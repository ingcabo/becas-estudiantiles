<?php
class con_rep_beca_ayuda extends Controller{

     function con_rep_beca_ayuda() {

             parent::Controller();
             $this -> load  ->database();
             $this -> load  ->model('Model_consulta','',TRUE);
             $this -> load  ->model('reportesModel','',TRUE);
             $this -> load  ->helper(array('form', 'url'));
             $this -> load  ->library('JELGeneral');
             $this -> load  ->library('xajax');
             $this -> xajax ->registerFunction(array('obtieneCarrera', &$this, 'obtieneCarrera'));
             $this -> xajax ->processRequest();

     }

        function index(){  //formulario 3

            $centinela = new Centinela();
            $menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
            $data['menu']               = $this->load->view('vis_menu',$menu_final,true);
            $data['xajax_js']          = $this -> xajax          -> getJavascript(base_url());
            $data['q_banco']           = $this -> Model_consulta -> consulta_combo('nombre_banco','ASC','vis_banco');
            $data['q_estado_persona']  = $this -> Model_consulta -> consulta_combo('nombre_estado_persona','ASC','vis_estado_persona');

            $this->load->view('reporte/vis_rep_beca_ayuda',$data);

        }


        
function const_rep_beca_ayuda(){





//****************************************************

$valores_banco='';
$nombre   ='';
$apellido ='';
$fecha    ='';
$status   ='';


$criterio_nombre  = $_POST['snombre'];
if(isset($_POST['nombre']) && $_POST['nombre'] <> ''){

    $nombre =  $_POST['nombre'];
}

//***************************************************

$criterio_apellido  = $_POST['sapellido'];
if(isset($_POST['apellido']) && $_POST['apellido'] <> ''){

    $apellido =  $_POST['apellido'];
}
//****************************************************


/*$criterio_fecha= $_POST['sfecha'];
if(isset($_POST['fecha']) && $_POST['fecha'] <> ''){

$fecha = $_POST['fecha'];
    
}
*/
$criterio_status= 0;
if(isset($_POST['sstatus']) && $_POST['sstatus'] <> ''){

$status = $_POST['sstatus'];

}

//********************************************
if(isset($_POST['banco'])){

     foreach($_POST['banco'] as $kye => $value){

      $valores_banco.= $value.',';

     }
      $valores_banco = substr($valores_banco,0,strlen($valores_banco)- 1);
      $sql_b= ' banco_id in ('.$valores_banco.') and ';

 }else{

      $sql_b='';

 }
 
//**********************************************



//$tipo_beca_id    =$this->Model_consulta->consulta('');
$data['query'] = $this->reportesModel->rep_beca_ayuda($criterio_nombre,$nombre,$criterio_apellido,$apellido,$criterio_status,$status,$sql_b);
$total_personas    = $data['query']->num_rows();


//*-*****INICIO DEL EXCEL

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

$objPHPExcel->getActiveSheet()->mergeCells('A1:M1');
$objPHPExcel->getActiveSheet()->mergeCells('A2:M2');
$objPHPExcel->getActiveSheet()->mergeCells('A3:M3');
$objPHPExcel->getActiveSheet()->mergeCells('A4:M4');
$objPHPExcel->getActiveSheet()->mergeCells('A5:M5');
$objPHPExcel->getActiveSheet()->mergeCells('A6:M6');



//$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, 10, 'Some value'); el valor de la columna por cordenadas X y Y

// Set column width dimensiones anchura de la filas no tocar o te jodo
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(3);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(19);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(17);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(16);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(14);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(25);




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

         $logogov->setCoordinates('B2');
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

         $logojel->setCoordinates('K2');
         $logojel->setOffsetX(10);

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
$objPHPExcel->getActiveSheet()->SetCellValue('A5',"REPORTE NOMINA BECA AYUDA");


$objPHPExcel->getActiveSheet()->mergeCells('A6:E6');

//FORMATO FECHA Y TOTAL

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
),
       'fill'   => array(
       'argb' => 'FFFFBE00'
                     ),

),
		'B7:M10'
);

//color de fondo
$objPHPExcel->getActiveSheet()->duplicateStyleArray(
   array('fill'    => array(
                   'type'    => PHPExcel_Style_Fill::FILL_SOLID,
                   'color'   => array('argb' => 'FFFFBE00')),
         'borders' => array(
                   'top'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN))
        ),
        "B7:B8"
        );
 // fin color de fondo
//fin formato titulo de los beneficiarios

