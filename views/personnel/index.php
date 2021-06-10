<div id="entete">
    <div class="logo"><img src="<?php echo SITE_ROOT . "public/img/wide_personnel.png"; ?>" /></div>
    <div style="margin-left: 70px;">
        <span class="select" style="width: 300px; margin-left: 120px;"><label><?php echo __t("Fonction"); ?> : </label>
            <?php echo $comboFonctions; ?></span>
    </div>
</div>
<form action="<?php echo Router::url("personnel", "saisie"); ?>" name="frmpersonnel">
    <div class="page">

        <?php echo $listepersonnels; ?>

    </div>

    <div class="navigation">
        <?php if (isAuth(502)) { 
            echo btn_add("document.location='" . Router::url("personnel", "saisie") . "'");
        } ?>
    </div>
</form>
<div class="status"></div>