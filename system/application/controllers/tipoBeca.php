<?php
/**
 * @property CI_Loader $load
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property CI_Email $email
 * @property CI_DB_active_record $db
 * @property CI_DB_forge $dbforge
 */



class tipobeca extends Controller
{

var $tbla;
    function tipobeca()
    {
        parent::Controller();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('tipo_becaModel');
        $this->load->model('Mfrmclass','',TRUE);

        $this->load->library('JELGeneral');
    }

    function tipobecaControl()
    {

       $this->Mfrmclass->nombre_tabla = 'tipo_beca';
    
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

        $config['base_url']    =   base_url().'/index.php/tipobeca/tipobecaControl/';
        $config['total_rows']  = $this->tipo_becaModel->getNumTotaltipo_beca($campo, $criterio, $valor);
        $config['per_page']    = 10;
        $config['uri_segment'] = 3;
        $config['first_link']  = 'Inicio';
        $config['last_link']   = 'Fin';

        $data['result']=$this->tipo_becaModel->getAlltipo_beca($campo, $criterio, $valor, $page, $config['per_page']);

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

        $this->load->view('mantenimiento/tipoBecaList', $data);
    }

    function tipoBecaForm()
    {
        $this->Mfrmclass->nombre_tabla = 'tipo_beca';
        $id =$this->uri->segment(3);
        $data['id'] = $id;
        $data['nombretipobeca'] = '';
        //$data['nacionalidadPais'] = '';
        $data['activo'] = 1;
        //Armado de las opciones del menu segun el usuario
        $centinela = new Centinela();
        $menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
        $data['menu']               = $this->load->view('vis_menu',$menu_final,true);

        if($id!=-1)
        {
            $reg=$this->tipo_becaModel->gettipo_beca($id,$this->Mfrmclass->nombre_tabla);
            $data['nombretipobeca'] = $reg->nombre_tipo_beca;
          //$data['nacionalidadPais'] = $reg->nacionalidad_pais;
            $data['activo'] = $reg->activo;
        }
        $this->load->view('mantenimiento/tipoBecaForm', $data);
    }

    function tipoBecaRecord()
    {
        $this->Mfrmclass->nombre_tabla = 'tipo_beca';
        $this->load->library('form_validation');
        $this->form_validation->set_rules('txttipobeca', 'Nombre Tipo Beca', 'required');
   

        $data['id'] = $_POST['txtId'];
        $data['nombretipobeca'] = $_POST['txttipobeca'];
        $data['usuario'] = '1';
        $data['activo']  = $_POST['txtActivo'];
        

        //Armado de las opciones del menu segun el usuario
        $centinela = new Centinela();
        $menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
        $data['menu']               = $this->load->view('vis_menu',$menu_final,true);
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('mantenimiento/tipoBecaForm',$data);
        }
        else
        {
            if($data['id'] == -1)
            {
                $dataMsg['result'] = $this->tipo_becaModel->insert_tipoBeca($this->Mfrmclass->nombre_tabla);
               //$data['nombretipobeca'],$data['usuario'] ,$data['activo'], $this->tipo_becaModel->nombre_tabla
               $this->jelgeneral->mensaje($this,'Registro Almacenado Exitosamente','tipobeca/tipobecaControl','black');
            }
            else
            {
                $dataMsg['result'] = $this->tipo_becaModel->updatetipo_beca($data['id'],$this->Mfrmclass->nombre_tabla);
                $this->jelgeneral->mensaje($this,'Registro Modificado Exitosamente','tipobeca/tipobecaControl','black');
            }
        }
    }

    function tipoBecaDelete()
    {
        $this->Mfrmclass->nombre_tabla = 'tipo_beca';
        $id =$this->uri->segment(3);
        $data['result'] = $this->tipo_becaModel->deletetipo_beca($id,$this->Mfrmclass->nombre_tabla);
        $this->jelgeneral->mensaje($this,'Registro Eliminado Exitosamente','tipobeca/tipobecaControl/','black');
    }

}
?>
