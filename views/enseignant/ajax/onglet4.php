<style>
    .apercu-emplois{
        border-collapse: collapse;
        border: 1px solid #000;
        margin: auto;
        width: 100%;
    }
    .apercu-emplois th{
        
    }
    .apercu-emplois tbody td{
        border: 1px solid #000;
        width: 150px;
        height: 60px; 
        padding: 2px 6px 6px 0.5px;
        max-width: 150px;
        max-height: 60px;
        overflow: hidden;
    }
    .apercu-emplois tbody td:first-child {
        border: 1px solid #000;
        width: 45px;
        height: 60px; 
        padding: 0;
        max-width: 45px;
        max-height: 60px;
        overflow: hidden;
    }
    .heu{
        width: 100%;
        height: 100%;
        display: block;
        font-size: 13px;
        font-weight: bold;
        padding-left: 5px;
    }
    .heu .el1{
        top: 2px;
        position: relative;
        display: inline-block;
        left: 1px;
    }
    .heu .el2{
        position: relative;
        left: 1px;
        display: inline-block;
        top: 32px;
    }
    
    .heu label sup{
    
        position: relative;
        top: 3px;
    }
    
    .mat{
        position: relative;
        width: 100%;
        height: 100%;
        display: block;
        font-size: 12px;
        box-shadow: 3px 3px 0px #aaa; 
    }
    .mat .el1{
        background-color: #8B4513;
        display: inline-block;
        text-align: center;
        vertical-align: top;
        width: 100%;
        position: relative;
        font-weight: bold;
        color: white;
    }  
    .mat .el2{
        background-color: #AAAAAA;
        display: inline-block;
        text-align: center;
        position: relative;
        top: 8%;
        width: 100%;

    }
    
    .mat .el3{
        background-color: greenyellow;
        display: inline-block;
        text-align: center;
        position: relative;
        bottom: 0;
        width: 100%;
    }
</style>
<?php 
function _spanHeure($heure){
    $hs = explode("h", $heure);
    return $hs[0] . "<sup>".$hs[1] ."</sup>";
}
function __getEnseignements($jour, $horaire_id, $enseignements){
    foreach($enseignements as $e){
        if($e['IDHORAIRE'] === $horaire_id && $e['JOUR'] === $jour){
            return $e;
        }
    }
    return null;
}
$array_fusionner = array();
function __getDuree($jour, $idenseignement, $nexthoraireordre, &$enseignements, &$array_fusionner){
    $duree = 0;
    $previousordre = $nexthoraireordre - 1;
    $i = 0;
    foreach($enseignements as $e){
        if($e['JOUR'] === $jour && $e['ORDRE'] === $nexthoraireordre && $e['ENSEIGNEMENT'] === $idenseignement){
            if($nexthoraireordre === $previousordre + 1){
                $duree++;
                $array_fusionner[] = $e;
                $previousordre = $nexthoraireordre;
            }
            $nexthoraireordre++;
            //unset($enseignements[$i]);
        }
        $i++;
    }
    return $duree;
}
function isFusionner($ens, $array_fusionner){
    foreach($array_fusionner as $f){
        if($f['IDEMPLOIS'] === $ens['IDEMPLOIS']){
            return true;
        }
    }
    return false;
}
?>
<table class="apercu-emplois">
    <thead><th></th><th><?php echo __t("Lundi"); ?></th><th><?php echo __t("Mardi"); ?></th><th><?php echo __t("Mercredi"); ?></th>
    <th><?php echo __t("Jeudi"); ?></th><th><?php echo __t("Vendredi"); ?></th><th><?php echo __t("Samedi"); ?></th></thead>
<tbody id="table_corp">
    <?php
    
    foreach($horaire as $h) {
        echo "<tr><td>";
        echo "<span class='heu'><label class='el1'>" .  _spanHeure($h['HEUREDEBUT']) ."</label>";
        echo "<label class='el2'>" . _spanHeure($h['HEUREFIN'])."</label></span></td>";
        for($jour = 1; $jour <= 6; $jour++){
            $ens = __getEnseignements($jour, $h['IDHORAIRE'], $enseignements);
            if(!isFusionner($ens, $array_fusionner)){
                if($ens != null){
                    $duree = __getDuree($jour, $ens['ENSEIGNEMENT'], $h['ORDRE'], $enseignements, $array_fusionner);
                    // duree sera utiliser pour fusionner les lignes,
                    echo "<td rowspan='".$duree."'><span class='mat'><label class='el1'>". $ens['BULLETIN']. "</label>";
                    echo "<label class='el2'>" . $ens['CIVILITE']. ' '. $ens['NOM'] . '<br/>' . $ens['PRENOM'] . '</br>' . $ens['NIVEAUHTML']. "</label></span></td>";
                }else{
                    echo "<td></td>";
                }
            }
        }
        
        echo "</tr>";
        
    }
    ?>
</tbody>
</table>