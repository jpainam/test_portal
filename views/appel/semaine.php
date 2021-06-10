<style>
    .dataTable .centrer{
        text-align: center;
    }
</style>
<div id="entete" style="height: 80px">
    <div class="logo"><img src="<?php echo SITE_ROOT . "public/img/wide_appel.png"; ?>" /></div>
    <div style="margin-left: 100px">
        <span class="text" style="width: 160px; margin-top: 0"><label><?php echo __t("Du"); ?></label>
            <input type="text"  id="datedu" name="datedu" /></span>
            <span class="text" style="width: 160px; margin-top: 0"><label><?php echo __t("Au"); ?></label>
            <input type="text" name="dateau" id="dateau" /></span>

            <span class="select" style="width: 330px; margin-top: 0;clear: both; "><label><?php echo __t("Classes"); ?> : </label>
            <?php echo $comboClasses; ?></span>

    </div>
</div>
<div class="page">
    <div class="tabs" style="width: 100%">
        <ul>
            <li id="tab1" class="courant"><a onclick="onglets(1, 1, 5);">
                    <img border ="0" alt="" src="<?php echo SITE_ROOT . "public/img/icons/un.png"; ?>" />&nbsp;&nbsp;<?php echo __t("Lundi"); ?><span></span></a></li>
            <li id="tab2" class="noncourant"><a onclick="onglets(1, 2, 5);">
                    <img border ="0" alt="" src="<?php echo SITE_ROOT . "public/img/icons/deux.png"; ?>" />&nbsp;&nbsp;<?php echo __t("Mardi"); ?><span></span></a></li>
            <li id="tab3" class="noncourant"><a onclick="onglets(1, 3, 5);">
                    <img border ="0" alt="" src="<?php echo SITE_ROOT . "public/img/icons/trois.png"; ?>" />&nbsp;&nbsp;<?php echo __t("Mercredi"); ?><span></span></a></li>
            <li id="tab4" class="noncourant"><a onclick="onglets(1, 4, 5);">
                    <img border ="0" alt="" src="<?php echo SITE_ROOT . "public/img/icons/quatre.png"; ?>" />&nbsp;&nbsp;<?php echo __t("Jeudi"); ?><span></span></a></li>
            <li id="tab5" class="noncourant"><a onclick="onglets(1, 5, 5);">
                    <img border ="0" alt="" src="<?php echo SITE_ROOT . "public/img/icons/cinq.png"; ?>" />&nbsp;&nbsp;<?php echo __t("Vendredi"); ?><span></span></a></li>
        </ul>
    </div>
    <div id="onglet1" class="onglet" style="display: block; height: 85%;">
        <form name="formAppel1" action="" >
        </form>
    </div>
    <div id="onglet2" class="onglet" style="display: none;height: 85%">
        <form name="formAppel2" action="" >
        </form>
    </div>
    <div id="onglet3" class="onglet" style="display: none;height: 85%">
        <form name="formAppel3" action="" >
        </form>
    </div>
    <div id="onglet4" class="onglet" style="display: none;height: 85%">
        <form name="formAppel4" action="" >
        </form>
    </div>
    <div id="onglet5" class="onglet" style="display: none;height: 85%">
        <form name="formAppel5" action="" >
        </form>
    </div>

    <p style="margin:5px 10px 0 10px; padding: 0">
        <label style="font-weight: bold;text-decoration: underline"><?php echo __t("L&eacute;gendes"); ?>:</label>&nbsp;&nbsp;
        <span class="present"></span><b>P : </b><?php echo __t("Pr&eacute;sent"); ?> &nbsp;&nbsp;&nbsp; 
        <span class="absent"></span><b>A : </b> <?php echo __t("Absent"); ?> &nbsp;&nbsp;&nbsp;
        <span class="retard">R</span><b>R : </b><?php echo __t("en Retard"); ?> &nbsp;&nbsp;&nbsp;
        <span class="exclu">E</span><b>E : </b><?php echo __t("Exclu de cours"); ?>&nbsp;&nbsp;&nbsp;
        <span class="justifier">&nbsp;&nbsp;&nbsp;&nbsp;</span><b>A : </b> <?php echo __t("Absence justifi&eacute;e"); ?>
        <span class="freedays">&nbsp;&nbsp;&nbsp;&nbsp;</span><b>F : </b> <?php echo __t('Ets ferm&eacute;/f&eacute;ri&eacute;'); ?>
    </p>
</div>
<div class="navigation">
    <div class="editions" style="float: left">&nbsp;
     <img src="<?php echo img_imprimer(); ?>" /><select onchange="imprimer();" name = "code_impression">
        <option></option>
        <option value="0001"><?php echo __t("Liste d'appel vierge"); ?></option>
        <option value="0002"><?php echo __t("Cette liste d'appel"); ?></option>
    </select>
</div>
<?php echo __t("En cochant cette case, vous certifiez l'exactitude des donn&eacute;es saisies en votre nom"); ?> : 
<input style="vertical-align: middle;" type="checkbox" name="certifier" />
<?php echo btn_save_appel("validerAppel();"); ?>

</div>
<div class="status"></div>