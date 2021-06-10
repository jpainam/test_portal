<div class="titre"><?php echo __t("Inscription d'élèves"); ?></div>
<form action="<?php echo Router::url('classe', 'index'); ?>" method="post" enctype="multipart/form-data" name="frmclasse">
    <div class="page">
        <fieldset style="margin: auto;margin-bottom: 5px; float: none; width: 750px;"><legend><?php echo __t("Information de la classe"); ?>
            </legend>
            <span class="select" style="width: 150px;"><label><?php echo __t("Nom abr&eacute;g&eacute;"); ?></label>
                <?php echo $comboNiveau ?></span>
            <span class="text" style="width: 360px;"><label><?php echo __t("Libell&eacute;"); ?></label>
                <input disabled="disabled" type="text" name="libelle" value="<?php echo $libelle; ?>"/></span>
            <span class="select" style="width: 150px;">    
                <label><?php echo __t("D&eacute;coupage"); ?></label>
                <?php echo $comboDecoupage; ?>
            </span>
            <input type="hidden" name="idclasse" value="<?php echo $idclasse ?>" />
            <input type="hidden" name="identifiant" value="" />
            <input type="hidden" name="matiere" value="" />
        </fieldset>
        <div class="tabs" style="width: 100%">
            <ul>
                <li id="tab1" class="courant">
                    <a onclick="onglets(1, 1, 1);">
                        <img border ="0" alt="" src="<?php echo SITE_ROOT . "public/img/icons/eleve.png"; ?>" />
                        <?php echo __t("El&egrave;ves"); ?>
                    </a>
                </li>
            </ul>
        </div>
        <div id="onglet1" class="onglet" style="display: block; margin: auto">
            <fieldset style="width: 90%; height: 415px;"><legend>Elèves</legend>
                <div style="float: left; width: 40%">
                    <img id="ajout_eleve" src="<?php echo SITE_ROOT . "public/img/btn_add.png"; ?>" style="position: relative; margin: 3px; cursor: pointer;  float: right;">
                    <span class="select2"><?php echo __t("Selectionner un élève"); ?></span>
                    <?php echo $comboElevesNonInscrits; ?>
                </div>
                <div id="eleve_content" style="float: right; width: 50%">
                    <table class="dataTable" id="tab_elv">
                        <thead><tr><th><?php echo __t("Matricule "); ?></th><th><?php echo __t("Nom et Pr&eacute;nom"); ?></th>
                                <th></th></tr></thead>
                        <tbody>      <?php
                            foreach ($elevesInscrits as $eleve) {
                                echo "<tr><td>" . $eleve['MATRICULE'] . "</td><td>" . $eleve['CNOM'] . "</td>"
                                . "   <td align = 'center'><img style = 'cursor:pointer' src = '" . SITE_ROOT . "public/img/delete.png'"
                                . " onclick = \"desinscrire('" . $eleve['IDINSCRIPTION'] . "');\"  /></td></tr>";
                            }
                            ?>
                        </tbody>
                    </table></div>
            </fieldset>
        </div>
        </div>
        <div class="recapitulatif">
            <?php
            if ($errors) {
                echo $message;
            }
            ?>
        </div>
        <div class="navigation">
            <img  src="<?php echo SITE_ROOT . "public/img/btn_ok.png" ?> " onclick="document.forms[0].submit();" />
            <img  src="<?php echo SITE_ROOT . "public/img/btn_cancel.png" ?> " 
                  onclick="document.location = '<?php echo Router::url("classe"); ?>'" />
    </div>
</form>
<div class="status"></div>