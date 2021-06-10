<div id="entete">
    <div class="logo"><img src="<?php echo SITE_ROOT . "public/img/wide_etablissement.png"; ?>" /></div>
    <span style="margin-left: 100px; margin-top: 10px; width: 550px; display: inline-block">
        <h2><?php echo __t("SYST&Egrave;ME DE GESTION DE L'INFORMATION SCOLAIRE"); ?></h2>
    </span>
    <span style="margin-left: 50px; clear: both;">
        <!-- Y mettre le calendrier -->
    </span>
</div>
<div class="titre"></div>
<div class="page" style="font-size: 14px; font-family: arial;">
    <div id="indexPage">
        <fieldset style="width: 90%; margin-left: auto; margin-right: auto;">
            <legend style="text-align: center"><?php echo __t("Informations de l'&eacute;tablissement"); ?></legend>

            <span><?php echo __t($school['MINISTERE']); ?></span>
            <span>*************</span>
            <span><?php echo __t($school['REGION']); ?></span>
            <span>*************</span>
            <span><?php echo __t($school['DEPARTEMENT']); ?></span>
            <span>*************</span>
            <span style="font-weight: bold;"><?php echo $school['NOM']; ?></span>
            <span style="font-style: oblique;"><?php echo __t("Autorisation d'ouverture");
echo $school['AUTORISATION']; ?></span>
            <span><?php echo __t("BP"); ?> : <?php echo $school['BP']; ?> </span>
            <span><?php echo __t("T&eacute;l&eacute;phone") . ": " . $school['TELEPHONE']; ?> </span>
            <span><address><?php echo __t("Email") . ": " . $school['EMAIL']; ?></address></span>
            <span><em><?php echo $school['SITEWEB']; ?></em></span> 
        </fieldset>
        <fieldset style="width: 90%; margin: auto;"><legend style="text-align: center"><?php echo __t("Nous contacter"); ?></legend>
            <span style="text-align: left; font-weight: bold; margin-bottom: 10px;"><?php echo __t("Vous pouvez contacter les concepteurs du syst&egrave;me"); ?> : </span>
            <span style="text-align: left"> <?php echo __t("De Lundi &agrave; Vendredi"); ?>
<?php echo __t("de 9h00 &agrave; 17h00"); ?></span>
            <span style="font-weight: bold; text-align: left; margin-bottom: 10px"><?php echo __t("Par t&eacute;l&eacute;phone"); ?>:
                +237 699 01 17 66 / +237 677 88 77 04</span>
            <span style="text-align: left"><?php echo __t("Par E-mail"); ?>
                <a href="mailto:businessedis9@gmail.com">businessedis9@gmail.com</a><br/>
                <br/>
<?php echo __t("Nous envoyer un message"); ?> : <a href="<?php echo Router::url("notification", "envoi"); ?>" >Envoyer</a>
            </span>

        </fieldset>
    </div>
</div>
<div class="recapitulatif"></div>
<div class="navigation">
</div>
<div class="status" style="padding: 2px;"><?php echo $infos; ?> | @ BAACK CORPORATION</div>
<script>
    $(document).ready(function () {
<?php
if (isset($errors)) {
    if ($errors) {
        echo "alertWebix('Une erreur est survenue lors de l\'envoi');";
    } else {
        echo "alertWebix('Message envoy&eacute; avec succ&egraves;');";
    }
}
?>
    });
</script>
