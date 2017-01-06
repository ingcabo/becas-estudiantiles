<?php

class con_rep_sorteo extends Controller
{

     function con_rep_sorteo() {

             parent::Controller();
             $this -> load ->database();
             $this -> load ->model('Model_consulta','',TRUE);
             $this -> load ->helper(array('form', 'url'));
             $this -> load ->library('JELGeneral');
             $this -> load ->model('reportesModel');
             $this -> load ->library('xajax');
             $this -> load ->library('mylib_base');
             
             $this -> xajax ->registerFunction(array('obtieneParroquia_sorteo', &$this, 'obtieneParroquia_sorteo'));
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
        $data['q_car_inst']   = $this -> Model_consulta -> consulta_combo_p('carrera','ASC','vis_carrera_solicitada');



        $this->load->view('reporte/vis_rep_sorteo',$data);
        }


           function obtieneParroquia_sorteo($controles){

        $respuesta = new xajaxResponse(); //Creamos el objeto xajax
		$inputDestino = "capa_parroquia_sorteo"; //indicamos el ID del tag HTML de destino. en este caso el DIV que contiene el selector
		$propiedadInputDestino = "innerHTML"; //indicamos la propiedad que deseamos que se modifique. Colocaremos el selector dentro del DIV
		$valorAAsignar   = ""; //indicamos el nuevo valor que este tendrá. Cadena HTML
        $condicion       = "";

        if(!isset($controles['municipio_sorteo'])){
                       $condicion='0,';
        }else{
                       foreach($controles['municipio_sorteo'] as $key => $value){
                           $condicion.=$value.',';
                       }
              }


       $condicion  = substr ($condicion, 0, strlen($condicion) -1);
       $consulta   = $this->db->query('select * from vis_parroquia where municipio_id in ('.$condicion.') order by nombre_parroquia');

        if ($consulta->num_rows() > 0){

                         foreach ($consulta -> result() as $row){

                                $data = array(
                                'name'     => 'parroquia_sorteo[]',
                                'id'       => 'parroquia_sorteo',
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
                               $valorAAsignar .=  '<font size="2" face="Geneva, Arial, Helvetica, sans-serif">'.form_checkbox($data).$row->nombre_carrera.'</font><br>';
                               $respuesta -> Assign($inputDestino, $propiedadInputDestino, $valorAAsignar);
                            }

         }else{
                 $valorAAsignar ="";
                 $respuesta -> Assign($inputDestino, $propiedadInputDestino, $valorAAsignar);
               }
         return $respuesta;

         }






function const_sorteos(){


$valores_municipio_sorteo    ="";
$valores_parroquia_sorteo    ="";
$valores_municipio_habitad   ="";
$valores_parroquia_habitad   ="";
$valores_instituto           ="";
$valores_carrera             ="";








 //inicio parametros a consultar sorteo
 //********************************************

 if(isset($_POST['municipio_sorteo'])){
 $andm= ' and ';
 foreach($_POST['municipio_sorteo'] as $key => $value){
                            $valores_municipio_sorteo.=$value.',';

                       }

$valores_municipio_sorteo = substr ($valores_municipio_sorteo, 0, strlen($valores_municipio_sorteo) -1);
$sql_ms= ' municipio_id in ('.$valores_municipio_sorteo.') ';
}else{
      $andm  = '';
      $sql_ms= '';
     }


 if(isset($_POST['parroquia_sorteo'])){
 foreach($_POST['parroquia_sorteo'] as $key => $value){
                             $valores_parroquia_sorteo.=$value.',';


                       }
$valores_parroquia_sorteo = substr ($valores_parroquia_sorteo, 0, strlen($valores_parroquia_sorteo) -1);
$sql_ps=  $andm.'  parroquia_id in ('.$valores_parroquia_sorteo.') and ';
}else{
      $sql_ps= '';
     }

//*****************************************
$lugar           = $_POST['lugar'];
$criterio_lugar  = 0;
if(isset($_POST['fecha']) and $_POST['fecha'] <> ''){
$fecha           = $this->mylib_base->human_to_pg($_POST['fecha']);
}else{
  $fecha = '';
}
$criterio_fecha  = $_POST['sfecha'];
 //fin parametros a consultar sorteo


//inicio parametros a consultar sorteados
//********************************************

 if(isset($_POST['municipio_habitad'])){

 foreach($_POST['municipio_habitad'] as $key => $value){
                             $valores_municipio_habitad.=$value.',';
                       }
$valores_municipio_habitad = substr ($valores_municipio_habitad, 0, strlen($valores_municipio_habitad) -1);
$sql_mh= ' municipio_id in ('.$valores_municipio_habitad.') and ';

}else{
     
      $sql_mh = '';
     }


 if(isset($_POST['parroquia_habitad'])){
 foreach($_POST['parroquia_habitad'] as $key => $value){
                             $valores_parroquia_habitad.=$value.',';
                       }
$valores_parroquia_habitad = substr ($valores_parroquia_habitad, 0, strlen($valores_parroquia_habitad) -1);
$sql_ph= '  parroquia_id in ('.$valores_parroquia_habitad.')  and ';
}else{
$sql_ph = '';
     }


// if(isset($_POST['instituto'])){
//
// foreach($_POST['instituto'] as $key => $value){
//                             $valores_instituto.=$value.',';
//                       }
//$valores_instituto = substr ($valores_instituto, 0, strlen($valores_instituto) -1);
//$sql_i= '  instituto_id in ('.$valores_instituto.') and ';
//}else{
//
//
//      $sql_i = '';
//
//     }
 $sql_i = '';

 if(isset($_POST['carrera'])){
 foreach($_POST['carrera'] as $key => $value){
                           
                            // $valores_carrera.='LIKE \'%\' || \''.strtoupper($value).'\' || \'%\' or ';
                              $valores_carrera.=' upper(carrera) LIKE \'%'.strtoupper($value).'%\' or ';
                             
                       }
$valores_carrera = substr ($valores_carrera, 0, strlen($valores_carrera) -3);
$sql_c=  '( '.$valores_carrera. ') and ' ;
}else{
$sql_c=' carrera = -1 and ';
     }

//*******************************
$nombre   ='';
$apellido ='';
$carta    ='';
$cedula   ='';
$numero   ='';
$apellido ='';

$criterio_nombre  = $_POST['snombre'];
if(isset($_POST['nombre']) && $_POST['nombre'] <> ''){

    $nombre =  $_POST['nombre'];
}

$criterio_pellido  = $_POST['sapellido'];
if(isset($_POST['apellido']) && $_POST['apellido'] <> ''){

    $apellido =  $_POST['apellido'];
}

$criterio_carta  = 0;
if(isset($_POST['carta']) && $_POST['carta'] <> ''){

    $carta =  $_POST['carta'];
}

$criterio_cedula  = $_POST['scedula'];
if(isset($_POST['cedula']) && $_POST['cedula'] <> ''){

    $cedula =  $_POST['cedula'];
}

if(isset($_POST['ssexo']) && $_POST['ssexo'] <> 'T' ){

    $criterio_sexo = 1;
    $sexo = $_POST['ssexo'];
}else{

    $criterio_sexo = '';
    $sexo = '';
}

if(isset($_POST['sapto']) && $_POST['sapto'] <> 'T' ){

    $criterio_apto = 1;
    $apto = $_POST['sapto'];
}else{

    $criterio_apto = '';
    $apto = '';
}

$criterio_numero  = $_POST['snumero'];
if(isset($_POST['numero']) && $_POST['numero'] <> ''){

    $numero =  $_POST['numero'];
}


//*************************************
// fin parametros a consultar sorteados

//$data['q_sorteados']=$this->reportesModel->getAllsorteados($criterio_nombre,$nombre,$criterio_pellido,$apellido,$criterio_carta,$carta,$criterio_cedula,$cedula,$criterio_sexo,$sexo,$criterio_apto,$apto,$criterio_numero,$numero,$sql_mh,$sql_ph,$sql_i,$sql_c);









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
$objPHPExcel->getActiveSheet()->getRowDimension(1)->setRowHeight(15);
$objPHPExcel->getActiveSheet()->getRowDimension(2)->setRowHeight(15);
$objPHPExcel->getActiveSheet()->getRowDimension(3)->setRowHeight(15);
$objPHPExcel->getActiveSheet()->getRowDimension(4)->setRowHeight(15);
$objPHPExcel->getActiveSheet()->getRowDimension(5)->setRowHeight(15);

$objPHPExcel->getActiveSheet()->mergeCells('A1:I1');
$objPHPExcel->getActiveSheet()->mergeCells('A2:I2');
$objPHPExcel->getActiveSheet()->mergeCells('A3:I3');
$objPHPExcel->getActiveSheet()->mergeCells('A4:I4');
$objPHPExcel->getActiveSheet()->mergeCells('A5:I5');
$objPHPExcel->getActiveSheet()->mergeCells('A6:I6');



//$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, 10, 'Some value'); el valor de la columna por cordenadas X y Y

// Set column width dimensiones anchura de la filas no tocar o te jodo
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(13);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(0);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(26);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(6);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(12);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(14);


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
         $logogov->setOffsetX(5);
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

         $logojel->setCoordinates('H2');
         $logojel->setOffsetX(7);

//*******************************************************


// Add some data
$data['c'] = date('H:i:s') . " Add some data\n"."<br>";
$objPHPExcel->setActiveSheetIndex(0);


//formato titulo del reporte

$objPHPExcel->getActiveSheet()->duplicateStyleArray(
		array(
'font'      => array(
'name'      => 'ARIAL',
'bold'      => true,
'italic'    => false,
'size'      => 11
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


//titulo reporte
$objPHPExcel->getActiveSheet()->SetCellValue('A2',"GOBERNACIÓN DEL ESTADO ZULIA");
$objPHPExcel->getActiveSheet()->SetCellValue('A3',"FUNDACIÓN JESUS ENRIQUE LOSSADA");
$objPHPExcel->getActiveSheet()->SetCellValue('A5',"REPORTE DE SORTEOS");




 //consulta sorteos
$data['q_sorteo']=$this->reportesModel->getAllsorteo($criterio_fecha,$fecha,$criterio_lugar,$lugar,$sql_ms,$sql_ps);
//fin consulta sorteo
$sorteo = $data['q_sorteo']->num_rows();

//aqui foreach sorteos

$indice = 7;
foreach($data['q_sorteo']->result() as $row){



//FORMATO TITULO DE LOS SORTEOS
$objPHPExcel->getActiveSheet()->getRowDimension($indice)->setRowHeight(12);
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

),
		'A'.$indice.':L'.$indice
);
//******************color titulos

//color de fondo
$objPHPExcel->getActiveSheet()->duplicateStyleArray(
   array('fill'    => array(
                   'type'    => PHPExcel_Style_Fill::FILL_SOLID,
                   'color'   => array('argb' => 'FFFFBE00')),
         'borders' => array(
                   'top'     => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN))
        ),
        'A'.$indice.':I'.$indice
        );
 // fin color de fondo

//fin color titulos
//TITULO DE LOS SORTEOS
$objPHPExcel->getActiveSheet()->mergeCells('C'.$indice.':E'.$indice);
$objPHPExcel->getActiveSheet()->mergeCells('G'.$indice.':I'.$indice);

$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice,"# SORTEO");
$objPHPExcel->getActiveSheet()->SetCellValue('B'.$indice,"FECHA SORTEO");
$objPHPExcel->getActiveSheet()->SetCellValue('C'.$indice,"MUNICIPIO SORTEO");
$objPHPExcel->getActiveSheet()->SetCellValue('F'.$indice,"PARROQUIA SORTEO");
$objPHPExcel->getActiveSheet()->SetCellValue('G'.$indice,"LUGAR DEL SORTEO");

$indice_prima = $indice + 1;
//FORMATO DESCRIPCION SORTEOS
$objPHPExcel->getActiveSheet()->getRowDimension($indice_prima)->setRowHeight(12);
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
),

),





