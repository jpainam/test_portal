<?php
function getAnnuelFinalDecision($moy, $groupe = 0){
    if($groupe == 0 || $groupe == 1){
        return "";
    }
    
    $gr = "<sup>ème</sup>";
    if($groupe == 3){
        $gr = "<sup>nde</sup>";
    }
    if($groupe == 2){
        $gr = "<sup>ère</sup>";
    }
    if($groupe == 6 || $groupe == 5){
        if($moy >= 10.00){
            return 'Admis(e) en '.($groupe - 1).$gr ;
        }/*elseif($moy >= 10.00 && $moy <= 11.99){
            return 'Admis(e) en ' . ($groupe - 1).$gr.' et # Nécessité de cours de vacances';
        }elseif($moy >= 8.50 && $moy <= 9.99){
            return 'Examen de rattrapage et # Obligation de cours de vacances';
        }*/
    }elseif($groupe == 4 || $groupe == 3 || $groupe == 2){
        if($moy >= 12.00){
            return 'Admis(e) en '.($groupe - 1).$gr;
        }elseif($moy >= 10.00 && $moy <= 11.99){
            return 'Admis(e) en '.($groupe - 1).$gr.' # Nécessité de cours de vacances';
        }elseif($moy >= 8.50 && $moy <= 9.99){
            return 'Examen de rattrapage et # Obligation de cours de vacances';
        }
    }
    return "";
}

function getAnnuelFinalDecisionANG($moy, $groupe=0){
     if($moy >= 12.00){
        return 'Promoted';
    }elseif($moy >= 10.00 && $moy <= 11.99){
        return 'Promoted, and # Holiday classes recommended';
    }elseif($moy >= 9.00 && $moy <= 9.99){
        return 'Holiday classes recommended';
    }
}


