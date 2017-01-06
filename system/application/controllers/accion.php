<?php
/**
 * @property CI_Loader $load
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property CI_Email $email
 * @property CI_DB_active_record $db
 * @property CI_DB_forge $dbforge
 */



class accion extends Controller
{


    function accion()
    {
        parent::Controller();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('Model_consulta');
        $this->load->model('Mfrmclass','',TRUE);
        $this->load->model('accionModel');

        $this->load->library('JELGeneral');
        $this->accionModel->nombre_tabla = 'accion';
    }

    function accionControl()
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

        $config['base_url']    =   base_url().'/index.php/accion/accionControl/';
        $config['total_rows']  = $this->accionModel->getNumTotal($campo, $criterio, $valor);
        $config['per_page']    = 10;
        $config['uri_segment'] = 3;
        $config['first_link']  = 'Inicio';
        $config['last_link']   = 'Fin';

        $data['result']=$this->accionModel->getAll($campo, $criterio, $valor, $page, $config['per_page']);

        $this->pagination->initialize($config);
        $pages = $this->pagination->create_links();

        $data['pages']=$this->jelgeneral->getFilterPages($pages,$campo,$criterio,$valor);
       

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

        $this->load->view('mantenimiento/accionList', $data);
    }

    function accionForm()
    {
        
        $id =$this->uri->segment(3);
        $data['id']             = $id;
        $data['nombreaccion']   = '';
        $data['activo']         = 1;
        $data['becas']          = $this->Model_consulta->consulta_un_parametro('nombre_beca','asc','vis_beca','1','activo');
        $data['becaId']         = '0';
        $data['estado_personas']= $this->Model_consulta->consulta_un_parametro('nombre_estado_persona','asc','estado_persona','1','activo');
        $data['est_personaId']  = '0';
        $data['menu']           = $this->load->view('menu', $data,true);

        if($id!=-1)
        {
            $reg=$this->Model_consulta->get($id,$this->accionModel->nombre_tabla);
            $data['nombreaccion']   = $reg->nombre_accion;
            $data['activo']         = $reg->activo;
            $data['becaId']         = $reg->beca_id;
            $data['est_personaId']  = $reg->estado_persona_id;


            
        }
        $this->load->view('mantenimiento/accionForm', $data);
    }

    function accionRecord()
    {
       
       $this->load->library('form_validation');
       
       $this->form_validation->set_rules('txtaccion', 'Nombre Acción', 'required');
       $this->form_validation->set_rules('cmb_estado_persona', 'Estado Persona', 'required');
       $this->form_validation->set_rules('cmbbeca', 'Beca', 'required');


        $data['id']             = $_POST['txtId'];
        $data['nombreaccion']   = $_POST['txtaccion'];
        $data['becas']          = $this->Model_consulta->consulta_un_parametro('nombre_beca','asc','vis_beca','1','activo');
        $data['estado_personas']= $this->Model_consulta->consulta_un_parametro('nombre_estado_persona','asc','estado_persona','1','activo');
        $data['est_personaId']  = $_POST['cmb_estado_persona'];
        $data['becaId']         = $_POST['cmbbeca'];
        $data['usuario']        = '1';
        $data['activo']         = $_POST['txtActivo'];


        //Carga del menú principal de la aplicación
        $data['menu']=$this->load->view('menu', $data,true);
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('mantenimiento/accionForm',$data);
        }
        else
        {
            if($data['id'] == -1)
            {
                $dataMsg['result'] = $this->accionModel->insert_accion();
               //$data['nombretipobeca'],$data['usuario'] ,$data['activo'], $this->tipo_becaModel->nombre_tabla
               $this->jelgeneral->mensaje($this,'Registro Almacenado Exitosamente','accion/accionControl','black');
            }
            else
            {
                $dataMsg['result'] = $this->accionModel->upd_accion($data['id'],$this->accionModel->nombre_tabla);
                $this->jelgeneral->mensaje($this,'Registro Modificado Exitosamente','accion/accionControl','black');
            }
        }
    }

    function accionDelete()
    {
        
        $id =$this->uri->segment(3);
        $data['result'] = $this->accionModel->delete_accion($id,$this->accionModel->nombre_tabla);
        $this->jelgeneral->mensaje($this,'Registro Eliminado Exitosamente','accion/accionControl/','black');
    }

}
?>
