<?php
# Desactiver les entete de page
$pdf->SetPrintHeader(false);
# Desactiver les pieds de page
$pdf->SetPrintFooter(false);
$pdf->AddPage();
$restant = $montantapayer['TOTALFRAIS'] - $montantpayer['MONTANTPAYER'];
for ($i = 0; $i < 2; $i++) {
    if($i == 0){
        $x = 15;
        $y = 20;
    }elseif($i == 1){
        $x = 15;
        $y = 110;
    }else{
        $x = 15;
        $y = 200;
    }
    $pdf->Rect($x - 5, $y - 5, 190, 80);
    $logo = SITE_ROOT . "public/img/" . $school['LOGO'];

    $pdf->Image($logo, $x, $y - 3, 25, '', '', '', 'T', false, 300, '', false, false, 0, false, false, false);

# Image de font d'ecran
    $pdf->SetAlpha(0.2);
    $pdf->Image($logo, $x + 67, $y, 50, '', '', '', 'T', false, 300, '', false, false, 0, false, false, false);
# Remettre l'opacite par defaut
    $pdf->SetAlpha(1);
    $pdf->setFont("Times", "", 10);
    $corps = '<p style="text-align:center;margin:0; padding:0">'.$school['NOM'].'<br/>'.
            __t('BP').' : '. $school['BP'].' '. __t('CAMEROUN').'<br/>'.
            __t('T&eacute;l&eacute;phone').' : '. $school['TELEPHONE'].'<br/>
            ***************</p>';
   
    $pdf->WriteHTMLCell(0, 0, $x + 5, $y - 3, $corps);
    $pdf->setFont("Times", "", 10);
# Reference
    $reference = '<h2 style="text-align: center; font-size: 15px;">
            <font style="text-decoration: underline">REF:</font>' . $operation['REFCAISSE'] . '</h2>';
    $pdf->WriteHTMLCell(100, 0, $x + 40, $y + 15, $reference);
    if(!empty($operation['IDCAISSEBANQUE'])){
        $bordereau = '<h4 style="text-align:center"><b>N° Bordereau Banque:</b>'.$operation['BORDEREAUBANQUE'].'</h4>';
        $pdf->WriteHTMLCell(100, 0, $x + 40, $y + 22, $bordereau);
    }
# date de recu
    $pdf->SetFillColor(211, 211, 211);
# $this->SetTextColor(255);
    $pdf->SetDrawColor(128, 0, 0);
    $d = new DateFR($operation['DATETRANSACTION']);

    # Classe de l'eleve
    $pdf->WriteHTMLCell(0, 0, $x + 135, $y + 3, "<b>".__t('Classe')." : " . $classe['NIVEAUHTML']."</b>");
    $daterecu = '<b>' . $d->getDate() . " " . $d->getMois(3) . " " . $d->getYear() . " " . $d->getTime() . '</b>';
    $pdf->WriteHTMLCell(0, 0, $x + 135, $y + 10, "<b>".__t('Montant')." : # " . moneyString($operation['MONTANT']) . "#</b>", 1, 1, true);
    $pdf->WriteHTMLCell(0, 0, $x + 135, $y + 15, $daterecu);

    $contenu = '<span style="width: 20%; text-align: left">'.__t('Re&ccedil;u de').' </span> : ' . $operation['NOMEL'] . "  " . $operation['PRENOMEL'] . '<br/>
            <span style="width: 20%; text-align: left">'.__t('Pour').'  </span> : 
            <span class="recu_libelle" >' . $operation['DESCRIPTION'] . '</span><br/>
            <span style="width: 20%;text-align: left">'.__t('MONTANT').'</span> : ' . moneyString($operation['MONTANT']) . ' <em>fcfa</em>
            <span style="font-size: 12px"><i>(' . enLettre($operation['MONTANT']) . ' franc cfa)</i></span><br/>
            <span style="width: 20%;text-align: left">'.__t('RESTE').'</span> : ' . moneyString($restant) . ' <em>fcfa</em>
            <span style="font-size: 12px"><i>(' . enLettre($restant) . ' franc cfa)</i></span><br/>';

    $pdf->WriteHTMLCell(0, 0, $x, $y + 28, $contenu);


    $infosresp = 'S/C ' . $operation['CIVILITEREP'] . " " . $operation['NOMREP'] . " "
            . $operation['PRENOMREP'] . '<br/>'.__t('T&eacute;l').' : ' . $operation['PORTABLEREP'];
    $pdf->WriteHTMLCell(0, 0, $x, $y + 50, $infosresp);

    /* $barrecode = SITE_ROOT . "public/tmp/barcode_upca.png";
      $pdf->Image($barcode, 80, 50, 30, '', '', '', 'T', false, 300, '', false, false, 0, false, false, false);
      //echo $barcode; */

    #$pdf->write1DBarcode($operation['REFCAISSE'], 'C128A', $x + 60, $y + 60, '', 8, 0.4);
    //if(isset($barcode)){
     //   $pdf->WriteHTMLCell(50, 50, $x + 60, $y + 60, $barcode);
    //}

    $pdf->setFont("Times", "", 8);
    $pdf->WriteHTMLCell(0, 0, $x + 130, $y + 40, __t("Enreg. par")." : " . $enregistreur['CIVILITE'].' '.$enregistreur['NOM']);
    
    $pdf->WriteHTMLCell(0, 0, $x + 130, $y + 55, __t("Per&ccedil;u par")." : " . $percepteur['CIVILITE'].' '.$percepteur['NOM']);
    $d->setSource($operation['DATEPERCEPTION']);
    $pdf->WriteHTMLCell(0, 0, $x + 150, $y + 60, $d->getDate() . " " . $d->getMois(3) . " " . $d->getYear() . " " . $d->getTime());
    
    $pdf->setFont("Times", "", 7);
     $d->setSource(date("Y-m-d H:i:s", time()));
    $infopersonnel = __t('Imprim&eacute; par'). ' ' . $personnel['CIVILITE'] . " " . $personnel['NOM'] . ' le '
          .  $d->getDate() . " " . $d->getMois(3) . " " . $d->getYear() . " " . $d->getTime();
    $pdf->WriteHTMLCell(0, 0, $x, $y + 70, $infopersonnel);
}
$pdf->OutPut();
