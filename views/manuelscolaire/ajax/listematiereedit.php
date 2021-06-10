<option value=""></option>
<?php
foreach($enseignements as $ens){
    if($mat['IDENSEIGNEMENT'] === $idenseignement){
         echo "<option selected value='".$ens['IDENSEIGNEMENT']."'>" . $ens['MATIERELIBELLE'] . "</option>";  
    }else{
        echo "<option value='".$ens['IDENSEIGNEMENT']."'>" . $ens['MATIERELIBELLE'] . "</option>";  
    }
}