<table class="dataTable" id="tab_ra">
    <thead><tr><th><?php echo __t("Matricule "); ?></th><th><?php echo __t("Noms et Pr&eacute;noms"); ?></th><th></th></tr></thead>
    <tbody><tr><td>
                <?php
                echo $admin['MATRICULE'] . "</td><td>" . $admin['NOM'] ." " . $admin['PRENOM'] . "</td>
               <td align = 'center'><img style = 'cursor:pointer' src = '" . SITE_ROOT . "public/img/delete.png'"
                . " onclick = \"deletePrincipale(3);\"  />";
                ?>
            </td></tr></tbody>
</table>
<script>
    if (!$.fn.DataTable.isDataTable("#tab_ra")) {
        $("#tab_ra").DataTable({
            "paging": false,
            "bInfo": false,
            "scrollY": 100,
            "searching": false,
             "scrollCollapse": true,
            "columns": [
                {"width": "20%"},
                null,
                {"width": "5%"}
            ]
        });
    }
</script>