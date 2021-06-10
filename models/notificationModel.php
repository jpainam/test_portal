<?php

class notificationModel extends Model {
    protected $_table = "notifications";
    protected $_key = "IDNOTIFICATION";
    public function __construct() {
        parent::__construct();
    }
     public function selectAll() {
        $query = "SELECT m.*, p.* "
                . "FROM `" . $this->_table . "` m "
                . "LEFT JOIN personnels p ON p.IDPERSONNEL = m.EXPEDITEUR "
                . "ORDER BY m.DATEENVOI DESC";
        return $this->query($query);
    }

    /**
     * Obtenir les message envoyee a ce destinataire
     * @param type $destinataire
     * @param type $datedebut
     * @param type $datefin
     */
    public function getMessagesBy($destinataire, $datedebut = "", $datefin = "") {
        $query = "SELECT m.*, p.* "
                . "FROM `" . $this->_table . "` m "
                . "LEFT JOIN personnels p ON p.IDPERSONNEL = m.EXPEDITEUR "
                . "WHERE m.DESTINATAIRE = :destinataire "
                . "AND DATEENVOI BETWEEN :datedebut AND :datefin "
                . "ORDER BY m.DATEENVOI DESC";
        return $this->query($query, ["destinataire" => $destinataire, "datedebut" => $datedebut,
                    "datefin" => $datefin]);
    }

    public function findBy($conditions = array()) {
        $str = "";
        $params = array();
        foreach ($conditions as $key => $condition) {
            $str .= " $key = :$key AND ";
            $params[$key] = $condition;
        }
        $str = substr($str, 0, strlen($str) - 4);

        $query = "SELECT m.*, p.* "
                . "FROM `" . $this->_table . "` m "
                . "LEFT JOIN personnels p ON p.IDPERSONNEL = m.EXPEDITEUR "
                . "WHERE $str "
                . "ORDER BY m.DATEENVOI DESC";
        return $this->query($query, $params);
    }
}
