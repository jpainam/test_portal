<?php

/**
 * http://uni-graz.at/~vollmanr/unicode/uni_letter_e.html
 * http://www.fileformat.info/info/unicode/char/1db0/index.htm
 * http://www.datatables.net/examples/api/tabs_and_scrolling.html
 */
class classeController extends Controller {

    public function __construct() {
        parent::__construct();
        /**
         * Charger les libraries utiliser dans cette classe
         */
        $this->loadModel("inscription");
        $this->loadModel("personnel");
        $this->loadModel("responsable");
        $this->loadModel("enseignement");
        $this->loadModel("classeparametre");
        $this->loadModel("matiere");
        $this->loadModel("groupe");
        $this->loadModel("niveau");
        $this->loadModel("eleve");
        $this->loadModel("frais");
        $this->loadModel("emplois");
        $this->loadModel("horaire");
        $this->loadModel("scolarite");
        $this->loadModel("decoupage");
        $this->loadModel("sequence");
        $this->loadModel("messagerappel");
        $this->loadModel("messagetype");
        $this->loadModel("classeverrouillage");
        $this->loadModel("notation");
        $this->loadModel("appel");
        $this->loadModel("recapitulatifbulletin");
        $this->loadModel("recapitulatif");
        $this->loadModel("bulletin");
        $this->loadModel("compteeleve");
        $this->loadModel("manuelscolaire");
    }

    public function index() {
        if (!isAuth(202)) {
            return;
        }
        $this->view->clientsJS("classe" . DS . "index");
        $view = new View();
        $data = $this->Classe->selectAll();
        $comboClasse = new Combobox($data, "comboClasses", "IDCLASSE", ["LIBELLE", "NIVEAUSELECT"]);
        $comboClasse->first = " ";
        $view->Assign("comboClasses", $comboClasse->view());
        $content = $view->Render("classe" . DS . "index", false);
        $this->Assign("content", $content);
    }

    public function ajaxclasse() {
        $json = array();
        $view = new View();
        //Onglet 1
        $eleves = $this->Inscription->getInscrits($this->request->idclasse, $this->session->anneeacademique);
        $view->Assign("eleves", $eleves);
        //Renvoyer un tableau contenant les id des eleve redoublant
        $array_of_redoublants = $this->Classe->getRedoublants($this->request->idclasse, $this->session->anneeacademique, true);
        $view->Assign("array_of_redoublants", $array_of_redoublants);

        $json[0] = $view->Render("classe" . DS . "ajax" . DS . "onglet1", false);
        //Onglet 2
        $enseignants = $this->Enseignement->getEnseignements($this->request->idclasse);
        $view->Assign("enseignants", $enseignants);
        $json[1] = $view->Render("classe" . DS . "ajax" . DS . "onglet2", false);

        # Onglet 3
        $ens = $this->Emplois->getEmplois($this->request->idclasse);
        $view->Assign("enseignements", $ens);
        $horaire = $this->Horaire->selectAll();
        $heure_debut = array();
        foreach ($horaire as $line) {
             $heure_debut[] = substr(_heure($line["HEUREDEBUT"]), 0, strlen(_heure($line["HEUREDEBUT"])) - 3);
        }
        $synchronisations = $this->Classe->getSynchronisationEmplois($this->request->idclasse);
        $nb = $synchronisations == null ? 0 : count($synchronisations);
        $view->Assign("nb_sync_emplois", $nb);
        $view->Assign("horaire", $horaire);
        $view->Assign("heure_debut", json_encode($heure_debut));
        $json[2] = $view->Render("classe" . DS . "ajax" . DS . "onglet3", false);

        # Onglet 4
        $soldes = $this->Classe->getSoldeEleves($this->request->idclasse);
        $view->Assign("soldes", $soldes);
        $montanfraisapplicable = $this->Frais->getTotalFraisApplicables($this->request->idclasse)['MONTANTAPPLICABLE'];
        $view->Assign("montanfraisapplicable", $montanfraisapplicable);

        $json[3] = $view->Render("classe" . DS . "ajax" . DS . "onglet5", false);
        $classe_parametre = $this->Classeparametre->findSingleRowBy(["CLASSE" => $this->request->idclasse]);

        $json[4] = $classe_parametre['NOMPRINCIPALE'] . " " . $classe_parametre['PRENOMPRINCIPALE'];
        $json[5] = $classe_parametre['NOMRESPONSABLE'] . " " . $classe_parametre['PRENOMRESPONSABLE'];
        $json[6] = $classe_parametre['NOMADMIN'] . " " . $classe_parametre['PRENOMADMIN'];
        $json[7] = count($eleves);
        $json[8] = moneyString($this->Frais->getClasseTotalFrais($this->request->idclasse)['TOTALFRAIS']) . " fcfa";

        # onglet 5 : Notification financiere ou lettre de rappel
        //$notifications = $this->Messagerappel->selectAll();
        //$view->Assign("notifications", $notifications);
        //$json[9] = $view->Render("classe" . DS . "ajax" . DS . "notificationfinanciere", false);
        $enseignements = $this->Enseignement->getEnseignements($this->request->idclasse);
        $view->Assign("enseignements", $enseignements);
        $json[9] = $view->Render("classe" . DS . "ajax" . DS . "onglet4", false);

        # Onglet 6 Manuel scolaire
        $manuels = $this->Classe->getManuelsScolaires($this->request->idclasse);
        $sync_manuel = $this->Classe->getSynchronisationManuels($this->request->idclasse);
        $nb = $sync_manuel == null ? 0 : count($sync_manuel);
        $view->Assign("nb_sync_manuels", $nb);
        $view->Assign("manuels", $manuels);
        $json[10] = $view->Render("classe" . DS . "ajax" . DS . "onglet6", false);
        echo json_encode($json);
    }

