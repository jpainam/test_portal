<div id="entete" style="text-align: center">
    <h3><?php echo __t("SAUVEGARDE DE LA BASE DE DONNEES"); ?> <br/><?php echo __t("DANS LE DOSSIER BACKUPS"); ?></h3>
</div>
<div class="page">
    <table class="dataTable" id="sauvegardeTable">
        <thead><tr><th>N°</th><th><?php echo __t("Description"); ?></th><th><?php echo __t("Taille"); ?></th>
                <th></th><th></th></tr></thead>
        <tbody>
            <?php
            $i = 1;
            $d = new DateFR();
            if (!empty($sauvegardes)) {
                foreach ($sauvegardes as $save) {
                    $d->setSource($save['DATESAUVEGARDE']);
                    echo "<tr><td style='text-align:center'>" . $i . "</td><td>Sauvegarde des données " . $save['DESCRIPTION'] . " : "
                    . $d->getDate() . " " . $d->getMois(3) . " " . $d->getYear() . " &agrave; " . $d->getTime() . "</td>"
                    . "<td style='text-align:right'>" . substr(moneyString($save['TAILLE']), 0, -3) . "KB</td>"
                    . "<td style='text-align:center'>"
                    . "<img  title='Telecharger cette sauvegarde' style='cursor:pointer' "
                            . "onclick='telechargerSauvegarde(" . $save['IDSAUVEGARDE'] . ")' src='" . img_download() . "' />"
                    . "&nbsp;&nbsp;&nbsp;<img title='Restaurer cette sauvegarde' src='" . img_restaure() . "' style='cursor:pointer' "
                            . "onclick='restaurerSauvegarde(" . $save['IDSAUVEGARDE'] . ")' /></td>"
                    . "<td style='text-align:center'><img style='cursor:pointer' onclick='supprimerSauvegarde(" . $save['IDSAUVEGARDE'] . ")' src='" . img_delete() . "'>"
                    . "</td></tr>";
                    $i++;
                }
            }
            ?>
        </tbody>
    </table>
    <div style="margin: 10px;text-align: center">
        <input style="width: 350px; border: 2px outset buttonface; margin:0" type="button" 
               value="<?php echo __t("Effectuer une nouvelle sauvegarde"); ?>" onclick="nouvelleSauvegarde()"/>
    </div>
</div>
<div class="recapitulatif">

</div>
<div class="navigation">

</div>
<div class="status"></div>