function getBodyAnnuelle($groupe, $col, $el, &$sumtotal = 0, &$sumcoeff = 0, $cellHeight=17, $cellFont=7) {
    $str = "";
    foreach ($groupe as $g) {
        if ($g['IDELEVE'] == $el['IDELEVE']) {
            $str .= '<tr style="text-align:center;">';
            # Matiere
            //$g['NOM'] = preg_replace("%[^\033-\176\r\n\t]%", '', $g['NOM']);
            //$g['PRENOM'] = preg_replace("%[^\033-\176\r\n\t]%", '', $g['PRENOM']);

            $str .= '<td border="1" style="text-align:left;" '
                    . 'width="' . $col[10] . '%">&nbsp;&nbsp;<b style="text-transform:uppercase;font-size:'.$cellFont.'px;">' . trim($g['BULLETIN']) .
                    '</b><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size:'.$cellFont.'px;font-weight:normal">'
                    . ($g['CIVILITE'] . ' ' . $g['NOM']) . '</span></td>';

            # NOTES SEQUENTIELLES

            if (!empty($g['SEQ1'])) {
                $str .= '<td  style="line-height:'.$cellHeight.'px" border="1" width="' . $col[1] . '%">' . sprintf("%.2f", $g['SEQ1']) . '</td>';
            } else {
                $str .= '<td border="1" width="' . $col[1] . '%"></td>';
            }
            if (!empty($g['SEQ2'])) {
                $str .= '<td  style="line-height:'.$cellHeight.'px" border="1" width="' . $col[2] . '%">' . sprintf("%.2f", $g['SEQ2']) . '</td>';
            } else {
                $str .= '<td border="1" width="' . $col[2] . '%"></td>';
            }
            if (!empty($g['SEQ3'])) {
                $str .= '<td  style="line-height:'.$cellHeight.'px" border="1" width="' . $col[3] . '%">' . sprintf("%.2f", $g['SEQ3']) . '</td>';
            } else {
                $str .= '<td border="1" width="' . $col[3] . '%"></td>';
            }
            if (!empty($g['SEQ4'])) {
                $str .= '<td  style="line-height:'.$cellHeight.'px" border="1" width="' . $col[4] . '%">' . sprintf("%.2f", $g['SEQ4']) . '</td>';
            } else {
                $str .= '<td border="1" width="' . $col[4] . '%"></td>';
            }
            if (!empty($g['SEQ5'])) {
                $str .= '<td  style="line-height:'.$cellHeight.'px" border="1" width="' . $col[5] . '%">' . sprintf("%.2f", $g['SEQ5']) . '</td>';
            } else {
                $str .= '<td border="1" width="' . $col[5] . '%"></td>';
            }
            if (!empty($g['SEQ6'])) {
                $str .= '<td  style="line-height:'.$cellHeight.'px" border="1" width="' . $col[6] . '%">' . sprintf("%.2f", $g['SEQ6']) . '</td>';
            } else {
                $str .= '<td border="1" width="' . $col[6] . '%"></td>';
            }



            # Moyenne DES 6 SEQUENCE
            if (!empty($g['COEFF']) && intval($g['COEFF']) != 0) {
                $str .= '<td  style="line-height:'.$cellHeight.'px" border="1" width="' . $col[7] . '%">' . sprintf("%.2f", $g['MOYENNE']) . '</td>';
            } else {
                $str .= '<td border="1" width="' . $col[7] . '%"></td>';
            }
            # Coeff
            if (!empty($g['COEFF']) && intval($g['COEFF']) != 0) {
                $str .= '<td  style="line-height:'.$cellHeight.'px" border="1" width="' . $col[11] . '%">' . sprintf("%.0f", $g['COEFF']) . '</td>';
            } else {
                $str .= '<td border="1" width="' . $col[11] . '%"></td>';
            }
            # Total = coeff * moy
            if (!empty($g['COEFF']) && intval($g['COEFF']) != 0) {
                $str .= '<td  style="line-height:'.$cellHeight.'px" border="1" width="' . $col[13] . '%">' . sprintf("%.2f", sprintf("%.2f", $g['MOYENNE']) * $g['COEFF']) . '</td>';
            } else {
                $str .= '<td border="1" width="' . $col[13] . '%"></td>';
            }
            # Rang
            if (!empty($g['COEFF']) && intval($g['COEFF']) != 0) {
                $str .= '<td  style="line-height:'.$cellHeight.'px" border="1" width="' . $col[8] . '%">' . $g['RANG'] . '</td>';
            } else {
                $str .= '<td border="1" width="' . $col[8] . '%"></td>';
            }
            #Appreciation
            if (!empty($g['COEFF']) && intval($g['COEFF']) != 0) {
                $str .= '<td  style="text-align:left;line-height:'.$cellHeight.'px"'
                        . ' border="1" width="' . $col[9] . '%" >&nbsp;&nbsp;<span style="text-transform:uppercase;font-size:'.$cellFont.'px;">' .
                        getAppreciations($g['MOYENNE']) . '</span></td>';
            } else {
                $str .= '<td border="1" width="' . $col[9] . '%"></td>';
            }
            $sumcoeff += $g['COEFF'];
            $sumtotal += $g['TOTAL'];
            $str .= '</tr>';
        }
    }
    if (!empty($groupe)) {
        $param = ["sumtotal" => $sumtotal, "sumcoeff" => $sumcoeff,
            "description" => $g['DESCRIPTION']];
        $str .= printGroupeAnnuelle($col, $param);
    }
    return $str;
}

function printGroupeAnnuelle($col, $params) {
    # Ecrire le GROUPE 1
    #$backg = "#F7F7F7";
    $backg = "#CCC";
    if (strlen($params['description']) > 10) {
        $backg = "#CCC";
    }
    $str = '<tr style="background-color:' . $backg . ';line-height:14px;text-align:center;font-weight:bold;">';
    $str .= '<td border="1" witdh="' . $col[10] . '%" style="text-align:left">&nbsp;&nbsp;' . $params['description'] . '</td>';

    # Moyenne totale du groupe 
    if ($params['sumcoeff'] != 0) {
        $moy = ($params['sumtotal']) / $params['sumcoeff'];
    } else {
        $moy = 0;
    }

    $str .= '<td border="1" colspan = "6" width="' . ($col[1] * 6) . '%"></td>';
    $str .= '<td border="1" width="' . $col[7] . '%">' . sprintf("%.2f", $moy) . '</td>'
            . '<td border="1" width="' . $col[11] . '%">' . $params['sumcoeff'] . "</td>";
    $str .= '<td  border="1" colspan="3"  width="' . ($col[13] + $col[8] + $col[9]) . '%">Points : ' . sprintf("%.2f", $params['sumtotal']) . '</td></tr>';
    return $str;
}