    /**
     * appeler dans saisie 
     */
    private function showClasses() {
        $classes = $this->Classe->selectAll();
        $grid = new Grid($classes, 0);
        $grid->addcolonne(0, "ID", "IDCLASSE", false);
        $grid->addcolonne(1, "Code", "NIVEAUSELECT");
        $grid->addcolonne(2, "Libellé", "LIBELLE");
        $grid->addcolonne(3, "Découpage", "FK_DECOUPAGE");
        $grid->editbutton = true;
        $grid->deletebutton = true;
        $grid->droitedit = 517;
        $grid->droitdelete = 518;
        /* $this->Assign("content", (new View())->output(array("classes",
          $grid->display(),
          "errors", false), false)); */
        $view = new View();
        $view->Assign("classes", $grid->display());
        $view->Assign("errors", false);
        $view->Assign("total", count($classes));
        $content = $view->Render("classe" . DS . "showClasses", false);
        $this->Assign("content", $content);
    }

    public function edit($id) {
        $this->view->clientsJS("classe" . DS . "edit");
        $view = new View();
        $classe = $this->Classe->get($id);
        $view->Assign("classe", $classe);
        $view->Assign("idclasse", $id);
        /**
         * Parametre de la classe, son prof principale, son administrateur principale
         * son cpe principale sous forme de variable dataTable if defined
         */
        $param = $this->Classeparametre->findSingleRowBy(["CLASSE" => $id]);
        //Prof Principale\
        $prof = $this->Personnel->findSingleRowBy(["IDPERSONNEL" => $param['PROFPRINCIPALE']]);
        $view->Assign("prof", $prof);
        //CPE principale
        $cpe = $this->Responsable->findSingleRowBy(["IDRESPONSABLE" => $param['CPEPRINCIPALE']]);
        $view->Assign("cpe", $cpe);
        //Administration principale
        $admin = $this->Personnel->findSingleRowBy(["IDPERSONNEL" => $param['RESPADMINISTRATIF']]);
        $view->Assign("admin", $admin);
        /**
         * Les des enseignants, personnels, et responsable pour les combobox
         */
        //Enseignant
        $pers = $this->Personnel->selectAll();
        $comboEnseignants = new Combobox($pers, "listeenseignant", "IDPERSONNEL", "CNOM");
        $view->Assign("comboEnseignants", $comboEnseignants->view());

        $pers2 = $this->Personnel->selectAll();
        $comboEnseignants2 = new Combobox($pers2, "listeenseignant2", "IDPERSONNEL", "CNOM");
        $view->Assign("comboEnseignants2", $comboEnseignants2->view());

        //Responsable
        $data = $this->Responsable->selectAll();
        $comboResponsables = new Combobox($data, "listeresponsable", "IDRESPONSABLE", "CNOM");
        $view->Assign("comboResponsables", $comboResponsables->view());

        //groupe
        $groupe = $this->Groupe->selectAll();
        $groupeCombo = new Combobox($groupe, "groupe", "IDGROUPE", "DESCRIPTION");
        $view->Assign("comboGroupe", $groupeCombo->view());

        //groupe2
        $groupe2 = $this->Groupe->selectAll();
        $groupeCombo2 = new Combobox($groupe2, "groupe2", "IDGROUPE", "DESCRIPTION");
        $view->Assign("comboGroupe2", $groupeCombo2->view());

        //Matiere
        $mat = $this->Matiere->selectAll();
        $view->Assign("matieres", $mat);
        $comboMatieres = new Combobox($mat, "listematiere", "IDMATIERE", "LIBELLE");
        $view->Assign("comboMatieres", $comboMatieres->view());
        //Enseignements
        $ens = $this->Enseignement->getEnseignements($id);
        $view->Assign("enseignements", $ens);

        $view->Assign("message", "");

        $content = $view->Render("classe" . DS . "edit", false);
        $this->Assign("content", $content);
    }

