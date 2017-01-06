<?php
/**
 * @property CI_Loader $load
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property CI_Email $email
 * @property CI_DB_active_record $db
 * @property CI_DB_forge $dbforge
 */



class accionBeneficiario extends Controller
{

  var $classBaseName;
  var $baseDir;
  var $javaScriptText ='';

  function accionBeneficiario()
  {
    parent::Controller();
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->model('beneficiarioModel');
    $this->load->model('accionBeneficiarioModel');
    $this->load->model('periodoModel');
    $this->load->model('municipioModel');
    $this->load->model('parroquiaModel');
    $this->load->model('institutoModel');
    $this->load->model('becaModel');
    $this->load->model('accionModel');
    $this->load->model('institutoModel');
    $this->load->model('nucleoModel');
    $this->load->model('carreraModel');
    $this->load->library('JELGeneral');
    $this->classBaseName ='accionBeneficiario';
    $this->baseDir ='operaciones';
    $this->xajax->registerFunction(array('buildSelectCambios', &$this, 'buildSelectCambios'));
    $this->xajax->registerFunction(array('buildSelectCarreras', &$this, 'buildSelectCarreras'));
    $this->xajax->processRequest();
    $this->javaScriptText = $this->xajax->getJavascript(base_url());
    
  }

  function buildSelectCambios($accionId, $institutoId, $nucleoId, $carreraId)
  {

    $objResponse = new xajaxResponse();

    $accionIdCambioInstituto = $this->accionBeneficiarioModel->getAccionIdCambioInstituto();
    $accionIdCambioNucleo = $this->accionBeneficiarioModel->getAccionIdCambioNucleo();
    $accionIdCambioCarrera = $this->accionBeneficiarioModel->getAccionIdCambioCarrera();

    if (($accionId != $accionIdCambioInstituto) && ($accionId != $accionIdCambioNucleo) && ($accionId != $accionIdCambioCarrera))
    {
      $objResponse->Assign('divCabeceraNucleo',  "innerHTML", '');
      $objResponse->Assign('divInstituto',  "innerHTML", '');
      $objResponse->Assign('divNucleo',  "innerHTML", '');
      $objResponse->Assign('divCarrera',  "innerHTML", '');
      return;
    }
      
    $institutos = $this->institutoModel->getAllInstituto('', '', '', '', '');

    $nucleos = $this->nucleoModel->getAllNucleo('instituto_id','Sea Igual a', $institutoId, '', '');
    $carreras = $this->carreraModel->getAllCarreraInstituto('instituto_id','Sea Igual a', $institutoId, '', '');



    $result =' <input type="hidden" name="txtInstitutoId" value="'.$institutoId.'"> ';

    //echo $accionId;
    if ($accionId != $accionIdCambioInstituto)
      $result ='<select name="cmbInstituto" id="cmbInstituto" style="width:180px" onChange="xajax_buildSelectCarreras(this.value)"  disabled> ';
    else
      $result ='<select name="cmbInstituto" id="cmbInstituto" style="width:180px" onChange="xajax_buildSelectCarreras(this.value)"> ';
      
    $result = $result .'>';
    if($institutos->num_rows()!=0)
    {
      foreach($institutos->result() as $row)
      {
          $result = $result .'<option value="'.$row->instituto_id.'"';
          if($row->instituto_id == $institutoId)
            $result = $result .' selected';
          $result = $result .'>';
          $result = $result .$row->siglas_instituto.'</option> ';

      }
    }
    $result = $result .'</select>';
    $objResponse->Assign('divCabeceraInstituto',  "innerHTML", 'Instituto&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nucleo&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Carrera');
    $objResponse->Assign('divInstituto',  "innerHTML", $result);


    $result  = $result .' <input type="hidden" name="txtNucleoId" value="'.$nucleoId.'"> ';
    $result ='<select name="cmbNucleo" id="cmbNucleo" style="width:180px" ';
    if ($accionId == $accionIdCambioCarrera)
      $result = $result .'disabled';
    $result = $result .'>';
    if($nucleos->num_rows()!=0)
    {
      foreach($nucleos->result() as $row)
      {
          $result = $result .'<option value="'.$row->nucleo_instituto_id.'"';
          if($row->nucleo_instituto_id == $nucleoId)
            $result = $result .' selected';
          $result = $result .'>';
          $result = $result .$row->siglas_nucleo_instituto.'</option> ';

      }
    }
    $result = $result .'</select>';
    $objResponse->Assign('divCabeceraNucleo',  "innerHTML", 'Nucleo');
    $objResponse->Assign('divNucleo',  "innerHTML", $result);

    $result = '<select name="cmbCarrera" id="cmbCarrera" style="width:360px">';
    $result = $result .'</select>';

    $result ='<select name="cmbCarrera" id="cmbCarrera" style="width:360px" ';
    if ($accionId == $accionIdCambioNucleo)
      $result = $result .'disabled';
    $result = $result .'>';
    $result = $result .'<option value="-1"></option> ';
    if($carreras->num_rows()!=0)
    {
      foreach($carreras->result() as $row)
      {
          $result = $result .'<option value="'.$row->carrera_instituto_id.'"';
          if($row->carrera_instituto_id == $carreraId)
            $result = $result .' selected';
          $result = $result .'>';
          $result = $result .$row->nombre_carrera.'</option> ';

      }
    }
    $result = $result .'</select>';
    $objResponse->Assign('divCabeceraCarrera',  "innerHTML", 'Carrera');
    $objResponse->Assign('divCarrera', "innerHTML", $result);

    return $objResponse;
  }


