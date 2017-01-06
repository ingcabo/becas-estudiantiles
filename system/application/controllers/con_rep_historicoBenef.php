<?php
class con_rep_historicoBenef extends Controller
{
var $vismenu;
     function con_rep_historicoBenef() {

             parent::Controller();
             $this -> load  ->database();
             $this -> load  ->model('Model_consulta','',TRUE);
             $this -> load  ->helper(array('form', 'url'));
             $this -> load  ->library('JELGeneral'); 
             $this -> load  ->model('reportesModel');

             $this -> load  ->library('xajax');
             $this -> xajax ->registerFunction(array('obtieneParroquia_censo', &$this, 'obtieneParroquia_censo'));
             $this -> xajax ->registerFunction(array('obtieneParroquia_habitad', &$this, 'obtieneParroquia_habitad'));
             $this -> xajax ->registerFunction(array('obtieneCarrera', &$this, 'obtieneCarrera'));

             $this -> xajax ->processRequest();
     }

        function index(){

        $centinela = new Centinela();
        $menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
        $data['menu']               = $this->load->view('vis_menu',$menu_final,true);

        $data['xajax_js']     = $this -> xajax          -> getJavascript(base_url());
        $data['q_municipio']  = $this -> Model_consulta -> consulta_combo('nombre_municipio','ASC','vis_municipio');
        $data['q_parroquia']  = $this -> Model_consulta -> consulta_combo('nombre_parroquia','ASC','vis_parroquia');
        $data['q_instituto']  = $this -> Model_consulta -> consulta_combo('nombre_instituto','ASC','instituto');
        $data['q_car_inst']   = $this -> Model_consulta -> consulta_combo('siglas_instituto','ASC','vis_carrera_instituto');
        $data['q_accion']     = $this -> Model_consulta -> consulta_combo('nombre_accion','ASC','accion');



        $this->load->view('reporte/vis_rep_historico_beneficiario',$data);
        }