    private function validerSaisie(){
        if(empty( $this->request->libelle)){
            $libelle =  $this->request->niveau;
        }else{
            $libelle =  $this->request->libelle;
        }
        $niveauhtml = $this->request->numero;
        $niveauselect = $this->request->numero;
        if(!empty($this->request->exposant)){
            $niveauhtml .=  " <sup>" . $this->request->exposant . "</sup> ";
           $niveauselect .=  $this->request->exposant . " ";
        }
        if(!empty($this->request->abrege)){
            $niveauhtml .= $this->request->abrege;
             $niveauselect .= $this->request->abrege;
        }
        $this->Niveau->insert(["niveauselect" => $niveauselect, 
            'niveauhtml' => $niveauhtml, 
            'groupe' => $this->request->groupe,
            "typeenseignement" => $this->request->type]);
        $idniveau = $this->Niveau->lastInsertId();
        $this->Classe->insert(array("libelle" =>$libelle, 
            "decoupage" => 1, // Always sequence
            "section" => $this->request->section,
            "cycle" => $this->request->cycle,
            "niveau" => $idniveau, 
            "anneeacademique" => $this->session->anneeacademique));
         header("Location:" . Router::url("classe"));
    }
    
    public function saisie() {
        //505 Saisie des classes
        if (!isAuth(505)) {
            return;
        }
        $this->view->clientsJS("classe" . DS . "classe");
        if (isset($this->request->abrege)) {
            $this->validerSaisie();
        }
        //202 Consultation des informations sur les classes
        if (!isset($this->request->saisie) && isAuth(202)) {
            $this->showClasses();
        } else {
            $view = new View();
            $view->Assign("errors", false);
            $this->loadModel("inscription");
            //Envoyer seulement la liste des eleves non inscrits pour cette periode academique
            $elevesnoninscrits = $this->Inscription->getNonInscrits($this->session->anneeacademique);
            $comboEleve = new Combobox($elevesnoninscrits, "listeeleve", "IDELEVE", "CNOM");
            $view->Assign("comboEleves", $comboEleve->view());

            $pers = $this->Personnel->selectAll();
            $comboEnseignants = new Combobox($pers, "listeenseignant", "IDPERSONNEL", "CNOM");
            $comboEnseignants->idname = "";
            $view->Assign("comboEnseignants", $comboEnseignants->view());

            $data = $this->Responsable->selectAll();
            $comboResponsables = new Combobox($data, "listeresponsable", "IDRESPONSABLE", "CNOM");
            $view->Assign("comboResponsables", $comboResponsables->view());

            $mat = $this->Matiere->selectAll();
            $comboMatieres = new Combobox($mat, "listematiere", "IDMATIERE", "LIBELLE");
            $view->Assign("comboMatieres", $comboMatieres->view());

            $niveau = $this->Niveau->selectAll();
            $comboNiveau = new Combobox($niveau, "niveau", "IDNIVEAU", "NIVEAUSELECT");
            $view->Assign("comboNiveau", $comboNiveau->view());

            $groupe = $this->Groupe->selectAll();
            $groupeCombo = new Combobox($groupe, "groupe", "IDGROUPE", "DESCRIPTION");
            $view->Assign("comboGroupe", $groupeCombo->view());

            $this->loadModel("manuelscolaire");
            $manuels = $this->Manuelscolaire->selectAll();
            $view->Assign("manuels", $manuels);
            $content = $view->Render("classe" . DS . "saisie", false);
            $this->Assign("content", $content);
        }
    }

    public function validateEdit() {
        //Faire un dernier update si on clique sur okay
        $params = ["LIBELLE" => $this->request->libelle,
            "DECOUPAGE" => 1, //Always sequence
            "section" => $this->request->section,
            "ANNEEACADEMIQUE" => $this->session->anneeacademique];
        /*if (isset($this->request->niveau)) {
            $params["NIVEAU"] = $this->request->niveau;
        }*/
        $this->Classe->update($params, ["IDCLASSE" => $this->request->idclasse]);
        header("Location:" . Router::url("classe"));
    }