// FIN FORMATO
$objPHPExcel->getActiveSheet()->SetCellValue('B7',"FECHA DE ENVIO");
$objPHPExcel->getActiveSheet()->SetCellValue('B8',"TOTAL EN NOMINA");

$objPHPExcel->getActiveSheet()->SetCellValue('C7',"XX/XX/XXXX");
$objPHPExcel->getActiveSheet()->SetCellValue('C8',$total_personas);


//COLOR DE FONDO TITULOS

//color de fondo
$objPHPExcel->getActiveSheet()->duplicateStyleArray(
   array('fill'    => array(
                   'type'    => PHPExcel_Style_Fill::FILL_SOLID,
                   'color'   => array('argb' => 'FFFFBE00')),
         'borders' => array(
                   'top'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN))
        ),
        "B10:J10"
        );
 // fin color de fondo

//FIN SOLOR DE FONDO TITULO


//TITULOS
$objPHPExcel->getActiveSheet()->SetCellValue('B10',"NOMBRE");
$objPHPExcel->getActiveSheet()->SetCellValue('C10',"CEDULA");
$objPHPExcel->getActiveSheet()->SetCellValue('D10',"BANCO");
$objPHPExcel->getActiveSheet()->SetCellValue('E10',"NUMERO DE CUENTA");
$objPHPExcel->getActiveSheet()->SetCellValue('F10',"MONTO");
$objPHPExcel->getActiveSheet()->SetCellValue('G10',"TIPO DE BECA");
$objPHPExcel->getActiveSheet()->SetCellValue('H10',"ESTATUS");
$objPHPExcel->getActiveSheet()->SetCellValue('I10',"FECHA");
$objPHPExcel->getActiveSheet()->SetCellValue('J10',"OBSERVACION");



//VALORES DE LOS TITULOS

$indice=11;
foreach($data['query']->result() as $row){


//formato letra en blanco
$objPHPExcel->getActiveSheet()->duplicateStyleArray(
		array(
'font'      => array(
'name'      => 'ARIAL',
'bold'      => false,
'italic'    => false,
'size'      => 8
),
'alignment'  => array(
'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
'wrap'       => true
)
),
		'A'.$indice.':J'.$indice
);
//fin formato letra
//color y lineas
$objPHPExcel->getActiveSheet()->duplicateStyleArray(
   array('fill'    => array(
                   'type'    => PHPExcel_Style_Fill::FILL_SOLID),

         'borders' => array(
                   'top'     => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN))
        ),

       'A'.$indice.':J'.$indice
        );
//fin de color y lineas



$objPHPExcel->getActiveSheet()->SetCellValue('B'.$indice,$row->nombre_persona.''.$row->apellido_persona);
$objPHPExcel->getActiveSheet()->SetCellValue('C'.$indice,$row->cedula_persona);
$objPHPExcel->getActiveSheet()->SetCellValue('D'.$indice,$row->nombre_banco);
$objPHPExcel->getActiveSheet()->SetCellValue('E'.$indice,$row->numero_cuenta_persona.' ');
$objPHPExcel->getActiveSheet()->SetCellValue('F'.$indice,$row->monto_beca.' ');
$objPHPExcel->getActiveSheet()->SetCellValue('G'.$indice,$row->nombre_tipo_beca);
$objPHPExcel->getActiveSheet()->SetCellValue('H'.$indice,$row->nombre_estado_persona);
$objPHPExcel->getActiveSheet()->SetCellValue('I'.$indice,$row->fecha_ingreso);
$objPHPExcel->getActiveSheet()->SetCellValue('J'.$indice,$row->observaciones);
$indice=$indice+1;
}
// FIN VSLORES TITULOS





//FIN VALORES DE LOS TITULOS


$objPHPExcel->getActiveSheet()->setTitle('Reporte Nomina Beca Becario');

// Save Excel 2003 file

$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
//$objWriter->save(str_replace('.php', '.xls', _FILE_));

$arv= time();
$objWriter->save('Reportes/becayuda'.$arv.'.XLS');





//fin de titulo del reporte
//*******************************************************************************





//****************************
//FIN DEL EXCEL
//****************************

$data['archivo']   ='becayuda'.$arv.'.xls';
$data['rept']      ='Reporte Nomina Beca Ayuda';

$centinela = new Centinela();
$menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
$data['menu']               = $this->load->view('vis_menu',$menu_final,true);
$this->load->view('vis',$data);


    
}

















      }
?>