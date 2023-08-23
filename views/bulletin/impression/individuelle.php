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
$bas_bulletin[2] = "FR";
$pdf->SetPrintFooter(true);
# Desactiver le texte de signature pour les bulletins
$pdf->bCertify = false;
$pdf->AddPage();

$pdf->leftUpCorner = 10;

# Largeur des colonnes
$col = getLargeurColonne($codeperiode);

#creer les trois groupes de matieres et envoyer cela a la vue
$tab = trierParGroupe($notes, $rang['IDELEVE']);
$groupe1 = $tab[0];
$groupe2 = $tab[1];
$groupe3 = $tab[2];
$array_of_redoublants = is_null($array_of_redoublants) ? array() : $array_of_redoublants;

$style = array(
    'text' => true,
);


$pdf->SetFont("helvetica", '', 15);
$y = PDF_Y + 1;
$pdf->RoundedRect(80, $y - 10, 65, 7, 2.0, '1111', 'DF', array("width" => 0.5, "color" => array(0, 0, 0)), array(255, 255, 255));
if ($codeperiode === "A") {
    $titre = '<div>  BULLETIN ANNUEL</div>';
} else {
    $titre = '<div>BULLETIN DE NOTES</div>';
}
$pdf->WriteHTMLCell(0, 5, 85, $y - 10, $titre);
$pdf->SetFont("helvetica", "B", 10);

$annee = "Ann&eacute;e scolaire " . $_SESSION['anneeacademique'];
$pdf->WriteHTMLCell(150, 5, 155, $y - 20, $annee);


# Le cadre pour la photo
$photo = SITE_ROOT . "public/photos/eleves/" . $rang['PHOTOEL'];

if (!empty($rang['PHOTOEL']) && file_exists(ROOT . DS . "public" . DS . "photos" . DS . "eleves" . DS . $rang['PHOTOEL'])) {
    //ROOT . DS . "public" . DS . "photos" . DS . "eleves" . DS . 
    $pdf->Image($photo, 15, $y - 16, 39, 35, '', '', 'T', true, 300, '', false, false, 0, false, false, false);
} else {
    $pdf->WriteHTMLCell(20, 18, 15, $y, '<br/><br/>PHOTO', 1, 2, false, true, 'C');
}
$pdf->Rect(55, $y, 142, 13, 'DF');

if (in_array($rang['IDELEVE'], $array_of_redoublants)) {
    $redoublant = "OUI";
} else {
    $redoublant = "NON";
}
$pdf->SetFont("helvetica", "", 9);
$d = new DateFR($rang['DATENAISSEL']);

$pdf->WriteHTMLCell(0, 5, 56, $y, 'Matricule');
$pdf->WriteHTMLCell(0, 5, 78, $y, ':&nbsp;<b>' . $rang['MATRICULEEL'] . '</b>');

$pdf->WriteHTMLCell(0, 5, 56, $y + 4, 'Nom');
$pdf->WriteHTMLCell(0, 5, 78, $y + 4, ':&nbsp;<b>' . $rang['NOMEL'] . " " . $rang['PRENOMEL'] . ' ' . $rang['AUTRENOMEL'] . '</b>');

if ($rang['SEXEEL'] === "F") {
    $pdf->WriteHTMLCell(0, 5, 56, $y + 8, "N&eacute;e le");
}else{
    $pdf->WriteHTMLCell(0, 5, 56, $y + 8, "N&eacute; le");
}
$naiss = ":&nbsp;<b>". $d->getDate() . " " . $d->getMois(3) . "-" . $d->getYear();
if (!empty($rang['LIEUNAISSEL'])) {
    $naiss .= " &agrave; " . $rang['LIEUNAISSEL'];
}
$naiss .= '</b>';
$pdf->WriteHTMLCell(0, 5, 78, $y + 8, $naiss);

#Adresse
#classe
$pdf->WriteHTMLCell(0, 5, 155, $y - 10, 'Classe');
$pdf->WriteHTMLCell(0, 5, 175, $y - 10, ':&nbsp;<b>' . $classe['NIVEAUHTML'] . '</b>');

$pdf->WriteHTMLCell(0, 5, 155, $y - 15, 'Effectif'); 
$pdf->WriteHTMLCell(0, 5, 175, $y - 15, ':&nbsp;<b>' . $effectif . '</b>');