          'A'.$indice_prima.':L'.$indice_prima
);

//DESCRIPCION SORTEOS valores de sorteos
$objPHPExcel->getActiveSheet()->mergeCells('C'.$indice_prima.':E'.$indice_prima);
$objPHPExcel->getActiveSheet()->mergeCells('G'.$indice_prima.':I'.$indice_prima);
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice_prima,$row->sorteo_id);
$objPHPExcel->getActiveSheet()->SetCellValue('B'.$indice_prima,$row->fecha_sorteo);
$objPHPExcel->getActiveSheet()->SetCellValue('C'.$indice_prima,$row->nombre_municipio);
$objPHPExcel->getActiveSheet()->SetCellValue('F'.$indice_prima,$row->nombre_parroquia);
$objPHPExcel->getActiveSheet()->SetCellValue('G'.$indice_prima,$row->lugar_sorteo);






$indice_prima_2= $indice_prima +1;

$data['q_sorteados']=$this->reportesModel->getAllsorteados($criterio_nombre,$nombre,$criterio_pellido,$apellido,$criterio_carta,$carta,$criterio_cedula,$cedula,$criterio_sexo,$sexo,$criterio_apto,$apto,$criterio_numero,$numero,$sql_mh,$sql_ph,$sql_i,$sql_c,$row->sorteo_id);
$sorteados = $data['q_sorteados']->num_rows();

