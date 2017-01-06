<?php
class materiacarrerainstituto extends Controller
{

	function materiacarrerainstituto(){
		parent::Controller();
        $this->load->helper(array('form','date','url'));
        $this->load->model('Mfrmclass','',TRUE);
        $this->load->model('Model_consulta');
        $this->load->library('xajax');
        $this->load->library(array('JELGeneral','form_validation','pagination'));
        $this->load->model('mod_materiacarrerainstituto');
      //$this->load->model('Model_consulta');
        
        $this->xajax->registerFunction(array('carrera_x', &$this, 'carrera_x'));
        $this->xajax->processRequest();
        $this->javaScriptText = $this->xajax->getJavascript(base_url());
         
	}


    function carrera_x($id){
     
    $respuesta             = new xajaxResponse();
    $propiedadInputDestino = "innerHTML";
    $inputDestino          = "div_carrera";


    $q_carrera       = $this -> mod_materiacarrerainstituto->carrera_instituto($id);

    $valorAAsignar  ='<select name="cmbcarrera" id="cmbcarrera">';

    $valorAAsignar .='<option value="">Seleccione</option>';
     foreach($q_carrera->result() as $row)
        {

        $valorAAsignar.='<option value="'.$row->carrera_id.'">'.$row->nombre_carrera.'</option>';


        }
    
   
    $valorAAsignar .='</seelct>';

    $respuesta->Assign($inputDestino, $propiedadInputDestino, $valorAAsignar);

    return $respuesta;
        
    }


  function index() {
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
    $config['base_url']     = base_url().'/index.php/materiacarrerainstituto/index';
    $config['total_rows']   = $this->mod_materiacarrerainstituto->getNumTotalcarrerainstituto($campo, $criterio, $valor);
    $config['per_page']     = 10;
    $config['uri_segment']  = 3;
    $config['first_link']   = 'Inicio';
    $config['last_link']    = 'Fin';
    $this->pagination->initialize($config);
    $pages                  = $this->pagination->create_links();




      //Permisologia
    $data['permisos']['i'] = $this->mod_usuario->evalua_permiso('i','',$this->uri->segment(1));
    $data['permisos']['m'] = $this->mod_usuario->evalua_permiso('m','',$this->uri->segment(1));
    $data['permisos']['b'] = $this->mod_usuario->evalua_permiso('b','',$this->uri->segment(1));
   //fin permisologia a copiar




    //Consulta para obtener todos los registros
    $data['result']     = $this->mod_materiacarrerainstituto->getAllCarrerainstituto($campo, $criterio, $valor, $page, $config['per_page']);
    //Consulta filtrada de registros
    $data['pages']      = $this->jelgeneral->getFilterPages($pages,$campo,$criterio,$valor);
    //Carga del menú principal de la aplicación

   $centinela = new Centinela();
   $menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
   $data['menu']               = $this->load->view('vis_menu',$menu_final,true);
    //$data['menu']       = $this->load->view('menu', $data,true);
    //Repopulo campos de busqueda
    $data['campo']      = $campo;
    $data['criterio']   = $criterio;
    $data['valor']      = $valor;
    $this->form_validation->set_error_delimiters('<div class="celdaError">', '</div>');
    echo validation_errors('<div class="celdaError">', '</div>');
    //Carga de vista de listado de registros
    $this->load->view('mantenimiento/carrerainstitutoList', $data);

  } //Fin index



function  carrerainstitutoform(){
        $data['js'] = $this->javaScriptText;
        $id                                 = $this->uri->segment(3);

        //
        $data['q_carrera']       = $this -> Model_consulta -> consulta_combo('nombre_carrera','asc','carrera');
        $data['q_instituto']     = $this -> Model_consulta -> consulta_combo('nombre_instituto','asc','instituto');
        $data['q_modalidad']     = $this -> Model_consulta -> consulta_combo('nombre_modalidad','asc','modalidad');
        $data['q_tipo_periodo']  = $this -> Model_consulta -> consulta_combo('nombre_tipo_periodo','asc','tipo_periodo');
        $data['carrera_instituto_id']       ='-1';
        $data['carrera_id']                 ='';
        $data['instituto_id']               ='';
        $data['tipo_periodo_id']            ='';
        $data['modalidad_id']               ='';

    $centinela = new Centinela();
   $menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
   $data['menu']               = $this->load->view('vis_menu',$menu_final,true);
    
      //Carga del menú principal de la aplicación
     //$data['menu']=$this->load->view('menu', $data,true);
    // $data['menu']               = $this->load->view('vis_menu',$menu_final,true);
    if($id!=-1){
      
      //$data['q_carrera']       = $this -> mod_materiacarrerainstituto->carrera_instituto($id);

      $reg                               = $this->mod_materiacarrerainstituto->getcarrerainstituto($id);
      $data['carrera_instituto_id']      = $id;

      $data['carrera_id']                = $reg->carrera_id;
      $data['instituto_id']              = $reg->instituto_id;
      $data['tipo_periodo_id']           = $reg->tipo_periodo_id;
      $data['modalidad_id']              = $reg->modalidad_id;

    }
    
    $this->load->view('mantenimiento/carrerainstitutoForm', $data);

    
}

