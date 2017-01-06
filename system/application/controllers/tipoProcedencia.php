<?php
/**
 * @property CI_Loader $load
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property CI_Email $email
 * @property CI_DB_active_record $db
 * @property CI_DB_forge $dbforge
 */

class tipoProcedencia extends Controller{
    function tipoProcedencia() {
        parent::Controller();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('tipoProcedenciaModel');
        $this->load->library('JELGeneral');
    }


  function tipoProcedenciaControl()
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

    $config['base_url'] =   base_url().'/index.php/tipoProcedencia/tipoProcedenciaControl/';
    $config['total_rows'] = $this->tipoProcedenciaModel->getNumTotalTipoProcedencia($campo, $criterio, $valor);
    $config['per_page'] = 10;
    $config['uri_segment'] = 3;
    $config['first_link'] = 'Inicio';
    $config['last_link'] = 'Fin';

    $data['result']=$this->tipoProcedenciaModel->getAllTipoProcedencia($campo, $criterio, $valor, $page, $config['per_page']);

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

    $this->load->view('mantenimiento/tipoProcedenciaList', $data);
  }

  function tipoProcedenciaForm()
  {
    $id =$this->uri->segment(3);
    $data['id'] = $id;
    //$data['tipoProcedenciaId'] = -1;
    $data['tipoProcedencia']= $this->tipoProcedenciaModel->getAllTipoProcedencia('', '', '', '', '');
    $data['nombreTipoProcedencia'] = '';
    $data['activo'] = 1;
    //Armado de las opciones del menu segun el usuario
    $centinela = new Centinela();
    $menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
    $data['menu']               = $this->load->view('vis_menu',$menu_final,true);


    if($id!=-1)
    {
      $reg=$this->tipoProcedenciaModel->getTipoProcedencia($id);

      //$data['tipoProcedenciaId'] = $reg->tipo_procedencia_id;
      $data['nombreTipoProcedencia'] = $reg->nombre_tipo_procedencia;
      $data['activo'] = $reg->activo;
    }
    $this->load->view('mantenimiento/tipoProcedenciaForm', $data);
  }

  function tipoProcedenciaRecord()
  {
    $this->load->library('form_validation');		
    $this->form_validation->set_rules('txtTipoProcedencia', 'Tipo Procedencia', 'required');

    $data['id'] = $_POST['txtId'];
    //$data['tipoProcedenciaId'] = $_POST['cmbTipoProcedencia'];
    $data['tipoProcedencia']= $this->tipoProcedenciaModel->getAllTipoProcedencia('', '', '', '', '');
    $data['nombreTipoProcedencia'] = $_POST['txtTipoProcedencia'];
    $data['activo'] = $_POST['txtActivo'];
     //Armado de las opciones del menu segun el usuario
    $centinela = new Centinela();
    $menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
    $data['menu']               = $this->load->view('vis_menu',$menu_final,true);

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('mantenimiento/tipoProcedenciaForm',$data);
		}
		else
		{

			  if($data['id'] == -1)
			  {
				$dataMsg['result'] = $this->tipoProcedenciaModel->insertTipoProcedencia( $data['nombreTipoProcedencia']);
				$this->jelgeneral->mensaje($this,'Registro Almacenado Exitosamente','tipoProcedencia/tipoProcedenciaControl','black');
			  }
			  else
			  {
				$dataMsg['result'] = $this->tipoProcedenciaModel->updateTipoProcedencia($data['id'],  $data['nombreTipoProcedencia'], $data['activo']);
			   $this->jelgeneral->mensaje($this,'Registro Modificado Exitosamente','tipoProcedencia/tipoProcedenciaControl','black');
			  }
    	}
  }

  function tipoProcedenciaDelete()
  {
    $id =$this->uri->segment(3);
    $data['result'] = $this->tipoProcedenciaModel->deleteTipoProcedencia($id);
    $this->jelgeneral->mensaje($this,'Registro Eliminado Exitosamente','tipoProcedencia/tipoProcedenciaControl','black');
  }

}
?>
