<?php

/**
 * 512 : Saisie d'operation caisse
 * 522 : Impression d'un recu de caisse
 * http://www.iconarchive.com/search?q=money+icon+16x16
 */
class caisseController extends Controller {

    protected $comboJournals;
    protected $comboClasses;

    public function __construct() {
        parent::__construct();
        $this->loadModel("journal");
        $this->loadModel("compteeleve");
        $this->loadModel("personnel");
        $this->loadModel("classe");
        $this->loadModel("messagetype");
        $this->loadModel("eleve");
        $this->loadModel("frais");
        $this->loadModel("locan");
        $this->loadModel("caissesupprimee");

        $journals = $this->Journal->selectAll();
        $this->comboJournals = new Combobox($journals, "comboJournals", $this->Journal->getKey(), $this->Journal->getLibelle());

        $classe = $this->Classe->selectAll();
        $this->comboClasses = new Combobox($classe, "comboClasses", $this->Classe->getKey(), ["LIBELLE", "NIVEAUSELECT"]);
    }

    public function validerFraisObligatoire(){
        $compte = $this->Compteeleve->get($this->request->idcompte);
        $valeurs = $_POST['fraisobligatoire'];
        $fraisobligatoires = $this->Frais->getFraisObligatoiresNonPayes($this->request->idclasse, 
                        $compte["ELEVE"], $this->session->anneeacademique);
        foreach($fraisobligatoires as $fr){
            if(!in_array($fr['CODEFRAIS'], $valeurs)){
                return false;
            }else{
                $this->Frais->insertFraisObligatoireEleve($compte["ELEVE"], $fr['CODEFRAIS'], 
                        $this->session->anneeacademique);
            }
        }
        return true;
    }
    public function validerSaisie() {
        # Verifier les frais obligatoire
        $return_frais = true;
        if(isset($_POST['fraisobligatoire']) && !empty($_POST['fraisobligatoire'])){
            $return_frais = $this->validerFraisObligatoire();
        }
        if($return_frais){
            $personnel = $this->Personnel->getBy(["USER" => $this->session->iduser]);
            # Generer la refcaisse en function du time
            //$journal = $this->Journal->get($this->request->idjournal);
            //$refcaisse = $journal['CODE'].'000'.time();
            $typetransaction = empty($this->request->typetransaction) ? "C" : $this->request->typetransaction;
            if ($typetransaction == 'R') {
                $refcaisse = "RE" . '000' . time();
            } else {
                $refcaisse = "JE" . '000' . time();
            }

            $params = ["compte" => $this->request->idcompte,
                "type" => $typetransaction,
                "reftransaction" => $this->request->reftransaction,
                "refcaisse" => $refcaisse,
                "description" => $this->request->description,
                "montant" => $this->request->montant,
                "datetransaction" => date("Y-m-d H:i:s", time()),
                "enregistrerpar" => $personnel['IDPERSONNEL'],
                "periode" => $_SESSION['anneeacademique']];

            $this->Caisse->insert($params);
            $idcaisse = $this->Caisse->lastInsertId();
            $bordereau_banque = $this->request->bordereau;
            if (!empty($bordereau_banque)) {
                $this->Caisse->insertBordereauBanque($idcaisse, $bordereau_banque);
            }
            if($this->getSystemValue(SEND_NOTIFICATION_CAISSE_DIRECTLY)){
                //$this->insertToFirebaseFinance($idcaisse, $params);
            }
            header("Location:" . Router::url("caisse", "recu", $idcaisse));
        }else{
            $view = new View();
            $this->comboClasses->first = " ";
            $view->Assign("comboClasses", $this->comboClasses->view());
            $view->Assign("errors", true);
            $content = $view->Render("caisse" . DS . "saisie", false);
            $this->Assign("content", $content);
        }
    }
    public function insertToFirebaseFinance($idcaisse, $params){
        $firebase = new EdisFirestore();
        $caisse = $this->Caisse->get($idcaisse);
        $data = ["amount" => $params['montant'] . " FCFA", 
            "description" => $params['description'],
            "depositTime" => date("d/m/Y H:i:s", time())];
        $firebase->db->collection("finances")->document(INSTITUTION_CODE . "")
                ->collection("studentFinances")->document($caisse['ELEVE']."")
                ->collection("transactions")->document($idcaisse . "")->set($data);
        // send notification about the payement
      
        $responsables = $this->Eleve->getResponsables($caisse['ELEVE']);
        $personnel = $this->getConnectedUser();
        $message = $caisse['NOMEL']. ' '.$caisse['PRENOMEL']." a effectue un versement d'un montant de ". $params['montant']. " FCFA";
        foreach($responsables as $resp){
            if(!empty($resp['PORTABLE'])){
                $portable = getPhoneNumber($resp['PORTABLE']);
                $firebase->sendNotifications($personnel['NOM'].' '.$personnel['PRENOM'], 
                        "Notification financiere", $message, "Finance", $portable);
            }
        }
    }

