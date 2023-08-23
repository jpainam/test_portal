<?php

class horaireModel extends Model {

    protected $_table = "horaires";
    protected $_key = "IDHORAIRE";

    public function __construct() {
        parent::__construct();
    }
    public function selectAll() {
        return $this->query("SELECT * FROM horaires ORDER BY ORDRE ASC");
    }
    /**
     * Selectionner les horaires donc les heuredebut et heurefin sont compris entre 
     * les heure de debut de horairedebut et l heure de fin de horaire fin
     * Entre un horaire de debut et de fin, il renvoit les horaires compris 
     * entre ces deux borne
     * @param type $horairedebut
     * @param type $horairefin
     */
    public function getHoraireIntervalle($horairedebut, $horairefin, $anneeacad = "") {
        $query = "SELECT h.*, a.* "
                . "FROM `" . $this->_table . "` h "
                . "INNER JOIN anneeacademique a ON a.ANNEEACADEMIQUE = h.PERIODE "
                . "WHERE h.HEUREDEBUT >= "
                    . "(SELECT h2.HEUREDEBUT FROM horaires h2 WHERE h2.IDHORAIRE = :horairedebut)"
                . "AND h.HEUREFIN <= "
                    . "(SELECT h3.HEUREFIN FROM horaires h3 WHERE h3.IDHORAIRE = :horairefin) "
                . "AND h.PERIODE = :anneeacad";
        
        return $this->query($query, ["horairedebut" => $horairedebut, 
            "horairefin" => $horairefin, "anneeacad" => $anneeacad]);
    }
     public function findBy($conditions = array()) {
        $str = "";
        $params = array();
        foreach ($conditions as $key => $condition) {
            $str .= " $key = :$key AND ";
            $params[$key] = $condition;
        }
        $str = substr($str, 0, strlen($str) - 4);
        $query = "SELECT * FROM `" . $this->_table . "` xxx WHERE $str "
                . "ORDER BY xxx.ORDRE ASC ";

        return $this->query($query, $params);
    }

}
