<?php
class con_rep_becaPromedio extends Controller{

     function con_rep_becaPromedio() {

             parent::Controller();
             $this -> load  ->database();
             $this -> load  ->model('Model_consulta','',TRUE);
             $this -> load  ->model('reportesModel','',TRUE);


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
            $data['q_periodo']    = $this -> Model_consulta -> consulta_combo('ano_periodo','ASC','vis_periodo');

            $this->load->view('reporte/vis_rep_becaPromedio',$data);

        }


        function obtieneNucleo($controles){


        $respuesta = new xajaxResponse(); //Creamos el objeto xajax
		$inputDestino = "capa_nucleo"; //indicamos el ID del tag HTML de destino. en este caso el DIV que contiene el selector
		$propiedadInputDestino = "innerHTML"; //indicamos la propiedad que deseamos que se modifique. Colocaremos el selector dentro del DIV
		$valorAAsignar   = ""; //indicamos el nuevo valor que este tendrá. Cadena HTML
        $condicion       = "";
        $inputDestino_2  = "capa_carrera";
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

function const_becaPromedio(){

$valores_instituto ='';
$valores_carrera   ='';
$valores_municipio ='';
$valores_parroquia ='';
$valores_periodo   ='';
$nombre   ='';
$apellido ='';
$cedula   ='';
$promedio ='';



if(isset($_POST['instituto'])){

 foreach($_POST['instituto'] as $key => $value){
                            $valores_instituto.=$value.',';
                       }

$valores_instituto = substr ($valores_instituto, 0, strlen($valores_instituto) -1);
$sql_i= ' instituto_id in ('.$valores_instituto.') and ';

}else{

      $sql_i= '';
     }
    
//****************************************************

if(isset($_POST['carrera'])){

     foreach($_POST['carrera'] as $kye => $value){

      $valores_carrera.= $value.',';

     }
      $valores_carrera = substr($valores_carrera,0,strlen($valores_carrera)- 1);
      $sql_c= ' carrera_instituto_id in ('.$valores_carrera.') and ';

 }else{

      $sql_c='';

 }

//****************************************************

if(isset($_POST['municipio'])){

     foreach($_POST['municipio'] as $kye => $value){

      $valores_municipio.= $value.',';

     }
      $valores_municipio = substr($valores_municipio,0,strlen($valores_municipio)- 1);
      $sql_m= ' municipio_id in ('.$valores_municipio.') and ';

 }else{

      $sql_m='';

 }

//******************************************************

if(isset($_POST['parroquia'])){

     foreach($_POST['parroquia'] as $kye => $value){

      $valores_parroquia.= $value.',';

     }
      $valores_parroquia = substr($valores_parroquia,0,strlen($valores_parroquia)- 1);
      $sql_p= ' parroquia_id in ('.$valores_parroquia.') and ';

 }else{

      $sql_p='';

 }



//******************************************************



if(isset($_POST['periodo'])){

     foreach($_POST['periodo'] as $kye => $value){

      $valores_periodo.= $value.',';

     }
      $valores_periodo = substr($valores_periodo,0,strlen($valores_periodo)- 1);
      $sql_pe= ' periodo_id in ('.$valores_periodo.') and ';

 }else{

      $sql_pe='';

 }


//****************************************************

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


$criterio_cedula  = $_POST['scedula'];
if(isset($_POST['cedula']) && $_POST['cedula'] <> ''){

    $cedula =  $_POST['cedula'];
}

//****************************************************

$criterio_promedio  = $_POST['spromedio'];
if(isset($_POST['promedio']) && $_POST['promedio'] > 0){

    $promedio =  $_POST['promedio'];
}
//*************************************************










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

$objPHPExcel->getActiveSheet()->mergeCells('A1:F1');
$objPHPExcel->getActiveSheet()->mergeCells('A2:F2');
$objPHPExcel->getActiveSheet()->mergeCells('A3:F3');
$objPHPExcel->getActiveSheet()->mergeCells('A4:F4');
$objPHPExcel->getActiveSheet()->mergeCells('A5:F5');
$objPHPExcel->getActiveSheet()->mergeCells('A6:F6');



//$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(8, 10, 'Some value'); el valor de la columna por cordenadas X y Y

// Set column width dimensiones anchura de la filas no tocar o te jodo
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(13);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(29);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(16);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(18);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(18);




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

         $logojel->setCoordinates('E2');
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
$objPHPExcel->getActiveSheet()->SetCellValue('A5',"REPORTE BECA PROMEDIO");


$objPHPExcel->getActiveSheet()->mergeCells('A7:E7');

//fomato titulo de la persona
//*************************************************************
//*************************************************************
//*************************************************************
$data['beca_pro'] = $this->reportesModel->getbecapromedio($criterio_nombre,$nombre,$criterio_apellido,$apellido,$criterio_cedula,$cedula,$criterio_promedio,$promedio,$sql_i,$sql_c,$sql_m,$sql_p,$sql_pe);
$becados = $data['beca_pro']->num_rows();
$indice=10;
foreach($data['beca_pro']->result() as $row){
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
       'argb' => '3366ff'
                     ),

),
		'A'.$indice.':E'.$indice
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
        'A'.$indice.':E'.$indice
        );
 // fin color de fondo


//fin formato titulo de la persona
//titulo de persona
$objPHPExcel->getActiveSheet()->mergeCells('B'.$indice.':C'.$indice);
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice,"CEDULA");
$objPHPExcel->getActiveSheet()->SetCellValue('B'.$indice,"NOMBRE Y APELLIDO");
$objPHPExcel->getActiveSheet()->SetCellValue('D'.$indice,"PERIODO");
$objPHPExcel->getActiveSheet()->SetCellValue('E'.$indice,"PROMEDIO");


