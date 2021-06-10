<?php

class manuelMatiereModel extends Model{
    protected $_table = "manuels_matieres";
    
    public function __construct() {
        parent::__construct();
    }
     public function getBy($conditions = array()) {
        $str = "";
        $params = array();
        foreach ($conditions as $key => $condition) {
            $str .= " $key = :$key AND ";
            $params[$key] = $condition;
        }
        $str = substr($str, 0, strlen($str) - 4);
        $query = "SELECT t.*, mat.* FROM `" . $this->_table . "` t "
                . "INNER JOIN matieres mat ON mat.IDMATIERE = t.MATIERE "
                . "WHERE $str";
        return $this->row($query, $params);
    }
}
