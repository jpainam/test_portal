<?php


$y = FIRST_TITLE;
$pdf->AddPage();
$pdf->SetPrintHeader(false);

//$pdf->SetPrintFooter(false);
//Titre du PDF
$titre = '<p>'.__t('ELEVES DEVANT PAYES LES FRAIS SUIVANTS').'</p>';
$pdf->WriteHTMLCell(0, 50, 65, $y, $titre);

$pdf->WriteHTMLCell(0, 5, 10, $y + 10, __t('Classe').' : <b>'.$classe['NIVEAUHTML'].' '.$classe['LIBELLE'].'</b>');
$pdf->WriteHTMLCell(0, 5, 10, $y + 15, __t('Effectif').' : <b>'.$effectif.'</b>');

$corps = __t('Frais')." : <i>";
foreach ($array_of_frais as $frais){
    $corps .= $frais['DESCRIPTION'].' : '.$frais['MONTANT'].'&nbsp;&nbsp;|';
}
$corps = substr($corps, 0, strlen($corps) - 1);

$pdf->WriteHTMLCell(0, 5, 10, $y + 25, $corps."</i>");

//Corps du PDF
$corps = '
        <table border = "0" cellpadding = "5"><thead><tr style = "font-weight:bold">
        <th width="5%">N°</th><th width ="10%">Mle</th><th width ="55%">'.__t('Noms et Pr&eacute;noms').'</th>
        <th width ="15%">'.__t('Date Naiss.').'</th><th align="center" width ="15%">'.__t('Redoublant').'</th></tr></thead><tbody>';
if (!is_array($array_of_redoublants)) {
    $array_of_redoublants = array();
}
$i = 1;
foreach ($eleves as $el) {
    if (in_array($el['IDELEVE'], $array_of_redoublants)) {
        $redoublant = "OUI";
    } else {
        $redoublant = "NON";
    }
    $d = new DateFR($el['DATENAISS']);
    $corps .= '<tr><td width="5%">' . $i . '</td><td width ="10%" style = "border-bottom:1px solid #000">' . $el['MATRICULE'] . '</td>'
            . '<td width ="55%" style = "border-bottom:1px solid #000">' . $el['NOM'] . ' ' . $el['PRENOM'] . '</td>'
            . '<td width ="15%"  style = "border-bottom:1px solid #000">' . $d->getDate() . " " . $d->getMois(3) . " " . $d->getYear() . '</td>'
            . '<td align="center" width ="15%"  style = "border-bottom:1px solid #000">' . $redoublant . '</td></tr>';
    $i++;
}
$corps .= "</tbody></table>";
$pdf->SetFont("Times", '', 10);

//Impression du tableau
//$pdf->writeHTML($corps, true, false, false, false, '');

$pdf->WriteHTMLCell(0, 5, 10, $y + 35, $corps);

$pdf->Output();
