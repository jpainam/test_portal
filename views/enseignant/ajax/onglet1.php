<style>
    .photo-prof{
        position: absolute;
        display: block;
        width: 120px;
        height: 120px;
        right: 0;
        margin-right: 20px;
        margin-top: 5px;
        border: 1px solid #CCC;
        background-color: #F7F7F7;
        border-radius: 5px;
        text-align: center;
        vertical-align: middle;
        line-height: 100px;
    }
    .fiche table td{
        border-bottom: 1px solid #000;
    }
</style>
<div class="fiche">
    <fieldset  style="width: 95%;float: none;margin: auto; margin-top: 20px"><legend><?php echo __t("Identit&eacute;"); ?></legend>
        <img src="<?php echo SITE_ROOT . "public/photos/personnels/" . $personnel['PHOTO']; ?>" alt="Photo Prof" class="photo-prof">
        <table cellpadding = "3" style="width: 620px;">
            <tr><td style="font-weight: bold"><?php echo __t("Civilit&eacute;"); ?> : </td>
                <td><?php echo $personnel['CIVILITE']; ?></td>
                <td style="font-weight: bold"><?php echo __t("Matricule "); ?> : </td>
                <td><?php echo $personnel['MATRICULE']; ?></td></tr>
            <tr><td style="font-weight: bold"><?php echo __t("Nom"); ?> : </td><td><?php echo $personnel['NOM']; ?></td>
                <td style="font-weight: bold"><?php echo __t("Pr&eacute;noms"); ?> : </td><td><?php echo $personnel['PRENOM'] . ' ' . $personnel['AUTRENOM']; ?></td></tr>
            <tr><td style="font-weight: bold"><?php echo __t("Fonction"); ?> : </td><td><?php echo $personnel['FK_FONCTION']; ?></td>
                <td style="font-weight: bold"><?php echo __t("Grade"); ?> : </td><td><?php echo $personnel['GRADE']; ?></td></tr>
            <tr><td style="font-weight: bold"><?php echo __t("Sexe"); ?> : </td><td><?php
                    if ($personnel['SEXE'] == "M") {
                        echo __t("Masculin");
                    } else {
                        echo __t("F&eacute;minin");
                    }
                    ?></td>
                <td style="font-weight: bold"><?php echo __t("Date de Naiss."); ?> : </td><td><?php
                    $d = new DateFR($personnel['DATENAISS']);
                    if ($d->getYear() != 1970) {
                        echo $d->getDate() . " " . $d->getMois(3) . " " . $d->getYear();
                    }
                    ?></td>
            </tr>
            <tr><td style="font-weight: bold"><?php echo __t("Portable"); ?> : </td><td><?php echo $personnel['PORTABLE']; ?></td>
                <td style="font-weight: bold"><?php echo __t("T&eacute;l&eacute;phone"); ?> : </td><td><?php echo $personnel['TELEPHONE']; ?></td>
            </tr>
            <tr><td style="font-weight: bold"><?php echo __t("Email"); ?> : </td><td><?php echo $personnel['EMAIL']; ?></td>
                <td style="font-weight: bold"><?php echo __t("Dipl&ocirc;me"); ?> : </td><td><?php echo $personnel['FK_DIPLOME']; ?></td>
            </tr>
        </table>
    </fieldset>
    <fieldset style="width: 95%;float: none; margin: auto;margin-top: 20px"><legend><?php echo __t("Autres informations"); ?></legend>
        <table cellpadding = "3">
            <tr><td><b><?php echo __t("Si&egrave;ge"); ?> : </b></td><td><?php echo $personnel['SIEGE']; ?></td>
                <td><b><?php echo __t("Structure"); ?> : </b></td><td><?php echo $personnel['FK_STRUCTURE']; ?></td></tr>
            <tr><td><b><?php echo __t("Cat&eacute;gorie"); ?> : </b></td><td><?php echo $personnel['FK_CATEGORIE']; ?></td>
                <td><b><?php echo __t("Sit. Indemnitaire"); ?> : </b></td><td><?php echo $personnel['INDEMNITAIRE']; ?></td></tr>
            <tr><td><b><?php echo __t("Ind. Solde"); ?> : </b></td><td><?php echo $personnel['SOLDE']; ?></td>
                <td><b><?php echo __t("Ind. Carri&egrave;re"); ?>: </b></td><td><?php echo $personnel['CARRIERE']; ?></td></tr>
            <tr><td><b><?php echo __t("Texte Nominatif"); ?> : </b></td><td><?php echo $personnel['NOMINATIF']; ?></td>
                <td><b><?php echo __t("Echelon"); ?> : </b></td><td><?php echo $personnel['ECHELON']; ?></td></tr>
            <tr><td><b><?php echo __t("Statut"); ?> : </b></td><td><?php echo $personnel['FK_STATUT']; ?></td>
                <td><b>DMR/AMR : </b></td><td><?php echo $personnel['DMR']; ?></td></tr>
            <tr><td colspan="2"><b><?php echo __t("Date dernier avancement"); ?> : </b></td><td>
                    <?php
                    $d->setSource($personnel['AVANCEMENT']);
                    if ($personnel['AVANCEMENT'] != "0000-00-00" && $d->getYear() != 1970 && $d->getYear() != "0001") {
                        echo $d->getDate() . " " . $d->getMois(3) . " " . $d->getYear();
                    }
                    ?></td>
                <td></td>
            </tr>
            <tr><td colspan="4">
                    <b><?php echo __t("R&eacute;gion"); ?> : </b> <?php echo $personnel['FK_REGION']; ?> /
                    <b><?php echo __t("D&eacute;partement"); ?> : </b> <?php echo $personnel['FK_DEPARTEMENT']; ?> /
                    <b><?php echo __t("Arrondissement"); ?> : </b><?php echo $personnel['FK_ARRONDISSEMENT']; ?>
                </td>
            </tr>
        </table>

    </fieldset>
</div>