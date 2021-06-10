<?php

function getBodyAnnuelleANG($groupe, $col, $el, &$sumtotal = 0, &$sumcoeff = 0) {
    $str = "";
    foreach ($groupe as $g) {
        if ($g['IDELEVE'] == $el['IDELEVE']) {
            $str .= '<tr style="text-align:center;">';
            # Matiere
            //$g['NOM'] = preg_replace("%[^\033-\176\r\n\t]%", '', $g['NOM']);
            //$g['PRENOM'] = preg_replace("%[^\033-\176\r\n\t]%", '', $g['PRENOM']);

            $str .= '<td border="1" style="text-align:left;" '
                    . 'width="' . $col[10] . '%">&nbsp;&nbsp;<b style="text-transform:uppercase">' . trim($g['BULLETIN']) .
                    '</b><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size:7px;font-weight:normal">'
                    . ($g['CIVILITE'] . ' ' . $g['NOM']) . '</span></td>';

            # NOTES SEQUENTIELLES

            if (!empty($g['SEQ1'])) {
                $str .= '<td  style="line-height:17px" border="1" width="' . $col[1] . '%">' . sprintf("%.2f", $g['SEQ1']) . '</td>';
            } else {
                $str .= '<td border="1" width="' . $col[1] . '%"></td>';
            }
            if (!empty($g['SEQ2'])) {
                $str .= '<td  style="line-height:17px" border="1" width="' . $col[2] . '%">' . sprintf("%.2f", $g['SEQ2']) . '</td>';
            } else {
                $str .= '<td border="1" width="' . $col[2] . '%"></td>';
            }
            if (!empty($g['SEQ3'])) {
                $str .= '<td  style="line-height:17px" border="1" width="' . $col[3] . '%">' . sprintf("%.2f", $g['SEQ3']) . '</td>';
            } else {
                $str .= '<td border="1" width="' . $col[3] . '%"></td>';
            }
            if (!empty($g['SEQ4'])) {
                $str .= '<td  style="line-height:17px" border="1" width="' . $col[4] . '%">' . sprintf("%.2f", $g['SEQ4']) . '</td>';
            } else {
                $str .= '<td border="1" width="' . $col[4] . '%"></td>';
            }
            if (!empty($g['SEQ5'])) {
                $str .= '<td  style="line-height:17px" border="1" width="' . $col[5] . '%">' . sprintf("%.2f", $g['SEQ5']) . '</td>';
            } else {
                $str .= '<td border="1" width="' . $col[5] . '%"></td>';
            }
            if (!empty($g['SEQ6'])) {
                $str .= '<td  style="line-height:17px" border="1" width="' . $col[6] . '%">' . sprintf("%.2f", $g['SEQ6']) . '</td>';
            } else {
                $str .= '<td border="1" width="' . $col[6] . '%"></td>';
            }



            # Moyenne DES 6 SEQUENCE
            if (!empty($g['COEFF']) && intval($g['COEFF']) != 0) {
                $str .= '<td  style="line-height:17px" border="1" width="' . $col[7] . '%">' . sprintf("%.2f", $g['MOYENNE']) . '</td>';
            } else {
                $str .= '<td border="1" width="' . $col[7] . '%"></td>';
            }
            # Coeff
            if (!empty($g['COEFF']) && intval($g['COEFF']) != 0) {
                $str .= '<td  style="line-height:17px" border="1" width="' . $col[11] . '%">' . sprintf("%.0f", $g['COEFF']) . '</td>';
            } else {
                $str .= '<td border="1" width="' . $col[11] . '%"></td>';
            }
            # Total = coeff * moy
            if (!empty($g['COEFF']) && intval($g['COEFF']) != 0) {
                $str .= '<td  style="line-height:17px" border="1" width="' . $col[13] . '%">' . sprintf("%.2f", sprintf("%.2f", $g['MOYENNE']) * $g['COEFF']) . '</td>';
            } else {
                $str .= '<td border="1" width="' . $col[13] . '%"></td>';
            }
            # Rang
            if (!empty($g['COEFF']) && intval($g['COEFF']) != 0) {
                $str .= '<td  style="line-height:17px" border="1" width="' . $col[8] . '%">' . $g['RANG'] . '</td>';
            } else {
                $str .= '<td border="1" width="' . $col[8] . '%"></td>';
            }
            #Appreciation
            if (!empty($g['COEFF']) && intval($g['COEFF']) != 0) {
                $str .= '<td  style="line-height:17px;text-align:left;"'
                        . ' border="1" width="' . $col[9] . '%" >&nbsp;&nbsp;<span style="text-transform:uppercase">' .
                        getAppreciationsANG($g['MOYENNE']) . '</span></td>';
            } else {
                $str .= '<td border="1" width="' . $col[9] . '%"></td>';
            }
            $sumcoeff += $g['COEFF'];
            $sumtotal += $g['TOTAL'];
            $str .= '</tr>';
        }
    }
    return $str;
}
function printGroupeAnnuelleANG($col, $params) {
    # Ecrire le GROUPE 1
    #$backg = "#F7F7F7";
    $backg = "#CCC";
    /*if (strlen($params['description']) > 10) {
        $backg = "#CCC";
    }*/
    $str = '<tr style="font-weight:bold;">';
    $str .= '<td border="1" witdh="' . $col[10] . '%" style="text-align:left">&nbsp;&nbsp;TOTAL</td>';

    # Moyenne totale du groupe 
    /*if ($params['sumcoeff'] != 0) {
        $moy = ($params['sumtotal']) / $params['sumcoeff'];
    } else {
        $moy = 0;
    }*/

    $str .= '<td border="1" colspan = "6" width="' . ($col[1] * 6) . '%"></td>';
    $str .= '<td border="1" width="' . $col[7] . '%"></td>'
            . '<td border="1" width="' . $col[11] . '%">' . $params['sumcoeff'] . "</td>";
    $str .= '<td  border="1" colspan="3"  width="' . ($col[13] + $col[8] + $col[9]) . '%">Points : ' . sprintf("%.2f", $params['sumtotal']) . '</td></tr>';
    return $str;
}