if($data['q_sorteados']->num_rows() > 0){

if(isset($_POST['detalle'])){//******************


//FORMATO TITULO DE LOS SORTEADOS
$objPHPExcel->getActiveSheet()->getRowDimension($indice_prima_2)->setRowHeight(12);
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
		'A'.$indice_prima_2.':H'.$indice_prima_2
);
//*****************

//color de fondo
$objPHPExcel->getActiveSheet()->duplicateStyleArray(
   array('fill'    => array(
                   'type'    => PHPExcel_Style_Fill::FILL_SOLID,
                   'color'   => array('argb' => 'FF0073E6')),
         'borders' => array(
                   'top'     => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN))
        ),
        'A'.$indice_prima_2.':H'.$indice_prima_2
        );
 // fin color de fondo
//FFCCFFCC



//TITULOS SORTEADOS
$objPHPExcel->getActiveSheet()->mergeCells('G'.$indice_prima_2.':H'.$indice_prima_2);
$objPHPExcel->getActiveSheet()->mergeCells('A'.$indice_prima_2.':B'.$indice_prima_2);
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice_prima_2,"NOMBRE");
$objPHPExcel->getActiveSheet()->SetCellValue('C'.$indice_prima_2,"CÉDULA");
$objPHPExcel->getActiveSheet()->SetCellValue('D'.$indice_prima_2,"SEXO");
$objPHPExcel->getActiveSheet()->SetCellValue('E'.$indice_prima_2," ");
$objPHPExcel->getActiveSheet()->SetCellValue('F'.$indice_prima_2,"CARRERA");
$objPHPExcel->getActiveSheet()->SetCellValue('G'.$indice_prima_2,"CODIGO CARTA");
/*
$objPHPExcel->getActiveSheet()->SetCellValue('H'.$indice_prima_2,"FILTRO");
$objPHPExcel->getActiveSheet()->SetCellValue('I'.$indice_prima_2,"PROCEDENCIA");
$objPHPExcel->getActiveSheet()->SetCellValue('J'.$indice_prima_2,"PARTCIPACIONES EN SORTEOS");
$objPHPExcel->getActiveSheet()->SetCellValue('K'.$indice_prima_2,"OBSERVACIONES");
*/



 //consulta sorteos
 


 //$sorteados = $data['q_sorteados']->row();
