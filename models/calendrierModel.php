<?php

class calendrierModel extends Model{
    public function __construct() {
        parent::__construct();
    }
    
    public function getVacances($annneacad){
        $query = "SELECT * FROM vacances WHERE PERIODE = :periode ORDER BY DATEDEBUT";
        return $this->query($query, ["periode" => $annneacad]);
    }
    public function getSequences($anneeacad){
        $sql = "SELECT seq.* "
                . "FROM sequences seq "
                . "INNER JOIN trimestres tr ON tr.IDTRIMESTRE = seq.TRIMESTRE "
                . "WHERE tr.PERIODE = :periode "
                . "ORDER BY seq.ORDRE ASC";
        return $this->query($sql, array("periode" => $anneeacad));
    }
    public function getTrimestres($anneeacad){
        $sql = "SELECT * FROM trimestres WHERE PERIODE = :periode ORDER BY ORDRE ASC";
        return $this->query($sql, ["periode" => $anneeacad]);
    }
    
    public function getPeriode($anneeacad){
        $sql = "SELECT * FROM anneeacademique WHERE ANNEEACADEMIQUE = :periode";
        return $this->row($sql, ["periode" => $anneeacad]);
    }
    
    public function getFeries($anneeacad){
        $sql = "SELECT * FROM feries WHERE PERIODE = :periode";
        return $this->query($sql, ["periode" => $anneeacad]);
    }
    public function getFermetures($anneeacad){
        $sql = "SELECT * FROM fermetures WHERE PERIODE = :periode";
        return $this->query($sql, ["periode" => $anneeacad]);
    }
    
    public function getHoraires($anneeacad){
        $sql = "SELECT * FROM horaires WHERE PERIODE = :periode ORDER BY ORDRE ASC";
        return $this->query($sql, ["periode" => $anneeacad]);
    }
    public function updatePeriode($params){
        $sql = "UPDATE anneeacademique SET anneeacademique = :libelle, datedebut = :datedebut, "
                . "datefin = :datefin, verrouiller = :verrouiller WHERE ANNEEACADEMIQUE = :anneeacad";
        $params['anneeacad'] = $_SESSION['anneeacademique'];
        return $this->query($sql, $params);
    }
    
    public function deleteFerie($idferie){
        $sql = "DELETE FROM feries WHERE IDFERIE = :idferie";
        return $this->query($sql, array("idferie" => $idferie));
    }
    public function insertFerie($dateferie, $libelle){
        $sql = "INSERT INTO feries(LIBELLE, DATEFERIE, PERIODE) VALUES(:libelle, :dateferie, :periode)";
        return $this->query($sql, array("libelle" => $libelle, "dateferie" => $dateferie, "periode" => $_SESSION['anneeacademique']));
    }
    
    public function updateHoraire($params, $idhoraire){
        $sql = "UPDATE horaires SET HEUREDEBUT = :heuredebut, HEUREFIN = :heurefin, LUNDI = :lundi, "
                . "MARDI = :mardi , MERCREDI = :mercredi, JEUDI = :jeudi, VENDREDI = :vendredi, SAMEDI = :samedi "
                . "WHERE IDHORAIRE = :idhoraire";
        $params['idhoraire'] = $idhoraire;
        return $this->query($sql, $params);
    }
    public function updateTrimestre($params, $idtrimestre){
         $sql = "UPDATE trimestres SET libelle = :libelle, datedebut = :datedebut, "
                . "datefin = :datefin WHERE IDTRIMESTRE = :idtrimestre";
        $params['idtrimestre'] = $idtrimestre;
        return $this->query($sql, $params);
    }
    public function updateSequence($params, $idsequence){
         $sql = "UPDATE sequences SET libelle = :libelle, libellehtml = :libellehtml, datedebut = :datedebut, "
                . "datefin = :datefin WHERE IDSEQUENCE = :idsequence";
        $params['idsequence'] = $idsequence;
        return $this->query($sql, $params);
    }
    public function updateVacance($params, $idvacance){
         $sql = "UPDATE vacances SET libelle = :libelle, datedebut = :datedebut, "
                . "datefin = :datefin WHERE IDVACANCE = :idvacance";
        $params['idvacance'] = $idvacance;
        return $this->query($sql, $params);
    }
    
    public function insertHoraire($params){
         $sql = "INSERT INTO horaires(HEUREDEBUT, HEUREFIN, LUNDI, MARDI, MERCREDI, JEUDI, VENDREDI, SAMEDI, ORDRE, PERIODE) "
                . "VALUES (:heuredebut, :heurefin, :lundi, :mardi, :mercredi, :jeudi, :vendredi, :samedi, :ordre, :periode)";
         return $this->query($sql, $params);
    }
    public function insertVacance($params){
          $sql = "INSERT INTO vacances(LIBELLE, DATEDEBUT, DATEFIN, PERIODE) "
                . "VALUES (:libelle, :datedebut, :datefin, :periode)";
         return $this->query($sql, $params);
    }
    public function deleteVacance($idvac){
        return $this->query("DELETE FROM vacances WHERE IDVACANCE = :vac", array("vac" => $idvac));
    }
    public function getExamens($anneeacad){
        $sql = "SELECT e.* FROM examens e WHERE e.PERIODE = :anneeacad";
        return $this->query($sql, array("anneeacad" => $anneeacad));
    }
     public function insertExamen($params){
         $sql = "INSERT INTO examens(DATEDEBUT, DATEFIN, LIBELLE, PERIODE) "
                . "VALUES (:datedebut, :datefin, :libelle, :periode)";
         return $this->query($sql, $params);
    }
    
    public function getClasseForExamen($idexamen){
        $sql = "SELECT cl.*, niv.* "
                . "FROM classes cl "
                . "INNER JOIN niveau niv ON niv.IDNIVEAU = cl.NIVEAU "
                . "INNER JOIN examen_classe ec ON ec.CLASSE = cl.IDCLASSE "
                . "WHERE ec.EXAMEN = :idexam";
        return $this->query($sql, array("idexam" => $idexamen));
    }
    public function insertExamClasse($params){
        $this->query("INSERT INTO examen_classe(EXAMEN, CLASSE) VALUES (:examen, :classe)", $params);
    }
    public function deleteExamen($idexam){
        $this->query("DELETE FROM examens WHERE IDEXAMEN = :idexamen", array("idexamen" => $idexam));
    }
}
