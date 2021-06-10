<?php

class bulletinController extends Controller {

    private $comboClasses;
    private $comboPeriodes;

    public function __construct() {
        parent::__construct();
        $this->loadModel("sequence");
        $this->loadModel("trimestre");
        $this->loadModel("classe");
        $this->loadModel("anneeacademique");
        $this->loadModel("inscription");
        $this->loadModel("eleve");
        $this->loadModel("enseignement");
        $this->loadModel("note");
        $this->loadModel("recapitulatif");
        $this->loadModel("notificationbulletin");
        $this->loadModel("messagetype");
        $this->loadModel("absenceperiodique");
        $this->loadJPGraph();

        $classes = $this->Classe->selectAll();
        $this->comboClasses = new Combobox($classes, "comboClasses", $this->Classe->getKey(), ['NIVEAUSELECT', 'LIBELLE']);

        $periodes = $this->Anneeacademique->getPeriodes($this->session->anneeacademique);
        $this->comboPeriodes = new Combobox($periodes, "comboPeriodes", "IDPERIODE", "LIBELLE");
    }

    public function index() {
        
    }

    public function imprimer() {
        parent::printable();

        switch ($this->request->code) {
            case "0001":
                $this->bulletin();
                break;
            case "0002":
                $this->annuelle();
                break;
            case "0003":
                break;
        }
    }

    public function trimestre(&$view, $idclasse, $idperiode) {
        $trimestre = $this->Trimestre->get($idperiode);
        $view->Assign("trimestre", $trimestre);

        # Precedentes moyennes des trimestres
        $trimestres = $this->Trimestre->getPreviousTrimestres($idperiode);
        $recapitulatifs = array();
        foreach ($trimestres as $tr) {
            # Obtenir les sequence du trimestre
            $sequences = $this->Sequence->findBy(['TRIMESTRE' => $tr['IDTRIMESTRE']]);
            $array_of_sequences = [$sequences[0]['IDSEQUENCE'], $sequences[1]['IDSEQUENCE']];
            $this->Bulletin->createTrimestreTable($idclasse, $array_of_sequences);
            $rangs = $this->Bulletin->getElevesRang();
            if (!empty($this->request->comboEleves)) {
                $rangs = getRangEleve($this->request->comboEleves, $rangs);
                $recapitulatifs[] = $rangs;
            } else {
                $recapitulatifs = array_merge($recapitulatifs, $rangs);
            }
        }

        # Obtenir les sequence du trimestre
        $sequences = $this->Sequence->findBy(['TRIMESTRE' => $idperiode]);
        $view->Assign("sequences", $sequences);
        $array_of_sequences = [$sequences[0]['IDSEQUENCE'], $sequences[1]['IDSEQUENCE']];

        # Obtenir les moyennes sequentielle du trimestre
        $this->Bulletin->createTMPNoteTable($idclasse, $array_of_sequences[0]);
        $sequence1 = $this->Bulletin->getElevesRang();
        $this->Bulletin->createTMPNoteTable($idclasse, $array_of_sequences[1]);
        $sequence2 = $this->Bulletin->getElevesRang();
        $view->Assign("sequence1", $sequence1);
        $view->Assign("sequence2", $sequence2);

        # Obtenir les absences de la sequence
        $absence1 = $this->Absenceperiodique->getAbsencesPeriodique($idclasse, $array_of_sequences[0]);
        $absence2 = $this->Absenceperiodique->getAbsencesPeriodique($idclasse, $array_of_sequences[1]);
        $view->Assign("absence1", $absence1);
        $view->Assign("absence2", $absence2);

        $this->Bulletin->createTrimestreTable($idclasse, $array_of_sequences);
        $view->Assign("recapitulatifs", is_null($recapitulatifs) ? array() : $recapitulatifs);
        $rangs = $this->Bulletin->getElevesRang();
        if ($this->session->anneeacademique !== FIRST_ACADEMIQUE_YEAR) {
            $moyclasse = $moymax = $moymin = 0;
            setmoyrangtrimestriel($rangs, $sequence1, $sequence2, $moyclasse, $moymax, $moymin);
            $view->Assign("moyclasse", $moyclasse);
            $view->Assign("moymax", $moymax);
            $view->Assign("moymin", $moymin);
        }
        return $rangs;
    }

