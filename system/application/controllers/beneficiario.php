<?php
/**
 * @property CI_Loader $load
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property CI_Email $email
 * @property CI_DB_active_record $db
 * @property CI_DB_forge $dbforge
 */



class beneficiario extends Controller
{

  var $classBaseName;
  var $baseDir;
  var $javaScriptText ='';

  function beneficiario()
  {
    parent::Controller();
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->model('beneficiarioModel');
    $this->load->model('paisModel');
    $this->load->model('estadoModel');
    $this->load->model('municipioModel');
    $this->load->model('parroquiaModel');
    $this->load->model('institutoModel');
    $this->load->model('becaModel');
    $this->load->model('bancoModel');
    $this->load->model('nucleoModel');
    $this->load->model('carreraModel');
    $this->load->library('JELGeneral');
    $this->classBaseName ='beneficiario';
    $this->baseDir ='operaciones';
   $this->xajax->registerFunction(array('buildSelectEstados', &$this, 'buildSelectEstados'));
    $this->xajax->registerFunction(array('buildSelectMunicipios', &$this, 'buildSelectMunicipios'));
    $this->xajax->registerFunction(array('buildSelectParroquias', &$this, 'buildSelectParroquias'));
    $this->xajax->processRequest();
    $this->javaScriptText = $this->xajax->getJavascript(base_url());
  }

/*
  function buildSelectCarreras($institutoId)
  {
    $objResponse = new xajaxResponse();

    $nucleos = $this->nucleoModel->getAllNucleo('instituto_id', 'Sea Igual a', $institutoId, '', '');

    $result ='';
    
    $result = $result .'<select name="cmbNucleo" id="cmbNucleo" style="width:230px"> ';
    $result = $result .'<option></option> ';
    if($nucleos->num_rows()!=0)
    {
      foreach($nucleos->result() as $row)
      {
        $result = $result . '<option value = "'.$row->nucleo_instituto_id.'">'.$row->nombre_nucleo_instituto.'</option>';
      }
    }
    $result = $result . ' </select> &nbsp; ';

    $carreras = $this->carreraModel->getAllCarreraInstituto('instituto_id', 'Sea Igual a', $institutoId, '', '');

    $result = $result .'<select name="cmbCarrera" id="cmbCarrera" style="width:315px"> ';
    $result = $result .'<option></option> ';
    if($carreras->num_rows()!=0)
    {
      foreach($carreras->result() as $row)
      {
        $result = $result . '<option value = "'.$row->carrera_instituto_id.'">'.$row->nombre_carrera.'</option>';
      }
    }
    $result = $result . ' </select> ';


    $objResponse->Assign('divCmbEspecial', "innerHTML", $result);
    return $objResponse;
  }
*/

