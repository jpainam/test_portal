<table class="dataTable" id="tableRecapitulatif">
    <thead><tr><th><?php echo __t("Noms et Pr&eacute;noms"); ?></th><th><?php echo __t("Mati&egrave;res"); ?></th>
            <th><?php echo __t("Notes"); ?></th></tr></thead>
    <tbody>
        <?php
        foreach ($notes as $n) {
            echo "<tr><td>".$n['NOMEL']." " . $n['PRENOMEL']."</td><td>".$n['BULLETIN']."</td><td>".$n['MOYENNE']."</td></tr>";
        }
        ?>
    </tbody>
</table>
<script>
    $(document).ready(function () {
        if (!$.fn.DataTable.isDataTable("#tableRecapitulatif")) {
            $("#tableRecapitulatif").DataTable({
               columns: [
                   null,
                   {width: "25%"},
                   {width: "10%"}
               ] 
            });
        }
    });
</script>