           function obtieneParroquia_censo($controles){

        $respuesta = new xajaxResponse(); //Creamos el objeto xajax
		$inputDestino = "capa_parroquia_censo"; //indicamos el ID del tag HTML de destino. en este caso el DIV que contiene el selector
		$propiedadInputDestino = "innerHTML"; //indicamos la propiedad que deseamos que se modifique. Colocaremos el selector dentro del DIV
		$valorAAsignar   = ""; //indicamos el nuevo valor que este tendrá. Cadena HTML
        $condicion       = "";

        if(!isset($controles['municipio_censo'])){
                       $condicion='0,';
        }else{
                       foreach($controles['municipio_censo'] as $key => $value){
                           $condicion.=$value.',';
                       }
              }


       $condicion  = substr ($condicion, 0, strlen($condicion) -1);
       $consulta   = $this->db->query('select * from vis_parroquia where municipio_id in ('.$condicion.') order by nombre_parroquia');

        if ($consulta->num_rows() > 0){

                         foreach ($consulta -> result() as $row){

                                $data = array(
                                'name'     => 'parroquia_censo[]',
                                'id'       => 'parroquia_censo',
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



            function obtieneParroquia_habitad($controles){

        $respuesta = new xajaxResponse(); //Creamos el objeto xajax
		$inputDestino = "capa_parroquia_habitad"; //indicamos el ID del tag HTML de destino. en este caso el DIV que contiene el selector
		$propiedadInputDestino = "innerHTML"; //indicamos la propiedad que deseamos que se modifique. Colocaremos el selector dentro del DIV
		$valorAAsignar   = ""; //indicamos el nuevo valor que este tendrá. Cadena HTML
        $condicion       = "";

        if(!isset($controles['municipio_habitad'])){
                       $condicion='0,';
        }else{
                       foreach($controles['municipio_habitad'] as $key => $value){
                           $condicion.=$value.',';
                       }
              }


       $condicion  = substr ($condicion, 0, strlen($condicion) -1);
       $consulta   = $this->db->query('select * from vis_parroquia where municipio_id in ('.$condicion.') order by nombre_parroquia');

        if ($consulta->num_rows() > 0){

                         foreach ($consulta -> result() as $row){

                                $data = array(
                                'name'     => 'parroquia_habitad[]',
                                'id'       => 'parroquia_habitad',
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


     function obtieneCarrera($controles){

        $respuesta = new xajaxResponse(); //Creamos el objeto xajax
		$inputDestino = "capa_carrera"; //indicamos el ID del tag HTML de destino. en este caso el DIV que contiene el selector
		$propiedadInputDestino = "innerHTML"; //indicamos la propiedad que deseamos que se modifique. Colocaremos el selector dentro del DIV
		$valorAAsignar   = ""; //indicamos el nuevo valor que este tendrá. Cadena HTML
        $condicion       = "";

        if(!isset($controles['instituto'])){
                       $condicion='0,';
        }else{
                       foreach($controles['instituto'] as $key => $value){
                           $condicion.=$value.',';
                       }
              }


       $condicion  = substr ($condicion, 0, strlen($condicion) -1);
       $consulta   = $this->db->query('select * from vis_carrera_instituto where instituto_id in ('.$condicion.') order by nombre_carrera');

        if ($consulta->num_rows() > 0){

                         foreach ($consulta -> result() as $row){

                                $data = array(
                                'name'     => 'carrera[]',
                                'id'       => 'carrera',
                                'value'    => $row->carrera_instituto_id,
                                'checked'  => true,
                                             );
                               $valorAAsignar .=  '<font size="2" face="Geneva, Arial, Helvetica, sans-serif">'.form_checkbox($data).$row->siglas_instituto."-".$row->nombre_carrera.'</font><br>';
                               $respuesta -> Assign($inputDestino, $propiedadInputDestino, $valorAAsignar);
                            }

         }else{
                 $valorAAsignar ="";
                 $respuesta -> Assign($inputDestino, $propiedadInputDestino, $valorAAsignar);
               }
         return $respuesta;

         }





function const_historicoBenef(){


$valores_municipio_censo   ='';
$valores_parroquia_censo   ='';
$valores_municipio_habitad ='';
$valores_parroquia_habitad ='';
$valores_carrera           ='';
$valores_instituto         ='';
 $valores_accion           ='';

//***************************************
  if(isset($_POST['municipio_censo'])){
     
     foreach($_POST['municipio_censo'] as $key => $value){
                               $valores_municipio_censo.=$value.',';
                           }

    $valores_municipio_censo = substr ($valores_municipio_censo, 0, strlen($valores_municipio_censo) -1);
    $sql_mc= ' municipio_id in ('.$valores_municipio_censo.') and ';

    }else{
         
          $sql_mc = '';
         }

//**********************************************

     if(isset($_POST['parroquia_censo'])){
  
     foreach($_POST['parroquia_censo'] as $key => $value){
                                $valores_parroquia_censo.=$value.',';
                           }

    $valores_parroquia_censo = substr ($valores_parroquia_censo, 0, strlen($valores_parroquia_censo) -1);
    $sql_pc= ' parroquia_id in ('.$valores_parroquia_censo.') and ';

    }else{
          
          $sql_pc = '';
         }


//**********************************************

 if(isset($_POST['municipio_habitad'])){
     
     foreach($_POST['municipio_habitad'] as $key => $value){
                                $valores_municipio_habitad.=$value.',';
                           }

    $valores_municipio_habitad = substr ($valores_municipio_habitad, 0, strlen($valores_municipio_habitad) -1);
    $sql_ma= ' municipio_id in ('.$valores_municipio_habitad.') and ';

    }else{
         
          $sql_ma = '';
         }


//********************************************

 if(isset($_POST['parroquia_habitad'])){
    
     foreach($_POST['parroquia_habitad'] as $key => $value){
                                $valores_parroquia_habitad.=$value.',';
                           }

    $valores_parroquia_habitad = substr ($valores_parroquia_habitad, 0, strlen($valores_parroquia_habitad) -1);
    $sql_pa= ' parroquia_id in ('.$valores_parroquia_habitad.') and ';

    }else{
         
          $sql_pa= '';
         }




//********************************************


 if(isset($_POST['instituto'])){
     $andi= ' and ';
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
    $sql_ca= ' carrera_id in ('.$valores_carrera.')  and ';

    }else{
         
          $sql_ca= '';
         }

//***********************************


if(isset($_POST['accion'])){

     foreach($_POST['accion'] as $key => $value){
                                $valores_accion.=$value.',';
                           }

    $valores_accion = substr ($valores_accion, 0, strlen($valores_accion) -1);
    $sql_acc= ' accion_id in ('.$valores_accion.') ';

    }else{

          $sql_acc= '';
         }



//***********************************
$nombre   ='';
$apellido ='';
$cedula   ='';
$sexo     ='';


//**********************************
$criterio_nombre  = $_POST['snombre'];
if(isset($_POST['nombre']) && $_POST['nombre'] <> ''){

    $nombre =  $_POST['nombre'];
}

//*************************************

$criterio_apellido  = $_POST['sapellido'];
if(isset($_POST['apellido']) && $_POST['apellido'] <> ''){

    $apellido =  $_POST['apellido'];
}

//*************************************

$criterio_cedula  = $_POST['scedula'];
if(isset($_POST['cedula']) && $_POST['cedula'] <> ''){

    $cedula =  $_POST['cedula'];
}
//************************************

$criterio_sexo = 0;
if(isset($_POST['sexo']) && $_POST['sexo'] <> '0'){
    $criterio_sexo = 0;
    $sexo =  $_POST['sexo'];
}else{

    $criterio_sexo = '';
    $sexo          = '';
}


//**********************************






 $data['becado_jel']=$this->reportesModel->gethistoricoBenef($criterio_nombre,$nombre,$criterio_apellido,$apellido,$criterio_cedula,$cedula,$criterio_sexo,$sexo,$sql_mc,$sql_pc,$sql_ma,$sql_pa,$sql_i,$sql_ca,$sql_acc);

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
//******************************************************************
// Set column width dimensiones anchura de la filas no tocar o te jodo
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(18);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(11);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(23);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(27);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(27);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(27);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(16);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(19);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(17);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(19);


//*******************************************************************
$objPHPExcel->getActiveSheet()->mergeCells('A1:M1');
$objPHPExcel->getActiveSheet()->mergeCells('A2:M2');
$objPHPExcel->getActiveSheet()->mergeCells('A3:M3');
$objPHPExcel->getActiveSheet()->mergeCells('A4:M4');
$objPHPExcel->getActiveSheet()->mergeCells('A5:M5');
$objPHPExcel->getActiveSheet()->mergeCells('A6:M6');
//******************************************************************




//$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, 10, 'Some value'); el valor de la columna por cordenadas X y Y




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

         $logojel->setCoordinates('L2');
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
		'A2:M3'
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
		'A5:M5'
);
//fin formato titulo del reporte

//titulo reporte
$objPHPExcel->getActiveSheet()->SetCellValue('A2',"GOBERNACIÓN DEL ESTADO ZULIA");
$objPHPExcel->getActiveSheet()->SetCellValue('A3',"FUNDACIÓN JESUS ENRIQUE LOSSADA");
$objPHPExcel->getActiveSheet()->SetCellValue('A5',"REPORTE HISTORICO DE BENEFICIARIO");



//****INICIO DE EL CONTENIDO DEL REPORTE


//inicio de la impresion de la persona como becado jel
$indice=7;
foreach($data['becado_jel']->result() as $row){

$personaId= $row->persona_id;
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
		'A'.$indice.':M'.$indice
);
//fin formato titulo del reporte
//color y lineas
$objPHPExcel->getActiveSheet()->duplicateStyleArray(
   array('fill'    => array(
                   'type'    => PHPExcel_Style_Fill::FILL_SOLID,
                   'color'   => array('argb' => 'FFFFCC99')),

         'borders' => array(
                   'top'     => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN))
        ),
       // 'A'.$indice.':I'.$indice
       'A'.$indice.':M'.$indice
        );
//fin de color y lineas
$objPHPExcel->getActiveSheet()->mergeCells('A'.$indice.':M'.$indice);
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice,"INFORMACIÓN DEL BENEFICIARIO");
//**fin

$indice=$indice+1;//un espacio mas 8
//formato letra
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
		'A'.$indice.':M'.$indice
        );
//fin formato letra
//color y lineas
$objPHPExcel->getActiveSheet()->duplicateStyleArray(
   array('fill'    => array(
                   'type'    => PHPExcel_Style_Fill::FILL_SOLID,
                   'color'   => array('argb' => '333366ff')),//azul

         'borders' => array(
                   'top'     => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN))
        ),
       // 'A'.$indice.':I'.$indice
       'A'.$indice.':M'.$indice
        );
//fin de color y lineas

//**TITULOS
$objPHPExcel->getActiveSheet()->mergeCells('A'.$indice.':B'.$indice);
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice,"NOMBRE");
$objPHPExcel->getActiveSheet()->SetCellValue('C'.$indice,"CEDULA");
$objPHPExcel->getActiveSheet()->SetCellValue('D'.$indice,"ESTÁTUS ACTUAL");
$objPHPExcel->getActiveSheet()->SetCellValue('E'.$indice,"INSTITUTO ACTUAL");
$objPHPExcel->getActiveSheet()->SetCellValue('F'.$indice,"CARRERA ACTUAL");
$objPHPExcel->getActiveSheet()->SetCellValue('G'.$indice,"CORREO ELECTRÓNICO");
$objPHPExcel->getActiveSheet()->SetCellValue('H'.$indice,"MUNICIPIO");
$objPHPExcel->getActiveSheet()->SetCellValue('I'.$indice,"PARROQUIA");
$objPHPExcel->getActiveSheet()->mergeCells('J'.$indice.':L'.$indice);
$objPHPExcel->getActiveSheet()->SetCellValue('J'.$indice,"DIRECCIÓN");
$objPHPExcel->getActiveSheet()->SetCellValue('M'.$indice,"TIPO BECA");


//***FIN DE TITULOS

$indice=$indice+1;//un espacio mas 9
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
		'A'.$indice.':M'.$indice
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
       // 'A'.$indice.':I'.$indice
       'A'.$indice.':M'.$indice
        );
//fin de color y lineas
//consulto el estado de la persona
$estado = $this -> Model_consulta -> consulta_un_parametro('beca_jel_id','asc','vis_beca_persona',$row->beca_jel_id,'beca_jel_id');
$fila_estado = $estado->row_array();
//fin de consulta estado de la persona
//**INICIO DE VALORES
$objPHPExcel->getActiveSheet()->mergeCells('A'.$indice.':B'.$indice);
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice,$row->nombre_persona.' '.$row->apellido_persona);
$objPHPExcel->getActiveSheet()->SetCellValue('C'.$indice,$row->cedula_persona);
$objPHPExcel->getActiveSheet()->SetCellValue('D'.$indice,$fila_estado['nombre_estado_persona']);
$objPHPExcel->getActiveSheet()->SetCellValue('E'.$indice,$row->siglas_instituto);
$objPHPExcel->getActiveSheet()->SetCellValue('F'.$indice,$row->nombre_carrera);
$objPHPExcel->getActiveSheet()->SetCellValue('G'.$indice,$row->email_persona);
$objPHPExcel->getActiveSheet()->SetCellValue('H'.$indice,$row->nombre_municipio);
$objPHPExcel->getActiveSheet()->SetCellValue('I'.$indice,$row->nombre_parroquia);

$objPHPExcel->getActiveSheet()->mergeCells('J'.$indice.':L'.$indice);

$objPHPExcel->getActiveSheet()->SetCellValue('J'.$indice,$row->direccion01_persona);
$objPHPExcel->getActiveSheet()->SetCellValue('M'.$indice,$row->nombre_tipo_beca);

//***FIN DE VALORES


$indice=$indice+2;


//formato letra
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
		'A'.$indice.':M'.$indice
        );
//fin formato letra
//color y lineas
$objPHPExcel->getActiveSheet()->duplicateStyleArray(
   array('fill'    => array(
                   'type'    => PHPExcel_Style_Fill::FILL_SOLID,
                   'color'   => array('argb' => '333366ff')),//azul

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
//inicio de titulo
$objPHPExcel->getActiveSheet()->mergeCells('A'.$indice.':D'.$indice);
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice,'OBSERVACIONES');
$objPHPExcel->getActiveSheet()->SetCellValue('E'.$indice,'APTO');

$objPHPExcel->getActiveSheet()->mergeCells('F'.$indice.':G'.$indice);

$objPHPExcel->getActiveSheet()->SetCellValue('F'.$indice,'FILTRO');
$objPHPExcel->getActiveSheet()->SetCellValue('H'.$indice,'PART. SORTEOS');
//fim de titulo

$indice=$indice+1;






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
		'A'.$indice.':H'.$indice
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
       // 'A'.$indice.':I'.$indice
       'A'.$indice.':H'.$indice
        );
//fin de color y lineas


//consulto el estado de la persona
$pto    = $this->db->query('select * from vis_verificacion where persona_id= '.$personaId.' and fecha_verificacion =(select max(fecha_verificacion) as fecha_verificacion from verificacion)');
$fila_pto = $pto->row_array();
$sort  = $this->db->query ('select COUNT(sorteo_id) as total from vis_sorteo where fecha_sorteo >= (select min(fecha_procedencia) as fecha_procedencia from vis_procedencia_persona where persona_id= '.$personaId.') and  fecha_sorteo <= (select fecha_sorteo from vis_sorteo_persona where persona_id = '.$personaId.' )');
$fila_total_sort = $sort->row_array();
//fin de consulta estado de la persona



if($pto->num_rows() > 0){
//inicio de VALORES
$objPHPExcel->getActiveSheet()->mergeCells('A'.$indice.':D'.$indice);
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice,$fila_pto['descripcion_verificacion']);
$objPHPExcel->getActiveSheet()->SetCellValue('E'.$indice,'NO');
$objPHPExcel->getActiveSheet()->mergeCells('F'.$indice.':G'.$indice);
$objPHPExcel->getActiveSheet()->SetCellValue('F'.$indice,'En '.$fila_pto['siglas_instituto']);
$objPHPExcel->getActiveSheet()->SetCellValue('H'.$indice,$fila_total_sort['total']);
//fim de VALORES
}else{
$objPHPExcel->getActiveSheet()->mergeCells('A'.$indice.':D'.$indice);
$objPHPExcel->getActiveSheet()->mergeCells('F'.$indice.':G'.$indice);
$objPHPExcel->getActiveSheet()->SetCellValue('E'.$indice,'SI');
$objPHPExcel->getActiveSheet()->SetCellValue('H'.$indice,$fila_total_sort['total']);
    
}






 $indice=$indice +2;//14

