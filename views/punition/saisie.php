<div id="entete">
    <div class="logo"><img src="<?php echo SITE_ROOT . "public/img/punition.png"; ?>" /></div>
    <span class="select" style="width: 250px; margin-left: 100px"> <label><?php echo __t("Puni par"); ?> : </label>
        <?php echo $comboPersonnels; ?>
    </span>
</div>
<div class="titre"><?php echo __t("Saisie d'une punition"); ?></div>
<form action="<?php echo Router::url("punition", "saisie") ?>" method="post" name="frmpunition">
    <div class="page">
        <input type="hidden" name="punipar" value="" />
        <input type="hidden" name="datepunition" value="" />
        <fieldset style="float: none; margin: auto; width: 80%"><legend><?php echo __t("El&egrave;ve puni"); ?></legend>
            <span class="select" style="width: 300px;margin-right: 200px;">
                <label><?php echo __t('Classe'); ?>: </label>
                <?php echo $comboClasses; ?> 
            </span>
            <span class="select" style="width: 300px">
                <label> <?php echo __t("El&egrave;ve"); ?>:</label>
                <select name="comboEleves"><option></option></select>
            </span>
        </fieldset>
        <fieldset style="float: none; margin: auto; width: 80%;height: 60%;"><legend><?php echo __t("Punition"); ?></legend>
            <span class="text" style="width: 150px">
                <label><?php echo __t("Date"); ?></label>
                <input type="text" id="datepunition" name="datepunition" value="" />
            </span>
            <span class="text" style="width: 135px"><label><?php echo __t("Dur&eacute;e (jrs/hrs)"); ?>:</label>
                <input type="text" name ="duree" /></span>
            <span class="select" style="width: 300px">
                <label><?php echo __t("Type"); ?>:</label><?php echo $comboTypes; ?>
            </span>
            <span class="text" style="width: 88%">
                <label><?php echo __t("Motif"); ?>:</label><input type="text" name="motif" />
            </span>
            <span class="text" style="width: 88%">
                <label><?php echo __t("Description"); ?></label>
                <textarea rows="2" cols="2" style="width: 100%" name="description"></textarea>
            </span>
        </fieldset>
    </div>
    <div class="recapitulatif"></div>
    <div class="navigation">
        <?php
        if(isAuth(315)){
            echo btn_ok("soumettrePunition();");
        }else{
            echo btn_ok_disabled();
        }
        if(isAuth(311)){
            echo "&nbsp;&nbsp;&nbsp;".btn_cancel("document.location='".Router::url("punition")."'");
        }else{
            echo "&nbsp;&nbsp;&nbsp;".btn_cancel_disabled();
        }
        ?>
    </div>
</form>
<div class="status"></div>