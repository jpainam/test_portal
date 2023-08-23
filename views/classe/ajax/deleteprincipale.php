<script>
    if (!$.fn.DataTable.isDataTable("#tab_pp")) {
        $('#tab_pp').DataTable({
            "paging": false,
            "bInfo": false,
            "searching": false,
            "scrollCollapse": true,
            "columns": [
                {"width": "20%"},
                null,
                {"width": "5%"}
            ]
        });
    }
    if (!$.fn.DataTable.isDataTable("#tab_ra")) {
        $("#tab_ra").DataTable({
            "paging": false,
            "bInfo": false,
            "searching": false,
            "scrollCollapse": true,
            "columns": [
                {"width": "20%"},
                null,
                {"width": "5%"}
            ]
        });
    }
    if (!$.fn.DataTable.isDataTable("#tab_cpe")) {
        $("#tab_cpe").DataTable({
            "paging": false,
            "bInfo": false,
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

<table class="dataTable" id="<?php echo $tableid; ?>">
    <thead><tr><th><?php echo __t("Matricule "); ?></th><th><?php echo __t("Noms et Pr&eacute;noms"); ?></th><th></th></tr></thead>
    <tbody>
    </tbody>
</table>