<table class="dataTable" id="tableAbsences5">
    <thead>
        <tr><th>Date</th><th><?php echo __t("Elèves"); ?></th>
            <th><?php echo __t("Description"); ?></th>
            <th><?php echo __t("Montant"); ?></th>
            <th><?php echo __t("Status"); ?></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $d = new DateFR();
        foreach ($bligatoires as $f) {
            $d->setSource($f['DATETRANSACTION']);
            echo "<tr><td>" . $d->getDateMessage(3) . "</td><td>" . $f['DESCRIPTION'] . "</td><td>" . $f['MONTANT'] . "</td>";
             if ($f['VALIDE'] == 0) {
                echo "<td style='background-color:#ff9999' align='center'>En cours</td>";
            } else {
                echo "<td style='background-color:#99ff99' align='center'>Valid&eacute;e</td>";
            }
             if(peutSupprimerEleveFraisObligatoire() && isAuth(554)){
                echo "&nbsp;|&nbsp;<img style='cursor:pointer' src='" . SITE_ROOT . "public/img/icons/annuler.png' title='Supprimer ce payement' "
                        . "onclick='supprimerFraisObligatoire(".$f['IDELEVEFRAIS'].");' />";
            }else{
                echo "&nbsp;|&nbsp;<img src='".img_delete_disabled()."' />";
            }
            echo "</td></tr>";
        }
        ?>
    </tbody>
</table>
<script>
    $(document).ready(function () {
        if (!$.fn.DataTable.isDataTable("#tableAbsences5")) {
            $("#tableAbsences5").DataTable({
                scrollY: $(".page").height() - 175,
                columns: [
                    {"width": "7%"},
                    null,
                    {"width": "15%"},
                    null,
                    {"width": "8%"},
                    {"width": "8%"},
                ]
            });
        }
    });
</script>