    /**
     * Code droit 512: Saisie d'une operation caise
     */
    public function saisie() {
        if (!isAuth(512)) {
            return;
        }

        if (!empty($this->request->reftransaction)) {
            if (!empty($this->request->typetransaction) && $this->request->typetransaction == 'M') {
                $this->validerMoratoire();
            } else {
                $this->validerSaisie();
            }
        }
        $this->view->clientsJS("caisse" . DS . "saisie");
        $view = new View();

        $this->comboClasses->first = " ";
        $view->Assign("comboClasses", $this->comboClasses->view());

        $content = $view->Render("caisse" . DS . "saisie", false);
        $this->Assign("content", $content);
    }

    public function validerMoratoire() {
        $this->loadModel('moratoire');
        assert($this->request->typetransaction == 'M');
        $personnel = $this->Personnel->getBy(["USER" => $this->session->iduser]);
        $refmoratoire = "MO" . '000' . time();
        $params = [
            "compte" => $this->request->idcompte,
            "dateoperation" => date("Y-m-d H:i:s", time()),
            'valide' => 0,
            "montant" => $this->request->montant,
            "echeance" => parseDate($this->request->echeance),
            "refmoratoire" => $refmoratoire,
            "description" => $this->request->description,
            "enregistrerpar" => $personnel['IDPERSONNEL'],
            "periode" => $_SESSION['anneeacademique']];
        $this->Moratoire->insert($params);
        $idmoratoire = $this->Moratoire->lastInsertId();
        header("Location:" . Router::url("moratoire", "recu", $idmoratoire));
    }

    public function ajaxsaisie() {
        $action = $this->request->action;
        $json = array();
        $view = new View();

        switch ($action) {
            case "chargerComptes":
                $comptes = $this->Compteeleve->getComptesByClasse($this->request->idclasse);
                $view->Assign("comptes", $comptes);
                $json[0] = $view->Render("caisse" . DS . "ajax" . DS . "comboComptes", false);
                break;
            case "chargerPhoto":
                $compte = $this->Compteeleve->get($this->request->idcompte);
                $json[0] = SITE_ROOT . "public/photos/eleves/" . $compte['PHOTO'];
                # If the user has not yet paid all the required fees, print the required  fees
                $fraisobligatoires = $this->Frais->getFraisObligatoiresNonPayes($this->request->idclasse, 
                        $compte["ELEVE"], $this->session->anneeacademique);
                 $json[1] = false;
                if(!empty($fraisobligatoires)){
                    $json[1] = true; # this student has not paid all the required fees
                    # send the required fees to the views
                    $view->Assign("fraisobligatoires", $fraisobligatoires);
                }
                $json[2] = $view->Render("caisse" . DS . "ajax" . DS . "frais_obligatoires", false);
                $json[3] = MUST_PAY_ALL_REQUIRED_FEES; # true in IPW and false in Petit Wacgue
                break;
        }
        echo json_encode($json);
    }

