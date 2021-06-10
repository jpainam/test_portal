<style>
    .dialog span{
        display: block;
    }
    
</style>
<div id="entete">
    <div class="logo"><img src="<?php echo SITE_ROOT . "public/img/wide_email.png"; ?>" /></div>
    <div style="margin-left: 100px; width: 750px">
        <span class="select" style="width: 300px;margin-top: 0"><label><?php echo __t("Classes"); ?> : </label>
            <select name="classes" style="width:100%">
                <option value=""></option>
                <?php 
                if(!empty($classes)){
                    foreach($classes as $cl){
                        echo "<option value='". $cl['IDCLASSE']."'>" .$cl['LIBELLE']. ' '. $cl['NIVEAUSELECT']."</option>";
                    }
                }
                ?>
            </select>
        </span>
    </div>
</div>
<div class="page">
    <div id="ajout-manuel-dialog" class="dialog" title="Ajouter des manuels scolaires">
        <span><label><?php echo __t("Titre (*obligatoire)"); ?> : </label>
            <input type="text" name = 'titre' style="width: 90%"/>
        </span>
        <span><label><?php echo __t("Editeurs"); ?></label>
            <textarea style="width: 90%" name="editeurs" rows="2" cols="10"></textarea>
        </span>
        <span><label><?php echo __t("Auteurs"); ?></label>
            <textarea style="width: 90%" name="auteurs" rows="2" cols="10"></textarea>
        </span>
        <span style="display: inline-block; width: 42%"><label><?php echo __t("Prix"); ?></label>
            <input style="width:90%" name="prix" type="text" />
        </span>
        <span style="display: inline-block; width: 42%"><label><?php echo __t("Edition"); ?></label>
            <input style="width:90%" name="edition" type="text" />
        </span>
        <span><label><?php echo __t("Mati&egrave;res (*obligatoire)"); ?></label>
            <select name="enseignement" style="width:90%">
                <option value=""></option>
            </select>
        </span>
    </div>
    <div id="edit-manuel-dialog" class="dialog" title="Modifier un manuel scolaire">
        <span><label><?php echo __t("Titre (*obligatoire)"); ?> : </label>
            <input type="text" name = 'edit_titre' style="width: 90%"/>
        </span>
        <span><label><?php echo __t("Editeurs"); ?></label>
            <textarea style="width: 90%" name="edit_editeurs" rows="2" cols="10"></textarea>
        </span>
        <span><label><?php echo __t("Auteurs"); ?></label>
            <textarea style="width: 90%" name="edit_auteurs" rows="2" cols="10"></textarea>
        </span>
        <span style="display: inline-block; width: 42%"><label><?php echo __t("Prix"); ?></label>
            <input style="width: 90%" name="edit_prix" type="text" />
        </span>
        <span style="display: inline-block; width: 42%"><label><?php echo __t("Edition"); ?></label>
            <input style="width: 90%" name="edit_edition" type="text" />
        </span>
         <span><label><?php echo __t("Mati&egrave;res (*obligatoire)"); ?></label>
            <select name="edit_enseignement" style="width:90%">
                <option value=""></option>
            </select>
        </span>
        <input type="hidden" name="idmanuel" value="" />
    </div>
    <div id="manuel-content">
        <table id="tableManuel" class='dataTable'>
            <thead><th><?php echo __t("Titre"); ?></th><th><?php echo __t("Mati&egrave;res"); ?></th>
            <th><?php echo __t("Editeurs"); ?></th><th><?php echo __t("Auteurs"); ?></th><th><?php echo __t("Prix"); ?></th>
            <th><?php echo __t("Action"); ?></th></thead>
            <tbody>
                <?php
                if (isset($manuels) && !empty($manuels)) {
                    foreach ($manuels as $m) {
                        echo "<tr><td>" . $m['TITRE'] . "</td><td>".$m['MATIERELIBELLE']." (".$m['NIVEAUHTML'].")</td><td>" . $m['EDITEURS'] . "</td><td>"
                        . $m['AUTEURS'] . "</td><td align='right'>" . $m['PRIX'] . "</td>"
                        . "<td align='right'><img style='cursor:pointer' src='" . img_edit() . "' "
                        . "onclick=\"openEditForm(" . $m['IDMANUELSCOLAIRE'] .")\" />";
                        if (isAuth(244)) {
                            echo "&nbsp;&nbsp;<img style='cursor:pointer' src='" . img_delete() . "' "
                           . "onclick='supprimerManuel(" . $m['IDMANUELSCOLAIRE'] . ", \"". $m['TITRE']."\")' />";
                        } else {
                            echo "&nbsp;&nbsp;<img style='cursor:pointer' src='" . img_delete_disabled() . "' />";
                        }
                        echo "</td></tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<div class="navigation">
    <div class="editions" style="float: left">
        <input type="radio" value="excel" name="type_impression" />
        <img src="<?php echo img_excel(); ?>" />&nbsp;&nbsp;
        <input type="radio" value="pdf" name="type_impression" checked="checked" />
        <img src="<?php echo img_pdf(); ?>" />&nbsp;&nbsp;Editions:
        <select onchange="imprimer();" name = "code_impression">
            <option></option>
            <option value="0001"><?php echo __t("Liste des Manuels Scolaires"); ?></option>
        </select>
    </div>
    <div>
        <img src="<?php echo SITE_ROOT . "public/img/btn_add.png" ?>" id="ajout-manuel"/>
    </div>
</div>
<div class="status"></div>