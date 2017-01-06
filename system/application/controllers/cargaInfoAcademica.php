<?php


class cargaInfoAcademica extends Controller
{

  function cargaInfoAcademica()
  {

    parent::Controller();

    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->helper('file');
    $this->load->library('JELGeneral');
   $this->load->model('cargaModel');
   $this->load->model('institutoModel');

  }

  function cargaInfoAcademicaControl()
  {
    //Carga del menú principal de la aplicación
    $centinela  = new Centinela();
    $menu_final['opciones']   = $this->mod_demenu->inicio($centinela->getId());
    $data['menu'] = $this->load->view('vis_menu',$menu_final,true);
    //$x=0;
    //$data['menu']=$this->load->view('menu', $x, true);
    $data['institutos'] = $this->institutoModel->getAllInstituto('', '', '', '', '');;
    $data['error']='';

    $this->load->view('carga/cargaInfoAcademicaForm', $data);
  }


  function cargaInfoAcademicaRecord()
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

			$this->load->view('carga/cargaInfoAcademicaForm', $dataView);
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
      $dataView['returnPage'] ='cargaInfoAcademica/cargaInfoAcademicaControl';
      $dataView['titulo'] ='Carga de Informaci&oacute;n Acad&eacute;mica';
      $instituto = $this->jelgeneral->leerCelda($data,0,3,3);

       $reg=$this->institutoModel->getInstituto($dataView['institutoId']);


      $tipoCedulaPersona = '';
      $tipoCedulaPersona = $this->jelgeneral->leerCelda($data,0,$row,1);
      $contReg = 1;

