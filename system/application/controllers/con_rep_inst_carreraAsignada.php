<?php
class con_rep_inst_carreraAsignada extends Controller{


//Reporte de Institutos, Carreras y Asignaturas


     function con_rep_inst_carreraAsignada() {

             parent::Controller();
             $this -> load  ->database();
             $this -> load  ->model('Model_consulta','',TRUE);
             $this -> load  ->model('reportesModel');
             $this -> load  ->helper(array('form', 'url'));
             $this -> load  ->library('JELGeneral');
             $this -> load  ->library('xajax');
             $this -> xajax ->registerFunction(array('obtieneNucleo', &$this, 'obtieneNucleo'));
             $this -> xajax ->registerFunction(array('obtieneParroquia', &$this, 'obtieneParroquia'));
             $this -> xajax ->processRequest();

     }

        function index(){ //formulario 3
            $centinela = new Centinela();
            $menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
            $data['menu']               = $this->load->view('vis_menu',$menu_final,true);
            $data['xajax_js']     = $this -> xajax          -> getJavascript(base_url());
            $data['q_instituto']  = $this -> Model_consulta -> consulta_combo('nombre_instituto','ASC','instituto');
            $data['q_car_inst']   = $this -> Model_consulta -> consulta_combo('siglas_instituto','ASC','vis_carrera_instituto');
            $data['q_municipio']  = $this -> Model_consulta -> consulta_combo('nombre_municipio','ASC','vis_municipio');
            $data['q_parroquia']  = $this -> Model_consulta -> consulta_combo('nombre_parroquia','ASC','vis_parroquia');
           

            $this->load->view('reporte/vis_rep_carreraAsignada',$data);

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


function const_rep_inst_carreraAsignada(){

$valores_municipio ='';
$valores_parroquia ='';
$valores_instituto ='';
 $valores_carrera  ='';


if(isset($_POST['municipio'])){

     foreach($_POST['municipio'] as $key => $value){
                               $valores_municipio.=$value.',';
                           }

    $valores_municipio = substr ($valores_municipio, 0, strlen($valores_municipio) -1);
    $sql_m= ' municipio_id in ('.$valores_municipio.') and ';

    }else{

          $sql_m = '';
         }

//**********************************************

     if(isset($_POST['parroquia'])){

     foreach($_POST['parroquia'] as $key => $value){
                                $valores_parroquia.=$value.',';
                           }

    $valores_parroquia = substr ($valores_parroquia, 0, strlen($valores_parroquia) -1);
    $sql_p= ' parroquia_id in ('.$valores_parroquia.') and ';

    }else{

          $sql_p = '';
         }

//*******************************************

 if(isset($_POST['instituto'])){
     
     foreach($_POST['instituto'] as $key => $value){
                                $valores_instituto.=$value.',';
                           }

    $valores_instituto = substr ($valores_instituto, 0, strlen($valores_instituto) -1);
    $sql_i= ' instituto_id in ('.$valores_instituto.') and  ';

    }else{

          $sql_i= '';
         }



//******************************************



 if(isset($_POST['carrera'])){

     foreach($_POST['carrera'] as $key => $value){
                                $valores_carrera.=$value.',';
                           }

    $valores_carrera = substr ($valores_carrera, 0, strlen($valores_carrera) -1);
    $sql_ca= ' carrera_instituto_id in ('.$valores_carrera.')  and ';

    }else{

          $sql_ca= '';
         }
//*********************************************



//generar xls para reporte
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

$objPHPExcel->getActiveSheet()->mergeCells('A1:H1');
$objPHPExcel->getActiveSheet()->mergeCells('A2:H2');
$objPHPExcel->getActiveSheet()->mergeCells('A3:H3');
$objPHPExcel->getActiveSheet()->mergeCells('A4:H4');
$objPHPExcel->getActiveSheet()->mergeCells('A5:H5');
$objPHPExcel->getActiveSheet()->mergeCells('A6:H6');



//$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, 10, 'Some value'); el valor de la columna por cordenadas X y Y

// Set column width dimensiones anchura de la filas no tocar o te jodo
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(23);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(19);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(18);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(8);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(8);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(8);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(5);





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
$objPHPExcel->getActiveSheet()->SetCellValue('A5',"REPORTE DE INSTITUCIONES, CARRERAS Y MATERIAS");


$objPHPExcel->getActiveSheet()->mergeCells('A6:E6');





//FORMATO FECHA Y TOTAL 8

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
		'A8:H8'
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
        'A8:H8'
        );
 // fin color de fondo
//******************************************************************************


$query_instituto =$this->reportesModel->getinstituto($sql_i);


$indice=8;
foreach($query_instituto->result() as $row){




//FORMATO FECHA Y TOTAL 8

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
		'A'.$indice.':H'.$indice
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
        'A'.$indice.':H'.$indice
        );
 // fin color de fondo



//TITULOS
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice,"INSTITUTO");
$objPHPExcel->getActiveSheet()->SetCellValue('B'.$indice,"R.I.F.");
$objPHPExcel->getActiveSheet()->mergeCells('C'.$indice.':H'.$indice);
$objPHPExcel->getActiveSheet()->SetCellValue('C'.$indice,"NOMBRE COMPLETO INSTITUTO");
//FIN LOS TITULOS




$indice= $indice+1;
//FORMATO FECHA Y TOTAL 9

