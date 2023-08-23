<style>
    #page-content span.select2{
        width: 400px !important;
    }
</style>
<div id="entete">
    <div class="logo"><img src="<?php echo SITE_ROOT . "public/img/wide_personnel.png"; ?>" /></div>
    <div style="margin-left: 120px">
        <span class="select2" >
            <label><?php echo __t("Liste des parents d'&eacute;l&egrave;ves"); ?>: </label>
            <select name="responsable">
                <option value=""></option>
                <?php
                foreach ($responsables as $resp) {
                    echo "<option value='" . $resp['IDRESPONSABLE'] . "'>" . $resp['NOM'] . ' ' . $resp['PRENOM'] . "</option>";
                }
                ?>
            </select>
        </span>
    </div>
</div>
<div class="titre"></div>
<div class="page">
    <div id="responsable-content">
        <table class="dataTable" id="responsableTable">
            <thead><tr><th>Civ.</th><th><?php echo __t("Noms et Pr&eacute;noms"); ?></th><th><?php echo __t("Portable"); ?></th>
                    <th><?php echo __t("T&eacute;l&eacute;phone"); ?></th>
                    <th><?php echo __t("Email"); ?></th><th></th></tr></thead>
            <tbody>
                <?php
                foreach ($responsables as $r) {
                    echo "<tr><td>" . $r["CIVILITE"] . "</td><td>" . $r["CNOM"] . "</td><td>";
                    echo $r["PORTABLE"] . "</td><td>" . $r["TELEPHONE"] . "</td><td>" . $r["EMAIL"] . "</td><td align='center'>";
                    if (isAuth(317)) {
                        echo "<img src='" . img_edit() . "' style='cursor:pointer' onclick=\"document.location='" . Router::url("responsable", "edit", $r['IDRESPONSABLE']) . "'\" />";
                    } else {
                        echo "<img src='" . img_edit_disabled() . "' style='cursor:pointer' />";
                    }
                    if (isAuth(318)) {
                        echo "&nbsp;&nbsp;<img src='" . img_delete() . "' style='cursor:pointer' onclick='deleteResponsable(" . $r['IDRESPONSABLE'] . ")' />";
                    } else {
                        echo "&nbsp;&nbsp;<img style='cursor:pointer' src='" . img_delete_disabled() . "' />";
                    }
                    echo "</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<div class="navigation">
    <?php
    if (isAuth(319)) {
        echo btn_add("document.location='" . Router::url("responsable", "saisie") . "'");
    } else {
        echo btn_add_disabled();
    }
    ?>
</div>
<div class="status"></div>
<script>
    $(document).ready(function () {
        $("#responsableTable").DataTable({
            "columns": [
                {"width": "5%"},
                null,
                {"width": "10%"},
                {"width": "10%"},
                {"width": "10%"},
                {"width": "10%"}
            ]
        })
    });
</script>