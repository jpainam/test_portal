<table class="dataTable" style="margin: auto" id="tableOperation">
    <thead><tr><th><?php echo __t("Date"); ?></th><th><?php echo __t("Libell&eacute;"); ?></th><th></th></tr></thead>
    <tbody>
        <?php
        foreach ($feries as $f) {
            echo "<tr><td>" . date("d/m/Y", strtotime($f['DATEFERIE'])) . "</td><td>" . $f['LIBELLE'] . "</td>";
            echo "<td align='center'>";
            if(isAuth(548)){
                echo "<img src='" . img_delete() . "' style='cursor:pointer' onclick='deleteFerie(" . $f['IDFERIE'] . ")' />";
            }else{
                echo "<img src='".img_delete_disabled()."' style='cursor:pointer' />";
            }
            echo "</td></tr>";
        }
        ?>
    </tbody>
</table>

<script>
    $(document).ready(function () {
        if (!$.fn.DataTable.isDataTable("#tableOperation")) {
            $("#tableOperation").DataTable({
                "paging": false,
                "bInfo": false,
                "scrollCollapse": true,
                "scrollY": 300,
                "searching": false,
                "columns": [
                    {"width": "15%"},
                    null,
                    {"width": "5%"}
                ]
            });
        }
    });
</script>