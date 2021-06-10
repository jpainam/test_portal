<?php 
# droitTable -> tableNotesNonSaisie
?>
<table class="dataTable" id="droitTable">
    <thead><th><?php echo __t("P&eacute;riode"); ?></th><th><?php echo __t("Enseignants"); ?></th>
    <th><?php echo __t("Mati&egrave;res"); ?></th><th><?php echo __t("Coeff"); ?>.</th></thead>
<tbody>
    <?php
    foreach ($notesnonsaisies as $n) {
        echo "<tr><td>".$n['SEQUENCELIBELLE']."</td>";
        echo "<td>" . $n['NOM'] . " - " . $n['PRENOM'] . "</td>";
        echo "<td>". $n['MATIERELIBELLE'].'</td>';
        echo "<td align='right'>". $n['COEFF']."</td></tr>";
    }
    ?>
</tbody>
</table>
<script>
    $(document).ready(function () {
        if (!$.fn.DataTable.isDataTable("#droitTable")) {
            $("#droitTable").DataTable({
                scrollY: 600,
                columns: [
                    {"width": "15%"},
                    null,
                    null,
                    {"width": "5%"},
                ]
            });
        }
    });
</script>