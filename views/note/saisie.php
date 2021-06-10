<form action="<?php echo Router::url("note", "saisie"); ?>" method="post" name="saisienotes" >
    <div id="entete"><div class="logo"><img src="<?php echo SITE_ROOT . "public/img/wide_classe.png"; ?>" /></div>
        <div style="margin-left: 90px; width: 650px; height: 80px">

            <span class="select" style="width: 200px; margin: 0 10px 0;"><label><?php echo __t("Classes"); ?> : </label>
                <?php echo $comboClasses; ?></span>
            <span class="select" style="width: 200px; margin: 0 10px 0"><label><?php echo __t("P&eacute;riode"); ?> : </label>
                <?php echo $comboPeriodes; ?></span>

            <span class="text" style="width: 120px; margin-top: 0"><label><?php echo __t("Date du devoir"); ?></label>
                <input type="text" name="datedevoir"></span>

            <span class="text" style="width: 200px; margin: 0 10px 0"><label><?php echo __t("Libell&eacute; du devoir"); ?> : </label>
                <input type="text" name="description" value="Devoir Harmonis&eacute;" />
            </span>

            <span class="select" style="width: 200px; margin: 0 10px 0"><label><?php echo __t("Mati&egrave;res"); ?></label>
                <select name="comboEnseignements"><option></option></select></span>

            <span class="text" style="width: 50px; margin: 0"><label><?php echo __t("Note sur"); ?> : </label>
                <input type="text" value="20" name="notesur" style="text-align: right" /></span>
                <span class="text" style="width: 50px; margin: 0 20px 0"><label><?php echo __t("Coeff"); ?>.</label>
                <input style="text-align: right" type="text" value="00" name="coeff" disabled="disabled" /></span>
        </div>
    </div>
    <div class="page">
        <!-- <div class="tabs" style="width: 100%">
            <ul>
                <li id="tab1" class="courant">
                    <a onclick="onglets(1, 1, 2);">
                        <img border ="0" alt="" src="<?php //echo SITE_ROOT . "public/img/icons/note.png"; ?>" />
                        Harmonis&eacute;es
                    </a>
                </li>
                <li id="tab2" class="noncourant">
                    <a onclick="onglets(1, 2, 2);">
                        <img border ="0" alt="" src="<?php //echo SITE_ROOT . "public/img/icons/activite.png"; ?>" />
                        Contr&ocirc;les continus
                    </a>
                </li>
            </ul>
        </div>
        <div id="onglet1" class="onglet" style="display: block;height: 95%"> -->
            <div id="eleve-content">
                <table class="dataTable" id="eleveTable">
                    <thead><th><?php echo __t("Matricule "); ?></th><th><?php echo __t("Noms et Pr&eacute;noms"); ?></th><th><?php echo __t("Note"); ?></th>
                    <!-- th>Absent</th --><th><?php echo __t("Non not&eacute;"); ?></th><th><?php echo __t("Observations"); ?></th></thead>
                    <tbody>
                    </tbody></table>
            </div>
        <!-- /div>
        <div id="onglet2" class="onglet" style="display: none;height: 95%">
            <div id="eleve-cc">
                <table class="dataTable" id="tableNotes">
                    <thead><th>Matricule</th><th>Noms & Pr&eacute;noms</th>
                    <th>CC</th><th>DP</th><th>SI</th>
                    <th>Non not&eacute;</th><th>Observations</th></thead>
                    <tbody>
                    </tbody></table>
            </div>
        </div -->

    </div>
    <div class="navigation">
        <div class="editions" style="float: left">
            <img src="<?php echo img_imprimer(); ?>" />&nbsp;Editions:
            <select onchange="imprimer();" name = "code_impression">
                <option></option>
                <option value="0001"><?php echo __t("Fiche de report de notes individuelles"); ?></option>
                <option value="0005"><?php echo __t("Fiche de report de notes périodique"); ?></option>
            </select>
        </div>
        <?php
        //Droit recapitulatif des notes
        if (isAuth(401)) {
            echo btn_ok("soumettreNotes();");
        }
        ?>
    </div>
</form>
<div class="status"></div>