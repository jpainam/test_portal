<table class="dataTable" id="tableEnseignements" >
    <thead><tr><th><?php echo __t("Classe"); ?></th><th><?php echo __t("Libell&eacute;"); ?></th>
            <th><?php echo __t("Mati&egrave;res"); ?></th><th><?php echo __t("Coeff"); ?>.</th></tr></thead>
    <tbody>
        <?php
        foreach ($enseignements as $ens) {
            echo "<tr><td>" . $ens['NIVEAUHTML'] . "</td><td>" . $ens['CLASSELIBELLE'] . "</td>"
            . "<td>" . $ens['MATIERELIBELLE'] . "</td><td>" . $ens['COEFF'] . "</td></tr>";
        }
        ?>
    </tbody>
</table>
<script>
    $(document).ready(function () {
        if (!$.fn.DataTable.isDataTable("#tableEnseignements")) {
            $("#tableEnseignements").DataTable({
                bInfo: false,
                paging: false,
                columns: [
                    {"width": "10%"},
                    null,
                    null,
                    {"width": "5%"}
                ]
            });
        }
    });
</script>
