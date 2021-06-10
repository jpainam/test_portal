<?php
$y = FIRST_TITLE;
$pdf->AddPage();
$pdf->SetPrintHeader(false);


$titre = '<p style="text-decoration:underline">CAHIER DE TEXTE</p>';
$pdf->WriteHTMLCell(0, 5, 90, $y, $titre);
$pdf->WriteHTMLCell(0, 5, 10, $y + 10, '<b>Classe: ' . $classe['LIBELLE'] . ' ' . $classe['NIVEAUHTML'].'</b>');

$pdf->WriteHTMLCell(0, 5, 10, $y + 15, '<b>Mati&egrave;re: ' . $matiere['MATIERELIBELLE'].'</b>');


$pdf->setFont('Times', '', 9);
$corps = '<table border="0.5" cellpadding="5">'
        . '<thead><tr style="font-weight:bold"><th width="10%">Date</th>'
        . '<th width="15%">Heures</th><th width="25%">Objectif</th>'
        . '<th width="55%">Contenu</th></tr></thead><tbody>';

foreach ($cahier as $c) {
    $corps .= '<tr><td width="10%">' . date("d/m/Y", strtotime($c['DATESAISIE'])) . '</td>'
            . '<td width="15%">' . $c['HEUREDEBUT'] . '-' . $c['HEUREFIN'].'</td>'
            . '<td width="25%">' . $c['OBJECTIF'] . '</td>'
            . '<td width="55%" align="right">'.$c['CONTENU'].'</td></tr>';
}
$corps .= '</tbody></table>';

$pdf->WriteHTMLCell(0, 5, 10, $y + 25, $corps);
$pdf->Output();

