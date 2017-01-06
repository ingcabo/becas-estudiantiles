<?php

class Con_madresoltera extends Controller{

     function Con_madresoltera() {

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
            $data['q_nucleo']     = $this -> Model_consulta -> consulta_combo('nombre_nucleo_instituto','ASC','nucleo_instituto');
            $data['q_car_inst']   = $this -> Model_consulta -> consulta_combo('siglas_instituto','ASC','vis_carrera_instituto');
            $data['q_periodo']    = $this -> Model_consulta -> consulta_combo('ano_periodo','ASC','vis_periodo');
            $data['q_municipio']  = $this -> Model_consulta -> consulta_combo('nombre_municipio','ASC','vis_municipio');
            $data['q_parroquia']  = $this -> Model_consulta -> consulta_combo('nombre_parroquia','ASC','vis_parroquia');

            $this->load->view('reporte/vis_rep_madresoltera',$data);

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


               if ($consulta->num_rows() > 0){

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

                                                   $valorAAsignar_2 .=  '<font size="2" face="Geneva, Arial, Helvetica, sans-serif">'.form_checkbox($data_2).$row->nombre_carrera.'</font><br>';
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


function const_madresoltera(){

$valores_instituto ='';
$valores_nucleo    ='';
$valores_carrera   ='';
$valores_periodo   ='';
$valores_municipio ='';
$valores_parroquia ='';


 if(isset($_POST['instituto'])){
 
 foreach($_POST['instituto'] as $key => $value){
                            $valores_instituto.=$value.',';
                       }

$valores_instituto = substr ($valores_instituto, 0, strlen($valores_instituto) -1);
$sql_i= ' instituto_id in ('.$valores_instituto.') and ';

}else{
     
      $sql_i= '';
     }

//*********************************************

 if(isset($_POST['nucleo'])){

 foreach($_POST['nucleo'] as $key => $value){
                            $valores_nucleo.=$value.',';

                       }

$valores_nucleo = substr ($valores_nucleo, 0, strlen($valores_nucleo) -1);
$sql_n= ' nucleo_instituto_id in ('.$valores_nucleo.') and ';
}else{
     
      $sql_n = '';
     }
//********************************************

 if(isset($_POST['carrera'])){

 foreach($_POST['carrera'] as $key => $value){
                            $valores_carrera.=$value.',';

                       }

$valores_carrera = substr ($valores_carrera, 0, strlen($valores_carrera) -1);
$sql_c= ' carrera_instituto_id in ('.$valores_carrera.') and ';
}else{
     
      $sql_c= '';
     }

//*******************************
 if(isset($_POST['periodo'])){
 
 foreach($_POST['periodo'] as $key => $value){
                            $valores_periodo.=$value.',';

                       }

$valores_periodo = substr ($valores_periodo, 0, strlen($valores_periodo) -1);
$sql_p= ' periodo_id in ('.$valores_periodo.') and ';
}else{
    
      $sql_p= '';
     }
//**********************************


 if(isset($_POST['municipio'])){

 foreach($_POST['municipio'] as $key => $value){
                            $valores_municipio.=$value.',';

                       }

$valores_municipio = substr ($valores_municipio, 0, strlen($valores_municipio) -1);
$sql_m= ' municipio_id in ('.$valores_municipio.')  and ';
}else{
     
      $sql_m= '';
     }


//**************************************

 if(isset($_POST['parroquia'])){
 
 foreach($_POST['parroquia'] as $key => $value){
                            $valores_parroquia.=$value.',';

                       }

$valores_parroquia = substr ($valores_parroquia, 0, strlen($valores_parroquia) -1);
$sql_pa= ' parroquia_id in ('.$valores_parroquia.') and ';
}else{
    
      $sql_pa= '';
     }


//***********************************

 $nombre   ='';
 $apellido ='';
 $cedula   ='';
 $hijos    ='';


$criterio_nombre  = $_POST['snombre'];
if(isset($_POST['nombre']) && $_POST['nombre'] <> ''){

    $nombre =  $_POST['nombre'];
}

//******************apellido

$criterio_apellido  = $_POST['sapellido'];
if(isset($_POST['apellido']) && $_POST['apellido'] <> ''){

    $apellido =  $_POST['apellido'];
}

//*********************

$criterio_cedula  = $_POST['scedula'];
if(isset($_POST['cedula']) && $_POST['cedula'] <> ''){

    $cedula =  $_POST['cedula'];
}

//********************shijos

$criterio_hijos  = $_POST['shijos'];
if(isset($_POST['hijos']) && $_POST['hijos'] <> ''){

    $hijos =  $_POST['hijos'];
}

//***********************************************

 $qq     =  $this->db->query('select beca_id_madre_soltera from configuracion');

 $fila   =  $qq->row_array();

$q_madre = $this->reportesModel->madresoltera($criterio_nombre,$nombre,$criterio_apellido,$apellido,$criterio_cedula,$cedula,$criterio_hijos,$hijos,$sql_i,$sql_n,$sql_c,$sql_p,$sql_m,$sql_pa,$fila['beca_id_madre_soltera']);
$total  =  $q_madre->num_rows();
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
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(14);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(19);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(14);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);



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
$objPHPExcel->getActiveSheet()->SetCellValue('A5',"REPORTE MADRE SOLTERA");










//*******************************************************************************
//formato titulo de las madres
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
       'argb' => '333366FF'
                     ),

),
		'A7:F7'
);