    public function inscription($id = "") {
        if (empty($id)) {
            $classes = $this->Classe->selectAll();
            $view = new View();
            $view->Assign("classes", $classes);

            $content = $view->Render("classe" . DS . "listeinscrire", false);
            $this->Assign("content", $content);
            return;
        }
        $this->view->clientsJS("classe" . DS . "inscription");
        $view = new View();
        $view->Assign("errors", false);
        /**
         * Information sur la classe
         */
        $classe = $this->Classe->findSingleRowBy(["IDCLASSE" => $id]);
        $view->Assign("libelle", $classe['LIBELLE']);
        $this->loadModel("niveau");
        $niveau = $this->Niveau->selectAll();
        $comboNiveau = new Combobox($niveau, "niveau", "IDNIVEAU", "NIVEAUSELECT");
        $comboNiveau->selectedid = $classe['NIVEAU'];

        # Desactiver le niveau pour l'edition
        $comboNiveau->disabled = true;
        $view->Assign("comboNiveau", $comboNiveau->view());

        $data = $this->Decoupage->selectAll();
        $comboDecoupage = new Combobox($data, "decoupage", "IDDECOUPAGE", "LIBELLE", true, $classe["DECOUPAGE"]);
        $comboDecoupage->disabled = true;
        $view->Assign("comboDecoupage", $comboDecoupage->view());
        $view->Assign("idclasse", $id);

        /**
         * Combo des eleves non encore inscrits
         */
        $elevesnoninscrits = $this->Inscription->getNonInscrits($this->session->anneeacademique);
        $comboEleve = new Combobox($elevesnoninscrits, "listeeleve", "IDELEVE", "CNOM");
        $view->Assign("comboElevesNonInscrits", $comboEleve->view());

        /**
         * Eleve deja inscrits dans cette classe a cette periode
         */
        $elevesInscrits = $this->Inscription->getInscrits($id, $this->session->anneeacademique);
        $view->Assign("elevesInscrits", $elevesInscrits);
        $content = $view->Render("classe" . DS . "inscription", false);
        $this->Assign("content", $content);
    }

