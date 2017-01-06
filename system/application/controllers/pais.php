<?php
/**
 * @property CI_Loader $load
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property CI_Email $email
 * @property CI_DB_active_record $db
 * @property CI_DB_forge $dbforge
 */



class pais extends Controller
{

    function pais()
    {
        parent::Controller();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('paisModel');
        $this->load->library('JELGeneral');
        $this->load->model('Mfrmclass');
        $this->load->model('Model_consulta');


    }

    function paisControl()
    {
       $this->Mfrmclass->nombre_tabla = 'pais';
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

        $config['base_url'] =   base_url().'/index.php/pais/paisControl/';
        $config['total_rows'] = $this->paisModel->getNumTotalPais($campo, $criterio, $valor);
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $config['first_link'] = 'Inicio';
        $config['last_link'] = 'Fin';

        $data['result']=$this->paisModel->getAllPais($campo, $criterio, $valor, $page, $config['per_page']);

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

        $this->load->view('mantenimiento/paisList', $data);
    }

    function paisForm()
    {
        $id =$this->uri->segment(3);
        $data['id'] = $id;
        $data['nombrePais'] = '';
        $data['nacionalidadPais'] = '';
        $data['activo'] = 1;
        //Armado de las opciones del menu segun el usuario
        $centinela = new Centinela();
        $menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
        $data['menu']               = $this->load->view('vis_menu',$menu_final,true);

        if($id!=-1)
        {
            $reg=$this->paisModel->getPais($id);
            $data['nombrePais'] = $reg->nombre_pais;
            $data['nacionalidadPais'] = $reg->nacionalidad_pais;
            $data['activo'] = $reg->activo;
        }
        $this->load->view('mantenimiento/paisForm', $data);
    }

    function paisRecord()
    {

        $this->Mfrmclass->nombre_tabla = 'pais';
        $this->load->library('form_validation');
        $this->form_validation->set_rules('txtPais', 'Pa&iacute;s', 'required');
        $this->form_validation->set_rules('txtNacionalidad', 'Nacionalidad', 'required');

        $data['id'] = $_POST['txtId'];
        $data['nombrePais'] = $_POST['txtPais'];
        $data['nacionalidadPais'] = $_POST['txtNacionalidad'];
        $data['activo'] = $_POST['txtActivo'];
        //Armado de las opciones del menu segun el usuario
        $centinela = new Centinela();
        $menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
        $data['menu']               = $this->load->view('vis_menu',$menu_final,true);
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('mantenimiento/paisForm',$data);
        }
        else
        {
            if($data['id'] == -1)
            {
                $dataMsg['result'] = $this->paisModel->insertPais($data['nombrePais'], $data['nacionalidadPais'], $data['activo']);
                $this->jelgeneral->mensaje($this,'Registro Almacenado Exitosamente','pais/paisControl','black');
            }
            else
            {
                $dataMsg['result'] = $this->paisModel->updatePais($data['id'], $data['nombrePais'], $data['nacionalidadPais'], $data['activo']);
                $this->jelgeneral->mensaje($this,'Registro Modificado Exitosamente','pais/paisControl','black');
            }
        }
    }

    function paisDelete()
    {
        $id =$this->uri->segment(3);
        $data['result'] = $this->paisModel->deletePais($id);
        $this->jelgeneral->mensaje($this,'Registro Eliminado Exitosamente','pais/paisControl','black');
    }

}
?>
