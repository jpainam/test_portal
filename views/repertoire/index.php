<div id="entete">

</div>
<div class="page">
    <?php echo $repertoires; ?>
</div>
<div class="recapitulatif">
    <?php echo $total; ?> entr&eacute;es
</div>
<div class="navigation">
     <div class="editions">
           <input type="radio" value="excel" name="type_impression" checked="checked" />
            <img src="<?php echo img_excel(); ?>" />&nbsp;&nbsp;
            <input type="radio" value="pdf" name="type_impression" />
            <img src="<?php echo img_pdf(); ?>" />&nbsp;&nbsp;Editions:
            <select onchange="imprimer();" name = "code_impression">
                <option></option>
                <option value="0001"><?php echo __t("Tout le repertoire téléphonique"); ?></option>
                <option value="0002"><?php echo __t("Repertoire téléphonique des parent d'élèves"); ?></option>
            </select>
        </div>
</div>
<div class="status">

</div>
