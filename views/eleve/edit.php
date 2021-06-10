<div id="entete">
    <div class="logo"> <img src="<?php echo SITE_ROOT . "public/img/wide_saisieeleve.png"; ?>" /></div>
</div>
<div class="titre">Modification de l'&eacute;l&egrave;ve : <?php
    echo $eleve['MATRICULE'] . " : " . $eleve['NOM'] . "  " .
    $eleve['PRENOM'];
    ?></div>

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
                    <?php echo __t("Ajout d'une photo d'identit&eacute;"); ?>
                </a>
            </li>
        </ul>
    </div>
    <div id="onglet1" class="onglet" style="display: block; height: 470px;">
        <form action="<?php echo url('eleve', 'edit', $eleve['IDELEVE']); ?>" name = 'frmeleve' method="post" enctype="multipart/form-data">
            <fieldset style="clear: both; width: 800px"><legend>Identit&eacute;</legend>
                <input type="hidden" name="ideleve" value="<?php echo $eleve['IDELEVE']; ?>" />
                <input type='hidden' name='responsable' value=""/>
                <input type="hidden" name="photoeleve" value="<?php echo $eleve['PHOTO']; ?>" />
                <input type="hidden" name="responsablemodif" id="responsablemodif" value="" />
                <span class="text" style="width: 250px">
                    <label><?php echo __t("Nom"); ?></label>
                    <input type="text" name="nomel" value="<?php echo $eleve['NOM']; ?>" maxlength="30" />
                </span>
                <span class="text" style="width: 228px">
                    <label><?php echo __t("Pr&eacute;nom"); ?></label>
                    <input type="text" value="<?php echo $eleve['PRENOM']; ?>" name="prenomel" maxlength="30" />
                </span>
                <span class="text" style="width: 228px">
                    <label><?php echo __t("Autre Nom"); ?></label>
                    <input type="text" value="<?php echo $eleve['AUTRENOM']; ?>" name="autrenom" maxlength="30" />
                </span>
                <span class="select" style="width: 255px;margin-right: 10px; clear: both;">
                    <label><?php echo __t("Sexe"); ?></label>
                    <select name="sexe">
                        <option value="M" <?php if ($eleve['SEXE'] === "M") echo "selected"; ?>><?php echo __t("Masculin"); ?></option>
                        <option value="F" <?php if ($eleve['SEXE'] === "F") echo "selected"; ?>><?php echo __t("Féminin"); ?></option>
                    </select>
                </span>
                <span class="select" style="width: 234px;margin-right: 7px;">
                    <label><?php echo __t("Pays de nationalit&eacute;"); ?></label>
                    <?php echo $comboNationalite; ?> 
                </span>
                <span class="text" style="width: 228px; margin-left: 0;"><label><?php echo __t("Lieu de r&eacute;sidence"); ?> :</label>
                         <input type="text" name="residence" value="<?php echo $eleve['RESIDENCE']; ?>"/>
                </span>
            </fieldset>
            <div style="height: 40px; clear: both; content: ' ';"></div>
            <fieldset style="clear: both; width: 360px">
                <legend><?php echo __t("Date et lieu de naissance"); ?></legend>
                <span class="text" style="width: 130px">
                    <label><?php echo __t("Date de Naissance"); ?></label>
                    <input type="text" id="datenaiss" name="datenaiss" value="<?php echo $eleve['DATENAISS']; ?>" />
                </span>
                <span class="select" style="width: 180px; margin-left: 10px;">`
                    <label><?php echo __t("Pays de Naiss."); ?></label>
                    <?php echo $comboNaiss; ?>
                </span>
                <span class="text" style="width: 330px">
                    <label><?php echo __t("Lieu de Naissance"); ?></label>
                    <input type="text" name="lieunaiss" value="<?php echo $eleve['LIEUNAISS']; ?>" maxlength="30" />
                </span>
            </fieldset>
            <fieldset style="width: 419px; margin-left: 5px; float: right;">
                <legend><?php echo __t("Informations internes"); ?></legend>
                <span class="text" style="width: 150px; margin-right: 22px">
                    <label><?php echo __t("CNI"); ?></label>
                    <input type="text" name="cni" value="<?php echo $eleve['CNI']; ?>" />
                </span>
                <span class="text" style="width: 222px;" >
                    <label><?php echo __t("Identifiant dans l'Etabl.: Matricule"); ?></label>
                    <input type="text" name="matricule"  value="<?php echo $eleve['MATRICULE']; ?>" />
                </span>
                <span class="text" style="width: 150px;margin-right: 20px;">
                    <label><?php echo __t("Date entr&eacute;e"); ?> : </label>
                    <input type="text" id="dateentree" name="dateentree" value="<?php echo $eleve['DATEENTREE']; ?>" />
                </span>
                <span class="select" style="width: 230px">
                    <label><?php echo __t("Provenance"); ?> :</label>
                    <?php echo $comboProvenance; ?>
                </span>
                <span class="select" style="width: 155px">
                    <label><?php echo __t("Redoublant"); ?></label>
                    <select name="redoublant">
                        <option value="0" <?php if ($eleve['REDOUBLANT'] === 0) echo "selected"; ?>>Non</option>
                        <option value="1" <?php if ($eleve['REDOUBLANT'] === 1) echo "selected"; ?>>Oui</option>
                    </select>
                </span>
                <span class="text" style="width: 222px">
                    <label><?php echo __t("Classe"); ?></label>
                    <input type="text" name="classe" value="<?php echo $classe['LIBELLE']." ".$classe['NIVEAUSELECT'];     ?>" 
                           readonly="readonly" disabled="disabled" />
                </span>
                <span class="text" style="width: 150px;margin-right: 20px;">
                    <label><?php echo __t("Date de sortie"); ?> : </label>
                    <input type="text" id="datesortie" name="datesortie" value="<?php echo $eleve['DATESORTIE']; ?>" />
                </span>
                <span class="select" style="width: 226px">
                    <label><?php echo __t("Motif de sortie"); ?>: </label>
                    <?php echo $comboMotifSortie; ?>
                </span>
            </fieldset>
            <fieldset style="width: 360px; height: 70px;"><legend><?php echo __t("Fr&egrave;res et s&oelig;urs"); ?></legend>
                <span class="text" style="width: 340px">
                    <label><?php echo __t("Noms des fr&egrave;res et s&oelig;urs inscrits"); ?></label>
                    <input type="text" name="frereetsoeur" value="<?php echo $eleve['FRERESOEUR']; ?>" />
                </span>
            </fieldset>
        </form>
    </div>
    <div id="onglet2" class="onglet" style="display: none; height: 470px;">
        <fieldset style = 'height:446px;width: 30%;'><legend><?php echo __t("Responsables"); ?></legend>
            <p style="margin: 0 0 5px 0; text-align: right">
                <img src="<?php echo SITE_ROOT . "public/img/btn_add.png" ?>" id="ajout-responsable" style="cursor: pointer;" />
            </p>
            <div id="ajout-responsable-dialog-form" tabindex="-1" class="dialog" title="Selectionner un responsable"><span>
                    <label><?php echo __t("Choisir un responsable"); ?></label>
                <select name='comboResponsable' tabindex="-1" style="width:100%">
                    <?php
                    foreach ($nonresponsables as $non) {
                        echo "<option value = '" . $non['IDRESPONSABLE'] . "'>" . $non['CIVILITE'] . "-" . $non['NOM'] . " " . $non['PRENOM'] . "</option>";
                    }
                    ?>
                </select></span>
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
                ?></span>
            </div>
            <div id="responsable_content">
                <table class="dataTable" id="responsabletable">
                    <thead><tr><th>Civ.</th><th><?php echo __t("Noms et Pr&eacute;noms"); ?></th><th></th></thead>
                    <tbody><?php
                        foreach ($responsables as $resp) {
                            echo "<tr><td>" . $resp['CIVILITE'] . "</td>";
                              echo "<td><span style='cursor:pointer;display:block' "
            . " onclick=\"afficherResponsable(".$resp['IDRESPONSABLE'].")\">".$resp['NOM'] . " " . $resp['PRENOM'] . "</span></td>" .
                            "<td align = 'center'><img style = 'cursor:pointer' src = '" . SITE_ROOT . "public/img/delete.png'"
                            . " onclick = \"deleteResponsabilite('" . $resp['IDRESPONSABLEELEVE'] . "');\"  /></td></tr>";
                        }
                        ?></tbody>
                </table>
            </div>
        </fieldset>
        <form name="formresponsable"  action='' method="post" enctype="multipart/form-data">
            <fieldset style="width: 55%; height: 446px;"><legend>Informations li&eacute;es au responsable</legend>
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
                    <label><?php echo __t("Portable"); ?></label>
                    <input type="text" name="portable" id="portable"/>
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
                    <input type="text" name="numsms" id="numsms" maxlength="20"/>
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
    </div>
    <div id="onglet3" class="onglet" style=" display: none; height: 470px; ">
        <form action="<?php echo Router::url("eleve", "photo", "upload"); ?>"  enctype="multipart/form-data" id="frmphoto">
            <fieldset style = 'width: 400px; height: 270px;'><legend><?php echo __t("Photo d'identit&eacute;"); ?></legend>
                <?php  echo  __t("photo_identity_description_student"); ?>
                <input type="file" name="photo" maxlength="30" required="" style="margin: 0; padding: 0" />
                <div  style="position: relative; top: 10px; margin-right: 10px; clear: both;" class="navigation">
                    <div id="btn_photo_action"><?php 
                    if (!empty($eleve['PHOTO']) && file_exists(ROOT . DS . "public" . DS . "photos" . DS . "eleves" . DS . $eleve['PHOTO'])){
                        echo btn_add_disabled()." ".btn_effacer("effacerPhotoEleve()");
                    }else{
                        echo btn_add("savePhotoEleve()")." ".btn_effacer_disabled("");
                    }
                    ?>
                    </div>
                </div>
            </fieldset>

            <div id="photoeleve" style="border: 1px solid #000; float: left;  position: relative;width: 200px; height: 200px;margin: 8px 20px;">
                <?php
                if (isset($eleve['PHOTO']) && !empty($eleve['PHOTO'])) {
                    echo "<img style = 'width:200px;height:200px;' src = '" . SITE_ROOT . "public/photos/eleves/" . $eleve['PHOTO'] . "' />";
                }
                ?>
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
