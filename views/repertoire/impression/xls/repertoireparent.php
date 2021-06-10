<?php

//var_dump($repertoires);
#https://phpspreadsheet.readthedocs.io/en/develop/topics/recipes
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

$spreadsheet = new Spreadsheet();
$spreadsheet->getDefaultStyle()->getFont()->setName("Verdana");
$spreadsheet->getDefaultStyle()->getFont()->setSize(10);
$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('A1', __t('REPERTOIRE DES PARENTS D\'ELEVES'))
        ->setCellValue('A2', 'Civ.')
        ->setCellValue('B2', 'Nom')
        ->setCellValue('C2', 'Prénom')
        ->setCellValue('D2', 'Adresse') # combiner avec residence
        ->setCellValue('E2', 'Téléphone')
        ->setCellValue('F2', 'Portable')
        ->setCellValue('G2', 'Email')
        ->setCellValue('H2', 'Profession')
        ->setCellValue('I2', 'Parenté')
        ->setCellValue('J2', 'Nom de l\'élève')
        ->setCellValue('K2', 'Prénom de l\'élève')
        ->setCellValue('L2', 'Classe')
        ->setCellValue('M2', 'Redoublant');
$sheet->mergeCells("A1:M1");

$i = 3;
$bgcolor = "FFFF9999";
foreach ($repertoires as $rep) {
    if (in_array($rep['IDELEVE'], $array_of_redoublants[$rep['IDCLASSE']])) {
        $redoublant = "OUI";
    } else {
        $redoublant = "NON";
    }
    $sheet->setCellValue('A' . $i, $rep['CIVILITE'])
            ->setCellValue('B' . $i, $rep['NOM'])
            ->setCellValue('C' . $i, $rep['PRENOM'])
            ->setCellValue('D' . $i, $rep['RESIDENCE'] . ' ' . $rep['ADRESSE'])
            ->setCellValue('E' . $i, $rep['TELEPHONE'])
            ->setCellValue('F' . $i, $rep['PORTABLE'])
            ->setCellValue('G' . $i, $rep['EMAIL'])
            ->setCellValue('H' . $i, $rep['PROFESSION'])
            ->setCellValue('I' . $i, $rep['PARENTE'])
            ->setCellValue('J' . $i, $rep['NOMEL'])
            ->setCellValue('K' . $i, $rep['PRENOMEL'])
            ->setCellValue('L' . $i, strip_tags($rep['NIVEAUHTML']) . ' ' . $rep['LIBELLE'])
            ->setCellValue('M' . $i, $redoublant);
    if ($redoublant == "OUI") {
        $sheet->getStyle('A' . $i . ':M' . $i)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setARGB($bgcolor);
    }
    $i++;
}

setAutoSize($sheet, ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M']);
$spreadsheet->setActiveSheetIndex(0);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="repertoire_parents.xlsx"');
header('Cache-Control: max-age=0');
# If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

# If you're serving to IE over SSL, then the following may be needed
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header('Pragma: public'); // HTTP/1.0

$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');
exit;