//formato letra
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
		'A'.$indice.':j'.$indice
);
//fin formato letra
//color y lineas
$objPHPExcel->getActiveSheet()->duplicateStyleArray(
   array('fill'    => array(
                   'type'    => PHPExcel_Style_Fill::FILL_SOLID,
                   'color'   => array('argb' => 'CCCC99FF')),//azul

         'borders' => array(
                   'top'     => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN))
        ),
       // 'A'.$indice.':I'.$indice
       'A'.$indice.':j'.$indice
        );
//fin de color y lineas
//titulo
$objPHPExcel->getActiveSheet()->mergeCells('A'.$indice.':j'.$indice);
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice,"PROCEDENCIA");

$indice=$indice+1;//15

//formato letra titulo
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
		'A'.$indice.':J'.$indice
);
//fin formato letra



//color y lineas
$objPHPExcel->getActiveSheet()->duplicateStyleArray(
   array('fill'    => array(
                   'type'    => PHPExcel_Style_Fill::FILL_SOLID,
                   'color'   => array('argb' => '333366ff')),//azul

         'borders' => array(
                   'top'     => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN))
        ),
       // 'A'.$indice.':I'.$indice
       'A'.$indice.':J'.$indice
        );
//fin de color y lineas

$objPHPExcel->getActiveSheet()->mergeCells('C'.$indice.':D'.$indice);
$objPHPExcel->getActiveSheet()->mergeCells('F'.$indice.':G'.$indice);
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice,"CENSO");
$objPHPExcel->getActiveSheet()->SetCellValue('B'.$indice,"FECHA CENSO");
$objPHPExcel->getActiveSheet()->SetCellValue('C'.$indice,"MUNICIPIO CENSO");
$objPHPExcel->getActiveSheet()->SetCellValue('E'.$indice,"PARROQUIA CENSO");
$objPHPExcel->getActiveSheet()->SetCellValue('F'.$indice,"LUGAR CENSO");
$objPHPExcel->getActiveSheet()->SetCellValue('H'.$indice,"TIPO");
$objPHPExcel->getActiveSheet()->mergeCells('I'.$indice.':J'.$indice);
$objPHPExcel->getActiveSheet()->SetCellValue('I'.$indice,"OBSERVACIONES");



