<div id="entete">
    <div class="logo"><img src="<?php echo SITE_ROOT . "public/img/wide_classe.png"; ?>" /></div>
</div>
<script>
    $(document).ready(function () {
        $("#tableClasse").DataTable({
            "columns": [
                {"width": "20%"},
                null,
                {"width": "10%"},
            ],
            
        });
    });

</script>

<form action="<?php echo Router::url("classe", "saisie"); ?>" method="post">
    <div class="page">
        <table class="dataTable" id="tableClasse">
            <thead>
                <tr><th><?php echo __t("Nom Abrégé"); ?></th><th><?php echo __t("Libellé"); ?></th>
                    <th><?php echo __t("Action"); ?></th></tr>
            </thead>
            <tbody>
                <?php 
                foreach($classes as $cl){
                    echo "<tr><td>". $cl['NIVEAUHTML']."</td><td>". $cl['LIBELLE']."</td>"
                            . "<td align='right'>"
                            . "<a href='" . Router::url("classe", "inscription", $cl['IDCLASSE']). "'>"
                            . "Inscrire</a>&nbsp;&nbsp;&nbsp;"
                            . "</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    
    <div class="navigation">
        <input type="hidden" value="true" name="saisie" />
        <img src="<?php echo SITE_ROOT . "public/img/btn_add.png" ?>" onclick="document.forms[0].submit();" />
    </div>
</form>
<div class="status"></div>