 $objPHPExcel->getActiveSheet()->duplicateStyleArray(
		array(
'font'      => array(
'name'      => 'ARIAL',
'bold'      => FALSE,
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
		 'A'.$indice.':H'.$indice
);

//color de fondo
$objPHPExcel->getActiveSheet()->duplicateStyleArray(
   array('fill'    => array(
                   'type'    => PHPExcel_Style_Fill::FILL_SOLID),

         'borders' => array(
                   'top'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN))
        ),
         'A'.$indice.':H'.$indice
        );
 // fin color de fondo

//VALORES 9
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice,$row->siglas_instituto);
$objPHPExcel->getActiveSheet()->SetCellValue('B'.$indice,$row->rif_instituto);
$objPHPExcel->getActiveSheet()->mergeCells('C'.$indice.':H'.$indice);
$objPHPExcel->getActiveSheet()->SetCellValue('C'.$indice,$row->nombre_instituto);
//FIN VALORES
//******************************************************************************



$id = $row->instituto_id;
$indice=$indice+1;
$query_nucleo =$this->reportesModel->getnucleo($sql_m,$sql_p,$id);
foreach($query_nucleo->result() as $row2){



//FORMATO FECHA Y TOTAL 11

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
		'A'.$indice.':H'.$indice
);

//color de fondo
$objPHPExcel->getActiveSheet()->duplicateStyleArray(
   array('fill'    => array(
                   'type'    => PHPExcel_Style_Fill::FILL_SOLID,
                   'color'   => array('argb' => 'FFFFFF99')),
         'borders' => array(
                   'top'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN))
        ),
        'A'.$indice.':H'.$indice
        );
 // fin color de fondo 11
//TITULOS
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice,"NUCLEO");
$objPHPExcel->getActiveSheet()->SetCellValue('B'.$indice,"MUNICIPIO");
$objPHPExcel->getActiveSheet()->SetCellValue('C'.$indice,"PARROQUIA");
$objPHPExcel->getActiveSheet()->mergeCells('D'.$indice.':E'.$indice);
$objPHPExcel->getActiveSheet()->SetCellValue('D'.$indice,"CONTACTO 1");
$objPHPExcel->getActiveSheet()->mergeCells('F'.$indice.':H'.$indice);
$objPHPExcel->getActiveSheet()->SetCellValue('F'.$indice,"TELÉFONO CONTACTO 1");
//FIN DE LOS TITULOS



