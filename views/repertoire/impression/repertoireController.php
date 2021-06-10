<?php
class repertoireController extends Controller{
    
    public function __construct() {
        parent::__construct();
        $this->loadModel('classe');
    }
    
    public function index(){
        if(!isAuth(206)){
            return;
        }
        $view = new View();
        $this->view->clientsJS("repertoire" . DS . "index");
        
        $rep = $this->Repertoire->selectAll();
        
        $repertoires = new Grid($rep, 1);
        $repertoires->actionbutton = false;
        $repertoires->addcolonne(0, "Civilité", "CIVILITE");
        $repertoires->addcolonne(1, "Nom", "NOM");
        $repertoires->addcolonne(2, "Téléphone", "TELEPHONE");
        $repertoires->addcolonne(3, "Portable", "PORTABLE");
        $repertoires->addcolonne(4, "Email", "EMAIL");
        $repertoires->dataTable = "tableRepertoire";
        
        $view->Assign("total", count($rep));
        $view->Assign("repertoires", $repertoires->display());
        $content = $view->Render("repertoire" . DS . "index", false);
        $this->Assign("content", $content);
    }
    
     public function imprimer() {
        parent::printable();
        $view = new View();
        $view->Assign("pdf", $this->pdf);
        $type = $this->request->type_impression;
        switch ($this->request->code) {
            case "0001":
                $rep = $this->Repertoire->selectAll();
                $view->Assign("repertoires", $rep);
                echo $view->Render("repertoire" . DS . "impression" . DS . "xls" . DS . "toutlerepertoire", false);
                break;
            # Repertoire des parent d'eleves
            case "0002":
                $rep = $this->Repertoire->getParentRepertoire();
                $view->Assign("repertoires", $rep);
                $classes = $this->Classe->selectAll();
                $redoublants = [];
                foreach($classes as $cl){
                    $redoublants[$cl['IDCLASSE']] = $this->Classe->getRedoublants($cl['IDCLASSE'], $this->session->anneeacademique, true);
                }
                $view->Assign("array_of_redoublants", $redoublants);
                if($type == "excel"){
                    echo $view->Render("repertoire" . DS . "impression" . DS . "xls". DS . "repertoireparent", false);
                }else{
                    echo $view->Render("repertoire" . DS . "impression" . DS  . "repertoireparent", false);
                }
                break;
        }
     }
}
