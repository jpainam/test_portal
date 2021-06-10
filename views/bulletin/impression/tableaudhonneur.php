<?php

foreach($eleves as $eleve){
	$pdf->AddPage();
	$pdf->Bookmark($eleve['NOMEL']. ' '. $eleve['PRENOMEL'], 1, 0, '', '', array(0, 0, 0));

}