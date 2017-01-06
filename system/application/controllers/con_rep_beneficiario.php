<?php

class con_rep_beneficiario extends Controller{

     function con_rep_beneficiario() {

             parent::Controller();
             $this -> load  ->database();
             $this -> load  ->model('Model_consulta','',TRUE);
             $this -> load  ->helper(array('form', 'url'));
             $this -> load  ->library('JELGeneral');
             $this -> load  ->model('reportesModel','',TRUE);
             $this -> load  ->library('xajax');
             $this -> xajax ->registerFunction(array('obtieneNucleo', &$this, 'obtieneNucleo'));
             $this -> xajax ->registerFunction(array('obtieneParroquia', &$this, 'obtieneParroquia'));
             $this -> xajax ->processRequest();

     }

        function index(){ //formulario 3
          
          
            $centinela = new Centinela();
            $menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
            $data['menu']               = $this->load->view('vis_menu',$menu_final,true);
            
            $data['xajax_js']         = $this -> xajax          -> getJavascript(base_url());
            $data['q_instituto']      = $this -> Model_consulta -> consulta_combo('nombre_instituto','ASC','instituto');
            $data['q_car_inst']       = $this -> Model_consulta -> consulta_combo('siglas_instituto','ASC','vis_carrera_instituto');
            $data['q_municipio']      = $this -> Model_consulta -> consulta_combo('nombre_municipio','ASC','vis_municipio');
            $data['q_parroquia']      = $this -> Model_consulta -> consulta_combo('nombre_parroquia','ASC','vis_parroquia');
            $data['q_stado_persona']  = $this -> Model_consulta -> consulta_combo('nombre_estado_persona','ASC','vis_estado_persona');

            $this->load->view('reporte/vis_rep_beneficiario',$data);

        }


        function obtieneNucleo($controles){


        $respuesta = new xajaxResponse(); //Creamos el objeto xajax
		$inputDestino = "capa_nucleo"; //indicamos el ID del tag HTML de destino. en este caso el DIV que contiene el selector
		$propiedadInputDestino = "innerHTML"; //indicamos la propiedad que deseamos que se modifique. Colocaremos el selector dentro del DIV
		$valorAAsignar   = ""; //indicamos el nuevo valor que este tendrá. Cadena HTML
        $condicion       = "";
        $inputDestino_2  ="capa_carrera";
        $valorAAsignar_2 = "";



         if(!isset($controles['instituto'])){
                       $condicion='0,';
           }else{
                       foreach($controles['instituto'] as $key => $value){
                           $condicion.=$value.',';
                       }
                }


       $condicion  = substr ($condicion, 0, strlen($condicion) -1);
       $consulta   = $this->db->query('select * from nucleo_instituto where instituto_id in ('.$condicion.') order by siglas_nucleo_instituto');
       $consulta_2 = $this->db->query('select * from vis_carrera_instituto where instituto_id in ('.$condicion.') order by siglas_instituto');


               if ($consulta->num_rows() > 0){ //esto en este formulario nunca ocurrira

                         foreach ($consulta -> result() as $row){

                                $data = array(
                                'name'     => 'nucleo[]',
                                'id'       => 'nucleo',
                                'value'    => $row->nucleo_instituto_id,
                                'checked'  => true,
                                             );
                               $valorAAsignar .=  '<font size="2" face="Geneva, Arial, Helvetica, sans-serif">'.form_checkbox($data).$row->siglas_nucleo_instituto.'</font><br>';
                               $respuesta -> Assign($inputDestino, $propiedadInputDestino, $valorAAsignar);
                            }

                 }else{
                         $valorAAsignar ="";
                         $respuesta -> Assign($inputDestino, $propiedadInputDestino, $valorAAsignar);
                       }

                                 if ($consulta_2->num_rows() >= 1){

                                                  foreach ($consulta_2 -> result() as $row){

                                                    $data_2 = array(
                                                    'name'     => 'carrera[]',
                                                    'id'       => 'carrera',
                                                    'value'    => $row->carrera_instituto_id,
                                                    'checked'  => true,

                                                      );

                                                   $valorAAsignar_2 .=  '<font size="2" face="Geneva, Arial, Helvetica, sans-serif">'.form_checkbox($data_2).$row->siglas_instituto."-".$row->nombre_carrera.'</font><br>';
                                                   $respuesta -> Assign($inputDestino_2, $propiedadInputDestino, $valorAAsignar_2);

                                                    }
                                 }else{
                                         $valorAAsignar_2 ="";
                                         $respuesta -> Assign($inputDestino_2, $propiedadInputDestino, $valorAAsignar_2);
                                      }
              return $respuesta;
           }