$indice=$indice+1;
//FORMATO FECHA Y TOTAL 12

 $objPHPExcel->getActiveSheet()->duplicateStyleArray(
		array(
'font'      => array(
'name'      => 'ARIAL',
'bold'      => FALSE,
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
		'A'.$indice.':H'.$indice
);

//color de fondo
$objPHPExcel->getActiveSheet()->duplicateStyleArray(
   array('fill'    => array(
                   'type'    => PHPExcel_Style_Fill::FILL_SOLID),

         'borders' => array(
                   'top'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN))
        ),
        'A'.$indice.':H'.$indice
        );
 // fin color de fondo
//VALORES
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice,$row2->siglas_nucleo_instituto);
$objPHPExcel->getActiveSheet()->SetCellValue('B'.$indice,$row2->nombre_municipio);
$objPHPExcel->getActiveSheet()->SetCellValue('C'.$indice,$row2->nombre_parroquia);
$objPHPExcel->getActiveSheet()->mergeCells('D'.$indice.':E'.$indice);
$objPHPExcel->getActiveSheet()->SetCellValue('D'.$indice,$row2->contacto_01);
$objPHPExcel->getActiveSheet()->mergeCells('F'.$indice.':H'.$indice);
$objPHPExcel->getActiveSheet()->SetCellValue('F'.$indice,$row2->telefono_contacto_01);
//FIN DE LOS VALORES




$indice=$indice+1;
//FORMATO FECHA Y TOTAL 13

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
		'A'.$indice.':H'.$indice
);

//color de fondo
$objPHPExcel->getActiveSheet()->duplicateStyleArray(
   array('fill'    => array(
                   'type'    => PHPExcel_Style_Fill::FILL_SOLID,
                   'color'   => array('argb' => 'FFFFFF99')),
         'borders' => array(
                   'top'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN))
        ),
        'A'.$indice.':H'.$indice
        );
 // fin color de fondo
//TITULOS 13
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice,"TELÉFONO 1");
$objPHPExcel->getActiveSheet()->SetCellValue('B'.$indice,"TELÉFONO 2");
$objPHPExcel->getActiveSheet()->SetCellValue('C'.$indice,"TELÉFONO 3");
$objPHPExcel->getActiveSheet()->mergeCells('D'.$indice.':E'.$indice);
$objPHPExcel->getActiveSheet()->SetCellValue('D'.$indice,"CONTACTO 2");
$objPHPExcel->getActiveSheet()->mergeCells('F'.$indice.':H'.$indice);
$objPHPExcel->getActiveSheet()->SetCellValue('F'.$indice,"TELÉFONO CONTACTO 2");
//FIN DE LOS TITULOS


$indice=$indice+1;
//FORMATO FECHA Y TOTAL 14

 $objPHPExcel->getActiveSheet()->duplicateStyleArray(
		array(
'font'      => array(
'name'      => 'ARIAL',
'bold'      => FALSE,
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
		'A'.$indice.':H'.$indice
);

//color de fondo
$objPHPExcel->getActiveSheet()->duplicateStyleArray(
   array('fill'    => array(
                   'type'    => PHPExcel_Style_Fill::FILL_SOLID),

         'borders' => array(
                   'top'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN))
        ),
        'A'.$indice.':H'.$indice
        );
 // fin color de fondo 14
//VALORES
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice,$row2->telefono01_nucleo_instituto);
$objPHPExcel->getActiveSheet()->SetCellValue('B'.$indice,$row2->telefono02_nucleo_instituto);
$objPHPExcel->getActiveSheet()->SetCellValue('C'.$indice,$row2->telefono03_nucleo_instituto);
$objPHPExcel->getActiveSheet()->mergeCells('D'.$indice.':E'.$indice);
$objPHPExcel->getActiveSheet()->SetCellValue('D'.$indice,$row2->contacto_02);
$objPHPExcel->getActiveSheet()->mergeCells('F'.$indice.':H'.$indice);
$objPHPExcel->getActiveSheet()->SetCellValue('F'.$indice,$indice,$row2->telefono_contacto_02);
//FIN DE LOS VALORES



$indice=$indice+1;
//FORMATO FECHA Y TOTAL 15

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
		'A'.$indice.':H'.$indice
);

//color de fondo
$objPHPExcel->getActiveSheet()->duplicateStyleArray(
   array('fill'    => array(
                   'type'    => PHPExcel_Style_Fill::FILL_SOLID,
                   'color'   => array('argb' => 'FFFFFF99')),
         'borders' => array(
                   'top'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN))
        ),
        'A'.$indice.':H'.$indice
        );
 // fin color de fondo 15
