<?php

//var_dump($rang);die();
global $bas_bulletin;
if ($codeperiode === "S") {
    $bas_bulletin[1] = $sequence['VERROUILLER'];
} elseif ($codeperiode === "T") {
    $bas_bulletin[1] = "U";
} elseif ($codeperiode === "A") {
    $bas_bulletin[1] = "A";
}
$bas_bulletin[2] = "ANG";
$pdf->SetPrintFooter(true);
# Desactiver le texte de signature pour les bulletins
$pdf->bCertify = false;
$pdf->AddPage();

$pdf->leftUpCorner = 10;

# Largeur des colonnes
$col = getLargeurColonneANG($codeperiode);

#creer les trois groupes de matieres et envoyer cela a la vue
$tab = trierParGroupe($notes, $rang['IDELEVE']);
$groupe1 = $tab[0];
$groupe2 = $tab[1];
$groupe3 = $tab[2];
$array_of_redoublants = is_null($array_of_redoublants) ? array() : $array_of_redoublants;

$style = array(
    'text' => true,
);


$pdf->setFont("helvetica", '', 13);
$y = PDF_Y + 10;
$pdf->RoundedRect(55, $y - 10, 103, 8, 2.0, '1111', 'DF', array("width" => 0.5, "color" => array(0, 0, 0)), array(255, 255, 255));
if ($codeperiode === "A") {
    $titre = '<div>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ANNUAL PROGRESS REPORT</div>';
} elseif($codeperiode == "S") {
    $titre = '<div>MONTHLY PROGRESS REPORT CARD N° ' . $sequence['ORDRE'].'</div>';
}elseif ($codeperiode === "T"){
    $titre = '<div>&nbsp;&nbsp;&nbsp;TERM PROGRESS REPORT CARD N° ' . $trimestre['ORDRE'].'</div>';
}
$pdf->WriteHTMLCell(0, 5, 58, $y - 9, $titre);
//$pdf->SetFont("Times", "B", 10);
$pdf->setFont("helvetica", "B", 10);

$annee = "School Year " . $_SESSION['anneeacademique'];
$pdf->WriteHTMLCell(150, 5, 158, $y - 20, $annee);


# Le cadre pour la photo
$photo = SITE_ROOT . "public/photos/eleves/" . $rang['PHOTOEL'];

if (!empty($rang['PHOTOEL']) && file_exists(ROOT . DS . "public" . DS . "photos" . DS . "eleves" . DS . $rang['PHOTOEL'])) {
    //ROOT . DS . "public" . DS . "photos" . DS . "eleves" . DS . 
    $pdf->Image($photo, 15, $y, 20, 18, '', '', 'T', false, 300, '', false, false, 1, false, false, false);
} else {
    $pdf->WriteHTMLCell(20, 18, 15, $y, '<br/><br/>PHOTO', 1, 2, false, true, 'C');
}
$pdf->Rect(37, $y, 160, 13, 'DF');

if (in_array($rang['IDELEVE'], $array_of_redoublants)) {
    $redoublant = "YES";
} else {
    $redoublant = "NO";
}
//$pdf->SetFont("Times", "", 9);
$pdf->setFont("helvetica", '', 9);
$d = new DateFR($rang['DATENAISSEL']);

$pdf->WriteHTMLCell(0, 5, 37, $y, 'Reg. Number');
$pdf->WriteHTMLCell(0, 5, 70, $y, ':&nbsp;<b>' . $rang['MATRICULEEL'] . '</b>');

$pdf->WriteHTMLCell(0, 5, 37, $y + 4, 'First and Last name');
$pdf->WriteHTMLCell(0, 5, 70, $y + 4, ':&nbsp;<b>' . $rang['NOMEL'] . " " . $rang['PRENOMEL'] . ' ' . $rang['AUTRENOMEL'] . '</b>');


$pdf->WriteHTMLCell(0, 5, 37, $y + 8, 'Date and place of birth ');
$naiss =   ':&nbsp;<b>' . $d->getDate() . " " . $d->getMois(3) . "-" . $d->getYear();
if (!empty($rang['LIEUNAISSEL'])) {
    $naiss .= " At " . $rang['LIEUNAISSEL'];
}
$naiss .= '</b>';
$pdf->WriteHTMLCell(0, 5, 70, $y + 8, $naiss);