    public function imprimer() {
        parent::printable();
        $view = new View();
        $view->Assign("pdf", $this->pdf);
        $school = $this->Locan->get(INSTITUTION_CODE);
        $view->Assign("school", $school);
        switch ($this->request->code) {
            # Impression de l'etat de ce compte caisse eleve
            case "0001":
                $compte = $this->Compteeleve->get($this->request->idcompte);
                $operations = $this->Caisse->getOperationsCaisse($compte['ELEVE']);
                $view->Assign("operations", $operations);
                $view->Assign("compte", $compte);
                $view->Assign("anneeacademique", $this->session->anneeacademique);
                echo $view->Render("eleve" . DS . "impression" . DS . "comptecaisse", false);
                break;

            # Impression du recu de caisse
            case "0002":
                # Inserer la perception du montant par l'utilisateur connecter
                $caisse = $this->Caisse->get($this->request->idcaisse);
                $personnel = $this->Personnel->getBy(["USER" => $this->session->iduser]);

                if (empty($caisse['PERCUPAR'])) {
                    $params = ["percupar" => $personnel['IDPERSONNEL'], "dateperception" => date("Y-m-d H:i:s", time())];
                    $this->Caisse->update($params, ["idcaisse" => $this->request->idcaisse]);
                }
                if (empty($caisse['IMPRIMERPAR'])) {
                    $params = ["imprimerpar" => $personnel['IDPERSONNEL'], "dateimpression" => date("Y-m-d H:i:s", time())];
                    $this->Caisse->update($params, ["idcaisse" => $this->request->idcaisse]);
                }
                # imprimer le recu
                $operation = $this->Caisse->get($this->request->idcaisse);
                $view->Assign("operation", $operation);
                $view->Assign("personnel", $personnel);

                $percepteur = $this->Personnel->get($operation['PERCUPAR']);
                $view->Assign("percepteur", $percepteur);

                $enregistreur = $this->Personnel->get($operation['ENREGISTRERPAR']);
                $view->Assign("enregistreur", $enregistreur);

                $classe = $this->Eleve->getClasse($operation['ELEVE'], $this->session->anneeacademique);
                $view->Assign("classe", $classe);
                $montantapayer = $this->Frais->getClasseTotalFrais($classe['IDCLASSE']);
                $view->Assign("montantapayer", $montantapayer);

                $montantpayer = $this->Caisse->getMontantPayer($operation['ELEVE']);
                $view->Assign("montantpayer", $montantpayer);
                $this->loadBarcode(BARCODE_1);
                $barcodeobj = new TCPDFBarcode($operation['REFCAISSE'], 'C128A');
                $view->Assign("barcode", $barcodeobj->getBarcodeHTML(1, 35, 'black'));
                echo $view->Render("caisse" . DS . "impression" . DS . "recu", false);
                break;
            case "0003":
            case "0004":
                $soldes = $this->Classe->getSoldeAllEleves();
                $montanfraisapplicable = $this->Frais->getAllFraisApplicables();
                $montantfrais = $this->Frais->getClasseSommeFrais();
                $view->Assign("soldes", $soldes);
                $view->Assign("montantfrais", $montantfrais);
                $view->Assign("montantfraisapplicable", $montanfraisapplicable);
                if ($this->request->code === "0003") {
                    $view->Assign("type", "debit");
                } else {
                    $view->Assign("type", "credit");
                }
                echo $view->Render("caisse" . DS . "impression" . DS . "situationfinanciere", false);
                break;
        }
    }

    /**
     * Impression d'un recu grace a l'operation caisse idcaisse
     * Afficher avant de proposer une impression
     * @param type $idcaisse
     */
    public function recu($idcaisse) {
        if (!isAuth(522)) {
            return;
        }
        $this->view->clientsJS("caisse" . DS . "recu");
        $view = new View();
        $operation = $this->Caisse->get($idcaisse);

        $view->Assign("operation", $operation);

        $this->loadBarcode(BARCODE_1);
        $barcodeobj = new TCPDFBarcode($operation['REFCAISSE'], 'C128A');
        $view->Assign("barcode", $barcodeobj->getBarcodeHTML(1, 35, 'black'));

        $personnel = $this->Personnel->getBy(["USER" => $this->session->iduser]);

        if (!empty($operation['PERCUPAR'])) {
            $percepteur = $this->Personnel->get($operation['PERCUPAR']);
            $view->Assign("percepteur", $percepteur);
        }

        if (!empty($operation['IMPRIMERPAR'])) {
            $imprimeur = $this->Personnel->get($operation['IMPRIMERPAR']);
        } else {
            $imprimeur = $personnel;
        }

        $percepteur = $this->Personnel->get($operation['PERCUPAR']);
        $view->Assign("percepteur", $percepteur);

        $enregistreur = $this->Personnel->get($operation['ENREGISTRERPAR']);
        $view->Assign("enregistreur", $enregistreur);

        $view->Assign("imprimeur", $imprimeur);
        $view->Assign("estDirectrice", ($this->session->idprofile === DIRECTOR_PROFILE) ? true : false);

        $classe = $this->Eleve->getClasse($operation['ELEVE'], $this->session->anneeacademique);
        $view->Assign("classe", $classe);
        $montantapayer = $this->Frais->getClasseTotalFrais($classe['IDCLASSE']);
        $view->Assign("montantapayer", $montantapayer);

        $montantpayer = $this->Caisse->getMontantPayer($operation['ELEVE']);
        $view->Assign("montantpayer", $montantpayer);
        $school = $this->Locan->get(INSTITUTION_CODE);
        $view->Assign("school", $school);
        $content = $view->Render("caisse" . DS . "recu", false);
        $this->Assign("content", $content);
    }

    