//FIN DE TITULOS

$indice=$indice+1;//16

$data['censos']=$this->Model_consulta->consulta_un_parametro('procedencia_id','asc','vis_procedencia_persona',$personaId,'persona_id');





foreach($data['censos']->result() as $row2){
//***************************************************************
//***************************************************************
//formato letra en blanco  Model_consulta
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
       // 'A'.$indice.':I'.$indice
       'A'.$indice.':J'.$indice
        );
//fin de color y lineas
//***VALORES
$objPHPExcel->getActiveSheet()->mergeCells('C'.$indice.':D'.$indice);
$objPHPExcel->getActiveSheet()->mergeCells('F'.$indice.':G'.$indice);
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice,$row2->procedencia_id);
$objPHPExcel->getActiveSheet()->SetCellValue('B'.$indice,$row2->fecha_procedencia);
$objPHPExcel->getActiveSheet()->SetCellValue('C'.$indice,$row2->nombre_municipio_procedencia);
$objPHPExcel->getActiveSheet()->SetCellValue('E'.$indice,$row2->nombre_parroquia_procedencia);
$objPHPExcel->getActiveSheet()->SetCellValue('F'.$indice,$row2->lugar_procedencia);
$objPHPExcel->getActiveSheet()->SetCellValue('H'.$indice,$row2->nombre_tipo_procedencia);
$objPHPExcel->getActiveSheet()->mergeCells('I'.$indice.':J'.$indice);
$objPHPExcel->getActiveSheet()->SetCellValue('I'.$indice,$row2->observaciones);
//FIN DE VALORES
//**********************************************************************************
//**********************************************************************************
$indice=$indice+1;
}

