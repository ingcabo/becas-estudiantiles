<?php

class municipio extends Controller
{
  var $javaScriptText ='';

	function municipio()
	{
		parent::Controller();
    $this->load->helper('url');
    $this->load->helper('form');
    $this->load->library('xajax');
    $this->load->library('JELGeneral');
    $this->load->model('estadoModel');
    $this->load->model('paisModel');
    $this->load->model('municipioModel');
    $this->xajax->registerFunction(array('buildSelectEstados', &$this, 'buildSelectEstados'));
    $this->xajax->processRequest();
    $this->javaScriptText = $this->xajax->getJavascript(base_url());
	}

  function buildSelectEstados($paisId)
  {

    $objResponse = new xajaxResponse();

    //$paisId = $this->getHTTPArgument($arguments,'paisId');
    //$paisId = 1;
    $estados = $this->estadoModel->getAllEstado('pais_id', 'Sea Igual a', $paisId, '', '');

    $result = '<select name="cmbEstado" id="cmbEstado" style="width:363px">';
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

  function municipioControl()
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
     
      $campo = $this->jelgeneral->getSegmentArgument($uri, 'cmbCampo');
      if($campo!='')
      {
        $criterio =  $this->getSegmentArgument($uri, 'cmbCriterio');
        $valor = $this->getSegmentArgument($uri, 'txtValor');
      }  
    }

    $config['base_url'] =   base_url().'/index.php/pais/paisControl/';
    $config['total_rows'] = $this->municipioModel->getNumTotalMunicipio($campo, $criterio, $valor);
    $config['per_page'] = 10;
    $config['uri_segment'] = 3;
    $config['first_link'] = 'Inicio';
    $config['last_link'] = 'Fin';

    $data['result']=$this->municipioModel->getAllMunicipio($campo, $criterio, $valor, $page, $config['per_page']);

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


    $this->load->view('mantenimiento/municipioList', $data);
  }

  function municipioForm()
  {
    $id =$this->uri->segment(3);
    $data['id'] = $id;
    $data['paisId'] = -1;
    $data['estadoId'] = -1;
    $data['paises']= $this->paisModel->getAllPais('', '', '', '', '');
    $data['nombreMunicipio'] = '';
    $data['activo'] = 1;
    $data['js'] = $this->javaScriptText;
    //Armado de las opciones del menu segun el usuario
    $centinela = new Centinela();
    $menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
    $data['menu']               = $this->load->view('vis_menu',$menu_final,true);

    if($id!=-1)
    {
      $reg=$this->municipioModel->getMunicipio($id);
      $data['estados'] = $this->estadoModel->getAllEstado('pais_id', 'Sea Igual a', $reg->pais_id, '', '');
      $data['paisId'] = $reg->pais_id;
      $data['estadoId'] = $reg->estado_id;
      $data['nombreMunicipio'] = $reg->nombre_municipio;
      $data['activo'] = $reg->activo;
    }
    $this->load->view('mantenimiento/municipioForm', $data);
  }

  function municipioRecord()
  {
    $this->load->library('form_validation');
		$this->form_validation->set_rules('cmbPais', 'Pa&iacute;s', 'required');
    $this->form_validation->set_rules('cmbEstado', 'Estado', 'required');
		$this->form_validation->set_rules('txtMunicipio', 'Municipio', 'required');

    $data['id'] = $_POST['txtId'];
    $data['paisId'] = $_POST['cmbPais'];
    $data['estadoId'] = $_POST['cmbEstado'];
    $data['paises']= $this->paisModel->getAllPais('', '', '', '', '');
    $data['nombreMunicipio'] = $_POST['txtMunicipio'];
    $data['activo'] = $_POST['txtActivo'];
   //Armado de las opciones del menu segun el usuario
    $centinela = new Centinela();
    $menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
    $data['menu']               = $this->load->view('vis_menu',$menu_final,true);
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('mantenimiento/municipioForm',$data);
		}
		else
		{    
		    if($data['id'] == -1)
		    {
		  	  $dataMsg['result'] = $this->municipioModel->insertMunicipio($data['estadoId'], $data['nombreMunicipio'], $data['activo']);
		  	  $this->jelgeneral->mensaje($this,'Registro Almacenado Exitosamente','municipio/municipioControl','black');
		    }
		    else
		    {
			  $dataMsg['result'] = $this->municipioModel->updateMunicipio($data['id'], $data['estadoId'], $data['nombreMunicipio'], $data['activo']);
			  $this->jelgeneral->mensaje($this,'Registro Modificado Exitosamente','municipio/municipioControl','black');
		    }
    	}
  }

  function municipioDelete()
  {
    $id =$this->uri->segment(3);   
    $data['result'] = $this->municipioModel->deleteMunicipio($id);
   	$this->jelgeneral->mensaje($this,'Registro Eliminado Exitosamente','municipio/municipioControl','black');
  }

}
?>
