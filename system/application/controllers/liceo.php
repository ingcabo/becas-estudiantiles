<?php
/**
 * @property CI_Loader $load
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property CI_Email $email
 * @property CI_DB_active_record $db
 * @property CI_DB_forge $dbforge
 */



class liceo extends Controller
{

var $tbla;
    function liceo()
    {
        parent::Controller();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('liceoModel');
        $this->load->model('Mfrmclass','',TRUE);
        $this->load->library('JELGeneral');
    }

    function liceoControl()
    {

       $this->Mfrmclass->nombre_tabla = 'liceo';

       $this->load->library('pagination');
        //$this->load->library('JELGeneral');
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

        $config['base_url']    =   base_url().'/index.php/liceo/liceoControl/';
        $config['total_rows']  = $this->liceoModel->getNumTotalliceo($campo, $criterio, $valor);
        $config['per_page']    = 10;
        $config['uri_segment'] = 3;
        $config['first_link']  = 'Inicio';
        $config['last_link']   = 'Fin';

        $data['result']=$this->liceoModel->getAllliceo($campo, $criterio, $valor, $page, $config['per_page']);

        $this->pagination->initialize($config);
        $pages = $this->pagination->create_links();

        $data['pages']=$this->jelgeneral->getFilterPages($pages,$campo,$criterio,$valor);
        //$data['pages']='sdfasdfa'.$pages.$campo.$criterio.$valor;

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

        $this->load->view('mantenimiento/liceoList', $data);
    }

    function liceoForm()
    {
        $this->Mfrmclass->nombre_tabla = 'liceo';
        $id =$this->uri->segment(3);
        $data['id']          = $id;
        $data['nombreliceo'] = '';
        $data['telefono']    = '';
        $data['direccion']   = '';
        $data['activo']      = 1;
        //Carga del menú principal de la aplicación
        $data['menu']=$this->load->view('menu', $data,true);

        if($id!=-1)
        {
            $reg=$this->liceoModel->getliceo($id,$this->Mfrmclass->nombre_tabla);
            $data['nombreliceo'] = $reg->nombre_liceo;
            $data['telefono']    = $reg->telefono_direccion;
            $data['direccion']   = $reg->direccion_liceo;
            $data['activo']      = $reg->activo;
        }
        $this->load->view('mantenimiento/liceoForm', $data);
    }

    function liceoRecord()
    {
        $this->Mfrmclass->nombre_tabla = 'liceo';
        $this->load->library('form_validation');
        $this->form_validation->set_rules('txtliceo', 'Nombre Liceo', 'required');
        $this->form_validation->set_rules('txtdir', 'Dirección', 'required');
        $this->form_validation->set_rules('txttelefono', 'Telèfono', 'required');


        $data['id'] = $_POST['txtId'];
        $data['nombreliceo'] = $_POST['txtliceo'];
        $data['usuario']     = '1';
        $data['activo']      = $_POST['txtActivo'];
        $data['telefono']    = $_POST['txttelefono'];
        $data['direccion']   = $_POST['txtdir'];



        //Carga del menú principal de la aplicación
        $data['menu']=$this->load->view('menu', $data,true);
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('mantenimiento/liceoForm',$data);
        }
        else
        {
            if($data['id'] == -1)
            {
                $dataMsg['result'] = $this->liceoModel->insert_liceo($this->Mfrmclass->nombre_tabla);
               //$data['nombretipobeca'],$data['usuario'] ,$data['activo'], $this->tipo_becaModel->nombre_tabla
               $this->jelgeneral->mensaje($this,'Registro Almacenado Exitosamente','liceo/liceoControl','black');
            }
            else
            {
                $dataMsg['result'] = $this->liceoModel->update_liceo($data['id'],$this->Mfrmclass->nombre_tabla);
                $this->jelgeneral->mensaje($this,'Registro Modificado Exitosamente','liceo/liceoControl','black');
            }
        }
    }

    function liceoDelete()
    {
        $this->Mfrmclass->nombre_tabla = 'liceo';
        $id =$this->uri->segment(3);
        $data['result'] = $this->liceoModel->deleteliceo($id,$this->Mfrmclass->nombre_tabla);
        $this->jelgeneral->mensaje($this,'Registro Eliminado Exitosamente','liceo/liceoControl','black');
    }

}
?>