//formato de los items

$indice2= $indice + 1;
$objPHPExcel->getActiveSheet()->getRowDimension($indice2)->setRowHeight(12);
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

//fin formato de los items
//valores de persona
$objPHPExcel->getActiveSheet()->mergeCells('B'.$indice2.':C'.$indice2);
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice2,$row->cedula_persona);
$objPHPExcel->getActiveSheet()->SetCellValue('B'.$indice2,$row->nombre_persona.' '.$row->apellido_persona);
$objPHPExcel->getActiveSheet()->SetCellValue('D'.$indice2,$row->ano_periodo.'-'.$row->parcial_periodo);
$objPHPExcel->getActiveSheet()->SetCellValue('E'.$indice2,$row->promedio_nota);

$indice3= $indice2 + 1;
//formato titulo  de intituto y carrera

//fomato titulo de la persona
$objPHPExcel->getActiveSheet()->getRowDimension($indice3)->setRowHeight(12);
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
		'A'.$indice3.':C'.$indice3
);

//color de fondo
$objPHPExcel->getActiveSheet()->duplicateStyleArray(
   array('fill'    => array(
                   'type'    => PHPExcel_Style_Fill::FILL_SOLID,
                   'color'   => array('argb' => '333366ff')),
         'borders' => array(
                   'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'top'     => array('style' => PHPExcel_Style_Border::BORDER_THIN))
        ),
        'A'.$indice3.':E'.$indice3
        );
 // fin color de fondo

//
$objPHPExcel->getActiveSheet()->mergeCells('A'.$indice3.':B'.$indice3);
$objPHPExcel->getActiveSheet()->mergeCells('C'.$indice3.':E'.$indice3);
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice3,"INSTITUTO");
$objPHPExcel->getActiveSheet()->SetCellValue('C'.$indice3,"CARRERA");


$indice4=$indice3 + 1;
//****************
//formato de los items

$objPHPExcel->getActiveSheet()->getRowDimension($indice4)->setRowHeight(12);
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

          'A'.$indice4.':C'.$indice4
);

