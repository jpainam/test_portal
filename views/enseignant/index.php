<div id="entete">
    <div class="logo"><img src="<?php echo SITE_ROOT . "public/img/wide_enseignant.png"; ?>" /></div>
    <div style="margin-left: 100px">
        <span class="select2" style="width: 300px">
            <label><?php echo __t("Enseignants"); ?> : </label>
                <?php echo $comboEnseignants; ?></span>
    </div>
</div>
<div class="titre"><?php echo __t("Gestion des enseignants"); ?></div>
<div class="page">
    <div class="tabs" style="width: 100%">
        <ul><li id="tab1" class="courant">
                <a onclick="onglets(1, 1, 4);">
                    <img border ="0" alt="" src="<?php echo SITE_ROOT . "public/img/icons/enseignant.png"; ?>" />
                    <?php echo __t("Informations"); ?>
                </a></li>
            <li id="tab2" class="noncourant">
                <a onclick="onglets(1, 2, 4);">
                    <img border ="0" alt="" src="<?php echo SITE_ROOT . "public/img/icons/classe.png"; ?>" />
                    <?php echo __t("Classes"); ?>
                </a>
            </li>
            <li id="tab3" class="noncourant"><a onclick="onglets(1, 3, 4);">
                    <img border ="0" alt="" src="<?php echo SITE_ROOT . "public/img/icons/eleves.png"; ?>" />
                    <?php echo __t("El&egrave;ves"); ?>
                </a>
            </li>
            <li id="tab4" class="noncourant"><a onclick="onglets(1, 4, 4);">
                    <img border ="0" alt="" src="<?php echo SITE_ROOT . "public/img/icons/emploistemps.png"; ?>" />
                    <?php echo __t("Emplois du temps"); ?></a></li>
        </ul>
    </div>
    <div id="onglet1" class="onglet" style="display: block;height: 90%">
        
    </div>
    <div id="onglet2" class="onglet" style="display: none;height: 90%">
      
    </div>
    <div id="onglet3" class="onglet" style="display: none;height: 90%">
      
    </div>
    <div id="onglet4" class="onglet" style="display: none;height: 90%">
        
    </div>
</div>
<div class="navigation">
    <div class="editions">
            <img src="<?php echo img_imprimer(); ?>" />&nbsp;Editions:
            <select onchange="imprimer();" name = "code_impression">
                <option></option>
                <option value="0001"><?php echo __t("Fiche de l'enseignant"); ?></option>
                <option value="0010"><?php echo __t("Emploi du temps de l'enseignant"); ?></option>
                <option value="0009"><?php echo __t("Repertoire t&eacute;l&eacute;phonique des enseignants"); ?></option>
        </div>
</div>
<div class="status"></div>