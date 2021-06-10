<style>
    .dialog span{
        display: block;
    }
    #horaireTable th{
        padding: 5px;
        border: none;
        text-align: center;
    }
    #horaireTable{
        border-collapse: collapse;
        border: none;
        margin: auto;
    }
    #horaireTable td{
        border: none;
        text-align: center;
        padding-left: 10px;
        padding-right: 10px;
    }
    #horaireTable input[type=text]{
        width: 80px;
        text-align: right;
    }
</style>

<div id="entete">
    <div class="logo"> <img src="<?php echo SITE_ROOT . "public/img/wide_calendrier.png" ?>" /></div>
</div>
<div class="titre"></div>
<form action="<?php echo Router::url("calendrier"); ?>" method="post" name="calendrier" >
    <div class="page">
        <div class="tabs" style="width: 100%">
            <ul>
                <li id="tab1" class="courant">
                    <a onclick="onglets(1, 1, 5);"><img border ="0" alt="" src="<?php echo SITE_ROOT . "public/img/icons/calendrier.png"; ?>" />
                        <?php echo __t("P&eacute;riodes"); ?>
                    </a>
                </li>
                <li id="tab2" class="noncourant">
                    <a onclick="onglets(1, 2, 5);"><img border ="0" alt="" src="<?php echo SITE_ROOT . "public/img/icons/vacance.png"; ?>" />
                        <?php echo __t("Vacances"); ?>
                    </a>
                </li>
                <li id="tab3" class="noncourant">
                    <a onclick="onglets(1, 3, 5);"><img border ="0" alt="" src="<?php echo SITE_ROOT . "public/img/icons/ferie.png"; ?>" />
                        <?php echo __t("Jours f&eacute;ri&eacute;s"); ?>
                    </a>
                </li>
                <li id="tab4" class="noncourant">
                    <a onclick="onglets(1, 4, 5);"><img border ="0" alt="" src="<?php echo SITE_ROOT . "public/img/icons/fermeture.png"; ?>" />
                        <?php echo __t("Examens"); ?>
                    </a>
                </li>
                <li id="tab5" class="noncourant">
                    <a onclick="onglets(1, 5, 5);"><img border ="0" alt="" src="<?php echo SITE_ROOT . "public/img/icons/horaire.png"; ?>" />
                        <?php echo __t("D&eacute;coupage horaire"); ?>
                    </a>
                </li>
            </ul>
        </div>
        <div id="onglet1" class="onglet" style="display: block;height: 90%">
            <table style="width: 100%">
                <tr><td style="width: 50%">
                        <fieldset  style="width: 90%;float: none; margin: auto;"><legend><?php echo __t("Ann&eacute;e scolaire"); ?></legend>
                            <span class="text" style="width: 90%">
                                <label><?php echo __t("Libell&eacute;"); ?></label>
                                <input type="text" name="periode" value="<?php echo $anneescolaire['ANNEEACADEMIQUE'] ?>" />
                            </span>
                            <span class="text" style="width: 43%">
                                <label><?php echo __t("D&eacute;but"); ?></label>
                                <input type="text" id="periodedebut" name="periodedebut" value="<?php echo $anneescolaire['DATEDEBUT'] ?>" />
                            </span>
                            <span class="text" style="width: 43%">
                                <label><?php echo __t("Fin"); ?></label>
                                <input type="text" id="periodefin" name="periodefin" value="<?php echo $anneescolaire['DATEFIN'] ?>" />
                            </span>
                        </fieldset>
                        <fieldset style="width: 90%;float: none; margin: auto;"><legend><?php echo __t("Trimestres"); ?></legend>
                            <?php
                            $legences = [__t("1er"), __t("2&egrave;me"), __t("3&egrave;me")];
                            $kk = 0;
                            foreach ($trimestres as $t) {
                                $i = $t['IDTRIMESTRE'];

                                echo '<div>
                                <span class="text" style="width: 90%">
                                    <label>'.__t('Libell&eacute;'). ' '. $legences[$kk].'  '. __t('trimestre').'</label>
                                    <input type="text" name="trimestre' . $i . '" value="' . $t['LIBELLE'] . '" />
                                </span>
                                <span class="text" style="width: 43%">
                                    <label>'.__t('D&eacute;but').'</label>
                                    <input type="text" id="trimestredebut' . $i . '" name="trimestredebut' . $i . '" value="' . $t['DATEDEBUT'] . '" />
                                </span>
                                <span class="text" style="width: 43%">
                                    <label>'.__t('Fin').'</label>
                                    <input type="text" id="trimestrefin' . $i . '" name="trimestrefin' . $i . '" value="' . $t['DATEFIN'] . '" />
                                </span>
                            </div>';
                                $kk++;
                            }
                            ?>
                        </fieldset>
                    </td>
                    <td style="width: 50%">
                        <fieldset style="width: 90%;float: none; margin: auto;"><legend><?php echo __t("S&eacute;quences"); ?></legend>
                            <?php
                            foreach ($sequences as $seq) {
                                $i = $seq['IDSEQUENCE'];
                                echo '<div>
                                <span class="text" style="width: 90%">
                                    <label> '.__t('Libell&eacute;'). ' ' . __t($seq['LIBELLE']) . '</label>
                                    <input type="text" name="sequence' . $i . '" value="' . $seq['LIBELLE'] . '" />
                                </span>
                                <span class="text" style="width: 43%">
                                    <label>'.__t('D&eacute;but').'</label>
                                    <input type="text" id="sequencedebut' . $i . '" name="sequencedebut' . $i . '" value="' . $seq['DATEDEBUT'] . '" />
                                </span>
                                <span class="text" style="width: 43%">
                                    <label>'.__t('Fin').'</label>
                                    <input type="text" id="sequencefin' . $i . '" name="sequencefin' . $i . '" value="' . $seq['DATEFIN'] . '" />
                                </span>
                            </div>';
                            }
                            ?>

                        </fieldset>
                    </td>
                </tr>
            </table>
            <div style="text-align: right; margin: 15px">
                <?php 
                if(isAuth(546)){
                    echo btn_ok("validerForm('periode');"); 
                }?>
            </div>
        </div>
        <div id="onglet2" class="onglet" style="display: none; height: 90%">
            <div id="vacance-content">
                <?php echo $vacanceView; ?>
            </div>
            <div style="text-align: right; margin: 15px">
                <?php 
                if(isAuth(547)){
                    echo btn_ok("validerForm('vacance');");
                }?>
            </div>
        </div>
        <div id="onglet3" class="onglet" style="display: none; height: 90%">
            <div id="ferie-content" style="float: left; width: 75%">
                <table class="dataTable" style="margin: auto" id="tableOperation">
                    <thead><tr><th><?php echo __t("Date"); ?></th><th><?php echo __t("Libell&eacute;"); ?></th><th></th></tr></thead>
                    <tbody>
                        <?php
                        foreach ($feries as $f) {
                            echo "<tr><td>" . date("d/m/Y", strtotime($f['DATEFERIE'])) . "</td><td>" . $f['LIBELLE'] . "</td>";
                            echo "<td align='center'>";
                            if(isAuth(548)){
                                echo "<img src='" . img_delete() . "' style='cursor:pointer' onclick='deleteFerie(" . $f['IDFERIE'] . ")' />";
                            }else{
                                 echo "<img src='".img_delete_disabled()."' style='cursor:pointer' />";
                            }
                            echo "</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div style="float: right; margin: 15px;">
                <?php
                if(isAuth(549)){
                    echo btn_add("ajouterFeries()");
                }?>
            </div>
            <div id="jourferie-dialog-form" class="dialog" title="Saisir des jour f&eacute;ri&eacute;s">
                <span><label><?php echo __t("Date"); ?></label>
                    <input style="width: 90%" type="text" name="feriedate" id="feriedate" />
                </span>
                <span><label><?php echo __t("Libell&eacute;"); ?></label>
                    <input style="width: 90%" type="text" name="ferielibelle" />
                </span>
            </div>

        </div>
        <div id="onglet4" class="onglet" style="display: none; height: 90%">
            <div style="height: 300px">
                <div style="width: 30%">
                    <span class="select" style="width: 90%">
                        <label><?php echo __t("Classes concern&eacute;es (Selection multiple)"); ?></label>
                        <select style="height:250px" name="classes[]" multiple="multiple">
                            <?php
                            foreach ($classes as $cl) {
                                echo "<option value='" . $cl['IDCLASSE'] . "'>" . $cl['LIBELLE'] . ' ' . $cl['NIVEAUSELECT'] . "</option>";
                            }
                            ?>
                        </select>
                    </span>
                </div>
                <div style=" float: right; width: 45%">
                    <span class="text" style="width: 90%">
                        <label><?php echo __t("Libell&eacute; de l'examen"); ?></label>
                        <input type="text" name="examen"  />
                    </span>
                    <span class="text" style="width: 43%">
                        <label><?php echo __t("D&eacute;but de la p&eacute;riode d'examen"); ?></label>
                        <input type="text" id="examendebut" name="examendebut" />
                    </span>
                    <span class="text" style="width: 43%">
                        <label><?php echo __t("Fin de la p&eacute;riode d'examen"); ?></label>
                        <input type="text" id="examenfin" name="examenfin" />
                    </span>
                </div>
                <div style="float: right; margin: 15px; margin-right: 20px; clear: both">
                    <?php 
                    if(isAuth(550)){
                        echo btn_add("ajouterExamen()");
                    }?>
                </div>
            </div>
            <hr style="clear:both" />
            <div id="examen-content">
                <?php echo $examensView; ?>
            </div>
        </div>
        <div id="onglet5" class="onglet" style="display: none; height: 90%">
            <div id="horaire-content">
                <?php echo $horairesView; ?>
            </div>
            <div style="text-align: right; margin: 15px">
                <?php 
                if(isAuth(552)){
                    echo btn_ok("validerForm('horaire');");
                }?>
            </div>
        </div>
        <div id="success_submit" style="text-align:center; font-weight: bold;color:#f26870;"></div>
    </div>

    <div class="navigation">
        <?php //echo btn_ok("validerFormDroit();");  ?>
    </div>
    <input type="hidden" value="" name="actiontype" />
</form>
<div class="status"></div>