    public function sequence(&$view, $idperiode, $idclasse) {
        $sequence = $this->Sequence->get($idperiode);
        $view->Assign("sequence", $sequence);
        # Obtenir les sequences inferieur a la sequence encours
        $sequences = $this->Sequence->getPreviousSequences($idperiode);
        $recapitulatifs = array();
        foreach ($sequences as $seq) {
            $this->Bulletin->createTMPNoteTable($idclasse, $seq['IDSEQUENCE']);
            $rangs = $this->Bulletin->getElevesRang();
            if (!empty($this->request->comboEleves)) {
                $rangs = getRangEleve($this->request->comboEleves, $rangs);
                $recapitulatifs[] = $rangs;
            } else {
                $recapitulatifs = array_merge($recapitulatifs, $rangs);
            }
        }

        # Precedentes moyennes
        if (!empty($this->request->comboEleves)) {
            $ideleve = $this->request->comboEleves;
            #$recapitulatifs = $this->Recapitulatif->getRecapitulatifs($idclasse, $idperiode, $ideleve);
            $discipline = $this->Absenceperiodique->getAbsencesPeriodiqueByELeve($idclasse, $idperiode, $ideleve);
        } else {
            //$recapitulatifs = $this->Recapitulatif->getRecapitulatifs($idclasse, $idperiode);
            # Discripline des eleves de cette classe 
            $discipline = $this->Absenceperiodique->getAbsencesPeriodique($idclasse, $sequence['IDSEQUENCE']);
        }
        $view->Assign("recapitulatifs", is_null($recapitulatifs) ? array() : $recapitulatifs);
        $this->Bulletin->createTMPNoteTable($idclasse, $idperiode);
        $view->Assign("discipline", $discipline);
        return $this->Bulletin->getElevesRang();
    }