//fin consulta sorteo

$indice_prima_3= $indice_prima_2 +1;

foreach($data['q_sorteados']->result() as $row2){

//FORMATO DESCRIPCION SORTEADOS valores de los sorteados
$objPHPExcel->getActiveSheet()->getRowDimension($indice_prima_3)->setRowHeight(12);
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
		'A'.$indice_prima_3.':H'.$indice_prima_3
);

//*************************************************************
//color de fondo

$objPHPExcel->getActiveSheet()->duplicateStyleArray(
   array('fill'    => array(
                   'type'    => PHPExcel_Style_Fill::FILL_SOLID),
                  
         'borders' => array(
                   'top'     => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN))
        ),
        'A'.$indice_prima_3.':H'.$indice_prima_3
        );
 // fin color de fondo
//*************************************************************
//INFORMACION SORTEADAS VALORES DE PERSONAS SORTEADAS
$objPHPExcel->getActiveSheet()->mergeCells('G'.$indice_prima_3.':H'.$indice_prima_3);
$objPHPExcel->getActiveSheet()->mergeCells('A'.$indice_prima_3.':B'.$indice_prima_3);
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice_prima_3,$row2->nombre_persona.' '.$row2->apellido_persona);
$objPHPExcel->getActiveSheet()->SetCellValue('C'.$indice_prima_3,$row2->cedula_persona);
$objPHPExcel->getActiveSheet()->SetCellValue('D'.$indice_prima_3,$row2->sexo_persona);
$objPHPExcel->getActiveSheet()->SetCellValue('E'.$indice_prima_3,'');