      $dataView['errorMsg'] = '';
      $dataView['outputFilename'] = 'InfoAcad_('.$reg->siglas_instituto.')_'.date("Y-m-d_H-i-s").'.log';
      $outputFilename = './logs/'.$dataView['outputFilename'];
      while($tipoCedulaPersona != '')
      {
        $dataView['tipoCedulaPersona'] = $this->jelgeneral->leerCelda($data,0,$row,1);
        $dataView['cedulaPersona'] = $this->jelgeneral->leerCelda($data,0,$row,2);
        $dataView['nombrePersona'] = $this->jelgeneral->leerCelda($data,0,$row,3);
        $dataView['apellidoPersona'] = $this->jelgeneral->leerCelda($data,0,$row,4);
        //$dataView['carrera'] = $this->jelgeneral->leerCelda($data,0,$row,5);
        $dataView['anoPeriodo'] = $this->jelgeneral->leerCelda($data,0,$row,6);
        $dataView['parcialPeriodo'] = $this->jelgeneral->leerCelda($data,0,$row,7);
        $dataView['codigoMateria'] = $this->jelgeneral->leerCelda($data,0,$row,8);
        $dataView['nombreMateria'] = $this->jelgeneral->leerCelda($data,0,$row,9);
        $dataView['notaMateria'] = $this->jelgeneral->leerCelda($data,0,$row,10);
        $dataView['siglasEstadoMateria'] = $this->jelgeneral->leerCelda($data,0,$row,11);
        $dataView['estadoMateria'] = $this->jelgeneral->leerCelda($data,0,$row,12);
        $dataView['turnoMateria'] = $this->jelgeneral->leerCelda($data,0,$row,13);

        
        $dataView['tipoCedulaPersona'] = utf8_encode($dataView['tipoCedulaPersona']);
        $dataView['cedulaPersona'] = utf8_encode($dataView['cedulaPersona']);
        $dataView['nombrePersona'] = utf8_encode($dataView['nombrePersona']);
        $dataView['apellidoPersona'] = utf8_encode($dataView['apellidoPersona']);
        //$dataView['carrera'] = utf8_encode($dataView['carrera']);
        $dataView['anoPeriodo'] = utf8_encode($dataView['anoPeriodo']);
        $dataView['parcialPeriodo'] = utf8_encode($dataView['parcialPeriodo']);
        $dataView['codigoMateria'] = utf8_encode($dataView['codigoMateria']);
        $dataView['nombreMateria'] = utf8_encode($dataView['nombreMateria']);
        $dataView['notaMateria'] = utf8_encode($dataView['notaMateria']);
        $dataView['siglasEstadoMateria'] = utf8_encode($dataView['siglasEstadoMateria']);
        $dataView['estadoMateria'] = utf8_encode($dataView['estadoMateria']);
        $dataView['turnoMateria'] = utf8_encode($dataView['turnoMateria']);

        $dataView['notaMateria'] = (is_numeric($dataView['notaMateria'])) ? $dataView['notaMateria'] : -1;
        //OJO LA NOTA LA TENGO QUE VERIFICAR AQUÍ Y PONERLA EN MENOS UNO SI VIENE VACÍA

        $result = $this->cargaModel->insertInfoAcademica($dataView['tipoCedulaPersona'], $dataView['cedulaPersona'],
                        $dataView['institutoId'], $dataView['anoPeriodo'], $dataView['parcialPeriodo'],
                        $dataView['codigoMateria'], $dataView['notaMateria'], $dataView['siglasEstadoMateria'],
                        $dataView['turnoMateria'], 1);


        $estudiante =$dataView['tipoCedulaPersona'] .'-'.$dataView['cedulaPersona'].' - '.$dataView['nombrePersona'].' '.$dataView['apellidoPersona'];
        if ($result == -1)//EL ESTUDIANTE NO ESTÁ REGISTRADO COMO BENEFICIARIO JEL
        {
          $logMsg = 'REGISTRO '.$contReg.': El estudiante '.$estudiante.' NO está registrado como Beneficiario. Registro NO Cargado'.chr(13).chr(10);
          $dataView['errorMsg'] = ($dataView['errorMsg'] == '') ? 'ERROR DE CARGA DE DATOS' : $dataView['errorMsg'];
        }
        else if ($result == -2)//EL ESTUDIANTE NO ESTÁ ASIGNADO A NINGUNA BECA UNIVERSITARIA
        {
          $logMsg = 'REGISTRO '.$contReg.': El estudiante '.$estudiante.' NO tiene asignada ninguna beca de tipo Universitario. Registro NO Cargado'.chr(13).chr(10);
          $dataView['errorMsg'] = ($dataView['errorMsg'] == '') ? 'ERROR DE CARGA DE DATOS' : $dataView['errorMsg'];
        }
        else if ($result == -3)//EL ESTUDIANTE NO ESTÁ ASIGNADO AL INSTITUTO SELECCIONADO
        {
          $logMsg = 'REGISTRO '.$contReg.': El estudiante '.$estudiante.' NO está asignado al instituto seleccionado. Registro NO Cargado'.chr(13).chr(10);
          $dataView['errorMsg'] = ($dataView['errorMsg'] == '') ? 'ERROR DE CARGA DE DATOS' : $dataView['errorMsg'];
        }
        else if ($result == -4)//EL PERIODO NO EXISTE
        {
          $logMsg = 'REGISTRO '.$contReg.': El periodo (Año:'.$dataView['anoPeriodo'].', Parcial:'.$dataView['parcialPeriodo'].') no existe en BD. Registro NO Cargado'.chr(13).chr(10);
          $dataView['errorMsg'] = ($dataView['errorMsg'] == '') ? 'ERROR DE CARGA DE DATOS' : $dataView['errorMsg'];
        }
        else if ($result == -5)//NO EXISTE UNA MATERIA CON ESE CÓDIGO
        {
          $logMsg = 'REGISTRO '.$contReg.': La Materia '.$dataView['nombreMateria'].' (Código:'.$dataView['codigoMateria'].') no existe en BD. Registro NO Cargado'.chr(13).chr(10);
          $dataView['errorMsg'] = ($dataView['errorMsg'] == '') ? 'ERROR DE CARGA DE DATOS' : $dataView['errorMsg'];
        }
        else if ($result == -6)//NO EXISTE UNA MATERIA CON ESE CÓDIGO EN EL INSTITUTO SELECCIONADO
        {
          $logMsg = 'REGISTRO '.$contReg.': La Materia '.$dataView['nombreMateria'].' (Código:'.$dataView['codigoMateria'].') no existe para el Instituto seleccionado. Registro NO Cargado'.chr(13).chr(10);
          $dataView['errorMsg'] = ($dataView['errorMsg'] == '') ? 'ERROR DE CARGA DE DATOS' : $dataView['errorMsg'];
        }
        else if ($result == -7)//LA MATERIA NO PERTENECE A LA CARRERA DEL ESTUDIANTE
        {
          $logMsg = 'REGISTRO '.$contReg.': La Materia '.$dataView['nombreMateria'].' (Código:'.$dataView['codigoMateria'].') no no pertenece a la Carrera que tiene asignada el Beneficiario. Registro NO Cargado'.chr(13).chr(10);
          $dataView['errorMsg'] = ($dataView['errorMsg'] == '') ? 'ERROR DE CARGA DE DATOS' : $dataView['errorMsg'];
        }
        else if ($result == -8)//EL ESTADO DE MATERIA NO EXISTE EN LA BASE DE DATOS
        {
          $logMsg = 'REGISTRO '.$contReg.': El Estado de Materia '.$dataView['estadoMateria'].' (Código:'.$dataView['siglasEstadoMateria'].') no existe en BD. Registro NO Cargado'.chr(13).chr(10);
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
