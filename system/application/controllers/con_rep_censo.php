<?php
class con_rep_censo extends Controller
{

     function con_rep_censo() {

             parent::Controller();
             $this -> load  ->database();
             $this -> load  ->model('Model_consulta','',TRUE);
             $this -> load  ->helper(array('form', 'url'));
             $this -> load  ->model('reportesModel','',TRUE);
             $this -> load  ->library('JELGeneral');
             $this -> load  ->library('xajax');
             $this -> load  -> library('mylib_base');
             $this -> xajax ->registerFunction(array('obtieneParroquia_censo', &$this, 'obtieneParroquia_censo'));
             $this -> xajax ->registerFunction(array('obtieneParroquia_habitad', &$this, 'obtieneParroquia_habitad'));
             $this -> xajax ->registerFunction(array('obtieneCarrera', &$this, 'obtieneCarrera'));

             $this -> xajax ->processRequest();
     }

        function index(){

        $centinela = new Centinela();
        $menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
        $data['menu']               = $this->load->view('vis_menu',$menu_final,true);


        $data['xajax_js']       = $this -> xajax          -> getJavascript(base_url());
        $data['q_municipio']    = $this -> Model_consulta -> consulta_combo('nombre_municipio','ASC','vis_municipio');
        $data['q_parroquia']    = $this -> Model_consulta -> consulta_combo('nombre_parroquia','ASC','vis_parroquia');
        $data['q_procedencia']  = $this -> Model_consulta -> consulta_combo('nombre_tipo_procedencia','ASC','vis_tipo_procedencia');
        $data['q_car_inst']     = $this -> Model_consulta -> consulta_combo_dist('carrera','ASC','vis_carrera_solicitada');



        $this->load->view('reporte/vis_rep_censo',$data);
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
       $consulta   = $this->db->query('select distinct(nombre_carrera), carrera_id from vis_carrera_instituto where instituto_id in ('.$condicion.') order by nombre_carrera');

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
// $this->load->view('reporte/vis_rep_censo',$data);
         }


   function const_censo(){

  $valores_municipio_censo    = '';
  $valores_municipio_habitad  = '';
  $valores_parroquia_censo    = '';
  $valores_parroquia_habitad  = '';
  $valores_instituto          = '';
  $valores_carrera            = '';
  $valores_procedencia        = '';


//*************************************************


if(isset($_POST['procedencia'])){

     foreach($_POST['procedencia'] as $key => $value){
                               $valores_procedencia.=$value.',';
                           }

    $valores_procedencia = substr ($valores_procedencia, 0, strlen($valores_procedencia) -1);
    $sql_pro= ' tipo_procedencia_id in ('.$valores_procedencia.') and  ';

    }else{

          $sql_pro = '';
         }



//**************************************************

     if(isset($_POST['municipio_censo'])){

     foreach($_POST['municipio_censo'] as $key => $value){
                               $valores_municipio_censo.=$value.',';
                           }

    $valores_municipio_censo = substr ($valores_municipio_censo, 0, strlen($valores_municipio_censo) -1);
    $sql_mc= ' municipio_id in ('.$valores_municipio_censo.') and  ';

    }else{

          $sql_mc = '';
         }

//**********************************************

     if(isset($_POST['parroquia_censo'])){

     foreach($_POST['parroquia_censo'] as $key => $value){
                                $valores_parroquia_censo.=$value.',';
                           }

    $valores_parroquia_censo = substr ($valores_parroquia_censo, 0, strlen($valores_parroquia_censo) -1);
    $sql_pc= ' parroquia_id in ('.$valores_parroquia_censo.')  and';

    }else{

          $sql_pc = '';
         }


//**********************************************

 if(isset($_POST['municipio_habitad'])){

     foreach($_POST['municipio_habitad'] as $key => $value){
                                $valores_municipio_habitad.=$value.',';
                           }

    $valores_municipio_habitad = substr ($valores_municipio_habitad, 0, strlen($valores_municipio_habitad) -1);
    $sql_ma= ' municipio_id in ('.$valores_municipio_habitad.')  and ';

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

     foreach($_POST['instituto'] as $key => $value){
                                $valores_instituto.=$value.',';
                           }

    $valores_instituto = substr ($valores_instituto, 0, strlen($valores_instituto) -1);
    $sql_i= ' instituto_id in ('.$valores_instituto.') and ';

    }else{

          $sql_i= '';
         }



//******************************************
 $nombre    ='';
 $apellido  ='';
 $cedula    ='';

  if(isset($_POST['carrera'])){
 foreach($_POST['carrera'] as $key => $value){

                            // $valores_carrera.='LIKE \'%\' || \''.strtoupper($value).'\' || \'%\' or ';
                              $valores_carrera.=' upper(carrera) LIKE \'%'.strtoupper($value).'%\' or ';

                       }

$valores_carrera = substr ($valores_carrera, 0, strlen($valores_carrera) -3);
$sql_ca=  '('.$valores_carrera.')  and ' ;
}else{
$v=-1;
$sql_ca='( upper(carrera) LIKE \'%'.($v).'%\') and ';
     }

//***********************************

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
if(isset($_POST['lugar']) && $_POST['lugar'] <> ''){

    $criterio_lugar=0;
    $lugar= $_POST['lugar'];
}else{
    $lugar='';
    $criterio_lugar='';
}


//*******************************
$criterio_fecha='';
if(isset($_POST['fecha']) && $_POST['fecha'] <> ''){

$criterio_fecha= $_POST['sfecha'];
$fecha= $this->mylib_base->human_to_pg($_POST['fecha']);

}else{
$fecha='';


}
 if (isset($_POST['nobenef'])){
     $no_benef  = $_POST['nobenef'];
 }else{
      $no_benef = 0;
 }


//****************************
        //INICIO EXCEL
//****************************

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
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(24);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);


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

