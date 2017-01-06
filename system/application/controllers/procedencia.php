<?php

class procedencia extends Controller
{

  var $javaScriptText ='';

	function procedencia()
	{
		parent::Controller();
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->library('xajax');
    $this->load->library('JELGeneral');
    $this->load->model('procedenciaModel');
    $this->load->model('personaModel');
    $this->load->model('paisModel');
    $this->load->model('estadoModel');
    $this->load->model('municipioModel');
    $this->load->model('parroquiaModel');
    $this->load->model('tipoProcedenciaModel');
    $this->personaModel->nombre_tabla='persona';
    $this->xajax->registerFunction(array('buildSelectEstados', &$this, 'buildSelectEstados'));
    $this->xajax->registerFunction(array('buildSelectMunicipios', &$this, 'buildSelectMunicipios'));
    $this->xajax->registerFunction(array('buildSelectParroquias', &$this, 'buildSelectParroquias'));
    $this->xajax->processRequest();
    $this->javaScriptText = $this->xajax->getJavascript(base_url());
    
	}

  function buscarContactos()
  {

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

  function procedenciaControl()
  {
    
    $this->load->library('pagination');
    //$this->load->library('JELGeneral');
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
     
      $campo =  $this->jelgeneral->getSegmentArgument($uri, 'cmbCampo');
      if($campo!='')
      {
        $criterio =   $this->jelgeneral->getSegmentArgument($uri, 'cmbCriterio');
        $valor = $this->jelgeneral->getSegmentArgument($uri, 'txtValor');
      }  
    }

    $config['base_url'] =   base_url().'/index.php/procedencia/procedenciaControl/';
    $config['total_rows'] = $this->procedenciaModel->getNumTotalProcedencia($campo, $criterio, $valor);
    $config['per_page'] = 10;
    $config['uri_segment'] = 3;
    $config['first_link'] = 'Inicio';
    $config['last_link'] = 'Fin';

    $data['result']=$this->procedenciaModel->getAllProcedencia($campo, $criterio, $valor, $page, $config['per_page']);

    $this->pagination->initialize($config);

    $pages = $this->pagination->create_links();
  
    $data['pages']= $this->jelgeneral->getFilterPages($pages,$campo,$criterio,$valor);
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


    $this->load->view('operaciones/procedenciaList', $data);
  }

  function procedenciaForm()
  {
    $id =$this->uri->segment(3);
    $data['id'] = $id;
    $data['paisId']= -1;
    $data['paises']= $this->paisModel->getAllPais('', '', '', '', '');
    $data['contactoId'] = -1;

    $data['contactos']= $this->personaModel->getAllPersona('', '', '', '', '');
    $data['tipoProcedenciaId'] = -1;
    $data['tiposProcedencia'] = $this->tipoProcedenciaModel->getAllTipoProcedencia('', '', '', '', '');
    $data['fechaProcedencia'] = '';
    $data['nombreEstado'] = '';
    $data['nombreMunicipio'] = '';
    $data['nombreParroquia'] = '';
    $data['lugarProcedencia'] = '';
    $data['instruccionProcedencia'] = '';
    $data['activo'] = 1;
    $data['js'] = $this->javaScriptText;
     //Carga del menú principal de la aplicación
     $centinela  = new Centinela();
    $menu_final['opciones']   = $this->mod_demenu->inicio($centinela->getId());
    $data['menu'] = $this->load->view('vis_menu',$menu_final,true);
    //$data['menu']=$this->load->view('menu', $data,true);

    if($id!=-1)
    {
      $reg=$this->procedenciaModel->getProcedencia($id);
      
      $data['paisId']= $reg->pais_id;
      $data['estadoId'] = $reg->estado_id;
      $data['estados']= $this->estadoModel->getAllEstado('pais_id', 'Sea Igual a', $reg->pais_id, '', '');
      $data['municipioId'] = $reg->municipio_id;
      $data['municipios']= $this->municipioModel->getAllMunicipio('estado_id', 'Sea Igual a', $reg->estado_id, '', '');
      $data['parroquiaId'] = $reg->parroquia_id;
      $data['parroquias']= $this->parroquiaModel->getAllParroquia('municipio_id', 'Sea Igual a', $reg->municipio_id, '', '');
      $data['contactoId'] = $reg->contacto_id;
      $data['tipoProcedenciaId'] = $reg->tipo_procedencia_id;
      $data['fechaProcedencia'] = $this->jelgeneral->arreglarFechaBD($reg->fecha_procedencia);
      //$data['nombreEstado'] = $reg->nombre_estado;
      //$data['nombreMunicipio'] = $reg->nombre_municipio;
      //$data['nombreParroquia'] = $reg->nombre_parroquia;
      $data['lugarProcedencia'] = $reg->lugar_procedencia;
      $data['instruccionProcedencia'] = $reg->instruccion_procedencia;
      $data['activo'] = $reg->activo;
    }
    $this->load->view('operaciones/procedenciaForm', $data);
  }