$indice=$indice+1;


$data['sorteos']=$this->Model_consulta->consulta_un_parametro('sorteo_id','asc','vis_sorteo_persona',$personaId,'persona_id');


if($data['sorteos']->num_rows() > 0){//*********************

//formato letra titulo
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
		'A'.$indice.':J'.$indice
);
//fin formato letra
//color y lineas
$objPHPExcel->getActiveSheet()->duplicateStyleArray(
   array('fill'    => array(
                   'type'    => PHPExcel_Style_Fill::FILL_SOLID,
                   'color'   => array('argb' => 'FFFFFF99')),

         'borders' => array(
                   'top'     => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN))
        ),
       // 'A'.$indice.':I'.$indice
       'A'.$indice.':J'.$indice
        );
//fin de color y lineas

//titulo
$objPHPExcel->getActiveSheet()->mergeCells('A'.$indice.':J'.$indice);
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice,"SORTEO");
//FIN DE TITULO


$indice=$indice+1;


//formato letra titulo
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
		'A'.$indice.':J'.$indice
);
//fin formato letra
//color y lineas
$objPHPExcel->getActiveSheet()->duplicateStyleArray(
   array('fill'    => array(
                   'type'    => PHPExcel_Style_Fill::FILL_SOLID,
                   'color'   => array('argb' => '333366FF')),

         'borders' => array(
                   'top'     => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN))
        ),
       // 'A'.$indice.':I'.$indice
       'A'.$indice.':J'.$indice
        );
//fin de color y lineas
$objPHPExcel->getActiveSheet()->mergeCells('C'.$indice.':D'.$indice);
$objPHPExcel->getActiveSheet()->mergeCells('F'.$indice.':G'.$indice);
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice,"SORTEO");
$objPHPExcel->getActiveSheet()->SetCellValue('B'.$indice,"FECHA SORTEO");
$objPHPExcel->getActiveSheet()->SetCellValue('C'.$indice,"MUNICIPIO SORTEO");
$objPHPExcel->getActiveSheet()->SetCellValue('E'.$indice,"PARROQUIA SORTEO");
$objPHPExcel->getActiveSheet()->SetCellValue('F'.$indice,"LUGAR SORTEO");
//$objPHPExcel->getActiveSheet()->SetCellValue('H'.$indice,"INSTITUTO");
$objPHPExcel->getActiveSheet()->mergeCells('H'.$indice.':I'.$indice);
$objPHPExcel->getActiveSheet()->SetCellValue('H'.$indice,"CARRERA");
$objPHPExcel->getActiveSheet()->SetCellValue('J'.$indice,"CODIGO CARTA");
//FIN DE TITULOS
$indice=$indice+1;



foreach($data['sorteos']->result() as $row3){
//VALORES

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

$objPHPExcel->getActiveSheet()->mergeCells('C'.$indice.':D'.$indice);
$objPHPExcel->getActiveSheet()->mergeCells('F'.$indice.':G'.$indice);
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice,$row3->sorteo_id);
$objPHPExcel->getActiveSheet()->SetCellValue('B'.$indice,$row3->fecha_sorteo);
$objPHPExcel->getActiveSheet()->SetCellValue('C'.$indice,$row3->nombre_municipio);
$objPHPExcel->getActiveSheet()->SetCellValue('E'.$indice,$row3->nombre_parroquia);
$objPHPExcel->getActiveSheet()->SetCellValue('F'.$indice,$row3->lugar_sorteo);
//$objPHPExcel->getActiveSheet()->SetCellValue('H'.$indice,'instituto');
$objPHPExcel->getActiveSheet()->mergeCells('H'.$indice.':I'.$indice);
$objPHPExcel->getActiveSheet()->SetCellValue('H'.$indice,$row3->carrera);
$objPHPExcel->getActiveSheet()->SetCellValue('J'.$indice,$row3->codigo_carta_postulacion);

