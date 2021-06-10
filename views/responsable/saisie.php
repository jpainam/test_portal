<div id="entete"></div>
<div class="titre"><?php echo __t("Ajout d'un responsable"); ?></div>
<form action="<?php echo Router::url("responsable", "saisie") ?>" method="post" >
    <div class="page">
        <fieldset style="float: none; margin: auto;width: 500px;"><legend><?php echo __t("Identit&eacute;"); ?></legend>
            <span class="select" style="width: 50px">
                <label><?php echo __t("Civilit&eacute;"); ?></label><?php echo $comboCivilite; ?>
            </span>
            <span class="text" style="width: 200px">
                <label><?php echo __t("Nom"); ?></label><input type="text" name="nom" />
            </span>
            <span class="text" style="width: 200px">
                <label><?php echo __t("Pr&eacute;nom"); ?></label><input type="text" name="prenom" />
            </span>
        </fieldset>
        <fieldset style="float: none; margin: auto; width: 500px;"><legend><?php echo __t("Coordonn&eacute;es"); ?></legend>
            <span class="text" style="width: 200px">
                <label><?php echo __t("Adresse"); ?></label><input type="text" name="adresse" />
            </span> 
            <span class="text" style="width: 200px">
                <label><?php echo __t("BP"); ?></label><input type="text" name="bp" />
            </span>
            <span class="text" style="width: 200px">
                <label><?php echo __t("Portable"); ?></label><input type="text" name="portable" />
            </span>
            <span class="text" style="width: 200px">
                <label><?php echo __t("T&eacute;l&eacute;phone"); ?></label><input type="text" name="telephone" />
            </span>
            <span class="text" style="width: 200px">
                <label><?php echo __t("E-mail"); ?></label><input type="text" name="email" />
            </span>
            <span class="text" style="width: 200px">
                <label><?php echo __t("Profession"); ?></label><input type="text" name="profession" />
            </span>
            <span class="text" style="width: 200px">
                <label><?php echo __t("Accepte l'envoi de notification"); ?></label><input type="checkbox" name="acceptesms" />
            </span>
            <span class="text" style="width: 200px">
                <label><?php echo __t("N° envoi de notification"); ?></label><input type="text" name="numsms" />
            </span>
        </fieldset>
    </div>
    <div class="recapitulatif"></div>
    <div class="navigation">
        <?php echo btn_ok("document.forms[0].submit()"); ?>
    </div>
</form>
<div class="status"></div>