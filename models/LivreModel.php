<?php


class LivreModel extends Model{
    protected $_table = "bi_livre";
    protected $_key = "IDLIVRE";
    public function __construct() {
        parent::__construct();
    }
    public function selectAll() {
        $q = "SELECT l.*, p.LIBELLE AS PUBLISHERLIBELLE "
                . "FROM bi_livre l "
                . "LEFT JOIN bi_publisher p ON p.IDPUBLISHER = l.PUBLISHER "
                . "ORDER BY l.TITRE";
        return $this->query($q);
    }
    public function insert_auteur($nom, $prenom = ""){
        $q = "INSERT INTO bi_auteur(NOM, PRENOM) VALUES(:nom, :prenom)";
        return $this->query($q, array(
            "nom" => $nom,
            "prenom" => $prenom
        ));
    }
    public function bind_auteur($idlivre, $idauteur){
        $q = "INSERT INTO bi_livre_auteur VALUES(:livre, :auteur)";
        return $this->query($q, array("livre" => $idlivre, "auteur" => $idauteur));
    }
    public function insert_publisher($publisher_libelle){
        $q = "INSERT INTO bi_publisher(LIBELLE) VALUES(:libelle)";
        return $this->query($q, array("libelle" => $publisher_libelle));
    }
}
