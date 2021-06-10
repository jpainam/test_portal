<?php

class CahiertexteController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->loadModel("classe");
        $this->loadModel("enseignement");
    }

    public function index() {
        if (!isAuth(350)) {
            return;
        }
        $this->view->clientsJS("cahiertexte" . DS . "index");
        $view = new View();
        $classes = $this->Classe->selectAll();
        $view->Assign("classes", $classes);
        $content = $view->Render("cahiertexte" . DS . "index", false);
        $this->Assign("content", $content);
    }

    public function delete($id) {
        $this->Frais->delete($id);
        header("Location:" . Router::url("frais"));
    }

    function saisie() {
        if (!isAuth(545)) {
            return;
        }
        $this->view->clientsJS("frais" . DS . "frais");
        $view = new View();

        $data = $this->Classe->findBy(["ANNEEACADEMIQUE" => $this->session->anneeacademique]);
        $comboClasses = new Combobox($data, "comboClasses", "IDCLASSE", ["LIBELLE", "NIVEAUSELECT"]);
        $comboClasses->first = " ";
        $view->Assign("comboClasses", $comboClasses->view());
        $content = $view->Render("frais" . DS . "saisie", false);
        $this->Assign("content", $content);
    }

    function ajaxindex() {
        if (!isAuth(350)) {
            return;
        }
        $view = new View();
        $json = array();
        $action = $this->request->action;
        switch ($action) {
            case "chargerEnseignement":
                $enseignements = $this->Enseignement->getEnseignements($this->request->idclasse);
                $view->Assign("enseignements", $enseignements);
                $json[0] = $view->Render("cahiertexte" . DS . "ajax" . DS . "comboEnseignement", false);
                break;

            case "ajouter":
                $personnel = $this->getConnectedUser();
                $params = ["CLASSE" => $this->request->idclasse, "DATESAISIE" => parseDate($this->request->datesaisie),
                    "HEUREDEBUT" => $this->request->heuredebut, "HEUREFIN" => $this->request->heurefin,
                    "OBJECTIF" => $this->request->objectif, "CONTENU" => $this->request->contenu,
                    "ENSEIGNEMENT" => $this->request->enseignement, "par" => $personnel['IDPERSONNEL']];
                $this->Cahiertexte->insert($params);
                break;
            case "listercahier":

                break;
            case "supprimer":
                $this->Cahiertexte->delete($this->request->idcahier);
                break;
            case "edit":
                $params = ["CLASSE" => $this->request->idclasse, "DATESAISIE" => parseDate($this->request->datesaisie),
                    "HEUREDEBUT" => $this->request->heuredebut, "HEUREFIN" => $this->request->heurefin,
                    "OBJECTIF" => $this->request->objectif, "CONTENU" => $this->request->contenu,
                    "ENSEIGNEMENT" => $this->request->enseignement, "par" => $personnel['IDPERSONNEL']];
                $this->Cahiertexte->update($params, ["IDCAHIERTEXTE" => $this->request->idcahiertexte]);
                break;
        }
        if ($action == "ajouter" || $action == "listercahier" || $action == "supprimer") {
            $cahier = $this->Cahiertexte->findBy(array("classe" => $this->request->idclasse,
                "enseignement" => $this->request->enseignement));
            $view->Assign("cahier", $cahier);
            $json[0] = $view->Render("cahiertexte" . DS . "ajax" . DS . "cahiertexte", false);
        }
        echo json_encode($json);
    }

    public function imprimer() {
        parent::printable();

        $view = new View();
        $view->Assign("pdf", $this->pdf);
        $action = $this->request->code;
        $type = $this->request->type_impression;
        switch ($action) {
            case "0001":
                 $cahier = $this->Cahiertexte->findBy(array("classe" => $this->request->idclasse,
                "enseignement" => $this->request->enseignement));
                $view->Assign("cahier", $cahier);
                $classe = $this->Classe->get($this->request->idclasse);
                $matiere = $this->Enseignement->get($this->request->enseignement);
                $view->Assign("classe", $classe);
                $view->Assign("matiere", $matiere);
                if ($type == "pdf") {
                    echo $view->Render("cahiertexte" . DS . "impression" . DS . "listecahier", false);
                } else {
                    echo $view->Render("cahiertexte" . DS . "xls" . DS . "listecahier", false);
                }
                break;
        }
    }

    public function synchroniser() {
        $firebase = new EdisFirestore();
        $frais = $this->Frais->findBy(["CLASSE" => $this->request->idclasse]);
        foreach ($frais as $f) {
            $d = new DateFR($f['ECHEANCES']);
            $echeance = $d->getJour(3) . " " . $d->getDate() . "-" . $d->getMois() . "-" . $d->getYear();
            $firebase->db->collection("fees")->document(INSTITUTION_CODE)->collection($this->request->idclasse . "")
                    ->document($f['IDFRAIS'] . "")->set(array("amount" => $f['MONTANT'],
                "description" => $f['DESCRIPTION'],
                "dueDate" => $echeance));
        }
        $json = array();
        $json[0] = true;
        echo json_encode($json);
    }

}
