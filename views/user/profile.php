<div id="entete">
    <div class="logo">

    </div>
    <div  style="margin-left: 100px">
        <span class="select" style="width: 250px">
            <label>Profile utilisateur : </label>
            <?php
            echo $comboProfiles;
            ?>
        </span>
    </div>
</div>
<form name="frmprofile" action="<?php echo Router::url("user", "profile"); ?>" method="post">
    <div class="page">
        <div id="listeusers" style="float: left; width: 285px; position: relative">
            <table id="tableusers" class="dataTable">
                <thead>
                    <tr><th></th><th>Noms et Pr&eacute;noms</th><th align='center'><input type="checkbox" name="chk_all_user" /></th></tr>
                </thead>
                <tbody>
                    <?php 
                    /*foreach($personnels as $p){
                        $apellation = $p['NOM'].' '.$p['PRENOM'];
                        echo "<tr><td>".$p['CIVILITE']."</td><td>".$apellation."</td>"
                                . "<td align='center'><input type='checkbox' /></td></tr>";
                    }*/
                    ?>
                </tbody>
            </table>
        </div>
        <div id="listedroits" style="width: 550px; float: right; ">
            <table id="tabledroits" class="dataTable">
                <thead>
                    <tr><th>Code</th><th>Description du droits</th><th align='center'><input type="checkbox" name="chk_all_droit" /></th></tr>
                </thead>
                <tbody>
                    <?php 
                    /*foreach($droits as $d){
                        echo "<tr><td style='border-left:1px solid #000'>".$d['CODEDROIT']."</td><td>".$d['LIBELLE']."</td>"
                                . "<td align='center'><input type='checkbox' /></td></tr>";
                    }*/
                    ?>
                </tbody>
            </table>
        </div>
        <p style="clear:both ; text-align: center; color: red">
            Cocher les utilisateurs ainsi que les droits &agrave; appliquer &agrave; ces derniers
        </p>
    </div>
    
    <div class="navigation">
        <?php echo btn_ok("validerDroit();"); ?>
    </div>
    <input type="hidden" name="profile" value="" />
</form>
<div class="status">

</div>