$pdf->WriteHTMLCell(0, 5, 155, $y - 5, "Redoublant");
$pdf->WriteHTMLCell(0, 5, 175, $y - 5, ':&nbsp;<b>' . $redoublant . '</b>');

$pdf->setFontSize(10);
if ($codeperiode === "S") {
    $pdf->WriteHTMLCell(0, 5, 56, $y + 15, '<div style="text-transform:uppercase">' . $sequence['LIBELLEHTML'] . "</div>");
} elseif ($codeperiode === "T") {
    $pdf->WriteHTMLCell(0, 5, 56, $y + 15, '<div style="text-transform:uppercase">' . $trimestre['LIBELLE'] . "</div>");
}
if ($codeperiode === "S" || $codeperiode === "T") {
    $pdf->WriteHTMLCell(0, 5, 116, $y + 15, '<b>Prof. Princ : ' . $classe['NOMPROFPRINCIPAL'] . ' ' . $classe['PRENOMPROFPRINCIPAL']);
}
$pdf->setFontSize(7);

# Table header
if ($codeperiode === "T") {
    $seqs = getLibelleSequences($sequences);
    $attrs = ["codeperiode" => $codeperiode, "seq1" => $seqs[0], "seq2" => $seqs[1]];
} elseif ($codeperiode === "S") {
    $attrs = ["codeperiode" => $codeperiode];
} elseif ($codeperiode === "A") {
    $attrs = ["codeperiode" => $codeperiode];
}
$corps = getHeaderBulletin($enseignements, $col, $attrs);

# FAIRE UNE BOUCLE SUR LES GROUPES DE MATIERES
$st1 = $sc1 = $st2 = $sc2 = $st3 = $sc3 = 0;
if ($codeperiode === "A") {
    $cellHeight = 16; $cellFont = 7;
    if(count($enseignements) > 19){
        $pdf->setFontSize(6);
        $cellHeight = 12; $cellFont = 6;
    }
    $corps .= getBodyAnnuelle($groupe1, $col, $rang, $st1, $sc1, $cellHeight, $cellFont);
    $corps .= getBodyAnnuelle($groupe2, $col, $rang, $st2, $sc2, $cellHeight, $cellFont);
    $corps .= getBodyAnnuelle($groupe3, $col, $rang, $st3, $sc3, $cellHeight, $cellFont);
    foreach ($recapitulatifs as $recap) {
        if ($recap['IDELEVE'] === $rang['IDELEVE']) {
            break;
        }
    }
    $pdf->setFontSize(7);
    $corps .= printTravailAnnuel2($rang, $recap, $col, $prev, $effectif);
} else {
    $corps .= getBody($groupe1, $col, $rang, $codeperiode, $st1, $sc1, $enseignements);
    $corps .= getBody($groupe2, $col, $rang, $codeperiode, $st2, $sc2, $enseignements);
    #$corps .= printGroupe($st1 + $st2, $sc1 + $sc2, $col, "Groupe 1 + Groupe 2");
    $corps .= getBody($groupe3, $col, $rang, $codeperiode, $st3, $sc3, $enseignements);
    if($codeperiode == "S"){
        $corps .= getBodyAverage($col, $rang, $prev, $st1 + $st2 + $st3, $sc1 + $sc2 + $sc3);
    }elseif($codeperiode == "T"){
        $seq1 = getMoyRecapitulativeSequence($rang['IDELEVE'], $sequence1);
        $seq1["ORDRE"] = $sequences[0]['ORDRE'];
        $seq2 = getMoyRecapitulativeSequence($rang['IDELEVE'], $sequence2);
        $seq2["ORDRE"] = $sequences[1]['ORDRE'];
        $corps .= getBodyAverageTrimestre($col, $rang, $prev, $st1 + $st2 + $st3, $sc1 + $sc2 + $sc3, $seq1, $seq2);
    }
}
$corps .= "</tbody></table>";
if ($codeperiode === "A") {
    $pdf->setX(14);$pdf->Ln(19);
    $pdf->WriteHTML($corps, true, false, false, false, '');
} else {
    $pdf->setX(14);$pdf->Ln(5);
    $pdf->WriteHTML($corps, true, false, false, false, '');
}

