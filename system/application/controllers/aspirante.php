<?php
/**
 * @property CI_Loader $load
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property CI_Email $email
 * @property CI_DB_active_record $db
 * @property CI_DB_forge $dbforge
 */

class aspirante extends Controller
{
  var $javaScriptText ='';

  function aspirante()
  {

    parent::Controller();
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->model('aspiranteModel');
    $this->load->model('procedenciaModel');
    $this->load->model('carreraModel');
    $this->load->model('paisModel');
    $this->load->model('estadoModel');
    $this->load->model('municipioModel');
    $this->load->model('parroquiaModel');
    $this->load->model('bancoModel');
    $this->load->model('personaModel');
    $this->personaModel->nombre_tabla ='persona';
    $this->load->model('becaModel');
    $this->load->library('JELGeneral');
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
  }

    function aspiranteSubmit()
  {
    $opcion = $_POST['txtOpcion'];
    $cedulaPersona = $_POST['txtCedulaPersona'];
   
    if($opcion == 1)
    {
      $this->buscarPersona($cedulaPersona);
    }
    else
    {
      $this->aspiranteRecord();
    }
  }

  function buscarPersona($cedPersona)
  {
    $persona = $this->personaModel->getAllPersona('cedula_persona', 'Sea Igual a', $cedPersona, '', '');
    
    $data['procedenciaId'] = $_POST['cmbProcedencia'];
  
    if($persona->num_rows()!=0)
    {

      $persona = $persona->row();
      $data['nombrePersona'] = $persona->nombre_persona;
      $data['apellidoPersona'] = $persona->apellido_persona;
      $data['fechaNacimientoPersona'] = $persona->fecha_nacimiento_persona;
      $data['fechaNacimientoPersona'] = $this->jelgeneral->arreglarFechaBD($data['fechaNacimientoPersona']);
      $data['tipoCedulaPersona'] = $persona->tipo_cedula_persona;
      $data['cedulaPersona'] = $cedPersona; //$persona->cedula_persona;
      $data['nacionalidad'] = $persona->nacionalidad;
      $data['paisId'] = $persona->pais_id;
      $data['estadoId'] = $persona->estado_id;
      $data['estados']= $this->estadoModel->getAllEstado('pais_id', 'Sea Igual a', $persona->pais_id, '', '');
      $data['municipioId'] = $persona->municipio_id;
      $data['municipios']= $this->municipioModel->getAllMunicipio('estado_id', 'Sea Igual a', $persona->estado_id, '', '');
      $data['parroquiaId'] = $persona->parroquia_id;
      $data['parroquias']= $this->parroquiaModel->getAllParroquia('municipio_id', 'Sea Igual a', $persona->municipio_id, '', '');
      $data['representanteId'] = $persona->representante_id == null ? -1 : $persona->representante_id ;
      $data['nombreRepresentante'] = $persona->nombre_representante;
      $data['apellidoRepresentante'] = $persona->apellido_representante;
      $data['tipoCedulaRepresentante'] = $persona->tipo_cedula_representante;
      $data['cedulaRepresentante'] = $persona->cedula_representante;
      $data['bancoId'] = $persona->banco_id;
      $data['telefono01Persona'] = $persona->telefono01_persona;
      $data['telefono02Persona'] = $persona->telefono02_persona;
      $data['telefono03Persona'] = $persona->telefono03_persona;
      $data['telefono04Persona'] = $persona->telefono04_persona;
      $data['direccion01Persona'] = $persona->direccion01_persona;
      $data['direccion02Persona'] = $persona->direccion02_persona;
      $data['direccion03Persona'] = $persona->direccion03_persona;
      $data['emailPersona'] = $persona->email_persona;
      $data['sexoPersona'] = $persona->sexo_persona;
      $data['tipoCuentaPersona'] = $persona->tipo_cuenta_persona;
      $data['numeroCuentaPersona'] = $persona->numero_cuenta_persona;
    }
    else
    {
      $data['nombrePersona'] = '';
      $data['apellidoPersona'] = '';
      $data['fechaNacimientoPersona'] = '';
      $data['tipoCedulaPersona'] = 'V';
      $data['cedulaPersona'] = $cedPersona; 
      $data['nacionalidad'] = -1;
      $data['paisId'] = -1;
      $data['estadoId'] = -1;
      $data['estados']= $this->estadoModel->getAllEstado('', '', '', '', '');
      $data['municipioId'] = -1;
      $data['municipios']= $this->municipioModel->getAllMunicipio('', '', '', '', '');
      $data['parroquiaId'] = -1;
      $data['parroquias']= $this->parroquiaModel->getAllParroquia('', '', '', '', '');
      $data['representanteId'] =  -1;
      $data['nombreRepresentante'] = '';
      $data['apellidoRepresentante'] = '';
      $data['tipoCedulaRepresentante'] = '';
      $data['cedulaRepresentante'] = '';
      $data['bancoId'] = '';
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
    }

    $aspirante = $this->aspiranteModel->getAllAspirante('cedula_persona', 'Sea Igual a', $cedPersona, '', '');
     if($aspirante->num_rows()!=0)
    {

      $aspirante = $aspirante->row();
      $data['anoGrado'] = $aspirante->ano_grado;
      $data['promedioNota'] = $aspirante->promedio_nota;
      $data['nroMbroNucleoFamiliar'] = $aspirante->nro_mbro_nucleo_familiar;
      $data['nroMbroMayorEdad'] = $aspirante->nro_mbro_mayor_edad;
      $data['madrePersonaId'] = $aspirante->madre_persona_id;
      $data['tipoCedulaMadre'] = $aspirante->tipo_cedula_madre;
      $data['cedulaMadre'] = $aspirante->cedula_madre;
      $data['nombreMadre'] = $aspirante->nombre_madre;
      $data['apellidoMadre'] = $aspirante->apellido_madre;
      $data['padrePersonaId'] = $aspirante->padre_persona_id;
      $data['tipoCedulaPadre'] = $aspirante->tipo_cedula_padre;
      $data['cedulaPadre'] = $aspirante->cedula_padre;
      $data['nombrePadre'] = $aspirante->nombre_padre;
      $data['apellidoPadre'] = $aspirante->apellido_padre;
    }
    else
    {
      $data['anoGrado'] = '';
      $data['promedioNota'] = '';
      $data['nroMbroNucleoFamiliar'] = '';
      $data['nroMbroMayorEdad'] = '';
      $data['madrePersonaId'] = '-1';
      $data['tipoCedulaMadre'] = '';
      $data['cedulaMadre'] = '';
      $data['nombreMadre'] = '';
      $data['apellidoMadre'] = '';
      $data['padrePersonaId'] = '-1';
      $data['tipoCedulaPadre'] = '';
      $data['cedulaPadre'] = '';
      $data['nombrePadre'] = '';
      $data['apellidoPadre'] = '';
    }

    $data['id'] = -1;

    $data['paises']= $this->paisModel->getAllPais('', '', '', '', '');
    $data['procedencias']= $this->procedenciaModel->getAllProcedencia('', '', '', '', '');
    $data['bancos']= $this->bancoModel->getAllBanco('', '', '', '', '');
    $data['becaId'] = '-1';
    $data['becas']= $this->becaModel->getAllBeca('', '', '', '', '');
    $data['carreras']= $this->carreraModel->getAllDistinctCarrera();
    $data['carrera']= '';
    $data['filtroPersona']= $this->personaModel->getFiltroPersona($cedPersona);
    $data['liceo_id']= '-1';
    $data['carrera'] = '';
        
    $data['activo'] = 1;
    $data['js'] = $this->javaScriptText;
    //Carga del menú principal de la aplicación
    $centinela  = new Centinela();
    $menu_final['opciones']   = $this->mod_demenu->inicio($centinela->getId());
    $data['menu'] = $this->load->view('vis_menu',$menu_final,true);
    //$data['menu']=$this->load->view('menu', $data,true);

    $this->load->view('operaciones/aspiranteForm', $data);

  }