//VALORES

$indice=$indice+1;
}
}else{



}
$indice=$indice+1;


$becas    = $this->db->query('select * from vis_beca_persona where persona_id= '.$personaId.'');
if ($becas->num_rows() > 0){
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
		'A'.$indice.':C'.$indice
);
//fin formato letra
//color y lineas
$objPHPExcel->getActiveSheet()->duplicateStyleArray(
   array('fill'    => array(
                   'type'    => PHPExcel_Style_Fill::FILL_SOLID,
                   'color'   => array('argb' => 'FFFFFF99')),

         'borders' => array(
                   'top'     => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN))
        ),
       // 'A'.$indice.':I'.$indice
       'A'.$indice.':C'.$indice
        );
//fin de color y lineas



$objPHPExcel->getActiveSheet()->mergeCells('A'.$indice.':C'.$indice);
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice,'HISTORICO DE BENEFICIOS');
$indice=$indice+1;

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
		'A'.$indice.':D'.$indice
);
//fin formato letra
//color y lineas
$objPHPExcel->getActiveSheet()->duplicateStyleArray(
   array('fill'    => array(
                   'type'    => PHPExcel_Style_Fill::FILL_SOLID,
                   'color'   => array('argb' => '333366ff')),

         'borders' => array(
                   'top'     => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN))
        ),
       // 'A'.$indice.':I'.$indice
       'A'.$indice.':D'.$indice
        );
//fin de color y lineas



$objPHPExcel->getActiveSheet()->mergeCells('C'.$indice.':D'.$indice);
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice,'FECHA');
$objPHPExcel->getActiveSheet()->SetCellValue('B'.$indice,'TIPO BECA');
$objPHPExcel->getActiveSheet()->SetCellValue('C'.$indice,'BECA');
$indice=$indice+1;
foreach($becas->result() as $row5){

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
		'A'.$indice.':D'.$indice
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

       'A'.$indice.':D'.$indice
        );
//fin de color y lineas

$objPHPExcel->getActiveSheet()->mergeCells('C'.$indice.':D'.$indice);
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice,$row5->fecha_ingreso);
$objPHPExcel->getActiveSheet()->SetCellValue('B'.$indice,$row5->nombre_tipo_beca);
$objPHPExcel->getActiveSheet()->SetCellValue('C'.$indice,$row5->nombre_beca);
$indice=$indice+1;

}



}else{

    
}
//************AQUI





$data['accion']=$this->Model_consulta->consulta_un_parametro('accion_beca_id','asc','vis_accion_beneficiario',$row->beca_persona_id,'beca_persona_id');






//formato letra titulo
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
		'A'.$indice.':G'.$indice
);
//fin formato letra
//color y lineas
$objPHPExcel->getActiveSheet()->duplicateStyleArray(
   array('fill'    => array(
                   'type'    => PHPExcel_Style_Fill::FILL_SOLID,
                   'color'   => array('argb' => 'CCCCFFFF')),//azul

         'borders' => array(
                   'top'     => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN))
        ),
       // 'A'.$indice.':I'.$indice
       'A'.$indice.':G'.$indice
        );
//fin de color y lineas
//inicio titulo
$objPHPExcel->getActiveSheet()->mergeCells('A'.$indice.':G'.$indice);
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice,"INFORMACIÓN HISTÓRICA");
//****

$indice=$indice+1;
//formato letra titulo
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
		'A'.$indice.':G'.$indice
);
//fin formato letra
//color y lineas
$objPHPExcel->getActiveSheet()->duplicateStyleArray(
   array('fill'    => array(
                   'type'    => PHPExcel_Style_Fill::FILL_SOLID,
                   'color'   => array('argb' => '333366FF')),//azul

         'borders' => array(
                   'top'     => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN))
        ),
       // 'A'.$indice.':I'.$indice
       'A'.$indice.':G'.$indice
        );
//fin de color y lineas



$objPHPExcel->getActiveSheet()->mergeCells('A'.$indice.':B'.$indice);
$objPHPExcel->getActiveSheet()->mergeCells('E'.$indice.':G'.$indice);
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice,"ACCIÓN");
$objPHPExcel->getActiveSheet()->SetCellValue('C'.$indice,"FECHA");
$objPHPExcel->getActiveSheet()->SetCellValue('D'.$indice,"PERIODO");
$objPHPExcel->getActiveSheet()->SetCellValue('E'.$indice,"RAZON");
//fin titulo


$indice=$indice+1;

foreach($data['accion']->result() as $row4){
//************************************************
//************************************************
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
		'A'.$indice.':G'.$indice
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
       // 'A'.$indice.':I'.$indice
       'A'.$indice.':G'.$indice
        );
//fin de color y lineas
//VALORES
$objPHPExcel->getActiveSheet()->mergeCells('A'.$indice.':B'.$indice);
$objPHPExcel->getActiveSheet()->mergeCells('E'.$indice.':G'.$indice);
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice,$row4->nombre_accion);
$objPHPExcel->getActiveSheet()->SetCellValue('C'.$indice,$row4->fecha_accion);
$objPHPExcel->getActiveSheet()->SetCellValue('D'.$indice,$row4->periodo);
$objPHPExcel->getActiveSheet()->SetCellValue('E'.$indice,$row4->razon_accion);
//FIN VALORES
$indice=$indice+1;
}

