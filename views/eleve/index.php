<div id="entete">
    <div class="logo"><img src="<?php echo SITE_ROOT . "public/img/wide_saisieeleve.png"; ?>" /></div>
    <div style="margin-left: 120px"><span class="select2" style="width: 400px">
            <label><?php echo __t("Liste des élèves"); ?> : </label>
            <?php echo $eleves; ?></span>
    </div>
</div>
<?php
if(isAuth(219)){
    $_nbre = 6;
}else{
    $_nbre = 5;
} ?>
<div class="titre"></div>
<form action="<?php echo url('eleve', 'saisie'); ?>" method="post">
    <div class="page" style="">
        <div class="tabs" style="width: 100%">
            <ul>
                <li id="tab1" class="courant">
                    <a onclick="onglets(1, 1, <?php echo $_nbre; ?>);">
                        <img border ="0" alt="" src="<?php echo SITE_ROOT . "public/img/icons/eleve.png"; ?>" />
                        <?php echo __t("El&egrave;ve"); ?>
                    </a>
                </li>
                <li id="tab2" class="noncourant">
                    <a onclick="onglets(1, 2, <?php echo $_nbre; ?>);">
                        <img border ="0" alt="" src="<?php echo SITE_ROOT . "public/img/icons/responsable.png"; ?>" />
                        <?php echo __t("Responsables"); ?>
                    </a>
                </li>
                <li id="tab3" class="noncourant">
                    <a onclick="onglets(1, 3, <?php echo $_nbre; ?>);">
                        <img border ="0" alt="" src="<?php echo SITE_ROOT . "public/img/icons/emploistemps.png"; ?>" />
                       <?php echo __t("Emploi du temps"); ?>
                    </a>
                </li>
                <?php /*<li id="tab4" class="noncourant">
                    <a onclick="onglets(1, 4, <?php echo $_nbre; ?>);">
                        <img border ="0" alt="" src="<?php echo SITE_ROOT . "public/img/icons/viescolaire.png"; ?>" />
                        Vie scolaire
                    </a>
                </li> */ ?>
                <li id="tab4" class="noncourant">
                    <a onclick="onglets(1, 4, <?php echo $_nbre; ?>);">
                        <img border ="0" alt="" src="<?php echo SITE_ROOT . "public/img/icons/note.png"; ?>" />
                        <?php echo __t("Notes"); ?>
                    </a>
                </li>
                <li id="tab5" class="noncourant">
                    <a onclick="onglets(1, 5, <?php echo $_nbre; ?>);">
                        <img border ="0" alt="" src="<?php echo SITE_ROOT . "public/img/icons/suivi.png"; ?>" />
                        <?php echo __t("Suivi"); ?>
                    </a>
                </li>
                <?php if(isAuth(219)){ ?>
                <li id="tab6" class="noncourant"><a onclick="onglets(1, 6, <?php echo $_nbre; ?>);">
                        <img border ="0" alt="" src="<?php echo SITE_ROOT . "public/img/icons/caisse.png"; ?>" />
                        <?php echo __t("Situation financi&egrave;re"); ?></a></li>
                <?php } ?>
            </ul>
        </div>
        <div id="onglet1" class="onglet" style="display: block;height: 90%">
            <div class="fiche">
                <fieldset style="width: 80%;float: none; margin: auto;margin-top: 20px"><legend><?php echo __t("Identité"); ?></legend>
                    <table cellpadding = "5">
                        <tr><td width = "25%" style="font-weight: bold"><?php echo __t("Nom"); ?> : </td><td><?php //echo //$nom;     ?></td></tr>
                        <tr><td style="font-weight: bold"><?php echo __t("Pr&eacute;nom"); ?> : </td><td><?php //echo// $prenom;     ?></td></tr>
                        <tr><td style="font-weight: bold"><?php echo __t("Sexe"); ?> : </td><td><?php //echo //$sexe;     ?></td></tr>
                        <tr><td style="font-weight: bold"><?php echo __t("Date de Naissance"); ?> : </td><td><?php //echo $datenaiss;     ?></td></tr>
                        <tr><td style="font-weight: bold"> <?php echo __t("Lieu de Naissance"); ?>: </td><td><?php //echo $lieunaiss;     ?></td></tr>
                        <tr><td style="font-weight: bold"><?php echo __t("Pays de nationalité"); ?> : </td><td><?php // echo $nationalite;     ?></td></tr>
                    </table>
                </fieldset>
                <fieldset style="width: 80%;float: none; margin: auto;margin-top: 20px;"><legend><?php echo __t("Scolarité actuelle"); ?></legend>
                    <table  cellpadding = "5">
                        <tr><td  width = "25%" style="font-weight: bold"><?php echo __t("Classe"); ?> : </td><td><?php //echo $classe;      ?></td></tr>
                        <tr><td style="font-weight: bold"><?php echo __t("Redoublant"); ?> : </td><td><?php //echo $redoublant;      ?></td></tr>
                        <tr><td style="font-weight: bold"><?php echo __t("Date d'entr&eacute;e"); ?> : </td><td><?php // echo $dateentree;     ?></td></tr>
                        <tr><td style="font-weight: bold"><?php echo __t("Provenance"); ?> : </td><td><?php //echo //$provenance;     ?></td></tr>
                        <tr><td style="font-weight: bold"><?php echo __t("Date de sortie"); ?> : </td><td><?php //echo// $datesortie;     ?></td></tr>
                        <tr><td style="font-weight: bold"><?php echo __t("Motif sortie"); ?> : </td><td><?php //echo// $motifsortie;     ?></td></tr>
                    </table>

                </fieldset>
            </div>
        </div>
        <div id="onglet2" class="onglet" style="display: none;height: 90%">
            <?php //echo $responsables; ?>
        </div>
        <div id="onglet3" class="onglet" style="display: none;height: 90%">
            <?php //echo $emplois; ?>
        </div>
        <?php /*<div id="onglet4" class="onglet" style="display: none;height: 90%">
             //echo $viescolaire; 
        </div> */?>
        <div id="onglet4" class="onglet" style="display: none;height: 90%"></div>
        <div id="onglet5" class="onglet" style="display: none;height: 90%"></div>
        <?php if(isAuth(219)){ ?>
        <div id="onglet6" class="onglet" style="display: none;height: 90%"></div>
        <?php } ?>
    </div>

    <div class="navigation">
        <div class="editions">
            <img src="<?php echo img_imprimer(); ?>" />&nbsp;Editions:
            <select onchange="imprimer();" name = "code_impression">
                <option></option>
                <option value="0001"><?php echo __t("Fiche de l'&eacute;l&egrave;ve"); ?></option>
                <option value="0002"><?php echo __t("Fiche de demande d'inscription"); ?></option>
                <option value="0003"><?php echo __t("Certificat de scolarit&eacute;"); ?></option>
                <option value="0007"><?php echo __t("Carte d'identité scolaire"); ?></option>
                 <?php if(isAuth(219)){ ?>
                <option value="0004"><?php echo __t("Situation financi&egrave;re"); ?></option>
                 <?php } ?>
                <option value="0005"><?php echo __t("Liste des notes de l'&eacute;l&egrave;ve"); ?></option>
                <option value="0006"><?php echo __t("Emploi du temps"); ?></option>
            </select>
        </div>
    </div>
    <?php
    if (isset($ideleve)) {
        echo '<input type="hidden" value="' . $ideleve . '" name="ideleve" />';
    }else{
        echo '<input type="hidden" value="" name="ideleve" />';
    }
    ?>
</form>
<div class="status">
</div>
<div id="editer-note-dialog" class="dialog" title="Modifier la note cet &eacute;l&egrave;ve">
    <span><label><?php echo __t("Mati&egrave;res"); ?> : </label>
        <input type="text" name="matiere-editer" style="width: 100%" value="" disabled="disabled" />
    </span>
    <span><label><?php echo __t("Note"); ?></label>
        <input style="width: 100%" type="text" name="nouvelnote" />
    </span>
    <div id="erreur-nouvel-note" style="color: #ff9999; text-align: center; font-size: 11px; 
         display: none" ><blink><?php echo __t("Veuillez entrer une note valide"); ?></blink></div>
</div>