         $logojel->setCoordinates('G2');
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
$objPHPExcel->getActiveSheet()->SetCellValue('A5',"REPORTE PROCEDENCIA");




 //consulta censos
$data['q_censo']=$this->reportesModel->getAllcenso($sql_mc,$sql_pc,$criterio_lugar,$lugar,$criterio_fecha,$fecha,$sql_pro);
//fin consulta sorteo

$censos = $data['q_censo']->num_rows();
//aqui foreach sorteos

 $indice = 8;
foreach($data['q_censo']->result() as $row){


$id= $row->procedencia_id;
//FORMATO TITULO DE LOS censos
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

),
		//'A'.$indice.':L'.$indice
        'A'.$indice.':I'.$indice
);
//******************color titulos


$indice2= $indice+1;
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
       // 'A'.$indice.':I'.$indice
       'A'.$indice2.':I'.$indice2
        );
 // fin color de fondo



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
		//'A'.$indice.':L'.$indice
        'A'.$indice2.':I'.$indice2
);




//fin color titulos
//TITULO DE LOS SORTEOS
$objPHPExcel->getActiveSheet()->mergeCells('C'.$indice2.':E'.$indice2);
$objPHPExcel->getActiveSheet()->mergeCells('G'.$indice2.':I'.$indice2);

$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice2,"# PROC.");
$objPHPExcel->getActiveSheet()->SetCellValue('B'.$indice2,"FECHA CENSO");
$objPHPExcel->getActiveSheet()->SetCellValue('C'.$indice2,"MUNICIPIO CENSO");
$objPHPExcel->getActiveSheet()->SetCellValue('F'.$indice2,"PARROQUIA CENSO");
$objPHPExcel->getActiveSheet()->SetCellValue('G'.$indice2,"LUGAR DEL CENSO");

$indice3 = $indice2 + 1;
//FORMATO DESCRIPCION censados
$objPHPExcel->getActiveSheet()->getRowDimension($indice3)->setRowHeight(12);
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


         'A'.$indice3.':I'.$indice3
);

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

       'A'.$indice3.':I'.$indice3
        );
 // fin color de fondo