 function carrerainstitutoRecord()
  {

		$this->form_validation->set_rules('cmbcarrera', 'Carrera', 'required');
		$this->form_validation->set_rules('cmbinstituto', 'Instituto', 'required');
        $this->form_validation->set_rules('cmbtipperiodo', 'Tipo Periodo', 'required');
		$this->form_validation->set_rules('cmbModalidad', 'Modalidad', 'required');
        $data['js'] = $this->javaScriptText;
        $data['q_carrera']       = $this -> Model_consulta -> consulta_combo('nombre_carrera','asc','carrera');
        $data['q_instituto']     = $this -> Model_consulta -> consulta_combo('nombre_instituto','asc','instituto');
        $data['q_modalidad']     = $this -> Model_consulta -> consulta_combo('nombre_modalidad','asc','modalidad');
        $data['q_tipo_periodo']  = $this -> Model_consulta -> consulta_combo('nombre_tipo_periodo','asc','tipo_periodo');


        $data['carrera_instituto_id']        =  $_POST['carrera_instituto_id'];

        //Se reciben los datos del formulario a guardar
        $data['carrera_id']                  = $this->input->post('cmbcarrera');
        $data['instituto_id']                = $this->input->post('cmbinstituto');
        $data['tipo_periodo_id']             = $this->input->post('cmbtipperiodo');
        $data['modalidad_id']                = $this->input->post('cmbModalidad');


        
        $centinela = new Centinela();
        $menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
        $data['menu']               = $this->load->view('vis_menu',$menu_final,true);


        if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('mantenimiento/carrerainstitutoform',$data);
		}
		else
		{
			  if($data['carrera_instituto_id'] == -1)
			  {
				$dataMsg['result'] = $this->mod_materiacarrerainstituto->ins_carrera_instituto($data);
				$this->jelgeneral->mensaje($this,'Registro Almacenado Exitosamente','materiacarrerainstituto','black');
			  }
			  else
			  {
				$dataMsg['result'] = $this->mod_materiacarrerainstituto->upd_carrera_instituto($data);
			    $this->jelgeneral->mensaje($this,'Registro Modificado Exitosamente','materiacarrerainstituto','black');
			  }
    	}
  }


 function carrerainstitutoDelete()
  {
    $id =$this->uri->segment(3);
    $data['result'] = $this->mod_materiacarrerainstituto->del_tecarrerainstituto($id);
    $this->jelgeneral->mensaje($this,'Registro Eliminado Exitosamente','materiacarrerainstituto','black');
  }



