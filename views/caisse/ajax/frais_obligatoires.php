<fieldset style="float: none !important; width: 67%; height: 45%;margin: auto; margin-bottom:10px">
    <legend><?php echo __t("Frais obligatoires"); ?></legend>
    <table class="table table-bordered" style="margin: auto; width:100%">
        
    <?php 
    if(isset($fraisobligatoires) && is_array($fraisobligatoires)){
        $i = 0;
        while($i < count($fraisobligatoires)){
            $fr = $fraisobligatoires[$i];
            echo "<tr><td><input type='checkbox' name='fraisobligatoire[]' value='".$fr['CODEFRAIS']."'/>"
                    . "&nbsp;" . $fr['DESCRIPTION'] . " (" . moneyString($fr['MONTANT']). " FCFA)</td>";
            $i++;
            echo "<td>";
            if($i < count($fraisobligatoires)){
                $fr = $fraisobligatoires[$i];
                echo "<input type='checkbox' name='fraisobligatoire[]' value='".$fr['CODEFRAIS']."'/>"
                    . "<label>" . $fr['DESCRIPTION'] . " (" . moneyString($fr['MONTANT']). " FCFA)</td>";
            }
            echo "</td></tr>";
            $i++;
        }
        
    }
    ?>
    </table>
</fieldset>
<div id="info_obligatoire" class="blink" style="color: #ff0033; text-align:center; margin-bottom:10px">
    <?php echo __t("Veuillez vous rassurer des payement des frais obligatoires en cochant les cases ci-dessus!!!"); ?>
</div>
<script>
$(document).ready(function(){
    $("input[name='fraisobligatoire[]'").each(function(index, element){
        $(this).change(function(){
           if ($(this).is(":checked")) {
                //console.log("checked");
                if($("input[name='fraisobligatoire[]']").length === $("input[name='fraisobligatoire[]']:checked").length){
                    disableNouvelleSaisie(false);
                }
           }else{
               if($("input[name='fraisobligatoire[]']").length !== $("input[name='fraisobligatoire[]']:checked").length){
                    disableNouvelleSaisie(true);
                }
           }
            // if($("input[name='fraisobligatoire[]']").length === $("input[name='fraisobligatoire[]']:checked")){
        });
    });
});
</script>