<table class="dataTable" id="tableEleves">
    <thead><tr><th><?php echo __t("Matricule "); ?></th><th><?php echo __t("Noms et Pr&eacute;noms"); ?></th>
            <th><?php echo __t("Sexe"); ?></th><th><?php echo __t("Classe"); ?></th>
            <th><?php echo __t("Redoublant"); ?></th></tr></thead>
    <tbody>
        <?php 
        $array_of_redoublants = (is_null($array_of_redoublants) ? array() : $array_of_redoublants);
        foreach ($eleves as $el) {
            echo "<tr><td>" . $el['MATRICULE'] . "</td><td>" . $el['NOM'] . " " . $el['PRENOM'] . "</td>"
            . "<td>" . $el['SEXE'] . "</td><td>" . $el['NIVEAUHTML'] . "</td>";
            if (in_array($el['IDELEVE'], $array_of_redoublants)) {
                echo "<td align='center'><input type='checkbox' disabled checked /></td>";
            } else {
                echo "<td align='center'><input type='checkbox' disabled /></td>";
            }
        }
        ?>
    </tbody>
</table>
<script>
$(document).ready(function(){
   if(!$.fn.DataTable.isDataTable("#tableEleves")){
       $("#tableEleves").DataTable({
           paging: false,
           bInfo: false,
          columns: [
              {"width" : "10%"},
              null,
              {"width" : "7%"},
              {"width" : "10%"},
              {"width" : "10%"}
          ] 
       });
   } 
});
</script>