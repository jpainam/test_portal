<fieldset style="width: 480px; height: 446px;"><legend>Informations li&eacute;es au responsable</legend>
    <span class="select" style="width: 50px">
        <label>Civilit&eacute;</label>
        <select name="civilite" style="width:100%" id="civilite">
            <?php
            foreach ($civilites as $ci) {
                if ($ci['CIVILITE'] == $r['CIVILITE']) {
                    echo "<option selected='selected' value='" . $ci['CIVILITE'] . "'>" . $ci['CIVILITE'] . "</option>";
                } else {
                    echo "<option value='" . $ci['CIVILITE'] . "'>" . $ci['CIVILITE'] . "</option>";
                }
            }
            ?>
        </select>
    </span>
    <span class="text" style="width: 170px">
        <label>Nom</label>
        <input type="text" name="nom" value='<?php echo $r['NOM'] ?>' />
    </span>
    <span class="text" style="width: 200px">
        <label>Pr&eacute;nom</label>
        <input type="text" name="prenom" value='<?php echo $r['PRENOM'] ?>' />
    </span>
    <span class="select" style="width: 120px; clear: both">
        <label>Parent&eacute;</label>
        <select name="parente" style="width:100%" id="parente">
            <?php
            foreach ($parentes as $pa) {
                if ($pa['LIBELLE'] == $r['PARENTE']) {
                    echo "<option selected='selected' value='" . $pa['LIBELLE'] . "'>" . $pa['LIBELLE'] . "</option>";
                } else {
                    echo "<option value='" . $pa['LIBELLE'] . "'>" . $pa['LIBELLE'] . "</option>";
                }
            }
            ?>
        </select>
    </span>
    <span class="text" style="width: 315px" >
        <label>Profession</label>
        <input type="text" name="profession" value='<?php echo $r['PROFESSION'] ?>'  />
    </span>
    <div style="height: 10px; clear: both; content: ' ';"></div>
    <?php
    foreach ($charges as $charge) {
        echo "<span style = 'margin-right:15px'>";
        if (strpos($r['CHARGES'], $charge['LIBELLE']) !== false) {
            echo "<input checked='checked' type ='checkbox' value = \"" . $charge['IDCHARGE'] . "\" name = 'charge' />";
        } else {
            echo "<input type ='checkbox' value = \"" . $charge['IDCHARGE'] . "\" name = 'charge' />";
        }

        echo "<label style = 'font-weight:bold;'>" . $charge['LIBELLE'] . "</label></span>";
    }
    ?>
    <span class="text" style="width: 140px">
        <label>Portable</label>
        <input type="text" name="portable" id="portable" value='<?php echo $r['PORTABLE'] ?>' />
    </span>
    <span class="text" style="width: 140px">
        <label>T&eacute;l&eacute;phone</label>
        <input type="text" name="telephone" value='<?php echo $r['TELEPHONE'] ?>'  />
    </span>
    <span class="text" style="width: 140px">
        <label>E-mail</label>
        <input type="text" name="email" value='<?php echo $r['EMAIL'] ?>'  />
    </span>
    <span  style="width: 200px; display: block; float: left; position: relative; top: 20px;">
        <input type="checkbox" name="acceptesms" checked ='checked' />
        Accepte l'envoi de notification

    </span>
    <span class="text" style="width: 140px;" >
        <label>N° envoi de notification</label>
        <input type="text" name="numsms" id="numsms" value='<?php echo $r['NUMSMS'] ?>'  maxlength="20"/>
    </span>

    <fieldset style="width: 440px;"><legend>Coordonn&eacute;es</legend>

        <span class="text" style="width: 418px;">
            <label>Adresse</label>
            <input type="text" name="adresse1" placeholder = 'Adresse' value='<?php echo $r['ADRESSE'] ?>' />
        </span>
        <span class="text" style="width: 418px;margin-top:-10px;" placeholder = 'Adresse'>
            <input type="text" name="adresse2" placeholder = 'Adresse'/>
        </span>
        <span class="text" style="width: 418px; margin-top:-10px;">
            <input type="text" name="adresse3" placeholder = 'Adresse' />
        </span>
        <span class="text" style="width: 418px;">
            <label>Boite Postale</label>
            <input type="text" name="bp" value='<?php echo $r['BP'] ?>'  />
        </span>

    </fieldset>
    <div  style="position: relative; top: 10px; margin-right: 10px; clear: both;" class="navigation">
        <?php echo btn_ok("saveResponsable()"); ?>
        <?php echo btn_cancel("resetResponsable();") ?>
    </div>
</fieldset>
<script>
    $(document).ready(function () {
        $(function () {
            var $src = $('#portable'),
                    $dst = $('#numsms');
            $src.on('input', function () {
                $dst.val($src.val());
            });
        });
    });
</script>

