<?php
/**
 * @property CI_Loader $load
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property CI_Email $email
 * @property CI_DB_active_record $db
 * @property CI_DB_forge $dbforge
 */

class aprobacionBeca extends Controller
{


  function aprobacionBeca()
  {

    parent::Controller();
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->model('aspiranteModel');
    $this->load->model('aprobacionBecaModel');
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
    //$this->load->library('xajax');
    
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

  function aprobacionBecaControl()
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
    $config['total_rows'] = $this->aprobacionBecaModel->getNumTotalAspirante($campo, $criterio, $valor);
    $config['per_page'] = 10;
    $config['uri_segment'] = 3;
    $config['first_link'] = 'Inicio';
    $config['last_link'] = 'Fin';

    $data['result']=$this->aprobacionBecaModel->getAllAspirante($campo, $criterio, $valor, $page, $config['per_page']);

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
    $this->load->view('operaciones/aprobacionBecaList', $data);
  }

  function aprobacionBecaForm()
  {
    $id =$this->uri->segment(3);
    $data['id'] = $id;

    $data['fechaSolucion'] = date('d/m/Y');//$this->jelgeneral->arreglarFechaBD();

    $data['paises']= $this->paisModel->getAllPais('', '', '', '', '');

    $data['becas']= $this->becaModel->getAllBeca('', '', '', '', '');
    $data['carreras']= $this->carreraModel->getAllDistinctCarrera();
   
    $data['activo'] = 1;

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
      $data['fechaNacimientoPersona'] = $this->jelgeneral->arreglarFechaBD($reg->fecha_nacimiento_persona);
      $data['tipoCedulaPersona'] = $reg->tipo_cedula_persona;
      $data['cedulaPersona'] = $reg->cedula_persona;
      $data['nombrePais'] = $reg->nombre_pais;
      $data['nombreBeca'] = $reg->nombre_tipo_beca.' - '.$reg->nombre_beca;
      if($reg->carrera != '-1')
        $data['carrera'] = $reg->carrera;
      else
        $data['carrera'] = '';
      $contacto = !$reg->nombre_persona  ? '(NINGUNO)' : $reg->nombre_persona.' '.$reg->apellido_persona;
      $data['procedencia'] = $reg->nombre_tipo_procedencia.' - '.$reg->fecha_procedencia.' - '.$reg->lugar_procedencia.' - '.$contacto;
      $data['procedenciaId'] = $reg->procedencia_id;
      $data['instruccionProcedencia'] = $reg->instruccion_procedencia;
      $data['nombreEstado'] = $reg->nombre_estado;
      $data['nombreMunicipio'] = $reg->nombre_municipio;
      $data['nombreParroquia'] = $reg->nombre_parroquia;
      $data['representanteId'] = $reg->representante_id == null ? -1 : $reg->representante_id ;
      $data['nombreRepresentante'] = $reg->nombre_representante;
      $data['apellidoRepresentante'] = $reg->apellido_representante;
      $data['tipoCedulaRepresentante'] = $reg->tipo_cedula_representante;
      $data['cedulaRepresentante'] = $reg->cedula_representante;
      $data['filtroPersona']= $this->personaModel->getFiltroPersona($reg->cedula_persona);
      $data['nombreBanco'] = $reg->nombre_banco;
      $data['becaId'] = $reg->beca_id;
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
      if($reg->tipo_cuenta_persona==1)
        $data['tipoCuentaPersona'] = 'Ahorro';
      else if($reg->tipo_cuenta_persona==2)
        $data['tipoCuentaPersona'] = 'Corriente';
      else
        $data['tipoCuentaPersona'] = 'F.A.L';
      $data['numeroCuentaPersona'] = $reg->numero_cuenta_persona;
      $data['activo'] = $reg->activo;
    }
    //$this->load->view('mantenimiento/personaForm', $data);
    $this->load->view('operaciones/aprobacionBecaForm', $data);
  }

  function aprobacionBecaRecord()
  {
    $this->load->library('form_validation');
    $this->form_validation->set_rules('txtFechaAprobacion', 'Fecha de Aprobación', 'required');
   

    $data['id'] = $_POST['txtId'];
    $data['nombrePersona'] = $_POST['txtNombrePersona'];
    $data['apellidoPersona'] = $_POST['txtApellidoPersona'];
    $data['fechaNacimientoPersona'] = $_POST['txtFechaNacimientoPersona'];
    $data['fechaNacimientoPersona'] = $this->jelgeneral->arreglarFechaBD($data['fechaNacimientoPersona']);

    $data['fechaAprobacionBeca'] = $_POST['txtFechaAprobacion'];
    $data['fechaAprobacionBeca'] = $this->jelgeneral->arreglarFechaBD($data['fechaAprobacionBeca']);

    $data['tipoCedulaPersona'] = $_POST['txtTipoCedulaPersona'];
    $data['cedulaPersona'] = $_POST['txtCedulaPersona'];
    $data['procedencia'] = $_POST['txtProcedencia'];
    $data['nombrePais'] = $_POST['txtPais'];
    $data['nombreEstado'] = $_POST['txtEstado'];
    $data['nombreMunicipio'] = $_POST['txtMunicipio'];
    $data['nombreParroquia'] = $_POST['txtParroquia'];
    $data['representanteId'] = $_POST['txtRepresentanteId'];
    $data['tipoCedulaRepresentante'] = $_POST['txtTipoCedulaRepresentante'];
    $data['cedulaRepresentante'] = $_POST['txtCedulaRepresentante'];
    $data['nombreRepresentante'] = $_POST['txtNombreRepresentante'];
    $data['apellidoRepresentante'] =  $_POST['txtApellidoRepresentante'];
    $data['nombreBanco'] = $_POST['txtBanco'];
    $data['nombreBeca'] = $_POST['txtBeca'];
    $data['becas']= $this->becaModel->getAllBeca('', '', '', '', '');
    $data['telefono01Persona'] = $_POST['txtTelefono01Persona'];
    $data['telefono02Persona'] = $_POST['txtTelefono02Persona'];
    $data['telefono03Persona'] = $_POST['txtTelefono02Persona'];
    $data['telefono04Persona'] = $_POST['txtTelefono04Persona'];
    $data['direccion01Persona'] = $_POST['txtDireccion01Persona'];
    $data['direccion02Persona'] = $_POST['txtDireccion02Persona'];
    $data['direccion03Persona'] = $_POST['txtDireccion02Persona'];//AQUI ESTOY USANDO LA MISMA DIRECCIÓN 02
    $data['emailPersona'] = $_POST['txtEmailPersona'];
    $data['sexoPersona'] = $_POST['txtSexoPersona'];
    $data['tipoCuentaPersona'] = $_POST['txtTipoCuentaPersona'];
    $data['numeroCuentaPersona'] = $_POST['txtNumeroCuentaPersona'];
    $data['carrera'] = $_POST['txtCarrera'];
    //$data['liceoId'] = $_POST['cmbLiceo'];
    $data['liceoId'] = '-1'; //ojo esto está pasando -1 por defecto porque aun no es necesario
    $data['anoGrado'] = $_POST['txtAnoGrado'];
    $data['promedioNota'] = $_POST['txtPromedioNota'];
    //$data['madrePersonaId'] = $_POST[''];
    $data['tipoCedulaMadre'] = $_POST['txtTipoCedulaMadre'];
    $data['cedulaMadre'] = $_POST['txtCedulaMadre'];
    $data['nombreMadre'] = $_POST['txtNombreMadre'];
    $data['apellidoMadre'] = $_POST['txtApellidoMadre'];
    //$data['padrePersonaId'] = $_POST[''];
    $data['tipoCedulaPadre'] = $_POST['txtTipoCedulaPadre'];
    $data['cedulaPadre'] = $_POST['txtCedulaPadre'];
    $data['nombrePadre'] = $_POST['txtNombrePadre'];
    $data['apellidoPadre'] = $_POST['txtApellidoPadre'];
    $data['nroMbroNucleoFamiliar'] = $_POST['txtNroMbroNucleoFamiliar'];
    $data['nroMbroMayorEdad'] = $_POST['txtNroMbroMayorEdad'];
    $data['activo'] = $_POST['txtActivo'];
    
    //Carga del menú principal de la aplicación
    $centinela  = new Centinela();
    $menu_final['opciones']   = $this->mod_demenu->inicio($centinela->getId());
    $data['menu'] = $this->load->view('vis_menu',$menu_final,true);
    //$data['menu']=$this->load->view('menu', $data,true);
    if ($this->form_validation->run() == FALSE)
    {
      $this->load->view('operaciones/aprobacionBecaForm',$data);
    }
    else
    {
      $dataMsg['result'] = $this->aprobacionBecaModel->insertAprobacionBeca($data['fechaAprobacionBeca'], $data['id'],
                           $data['activo']);
      //echo $dataMsg['result'];

      $this->jelgeneral->mensaje($this,'Aspirante Aprobado Exitosamente','aprobacionBeca/aprobacionBecaControl','black');

    }
  }


/*
  function aprobacionBecaDelete()
  {
    $id =$this->uri->segment(3);
    $data['result'] = $this->aspiranteModel->deleteAspirante($id);
    $this->jelgeneral->mensaje($this,'Registro Eliminado Exitosamente','aspirante/aspiranteControl','black');
  }
*/
}
?>
