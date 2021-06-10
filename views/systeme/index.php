<style>
    #systemeTable tr td:first-child{
        text-align: center;
    }
</style>
<div id="entete">
    <div class="logo"><img src="<?php echo SITE_ROOT ?>public/img/systeme.png" /></div>
    <div style="margin-left: 120px; text-align: center">
        <h3><?php echo __t("PARAMETRE SYSTEME"); ?></h3>
    </div>
</div>
<div class="page">
    <?php 
    $keys = [];
    foreach($params as $pa){
        $keys[$pa['CLE']] = $pa['VALEUR'];
    }
    ?>
    <table id="systemeTable" class="dataTable" style="border: none; margin: auto;">
        <thead><tr><th>#</th><th><?php echo __t("Propriet&eacute;s"); ?></th></tr></thead>
        <tbody>
            <tr><td><input 
                        <?php if($keys[SEND_NOTIFICATION_DIRECTLY] != '0'){
                            echo " checked ";
                        }
                      ?>
                        type="checkbox" value="sync_realtime" /></td>
                <td><?php echo __t("Synchroniser en temps réel vos données avec la BD distante"); ?></td>
            </tr>
            <tr><td><input <?php if($keys[SEND_NOTIFICATION_APPEL_DIRECTLY] != '0'){
                echo " checked ";
            } ?>
                        type="checkbox" value="appel_realtime" /></td>
                <td><?php echo __t("Envoi direct des notifications d'appels apr&egrave;s validation de l'appel"); ?></td>
            </tr>
            <tr><td><input <?php if($keys[SEND_NOTIFICATION_CAISSE_DIRECTLY] != '0'){
                echo " checked ";
            } ?>
                        type="checkbox" value="caisse_realtime" /></td>
                <td><?php echo __t("Envoi direct des op&eacute;rations caisses apr&egrave;s validation"); ?></td>
            </tr>
        </tbody>
    </table>
</div>

<div class="navigation">

</div>
<div class="status"></div>
