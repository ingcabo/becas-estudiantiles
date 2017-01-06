<?php
/**
 * @property CI_Loader $load
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property CI_Email $email
 * @property CI_DB_active_record $db
 * @property CI_DB_forge $dbforge
 */



class pendienteBeca extends Controller
{

  var $classBaseName;
  var $baseDir;
  var $javaScriptText ='';

  function pendienteBeca()
  {
    parent::Controller();
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->model('pendienteBecaModel');
    $this->load->model('configuracionModel');
    $this->load->model('institutoModel');
    $this->load->model('becaModel');
    $this->load->model('personaModel');
    $this->load->model('periodoModel');
    $this->load->model('nucleoModel');
    $this->load->model('carreraModel');
    $this->load->library('JELGeneral');
    $this->classBaseName ='pendienteBeca';
    $this->baseDir ='operaciones';
    $this->xajax->registerFunction(array('buildSelectCarreras', &$this, 'buildSelectCarreras'));
    $this->xajax->registerFunction(array('buildListaBecas', &$this, 'buildListaBecas'));
    $this->xajax->processRequest();
    $this->javaScriptText = $this->xajax->getJavascript(base_url());
  }

/*

  function buildListaBecas($becaId, $nucleoInstitutoId, $carreraInstitutoId, $procedenciaPersonaId, $accion)
  {
    if($accion == 1) //ASIGNARLE UNA BECA A LA PERSONA
    {
      $estadoPersonaActivo = $this->configuracionModel->getEstadoPersonaIdActivo;
      $dataMsg['result'] = $this->pendienteBecaModel->insertBecaPersona($becaId, $estadoPersonaActivo, $procedenciaPersonaId);
      $this->jelgeneral->mensaje($this,'Registro Almacenado Exitosamente',$this->classBaseName.'/'.$this->classBaseName.'Control/');
    }
    elseif($accion == 2) //RETIRARLE UNA BECA A LA PERSONA
    {
      $dataMsg['result'] = $this->pendienteBecaModel->deleteBecaPersona($data['id'], $data['nombrePais'], $data['nacionalidadPais'], $data['activo']);
      $this->jelgeneral->mensaje($this,'Registro Modificado Exitosamente',$this->classBaseName.'/'.$this->classBaseName.'Control/');
    }
    elseif($accion == 3) //ELIMINARLE UNA BECA A LA PERSONA
    {

    }
  }
*/
  function buildSelectCarreras($institutoId)
  {
    $objResponse = new xajaxResponse();

    $nucleos = $this->nucleoModel->getAllNucleo('instituto_id', 'Sea Igual a', $institutoId, '', '');

    $result ='';
    
    $result = $result .'<select name="cmbNucleo" id="cmbNucleo" style="width:205px"> ';
    $result = $result .'<option></option> ';
    if($nucleos->num_rows()!=0)
    {
      foreach($nucleos->result() as $row)
      {
        $result = $result . '<option value = "'.$row->nucleo_instituto_id.'">'.$row->nombre_nucleo_instituto.'</option>';
      }
    }
    $result = $result . ' </select> ';

    $carreras = $this->carreraModel->getAllCarreraInstituto('instituto_id', 'Sea Igual a', $institutoId, '', '');

    $result = $result .'<select name="cmbCarrera" id="cmbCarrera" style="width:346px"> ';
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

    function pendienteBecaControl()
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
        $config['total_rows'] = $this->pendienteBecaModel->getNumTotalPendienteBeca($campo, $criterio, $valor);
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['first_link'] = 'Inicio';
        $config['last_link'] = 'Fin';

        $data['result']=$this->pendienteBecaModel->getAllPendienteBeca($campo, $criterio, $valor, $page, $config['per_page']);

        $this->pagination->initialize($config);
        $pages = $this->pagination->create_links();

        $data['pages']=$this->jelgeneral->getFilterPages($pages,$campo,$criterio,$valor);
        //$data['pages']='sdfasdfa'.$pages.$campo.$criterio.$valor;

        //Armado de las opciones del menu segun el usuario
        $centinela = new Centinela();
        $menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
        $data['menu']               = $this->load->view('vis_menu',$menu_final,true);

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

    function pendienteBecaForm()
    {

        //$tipoProcedenciaIdCenso = $this->configuracionModel->getProcedenciaIdCenso();
        $tipoProcedenciaId =$this->uri->segment(3);
        $procedenciaId =$this->uri->segment(4);
        $procedenciaPersonaId =$this->uri->segment(5);
        $sorteoId =$this->uri->segment(6);


        $data['tipoProcedenciaId'] = $tipoProcedenciaId;
        $data['procedenciaId'] = $procedenciaId;
        $data['procedenciaPersonaId'] = $procedenciaPersonaId;
        $data['sorteoId'] = $sorteoId;

        $reg=$this->pendienteBecaModel->getPendienteBeca($tipoProcedenciaId,$procedenciaId,$procedenciaPersonaId, $sorteoId);

        $nombreContacto = $reg->nombre_contacto ? $reg->nombre_contacto : 'NA';
        $apellidoContacto = $reg->apellido_contacto ? $reg->apellido_contacto : '';
        $data['procedencia'] =  $reg->nombre_tipo_procedencia.' - '.$this->jelgeneral->arreglarFechaBD($reg->fecha_procedencia).' - '.
                                $reg->nombre_municipio_procedencia.' - '.$reg->lugar_procedencia.' - '.
                                $nombreContacto.' '.$apellidoContacto;

        $data['sorteo'] =  $this->jelgeneral->arreglarFechaBD($reg->fecha_sorteo).' - '.$reg->nombre_municipio_sorteo.' - '.$reg->lugar_sorteo;
        
        
        //$data['nombreParroquiaProcedencia'] = $reg->nombre_parroquia_procedencia;
        //$data['nombreParroquiaSorteo'] = $reg->nombre_parroquia_sorteo;
        
        $data['cedulaPersona'] = $reg->tipo_cedula_persona.'-'.$reg->cedula_persona;
        $data['nombrePersona'] = $reg->nombre_persona;
        $data['apellidoPersona'] = $reg->apellido_persona;
        $data['filtroPersona']= $this->personaModel->getFiltroPersona($reg->cedula_persona);

        $data['nombreBeca'] = $reg->nombre_tipo_beca.' - '.$reg->nombre_beca;
        $data['becaId'] = '-1';
        $data['becas']= $this->becaModel->getAllBeca('', '', '', '', '');
        $data['carrera'] = ($reg->carrera='-1') ? '(NO ESPECIFICADO)' : $reg->carrera;
        $data['institutoId'] = '-1';
        $data['periodoId'] = '-1';
        $data['institutos']= $this->institutoModel->getAllInstituto('', '', '', '', '');
        $data['periodos']= $this->periodoModel->getAllPeriodo('', '', '', '', '');
        $data['anoGrado'] = $reg->ano_grado;
        $data['promedioNota'] = $reg->promedio_nota;
        $data['nroMbroNucleoFamiliar'] = $reg->nro_mbro_nucleo_familiar;
        $data['nroMbroMayorEdad'] = $reg->nro_mbro_mayor_edad;

        //$data['becaAsignada'] = $this->pendienteBecaModel->getAllBecaAsignada('procedencia_persona_id', 'Sea Igual a', $data['procedenciaPersonaId'], '', '');

        $data['activo'] = $reg->activo;
        $data['js'] = $this->javaScriptText;
        //Armado de las opciones del menu segun el usuario
        $centinela = new Centinela();
        $menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
        $data['menu']               = $this->load->view('vis_menu',$menu_final,true);

        //Permisologia
        $data['permisos']['i'] = $this->mod_usuario->evalua_permiso('i','',$this->uri->segment(1));
        $data['permisos']['m'] = $this->mod_usuario->evalua_permiso('m','',$this->uri->segment(1));
        $data['permisos']['b'] = $this->mod_usuario->evalua_permiso('b','',$this->uri->segment(1));
        //fin permisologia a copiar

        //Llamada al view del formulario
        $this->load->view($this->baseDir.'/'.$this->classBaseName.'Form', $data);
    }

    function pendienteBecaRecord()
    {
        $this->load->library('form_validation');
                                           
        $this->form_validation->set_rules('cmbBeca', 'Beca a Asignar', 'required');
      
        $data['procedenciaId'] = $_POST['txtProcedenciaId'];
        $data['sorteoId'] = $_POST['txtSorteoId'];


        $data['procedencia'] = $_POST['txtProcedencia'];
        $data['sorteo'] = $_POST['txtSorteo'];
        
        $data['cedulaPersona'] = $_POST['txtCedulaPersona'];
        $data['nombrePersona'] = $_POST['txtNombrePersona'];
        $data['apellidoPersona'] = $_POST['txtApellidoPersona'];

        $data['nombreBeca'] = $_POST['txtBeca'];
        $data['becaId'] = '-1';
        $data['becas']= $this->becaModel->getAllBeca('', '', '', '', '');
        $data['carrera'] = $_POST['txtCarrera'];
        $data['institutoId'] = '-1';
        $data['institutos']= $this->institutoModel->getAllInstituto('', '', '', '', '');
        $data['periodoId'] = '-1';
        $data['periodos']= $this->periodoModel->getAllPeriodo('', '', '', '', '');
        $data['anoGrado'] = $_POST['txtAnoGrado'];
        $data['promedioNota'] = $_POST['txtPromedioNota'];
        $data['nroMbroNucleoFamiliar'] = $_POST['txtNroMbroNucleoFamiliar'];
        $data['nroMbroMayorEdad'] = $_POST['txtNroMbroMayorEdad'];
        $data['periodoId'] = $_POST['cmbPeriodo'];

        $data['js'] = $this->javaScriptText;
    
        $data['procedenciaPersonaId'] = $_POST['txtProcedenciaPersonaId'];
        $data['becaId'] = $_POST['cmbBeca'];
        $data['nucleoInstitutoId'] = $_POST['cmbNucleo'];
        $data['carreraInstitutoId'] = $_POST['cmbCarrera'];
        $arreglearFecha = $_POST['txtFechaIngreso'];
        $data['fechaIngreso'] = $this->jelgeneral->arreglarFechaBD($arreglearFecha);
        $data['activo'] = $_POST['txtActivo'];
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
          $estadoPersonaActivo = $this->configuracionModel->getEstadoPersonaIdActivo();
          $dataMsg['result'] = $this->pendienteBecaModel->insertBecaPersona($data['becaId'], $estadoPersonaActivo,
                                $data['procedenciaPersonaId'], $data['fechaIngreso'], $data['nucleoInstitutoId'],
                                $data['carreraInstitutoId'], $data['activo'], $data['periodoId']);
          $this->jelgeneral->mensaje($this,'Registro Almacenado Exitosamente',$this->classBaseName.'/'.$this->classBaseName.'Control/','black');
        }
    }



}
?>
