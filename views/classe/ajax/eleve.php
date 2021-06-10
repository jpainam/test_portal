<table class="dataTable" id="tab_elv">
    <thead><tr><th><?php echo __t("Matricule "); ?></th><th><?php echo __t("Noms et Pr&eacute;noms"); ?></th><th></th></tr></thead>
    <tbody>
        <?php
        foreach ($eleves as $eleve) {
            echo "<tr><td>" . $eleve['MATRICULE'] . "</td><td>" . $eleve['CNOM'] . "</td>
               <td align = 'center'><img style = 'cursor:pointer' src = '" . SITE_ROOT . "public/img/delete.png'"
            . " onclick = \"desinscrire('" . $eleve['IDINSCRIPTION'] . "');\"  /></td></tr>";
        }
        ?>
    </tbody>
</table>
<script>
    if (!$.fn.DataTable.isDataTable("#tab_elv")) {
        $('#tab_elv').DataTable({
            "paging": false,
            "bInfo": false,
            "scrollY": 300,
            "columns": [
                {"width": "20%"},
                null,
              {"width": "5%"}
            ]
        });
    }
</script>