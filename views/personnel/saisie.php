<div id="entete">
    <div class="logo"><img src="<?php echo SITE_ROOT . "public/img/wide_saisiepersonnel.png"; ?>" /></div>
</div>
<style>
    .courant a{
        background: #F7F7F7;
        border-bottom: 1px solid #F7F7F7;
    }
</style>
<div class="titre">
    Saisie d'un nouvel Personnel
</div>
<form action="<?php echo url("personnel", "saisie"); ?>" method="post" id="frmpersonnel" >
    <div class="page">
        <div class="tabs" style="width: 100%; background: #F7F7F7">
            <ul>
                <li id="tab1" class="courant">
                    <a onclick="onglets(1, 1, 3);">
                        <img border ="0" alt="" src="<?php echo SITE_ROOT . "public/img/icons/saisiepersonnel.png"; ?>" />
                        <?php echo __t("Informations g&eacute;n&eacute;rales"); ?></a>
                </li>
                <li id="tab2" class="noncourant">
                    <a onclick="onglets(1, 2, 3);">
                        <img border ="0" alt="" src="<?php echo SITE_ROOT . "public/img/icons/saisiepersonnelautreinfo.png"; ?>" />
                        <?php echo __t("Autres informations"); ?></a>
                </li>
                <li id="tab3" class="noncourant">
                    <a onclick="onglets(1, 3, 3);">
                        <img border ="0" alt="" src="<?php echo SITE_ROOT . "public/img/icons/photo.png"; ?>" />
                        <?php echo __t("Ajout d'une photo d'identit&eacute;"); ?>
                    </a>
                </li>
            </ul>
        </div>
        <div id="onglet1" class="onglet" style="display: block;height: 90%;background: #F7F7F7">
            <fieldset style="float: none; margin: auto; width: 700px;"><legend>Matricule</legend>
                <span class="text" style="width: 350px; margin-left: 165px;">
                    <label><?php echo __t("Matricule "); ?></label>
                    <input type="text" name="matricule" />
                </span>
            </fieldset>
            <fieldset style="width: 700px;float: none; margin: auto;"><legend> <?php echo __t("Identit&eacute;"); ?></legend>
                <span class="select" style="width: 150px;">
                    <label><?php echo __t("Civilit&eacute;"); ?></label>
                    <?php echo $civilite; ?>
                </span>
                <span class="text" style="width: 182px;">
                    <label> <?php echo __t("Nom"); ?> </label>
                    <input type="text" name="nom" maxlength="30"  />
                </span>
                <span class="text" style="width: 150px">
                    <label> <?php echo __t("Pr&eacute;nom"); ?></label>
                    <input type="text" name="prenom" maxlength="30" />
                </span>
                <span class="text" style="width: 150px">
                    <label><?php echo __t("Autre noms"); ?></label>
                    <input type="text" name="autrenom" maxlength="30" />
                </span>
                <span class="select" style="width: 150px;">
                    <label><?php echo __t("Fonction"); ?></label>
                    <?php echo $fonctions; ?>
                </span>
                <span class="text" style=" width: 350px;">
                    <label><?php echo __t("Grade"); ?></label>
                    <input type="text" class="grade" name="grade" maxlength="15" />
                </span>
                <span class="text" style="width: 150px;">
                    <label><?php echo __t("Date de Naissance"); ?></label>
                    <input type="text" id="datenaiss" name="datenaiss" />
                </span>
                <span class="text" style="width: 145px;margin-right: 22px">
                    <label><?php echo __t("Portable"); ?></label>
                    <input type="text" name="portable" maxlength="30" />
                </span>
                <span class="text" style="width: 182px;">
                    <label><?php echo __t("T&eacute;l&eacute;phone"); ?></label>
                    <input type="text" name="telephone"  maxlength="30"/>
                </span>
                <span class="text" style="width: 150px">
                    <label><?php echo __t("Email"); ?></label>
                    <input type="text" name="email" maxlength="30"/>
                </span>
                <span class="select" style="width: 155px;">
                    <label><?php echo __t("Sexe"); ?></label>
                    <select name="sexe">
                        <option value="M"><?php echo __t("Masculin"); ?></option>
                        <option value="F">F&eacute;minin</option>
                    </select>
                </span>   
            </fieldset>
        </div>
        <div id="onglet2" class="onglet" style="display: none;height: 90%; background: #F7F7F7">
            <fieldset style="width: 700px;float: none; margin: auto;"><legend> Autre</legend>
                <span class="select" style="width: 150px;">
                    <label><?php echo __t("Region d'origine"); ?></label>
                    <?php echo $region; ?>
                </span>
                <span class="select" style="width: 150px;">
                    <label><?php echo __t("D&eacute;partement"); ?></label>
                    <select name ="departement"><option value=""></option>
                        <option value="-1"><?php echo __t("Autre - Pr&eacute;ciser"); ?></option>
                    </select>
                </span>
                <span class="select" style="width: 150px;">
                    <label>Arrondissement</label>
                    <select name ="arrondissement"><option value=""></option>
                        <option value="-1">Autre - Pr&eacute;ciser</option>
                    </select>
                </span>
                <span class="text" style="width: 150px;">
                    <label><?php echo __t("Si&egrave;ge"); ?></label>
                    <input type="text" name="siege" />
                </span>
                <span class="select" style="width: 150px;">
                    <label><?php echo __t("Structure"); ?></label><select name="structure" >
                        <?php echo $structure; ?>
                    </select>
                </span>
                <span class="select" style="width: 150px;">
                    <label><?php echo __t("Dernier dipl&ocirc;me"); ?></label>
                    <?php echo $diplome; ?>
                </span>
                <span class="select" style="width: 150px;">
                    <label><?php echo __t("Cat&eacute;gorie"); ?></label>
                    <?php echo $categorie; ?>
                </span>
                <span class="text" style="width: 149px">
                    <label><?php echo __t("Sit. Indemnitaire"); ?></label>
                    <input type="text" name="indemnitaire" maxlength="30"/>
                </span>
                <span class="text" style="width: 145px; margin-right: 20px">
                    <label><?php echo __t("Ind. Solde"); ?></label>
                    <input type="text" name="solde" maxlength="30"/>
                </span>

                <span class="text" style="width: 145px; margin-right: 20px">
                    <label><?php echo __t("Ind. Carri&egrave;re"); ?></label>
                    <input type="text" name="carriere" maxlength="30"/>
                </span>

                <span class="text" style="width: 145px;margin-right: 20px">
                    <label><?php echo __t("R&eacute;f. texte nominatif"); ?></label>
                    <input type="text" name="reftexte" />
                </span>
                <span class="text" style="width: 149px">
                    <label><?php echo __t("Echelon"); ?></label>
                    <input type="text" name="echelon" maxlength="30"/>
                </span>
                <span class="select" style="width: 150px;">
                    <label><?php echo __t("Statut"); ?></label>
                    <?php echo $statut; ?>
                </span>
                <span class="select" style="width: 150px;">
                    <label>DMR/AMR</label>
                    <select name="dmramr">
                        <?php
                        for ($k = 2010; $k <= 2050; $k++) {
                            echo "<option value ='" . $k . "'>" . $k . "</option>";
                        }
                        ?>

                    </select>
                </span>   
                <span class="text" style="width: 145px">
                    <label><?php echo __t("Date dernier avancement"); ?></label>
                    <input type="text" id="dateavancement" name="dateavancement" />
                </span>
            </fieldset>
        </div>
        <div id="onglet3" class="onglet" style="display: none; height: 90%; background: #F7F7F7">
            <fieldset style = 'width: 400px; height: 270px;'><legend>Photo d'identit&eacute;</legend>
                <?php echo __t("photo_identity_description_staff"); ?>
                <input type="file" name="photo" maxlength="30" required="" style="margin: 0; padding: 0" />
                <div  style="position: relative; top: 10px; margin-right: 10px; clear: both;" class="navigation">
                    <div id="btn_photo_action"><?php echo btn_add("savePhotoPersonnel()"); ?>
                        <?php echo btn_effacer_disabled(""); ?>
                    </div>

                </div>
            </fieldset>

            <div id="photopersonnel" style="border: 1px solid #000; float: left;  position: relative;width: 200px; height: 200px;margin: 8px 20px;">

            </div>
        </div>
    </div>

    <div class="recapitulatif">
        <div class="errors">
            <?php
            if ($errors) {
                echo $message;
            }
            ?>
        </div>
    </div>
    <div class="navigation">
        <?php
        if (isAuth(502)) {
            echo btn_ok("submitForm();");
        }
  
         echo btn_cancel("document.location='" . Router::url("personnel") . "'");

        ?>
    </div>
    <input type="hidden" name="photopersonnel" value="" />
</form>
<div class="status"></div>
<?php
/**
 * Les dialog pour la saisie d'un nouvel etablissement
 */
?>
<div id="preciser-libelle-dialog-form" class="dialog" title="Pr&eacute;ciser le d&eacute;partement">
    <span><label>D&eacute;partement : </label>
        <input style="width: 100%" type="text" name="preciserdept" /></span>
</div>
<div id="preciser-arr-dialog-form" class="dialog" title="Pr&eacute;ciser l'arrondissement">
    <span><label>Arrondissement : </label>
        <input style="width: 100%" type="text" name="preciserarr" /></span>
</div>
<div id="preciser-ets-dialog-form" class="dialog" title="Pr&eacute;ciser la structure d'origine">
    <span><label>Structure : </label>
        <input style="width: 100%" type="text" name="preciserets" /></span>
</div>