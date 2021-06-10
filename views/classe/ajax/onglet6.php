<table class="dataTable" id="tableOperation">
    <thead><tr><th><?php echo __t("Mati&egrave;res"); ?></th><th><?php echo __t("Titre"); ?></th>
            <th><?php echo __t("Editeurs"); ?></th><th><?php echo __t("Auteurs"); ?></th><th><?php echo __t("Prix"); ?></th></tr></thead>
    <tbody>
        <?php
        if(!empty($manuels)){
            $nb_manuel_scolaire = count($manuels);
            foreach ($manuels as $ma) {
                echo "<tr><td>" . $ma['MATIERELIBELLE'] . "</td><td>" . $ma['TITRE'] . "</td>"
                        . "<td>". $ma['EDITEURS'] . "</td><td>"  . $ma['AUTEURS'] . 
                        "</td><td>" . $ma['PRIX'] . "</td></tr>";
            }
        }
        ?>
    </tbody>
</table>
<!-- div style="margin: 10px;text-align: center" id="btn_sync_emplois">
    <input style="width: 350px; border: 2px outset buttonface; margin:0" type="button" 
           value="<?php //echo __t("Synchroniser les manuels scolaires"); ?> (<?php //echo $nb_sync_manuels; ?>)" onclick="synchroniserManuels()"/>
</div -->
<script>
    if (!$.fn.DataTable.isDataTable("#tableOperation")) {
        $('#tableOperation').DataTable({
            "paging": false,
            "bInfo": false,
            "scrollY": 400,
            "columns": [
                null,
                null,
                null,
                null,
                {"width": "5%"}
            ]
        });
    }
</script>
