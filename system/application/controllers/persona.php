<?php
/**
 * @property CI_Loader $load
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property CI_Email $email
 * @property CI_DB_active_record $db
 * @property CI_DB_forge $dbforge
 */


class persona extends Controller
{
  var $javaScriptText ='';

  function persona()
  {
    parent::Controller();
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->model('personaModel');
    $this->load->model('paisModel');
    $this->load->model('estadoModel');
    $this->load->model('municipioModel');
    $this->load->model('parroquiaModel');
    $this->load->model('bancoModel');
   
    $this->load->model('Mfrmclass');
    $this->load->library('JELGeneral');
    $this->load->library('Mylib_base');
    $this->load->library('xajax');
    $this->xajax->registerFunction(array('buildSelectEstados', &$this, 'buildSelectEstados'));
    $this->xajax->registerFunction(array('buildSelectMunicipios', &$this, 'buildSelectMunicipios'));
    $this->xajax->registerFunction(array('buildSelectParroquias', &$this, 'buildSelectParroquias'));
    $this->xajax->processRequest();
    $this->javaScriptText = $this->xajax->getJavascript(base_url());
  }



  function buildSelectEstados($paisId)
  {

    $objResponse = new xajaxResponse();

    $estados = $this->estadoModel->getAllEstado('pais_id', 'Sea Igual a', $paisId, '', '');

    $result = '<select name="cmbEstado" id="cmbEstado" style="width:367px" onchange="xajax_buildSelectMunicipios(this.value)">';
    $result = $result .'<option></option>';
    if($estados->num_rows()!=0)
    {
      foreach($estados->result() as $row)
      {
        $result = $result . '<option value = "'.$row->estado_id.'">'.$row->nombre_estado.'</option>';
      }
    }
    $result = $result . '</select>';

    $objResponse->Assign('divCmbEstado', "innerHTML", $result);
    return $objResponse;
  }

  function buildSelectMunicipios($estadoId)
  {

    $objResponse = new xajaxResponse();

    $municipios = $this->municipioModel->getAllMunicipio('estado_id', 'Sea Igual a', $estadoId, '', '');

    $result = '<select name="cmbMunicipio" id="cmbMunicipio" style="width:367px" onchange="xajax_buildSelectParroquias(this.value)">';
    $result = $result .'<option></option>';
    if($municipios->num_rows()!=0)
    {
      foreach($municipios->result() as $row)
      {
        $result = $result . '<option value = "'.$row->municipio_id.'">'.$row->nombre_municipio.'</option>';
      }
    }
    $result = $result . '</select>';
    $objResponse->Assign('divCmbMunicipio', "innerHTML", $result);
    return $objResponse;
  }

  function buildSelectParroquias($municipioId)
  {

    $objResponse = new xajaxResponse();

    $parroquias = $this->parroquiaModel->getAllParroquia('municipio_id', 'Sea Igual a', $municipioId, '', '');

    $result = '<select name="cmbParroquia" id="cmbParroquia" style="width:367px">';
    $result = $result .'<option></option>';
    if($parroquias->num_rows()!=0)
    {
      foreach($parroquias->result() as $row)
      {
        $result = $result . '<option value = "'.$row->parroquia_id.'">'.$row->nombre_parroquia.'</option>';
      }
    }
    $result = $result . '</select>';
    $objResponse->Assign('divCmbParroquia', "innerHTML", $result);
    return $objResponse;
  }


