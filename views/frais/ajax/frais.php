<table class="dataTable" id="fraisTable">
    <thead><tr><th><?php echo __t("Description"); ?></th><th><?php echo __t("Montant"); ?></th>
            <th><?php echo __t("Ech&eacute;ances"); ?></th><th></th></tr></thead>
    <tbody>
        <?php 
        $montanttotal = 0;
        if(isset($frais) && is_array($frais)){
            foreach ($frais as $f) {
                $montanttotal += $f['MONTANT'];
                $d = new DateFR($f['ECHEANCES']);
                $echeance = $d->getJour(3) . " " . $d->getDate() . "-" . $d->getMois() . "-" . $d->getYear();
                echo "<tr><td>" . $f['DESCRIPTION'] . "</td><td align='right'>" . moneyString($f['MONTANT']) . "</td><td>" . $echeance . "</td>"
                . "<td align = 'center'>";
                if (isAuth(510)) {
                    echo "<img style = 'cursor:pointer' src = \"" . SITE_ROOT . "public/img/delete.png\" "
                    . "onclick = \"supprimerFrais('" . $f['IDFRAIS'] . "')\" />&nbsp;&nbsp;";
                }
                if (isAuth(511)) {
                    echo "<img id = 'img-edit' style = 'cursor:pointer' src = '" . img_edit() . "'  "
                    . "onclick = \"openEditForm('" . $f['IDFRAIS'] . "')\" />";
                    # Ajout des input hidden pour la modification
                    echo "<input type='hidden' name='description" .$f['IDFRAIS']."' value='".$f['DESCRIPTION']."' />";
                    echo "<input type='hidden' name='montant" . $f['IDFRAIS']."' value ='".$f['MONTANT']."' />";
                    echo "<input type='hidden' name='echeances" . $f['IDFRAIS']."' value='".$f['ECHEANCES']."' />";
                    echo "<input type='hidden' name='obligatoire" . $f['IDFRAIS']."' value='0' />";
                     echo "<input type='hidden' name='codefrais" . $f['IDFRAIS']."' value='' />";
                }
                echo "</td></tr>";
            }
        echo "<tr style='background-color:#F0EBA9'><td>TOTAL</td><td align='right'>".  moneyString($montanttotal)."</td><td><td></tr>";
        }
        # Print frais obligatoires
        if(isset($fraisobligatoires) && is_array($fraisobligatoires)){
            foreach($fraisobligatoires as $f){
                echo "<tr><td>" . $f['DESCRIPTION']."</td><td align='right'>" . moneyString($f['MONTANT']) . "</td>"
                        . "<td>*" . __t("Obligatoire") . "</td>";
                echo "<td align = 'center'>";
                if (isAuth(510)) {
                    echo "<img style = 'cursor:pointer' src = \"" . SITE_ROOT . "public/img/delete.png\" "
                    . "onclick = \"supprimerFrais('" . $f['IDFRAISOBLIGATOIRE'] . "O')\" />&nbsp;&nbsp;";
                }
                if (isAuth(511)) {
                    echo "<img id = 'img-edit' style = 'cursor:pointer' src = '" . img_edit() . "'  "
                    . "onclick = \"openEditForm('" . $f['IDFRAISOBLIGATOIRE'] . "O')\" />";
                    # Ajout des input hidden pour la modification
                    echo "<input type='hidden' name='description" .$f['IDFRAISOBLIGATOIRE']."O' value='".$f['DESCRIPTION']."' />";
                    echo "<input type='hidden' name='montant" . $f['IDFRAISOBLIGATOIRE']."O' value ='".$f['MONTANT']."' />";
                    echo "<input type='hidden' name='echeances" . $f['IDFRAISOBLIGATOIRE']."O' value='' />";
                    echo "<input type='hidden' name='obligatoire" . $f['IDFRAISOBLIGATOIRE']."O' value='1' />";
                    echo "<input type='hidden' name='codefrais" . $f['IDFRAISOBLIGATOIRE']."O' value='".$f['CODEFRAIS']."' />";
                }
                echo "</td></tr>";
            }
        }
        ?>
    </tbody>
</table>
<!-- div style="margin: 10px;text-align: center" id="btn_sync_responsable">
    <input style="width: 350px; border: 2px outset buttonface; margin:0" type="button" 
           value="<?php //echo __t("Synchroniser les frais"); ?>" onclick="synchroniserDonnees()"/>
</div -->
<script>
$(document).ready(function(){
     if (!$.fn.DataTable.isDataTable("#fraisTable")) {
        $("#fraisTable").DataTable({
            "bInfo": false,
            scrollY: $(".page").height() - 250,
            "searching": false,
            "paging": false,
            "columns": [
                null,
                {"width": "15%"},
                {"width": "20%"},
                {"width": "10%"}
            ]
        });
    }
 });
</script>
