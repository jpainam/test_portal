<?php

class responsableModel extends Model{
    protected  $_table = "responsables";
    protected  $_key = "IDRESPONSABLE";
    
    public function __construct() {
        parent::__construct();
    }
    
     public  function get($id) {
        $query = "SELECT r.*, re.*, p.* "
                . "FROM `" . $this->_table . "` r "
                . "LEFT JOIN responsable_eleve re ON re.IDRESPONSABLE = r.IDRESPONSABLE "
                . "LEFT JOIN parente p ON p.LIBELLE = re.PARENTE "
                . "WHERE r.IDRESPONSABLE = :id";
        return $this->row($query, ["id" => $id]);
    }
    
    public function selectAll() {
        
        $query = "SELECT r.*, CONCAT(NOM, ' ', PRENOM) AS CNOM "
                . "FROM $this->_table r ORDER BY NOM";
        return $this->query($query);
    }
    
    public function getLibelle(){
        return "CNOM";
    }  
    
    /**
     * Liste des eleves dont @param  est responsable
     * @param type $ideleve
     * @return type
     */
     public function getEleves($idresponsable) {
        $query = "SELECT e.*, re.*, cl.*, cl.LIBELLE AS LIBELLECLASSE, niv.* "
                . "FROM eleves e "
                . "LEFT JOIN responsable_eleve re ON re.IDELEVE = e.IDELEVE "
                . "LEFT JOIN inscription i ON i.IDELEVE = e.IDELEVE AND i.ANNEEACADEMIQUE = :anneeacad "
                . "LEFT JOIN classes cl ON cl.IDCLASSE = i.IDCLASSE "
                . "LEFT JOIN niveau niv ON niv.IDNIVEAU = cl.NIVEAU "
                . "WHERE re.IDRESPONSABLE = :idresponsable ";
        return $this->query($query, ["idresponsable" => $idresponsable, "anneeacad" => $_SESSION['anneeacademique']]);
    }
    public function getResponsablesDesInscrits(){
        $sql = "SELECT r.IDRESPONSABLE, r.NUMSMS, r.PORTABLE, re.* "
                . "FROM responsables r "
                . "INNER JOIN responsable_eleve re ON re.IDRESPONSABLE = r.IDRESPONSABLE "
                . "WHERE re.IDELEVE IN (SELECT i.IDELEVE FROM inscription i WHERE i.ANNEEACADEMIQUE = :anneeacad)";
        return $this->query($sql, array("anneeacad" => $_SESSION['anneeacademique']));
    }
}