        function obtieneParroquia($controles){

        $respuesta = new xajaxResponse(); //Creamos el objeto xajax
		$inputDestino = "capa_parroquia"; //indicamos el ID del tag HTML de destino. en este caso el DIV que contiene el selector
		$propiedadInputDestino = "innerHTML"; //indicamos la propiedad que deseamos que se modifique. Colocaremos el selector dentro del DIV
		$valorAAsignar   = ""; //indicamos el nuevo valor que este tendrá. Cadena HTML
        $condicion       = "";

        if(!isset($controles['municipio'])){
                       $condicion='0,';
        }else{
                       foreach($controles['municipio'] as $key => $value){
                           $condicion.=$value.',';
                       }
              }


       $condicion  = substr ($condicion, 0, strlen($condicion) -1);
       $consulta   = $this->db->query('select * from vis_parroquia where municipio_id in ('.$condicion.') order by nombre_parroquia');

        if ($consulta->num_rows() > 0){

                         foreach ($consulta -> result() as $row){

                                $data = array(
                                'name'     => 'parroquia[]',
                                'id'       => 'parroquia',
                                'value'    => $row->parroquia_id,
                                'checked'  => true,
                                             );
                               $valorAAsignar .=  '<font size="2" face="Geneva, Arial, Helvetica, sans-serif">'.form_checkbox($data).$row->nombre_parroquia.'</font><br>';
                               $respuesta -> Assign($inputDestino, $propiedadInputDestino, $valorAAsignar);
                            }

         }else{
                 $valorAAsignar ="";
                 $respuesta -> Assign($inputDestino, $propiedadInputDestino, $valorAAsignar);
               }
         return $respuesta;

         }

//************************************************************



function const_beneficiario(){

//ini_set('include_path', ini_get('include_path').';'.BASEPATH.'application/my_classes/Classes/');
//require_once 'PHPExcel/IOFactory.php';

$valores_instituto ='';
$valores_carrera   ='';
$criterio_promedio ='';
$valores_municipio ='';
$valores_parroquia ='';


  if(isset($_POST['instituto'])){

     foreach($_POST['instituto'] as $key => $value){
                                $valores_instituto.=$value.',';
                           }

    $valores_instituto = substr ($valores_instituto, 0, strlen($valores_instituto) -1);
    $sql_i= ' instituto_id in ('.$valores_instituto.') and ';

    }else{

          $sql_i = '';
         }


 //******************************************************


 if(isset($_POST['carrera'])){

     foreach($_POST['carrera'] as $key => $value){
                                $valores_carrera.=$value.',';
                           }

    $valores_carrera = substr ($valores_carrera, 0, strlen($valores_carrera) -1);
    $sql_c= ' carrera_instituto_id in ('.$valores_carrera.') and ';

    }else{

          $sql_c = '';
         }

//****************************************************

 if(isset($_POST['municipio'])){

     foreach($_POST['municipio'] as $key => $value){
                                $valores_municipio.=$value.',';
                           }

    $valores_municipio = substr ($valores_municipio, 0, strlen($valores_municipio) -1);
    $sql_m= ' municipio_id in ('.$valores_municipio.') and ';

    }else{

          $sql_m = '';
         }

//**************************************************

//parroquia


 if(isset($_POST['parroquia'])){

     foreach($_POST['parroquia'] as $key => $value){
                                $valores_parroquia.=$value.',';
                           }

    $valores_parroquia = substr ($valores_parroquia, 0, strlen($valores_parroquia) -1);
    $sql_p= ' parroquia_id in ('.$valores_parroquia.')  and ';

    }else{

          $sql_p = '';
         }


//***********************************************
$nombre   ='';
$apellido ='';
$cedula    ='';
$promedio ='';

$criterio_nombre  = $_POST['snombre'];
if(isset($_POST['nombre']) && $_POST['nombre'] <> ''){

    $nombre =  $_POST['nombre'];
}


//***********************************************


$criterio_apellido  = $_POST['sapellido'];
if(isset($_POST['apellido']) && $_POST['apellido'] <> ''){

    $apellido =  $_POST['apellido'];
}

//***************************************************
//spromedio

$criterio_promedio  = $_POST['spromedio'];
if(isset($_POST['promedio']) && $_POST['promedio'] <> ''){

    $promedio =  $_POST['promedio'];
}


//***************************************************




//***************************************************


$criterio_cedula  = $_POST['scedula'];
if(isset($_POST['cedula']) && $_POST['cedula'] <> ''){

    $cedula =  $_POST['cedula'];
}

//*****************************************************



$criterio_sexo  = 0;
if(isset($_POST['sexo']) or $_POST['sexo'] <> ''){

    $sexo =  $_POST['sexo'];
}else{


   $sexo ='';
}



//**************************status
$criterio_status  = 0;
if(isset($_POST['status']) && $_POST['status'] <> ''){

    $status =  $_POST['status'];
}




$data['q_beneficiario']=$this->reportesModel->getbeneficiario($criterio_nombre,$nombre,$criterio_apellido,$apellido,$criterio_promedio,$promedio,$criterio_cedula,$cedula,$criterio_sexo,$sexo,$sql_i,$sql_c,$sql_m,$sql_p);


//*****************************************************
// Create new PHPExcel object

$objPHPExcel = new PHPExcel();

// Set properties

$objPHPExcel->getProperties()->setCreator("BazZ");
$objPHPExcel->getProperties()->setLastModifiedBy("BazZ");
$objPHPExcel->getProperties()->setTitle("Beneficiarios");
$objPHPExcel->getProperties()->setSubject("");



$objPHPExcel->getActiveSheet()->getPageSetup()->setHorizontalCentered(true);
$objPHPExcel->getActiveSheet()->getPageSetup()->setVerticalCentered(false);

// Set row height
$objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(15);
$objPHPExcel->getActiveSheet()->getRowDimension(2)->setRowHeight(15);
$objPHPExcel->getActiveSheet()->getRowDimension(3)->setRowHeight(15);
$objPHPExcel->getActiveSheet()->getRowDimension(4)->setRowHeight(15);
$objPHPExcel->getActiveSheet()->getRowDimension(5)->setRowHeight(15);

$objPHPExcel->getActiveSheet()->mergeCells('A1:H1');
$objPHPExcel->getActiveSheet()->mergeCells('A2:H2');
$objPHPExcel->getActiveSheet()->mergeCells('A3:H3');
$objPHPExcel->getActiveSheet()->mergeCells('A4:H4');
$objPHPExcel->getActiveSheet()->mergeCells('A5:H5');
$objPHPExcel->getActiveSheet()->mergeCells('A6:H6');



//$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, 10, 'Some value'); el valor de la columna por cordenadas X y Y

// Set column width dimensiones anchura de la filas no tocar o te jodo
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(24);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(11);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(23);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(12);


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

         $logojel->setCoordinates('G2');
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
$objPHPExcel->getActiveSheet()->SetCellValue('A5',"REPORTE DE BENEFICIARIO");
//fin de titulo del reporte
//*******************************************************************************

//formato titulo de los beneficiarios
 $objPHPExcel->getActiveSheet()->getRowDimension(7)->setRowHeight(12);
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
		'A7:H7'
);

//color de fondo
$objPHPExcel->getActiveSheet()->duplicateStyleArray(
   array('fill'    => array(
                   'type'    => PHPExcel_Style_Fill::FILL_SOLID,
                   'color'   => array('argb' => 'FFFFBE00')),
         'borders' => array(
                   'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'top'     => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN))
        ),
        "A7:H7"
        );
 // fin color de fondo
//fin formato titulo de los beneficiarios

//TITULO DE LOS beneficiarios


$objPHPExcel->getActiveSheet()->SetCellValue('A7',"NOMBRE");
$objPHPExcel->getActiveSheet()->SetCellValue('B7',"CEDULA");
$objPHPExcel->getActiveSheet()->SetCellValue('C7',"TIPO");
$objPHPExcel->getActiveSheet()->SetCellValue('D7',"INSTITUTO");
$objPHPExcel->getActiveSheet()->SetCellValue('E7',"CARRERA");
$objPHPExcel->getActiveSheet()->SetCellValue('F7',"PROMEDIO");
$objPHPExcel->getActiveSheet()->SetCellValue('G7',"PROM. DEPURADO");
$objPHPExcel->getActiveSheet()->SetCellValue('H7',"ESTATUS");
//fin de titulos de benefiarios
$indice=8;
foreach($data['q_beneficiario']->result() as $row){

//FORMATO DESCRIPCION beneficiarios
$objPHPExcel->getActiveSheet()->getRowDimension(7)->setRowHeight(12);
$objPHPExcel->getActiveSheet()->duplicateStyleArray(
		array(
'font'      => array(
'name'      => 'ARIAL',
'italic'    => false,
'size'      => 8
),
'alignment'  => array(
'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
'wrap'       => true
)
),

          'A'.$indice.':L'.$indice
);
//fin formato beneficiarios


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
       // 'A'.$indice.':I'.$indice
       'A'.$indice.':H'.$indice
        );
//fin de color y lineas



//DESCRIPCION SORTEOS valores de sorteos
//$objPHPExcel->getActiveSheet()->mergeCells('C8:E8');
//$objPHPExcel->getActiveSheet()->mergeCells('G8:I8');
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice,$row->nombre_persona.' '.$row->apellido_persona);
$objPHPExcel->getActiveSheet()->SetCellValue('B'.$indice,$row->cedula_persona);
$objPHPExcel->getActiveSheet()->SetCellValue('C'.$indice,$row->nombre_tipo_beca);
$objPHPExcel->getActiveSheet()->SetCellValue('D'.$indice,$row->nombre_instituto);
$objPHPExcel->getActiveSheet()->SetCellValue('E'.$indice,$row->nombre_carrera);
$objPHPExcel->getActiveSheet()->SetCellValue('F'.$indice,$row->promedio);
$objPHPExcel->getActiveSheet()->SetCellValue('G'.$indice,$row->promedio_depurado);
$objPHPExcel->getActiveSheet()->SetCellValue('H'.$indice,$row->nombre_estado_persona);

//fin descripcion de beneficiarios, valores
//******************************************
$indice=$indice+1;
}


