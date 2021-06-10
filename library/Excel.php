<?php

require '../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
$spreadsheet = new Spreadsheet();
$writer = new Xlsx($spreadsheet);
$spreadsheet->getDefaultStyle()->getFont()->setName("Verdana");
$spreadsheet->getDefaultStyle()->getFont()->setSize(10);

function save($outputFile = "rapport.xlsx") {
    // Redirect output to a client’s web browser (Xlsx)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="'.$outputFile.'"');
    header('Cache-Control: max-age=0');
    # If you're serving to IE 9, then the following may be needed
    header('Cache-Control: max-age=1');

    # If you're serving to IE over SSL, then the following may be needed
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
    header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
    header('Pragma: public'); // HTTP/1.0

    $writer = IOFactory::createWriter($this->spreadsheet, 'Xlsx');
    $writer->save('php://output');
}