//fin formato de los items

//***************

$objPHPExcel->getActiveSheet()->mergeCells('A'.$indice4.':B'.$indice4);
$objPHPExcel->getActiveSheet()->mergeCells('C'.$indice4.':E'.$indice4);

$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice4,$row->siglas_instituto);
$objPHPExcel->getActiveSheet()->SetCellValue('C'.$indice4,$row->nombre_carrera);





if (isset($_POST['detalle'])){

$indice5=$indice4+1;//
//fomato titulo de la persona
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
		'A'.$indice5.':E'.$indice5
);

//color de fondo
$objPHPExcel->getActiveSheet()->duplicateStyleArray(
   array('fill'    => array(
                   'type'    => PHPExcel_Style_Fill::FILL_SOLID,
                   'color'   => array('argb' => '333366ff')),
         'borders' => array(
                   'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'top'     => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN))
        ),
        'A'.$indice5.':E'.$indice5
        );
 // fin color de fondo


$objPHPExcel->getActiveSheet()->mergeCells('A'.$indice5.':B'.$indice5);
$objPHPExcel->getActiveSheet()->mergeCells('C'.$indice5.':D'.$indice5);

$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice5,"MATERIA CURSADA");
$objPHPExcel->getActiveSheet()->SetCellValue('C'.$indice5,"NOTA");
$objPHPExcel->getActiveSheet()->SetCellValue('E'.$indice5,"APROBADA");




//***************************************************************************************
//***************************************************************************************
//***************************************************************************************
$data['materias']=$this->reportesModel->materias($row->beca_persona_id,$row->periodo_id);
//***************************************************************************************
//*********INICIO DE MATERIAS
$indice6= $indice5 + 1;
foreach($data['materias']->result() as $row2){
//formato de los items
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
$objPHPExcel->getActiveSheet()->duplicateStyleArray(
   array('fill'    => array(
                   'type'    => PHPExcel_Style_Fill::FILL_SOLID),

         'borders' => array(
                   'left'    => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'right'   => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'top'     => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                   'bottom'  => array('style' => PHPExcel_Style_Border::BORDER_THIN))
        ),
        'A'.$indice6.':E'.$indice6
        );

$objPHPExcel->getActiveSheet()->mergeCells('A'.$indice6.':B'.$indice6);
$objPHPExcel->getActiveSheet()->mergeCells('C'.$indice6.':D'.$indice6);
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice6,$row2->nombre_materia);
$objPHPExcel->getActiveSheet()->SetCellValue('C'.$indice6,$row2->nota_materia);
$objPHPExcel->getActiveSheet()->SetCellValue('E'.$indice6,"Si");
$indice6= $indice6+1;
}
$indice= $indice6 +1;


}else{
    
 $indice= $indice4 +2;
}


 }//fin del grande

$indice8 = $indice+1;
$objPHPExcel->getActiveSheet()->getRowDimension($indice8)->setRowHeight(12);
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

          'A'.$indice8.':C'.$indice8
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
        'A'.$indice8.':C'.$indice8
        );
 // fin color de fondo
$objPHPExcel->getActiveSheet()->mergeCells('A'.$indice8.':C'.$indice8);
$objPHPExcel->getActiveSheet()->SetCellValue('A'.$indice8,"TOTAL GENERAL BECA PROMEDIO: ".$becados);
//***************************************************************
$objPHPExcel->getActiveSheet()->setTitle('Reporte Beca Promedio');
$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
$arv= time();
$objWriter->save('Reportes/BECAPRO'.$arv.'.XLS');
//****************************
//FIN DEL EXCEL
//****************************


$data['archivo']   ='becapro'.$arv.'.xls';
$data['rept']      ='reporte Beca Promedio';

$centinela = new Centinela();
$menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
$data['menu']               = $this->load->view('vis_menu',$menu_final,true);




$this->load->view('vis',$data);
}

















}
?>
