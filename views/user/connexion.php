<div id="entete">
    <div class="logo">
        <img src="<?php echo SITE_ROOT . "public/img/wide_connexion.png" ?>" />
    </div>
</div>
<div class="page">
    <table class="dataTable" id="tableConnexion">
        <thead><tr><th><?php echo __t("Date de début"); ?></th>
                <th><?php echo __t("Machine"); ?></th><th><?php echo __t("Adresse"); ?></th>
                <th><?php echo __t("Connexion"); ?></th><th><?php echo __t("Date de fin"); ?></th>
                <th><?php echo __t("Déconnexion"); ?></th></tr>
        </thead>
        <tbody>
            <?php
            foreach ($connexions as $c) {
                echo "<tr><td>" . $c['DATEDEBUT'] . "</td><td>" . $c['MACHINESOURCE'] . "</td><td>" . $c['IPSOURCE'] . "</td>"
                . "<td>" . $c['CONNEXION'] . "</td><td>" . $c['DATEFIN'] . "</td><td>" . $c['DECONNEXION'] . "</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<div class="navigation"></div>
<div class="status">

</div>
<script>
    $(document).ready(function () {
        if (!$.fn.DataTable.isDataTable("#tableConnexion")) {
            $("#tableConnexion").DataTable();
        }
    });
</script>