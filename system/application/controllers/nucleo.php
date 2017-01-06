<?php
/* Programador: Sigerist Rodriguez y Ricardo Camejo
 * Fecha: 03/06/09
*/


class Nucleo extends Controller
{

	function Nucleo()
	{
		parent::Controller();
        $this->load->helper(array('form','date','url'));
        $this->load->library(array('JELGeneral','form_validation','xajax','pagination'));
        $this->load->model(array('nucleoModel','model_consulta','mfrmclass'));
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
    $config['base_url']     = base_url().'/index.php/nucleo';
    $config['total_rows']   = $this->nucleoModel->getNumTotalNucleo($campo, $criterio, $valor);
    $config['per_page']     = 10;
    $config['uri_segment']  = 3;
    $config['first_link']   = 'Inicio';
    $config['last_link']    = 'Fin';
    $this->pagination->initialize($config);
    $pages                  = $this->pagination->create_links();

    //Consulta para obtener todos los registros
    $data['result']     = $this->nucleoModel->getAllNucleo($campo, $criterio, $valor, $page, $config['per_page']);
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
   //fin permisologia a copiar

    //Carga de vista de listado de registros
    $this->load->view('mantenimiento/nucleoList', $data);
  } //Fin index


   function buildSelectTipoPeriodo($modalidadId){

    $objResponse = new xajaxResponse();

    //$paisId = $this->getHTTPArgument($arguments,'paisId');
    //$paisId = 1;
    $tipoInstituto = $this->nucleoModel->getAllTipoInstituto('nucleo_instituto_id', 'Sea Igual a', $modalidadId, '', '');

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

  function nucleoForm()
  {

    $q_institutos                       = $this->db->query('Select instituto_id,nombre_instituto from vis_instituto order by nombre_instituto');
    $a_institutos                       = $q_institutos->result_array();
    foreach($a_institutos as $campos){
        $ddl_institutos[$campos['instituto_id']] = $campos['nombre_instituto'];
    }
    $data['instituto_lista']            = $ddl_institutos;
    $q_parroquias                       = $this->db->query('Select parroquia_id,nombre_parroquia from vis_parroquia order by nombre_parroquia');
    $a_parroquias                       = $q_parroquias->result_array();
    foreach($a_parroquias as $campos){
        $ddl_parroquias[$campos['parroquia_id']] = $campos['nombre_parroquia'];
    }

    $data['parroquia_lista']            = $ddl_parroquias;
    $data['nombre_nucleo_instituto']    = '';
    $data['siglas_nucleo_instituto']    = '';
    $data['direccion_nucleo_instituto'] = '';
    $data['telefono01_nucleo_instituto']= '';
    $data['telefono02_nucleo_instituto']= '';
    $data['telefono03_nucleo_instituto']= '';
    $data['telefono04_nucleo_instituto']= '';
    $data['fax01_nucleo_instituto']     = '';
    $data['fax02_nucleo_instituto']     = '';
    $data['email01_nucleo_instituto']   = '';
    $data['email02_nucleo_instituto']   = '';
    $data['contacto_01']                = '';
    $data['telefono_contacto_01']       = '';
    $data['contacto_02']                = '';
    $data['telefono_contacto_02']       = '';
    $data['activo']                     = '1';
    $data['nucleo_instituto_id']        = '-1';

    $id                                 = $this->uri->segment(3);
    
    //Armado de las opciones del menu segun el usuario
    $centinela = new Centinela();
    $menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
    $data['menu']               = $this->load->view('vis_menu',$menu_final,true);

    if($id!=-1)
    {
      $reg                                = $this->nucleoModel->getNucleo($id);
      $data['nucleo_instituto_id']        = $id;
      $data['instituto_id']               = $reg->instituto_id;
      $data['parroquia_id']               = $reg->parroquia_id;
      $data['nombre_nucleo_instituto']    = $reg->nombre_nucleo_instituto;
      $data['siglas_nucleo_instituto']    = $reg->siglas_nucleo_instituto;
      $data['direccion_nucleo_instituto'] = $reg->direccion_nucleo_instituto;
      $data['telefono01_nucleo_instituto']= $reg->telefono01_nucleo_instituto;
      $data['telefono02_nucleo_instituto']= $reg->telefono02_nucleo_instituto;
      $data['telefono03_nucleo_instituto']= $reg->telefono03_nucleo_instituto;
      $data['telefono04_nucleo_instituto']= $reg->telefono04_nucleo_instituto;
      $data['fax01_nucleo_instituto']     = $reg->fax01_nucleo_instituto;
      $data['fax02_nucleo_instituto']     = $reg->fax02_nucleo_instituto;
      $data['email01_nucleo_instituto']   = $reg->email01_nucleo_instituto;
      $data['email02_nucleo_instituto']   = $reg->email02_nucleo_instituto;
      $data['contacto_01']                = $reg->contacto_01;
      $data['telefono_contacto_01']       = $reg->telefono_contacto_01;
      $data['contacto_02']                = $reg->contacto_02;
      $data['telefono_contacto_02']       = $reg->telefono_contacto_02;
    }
    $this->load->view('mantenimiento/nucleoForm', $data);
  }

  function nucleoRecord()
  {
    
		$this->form_validation->set_rules('instituto_lista', 'Nombre del Instituto', 'integer|required');
		$this->form_validation->set_rules('parroquia_lista', 'Parroquia', 'integer');
        $this->form_validation->set_rules('nombre_nucleo_instituto', 'Nombre del Nucleo', 'required');
        $this->form_validation->set_rules('siglas_nucleo_instituto', 'Siglas del Nucleo', 'required');
        $this->form_validation->set_rules('direccion_nucleo_instituto', 'Dirección del Nucleo', 'required');
        $this->form_validation->set_rules('telefono01_nucleo_instituto', 'Teléfono Principal', 'required');
		$this->form_validation->set_rules('telefono02_nucleo_instituto', 'Teléfono Secundario', '');
        $this->form_validation->set_rules('telefono03_nucleo_instituto', 'Teléfono Alternativo', '');
        $this->form_validation->set_rules('telefono04_nucleo_instituto', 'Teléfono Alternativo', '');
        $this->form_validation->set_rules('fax01_nucleo_instituto', 'Número de Fax', 'required');
        $this->form_validation->set_rules('fax02_nucleo_instituto', 'Número de Fax Alternativo', '');
        $this->form_validation->set_rules('email01_nucleo_instituto', 'Correo Electrónico', 'required|valid_email');
		$this->form_validation->set_rules('email02_nucleo_instituto', 'Correo Electrónico Alternativo', 'valid_email');
        $this->form_validation->set_rules('contacto_01', 'Persona Contacto', '');
        $this->form_validation->set_rules('telefono_contacto_01', 'Teléfono Persona Contacto', '');
        $this->form_validation->set_rules('contacto_02', 'Persona Contacto Alternativo', '');
        $this->form_validation->set_rules('telefono_contacto_02', 'Telefono Persona Contacto Alternativo', '');
        
        //Se reciben los datos del formulario a guardar
        $data['nucleo_instituto_id']        = $this->input->post('nucleo_instituto_id');
        $data['instituto_id']               = $this->input->post('instituto_lista');
        $data['parroquia_id']               = $this->input->post('parroquia_lista');
        $data['nombre_nucleo_instituto']    = $this->input->post('nombre_nucleo_instituto');
        $data['siglas_nucleo_instituto']    = $this->input->post('siglas_nucleo_instituto');
        $data['direccion_nucleo_instituto'] = $this->input->post('direccion_nucleo_instituto');
        $data['telefono01_nucleo_instituto']= $this->input->post('telefono01_nucleo_instituto');
        $data['telefono02_nucleo_instituto']= $this->input->post('telefono02_nucleo_instituto');
        $data['telefono03_nucleo_instituto']= $this->input->post('telefono03_nucleo_instituto');
        $data['telefono04_nucleo_instituto']= $this->input->post('telefono04_nucleo_instituto');
        $data['fax01_nucleo_instituto']     = $this->input->post('fax01_nucleo_instituto');
        $data['fax02_nucleo_instituto']     = $this->input->post('fax02_nucleo_instituto');
        $data['email01_nucleo_instituto']   = $this->input->post('email01_nucleo_instituto');
        $data['email02_nucleo_instituto']   = $this->input->post('email02_nucleo_instituto');
        $data['contacto_01']                = $this->input->post('contacto_01');
        $data['telefono_contacto_01']       = $this->input->post('telefono_contacto_01');
        $data['contacto_02']                = $this->input->post('contacto_02');
        $data['telefono_contacto_02']       = $this->input->post('telefono_contacto_02');
        

        //echo 'Valor id: '.$data['institutoId'];
        //Armado de las opciones del menu segun el usuario
        $centinela = new Centinela();
        $menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
        $data['menu']               = $this->load->view('vis_menu',$menu_final,true);
		if ($this->form_validation->run() == FALSE)
		{
            $q_institutos                       = $this->db->query('Select instituto_id,nombre_instituto from vis_instituto order by nombre_instituto');
            $a_institutos                       = $q_institutos->result_array();
            foreach($a_institutos as $campos){
              $ddl_institutos[$campos['instituto_id']] = $campos['nombre_instituto'];
            }
            $data['instituto_lista']            = $ddl_institutos;
            $q_parroquias                       = $this->db->query('Select parroquia_id,nombre_parroquia from vis_parroquia order by nombre_parroquia');
            $a_parroquias                       = $q_parroquias->result_array();
            foreach($a_parroquias as $campos){
              $ddl_parroquias[$campos['parroquia_id']] = $campos['nombre_parroquia'];
            }
            $data['parroquia_lista']            = $ddl_parroquias;
			$this->load->view('mantenimiento/nucleoForm',$data);
		}
		else
		{
			  if($data['nucleo_instituto_id'] == -1)
			  {
				$dataMsg['result'] = $this->nucleoModel->insertNucleo($data);
				$this->jelgeneral->mensaje($this,'Registro Almacenado Exitosamente','nucleo','black');
			  }
			  else
			  {
				$dataMsg['result'] = $this->nucleoModel->updateNucleo($data);
			    $this->jelgeneral->mensaje($this,'Registro Modificado Exitosamente','nucleo','black');
			  }
    	}
  }

  function nucleoDelete()
  {
    $id =$this->uri->segment(3);
    $data['result'] = $this->nucleoModel->deleteNucleo($id);
    $this->jelgeneral->mensaje($this,'Registro Eliminado Exitosamente','nucleo','black');
  }

}
?>
