<?php

class cahiertexteModel  extends Model{
    protected $_table = "cahier_texte";
    protected $_key = "IDCAHIERTEXTE";
    
    
    public function __construct() {
        parent::__construct();
    }
    public function get($id){
        $sql = "SELECT c.*, cl.* p.* "
                . "FROM cahier_texte c "
                . "INNER JOIN classes cl ON cl.IDCLASSE = c.CLASSE "
                . "LEFT JOIN personnes p ON p.IDPERSONNEL = c.PAR "
                . "WHERE c.IDCAHIERTEXTE = :id";
        return $this->query($sql, array("id" => $id));
    }
    
    public function findBy($conditions = array()) {
        $str = "";
        $params = array();
        foreach ($conditions as $key => $condition) {
            $str .= " $key = :$key AND ";
            $params[$key] = $condition;
        }
        $str = substr($str, 0, strlen($str) - 4);
        $query = "SELECT c.*, cl.*, p.* FROM `" . $this->_table . "` c "
                . " INNER JOIN classes cl ON cl.IDCLASSE = c.CLASSE "
                . "LEFT JOIN personnels p ON p.IDPERSONNEL = c.PAR "
                . " WHERE $str";

        return $this->query($query, $params);
    }
}
