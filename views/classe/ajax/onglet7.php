<table class="dataTable" id="tableOperation">
    <thead><tr><th><?php echo __t("Matricule "); ?></th><th><?php echo __t("Noms et Pr&eacute;noms"); ?></th>
            <th><?php echo __t("Sexe"); ?></th><th><?php echo __t("Date Naiss."); ?></th><th><?php echo __t("Redoublant"); ?></th></tr></thead>
    <tbody>
        <?php
        foreach ($nouveaux as $el) {
            $d = new DateFR($el['DATENAISS']);
            echo "<tr><td>" . $el['MATRICULE'] . "</td><td>" .  $el['NOM'] . ' ' . $el['PRENOM'] . "</td>";
            echo "<td align ='center'>" . $el['SEXE'] . "</td><td>" . $d->getDate() . " " . $d->getMois(3) . " " . $d->getYear() . "</td>";
            echo "<td align = 'center'>". $el['REDOUBLANTLBL']. "</td></tr>";
        }
        ?>
    </tbody>
</table>
<script>
    $(document).ready(function () {
        if (!$.fn.DataTable.isDataTable("#tableOperation")) {
            $("#tableOperation").DataTable({
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