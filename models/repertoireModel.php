<?php

class repertoireModel extends Model {
    public function __construct() {
        parent::__construct();
    }
    
    /** Obtenir tous les numero de telephone des personnels
     * et des parents de l'etablissement
     */
    public function selectAll(){
        $query = "SELECT '' AS CIVILITE, CONCAT(ID,'-',NOM) AS NOM , CONCAT(TELEPHONE, '/', TELEPHONE2) AS TELEPHONE,"
                . " MOBILE AS PORTABLE, EMAIL FROM locan "
                . "UNION "
                . "SELECT CIVILITE, CONCAT(NOM,' ', PRENOM) AS NOM, TELEPHONE, PORTABLE, EMAIL FROM personnels "
                . "UNION "
                . "SELECT CIVILITE, CONCAT(NOM, ' ', PRENOM) AS NOM, TELEPHONE, PORTABLE, EMAIL FROM responsables ";
        return $this->query($query);
    }
    
    /**
     * Fonction utilisee pour remplir la liste des destinataire lors de la saisie d'un SMS
     */
    public function getDestinataires(){
        $query = "SELECT '' AS CIVILITE, '' AS NUMSMS, CONCAT(ID, '-', NOM) AS NOM, MOBILE AS PORTABLE "
                . "FROM locan "
                . "UNION "
                . "SELECT CIVILITE, '' AS NUMSMS, CONCAT(NOM, ' ', PRENOM) AS NOM, PORTABLE FROM personnels "
                . "UNION "
                . "SELECT CIVILITE, NUMSMS, CONCAT(NOM, ' ', PRENOM) AS NOM, PORTABLE FROM responsables ";
        return $this->query($query);
    }
    
    /**
     * Utiliser dans l'impression excel du repertoire telephonique des 
     * parent d'eleve avc l'eleve en question, inscrit a l'annee encours
     */
    public function getParentRepertoire(){
        $query = "SELECT DISTINCT(r.IDRESPONSABLE), r.*, el.NOM AS NOMEL, el.PRENOM as PRENOMEL, el.RESIDENCE, "
                . "cl.*, re.*, niv.* "
                . "FROM responsables r "
                . "INNER JOIN responsable_eleve re ON re.IDRESPONSABLE = r.IDRESPONSABLE "
                . "INNER JOIN eleves el ON el.IDELEVE = re.IDELEVE "
                . "INNER JOIN inscription i ON i.IDELEVE = el.IDELEVE AND i.ANNEEACADEMIQUE = :anneeacad "
                . "INNER JOIN classes cl ON cl.IDCLASSE = i.IDCLASSE "
                . "INNER JOIN niveau niv ON niv.IDNIVEAU = cl.NIVEAU "
                . "ORDER BY r.NOM";
        return $this->query($query, ['anneeacad' => $_SESSION['anneeacademique']]);
    }
}