  function personaControl()
  {
    $this->load->library('pagination');

   //vis_sorteo_persona
    $data['sorteo_id'] = '0';
    $this->personaModel->nombre_tabla   = 'persona';
    $this->personaModels->condicion_valo = '';
    $page =is_numeric($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

    if(isset($_POST['bandPost']))
    {
      $campo = isset($_POST['cmbCampo']) ? $_POST['cmbCampo'] : '';
      $criterio = isset($_POST['cmbCriterio']) ? $_POST['cmbCriterio'] : '';
      $valor = isset($_POST['txtValor']) ? $_POST['txtValor'] : '';
    }
    else
    {
      $campo ='';
      $criterio ='';
      $valor ='';
      $uri = current_url();

      $campo = $this->jelgeneral->getSegmentArgument($uri, 'cmbCampo');
      if($campo!='')
      {
        $criterio =  $this->jelgeneral->getSegmentArgument($uri, 'cmbCriterio');
        $valor = $this->jelgeneral->getSegmentArgument($uri, 'txtValor');
      }
    }

    $config['base_url'] =   base_url().'/index.php/persona/personaControl/';
    $config['total_rows'] = $this->personaModel->getNumTotalPersona($campo, $criterio, $valor);
    $config['per_page'] = 10;
    $config['uri_segment'] = 3;
    $config['first_link'] = 'Inicio';
    $config['last_link'] = 'Fin';
    $data['result']=$this->personaModel->getAllPersona($campo, $criterio, $valor, $page, $config['per_page']);

    $this->pagination->initialize($config);
    $pages = $this->pagination->create_links();
    $data['pages']=$this->jelgeneral->getFilterPages($pages,$campo,$criterio,$valor);
    //Carga del menú principal de la aplicación
    $centinela  = new Centinela();
    $menu_final['opciones']   = $this->mod_demenu->inicio($centinela->getId());
    $data['menu'] = $this->load->view('vis_menu',$menu_final,true);
  

    $data['campo']=$campo;
    $data['criterio']=$criterio;
    $data['valor']=$valor;

    $data['titulo'] = 'Control de Personas';
    $data['titulo_valor']  ='persona';

    //Permisologia
    $data['permisos']['i'] = $this->mod_usuario->evalua_permiso('i','',$this->uri->segment(1));
    $data['permisos']['m'] = $this->mod_usuario->evalua_permiso('m','',$this->uri->segment(1));
    $data['permisos']['b'] = $this->mod_usuario->evalua_permiso('b','',$this->uri->segment(1));
   //fin permisologia a copiar


    $this->load->view('mantenimiento/personaList', $data);
  }

  function personaForm()
  {
    $this->personaModel->nombre_tabla   = 'persona';
    $id =$this->uri->segment(3);
    $data['id'] = $id;
    $data['nombrePersona'] = '';
    $data['apellidoPersona'] = '';
    $data['fechaNacimientoPersona'] = '';
    $data['tipoCedulaPersona'] = '';
    $data['cedulaPersona'] = '';
    $data['nacionalidad'] = -1;
    $data['paisId'] = -1;
    $data['paises']= $this->paisModel->getAllPais('', '', '', '', '');
    $data['estadoId'] = -1;
    $data['municipioId'] = -1;
    $data['parroquiaId'] = -1;
    $data['representanteId'] = -1;
    $data['representantePersona'] = '';
    $data['bancoId'] = '';
    $data['bancos']= $this->bancoModel->getAllBanco('', '', '', '', '');
    $data['telefono01Persona'] = '';
    $data['telefono02Persona'] = '';
    $data['telefono03Persona'] = '';
    $data['telefono04Persona'] = '';
    $data['direccion01Persona'] = '';
    $data['direccion02Persona'] = '';
    $data['direccion03Persona'] = '';
    $data['emailPersona'] = '';
    $data['sexoPersona'] = '';
    $data['tipoCuentaPersona'] = '-1';
    $data['numeroCuentaPersona'] = '';
    $data['activo'] = 1;
    $data['js'] = $this->javaScriptText;
    //Carga del menú principal de la aplicación
    $centinela  = new Centinela();
    $menu_final['opciones']   = $this->mod_demenu->inicio($centinela->getId());
    $data['menu'] = $this->load->view('vis_menu',$menu_final,true);


    if($id!=-1)
    {
      $this->personaModel->nombre_tabla   = 'persona';
      $reg=$this->personaModel->getPersona($id);
      $data['nombrePersona'] = $reg->nombre_persona;
      $data['apellidoPersona'] = $reg->apellido_persona;
      $data['fechaNacimientoPersona'] = $this->mylib_base->pg_to_human($reg->fecha_nacimiento_persona);
      $data['tipoCedulaPersona'] = $reg->tipo_cedula_persona;
      $data['cedulaPersona'] = $reg->cedula_persona;
      $data['nacionalidad'] = $reg->nacionalidad;
      $data['paisId'] = $reg->pais_id;
      $data['estadoId'] = $reg->estado_id;
      $data['estados']= $this->estadoModel->getAllEstado('pais_id', 'Sea Igual a', $reg->pais_id, '', '');
      $data['municipioId'] = $reg->municipio_id;
      $data['municipios']= $this->municipioModel->getAllMunicipio('estado_id', 'Sea Igual a', $reg->estado_id, '', '');
      $data['parroquiaId'] = $reg->parroquia_id;
      $data['parroquias']= $this->parroquiaModel->getAllParroquia('municipio_id', 'Sea Igual a', $reg->municipio_id, '', '');
      $data['representanteId'] = $reg->representante_id == null ? -1 : $reg->representante_id ;
      $data['representantePersona'] = $reg->nombre_representante.' '.$reg->apellido_representante;
      $data['bancos']= $this->bancoModel->getAllBanco('', '', '', '', '');
      $data['bancoId'] = $reg->banco_id;
      $data['telefono01Persona'] = $reg->telefono01_persona;
      $data['telefono02Persona'] = $reg->telefono02_persona;
      $data['telefono03Persona'] = $reg->telefono03_persona;
      $data['telefono04Persona'] = $reg->telefono04_persona;
      $data['direccion01Persona'] = $reg->direccion01_persona;
      $data['direccion02Persona'] = $reg->direccion02_persona;
      $data['direccion03Persona'] = $reg->direccion03_persona;
      $data['emailPersona'] = $reg->email_persona;
      $data['sexoPersona'] = $reg->sexo_persona;
      $data['tipoCuentaPersona'] = $reg->tipo_cuenta_persona;
      $data['numeroCuentaPersona'] = $reg->numero_cuenta_persona;
      $data['activo'] = $reg->activo;
    }
    //$this->load->view('mantenimiento/personaForm', $data);
    $this->load->view('mantenimiento/personaForm', $data);
  }

  function personaRecord()
  {
    $this->personaModel->nombre_tabla   = 'persona';
    $this->load->library('form_validation');
    $this->form_validation->set_rules('txtNombrePersona', 'Nombre', 'required');
    $this->form_validation->set_rules('txtApellidoPersona', 'Apellido', 'required');
    $this->form_validation->set_rules('cmbTipoCedulaPersona', 'C&eacute;dula', 'required');
    $this->form_validation->set_rules('txtCedulaPersona', 'C&eacute;dula', 'required');
    //$this->form_validation->set_rules('txtEmailPersona', 'E-mail', 'required');
    //$this->form_validation->set_rules('cmbSexoPersona', 'Sexo', 'required');
    //$this->form_validation->set_rules('cmbNacionalidad', 'Nacionalidad', 'required');
    //$this->form_validation->set_rules('cmbParroquia', 'Parroquia de Habitación', 'required');
    //$this->form_validation->set_rules('txtDireccion01Persona', 'Dirección de Habitación', 'required');
    //$this->form_validation->set_rules('txtTelefono01Persona', 'Tel&eacute;fono 01', 'required');

    $data['id'] = $_POST['txtId'];

    $data['nombrePersona'] = $_POST['txtNombrePersona'];
    $data['apellidoPersona'] = $_POST['txtApellidoPersona'];
    $data['fechaNacimientoPersona'] = $_POST['txtFechaNacimientoPersona'];
    $data['fechaNacimientoPersona'] = $this->jelgeneral->arreglarFechaBD($data['fechaNacimientoPersona']);
    $data['tipoCedulaPersona'] = $_POST['cmbTipoCedulaPersona'];
    $data['cedulaPersona'] = $_POST['txtCedulaPersona'];
    $data['nacionalidad'] = $_POST['cmbNacionalidad'];
    $data['paisId'] = $_POST['cmbPais'];
    $data['paises']= $this->paisModel->getAllPais('', '', '', '', '');
    $data['estadoId'] = $_POST['cmbEstado'];
    $data['estados']= $this->estadoModel->getAllEstado('pais_id', 'Sea Igual a', $data['paisId'], '', '');
    $data['municipioId'] = $_POST['cmbMunicipio'];
    $data['municipios']= $this->municipioModel->getAllMunicipio('estado_id', 'Sea Igual a', $data['estadoId'], '', '');
    $data['parroquiaId'] = $_POST['cmbParroquia'];
    $data['parroquias']= $this->parroquiaModel->getAllParroquia('municipio_id', 'Sea Igual a', $data['municipioId'], '', '');
    $data['representanteId'] = $_POST['txtRepresentanteId'];
    $data['representantePersona'] = $_POST['txtRepresentantePersona'];
    $data['bancoId'] = $_POST['cmbBanco'];
    $data['bancos']= $this->bancoModel->getAllBanco('', '', '', '', '');
    $data['telefono01Persona'] = $_POST['txtTelefono01Persona'];
    $data['telefono02Persona'] = $_POST['txtTelefono02Persona'];
    $data['telefono03Persona'] = $_POST['txtTelefono02Persona'];
    $data['telefono04Persona'] = $_POST['txtTelefono04Persona'];
    $data['direccion01Persona'] = $_POST['txtDireccion01Persona'];
    $data['direccion02Persona'] = $_POST['txtDireccion02Persona'];
    $data['direccion03Persona'] = $_POST['txtDireccion02Persona'];//AQUI ESTOY USANDO LA MISMA DIRECCIÓN 02
    $data['emailPersona'] = $_POST['txtEmailPersona'];
    $data['sexoPersona'] = $_POST['cmbSexoPersona'];
    $data['tipoCuentaPersona'] = $_POST['cmbTipoCuentaPersona'];
    $data['numeroCuentaPersona'] = $_POST['txtNumeroCuentaPersona'];
    $data['activo'] = $_POST['txtActivo'];
    $data['js'] = $this->javaScriptText;
    //Carga del menú principal de la aplicación
    $centinela  = new Centinela();
    $menu_final['opciones']   = $this->mod_demenu->inicio($centinela->getId());
    $data['menu'] = $this->load->view('vis_menu',$menu_final,true);


    if ($this->form_validation->run() == FALSE)
    {
      $this->load->view('mantenimiento/personaForm',$data);
    }
    else
    {
      if($data['id'] == -1)
      {
        $dataMsg['result'] = $this->personaModel->insertPersona($data['paisId'], $data['parroquiaId'],
        $data['representanteId'], $data['bancoId'], $data['tipoCedulaPersona'],
        $data['cedulaPersona'], $data['nombrePersona'], $data['apellidoPersona'],
        $data['telefono01Persona'], $data['telefono02Persona'], $data['telefono03Persona'],
        $data['telefono04Persona'], $data['direccion01Persona'], $data['direccion02Persona'],
        $data['direccion03Persona'], $data['emailPersona'], $data['sexoPersona'],
        $data['tipoCuentaPersona'], $data['numeroCuentaPersona'], $data['activo'],
        $data['fechaNacimientoPersona']);
        $this->jelgeneral->mensaje($this,'Registro Almacenado Exitosamente','persona/personaControl','black');
      }
      else
      {
        $dataMsg['result'] = $this->personaModel->updatePersona($data['id'], $data['paisId'], $data['parroquiaId'],
        $data['representanteId'], $data['bancoId'], $data['tipoCedulaPersona'],
        $data['cedulaPersona'], $data['nombrePersona'], $data['apellidoPersona'],
        $data['telefono01Persona'], $data['telefono02Persona'], $data['telefono03Persona'],
        $data['telefono04Persona'], $data['direccion01Persona'], $data['direccion02Persona'],
        $data['direccion03Persona'], $data['emailPersona'], $data['sexoPersona'],
        $data['tipoCuentaPersona'], $data['numeroCuentaPersona'], $data['activo'],
        $data['fechaNacimientoPersona']);

        $this->jelgeneral->mensaje($this,'Registro Modificado Exitosamente','persona/personaControl','black');
      }
    }
  }

  function personaDelete()
  {
    $id =$this->uri->segment(3);
    $data['result'] = $this->personaModel->deletePersona($id);
    $this->jelgeneral->mensaje($this,'Registro Eliminado Exitosamente','persona/personaControl','black');
  }
}
?>
