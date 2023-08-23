<?php

class emploisController extends Controller {

    private $comboClasses;

    public function __construct() {
        parent::__construct();
        $this->loadModel("classe");
        $this->loadModel("enseignement");
        $this->loadModel("horaire");
        $data = $this->Classe->selectAll();
        $this->comboClasses = new Combobox($data, "comboClasses", $this->Classe->getKey(), ["LIBELLE", "NIVEAUSELECT"]);
    }

    public function index() {
        
    }

    public function saisie() {
        $this->view->clientsJS("emplois" . DS . "saisie");

        $view = new View();

        $this->comboClasses->first = " ";
        $view->Assign("comboClasses", $this->comboClasses->view());
        $horaires = $this->Horaire->findBy(["PERIODE" => $this->session->anneeacademique]);
        $view->Assign("horaires", $horaires);
        $content = $view->Render("emplois" . DS . "saisie", false);
        $this->Assign("content", $content);
    }

    public function ajaxsaisie($action) {
        $json = array();
        $json[0] = "";
        $view = new View();
        $horaire = $this->Horaire->selectAll();
        $heure_debut = array();
        foreach ($horaire as $line) {
            $heure_debut[] = substr(_heure($line["HEUREDEBUT"]), 0, strlen(_heure($line["HEUREDEBUT"])) - 3);
        }
        $view->Assign("horaire", $horaire);
        $view->Assign("heure_debut", json_encode($heure_debut));

        switch ($action) {
            case "charger":
                $enseignements = $this->Enseignement->getEnseignements($this->request->idclasse);
                $view->Assign("enseignements", $enseignements);
                $json[0] = $view->Render("emplois" . DS . "ajax" . DS . "enseignement", FALSE);
                break;
            case "ajout":
                $horaires = $this->Horaire->getHoraireIntervalle($this->request->horairedebut, 
                        $this->request->horairefin, 
                        $this->session->anneeacademique);
                //var_dump($horaires);
                foreach ($horaires as $h) {
                $params = ["jour" => $this->request->jour,
                    "enseignement" => $this->request->enseignement,
                        "horaire" => $h['IDHORAIRE'],
                    "last_sync" => null];
                
                # Inserer dans la BD 
                $this->Emplois->insert($params);
                }
                if (empty($this->request->horairefin)) {
                $params = ["jour" => $this->request->jour,
                    "enseignement" => $this->request->enseignement,
                        "horaire" => $this->request->horairedebut, 
                    "last_sync" => null];

                # Inserer dans la BD 
                $this->Emplois->insert($params);
                }
                break;
            case "supprimer":
                $this->Emplois->delete($this->request->idemplois);
                $this->Donneesupprimee->insert(["IDTABLE" => $this->request->idemplois, "NOMTABLE" => "emplois"]);
                break;
        }
        //dataTable de l'emploi du temps: Onglet 1
        $ens = $this->Emplois->getEmplois($this->request->idclasse);
        $view->Assign("enseignements", $ens);
        $json[1] = $view->Render("emplois" . DS . "ajax" . DS . "emplois", false);
        //apercu de l'emploi du temps: Onglet 2
        $json[2] = $view->Render("emplois" . DS . "ajax" . DS . "apercu", false);
        echo json_encode($json);
    }

    public function imprimer() {
        parent::printable();
        $action = $this->request->code;
        $type = $this->request->type_impression;
        $view = new View();
        $view->Assign("pdf", $this->pdf);
        switch ($action) {
            case "0001":
                # Imprimer l'emploi du temps pour une classe
                $ens = $this->Emplois->getEmplois($this->request->idclasse);
                $view->Assign("enseignements", $ens);
                $classe = $this->Classe->get($this->request->idclasse);
                $view->Assign("classe", $classe);
                $horaires = $this->Horaire->findBy(["PERIODE" => $this->session->anneeacademique]);
                $view->Assign("horaires", $horaires);
                if ($type == "pdf") {
                    echo $view->Render("emplois" . DS . "impression" . DS . "emploisdutemps", false);
                } elseif ($type == "excel") {
                    echo $view->Render("emplois" . DS . "xls" . DS . "emploisdutemps", false);
                }
                break;
        }
    }

}