  function buscarPersonaMadre($cedMadre)
  {

     $objResponse = new xajaxResponse();

    $madre = $this->personaModel->getAllPersona('cedula_persona', 'Sea Igual a', $cedMadre, '', '');

    $resultNombre ='';
    $resultApellido='';
    if($madre->num_rows()!=0)
    {
      $madre = $madre->row();
      $resultNombre = ' <input name="txtNombreMadre" type="text" id="txtNombreMadre" value="'.$madre->nombre_persona.'" size="38">';
      $resultApellido = ' <input name="txtApellidoMadre" type="text" id="txtApellidoMadre" value="'.$madre->apellido_persona.'" size="38">';
    }
    else
    {
      $resultNombre = ' <input name="txtNombreMadre" type="text" id="txtNombreMadre" value="No Encontrado, Escriba el Nombre Aquí" size="38">';
      $resultApellido = ' <input name="txtApellidoMadre" type="text" id="txtApellidoMadre" value="No Encontrado, Escriba el Apellido Aquí" size="38">';
    }

     $objResponse->Assign('divNombreMadre', "innerHTML", $resultNombre);
     $objResponse->Assign('divApellidoMadre', "innerHTML", $resultApellido);
     return $objResponse;

  }

  function buscarPersonaPadre($cedPadre)
  {

     $objResponse = new xajaxResponse();

    $padre = $this->personaModel->getAllPersona('cedula_persona', 'Sea Igual a', $cedPadre, '', '');

    $resultNombre ='';
    $resultApellido='';
    if($padre->num_rows()!=0)
    {
      $padre = $padre->row();
      $resultNombre = ' <input name="txtNombrePadre" type="text" id="txtNombrePadre" value="'.$padre->nombre_persona.'" size="38">';
      $resultApellido = ' <input name="txtApellidoPadre" type="text" id="txtApellidoPadre" value="'.$padre->apellido_persona.'" size="38">';
    }
    else
    {
      $resultNombre = ' <input name="txtNombrePadre" type="text" id="txtNombrePadre" value="No Encontrado, Escriba el Nombre Aquí" size="38">';
      $resultApellido = ' <input name="txtApellidoPadre" type="text" id="txtApellidoPadre" value="No Encontrado, Escriba el Apellido Aquí" size="38">';
    }

     $objResponse->Assign('divNombrePadre', "innerHTML", $resultNombre);
     $objResponse->Assign('divApellidoPadre', "innerHTML", $resultApellido);
     return $objResponse;

  }

