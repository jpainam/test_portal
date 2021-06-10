<div id="entete" style="height: 80px">
    <div class="logo">
        <img src="<?php echo SITE_ROOT . "public/img/wide_telephone.png"; ?>" />
    </div>
    <div style="margin-left: 100px">
        <span class="text" style="width: 180px;"><label>De</label>
            <input type="text" name="datedebut" id="datedebut" /></span>
        <span class="text" style="width: 150px;"><label>Au</label>
            <input type="text" id="datefin" name="datefin" /></span>
            <br style="clear: both" />
        <span class="select2" style="width: 350px;">
            <label><?php echo __t("Filtrer par destinataires"); ?></label>
            <?php echo $comboDestinataires; ?>
        </span>
    </div>
</div>
<div class="page">
    <div id="message-content">
        <?php
        echo $tableMessages;
        ?>
    </div>
</div>
<div class="navigation">

</div>
<div class="status">

</div>