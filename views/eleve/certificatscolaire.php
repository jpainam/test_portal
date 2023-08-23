<?php
$pdf->bCertify = false;
$pdf->SetPrintFooter(false);
$pdf->AddPage();
$y = FIRST_TITLE;
$middle = PDF_MIDDLE;
$pdf->SetFont("Times", '', 20);
$titre = '<h1>CERTIFICAT DE SCOLARITE</h1>';
$pdf->WriteHTMLCell(0, 5, $middle - 70, $y + 20, $titre);

$pdf->SetFont("Times", '', 15);
$d = new DateFR($eleve['DATENAISS']);
$corps = '<p style="line-height:30px;text-align:justify;">Je soussign&eacute;<b>  Monsieur DAMI KEMADJOU BERTRAND BLAISE, '
        . 'Principal</b> de l\'<b>Institut Polyvalent Bilingue WAGUE</b><br/>'
        . 'Certifie par la pr&eacute;sente que :<br/> '
        . '<b>'.($eleve['SEXE'] == "M" ? "M. ": "Mlle").' '.$eleve['NOM'].' '.$eleve['PRENOM'].' ' . $eleve['AUTRENOM'].'</b><br/>'
        . 'N&eacute;(e) le  <b>'.$d->getDate().' '.$d->getMois().' '.$d->getYear().'</b> '
        . '&agrave;  <b>'.$eleve['LIEUNAISS'].'</b> '
        . 'est inscrit(e) dans les r&eacute;gistres de notre &eacute;tablissement pour le compte de l\'ann&eacute;e scolaire '
        .$anneescolaire. ' en classe de  <b><br/>'. ($classe['SECTION'] === "ANG" ? $classe['LIBELLE'] : $classe['NIVEAUHTML']).'</b> '
        . 'sous le num&eacute;ro matricule : <b>'.$eleve['MATRICULE'].'</b><br/><br/>'
        . 'En foi de quoi, la pr&eacute;sente attestation est &eacute;tablie pour servir et valoir ce que de droit.</p>';
$pdf->WriteHTMLCell(0, 0, 20, $y + 40, $corps);

$d->setSource(date("Y-m-d", time()));
$pdf->WriteHTMLCell(0, 0, 110, $y + 170, '<b>Nkolfoulou , le '.$d->getDate().' '.$d->getMois().' '.$d->getYear().'</b>');
$pdf->WriteHTMLCell(0, 0, 130, $y + 190, '<b><u>Le Principal</u></b>');

#$pdf->setFont("Times", '', 7);
#$pdf->WriteHTMLCell(0, 5, 50, $y + 220, '<b>En cas de doute  sur l\'authenticit&eacute; de ce document,
#        merci d\'appeler l\'IPW AU 699 58 40 78</b>');

$pdf->Output();