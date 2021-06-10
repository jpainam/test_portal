<div id="entete">
    <div class="logo"><img src="<?php echo SITE_ROOT . "public/img/wide_livre.png"; ?>" /></div>
</div>
<style>
    .courant a{
        background: #F7F7F7;
        border-bottom: 1px solid #F7F7F7;
    }
</style>
<div class="titre">
    Saisie de livres
</div>
<form action="<?php echo url("livre", "saisie"); ?>" method="post" id="frmlivre" >
    <div class="page">
        <fieldset style="width: 600px;float: none; margin: auto; height: 70%"><legend> Information sur un livre</legend>
            <span class="text" style="width: 95%">
                <label> Titre </label>
                <input type="text" name='titre' maxlength="250" />
            </span>
            <span class="text" style="width: 20%">
                <label> ISBN </label>
                <input type="text" name="isbn" maxlength="30"  />
            </span>

            <span class="text" style="width: 35%">
                <label>Ann&eacute;e d'&eacute;dition</label>
                <input type="number" name="edition" maxlength="30" />
            </span>
            <span class="text" style=" width: 35%;">
                <label>Quantit&eacute;</label>
                <input type="number" name="quantite" />
            </span>
            <span class="text" style="width: 95%;">
                <label>publisher</label>
                <input type="text" name="publisher" />
            </span>
             <span class="text" style="width: 46%">
                <label>Auteur 1</label>
                <input type="text" name="auteur[]" maxlength="30" />
            </span>
            <span class="text" style="width: 46.5%">
                <label>Auteur 2</label>
                <input type="text" name="auteur[]" maxlength="30" />
            </span>
            <span class="text" style="width: 46%">
                <label>Auteur 3</label>
                <input type="text" name="auteur[]" maxlength="30" />
            </span>
            <span class="text" style="width: 46.5%">
                <label>Auteur 4</label>
                <input type="text" name="auteur[]" maxlength="30" />
            </span>
            <span class="text" style="width: 95%">
                <label>R&eacute;sum&eacute;/Contenu</label>
                <textarea rows="12" cols="100" name="resume"></textarea>
            </span>
        </fieldset>
    </div>

    <div class="recapitulatif">
        <div class="errors">
            <?php
            if (isset($errors)) {
                echo $message;
            }
            ?>
        </div>
    </div>
    <div class="navigation">
        <?php
        if (isAuth(539)) {
            echo btn_ok("submitForm();");
        }
        if (isAuth(224)) {
            echo btn_cancel("document.location='" . Router::url("livre") . "'");
        } else {
            echo btn_cancel_disabled();
        }
        ?>
    </div>
</form>
<div class="status"></div>