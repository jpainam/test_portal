<div id="entete">

</div>
<form action="<?php echo Router::url("notification", "envoi"); ?>" method="post" name="frmenvoi">
    <div class="page">
        <div class="tabs" style="width: 100%">
            <ul>
                <li id="tab1" class="courant">
                    <a onclick="onglets(1, 1, 3);">
                        <img border ="0" alt="" src="<?php echo SITE_ROOT . "public/img/icons/individuel.png"; ?>" />
                        <?php echo __t("Messages individuel"); ?>
                    </a>
                </li>
                 <li id="tab2" class="noncourant">
                    <a onclick="onglets(1, 2, 3);">
                        <img border ="0" alt="" src="<?php echo SITE_ROOT . "public/img/icons/envoiparclasse.png"; ?>" />
                        <?php echo __t("Messages par classe"); ?>
                    </a>
                </li>
                <li id="tab3" class="noncourant">
                    <a onclick="onglets(1, 3, 3);">
                        <img border ="0" alt="" src="<?php echo SITE_ROOT . "public/img/icons/collectif.png"; ?>" />
                        <?php echo __t("Messages collectif"); ?>
                    </a>
                </li>
            </ul>
        </div>
        <div id="onglet1" class="onglet" style="display: block;height: 80%">
            <span class="text" style="width: 80%"><label><?php echo __t("Destinataire"); ?> : </label><br/>
                    <select style="width: 60%; position:static " class="select2" name="listDestinataire" id="listDestinataire">
                        <option value=""></option>
                        <?php
                        foreach ($destinataires as $d) {
                            $num = "";
                            if(isset($d['NUMSMS']) && !empty($d['NUMSMS']) && is_phone_number($d['NUMSMS'])){
                                $num = $d['NUMSMS'];
                            }elseif(!empty($d['PORTABLE']) && is_phone_number($d['PORTABLE'])){
                                $num = $d['PORTABLE'];
                            }
                            if(!empty($num)){
                                echo "<option value='" . $d['PORTABLE'] . "'>" . $d['NOM'] . "</option>";
                            }
                        }
                        ?>
                    </select> &nbsp;&nbsp;
                    <input style="width: 25%; position: static" type="text" name="destinataire" />
                </span>
            <span class="text" style="width: 79%;"><label><?php echo __t("Sujet"); ?> : </label>
                     <input type="text" name="sujet" /></span>
            <span class="text" style="width: 79%;"><label><?php echo __t("Message"); ?> : </label>
                    <textarea name="message" rows="3" cols="3" ></textarea></span>
            
                <?php echo btn_ok("envoyerSMS();");  ?>
           
        </div>
        <div id="onglet2" class="onglet" style="display: none; height: 90%">

            <span class="text" style="width: 80%"><label><?php echo __t("Destinataire"); ?> : </label>
                    <?php echo $comboParclasse; ?>
                </span>
              <span class="text" style="width: 79%;"><label><?php echo __t("Sujet"); ?> : </label>
                     <input type="text" name="sujetparclasse" /></span>
            <span class="text" style="width: 79%;"><label><?php echo __t("Message"); ?> : </label>
                    <textarea name="messageparclasse" rows="3" cols="3" ></textarea></span>

                <?php echo btn_ok("envoyerParclasse();");  ?>

        </div>
        <div id="onglet3" class="onglet" style="display: none;height: 90%">
                <span class="text" style="width: 80%"><label>Destinataire : </label>
                    <select name="collectif">
                        <option value=""></option>
                        <option value="1">Parents d'&eacute;l&egrave;ves</option>
                        <!-- option value="2">Enseignants de l'Institut</option>
                        <option value="3">Staff permanent de l'Institut</option -->
                    </select>
                </span>
              <span class="text" style="width: 79%;"><label><?php echo __t("Sujet"); ?> : </label>
                     <input type="text" name="sujetcollectif" /></span>
            <span class="text" style="width: 79%;"><label><?php echo __t("Message"); ?> : </label>
                    <textarea name="messagecollectif" rows="3" cols="3" ></textarea></span>


                <?php echo btn_ok("envoyerCollectif();");  ?>
        </div>
    </div>
    <div class="recapitulatif"></div>
    <div class="navigation">
        <?php
        //echo btn_ok("envoyerSMS();");
        ?>
    </div>
</form>
<div class="status">
    <?php if (isset($errors)) { ?>
        <script>
            $(document).ready(function () {
    <?php
    if ($errors) {
        echo "alertWebix('Message non envoy&eacute; <br/>Une erreur s\'est prouite');";
    } else {
        echo "alertWebix('Message envoy&eacute; avec succ&egrave;s');";
    }
    ?>
            });
        </script>
    <?php }
    ?>
</div>