function materia_carrera_list(){

//***




$id   = is_numeric($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
$page = is_numeric($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

$data['id']   =$id;

//echo $data['id'];

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
    $config['base_url']     = base_url().'/index.php/materiacarrerainstituto/materia_carrera_list/'.$id.'/';
    $config['total_rows']   = $this->mod_materiacarrerainstituto->getNumTotalmateriascarrera($campo, $criterio, $valor,$id);
    $config['per_page']     = 10;
    $config['uri_segment']  = 4;
    $config['first_link']   = 'Inicio';
    $config['last_link']    = 'Fin';
    $this->pagination->initialize($config);
    $pages                  = $this->pagination->create_links();


    //Permisologia
    $data['permisos']['i'] = $this->mod_usuario->evalua_permiso('i','',$this->uri->segment(1));
    $data['permisos']['m'] = $this->mod_usuario->evalua_permiso('m','',$this->uri->segment(1));
    $data['permisos']['b'] = $this->mod_usuario->evalua_permiso('b','',$this->uri->segment(1));
   //fin permisologia a copiar




    //Consulta para obtener todos los registros
    $data['result']     = $this->mod_materiacarrerainstituto->getAllmateriascarrera($campo, $criterio, $valor, $page, $config['per_page'],$id);
    //Consulta filtrada de registros
    $data['pages']      = $this->jelgeneral->getFilterPages($pages,$campo,$criterio,$valor);
    //Carga del menú principal de la aplicación
   $centinela = new Centinela();
   $menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
   $data['menu']               = $this->load->view('vis_menu',$menu_final,true);
    //Repopulo campos de busqueda
    $data['campo']      = $campo;
    $data['criterio']   = $criterio;
    $data['valor']      = $valor;
    $this->form_validation->set_error_delimiters('<div class="celdaError">', '</div>');
    echo validation_errors('<div class="celdaError">', '</div>');
    //Carga de vista de listado de registros


     $q_carr    = $this -> Model_consulta -> consulta_un_parametro('nombre_carrera','asc','vis_carrera_instituto',$this->uri->segment(3),'carrera_instituto_id');
     $fila_carr = $q_carr->row_array();
    $data['carrera'] = $fila_carr['nombre_carrera'];
    $this->load->view('mantenimiento/materiacarrerainstitutoList', $data);
   //Fin index



//******
    
}

//
function  materiacarrerainstitutoform(){
        $data['js'] = $this->javaScriptText;
        $pk                                 = $this->uri->segment(3);
        $id                                 = $this->uri->segment(4);



    $data['pk'] =$pk; //carrera_instituto_id
    $data['materia_carrera_id'] =$id; //materia_carrera_id

    $q_carr     = $this -> Model_consulta -> consulta_un_parametro('nombre_carrera','asc','vis_carrera_instituto',$data['pk'],'carrera_instituto_id');
    $fila_carr = $q_carr->row_array();
    $data['carrera'] = $fila_carr['nombre_carrera'];


       $q_id     = $this -> Model_consulta -> consulta_combo('carrera_id','asc','vis_carrera_instituto',$pk,'carrera_instituto_id');
      $fila_id = $q_id->row_array();
//consulta_un_parametro($campo,$order,$tabla,$parametro,$campo_parametro)


       
        
        $data['q_materias']       = $this -> mod_materiacarrerainstituto -> materias($fila_id['instituto_id'],$fila_id['carrera_id']);
      
        
        $data['materia_id']                 ='';
        $data['carrera_instituto_id']       =$pk;
        $data['cantidad_unidad_credito']    ='';
        $data['numero_periodo']             ='';
        $data['codigo_materia']             ='';
        $data['materia_carrera_id']         ='-1';
     



     //Carga del menú principal de la aplicación
    $centinela = new Centinela();
   $menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
   $data['menu']               = $this->load->view('vis_menu',$menu_final,true);

    if($id!=-1){

      
  
      $reg                               = $this->mod_materiacarrerainstituto->getmateriacarrerainstituto($id);
      $mt_id= $reg->materia_id;
      $data['q_materias']                = $this -> mod_materiacarrerainstituto -> materias_2($fila_id['instituto_id'],$fila_id['carrera_id'],$mt_id);
      $data['materia_id']                = $mt_id;
      $data['carrera_instituto_id']      = $pk;
      $data['cantidad_unidad_credito']   = $reg->cantidad_unidad_credito;
      $data['numero_periodo']            = $reg->numero_periodo;
      $data['codigo_materia']            = $reg->codigo_materia;
      $data['materia_carrera_id']        = $reg->materia_carrera_id;
      

    }

    $this->load->view('mantenimiento/materiacarrerainstitutoForm', $data);


}

function  materiacarrerainstitutoRecord(){

        $data['js'] = $this->javaScriptText;
        $this->form_validation->set_rules('cmbmateria', 'Materia', 'required');
		$this->form_validation->set_rules('numero_periodo', 'periodo', 'required');
        $this->form_validation->set_rules('cantidad_unidad_credito', 'Unidad de Credito', 'required');
        $this->form_validation->set_rules('codigo_materia', 'Codigo Materia', 'required');



        $data['carrera']                       = $_POST['carrera'];
        $data['materia_carrera_id']            = $_POST['materia_carrera_id'];
        $data['carrera_instituto_id']          = $_POST['carrera_instituto_id'];
        $data['codigo_materia']                = $_POST['codigo_materia'];
        $data['materia_id']                    = $this->input->post('cmbmateria');
              $q_id     = $this -> Model_consulta -> consulta_un_parametro('carrera_id','asc','vis_carrera_instituto',$data['carrera_instituto_id'],'carrera_instituto_id');
              $fila_id = $q_id->row_array();


             if ($this->input->post('cmbmateria') ==''){

              $data['q_materias']     = $this -> mod_materiacarrerainstituto -> materias($fila_id['instituto_id'],$fila_id['carrera_id'],$data['materia_id']);
             }else{

              $data['q_materias']     = $this -> mod_materiacarrerainstituto -> materias_2($fila_id['instituto_id'],$fila_id['carrera_id'],$data['materia_id']);
             }

            
        $data['numero_periodo']                = $this->input->post('numero_periodo');
        $data['cantidad_unidad_credito']       = $this->input->post('cantidad_unidad_credito');


   $centinela = new Centinela();
   $menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
   $data['menu']               = $this->load->view('vis_menu',$menu_final,true);

if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('mantenimiento/materiacarrerainstitutoform',$data);
        }
		else
		{
			  if($data['materia_carrera_id'] == -1)
			  {
				$dataMsg['result'] = $this->mod_materiacarrerainstituto->ins_materiacarrerainstituto($data);
				$this->jelgeneral->mensaje($this,'Registro Almacenado Exitosamente','materiacarrerainstituto/materia_carrera_list/'.$data['carrera_instituto_id'],'black');
			  }
			  else
			  {
				$dataMsg['result'] = $this->mod_materiacarrerainstituto->upd_materiacarrerainstituto($data);
			    $this->jelgeneral->mensaje($this,'Registro Modificado Exitosamente','materiacarrerainstituto/materia_carrera_list/'.$data['carrera_instituto_id'],'black');
			  }
    	}




    
}




function delete_materiacarrerainstituto(){



    $id =$this->uri->segment(4);
    $pk =$this->uri->segment(3);
    $data['result'] = $this->mod_materiacarrerainstituto->del_materia_carrera($id);
    $this->jelgeneral->mensaje($this,'Registro Eliminado Exitosamente','materiacarrerainstituto/materia_carrera_list/'.$pk,'black');
}







}
?>