    function buildSelectCarreras($institutoId)
  {
    $objResponse = new xajaxResponse();

    $nucleos = $this->nucleoModel->getAllNucleo('instituto_id', 'Sea Igual a', $institutoId, '', '');

    $result ='';

    $result = $result .'<select name="cmbNucleo" id="cmbNucleo" style="width:180px"> ';
    $result = $result .'<option></option> ';
    if($nucleos->num_rows()!=0)
    {
      foreach($nucleos->result() as $row)
      {
        $result = $result . '<option value = "'.$row->nucleo_instituto_id.'">'.$row->nombre_nucleo_instituto.'</option>';
      }
    }
    $result = $result . ' </select> ';
    $objResponse->Assign('divNucleo', "innerHTML", $result);

    $carreras = $this->carreraModel->getAllCarreraInstituto('instituto_id', 'Sea Igual a', $institutoId, '', '');

    $result = '<select name="cmbCarrera" id="cmbCarrera" style="width:360px"> ';
    $result = $result .'<option></option> ';
    if($carreras->num_rows()!=0)
    {
      foreach($carreras->result() as $row)
      {
        $result = $result . '<option value = "'.$row->carrera_instituto_id.'">'.$row->nombre_carrera.'</option>';
      }
    }
    $result = $result . ' </select> ';


    $objResponse->Assign('divCarrera', "innerHTML", $result);
    return $objResponse;
  }

  function getAllAccionBeneficiario()
  {
    $becaPersonaId =$this->uri->segment(3);
    
    $data['result']=$this->accionBeneficiarioModel->getAllAccionBeneficiario('beca_persona_id', 'Sea igual a', $becaPersonaId, '', '');
    //Llamada al view que muestra la lista de registros
    $this->load->view($this->baseDir.'/'.$this->classBaseName.'Hist', $data);

  }

