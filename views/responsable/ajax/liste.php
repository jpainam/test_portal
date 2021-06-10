<table class="dataTable" id="responsableTable">
    <thead><tr><th>Civ.</th><th><?php echo __t("Noms et Pr&eacute;noms"); ?></th><th><?php echo __t("Portable"); ?></th>
            <th><?php echo __t("T&eacute;l&eacute;phone"); ?></th><th><?php echo __t("Email"); ?></th><th></th></tr></thead>
    <tbody>
        <?php
        foreach ($responsables as $r) {
            echo "<tr><td>" . $r["CIVILITE"] . "</td><td>" . $r["CNOM"] . "</td><td>";
            echo $r["PORTABLE"] . "</td><td>" . $r["TELEPHONE"] . "</td><td>" . $r["EMAIL"] . "</td><td align='center'>";
            if (isAuth(317)) {
                echo "<img src='" . img_edit() . "' style='cursor:pointer' onclick=\"document.location='" . Router::url("responsable", "edit", $r['IDRESPONSABLE']) . "'\" />";
            } else {
                echo "<img src='" . img_edit_disabled() . "' style='cursor:pointer' />";
            }
            if (isAuth(318)) {
                echo "&nbsp;&nbsp;<img src='" . img_delete() . "' style='cursor:pointer' onclick='deleteResponsable(" . $r['IDRESPONSABLE'] . ")' />";
            } else {
                echo "&nbsp;&nbsp;<img style='cursor:pointer' src='" . img_delete_disabled() . "' />";
            }
            echo "</td></tr>";
        }
        ?>
    </tbody>
</table>
<script>
    $(document).ready(function () {
        if (!$.fn.DataTable.isDataTable("#responsableTable")) {
            $("#responsableTable").DataTable({
                "columns": [
                    {"width": "5%"},
                    null,
                    {"width": "10%"},
                    {"width": "10%"},
                    {"width": "10%"},
                    {"width": "10%"}
                ]
            });
        }
    });
</script>