function printMoyRangAnnuel($rang, $prev, $moyclasse, $moymax, $moymin) {
    $colt = [15, 15, 15, 15, 15, 29];
    $str = '<table style="text-align:center"><tr style="font-weight:bold;line-height:12px;font-size:8px">
            <td border="1" rowspan="2" width="' . $colt[0] . '%">'.__t2('Moyenne Annuelle').'</td>
            <td border="1" rowspan="2" width="' . $colt[1] . '%">'.__t2('Rang Annuel').'</td>
            <td border="1" rowspan="2" width="' . $colt[2] . '%">'.__t2('Moyenne Classe').'</td>
            <td border="1" rowspan="2" width="' . $colt[3] . '%">'.__t2('Moyenne Max').'</td>
            <td border="1" rowspan="2" width="' . $colt[4] . '%">'.__t2('Moyenne Min').'</td>
      <td border="1" width="' . $colt[5] . '%">'.__t2('Appr&eacute;ciation').'</td></tr>';
    $mention = getMentions($rang['MOYGENERALE']);
    $str .= '<tr>
              <td style="line-height:7px;font-size:8px" border="1" rowspan = "2" width="' . $colt[5] . '%">' . $mention . '</td></tr>';
    # Moyenne generale
    $str .= '<tr  style="font-weight:bold;line-height:12px;font-size:8px">
              <td  border="1" style="background-color:#CCC" width="' . $colt[0] . '%">' . sprintf("%.2f", $rang['MOYGENERALE']) . '</td>';
    # Rang Annuelle
    $expo = "<sup>".__t2('&egrave;me')."</sup>";
    if ($rang['RANG'] == 1) {
        $expo = '<sup>' . ($rang['SEXEEL'] == "F" ? "&egrave;re" : "er") . '</sup>';
    }
    $execo = "";
    if ($rang['RANG'] == $prev) {
        $execo = "ex";
    }
    $str .= '<td width="' . $colt[1] . '%" border="1" style="background-color:#CCC">' . $rang['RANG'] . $expo . ' ' . $execo . '</td>';
    $str .= '<td border="1">' . sprintf("%.2f", $moyclasse) . '</td>'
            . '<td border="1">' . sprintf("%.2f", $moymax) . '</td>'
            . '<td border="1">' . sprintf("%.2f", $moymin) . '</td></tr></table>';
    return $str;
}

