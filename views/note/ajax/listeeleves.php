<table class="dataTable" id="eleveTable">
    <thead><th><?php echo __t("Matricule "); ?></th><th><?php echo __t("Noms et Pr&eacute;noms"); ?></th><th><?php echo __t("Note"); ?></th>
    <!-- th>Absent</th -->
    <th><?php echo __t("Non not&eacute;"); ?></th><th><?php echo __t("Observations"); ?></th></thead>
<tbody>
    <?php
        foreach ($eleves as $el) {
            echo "<tr><td>" . $el['MATRICULE'] . "</td><td>" . $el['NOM'] . " " . $el['PRENOM'] . "</td>";
            echo "<td align = 'center'>"
             . "<input style=\"text-align: right\" onKeyUp = \"noter('" . $el['IDELEVE'] . "');\" type = 'text' "
        . "name = 'note_" . $el['IDELEVE'] . "' size = '2' onBlur=\"check_note('" . $el['IDELEVE'] . "');\" /></td>";
                    //. "<input style=\"text-align: right\"  type = 'text' name = 'note_" . $el['IDELEVE'] . "' size = '2' /></td>";
            //echo "<td align = 'center'><input type = 'checkbox' name = 'absent_" . $el['IDELEVE'] . "' /></td>";
            echo "<td align = 'center'><input type = 'checkbox' checked='checked' name='nonNote_" . $el['IDELEVE'] . "' /></td>";
            echo "<td align = 'center'><input type = 'text' size = '30' name = 'observation_" . $el['IDELEVE'] . "' /></td></tr>";
        }
    ?>
</tbody>
</table>
<script>
    $(document).ready(function () {
        $('#eleveTable input[type="text"]').keydown(function (e) {
            if (e.keyCode === 40) {
                //$(this).next('input[type=text]').focus();
                var td = $(this).parent();
                var tr = td.parent();
                tr = tr.next();
                td = tr.children("td")[2];
                //console.log(td);
                var input = $(td).children("input");
                console.log(input);
                input.focus();
            } else if (e.keyCode === 38) {
                //$(this).prev('input[type=text]').focus();
                var td = $(this).parent();
                var tr = td.parent();
                tr = tr.prev();
                td = tr.children("td")[2];
                //console.log(td);
                var input = $(td).children("input");
                console.log(input);
                input.focus();
            }
        });
        if (!$.fn.DataTable.isDataTable("#eleveTable")) {
            $("#eleveTable").DataTable({
<?php
if ($deja) {
    echo "scrollY : 500,";
}
?>
                columns: [
                    {"width": "10%"},
                    null,
                    {"width": "7%"},
                    {"width": "10%"},
                    {"width": "30%"}
                ]
            });
        }
    });
</script>