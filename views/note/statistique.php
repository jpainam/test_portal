<div id="entete" style="height: 80px">
    <div class="logo"><img src="<?php echo SITE_ROOT . "public/img/wide_statistique.png"; ?>" /></div>
    <div style="margin-left: 100px">
        <h2>STATISTIQUES DES NOTES</h2>
    </div>
</div>
<div class="titre"></div>
<div class="page">
     <fieldset style="float: none !important; width: 50%; margin: auto;">
        <span class="select" style="width: 355px; margin: 0"><label>Statistiques par mati&egrave;res : </label>
            <?php echo $comboMatieres; ?>
        </span>
        <span class="select" style="width: 170px;clear: both;margin-top: 0"><label>Statistiques par classes : </label>
            <?php echo $comboClasses; ?>
        </span>
        <span class="select" style="width: 170px; margin-top: 0"><label>P&eacute;riode : </label>
            <?php echo $comboPeriodes; ?>
        </span>
    </fieldset>
</div>
<div class="navigation">
    <div class="editions" style="float: left">
        <img src="<?php echo img_imprimer(); ?>" />&nbsp;Editions:
        <select onchange="imprimer();" name = "code_impression">
            <option></option>
            <option value="0002">Statistiques des notes par classes et par mati&egrave;res</option>
            <option value="0006">Proc&egrave;s verbal par classe</option>
            <option value="0007">Synth&egrave;se des notes par classe</option>
            <option value="0008">Courbe des notes par classe</option>
            <option value="0009">Tableau d'honneur par classe</option>
             <option value="0010">Bilan global des resultats par classe</option>
        </select>
    </div>
</div>
<div class="status"></div>