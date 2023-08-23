<table class="dataTable" id="tableEleves">
    <thead><tr><th><?php echo __t("Matricule "); ?></th><th><?php echo __t("Noms et Pr&eacute;noms"); ?></th>
            <th><?php echo __t("Sexe"); ?></th><th><?php echo __t("Date Naiss."); ?></th><th><?php echo __t("Redoublant"); ?></th></tr></thead>
    <tbody>
        <?php
        
        if (!is_array($array_of_redoublants)) {
            $array_of_redoublants = array();
        }
        foreach ($eleves as $el) {
            $d = new DateFR($el['DATENAISS']);
            echo "<tr><td>" . $el['MATRICULE'] . "</td><td>" . $el['CNOM'] . "</td>";
            echo "<td align ='center'>" . $el['SEXE'] . "</td><td>" . $d->getDate() . " " . $d->getMois(3) . " " . $d->getYear() . "</td>";
            if (in_array($el['IDELEVE'], $array_of_redoublants)) {
                echo "<td align = 'center'><input type = 'checkbox' disabled checked /></td></tr>";
            } else {
                echo "<td align = 'center'><input type = 'checkbox' disabled /></td></tr>";
            }
        }
        ?>
    </tbody>
</table>
<script>
    $(document).ready(function () {
        if (!$.fn.DataTable.isDataTable("#tableEleves")) {
            $("#tableEleves").DataTable({
                bInfo: false,
                paging: false,
                "columns": [
                    {"width": "7%"},
                    null,
                    {"width": "5%"},
                    {"width": "13%"},
                    {"width": "7%"}
                ]
            });
        }
    });
</script>