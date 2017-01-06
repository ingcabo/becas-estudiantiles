<?php
/* Programador: Sigerist Rodriguez y Ricardo Camejo
 * Fecha: 03/06/09
*/


class Carrera extends Controller
{

	function Carrera()
	{
		parent::Controller();
        $this->load->helper(array('form','date','url'));
        $this->load->library(array('JELGeneral','form_validation','xajax','pagination'));
        $this->load->model(array('carreraModel','model_consulta','mfrmclass'));
        $this->xajax->registerFunction(array('buildSelectTipoPeriodo', &$this, 'buildSelectTipoPeriodo'));
        $this->xajax->processRequest();
        $this->javaScriptText = $this->xajax->getJavascript(base_url());
	}

  function index()
  {
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
    $config['base_url']     = base_url().'/index.php/carrera';
    $config['total_rows']   = $this->carreraModel->getNumTotalCarrera($campo, $criterio, $valor);
    $config['per_page']     = 10;
    $config['uri_segment']  = 3;
    $config['first_link']   = 'Inicio';
    $config['last_link']    = 'Fin';
    $this->pagination->initialize($config);
    $pages                  = $this->pagination->create_links();

    //Consulta para obtener todos los registros
    $data['result']     = $this->carreraModel->getAllCarrera($campo, $criterio, $valor, $page, $config['per_page']);
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
    $this->load->view('mantenimiento/carreraList', $data);
  } //Fin index


   function buildSelectTipoPeriodo($modalidadId){

    $objResponse = new xajaxResponse();

    //$paisId = $this->getHTTPArgument($arguments,'paisId');
    //$paisId = 1;
    $tipoInstituto = $this->carreraModel->getAllTipoInstituto('carrera_id', 'Sea Igual a', $modalidadId, '', '');

    $result = '<select name="cmbTipoPeriodo" id="cmbTipoPeriodo" style="width:363px">';
    $result = $result .'<option></option>';
    if($tipoInstituto->num_rows()!=0)
    {
      foreach($tipoInstituto->result() as $row)
      {
        $result = $result . '<option value = "'.$row->tipo_periodo_id.'">'.$row->nombre_tipo_periodo.'</option>';
      }
    }
    $result = $result . '</select>';

    $objResponse->Assign('divTipoPeriodo', "innerHTML", $result);
    return $objResponse;
  }


  function carreraForm(){

    $data['nombre_carrera']     = '';
    $data['descripcion_carrera']= '';
    $data['carrera_id']         = '-1';

    $id                         = $this->uri->segment(3);
    
    //Armado de las opciones del menu segun el usuario
    $centinela = new Centinela();
    $menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
    $data['menu']               = $this->load->view('vis_menu',$menu_final,true);

    if($id!=-1){
      $reg                          = $this->carreraModel->getcarrera($id);
      $data['carrera_id']           = $id;

      $data['nombre_carrera']       = $reg->nombre_carrera;
      $data['descripcion_carrera']  = $reg->descripcion_carrera;




      
    }
    $this->load->view('mantenimiento/carreraForm', $data);
  }

  function carreraRecord()
  {
    
		$this->form_validation->set_rules('nombre_carrera', 'Nombre de Carrera', 'required');
		$this->form_validation->set_rules('descripcion_carrera', 'Parroquia', '');

        
        //Se reciben los datos del formulario a guardar
        $data['nombre_carrera']         = $this->input->post('nombre_carrera');
        $data['descripcion_carrera']    = $this->input->post('descripcion_carrera');
        $data['carrera_id']             = $this->input->post('carrera_id');

        //echo 'Valor id: '.$data['institutoId'];
        //Armado de las opciones del menu segun el usuario
        $centinela = new Centinela();
        $menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
        $data['menu']               = $this->load->view('vis_menu',$menu_final,true);
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('mantenimiento/carreraForm',$data);
		}
		else
		{
			  if($data['carrera_id'] == -1)
			  {
				$dataMsg['result'] = $this->carreraModel->insertcarrera($data);
				$this->jelgeneral->mensaje($this,'Registro Almacenado Exitosamente','carrera','black');
			  }
			  else
			  {
				$dataMsg['result'] = $this->carreraModel->updatecarrera($data);
			    $this->jelgeneral->mensaje($this,'Registro Modificado Exitosamente','carrera','black');
			  }
    	}
  }

  function carreraDelete()
  {
    $id =$this->uri->segment(3);
    $data['result'] = $this->carreraModel->deletecarrera($id);
    $this->jelgeneral->mensaje($this,'Registro Eliminado Exitosamente','carrera','black');
  }

}
?>
