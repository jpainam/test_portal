<?php

#https://phpspreadsheet.readthedocs.io/en/develop/topics/recipes
require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

$spreadsheet = new Spreadsheet();
$spreadsheet->getDefaultStyle()->getFont()->setName("Verdana");
$spreadsheet->getDefaultStyle()->getFont()->setSize(10);
$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('B1', 'CAHIER DE TEXTE');
$sheet->setCellValue("B2", 'Classe: ' . $classe['LIBELLE'].' ' . strip_tags($classe['NIVEAUHTML']));
$sheet->setCellValue("B3", 'Matiere: ' . $matiere['MATIERELIBELLE']);
$sheet->mergeCells("B1:F1");
$sheet->mergeCells("B2:F2");
$sheet->mergeCells("B3:F3");
$sheet->setCellValue('A5', "N°")
        ->setCellValue('B5', "Date")
        ->setCellValue('C5', "Heures")
        ->setCellValue('D5', 'Objectif')
        ->setCellValue('E5', 'Contenu');

$i = 6;
$j = 1;
foreach ($cahier as $c) {
    $sheet->setCellValue('A' . $i, $j)
             ->setCellValue('B' . $i, date("d/m/Y", strtotime($c['DATESAISIE'])))
            ->setCellValue('C' . $i, $c['HEUREDEBUT'] . '-' .$c['HEUREFIN'])
            ->setCellValue('D' . $i, $c['OBJECTIF'])
            ->setCellValue('E' . $i, $c['CONTENU'])
            ->setCellValue('F' . $i, $c['NOM'] . ' ' . $c['PRENOM']);
    $i++;
    $j++;
}
setAutoSize($sheet, ['A', 'B', 'C', 'D', 'E']);
$spreadsheet->setActiveSheetIndex(0);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="cahiertexte.xlsx"');
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