    public function ajax($zone) {
        $json = array();
        $idclasse = $this->request->idclasse;
        $json[0] = $idclasse;
        $view = new View();

        switch ($zone) {
            case "eleve":
                # Verifier qu'il est inscrivable
                $solde = $this->estInscrivable($this->request->identifiant);
                $this->loadModel("eleveexclus");
                $exclus = $this->Eleveexclus->getBy(["ELEVE" => $this->request->identifiant]);
                if ($solde < 0) {
                    $json[3] = $solde;
                    $json[4] = "debitaire";
                } elseif (isset($exclus) && !empty($exclus)) {
                    $json[3] = $exclus['DATEEXCLUSION'];
                    $json[4] = "exclus";
                } else {
                    # Inscrire l'eleve dans  cette classe. Confere la methode inscrire de cette classe
                    $this->inscrire($this->request->identifiant, $idclasse);
                    $json[3] = 0;
                    $json[4] = "inscrit";
                }
                # Mettre a jour le matricule puisqu'on connait deja la classe
                $this->updateMatricule($this->request->identifiant, $idclasse);
                # Obtenir la liste des eleves inscrits dans cette classe et renvoye dans la vue
                $elevesinscrits = $this->Inscription->getInscrits($idclasse, $this->session->anneeacademique);
                $view->Assign("eleves", $elevesinscrits);
                $json[1] = $view->Render("classe" . DS . "ajax" . DS . "eleve", false);

                //enlever de la liste les eleves deja inscrit
                $elevesnoninscripts = $this->Inscription->getNonInscrits($this->session->anneeacademique);
                $view->Assign("elevesnoninscripts", $elevesnoninscripts);
                $comboEleve = new Combobox($elevesnoninscripts, "listeeleve", "IDELEVE", "CNOM");
                $view->Assign("comboEleves", $comboEleve->view());
                $json[2] = $view->Render("classe" . DS . "ajax" . DS . "comboInscription", false);
                ;
                break;
            case "profprincipale":
                //Inserer le professeur principale
                $classparams = $this->Classeparametre->findBy(["classe" => $idclasse, "anneeacademique" => $_SESSION['anneeacademique']]);
                if (empty($classparams)) {
                    $params = ["classe" => $idclasse,
                        "profprincipale" => $this->request->identifiant,
                        "anneeacademique" => $_SESSION['anneeacademique']];
                    $this->Classeparametre->insert($params);
                } else {
                    $keys = ["CLASSE" => $idclasse, "anneeacademique" => $_SESSION['anneeacademique']];
                    $this->Classeparametre->update(["PROFPRINCIPALE" => $this->request->identifiant], $keys);
                }
                $prof = $this->Personnel->findSingleRowBy(["IDPERSONNEL" => $this->request->identifiant]);
                $view->Assign("prof", $prof);
                $json[1] = $view->Render("classe" . DS . "ajax" . DS . "profprincipale", false);
                $json[2] = SITE_ROOT . "public/img/btn_add_disabled.png";
                break;
            case "cpeprincipale":
                $classparams = $this->Classeparametre->findBy(["classe" => $idclasse, "anneeacademique" => $_SESSION['anneeacademique']]);
                if (empty($classparams)) {
                    $params = ["classe" => $idclasse,
                        "cpeprincipale" => $this->request->identifiant,
                        "anneeacademique" => $_SESSION['anneeacademique']];
                    $this->Classeparametre->insert($params);
                } else {
                    $keys = ["CLASSE" => $idclasse, "anneeacademique" => $_SESSION['anneeacademique']];
                    $this->Classeparametre->update(["CPEPRINCIPALE" => $this->request->identifiant], $keys);
                }
                $cpe = $this->Responsable->findSingleRowBy(["IDRESPONSABLE" => $this->request->identifiant]);
                $view->Assign("cpe", $cpe);
                $json[1] = $view->Render("classe" . DS . "ajax" . DS . "cpeprincipale", false);
                $json[2] = SITE_ROOT . "public/img/btn_add_disabled.png";
                break;
            case "adminprincipale":
                $classparams = $this->Classeparametre->findBy(["classe" => $idclasse, "anneeacademique" => $_SESSION['anneeacademique']]);
                if (empty($classparams)) {
                    $params = ["classe" => $idclasse,
                        "respadministratif" => $this->request->identifiant,
                        "anneeacademique" => $_SESSION['anneeacademique']];
                    $this->Classeparametre->insert($params);
                } else {
                    $keys = ["CLASSE" => $idclasse, "anneeacademique" => $_SESSION['anneeacademique']];
                    $this->Classeparametre->update(["RESPADMINISTRATIF" => $this->request->identifiant], $keys);
                }
                $admin = $this->Personnel->findSingleRowBy(["IDPERSONNEL" => $this->request->identifiant]);
                $view->Assign("admin", $admin);
                $json[1] = $view->Render("classe" . DS . "ajax" . DS . "adminprincipale", false);
                $json[2] = SITE_ROOT . "public/img/btn_add_disabled.png";
                break;
            case "ajoutmatiere":
                //Ajout enseignement
                $mat = json_decode($_POST['matiere']);
                $params = ["MATIERE" => $mat->matiere, "PROFESSEUR" => $mat->enseignant,
                    "CLASSE" => $idclasse, "GROUPE" => $mat->groupe, "ORDRE" => $mat->ordre, "COEFF" => $mat->coeff];
                $deja = $this->Enseignement->findBy(array(
                    "matiere" => $mat->matiere,
                    "classe" => $idclasse));
                if (empty($deja)) {
                    $this->Enseignement->insert($params);
                } else {
                    $this->Enseignement->update($params, array(
                        "matiere" => $mat->matiere,
                        "classe" => $idclasse));
                }
                $ens = $this->Enseignement->getEnseignements($idclasse);
                $view->Assign("enseignements", $ens);

                if ($_GET['url'] !== "classe/saisie") {
                    $json[1] = $view->Render("classe" . DS . "ajax" . DS . "editmatiere", false);
                } else {
                    $json[1] = $view->Render("classe" . DS . "ajax" . DS . "matiere", false);
                }
                $view->Assign("matieres", $this->Enseignement->getNonEnseignements($idclasse));
                $json[2] = $view->Render("classe" . DS . "ajax" . DS . "dialog-5", false);
                break;
            case "editenseignement":
                //edition enseignement
                $mat = json_decode($_POST['matiere']);

                $params = ["PROFESSEUR" => $mat->enseignant, "CLASSE" => $idclasse, "GROUPE" => $mat->groupe, "COEFF" => $mat->coeff,
                    "ORDRE" => $mat->ordre];
                if (isset($mat->matiere)) {
                    $params["MATIERE"] = $mat->matiere;
                  
                }
                $this->Enseignement->update($params, ["IDENSEIGNEMENT" => $this->request->identifiant]);
                $ens = $this->Enseignement->getEnseignements($idclasse);
                $view->Assign("enseignements", $ens);
                if ($_GET['url'] !== "classe/saisie") {
                    $json[1] = $view->Render("classe" . DS . "ajax" . DS . "editmatiere", false);
                } else {
                    $json[1] = $view->Render("classe" . DS . "ajax" . DS . "matiere", false);
                }
                $view->Assign("matieres", $this->Enseignement->getNonEnseignements($idclasse));
                $json[2] = $view->Render("classe" . DS . "ajax" . DS . "dialog-5", false);
                break;
        }
        echo json_encode($json);
    }

    /**
     * Permet de supprimer le prof principale (action = 1), ou le 
     * cpe principale (action = 2) ou l'administrateur principale (action = 3)
     * Utilise avec ajax dans la page saisie classe
     * @param type $action
     */
    public function deletePrincipale() {
        $action = $this->request->action;

        $tableid = "";
        switch ($action) {
            case 1: $tableid = "tab_pp";
                break;
            case 2: $tableid = "tab_cpe";
                break;
            case 3: $tableid = "tab_ra";
                break;
        }
        $classparams = $this->Classeparametre->findSingleRowBy(["CLASSE" => $this->request->idclasse]);
        $this->Classeparametre->deletePrincipale($action, $classparams['IDPARAMETRE']);
        $view = new View();
        $view->Assign("tableid", $tableid);
        $json = array();
        $json[0] = $this->request->idclasse;
        $json[1] = $view->Render("classe" . DS . "ajax" . DS . "deleteprincipale", false);
        $json[2] = SITE_ROOT . "public/img/btn_add.png";
        echo json_encode($json);
    }

