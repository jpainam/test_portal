<?php
//var_dump($absences);
$colonnes = getNbHoraire($classe['GROUPE']);
echo "<input type='hidden' value ='true' name = 'deja' />";
?>
<table class="dataTable" cellpadding='0' id="tableAbsences<?php echo $jour; ?>">
    <thead><tr><th><?php echo __t("Noms et Pr&eacute;noms"); ?></th>
            <?php
            if (!empty($horaires)) {
                foreach ($horaires as $h) {
                    echo "<th>" . $h['HEUREDEBUT'] . "</th>";
                }
            }
            ?>
            ?>
            <th><img src="<?php echo img_phone_ring(); ?>" /></th>
        </tr></thead>
    <tbody>
        <?php
        $i = 1;
        foreach ($eleves as $el) {
            $nbNotification = 0;
            echo "<tr>";
            echo "<td>" . $el['NOM'] . " " . $el['PRENOM'] . "</td>";
            foreach ($horaires as $h) {
                $abs = estAbsent($el['IDELEVE'], $absences, $h['HEUREDEBUT']);
                if ($abs === null) {
                    echo "<td class='present'></td>";
                } elseif ($abs['ETAT'] === "A" && empty($abs['JUSTIFIER'])) {
                    echo "<td class='absent'></td>";
                } elseif ($abs['ETAT'] === "R" && empty($abs['JUSTIFIER'])) {
                    echo "<td class='retard'></td>";
                } elseif ($abs['ETAT'] === "E" && empty($abs['JUSTIFIER'])) {
                    echo "<td class='exclu'></td>";
                } elseif (!empty($abs['JUSTIFIER'])) {
                    echo "<td class='justifier'></td>";
                } else {
                    echo "<td></td>"; # Ne dois jamais arriver ici
                }
                if($abs !== null){
                    $nbNotification += $abs['NOTIFICATION'];
                }
            }
            # Pour l'envoi de SMS
            echo "<td align='center' title='Nombre de notification envoyee'>"
            . "<img style='cursor:pointer' src='" . img_phone_add() . "' "
                    . "onclick=\"notifyDailyAbsence(".$el['IDELEVE'].",".$appel['IDAPPEL'].",".$jour.")\" />(".$nbNotification.")</td>";

            echo "</tr>";
            $i++;
        }
        ?>
    </tbody>

</table>
<p style="color: #0033cc;margin: 0;padding: 0; text-align: right; margin-top: 5px; margin-right: 10px;">
    Appel d&eacute;j&agrave; r&eacute;alis&eacute; par <?php
    echo $appel['NOMREALISATEUR'] . " " . $appel['PRENOMREALISATEUR'];
    if (isAuth(320)) {
        echo "&nbsp;&nbsp;|&nbsp;&nbsp;Editer <a href='" . Router::url("appel", "edit", $appel['IDAPPEL']) . "'>ici</a>";
    }
    if (isAuth(324)) {
        echo "&nbsp;&nbsp;|&nbsp;&nbsp;Supprimer <a href='" . Router::url("appel", "delete", $appel['IDAPPEL']) . "'>ici</a>";
    }
    ?></p>
<script>
    $(document).ready(function () {
        if (!$.fn.DataTable.isDataTable("#tableAbsences<?php echo $jour; ?>")) {
            $("#tableAbsences<?php echo $jour; ?>").DataTable({
                bInfo: false,
                paging: false,
                searching: false,
                scrollY: $(".page").height() - 150
            });
        }
    });
</script>