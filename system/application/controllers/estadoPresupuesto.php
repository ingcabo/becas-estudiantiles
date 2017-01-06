<?php

class estadoPresupuesto extends Controller
{

function estadoPresupuesto()
	{
		parent::Controller();
        $this->load->helper(array('form','date','url'));
        $this->load->library(array('JELGeneral','form_validation','xajax','pagination'));
        $this->load->model(array('model_consulta','mfrmclass'));
        $this->load->model('estadopresupuestoModel');
        $this->javaScriptText = $this->xajax->getJavascript(base_url());
	}


function index(){

  $page = is_numeric($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

    if(isset($_POST['bandPost']))
    {
      $campo    = isset($_POST['cmbCampo']) ? $_POST['cmbCampo'] : '';
      $criterio = isset($_POST['cmbCriterio']) ? $_POST['cmbCriterio'] : '';
      $valor    = isset($_POST['txtValor']) ? $_POST['txtValor'] : '';
    }
    else
    {
      $campo    = '';
      $criterio = '';
      $valor    = '';
      $uri      = current_url();

      $campo    =  $this->jelgeneral->getSegmentArgument($uri, 'cmbCampo');
      if($campo!='')
      {
        $criterio   = $this->jelgeneral->getSegmentArgument($uri, 'cmbCriterio');
        $valor      = $this->jelgeneral->getSegmentArgument($uri, 'txtValor');
      }
    }

    //Paginacion
    $config['base_url']     = base_url().'/index.php/estadoPresupuesto';
    $config['total_rows']   = $this->estadopresupuestoModel->getNumTotalestadopresupuesto($campo, $criterio, $valor); //**************
    $config['per_page']     = 10;
    $config['uri_segment']  = 3;
    $config['first_link']   = 'Inicio';
    $config['last_link']    = 'Fin';
    $this->pagination->initialize($config);
    $pages                  = $this->pagination->create_links();

    //Consulta para obtener todos los registros
    $data['result']     = $this->estadopresupuestoModel->getAllestadopresupuesto($campo, $criterio, $valor, $page, $config['per_page']);
    //Consulta filtrada de registros
    $data['pages']      = $this->jelgeneral->getFilterPages($pages,$campo,$criterio,$valor);
    //Armado de las opciones del menu segun el usuario
    $centinela = new Centinela();
    $menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
    $data['menu']               = $this->load->view('vis_menu',$menu_final,true);
    //Repopulo campos de busqueda
    $data['campo']      = $campo;
    $data['criterio']   = $criterio;
    $data['valor']      = $valor;
    $this->form_validation->set_error_delimiters('<div class="celdaError">', '</div>');
    echo validation_errors('<div class="celdaError">', '</div>');
    //Permisologia
    $data['permisos']['i'] = $this->mod_usuario->evalua_permiso('i','',$this->uri->segment(1));
    $data['permisos']['m'] = $this->mod_usuario->evalua_permiso('m','',$this->uri->segment(1));
    $data['permisos']['b'] = $this->mod_usuario->evalua_permiso('b','',$this->uri->segment(1));
    //Carga de vista de listado de registros
    $this->load->view('mantenimiento/estadopresupuestoList', $data);


}


 function esatdopresupuestoForm(){

    $data['nombre_estado_presupuesto']     = '';
    $data['estado_presupuesto_id']         = '-1';

    $id                         = $this->uri->segment(3);

    //Armado de las opciones del menu segun el usuario
    $centinela = new Centinela();
    $menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
    $data['menu']               = $this->load->view('vis_menu',$menu_final,true);

    if($id!=-1){
      $reg                                     = $this->estadopresupuestoModel->getestadopresupuesto($id);
      $data['estado_presupuesto_id']           = $id;
      $data['nombre_estado_presupuesto']       = $reg->nombre_estado_presupuesto;






    }
    $this->load->view('mantenimiento/estadopresupuestoForm', $data);
  }



function estadopresupuestoRecord()
  {

		$this->form_validation->set_rules('nombre_estado_presupuesto', 'Nombre Estado Presupuesto', 'required');



        //Se reciben los datos del formulario a guardar
        $data['nombre_estado_presupuesto']         = $this->input->post('nombre_estado_presupuesto');
        $data['estado_presupuesto_id']             = $this->input->post('estado_presupuesto_id');

        //echo 'Valor id: '.$data['institutoId'];
        //Armado de las opciones del menu segun el usuario
        $centinela = new Centinela();
        $menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
        $data['menu']               = $this->load->view('vis_menu',$menu_final,true);
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('mantenimiento/estadopresupuestoForm',$data);
		}
		else
		{
			  if($data['estado_presupuesto_id'] == -1)
			  {
				$dataMsg['result'] = $this->estadopresupuestoModel->ins_estado_presupuesto($data);
				$this->jelgeneral->mensaje($this,'Registro Almacenado Exitosamente','estadoPresupuesto','black');
			  }
			  else
			  {
				$dataMsg['result'] = $this->estadopresupuestoModel->upd_estado_presupuesto($data);
			    $this->jelgeneral->mensaje($this,'Registro Modificado Exitosamente','estadoPresupuesto','black');
			  }
    	}
  }



function delete_estadopresupuesto(){



    $id =$this->uri->segment(3);
   
    $data['result'] = $this->estadopresupuestoModel->delete_estadopresupuesto($id);
    $this->jelgeneral->mensaje($this,'Registro Eliminado Exitosamente','estadoPresupuesto','black');
}



}
?>