  function buscarPersonaRepresentante($cedRepresentante)
  {

     $objResponse = new xajaxResponse();

    $representante = $this->personaModel->getAllPersona('cedula_persona', 'Sea Igual a', $cedRepresentante, '', '');

    $resultNombre ='';
    $resultApellido='';
    if($representante->num_rows()!=0)
    {
      $representante = $representante->row();
      $resultNombre = ' <input name="txtNombreRepresentante" type="text" id="txtNombreRepresentante" value="'.$representante->nombre_persona.'" size="38">'.
      ' <input name="txtRepresentanteId" type="hidden" id="txtRepresentanteId" value="'.$representante->persona_id.'">';
      $resultApellido = ' <input name="txtApellidoRepresentante" type="text" id="txtApellidoRepresentante" value="'.$representante->apellido_persona.'" size="38">';
    }
    else
    {
      $resultNombre = ' <input name="txtNombreRepresentante" type="text" id="txtNombreRepresentante" value="No Encontrado, Escriba el Nombre Aquí" size="38">'.
      ' <input name="txtRepresentanteId" type="hidden" id="txtRepresentanteId" value="-1">';
      $resultApellido = ' <input name="txtApellidoRepresentante" type="text" id="txtApellidoRepresentante" value="No Encontrado, Escriba el Apellido Aquí" size="38">';
    }

     $objResponse->Assign('divNombreRepresentante', "innerHTML", $resultNombre);
     $objResponse->Assign('divApellidoRepresentante', "innerHTML", $resultApellido);
     return $objResponse;

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

  function aspiranteControl()
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

    $config['base_url'] =   base_url().'/index.php/aspirante/aspiranteControl/';
    $config['total_rows'] = $this->aspiranteModel->getNumTotalAspirante($campo, $criterio, $valor);
    $config['per_page'] = 10;
    $config['uri_segment'] = 3;
    $config['first_link'] = 'Inicio';
    $config['last_link'] = 'Fin';

    $data['result']=$this->aspiranteModel->getAllAspirante($campo, $criterio, $valor, $page, $config['per_page']);

    $this->pagination->initialize($config);
    $pages = $this->pagination->create_links();

    $data['pages']=$this->jelgeneral->getFilterPages($pages,$campo,$criterio,$valor);

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

    $this->load->view('operaciones/aspiranteList', $data);
  }

