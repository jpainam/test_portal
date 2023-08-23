<style>
    .dialog span{
        display: block;
    }
</style>
<div id="entete" style="height: 80px">
    <div class="logo"><img src="<?php echo SITE_ROOT . "public/img/wide_emplois.png"; ?>" /></div>
    <div style="margin-left: 100px">
        <span class="select" style="width: 200px"><label>Classes: </label><?php echo $comboClasses; ?></span>
    </div>
    <div style="float: right">
        <img id="ajout-emplois" style="cursor: pointer;margin-top: 15px; margin-right: 10px;" 
             src="<?php echo SITE_ROOT . "public/img/btn_add.png" ?>" />
    </div>
</div>
<form action="<?php echo Router::url("emplois", "saisie") ?>" method="post">
    <div class="page">
        <div class="tabs" style="width: 100%">
            <ul><li id="tab1" class="courant">
                    <a onclick="onglets(1, 1, 2);"><img  src="<?php echo SITE_ROOT . "public/img/icons/emploistemps.png"; ?>" />
                        Emplois du temps</a></li>
                <li id="tab2" class="noncourant">
                    <a onclick="onglets(1, 2, 2);"><img src="<?php echo SITE_ROOT . "public/img/icons/apercu.png"; ?>" />
                        Aper&ccedil;u</a> 
                </li>
            </ul></div>
        <div id="onglet1" class="onglet" style="display: block;height: 90%">
            <div id = 'emplois-content'><table id="tableEmplois" class='dataTable'>
                    <thead><th>Jour</th><th>D&eacute;but</th><th>Fin</th><th>Enseignant</th><th>Mati&egrave;re</th><th></th></thead>
                    <tbody></tbody>
                </table></div>
            <div id="ajout-emplois-dialog" class="dialog" title="S&eacute;lectionner les horaires">
                <span><label>Jour de la semaine:</label>
                    <select name = 'jour' style="width:100%;"><?php
                        $i = 1;
                        $jours = jourSemaine();
                        foreach ($jours as $j) {
                            echo "<option value = '$i'>$j</option>";
                            $i++;
                        }
                        ?>
                    </select>
                </span>
                <span><label>Mati&egrave;res : </label><select name = 'enseignement' style="width: 100%"></select></span>
                <span style="width: 150px; float: left; margin-right: 20px"><label>Heure d&eacute;but:</label>
                    <select name="horairedebut" id="horairedebut" style="width: 100%">
                        <option></option>
                        <?php
                        foreach ($horaires as $h) {
                            echo "<option value='" . $h['IDHORAIRE'] . "'>" . $h['HEUREDEBUT'] . "</option>";
                        }
                        ?>
                    </select>
                </span>
                <span style="width: 150px;float: left;"><label>Heure fin:</label>
                    <select name="horairefin" id="horairefin" style="width: 100%">
                        <option></option>
                        <?php
                        foreach ($horaires as $h) {
                            echo "<option value='" . $h['IDHORAIRE'] . "'>" . $h['HEUREFIN'] . "</option>";
                        }
                        ?>
                    </select>
                </span>

            </div>
        </div>
        <div id="onglet2" class="onglet" style="display: none;height: 90%">
            <div id="apercu-content"></div>
        </div>
    </div>
    <div class="recapitulatif"></div>
    <div class="navigation">
        <div class="editions">
            <input type="radio" value="excel" name="type_impression" />
            <img src="<?php echo img_excel(); ?>" />&nbsp;&nbsp;
            <input type="radio" value="pdf" name="type_impression" checked="checked" />
            <img src="<?php echo img_pdf(); ?>" />&nbsp;&nbsp;Editions:
            <select onchange="imprimer();" name = "code_impression">
                <option></option>
                <option value="0001">Emplois du temps</option>
            </select>
        </div>
    </div>
</form>
<div class="status"></div>