<?php
#Impression des statistique par matiere
#
if(empty($notations))
    return;
$pdf->isLandscape = True;
$pdf->setPageOrientation('L');
$pdf->AddPage();
$pdf->SetPrintHeader(false);
# Mettre la page en paysage, valeur par defaut est en portrait
$y = FIRST_TITLE;
#Deactiver le rendu par defaut des entetes pour les page en paysage

//$pdf->LandScapeHeader();
$pdf->setFont("Times", "", 13);

$titre = '<p style="text-decoration:underline">'.__t('STATISTIQUES DES NOTES PAR CLASSE').'</p>';
$pdf->WriteHTMLCell(0, 50, 100, $y + 10, $titre, 0, 1, false, true, '', true);

$cours = '<p><i style="text-decoration:underline">'.__t('Mati&egrave;re').'</i> :  '.$matiere['LIBELLE'].'</p>';

$pdf->WriteHTMLCell(0, 50, 10, $y + 20, $cours, 0, 1, false, true, '', true);
$pdf->WriteHTMLCell(0, 50, 10, $y + 26, '<p>'.__t('P&eacute;riode').' : '.$notations[0]['SEQUENCELIBELLE'].'</p>');

$corps = '<table border="0.5" cellpadding="5"><thead>'
        . '<tr style="text-align:center;font-weight:bold"><th rowspan="2">'.__t('Classe').'</th>'
        . '<th rowspan="2">'.__t('Enseignants').'</th>'
        . '<th rowspan="2">'.__t('Effectif &eacute;valu&eacute;').'</th>'
        . '<th rowspan="2">'.__t('Moyenne g&eacute;n&eacute;rale de la classe').'</th>'
        . '<th rowspan="2">'.__t('Nombre de Moy >= 10').'</th>'
        . '<th colspan="2">'.__t('Taux de r&eacute;ussite').'</th>'
        . '<th rowspan="2">'.__t('Taux de r&eacute;ussite g&eacute;n&eacute;ral').'</th>'
        . '<th rowspan="2">'.__t('Observation').'</th></tr>'
        . '<tr><th>'.__t('Gar&ccedil;ons').'</th><th>'.__t('Filles').'</th></tr></thead><tbody>';
foreach ($notations as $n) {
    $notes = $array_notes[$n['IDNOTATION']];
    $nbre = effectifEvalues($notes);
    # taux[0] = taux des garcons
    # taux[1] = taux des filles
    # taux[2] = taux generale de reussite
    $taux = tauxReussites($notes);
    
    $corps .= '<tr style="text-align:center"><td>'.$n['NIVEAUHTML'].'</td><td>' . $n['NOM'].' '.$n['PRENOM'] . '</td>'
            . '<td>'.$nbre.'</td><td>' . sprintf("%.2f", $n['NOTEMOYENNE']) . '</td>'
            . '<td>' . count(moyenneSup10($notes)) . '</td>'
            . '<td>' . sprintf("%.2f", $taux[0]) . '%</td><td>' . sprintf("%.2f", $taux[1]) . '%</td>'
            . '<td>' . sprintf("%.2f", $taux[2]) . '%</td>'
            . '<td>' . __t(getAppreciations($n['NOTEMOYENNE'])) . '</td></tr>';

}
    $corps .= '</tbody></table>';
$pdf->WriteHTMLCell(0, 5, 10, $y + 35, $corps, 0, 1, false, true, '', true);
$pdf->Output();
