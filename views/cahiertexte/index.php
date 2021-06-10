<style>
    .dialog span{
        display: block;
    }
</style>
<div id="entete">
    <div class="logo">
        <img src="<?php echo SITE_ROOT . "public/img/wide_livre.png"; ?>" />
    </div>
    <div style="margin-left: 100px">
        <span class="select" style="width: 200px"><label><?php echo __t("Classes"); ?> : </label>
            <select name="comboClasses" id="comboClasses">
                <option value=""></option>
                <?php
                if (isset($classes)) {
                    foreach ($classes as $cl) {
                        echo "<option value='" . $cl['IDCLASSE'] . "'>" . $cl['LIBELLE'] . " " . $cl['NIVEAUSELECT'] . "</option>";
                    }
                }
                ?>
            </select>
        </span>
        <span class="select" style="width: 200px"><label><?php echo __t("Enseignements"); ?> : </label>
            <select name="comboEnseignement">
                <option value=""></option>
            </select>
        </span>
    </div>
    <div style="text-align: right;margin: 0">
        <img id="img-ajout" style="cursor: pointer" src="<?php echo SITE_ROOT . "public/img/btn_add.png" ?>" />
    </div>
</div>
<div class="page">
    <div id="cahier-content">
        <table class="dataTable" id="cahierTable">
            <thead><tr><th><?php echo __t("Date"); ?></th><th><?php echo __t("Heures"); ?></th><th><?php echo __t("Objectif"); ?></th>
                    <th><?php echo __t("Description"); ?></th><th></th></tr></thead>
            <tbody></tbody>
        </table>
    </div>

    <div id="cahier-dialog-form" class="dialog" title="Ajouter  cahier de texte" >
        <span><label><?php echo __t("Date"); ?></label>
            <input type="text" id="datesaisie" name="datesaisie" style="width: 100%" /></span>
            <span><label><?php echo __t("Heures"); ?></label>
            <input type="text" id="heuredebut" name="heuredebut" style="width: 45%" />
            <input type="text" id="heurefin" name="heurefin" style="width: 45%" /></span>
            <span><label><?php echo __t("Objectif"); ?></label>
            <input type="text" name="objectif" style="width: 100%" /></span>
            <span><label><?php echo __t("Contenu"); ?></label>
            <textarea rows="5" cols="30" name="contenu"></textarea></span>
    </div>
</div>
<div class="navigation">
    <div class="editions" style="float: left">
        <input type="radio" value="excel" name="type_impression" />
        <img src="<?php echo img_excel(); ?>" />&nbsp;&nbsp;
        <input type="radio" value="pdf" name="type_impression" checked="checked" />
        <img src="<?php echo img_pdf(); ?>" />&nbsp;&nbsp;Editions:
        <select onchange="imprimer();" name = "code_impression" style="width: 250px">
            <option></option>
            <option value="0001"><?php echo __t("Cahier de texte<"); ?>/option>
        </select>
    </div>
</div>

<div class="status">

</div>