function getAnnuelAverageANG($rang, $seqs, $col, $prev, $effectif, $sumtotal, $coeftotal){
    $str = '<tr style="text-align:center;font-weight:bold;line-height:17px">'
            . '<td border="1" witdh="' . $col[10] . '%" style="text-align:left">&nbsp;&nbsp;TOTAL</td>'
            . '<td border="1" colspan="7" witdh="' . ($col[1] + $col[2] + $col[3] + $col[4] + $col[5] + $col[6] + $col[7]). '%"></td>'
            . '<td border="1" witdh="' . $col[8] . '%"> ' . $coeftotal . '</td>'
            . '<td border="1"  colspan="3" witdh="' . ($col[11] + $col[13] + $col[8]) . '%"> Points ' . sprintf("%.2f", $sumtotal) . ' / ' . sprintf("%.2f", $coeftotal * 20) . '</td></tr>';
    
     $str .= '<tr style="text-align:center;line-height:17px">'
            . '<td border="1" style="text-align:left;" width="' . $col[10] . '%"><b>&nbsp;&nbsp;AVERAGE</b></td>';

    $r1 = $r2 = $r3 = $r4 = $r5 = $r6 = "";
    if (!empty($seqs['MOYSEQ1'])) {
        $str .= '<td width="' . $col[1] . '%" border="1">' . sprintf("%.2f", $seqs['MOYSEQ1']) . '</td>';
        $expo = ($seqs['RANGSEQ1'] == 1) ? '<sup>' . ($rang['SEXEEL'] == "F" ? __t2("&egrave;re") : __t2("er")) . '</sup>' : "<sup>e</sup>";
        $r1 = $seqs['RANGSEQ1'] . $expo;
    } else {
        $str .= '<td width="' . $col[1] . '%" border="1"></td>';
    }
    if (!empty($seqs['MOYSEQ2'])) {
        $str .= '<td width="' . $col[2] . '%" border="1">' . sprintf("%.2f", $seqs['MOYSEQ2']) . '</td>';
        $expo = ($seqs['RANGSEQ2'] == 1) ? '<sup>' . ($rang['SEXEEL'] == "F" ? __t2("&egrave;re") : __t2("er")) . '</sup>' : "<sup>e</sup>";
        $r2 = $seqs['RANGSEQ2'] . $expo;
    } else {
        $str .= '<td width="' . $col[2] . '%" border="1"></td>';
    }
    if (!empty($seqs['MOYSEQ3'])) {
        $str .= '<td width="' . $col[3] . '%" border="1">' . sprintf("%.2f", $seqs['MOYSEQ3']) . '</td>';
        $expo = ($seqs['RANGSEQ3'] == 1) ? '<sup>' . ($rang['SEXEEL'] == "F" ? __t2("&egrave;re") : __t2("er")) . '</sup>' : "<sup>e</sup>";
        $r3 = $seqs['RANGSEQ3'] . $expo;
    } else {
        $str .= '<td width="' . $col[3] . '%" border="1"></td>';
    }
    if (!empty($seqs['MOYSEQ4'])) {
        $str .= '<td width="' . $col[4] . '%" border="1">' . sprintf("%.2f", $seqs['MOYSEQ4']) . '</td>';
        $expo = ($seqs['RANGSEQ4'] == 1) ? '<sup>' . ($rang['SEXEEL'] == "F" ? __t2("&egrave;re") : __t2("er")) . '</sup>' : "<sup>e</sup>";
        $r4 = $seqs['RANGSEQ4'] . $expo;
    } else {
        $str .= '<td width="' . $col[4] . '%" border="1"></td>';
    }
    if (!empty($seqs['MOYSEQ5'])) {
        $str .=' <td width="' . $col[5] . '%" border="1">' . sprintf("%.2f", $seqs['MOYSEQ5']) . '</td>';
        $expo = ($seqs['RANGSEQ5'] == 1) ? '<sup>' . ($rang['SEXEEL'] == "F" ? __t2("&egrave;re") : __t2("er")) . '</sup>' : $expo = "<sup>e</sup>";
        $r5 = $seqs['RANGSEQ5'] . $expo;
    } else {
        $str .= '<td width="' . $col[5] . '%" border="1"></td>';
    }
    if (!empty($seqs['MOYSEQ6'])) {
        $str .= '<td width="' . $col[6] . '%" border="1">' . sprintf("%.2f", $seqs['MOYSEQ6']) . '</td>';
        $expo = ($seqs['RANGSEQ6'] == 1) ? $expo = '<sup>' . ($rang['SEXEEL'] == "F" ? __t2("&egrave;re") : __t2("er")) . '</sup>' : "<sup>e</sup>";
        $r6 = $seqs['RANGSEQ6'] . $expo;
    } else {
        $str .= '<td width="' . $col[6] . '%" border="1"></td>';
    }
    $str .= '<td style="text-align:left;" colspan="4" width="' . ($col[7] + $col[11] + $col[13] + $col[8]) .'%" border="1">'
            . '<b>&nbsp;&nbsp;ANNUAL AVG: '.sprintf("%.2f", $rang['MOYGENERALE']).'</b></td>';
    $str .= '<td width="' . $col[9] .'%" border="1"><b style="text-transform:uppercase">'.getAppreciationsANG($rang['MOYGENERALE']).'</b></td></tr>';

    $str .= '<tr style="text-align:center; line-height:17px">';
    $str .= '<td style="text-align:left;" border="1" width="' . $col[10] . '%" ><b>&nbsp;&nbsp;RANK</b></td>';
    $str .= '<td width="' . $col[1] . '%" border="1">' . $r1 . '</td>';
    $str .= '<td width="' . $col[2] . '%" border="1">' . $r2 . '</td>';
    $str .= '<td width="' . $col[3] . '%" border="1">' . $r3 . '</td>';
    $str .= '<td width="' . $col[4] . '%" border="1">' . $r4 . '</td>';
    $str .= '<td width="' . $col[5] . '%" border="1">' . $r5 . '</td>';
    $str .= '<td width="' . $col[6] . '%" border="1">' . $r6 . '</td>';
    
    # Rang Annuelle
    $expo = "<sup>".__t2('&egrave;me')."</sup>";
    if ($rang['RANG'] == 1) {
        $expo = '<sup>' . ($rang['SEXEEL'] == "F" ? "&egrave;re" : "er") . '</sup>';
    }
    $execo = "";
    if ($rang['RANG'] == $prev) {
        $execo = "ex";
    }
    $str .= '<td style="text-align:left;" colspan="4" width="' . ($col[7] + $col[11] + $col[13] + $col[8]) .'%" border="1">'
            . '<b>&nbsp;&nbsp;ANNUAL RANK: '.$rang['RANG'] . $expo . ' ' . $execo.' / ' .$effectif .' </b></td>';
    $str .= '<td width="' . $col[9] .'%" border="1"></td></tr>';

    return $str;
}

