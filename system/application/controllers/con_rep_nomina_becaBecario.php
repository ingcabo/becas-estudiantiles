<?php
class con_rep_nomina_becaBecario extends Controller{

     function con_rep_nomina_becaBecario() {

             parent::Controller();
             $this -> load  ->database();
             $this -> load  ->model('Model_consulta','',TRUE);
             $this -> load  ->helper(array('form', 'url'));
             $this -> load  ->model('reportesModel','',TRUE);
             $this -> load  ->library('JELGeneral');
             $this->load->library('mylib_base');
             $this -> load  ->library('xajax');
             $this -> xajax ->registerFunction(array('obtieneCarrera', &$this, 'obtieneCarrera'));
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
            $data['q_banco']      = $this -> Model_consulta -> consulta_combo('nombre_banco','ASC','vis_banco');
            $data['q_estado_pre'] = $this -> Model_consulta -> consulta_combo('nombre_estado_presupuesto','ASC','estado_presupuesto');

            $this->load->view('reporte/vis_rep_nomina_becaBecario',$data);

        }


        function obtieneCarrera($controles){


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







function const_nomina_becaBecario(){


$valores_instituto  ='';
$valores_carrera    ='';
$valores_banco      ='';
$nombre             ='';
$apellido           ='';
$cedula             ='';
$fecha              ='';
$status             ='';



//**********************************************
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


 if(isset($_POST['banco'])){

     foreach($_POST['banco'] as $key => $value){
                                $valores_banco.=$value.',';
                           }

    $valores_banco = substr ($valores_banco, 0, strlen($valores_banco) -1);
    $sql_b= ' banco_id in ('.$valores_banco.') and ';

    }else{

          $sql_b = '';
         }



//****************************************************

$criterio_nombre  = $_POST['snombre'];
if(isset($_POST['nombre']) && $_POST['nombre'] <> ''){

    $nombre =  $_POST['nombre'];
}


//***********************************************


$criterio_apellido  = $_POST['sapellido'];
if(isset($_POST['apellido']) && $_POST['apellido'] <> ''){

    $apellido =  $_POST['apellido'];
}


//**************************************************


$criterio_cedula  = $_POST['scedula'];
if(isset($_POST['cedula']) && $_POST['cedula'] <> ''){

    $cedula =  $_POST['cedula'];
}
//****************************************************


$criterio_fecha  = $_POST['sfecha'];
if(isset($_POST['fecha']) && $_POST['fecha'] <> ''){

    $fecha =    $this->mylib_base->human_to_pg($_POST['fecha']);
}
//****************************************************

//

$criterio_status  = 0;
if(isset($_POST['sstatus']) && $_POST['sstatus'] <> ''){

    $status =  $_POST['sstatus'];
}



$parametro= $this -> Model_consulta -> consulta('beca_id_beca_becario','ASC','configuracion');
$fila_becario = $parametro->row_array();
$baca_Id= $fila_becario['beca_id_beca_becario'];
//***************************************************
 $query    = $this->reportesModel->getnominabecaBecario($criterio_nombre,$nombre,$criterio_apellido,$apellido,$criterio_cedula,$cedula,$criterio_fecha,$fecha,$criterio_status,$status,$sql_i,$sql_c,$sql_b,$baca_Id);
 $cantidad = $query->num_rows();
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
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(18);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(14);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(9);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(14);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(25);
$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(18);
$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(8);
$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(16);



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
$objPHPExcel->getActiveSheet()->SetCellValue('A5',"REPORTE NOMINA BECA BECARIO");


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

$objPHPExcel->getActiveSheet()->SetCellValue('C7',$fecha);
$objPHPExcel->getActiveSheet()->SetCellValue('C8',$cantidad);


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
        "B10:M10"
        );
 // fin color de fondo

//FIN SOLOR DE FONDO TITULO


//TITULOS
$objPHPExcel->getActiveSheet()->SetCellValue('B10',"NOMBRE");
$objPHPExcel->getActiveSheet()->SetCellValue('C10',"CEDULA");
$objPHPExcel->getActiveSheet()->SetCellValue('D10',"PRESUPUESTO");
$objPHPExcel->getActiveSheet()->SetCellValue('E10',"BANCO");
$objPHPExcel->getActiveSheet()->SetCellValue('F10',"NUMERO DE CUENTA");
$objPHPExcel->getActiveSheet()->SetCellValue('G10',"MONTO");
$objPHPExcel->getActiveSheet()->SetCellValue('H10',"PERIODO");
$objPHPExcel->getActiveSheet()->SetCellValue('I10',"INSTITUTO");
$objPHPExcel->getActiveSheet()->SetCellValue('J10',"CARRERA");
$objPHPExcel->getActiveSheet()->SetCellValue('K10',"ESTATUS");
$objPHPExcel->getActiveSheet()->SetCellValue('L10',"FECHA");
$objPHPExcel->getActiveSheet()->SetCellValue('M10',"OBSERVACIONES");


//VALORES DE LOS TITULOS




$indice=11;
foreach($query->result() as $row){



$objPHPExcel->getActiveSheet()->SetCellValue('B'.$indice,$row->nombre_persona.' '.$row->apellido_persona);
$objPHPExcel->getActiveSheet()->SetCellValue('C'.$indice,$row->cedula_persona);
$objPHPExcel->getActiveSheet()->SetCellValue('D'.$indice,$row->codigo_presupuesto);
$objPHPExcel->getActiveSheet()->SetCellValue('E'.$indice,$row->nombre_banco);
$objPHPExcel->getActiveSheet()->SetCellValue('F'.$indice,$row->numero_cuenta_persona);
$objPHPExcel->getActiveSheet()->SetCellValue('G'.$indice,$row->monto_presupuesto);
$objPHPExcel->getActiveSheet()->SetCellValue('H'.$indice,$row->ano_periodo.' '.$row->parcial_periodo);
$objPHPExcel->getActiveSheet()->SetCellValue('I'.$indice,$row->siglas_instituto);
$objPHPExcel->getActiveSheet()->SetCellValue('J'.$indice,$row->nombre_carrera);
$objPHPExcel->getActiveSheet()->SetCellValue('K'.$indice,$row->nombre_estado_presupuesto);
$objPHPExcel->getActiveSheet()->SetCellValue('L'.$indice,$row->fecha_presupuesto);
$objPHPExcel->getActiveSheet()->SetCellValue('M'.$indice,$row->observaciones);

//llamar a la funcion que cambia el comit en la tabla beca persona
if(isset($_POST['submit'])){
$upd= $this->reportesModel->upd_beca_persona_commit_beca($row->beca_persona_id,$beca_Id,'1');
}else{

    
}
//
// FIN VSLORES TITULOS
$indice=$indice+1;
}




//FIN VALORES DE LOS TITULOS


$objPHPExcel->getActiveSheet()->setTitle('Reporte Nomina Beca Becario');

// Save Excel 2003 file


 $arv= time();

$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
//$objWriter->save(str_replace('.php', '.xls', _FILE_));
$objWriter->save('Reportes/nomibecabec'.$arv.'.XLS');





//fin de titulo del reporte
//*******************************************************************************





//****************************
//FIN DEL EXCEL
//****************************

$data['archivo']   ='nomibecabec'.$arv.'.xls';
$data['rept']      ='Reporte Nomina Beca Becario';
$centinela = new Centinela();
$menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
$data['menu']               = $this->load->view('vis_menu',$menu_final,true);
$this->load->view('vis',$data);





   
}












}
?>