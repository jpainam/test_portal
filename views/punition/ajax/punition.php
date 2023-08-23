<table class="dataTable" id="punitionTable">
    <thead><th><?php echo __t("Date"); ?></th><th><?php echo __t("El&egrave;ves"); ?></th>
    <th><?php echo __t("Puni par"); ?></th><th><?php echo __t("Type"); ?></th><th><?php echo __t("Motif"); ?></th>
    <th><?php echo __t("Dur&eacute;e"); ?></th><th></th></thead>
<tbody>
    <?php
    foreach ($punitions as $p) {
        $d = new DateFR($p['DATEPUNITION']);
        echo "<tr><td>" . $d->getDate() . " " . $d->getMois(3) . " " . $d->getYear() . "</td><td>" . $p['NOM'] . " " . $p['PRENOM'] . "</td>";
        echo "<td>" . $p['PUNISSEUR'] . "</td><td>" . $p['LIBELLE'] . "</td><td>" . $p['MOTIF'] . "</td><td>" . $p['DUREE'] . "</td>";
        //echo "<td><img style ='cursor:pointer' src = '" . img_edit() . "' />&nbsp;&nbsp;";
        echo "<td><img style ='cursor:pointer' src = '" . img_delete() . "' onclick=\"supprimerPunition('".$p['IDPUNITION']."')\" />&nbsp;&nbsp;";
        echo "<img style ='cursor:pointer' src = '" . img_print() . "' onclick = \"printPunition('".$p['IDPUNITION']."')\" />&nbsp;"
                . "<img style='cursor:pointer' src='" . img_phone_add() . "' "
                    . "onclick=\"sendNotification(".$p['IDPUNITION'].")\" />". $p['NOTIFIER']."</td></tr>";
    }
    ?>
</tbody>
</table>
<script>
$(document).ready(function(){
     if (!$.fn.DataTable.isDataTable("#punitionTable")) {
        $("#punitionTable").DataTable({
            "bInfo": false,
            "columnDefs": [
                {"width": "10%", "targets": 0},
                {"width": "7%", "targets": 5},
                 {"width": "12%", "targets": 3},
                {"width": "10%", "targets": 6}
            ]
        });
    }
});
</script>