    //Supprime un enseignement de la page saisie enseignement via ajax
    public function deleteEnseignement() {
        if (!isAuth(533)) {
            return;
        }
        $this->loadModel("enseignement");
        $this->Enseignement->delete($this->request->idenseignement);
        $view = new View();
        $json = array();
        $view->Assign("matieres", $this->Enseignement->getNonEnseignements($this->request->idclasse));
        $json[0] = $view->Render("classe" . DS . "ajax" . DS . "dialog-5", false);
        $ens = $this->Enseignement->getEnseignements($this->request->idclasse);
        $view->Assign("enseignements", $ens);
        if ($_GET['url'] !== "classe/saisie") {
            $json[1] = $view->Render("classe" . DS . "ajax" . DS . "editmatiere", false);
        } else {
            $json[1] = $view->Render("classe" . DS . "ajax" . DS . "matiere", false);
        }
        echo json_encode($json);
    }

    public function delete($id) {
        if ($this->Classe->delete($id)) {
            header("Location: " . Router::url("classe", "saisie"));
        } else {
            $this->Assign("content", (new View())->output(["errors" => true], false));
        }
    }
    public function imprimer() {
        parent::printable();
        $action = $this->request->code;
        $type = $this->request->type_impression;
        $view = new View();
        $view->Assign("pdf", $this->pdf);


        $params = $this->Classeparametre->getBy(["CLASSE" => $this->request->idclasse]);
        $classe = $this->Classe->getBy(["IDCLASSE" => $this->request->idclasse]);
        $eleves = $this->Inscription->getInscrits($this->request->idclasse, $this->session->anneeacademique);

        $array_of_redoublants = $this->Classe->getRedoublants($this->request->idclasse, $this->session->anneeacademique, true);
        $view->Assign("array_of_redoublants", $array_of_redoublants);

        $view->Assign("params", $params);

        $view->Assign("classe", $classe);
        switch ($action) {
            case "0001":
                # Renvoyer un tableau contenant les id des eleve redoublant
                $view->Assign("eleves", $eleves);
                if ($type == "pdf") {
                    echo $view->Render("classe" . DS . "impression" . DS . "listesimpleeleves", false);
                } elseif ($type == "excel") {
                    echo $view->Render("classe" . DS . "xls" . DS . "listesimpleeleves", false);
                }
                break;

            # Imprimer la liste detaille des eleves de cette classe
            //case "0002":
            //   $view->Assign("eleves", $eleves);
            //   echo $view->Render("classe" . DS . "impression" . DS . "listedetailleeleves", FALSE);
            //   break;
            # Imprimer l'etat financiere de cette classe
            case "0003":
            case "0008":

                $view->Assign("effectif", count($eleves));
                $montanttotal = $this->Frais->getClasseTotalFrais($this->request->idclasse)['TOTALFRAIS'];

                $soldes = $this->Classe->getSoldeEleves($this->request->idclasse);
                $view->Assign("soldes", $soldes);
                $montanfraisapplicable = $this->Frais->getTotalFraisApplicables($this->request->idclasse)['MONTANTAPPLICABLE'];

                $view->Assign("montanfraisapplicable", $montanfraisapplicable);
                $view->Assign("montanttotal", $montanttotal);
                if ($action === "0008") {
                    if ($type == "pdf") {
                        echo $view->Render("classe" . DS . "impression" . DS . "elevesdebiteurs", false);
                    } else {
                        echo $view->Render("classe" . DS . "xls" . DS . "elevesdebiteurs", false);
                    }
                } else {
                    if ($type == "pdf") {
                        echo $view->Render("classe" . DS . "impression" . DS . "situationfinanciere", false);
                    } else {
                        echo $view->Render("classe" . DS . "xls" . DS . "situationfinanciere", false);
                    }
                }
                break;

            # Impression de lettre de rappel pour les eleves qui doivent
            case "0004":
                # Obtenir les montant actuellement applicable
                $montantfraisapplicable = $this->Frais->getTotalFraisApplicables($this->request->idclasse);
                $view->Assign("montantfraisapplicable", $montantfraisapplicable);

                $eleves = $this->Classe->getSoldeEleves($this->request->idclasse);
                $view->Assign("eleves", $eleves);

                $frais = $this->Frais->getLastFrais($this->request->idclasse);
                $view->Assign("frais", $frais);
                echo $view->Render("classe" . DS . "impression" . DS . "lettrerappel", false);
                break;

            # Impression de la synthse, etat et assiduite des eleves accessible via classe/index
            case "0005":
                echo $view->Render("classe" . DS . "impression" . DS . "syntheseassiduite", false);
                break;
            # Imprimer l'emploi du temps de cette classe
            case "0006":
                $this->loadModel("emplois");
                $classe = $this->Classe->get($this->request->idclasse);
                $view->Assign("classe", $classe);
                $ens = $this->Emplois->getEmplois($this->request->idclasse);
                $view->Assign("enseignements", $ens);
                $this->loadModel("horaire");
                $horaires = $this->Horaire->findBy(["PERIODE" => $this->session->anneeacademique]);
                $view->Assign("horaires", $horaires);
                echo $view->Render("classe" . DS . "impression" . DS . "emploisdutemps", false);
                break;
            case "0007":
                $view->Assign("eleves", $eleves);
                if (isset($this->request->idperiode)) {
                    $sequence = $this->Sequence->get($this->request->idperiode);
                } else {
                    $sequence = $this->Sequence->getSequenceByDate(date("Y-m-d", time()));
                }
                $view->Assign("sequence", $sequence);
                echo $view->Render("classe" . DS . "impression" . DS . "fichesuiviperiodique", false);
                break;
            case "0009":
                $ens = $this->Enseignement->getEnseignements($this->request->idclasse);
                $view->Assign("enseignements", $ens);
                if ($type == "pdf") {
                    echo $view->Render("classe" . DS . "impression" . DS . "listedesmatieres", false);
                } elseif ($type == "excel") {
                    echo $view->Render("classe" . DS . "xls" . DS . "listedesmatieres", false);
                }
                break;
            case "0010":
                $manuels = $this->Classe->getManuelsScolaires($this->request->idclasse);
                $view->Assign("manuels", $manuels);
                if ($type == "pdf") {
                    echo $view->Render("classe" . DS . "impression" . DS . "listemanuelscolaire", false);
                } elseif ($type == "excel") {
                    echo $view->Render("classe" . DS . "xls" . DS . "listemanuelscolaire", false);
                }
                break;
        }
    }