function printTravailAnnuel($rang, $seqs) {
    $colt = array();
    $colt[0] = 6;
    $colt[1] = 6;
    $colt[2] = 8;
    $str = '<table style="text-align:center"><tr style="font-weight:bold;line-height:12px;font-size:8px"><td width="' . $colt[2] . '%"></td>';
    for ($i = 1; $i <= 6; $i++) {
        $str .= '<td border="1" width="' . $colt[1] . '%">Seq' . $i . '</td>';
    }

    $str .= '</tr><tr style="font-weight:bold;line-height:12px;font-size:8px"><td width="' . $colt[2] . '%" border="1">Moy</td>';
    $r1 = $r2 = $r3 = $r4 = $r5 = $r6 = "";
    if (!empty($seqs['MOYSEQ1'])) {
        $str .= '<td width="' . $colt[1] . '%" border="1">' . sprintf("%.2f", $seqs['MOYSEQ1']) . '</td>';
        $expo = ($seqs['RANGSEQ1'] == 1) ? '<sup>' . ($rang['SEXEEL'] == "F" ? __t2("&egrave;re") : __t2("er")) . '</sup>' : "<sup>".__t2('&egrave;me')."</sup>";
        $r1 = $seqs['RANGSEQ1'] . $expo;
    } else {
        $str .= '<td width="' . $colt[1] . '%" border="1"></td>';
    }
    if (!empty($seqs['MOYSEQ2'])) {
        $str .= '<td width="' . $colt[1] . '%" border="1">' . sprintf("%.2f", $seqs['MOYSEQ2']) . '</td>';
        $expo = ($seqs['RANGSEQ2'] == 1) ? '<sup>' . ($rang['SEXEEL'] == "F" ? __t2("&egrave;re") : __t2("er")) . '</sup>' : "<sup>".__t2('&egrave;me')."</sup>";
        $r2 = $seqs['RANGSEQ2'] . $expo;
    } else {
        $str .= '<td width="' . $colt[1] . '%" border="1"></td>';
    }
    if (!empty($seqs['MOYSEQ3'])) {
        $str .= '<td width="' . $colt[1] . '%" border="1">' . sprintf("%.2f", $seqs['MOYSEQ3']) . '</td>';
        $expo = ($seqs['RANGSEQ3'] == 1) ? '<sup>' . ($rang['SEXEEL'] == "F" ? __t2("&egrave;re") : __t2("er")) . '</sup>' : "<sup>".__t2('&egrave;me')."</sup>";
        $r3 = $seqs['RANGSEQ3'] . $expo;
    } else {
        $str .= '<td width="' . $colt[1] . '%" border="1"></td>';
    }
    if (!empty($seqs['MOYSEQ4'])) {
        $str .= '<td width="' . $colt[1] . '%" border="1">' . sprintf("%.2f", $seqs['MOYSEQ4']) . '</td>';
        $expo = ($seqs['RANGSEQ4'] == 1) ? '<sup>' . ($rang['SEXEEL'] == "F" ? __t2("&egrave;re") : __t2("er")) . '</sup>' : "<sup>".__t2('&egrave;me')."</sup>";
        $r4 = $seqs['RANGSEQ4'] . $expo;
    } else {
        $str .= '<td width="' . $colt[1] . '%" border="1"></td>';
    }
    if (!empty($seqs['MOYSEQ5'])) {
        $str .=' <td width="' . $colt[1] . '%" border="1">' . sprintf("%.2f", $seqs['MOYSEQ5']) . '</td>';
        $expo = ($seqs['RANGSEQ5'] == 1) ? '<sup>' . ($rang['SEXEEL'] == "F" ? __t2("&egrave;re") : __t2("er")) . '</sup>' : $expo = "<sup>".__t2('&egrave;me')."</sup>";
        $r5 = $seqs['RANGSEQ5'] . $expo;
    } else {
        $str .= '<td width="' . $colt[1] . '%" border="1"></td>';
    }
    if (!empty($seqs['MOYSEQ6'])) {
        $str .= '<td width="' . $colt[1] . '%" border="1">' . sprintf("%.2f", $seqs['MOYSEQ6']) . '</td>';
        $expo = ($seqs['RANGSEQ6'] == 1) ? $expo = '<sup>' . ($rang['SEXEEL'] == "F" ? __t2("&egrave;re") : __t2("er")) . '</sup>' : "<sup>".__t2('&egrave;me')."</sup>";
        $r6 = $seqs['RANGSEQ6'] . $expo;
    } else {
        $str .= '<td width="' . $colt[1] . '%" border="1"></td>';
    }

    $str .= '</tr><tr style="font-weight:bold;line-height:12px;font-size:8px"><td border="1" width="' . $colt[2] . '%" >'.__t2('Rang').'</td>';
    $str .= '<td width="' . $colt[1] . '%" border="1">' . $r1 . '</td>';
    $str .= '<td width="' . $colt[1] . '%" border="1">' . $r2 . '</td>';
    $str .= '<td width="' . $colt[1] . '%" border="1">' . $r3 . '</td>';
    $str .= '<td width="' . $colt[1] . '%" border="1">' . $r4 . '</td>';
    $str .= '<td width="' . $colt[1] . '%" border="1">' . $r5 . '</td>';
    $str .= '<td width="' . $colt[1] . '%" border="1">' . $r6 . '</td></tr></table>';

    return $str;
}

