<?php
$y = FIRST_TITLE;
$pdf->AddPage();
$pdf->SetPrintHeader(false);


$titre = '<p style="text-decoration:underline"><b>'.__t('LISTE DES MANUELS SCOLAIRES').'</b></p>';
$pdf->WriteHTMLCell(0, 5, 75, $y, $titre);
$pdf->WriteHTMLCell(0, 5, 10, $y + 10, '<b>'.__t('ANNEE').': ' . $_SESSION['anneeacademique'] . '</b>');
$pdf->WriteHTMLCell(0, 5, 90, $y + 10, '<b>'.__t('CLASSE').': ' . $classe['NIVEAUHTML'] . '</b>');

$corps = '<table border="0.5" cellpadding="5">'
        . '<thead><tr style="font-weight:bold">'
        . '<th width="40%">'.__t('Titre').'</th><th width="25%">'.__t('Editeurs').'</th>'
        . '<th width="25%">'.__t('Auteurs').'</th><th width="12%">'.__t('Prix').'</th></tr></thead><tbody>';

foreach ($manuels as $m) {
    $corps .= '<tr><td width="40%">' . $m['TITRE'] . '</td>'
            . '<td width="25%">' . $m['EDITEURS'] . '</td>'
            . '<td width="25%">'.$m['AUTEURS'].'</td>'
            . '<td width="12%" align="right">'. $m['PRIX'].'</td></tr>';
}
$corps .= '</tbody></table>';

$pdf->setFont("Times", "", 10);
$pdf->WriteHTMLCell(0, 5, 10, $y + 20, $corps);
$pdf->Output();

