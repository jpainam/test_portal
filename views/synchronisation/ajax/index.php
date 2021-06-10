<table class="dataTable" id="synchronisationTable">
    <thead><tr><th>N°</th><th><?php echo __t("Description"); ?></th><th><?php echo __t("Date"); ?></th></tr></thead>
    <tbody>
        <?php
        $i = 1;
        $d = new DateFR();
        if (!empty($synchronisations)) {
            foreach ($synchronisations as $sync) {
                $d->setSource($sync['DATESYNCHRONISATION']);
                echo "<tr><td style='text-align:right'>" . $i . "</td>"
                . "<td>Synchronisation des données </td><td>"
                . $d->getDate() . " " . $d->getMois(3) . " " . $d->getYear() . " &agrave; " . $d->getTime() . "</td></tr>";
                $i++;
            }
        }
        ?>
    </tbody>
</table>
<script>
    $(document).ready(function () {
        if (!$.fn.DataTable.isDataTable("#synchronisationTable")) {
            $("#synchronisationTable").DataTable({
                "bInfo": false,
                "scrollY": $(".page").height() - 100,
                "searching": false,
                "paging": false,
                "columns": [
                    {"width": "15%"},
                   null,
                    {"width": "20%"}
                ]
            });
        }
    });
</script>