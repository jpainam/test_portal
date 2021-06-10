<?php

class systemeController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->loadModel("anneeacademique");
        $this->loadModel("manuelscolaire");
        $this->loadModel("classe");
        $this->loadModel("frais");
        $this->loadModel("sequence");
        $this->loadModel("trimestre");
        $this->loadModel("enseignement");
        $this->loadModel("calendrier");
    }

    public function index() {
        if (!isAuth(750)) {
            return;
        }
        $this->view->clientsJS("systeme" . DS . "creer");
        $view = new View();
        //$params = $this->Systeme->selectAll();
        //$view->Assign("params", $params);
        $content = $view->Render("systeme" . DS . "creer", false);
        $this->Assign("content", $content);
    }

    /*public function ajax() {
        $key = $this->request->key;
        switch ($key) {
            case "sync_realtime":
                if ($this->request->checked == "true") {
                    $this->Systeme->update(["VALEUR" => 1], ["CLE" => SEND_NOTIFICATION_DIRECTLY]);
                } else {
                    $this->Systeme->update(["VALEUR" => 0], ["CLE" => SEND_NOTIFICATION_DIRECTLY]);
                }

                break;
            case "appel_realtime":
                if ($this->request->checked == "true") {
                    $this->Systeme->update(["VALEUR" => 1], ["CLE" => SEND_NOTIFICATION_APPEL_DIRECTLY]);
                } else {
                    $this->Systeme->update(["VALEUR" => 0], ["CLE" => SEND_NOTIFICATION_APPEL_DIRECTLY]);
                }
                break;
            case "caisse_realtime":
                if ($this->request->checked == "true") {
                    $this->Systeme->update(["VALEUR" => 1], ["CLE" => SEND_NOTIFICATION_CAISSE_DIRECTLY]);
                } else {
                    $this->Systeme->update(["VALEUR" => 0], ["CLE" => SEND_NOTIFICATION_CAISSE_DIRECTLY]);
                }
                break;
        }
        echo json_encode(["success" => true]);
    }*/

    /**
     * create a new academic year
     */
    public function creer() {
        $newacad = $this->request->schoolyear;
        if (!empty($newacad)) {
            $ancienn = $this->Anneeacademique->getBy(["ANNEEACADEMIQUE" => $this->session->anneeacademique]);
            $this->Anneeacademique->insert([
                "ANNEEACADEMIQUE" => $newacad,
                "datedebut" => date("Y-m-d", strtotime("+1 year", strtotime($ancienn['DATEDEBUT']))),
                "datefin" => date("Y-m-d", strtotime("+1 year", strtotime($ancienn['DATEFIN']))),
                "verrouiller" => 0,
                "last_sync" => null
            ]);
           
            # Inserer les classes
            $this->insertClasse($newacad);
            # Les trimestres
            $this->insertTrimestre($newacad);
            $this->insertHoraire($newacad);
            $this->insertExamen($newacad);
            $this->insertFerie($newacad);
            $view = new View();
            $json = array();
            $json[0] = true;
            echo json_encode($json);
        }
    }
  
    public function insertFerie($newacad){
        $feries = $this->Calendrier->getFeries($newacad);
        foreach($feries as $f){
            $d = date("Y-m-d", strtotime("+1 year", strtotime($f['DATEFERIE'])));
            $this->Calendrier->insertFerie($d, $f['LIBELLE']);
        }
    }

    private function insertClasse($newacad) {
       
        $classes = $this->Classe->selectAll();
       
        foreach ($classes as $cl) {
            $cycle = $cl['CYCLE'];
            if($cl['CYCLE'] == null || empty($cl['CYCLE'])){
                if($cl['GROUPE'] <= 3){
                    $cycle = 2;
                }else{
                    $cycle = 1;
                }
            }
            $this->Classe->insert(array(
                "LIBELLE" => $cl['LIBELLE'],
                "DECOUPAGE" => $cl['DECOUPAGE'],
                "NIVEAU" => $cl['NIVEAU'],
                "CYCLE" => $cycle,
                "ANNEEACADEMIQUE" => $newacad
            ));
           
            $lastInsertId = $this->Classe->lastInsertId();

            # Inserer les enseignements

            $enseignements = $this->Enseignement->getEnseignements($cl['IDCLASSE']);
            foreach ($enseignements as $ens) {
                $this->Enseignement->insert(["MATIERE" => $ens['MATIERE'],
                    "PROFESSEUR" => $ens['PROFESSEUR'],
                    "CLASSE" => $lastInsertId,
                    "GROUPE" => $ens['GROUPE'],
                    "ORDRE" => $ens['ORDRE'],
                    "COEFF" => $ens['COEFF']]);
                $this->insertManuel($ens['IDENSEIGNEMENT'], $this->Enseignement->lastInsertId());
            }
            # Les frais
            $frais = $this->Frais->getClasseFrais($cl['IDCLASSE']);
            foreach ($frais as $f) {
                $d = new DateTime($f['ECHEANCES']);
                $d->setDate(intval($d->format("Y")) + 1, $d->format("m"), $d->format("d"));

                $this->Frais->insert(array(
                    "CLASSE" => $lastInsertId,
                    "DESCRIPTION" => $f['DESCRIPTION'],
                    "MONTANT" => $f['MONTANT'],
                    "ECHEANCES" => date("Y-m-d", $d->getTimestamp())
                ));
            }
        }
    }
    private function insertManuel($oldensid, $newenseid){
        $manuels = $this->Manuelscolaire->findBy(["ENSEIGNEMENT" => $oldensid]);
        foreach($manuels as $m){
            $this->Manuelscolaire->insert(array(
                "TITRE" => $m['TITRE'],
                "EDITEURS" => $m['EDITEURS'],
                "PRIX" => $m['PRIX'],
                "AUTEURS" => $m['AUTEURS'],
                "EDITION" => $m['EDITION'],
                "ENSEIGNEMENT" => $newenseid,
                "LAST_SYNC" => null,
            ));
        }
    }
    private function insertExamen($newacad){
        $this->loadModel("calendrier");
        $examens = $this->Calendrier->getExamens($newacad);
        foreach($examens as $e){
            $this->Calendrier->insertExamen(["DATEDEBUT" => $e['DATEDEBUT'], 
                "DATEFIN" => $e['DATEFIN'], 
                "LIBELLE" => $e['LIBELLE'], 
                "PERIODE" => $e['PERIODE'], 
                "LAST_SYNC" => null]);
            $examen_id = $this->Calendrier->lastInsertId();
            $exam_class = $this->Calendrier->getClasseForExamen($e['IDEXAMEN']);
            foreach($exam_class as $ec){
                $this->Calendrier->insertExamClasse(["EXAMEN" => $examen_id, "CLASSE" => $ec['CLASSE']]);
            }
        }
    }

    private function insertTrimestre($newacad) {
       
        $trimestre = $this->Trimestre->findBy(["PERIODE" => $this->session->anneeacademique]);

        foreach ($trimestre as $t) {
            $this->Trimestre->insert(array(
                "PERIODE" => $newacad,
                "datedebut" => date("Y-m-d", strtotime("+1 year", strtotime($t['DATEDEBUT']))),
                "datefin" => date("Y-m-d", strtotime("+1 year", strtotime($t['DATEFIN']))),
                "libelle" => $t['LIBELLE'],
                "ordre" => $t['ORDRE'],
                "VERROUILLER" => $t['VERROUILLER']
            ));
            $lastInsertId = $this->Trimestre->lastInsertId();
            $sequence = $this->Sequence->findBy(["trimestre" => $t["IDTRIMESTRE"]]);

            foreach ($sequence as $s) {
                $this->Sequence->insert(array(
                    "TRIMESTRE" => $lastInsertId,
                    "libelle" => $s['LIBELLE'],
                    "LIBELLEHTML" => $s['LIBELLEHTML'],
                    "datedebut" => date("Y-m-d", strtotime("+1 year", strtotime($s['DATEDEBUT']))),
                    "datefin" => date("Y-m-d", strtotime("+1 year", strtotime($s['DATEFIN']))),
                    "ordre" => $s['ORDRE'],
                    "verrouiller" => $s['VERROUILLER']
                ));
            }
        }
    }

    private function insertHoraire($newyear) {
        $this->loadModel("horaire");
        $horaires = $this->Horaire->findBy(['PERIODE' => $this->session->anneeacademique]);
        foreach ($horaires as $h) {
            $this->Horaire->insert(["PERIODE" => $newyear,
                //"DESCRIPTION" => $h['DESCRIPTION'],
                "HEUREDEBUT" => $h['HEUREDEBUT'],
                "HEUREFIN" => $h['HEUREFIN'],
                "ORDRE" => $h['ORDRE'],
                "LUNDI" => $h['LUNDI'],
                "MARDI" => $h['MARDI'],
                "MERCREDI" => $h['MERCREDI'],
                "JEUDI" => $h['JEUDI'],
                "VENDREDI" => $h['VENDREDI'],
                "SAMEDI" => $h['SAMEDI'],
            ]);
        }
    }

    /**
     * Update the current academic year
     */
    public function vider() {
        
    }

}