//color de fondo
$objPHPExcel->getActiveSheet()->duplicateStyleArray(
   array('fill'    => array(
                   'type'    => PHPExcel_Style_Fill::FILL_SOLID,
                   'color'   => array('argb' => '333366FF')),
         'borders' => array(
                   'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN))
        ),
        "A7:F7"
        );
 // fin color de fondo
//fin formato titulo de los beneficiarios

//TITULO DE Las madres
$objPHPExcel->getActiveSheet()->SetCellValue('A7',"CEDULA");
$objPHPExcel->getActiveSheet()->SetCellValue('B7',"NOMBRE Y APELLIDO");
$objPHPExcel->getActiveSheet()->SetCellValue('C7',"INSTITUTO");
$objPHPExcel->getActiveSheet()->SetCellValue('D7',"PERIODO");
$objPHPExcel->getActiveSheet()->SetCellValue('E7',"NUMERO DE HIJOS");
$objPHPExcel->getActiveSheet()->SetCellValue('F7',"OBSERVACIONES");
$objPHPExcel->getActiveSheet()->getRowDimension(7)->setRowHeight(12);
//fin de titulos de las madres
//***************************************************************

$indice=8;
foreach($q_madre->result() as $row){


//FORMATO DESCRIPCION madres
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

          'A'.$indice.':F'.$indice
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
       'A'.$indice.':F'.$indice
        );


//DESCRIPCION SORTEOS valores de sorteos
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice,$row->cedula_persona);
$objPHPExcel->getActiveSheet()->SetCellValue('B'.$indice,$row->nombre_persona.''.$row->apellido_persona);
$objPHPExcel->getActiveSheet()->SetCellValue('C'.$indice,$row->siglas_instituto);
$objPHPExcel->getActiveSheet()->SetCellValue('D'.$indice,$row->ano_periodo.$row->parcial_periodo);
$objPHPExcel->getActiveSheet()->SetCellValue('E'.$indice,$row->numero_hijo);
$objPHPExcel->getActiveSheet()->SetCellValue('F'.$indice,$row->observaciones);
//*********************************************************

$indice=$indice+1;
}

//formato titulo de las madres

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
       'argb' => '333366FF'
                     ),

),
		'A'.$indice.':C'.$indice
);






//color de fondo
$objPHPExcel->getActiveSheet()->duplicateStyleArray(
   array('fill'    => array(
                   'type'    => PHPExcel_Style_Fill::FILL_SOLID,
                   'color'   => array('argb' => '0000FFFF')),
         'borders' => array(
                   'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN))
        ),
        'A'.$indice.':C'.$indice
        );
 // fin color de fondo

$objPHPExcel->getActiveSheet()->mergeCells('A'.$indice.':C'.$indice);
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice,'TOTAL MADRES SOLTERAS: '.$total);







//***************************************************************
// Rename sheet
//echo date('H:i:s') . " Rename sheet\n"."Ruta donde no se como mostralo C:\web\JEL\Reportes";
$objPHPExcel->getActiveSheet()->setTitle('Reporte Beneficiario');

// Save Excel 2003 file
 
$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
//$objWriter->save(str_replace('.php', '.xls', _FILE_));
$arv = time();
$objWriter->save('Reportes/madre'.$arv.'.XLS');


//fin de titulo del reporte
//*******************************************************************************






//****************************
//FIN DEL EXCEL
//****************************

$data['archivo']   ='madre'.$arv.'.xls';
$data['rept']      ='reporte madre soltera';
//llamada a centinela y a menu dinamico
$centinela = new Centinela();
$menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
$data['menu']               = $this->load->view('vis_menu',$menu_final,true);
//fin de llamada centinela y menu dinamico
$this->load->view('vis',$data);


}









}
?>