  function accionBeneficiarioControl()
  {
      
    $this->load->library('pagination');
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

    $config['base_url'] =   base_url().'/index.php/'.$this->classBaseName.'/'.$this->classBaseName.'Control/';
    $config['total_rows'] = $this->beneficiarioModel->getNumTotalBeneficiario($campo, $criterio, $valor);
    $config['per_page'] = 10;
    $config['uri_segment'] = 3;
    $config['first_link'] = 'Inicio';
    $config['last_link'] = 'Fin';

    $data['result']=$this->beneficiarioModel->getAllBeneficiario($campo, $criterio, $valor, $page, $config['per_page']);

    $this->pagination->initialize($config);
    $pages = $this->pagination->create_links();

    $data['pages']=$this->jelgeneral->getFilterPages($pages,$campo,$criterio,$valor);
    //$data['pages']='sdfasdfa'.$pages.$campo.$criterio.$valor;

    //Carga del menú principal de la aplicación
    $centinela  = new Centinela();
    $menu_final['opciones']   = $this->mod_demenu->inicio($centinela->getId());
    $data['menu'] = $this->load->view('vis_menu',$menu_final,true);
    //$data['menu']=$this->load->view('menu', $data,true);

    $data['campo']=$campo;
    $data['criterio']=$criterio;
    $data['valor']=$valor;

    //Permisologia
    $data['permisos']['i'] = $this->mod_usuario->evalua_permiso('i','',$this->uri->segment(1));
    $data['permisos']['m'] = $this->mod_usuario->evalua_permiso('m','',$this->uri->segment(1));
    $data['permisos']['b'] = $this->mod_usuario->evalua_permiso('b','',$this->uri->segment(1));
   //fin permisologia a copiar

    //Llamada al view que muestra la lista de registros
    $this->load->view($this->baseDir.'/'.$this->classBaseName.'List', $data);
  }

