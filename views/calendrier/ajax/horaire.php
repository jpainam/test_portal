<table id="horaireTable">
    <thead><tr><th><?php echo __t("D&eacute;but"); ?></th><th><?php echo __t("Fin"); ?></th><th><?php echo __t("Lundi"); ?></th>
            <th><?php echo __t("Mardi"); ?></th><th><?php echo __t("Mercredi"); ?></th><th><?php echo __t("Jeudi"); ?></th>
            <th><?php echo __t("Vendredi"); ?></th><th><?php echo __t("Samedi"); ?></th></tr></thead>
    <tbody>
        <?php
        foreach ($horaires as $h) {
            echo "<tr><td><input type='text' value='" . $h['HEUREDEBUT'] . "' name='horairedebut" . $h['IDHORAIRE'] . "' /></td>";
            echo "<td><input type='text' value='" . $h['HEUREFIN'] . "' name='horairefin" . $h['IDHORAIRE'] . "' /></td>";
            # Lundi
            if ($h['LUNDI']) {
                echo "<td><input type='checkbox' checked name='lundi" . $h['IDHORAIRE'] . "' /></td>";
            } else {
                echo "<td><input type='checkbox' name='lundi" . $h['IDHORAIRE'] . "' /></td>";
            }
            # Mardi
            if ($h['MARDI']) {
                echo "<td><input type='checkbox' checked name='mardi" . $h['IDHORAIRE'] . "' /></td>";
            } else {
                echo "<td><input type='checkbox' name='mardi" . $h['IDHORAIRE'] . "' /></td>";
            }

            # Mercredi
            if ($h['MERCREDI']) {
                echo "<td><input type='checkbox' checked name='mercredi" . $h['IDHORAIRE'] . "' /></td>";
            } else {
                echo "<td><input type='checkbox' name='mercredi" . $h['IDHORAIRE'] . "' /></td>";
            }
            # Jeudi
            if ($h['JEUDI']) {
                echo "<td><input type='checkbox' checked name='jeudi" . $h['IDHORAIRE'] . "' /></td>";
            } else {
                echo "<td><input type='checkbox' name='jeudi" . $h['IDHORAIRE'] . "' /></td>";
            }
            # Vendredi
            if ($h['VENDREDI']) {
                echo "<td><input type='checkbox' checked name='vendredi" . $h['IDHORAIRE'] . "' /></td>";
            } else {
                echo "<td><input type='checkbox' name='vendredi" . $h['IDHORAIRE'] . "' /></td>";
            }
            # Lundi
            if ($h['SAMEDI']) {
                echo "<td><input type='checkbox' checked name='samedi" . $h['IDHORAIRE'] . "' /></td>";
            } else {
                echo "<td><input type='checkbox' name='samedi" . $h['IDHORAIRE'] . "' /></td>";
            }
            echo "</tr>";
        }
        for ($j = 0; $j < 6; $j++) {
            echo "<tr><td><input type='text' name='xhorairedebut" . $j . "' /></td>";
            echo "<td><input type='text' name='xhorairefin" . $j . "'  /></td>";
            echo "<td><input type='checkbox' name='xlundi" . $j . "' /></td>";
            echo "<td><input type='checkbox' name='xmardi" . $j . "' /></td>";
            echo "<td><input type='checkbox' name='xmercredi" . $j . "' /></td>";
            echo "<td><input type='checkbox' name='xjeudi" . $j . "' /></td>";
            echo "<td><input type='checkbox' name='xvendredi" . $j . "' /></td>";
            echo "<td><input type='checkbox' name='xsamedi" . $j . "' /></td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>