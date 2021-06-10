
<table class="dataTable" id="cahierTable">
    <thead><tr><th><?php echo __t("Date"); ?></th><th><?php echo __t("Heures"); ?></th><th><?php echo __t("Objectif"); ?></th>
            <th><?php echo __t("Description"); ?></th><th></th></tr></thead>
    <tbody>
        <?php
        if (isset($cahier)) {
            foreach ($cahier as $c) {
                echo "<tr><td>" . date("d/m/Y", strtotime($c['DATESAISIE'])) . "</td><td>";
                echo $c['HEUREDEBUT'] . "-" . $c['HEUREFIN'] . "</td><td>" . $c['OBJECTIF'] . "</td>";
                echo "<td>" . $c['CONTENU'] . "</td><td align='center'>"
                . "<img src='" . img_delete() . "' onclick='deleteCahier(" . $c['IDCAHIERTEXTE'] . ")' "
                . "style='cursor:pointer' /></td></tr>";
            }
        }
        ?>
    </tbody>
</table>
<script>
    $(document).ready(function () {
        if (!$.fn.DataTable.isDataTable("#cahierTable")) {
            $("#cahierTable").DataTable({
                bInfo: false,
                searching: false,
                paging: false,
                columns: [
                    {"width": "10%"},
                    {"width": "10%"},
                    null,
                    null,
                    {"width": "5%", orderable: false}
                ]
            });
        }
    });

</script>