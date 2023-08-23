<?php
# Permet d'afficher un formulaire grisee pour les jours feries et fermer

$colonnes = getNbHoraire($classe['GROUPE']);
echo "<input type='hidden' value ='true' name = 'freedays' />";
?>
<table class="dataTable" cellpadding='0' id="tableAbsences<?php echo $jour; ?>">
    <thead><tr><th><?php echo __t("Noms et Pr&eacute;noms"); ?></th>
            <?php
            if (!empty($horaires)) {
                foreach ($horaires as $h) {
                    echo "<th>" . $h['HEUREDEBUT'] . "</th>";
                }
            }
            ?>
        </tr></thead>
    <tbody>
        <?php
        $i = 1;
        foreach ($eleves as $el) {
            echo "<tr>";
            echo "<td>" . $el['NOM'] . " " . $el['PRENOM'] . "</td>";
            foreach ($horaires as $h) {
                echo "<td class='freedays'>&nbsp;</td>";
            }

            echo "</tr>";
            $i++;
        }
        ?>
    </tbody>

</table>
<p style="color: #ff0033;margin: 0;padding: 0; text-align: right; margin-top: 5px; margin-right: 10px;">
    Appel impossible &agrave; r&eacute;aliser dans un jour non ouvrable
</p>
<script>
    $(document).ready(function () {
        if (!$.fn.DataTable.isDataTable("#tableAbsences<?php echo $jour; ?>")) {
            $("#tableAbsences<?php echo $jour; ?>").DataTable({
                bInfo: false,
                paging: false,
                searching: false,
                scrollY: $(".page").height() - 150

            });
        }
    });
</script>