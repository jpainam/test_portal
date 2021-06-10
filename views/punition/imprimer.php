<?php
$pdf->SetTitle('Impression de la punition');
$pdf->SetSubject('Punition IPW');
$pdf->SetKeywords('Puntion, classe, exclusion');
/**
 * 
 */
$pdf->AddPage('P','A4');
$titre ='
        <p style="text-decoration:underline"><b>'.__t("PUNITION").'</b></p>
';
//Le 1 c'est pour mettre la bordure
$pdf->WriteHTMLCell(30, 10, 100, 40, $titre);

/*$pdf->SetXY(120, 40);
$pdf->Write(12, "PUNITION");*/
$pdf->setFontSize(10);

$pdf->writeHTMLCell(0, 140, 10, 60, "<b>".__t('Matricule').": </b>" . $punition['MATRICULE']);
$pdf->writeHTMLCell(0, 140, 10, 67, "<b>".__t('El&egrave;ve puni').": </b>" . $punition['NOM'] . ' '. $punition['PRENOM']);
$pdf->writeHTMLCell(0, 140, 10, 74, "<b>".__t('Type de punition').": </b>" . ucfirst(strtolower($punition['TYPEPUNITION'])));
$pdf->writeHTMLCell(0, 140, 10, 81, "<b>".__t("Motif").": </b>" . $punition['MOTIF']);
$pdf->writeHTMLCell(0, 140, 10, 88, "<b>".__t("Description").": </b>" . $punition['DESCRIPTION']);
$pdf->writeHTMLCell(0, 140, 10, 95, "<b>".__t("Date de la punition").": </b>" . date("d/m/Y", strtotime($punition['DATEPUNITION'])));
$pdf->writeHTMLCell(0, 140, 10, 102, "<b>".__t('Durée').": </b>" . $punition['DUREE']);
$pdf->writeHTMLCell(0, 140, 10, 109, "<b>".__t("Puni par").": </b>" . $punition['PUNISSEUR']);

$pdf->Output();