<?php
 $pdf->SetMargins(0, 0, 0, 0);
$pdf->bCertify = false;
$pdf->SetPrintFooter(false);
$pdf->SetPrintHeader(false);
$pdf->AddPage('L', 'A7');
//Image($file, $x='', $y='', $w=0, $h=0, $type='', $link='', $align='', $resize=false, $dpi=300, $palign='', 
$pdf->Image(SITE_ROOT . "public/photos/bg.jpg", 0, 0, 200, 20, '', '', '', false, 300, '', false, false, 0);
#$pdf->Image(SITE_ROOT . "public/photos/footer.jpg", 0, 50, 200, 20, '', '', '', false, 300, '', false, false, 0);
$y = 60;
$pdf->WriteHTMLCell(0, 0, 2, 10, '<b>ETABLISSEMENT</b>');

if(!empty($eleve['PHOTO'])){
   $photo = SITE_ROOT . "public/photos/eleves/" . $eleve['PHOTO'];
   $pdf->Image($photo, 80, 10, 20, 18, '', '', 'T', false, 300, '', false, false, 1, false, false, false);
}else{
    $photo = SITE_ROOT . "public/photos/avatar_default.png";
    $pdf->Image($photo, 80, 10, 20, 18, '', '', 'T', false, 300, '', false, false, 1, false, false, false);
}

$pdf->setFontSize(7);
$pdf->WriteHTMLCell(0, 0, 2, 20, '<b>Nom Prénom: </b>'. $eleve['PRENOM']. ' '. $eleve['NOM'] );
$pdf->WriteHTMLCell(0, 0, 2, 25, '<b>Date de Naissance: </b>'.(!empty($eleve['DATENAISS']) ? date("d/m/Y", strtotime($eleve['DATENAISS'])):""));
$pdf->WriteHTMLCell(0, 0, 2, 30, '<b>Année scolaire: </b>'.$_SESSION['anneeacademique']);
$pdf->WriteHTMLCell(0, 0, 2, 35, '<b>Classe: </b>'.$eleve['NIVEAUHTML']);
$pdf->WriteHTMLCell(80, 0, 80, 35, '<b>Matricule: </b>'.$eleve['MATRICULE']);
$pdf->WriteHTMLCell(0, 0, 2, 45, '<b>Adresse: </b>'.$eleve['ADRESSE']);
$pdf->WriteHTMLCell(0, 0, 2, 50, '<b>Téléphone: </b>'.$eleve['PORTABLE']);
$pdf->WriteHTMLCell(0, 0, 80, 50, '<b>Email: </b>'.$eleve['EMAIL']);


$pdf->Output();