<div id="entete" style="text-align: center">
    <h3><?php echo __t("SYNCHRONISATION DE LA BASE DE DONNEES"); ?> <br/><?php echo __t("AVEC LA BD DISTANTE"); ?></h3>
</div>
<div class="page">
    <table style="border: none; margin: auto;">
        <tbody>
            <tr><td>
                <div style="margin: 10px;">
                    <input style="width: 350px; border: 2px outset buttonface; margin:0" type="button" 
                           value="Synchroniser les emplois du temps" onclick="synchroniser_emplois()"/>
                </div>
                </td><td>
                    <div style="margin: 10px;">
                        <input style="width: 350px; border: 2px outset buttonface; margin:0" type="button" 
                               value="<?php echo __t('Synchroniser les manuels scolaires'); ?>" onclick="synchroniser_manuels()"/>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>

<div class="navigation">

</div>
<div class="status"></div>