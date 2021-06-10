<?php

class calendrierController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->loadModel("classe");
    }

    public function index() {
        $this->view->clientsJS("calendrier" . DS . "index");
        $view = new View();
        $vacances = $this->Calendrier->getVacances($this->session->anneeacademique);
        $view->Assign("vacances", $vacances);
        $vacanceView = $view->Render("calendrier" . DS . "ajax" . DS . "vacance", false);
        $view->Assign("vacanceView", $vacanceView);

        $sequences = $this->Calendrier->getSequences($this->session->anneeacademique);
        $view->Assign("sequences", $sequences);

        $trimestres = $this->Calendrier->getTrimestres($this->session->anneeacademique);
        $view->Assign("trimestres", $trimestres);

        $anneescolaire = $this->Calendrier->getPeriode($this->session->anneeacademique);
        $view->Assign("anneescolaire", $anneescolaire);

        $feries = $this->Calendrier->getFeries($this->session->anneeacademique);
        $view->Assign("feries", $feries);

        $fermetures = $this->Calendrier->getFermetures($this->session->anneeacademique);
        $view->Assign("fermetures", $fermetures);

        $horaires = $this->Calendrier->getHoraires($this->session->anneeacademique);
        $view->Assign("horaires", $horaires);
        $horairesView = $view->Render("calendrier" . DS . "ajax" . DS . "horaire", false);
        $view->Assign("horairesView", $horairesView);

        $examens = $this->Calendrier->getExamens($this->session->anneeacademique);
        $view->Assign("examens", $examens);

        $examensView = $view->Render("calendrier" . DS . "ajax" . DS . "examen", false);
        $view->Assign("examensView", $examensView);
        $classes = $this->Classe->selectAll();
        $view->Assign("classes", $classes);
        $content = $view->Render("calendrier" . DS . "index", false);
        $this->Assign("content", $content);
    }

    public function ajax() {
        $action = $this->request->actiontype;
        $view = new View();
        $json = array();
        switch ($action) {
            case "periode":
                if(!isAuth(546)){
                   $json[0] = "Impossible de modifier les p&eacute;riodes";
                    return;
                }else{
                    $this->Calendrier->updatePeriode(["libelle" => $this->request->periode,
                        "datedebut" => parseDate($this->request->periodedebut),
                        "datefin" => parseDate($this->request->periodefin),
                        "last_sync" => null,
                        "verrouiller" => 0]);
                    $trimestres = $this->Calendrier->getTrimestres($this->session->anneeacademique);
                    foreach ($trimestres as $t) {
                        $i = $t['IDTRIMESTRE'];
                        $this->Calendrier->updateTrimestre(array(
                            "datedebut" => parseDate($this->request->{'trimestredebut' . $i}),
                            "datefin" => parseDate($this->request->{'trimestrefin' . $i}),
                            "libelle" => parseDate($this->request->{'trimestre' . $i}),
                            "last_sync" => null,
                                ), $t['IDTRIMESTRE']);
                    }
                    $sequences = $this->Calendrier->getSequences($this->session->anneeacademique);
                    foreach ($sequences as $s) {
                        $i = $s['IDSEQUENCE'];
                        $this->Calendrier->updateSequence(array(
                            "datedebut" => parseDate($this->request->{'sequencedebut' . $i}),
                            "datefin" => parseDate($this->request->{'sequencefin' . $i}),
                            "libelle" => parseDate($this->request->{'sequence' . $i}),
                            "libellehtml" => parseDate($this->request->{'sequence' . $i}),
                             "last_sync" => null,
                                ), $s['IDSEQUENCE']);
                    }
                    $json[0] = "P&eacute;riode modifi&eacute;e avec succ&egrave;s";
                }
                break;
            case "fermeture":
                $json[0] = "Fermetures modifi&eacute;e avec succ&egrave;s";
                break;
            case "horaire":
                $horaires = $this->Calendrier->getHoraires($this->session->anneeacademique);
                $ordre = 0;
                foreach ($horaires as $h) {
                    $id = $h['IDHORAIRE'];
                    $this->Calendrier->updateHoraire(array(
                        "heuredebut" => $this->request->{'horairedebut' . $id},
                        "heurefin" => $this->request->{'horairefin' . $id},
                        "lundi" => _checked($this->request->{'lundi' . $id}),
                        "mardi" => _checked($this->request->{'mardi' . $id}),
                        "mercredi" => _checked($this->request->{'mercredi' . $id}),
                        "jeudi" => _checked($this->request->{'jeudi' . $id}),
                        "vendredi" => _checked($this->request->{'vendredi' . $id}),
                        "samedi" => _checked($this->request->{'samedi' . $id})), $h['IDHORAIRE']);
                    $ordre = $h['ORDRE'];
                }
                $ordre = $ordre + 1;
                for ($j = 0; $j < 6; $j++) {
                    if (!empty($this->request->{"xhorairedebut" . $j})) {
                        $this->Calendrier->insertHoraire(array(
                            "heuredebut" => $this->request->{'xhorairedebut' . $id},
                            "heurefin" => $this->request->{'xhorairefin' . $id},
                            "lundi" => _checked($this->request->{'xlundi' . $id}),
                            "mardi" => _checked($this->request->{'xmardi' . $id}),
                            "mercredi" => _checked($this->request->{'xmercredi' . $id}),
                            "jeudi" => _checked($this->request->{'xjeudi' . $id}),
                            "vendredi" => _checked($this->request->{'xvendredi' . $id}),
                            "samedi" => _checked($this->request->{'xsamedi' . $id}),
                            "ordre" => $ordre,
                            "periode" => $this->session->anneeacademique
                        ));
                        $ordre++;
                    }
                }
                $json[0] = "D&eacute;coupage horaire mis &agrave; jour";
                $horaires = $this->Calendrier->getHoraires($this->session->anneeacademique);
                $view->Assign("horaires", $horaires);
                $json[1] = $view->Render("calendrier" . DS . "ajax" . DS . "horaire", false);
                break;
            case "vacance":
                $vacances = $this->Calendrier->getVacances($this->session->anneeacademique);
                if(isAuth(547)){
                    foreach ($vacances as $v) {
                        $i = $v['IDVACANCE'];
                        if (!empty($this->request->{"vacance" . $i})) {
                            $this->Calendrier->updateVacance(array(
                                "libelle" => $this->request->{"vacance" . $i},
                                "datedebut" => parseDate($this->request->{"vacancedebut" . $i}),
                                "datefin" => parseDate($this->request->{"vacancefin" . $i}),
                               "last_sync" => null,
                                    ), $i);
                        } else {
                            $this->Calendrier->deleteVacance($i);
                             $this->Donneesupprimee->insert(["IDTABLE" => $i, "NOMTABLE" => "vacances"]);
                        }
                    }

                    for ($i = 1; $i <= 4; $i++) {
                        if (!empty($this->request->{"vacancex" . $i})) {
                            $this->Calendrier->insertVacance(array(
                                "libelle" => $this->request->{"vacancex" . $i},
                                "datedebut" => parseDate($this->request->{"vacancedebutx" . $i}),
                                "datefin" => parseDate($this->request->{"vacancefinx" . $i}),
                                "periode" => $this->session->anneeacademique,
                                 "last_sync" => null,
                            ));
                        }
                    }
                    $json[0] = "Vacances modifi&eacute;e avec succ&egrave;s";
                }else{
                    $json[0] = "Impossible de modifier les vacances";
                }
                $vacances = $this->Calendrier->getVacances($this->session->anneeacademique);
                $view->Assign("vacances", $vacances);
                $json[1] = $view->Render("calendrier" . DS . "ajax" . DS . "vacance", false);
                break;
        }
        echo json_encode($json);
    }

    public function ajaxferie() {
        $action = $this->request->actiontype;
        $view = new View();
        $json = array();
        switch ($action) {
            case "deleteferie":
                if(isAuth(548)){
                    $this->Calendrier->deleteFerie($this->request->idferie);
                    $this->Donneesupprimee->insert(["IDTABLE" => $this->request->idferie, "NOMTABLE" => "feries"]);
                    $json[0] = "Jour f&eacute;ri&eacute; suprim&eacute; avec succ&egrave;s";
                }else{
                    $json[0] = "Impossible de supprimer ce jour f&eacute;ri&eacute;";
                }
                break;
            case "ajouterFerie":
                if(isAuth(549)){
                    $this->Calendrier->insertFerie(parseDate($this->request->dateferie), $this->request->libelle);
                    $json[0] = "Jour f&eacute;ri&eacute; ajout&eacute; avec succ&egrave;s";
                }else{
                    $json[0] = "Impossible d'ajouter un jour f&eacute;ri&eacute;";
                }
                break;
        }
        $feries = $this->Calendrier->getFeries($this->session->anneeacademique);
        $view->Assign("feries", $feries);
        $json[1] = $view->Render("calendrier" . DS . "ajax" . DS . "ferie", false);
        echo json_encode($json);
    }

    public function ajaxexamen() {
        $view = new View();
        $json = array();
        $action = $this->request->action;
        switch ($action) {
            case "afficher":
                $json[0] = "";
                break;
            case "delete":
                if(isAuth(551)){
                    $idexamen = $this->request->idexamen;
                    $this->Calendrier->deleteExamen($this->request->idexamen);
                     $this->Donneesupprimee->insert(["IDTABLE" => $idexamen, "NOMTABLE" => "examens"]);
                }else{
                     $json[0] = "Impossible de supprimer cet examen";
                }
                break;
            case "ajouter":
                if(isAuth(550)){
                    $datedebut = parseDate($this->request->examendebut);
                    $datefin = parseDate($this->request->examenfin);
                    $libelle = $this->request->examen;
                    $this->Calendrier->insertExamen(array(
                        "datedebut" => $datedebut,
                        "datefin" => $datefin,
                        "libelle" => $libelle,
                        "last_sync" => null,
                        "periode" => $this->session->anneeacademique));
                    $idexamen = $this->Calendrier->lastInsertId();
                    $classes = $_POST['classes'];
                    if (!empty($classes)) {
                        foreach ($classes as $cl) {
                            $this->Calendrier->insertExamClasse(array(
                                "classe" => $cl,
                                "examen" => $idexamen));
                        }
                    }
                    $json[0] = "Examen mis &agrave; jour";
                }else{
                    $json[0] = "Impossible d'ajouter un examen";
                }
                $examens = $this->Calendrier->getExamens($this->session->anneeacademique);
                $view->Assign("examens", $examens);
                $json[1] = $view->Render("calendrier" . DS . "ajax" . DS . "examen", false);
                break;
        }
        if ($action != "ajouter") {
            $idexamen = $this->request->idexamen;
            $classes = $this->Calendrier->getClasseForExamen($idexamen);
            $view->Assign("classes", $classes);
            $examens = $this->Calendrier->getExamens($this->session->anneeacademique);
            $view->Assign("examens", $examens);
            $json[1] = $view->Render("calendrier" . DS . "ajax" . DS . "examen", false);
        }
        echo json_encode($json);
    }

}
