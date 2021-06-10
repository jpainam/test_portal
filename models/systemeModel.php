<?php

class systemeModel extends Model{
    public $_table = "systemes";
    public $_key = "IDSYSTEME";
    public function __construct() {
        parent::__construct();
    }
    
    public function getValue($str){
        $query = "SELECT VALEUR FROM systemes "
                . "WHERE CLE = :key";
        $row = $this->row($query, ["key" => $str]);
        if(!empty($row)){
            return $row['VALEUR'];   
        }
        return null;
    }
    
    public function vider(){
        $acad = $_SESSION['anneeacademique'];
        $this->query("DELETE FROM classes WHERE ANNEEACADEMIQUE = '" . $acad."'");
        $this->query("DELETE FROM caisses WHERE PERIODE = '" . $acad . "'" );
        $this->query("DELETE FROM notifications WHERE ANNEEACADEMIQUE = '" . $acad . "'");
        $this->query("DELETE FROM feries WHERE PERIODE = '" . $acad . "'");
        $this->query("DELETE FROM vacances WHERE PERIODE = '" . $acad . "'");
        $this->query("DELETE FROM punitions WHERE ANNEEACADEMIQUE = '" . $acad . "'");
    }
}
