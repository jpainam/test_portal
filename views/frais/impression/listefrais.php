<?php
$y = FIRST_TITLE;
$pdf->AddPage();
$pdf->SetPrintHeader(false);


$titre = '<p style="text-decoration:underline">'.__t('FRAIS SCOLAIRES').'</p>';
$pdf->WriteHTMLCell(0, 5, 90, $y, $titre);

$pdf->setFont('Times', '', 10);
$corps = '<table border="0.5" cellpadding="5">'
        . '<thead><tr style="font-weight:bold">'
        . '<th width="15%">'.__t('Classe').'</th><th width="45%">'.__t('Libell&eacute;').'</th>'
        . '<th width="20%">'.__t('Montant').'</th><th width="20%">'.__t('Ech&eacute;ance').'</th></tr></thead><tbody>';

foreach ($frais as $f) {
    $corps .= '<tr><td width="15%">' . $f['NIVEAUHTML'] . '</td>'
            . '<td width="45%">' . $f['DESCRIPTION'] . '</td>'
            . '<td width="20%" align="right">'.moneyString($f['MONTANT']).'</td>'
            . '<td width="20%" align="right">'. date("d/m/Y", strtotime($f['ECHEANCES'])).'</td></tr>';
}
$corps .= '</tbody></table>';

$pdf->WriteHTMLCell(0, 5, 10, $y + 15, $corps);
$pdf->Output();

