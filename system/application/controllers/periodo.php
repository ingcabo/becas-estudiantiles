<?php

class periodo extends Controller
{

	function periodo()
	{
		parent::Controller();
    $this->load->helper(array('form','date','url'));
    $this->load->library(array('JELGeneral','form_validation','xajax'));
    $this->load->model(array('periodoModel','tipoPeriodoModel'));
    $this->xajax->registerFunction(array('buildSelectTipoPeriodo', &$this, 'buildSelectTipoPeriodo'));
    $this->xajax->processRequest();
    $this->javaScriptText = $this->xajax->getJavascript(base_url());
	}

   function buildSelectTipoPeriodo($modalidadId){

    $objResponse = new xajaxResponse();

    //$paisId = $this->getHTTPArgument($arguments,'paisId');
    //$paisId = 1;
    $tipoPeriodos = $this->tipoPeriodoModel->getAllTipoPeriodo('tipo_periodo_id', 'Sea Igual a', $modalidadId, '', '');

    $result = '<select name="cmbTipoPeriodo" id="cmbTipoPeriodo" style="width:363px">';
    $result = $result .'<option></option>';
    if($tipoPeriodos->num_rows()!=0)
    {
      foreach($tipoPeriodos->result() as $row)
      {
        $result = $result . '<option value = "'.$row->tipo_periodo_id.'">'.$row->nombre_tipo_periodo.'</option>';
      }
    }
    $result = $result . '</select>';

    $objResponse->Assign('divTipoPeriodo', "innerHTML", $result);
    return $objResponse;
  }

  function periodoControl()
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

    $config['base_url'] =   base_url().'/index.php/periodo/periodoControl/';
    $config['total_rows'] = $this->periodoModel->getNumTotalPeriodo($campo, $criterio, $valor);
    $config['per_page'] = 10;
    $config['uri_segment'] = 3;
    $config['first_link'] = 'Inicio';
    $config['last_link'] = 'Fin';

    $data['result']=$this->periodoModel->getAllPeriodo($campo, $criterio, $valor, $page, $config['per_page']);

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


    $this->load->view('mantenimiento/periodoList', $data);
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

  function periodoForm()
  {
    $id =$this->uri->segment(3);
    $data['id']                 = $id;
    $data['tipoPeriodoId']      = -1;
    $data['tipoPeriodos']       = $this->tipoPeriodoModel->getAllTipoPeriodo('', '', '', '', '');
    $data['nombreTipoPeriodos'] = '';
    $data['parcialPeriodo']     = '';
    $data['anoPeriodo']         = $this->listaanos();
    $data['activo']             = 1;
    //Armado de las opciones del menu segun el usuario
    $centinela = new Centinela();
    $menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
    $data['menu']               = $this->load->view('vis_menu',$menu_final,true);

    if($id!=-1)
    {
      $reg=$this->periodoModel->getPeriodo($id);

      $data['tipoPeriodoId']        = $reg->tipo_periodo_id;
      $data['nombreTipoPeriodo']    = $reg->nombre_tipo_periodo;
      $data['parcialPeriodo']       = $reg->parcial_periodo;
      $data['anoPeriodo']           = $this->listaanos();
      $data['anoPeriodoSel']        = $reg->ano_periodo;
      $data['activo']               = $reg->activo;
    }
    $this->load->view('mantenimiento/periodoForm', $data);
  }

  function periodoRecord()
  {
    
		$this->form_validation->set_rules('cmbTipoPeriodos', 'Tipo de Periodo', 'required');
		$this->form_validation->set_rules('txtparcialPeriodo', 'Parcial del Periodo', 'required');
        $this->form_validation->set_rules('anoPeriodo', 'Año del Periodo', 'required');

    $data['id']             = $_POST['txtId'];
    $data['tipoPeriodos']   = $this->tipoPeriodoModel->getAllTipoPeriodo('', '', '', '', '');
    $data['tipoPeriodoId']  = $_POST['cmbTipoPeriodos'];
    $data['parcialPeriodo'] = $_POST['txtparcialPeriodo'];
    $data['anoPeriodo']     = $this->listaanos();
    $data['anoPeriodoSel']  = $_POST['anoPeriodo'];
    $data['visible']        = isset($_POST['chkVisible'])?'true':'false';
    //Armado de las opciones del menu segun el usuario
    $centinela = new Centinela();
    $menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
    $data['menu']               = $this->load->view('vis_menu',$menu_final,true);
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('mantenimiento/periodoForm',$data);
		}
		else
		{
     
			  if($data['id'] == -1)
			  {
				$dataMsg['result'] = $this->periodoModel->insertPeriodo($data['tipoPeriodoId'], $data['parcialPeriodo'],$data['anoPeriodoSel'],$data['visible']);
				$this->jelgeneral->mensaje($this,'Registro Almacenado Exitosamente','periodo/periodoControl','black');
			  }
			  else
			  {
				$dataMsg['result'] = $this->periodoModel->updatePeriodo($data['id'], $data['tipoPeriodoId'], $data['parcialPeriodo'],$data['anoPeriodoSel'], $data['visible']);
			   $this->jelgeneral->mensaje($this,'Registro Modificado Exitosamente','periodo/periodoControl','black');
			  }
    	}
  }

  function periodoDelete()
  {
    $id =$this->uri->segment(3);
    $data['result'] = $this->periodoModel->deletePeriodo($id);
    $this->jelgeneral->mensaje($this,'Registro Eliminado Exitosamente','periodo/periodoControl','black');
  }

}
?>
