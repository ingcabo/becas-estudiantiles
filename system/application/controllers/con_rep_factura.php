<?php
class con_rep_factura extends Controller{

             function con_rep_factura() {

                     parent::Controller();
                     $this -> load  ->database();
                     $this -> load  ->model('Model_consulta','',TRUE);
                     $this -> load  ->helper(array('form', 'url'));
                     $this -> load  ->library('JELGeneral');
                     $this -> load  ->model('reportesModel','',TRUE);
                     $this -> load  ->library('xajax');
                     $this -> xajax ->registerFunction(array('prueba', &$this, 'prueba'));
                     $this -> xajax ->processRequest();

             }

                function index(){ //formulario 3
                    $data['xajax_js']     = $this -> xajax          -> getJavascript(base_url());
                    $data['menu']         = $this -> load           -> view('menu','',true);
                    $data['xajax_js']     = $this -> xajax          -> getJavascript(base_url());
                    $data['q_instituto']  = $this -> Model_consulta -> consulta_combo('nombre_instituto','ASC','instituto');
                    $data['q_periodo']    = $this -> Model_consulta -> consulta_combo('ano_periodo','ASC','vis_periodo');

                    $this->load->view('reporte/vis_rep_factura',$data);

                }




function prueba($p){


        $respuesta = new xajaxResponse(); //Creamos el objeto xajax
		$inputDestino = "capa"; //indicamos el ID del tag HTML de destino. en este caso el DIV que contiene el selector
		$propiedadInputDestino = "innerHTML"; //indicamos la propiedad que deseamos que se modifique. Colocaremos el selector dentro del DIV
		$valorAAsignar   = ""; //indi


        $valorAAsignar = $p.'xxx'.'di';

        $respuesta -> Assign($inputDestino, $propiedadInputDestino, $valorAAsignar);
          return $respuesta;
}




function const_rep_factura(){
     

$valores_instituto ='';
$valores_periodo   ='';

//****************************************************************************************
     if(isset($_POST['instituto'])){

     foreach($_POST['instituto'] as $key => $value){
                               $valores_instituto.=$value.',';
                           }

    $valores_instituto = substr ($valores_instituto, 0, strlen($valores_instituto) -1);
    $sql_i= ' instituto_id in ('.$valores_instituto.') and  ';

    }else{

          $sql_i = '';
         }
//******************************************************************************************

   if(isset($_POST['periodo'])){

     foreach($_POST['periodo'] as $key => $value){
                               $valores_periodo.=$value.',';
                           }

    $valores_periodo = substr ($valores_periodo, 0, strlen($valores_periodo) -1);
    $sql_pe= ' periodo_id in ('.$valores_periodo.') and  ';

    }else{

          $sql_pe = '';
         }


 //**************************************************************************************
$fecha_fact          ='';
$fecharep            ='';
$status              ='';
//****************************************************
$criterio_fechafact  = $_POST['sfechafact'];
if(isset($_POST['fechafact']) && $_POST['fechafact'] <> ''){

    $fecha_fact =  $_POST['fechafact'];
}

//***************************************************
$criterio_sfecharep  = $_POST['sfecharep'];
if(isset($_POST['fecharep']) && $_POST['fecharep'] <> ''){

    $fecharep =  $_POST['fecharep'];
}
//****************************************************
$criterio_status  = $_POST['sstatus'];
if(isset($_POST['status']) && $_POST['status'] <> ''){

    $status =  $_POST['status'];
}
//****************************************************




 // $this->reportesModel->getcon_rep_factura($sql_i,$sql_pe,$criterio_fechafact,$fecha_fact,$criterio_status,$status,$criterio_sfecharep,$fecharep);

//****************************
        //INICIO EXCEL
//****************************

//*****************************************************
// Create new PHPExcel object
$data['a'] = date('H:i:s') . " Create new PHPExcel object\n"."<br>";
$objPHPExcel = new PHPExcel();

// Set properties
$data['b'] = date('H:i:s') . " Set properties\n"."<br>";
$objPHPExcel->getProperties()->setCreator("BazZ");
$objPHPExcel->getProperties()->setLastModifiedBy("BazZ");
$objPHPExcel->getProperties()->setTitle("TestExcel");
$objPHPExcel->getProperties()->setSubject("");



$objPHPExcel->getActiveSheet()->getPageSetup()->setHorizontalCentered(true);
$objPHPExcel->getActiveSheet()->getPageSetup()->setVerticalCentered(false);

// Set row height
$objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(15);
$objPHPExcel->getActiveSheet()->getRowDimension(2)->setRowHeight(15);
$objPHPExcel->getActiveSheet()->getRowDimension(3)->setRowHeight(15);
$objPHPExcel->getActiveSheet()->getRowDimension(4)->setRowHeight(15);
$objPHPExcel->getActiveSheet()->getRowDimension(5)->setRowHeight(15);

$objPHPExcel->getActiveSheet()->mergeCells('A1:F1');
$objPHPExcel->getActiveSheet()->mergeCells('A2:F2');
$objPHPExcel->getActiveSheet()->mergeCells('A3:F3');
$objPHPExcel->getActiveSheet()->mergeCells('A4:F4');
$objPHPExcel->getActiveSheet()->mergeCells('A5:F5');
$objPHPExcel->getActiveSheet()->mergeCells('A6:F6');



//$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, 10, 'Some value'); el valor de la columna por cordenadas X y Y

// Set column width dimensiones anchura de la filas no tocar o te jodo
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(13);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(17);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(14);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(17);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(13);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(14);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
//******************************************************


$objPHPExcel->setActiveSheetIndex(0);

//******************************************************

         //LOGO GOV
         $logogov = new PHPExcel_Worksheet_Drawing();
         $logogov->setName('gov');
         $logogov->setDescription('Logo del GOV');
         $logogov->setPath(BASEPATH.'application/views/imagenes/gov.png');
         $logogov->setResizeProportional(false);
         $logogov->setHeight(80);
         $logogov->setWidth(180);
         $logogov->setWorksheet($objPHPExcel->getActiveSheet());

         $logogov->setCoordinates('A2');
         $logogov->setOffsetX(10);
//*******************************************************
//LOGO JEL
        $logojel = new PHPExcel_Worksheet_Drawing();
         $logojel->setName('jel');
         $logojel->setDescription('Logo del jel');
         $logojel->setPath(BASEPATH.'application/views/imagenes/JEL.png');
         $logojel->setResizeProportional(false);
         $logojel->setHeight(80);
         $logojel->setWidth(180);
         $logojel->setWorksheet($objPHPExcel->getActiveSheet());

         $logojel->setCoordinates('F2');
         $logojel->setOffsetX(-10);

//*******************************************************
//formato titulo del reporte

$objPHPExcel->getActiveSheet()->duplicateStyleArray(
		array(
'font'      => array(
'name'      => 'ARIAL',
'bold'      => true,
'italic'    => false,
'size'      => 12
),
'alignment'  => array(
'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
'wrap'       => true
)
),
		'A2:A3'
);
//formato titulo del reporte
$objPHPExcel->getActiveSheet()->duplicateStyleArray(
		array(
'font'      => array(
'name'      => 'ARIAL',
'bold'      => true,
'italic'    => false,
'size'      => 8
),
'alignment'  => array(
'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
'wrap'       => true
)
),
		'A5:B5'
);
//fin formato titulo del reporte

//titulo reporte
$objPHPExcel->getActiveSheet()->SetCellValue('A2',"GOBERNACIÓN DEL ESTADO ZULIA");
$objPHPExcel->getActiveSheet()->SetCellValue('A3',"FUNDACIÓN JESUS ENRIQUE LOSSADA");
$objPHPExcel->getActiveSheet()->SetCellValue('A5',"REPORTE DE FACTURAS");
//*******************************************************************************


//*******************************************************************************

$objPHPExcel->getActiveSheet()->SetCellValue('A7',"CODIGO");
$objPHPExcel->getActiveSheet()->SetCellValue('B7',"FECH. FACTURA");
$objPHPExcel->getActiveSheet()->SetCellValue('C7',"FECH. RECEPCION");
$objPHPExcel->getActiveSheet()->mergeCells('D7:E7');
$objPHPExcel->getActiveSheet()->SetCellValue('D7',"INSTITUTO");
$objPHPExcel->getActiveSheet()->SetCellValue('F7',"ESTATUS");
$objPHPExcel->getActiveSheet()->mergeCells('G7:I7');
$objPHPExcel->getActiveSheet()->SetCellValue('G7',"OBSERVACIONES");

//*******************************************************************************


$objPHPExcel->getActiveSheet()->SetCellValue('A8',"16");
$objPHPExcel->getActiveSheet()->SetCellValue('B8',"22/12/2008");
$objPHPExcel->getActiveSheet()->SetCellValue('C8',"01/01/2009");
$objPHPExcel->getActiveSheet()->mergeCells('D8:E8');
$objPHPExcel->getActiveSheet()->SetCellValue('D8',"urbe");
$objPHPExcel->getActiveSheet()->SetCellValue('F8',"pendiente");
$objPHPExcel->getActiveSheet()->mergeCells('G8:I8');
$objPHPExcel->getActiveSheet()->SetCellValue('G8',"muy mal");

//*******************************************************************************

$objPHPExcel->getActiveSheet()->SetCellValue('A9',"ITEM");
$objPHPExcel->getActiveSheet()->mergeCells('B9:D9');
$objPHPExcel->getActiveSheet()->SetCellValue('B9',"CONCEPTO");
$objPHPExcel->getActiveSheet()->SetCellValue('E9',"TIPO ARANCEL");
$objPHPExcel->getActiveSheet()->SetCellValue('F9',"MONTO");
$objPHPExcel->getActiveSheet()->SetCellValue('G9',"% DESCTO");
$objPHPExcel->getActiveSheet()->SetCellValue('H9',"SUBTOTAL");
$objPHPExcel->getActiveSheet()->SetCellValue('I9',"PERIODO");
//*******************************************************************************
$objPHPExcel->getActiveSheet()->SetCellValue('A10',"1");
$objPHPExcel->getActiveSheet()->mergeCells('B10:D10');
$objPHPExcel->getActiveSheet()->SetCellValue('B10',"INSCRIPCIÓN JOSE MEDINA");
$objPHPExcel->getActiveSheet()->SetCellValue('E10',"INSCRIPCIÓN");
$objPHPExcel->getActiveSheet()->SetCellValue('F10',"100");
$objPHPExcel->getActiveSheet()->SetCellValue('G10',"0");
$objPHPExcel->getActiveSheet()->SetCellValue('H10',"100");
$objPHPExcel->getActiveSheet()->SetCellValue('I10',"2009-A");

//*******************************************************************************

$objPHPExcel->getActiveSheet()->mergeCells('A11:E11');
$objPHPExcel->getActiveSheet()->SetCellValue('A11',"TOTAL FACTURA");

//*******************************************************************************
$objPHPExcel->getActiveSheet()->SetCellValue('A13',"FECHA TRÁMITE");
$objPHPExcel->getActiveSheet()->SetCellValue('B13',"FECHA ENVIO");
$objPHPExcel->getActiveSheet()->SetCellValue('C13',"FECHA PAGO");
$objPHPExcel->getActiveSheet()->SetCellValue('D13',"MONTO");
$objPHPExcel->getActiveSheet()->mergeCells('E13:I13');
$objPHPExcel->getActiveSheet()->SetCellValue('E13',"OBSERVACIONES");

//*******************************************************************************

$objPHPExcel->getActiveSheet()->SetCellValue('A14',"22/01/2005");
$objPHPExcel->getActiveSheet()->SetCellValue('B14',"22/01/2005");
$objPHPExcel->getActiveSheet()->SetCellValue('C14',"22/01/2005");
$objPHPExcel->getActiveSheet()->SetCellValue('D14',"54421");
$objPHPExcel->getActiveSheet()->mergeCells('E14:I14');
$objPHPExcel->getActiveSheet()->SetCellValue('E14',"nada");

//*******************************************************************************
$objPHPExcel->getActiveSheet()->mergeCells('A15:E15');
$objPHPExcel->getActiveSheet()->SetCellValue('A15',"TOTAL ");
//*******************************************************************************





//*******************************************************************************
$objPHPExcel->getActiveSheet()->setTitle('Reporte facturas');

// Save Excel 2003 file
 $data['d'] = date('H:i:s') . " Write to Excel2003 format\n"."<br>";
$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
//$objWriter->save(str_replace('.php', '.xls', _FILE_));
$objWriter->save('Reportes/facturas.XLS');





//fin de titulo del reporte
//*******************************************************************************





//****************************
//FIN DEL EXCEL
//****************************

$data['archivo']   ='facturas.xls';
$data['rept']      ='Reporte facturas';
$data['menu']      =$this->load->view('menu', $data,true);
$this->load->view('vis',$data);

      }

      

}
?>
