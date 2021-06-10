<?php

class manuelscolaireController extends Controller {

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
        if (!isAuth(245)) {
            return;
        }
        $this->view->clientsJS("manuelscolaire" . DS . "index");
        $view = new View();
        $manuels = $this->Manuelscolaire->selectAll();
        $view->Assign("manuels", $manuels);
        $classes = $this->Classe->selectAll();
        $view->Assign("classes", $classes);
        $content = $view->Render("manuelscolaire" . DS . "index", false);
        $this->Assign("content", $content);
    }

    public function saisie() {
        $this->view->clientsJS("manuelscolaire" . DS . "saisie");
        $view = new View();
        $content = $view->Render("manuelscolaire" . DS . "saisie", false);
        $this->Assign("content", $content);
    }

    public function ajax() {
        $action = $this->request->action;
        $json = array();
        $view = new View();
        switch ($action) {
            case "chargerManuel":
                if(empty($this->request->idclasse)){
                    $manuels = $this->Manuelscolaire->selectAll();
                }else{
                    $manuels = $this->Classe->getManuelsScolaires($this->request->idclasse);
                }
                $enseignements = $this->Enseignement->getEnseignements($this->request->idclasse);
                $view->Assign("manuels", $manuels);
                $json[0] = $view->Render("manuelscolaire" . DS . "ajax" . DS . "index", false);
                $view->Assign("enseignements", $enseignements);
                $json[1] = $view->Render("manuelscolaire" . DS . "ajax" . DS . "listematiere", false);
                break;
            case "ajout":
                $params = array(
                    "titre" => $this->request->titre,
                    "editeurs" => $this->request->editeurs,
                    "auteurs" => $this->request->auteurs,
                    "prix" => $this->request->prix, 
                    "edition" => $this->request->edition, 
                    "enseignement" => $this->request->enseignement,
                    "last_sync" => null);
                $this->Manuelscolaire->insert($params);
                break;
            case "fetch_edit":
                $manuel = $this->Manuelscolaire->get($this->request->idmanuel);
                $json[0] = $manuel['TITRE'];
                $json[1] = $manuel['EDITEURS'];
                $json[2] = $manuel['AUTEURS'];
                $json[3] = $manuel["PRIX"];
                $json[4] = $manuel['EDITION'];
                $matiere = $this->Manuelmatiere->getBy(["manuel" => $this->request->idmanuel]);
                $view->Assign("idmatiere", $matiere['IDMATIERE']);
                $matieres = $this->Enseignement->getEnseignements($matiere['CLASSE']);
                $view->Assign("matieres", $matieres);
                $json[5] = $view->Render("manuelscolaire" . DS . "ajax" . DS . "listematiereedit", false);
                break;
            case "submit_edit":
                $params = array(
                    "titre" => $this->request->titre,
                    "editeurs" => $this->request->editeurs,
                    "auteurs" => $this->request->auteurs,
                    "prix" => $this->request->prix,
                    "edition" => $this->request->edition,
                    "enseignement" => $this->request->enseignement,
                    "last_sync" => null);
                $this->Manuelscolaire->update($params, ["IDMANUELSCOLAIRE" => $this->request->idmanuel]);
               break;
        }
        if($action == "ajout" || $action == "submit_edit"){
            if(empty($this->request->idclasse)){
                 $manuels = $this->Manuelscolaire->selectAll();
            }else{
                $manuels = $this->Classe->getManuelsScolaires($this->request->idclasse);
            }
            $view->Assign("manuels", $manuels);
            $json[0] = $view->Render("manuelscolaire" . DS . "ajax" . DS . "index", false);
        }
        echo json_encode($json);
    }

    public function delete(){
        $idmanuel = $this->request->idmanuel;
        if(!isAuth(244)){
            return;
        }
        $view = new View();
        $json = array();
        $this->Manuelscolaire->delete($idmanuel);
        $this->Donneesupprimee->insert(["IDTABLE" => $idmanuel, "NOMTABLE" => "manuels_scolaires"]);
        if(empty($this->request->idclasse)){
            $manuels = $this->Manuelscolaire->selectAll();
        }else{
            $manuels = $this->Classe->getManuelsScolaires($this->request->idclasse);
        }
        $view->Assign("manuels", $manuels);
        $json[0] = $view->Render("manuelscolaire" . DS . "ajax" . DS . "index", false);
        echo json_encode($json);
    }
    
    public function edit($id) {
        $this->view->clientsJS("manuelscolaire" . DS . "edit");
        if (!empty($this->request->idmanuel)) {
            $this->validateEdit();
        }
        $view = new View();
        $view->Assign("errors", false);
        $manuel = $this->Manuelscolaire->get($id);
        $view->Assign("manuel", $manuel);
        $content = $view->Render("manuelscolaire" . DS . "edit", false);
        $this->Assign("content", $content);
    }

    public function imprimer() {
        parent::printable();
        $action = $this->request->code;
        $type = $this->request->type_impression;
        $view = new View();
        $view->Assign("pdf", $this->pdf);
        switch ($action) {
            case "0001":
                $manuels = $this->Manuelscolaire->selectAll();
                $view->Assign("manuels", $manuels);
                if ($type == "pdf") {
                    echo $view->Render("manuelscolaire" . DS . "impression" . DS . "listemanuelscolaire", false);
                } elseif ($type == "excel") {
                    echo $view->Render("manuelscolaire" . DS . "xls" . DS . "listemanuelscolaire", false);
                }
                break;
        }
    }

}
