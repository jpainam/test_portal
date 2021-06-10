<?php

$pdf->AddPage();
$pdf->SetPrintHeader(false);
$y = PDF_Y;
$x = PDF_X;
$middle = PDF_MIDDLE;
$pdf->setFont("Times", '', 9);
$titre = '<b>REPERTOIRE DES PARENTS D\'ELEVEs </b>';
$pdf->WriteHTMLCell(0, 5, $middle - 25, $y, $titre);

$pdf->WriteHTMLCell(100, 100, 150, $y, '<b>Ann&eacute;e Acad. ' . $_SESSION['anneeacademique'] . '</b>');
$cols[0] = 5;
$cols[1] = 10;
$cols[2] = 10;
$cols[3] = 12;
$cols[4] = 7;
$cols[5] = 10;
$cols[6] = 7;
$cols[7] = 10;
$cols[8] = 7;
$cols[9] = 12;
$cols[10] = 12;
$cols[11] = 5;$cols[12] = 6;
$pdf->setFont("Times", '', 7);



$corps = '<table cellpadding="2" border="1"><thead>
    <tr  border ="1"   style="font-weight:bold"  >
        <td border="1"  width ="' . $cols[0] . '%">Civ.</td>
        <td border="1"  width ="' . $cols[1] . '%">Nom</td>
        <td border="1"  width ="' . $cols[2] . '%"  >Prénom</td>
        <td border="1"  width ="' . $cols[3] . '%" >Adresse</td>
        <td border="1"  width ="' . $cols[4] . '%" >Téléphone</td>
        <td border="1"  width ="' . $cols[5] . '%" >Portable</td>';
        #<td border="1"  width ="' . $cols[6] . '%" >Email</td>
        $corps .= '<td border="1"  width ="' . $cols[7] . '%" >Profession</td>
        <td border="1"  width ="' . $cols[8] . '%" >Parenté</td>
        <td border="1"  width ="' . $cols[9] . '%" >Nom de l\'élève</td>
        <td border="1"  width ="' . $cols[10] . '%" >Prénom de l\'élève</td>
        <td border="1"  width ="' . $cols[11] . '%" >Classe</td>
        <td border="1"  width ="' . $cols[12] . '%" >Redou.</td>               
      </tr></thead><tbdoy>';
foreach ($repertoires as $r) {
    if (in_array($rep['IDELEVE'], $array_of_redoublants[$rep['IDCLASSE']])) {
        $redoublant = "OUI";
    } else {
        $redoublant = "NON";
    }
    $corps .= '<tr><td border="1"  width ="' . $cols[0] . '%">' . $r['CIVILITE'] . "</td>"
            . '<td border="1"  width ="' . $cols[1] . '%">' . $r['NOM'] . "</td>"
            . '<td border="1"  width ="' . $cols[2] . '%">' . $r['PRENOM'] . '</td>'
            . '<td border="1"  width ="' . $cols[3] . '%">' . $r['RESIDENCE'] . ' ' . $r['ADRESSE']. "</td>"
            . '<td align="right" border="1"  width ="' . $cols[4] . '%">' . $r['TELEPHONE'] . "</td>"
            . '<td border="1"  width ="' . $cols[5] . '%">' . $r['PORTABLE'] . '</td>'
            #. '<td border="1"  width ="' . $cols[6] . '%">' . $r['EMAIL'] . '</td>'
            . '<td border="1"  width ="' . $cols[7] . '%">' . $r['PROFESSION'] . '</td>'
            . '<td border="1"  width ="' . $cols[8] . '%">' . $r['PARENTE'] . '</td>'
            . '<td border="1"  width ="' . $cols[9] . '%">' . $r['NOMEL'] . '</td>'
            . '<td border="1"  width ="' . $cols[10] . '%">' . $r['PRENOMEL'] . '</td>'
            . '<td border="1"  width ="' . $cols[11] . '%">' . $r['NIVEAUHTML'] . '</td>'
            . '<td border="1"  width ="' . $cols[12] . '%">' . $redoublant . '</td></tr>';
}
$corps .= '</tbody></table>';
$pdf->WriteHTMLCell(0, 5, $x, $y + 10, $corps);
$pdf->Output();
