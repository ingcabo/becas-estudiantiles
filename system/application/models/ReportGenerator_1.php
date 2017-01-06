<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'PHPExcel/IOFactory.php';
class ReportGenerator extends Model {
    function ReportGenerator() {
        parent::Model();
    }

    function testPHPExcelHelper(){
         $objPHPExcel = new PHPExcel();
         $actsheet = $objPHPExcel->getActiveSheet();

                             /**********************
                              ***** ENCABEZADO: ****
                              **********************/
        /*
         //LOGO GOV
         $logogov = new PHPExcel_Worksheet_Drawing();
         $logogov->setName('LogoGov');
         $logogov->setDescription('Logo del GOV');
         $logogov->setPath('./images/GOV_LOGO.jpg');
         $logogov->setResizeProportional(false);
         $logogov->setHeight(80);
         $logogov->setWidth(180);
         $logogov->setWorksheet($objPHPExcel->getActiveSheet());

         $logogov->setCoordinates('A2');
         $logogov->setOffsetX(10);

         //LOGO JEL
         $logojel = new PHPExcel_Worksheet_Drawing();
         $logojel->setName('LogoJEL');
         $logojel->setDescription('Logo del JEL');
         $logojel->setPath('./images/JEL_LOGO.jpg');
         $logojel->setResizeProportional(false);
         $logojel->setHeight(85);
         $logojel->setWidth(120);
         $logojel->setWorksheet($objPHPExcel->getActiveSheet());

         $logojel->setCoordinates('K2');
         $logojel->setOffsetX(-10);

         //TITULO
         $actsheet->mergeCells("A2:K2");
         $actsheet->mergeCells("A3:K3");
         $actsheet->mergeCells("A5:K5");
         $actsheet->getStyle("A2")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
         $actsheet->getStyle("A2")->applyFromArray($title1);
         $actsheet->getStyle("A3")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
         $actsheet->getStyle("A3")->applyFromArray($title1);
         $actsheet->getStyle("A5")->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
         $actsheet->getStyle("A5")->applyFromArray($column_header1);

         $actsheet->getCell("A2")->setValue("GOBERNACIÓN DEL ESTADO ZULIA");
         $actsheet->getCell("A3")->setValue("FUNDACIÓN JESUS ENRIQUE LOSSADA");
         $actsheet->getCell("A5")->setValue("REPORTE DE CENSOS");
        */
         $records = array(
                       array("Good","God","King","Pop"),
                       array("Peek","Damn","Live","Destroyer"),
                       array("Fine","Find","Kind","Hard"),
                       array("Expectacular","Primary","Stock","Product")
                    );
         $sizes = array(3,3,3,3);

         arrayToExcelTable($actsheet,$records);
         $writer = PHPExcel_IOFactory::createWriter($objPHPExcel,"Excel5");
         $writer->save("C:\Publico\LaVidaMisma.xls");
    }
}
?>
