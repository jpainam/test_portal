<div id="entete"></div>
<div class="titre"><?php echo __t("Modification du responsable"); ?> <?php echo $resp['CIVILITE']." ".$resp['NOM']." ".$resp['PRENOM']; ?></div>
<form action="<?php echo Router::url("responsable", "edit", $resp['IDRESPONSABLE']); ?>" method="post" >
    <div class="page">
        <fieldset style="float: none; margin: auto;width: 500px;"><legend><?php echo __t("Identit&eacute;"); ?></legend>
            <span class="select" style="width: 50px">
                <label><?php echo __t("Civilit&eacute;"); ?></label><?php echo $comboCivilite; ?>
            </span>
            <span class="text" style="width: 200px">
                <label><?php echo __t("Nom");?></label><input type="text" name="nom" value="<?php echo $resp['NOM']; ?>" />
            </span>
            <span class="text" style="width: 200px">
                <label><?php echo __t("Pr&eacute;nom"); ?></label>
                <input type="text" name="prenom" value="<?php echo $resp['PRENOM']; ?>" />
            </span>
        </fieldset>
        <fieldset style="float: none; margin: auto; width: 500px;"><legend>Coordonn&eacute;es</legend>
            <span class="text" style="width: 200px">
                <label><?php echo __t("Adresse"); ?></label><input type="text" name="adresse" value="<?php echo $resp['ADRESSE']; ?>" />
            </span> 
            <span class="text" style="width: 200px">
                <label><?php echo __t("BP"); ?></label><input type="text" name="bp" value="<?php echo $resp['BP']; ?>" />
            </span>
            <span class="text" style="width: 200px">
                <label><?php echo __t("Portable"); ?></label><input type="text" name="portable" value="<?php echo $resp['PORTABLE']; ?>" />
            </span>
            <span class="text" style="width: 200px">
                <label><?php echo __t("T&eacute;l&eacute;phone"); ?></label>
                <input type="text" name="telephone" value="<?php echo $resp['TELEPHONE']; ?>" />
            </span>
            <span class="text" style="width: 200px">
                <label><?php echo __t("E-mail"); ?></label>
                <input type="text" name="email" value="<?php echo $resp['EMAIL']; ?>" />
            </span>
            <span class="text" style="width: 200px">
                <label><?php echo __t("Profession"); ?></label><input type="text" name="profession" value="<?php echo $resp['PROFESSION']; ?>" />
            </span>
            <span class="text" style="width: 200px">
                <label><?php echo __t("Accepte l'envoi de notification"); ?></label><input type="checkbox" name="acceptesms" 
                    <?php if($resp['ACCEPTESMS'] === 1) echo "checked"; ?> />
            </span>
            <span class="text" style="width: 200px">
                <label><?php echo __t("N° envoi de notification"); ?></label><input type="text" name="numsms" value="<?php echo $resp['NUMSMS']; ?>" />
            </span>
        </fieldset>
    </div>
    <input type="hidden" name="idresponsable" value="<?php echo $resp['IDRESPONSABLE']; ?>" />
    <div class="recapitulatif"></div>
    <div class="navigation">
        <?php echo btn_ok("document.forms[0].submit()"); ?>
    </div>
</form>
<div class="status"></div>