function getHeaderBulletinANG($enseignements, $col, $attrs = array()) {
    $nbMatieres = count($enseignements);
    $line_height = "10px";
    if ($nbMatieres > 14) {
        $line_height = "8px";
    }
    if ($attrs['codeperiode'] === "A") {
        $corps = '<table cellpadding="0.5" style="line-height: ' . $line_height . '">
    <thead>
        <tr style="text-align:center;font-weight:bold;font-size:7px;line-height: 15px;">
        <th width="' . $col[10] . '%"></th>
           <th colspan="2" width="' . $col[12] . '%" border="1">1<sup>er</sup>Term</th>
        <th border="1" colspan="2"  width="' . $col[12] . '%">2<sup>nd</sup>Term</th>
            <th border="1" colspan="2" width="' . $col[12] . '%">3<sup>e</sup>Term</th>
                <th colspan="5" border="1" width="' . ($col[7] + $col[11] + $col[13] + $col[8] + $col[9]) . '%">Annual</th></tr>
        <tr style="text-align:center;font-weight:bold; line-height: 15px;font-size:8px;background-color:#000;color:#FFF;">
            <th border="1" width="' . $col[10] . '%">Subjects</th>
            <th width="' . $col[1] . '%">S1</th>
            <th width="' . $col[2] . '%">S2</th>
            <th width="' . $col[3] . '%">S3</th>
            <th width="' . $col[4] . '%">S4</th><th  width="' . $col[5] . '%">S5</th>
            <th width="' . $col[6] . '%">S6</th>
            <th width="' . $col[7] . '%" border="1">Moy</th>
            <th  width="' . $col[11] . '%" border="1">Coef</th>
            <th width="' . $col[13] . '%" border="1">Total</th>
            <th width="' . $col[8] . '%" border="1">Rank</th>
            <th width="' . $col[9] . '%" border="1">Remark</th></tr>
        </thead>
        <tbody>';
        return $corps;
    }
    $str = '<table border="1" cellpadding="0.5" style="line-height: ' . $line_height . '"><thead>'
            . '<tr style="text-align:center;font-weight:bold; line-height: 15px;font-size:10px;background-color:#000;color:#FFF;">'
            . '<th border="1"  width="' . $col[1] . '%" style="text-align:left">&nbsp;&nbsp;Subjects</th>';

    if ($attrs['codeperiode'] === "S") {
        $str .= '<th border="1" width="' . $col[4] . '%">Mark</th>';
    } else {
        $str .= '<th border="1" width="' . $col[2] . '%">' . $attrs['seq1'] . '</th>'
                . '<th border="1" width="' . $col[3] . '%">' . $attrs['seq2'] . '</th>'
                . '<th border="1" width="' . $col[4] . '%">AVG</th>';
    }

    $str .= '<th border="1"  width="' . $col[5] . '%">Coef</th>'
            . '<th border="1"  width="' . $col[6] . '%">Total</th>'
            . '<th border="1" width="' . $col[7] . '%">Rank</th>'
            . '<th border="1"  width="' . $col[8] . '%">Cl.Avg</th>'
            . '<th border="1"  width="' . $col[9] . '%">Last/First</th>'
            . '<th border="1"  width="' . $col[10] . '%">Remark</th></tr></thead><tbody>';
    return $str;
}

function getLargeurColonneANG($codeperiode) {
    $col = array();
    if ($codeperiode === "S") {
        $col[0] = 0;
        $col[1] = 35;
        $col[2] = 7;
        $col[3] = 7;
        $col[4] = 8;
        $col[5] = 7;
        $col[6] = 7;
        $col[7] = 6;
        $col[8] = 8;
        $col[9] = 12;
        $col[10] = 18;
    } elseif ($codeperiode === "T") {
        $col[0] = 0;
        $col[1] = 32;
        $col[2] = 6;
        $col[3] = 6;
        $col[4] = 6;
        $col[5] = 6;
        $col[6] = 6;
        $col[7] = 6;
        $col[8] = 7;
        $col[9] = 10;
        $col[10] = 16;
    } elseif ($codeperiode === "A") {
        $col = [5, 5, 5, 5, 5, 5, 5, 6, 6, 16, 31, 5, 10, 7];
    }
    return $col;
}


function getAppreciationsANG($note) {
    if ($note >= 0 && $note <= 5.99) {
        return "Extremely weak";
    } elseif ($note >= 6 && $note <= 7.99) {
        return "Weak";
    } elseif ($note >= 8 && $note <= 8.99) {
        return "Poor";
    } elseif ($note >= 9 && $note <= 9.99) {
        return "Below average";
    } elseif ($note >= 10 && $note <= 11.99) {
        return "Average";
    } elseif ($note >= 12 && $note <= 13.99) {
        return "Fairly good";
    } elseif ($note >= 14 && $note <= 14.99) {
        return "Good";
    } elseif ($note >= 15 && $note <= 17.99) {
        return "Very good";
    } elseif ($note >= 18 && $note <= 20) {
        return "Excellent";
    } else {
        return "";
    }
}