$indice=$indice+1;


//formato letra titulo
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
		'A'.$indice.':E'.$indice
);
//fin formato letra
//color y lineas
$objPHPExcel->getActiveSheet()->duplicateStyleArray(
   array('fill'    => array(
                   'type'    => PHPExcel_Style_Fill::FILL_SOLID,
                   'color'   => array('argb' => '0000FFFF')),//azul

         'borders' => array(
                   'top'     => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN))
        ),
       // 'A'.$indice.':I'.$indice
       'A'.$indice.':E'.$indice
        );
//fin de color y lineas
//TITULOS
$objPHPExcel->getActiveSheet()->mergeCells('A'.$indice.':E'.$indice);
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice,"INFORMACIÓN ACADÉMICA");
//***

$indice=$indice+1;

$data['jel']=$this->Model_consulta->consulta_un_parametro('beca_persona_id','asc','vis_beneficiario_jel',$row->beca_persona_id,'beca_persona_id');



foreach($data['jel']->result() as $row5){
//formato letra titulo
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
		'A'.$indice.':E'.$indice
);
//fin formato letra
//color y lineas
$objPHPExcel->getActiveSheet()->duplicateStyleArray(
   array('fill'    => array(
                   'type'    => PHPExcel_Style_Fill::FILL_SOLID,
                   'color'   => array('argb' => '333366FF')),//azul

         'borders' => array(
                   'top'     => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN))
        ),
       // 'A'.$indice.':I'.$indice
       'A'.$indice.':E'.$indice
        );
//fin de color y lineas


//***
$objPHPExcel->getActiveSheet()->mergeCells('B'.$indice.':D'.$indice);
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice,"INSTITUTO");
$objPHPExcel->getActiveSheet()->SetCellValue('B'.$indice,"CARRERA");
$objPHPExcel->getActiveSheet()->SetCellValue('E'.$indice,"PERIODO");
//$objPHPExcel->getActiveSheet()->SetCellValue('F'.$indice,"BECA PROMEDIO");
//FIN DE TITULOS
$indice=$indice+1;
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
		'A'.$indice.':E'.$indice
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
       // 'A'.$indice.':I'.$indice
       'A'.$indice.':E'.$indice
        );
//fin de color y lineas

//VALORES
$objPHPExcel->getActiveSheet()->mergeCells('B'.$indice.':D'.$indice);
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice,$row5->siglas_instituto);
$objPHPExcel->getActiveSheet()->SetCellValue('B'.$indice,$row5->nombre_carrera);
$objPHPExcel->getActiveSheet()->SetCellValue('E'.$indice,$row5->ano_periodo.$row5->parcial_periodo);
//$objPHPExcel->getActiveSheet()->SetCellValue('F'.$indice,"NO");  //-************TE FALTA DECIRLE SI ES BECA PROMEDIO
//FIN VALORES
$indice=$indice+2;

//formato letra titulo
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
		'A'.$indice.':F'.$indice
);
//fin formato letra
//color y lineas
$objPHPExcel->getActiveSheet()->duplicateStyleArray(
   array('fill'    => array(
                   'type'    => PHPExcel_Style_Fill::FILL_SOLID,
                   'color'   => array('argb' => '333366FF')),//azul

         'borders' => array(
                   'top'     => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN))
        ),
       // 'A'.$indice.':I'.$indice
       'A'.$indice.':F'.$indice
        );
//fin de color y lineas
//TITULOS
$objPHPExcel->getActiveSheet()->mergeCells('D'.$indice.':E'.$indice);
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice,"MATERIA CURSADA");
$objPHPExcel->getActiveSheet()->SetCellValue('B'.$indice,"M. APROBADA");
$objPHPExcel->getActiveSheet()->SetCellValue('C'.$indice,"NOTA");
$objPHPExcel->getActiveSheet()->SetCellValue('D'.$indice,"UNIDADES DE CRÉDITO");
$objPHPExcel->getActiveSheet()->SetCellValue('F'.$indice,"SEMESTRE/TRIMESTRE");
//FIN DE TITULOS
$indice=$indice+1;

//*************totales de materias
$data['materias']=$this->Model_consulta->consulta_un_parametro('ano_periodo','asc','vis_materia_becado',$row5->beca_jel_id,'beca_jel_id');
$data['materias_aprobadas']=$this->reportesModel->materias_aprobadas('vis_materia_becado',$row5->beca_jel_id,'beca_jel_id');
$total_materias          = $data['materias']->num_rows();
$totla_materias_apdas    = $data['materias_aprobadas']->num_rows();
$total_materias_rep      = $total_materias - $totla_materias_apdas;
//*************fin totales de materias

foreach($data['materias']->result() as $row6){


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
		'A'.$indice.':F'.$indice
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
       // 'A'.$indice.':I'.$indice
       'A'.$indice.':F'.$indice
        );
//fin de color y lineas


