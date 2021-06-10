<div id="entete">
    <div class="logo">
        <img src="<?php echo SITE_ROOT . "public/img/wide_livre.png"; ?>" />
    </div>
    <div style="margin-left: 100px">
        <span class="select" style="width: 300px"><label>Classes : </label><?php echo $comboClasses; ?></span>
    </div>
</div>
<div class="page">
    <p style="text-align: right;margin: 0"><img id="img-ajout" style="cursor: pointer" src="<?php echo SITE_ROOT . "public/img/btn_add.png" ?>" /></p>

    <div id="frais-content">
        <table class="dataTable" id="fraisTable">
            <thead><tr><th>Description du frais scolaire</th><th>Montant</th><th>Ech&eacute;ances</th><th></th></tr></thead>
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
