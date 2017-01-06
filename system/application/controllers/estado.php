<?php

class estado extends Controller
{

	function estado()
	{
		parent::Controller();
    $this->load->helper('url');
    $this->load->helper('form');    
    $this->load->library('JELGeneral');
    $this->load->model('estadoModel');
    $this->load->model('paisModel');
    $this->load->model('Mfrmclass');

	}

  function estadoControl()
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
     
      $campo =  $this->jelgeneral->getSegmentArgument($uri, 'cmbCampo');
      if($campo!='')
      {
        $criterio =   $this->jelgeneral->getSegmentArgument($uri, 'cmbCriterio');
        $valor = $this->jelgeneral->getSegmentArgument($uri, 'txtValor');
      }  
    }

    $config['base_url'] =   base_url().'/index.php/estado/estadoControl/';
    $config['total_rows'] = $this->estadoModel->getNumTotalEstado($campo, $criterio, $valor);
    $config['per_page'] = 10;
    $config['uri_segment'] = 3;
    $config['first_link'] = 'Inicio';
    $config['last_link'] = 'Fin';

    $data['result']=$this->estadoModel->getAllEstado($campo, $criterio, $valor, $page, $config['per_page']);

    $this->pagination->initialize($config);

    $pages = $this->pagination->create_links();

  
    $data['pages']= $this->jelgeneral->getFilterPages($pages,$campo,$criterio,$valor);
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


    $this->load->view('mantenimiento/estadoList', $data);
  }

  function estadoForm()
  {
    $id =$this->uri->segment(3);
    $data['id'] = $id;
    $data['paisId'] = -1;
    $data['paises']= $this->paisModel->getAllPais('', '', '', '', '');
    $data['nombrePais'] = '';
    $data['nombreEstado'] = '';
    $data['activo'] = 1;
     //Armado de las opciones del menu segun el usuario
    $centinela = new Centinela();
    $menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
    $data['menu']               = $this->load->view('vis_menu',$menu_final,true);

    if($id!=-1)
    {
      $reg=$this->estadoModel->getEstado($id);

      $data['paisId'] = $reg->pais_id;
      $data['nombrePais'] = $reg->nombre_pais;
      $data['nombreEstado'] = $reg->nombre_estado;
      $data['activo'] = $reg->activo;
    }
    $this->load->view('mantenimiento/estadoForm', $data);
  }

  function estadoRecord()
  {
    $this->load->library('form_validation');
		$this->form_validation->set_rules('cmbPais', 'Pa&iacute;s', 'required');
		$this->form_validation->set_rules('txtEstado', 'Estado', 'required');

    $data['id'] = $_POST['txtId'];
    $data['paisId'] = $_POST['cmbPais'];   
    $data['nombreEstado'] = $_POST['txtEstado'];
    $data['activo'] = $_POST['txtActivo'];
    //Armado de las opciones del menu segun el usuario
    $centinela = new Centinela();
    $menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
    $data['menu']               = $this->load->view('vis_menu',$menu_final,true);
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('mantenimiento/estadoForm',$data);
		}
		else
		{
     
			  if($data['id'] == -1)
			  {
				$dataMsg['result'] = $this->estadoModel->insertEstado($data['paisId'], $data['nombreEstado'], $data['activo']);
				$this->jelgeneral->mensaje($this,'Registro Almacenado Exitosamente','estado/estadoControl','black');
			  }
			  else
			  {
				$dataMsg['result'] = $this->estadoModel->updateEstado($data['id'], $data['paisId'], $data['nombreEstado'], $data['activo']);
			   $this->jelgeneral->mensaje($this,'Registro Modificado Exitosamente','estado/estadoControl','black');
			  }
    	}
  }

  function estadoDelete()
  {
    $id =$this->uri->segment(3);
    $data['result'] = $this->estadoModel->deleteEstado($id);
    $this->jelgeneral->mensaje($this,'Registro Eliminado Exitosamente','estado/estadoControl','black');
  }

}
?>