//TITULOS
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice,"FAX 1");
$objPHPExcel->getActiveSheet()->SetCellValue('B'.$indice,"FAX 2");
$objPHPExcel->getActiveSheet()->mergeCells('C'.$indice.':D'.$indice);
$objPHPExcel->getActiveSheet()->SetCellValue('C'.$indice,"E-MAIL 1");
$objPHPExcel->getActiveSheet()->mergeCells('E'.$indice.':H'.$indice);
$objPHPExcel->getActiveSheet()->SetCellValue('E'.$indice,"E-MAIL 2");
//FIN DE LOS TITULOS


$indice=$indice+1;
//FORMATO FECHA Y TOTAL 16

 $objPHPExcel->getActiveSheet()->duplicateStyleArray(
		array(
'font'      => array(
'name'      => 'ARIAL',
'bold'      => FALSE,
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
		'A'.$indice.':H'.$indice
);

//color de fondo
$objPHPExcel->getActiveSheet()->duplicateStyleArray(
   array('fill'    => array(
                   'type'    => PHPExcel_Style_Fill::FILL_SOLID),

         'borders' => array(
                   'top'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN))
        ),
        'A'.$indice.':H'.$indice
        );
 // fin color de fondo
//TITULOS 16
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice,$row2->fax01_nucleo_instituto);
$objPHPExcel->getActiveSheet()->SetCellValue('B'.$indice,$row2->fax02_nucleo_instituto);
$objPHPExcel->getActiveSheet()->mergeCells('C'.$indice.':D'.$indice);
$objPHPExcel->getActiveSheet()->SetCellValue('C'.$indice,$row2->email01_nucleo_instituto);
$objPHPExcel->getActiveSheet()->mergeCells('E'.$indice.':H'.$indice);
$objPHPExcel->getActiveSheet()->SetCellValue('E'.$indice,$row2->email02_nucleo_instituto);

$indice=$indice+1;
//FIN DE LOS TITULOS

//FORMATO FECHA Y TOTAL 17

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
		'A'.$indice.':H'.$indice
);

//color de fondo
$objPHPExcel->getActiveSheet()->duplicateStyleArray(
   array('fill'    => array(
                   'type'    => PHPExcel_Style_Fill::FILL_SOLID,
                   'color'   => array('argb' => 'FFFFFF99')),
         'borders' => array(
                   'top'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN))
        ),
        'A'.$indice.':H'.$indice
        );
 // fin color de fondo
//TITULOS 17
$objPHPExcel->getActiveSheet()->mergeCells('A'.$indice.':H'.$indice);
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice,"DIRECCION NUCLEO");



$indice=$indice+1;
//FORMATO FECHA Y TOTAL 18

 $objPHPExcel->getActiveSheet()->duplicateStyleArray(
		array(
'font'      => array(
'name'      => 'ARIAL',
'bold'      => FALSE,
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
		'A'.$indice.':H'.$indice
);

//color de fondo
$objPHPExcel->getActiveSheet()->duplicateStyleArray(
   array('fill'    => array(
                   'type'    => PHPExcel_Style_Fill::FILL_SOLID),

         'borders' => array(
                   'top'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN))
        ),
        'A'.$indice.':H'.$indice
        );
 // fin color de fondo
//FIN TITULOS 18
$objPHPExcel->getActiveSheet()->mergeCells('A'.$indice.':H'.$indice);
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice,$row2->direccion_nucleo_instituto);

$indice=$indice+2;
}//fin nucleo********************************************************


$indice=$indice+1;
$query_carrera =$this->reportesModel->getcarrera($sql_ca,$id);
foreach($query_carrera->result() as $row3){




//FORMATO FECHA Y TOTAL 21

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
		'A'.$indice.':H'.$indice
);

//color de fondo
$objPHPExcel->getActiveSheet()->duplicateStyleArray(
   array('fill'    => array(
                   'type'    => PHPExcel_Style_Fill::FILL_SOLID,
                   'color'   => array('argb' => '333366FF')),
         'borders' => array(
                   'top'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN))
        ),
        'A'.$indice.':H'.$indice
        );
 // fin color de fondo
 
