<?php

class parroquia extends Controller
{
  var $javaScriptText ='';

	function parroquia()
	{
		parent::Controller();
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->library('xajax');
    $this->load->library('JELGeneral');
    $this->load->model('paisModel');
    $this->load->model('estadoModel');    
    $this->load->model('municipioModel');
    $this->load->model('parroquiaModel');
    $this->xajax->registerFunction(array('buildSelectEstados', &$this, 'buildSelectEstados'));
    $this->xajax->registerFunction(array('buildSelectMunicipios', &$this, 'buildSelectMunicipios'));
    $this->xajax->processRequest();
    $this->javaScriptText = $this->xajax->getJavascript(base_url());
	}

  function buildSelectEstados($paisId)
  {

    $objResponse = new xajaxResponse();

    //$paisId = $this->getHTTPArgument($arguments,'paisId');
    //$paisId = 1;
    $estados = $this->estadoModel->getAllEstado('pais_id', 'Sea Igual a', $paisId, '', '');

    $result = '<select name="cmbEstado" id="cmbEstado" style="width:390px" onChange="xajax_buildSelectMunicipios(this.value)">';
    $result = $result .'<option></option>';
    if($estados->num_rows()!=0)
    {
      foreach($estados->result() as $row)
      {
        $result = $result . '<option value = "'.$row->estado_id.'">'.$row->nombre_estado.'</option>';
      }
    }
    $result = $result . '</select>';
    
    $objResponse->Assign('divEstado', "innerHTML", $result);
    return $objResponse;
  }

  function buildSelectMunicipios($estadoId)
  {

    $objResponse = new xajaxResponse();
    $municipios = $this->municipioModel->getAllMunicipio('estado_id', 'Sea Igual a', $estadoId, '', '');

    $result = '<select name="cmbMunicipio" id="cmbMunicipio" style="width:363px">';
    $result = $result .'<option></option>';
    if($municipios->num_rows()!=0)
    {
      foreach($municipios->result() as $row)
      {
        $result = $result . '<option value = "'.$row->municipio_id.'">'.$row->nombre_municipio.'</option>';
      }
    }
    $result = $result . '</select>';

    $objResponse->Assign('divMunicipio', "innerHTML", $result);
    return $objResponse;
  }

  function parroquiaControl()
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
        $criterio =  $this->getSegmentArgument($uri, 'cmbCriterio');
        $valor = $this->getSegmentArgument($uri, 'txtValor');
      }  
    }

    $config['base_url'] =   base_url().'/index.php/parroquia/parroquiaControl/';
    $config['total_rows'] = $this->parroquiaModel->getNumTotalParroquia($campo, $criterio, $valor);
    $config['per_page'] = 10;
    $config['uri_segment'] = 3;
    $config['first_link'] = 'Inicio';
    $config['last_link'] = 'Fin';

    $data['result']=$this->parroquiaModel->getAllParroquia($campo, $criterio, $valor, $page, $config['per_page']);

    $this->pagination->initialize($config);

    $pages = $this->pagination->create_links();

    $data['pages']=$this->jelgeneral->getFilterPages($pages,$campo,$criterio,$valor);;
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

    $this->load->view('mantenimiento/parroquiaList', $data);
  }

  function parroquiaForm()
  {
    $id =$this->uri->segment(3);
    $data['id'] = $id;
    $data['paisId'] = -1;
    $data['estadoId'] = -1;
    $data['municipioId'] = -1;
    $data['paises']= $this->paisModel->getAllPais('', '', '', '', '');
    $data['nombreParroquia'] = '';
    $data['activo'] = 1;
    $data['js'] = $this->javaScriptText;
    //Armado de las opciones del menu segun el usuario
    $centinela = new Centinela();
    $menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
    $data['menu']               = $this->load->view('vis_menu',$menu_final,true);

    if($id!=-1)
    {
      $reg=$this->parroquiaModel->getParroquia($id);

      $data['estados'] = $this->estadoModel->getAllEstado('pais_id', 'Sea Igual a', $reg->pais_id, '', '');
      $data['municipios'] = $this->municipioModel->getAllMunicipio('estado_id', 'Sea Igual a', $reg->estado_id, '', '');

      $data['estadoId'] = $reg->estado_id;
      $data['paisId'] = $reg->pais_id;
      $data['municipioId'] = $reg->municipio_id;
      $data['nombreParroquia'] = $reg->nombre_parroquia;
      $data['activo'] = $reg->activo;
    }
    $this->load->view('mantenimiento/parroquiaForm', $data);
  }

  function parroquiaRecord()
  {
    $this->load->library('form_validation');
	$this->form_validation->set_rules('cmbPais', 'Pa&iacute;s', 'required');
    $this->form_validation->set_rules('cmbEstado', 'Estado', 'required');
	$this->form_validation->set_rules('cmbMunicipio', 'Municipio', 'required');
    $this->form_validation->set_rules('txtParroquia', 'Parroquia', 'required');

    $data['id'] = $_POST['txtId'];
    $data['paisId'] = $_POST['cmbPais'];
    $data['estadoId'] = $_POST['cmbEstado'];
    $data['municipioId'] = $_POST['cmbMunicipio'];    
    $data['nombreParroquia'] = $_POST['txtParroquia'];
    $data['activo'] = $_POST['txtActivo'];
    //Armado de las opciones del menu segun el usuario
    $centinela = new Centinela();
    $menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
    $data['menu']               = $this->load->view('vis_menu',$menu_final,true);
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('mantenimiento/parroquiaForm',$data);
		}
		else
		{    
		    if($data['id'] == -1)
		    {
		  	  $dataMsg['result'] = $this->parroquiaModel->insertParroquia($data['municipioId'], $data['nombreParroquia'], $data['activo']);
		  	  $this->jelgeneral->mensaje($this,'Registro Almacenado Exitosamente','parroquia/parroquiaControl','black');
		    }
		    else
		    {
			  $dataMsg['result'] = $this->parroquiaModel->updateParroquia($data['id'], $data['municipioId'], $data['nombreParroquia'], $data['activo']);
			  $this->jelgeneral->mensaje($this,'Registro Modificado Exitosamente','parroquia/parroquiaControl','black');
		    }
    	}
  }

  function ParroquiaDelete()
  {
    $id =$this->uri->segment(3);   
    $data['result'] = $this->parroquiaModel->deleteParroquia($id);
   	$this->jelgeneral->mensaje($this,'Registro Eliminado Exitosamente','parroquia/parroquiaControl','black');
  }

}
?>
