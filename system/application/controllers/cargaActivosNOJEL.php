<?php


class cargaActivosNOJEL extends Controller
{

  function cargaActivosNOJEL()
  {

    parent::Controller();
    
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->helper('file');
    $this->load->library('JELGeneral');
   $this->load->model('cargaModel');
   $this->load->model('institutoModel');
   
    /*
    $this->load->model('aspiranteModel');
    
    
    
    $this->load->model('procedenciaModel');
    $this->load->model('carreraModel');
    $this->load->model('paisModel');
    $this->load->model('estadoModel');
    $this->load->model('municipioModel');
    $this->load->model('bancoModel');
    $this->load->model('personaModel');
    $this->personaModel->nombre_tabla ='persona';
    $this->load->model('becaModel');
    
    $this->load->library('xajax');
    $this->xajax->registerFunction(array('buildSelectEstados', &$this, 'buildSelectEstados'));
    $this->xajax->registerFunction(array('buildSelectMunicipios', &$this, 'buildSelectMunicipios'));
    $this->xajax->registerFunction(array('buildSelectParroquias', &$this, 'buildSelectParroquias'));
    $this->xajax->registerFunction(array('buscarPersona', &$this, 'buscarPersona'));
    $this->xajax->registerFunction(array('buscarPersonaMadre', &$this, 'buscarPersonaMadre'));
    $this->xajax->registerFunction(array('buscarPersonaPadre', &$this, 'buscarPersonaPadre'));
    $this->xajax->registerFunction(array('buscarPersonaRepresentante', &$this, 'buscarPersonaRepresentante'));
    $this->xajax->processRequest();
    $this->javaScriptText = $this->xajax->getJavascript(base_url());
     *
     */
  }

