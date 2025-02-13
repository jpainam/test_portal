<div id="entete"></div>
<div class="titre">
    <?php echo __t("Modification de mon num&eacute;ro de t&eacute;l&eacute;phone"); ?>
</div>
<form action="<?php echo Router::url("user", "telephone"); ?>" method="post" >
    <div class="page">
        <fieldset style="margin: auto; width: 350px; position: relative;float: none;">
            <legend><?php echo __t("Changement de num&eacute;ro de t&eacute;l&eacute;phone"); ?></legend>
            <span class="text" style="width: 300px">
                <label><?php echo __t("Nouveau Num&eacute;ro portable"); ?> </label>
                <input type="tel" name="portable" value="<?php echo $portable; ?>" />
            </span>
            <span class="text" style="width: 300px">
                <label><?php echo __t("Nouveau Num&eacute;ro de t&eacute;l&eacute;phone"); ?> </label>
                <input type="tel" name="telephone" value="<?php echo $tel; ?>" />
            </span>
            
        </fieldset>
    </div>
    <div class="recapitulatif">


    </div>
    <div class="navigation">
        <?php echo btn_ok("document.forms[0].submit();"); ?>
         <?php echo btn_cancel("document.location='../'"); ?>
    </div>
</form>

<?php
if ($errors) {
    echo $message;
}
?>
<div class="status"></div>