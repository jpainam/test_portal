<?php
$i = 1;
$legendes = ['', __t('1&egrave;re'), __t('2nde'), __t('3&egrave;me'), __t('4&egrave;me')];
foreach ($vacances as $v) {
    $k = $v['IDVACANCE'];
    if ($i <= 4) {
        $lg = $legendes[$i];
    } else {
        $lg = $i . __t("&egrave;me");
    }
    echo '<fieldset  style="width: 40%;float: left; margin: 5px;"><legend>' . $lg . ' '. __t('p&eacute;riode de vacances').'</legend>
                <span class="text" style="width: 90%">
                    <label>'.__t('Libell&eacute;').'</label>
                    <input type="text" name="vacance' . $k . '" value="' . $v['LIBELLE'] . '" />
                </span>
                <span class="text" style="width: 43%">
                    <label>'.__t('D&eacute;but').'</label>
                    <input type="text" id="vacancedebut' . $k . '" name="vacancedebut' . $k . '" value="' . $v['DATEDEBUT'] . '" />
                </span>
                <span class="text" style="width: 43%">
                    <label>'.__t('Fin').'</label>
                    <input type="text" id="vacancefin' . $k . '" name="vacancefin' . $k . '" value="' . $v['DATEFIN'] . '" />
                </span>
            </fieldset>';
    $i++;
}
for ($j = 1; $j <= 2; $j++) {
    if ($i <= 4) {
        $lg = $legendes[$i];
    } else {
        $lg = $i . __t("&egrave;me");
    }
    echo '<fieldset  style="width: 40%;float: left; margin: 5px;"><legend>' . $lg . ' '.__t('p&eacute;riode de vacances').'</legend>
                <span class="text" style="width: 90%">
                    <label>'.__t('Libell&eacute;').'</label>
                    <input type="text" name="vacancex' . $j . '"  />
                </span>
                <span class="text" style="width: 43%">
                    <label>'.__t('D&eacute;but').'</label>
                    <input type="text" id="vacancedebutx' . $j . '" name="vacancedebutx' . $j . '"  />
                </span>
                <span class="text" style="width: 43%">
                    <label>'.__t('Fin').'</label>
                    <input type="text" id="vacancefinx' . $j . '" name="vacancefinx' . $j . '"  />
                </span>
            </fieldset>';
    $i++;
}
?>
<script>
    $(document).ready(function(){
        $('input[id^=vacancedebut], input[id^=vacancefin]').datepicker({
            dateFormat: 'dd/mm/yy',
            changeMonth: true,
            changeYear: true,
            prevText: '<i class="fa fa-chevron-left"></i>',
            nextText: '<i class="fa fa-chevron-right"></i>'
        });
    });
</script>