#Adresse
#classe
$pdf->WriteHTMLCell(50, 5, 165, $y, 'Class');
$pdf->WriteHTMLCell(50, 5, 185, $y, ':&nbsp;<b>' . $classe['NIVEAUHTML'] . '</b>');
$pdf->WriteHTMLCell(50, 5, 165, $y + 4, 'Enrolment');
$pdf->WriteHTMLCell(50, 5, 185, $y + 4, ':&nbsp;<b>' . $effectif . '</b>');
$pdf->WriteHTMLCell(50, 5, 165, $y + 8, 'Repeater?');
$pdf->WriteHTMLCell(50, 5, 185, $y + 8, ':&nbsp;<b>' . $redoublant . '</b>');

$pdf->setFontSize(10);

if ($codeperiode === "S" || $codeperiode === "T") {
    $pdf->WriteHTMLCell(0, 5, 110, $y + 15, '<b>Class advisor : ' . $classe['NOMPROFPRINCIPAL'] . ' ' . $classe['PRENOMPROFPRINCIPAL']);
}
$pdf->setFontSize(8);

# Table header
if ($codeperiode === "T") {
    $seqs = getLibelleSequences($sequences);
    $attrs = ["codeperiode" => $codeperiode, "seq1" => $seqs[0], "seq2" => $seqs[1]];
} elseif ($codeperiode === "S") {
    $attrs = ["codeperiode" => $codeperiode];
} elseif ($codeperiode === "A") {
    $attrs = ["codeperiode" => $codeperiode];
}
$corps = getHeaderBulletinANG($enseignements, $col, $attrs);

# FAIRE UNE BOUCLE SUR LES GROUPES DE MATIERES
$st1 = $sc1 = $st2 = $sc2 = $st3 = $sc3 = 0;
if ($codeperiode === "A") {
    $corps .= getBodyAnnuelleANG($groupe1, $col, $rang, $st1, $sc1);
    $corps .= getBodyAnnuelleANG($groupe2, $col, $rang, $st2, $sc2);
    $corps .= getBodyAnnuelleANG($groupe3, $col, $rang, $st3, $sc3);
    foreach ($recapitulatifs as $recap) {
        if ($recap['IDELEVE'] === $rang['IDELEVE']) {
            break;
        }
    }
    $corps .= getAnnuelAverageANG($rang, $recap, $col, $prev, $effectif, $st1 + $st2 + $st3, $sc1 + $sc2 + $sc3);
} else {
    $corps .= getBodyANG($groupe1, $col, $rang, $codeperiode, $st1, $sc1);
    $corps .= getBodyANG($groupe2, $col, $rang, $codeperiode, $st2, $sc2);
    #$corps .= printGroupe($st1 + $st2, $sc1 + $sc2, $col, "Groupe 1 + Groupe 2");
    $corps .= getBodyANG($groupe3, $col, $rang, $codeperiode, $st3, $sc3);
    if($codeperiode == "S"){
        $corps .= getBodyAverageANG($col, $rang, $prev, $st1 + $st2 + $st3, $sc1 + $sc2 + $sc3);
    }elseif($codeperiode == "T"){
        $seq1 = getMoyRecapitulativeSequence($rang['IDELEVE'], $sequence1);
        $seq1["ORDRE"] = $sequences[0]['ORDRE'];
        $seq2 = getMoyRecapitulativeSequence($rang['IDELEVE'], $sequence2);
        $seq2["ORDRE"] = $sequences[1]['ORDRE'];
        $corps .= getBodyAverageANGTrimestre($col, $rang, $prev, $st1 + $st2 + $st3, $sc1 + $sc2 + $sc3, $seq1, $seq2);
    }
}
$corps .= "</tbody></table>";
if ($codeperiode === "A") {
    $pdf->setX(14);$pdf->Ln(7);
    $pdf->WriteHTML($corps, true, false, false, false, '');
} else {
    $pdf->setX(14);$pdf->Ln(5);
    $pdf->WriteHTML($corps, true, false, false, false, '');
}