    public function operation() {
        $this->view->clientsJS("caisse" . DS . "operation");
        $view = new View();
        $this->comboJournals->first = "Tous les journaux";
        $view->Assign("comboJournals", $this->comboJournals->view());
        $operations = $this->Caisse->selectAll();

        $totaux = $this->Caisse->getMontantTotaux();

        $view->Assign("totaux", $totaux);
        $tableTotaux = $view->Render("caisse" . DS . "ajax" . DS . "tableTotaux", false);
        $view->Assign("tableTotaux", $tableTotaux);
        $view->Assign("operations", $operations);
        $tableOperation = $view->Render("caisse" . DS . "ajax" . DS . "operation", false);
        $view->Assign("tableOperation", $tableOperation);

        $operations = $this->Caissesupprimee->selectAll();
        $view->Assign("operations", $operations);
        $operationSupprimes = $view->Render("caisse" . DS . "ajax" . DS . "operationsupprimee", false);
        $view->Assign("operationSupprimes", $operationSupprimes);

        $operations = $this->Caisse->getOperationsRemises();
        $view->Assign('operations', $operations);
        $operationsRemises = $view->Render('caisse' . DS . 'ajax' . DS . 'operationRemise', false);
        $view->Assign('operationsRemises', $operationsRemises);

        $this->loadModel('moratoire');
        $operations = $this->Moratoire->selectAll();
        $view->Assign('operations', $operations);
        $moratoires = $view->Render('caisse' . DS . 'ajax' . DS . 'moratoire', false);
        $view->Assign('moratoires', $moratoires);

        # Frais obligatoires payeers
        $obligatoires = $this->Caisse->operationObligatoires();
        $view->Assign("obligatoires", $obligatoires);
        $fraisObligatoires = $view->Render("caisse" . DS . "ajax" . DS . "fraisObligatoires", false);
        $view->Assign("fraisObligatoires", $fraisObligatoires);
        $content = $view->Render("caisse" . DS . "operation", false);
        $this->Assign("content", $content);
    }

    public function ajaxoperation() {
        $action = $this->request->action;
        $json = array();
        $view = new View();
        $datedebut = parseDate($this->request->datedebut);
        $datefin = parseDate($this->request->datefin);
        switch ($action) {
            case "validerOperation" :
                $this->Caisse->update(["valide" => 1], ["idcaisse" => $this->request->idcaisse]);
                break;
            case "percuRecu" :
                # Inserer la perception du montant par l'utilisateur connecter
                $personnel = $this->Personnel->getBy(["USER" => $this->session->iduser]);
                $params = ["percupar" => $personnel['IDPERSONNEL'],
                    "dateperception" => date("Y-m-d H:i:s", time())];
                $this->Caisse->update($params, ["idcaisse" => $this->request->idcaisse]);
                break;
            case "supprimerFraisObligatoire":
                $idelevefrais = $this->request->idcaisse;
                $this->Frais->deleteEleveFraisObligatoire($idelevefrais);
                $obligatoires = $this->Caisse->operationObligatoires($datedebut, $datefin);
                $view->Assign("obligatoires", $obligatoires);
                $json[0] = $view->Render("caisse" . DS . "ajax" . DS . "fraisObligatoires", false);
                break;
        }


        # 1 = Operation en cours, 2 = Operation validee, 3 = Operation dont le montant est percue
        $filtre = $this->request->filtre;

        if (empty($datedebut)) {
            $datedebut = "1970-01-01";
        }
        if ($filtre == 1) {
            $operations = $this->Caisse->getOperationsEncours($datedebut, $datefin);
        } elseif ($filtre == 2) {
            $operations = $this->Caisse->getOperationsValidees($datedebut, $datefin);
        } elseif ($filtre == 3) {
            $operations = $this->Caisse->getOperationsPercues($datedebut, $datefin);
        } elseif (!empty($this->request->datedebut)) {
            $operations = $this->Caisse->getOperationsByJour($datedebut, $datefin);
        } else {
            $operations = $this->Caisse->selectAll();
        }
        if($action !== "supprimerFraisObligatoire"){
            $view->Assign("operations", $operations);
            $json[0] = $view->Render("caisse" . DS . "ajax" . DS . "operation", false);
        }

        # montant

        $totaux = $this->Caisse->getMontantTotaux($datedebut, $datefin);
        $view->Assign("totaux", $totaux);
        $json[1] = $view->Render("caisse" . DS . "ajax" . DS . "tableTotaux", false);
        echo json_encode($json);
    }

