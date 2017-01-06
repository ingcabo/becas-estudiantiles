<?php

class tipoPeriodo extends Controller
{

	function tipoPeriodo()
	{
		parent::Controller();
    $this->load->helper('url');
    $this->load->helper('form');    
    $this->load->library('JELGeneral');
    $this->load->model('tipoPeriodoModel');
    $this->load->model('modalidadModel');
	}

  function tipoPeriodoControl()
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

    $config['base_url'] =   base_url().'/index.php/tipoPeriodo/tipoPeriodoControl/';
    $config['total_rows'] = $this->tipoPeriodoModel->getNumTotalTipoPeriodo($campo, $criterio, $valor);
    $config['per_page'] = 10;
    $config['uri_segment'] = 3;
    $config['first_link'] = 'Inicio';
    $config['last_link'] = 'Fin';

    $data['result']=$this->tipoPeriodoModel->getAllTipoPeriodo($campo, $criterio, $valor, $page, $config['per_page']);

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


    $this->load->view('mantenimiento/tipoPeriodoList', $data);
  }

  function tipoPeriodoForm()
  {
    $id =$this->uri->segment(3);
    $data['id'] = $id;
    $data['modalidadId'] = -1;
    $data['modalidades']= $this->modalidadModel->getAllModalidad('', '', '', '', '');
    $data['nombreModalidad'] = '';
    $data['nombreTipoPeriodo'] = '';
    $data['activo'] = 1;
    //Armado de las opciones del menu segun el usuario
    $centinela = new Centinela();
    $menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
    $data['menu']               = $this->load->view('vis_menu',$menu_final,true);

    if($id!=-1)
    {
      $reg=$this->tipoPeriodoModel->getTipoPeriodo($id);

      $data['modalidadId'] = $reg->modalidad_id;
      $data['nombreModalidad'] = $reg->nombre_modalidad;
      $data['nombreTipoPeriodo'] = $reg->nombre_tipo_periodo;
      $data['activo'] = $reg->activo;
    }
    $this->load->view('mantenimiento/tipoPeriodoForm', $data);
  }

  function tipoPeriodoRecord()
  {
    $this->load->library('form_validation');
		$this->form_validation->set_rules('cmbModalidad', 'Modalidad', 'required');
		$this->form_validation->set_rules('txtTipoPeriodo', 'Tipo de Periodo', 'required');

    $data['id'] = $_POST['txtId'];
    $data['modalidadId'] = $_POST['cmbModalidad'];
    $data['nombreTipoPeriodo'] = $_POST['txtTipoPeriodo'];
    $data['activo'] = $_POST['txtActivo'];
    //Armado de las opciones del menu segun el usuario
    $centinela = new Centinela();
    $menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
    $data['menu']               = $this->load->view('vis_menu',$menu_final,true);
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('mantenimiento/tipoPeriodoForm',$data);
		}
		else
		{
     
			  if($data['id'] == -1)
			  {
				$dataMsg['result'] = $this->tipoPeriodoModel->insertTipoPeriodo($data['modalidadId'], $data['nombreTipoPeriodo'], $data['activo']);
				$this->jelgeneral->mensaje($this,'Registro Almacenado Exitosamente','tipoPeriodo/tipoPeriodoControl','black');
			  }
			  else
			  {
				$dataMsg['result'] = $this->tipoPeriodoModel->updateTipoPeriodo($data['id'], $data['modalidadId'], $data['nombreTipoPeriodo'], $data['activo']);
			   $this->jelgeneral->mensaje($this,'Registro Modificado Exitosamente','tipoPeriodo/tipoPeriodoControl','black');
			  }
    	}
  }

  function tipoPeriodoDelete()
  {
    $id =$this->uri->segment(3);
    $data['result'] = $this->tipoPeriodoModel->deleteTipoPeriodo($id);
    $this->jelgeneral->mensaje($this,'Registro Eliminado Exitosamente','tipoPeriodo/tipoPeriodoControl','black');
  }

}
?>