# RESUME DU TRAVAIL ACCOMPLI
//$pdf->setFontSize(10);
$pdf->setFont("helvetica", '', 8);
if ($codeperiode === "S") {
    $corps = printTravailANG($travail, $discipline, $rang);
} elseif ($codeperiode === "T") {
    $travail['MOYCLASSE'] = isset($moyclasse) ? $moyclasse : $travail['MOYCLASSE'];
    $travail['MOYMIN'] = isset($moymin) ? $moymin : $travail['MOYMIN'];
    $travail['MOYMAX'] = isset($moymax) ? $moymax : $travail['MOYMAX'];
    $abs1 = getDisciplineRecapitulativeSequence($rang['IDELEVE'], $absence1);
    $abs2 = getDisciplineRecapitulativeSequence($rang['IDELEVE'], $absence2);
    $corps = printTravailTrimestreANG($travail, $abs1, $abs2, $rang);
} elseif ($codeperiode === "A") {
    $disc = array();
    foreach ($discipline as $d) {
        if ($d["IDELEVE"] === $rang['IDELEVE']) {
            $disc["ABS" . $d["ORDRESEQUENCE"]] = $d['ABSENCE'];
            $disc["JUST" . $d["ORDRESEQUENCE"]] = $d['JUSTIFIER'];
            $disc["CONS" . $d["ORDRESEQUENCE"]] = $d['CONSIGNE'];
        }
    }
    $corps = printTravailAnnuelANG($disc, $rang, $moyclasse, $moymax, $moymin, $success_rate);  
}

$pdf->WriteHTML($corps, true, false, false, false, '');

$pdf->setFont("helvetica", '', 8);

# Desinner la coube d'evolution
$moyennes = getMoyennesRecapitulatives($recapitulatifs, $rang['IDELEVE'], $codeperiode);
if ($codeperiode !== "A") {
    $moyennes[] = $rang['MOYGENERALE'];
}

genererCourbeANG($moyennes, $rang, $codeperiode);
$courbe = SITE_ROOT . "public/tmp/" . $rang['IDELEVE'] . ".png";
$pdf->Image($courbe, 10, $pdf->GetY(), 45, 30, '', '', 'T', false, 300, '', false, false, 0, false, false, false);
$filename = SITE_ROOT . "public" . DS . "tmp" . DS . $rang['IDELEVE'] . ".png";
if (file_exists($filename)) {
    try {
        unlink($filename);
    } catch (Exception $e) {
        
    }
}
$lasty = $pdf->GetY();
$pdf->StartTransform();
$pdf->setFontSize(5);
# Ajouter la signature et l'heure d'impression
$pdf->Rotate(90, 5, $y + 161);

$pdf->WriteHTMLCell(0, 5, 20, $y + 166, "Printed by IPBW version 1.0<br/>" .
        date("d/m/Y", time()) . " at " . date("H:i:s", time()));
$pdf->StopTransform();
//$pdf->StartTransform();
//$pdf->Rotate(90, 35, $y + 185);
//$pdf->Write1DBarcode($rang['MATRICULEEL'], 'C128A', 12, $y + 155, '', 7, 0.4);
//$pdf->StopTransform();

$pdf->StartTransform();
$pdf->Rotate(90, 15, $y + 171);
# Numero de la page
$pdf->WriteHTMLCell(50, 5, 20, $y + 166, '<b>' . $rang['RANG'] . '/' . $effectif . '</b>');
$pdf->StopTransform();

$pdf->setFont("helvetica", '', 9);
# Visa des parents
#$corps = getRemarks($codeperiode);
$pdf->SetY($lasty - 5);
$pdf->SetX(65);
$pdf->WriteHTML('Parents signatures', false, false, false, false, '');
$pdf->SetX(115);
$pdf->WriteHTML('Class advisor remarks', false, false, false, false, '');
$pdf->SetX(160);
$pdf->WriteHTML('Principal\'s signature', false, false, false, false, '');

if($codeperiode === "A"){
    $pdf->SetY($pdf->GetY() + 35);
    $pdf->SetX(75);
    $pdf->WriteHTML(getAnnuelFinalDecisionANG($rang['MOYGENERALE']), false, false, false, false, '');
}
$signname = $rang['NOMEL'] . " " . $rang['PRENOMEL'];
if(strlen($signname) > 25){
    $signname = substr($signname, 0, strrpos($signname, " "));
}
$bas_bulletin[0] = $signname;

$pdf->Output();
