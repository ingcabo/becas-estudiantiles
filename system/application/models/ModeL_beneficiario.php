<?php
class Model_beneficiario extends Model {
 function ReportGenerator() {
        parent::Model();
         $this -> load  ->model('reportesModel','',TRUE);
    }


function getbeneficiario($criterio_nombre,$nombre,$criterio_apellido,$apellido,$criterio_promedio,$promedio,$criterio_cedula,$cedula,$criterio_sexo,$sexo,$sql_i,$sql_c,$sql_m,$sql_p)
{


$strWhere_nombre    ='';
$strWhere_apellido  ='';
$strWhere_cedula    ='';
$strWhere_sexo      ='';
$strWhere_promedio  ='';

 if($nombre!='')
    {
      $strWhere_nombre = ' upper(nombre_persona) '.$this->reportesModel->setWhere($criterio_nombre,$nombre).' and ';

    }


if($apellido !='')
   {
       //$criterio_apellido
       $strWhere_apellido = ' upper(apellido_persona)  '.$this->reportesModel->setwhere($criterio_apellido, $apellido).' and ';
   }


if($promedio !='')
   {

        $strWhere_promedio = ' upper(promedio) '.$this->reportesModel->setwhere($criterio_promedio, $promedio).' and ';
   }


  if($cedula !='')
     {

          $strWhere_cedula = ' numero_cedula '.$this->reportesModel->setwhere($criterio_cedula, $cedula).' and ';
     }

if($sexo !='' && $sexo != 0 )
   {


       $strWhere_sexo =' upper(sexo_persona) '.$this->reportesModel->setwhere($criterio_sexo,$sexo).'  and ';
   }


 $strWhere= $strWhere_nombre.$strWhere_apellido.$strWhere_cedula.$strWhere_promedio.$strWhere_sexo.$sql_i.$sql_c.$sql_m.$sql_p;

 $sqlQuery = 'SELECT *
                 FROM  vis_beneficiario  WHERE '.$strWhere.'  activo = 1 ';
//ORDER BY sorteo_id ASC
   //print_r($sqlQuery);



  $result = $this->db->query($sqlQuery);



   return $result;
//*******************************
}

function rep_beneficiario(){
         $objPHPExcel = new PHPExcel();
         $actsheet = $objPHPExcel->getActiveSheet();

                             /**********************
                              ***** ENCABEZADO: ****
                              **********************/

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
         $actsheet->getCell("A5")->setValue("REPORTE DE BBENEFICIARIO");





         $records = array(array('NOMBRE','CEDULA','TIPO','INSTITUTO','CARRERA','PROMEDIO','PROM. DEPURADO','ESTATUS'));



         arrayToExcelTable($actsheet,$records,$COLUMN_HEADER1,NULL,0,7);
         
         $writer = PHPExcel_IOFactory::createWriter($objPHPExcel,"Excel5");
         $writer->save('Reportes/beneficiario2.XLS');
    }



















}













?>