$indice2 =$indice+1;

//color de fondo
$objPHPExcel->getActiveSheet()->duplicateStyleArray(
   array('fill'    => array(
                   'type'    => PHPExcel_Style_Fill::FILL_SOLID,
                   'color'   => array('argb' => 'FFCCFFCC')),
         'borders' => array(
                   'top'     => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN))
        ),
        'A'.$indice2.':E'.$indice2
        );
 // fin color de fondo
//formato de total conjunto
$objPHPExcel->getActiveSheet()->duplicateStyleArray(
		array(
'font'      => array(
'name'      => 'ARIAL',

'italic'    => false,
'size'      => 8
),
'alignment'  => array(
'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
'wrap'       => true
)
),

          'A'.$indice2.':E'.$indice2
);

$beneficiarios = $data['q_beneficiario']->num_rows();

$objPHPExcel->getActiveSheet()->mergeCells('A'.$indice2.':E'.$indice2);
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice2,'TOTAL: '.$beneficiarios);

//******************************************


//*******************************************************
 
 $arv=time();

  $data['archivo']='beneficiario'.$arv.'.xls';
  $data['rept']= 'reporte Beneficiario';

            $centinela = new Centinela();
            $menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
            $data['menu']               = $this->load->view('vis_menu',$menu_final,true);

  $this->load->view('vis',$data);