    public function verrouillage() {
        if (!isAuth(610)) {
            return;
        }
        $this->view->clientsJS("classe" . DS . "verrouillage");
        $view = new View();
        $sequences = $this->Sequence->getSequences($this->session->anneeacademique);
        $comboSequence = new Combobox($sequences, "comboSequences", $this->Sequence->getKey(), $this->Sequence->getLibelle());
        $comboSequence->first = " ";
        $view->Assign("comboSequences", $comboSequence->view());

        $content = $view->Render("classe" . DS . "verrouillage", false);
        $this->Assign("content", $content);
    }

    public function ajaxverrouillage() {
        $action = $this->request->action;
        $view = new View();
        $json = array();
        switch ($action) {
            case "verrouiller":
                # Supprimer les ancien info concernant la classe et la sequence
                $this->Recapitulatifbulletin->deleteBy(["sequence" => $this->request->idsequence,
                    "classe" => $this->request->idclasse]);
                # Inserer dans la BD, un resume des bulletins de la sequence
                $this->recapitulerMoyenne($this->request->idclasse, $this->request->idsequence);


                # Verrouiller egalement toutes les notes dans la table notation de ce semestre
                $enseignements = $this->Enseignement->findBy(["CLASSE" => $this->request->idclasse]);
                foreach ($enseignements as $ens) {
                    $this->Notation->update(["VERROUILLER" => 1], ["SEQUENCE" => $this->request->idsequence,
                        "ENSEIGNEMENT" => $ens['IDENSEIGNEMENT']]);
                }

                # Verrouiller les appels de cette sequence
                $sequence = $this->Sequence->get($this->request->idsequence);
                $this->Appel->lockAppelsByPeriode($sequence['DATEDEBUT'], $sequence['DATEFIN']);

                break;
            case "deverrouiller":
                $this->Sequence->update(["VERROUILLER" => 0], ["IDSEQUENCE" => $this->request->idsequence]);
                # Deverrouiller egalement les notes de ce semestre
                $enseignements = $this->Enseignement->findBy(["CLASSE" => $this->request->idclasse]);
                foreach ($enseignements as $ens) {
                    $this->Notation->update(["VERROUILLER" => 0], ["SEQUENCE" => $this->request->idsequence,
                        "ENSEIGNEMENT" => $ens['IDENSEIGNEMENT']]);
                }

                # Deverrouiller les appels de cette sequences
                $sequence = $this->Sequence->get($this->request->idsequence);
                $this->Appel->unlockAppelsByPeriode($sequence['DATEDEBUT'], $sequence['DATEFIN']);

                # Supprimer le resume des bulletins precedement defini lors du verrouillage
                $this->Recapitulatifbulletin->deleteBy(["sequence" => $this->request->idsequence,
                    "classe" => $this->request->idclasse]);
                $this->Classeverrouillage->deleteBy(["classe" => $this->request->idclasse,
                    "sequence" => $this->request->idsequence]);
                break;
        }

        $classes = $this->Classeverrouillage->getClasses($this->request->idsequence);
        $view->Assign("classes", $classes);
        $json[0] = $view->Render("classe" . DS . "ajax" . DS . "verrouillage", false);
        echo json_encode($json);
    }