  function aspiranteForm()
  {
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
    $data['procedenciaId'] = -1;
    $data['procedencias']= $this->procedenciaModel->getAllProcedencia('', '', '', '', '');
    $data['estadoId'] = -1;
    $data['municipioId'] = -1;
    $data['parroquiaId'] = -1;
    $data['representanteId'] = -1;
    $data['nombreRepresentante'] = '';
    $data['apellidoRepresentante'] = '';
    $data['tipoCedulaRepresentante'] = '';
     $data['cedulaRepresentante'] = '';
    $data['bancoId'] = '';
    $data['filtroPersona']= '';
    $data['bancos']= $this->bancoModel->getAllBanco('', '', '', '', '');
    $data['becaId'] = '-1';
    $data['becas']= $this->becaModel->getAllBeca('', '', '', '', '');
    $data['carreras']= $this->carreraModel->getAllDistinctCarrera();
    $data['carrera']= '';
    $data['liceo_id']= '-1';
    $data['telefono01Persona'] = '';
    $data['telefono02Persona'] = '';
    $data['telefono03Persona'] = '';
    $data['telefono04Persona'] = '';
    $data['direccion01Persona'] = '';
    $data['direccion02Persona'] = '';
    $data['direccion03Persona'] = '';
    $data['emailPersona'] = '';
    $data['sexoPersona'] = '';
    $data['carrera'] = '';
    $data['anoGrado'] = '';
    $data['promedioNota'] = '';
    $data['madrePersonaId'] = '-1';
    $data['tipoCedulaMadre'] = '';
    $data['cedulaMadre'] = '';
    $data['nombreMadre'] = '';
    $data['apellidoMadre'] = '';
    $data['padrePersonaId'] = '-1';
    $data['tipoCedulaPadre'] = '';
    $data['cedulaPadre'] = '';
    $data['nombrePadre'] = '';
    $data['apellidoPadre'] = '';
    $data['nroMbroNucleoFamiliar'] = '';
    $data['nroMbroMayorEdad'] = '';
    $data['tipoCuentaPersona'] = '-1';
    $data['numeroCuentaPersona'] = '';
    $data['activo'] = 1;
    $data['js'] = $this->javaScriptText;
    //Carga del menú principal de la aplicación
    $centinela  = new Centinela();
    $menu_final['opciones']   = $this->mod_demenu->inicio($centinela->getId());
    $data['menu'] = $this->load->view('vis_menu',$menu_final,true);
    //$data['menu']=$this->load->view('menu', $data,true);

    if($id!=-1)
    {
      $reg=$this->aspiranteModel->getAspirante($id);
      $data['nombrePersona'] = $reg->nombre_persona;
      $data['apellidoPersona'] = $reg->apellido_persona;
      $data['fechaNacimientoPersona'] = $reg->fecha_nacimiento_persona;
      $data['fechaNacimientoPersona'] = $this->jelgeneral->arreglarFechaBD($data['fechaNacimientoPersona']);
      $data['tipoCedulaPersona'] = $reg->tipo_cedula_persona;
      $data['cedulaPersona'] = $reg->cedula_persona;
      $data['nacionalidad'] = $reg->nacionalidad;
      $data['paisId'] = $reg->pais_id;
      $data['procedenciaId'] = $reg->procedencia_id;
      $data['estadoId'] = $reg->estado_id;
      $data['estados']= $this->estadoModel->getAllEstado('pais_id', 'Sea Igual a', $reg->pais_id, '', '');
      $data['municipioId'] = $reg->municipio_id;
      $data['municipios']= $this->municipioModel->getAllMunicipio('estado_id', 'Sea Igual a', $reg->estado_id, '', '');
      $data['parroquiaId'] = $reg->parroquia_id;
      $data['parroquias']= $this->parroquiaModel->getAllParroquia('municipio_id', 'Sea Igual a', $reg->municipio_id, '', '');
      $data['representanteId'] = $reg->representante_id == null ? -1 : $reg->representante_id ;
      $data['nombreRepresentante'] = $reg->nombre_representante;
      $data['apellidoRepresentante'] = $reg->apellido_representante;
      $data['tipoCedulaRepresentante'] = $reg->tipo_cedula_representante;
      $data['cedulaRepresentante'] = $reg->cedula_representante;
      $data['filtroPersona']= $this->personaModel->getFiltroPersona($reg->cedula_persona);
      $data['bancos']= $this->bancoModel->getAllBanco('', '', '', '', '');
      $data['bancoId'] = $reg->banco_id;
      $data['becaId'] = $reg->beca_id;
      $data['carrera']= $reg->carrera;
      $data['liceo_id']= $reg->liceo_id;
      $data['telefono01Persona'] = $reg->telefono01_persona;
      $data['telefono02Persona'] = $reg->telefono02_persona;
      $data['telefono03Persona'] = $reg->telefono03_persona;
      $data['telefono04Persona'] = $reg->telefono04_persona;
      $data['direccion01Persona'] = $reg->direccion01_persona;
      $data['direccion02Persona'] = $reg->direccion02_persona;
      $data['direccion03Persona'] = $reg->direccion03_persona;
      $data['emailPersona'] = $reg->email_persona;
      $data['sexoPersona'] = $reg->sexo_persona;
      $data['carrera'] = $reg->carrera;
      $data['anoGrado'] = $reg->ano_grado;
      $data['promedioNota'] = $reg->promedio_nota;
      $data['madrePersonaId'] = $reg->madre_persona_id;
      $data['tipoCedulaMadre'] = $reg->tipo_cedula_madre;
      $data['cedulaMadre'] = $reg->cedula_madre;
      $data['nombreMadre'] = $reg->nombre_madre;
      $data['apellidoMadre'] = $reg->apellido_madre;
      $data['padrePersonaId'] = $reg->padre_persona_id;
      $data['tipoCedulaPadre'] = $reg->tipo_cedula_padre;
      $data['cedulaPadre'] = $reg->cedula_padre;
      $data['nombrePadre'] = $reg->nombre_padre;
      $data['apellidoPadre'] = $reg->apellido_padre;
      $data['nroMbroNucleoFamiliar'] = $reg->nro_mbro_nucleo_familiar;
      $data['nroMbroMayorEdad'] = $reg->nro_mbro_mayor_edad;
      $data['tipoCuentaPersona'] = $reg->tipo_cuenta_persona;
      $data['numeroCuentaPersona'] = $reg->numero_cuenta_persona;
      $data['activo'] = $reg->activo;
    }
    //$this->load->view('mantenimiento/personaForm', $data);
    $this->load->view('operaciones/aspiranteForm', $data);
  }