  function cargaActivosNOJELControl()
  {
    
    //Carga del menú principal de la aplicación
    $centinela  = new Centinela();
    $menu_final['opciones']   = $this->mod_demenu->inicio($centinela->getId());
    $data['menu'] = $this->load->view('vis_menu',$menu_final,true);
    //$x=0;
    //$data['menu']=$this->load->view('menu', $x, true);
    $data['institutos'] = $this->institutoModel->getAllInstituto('', '', '', '', '');;
    $data['error']='';

    $this->load->view('carga/cargaActivosNOJELForm', $data);
  }

  
  function cargaActivosNOJELRecord()
  {
    $row = 6;
 
    require_once('./system/application/libraries/Excel/reader.php');

    $config['upload_path'] = "./system/application/uploads/";
		$config['allowed_types'] = 'xls';
		$config['max_size']	= '0';
		$config['max_width']  = '0';
		$config['max_height']  = '0';
    $config['remove_spaces']  = true;

		$this->load->library('upload', $config);

    $dataView['menu'] = $this->load->view('menu', '',true);

    if ( ! $this->upload->do_upload())
		{
      
			$dataView['error'] = $this->upload->display_errors();

			$this->load->view('carga/cargaActivosNOJELForm', $dataView);
		}
		else
		{
			$dataView['upload_data'] = $this->upload->data();

      //ABRIR ARCHIVO EXCEL

      $strfile = $config['upload_path'].$dataView['upload_data']['file_name'];

      $data = new Spreadsheet_Excel_Reader();
      $data->setOutputEncoding('CP1251');
      $data->read($strfile);
      error_reporting(E_ALL ^ E_NOTICE);

      $dataView['institutoId'] = $_POST['cmbInstituto'];
      $dataView['returnPage'] ='cargaActivosNOJEL/cargaActivosNOJELControl';
      $dataView['titulo'] ='Carga de Estudiantes Activos NO JEL';
      $instituto = $this->jelgeneral->leerCelda($data,0,3,3);

       $reg=$this->institutoModel->getInstituto($dataView['institutoId']);

      
      $tipoCedulaPersona = '';
      $tipoCedulaPersona = $this->jelgeneral->leerCelda($data,0,$row,1);
      $contReg = 1;

      $dataView['errorMsg'] = '';
      $dataView['outputFilename'] = 'ActNOJEL_('.$reg->siglas_instituto.')_'.date("Y-m-d_H-i-s").'.log';
      $outputFilename = './logs/'.$dataView['outputFilename'];
      while($tipoCedulaPersona != '')
      {
        $dataView['tipoCedulaPersona'] = $this->jelgeneral->leerCelda($data,0,$row,1);
        $dataView['cedulaPersona'] = $this->jelgeneral->leerCelda($data,0,$row,2);
        $dataView['sexoPersona'] = $this->jelgeneral->leerCelda($data,0,$row,3);
        $dataView['nombrePersona'] = $this->jelgeneral->leerCelda($data,0,$row,4);
        $dataView['apellidoPersona'] = $this->jelgeneral->leerCelda($data,0,$row,5);
        $dataView['carrera'] = $this->jelgeneral->leerCelda($data,0,$row,6);
        $dataView['anoPeriodo'] = $this->jelgeneral->leerCelda($data,0,$row,7);
        $dataView['parcialPeriodo'] = $this->jelgeneral->leerCelda($data,0,$row,8);

        //VERIFICACIÓN DEL SEXO DE LA PERSONA
        $dataView['sexoPersona'] = (($dataView['sexoPersona']=='F') || ($dataView['sexoPersona']=='M')) ? $dataView['sexoPersona'] : 'D';

        $dataView['tipoCedulaPersona'] = utf8_encode($dataView['tipoCedulaPersona']);
        $dataView['cedulaPersona'] = utf8_encode($dataView['cedulaPersona']);
        $dataView['sexoPersona'] = utf8_encode($dataView['sexoPersona']);
        $dataView['nombrePersona'] = utf8_encode($dataView['nombrePersona']);
        $dataView['apellidoPersona'] = utf8_encode($dataView['apellidoPersona']);
        $dataView['carrera'] = utf8_encode($dataView['carrera']);
        $dataView['anoPeriodo'] = utf8_encode($dataView['anoPeriodo']);
        $dataView['parcialPeriodo'] = utf8_encode($dataView['parcialPeriodo']);
        //poner el código que guarda en las tablas



        $result = $this->cargaModel->insertActivoNOJEL($dataView['tipoCedulaPersona'], $dataView['cedulaPersona'],
                        $dataView['sexoPersona'], $dataView['nombrePersona'], $dataView['apellidoPersona'],
                        $dataView['institutoId'], $dataView['carrera'], $dataView['anoPeriodo'],
                        $dataView['parcialPeriodo'], 1); //OJO el usuario_id

        $estudiante =$dataView['tipoCedulaPersona'] .'-'.$dataView['cedulaPersona'].' - '.$dataView['nombrePersona'].' '.$dataView['apellidoPersona'];
        if ($result == -1)
        {
          $logMsg = 'REGISTRO '.$contReg.': El estudiante '.$estudiante.' está registrado como Aspirante'.chr(13).chr(10);
          $dataView['errorMsg'] = ($dataView['errorMsg'] == '') ? 'ERROR DE CARGA DE DATOS' : $dataView['errorMsg'];
        }
        else if ($result == -2)
        {
          $logMsg = 'REGISTRO '.$contReg.': El estudiante '.$estudiante.' está registrado como Sorteado'.chr(13).chr(10);
          $dataView['errorMsg'] = ($dataView['errorMsg'] == '') ? 'ERROR DE CARGA DE DATOS' : $dataView['errorMsg'];
        }
        else if ($result == -3)
        {
          $logMsg = 'REGISTRO '.$contReg.': El estudiante '.$estudiante.' está registrado como Beneficiario'.chr(13).chr(10);
          $dataView['errorMsg'] = ($dataView['errorMsg'] == '') ? 'ERROR DE CARGA DE DATOS' : $dataView['errorMsg'];
        }
        else if ($result == -4)
        {
          $logMsg = 'REGISTRO '.$contReg.': El periodo (Año:'.$dataView['anoPeriodo'].', Parcial:'.$dataView['parcialPeriodo'].') no existe en BD. Registro NO Cargado'.chr(13).chr(10);
          $dataView['errorMsg'] = ($dataView['errorMsg'] == '') ? 'ERROR DE CARGA DE DATOS' : $dataView['errorMsg'];
        }
        else
        {
          $logMsg = 'REGISTRO '.$contReg.': Cargado Correctamente'.chr(13).chr(10);
        }
        if ( ! write_file($outputFilename, $logMsg,'a'))
        {
          $dataView['errorMsg'] = $dataView['errorMsg'].'Error en la escritura del archivo '.$outputFilename.chr(13).chr(10);
        }

        
        
        $dataView['result']=$result;
        $row++;
        $contReg++;
        $tipoCedulaPersona = $this->jelgeneral->leerCelda($data,0,$row,1);
      }
      
     
      //ABRIR ARCHIVO EXCEL
			$this->load->view('carga/cargaResult', $dataView);
		}


  }


}
?>