function __t3($str) {
    if ($str == "M.") {
        return "Mr.";
    }
    if ($str === "Mlle") {
        return "Miss";
    }
    if ($str === "Mme") {
        return "Mrs";
    }
    return "M.";
}

function getBodyANG($groupe, $col, $el, $codeperiode, &$sumtotal = 0, &$sumcoeff = 0) {
    $str = "";
    $sumdh = $sumdp = $summoy = 0;
    foreach ($groupe as $g) {
        if ($g['IDELEVE'] == $el['IDELEVE']) {
            $str .= '<tr style="text-align:center;">';
            # Matiere
            //$g['NOM'] = preg_replace("%[^\033-\176\r\n\t]%", '', $g['NOM']);
            //$g['PRENOM'] = preg_replace("%[^\033-\176\r\n\t]%", '', $g['PRENOM']);

            $str .= '<td border="1" style="text-align:left;" '
                    . 'width="' . $col[1] . '%">&nbsp;&nbsp;<b style="text-transform:uppercase">' . trim($g['BULLETIN']) .
                    '</b><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size:7px;font-weight:normal">'
                    . (__t3($g['CIVILITE']) . ' ' . $g['NOM']) . '</span></td>';

            # DP
            if ($codeperiode === "T") {
                if ($g['SEQ1'] != "" && $g['SEQ1'] != null) {
                    $str .= '<td  style="line-height:17px" border="1" width="' . $col[2] . '%">' . sprintf("%.2f", $g['SEQ1']) . '</td>';
                } else {
                    $str .= '<td border="1" width="' . $col[2] . '%"></td>';
                }
                # DH
                if ($g['SEQ2'] != "" && $g['SEQ2'] != null) {
                    $str .= '<td  style="line-height:17px" border="1" width="' . $col[3] . '%">' . sprintf("%.2f", $g['SEQ2']) . '</td>';
                } else {
                    $str .= '<td border="1" width="' . $col[3] . '%"></td>';
                }
            }

            # Moyenne DP et DH
            if (!empty($g['COEFF']) && intval($g['COEFF']) != 0) {
                $str .= '<td  style="line-height:17px" border="1" width="' . $col[4] . '%">' . sprintf("%.2f", $g['MOYENNE']) . '</td>';
            } else {
                $str .= '<td border="1" width="' . $col[4] . '%"></td>';
            }
            # Coeff
            if (!empty($g['COEFF']) && intval($g['COEFF']) != 0) {
                $str .= '<td  style="line-height:17px" border="1" width="' . $col[5] . '%">' . sprintf("%.0f", $g['COEFF']) . '</td>';
            } else {
                $str .= '<td border="1" width="' . $col[5] . '%"></td>';
            }
            # Total = coeff * moy
            if (!empty($g['COEFF']) && intval($g['COEFF']) != 0) {
                $str .= '<td  style="line-height:17px" border="1" width="' . $col[6] . '%">' . sprintf("%.2f", $g['TOTAL']) . '</td>';
            } else {
                $str .= '<td border="1" width="' . $col[6] . '%"></td>';
            }
            # Rang
            if (!empty($g['COEFF']) && intval($g['COEFF']) != 0) {
                $str .= '<td  style="line-height:17px" border="1" width="' . $col[7] . '%">' . $g['RANG'] . '</td>';
            } else {
                $str .= '<td border="1" width="' . $col[7] . '%"></td>';
            }
            #Moyenne de classe
            if (!empty($g['COEFF']) && intval($g['COEFF']) != 0) {
                $str .= '<td  style="line-height:17px" border="1" width="' . $col[8] . '%">' . sprintf("%.2f", $g['MOYCL']) . '</td>';
            } else {
                $str .= '<td border="1" width="' . $col[8] . '%"></td>';
            }
            #Min / Max
            if (!empty($g['COEFF']) && intval($g['COEFF']) != 0) {
                $str .= '<td  style="line-height:17px" border="1" width="' . $col[9] . '%">' . sprintf("%.2f", $g['NOTEMIN']) . ' / ' . sprintf("%.2f", $g['NOTEMAX']) . '</td>';
            } else {
                $str .= '<td border="1" width="' . $col[9] . '%"></td>';
            }
            #Appreciation
            if (!empty($g['COEFF']) && intval($g['COEFF']) != 0) {
                $str .= '<td  style="line-height:17px;text-align:left;"'
                        . ' border="1" width="' . $col[10] . '%" >&nbsp;&nbsp;<span style="text-transform:uppercase">' .
                        getAppreciationsANG($g['MOYENNE']) . '</span></td>';
            } else {
                $str .= '<td border="1" width="' . $col[10] . '%"></td>';
            }
            # Sommes
            #$sumdh += $g['MOYENNE'];
            #$sumdp += $g['DP'];
            $sumcoeff += $g['COEFF'];
            $sumtotal += $g['TOTAL'];
            $summoy += $g['MOYENNE'];

            $str .= '</tr>';
        }
    }
    /* if ($g['IDGROUPE'] === 1) {
      $description = "Average Art Subjects";
      } elseif ($g['IDGROUPE'] === 2) {
      $description = "Average Science Subjects";
      } else {
      $description = "Average Other Subjects";
      }
      if (!empty($groupe)) {
      $param = ["sumtotal" => $sumtotal, "sumcoeff" => $sumcoeff,
      "description" => $description, "codeperiode" => $codeperiode];
      $str .= printGroupeANG($col, $param);
      } */
    return $str;
}
function getBodyAverageANGTrimestre($col, $rang, $prev, $sumtotal, $coeftotal, $seq1, $seq2){
      $str = '<tr style="line-height:14px;text-align:center;font-weight:bold;">'
            . '<td border="1" witdh="' . $col[1] . '%" style="text-align:left">&nbsp;&nbsp;MONTHLY AVG</td>'
            . '<td border="1" witdh="' . $col[4] . '%">' .(isset($seq1['MOYGENERALE']) ? sprintf("%.2f", $seq1['MOYGENERALE']) : "") .' </td>'
            . '<td border="1" witdh="' . $col[5] . '%">'.(isset($seq2['MOYGENERALE']) ? sprintf("%.2f", $seq2['MOYGENERALE']) : "").'</td>'
            . '<td border="1" witdh="' . $col[6] . '%"></td>'
            . '<td border="1" witdh="' . $col[7] . '%"> ' . $coeftotal . '</td>'
            . '<td border="1"  colspan="3" witdh="' . ($col[8] + $col[9] + $col[10]) . '%"> Points ' . sprintf("%.2f", $sumtotal) . ' / ' . sprintf("%.2f", $coeftotal * 20) . '</td>'
            . '<td border="1"  colspan="2" witdh="' . ($col[11] + $col[12]) . '%"></td></tr>';

    $expo = "<sup>&egrave;me</sup>";
    if ($rang['RANG'] == 1) {
        $expo = '<sup>er</sup>';
    }
    
    $execo = "";
    if ($rang['RANG'] == $prev) {
        $execo = "ex";
    }


    $str .= '<tr style="line-height:14px;text-align:center;font-weight:bold;">'
            . '<td border="1" witdh="' . $col[1] . '%" style="text-align:left">&nbsp;&nbsp;TERM AVG</td>'
            . '<td border="1" style="background-color:#CCC" colspan="3" witdh="' . ($col[4] + $col[5] + $col[6]) . '%">'
            . sprintf("%.2f", $rang['MOYGENERALE']) . '</td>'
            . '<td border="1" style="background-color:#CCC" witdh="' . $col[7]  . '%"></td>'
            . '<td border="1" style="background-color:#CCC" colspan="3" witdh="' . ($col[8] + $col[9] + $col[10]) . '%">'
            . ( $rang['RANG'] . $expo . ' ' . $execo ) . '</td>'
            . '<td border="1"  colspan="2" witdh="' . ($col[11] + $col[12]) . '%">' . getAppreciationsANG($rang['MOYGENERALE']) . '</td></tr>';
    return $str;
}
function getBodyAverageANG($col, $rang, $prev, $sumtotal, $coeftotal) {  
    $str = '<tr style="line-height:14px;text-align:center;font-weight:bold;">'
            . '<td border="1" witdh="' . $col[1] . '%" style="text-align:left">&nbsp;&nbsp;TOTAL</td>'
            . '<td border="1" witdh="' . $col[4] . '%"></td>'
            . '<td border="1" witdh="' . $col[5] . '%"> ' . $coeftotal . '</td>'
            . '<td border="1"  colspan="3" witdh="' . ($col[6] + $col[7] + $col[8]) . '%"> Points ' . sprintf("%.2f", $sumtotal) . ' / ' . sprintf("%.2f", $coeftotal * 20) . '</td>'
            . '<td border="1"  colspan="2" witdh="' . ($col[9] + $col[10]) . '%"></td></tr>';

    $expo = "<sup>th</sup>";
    if ($rang['RANG'] == 1) {
        $expo = '<sup>st</sup>';
    }
    if ($rang['RANG'] == 2) {
        $expo = '<sup>nd</sup>';
    }
    if ($rang['RANG'] == 3) {
        $expo = '<sup>rd</sup>';
    }
    $execo = "";
    if ($rang['RANG'] == $prev) {
        $execo = "ex";
    }


    $str .= '<tr style="line-height:14px;text-align:center;font-weight:bold;">'
            . '<td border="1" witdh="' . $col[1] . '%" style="text-align:left">&nbsp;&nbsp;AVERAGE</td>'
            . '<td border="1" style="background-color:#CCC" colspan="2" witdh="' . ($col[4] + $col[5]) . '%">'
            . sprintf("%.2f", $rang['MOYGENERALE']) . '</td>'
            . '<td border="1" style="background-color:#CCC" colspan="3" witdh="' . ($col[6] + $col[7] + $col[8]) . '%">'
            . ( $rang['RANG'] . $expo . ' ' . $execo ) . '</td>'
            . '<td border="1"  colspan="2" witdh="' . ($col[9] + $col[10]) . '%">' . getAppreciationsANG($rang['MOYGENERALE']) . '</td></tr>';
    return $str;
}

