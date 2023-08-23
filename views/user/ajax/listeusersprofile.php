<table id="tableusers" class="dataTable">
    <thead>
        <tr><th></th><th>Noms et Pr&eacute;noms</th><th><input type="checkbox" name="chk_all_users" /></th></tr>
    </thead>
    <tbody>
        <?php 
        foreach($usersprofile as $u){
            echo "<tr><td>".$u['CIVILITE']."</td><td>".$u['NOM']." ".$u['PRENOM']."</td><td align='center'>"
                    . "<input type='checkbox' name='usersprofile[]' value = '" . $u['USER'] . "' checked='checked' /></tr>";
        }
        ?>
    </tbody>
</table>
<script>
    $(document).ready(function () {
        if(!$.fn.DataTable.isDataTable("#tableusers")){
            $("#tableusers").DataTable({
               bInfo: false,
               paging: false,
               columns : [
                   {"width" : "5%"},
                   null,
                    {"width" : "7%", orderable: false}
               ]
            });
        }
        $("input[name=chk_all_users]").change(function () {
            if ($(this).is(":checked")) {
                $("input[name='usersprofile[]']").each(function () {
                    $(this).attr('checked', true);
                });
            } else {
                 $("input[name='usersprofile[]']").each(function () {
                    $(this).attr('checked', false);
                });
            }
        });
    });
</script>