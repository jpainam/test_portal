<?php
/**
 * Liste des droits 1000
 */
class BibliothequeController extends Controller{
   public function __construct() {
       parent::__construct();
   }
   
   /**
    * Affiche les informations de la bibliotheque
    * Liste des emprunts,
    * Emprunt en cours
    * Emprunt retournee
    * Emprunts expiree
    */
   public function index(){
       if (!isAuth(223)) {
            return;
        }
        $this->view->clientsJS("bibliotheque" . DS . "index");
        $view = new View();
        $emprunts = $this->Emprunt->selectAll();
        
        $content = $view->Render("bibliotheque" . DS . "index", false);
        $this->Assign("content", $content); 
   }
   
}