function printTravailAnnuel2($rang, $seqs, $col, $prev, $effectif) {

    $str = '<tr style="text-align:center;line-height:17px">'
            . '<td border="1" style="text-align:left;" width="' . $col[10] . '%"><b>&nbsp;&nbsp;MOYENNE</b></td>';

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
            . '<b>&nbsp;&nbsp;MOY. ANNUELLE: '.sprintf("%.2f", $rang['MOYGENERALE']).'</b></td>';
    $str .= '<td width="' . $col[9] .'%" border="1"><b style="text-transform:uppercase">'.getAppreciations($rang['MOYGENERALE']).'</b></td></tr>';

    $str .= '<tr style="text-align:center; line-height:17px">';
    $str .= '<td style="text-align:left;" border="1" width="' . $col[10] . '%" ><b>&nbsp;&nbsp;RANG</b></td>';
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
            . '<b>&nbsp;&nbsp;RANG ANNUEL: '.$rang['RANG'] . $expo . ' ' . $execo.' / ' .$effectif .' </b></td>';
    $str .= '<td width="' . $col[9] .'%" border="1"></td></tr>';

    return $str;
}

/**
 * Construire rang et la moy annuelle a partir des moyennes sequentielles
 * @param type $rangs
 * @param type $seqs
 */
function setrangannuel(&$rangs, $seqs, &$moyclasse, &$moymax, &$moymin) {
    foreach ($seqs as $seq) {
        $moy = 0;
        $nb = 0;
        if (!empty($seq['MOYSEQ1'])) {
            $moy = $moy + floatval(sprintf("%.2f", $seq['MOYSEQ1']));
            $nb++;
        }
        if (!empty($seq['MOYSEQ2'])) {
            $moy = $moy + floatval(sprintf("%.2f", $seq['MOYSEQ2']));
            $nb++;
        }
        if (!empty($seq['MOYSEQ3'])) {
            $moy = $moy + floatval(sprintf("%.2f", $seq['MOYSEQ3']));
            $nb++;
        }
        if (!empty($seq['MOYSEQ4'])) {
            $moy = $moy + floatval(sprintf("%.2f", $seq['MOYSEQ4']));
            $nb++;
        }
        if (!empty($seq['MOYSEQ5'])) {
            $moy = $moy + floatval(sprintf("%.2f", $seq['MOYSEQ5']));
            $nb++;
        }
        if (!empty($seq['MOYSEQ6'])) {
            $moy = $moy + floatval(sprintf("%.2f", $seq['MOYSEQ6']));
            $nb++;
        }
        $i = 0;
        foreach ($rangs as $rang) {
            if ($rang['IDELEVE'] === $seq['IDELEVE']) {
                $rangs[$i]['MOYGENERALE'] = floatval(sprintf("%.2f", $moy / $nb));
            }
            $i++;
        }
    }
    usort($rangs, function($a, $b) {
        if ($a["MOYGENERALE"] === $b["MOYGENERALE"]) {
            return 0;
        } else {
            return $a["MOYGENERALE"] < $b['MOYGENERALE'] ? 1 : -1;
        }
    });
    $i = 0;
    $prev = null;
    $summoy = 0;
    foreach ($rangs as $r) {
        if ($r['MOYGENERALE'] === $prev) {
            $rangs[$i]["RANG"] = $i;
        } else {
            $rangs[$i]["RANG"] = ($i + 1);
        }
        $i++;
        $prev = $r['MOYGENERALE'];
        $summoy += $r['MOYGENERALE'];
    }
    $moyclasse = $summoy / $i;
    $moymax = $rangs[0]['MOYGENERALE'];
    $moymin = $rangs[$i - 1]["MOYGENERALE"];
}

