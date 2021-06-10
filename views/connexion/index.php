<div align="center" style="margin:auto;">
    <div id="submenu" style="text-shadow:1px 1px 2px #808040; font-variant:small-caps;font-weight:bold;border-top-style:solid;">
        <?php echo __t("Portail De Connexion"); ?>    
    </div>
</div>
<div id="content" style="margin-top:20px;">
    <form action ="<?php echo Router::url('connexion'); ?>" method="post">     			
        <div class="contenu">
            <p class="titleconnexion"><?php echo $school['NOM']; ?></p>
            <p class="trait"></p>
            <div>
                <table border="0" cellspacing="5" style="margin:auto;">
                    <tr>
                        <td>
                            <label class="txt" title="Nom Utilisateur ou matricule"><?php echo __t("Nom Utilisateur"); ?> :</label>
                        </td>
                        <td>
                            <input type="text" maxlength="100" size="30" name="login" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="txt"><?php echo __t("Mot de Passe"); ?>  :</label>
                        </td>
                        <td>
                            <input type="password" maxlength="100" size="30" name="pwd"  accesskey="enter"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label class="txt" title="Ann&eacute;e Acad&eacute;mique"><?php echo __t("Ann&eacute;e Scolaire"); ?> : </label></td>
                        <td>
                            <?php echo $anneeacademique; ?>
                        </td>
                    </tr>
                     <tr>
                        <td>
                            <label class="txt"><?php echo __t("Langue"); ?> :</label>
                        </td>
                        <td>
                            <select name="langue" style="width: 100%">
                                <?php 
                                if(isset($_COOKIE['langue']) && $_COOKIE['langue'] === "en"){
                                    echo '<option value="fr">Fran&ccedil;ais</option>';
                                    echo '<option value="en" selected="selected">Anglais</option>';
                                }elseif(isset($_COOKIE['langue']) && $_COOKIE['langue'] === "fr"){
                                    echo '<option value="fr" selected="selected">Fran&ccedil;ais</option>';
                                    echo '<option value="en" >Anglais</option>';
                                }else{
                                    echo '<option value="fr">Fran&ccedil;ais</option>';
                                    echo '<option value="en" >Anglais</option>';
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <?php
                            if ($errors) {
                                echo "<div id=\"erreur\">".__t('Erreur de connexion')."<br/>"
                                . __t("Verifier votre mot de passe ou utilisateur")."</div>";
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="right">
                            <input type="submit" id="but" value="Connexion" accesskey="enter"/>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </form>
</div>

