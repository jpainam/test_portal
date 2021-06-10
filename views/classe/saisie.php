<div id="entete">
    <div class="logo"><img src="<?php echo SITE_ROOT ?>public/img/wide_classe.png"></div>
</div>
<div class="titre"><?php echo __t("Saisie des classes"); ?></div>
<form action="<?php echo url('classe', 'saisie'); ?>" method="post" enctype="multipart/form-data" name="frmclasse">
    <div class="page" style="">
        <fieldset style="margin:auto; width: 710px;margin-bottom: 10px;float: none;"><legend><?php echo __t("Saisie de la classe"); ?></legend>
            <span class="text" style="width: 172px;"><label><?php echo __t("Num&eacute;ro"); ?></label>
                <select name="numero">
                    <option value=""></option>
                    <?php 
                    for($i = 1; $i <= 6; $i++){
                        echo "<option value='".$i."'>".$i."</option>";
                    } ?>
                </select>
            </span>
            <span class="text" style="width: 172px"><label><?php echo __t("Exposant"); ?></label>
                <?php $exposant = ["ère", "ème", "è", "e", "nde"]; ?>
                <datalist id="exposantlist">
                  <?php 
                  foreach($exposant as $ex){
                      echo "<option value='".$ex."'/>";
                  }
                  ?>
                </datalist>
                <input type="text" name="exposant" list="exposantlist" value="" />
            </span>
            <span class="text" style="width: 150px"><label><?php echo __t("Code"); ?></label>
                <?php $abreges = ["All", "Esp", "C", "D", "E", "A4 All", "A4 Esp"]; ?>
                <datalist id="abregelist">
                  <?php 
                  foreach($abreges as $ab){
                      echo "<option value='".$ab."'/>";
                  }
                  ?>
                </datalist>
                <input type="text" name="abrege" list="abregelist" value="" />
            </span>
            <br style="clear: both"/>
            <span class="select" style="width: 172px;"><label><?php echo __t("Cycle"); ?></label>
                <select name="cycle">
                    <option value="1"><?php echo __t("1er cycle"); ?></option>
                    <option value="2"><?php echo __t("2nd cycle"); ?></option>
                </select>
            </span>
            <span class="select" style="width: 172px"><label><?php echo __t("Type"); ?></label>
                <select name="type">
                    <option value="G"><?php echo __t("Enseignement Général"); ?></option>
                    <option value="C"><?php echo __t("Ens. Technique Commercial"); ?></option>
                    <option value="I"><?php echo __t("Ens. Technique Industrielle"); ?></option>
                </select>
            </span>
            <span class="select" style="width: 150px"><label><?php echo __t("Niveau"); ?></label>
                <select name="groupe">
                    <?php for($i = 6; $i >= 0; $i--){
                        echo "<option value='".$i."'>".$i."</option>";
                    }
                    ?>
                </select>
            </span>
             <br style="clear: both"/>
             
             
            <span class="text" style="width: 360px;"><label><?php echo __t("Nom complet"); ?></label>
                <datalist id="nomlist">
                    <option value="Sixième"/>
                    <option value="Cinquième"/>
                    <option value="Terminale Esp"/>
                    <option value="Terminale All"/>
                </datalist>
                <input type="text" name="libelle" list="nomlist" /></span>
            <span class="select" style="width: 150px;">    
                <label><?php echo __t("Section"); ?></label>
                <select name="section">
                    <option value="FRA"><?php echo __t("Francophone"); ?></option>
                    <option value="ANG"><?php echo __t("Anglophone"); ?></option>
                </select>
            </span>
            <br style="clear: both"/>
            <h2><?php echo __t("R&eacute;sultat") ;?> : 
            <span id="resultclass" style="margin-left: 10px">
               
            </span>
           </h2>
             <h2><?php echo __t("R&eacute;sultat complet") ;?> : 
            <span id="resultlong" style="margin-left: 10px">
               
            </span>
           </h2>
        </fieldset>
    </div>
    <div class="recapitulatif" >
        <?php
        if ($errors) {
            echo "<div class = 'errors'>" . $message . "</div>";
        }
        ?>
    </div>
    <div class="navigation">
        <?php
        echo btn_ok("soumettreFormClasse();");
        ?>
        
        &nbsp;&nbsp;&nbsp;&nbsp;
        <img  src="<?php echo SITE_ROOT . "public/img/btn_cancel.png" ?> " 
              onclick="annulerSaisieClasse();" />
    </div>

</form>
<div class="status"></div>