//valores
$objPHPExcel->getActiveSheet()->mergeCells('D'.$indice.':E'.$indice);
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice,$row6->nombre_materia);
$objPHPExcel->getActiveSheet()->SetCellValue('B'.$indice,$row6->nombre_estado_materia);
$objPHPExcel->getActiveSheet()->SetCellValue('C'.$indice,$row6->nota_materia);
$objPHPExcel->getActiveSheet()->SetCellValue('D'.$indice,$row6->cantidad_unidad_credito);
$objPHPExcel->getActiveSheet()->SetCellValue('F'.$indice,$row6->ano_periodo.$row6->parcial_periodo);
//FIN valores
$indice=$indice+1;
}

$indice2=$indice+2;
//formato letra titulo
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

		'A'.$indice.':B'.$indice2
);

//color y lineas
$objPHPExcel->getActiveSheet()->duplicateStyleArray(
   array('fill'    => array(
                   'type'    => PHPExcel_Style_Fill::FILL_SOLID,
                   'color'   => array('argb' => 'CCCCFFFF')),//azul

         'borders' => array(
                   'top'     => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN))
        ),
   
       'A'.$indice.':B'.$indice2
        );
//fin de color y lineas

//totales
$objPHPExcel->getActiveSheet()->mergeCells('A'.$indice.':B'.$indice);
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice,"TOTAL MATERIAS CURSADAS: ".$total_materias);

$indice=$indice+1;
$objPHPExcel->getActiveSheet()->mergeCells('A'.$indice.':B'.$indice);
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice,"TOTAL MATERIAS APROBADAS: ".$totla_materias_apdas);

$indice=$indice+1;
$objPHPExcel->getActiveSheet()->mergeCells('A'.$indice.':B'.$indice);
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice,"TOTAL MATERIAS REPROBADAS: ".$total_materias_rep);
//fin totales





$indice=$indice+1;
}

$indice=$indice+1;

//PARA obtener el id de la madre soltera
 $qq =  $this->db->query('select * from configuracion');
 $fila_cm = $qq->row_array();


$madre= $this->db->query('select * from vis_beca_persona where beca_id = '.$fila_cm['beca_id_madre_soltera'].' and persona_id = '.$personaId );
$fila_m = $madre->row_array();


if ($madre->num_rows() > 0){

//formato letra titulo
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
		'A'.$indice.':D'.$indice
);
//fin formato letra
//color y lineas
$objPHPExcel->getActiveSheet()->duplicateStyleArray(
   array('fill'    => array(
                   'type'    => PHPExcel_Style_Fill::FILL_SOLID,
                   'color'   => array('argb' => 'CCCC99FF')),//azul

         'borders' => array(
                   'top'     => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN))
        ),
       // 'A'.$indice.':I'.$indice
       'A'.$indice.':D'.$indice
        );
//fin de color y lineas
//TITULOS
$objPHPExcel->getActiveSheet()->mergeCells('A'.$indice.':D'.$indice);
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice,"MADRE SOLTERA");
//FIN TITULO





$indice=$indice+1;
//formato letra titulo
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
		'A'.$indice.':E'.$indice
);
//fin formato letra
//color y lineas
$objPHPExcel->getActiveSheet()->duplicateStyleArray(
   array('fill'    => array(
                   'type'    => PHPExcel_Style_Fill::FILL_SOLID,
                   'color'   => array('argb' => '333366FF')),//azul

         'borders' => array(
                   'top'     => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN))
        ),
       
       'A'.$indice.':E'.$indice
        );
//fin de color y lineas


//INICIO DE TITULOS
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice,"PERIODO");
$objPHPExcel->getActiveSheet()->SetCellValue('B'.$indice,"NUMERO DE HIJOS");
$objPHPExcel->getActiveSheet()->mergeCells('C'.$indice.':E'.$indice);
$objPHPExcel->getActiveSheet()->SetCellValue('C'.$indice,"OBSERVACIONES");
//FIN DE TITULOS

$indice=$indice+1;
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
		'A'.$indice.':E'.$indice
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
       // 'A'.$indice.':I'.$indice
       'A'.$indice.':E'.$indice
        );
//fin de color y lineas
//VALORES
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice,$fila_m['ano_periodo'].$fila_m['parcial_periodo']);
$objPHPExcel->getActiveSheet()->SetCellValue('B'.$indice,$fila_m['numero_hijo']);
$objPHPExcel->getActiveSheet()->mergeCells('C'.$indice.':E'.$indice);
$objPHPExcel->getActiveSheet()->SetCellValue('C'.$indice,$fila_m['observaciones']);
//VALORES
}else{


$indice=$indice+1;
    

}





$indice=$indice+2;
}//fin del fore persona
//*******************************************************************************
$objPHPExcel->getActiveSheet()->setTitle('Reporte Historico Beneficiario');

$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
//$objWriter->save(str_replace('.php', '.xls', _FILE_));
$arv = time();
$objWriter->save('Reportes/histbene'.$arv.'.XLS');
//fin de titulo del reporte
//*******************************************************************************






//****************************
//FIN DEL EXCEL
//****************************

$data['archivo']   ='histbene'.$arv.'.xls';
$data['rept']      ='Reporte Historico de Beneficiario';


$centinela = new Centinela();
$menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
$data['menu']               = $this->load->view('vis_menu',$menu_final,true);



$this->load->view('vis',$data);


   
}






}

?>