  function buildSelectEstados($paisId)
  {

    $objResponse = new xajaxResponse();

    $estados = $this->estadoModel->getAllEstado('pais_id', 'Sea Igual a', $paisId, '', '');

    $result = '<select name="cmbEstado" id="cmbEstado" style="width:370px" onchange="xajax_buildSelectMunicipios(this.value)">';
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

    $result = '<select name="cmbParroquia" id="cmbParroquia" style="width:370px">';
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

    function beneficiarioControl()
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

    function beneficiarioForm()
    {

        //$tipoProcedenciaIdCenso = $this->configuracionModel->getProcedenciaIdCenso();
        $becaPersonaId =$this->uri->segment(3);

        $data['becaPersonaId'] = $becaPersonaId;

        //OJO con esto repitiendo variables
        $data['procedenciaId'] = $becaPersonaId;
        $data['sorteoId'] = $becaPersonaId;
        $data['becaPersonaId'] = $becaPersonaId;

        $regs=$this->beneficiarioModel->getBeneficiario($becaPersonaId);

        
        $data['procedencia'] =  $regs['procedencia']->nombre_procedencia;
        //if (isset($data['sorteo']->nombre_sorteo))
        $data['sorteo'] =  $regs['sorteo']->nombre_sorteo;
        //else
          //$data['sorteo'] =  'NA';
        
        
        //$data['nombreParroquiaProcedencia'] = $reg->nombre_parroquia_procedencia;
        $data['nombreEstadoPersona'] = $regs['beneficiario']->nombre_estado_persona;
        $data['nacionalidadPersona'] =$regs['procedencia']->nacionalidad;
        $data['tipoCedulaPersona'] = $regs['beneficiario']->tipo_cedula_persona;
        $data['personaId'] = $regs['beneficiario']->persona_id;
        $data['cedulaPersona'] = $regs['beneficiario']->cedula_persona;
        $data['nombrePersona'] = $regs['beneficiario']->nombre_persona;
        $data['apellidoPersona'] = $regs['beneficiario']->apellido_persona;
        $data['telefono01Persona'] = $regs['procedencia']->telefono01_persona;
        $data['telefono02Persona'] = $regs['procedencia']->telefono02_persona;
        $data['telefono03Persona'] = $regs['procedencia']->telefono03_persona;
        $data['telefono04Persona'] = $regs['procedencia']->telefono04_persona;
        $data['direccion01Persona'] = $regs['procedencia']->direccion01_persona;
        $data['direccion02Persona'] = $regs['procedencia']->direccion02_persona;
        $data['direccion03Persona'] = $regs['procedencia']->direccion03_persona;
        $data['fechaNacimientoPersona'] = $this->jelgeneral->arreglarFechaBD($regs['procedencia']->fecha_nacimiento_persona);
        $data['emailPersona'] = $regs['procedencia']->email_persona;
        $data['sexoPersona'] = $regs['procedencia']->sexo_persona;
        $data['paises']= $this->paisModel->getAllPais('', '', '', '', '');
        $data['paisId'] = $regs['procedencia']->pais_id;
        $data['estadoId'] = $regs['procedencia']->estado_id;
        $data['estados']= $this->estadoModel->getAllEstado('pais_id', 'Sea Igual a', $regs['procedencia']->pais_id, '', '');
        $data['municipioId'] = $regs['procedencia']->municipio_id;
        $data['municipios']= $this->municipioModel->getAllMunicipio('estado_id', 'Sea Igual a', $regs['procedencia']->estado_id, '', '');
        $data['parroquiaId'] = $regs['procedencia']->parroquia_id;
        $data['parroquias']= $this->parroquiaModel->getAllParroquia('municipio_id', 'Sea Igual a', $regs['procedencia']->municipio_id, '', '');


        $data['fechaIngreso'] = $this->jelgeneral->arreglarFechaBD($regs['beneficiario']->fecha_ingreso);
        $data['nombreBeca'] = $regs['beneficiario']->nombre_tipo_beca.' - '.$regs['beneficiario']->nombre_beca;
        $data['nombreInstituto'] = $regs['beneficiario']->nombre_instituto;
        $data['nombreNucleoInstituto'] = $regs['beneficiario']->nombre_nucleo_instituto;
        $data['nombreCarrera'] = $regs['beneficiario']->nombre_carrera;
        $data['nroHijo'] = $regs['beneficiario']->numero_hijo;

        $data['contactadoBeca'] = $regs['beneficiario']->contactado_beca;
        $data['retiroCartaBeca'] = $regs['beneficiario']->retiro_carta_beca;
        $data['inscritoBeca'] = $regs['beneficiario']->inscrito_beca;
        $data['continuidadBeca'] = $regs['beneficiario']->continuidad_beca;

        $data['anoGrado'] = $regs['procedencia']->ano_grado;
        $data['promedioNota'] = $regs['procedencia']->promedio_nota;
        $data['nroMbroNucleoFamiliar'] = $regs['procedencia']->nro_mbro_nucleo_familiar;
        $data['nroMbroMayorEdad'] = $regs['procedencia']->nro_mbro_mayor_edad;
        $data['tipoCedulaMadre'] = $regs['procedencia']->tipo_cedula_madre;
        $data['cedulaMadre'] = $regs['procedencia']->cedula_madre;
        $data['nombreMadre'] = $regs['procedencia']->nombre_madre;
        $data['apellidoMadre'] = $regs['procedencia']->apellido_madre;
        $data['tipoCedulaPadre'] = $regs['procedencia']->tipo_cedula_padre;
        $data['cedulaPadre'] = $regs['procedencia']->cedula_padre;
        $data['nombrePadre'] = $regs['procedencia']->nombre_padre;
        $data['apellidoPadre'] = $regs['procedencia']->apellido_padre;
        $data['representanteId'] = $regs['procedencia']->representante_id;
        $data['tipoCedulaRepresentante'] = $regs['procedencia']->tipo_cedula_representante;
        $data['cedulaRepresentante'] = $regs['procedencia']->cedula_representante;
        $data['nombreRepresentante'] = $regs['procedencia']->nombre_representante;
        $data['apellidoRepresentante'] = $regs['procedencia']->apellido_representante;
        $data['bancoId'] = $regs['procedencia']->banco_id;
        $data['bancos']= $this->bancoModel->getAllBanco('', '', '', '', '');
        $data['tipoCuentaPersona'] = $regs['procedencia']->tipo_cuenta_persona;
        $data['numeroCuentaPersona'] = $regs['procedencia']->numero_cuenta_persona;

        //$data['becaAsignada'] = $this->pendienteBecaModel->getAllBecaAsignada('procedencia_persona_id', 'Sea Igual a', $data['procedenciaPersonaId'], '', '');

        $data['activo'] = $regs['beneficiario']->activo;
        $data['js'] = $this->javaScriptText;
        //Armado de las opciones del menu segun el usuario
        $centinela = new Centinela();
        $menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
        $data['menu']               = $this->load->view('vis_menu',$menu_final,true);

        //Llamada al view del formulario
        $this->load->view($this->baseDir.'/'.$this->classBaseName.'Form', $data);
        
    }

    function beneficiarioRecord()
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('txtApellidoPersona', 'Apellido', 'required');
        $this->form_validation->set_rules('txtNombrePersona', 'Nombre', 'required');
        $this->form_validation->set_rules('txtEmailPersona', 'Correo Electrónico', 'required');
        $this->form_validation->set_rules('cmbSexoPersona', 'Sexo', 'required');
        $this->form_validation->set_rules('cmbNacionalidadPersona', 'Nacionalidad', 'required');
        $this->form_validation->set_rules('txtFechaNacimientoPersona', 'Fecha de Nacimiento', 'required');
        $this->form_validation->set_rules('cmbPais', 'País', 'required');
        $this->form_validation->set_rules('cmbEstado', 'Estado', 'required');
        $this->form_validation->set_rules('cmbMunicipio', 'Municipio', 'required');
        $this->form_validation->set_rules('cmbParroquia', 'Parroquia', 'required');

        $data['becaPersonaId'] = $_POST['txtBecaPersonaId'];
        $data['procedenciaId'] = $_POST['txtProcedenciaId'];
        $data['sorteoId'] = $_POST['txtSorteoId'];
        $data['personaId'] = $_POST['txtPersonaId'];

        //DATOS DE PERSONA
        $data['tipoCedulaPersona'] = $_POST['cmbTipoCedulaPersona'];
        $data['cedulaPersona'] = $_POST['txtCedulaPersona'];
        $data['nombrePersona'] = $_POST['txtNombrePersona'];
        $data['apellidoPersona'] = $_POST['txtApellidoPersona'];
        $data['emailPersona'] = $_POST['txtEmailPersona'];
        $data['sexoPersona'] = $_POST['cmbSexoPersona'];
        $data['nacionalidadPersona'] = $_POST['cmbNacionalidadPersona'];
        $data['fechaNacimientoPersona'] = $_POST['txtFechaNacimientoPersona'];
        $data['fechaNacimientoPersona'] = $this->jelgeneral->arreglarFechaBD($data['fechaNacimientoPersona']);
        $data['apellidoPersona'] = $_POST['txtApellidoPersona'];
        $data['paisId'] = $_POST['cmbPais'];
        $data['estadoId'] = $_POST['cmbEstado'];
        $data['municipioId'] = $_POST['cmbMunicipio'];
        $data['parroquiaId'] = $_POST['cmbParroquia'];
        $data['direccion01Persona'] = $_POST['txtDireccion01Persona'];
        $data['direccion02Persona'] = $_POST['txtDireccion02Persona'];
        $data['telefono01Persona'] = $_POST['txtTelefono01Persona'];
        $data['telefono02Persona'] = $_POST['txtTelefono02Persona'];
        $data['telefono03Persona'] = $_POST['txtTelefono03Persona'];
        $data['telefono04Persona'] = $_POST['txtTelefono04Persona'];
        $data['paises']= $this->paisModel->getAllPais('', '', '', '', '');
        $data['estados']= $this->estadoModel->getAllEstado('pais_id', 'Sea Igual a', $data['paisId'], '', '');
        $data['municipios']= $this->municipioModel->getAllMunicipio('estado_id', 'Sea Igual a', $data['estadoId'], '', '');
        $data['parroquias']= $this->parroquiaModel->getAllParroquia('municipio_id', 'Sea Igual a', $data['municipioId'], '', '');

        //DATOS DE PROCEDENCIA PERSONA
        $data['tipoCedulaMadre'] = $_POST['cmbTipoCedulaMadre'];
        $data['cedulaMadre'] = $_POST['txtCedulaMadre'];
        $data['nombreMadre'] = $_POST['txtNombreMadre'];
        $data['apellidoMadre'] = $_POST['txtApellidoMadre'];
        $data['tipoCedulaPadre'] = $_POST['cmbTipoCedulaPadre'];
        $data['cedulaPadre'] = $_POST['txtCedulaPadre'];
        $data['nombrePadre'] = $_POST['txtNombrePadre'];
        $data['apellidoPadre'] = $_POST['txtApellidoPadre'];
        $data['anoGrado'] = $_POST['txtAnoGrado'];
        $data['promedioNota'] = $_POST['txtPromedioNota'];
        $data['nroMbroNucleoFamiliar'] = $_POST['txtNroMbroNucleoFamiliar'];
        $data['nroMbroMayorEdad'] = $_POST['txtNroMbroMayorEdad'];


        $data['representanteId'] = $_POST['txtRepresentanteId'];
        $data['tipoCedulaRepresentante'] = $_POST['cmbTipoCedulaRepresentante'];
        $data['cedulaRepresentante'] = $_POST['txtCedulaRepresentante'];
        $data['nombreRepresentante'] = $_POST['txtNombreRepresentante'];
        $data['apellidoRepresentante'] = $_POST['txtApellidoRepresentante'];
        $data['bancoId'] = $_POST['cmbBanco'];
        $data['tipoCuentaPersona'] = $_POST['cmbTipoCuentaPersona'];
        $data['numeroCuentaPersona'] = $_POST['txtNumeroCuentaPersona'];

        //DATOS DE BECA PERSONA
        $data['nroHijo'] = $_POST['txtNroHijo'];
        $data['contactadoBeca'] = $_POST['cmbContactado'];
        $data['inscritoBeca'] = $_POST['cmbInscrito'];
        $data['retiroCartaBeca'] = $_POST['cmbRetiroCarta'];
        $data['continuidadBeca'] = $_POST['cmbContinuidad'];

        //DATOS DE LA BECA ASIGNADA (NO MODIFICABLES)
        $data['procedencia'] = $_POST['txtProcedencia'];
        $data['sorteo'] = $_POST['txtSorteo'];
        $data['fechaIngreso'] = $_POST['txtFechaIngreso'];
        $data['fechaIngreso'] = $this->jelgeneral->arreglarFechaBD($data['fechaIngreso']);
        $data['nombreBeca'] = $_POST['txtNombreBeca'];
        $data['nombreInstituto'] = $_POST['txtNombreInstituto'];
        $data['nombreNucleo'] = $_POST['txtNombreNucleo'];
        $data['nombreCarrera'] = $_POST['txtNombreCarrera'];
        $data['activo'] = $_POST['txtActivo'];
        $data['usuarioId'] = 1; //OJO falta lo del usuario

        $data['js'] = $this->javaScriptText;
    
        //Armado de las opciones del menu segun el usuario
        $centinela = new Centinela();
        $menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
        $data['menu']               = $this->load->view('vis_menu',$menu_final,true);

        if ($this->form_validation->run() == FALSE)
        {
          //Llamada al view del formulario
          $this->load->view($this->baseDir.'/'.$this->classBaseName.'Form',$data);
        }
        else
        {



/*

    1             2                   3                4                  5               6             7
"numeric"    "varchar"            "varchar"        "varchar"          "varchar"      "varchar"      "varchar"
persona_id, tipo_cedula_persona, cedula_persona,  nombre_persona, apellido_persona, email_persona, sexo_persona,
      8                        9
  "numeric"                  date
nacionalidad_persona, fecha_nacimiento_persona,
    10        11        12              13             14                   15
"numeric" "numeric"  "numeric"      "numeric"      "varchar"             "varchar"
pais_id, estado_id, municipio_id, parroquia_id, direccion01_persona, direccion02_persona,
      16                     17                  18                19                   20
   "varchar"             "varchar"            "varchar"         "varchar"            "varchar"
telefono01_persona, telefono02_persona, telefono03_persona, telefono04_persona, tipo_cedula_madre,
     21             22            23               24                 25           26
 "varchar"       "varchar"     "varchar"        "varchar"          "varchar"    "varchar"
cedula_madre, nombre_madre, apellido_madre, tipo_cedula_padre, cedula_padre, nombre_padre,
     27            28          29                30                          31                32
 "varchar"      "numeric"   "numeric"        "numeric"                    "numeric"         "numeric"
apellido_padre, ano_grado, promedio_nota, nro_mbro_nucleo_familiar, nro_mbro_mayor_edad, representante_id,
           33                        34                   35                     36
       "varchar"                  "varchar"            "varchar"              "varchar"
tipo_cedula_representante, cedula_representante, nombre_representante, apellido_representante,
   37              38                  39                40          41               42
"numeric"       "varchar"          "varchar"          "numeric"  "numeric"      "numeric"
banco_id, tipo_cuenta_persona, numero_cuenta_persona, nro_hijo, usuario_id, beca_persona_id
   43                  44                45               46
"numeric"           "numeric"         "numeric"        "numeric"
contactado_beca, retiro_carta_beca, inscrito_beca, continuidad_beca

*/



          $dataMsg['result'] = $this->beneficiarioModel->updateBeneficiario($data['personaId'], $data['tipoCedulaPersona'],
                              $data['cedulaPersona'], $data['nombrePersona'], $data['apellidoPersona'],
                              $data['emailPersona'],  $data['sexoPersona'], $data['nacionalidadPersona'],
                              $data['fechaNacimientoPersona'],
                              $data['paisId'], $data['estadoId'], $data['municipioId'],
                              $data['parroquiaId'], $data['direccion01Persona'], $data['direccion02Persona'],
                              $data['telefono01Persona'], $data['telefono02Persona'], $data['telefono03Persona'],
                              $data['telefono04Persona'], $data['tipoCedulaMadre'], $data['cedulaMadre'],
                              $data['nombreMadre'], $data['apellidoMadre'], $data['tipoCedulaPadre'], $data['cedulaPadre'],
                              $data['nombrePadre'], $data['apellidoPadre'], $data['anoGrado'], $data['promedioNota'],
                              $data['nroMbroNucleoFamiliar'], $data['nroMbroMayorEdad'], $data['representanteId'],
                              $data['tipoCedulaRepresentante'], $data['cedulaRepresentante'], $data['nombreRepresentante'],
                              $data['apellidoRepresentante'], $data['bancoId'], $data['tipoCuentaPersona'],
                              $data['numeroCuentaPersona'], $data['nroHijo'], $data['usuarioId'], $data['becaPersonaId'],
                              $data['contactadoBeca'], $data['retiroCartaBeca'], $data['inscritoBeca'], $data['continuidadBeca']);

          //$dataMsg['result'] = $this->beneficiarioModel->updateBeneficiario($data);
          $this->jelgeneral->mensaje($this,'Registro Almacenado Exitosamente',$this->classBaseName.'/'.$this->classBaseName.'Control/','black');
        }
    }

  function beneficiarioDelete()
  {
    $id =$this->uri->segment(3);
    $data['result'] = $this->beneficiarioModel->deleteBeneficiario($id);
    $this->jelgeneral->mensaje($this,'Registro Eliminado Exitosamente',$this->classBaseName.'/'.$this->classBaseName.'Control/','black');
  }
}
?>