  function procedenciaRecord()
  {
    $this->load->library('form_validation');
		$this->form_validation->set_rules('cmbContacto', 'Contacto', 'required');
		$this->form_validation->set_rules('cmbTipoProcedencia', 'Tipo de Procedencia', 'required');
    $this->form_validation->set_rules('txtFechaProcedencia', 'Fecha de la Procedencia', 'required');
    $this->form_validation->set_rules('txtLugarProcedencia', 'Lugar de la Procedencia', 'required');

    $data['id'] = $_POST['txtId'];
    $data['contactoId'] = $_POST['cmbContacto'];
    $data['organismoId'] = 1; //Esto se hace porque el cliente pidió que no se manejaran organismo pero se está dejando la posibilidad futura
    $data['contactos']= $this->personaModel->getAllPersona('', '', '', '', '');
    $data['tipoProcedenciaId'] = $_POST['cmbTipoProcedencia'];
    $data['TiposProcedencia'] = $this->tipoProcedenciaModel->getAllTipoProcedencia('', '', '', '', '');
    $arreglearFecha = $_POST['txtFechaProcedencia'];
    $data['fechaProcedencia'] = $this->jelgeneral->arreglarFechaBD($arreglearFecha);

    

    $data['lugarProcedencia'] = $_POST['txtLugarProcedencia'];
    $data['instruccionProcedencia'] = $_POST['txtInstruccionProcedencia'];
    $data['usuarioId'] = 1;//OJO Arreglar esto
    $data['activo'] = $_POST['txtActivo'];
    $data['parroquiaId'] = $_POST['cmbParroquia'];

    //Carga del menú principal de la aplicación
    $centinela  = new Centinela();
    $menu_final['opciones']   = $this->mod_demenu->inicio($centinela->getId());
    $data['menu'] = $this->load->view('vis_menu',$menu_final,true);
    //$data['menu']=$this->load->view('menu', $data, true);

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('operaciones/procedenciaForm',$data);
		}
		else
		{
      if($data['id'] == -1)
			{
				$dataMsg['result'] =  $this->procedenciaModel->insertProcedencia($data['contactoId'],
                              $data['tipoProcedenciaId'], $data['organismoId'], $data['fechaProcedencia'],
                              $data['lugarProcedencia'], $data['instruccionProcedencia'], $data['usuarioId'],
                              $data['activo'], $data['parroquiaId']);
				$this->jelgeneral->mensaje($this,'Registro Almacenado Exitosamente','procedencia/procedenciaControl','black');
			}
			else
			{
				$dataMsg['result'] = $this->procedenciaModel->updateProcedencia($data['id'], $data['contactoId'],
                             $data['tipoProcedenciaId'], $data['organismoId'], $data['fechaProcedencia'],
                             $data['lugarProcedencia'], $data['instruccionProcedencia'], $data['usuarioId'],
                             $data['activo'], $data['parroquiaId']);
			  $this->jelgeneral->mensaje($this,'Registro Modificado Exitosamente','procedencia/procedenciaControl','black');
			}
    }
  }

  function procedenciaDelete()
  {
    $id =$this->uri->segment(3);
    $data['result'] = $this->procedenciaModel->deleteProcedencia($id);
    $this->jelgeneral->mensaje($this,'Registro Eliminado Exitosamente','procedencia/procedenciaControl','black');
  }
}
?>
