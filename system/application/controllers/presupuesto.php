<?php

class presupuesto extends Controller
{
   var $classBaseName;
   var $baseDir;
function presupuesto()
	{
		parent::Controller();
        $this->load->helper(array('form','date','url'));
        $this->load->library(array('JELGeneral','form_validation','xajax','pagination'));
        $this->load->model(array('Model_consulta','mfrmclass'));
        $this->load->model('presupuestoModel');
        $this -> load  -> library('mylib_base');
        $this->javaScriptText = $this->xajax->getJavascript(base_url());
        $this->classBaseName ='presupuestoPersona';
        $this->baseDir ='mantenimiento';
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
    $config['base_url']     = base_url().'/index.php/presupuesto';
    $config['total_rows']   = $this->presupuestoModel->getNumTotalpresupuesto($campo, $criterio, $valor); //**************
    $config['per_page']     = 10;
    $config['uri_segment']  = 3;
    $config['first_link']   = 'Inicio';
    $config['last_link']    = 'Fin';
    $this->pagination->initialize($config);
    $pages                  = $this->pagination->create_links();

    //Consulta para obtener todos los registros
    $data['result']     = $this->presupuestoModel->getAllpresupuesto($campo, $criterio, $valor, $page, $config['per_page']);
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
    $this->load->view('mantenimiento/presupuestoList', $data);

    


}





function presupuestoForm(){

 $data['q_estado']              = $this -> Model_consulta -> consulta_combo('nombre_estado_presupuesto','ASC','estado_presupuesto');
 $data['q_periodo']             = $this -> Model_consulta -> consulta_combo('ano_periodo','ASC','periodo');


 $pre_id                  = $this->uri->segment(4);
 $be_id                   = $this->uri->segment(3);



    
    $data['presupuesto_id']                  = $pre_id;
    $data['beca_persona_id']                 = $be_id;
    $data['periodo_id']                      = '';
    $data['estado_presupuesto_id']           = '';
    $data['codigo_presupuesto']              = '';
    $data['fecha_presupuesto']               = '';
    $data['monto_presupuesto']               = '';
    $data['observaciones']                   = '';

   

    //Armado de las opciones del menu segun el usuario
    $centinela = new Centinela();
    $menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
    $data['menu']               = $this->load->view('vis_menu',$menu_final,true);

    if($pre_id!=-1){
      $reg                                     = $this->presupuestoModel->getpresupuesto($pre_id);

      $data['presupuesto_id']                  = $pre_id;
      $data['beca_persona_id']                 = $reg->beca_persona_id;
      $data['periodo_id']                      = $reg->periodo_id;
      $data['estado_presupuesto_id']           = $reg->estado_presupuesto_id;
      $data['codigo_presupuesto']              = $reg->codigo_presupuesto;
      $data['fecha_presupuesto']               = $this->mylib_base->pg_to_human($reg->fecha_presupuesto);
      $data['monto_presupuesto']               = $reg->monto_presupuesto;
      $data['observaciones']                   = $reg->observaciones;




    }
    $this->load->view('mantenimiento/presupuestoForm', $data);


}


function presupuestoRecord()
  {

		$this->form_validation->set_rules('cmbperiodo', 'Periodo', 'required');
        $this->form_validation->set_rules('cmbestado', 'Esta del Presupuesto', 'required');
        $this->form_validation->set_rules('codigo_presupuesto', 'Codigo', 'required');
        $this->form_validation->set_rules('fecha_presupuesto', 'Fecha', 'required');
        $this->form_validation->set_rules('monto_presupuesto', 'Monto', 'required');
        $data['q_estado']              = $this -> Model_consulta -> consulta_combo('nombre_estado_presupuesto','ASC','estado_presupuesto');
        $data['q_periodo']             = $this -> Model_consulta -> consulta_combo('ano_periodo','ASC','periodo');


        //Se reciben los datos del formulario a guardar
        


        $data['presupuesto_id']                  = $this->input->post('presupuesto_id');
        $data['beca_persona_id']                 = $this->input->post('beca_persona_id');
        $data['periodo_id']                      = $this->input->post('cmbperiodo');
        $data['estado_presupuesto_id']           = $this->input->post('cmbestado');
        $data['codigo_presupuesto']              = $this->input->post('codigo_presupuesto');
        $data['fecha_presupuesto']               = $this->input->post('fecha_presupuesto');
        $data['monto_presupuesto']               = $this->input->post('monto_presupuesto');
        $data['observaciones']                   = $this->input->post('observaciones');




        //echo 'Valor id: '.$data['institutoId'];
        //Armado de las opciones del menu segun el usuario
        $centinela = new Centinela();
        $menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
        $data['menu']               = $this->load->view('vis_menu',$menu_final,true);
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('mantenimiento/presupuestoForm',$data);
		}
		else
		{
			  if($data['presupuesto_id'] == -1)
			  {
				$dataMsg['result'] = $this->presupuestoModel->ins_presupuesto($data);
				$this->jelgeneral->mensaje($this,'Registro Almacenado Exitosamente','presupuesto','black');
			  }
			  else
			  {
				$dataMsg['result'] = $this->presupuestoModel->upd_presupuesto($data);
			    $this->jelgeneral->mensaje($this,'Registro Modificado Exitosamente','presupuesto','black');
			  }
    	}
  }



function del_presupuesto(){



    $id =$this->uri->segment(4);

    $data['result'] = $this->presupuestoModel->del_presupuesto($id);
    $this->jelgeneral->mensaje($this,'Registro Eliminado Exitosamente','presupuesto','black');
}








 function presupuestoPersonaControl()
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
        $config['total_rows'] = $this->presupuestoModel->getNumTotalBeneficiario($campo, $criterio, $valor);
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['first_link'] = 'Inicio';
        $config['last_link'] = 'Fin';

        $data['result']=$this->presupuestoModel->getAllBeneficiario($campo, $criterio, $valor, $page, $config['per_page']);

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



}
?>
