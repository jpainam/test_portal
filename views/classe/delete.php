<div id="entete">
    
</div>
<div class="titre"><?php echo __t("Suppression d'une classe"); ?></div>
<div class="page">
    <h1 class="errors" style="font-size: 18px"><blink>ERREUR</blink></h1>
</div>
<div class="recapitulatif">
    <?php if($errors){
        echo "<div class = 'errors'> Erreur lors de la suppresion</div>";
    } ?>
    
</div>
<div class="navigation">
    <a href="<?php echo Router::url("classe", "saisie"); ?>" ><?php echo __t("Liste des classe"); ?></a>
</div>
<div class="status"></div>