  function accionBeneficiarioHistory()
  {

    $this->load->library('pagination');

    $becaPersonaId =is_numeric($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
    $page =is_numeric($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

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

    $config['base_url'] =   base_url().'/index.php/'.$this->classBaseName.'/'.$this->classBaseName.'Control/';
    $config['total_rows'] = $this->accionBeneficiarioModel->getNumTotalAccionBeneficiario($becaPersonaId, $campo, $criterio, $valor);
    $config['per_page'] = 10;
    $config['uri_segment'] = 3;
    $config['first_link'] = 'Inicio';
    $config['last_link'] = 'Fin';

    $data['result']=$this->accionBeneficiarioModel->getAllAccionBeneficiario($becaPersonaId, $campo, $criterio, $valor, $page, $config['per_page']);

    $this->pagination->initialize($config);
    $pages = $this->pagination->create_links();

    $data['pages']=$this->jelgeneral->getFilterPages($pages,$campo,$criterio,$valor);

    $regs=$this->beneficiarioModel->getBeneficiario($becaPersonaId);

    $data['tipoCedulaPersona'] = $regs['beneficiario']->tipo_cedula_persona;
    $data['cedulaPersona'] = $regs['beneficiario']->cedula_persona;
    $data['nombrePersona'] = $regs['beneficiario']->nombre_persona;
    $data['apellidoPersona'] = $regs['beneficiario']->apellido_persona;
    
    $data['campo']=$campo;
    $data['criterio']=$criterio;
    $data['valor']=$valor;
    //Llamada al view que muestra la lista de registros
    $this->load->view($this->baseDir.'/accionBeneficiarioHist', $data);
  
  }

  function accionBeneficiarioForm()
  {

    //$tipoProcedenciaIdCenso = $this->configuracionModel->getProcedenciaIdCenso();
    $becaPersonaId =$this->uri->segment(3);

    $data['becaPersonaId'] = $becaPersonaId;

    //OJO con esto repitiendo variables
    //$data['procedenciaPersonaId'] = $becaPersonaId;
    //$data['procedenciaId'] = $becaPersonaId;
    //$data['sorteoId'] = $becaPersonaId;
        

    $regs=$this->beneficiarioModel->getBeneficiario($becaPersonaId);

    $data['procedencia'] =  $regs['procedencia']->nombre_procedencia;
    $data['sorteo'] =  $regs['sorteo']->nombre_sorteo;
       
    //$data['nacionalidadPersona'] =$regs['procedencia']->nacionalidad;
    $data['becaJelId'] = $regs['beneficiario']->beca_jel_id;
    $data['tipoCedulaPersona'] = $regs['beneficiario']->tipo_cedula_persona;
    $data['personaId'] = $regs['beneficiario']->persona_id;
    $data['cedulaPersona'] = $regs['beneficiario']->cedula_persona;
    $data['nombrePersona'] = $regs['beneficiario']->nombre_persona;
    $data['apellidoPersona'] = $regs['beneficiario']->apellido_persona;
    $data['nombreEstadoPersona'] = $regs['beneficiario']->nombre_estado_persona;
    $data['telefono01Persona'] = $regs['procedencia']->telefono01_persona;
    $data['telefono02Persona'] = $regs['procedencia']->telefono02_persona;
    $data['institutoId'] = $regs['beneficiario']->instituto_id;
    $data['nucleoId'] = $regs['beneficiario']->nucleo_instituto_id;
    $data['carreraId'] = $regs['beneficiario']->carrera_instituto_id;
    //$data['telefono04Persona'] = $regs['procedencia']->telefono04_persona;
    $data['direccion01Persona'] = $regs['procedencia']->direccion01_persona;
    //$data['direccion02Persona'] = $regs['procedencia']->direccion02_persona;
    //$data['direccion03Persona'] = $regs['procedencia']->direccion03_persona;
    //$data['fechaNacimientoPersona'] = $regs['procedencia']->fecha_nacimiento_persona;
    $data['emailPersona'] = $regs['procedencia']->email_persona;
    $data['sexoPersona'] = $regs['procedencia']->sexo_persona;
    //$data['paises']= $this->paisModel->getAllPais('', '', '', '', '');
    //$data['paisId'] = $regs['procedencia']->pais_id;
    //$data['estadoId'] = $regs['procedencia']->estado_id;
    //$data['estados']= $this->estadoModel->getAllEstado('pais_id', 'Sea Igual a', $regs['procedencia']->pais_id, '', '');
    $this->accionModel->nombre_tabla = 'accion';
    $data['acciones']= $this->accionModel->getAllAccionEstado('', '', '', '', '');
    $data['accionId'] = -1;
    $data['estadoId'] = $regs['procedencia']->estado_id;
    $data['municipioId'] = $regs['procedencia']->municipio_id;
    $data['municipios']= $this->municipioModel->getAllMunicipio('estado_id', 'Sea Igual a', $regs['procedencia']->estado_id, '', '');
    $data['parroquiaId'] = $regs['procedencia']->parroquia_id;
    $data['parroquias']= $this->parroquiaModel->getAllParroquia('municipio_id', 'Sea Igual a', $regs['procedencia']->municipio_id, '', '');

    $data['fechaIngreso'] = $regs['beneficiario']->fecha_ingreso;
    $data['nombreBeca'] = $regs['beneficiario']->nombre_tipo_beca.' - '.$regs['beneficiario']->nombre_beca;
    $data['nombreInstituto'] = $regs['beneficiario']->nombre_instituto;
    $data['nombreNucleoInstituto'] = $regs['beneficiario']->nombre_nucleo_instituto;
    $data['nombreCarrera'] = $regs['beneficiario']->nombre_carrera;
    //$data['nroHijo'] = $regs['beneficiario']->numero_hijo;
    $data['fechaAccion'] = '';
    $data['periodos']= $this->periodoModel->getAllPeriodo('', '', '', '', '');
    $data['periodoId'] = -1;
    $data['razonAccion'] = '';
  

    $data['activo'] = $regs['beneficiario']->activo;
    $data['js'] = $this->javaScriptText;
    //Carga del menú principal de la aplicación
    $centinela  = new Centinela();
    $menu_final['opciones']   = $this->mod_demenu->inicio($centinela->getId());
    $data['menu'] = $this->load->view('vis_menu',$menu_final,true);
    //$data['menu']=$this->load->view('menu', $data,true);
    //Llamada al view del formulario
    $this->load->view($this->baseDir.'/'.$this->classBaseName.'Form', $data);
     
  }

  function accionBeneficiarioRecord()
  {
    $this->load->library('form_validation');

    $this->form_validation->set_rules('cmbAccion', 'Accion', 'required');
    $this->form_validation->set_rules('txtFechaAccion', 'Fecha de la Acción', 'required');
    $this->form_validation->set_rules('cmbPeriodoAccion', 'Priodo de la Acción', 'required');
    $this->form_validation->set_rules('txtRazonAccion', 'Justificación', 'required');
    
    $carreraId = isset($_POST['cmbCarrera']) ? $_POST['cmbCarrera'] : -1;
    if (isset($_POST['cmbNucleo']))
      $nucleoId = $_POST['cmbNucleo'];
    else if (isset($_POST['txtNucleoId']))
      $nucleoId = $_POST['txtNucleoId'];
    else
      $nucleoId = -1;
    $data['becaPersonaId'] = $_POST['txtBecaPersonaId'];

    $data['procedencia'] = $_POST['txtProcedencia'];
    $data['sorteo'] = $_POST['txtSorteo'];

    $data['becaJelId'] = $_POST['txtBecaJelId'];
    $data['tipoCedulaPersona'] = $_POST['cmbTipoCedulaPersona'];
    $data['personaId'] = $_POST['txtPersonaId'];
    $data['cedulaPersona'] = $_POST['txtCedulaPersona'];
    $data['nombrePersona'] = $_POST['txtNombrePersona'];
    $data['apellidoPersona'] = $_POST['txtApellidoPersona'];
    $data['emailPersona'] = $_POST['txtEmailPersona'];
    $data['sexoPersona'] = $_POST['cmbSexoPersona'];
    $data['telefono01Persona'] = $_POST['txtTelefono01Persona'];
    $data['telefono02Persona'] = $_POST['txtTelefono02Persona'];
    $data['direccion01Persona'] = $_POST['txtDireccion01Persona'];

    $data['estadoId'] =  $_POST['txtEstadoId'];
    $data['municipioId'] = $_POST['cmbMunicipio'];
    $data['municipios']= $this->municipioModel->getAllMunicipio('estado_id', 'Sea Igual a', $_POST['txtEstadoId'], '', '');
    $data['parroquiaId'] = $_POST['cmbParroquia'];
    $data['parroquias']= $this->parroquiaModel->getAllParroquia('municipio_id', 'Sea Igual a', $data['municipioId'], '', '');

    $data['fechaIngreso'] = $_POST['txtFechaIngreso'];
    $data['fechaIngreso'] = $this->jelgeneral->arreglarFechaBD($data['fechaIngreso']);
    $data['nombreBeca'] = $_POST['txtNombreBeca'];
    $data['nombreInstituto'] = $_POST['txtNombreInstituto'];
    $data['nombreNucleoInstituto'] = $_POST['txtNombreNucleoInstituto'];
    $data['nombreCarrera'] = $_POST['txtNombreCarrera'];

    $this->accionModel->nombre_tabla = 'accion';
    $data['acciones']= $this->accionModel->getAll('', '', '', '', '');

    $data['accionId'] = $_POST['cmbAccion'];
    $data['fechaAccion'] = $_POST['txtFechaAccion'];
    $data['fechaAccion'] = $this->jelgeneral->arreglarFechaBD($data['fechaAccion']);

    $data['periodoId'] = $_POST['cmbPeriodoAccion'];
    $data['razonAccion'] = $_POST['txtRazonAccion'];
    $data['periodos']= $this->periodoModel->getAllPeriodo('', '', '', '', '');

    $data['activo'] = $_POST['txtActivo'];
    $data['usuarioId'] = 1; //OJO falta lo del usuario

    $data['js'] = $this->javaScriptText;
    
    //Carga del menú principal de la aplicación
    $centinela  = new Centinela();
    $menu_final['opciones']   = $this->mod_demenu->inicio($centinela->getId());
    $data['menu'] = $this->load->view('vis_menu',$menu_final,true);
    //$data['menu']=$this->load->view('menu', $data,true);
    if ($this->form_validation->run() == FALSE)
    {
      //Llamada al view del formulario
      $this->load->view($this->baseDir.'/'.$this->classBaseName.'Form',$data);
    }
    else
    {
      $dataMsg['result'] = $this->accionBeneficiarioModel->insertAccionBeneficiario($data['accionId'], $data['becaPersonaId'],
                           $data['periodoId'], $data['fechaAccion'], $data['razonAccion'], $data['usuarioId'], $data['activo'], 
                           $nucleoId, $carreraId);


      $this->jelgeneral->mensaje($this,'Registro Almacenado Exitosamente',$this->classBaseName.'/'.$this->classBaseName.'Control/','black');
    }
  }

}
?>