function getEleveRangForThis($sequence, $ideleve) {
    foreach ($sequence as $s) {
        if ($s['IDELEVE'] === $ideleve) {
            return $s;
        }
    }
    return null;
}

function setmoyrangtrimestriel(&$rangs, $sequence1, $sequence2, &$moyclasse, &$moymax, &$moymin) {

    $i = 0;
   
    foreach ($rangs as $r) {
        $seq1 = getEleveRangForThis($sequence1, $r['IDELEVE']);
        $seq2 = getEleveRangForThis($sequence2, $r['IDELEVE']);
      
        if (isset($seq1['MOYGENERALE']) && isset($seq2['MOYGENERALE'])) {
            $moy1 = floatval(sprintf("%.2f", $seq1['MOYGENERALE']));
            $moy2 = floatval(sprintf("%.2f", $seq2['MOYGENERALE']));
            $moy = floatval(sprintf("%.2f", ($moy1 + $moy2) / 2));
            //print $r['IDELEVE'] . " " . $moy1 . " " . $moy2 . " Moy : " . $moy. "<br/>";
            $rangs[$i]['MOYGENERALE'] = $moy;
        }
        $i++;
    }
    usort($rangs, function($a, $b) {
        if ($a["MOYGENERALE"] === $b["MOYGENERALE"]) {
            return 0;
        } else {
            return $a["MOYGENERALE"] < $b['MOYGENERALE'] ? 1 : -1;
        }
    });
    $i = 0;
    $prev = null;
    $summoy = 0;
    foreach ($rangs as $r) {
        if ($r['MOYGENERALE'] === $prev) {
            $rangs[$i]['RANG'] = $i;
        } else {
            $rangs[$i]['RANG'] = ($i + 1);
        }
        $i++;
        $prev = $r['MOYGENERALE'];
        $summoy += $r['MOYGENERALE'];
    }
    $moyclasse = $summoy / $i;
    $moymax = $rangs[0]['MOYGENERALE'];
    $moymin = $rangs[$i - 1]['MOYGENERALE'];
    
}

function printDisciplineAnnuel($disc) {
    $cold = array();
    $cold[0] = 8;
    $cold[1] = 6;
    $cold[2] = 6;
    $cold[3] = 18;

    $str = '<table style="text-align:center;"><tr style="font-weight:bold;line-height:12px;font-size:8px"><td width="' . $cold[0] . '%"></td>';
    for ($i = 1; $i <= 6; $i++) {
        $str .= '<td border="1" width="' . $cold[1] . '%">Seq' . $i . '</td>';
    }
    $str .= '<td border="1" width="' . $cold[2] . '%" >Total</td>
                <td border="1" width="' . $cold[3] . '%">Discipline</td></tr>
                <tr  style="font-weight:bold;line-height:12px;font-size:8px">
                <td border="1" width="' . $cold[0] . '%"> T.Abs</td>';
    $total = 0;
    $just = 0;
    for ($i = 1; $i <= 6; $i++) {
        $str .= '<td border="1" width="' . $cold[1] . '%">' . (isset($disc["ABS" . $i]) ? $disc["ABS" . $i] : "") . '</td>';
        $total += isset($disc["ABS" . $i]) ? $disc["ABS" . $i] : 0;
        $just += isset($disc['JUST' . $i]) ? $disc['JUST' . $i] : 0;
    }
    $str .='<td border="1" width="' . $cold[2] . '%">' . $total . '</td>
            <td rowspan="3" border="1">' . getConseilClasseConduite($total - $just) . '</td></tr>';
    $str .= '<tr style="font-weight:bold;line-height:12px;font-size:8px"><td width="' . $cold[0] . '%" border="1">Abs.J</td>';

    for ($i = 1; $i <= 6; $i++) {
        $str .= '<td border="1" width="' . $cold[1] . '%">' . (isset($disc['JUST' . $i]) ? $disc['JUST' . $i] : "") . '</td>';
    }
    $str .= '<td width="' . $cold[2] . '%" border="1">' . $just . '</td></tr>';
    $str .= '<tr style="font-weight:bold;line-height:12px;font-size:8px"><td border="1" width="' . $cold[0] . '%">Cons</td>';
    $total = 0;
    for ($i = 1; $i <= 6; $i++) {
        $str .= '<td border="1" width="' . $cold[1] . '%">' . (isset($disc['CONS' . $i]) ? $disc['CONS' . $i] : "") . '</td>';
        $total += isset($disc['CONS' . $i]) ? $disc['CONS' . $i] : "";
    }
    $str .='<td border="1" width="' . $cold[2] . '%"></td></tr>';
    $str .= '</table>';
    return $str;
}

