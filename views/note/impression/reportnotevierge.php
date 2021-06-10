<?php
#Fiche de report de note vierge
# accessible grace a note/saisie
# code d'impression 0001
$y = FIRST_TITLE;
$pdf->AddPage();
$pdf->SetPrintHeader(false);
//Titre du PDF

$titre = '<p style = "text-decoration:underline">'.__t('FICHE DE REPORT DE NOTES').': ' . $anneescolaire . '</p>';
$pdf->WriteHTMLCell(0, 50, 60, $y, $titre);


$pdf->SetFont("Times", "", 10);
$titre = '<p>'.__t('CLASSE').'  : <i>' . $classe['NIVEAUHTML'].' '.$classe['LIBELLE']."</i></p>";
$pdf->WriteHTMLCell(0, 5, 15, $y + 15, $titre);

$enseignant = '<p>'.__t('Enseignant').'  : <i>'.$enseignement['NOM'].' '.$enseignement['PRENOM']."</i></p>";
$pdf->WriteHTMLCell(0, 5, 120, $y + 15, $enseignant);

$pdf->WriteHTMLCell(0, 5, 15, $y + 20, '<p>'.__t('Date').' : .....</p>');

$matiere = '<p>'.__t('Mati&egrave;re').' : <i>'.$enseignement['MATIERELIBELLE'].'</i></p>';
$pdf->WriteHTMLCell(0, 5, 120, $y + 20, $matiere);

$libelle = '<p>Libell&eacute; du devoir : .....</p>';
$pdf->WriteHTMLCell(0, 5, 15, $y + 25, $libelle);

$pdf->WriteHTMLCell(0, 5, 120, $y + 25, '<p>'.__t('Coefficient').' : <i>'.$enseignement['COEFF'].'</i></p>');

$pdf->WriteHTMLCell(0, 5, 15, $y + 30, '<p>'.__t('Note sur').' : .....</p>');

$pdf->WriteHTMLCell(0, 5, 120, $y + 30, '<p>'.__t('P&eacute;riode').' : .....</p>');

$pdf->SetFont("Times", '', 10);

$corps = '<table cellpadding = "2"><thead ><tr border="0.5" style="font-weight:bold"><th width="5%" border="0.5">N°</th>'
        . '<th border="0.5"width="50%">'.__t('Noms et Pr&eacute;noms').'</th>';
$corps .= '<th width="10%" border="0.5">'.__t('Note').'</th><th width="10%" border="0.5">'.__t('Absent').'</th>'
        . '<th width="25%" border="0.5">'.__t('Observations').'</th></tr></thead><tbody>';
$i = 1;
foreach($eleves as $el){
    $corps .= '<tr><td width="5%" border="0.5">'.$i.'</td>'
            . '<td width="50%" border="0.5">'.$el['NOM'].' '.$el['PRENOM'].'</td>'
            . '<td width="10%" border="0.5"></td><td width="10%" border="0.5"></td>'
            . '<td width="25%" border="0.5"></td></tr>';
    $i++;
}
$corps .= '</tbody></table>';
$pdf->WriteHTMLCell(0, 5, 15, $y + 40, $corps);

$pdf->Output();