if($row2->carrera == -1){
    $carrera='';
}else{
    $carrera=$row2->carrera;
}

$objPHPExcel->getActiveSheet()->SetCellValue('F'.$indice_prima_3,$carrera);
$objPHPExcel->getActiveSheet()->SetCellValue('G'.$indice_prima_3,$row2->codigo_carta_postulacion);
/*
$objPHPExcel->getActiveSheet()->SetCellValue('H'.$indice_prima_3,"NO APLICA");
$objPHPExcel->getActiveSheet()->SetCellValue('I'.$indice_prima_3,"EQUIVALENCIA");
$objPHPExcel->getActiveSheet()->SetCellValue('J'.$indice_prima_3,"5");
$objPHPExcel->getActiveSheet()->SetCellValue('K'.$indice_prima_3,"NO APLICA");
*/
$indice_prima_3= $indice_prima_3 +1;
    }// end foreach sorteados

$indice_prima_4 = $indice_prima_3 +0;


}else{

    
$indice_prima_4 = $indice_prima +0;
// $data['q_sorteados']=$this->reportesModel->getAllsorteados($criterio_nombre,$nombre,$criterio_pellido,$apellido,$criterio_carta,$carta,$criterio_cedula,$cedula,$criterio_sexo,$sexo,$criterio_apto,$apto,$criterio_numero,$numero,$sql_mh,$sql_ph,$sql_i,$sql_c,$row->sorteo_id);

 //$sorteados = $data['q_sorteados']->num_rows();
}



//TOTAL DETALLE SORTEADOS

//color de fondo
$objPHPExcel->getActiveSheet()->duplicateStyleArray(
   array('fill'    => array(
                   'type'    => PHPExcel_Style_Fill::FILL_SOLID,
                   'color'   => array('argb' => '#CCFF00')),
         'borders' => array(
                   'top'     => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN))
        ),
        'A'.$indice_prima_4.':E'.$indice_prima_4
        );
 // fin color de fondo

//******************
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
		'A'.$indice_prima_4.':E'.$indice_prima_4
);



$objPHPExcel->getActiveSheet()->mergeCells('A'.$indice_prima_4.':E'.$indice_prima_4);
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice_prima_4,'TOTAL SORTEO '.$row->sorteo_id.':'.$sorteados.'');

   

    $indice= $indice_prima_4 + 3;

    }else{

    $indice=$indice_prima_2;
    }

}//end foreach sorteo


$indice_total = $indice+1;

//TOTAL GENERAL
//color de fondo
$objPHPExcel->getActiveSheet()->duplicateStyleArray(
   array('fill'    => array(
                   'type'    => PHPExcel_Style_Fill::FILL_SOLID,
                   'color'   => array('argb' => 'FFCCFFCC')),
         'borders' => array(
                   'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN))
        ),
        'A'.$indice_total.':E'.$indice_total
        );
 // fin color de fondo
//TOTAL DETALLE SORTEADOS
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
		'A'.$indice_total.':E'.$indice_total
);



$objPHPExcel->getActiveSheet()->mergeCells('A'.$indice_total.':E'.$indice_total);
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice_total,'TOTAL SORTEO : '.$sorteo);









// Rename sheet
//echo date('H:i:s') . " Rename sheet\n"."Ruta donde no se como mostralo C:\web\JEL\Reportes";
$objPHPExcel->getActiveSheet()->setTitle('Reporte Sorteos');


$arv= time();
$data['archivo']='sorteos'.$arv.'.xls';
// Save Excel 2003 file

$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
//$objWriter->save(str_replace('.php', '.xls', _FILE_));
$objWriter->save('Reportes/sorteos'.$arv.'.XLS');

$data['rept']= 'reporte sorteos';

$centinela = new Centinela();
$menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
$data['menu']               = $this->load->view('vis_menu',$menu_final,true);

$this->load->view('vis',$data);
}




}
?>