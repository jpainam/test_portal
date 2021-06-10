<div class="fiche">
    <fieldset  style="width: 80%;float: none; margin: auto;margin-top: 20px"><legend></legend>
 
        <table cellpadding = "5">
            <tr><td width = "20%" style="font-weight: bold"><?php echo __t("Nom"); ?> : </td><td><?php echo $r['NOM']; ?></td></tr>
            <tr><td style="font-weight: bold"><?php echo __t("Pr&eacute;nom"); ?> : </td><td><?php echo $r['PRENOM']; ?></td></tr>
            <tr><td style="font-weight: bold"><?php echo __t("Civilité"); ?> : </td><td><?php echo $r['CIVILITE']; ?></td></tr>
            <tr><td style="font-weight: bold"><?php echo __t("Lieu de r&eacute;sidence"); ?> : </td><td><?php echo $r['ADRESSE']. ' BP.' . $r['BP'];; ?></td></tr>
            <tr><td style="font-weight: bold"><?php echo __t("Portable"); ?> : </td><td><?php  echo $r['PORTABLE']; ?></td></tr>
            <tr><td style="font-weight: bold"> <?php echo __t("T&eacute;l&eacute;phone"); ?>: </td><td><?php echo $r['TELEPHONE']; ?></td></tr>
            <tr><td style="font-weight: bold"><?php echo __t("Profession"); ?> : </td><td><?php echo __t($r['PROFESSION']); ?></td></tr>
            <tr><td style="font-weight: bold"><?php echo __t("Email"); ?> : </td><td><?php echo $r['EMAIL']; ?></td></tr>
        </table>
    </fieldset>
    <fieldset style="width: 80%;float: none; margin: auto;margin-top: 20px"><legend><?php echo __t("El&egrave;ves"); ?></legend>
       <?php 
    foreach($eleves as $el){
        echo '- '. $el['NOM']. ' '. $el['PRENOM']. ' <br/>'
                . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                . '<b>Lien de parent&eacute; : ' . $el['PARENTE']. '</b><br/>';
        echo  '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'
                . '<b>Classe : ' . $el['NIVEAUHTML']. '</b><br/>';
    }
    ?>
    </fieldset>
</div>
<div style="margin: 10px;text-align: center" id="btn_sync_responsable">
    <input style="width: 350px; border: 2px outset buttonface; margin:0" type="button" 
           value="<?php echo __t("Synchroniser ses données"); ?>" onclick="synchroniserDonnees()"/>
</div>
