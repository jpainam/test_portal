<table class="dataTable" id="tab_pp">
    <thead><tr><th><?php echo __t("Matricule "); ?></th><th><?php echo __t("Noms et Pr&eacute;noms"); ?></th><th></th></tr></thead>
    <tbody><tr><td>
                <?php
                echo $prof['MATRICULE'] . "</td><td>" . $prof['CNOM'] . "</td>
               <td align = 'center'><img style = 'cursor:pointer' src = '" . SITE_ROOT . "public/img/delete.png'"
                . " onclick = \"deletePrincipale(1);\"  />";
                ?>
            </td></tr></tbody>
</table>
<script>
    if (!$.fn.DataTable.isDataTable("#tab_pp")) {
        $("#tab_pp").DataTable({
            "paging": false,
            "bInfo": false,
            "scrollY": 100,
             "scrollCollapse": true,
            "searching": false,
            "columns": [
                {"width": "20%"},
                null,
                {"width": "5%"}
            ]
        });
    }
</script>