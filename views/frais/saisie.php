<style>
    .dialog span{
        display: block;
    }
</style>
<div id="entete">
    <div class="logo">
        <img src="<?php echo SITE_ROOT . "public/img/wide_frais.png"; ?>" />
    </div>
    <div style="margin-left: 100px">
        <span class="select" style="width: 300px"><label><?php echo __t("Classes"); ?> : </label><?php echo $comboClasses; ?></span>
    </div>
</div>
<div class="page">
    <p style="text-align: right;margin: 0"><img id="img-ajout" style="cursor: pointer" src="<?php echo SITE_ROOT . "public/img/btn_add.png" ?>" />
        <input type="hidden" name="echeances" value="" /></p>

    <div id="frais-content">
        <table class="dataTable" id="fraisTable">
            <thead><tr><th><?php echo __t("Description"); ?></th><th><?php echo __t("Montant"); ?></th>
                    <th><?php echo __t("Ech&eacute;ances"); ?></th><th></th></tr></thead>
            <tbody></tbody>
        </table>
    </div>
</div>
<div class="navigation">
    <?php
    if (isAuth(211)) {
        echo btn_ok("document.location='" . Router::url("frais") . "'");
    } else {
        echo btn_ok_disabled();
    }
    ?></div>
<div class="status"></div>
<div id="frais-dialog-form" class="dialog" title="Ajouter d'un frais scolaire" >
    <span><label><?php echo __t("Libell&eacute; du frais scolaire"); ?></label>
        <input type="text" name="description" style="width: 100%" /></span>
        <span><label><?php echo __t("Montant"); ?></label>
        <input type="text" name="montant" style="width: 100%" /></span>
        <span style="display: inline-block; width: 45%">
            <label><?php echo __t("Ech&eacute;ance"); ?></label>
            <input type="text" style="width: 90%" id="echeances" name="echeances"/>
        </span>
    <span style="display: inline-block; width: 50%">
        <label>*<?php echo __t('Obligatoire'); ?></label>
        <input type="checkbox" name="obligatoire" style="margin-right: 20px"/>
        <select name="codefrais">
             <option value=""></option>
            <?php 
            if(isset($codefrais) && is_array($codefrais)){
            foreach($codefrais as $c){
                echo "<option value='" . $c['CODE'] . "'>" . $c['CODE'] . "</option>";
             }
            } ?>
        </select>
    </span>
</div>
<div id="editfrais-dialog-form" class="dialog" title="modification d'un frais scolaire" >
    <span><label><?php echo __t("Libell&eacute; du frais scolaire"); ?></label>
        <input type="text" name="editdescription" style="width: 100%" />
    </span>
    <span><label><?php echo __t("Montant"); ?></label>
        <input type="text" name="editmontant" style="width: 100%" />
    </span>
    <span style="display: inline-block; width: 45%">
        <label><?php echo __t("Ech&eacute;ance"); ?></label>
        <input name="editecheances" id="editecheances"  type="text" />
    </span>
    <span style="display: inline-block; width: 50%">
        <label>*<?php echo __t('Obligatoire'); ?></label>
        <input type="checkbox" name="editobligatoire" style="margin-right: 20px"/>
        <select name="editcodefrais">
            <option value=""></option>
            <?php 
            if(isset($codefrais) && is_array($codefrais)){
            foreach($codefrais as $c){
                echo "<option value='" . $c['CODE'] . "'>" . $c['CODE'] . "</option>";
             }
            } ?>
        </select>
    </span>
</div>