function printGroupeANG($col, $params) {
    # Ecrire le GROUPE 1
    #$backg = "#F7F7F7";
    $backg = "#CCC";
    if (strlen($params['description']) > 10) {
        $backg = "#CCC";
    }
    $str = '<tr style="background-color:' . $backg . ';line-height:14px;text-align:center;font-weight:bold;">';
    $str .= '<td border="1" witdh="' . $col[1] . '%" style="text-align:left">&nbsp;&nbsp;' . $params['description'] . '</td>';

    # Moyenne totale du groupe 
    if ($params['sumcoeff'] != 0) {
        $moy = ($params['sumtotal']) / $params['sumcoeff'];
    } else {
        $moy = 0;
    }
    if ($params['codeperiode'] === "S") {
        $str .= '<td border="1" width="' . $col[4] . '%"></td>';
        $str .= '<td border="1" width="' . $col[5] . '%">' . $params['sumcoeff'] . '</td>'
                . '<td border="1" colspan="3" width="' . ($col[6] + $col[7] + $col[8]) . '%">'
                . 'Points : ' . $params['sumtotal'] . " / " . ($params['sumcoeff'] * 20) . '</td>';
        $str .= '<td style="text-align:left" border="1" colspan="2" width="' . ($col[9] + $col[10]) . '%">'
                . '&nbsp;&nbsp;Average : ' . sprintf("%.2f", $moy) . '</td></tr>';
    } elseif ($params['codeperiode'] === "T") {
        $str .= '<td border="1" colspan="3" width="' . ($col[2] + $col[3] + $col[4]) . '%">'
                . __t2('Points') . ' : ' . $params['sumtotal'] . " / " . ($params['sumcoeff'] * 20) . '</td>'
                . '<td border="1" width="' . $col[5] . '%">' . $params['sumcoeff'] . '</td>';

        $str .= '<td style="text-align:left" border="1" colspan="5" width="' . ($col[6] + $col[7] + $col[8] + $col[9] + $col[10]) . '%">'
                . '&nbsp;&nbsp;Average : ' . sprintf("%.2f", $moy) . '</td></tr>';
    }

    return $str;
}