  function aspiranteRecord()
  {
    $this->load->library('form_validation');
    $this->form_validation->set_rules('txtNombrePersona', 'Nombre', 'required');
    $this->form_validation->set_rules('txtApellidoPersona', 'Apellido', 'required');
    $this->form_validation->set_rules('cmbTipoCedulaPersona', 'C&eacute;dula', 'required');
    $this->form_validation->set_rules('txtCedulaPersona', 'C&eacute;dula', 'required');

    if($_POST['txtCedulaMadre'] <> '')
    {
      $this->form_validation->set_rules('txtNombreMadre', 'Nombre de la Madre', 'required');
      $this->form_validation->set_rules('txtApellidoMadre', 'Apellido de la Madre', 'required');
      $this->form_validation->set_rules('cmbTipoCedulaMadre', 'C&eacute;dula de la Madre', 'required');
      $this->form_validation->set_rules('txtCedulaMadre', 'C&eacute;dula de la Madre', 'required');
    }

    if($_POST['txtCedulaPadre'] <> '')
    {
      $this->form_validation->set_rules('txtNombrePadre', 'Nombre del Padre', 'required');
      $this->form_validation->set_rules('txtApellidoMadre', 'Apellido del Padre', 'required');
      $this->form_validation->set_rules('cmbTipoCedulaMadre', 'C&eacute;dula del Padre', 'required');
      $this->form_validation->set_rules('txtCedulaMadre', 'C&eacute;dula del Padre', 'required');
    }

    if($_POST['txtCedulaRepresentante'] <> '')
    {
      $this->form_validation->set_rules('txtNombreRepresentante', 'Nombre del Representante', 'required');
      $this->form_validation->set_rules('txtApellidoRepresentante', 'Apellido del Representante', 'required');
      $this->form_validation->set_rules('cmbTipoCedulaRepresentante', 'C&eacute;dula del Representante', 'required');
      $this->form_validation->set_rules('txtCedulaRepresentante', 'C&eacute;dula del Representante', 'required');
    }

    $data['id'] = $_POST['txtId'];
    $data['nombrePersona'] = $_POST['txtNombrePersona'];
    $data['apellidoPersona'] = $_POST['txtApellidoPersona'];
    $data['fechaNacimientoPersona'] = $_POST['txtFechaNacimientoPersona'];
    $data['fechaNacimientoPersona'] = $this->jelgeneral->arreglarFechaBD($data['fechaNacimientoPersona']);
    $data['tipoCedulaPersona'] = $_POST['cmbTipoCedulaPersona'];
    $data['cedulaPersona'] = $_POST['txtCedulaPersona'];
    $data['nacionalidad'] = $_POST['cmbNacionalidad'];
    $data['procedenciaId'] = $_POST['cmbProcedencia'];
    $data['paisId'] = $_POST['cmbPais'];
    $data['paises']= $this->paisModel->getAllPais('', '', '', '', '');
    $data['estadoId'] = $_POST['cmbEstado'];
    $data['estados']= $this->estadoModel->getAllEstado('pais_id', 'Sea Igual a', $data['paisId'], '', '');
    $data['municipioId'] = $_POST['cmbMunicipio'];
    $data['municipios']= $this->municipioModel->getAllMunicipio('estado_id', 'Sea Igual a', $data['estadoId'], '', '');
    $data['parroquiaId'] = $_POST['cmbParroquia'];
    $data['parroquias']= $this->parroquiaModel->getAllParroquia('municipio_id', 'Sea Igual a', $data['municipioId'], '', '');
    $data['representanteId'] = $_POST['txtRepresentanteId'];
    $data['tipoCedulaRepresentante'] = $_POST['cmbTipoCedulaRepresentante'];
    $data['cedulaRepresentante'] = $_POST['txtCedulaRepresentante'];
    $data['nombreRepresentante'] = $_POST['txtNombreRepresentante'];
    $data['apellidoRepresentante'] =  $_POST['txtApellidoRepresentante'];
    $data['bancoId'] = $_POST['cmbBanco'];
    $data['bancos']= $this->bancoModel->getAllBanco('', '', '', '', '');
    $data['becaId'] = $_POST['cmbBeca'];
    $data['becas']= $this->becaModel->getAllBeca('', '', '', '', '');
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
    $data['carrera'] = $_POST['cmbCarrera'];
    //$data['liceoId'] = $_POST['cmbLiceo'];
    $data['liceoId'] = '-1'; //ojo esto está pasando -1 por defecto porque aun no es necesario
    $data['anoGrado'] = $_POST['txtAnoGrado'];
    $data['promedioNota'] = $_POST['txtPromedioNota'];
    //$data['madrePersonaId'] = $_POST[''];
    $data['tipoCedulaMadre'] = $_POST['cmbTipoCedulaMadre'];
    $data['cedulaMadre'] = $_POST['txtCedulaMadre'];
    $data['nombreMadre'] = $_POST['txtNombreMadre'];
    $data['apellidoMadre'] = $_POST['txtApellidoMadre'];
    //$data['padrePersonaId'] = $_POST[''];
    $data['tipoCedulaPadre'] = $_POST['cmbTipoCedulaPadre'];
    $data['cedulaPadre'] = $_POST['txtCedulaPadre'];
    $data['nombrePadre'] = $_POST['txtNombrePadre'];
    $data['apellidoPadre'] = $_POST['txtApellidoPadre'];
    $data['nroMbroNucleoFamiliar'] = $_POST['txtNroMbroNucleoFamiliar'];
    $data['nroMbroMayorEdad'] = $_POST['txtNroMbroMayorEdad'];
    $data['activo'] = $_POST['txtActivo'];
    $data['js'] = $this->javaScriptText;
    //Carga del menú principal de la aplicación
    $centinela  = new Centinela();
    $menu_final['opciones']   = $this->mod_demenu->inicio($centinela->getId());
    $data['menu'] = $this->load->view('vis_menu',$menu_final,true);
    //$data['menu']=$this->load->view('menu', $data,true);
    if ($this->form_validation->run() == FALSE)
    {
      $this->load->view('operaciones/aspiranteForm',$data);
    }
    else
    {
      if($data['id'] == -1)
      {

/*ORDEN DE LOS PARAMETROS
   1           2            3                 4             5                  6              7               8
pais_id, parroquia_id, representante_id, banco_id, tipo_cedula_persona, cedula_persona, nombre_persona, apellido_persona,
      9                        10               11                  12                   13                   14
telefono01_persona, telefono02_persona, telefono03_persona, telefono04_persona, direccion01_persona, direccion02_persona,
         15               16            17                 18                  19                 20        21
direccion03_persona, email_persona, sexo_persona, tipo_cuenta_persona, numero_cuenta_persona, usuario_id, activo,
          22                      23              24            25            26               27               28
fecha_nacimiento_persona, tipo_cedula_madre, cedula_madre, nombre_madre, apellido_madre, tipo_cedula_padre, cedula_padre,
     29             30              31           32            33          34       35              36
nombre_padre, apellido_padre, procedencia_id, ano_grado, promedio_nota, beca_id, liceo_id, nro_mbro_nucleo_familiar,
        37                 38             39          40               41                      42
nro_mbro_mayor_edad, fecha_solucion, observaciones, carrera, tipo_cedula_representante, cedula_representante,
         43                    44
 nombre_representante, apellido_representante

*/

         $dataMsg['result'] = $this->aspiranteModel->insertAspirante($data['paisId'], $data['parroquiaId'],
                              $data['representanteId'], $data['bancoId'], $data['tipoCedulaPersona'],
                              $data['cedulaPersona'], $data['nombrePersona'], $data['apellidoPersona'],
                              $data['telefono01Persona'], $data['telefono02Persona'], $data['telefono03Persona'],
                              $data['telefono04Persona'], $data['direccion01Persona'], $data['direccion02Persona'],
                              $data['direccion03Persona'], $data['emailPersona'], $data['sexoPersona'],
                              $data['tipoCuentaPersona'], $data['numeroCuentaPersona'], $data['activo'],
                              $data['fechaNacimientoPersona'], $data['tipoCedulaMadre'], $data['tipoCedulaMadre'],
                              $data['cedulaMadre'], $data['nombreMadre'], $data['apellidoMadre'],
                              $data['tipoCedulaPadre'], $data['cedulaPadre'], $data['nombrePadre'],
                              $data['apellidoPadre'], $data['procedenciaId'], $data['anoGrado'], $data['promedioNota'],
                              $data['becaId'], $data['liceoId'], $data['nroMbroNucleoFamiliar'],
                              $data['nroMbroMayorEdad'],$data['carrera'],$data['tipoCedulaRepresentante'],
                              $data['cedulaRepresentante'], $data['nombreRepresentante'], $data['apellidoRepresentante']);
         echo $dataMsg['result'];
         if( $dataMsg['result']==-1)
         {
           $this->jelgeneral->mensaje($this,'El Registro Ya exsiste para la Procedencia seleccionada <br> NO SE INCLUYÓ EL REGISTRO','aspirante/aspiranteControl','#FF0000');
         }
         else
         {
           $this->jelgeneral->mensaje($this,'Registro Almacenado Exitosamente','aspirante/aspiranteControl','black');
         }
         
      }
      else
      {
        $dataMsg['result'] = $this->aspiranteModel->updateAspirante($data['id'], $data['paisId'], $data['parroquiaId'],
                              $data['representanteId'], $data['bancoId'], $data['tipoCedulaPersona'],
                              $data['cedulaPersona'], $data['nombrePersona'], $data['apellidoPersona'],
                              $data['telefono01Persona'], $data['telefono02Persona'], $data['telefono03Persona'],
                              $data['telefono04Persona'], $data['direccion01Persona'], $data['direccion02Persona'],
                              $data['direccion03Persona'], $data['emailPersona'], $data['sexoPersona'],
                              $data['tipoCuentaPersona'], $data['numeroCuentaPersona'], $data['activo'],
                              $data['fechaNacimientoPersona'], $data['tipoCedulaMadre'], $data['tipoCedulaMadre'],
                              $data['cedulaMadre'], $data['nombreMadre'], $data['apellidoMadre'],
                              $data['tipoCedulaPadre'], $data['cedulaPadre'], $data['nombrePadre'],
                              $data['apellidoPadre'], $data['procedenciaId'], $data['anoGrado'], $data['promedioNota'],
                              $data['becaId'], $data['liceoId'], $data['nroMbroNucleoFamiliar'],
                              $data['nroMbroMayorEdad'],$data['carrera']);
       $this->jelgeneral->mensaje($this,'Registro Modificado Exitosamente','aspirante/aspiranteControl','black');
      }
    }
  }



  function aspiranteDelete()
  {
    $id =$this->uri->segment(3);
    $data['result'] = $this->aspiranteModel->deleteAspirante($id);
    $this->jelgeneral->mensaje($this,'Registro Eliminado Exitosamente','aspirante/aspiranteControl','black');
  }

}
?>
