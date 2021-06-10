<?php

class manuelscolaireModel extends Model{
    protected $_key = "IDMANUELSCOLAIRE";
    protected $_table = "manuels_scolaires";
    
    public function __construct() {
        parent::__construct();
    }
    public function selectAll() {
       $query = "SELECT m.*, e.*, mat.LIBELLE AS MATIERELIBELLE, cl.*, niv.* "
                . "FROM manuels_scolaires m "
                . "INNER JOIN enseignements e ON e.IDENSEIGNEMENT = m.ENSEIGNEMENT "
                . "INNER JOIN matieres mat ON mat.IDMATIERE = e.MATIERE "
                . "INNER JOIN classes cl ON cl.IDCLASSE = e.CLASSE "
                . "INNER JOIN niveau niv ON niv.IDNIVEAU = cl.NIVEAU ";
       
        return $this->query($query);
    }
    public function get($idmanuel){
        $query = "SELECT m.*, e.*, mat.LIBELLE AS MATIERELIBELLE "
                . "FROM manuels_scolaires m "
                . "INNER JOIN enseignements e ON e.IDENSEIGNEMENT = m.ENSEIGNEMENT "
                . "INNER JOIN matieres mat ON mat.IDMATIERE = e.MATIERE "
                . "WHERE m.IDMANUELSCOLAIRE = :idmanuel";
        return $this->row($query, ["idmanuel" => $idmanuel]);
    }
    
    public function getManuelAnneeAcademique(){
        $sql = "SELECT m.*, mat.BULLETIN AS MATIERELIBELLE, e.* "
                . "FROM manuels_scolaires m "
                . "INNER JOIN enseignements e ON e.IDENSEIGNEMENT = m.ENSEIGNEMENT "
                . "INNER JOIN matieres mat ON mat.IDMATIERE = e.MATIERE "
                . "INNER JOIN classes cl ON cl.IDCLASSE = e.CLASSE "
                . "WHERE cl.ANNEEACADEMIQUE = :anneeacad";
        return $this->query($sql, array("anneeacad" => $_SESSION['anneeacademique']));
    }
}