function printTravailAnnuelANG($disc, $rang, $moyclasse, $moymax, $moymin, $success_rate){
    $colt = array();
    $colt[0] = 0;
    $colt[1] = 21;
    $colt[2] = 12;
    $colt[3] = 7;
    $colt[5] = 7;
    $colt[7] = 7;
    $colt[8] = 13;
    $colt[4] = 12;
    $colt[6] = 14;
    $colt[9] = 8.2;
    
    $total = 0;
    $just = 0;
    $retard = 0;
    for ($i = 1; $i <= 6; $i++) {
        $total += isset($disc["ABS" . $i]) ? $disc["ABS" . $i] : 0;
        $just += isset($disc['JUST' . $i]) ? $disc['JUST' . $i] : 0;
        $retard += isset($disc['CONS' . $i]) ? $disc['CONS' . $i] : 0;
    }
    
    $str = '<table border="1" cellpadding="3" ><tbody><tr>'
            . '<td width="' . $colt[1] . '%" border="1"><b>DISCIPLINE</b></td>'
            . '<td width="' . $colt[2] . '%" border="1">No. Absences</td>'
            . '<td width="' . $colt[3] . '%" style="text-align:center" border="1">' . $total . '</td>'
            . '<td width="' . $colt[4] . '%" border="1">Justified hours</td>'
            . '<td width="' . $colt[5] . '%" style="text-align:center"  border="1">' . $just . '</td>'
            . '<td width="' . $colt[6] . '%" border="1">Unjustified hours</td>'
            . '<td width="' . $colt[7] . '%" style="text-align:center" border="1">' . ($total - $just) . '</td>'
            . '<td width="' . $colt[8] . '%" border="1">Days of</td>'
            . '<td width="' . $colt[9] . '%" style="text-align:center" border="1">' . $retard .'</td></tr>';
    $str .= '<tr>'
            . '<td width="' . $colt[1] . '%" ><b>DISTINCTION</b></td>'
            . '<td>Warning</td><td style="text-align:center">';
    if($rang['MOYGENERALE'] <= 9.99){
        $str .= '<span style="font-family:zapfdingbats;">4</span>';
    } 
    $str .= '</td><td>Honour roll</td><td style="text-align:center">';
    
    if($rang['MOYGENERALE'] >= 12){
         $str .= '<span style="font-family:zapfdingbats;">4</span>';
    }
    $str .= '</td><td width="' . $colt[6] . '%" border="1">Encouragements</td><td style="text-align:center">';
    if($rang['MOYGENERALE'] >= 14){
         $str .= '<span style="font-family:zapfdingbats;">4</span>';
    }
    $str .= '</td><td border="1" width="' . $colt[8] . '%">Congratulations</td><td style="text-align:center">';
    if($rang['MOYGENERALE'] >= 18){
        $str .= '<span style="font-family:zapfdingbats;">4</span>';
    }
    $str .= '</td></tr>';
    $str .= '<tr>'
            . '<td width="' . $colt[1] . '%" style="text-align:left"><b>PERFORMANCE STATS.</b></td>'
            . '<td>Avg. Of first</td>'
            . '<td style="text-align:center" >' . sprintf("%.2f", $moymax) . '</td>'
            . '<td>Avg. Of last</td>'
            . '<td style="text-align:center" >' . sprintf("%.2f", $moymin) . '</td>'
            . '<td>Class avg.</td>'
            . '<td style="text-align:center" >' . sprintf("%.2f", $moyclasse) . '</td>'
            . '<td>% Success</td>'
            . '<td style="text-align:center" >' . sprintf("%.2f", $success_rate) . '%</td></tr>'
            . '</tbody></table>';
    return $str;
}

function printTravailTrimestreANG($travail, $abs1, $abs2, $rang){
    $colt = array();
    $colt[0] = 0;
    $colt[1] = 21;
    $colt[2] = 12;
    $colt[3] = 7;
    $colt[5] = 7;
    $colt[7] = 7;
    $colt[8] = 13;
    $colt[4] = 12;
    $colt[6] = 14;
    $colt[9] = 8.2;
    
    $totalabs = $abs1['TOTALABS'] + $abs2['TOTALABS'];
    $absinjust = $abs1['ABSINJUST'] + $abs2['ABSINJUST'];
    $absjust = $abs1['ABSJUST'] + $abs2['ABSJUST'];
    if($totalabs == 0){
        $absjust = 0;
    }
    
    $str = '<table border="1" cellpadding="3" ><tbody><tr>'
            . '<td width="' . $colt[1] . '%" border="1"><b>DISCIPLINE</b></td>'
            . '<td width="' . $colt[2] . '%" border="1">No. Absences</td>'
            . '<td width="' . $colt[3] . '%" style="text-align:center" border="1">' . $totalabs . '</td>'
            . '<td width="' . $colt[4] . '%" border="1">Justified hours</td>'
            . '<td width="' . $colt[5] . '%" style="text-align:center"  border="1">' . $absjust . '</td>'
            . '<td width="' . $colt[6] . '%" border="1">Unjustified hours</td>'
            . '<td width="' . $colt[7] . '%" style="text-align:center" border="1">' . ($totalabs - $absjust) . '</td>'
            . '<td width="' . $colt[8] . '%" border="1">Days of</td>'
            . '<td width="' . $colt[9] . '%" style="text-align:center" border="1"></td></tr>';
    $str .= '<tr>'
            . '<td width="' . $colt[1] . '%" ><b>DISTINCTION</b></td>'
            . '<td>Warning</td><td style="text-align:center">';
    if($rang['MOYGENERALE'] <= 9.99){
        $str .= '<span style="font-family:zapfdingbats;">4</span>';
    } 
    $str .= '</td><td>Honour roll</td><td style="text-align:center">';
    
    if($rang['MOYGENERALE'] >= 12){
         $str .= '<span style="font-family:zapfdingbats;">4</span>';
    }
    $str .= '</td><td width="' . $colt[6] . '%" border="1">Encouragements</td><td style="text-align:center">';
    if($rang['MOYGENERALE'] >= 14){
         $str .= '<span style="font-family:zapfdingbats;">4</span>';
    }
    $str .= '</td><td border="1" width="' . $colt[8] . '%">Congratulations</td><td style="text-align:center">';
    if($rang['MOYGENERALE'] >= 18){
        $str .= '<span style="font-family:zapfdingbats;">4</span>';
    }
    $str .= '</td></tr>';
    $str .= '<tr>'
            . '<td width="' . $colt[1] . '%" style="text-align:left"><b>PERFORMANCE STATS.</b></td>'
            . '<td>Avg. Of first</td>'
            . '<td style="text-align:center" >' . sprintf("%.2f", $travail['MOYMAX']) . '</td>'
            . '<td>Avg. Of last</td>'
            . '<td style="text-align:center" >' . sprintf("%.2f", $travail['MOYMIN']) . '</td>'
            . '<td>Class avg.</td>'
            . '<td style="text-align:center" >' . sprintf("%.2f", $travail['MOYCLASSE']) . '</td>'
            . '<td>% Success</td>'
            . '<td style="text-align:center" >' . sprintf("%.2f", $travail['SUCCESSRATE']) . '%</td></tr>'
            . '</tbody></table>';
    return $str;
}