    /**
     * Bulletin sequentielle
     */
    public function bulletin() {
        $view = new View();
        $view->Assign("pdf", $this->pdf);

        # Permettant de savoir si c'est un bulletin sequentielle ou trimestrielle
        # S = Sequentielle, T = Trimestrielle, A pour annuelle
        $periode = $this->request->comboPeriodes;
        $codeperiode = substr($periode, 0, 1);
        $view->Assign("codeperiode", $codeperiode);

        # Information generale sur la classe
        $idclasse = $this->request->comboClasses;
        $array_of_redoublant = $this->Classe->getRedoublants($idclasse, $this->session->anneeacademique, true);
        $view->Assign("array_of_redoublants", $array_of_redoublant);

        $classe = $this->Classe->get($idclasse);
        $view->Assign("classe", $classe);

        $inscrits = $this->Inscription->getInscrits($idclasse);
        $view->Assign("eleves", $inscrits);

        # Recuperer l'id de la periode
        $libelle = "";
        $idperiode = substr($periode, strpos($periode, "_") + 1, strlen($periode));
        if ($codeperiode === "S") {
            $sequence = $this->Sequence->get($idperiode);
            $libelle = "Sequence " . $sequence['SEQUENCEORDRE'];
            $rangs = $this->sequence($view, $idperiode, $idclasse);
        } elseif ($codeperiode === "T") {
            $trimestre = $this->Trimestre->get($idperiode);
            $libelle = trim("Trimestre " . $trimestre['ORDRE']);
            $rangs = $this->trimestre($view, $idclasse, $idperiode);
        }

        $notes = array();
        # Ajouter les notes par matiere, cette variable contient aussi les notes des eleves
        $enseignements = $this->Enseignement->getEnseignements($idclasse);
        $view->Assign("enseignements", $enseignements);
        //$this->Bulletin->dropTMPTableForSync();
        foreach ($enseignements as $ens) {
            $new_notes = $this->Bulletin->getNotesByEnseignements($ens['IDENSEIGNEMENT']);
            $notes = array_merge($notes, $new_notes);
            //$this->Bulletin->keepTMPTableForSync($new_notes, $libelle, $classe["SECTION"], $this->request->comboEleves);
        }

        if (!empty($this->request->comboEleves)) {
            $prev = 0;
            $rang = getRangEleve($this->request->comboEleves, $rangs, $prev);
            $view->Assign("rang", $rang);
            $view->Assign("prev", $prev);
        }
       
        $view->Assign("rangs", $rangs);
        $view->Assign("effectif", count($rangs));
        $view->Assign("notes", $notes);
        $travail = $this->Bulletin->getGlobalMoyenne();
        $success_rate = $this->getSuccessRate($rangs);
        $travail['SUCCESSRATE'] = $success_rate;
        //$this->Bulletin->keepTMPRecapForSync($rangs, $libelle, $classe["SECTION"], $this->request->comboEleves);
        $view->Assign("travail", $travail);
        

        $this->Bulletin->dropTMPTable();
        # Definir l'interval d'impression
        $view->Assign("debutinterval", $this->request->debutinterval);
        $view->Assign("fininterval", $this->request->fininterval);
        if (!empty($this->request->comboEleves)) {
            if($classe['SECTION'] === "ANG"){
                echo $view->Render("bulletin" . DS . "impression" . DS . "individuelleANG", false);
            }else{
                echo $view->Render("bulletin" . DS . "impression" . DS . "individuelle", false);
            }
        } else {
            if($classe['SECTION'] === "ANG"){
                echo $view->Render("bulletin" . DS . "impression" . DS . "bulletinANG", false);
            }else{
                 echo $view->Render("bulletin" . DS . "impression" . DS . "bulletin", false);
            }
        }
    }
    public function getSuccessRate($rangs){
        $nb = 0;
        foreach($rangs as $r){
            if(floatval($r['MOYGENERALE']) >= 10.0){
                $nb++;
            }
        }
        if(count($rangs) > 0){
            return ($nb / count($rangs)) * 100;
        }
        return 0;
    }

