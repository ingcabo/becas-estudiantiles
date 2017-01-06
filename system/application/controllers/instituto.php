<?php
/* Programador: Sigerist Rodriguez y Ricardo Camejo
 * Fecha: 03/06/09
*/


class Instituto extends Controller
{

	function Instituto()
	{
		parent::Controller();
        $this->load->helper(array('form','date','url'));
        $this->load->library(array('JELGeneral','form_validation','xajax','pagination'));
        $this->load->model(array('institutoModel'));
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
    $config['base_url']     = base_url().'/index.php/instituto';
    $config['total_rows']   = $this->institutoModel->getNumTotalInstituto($campo, $criterio, $valor);
    $config['per_page']     = 10;
    $config['uri_segment']  = 3;
    $config['first_link']   = 'Inicio';
    $config['last_link']    = 'Fin';
    $this->pagination->initialize($config);
    $pages                  = $this->pagination->create_links();

    //Consulta para obtener todos los registros
    $data['result']     = $this->institutoModel->getAllInstituto($campo, $criterio, $valor, $page, $config['per_page']);
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
    $this->load->view('mantenimiento/institutoList', $data);
  } //Fin index


   function buildSelectTipoPeriodo($modalidadId){

    $objResponse = new xajaxResponse();

    //$paisId = $this->getHTTPArgument($arguments,'paisId');
    //$paisId = 1;
    $tipoInstituto = $this->institutoModel->getAllTipoInstituto('tipo_periodo_id', 'Sea Igual a', $modalidadId, '', '');

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



  //Genero listado de años
    function listaanos(){
       $anoinicio = 2000;
       $anos[0] = 'Seleccione uno';
       for($ano=2000;$ano<=date('Y',now());$ano++){
           $anos[$ano] = $ano;
       }
       return $anos;
    } //Fin listaanos

  function institutoForm()
  {
    $id =   $this->uri->segment(3);
    $data['institutoId']                = $id;
    $data['nombre_instituto']           = '';
    $data['siglas_instituto']           = '';
    $data['rif_instituto']              = '';
    $data['rector_instituto']           = '';
    $data['unidad_credito_instituto']   = '';
    $data['activo']                     = 1;
    //Armado de las opciones del menu segun el usuario
    $centinela = new Centinela();
    $menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
    $data['menu']               = $this->load->view('vis_menu',$menu_final,true);

    if($id!=-1)
    {
      $reg=$this->institutoModel->getInstituto($id);

      $data['institutoId']          = $reg->instituto_id;
      $data['nombre_instituto']     = $reg->nombre_instituto;
      $data['siglas_instituto']     = $reg->siglas_instituto;
      $data['rif_instituto']        = $reg->rif_instituto;
      $data['rector_instituto']     = $reg->rector_instituto;
      $data['unidad_credito_instituto'] = $reg->unidad_credito_instituto;
      $data['activo']               = $reg->activo;
    }
    $this->load->view('mantenimiento/institutoForm', $data);
  }

  function institutoRecord()
  {
    
		$this->form_validation->set_rules('txtnombre_instituto', 'Nombre del Instituto', 'required');
		$this->form_validation->set_rules('txtsiglas_instituto', 'Siglas del Instituto', 'required');
        $this->form_validation->set_rules('txtrif_instituto', 'R.I.F.', 'required');
        $this->form_validation->set_rules('txtrector_instituto', 'Nombre del Rector', 'required');
        $this->form_validation->set_rules('txtunidad_credito_instituto', 'Unidad Crédito ', 'required');
        
        //Se reciben los datos del formulario a guardar
        $data['institutoId']          = $_POST['txtId'];//$this->input->post('txtid');
        $data['nombre_instituto']     = $this->input->post('txtnombre_instituto');
        $data['siglas_instituto']     = $this->input->post('txtsiglas_instituto');
        $data['rif_instituto']        = $this->input->post('txtrif_instituto');
        $data['rector_instituto']     = $this->input->post('txtrector_instituto');
        $data['unidad_credito_instituto'] = $this->input->post('txtunidad_credito_instituto');
        $data['activo']               = $this->input->post('txtactivo');

        //echo 'Valor id: '.$data['institutoId'];
        //Armado de las opciones del menu segun el usuario
        $centinela = new Centinela();
        $menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
        $data['menu']               = $this->load->view('vis_menu',$menu_final,true);
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('mantenimiento/institutoForm',$data);
		}
		else
		{
			  if($data['institutoId'] == -1)
			  {
				$dataMsg['result'] = $this->institutoModel->insertInstituto($data['nombre_instituto'], $data['siglas_instituto'],$data['rif_instituto'],$data['rector_instituto'],$data['unidad_credito_instituto']);
				$this->jelgeneral->mensaje($this,'Registro Almacenado Exitosamente','instituto','black');
			  }
			  else
			  {
				$dataMsg['result'] = $this->institutoModel->updateInstituto($data['institutoId'], $data['nombre_instituto'], $data['siglas_instituto'],$data['rif_instituto'],$data['rector_instituto'],$data['unidad_credito_instituto']);
			   $this->jelgeneral->mensaje($this,'Registro Modificado Exitosamente','instituto','black');
			  }
    	}
  }

  function institutoDelete()
  {
    $id =$this->uri->segment(3);
    $data['result'] = $this->institutoModel->deleteInstituto($id);
    $this->jelgeneral->mensaje($this,'Registro Eliminado Exitosamente','instituto','black');
  }

}
?>