# RESUME DU TRAVAIL ACCOMPLI
$pdf->setFont("helvetica", '', 8);
if ($codeperiode === "S") {
    $corps = printTravail2($travail, $discipline, $rang);
} elseif ($codeperiode === "T") {
    $travail['MOYCLASSE'] = isset($moyclasse) ? $moyclasse : $travail['MOYCLASSE'];
    $travail['MOYMIN'] = isset($moymin) ? $moymin : $travail['MOYMIN'];
    $travail['MOYMAX'] = isset($moymax) ? $moymax : $travail['MOYMAX'];
    $abs1 = getDisciplineRecapitulativeSequence($rang['IDELEVE'], $absence1);
    $abs2 = getDisciplineRecapitulativeSequence($rang['IDELEVE'], $absence2);
    $corps = printTravailTrimestre2($travail, $abs1, $abs2, $rang);
    #$corps = printTravailTrimestre($rang, $travail, $prev, $seq1, $seq2);
} elseif ($codeperiode === "A") {
    //$corps = printMoyRangAnnuel($rang, $prev, $moyclasse, $moymax, $moymin);
    //$pdf->WriteHTML($corps, true, false, false, false, '');
    $disc = array();
    foreach ($discipline as $d) {
        if ($d["IDELEVE"] === $rang['IDELEVE']) {
            $disc["ABS" . $d["ORDRESEQUENCE"]] = $d['ABSENCE'];
            $disc["JUST" . $d["ORDRESEQUENCE"]] = $d['JUSTIFIER'];
            $disc["CONS" . $d["ORDRESEQUENCE"]] = $d['CONSIGNE'];
        }
    }
    $corps = printDisciplineAnnuel2($disc, $rang, $moyclasse, $moymax, $moymin, $success_rate);  
}

$pdf->WriteHTML($corps, true, false, false, false, '');

$pdf->setFont("helvetica", '', 8);

# Desinner la coube d'evolution
$moyennes = getMoyennesRecapitulatives($recapitulatifs, $rang['IDELEVE'], $codeperiode);
if ($codeperiode !== "A") {
    $moyennes[] = $rang['MOYGENERALE'];
}

genererCourbe($moyennes, $rang, $codeperiode);
$courbe = SITE_ROOT . "public/tmp/" . $rang['IDELEVE'] . ".png";
$pdf->Image($courbe, $pdf->GetX(), $pdf->GetY(), 45, 30, '', '', 'T', false, 300, '', false, false, 0, false, false, false);
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

$pdf->WriteHTMLCell(0, 5, 20, $y + 166, "G&eacute;n&eacute;r&eacute; par IPBW version 1.0<br/>" .
        date("d/m/Y ", time()) . "&agrave; " . date("H:i:s", time()));
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
#$corps = getRemarque($codeperiode);

$pdf->SetY($lasty - 5);
$pdf->SetX(75);
$pdf->WriteHTML('Visa des Parents', false, false, false, false, '');
$pdf->SetX(115);
$pdf->WriteHTML('Le Titulaire', false, false, false, false, '');
$pdf->SetX(150);
if($codeperiode === "T" || $codeperiode === "A"){
    $pdf->WriteHTML('Le Chef d\'établissement', false, false, false, false, '');
}else{
    $pdf->WriteHTML('Le Directeur des études', false, false, false, false, '');
}

if($codeperiode === "A"){
    $pdf->SetY($pdf->GetY() + 10);
    $pdf->SetX(140);
    $finaldecision = getAnnuelFinalDecision($rang['MOYGENERALE'], $classe['GROUPE']);
    if(strpos($finaldecision, "#")){
        $pdf->WriteHTML('<b>'.substr($finaldecision, 0, strpos($finaldecision, "#")).'</b>',
            false, false, false, false, 'C');
        $pdf->SetY($pdf->GetY() + 5);
        $pdf->SetX(140);
        $pdf->WriteHTML('<b>'. substr($finaldecision, strpos($finaldecision, "#") + 1, strlen($finaldecision)).'</b>',
                false, false, false, false, 'C');
    }else{
        $pdf->WriteHTML('<b>'.$finaldecision.'</b>', false, false, false, false, 'C');
    }
}
$bas_bulletin[0] = $rang['NOMEL'] . " " . $rang['PRENOMEL'];

$pdf->Output();
