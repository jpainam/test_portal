<?php
echo "<input type='hidden' name ='datedujour' value = '" . $datedujour . "' />";
echo "<input type='hidden' name='jour' value='" . $jour . "' />";
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
        </tr></thead>
    <tbody>
        <?php
        $i = 1;
        foreach ($eleves as $el) {
            $mat = $el['MATRICULE'];
            echo "<tr>";
            echo "<td>" . $el['NOM'] . " " . $el['PRENOM'] . "</td>";
            foreach ($horaires as $h) {
                echo "<td class='centrer'><select name='" . $mat . "_" . $h['HEUREDEBUT'] . "_" . $jour . "' onchange='choisir(this);'>"
                . "<option value=''></option>"
                . "<option value='A'>A</option>"
                . "<option value='R'>R</option>"
                . "<option value='E'>E</option>";
                echo "</select></td>";
            }
            echo "</tr>";
            $i++;
        }
        ?>
    </tbody>

</table>
<script>
    $(document).ready(function () {
        if (!$.fn.DataTable.isDataTable("#tableAbsences<?php echo $jour; ?>")) {
            $("#tableAbsences<?php echo $jour; ?>").DataTable({
                bInf: false,
                paging: false,
                searching: false,
                scrollY: $(".page").height() - 150

            });
        }
    });
</script>