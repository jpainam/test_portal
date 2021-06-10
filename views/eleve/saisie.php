<style>
    .dialog span{
        display: block;
    }
</style>
<div id="entete"><div class="logo"><img src="<?php echo SITE_ROOT . "public/img/wide_saisieeleve.png"; ?>" /></div>
</div>
<div class="titre">
    <?php echo __t("Ajout d'un nouvel &eacute;l&egrave;ve"); ?>
</div>

<div class="page" style="">
    <div class="tabs" style="width: 100%">
        <ul>
            <li id="tab1" class="courant">
                <a onclick="onglets(1, 1, 3);">
                    <img border ="0" alt="" src="<?php echo SITE_ROOT . "public/img/icons/eleve.png"; ?>" />
                    <?php echo __t("Informations administratives"); ?>
                </a>
            </li>
            <li id="tab2" class="noncourant">
                <a onclick="onglets(1, 2, 3);">
                    <img border ="0" alt="" src="<?php echo SITE_ROOT . "public/img/icons/responsable.png"; ?>" />
                    <?php echo __t("Responsables"); ?>
                </a>
            </li>
            <li id="tab3" class="noncourant">
                <a onclick="onglets(1, 3, 3);">
                    <img border ="0" alt="" src="<?php echo SITE_ROOT . "public/img/icons/photo.png"; ?>" />
                    <?php echo __t("Ajout d'une photo d'identit&eacute;") ?>
                </a>
            </li>
        </ul>
    </div>
    <div id="onglet1" class="onglet" style="display: block; height: 470px;">
        <form action="<?php echo url('eleve', 'saisie'); ?>" name = 'frmeleve' method="post" enctype="multipart/form-data">
            <fieldset style="clear: both; width: 800px"><legend>Identité</legend>
                <input type="hidden" name="ideleve" value="" />
                <input type='hidden' name='responsable' value=""/>
                <input type="hidden" name="photoeleve" value="" />

                <span class="text" style="width: 250px">
                    <label><?php echo __t("Nom"); ?> <i style="color: red" class="exist-eleve"></i></label>
                    <datalist id="listeeleve">
                        <?php
                            foreach ($eleves as $ele){
                                echo "<option value='".$ele['NOM']."'>";
                             }
                        ?>
                    </datalist>
                    <input type="text" list="listeeleve" name="nomel" maxlength="30" onblur="verificationDoublons();" />
                </span>
                <span class="text" style="width: 228px">
                    <label><?php echo __t("Prénom"); ?> <i style="color: red" class="exist-eleve"></i></label>
                    <datalist id="listeeleveprenom">
                        <?php
                            foreach ($eleves as $ele){
                                echo "<option value='".$ele['PRENOM']."'>";
                             }
                        ?>
                    </datalist>
                    <input type="text" list="listeeleveprenom" name="prenomel" maxlength="30" onblur="verificationDoublons();" />
                </span>
                <span class="text" style="width: 228px">
                    <label><?php echo __t("Autre Nom"); ?></label>
                    <input type="text" name="autrenom" maxlength="30" />
                </span>
                <span class="select" style="width: 255px;margin-right: 10px; clear: both;">
                    <label><?php echo __t("Sexe"); ?></label>
                    <select name="sexe">
                        <option value="M"><?php echo __t("Masculin") ?></option>
                        <option value="F"><?php echo __t("Féminin"); ?></option>
                    </select>
                </span>
                <span class="select" style="width: 234px; margin-right: 7px;">
                    <label><?php echo __t("Pays de nationalité"); ?></label>
                    <?php echo $nationalite; ?> 
                </span>
                <span class="text" style="width: 228px; margin-left: 0;"><label><?php echo __t("Lieu de r&eacute;sidence"); ?> :</label> 
                        <input type="text" name="residence" />
                </span>
            </fieldset>
            <div style="height: 30px; clear: both; content: ' ';"></div>
            <fieldset style="width: 360px">
                <legend><?php echo __t("Date et lieu de naissance"); ?></legend>
                <span class="text" style="width: 130px">
                    <label><?php echo __t("Date de Naissance"); ?></label>
                    <!-- div id="datenaiss" style="margin-top: 10px;"></div -->
                    <input type="text" id="datenaiss" name="datenaiss" placeholder="<?php echo __t("Date Naissance"); ?>" />
                </span>; 
                <span class="select" style="width: 180px; margin-left: 10px;">
                    <label><?php echo __t("Pays de Naiss."); ?></label>
                    <?php echo $paysnaiss; ?>
                </span>
                <span class="text" style="width: 330px">
                    <label><?php echo __t("Lieu de Naissance"); ?></label>
                    <input type="text" name="lieunaiss" maxlength="30" />
                </span>
            </fieldset>
            <fieldset style="width: 419px;  float: right;">
                <legend><?php echo __t("Informations internes"); ?></legend>
                <span class="text" style="width: 150px;margin-right: 22px;">
                    <label><?php echo __t("CNI"); ?></label>
                    <input type="text" name="cni" />
                </span>
                <span class="text" style="width: 222px;" >
                    <label><?php echo __t("Identifiant dans l'Etabl.: Matricule"); ?></label>
                    <input type="text" name="matricule" value="" placeholder="<?php echo __t("Laisser vide si inconnu"); ?>"/>
                </span>
                <span class="text" style="width: 150px;margin-right: 20px;">
                    <label><?php echo __t("Date entrée"); ?> : </label>
                    <!-- div id="dateentree" style="margin-top: 10px;"></div -->
                    <input type="text" id="dateentree" name="dateentree" maxlength="30" />
                </span>
                <span class="select" style="width: 230px">
                    <label><?php echo __t("Provenance"); ?> :</label>
                    <select name="provenance" id="provenance" style="width: 100%">
                        <?php echo $provenance; ?>
                    </select>
                </span>
                <span class="select" style="width: 155px">
                    <label><?php echo __t("Redoublant"); ?></label>
                    <select name="redoublant">
                        <option value="0" selected="selected"><?php echo __t('Non'); ?></option>
                        <option value="1"><?php echo __t('Oui'); ?></option>
                    </select>
                </span>
                <span class="select" style="width: 230px">
                    <label><?php echo __t("Classes"); ?></label>
                    <!-- input type="text" name="classe" disabled="disabled" value="R.A.S" / -->
                    <?php echo $classes; ?>
                </span>
                <span class="text" style="width: 150px;margin-right: 20px;">
                    <label><?php echo __t("Date de sortie"); ?> : </label>
                    <!-- div id="date" style="margin-top: 10px;"></div -->
                    <input type="text" id="datesortie" name="datesortie" maxlength="30" />
                </span>
                <span class="text" style="width: 222px">
                    <label><?php echo __t("Motif de sortie"); ?> : </label>
                    <input type="text" name="motifsortie" disabled="disabled" value="R.A.S" />
                </span>
            </fieldset>
            <fieldset style="width: 360px; height: 70px;"><legend><?php echo __t("Fr&egrave;res et s&oelig;urs"); ?></legend>
                <span class="text" style="width: 340px">
                    <label><?php echo __t("Noms des fr&egrave;res et s&oelig;urs inscrits") ?></label>
                    <input type="text" name="frereetsoeur" />
                </span>
            </fieldset>
            <input type="hidden" value="" name="duplicate_validator" />
        </form>
    </div>
    <div id="onglet2" class="onglet" style="display: none; height: 470px;">

        <fieldset style = 'height:446px;width: 300px;'><legend>Responsables</legend>

            <p style="margin: 0 0 5px 0; text-align: right">
                <img src="<?php echo SITE_ROOT . "public/img/btn_add.png" ?>" id="ajout-responsable" style="cursor: pointer;" />
            </p>
            <div id="ajout-responsable-dialog-form"  class="dialog"  title="Selectionner un responsable"><span>
                    <label><?php echo __t("Choisir un responsable") ?></label>
                    <?php echo $comboResponsables; ?></span>
                <span><label><?php echo __t("Parent&eacute;"); ?></label>
                    <select name="parenteextra" id="parenteextra" style="width: 100%">
                    <?php 
                    foreach($parentedata as $pr){
                       echo "<option value='".$pr['LIBELLE']."'>" . __t($pr['LIBELLE'])."</option>";
                    }?>
                    </select>
                </span><span>
                    <?php
                    foreach ($charges as $charge) {
                        echo "<input type ='checkbox' value = \"" . $charge['IDCHARGE'] . "\" name = 'chargeextra' />"
                        . __t($charge['LIBELLE']) . "<br/>";
                    }
                    ?>
                    </span>
            </div>
            <div id="responsable_content">
                <table class="dataTable" id="responsabletable">
                    <thead><tr><th><?php echo __t("Civilit&eacute;"); ?></th>
                            <th><?php echo __t("Noms et Pr&eacute;noms") ?></th><th></th></thead>
                    <tbody id="responsablebody"></tbody>
                </table>
            </div>
        </fieldset>
        <form name="formresponsable"  action='' method="post" enctype="multipart/form-data">
            <fieldset style="width: 480px; height: 446px;"><legend>Informations li&eacute;es au responsable</legend>
                <span class="select" style="width: 50px">
                    <label><?php echo __t("Civilit&eacute;"); ?></label>
                    <?php echo $civilite; ?>
                </span>
                <span class="text" style="width: 170px">
                    <label><?php echo __t("Nom"); ?></label>
                    <input type="text" name="nom" />
                </span>
                <span class="text" style="width: 200px">
                    <label><?php echo __t("Pr&eacute;nom"); ?></label>
                    <input type="text" name="prenom" />
                </span>
                <span class="select" style="width: 120px; clear: both">
                    <label><?php echo __t("Parent&eacute;"); ?></label>
                    <select name="parente" id="parente" style="width: 100%">
                    <?php 
                    foreach($parentedata as $pr){
                       echo "<option value='".$pr['LIBELLE']."'>" . __t($pr['LIBELLE'])."</option>";
                    }?>
                    </select>
                </span>
                <span class="text" style="width: 315px" >
                    <label><?php echo __t("Profession"); ?></label>
                    <input type="text" name="profession" />
                </span>
                <div style="height: 10px; clear: both; content: ' ';"></div>
                <?php
                foreach ($charges as $charge) {
                    echo "<span style = 'margin-right:15px'>"
                    . "<input type ='checkbox' value = \"" . $charge['IDCHARGE'] . "\" name = 'charge' />";
                    echo "<label style = 'font-weight:bold;'>" . __t($charge['LIBELLE']) . "</label></span>";
                }
                ?>
                <span class="text" style="width: 140px">
                    <label>Portable</label>
                    <input type="text" id="portable" name="portable" />
                </span>
                <span class="text" style="width: 140px">
                    <label><?php echo __t("T&eacute;l&eacute;phone"); ?></label>
                    <input type="text" name="telephone" />
                </span>
                <span class="text" style="width: 140px">
                    <label><?php echo __t("E-mail"); ?></label>
                    <input type="text" name="email" />
                </span>
                <span  style="width: 200px; display: block; float: left; position: relative; top: 20px;">
                    <input type="checkbox" name="acceptesms" checked ='checked' />
                    <?php echo __t("Accepte l'envoi de notification"); ?>

                </span>
                <span class="text" style="width: 140px;" >
                    <label><?php echo __t("N° envoi de notification"); ?></label>
                    <input type="text" id="numsms" name="numsms" maxlength="30"/>
                </span>

                <fieldset style="width: 440px;"><legend><?php echo __t("Coordonn&eacute;es"); ?></legend>

                    <span class="text" style="width: 418px;">
                        <label><?php echo __t("Adresse"); ?></label>
                        <input type="text" name="adresse1" placeholder = 'Adresse'/>
                    </span>
                    <span class="text" style="width: 418px;margin-top:-10px;" placeholder = 'Adresse'>
                        <input type="text" name="adresse2" placeholder = 'Adresse'/>
                    </span>
                    <span class="text" style="width: 418px; margin-top:-10px;">
                        <input type="text" name="adresse3" placeholder = 'Adresse' />
                    </span>
                    <span class="text" style="width: 418px;">
                        <label><?php echo __t("Boite Postale"); ?></label>
                        <input type="text" name="bp" />
                    </span>

                </fieldset>
                <div  style="position: relative; top: 10px; margin-right: 10px; clear: both;" class="navigation">
                    <?php echo btn_ok("saveResponsable()"); ?>
                    <?php echo btn_cancel("resetResponsable();") ?>
                </div>
            </fieldset>
        </form>

        </fieldset>
    </div>
    <div id="onglet3" class="onglet" style=" display: none; height: 470px; ">
        <form action="<?php echo Router::url("eleve", "photo", "upload"); ?>"  enctype="multipart/form-data" id="frmphoto">
            <fieldset style = 'width: 400px; height: 270px;'><legend>Photo d'identit&eacute;</legend>
                <?php  echo  __t("photo_identity_description_student"); ?>
                <input type="file" name="photo" maxlength="30" required="" style="margin: 0; padding: 0" />
                <div  style="position: relative; top: 10px; margin-right: 10px; clear: both;" class="navigation">
                    <div id="btn_photo_action"><?php echo btn_add("savePhotoEleve()"); ?>
                        <?php echo btn_effacer_disabled(""); ?>
                    </div>

                </div>
            </fieldset>

            <div id="photoeleve" style="border: 1px solid #000; float: left;  position: relative;width: 200px; height: 200px;margin: 8px 20px;">

            </div>
        </form>
    </div>
</div>
<div class="recapitulatif">
    <div class="errors">
        <?php
        //if ($errors)
        //  echo $message;
        ?>
    </div>
</div>
<div class="navigation">
    <?php echo btn_ok("soumettreFormEleve();"); ?>
</div>

<div class="status"></div>
<?php
/**
 * Les dialog pour la saisie d'un nouvel etablissement
 */
?>
<div id="preciser-libelle-dialog-form" class="dialog" title="Pr&eacute;ciser le nom de l'&eacute;tablissement">
    <span><label>Nom de l'&eacute;tablissement</label>
        <input style="width: 100%" type="text" name="preciserets" /></span>
</div>
