<?php


class LivreController extends Controller{
    public function __construct() {
        parent::__construct();
    }
    public function index(){
         if (!isAuth(224)) {
            return;
        }
        $view = new View();
        $this->view->clientsJS("livre" . DS . "index");
        $livres = $this->Livre->selectAll();
        $view->Assign("livres", $livres);
        $content = $view->Render("livre" . DS . "index", false);
        $this->Assign("content", $content);
    }
    
    public function saisie(){
        if (!isAuth(539)){
            return;
        }
        if(isset($this->request->titre)){
            $insert_id_publisher = null;
            if(!empty($this->request->publisher)){
                $this->Livre->insert_publisher($this->request->publisher);
                $insert_id_publisher = $this->Livre->lastInsertId();
            }
            $params = array(
                "titre" => $this->request->titre,
                "isbn" => $this->request->isbn,
                "resume" => $this->request->resume,
                "quantite" => $this->request->quantite,
                "publisher" => $insert_id_publisher,
                "edition" => $this->request->edition
            );
            $this->Livre->insert($params);
            $insert_id_livre = $this->Livre->lastInsertId();
            $auteurs = $this->request->auteur;
            foreach($auteurs as $aut){
                #list($nom, $prenom) = explode(" ", $aut);
                $this->Livre->insert_auteur($aut);
                $insert_id_auteur = $this->Livre->lastInsertId();
                $this->Livre->bind_auteur($insert_id_livre, $insert_id_auteur);
            }
            header("Location:" . url('livre'));
        }
        $view = new View();
        $this->view->clientsJS("livre" . DS . "saisie");
        $content = $view->Render("livre" . DS . "saisie", false);
        $this->Assign("content", $content);
    }
}
