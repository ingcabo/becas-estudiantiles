<?php
class Kiba extends Controller
{
function Kiba()
{
parent::Controller();
}


function testexcel()

{
$this->load->helper('url');
$this->load->helper('form');
/*
 function load(){
        // Location relative to the main caller
        $template_location = 'template.xls';
    
        $xls_reader = PHPExcel_IOFactory::createReader('Excel5');
        $this->workbook = $xls_reader->load($template_location);
    }
    
    function send(){
        $xls_writer = PHPExcel_IOFactory::createWriter($this->workbook, 'Excel5');
        $xls_writer->save('result/from-template.xls');    
    }

*/


//include 'C:/web/jel/system/application/my_classes/Classes/PHPExcel.php';
/** PHPExcel_Writer_Excel2007 */
//include 'C:/web/jel/system/application/my_classes/Classes/PHPExcel/Writer/Excel5.php';

// Create new PHPExcel object
$data['a'] = date('H:i:s') . " Create new PHPExcel object\n"."<br>";
$objPHPExcel = new PHPExcel();

// Set properties
$data['b'] = date('H:i:s') . " Set properties\n"."<br>";
$objPHPExcel->getProperties()->setCreator("BazZ");
$objPHPExcel->getProperties()->setLastModifiedBy("BazZ");
$objPHPExcel->getProperties()->setTitle("TestExcel");
$objPHPExcel->getProperties()->setSubject("");

// Set row height
$objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(50);
$objPHPExcel->getActiveSheet()->getRowDimension(2)->setRowHeight(25);

// Set column width
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20);

//Merge cells (warning: the row index is 0-based)
$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow(0,1,13,1);
$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow(0,2,13,2);
$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow(0,3,0,5);
$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow(1,3,1,5);
$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow(2,3,3,3);
$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow(2,4,2,5);
$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow(3,4,3,5);
$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow(4,3,4,5);
$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow(5,3,5,5);
$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow(6,3,6,5);
$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow(7,3,9,3);
$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow(7,4,7,5);
$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow(8,4,9,4);
$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow(10,3,10,5);
$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow(11,3,11,5);
$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow(12,3,12,5);
$objPHPExcel->getActiveSheet()->mergeCellsByColumnAndRow(13,3,13,5);

//Modify cell's style
$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray(
array(
'font' => array(
'name'         => 'Times New Roman',
'bold'         => true,
'italic'    => false,
'size'        => 20
),
'alignment' => array(
'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
'wrap'       => true
)
)
);

$objPHPExcel->getActiveSheet()->getStyle('A2')->applyFromArray(
array(
'font' => array(
'name'         => 'Times New Roman',
'bold'         => true,
'italic'    => false,
'size'        => 14
),
'alignment' => array(
'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
'wrap'       => true
)
)
);

$objPHPExcel->getActiveSheet()->duplicateStyleArray(
array(
'font' => array(
'name'         => 'Times New Roman',
'bold'         => true,
'italic'    => false,
'size'        => 12
),
'borders' => array(
'top'        => array('style' => PHPExcel_Style_Border::BORDER_DOUBLE),
'bottom'    => array('style' => PHPExcel_Style_Border::BORDER_DOUBLE),
'left'        => array('style' => PHPExcel_Style_Border::BORDER_DOUBLE),
'right'        => array('style' => PHPExcel_Style_Border::BORDER_DOUBLE)
),
'alignment' => array(
'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
'wrap'       => true
)
),
'A3:N5'
);

// Add some data
$data['c'] = date('H:i:s') . " Add some data\n"."<br>";
$objPHPExcel->setActiveSheetIndex(0);

$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'El reporte');
$objPHPExcel->getActiveSheet()->SetCellValue('A2',"Subtitle here");

$objPHPExcel->getActiveSheet()->SetCellValue('A3',"No.");
$objPHPExcel->getActiveSheet()->SetCellValue('B3',"Nombre");
$objPHPExcel->getActiveSheet()->SetCellValue('C3',"Numero");
$objPHPExcel->getActiveSheet()->SetCellValue('C4',"Codigo");
$objPHPExcel->getActiveSheet()->SetCellValue('D4',"Registro");
$objPHPExcel->getActiveSheet()->SetCellValue('E3',"Space (M2)");
$objPHPExcel->getActiveSheet()->SetCellValue('F3',"año");
$objPHPExcel->getActiveSheet()->SetCellValue('G3',"direccion");

//simulacion

$objPHPExcel->getActiveSheet()->SetCellValue('A6',"2566");
$objPHPExcel->getActiveSheet()->SetCellValue('B6',"Carlos Ramirez");
$objPHPExcel->getActiveSheet()->SetCellValue('C6',"15839590");
$objPHPExcel->getActiveSheet()->SetCellValue('C6',"458");
$objPHPExcel->getActiveSheet()->SetCellValue('D6',"g45");
$objPHPExcel->getActiveSheet()->SetCellValue('E6',"no se que mas");
$objPHPExcel->getActiveSheet()->SetCellValue('F6',"2009");
$objPHPExcel->getActiveSheet()->SetCellValue('G6',"Zulia");


//fin de simulacion



// Rename sheet
echo date('H:i:s') . " Rename sheet\n"."Ruta donde no se como mostralo C:\web\JEL\Reportes";
$objPHPExcel->getActiveSheet()->setTitle('Try PHPExcel with CodeIgniter');

// Save Excel 2003 file
 $data['d'] = date('H:i:s') . " Write to Excel2003 format\n"."<br>";
$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
//$objWriter->save(str_replace('.php', '.xls', _FILE_));
$objWriter->save('reportes/CARLOS.XLS');

//$this->load->view('vista',$data);
}
}
//'php://output'
?> 