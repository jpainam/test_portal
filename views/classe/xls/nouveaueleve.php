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

$sheet->setCellValue('A1', 'LISTE DES NOUVEAUX ELEVES ' . strip_tags($classe['LIBELLE']));
$sheet->mergeCells("A1:F1");
$style = array(
    'alignment' => array(
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
    )
);
$sheet->getStyle("A1")->applyFromArray($style);

$sheet->setCellValue("A2", "N°")
        ->setCellValue("B2", "Matricule")
        ->setCellValue("C2", "Noms et Prénoms")
        ->setCellValue("D2", "Date de naissance")
        ->setCellValue("E2", "Redoublant");
$sheet->getStyle("A1:E2")->getFont()->setBold(true);
$sheet->getStyle('A2:E2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);

$sheet->getStyle('A2:E2')->getFill()->getStartColor()->setARGB('FFC4BD97');

$i = 3;
$j = 1;
foreach ($nouveaux as $el) {
    $sheet->setCellValue('A' . $i, $j)
            ->setCellValue('B' . $i, $el['MATRICULE'])
            ->setCellValue('C' . $i,  $el['NOM'] . ' ' . $el['PRENOM'])
            ->setCellValue('D' . $i, $el['DATENAISS'])
            ->setCellValue('E' . $i, $ens['REDOUBLANTLBL']);
    $i++;
    $j++;
}

setAutoSize($sheet, ["A", "B", "C", "D", "E"]);
$sheet->setTitle("Liste des nouveaux eleves");
$spreadsheet->setActiveSheetIndex(0);
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="liste_des_nouveaux_eleves.xlsx"');
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
