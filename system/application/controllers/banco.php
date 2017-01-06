<?php
/**
 * @property CI_Loader $load
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property CI_Email $email
 * @property CI_DB_active_record $db
 * @property CI_DB_forge $dbforge
 */

class banco extends Controller{
    function banco() {
        parent::Controller();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('bancoModel');
        $this->load->library('JELGeneral');
    }


  function bancoControl()
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

    $config['base_url'] =   base_url().'/index.php/banco/bancoControl/';
    $config['total_rows'] = $this->bancoModel->getNumTotalBanco($campo, $criterio, $valor);
    $config['per_page'] = 10;
    $config['uri_segment'] = 3;
    $config['first_link'] = 'Inicio';
    $config['last_link'] = 'Fin';

    $data['result']=$this->bancoModel->getAllBanco($campo, $criterio, $valor, $page, $config['per_page']);

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


    $this->load->view('mantenimiento/bancoList', $data);
  }

  function bancoForm()
  {
    $id =$this->uri->segment(3);
    $data['id'] = $id;        
    $data['nombreBanco'] = '';
    $data['activo'] = 1;
     //Carga del menú principal de la aplicación
    $data['menu']=$this->load->view('menu', $data,true);

    if($id!=-1)
    {
      $reg=$this->bancoModel->getBanco($id);      
      $data['nombreBanco'] = $reg->nombre_banco;
      $data['activo'] = $reg->activo;
    }
    $this->load->view('mantenimiento/bancoForm', $data);
  }

  function bancoRecord()
  {
    $this->load->library('form_validation');		
    $this->form_validation->set_rules('txtBanco', 'Banco', 'required');

    $data['id'] = $_POST['txtId'];    
    $data['nombreBanco'] = $_POST['txtBanco'];
    $data['activo'] = $_POST['txtActivo'];
    //Carga del menú principal de la aplicación
    $data['menu']=$this->load->view('menu', $data,true);
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('mantenimiento/bancoForm',$data);
		}
		else
		{

			  if($data['id'] == -1)
			  {
				$dataMsg['result'] = $this->bancoModel->insertBanco( $data['nombreBanco']);
				$this->jelgeneral->mensaje($this,'Registro Almacenado Exitosamente','banco/bancoControl','black');
			  }
			  else
			  {
				$dataMsg['result'] = $this->bancoModel->updateBanco($data['id'],  $data['nombreBanco'], $data['activo'],'black');
			   $this->jelgeneral->mensaje($this,'Registro Modificado Exitosamente','banco/bancoControl');
			  }
    	}
  }

  function bancoDelete()
  {
    $id =$this->uri->segment(3);
    $data['result'] = $this->bancoModel->deleteBanco($id);
    $this->jelgeneral->mensaje($this,'Registro Eliminado Exitosamente','banco/bancoControl','black');
  }

}
?>