    public function delete($idcaisse) {
        $op = $this->Caisse->get($idcaisse);
        $params = [
            "compte" => $op['COMPTE'],
            "type" => $op['TYPE'],
            "reftransaction" => $op['REFTRANSACTION'],
            "refcaisse" => $op['REFCAISSE'],
            "description" => $op['DESCRIPTION'],
            "montant" => $op['MONTANT'],
            "datetransaction" => $op['DATETRANSACTION'],
            "enregistrerpar" => $op['ENREGISTRERPAR'],
            "percupar" => $op['PERCUPAR'],
            "dateperception" => $op['DATEPERCEPTION'],
            "imprimerpar" => $op['IMPRIMERPAR'],
            "dateimpression" => $op['DATEIMPRESSION'],
            "valide" => $op['VALIDE'],
            "periode" => $op['PERIODE'],
            'observations' => $op['OBSERVATIONS'],
            'dateobservation' => $op['DATEOBSERVATION']
        ];
        $this->Caissesupprimee->insert($params);
        $this->Donneesupprimee->insert(["IDTABLE" => $idcaisse, "NOMTABLE" => "caisses"]);
        $this->Caisse->delete($idcaisse);
        header("Location:" . Router::url("caisse", "operation"));
    }

    public function deletemoratoire($idmoratoire) {
        $personnel = $this->Personnel->getBy(["USER" => $this->session->iduser]);
        $params = ['supprimer' => date('Y-m-d H:i:s', time()),
            'supprimerpar' => $personnel['IDPERSONNEL']];
        $this->loadModel('moratoire');
        $this->Moratoire->update($params, ['idmoratoire' => $idmoratoire]);
        header("Location:" . Router::url("caisse", "operation"));
    }

    public function restaurer($idcaisse) {
        $op = $this->Caissesupprimee->get($idcaisse);
        $params = [
            "compte" => $op['COMPTE'],
            "type" => $op['TYPE'],
            "reftransaction" => $op['REFTRANSACTION'],
            "refcaisse" => $op['REFCAISSE'],
            "description" => $op['DESCRIPTION'],
            "montant" => $op['MONTANT'],
            "datetransaction" => $op['DATETRANSACTION'],
            "enregistrerpar" => $op['ENREGISTRERPAR'],
            "percupar" => $op['PERCUPAR'],
            "dateperception" => $op['DATEPERCEPTION'],
            "imprimerpar" => $op['IMPRIMERPAR'],
            "dateimpression" => $op['DATEIMPRESSION'],
            "valide" => $op['VALIDE'],
            "periode" => $op['PERIODE']
        ];
        $this->Caisse->insert($params);
        $this->Caissesupprimee->delete($idcaisse);
        header("Location:" . Router::url("caisse", "operation"));
    }

    public function ajaxobservation() {
        $json = array();
        $view = new View();
        $action = $this->request->action;
        $type = $this->request->type;
        $idcaisse = $this->request->idcaisse;
        if ($type == 'R') {
            $caisse = $this->Caisse->get($idcaisse);
        } else {
            $caisse = $this->Caissesupprimee->get($idcaisse);
        }
        switch ($action) {
            case "getobservation":
                $json[0] = empty($caisse['DATEOBSERVATION']) ? date("Y-m-d", time()) : $caisse['DATEOBSERVATION'];
                $json[1] = $caisse['OBSERVATIONS'];
                break;
            case "miseajour":
                $json[0] = "Mise &agrave; effectu&eacute;e avec succ&egrave;s";
                if (!isAuth(535) && !isAuth(536)) {
                    $json[0] = "Impossible!!!\nVous ne disposez d'aucun droit sur les observations de caisses";
                } else {
                    $params = ["dateobservation" => parseDate($this->request->dateobservation),
                        "observations" => $this->request->observations];
                    $ok = true;
                    if (empty($caisse['OBSERVATIONS'])) {
                        if (!isAuth(535)) {
                            $json[0] = "Vous ne disposez pas du droit de saisie sur les observations de caisse";
                            $ok = false;
                        }
                    } else {
                        if (!isAuth(536)) {
                            $json[0] = "Vous ne disposez pas du droit de modification sur les observations de caisses";
                            $ok = false;
                        }
                    }
                    if ($ok) {
                        if ($type == 'R') {
                            $this->Caisse->update($params, ['idcaisse' => $idcaisse]);
                        } else {
                            $this->Caissesupprimee->update($params, ["idcaisse" => $idcaisse]);
                        }
                        $operations = $this->Caissesupprimee->selectAll();
                        $view->Assign("operations", $operations);
                        $json[1] = $view->Render("caisse" . DS . "ajax" . DS . "operationsupprimee", false);
                        $operations = $this->Caisse->getOperationsRemises();
                        $view->Assign("operations", $operations);
                        $json[2] = $view->Render("caisse" . DS . "ajax" . DS . "operationRemise", false);
                    }
                }
                break;
        }
        print json_encode($json);
    }

}
