<?php
// set margins (left, top, right, keepmargin)
$pdf->SetMargins(25, 20, 35, true);
#$pdf->SetHeaderMargin(20);
#$pdf->SetFooterMargin(20);
$pdf->setPageOrientation('L');
$pdf->setCellHeightRatio(1.5);
# Desactiver le texte de signature pour les bulletins
$y = PDF_Y;
$today = new DateFR();
foreach ($rangs as $rang) {
	if($rang['MOYGENERALE'] >= 12){
		$pdf->SetPrintFooter(false);
		$pdf->SetPrintHeader(false);
		$pdf->AddPage();
		$nomel = $rang['NOMEL'].' '.$rang['PRENOMEL']. ' ' . $rang['AUTRENOMEL'];
		$pdf->Bookmark($nomel, 1, 0, '', '', array(0, 0, 0));
		$pdf->SetFont("helvetica", 'B', 13);
		$pdf->WriteHTMLCell(0, 5, 30, 40, 'MINISTERE DES ENSEIGNEMENTS');
		$pdf->WriteHTMLCell(0, 5, 50, 45, 'SECONDAIRES');
		$pdf->Image($logo, 120, 40, 55, 35, '', '', 'T', false, 300, '', false, false, 0, false, false, false);

		$pdf->WriteHTMLCell(0, 100, 180, 40, 'INSTITUT POLYVALENT BILINGUE ');
		$pdf->WriteHTMLCell(0, 5, 210, 45, 'WAGUE');
		//$pdf->RoundedRect(80, $y - 10, 65, 7, 2.0, '1111', 'DF', array("width" => 0.5, "color" => array(0, 0, 0)), array(255, 255, 255));
		$pdf->SetFont('algerian', 'B', 30, '', false);
		$pdf->WriteHTMLCell(0, 5, 90, $y + 30, 'TABLEAU D\'HONNEUR');

		$pdf->SetFont("Times", '', 20);
		#$pdf->WriteHTMLCell(0, 5, 56, $y + 8, "D&eacute;cern&eacute; à :&nbsp;<b>". $rang['NOMEL'] . " " . $rang['PRENOMEL'] . ' ' . $rang['AUTRENOMEL'] . '</b>');
		$d = new DateFR($rang['DATENAISSEL']);
		$naiss = ":&nbsp;<b>". $d->getDate() . " " . $d->getMois(3) . "-" . $d->getYear();
    	if (!empty($rang['LIEUNAISSEL'])) {
        	$naiss .= " &agrave; " . $rang['LIEUNAISSEL'];
    	}
    	$naiss .= '</b>';
		$expo = intval($rang['RANG']) == 1 ? "er" : "e";
		$texte = 'D&eacute;cern&eacute; à :&nbsp;<b>'.$nomel .' </b><br/>';
		$texte .= 'N&eacute;(e) le '. $naiss .' de la classe de <b> '.  $classe['NIVEAUHTML'] . '</b>';
		$texte .= ' pour s\'&ecirc;tre particuli&egrave;rement distingu&eacute;(e) par son travail ';
		$texte .= 'et sa discipline tout au long de l\'ann&eacute;e scolaire <b> '.  $_SESSION['anneeacademique'] . '</b>';
		$texte .= ' en occupant le <b> '. $rang['RANG'].'<sup>'.$expo.'</sup></b> rang avec une moyenne de <b> '. $rang['MOYGENERALE'] . '.</b>';

		$pdf->WriteHTMLCell(0, 5, 30, $y + 50, $texte."\n", 0, 0, 0, true, 'J');

		$pdf->WriteHTMLCell(0, 5, 130, $y + 100, 'Fait à Nkolfoulou1, le ' . $today->getDate().' '. $today->getMois(3). ' '.$today->getYear());
		$pdf->WriteHTMLCell(0, 5, 180, $y + 110, '<b>Le Principal</b>');
	}
}
$pdf->Output();