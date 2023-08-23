<div id="entete" style="height: 80px">
    <div class="logo"><img src="<?php echo SITE_ROOT . "public/img/wide_classe.png"; ?>" /></div>
    <div style="margin-left: 100px; width: 750px">
        <span class="select" style="width: 200px;margin-top: 0"><label><?php echo __t("Classe"); ?> : </label><?php echo $comboClasses; ?></span>
        <span class="text" style="margin-left: 10px;margin: 0; width: 300px;font-weight: bold"><?php echo __t("Prof. Principal"); ?> :
            <span id="prof-principal"></span></span> 
            <span  style="margin: 0; font-weight: bold;"><?php echo __t("CPE. Principal"); ?>: <span id="cpe-principal"></span></span>
            <span class="text" style="margin-top:0;margin-left: 2px; clear: both; width: 197px;font-weight: bold"><?php echo __t("Effectif"); ?>: 
				<span id="effectif">00</span>
				&nbsp;&nbsp;&nbsp;Nouveaux:&nbsp;<span id="nouveauxeleves">00</span>
			</span>
            <span class="text" style="width: 300px;margin: 0;font-weight: bold"><?php echo __t("Responsable Admin."); ?> : 
            <span id="resp-admin"></span></span>

            <span class="text" style="margin: 0; font-weight: bold;"><?php echo __t("Total des frais"); ?> : <span id="total-frais"></span>
                
            </span>
    </div>
</div>
<?php
if (isAuth(220) && isAuth(328)) {
    $_situ = 4;
    $_notif = 5;
    $_maxnbre = 5;
} elseif (isAuth(220) && !isAuth(328)) {
    $_situ = 4;
    $_maxnbre = 4;
} elseif (!isAuth(220) && isAuth(328)) {
    $_notif = 4;
    $_maxnbre = 4;
} else {
    $_maxnbre = 3;
}

if(isAuth(220)){
    $_maxnbre = 6;
}else{
    $_maxnbre = 5;
} 
?>
<form action="<?php echo url('classe', 'saisie'); ?>" method="post">
    <div class="page" style="">
        <div class="tabs" style="width: 100%">
            <ul>
                <li id="tab1" class="courant">
                    <a onclick="onglets(1, 1, <?php echo $_maxnbre; ?>);">
                        <img border ="0" alt="" src="<?php echo SITE_ROOT . "public/img/icons/eleve.png"; ?>" />
                        <?php echo __t("El&egrave;ves"); ?>
                    </a>
                </li>
                <li id="tab2" class="noncourant">
                    <a onclick="onglets(1, 2, <?php echo $_maxnbre; ?>);">
                        <img border ="0" alt="" src="<?php echo SITE_ROOT . "public/img/icons/enseignant.png"; ?>" />
                        <?php echo __t("Enseignants"); ?>
                    </a>
                </li>
                <li id="tab3" class="noncourant">
                    <a onclick="onglets(1, 3, <?php echo $_maxnbre; ?>);">
                        <img border ="0" alt="" src="<?php echo SITE_ROOT . "public/img/icons/emploistemps.png"; ?>" />
                        <?php echo __t("Emploi du temps"); ?>
                    </a>
                </li>
                 <li id="tab4" class="noncourant">
                     <a onclick="onglets(1, 4, <?php echo $_maxnbre; ?>);">
                         <img border ="0" alt="" src="<?php echo SITE_ROOT . "public/img/icons/matiere.png"; ?>" />
                            <?php echo __t("Mati&egrave;res"); ?></a>
                 </li>
                  <li id="tab5" class="noncourant">
                     <a onclick="onglets(1, 5, <?php echo $_maxnbre; ?>);">
                         <img border ="0" alt="" src="<?php echo SITE_ROOT . "public/img/icons/individuel.png"; ?>" />
                            <?php echo __t("Nouveaux élèves"); ?></a>
                 </li>
                <?php if (isAuth(220)) { ?>
                    <li id="tab6" class="noncourant"><a onclick="onglets(1, 6, <?php echo $_maxnbre; ?>);">
                            <img border ="0" alt="" src="<?php echo SITE_ROOT . "public/img/icons/caisse.png"; ?>" />
                            <?php echo __t("Situation financi&egrave;re"); ?></a></li>
                <?php } /*
                if (isAuth(328)) { ?>
                    <li id="tab5" class="noncourant"><a onclick="onglets(1, <?php echo $_notif.','.$_maxnbre; ?>);">
                            <img border ="0" alt="" src="<?php echo SITE_ROOT . "public/img/icons/phone_ring.png"; ?>" />
                            Notification financi&egrave;re</a></li>
                <?php }*/ ?>
            </ul>
        </div>
        <div id="onglet1" class="onglet" style="display: block;height: 90%"></div>
        <div id="onglet2" class="onglet" style="display: none;height: 90%"></div>
        <div id="onglet3" class="onglet" style="display: none;height: 90%"></div>
        <div id="onglet4" class="onglet" style="display: none;height: 90%"></div>
        <div id="onglet5" class="onglet" style="display: none;height: 90%"></div>
        <?php if(isAuth(220)){ ?>
            <div id="onglet6" class="onglet" style="display: none; height: 90%"></div>
        <?php } ?>
    </div>

    <div class="navigation">  
        <div class="editions">
            <input type="radio" value="excel" name="type_impression" />
            <img src="<?php echo img_excel(); ?>" />&nbsp;&nbsp;
            <input type="radio" value="pdf" name="type_impression" checked="checked" />
            <img src="<?php echo img_pdf(); ?>" />&nbsp;&nbsp;Editions:
            <select onchange="imprimer();" name = "code_impression">
                <option></option>
                <option value="0001"><?php echo __t("Liste des &eacute;l&egrave;ves"); ?></option>
                <option value="0011">Listes des nouveaux élèves</option>
                <option value="0009"><?php echo __t("Liste des matières"); ?></option>
                <?php
                if (isAuth(220)) {
                    echo '<option value="0003">'.__t("Situation financi&egrave;re").'</option>';
                    echo '<option value="0008">'.__t("Liste des &eacute;l&egrave;ves d&eacute;biteurs").'</option>';
                }
                if (isAuth(222)) {
                    echo '<option value="0004">'.__t("Lettres de rappel financi&egrave;res").'</option>';
                }
                ?>
                 
                <option value="0006"><?php echo __t("Emploi du temps de la classe"); ?></option>
                <option value="0010"><?php echo __t("Liste des manuels scolaires"); ?></option>
                <option value="0007"><?php echo __t("Fiche de suivi p&eacute;riodique des &eacute;l&egrave;ves"); ?></option>
            </select>
        </div>
    </div>
</form>
<div class="status">
</div>