//DESCRIPCION SORTEOS valores de sorteos
$objPHPExcel->getActiveSheet()->mergeCells('C'.$indice3.':E'.$indice3);
$objPHPExcel->getActiveSheet()->mergeCells('G'.$indice3.':I'.$indice3);
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice3,$row->procedencia_id);
$objPHPExcel->getActiveSheet()->SetCellValue('B'.$indice3,$row->fecha_procedencia);
$objPHPExcel->getActiveSheet()->SetCellValue('C'.$indice3,$row->nombre_municipio);
$objPHPExcel->getActiveSheet()->SetCellValue('F'.$indice3,$row->nombre_parroquia);
$objPHPExcel->getActiveSheet()->SetCellValue('G'.$indice3,$row->lugar_procedencia);



$indice4= $indice3 +1;


$data['q_censados']=$this->reportesModel->getAllcensados($sql_ma,$sql_pa,$sql_ca,$criterio_nombre,$nombre,$criterio_apellido,$apellido,$criterio_cedula,$cedula,$criterio_sexo,$sexo,$id,$no_benef);
$censados = $data['q_censados']->num_rows();


if($data['q_censados']->num_rows() > 0){
if(isset($_POST['detalle'])){






//FORMATO TITULO DE LOS censados
$objPHPExcel->getActiveSheet()->getRowDimension($indice4)->setRowHeight(12);
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

          'A'.$indice4.':L'.$indice4
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

       'A'.$indice4.':K'.$indice4
        );
 // fin color de fondo
//FFCCFFCC



//TITULOS SORTEADOS

$objPHPExcel->getActiveSheet()->mergeCells('A'.$indice4.':B'.$indice4);
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice4,"NOMBRE");
$objPHPExcel->getActiveSheet()->SetCellValue('C'.$indice4,"CÉDULA");
$objPHPExcel->getActiveSheet()->SetCellValue('D'.$indice4,"SEXO");
$objPHPExcel->getActiveSheet()->SetCellValue('E'.$indice4,"INSTITUTO ");
$objPHPExcel->getActiveSheet()->SetCellValue('F'.$indice4,"CARRERA");
$objPHPExcel->getActiveSheet()->SetCellValue('G'.$indice4,"APTO");
$objPHPExcel->getActiveSheet()->SetCellValue('H'.$indice4,"FILTRO");
$objPHPExcel->getActiveSheet()->SetCellValue('I'.$indice4,"PROCEDENCIA");
$objPHPExcel->getActiveSheet()->SetCellValue('J'.$indice4,"# PARTICIPACIONES");
$objPHPExcel->getActiveSheet()->SetCellValue('K'.$indice4,"OBSERVACIONES");


 //consulta censos

//fin consulta censados

 $indice5= $indice4 +1;


 foreach($data['q_censados']->result() as $row2){
//FORMATO DESCRIPCION SORTEADOS valores de los sorteados
$objPHPExcel->getActiveSheet()->getRowDimension($indice5)->setRowHeight(12);
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

        'A'.$indice5.':L'.$indice5
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

       'A'.$indice5.':K'.$indice5
        );
 // fin color de fondo
$personaId = $row2->persona_id;

$no_sorteada =  $this->db->query ('select persona_id,procedencia_persona_id from vis_procedencia_persona where procedencia_persona_id  in (select procedencia_persona_id from vis_sorteo_persona where persona_id = '.$personaId.' )');

if($no_sorteada->num_rows() > 0){

$sort      = $this->db->query ('select COUNT(sorteo_id) as total from vis_sorteo where fecha_sorteo >= (select min(fecha_procedencia) as fecha_procedencia from vis_procedencia_persona where persona_id= '.$personaId.') and  fecha_sorteo <= (select fecha_sorteo from vis_sorteo_persona where persona_id = '.$personaId.' )');
}else{
$sort      = $this->db->query ('select COUNT(sorteo_id) as total from vis_sorteo where fecha_sorteo >= (select min(fecha_procedencia) as fecha_procedencia from vis_procedencia_persona where persona_id= '.$personaId.')');
}


$fila_total_sort = $sort->row_array();