function printTravailANG($travail, $disc, $rang) {
    $colt = array();
    $colt[0] = 0;
    $colt[1] = 21;
    $colt[2] = 12;
    $colt[3] = 7;
    $colt[5] = 7;
    $colt[7] = 7;
    $colt[8] = 13;
    $colt[4] = 12;
    $colt[6] = 14;
    $colt[9] = 8.2;
    if (empty($disc['TOTALABS'])) {
        $disc['TOTALABS'] = 0;
        $disc['ABSINJUST'] = 0;
    }
    if (empty($disc['ABSINJUST'])) {
        $disc['ABSINJUST'] = 0;
    }

    $str = '<table border="1" cellpadding="3" ><tbody><tr>'
            . '<td width="' . $colt[1] . '%" border="1"><b>DISCIPLINE</b></td>'
            . '<td width="' . $colt[2] . '%" border="1">No. Absences</td>'
            . '<td width="' . $colt[3] . '%" style="text-align:center" border="1">' . $disc['TOTALABS'] . '</td>'
            . '<td width="' . $colt[4] . '%" border="1">Justified hours</td>'
            . '<td width="' . $colt[5] . '%" style="text-align:center"  border="1">' . $disc['ABSINJUST'] . '</td>'
            . '<td width="' . $colt[6] . '%" border="1">Unjustified hours</td>'
            . '<td width="' . $colt[7] . '%" style="text-align:center" border="1">' . ($disc['TOTALABS'] - $disc['ABSJUST']) . '</td>'
            . '<td width="' . $colt[8] . '%" border="1">Days of</td>'
            . '<td width="' . $colt[9] . '%" style="text-align:center" border="1"></td></tr>';
    $str .= '<tr>'
            . '<td width="' . $colt[1] . '%" ><b>DISTINCTION</b></td>'
            . '<td>Warning</td><td style="text-align:center">';
    if ($rang['MOYGENERALE'] <= 9.99) {
        $str .= '<span style="font-family:zapfdingbats;">4</span>';
    }
    $str .= '</td><td>Honour roll</td><td style="text-align:center">';

    if ($rang['MOYGENERALE'] >= 12) {
        $str .= '<span style="font-family:zapfdingbats;">4</span>';
    }
    $str .= '</td><td width="' . $colt[6] . '%" border="1">Encouragements</td><td style="text-align:center">';
    if ($rang['MOYGENERALE'] >= 14) {
        $str .= '<span style="font-family:zapfdingbats;">4</span>';
    }
    $str .= '</td><td border="1" width="' . $colt[8] . '%">Congratulations</td><td style="text-align:center">';
    if ($rang['MOYGENERALE'] >= 18) {
        $str .= '<span style="font-family:zapfdingbats;">4</span>';
    }
    $str .= '</td></tr>';
    $str .= '<tr>'
            . '<td width="' . $colt[1] . '%" style="text-align:left"><b>PERFORMANCE STATS.</b></td>'
            . '<td>Avg. Of first</td>'
            . '<td style="text-align:center" >' . sprintf("%.2f", $travail['MOYMAX']) . '</td>'
            . '<td>Avg. Of last</td>'
            . '<td style="text-align:center" >' . sprintf("%.2f", $travail['MOYMIN']) . '</td>'
            . '<td>Class avg.</td>'
            . '<td style="text-align:center" >' . sprintf("%.2f", $travail['MOYCLASSE']) . '</td>'
            . '<td>% Success</td>'
            . '<td style="text-align:center" >' . sprintf("%.2f", $travail['SUCCESSRATE']) . '%</td></tr>'
            . '</tbody></table>';
    return $str;
}

function getRemarks($codeperiode) {
    $col = [28, 25, 25, 25];
    $str = '<table border="1" cellpadding="4" style="text-align:center"><tbody>'
            . '<tr><td border="1" colspan="4" style="background-color:#CCC"  width="' . array_sum($col) . '%">Remarks</td></tr>'
            . '<tr><td width="' . $col[0] . '%" border="1">Class advisor remarks</td>'
            . '<td width="' . $col[1] . '%" border="1">Displinary remarks</td>'
            . '<td width="' . $col[2] . '%"border="1" >Parents signatures</td>'
            . '<td width="' . $col[3] . '%" border="1">Principal\'s signature</td></tr>';
    $str .= '<tr style="line-height:55px">'
            . '<td width="' . $col[0] . '%"></td>'
            . '<td width="' . $col[1] . '%"></td>'
            . '<td width="' . $col[2] . '%"></td>'
            . '<td width="' . $col[3] . '%"></td></tr></tbody></table>';
    return $str;
}