//***************************************************************
// Rename sheet
//echo date('H:i:s') . " Rename sheet\n"."Ruta donde no se como mostralo C:\web\JEL\Reportes";
$objPHPExcel->getActiveSheet()->setTitle('Reporte Beneficiario');

// Save Excel 2003 file

$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
//$objWriter->save(str_replace('.php', '.xls', _FILE_));
$objWriter->save('Reportes/beneficiario'.$arv.'.XLS');





//**************INICIO************************************************

/*
 $objPHPExcel = new PHPExcel();
         $actsheet = $objPHPExcel->getActiveSheet();

                             /**********************
                              ***** ENCABEZADO: ****
                              **********************/

         //LOGO GOV
      /*   $logogov = new PHPExcel_Worksheet_Drawing();
         $logogov->setName('descargar');
         $logogov->setDescription('Logo del GOV');
         $logogov->setPath(BASEPATH.'application/views/imagenes/descargar.jpg');
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
         $actsheet->getCell("A5")->setValue("REPORTE DE BENEFICIARIO");





         $records = array(array('NOMBRE222222','CEDULA','TIPO','INSTITUTO','CARRERA','PROMEDIO','PROM. DEPURADO','ESTATUS'));

         arrayToExcelTable($actsheet,$records,get_style('COLUMN_HEADER1'),array(3,2,4),0,7);



         $writer = PHPExcel_IOFactory::createWriter($objPHPExcel,"Excel5");
         $writer->save('Reportes/beneficiario2.XLS');


*/



}






















}

?>
