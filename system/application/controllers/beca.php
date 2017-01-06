<?php
/* Programador: Sigerist Rodriguez y Ricardo Camejo
 * Fecha: 03/06/09
*/


class Beca extends Controller
{

	function Beca()
	{
		parent::Controller();
        $this->load->helper(array('form','date','url'));
        $this->load->library(array('JELGeneral','form_validation','xajax','pagination'));
        $this->load->model(array('becaModel','model_consulta','mfrmclass'));
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
    $config['base_url']     = base_url().'/index.php/beca';
    $config['total_rows']   = $this->becaModel->getNumTotalBeca($campo, $criterio, $valor);
    $config['per_page']     = 10;
    $config['uri_segment']  = 3;
    $config['first_link']   = 'Inicio';
    $config['last_link']    = 'Fin';
    $this->pagination->initialize($config);
    $pages                  = $this->pagination->create_links();

    //Consulta para obtener todos los registros
    $data['result']     = $this->becaModel->getAllBeca($campo, $criterio, $valor, $page, $config['per_page']);
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


   //Permisologia
    $data['permisos']['i'] = $this->mod_usuario->evalua_permiso('i','',$this->uri->segment(1));
    $data['permisos']['m'] = $this->mod_usuario->evalua_permiso('m','',$this->uri->segment(1));
    $data['permisos']['b'] = $this->mod_usuario->evalua_permiso('b','',$this->uri->segment(1));
   //fin permisologia a copiar


   
    $this->form_validation->set_error_delimiters('<div class="celdaError">', '</div>');
    echo validation_errors('<div class="celdaError">', '</div>');
    //Carga de vista de listado de registros
    $this->load->view('mantenimiento/becaList', $data);
  } //Fin index


   function buildSelectTipoPeriodo($modalidadId){

    $objResponse = new xajaxResponse();

    //$paisId = $this->getHTTPArgument($arguments,'paisId');
    //$paisId = 1;
    $tipoInstituto = $this->becaModel->getAllTipoBeca('nucleo_instituto_id', 'Sea Igual a', $modalidadId, '', '');

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

  function becaForm()
  {
    //Consulta de tipos de beca
    $q_tipo_beca                       = $this->db->query('Select tipo_beca_id,nombre_tipo_beca from tipo_beca order by nombre_tipo_beca');
    $a_tipo_beca                       = $q_tipo_beca->result_array();
    foreach($a_tipo_beca as $campos){
        $ddl_tipo_beca[$campos['tipo_beca_id']] = $campos['nombre_tipo_beca'];
    }
    $data['tipo_beca_lista']            = $ddl_tipo_beca;
    $data['nombre_beca']                = '';
    $data['combinable_beca']            = '';
    $data['monto_beca']                 = '';
    $data['activo']                     = '1';
    $data['beca_id']                    = -1;
    $data['permisos']['sl']['nombre_beca'] = false;
    

    $id                                 = $this->uri->segment(3);
    
     //Carga del menú principal de la aplicación
    $centinela = new Centinela();
    $menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
    $data['menu']               = $this->load->view('vis_menu',$menu_final,true);
    

    if($id!=-1)
    {
      $reg                                = $this->becaModel->getBeca($id);
      $data['tipo_beca_id']               = $reg->tipo_beca_id;
      $data['tipo_beca_lista']            = $ddl_tipo_beca;
      $data['nombre_beca']                = $reg->nombre_beca;
      $data['combinable_beca']            = $reg->combinable_beca;
      $data['monto_beca']                 = $reg->monto_beca;
      $data['beca_id']                    = $reg->beca_id;
      $data['activo']                     = '1';
      //Repetir esta linea tantas veces como campos a restringir sean necesarios
      $data['permisos']['sl']['nombre_beca'] = $this->mod_usuario->evalua_permiso('sl','nombre_beca',$this->uri->segment(1));
    }
    $this->load->view('mantenimiento/becaForm', $data);
  }

  function becaRecord()
  {
		$this->form_validation->set_rules('tipo_beca_id', 'Tipo de Beca', 'integer|required');
        $this->form_validation->set_rules('nombre_beca', 'Descripción de beca', 'required');
        $this->form_validation->set_rules('monto_beca', 'Monto Beca', 'required');
        
        //Se reciben los datos del formulario a guardar
        $data['tipo_beca_id']       = $this->input->post('tipo_beca_id');
        $data['nombre_beca']        = $this->input->post('nombre_beca');
        if(isset($_POST['combinable_beca'])){
           $data['combinable_beca'] = $this->input->post('combinable_beca');
        }else{
           $data['combinable_beca'] = 0;
        }
        $data['monto_beca']         = preg_replace('/\,/','.',preg_replace('/\./','',$this->input->post('monto_beca')));
        $data['beca_id']            = $this->input->post('beca_id');

        //echo 'Valor id: '.$data['institutoId'];
        //Carga del menú principal de la aplicación
        $centinela = new Centinela();
        $menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
        $data['menu']               = $this->load->view('vis_menu',$menu_final,true);
        //$data['menu']=$this->load->view('menu', $data,true);
		if ($this->form_validation->run() == FALSE)
		{
            //Consulta de tipos de beca
            $q_tipo_beca                       = $this->db->query('Select tipo_beca_id,nombre_tipo_beca from tipo_beca order by nombre_tipo_beca');
            $a_tipo_beca                       = $q_tipo_beca->result_array();
            foreach($a_tipo_beca as $campos){
              $ddl_tipo_beca[$campos['tipo_beca_id']] = $campos['nombre_tipo_beca'];
            }
            $data['tipo_beca_lista']            = $ddl_tipo_beca;
            $data['permisos']['sl']['nombre_beca'] = $this->mod_usuario->evalua_permiso('sl','nombre_beca',$this->uri->segment(1));
			$this->load->view('mantenimiento/becaForm',$data);
		}
		else
		{
              
			  if($data['beca_id'] == -1)
			  {
				$dataMsg['result'] = $this->becaModel->insertBeca($data);
				$this->jelgeneral->mensaje($this,'Registro Almacenado Exitosamente','beca','black');
			  }
			  else
			  {
				$dataMsg['result'] = $this->becaModel->updateBeca($data);
			    $this->jelgeneral->mensaje($this,'Registro Modificado Exitosamente','beca','black');
			  }
    	}
  }

  function becaDelete()
  {
    if($this->mod_usuario->evalua_permiso('b','',$this->uri->segment(1))){
      $id =$this->uri->segment(3);
      $data['result'] = $this->becaModel->deleteBeca($id);
      $this->jelgeneral->mensaje($this,'Registro Eliminado Exitosamente','beca','black');
    }else{
      $this->jelgeneral->mensaje($this,'Permiso restringido para eliminar datos','beca','black');
    }
    
  }

}
?>