function printDisciplineAnnuel2($disc, $rang, $moyclasse, $moymax, $moymin, $success_rate){
     $colt = array();
    $colt[0] = 0;
    $colt[1] = 18;
    $colt[2] = 12;
    $colt[3] = 7;
    $colt[5] = 7;
    $colt[7] = 7;
    $colt[8] = 13;
    $colt[4] = 15;
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
            . '<td width="' . $colt[4] . '%" border="1">Heures justifi&eacute;es</td>'
            . '<td width="' . $colt[5] . '%" style="text-align:center"  border="1">' . $just . '</td>'
            . '<td width="' . $colt[6] . '%" border="1">Hrs non justifi&eacute;es</td>'
            . '<td width="' . $colt[7] . '%" style="text-align:center" border="1">' . ($total - $just) . '</td>'
            . '<td width="' . $colt[8] . '%" border="1">Retards</td>'
            . '<td width="' . $colt[9] . '%" style="text-align:center" border="1">' . $retard .'</td></tr>';
    $str .= '<tr>'
            . '<td width="' . $colt[1] . '%" ><b>MENTION</b></td>'
            . '<td>Avertissement</td><td style="text-align:center">';
    if($rang['MOYGENERALE'] <= 9.99){
        $str .= '<span style="font-family:zapfdingbats;">4</span>';
    } 
    $str .= '</td><td>Tableau d\'honneur</td><td style="text-align:center">';
    
    if($rang['MOYGENERALE'] >= 12){
         $str .= '<span style="font-family:zapfdingbats;">4</span>';
    }
    $str .= '</td><td width="' . $colt[6] . '%" border="1">Encouragements</td><td style="text-align:center">';
    if($rang['MOYGENERALE'] >= 14){
         $str .= '<span style="font-family:zapfdingbats;">4</span>';
    }
    $str .= '</td><td border="1" width="' . $colt[8] . '%">Félicitations</td><td style="text-align:center">';
    if($rang['MOYGENERALE'] >= 18){
        $str .= '<span style="font-family:zapfdingbats;">4</span>';
    }
    $str .= '</td></tr>';
    $str .= '<tr>'
            . '<td width="' . $colt[1] . '%" style="text-align:left"><b>PERFORMANCE</b></td>'
            . '<td>Moy. Max</td>'
            . '<td style="text-align:center" >' . sprintf("%.2f", $moymax) . '</td>'
            . '<td>Moy. Min</td>'
            . '<td style="text-align:center" >' . sprintf("%.2f", $moymin) . '</td>'
            . '<td>Moy. de classe</td>'
            . '<td style="text-align:center" >' . sprintf("%.2f", $moyclasse) . '</td>'
            . '<td>% Succ&egrave;s</td>'
            . '<td style="text-align:center" >' . sprintf("%.2f", $success_rate) . '%</td></tr>'
            . '</tbody></table>';
    return $str;
}
function printObservationDecision() {
    $str = '<table cellpadding="2" style="text-align:center"><tr style="font-weight:bold;line-height:12px;font-size:8px">
            <td width="39%" border="1">'.__t2('D&eacute;cision du conseil').'</td><td></td></tr>
            <tr style="font-weight:bold;line-height:12px;font-size:8px">
            <td rowspan="2" border="1" width="39%"></td><td></td></tr><tr><td></td></tr></table>';
    return $str;
}
