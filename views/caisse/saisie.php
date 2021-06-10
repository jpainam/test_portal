<style>
    .photo-eleve{
        position: absolute;
        display: block;
        width: 130px;
        height: 130px;
        right: 0;
        margin-right: 20px;
        margin-top: 2px;
        border: 1px solid #CCC;
        background-color: #F7F7F7;
        border-radius: 5px;
        text-align: center;
        vertical-align: middle;
        line-height: 130px;
    }
    #page-content span.select2{
        width: inherit !important;
    }
    @-webkit-keyframes blinker {
        from {opacity: 1.0;}
        to {opacity: 0.0;}
      }
      .blink{
              text-decoration: blink;
              -webkit-animation-name: blinker;
              -webkit-animation-duration: 0.9s;
              -webkit-animation-iteration-count:infinite;
              -webkit-animation-timing-function:ease-in-out;
              -webkit-animation-direction: alternate;
      }

</style>
<div id="entete">
    <div class="logo"><img src="<?php echo SITE_ROOT . "public/img/wide_payement.png"; ?>" /></div>
    <div style="margin-left: 130px">
      <span class="select" style="width: 250px;margin-top: 0">
            <label>Classes : </label>
            <?php echo $comboClasses; ?>
        </span>
        <span class="select2" style="width: 250px !important; margin-top: 0">
            <label>Comptes &eacute;l&egrave;ves : </label>
            <select name="comboComptes" id="comboComptes">
                <option value=""></option>
            </select>
        </span>
    </div>
</div>
<div class="titre">Saisie d'une op&eacute;ration caisse</div>

<form action="<?php echo Router::url("caisse", "saisie"); ?>" method="post" name="frmcaisse">
    <div class="page">
        <?php 
        if(isset($errors)){
            echo "<div style='text-align:center, color:red'>Une erreur liee aux frais obligatoires s'est produite!!!</div>";
        }
        ?>
        <div id="frais_obligatoires"></div>
        <fieldset style="float: none !important; width: 67%; height: 45%;margin: auto;" id="saisie_field">
            <legend>Nouvelle saisie</legend>

            <img src="" alt="Photo eleve" class="photo-eleve">
            <input type="hidden" name="idcompte" value="" />
            <input type="hidden" name="idclasse" value="" />
            <input type="hidden" name="idjournal" value="" />
            <input type="hidden" name="must_pay_required_fees" value="" />
            <span class="text" style="width: 200px"><label>Ref. Transaction : </label>
                <input type="text" name="reftransaction" list="transactions" />
                <datalist id="transactions">
                    <option value="En esp&egrave;ce"></option>
                    <option value="Virement"></option>
                </datalist>
            </span>
            <span class="select" style="width: 190px;"><label>Type de transaction : </label>
                <select name="typetransaction" <?php echo !isAuth(537) ? 'disabled="disabled"' : ''; ?>>
                    <option value="C" selected="selected">Cr&eacute;dit</option>
                    <option value="R">R&eacute;mise</option>
                    <?php 
                    if(isAuth(538)){
                        echo '<option value="M">Moratoire</option>';
                    } ?>
                    <option value="D">D&eacute;bit</option>
                </select>
            </span>
            <span class="text" style="width: 400px;"><label>Description : </label>
                <input type="text" name="description" list="descriptions" />
                <datalist id="descriptions">
                    <option value="Inscription"></option>
                    <option value="Premi&egrave;re tranche"></option>
                    <option value="Deuxi&egrave;me tranche"></option>
                    <option value="Avance premi&egrave;re tranche"></option>
                    <option value="Avance deuxi&egrave;me tranche"></option>
                    <option value="Troisi&egrave;me tranche"></option>
                    <option value="Avance troisi&egrave;me tranche"></option>
                </datalist>
            </span>
            <span class="text" style="width: 400px;"><label>Montant : </label>
                <input type="text" name="montant" style="text-align: right;" />
            </span>
            
            <span class="text" style="width:400px"></span>
            <span class="text" style="width:200px"></span>
            <span class="text" style="width:190px"><label>N° Bordereau Banque</label>
                <input type="text" name="bordereau" />
            </span>
            <?php if(isAuth(538)){ 
                echo '<span class="text" style="width:200px"></span>';
                echo '<span class="text" style="width:190px"><label>Ech&eacute;ance(<small>si moratoire</small>)</label>';
                echo '<input type="date" name="echeance" />';
                echo '</span>';
            }
            ?>
        </fieldset>
    </div>
    <div class="recapitulatif"></div>
    <div class="navigation">
        <div class="editions" style="float: left;">
            <img src="<?php echo img_imprimer(); ?>" />&nbsp;Editions:
            <select onchange="imprimer();" name = "code_impression">
                <option></option>
                <option value="0001">Imprimer ce compte caisse</option>
            </select>
        </div>
        <?php
        if (isAuth(512)) {
            echo btn_add("ValiderCaisse();");
        } else {
            echo btn_add_disabled();
        }
        ?>
    </div>
</form>

<div class="status"></div>