function genererCourbeANG($moyennes, $rang, $codeperiode = "S") {
    try {
        # Donnees de la courbe
        $ydata = $moyennes;
        $ydata2 = $moyennes;

        /* for ($i = 1; $i <= 6; $i++) {
          $r = rand(0, 20);
          $ydata[] = $r;
          $ydata2[] = $r;
          } */

        /** Definition des label de l'axe x */
        if ($codeperiode === "T") {
            $datax = array("TERM1", "TERM2", "TERM3");
        } else {
            $datax = array("M1", "M2", "M3", "M4", "M5", "M6");
        }

        # Creation du graph
        $graph = new Graph(350, 250, 'auto');
        $graph->SetMarginColor('white');

        # Definir le max et le min des valeur X
        $graph->SetScale('textlin', 0, 20);

        #$graph->xaxis->title->Set("Séquences");
        $graph->yaxis->title->SetFont(FF_ARIAL, FS_BOLD, 12);
        $graph->yaxis->title->Set("Averages");
        $graph->xaxis->SetTickLabels($datax);
        $graph->yaxis->SetTickLabels([0, 5, 10, 15, 20]);
        $graph->xaxis->title->SetFont(FF_ARIAL, FS_BOLD, 12);
        if ($codeperiode === "T") {
            $graph->xaxis->SetTitle("Terms", "middle");
        } else {
            $graph->xaxis->SetTitle("Months", "middle");
        }

        $graph->SetBackgroundGradient('white', 'lightblue', GRAD_HOR, BGRAD_PLOT);

        # Adjuster les margins (left, right, top, bottom)
        $graph->SetMargin(40, 5, 21, 45);

        # Box autour du plotarea
        $graph->SetBox();

        # Un cadre ou frame autour de l'image
        $graph->SetFrame(false);

        # Definir le titre tabulaire
        $graph->tabtitle->SetFont(FF_ARIAL, FS_BOLD, 8);
        $graph->tabtitle->Set($_SESSION['anneeacademique']);
        # Definir le titre du graphe
        $graph->title->SetFont(FF_VERDANA, FS_BOLD, 8);
        $graph->title->SetAlign("right");

        if (count($ydata) > 1) {
            $prev = $ydata[count($ydata) - 2];
            if ($prev < $ydata[count($ydata) - 1]) {
                $graph->title->Set("Performance up");
            } elseif ($prev == $ydata[count($ydata) - 1]) {
                $graph->title->Set("Constant performance");
            } else {
                $graph->title->Set("Performance down");
            }
        }


        # Definir les grid X et Y
        $graph->ygrid->SetFill(true, '#BBBBBB@0.9', '#FFFFFF@0.9');
        //$graph->ygrid->SetLineStyle('dashed');
        //$graph->ygrid->SetColor('gray');
        //$graph->xgrid->SetLineStyle('dashed');

        $graph->xgrid->SetColor('gray');
        $graph->xgrid->Show();
        //$graph->ygrid->Show();
        #$graph->SetBackgroundGradient('blue','navy:0.5',GRAD_HOR,BGRAD_MARGIN);
        $graph->xaxis->SetFont(FF_ARIAL, FS_NORMAL, 8);
        $graph->xaxis->SetLabelAngle(0);

        # Creation d'une bar pot
        $bplot = new BarPlot($ydata);
        $bplot->SetWidth(0.9);
        $fcol = '#440000';
        $tcol = '#FF9090';

        $bplot->SetFillGradient($fcol, $tcol, GRAD_LEFT_REFLECTION);

        # Set line weigth to 0 so that there are no border around each bar
        $bplot->SetWeight(0);

        # Create filled line plot
        $lplot = new LinePlot($ydata2);
        $lplot->SetFillColor('skyblue@0.5');
        $lplot->SetStyle(1);
        $lplot->SetColor('navy@0.7');
        $lplot->SetBarCenter();

        $lplot->mark->SetType(MARK_SQUARE);
        $lplot->mark->SetColor('blue@0.5');
        $lplot->mark->SetFillColor('lightblue');
        $lplot->mark->SetSize(5);
        # Afficher les moyenne au dessus des barres
        $accbarplot = new AccBarPlot(array($bplot));
        $accbarplot->value->SetFormat("%.2f");
        $accbarplot->value->Show();
        $graph->Add($accbarplot);
        $graph->SetBackgroundImageMix(50);

        # Definir un fond d'ecran pour l'image
        $background = SITE_ROOT . "public/photos/eleves/" . $rang['PHOTOEL'];
        if (!empty($rang['PHOTOEL']) &&
                file_exists(ROOT . DS . "public" . DS . "photos" . DS . "eleves" . DS . $rang['PHOTOEL'])) {
            $graph->SetBackgroundImage($background, BGIMG_FILLPLOT);

            # $icon = new IconPlot($background, 25, 25, 0.8, 50);
        } else {
            //$graph->SetBackgroundImage(SITE_ROOT . "public/img/". LOGO, BGIMG_FILLPLOT);
            # $icon = new IconPlot(SITE_ROOT . "public/img/ipw.png", 25, 25, 0.8, 50);
        }
        # $icon->SetAnchor('right', 'bottom');

        $graph->Add($lplot);


        // Display the graph
        $filename = ROOT . DS . "public" . DS . "tmp" . DS . $rang['IDELEVE'] . ".png";
        if (file_exists($filename)) {
            unlink($filename);
        }
        $graph->Stroke($filename);
        //echo "<img src='" . SITE_ROOT . "public/tmp/emp.png' />";
    } catch (Exception $e) {
        var_dump($e);
    }
}