    public function annuelle() {
        $view = new View();
        $view->Assign("pdf", $this->pdf);
        $idclasse = $this->request->comboClasses;
        # Information generale sur la classe
        $array_of_redoublant = $this->Classe->getRedoublants($idclasse, $this->session->anneeacademique, true);
        $view->Assign("array_of_redoublants", $array_of_redoublant);

        $codeperiode = substr($this->request->comboPeriodes, 0, 1);
        $view->Assign("codeperiode", $codeperiode);

        $classe = $this->Classe->get($idclasse);
        $view->Assign("classe", $classe);

        $inscrits = $this->Inscription->getInscrits($idclasse);
        $view->Assign("effectif", count($inscrits));
        $view->Assign("eleves", $inscrits);
        $sequences = $this->Sequence->getIdSequences($_SESSION['anneeacademique']);
        # Obtenir les moyennes sequentielles
        $this->Bulletin->createMoySequentielTable();
        foreach ($sequences as $seq) {
            $this->getMoyRangSequentiel($idclasse, $seq);
        }
        $rangsequentiels = $this->Bulletin->getRangMoyenneSequences($sequences);
        $this->Bulletin->dropMoySequentielTable();

        $this->Bulletin->createAnnuelleTable($idclasse, $sequences);
        $notes = array();
        # Ajouter les notes par matiere, cette variable contient aussi les notes des eleves
        $enseignements = $this->Enseignement->getEnseignements($idclasse);
        $view->Assign("enseignements", $enseignements);
        //$this->Bulletin->dropTMPTableForSync();
        foreach ($enseignements as $ens) {
            $new_notes = $this->Bulletin->getNotesByEnseignements($ens['IDENSEIGNEMENT']);
            $notes = array_merge($notes, $new_notes);
            //$this->Bulletin->keepTMPTableForSync($new_notes, "Annuelle", $classe["SECTION"], $this->request->comboEleves);
        }
        $view->Assign("notes", $notes);
        $rangs = $this->Bulletin->getElevesRangAnnuel();
        $moyclasse = $moymax = $moymin = 0;
        setrangannuel($rangs, $rangsequentiels, $moyclasse, $moymax, $moymin);
        if (!empty($this->request->comboEleves)) {
            $prev = 0;
            $rang = getRangEleve($this->request->comboEleves, $rangs, $prev);
            $view->Assign("rang", $rang);
            $view->Assign("prev", $prev);
            $discipline = $this->Absenceperiodique->getAbsenceAnnuelleByEleve($classe['IDCLASSE'], $_SESSION['anneeacademique'], $this->request->comboEleves);
        } else {
            $discipline = $this->Absenceperiodique->getAbsenceAnnuelle($classe['IDCLASSE'], $_SESSION['anneeacademique']);
            $view->Assign("rangs", $rangs);
        }
        //$this->Bulletin->keepTMPRecapForSync($rangs, "Annuelle", $classe["SECTION"], $this->request->comboEleves);
        $view->Assign("moyclasse", $moyclasse);
        $view->Assign("moymin", $moymin);
        $view->Assign("moymax", $moymax);
        $view->Assign("recapitulatifs", $rangsequentiels);
        $view->Assign("discipline", $discipline);
        $success_rate = $this->getSuccessRate($rangs);
        $view->Assign("success_rate", $success_rate);

        # Definir un interval d'impression
        $view->Assign("debutinterval", $this->request->debutinterval);
        $view->Assign("fininterval", $this->request->fininterval);

        if (!empty($this->request->comboEleves)) {
            if($classe['SECTION'] === "ANG"){
                echo $view->Render("bulletin" . DS . "impression" . DS . "individuelleANG", false);
            }else{
                echo $view->Render("bulletin" . DS . "impression" . DS . "individuelle", false);
            }
        } else {
            if($classe['SECTION'] === "ANG"){
                echo $view->Render("bulletin" . DS . "impression" . DS . "bulletinANG", false);
            }else{
                 echo $view->Render("bulletin" . DS . "impression" . DS . "bulletin", false);
            }
        }
    }

    public function getMoyRangSequentiel($idclasse, $idsequence) {
        $this->Bulletin->createTMPNoteTable($idclasse, $idsequence);
        # Obtenir le rang des eleves
        $rangs = $this->Bulletin->getElevesRang();
        foreach ($rangs as $rang) {
            $params = ["eleve" => $rang['IDELEVE'],
                "moyenne" => sprintf("%.2f", $rang['MOYGENERALE']),
                "rang" => $rang['RANG'],
                "sequence" => $idsequence];
            $this->Bulletin->insertIntoMoySequentiel($params);
        }
    }

    public function impression() {

        if (!empty($this->request->comboClasses)) {
            $this->imprimer();
        }
        $view = new View();
        $this->view->clientsJS("bulletin" . DS . "impression");
        $this->comboClasses->first = " ";
        $this->comboPeriodes->first = " ";
        $view->Assign("comboClasses", $this->comboClasses->view());
        $view->Assign("comboPeriodes", $this->comboPeriodes->view());

        $content = $view->Render("bulletin" . DS . "impression", false);
        $this->Assign("content", $content);
    }

    public function ajaximpression() {
        $view = new View();
        $json = array();

        $action = $this->request->action;
        switch ($action) {
            case "chargerEleves":
                $eleves = $this->Inscription->getInscrits($this->request->idclasse);
                $view->Assign("eleves", $eleves);
                $json[0] = $view->Render("bulletin" . DS . "ajax" . DS . "comboEleves", false);
                $json[1] = $view->Render("bulletin" . DS . "ajax" . DS . "comboInterval", false);
                break;
        }

        echo json_encode($json);
    }

}
