<style>
    .photo-eleve{
        position: absolute;
        display: block;
        width: 130px;
        height: 150px;
        right: 0;
        margin-right: 20px;
        margin-top: 2px;
        border: 1px solid #CCC;
        background-color: #F7F7F7;
        border-radius: 5px;
        text-align: center;
        vertical-align: middle;
        line-height: 150px;
    }
</style>
<div class="fiche">
    <fieldset  style="width: 80%;float: none; margin: auto;margin-top: 20px"><legend><?php echo __t("Identit&eacute;"); ?></legend>
        <img src="<?php echo $photo; ?>" alt="Photo eleve" class="photo-eleve">
        <table cellpadding = "5">
            <tr><td width = "25%" style="font-weight: bold"><?php echo __t("Nom"); ?> : </td><td><?php echo $nom; ?></td></tr>
            <tr><td style="font-weight: bold"><?php echo __t("Pr&eacute;nom"); ?> : </td><td><?php echo $prenom; ?></td></tr>
            <tr><td style="font-weight: bold"><?php echo __t("Sexe"); ?> : </td><td><?php echo $sexe; ?></td></tr>
            <tr><td style="font-weight: bold"><?php echo __t("Lieu de r&eacute;sidence");?> : </td><td><?php echo $residence; ?></td></tr>
            <?php
            $d = new DateFR($datenaiss);
            ?>
            <tr><td style="font-weight: bold"><?php echo __t("Date de Naissance"); ?> : </td>
                <td><?php echo $d->getDate() . " " . $d->getMois(3) . " " . $d->getYear(); ?> &agrave; <?php echo $lieunaiss; ?></td></tr>
            <tr><td style="font-weight: bold"><?php echo __t("Pays de Naissance"); ?> : </td><td><?php echo $paysnaiss; ?>
                    &nbsp;&nbsp;&nbsp;<b><?php echo __t("Pays de nationalit&eacute;"); ?> : </b><?php echo $nationalite; ?></td></tr>
            <tr><td style="font-weight: bold"><?php echo __t("Fr&egrave;res et s&oelig;urs"); ?> : </td><td><?php echo $freresoeur; ?></td></tr>
        </table>
    </fieldset>
    <fieldset style="width: 80%;float: none; margin: auto;margin-top: 20px"><legend>Scolarité actuelle</legend>
        <table cellpadding = "5">
            <tr><td  width = "25%" style="font-weight: bold"><?php echo __t("Classe"); ?> : </td><td><?php
                    echo $niveau . " " . $classe;
                    if (!empty($classe)) {
                        echo "&nbsp;&nbspinscrit par " . $inscripteur['CIVILITE'] . " " . $inscripteur['NOM'];
                    }
                    ?></td></tr>
            <tr><td style="font-weight: bold"><?php echo __t("Redoublant"); ?> : </td><td><?php echo $redoublant === true ? 
                    __t("Oui") : __t("Non").
                    "&nbsp;".__t("et") . ' ';
                    if (isset($nbInscription) && !empty($nbInscription)) {
                        if ($eleve['PROVENANCE'] == ETS_ORIGINE) {
                            echo __t("Ancien");
                        } else {
                            echo __t("Nouveau");
                        }
                    } else {
                        echo __t("Ancien");
                    }
                    ?></td></tr>
            <?php
            $d->setSource($dateentree);
            ?>
            <tr><td style="font-weight: bold"><?php echo __t("Date d'entr&eacute;e") ?>: </td>
                <td><?php
                    if (!empty($dateentree) && $dateentree != "0000-00-00" && $d->getYear() != 1970) {
                        echo $d->getDate() . " " . $d->getMois(3) . " " . $d->getYear();
                    }
                    ?></td></tr>
            <tr><td style="font-weight: bold"><?php echo __t("Provenance"); ?> : </td><td><?php echo $provenance; ?></td></tr>
            <?php
            $d->setSource($datesortie);
            ?>
            <tr><td style="font-weight: bold"><?php echo __t("Date de sortie"); ?> : </td><td>
                    <?php
                    if (!empty($datesortie) && $datesortie != "0000-00-00" && $d->getYear() != 1970) {
                        echo $d->getDate() . " " . $d->getMois(3) . " " . $d->getYear();
                    }
                    ?>
                </td></tr>
            <tr><td style="font-weight: bold"><?php echo __t("Motif sortie"); ?> : </td><td><?php echo $motifsortie; ?></td></tr>
        </table>

    </fieldset>
</div>
<div style="margin: 10px;text-align: center" id="btn_sync_eleve">
    <input style="width: 350px; border: 2px outset buttonface; margin:0" type="button" 
           value="<?php echo __t("Synchroniser cet &eacute;l&egrave;ve"); ?>" onclick="synchroniserEleve()"/>
</div>