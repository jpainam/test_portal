<?php
/**
 * 511 : Modification des frais
 * 510 : Suppression des frais
 */
class fraisController extends Controller {

    public function __construct() {
        parent::__construct();
        $this->loadModel("classe");
        $this->loadModel("inscription");
    }

    public function index() {
        if (!isAuth(211)) {
            return;
        }
        $this->view->clientsJS("frais" . DS . "index");
        $view = new View();
        $frais = $this->Frais->getFrais($this->session->anneeacademique);
        $grid = new Grid($frais, 0);
        $grid->addcolonne(0, "IDFRAIS", "IDFRAIS", false);
        $grid->addcolonne(1, "Classe", "LIBELLE");
		$grid->addcolonne(2, "Niveau", "NIVEAUHTML");
        $grid->addcolonne(3, "Description", "DESCRIPTION");
        $grid->addcolonne(4, "Montant", "MONTANT");
        $grid->addcolonne(5, "Ech&eacute;ances", "ECHEANCES");
        $grid->dataTable = "fraisTable";

        $grid->actionbutton = true;
        $grid->deletebutton = true;
        $grid->droitdelete = 510;
        $grid->droitedit = 511;
		$grid->setColDate(5);
        $view->Assign("frais", $grid->display());
        $content = $view->Render("frais" . DS . "index", false);
        $this->Assign("content", $content);
    }

    public function delete($id) {
        $this->Frais->delete($id);
        $this->Donneesupprimee->insert(["IDTABLE" => $id, "NOMTABLE" => "frais"]);
        header("Location:" . Router::url("frais"));
    }

    function saisie() {
        if (!isAuth(509)) {
            return;
        }
        $this->view->clientsJS("frais" . DS . "frais");
        $view = new View();

        $data = $this->Classe->findBy(["ANNEEACADEMIQUE" => $this->session->anneeacademique]);
        $comboClasses = new Combobox($data, "comboClasses", "IDCLASSE", ["LIBELLE", "NIVEAUSELECT"]);
        $comboClasses->first = " ";
        $view->Assign("comboClasses", $comboClasses->view());
        $codefrais = $this->Frais->getFraisObligatoireCode();
        $view->Assign("codefrais", $codefrais);
        $content = $view->Render("frais" . DS . "saisie", false);
        $this->Assign("content", $content);
    }

    function ajax($action) {
        $view = new View();
        $json = array();
        switch ($action) {
            case "ajouter":
                $obligatoire = $this->request->obligatoire;
                if(isset($obligatoire) && $obligatoire === "true"){
                     $params = ["description" => $this->request->description, 
                        "classe" => $this->request->idclasse,
                         "codefrais" => $this->request->codefrais,
                        "montant" => $this->request->montant];
                      $this->Frais->insertFraisObligatoire($params);
                }else{
                    $params = ["DESCRIPTION" => $this->request->description, "MONTANT" => $this->request->montant,
                    "ECHEANCES" => parseDate($this->request->echeances), "CLASSE" => $this->request->idclasse];
                    $this->Frais->insert($params);
                }
                break;
            case "supprimer":
                $idfrais = $this->request->idfrais;
                # id for frais obligatoire contiendra le caractere O a la fin de l'id
                if(strpos($idfrais, "O") !== false){
                    $idfrais = substr($idfrais, 0, strlen($idfrais) - 1); # remove the O added at the end of the id frais obligatoire
                    $this->Frais->deleteFraisObligatoire($idfrais);
                }else{
                    $this->Frais->delete($idfrais);
                    $this->Donneesupprimee->insert(["IDTABLE" => $this->request->idfrais, "NOMTABLE" => "frais"]);
                }
                break;
            case "load":
                break;
            case "edit":
                $idfrais = $this->request->idfrais;
                # if the id contains O, then it's frais obligatoires
                 if(strpos($idfrais, "O") !== false){
                    $idfrais = substr($idfrais, 0, strlen($idfrais) - 1); # remove the O added at the end of the id frais obligatoire
                    $params = ["description" => $this->request->description, 
                        "classe" => $this->request->idclasse,
                        "codefrais" => $this->request->codefrais,
                        "montant" => $this->request->montant];
                    $this->Frais->updateFraisObligatoire($params, $idfrais);
                 }else{
                    $params = ["DESCRIPTION" => $this->request->description, "CLASSE" => $this->request->idclasse,
                        "ECHEANCES" => parseDate($this->request->echeances), 
                        "MONTANT" => $this->request->montant, "last_sync" => null];
                    $this->Frais->update($params, ["IDFRAIS" => $idfrais]);
                 }
                break;
        }
        $frais = $this->Frais->findBy(["CLASSE" => $this->request->idclasse]);
        $fraisobligatoires = $this->Frais->getFraisObligatoiresForClasse($this->request->idclasse);
        $view->Assign("frais", $frais);
        $view->Assign("fraisobligatoires", $fraisobligatoires);
        $json[0] = $view->Render("frais" . DS . "ajax" . DS . "frais", false);
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
                $frais = $this->Frais->getFrais($this->session->anneeacademique);
                $view->Assign("frais", $frais);
                if($type == "pdf"){
                    echo $view->Render("frais" . DS . "impression" . DS . "listefrais", false);
                }else{
                    echo $view->Render("frais" . DS . "xls" . DS . "listefrais", false);
                }
                break;
        }
    }
    
    /*public function synchroniser(){
        $firebase = new EdisFirestore();
        $frais = $this->Frais->findBy(["CLASSE" => $this->request->idclasse]);
        foreach($frais as $f){
            $echeance = strtotime($f['ECHEANCES']);
            $firebase->db->collection("fees")->document(INSTITUTION_CODE)->collection("classFees")
                    ->document(strval($f['IDFRAIS']))->set(array("amount" => $f['MONTANT'] . " FCFA", 
                        "description" => $f['DESCRIPTION'], 
                        "classId" => strval($this->request->idclasse),
                        "duedate" => $echeance));
        }
        $json = array();
        $json[0] = true;
        echo json_encode($json);
    }*/

}