//TITULOS 21
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice,"CARRERA");
$objPHPExcel->getActiveSheet()->mergeCells('B'.$indice.':H'.$indice);
$objPHPExcel->getActiveSheet()->SetCellValue('B'.$indice,"DESCRIPCION");
//FIN TITULOS



$indice=$indice+1;
//FORMATO FECHA Y TOTAL 22

 $objPHPExcel->getActiveSheet()->duplicateStyleArray(
		array(
'font'      => array(
'name'      => 'ARIAL',
'bold'      => FALSE,
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
		'A'.$indice.':H'.$indice
);

//color de fondo
$objPHPExcel->getActiveSheet()->duplicateStyleArray(
   array('fill'    => array(
                   'type'    => PHPExcel_Style_Fill::FILL_SOLID),

         'borders' => array(
                   'top'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN))
        ),
        'A'.$indice.':H'.$indice
        );
 // fin color de fondo
//VALORES
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice,$row3->nombre_carrera);
$objPHPExcel->getActiveSheet()->mergeCells('B'.$indice.':H'.$indice);
$objPHPExcel->getActiveSheet()->SetCellValue('B'.$indice,$row3->descripcion_carrera);
//VALORES
$indice=$indice+1;


//****************MATERIAS DE LA CARRERA



$query_materia =$this->reportesModel->materia($row3->carrera_instituto_id);

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
		'A'.$indice.':C'.$indice
);

//color de fondo
$objPHPExcel->getActiveSheet()->duplicateStyleArray(
   array('fill'    => array(
                   'type'    => PHPExcel_Style_Fill::FILL_SOLID,
                   'color'   => array('argb' => '333366FF')),
         'borders' => array(
                   'top'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN))
        ),
        'A'.$indice.':C'.$indice
        );
 // fin color de fondo
//titulo
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice,"ASIGNATURA");
$objPHPExcel->getActiveSheet()->SetCellValue('B'.$indice,"SEMESTRE/TRIMESTRE");
$objPHPExcel->getActiveSheet()->SetCellValue('C'.$indice,"UNIDAD CREDITO");
//fin titulos



$indice=$indice+1;

foreach($query_materia->result() as $row4){



//FORMATO FECHA Y TOTAL

 $objPHPExcel->getActiveSheet()->duplicateStyleArray(
		array(
'font'      => array(
'name'      => 'ARIAL',
'bold'      => FALSE,
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
		'A'.$indice.':C'.$indice
);

//color de fondo
$objPHPExcel->getActiveSheet()->duplicateStyleArray(
   array('fill'    => array(
                   'type'    => PHPExcel_Style_Fill::FILL_SOLID),

         'borders' => array(
                   'top'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN))
        ),
        'A'.$indice.':C'.$indice
        );
 // fin color de fondo
//valores
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice,$row4->nombre_materia);
$objPHPExcel->getActiveSheet()->SetCellValue('B'.$indice,$row4->numero_periodo);
$objPHPExcel->getActiveSheet()->SetCellValue('C'.$indice,$row4->cantidad_unidad_credito);
//fin valores


//*************************************************************************************************************
$indice=$indice+1;
}




//FIN DE MATERIAS DE LA CARRERA
$indice=$indice+1;
}


$indice=$indice+1;
}


$objPHPExcel->getActiveSheet()->setTitle('Reporte carrera instituto');

// Save Excel 2003 file
 
$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);


$arv= time();
//$objWriter->save(str_replace('.php', '.xls', _FILE_));
$objWriter->save('Reportes/carinstitu'.$arv.'.XLS');





//fin de titulo del reporte
//*******************************************************************************





//****************************
//FIN DEL EXCEL
//****************************

$data['archivo']   ='carinstitu'.$arv.'.xls';
$data['rept']      ='Reporte carrera instituto';
$centinela = new Centinela();
$menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
$data['menu']               = $this->load->view('vis_menu',$menu_final,true);
$this->load->view('vis',$data);
//fin xls para reporte
}
}
?>
