<?php
foreach($elevesnoninscripts as $insc){
    echo "<option value='".$insc['IDELEVE']."'>".$insc['CNOM'].'</option>';
}