$pto    = $this->db->query('select * from vis_verificacion where persona_id= '.$personaId.' and fecha_verificacion =(select max(fecha_verificacion) as fecha_verificacion from verificacion)');
$fila_pto = $pto->row_array();

if($pto->num_rows() > 0){

$filtro =$fila_pto['siglas_instituto'];
$apto   ='No';
}else{
$filtro ='';
$apto   ='Si';

}


//INFORMACION censados

$objPHPExcel->getActiveSheet()->mergeCells('A'.$indice5.':B'.$indice5);
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice5,$row2->nombre_persona.' '.$row2->apellido_persona);
$objPHPExcel->getActiveSheet()->SetCellValue('C'.$indice5,$row2->cedula_persona);
$objPHPExcel->getActiveSheet()->SetCellValue('D'.$indice5,$row2->sexo_persona);
$objPHPExcel->getActiveSheet()->SetCellValue('E'.$indice5,'');

if($row2->carrera == -1){
    $carrera= '';
}else{
    $carrera= $row2->carrera ;
}

$objPHPExcel->getActiveSheet()->SetCellValue('F'.$indice5,$carrera);
$objPHPExcel->getActiveSheet()->SetCellValue('G'.$indice5,$apto);
$objPHPExcel->getActiveSheet()->SetCellValue('H'.$indice5,$filtro);
$objPHPExcel->getActiveSheet()->SetCellValue('I'.$indice5,$row2->nombre_tipo_procedencia);
$objPHPExcel->getActiveSheet()->SetCellValue('J'.$indice5,$fila_total_sort['total']);
$objPHPExcel->getActiveSheet()->SetCellValue('K'.$indice5,$row2->observaciones);


$indice5=$indice5+1;
 }

$indice6= $indice5 +0;
//$indice_prima_4 = $indice_prima_3 +1;


}else{//fin de llave detalle


   $indice6  = $indice4 +0;
  // $data['q_censados']=$this->reportesModel->getAllcensados($sql_ma,$sql_pa,$sql_ca,$criterio_nombre,$nombre,$criterio_apellido,$apellido,$criterio_cedula,$cedula,$criterio_sexo,$sexo,$row->tipo_procedencia_id,$no_benef);

   //$censados = $data['q_censados']->num_rows();
}//fin else detalle


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

       'A'.$indice6.':E'.$indice6
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

        'A'.$indice6.':E'.$indice6
);



$objPHPExcel->getActiveSheet()->mergeCells('A'.$indice6.':E'.$indice6);
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice6,'TOTAL PROCEDENCIA: '.$row->procedencia_id.':'.$censados);




$indice= $indice6 + 1;


}else{

$indice= $indice4;
}



}//end foreach censo


$indice = $indice +1;

//TOTAL GENERAL
//color de fondo
$objPHPExcel->getActiveSheet($indice)->duplicateStyleArray(
   array('fill'    => array(
                   'type'    => PHPExcel_Style_Fill::FILL_SOLID,
                   'color'   => array('argb' => 'FFCCFFCC')),
         'borders' => array(
                   'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN))
        ),
        'A'.$indice.':E'.$indice
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
		'A'.$indice.':E'.$indice
);



$objPHPExcel->getActiveSheet()->mergeCells('A'.$indice.':E'.$indice);
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice,'TOTAL PROCEDENCIA '.$censos);







$arv = time();

// Rename sheet

$objPHPExcel->getActiveSheet()->setTitle('Reporte Sorteos');

$data['archivo']='censo'.$arv.'.xls';
// Save Excel 2003 file

$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
//$objWriter->save(str_replace('.php', '.xls', _FILE_));
$objWriter->save('Reportes/censo'.$arv.'.XLS');


//fin de titulo del reporte
//*******************************************************************************


//****************************
//FIN DEL EXCEL
//****************************


   $data['rept']= 'reporte Censos';

   //llamada a centinela y a menu dinamico
    $centinela = new Centinela();
    $menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
    $data['menu']               = $this->load->view('vis_menu',$menu_final,true);
    //fin de llamada centinela y menu dinamico

   $this->load->view('vis',$data);
   }



}

?>
