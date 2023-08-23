<style>
    .onglet fieldset{
        display: block;
        position: relative;
        margin: 15px 0 0 15%;
        width: 50%;
    }
    .onglet fieldset p a{
        color : #B63B00;
        text-decoration: none;
        cursor: pointer;
        font-size: 12px;      
    }
    .onglet fieldset p{
        font-weight: bold;
        font-size: 14px;
        padding-left: 50px;
    }
    .onglet fieldset p label{
        font-size: 12px;
    }
</style>
<div id="entete"><div class="logo"><img src="<?php echo SITE_ROOT . "public/img/wide_etablissement.png";  ?>" /></div>
</div>
<div class="titre">
    <?php echo __t("Informations relatives &agrave; l'&eacute;tablissement"); ?>
</div>
<div class="page">
    <div class="tabs" style="width: 100%">
        <ul>
            <li id="tab1" class="courant">
                <a onclick="onglets(1, 1, 5);">
                    <img border ="0" alt="" src="<?php echo SITE_ROOT . "public/img/icons/etablissement.png"; ?>" />
                    <?php echo __t("Etablissement"); ?>
                </a>
            </li>
            <li id="tab2" class="noncourant">
                <a onclick="onglets(1, 2, 5);">
                    <img border ="0" alt="" src="<?php echo SITE_ROOT . "public/img/icons/personnel.png"; ?>" />
                    <?php echo __t("Personnels"); ?>
                </a>
            </li>
            <li id="tab3" class="noncourant">
                <a onclick="onglets(1, 3, 5);">
                    <img border ="0" alt="" src="<?php echo SITE_ROOT . "public/img/icons/eleve.png"; ?>" />
                    <?php echo __t("Elèves inscrits"); ?>
                </a>
            </li>
            <li id="tab4" class="noncourant">
                <a onclick="onglets(1, 4, 5);">
                    <img border ="0" alt="" src="<?php echo SITE_ROOT . "public/img/icons/collectif.png"; ?>" />
                    <?php echo __t("Nouveaux &eacute;l&egrave;ves"); ?>
                </a>
            </li>
            <li id="tab5" class="noncourant">
                <a onclick="onglets(1, 5, 5);">
                    <img border ="0" alt="" src="<?php echo SITE_ROOT . "public/img/icons/exclus.png"; ?>" />
                    <?php echo __t("El&egrave;ves exclus"); ?>
                    
                </a>
            </li>
        </ul>
    </div>
    <div id="onglet1" class="onglet" style="display: block;">
        <fieldset style="margin-top: 5%;"><legend><?php echo __t("Etablissement"); ?>
        </legend>
            <img src="<?php echo SITE_ROOT . "public/img/" . $school['LOGO']; ?>" width="78" height="78" style="float:right;" >
            <p class="text"><?php echo $ets; ?></p>
            <p style=" position: relative; top: 15px; font-size: 12px;"><?php echo __t("Site Web"); ?> : 
                <?php echo $school['SITEWEB']; ?></p>
        </fieldset>
        <fieldset><legend><?php echo __t("Responsable"); ?></legend>
            <p><?php echo $responsable; ?></p>
        </fieldset>
        <fieldset><legend><?php echo __t("Adresse"); ?></legend>
            <p><?php echo $adresse; ?></p>
        </fieldset>
        <fieldset><legend><?php echo __t("Coordonn&eacute;es"); ?>
        </legend>
            <p><label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tel:&nbsp;</label><?php echo $tel1 . " / " . $tel2; ?></p>
            <p><label><?php echo __t("Mobile"); ?>:&nbsp;</label><?php echo $mobile; ?></p>
            <p style="margin-top: 20px;"><label>&nbsp;&nbsp;<?php echo __t("E-mail"); ?>:&nbsp;</label><a href=""><?php echo $email; ?>
                </a></p>
        </fieldset>
    </div>
    <div id="onglet2" class="onglet" style="display: none;">
        <?php echo $personnels; ?>
    </div>
    <div id="onglet3" class="onglet" style="display: none;">
        <?php echo $eleves; ?>
    </div>
     <div id="onglet4" class="onglet" style="display: none;">
        <?php echo $nouveaueleves; ?>
    </div>
    <div id="onglet5" class="onglet" style="display: none;">
        <table id="dataTable2" class="dataTable">
            <thead><tr><th><?php echo __t("Matricule "); ?></th><th><?php echo __t("Noms et Pr&eacute;noms"); ?></th>
                    <th><?php echo __t("Date Naiss."); ?></th>
                    <th><?php echo __t("Classe"); ?></th></tr></thead>
            <tbody>
                <?php
                    foreach($eleveexclus as $exclus){
                        $d = new DateFR($exclus['DATENAISS']);
                        echo "<tr><td>".$exclus['MATRICULE']."</td><td>".$exclus['NOM']." ".$exclus['PRENOM']."</td>"
                                . "<td>".$d->getDate()." ".$d->getMois()." ".$d->getYear()."</td>"
                                . "<td>".$exclus['NIVEAUHTML']."</td></tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>

<div class="navigation">
    <div class="editions" style="float: left">
        <img src="<?php echo img_imprimer(); ?>" />&nbsp;Editions:
         <select onchange="imprimer();" name = "code_impression">
            <option></option>
            <option value="0001"><?php echo __t("Informations de l'&eacute;tablissement"); ?></option>
            <option value="0008"><?php echo __t("Liste de nouveaux &eacute;l&egrave;ves"); ?></option>
            <option value="0002"><?php echo __t("Liste des &eacute;l&egrave;ves"); ?> </option>
            <!-- option value="0003">Liste d&eacute;taill&eacute;e des &eacute;l&egrave;ves</option -->
            <option value="0004"><?php echo __t("Liste du personnels"); ?></option>
            <!-- option value="0005">Liste d&eacute;taill&eacute;e du personnels</option -->
            <option value="0009"><?php echo __t("Fiche de demande d'inscription vierge"); ?></option>
            <!-- option value="0006"><?php //echo __t("Planning des activit&eacute;s p&eacute;dagogique"); ?></option -->
            <option value="0007"><?php echo __t("Liste des chefs et sous-chefs de classes"); ?></option>
        </select>
    </div>
    <?php 
        echo btn_add("document.location='". Router::url("etablissement", "saisie")."'");
    ?>
</div>
<div class="status"></div>