    public function recapitulerMoyenne($idclasse, $idsequence) {

        $this->Bulletin->createTMPNoteTable($idclasse, $idsequence);

        # Obtenir les moyennes de classe, la moyenne max et la moyenne min
        $moyennes = $this->Bulletin->getGlobalMoyenne();
        $params = ["classe" => $idclasse,
            "sequence" => $idsequence,
            "moyclasse" => $moyennes['MOYCLASSE'],
            "moymin" => $moyennes['MOYMIN'],
            "moymax" => $moyennes['MOYMAX']];
        $this->Recapitulatifbulletin->insert($params);
        $idrecapitulatifbulletin = $this->Recapitulatifbulletin->lastInsertId();

        # Obtenir le rang des eleves
        $rangs = $this->Bulletin->getElevesRang();
        foreach ($rangs as $rang) {
            $params = ["recapitulatifbulletin" => $idrecapitulatifbulletin,
                "eleve" => $rang['IDELEVE'],
                "moyenne" => $rang['MOYGENERALE'],
                "rang" => $rang['RANG']];
            $this->Recapitulatif->insert($params);
        }
        # Supprimer cette table
        $this->Bulletin->dropTMPNoteTable();

        # Inserer dans la classe verrouillage
        $param = ["CLASSE" => $idclasse, "sequence" => $idsequence];
        $this->Classeverrouillage->insert($param);
    }

    public function synchroniser() {
        $idclasse = $this->request->idclasse;
        $action = $this->request->action;
          $personnel = $this->Personnel->getBy(["USER" => $this->session->iduser]);
        $json = array();
        $view = new View();
        switch ($action) {
            case "emploisdutemps":
                $this->Classe->insertSynchronisationEmplois($idclasse, $personnel['IDPERSONNEL']);
                $ens = $this->Emplois->getEmplois($this->request->idclasse);
                $firebase = new EdisFirestore();
                foreach($ens as $e){
                    $data = array(
                        "color" => null,
                        "fromTime" => substr($e['HEUREDEBUT'], 0, 5),
                        "teacher" => $e['NOM'] . ' ' . $e['PRENOM'],
                        "toTime" => substr($e['HEUREFIN'], 0, 5),
                        "subject" => $e['BULLETIN'],
                        "day" => get_english_jour($e['JOUR']),
                        "classeId" => strval($idclasse)
                    );
                    $firebase->db->collection("timetables")->document(INSTITUTION_CODE)
                            ->collection("classTimetables")->document(strval($e['IDEMPLOIS']))->set($data);
                }
                $view->Assign("enseignements", $ens);
                $horaire = $this->Horaire->selectAll();
                $heure_debut = array();
                foreach ($horaire as $line) {
                     $heure_debut[] = substr(_heure($line["HEUREDEBUT"]), 0, strlen(_heure($line["HEUREDEBUT"])) - 3);
                }
                $synchronisations = $this->Classe->getSynchronisationEmplois($idclasse);
                $nb = $synchronisations == null ? 0 : count($synchronisations);
                $view->Assign("nb_sync_emplois", $nb);
                $view->Assign("horaire", $horaire);
                $view->Assign("heure_debut", json_encode($heure_debut));
                $json[0] = $view->Render("classe" . DS . "ajax" . DS . "onglet3", false);
                break;
            case "manuelscolaires":
                $this->Classe->insertSynchronisationManuel($idclasse, $personnel['IDPERSONNEL']);
                $manuels = $this->Classe->getManuelsScolaires($idclasse);
                $firebase = new EdisFirestore();
                foreach($manuels as $m){
                     $data = array(
                        "authors" => $m['AUTEURS'],
                        "editors" => $m['EDITEURS'],
                        "price" => $m['PRIX'] . "",
                        "title" => addslashes($m['TITRE']),
                        "edition" => $m['EDITION'] . "",
                        "classeId" => strval($idclasse),
                        "subject" => $m['MATIERELIBELLE']
                    );
                    $firebase->db->collection("textbooks")->document(INSTITUTION_CODE)
                        ->collection("classBooks")->document(strval($m['IDMANUELSCOLAIRE']))
                            ->set($data);
                }
                $sync_manuel = $this->Classe->getSynchronisationManuels($idclasse);
                $nb = $sync_manuel == null ? 0 : count($sync_manuel);
                $view->Assign("nb_sync_manuels", $nb);
                $view->Assign("manuels", $manuels);
                $json[0] = $view->Render("classe" . DS . "ajax" . DS . "onglet6", false);
                break;
            }
        echo json_encode($json);
    }

}
