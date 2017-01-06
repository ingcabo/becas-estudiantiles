<?php


class requisito extends controller{

 function requisito()
    {
        parent::Controller();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('Model_consulta');
        $this->load->model('Mfrmclass','',TRUE);
        $this->load->model('requisitoModel');

        $this->load->library('JELGeneral');
        $this->requisitoModel->nombre_tabla = 'requisito';
    }


 function requisitoControl()
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

        $config['base_url']    =   base_url().'/index.php/requisito/requisitoControl/';
        $config['total_rows']  = $this->requisitoModel->getNumTotal($campo, $criterio, $valor);
        $config['per_page']    = 10;
        $config['uri_segment'] = 3;
        $config['first_link']  = 'Inicio';
        $config['last_link']   = 'Fin';

        $data['result']=$this->requisitoModel->getAll($campo, $criterio, $valor, $page, $config['per_page']);

        $this->pagination->initialize($config);
        $pages = $this->pagination->create_links();

        $data['pages']=$this->jelgeneral->getFilterPages($pages,$campo,$criterio,$valor);



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

        $this->load->view('mantenimiento/requisitoList', $data);
    }


 function requisitoForm()
    {

        $id =$this->uri->segment(3);
        $data['id']                = $id;
        $data['nombrerequisito']   = '';
        $data['activo']            = 1;
        $data['acciones']          = $this->Model_consulta->consulta_un_parametro('nombre_accion','asc','vis_accion','1','activo');
        $data['accionId']          = '0';
        $data['obligatorio']       = '0';
      
        //Armado de las opciones del menu segun el usuario
        $centinela = new Centinela();
        $menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
        $data['menu']               = $this->load->view('vis_menu',$menu_final,true);

        if($id!=-1)
        {
            $reg=$this->requisitoModel->get($id,$this->requisitoModel->nombre_tabla);
            $data['nombrerequisito']  = $reg->nombre_requisito;
            $data['activo']           = $reg->activo;
            $data['accionId']         = $reg->accion_id;
           
           if($reg->obligatorio_requisito== '1'){
               
               $data['obligatorio']   = '1';
           }else{
               
               $data['obligatorio']   = '0';
           }

           



        }
        $this->load->view('mantenimiento/requisitoForm', $data);
    }


function requisitoRecord()
    {

       $this->load->library('form_validation');

       $this->form_validation->set_rules('txtrequisito', 'Nombre Requisito', 'required');
       $this->form_validation->set_rules('cmbaccion', 'Acción', 'required');
       $this->form_validation->set_rules('obligatorio', 'obligatorio', '');





        $data['id']             = $_POST['txtId'];
        $data['nombrerequisito']   = $_POST['txtrequisito']; 
        $data['acciones']          = $this->Model_consulta->consulta_un_parametro('nombre_accion','asc','vis_accion','1','activo');
        $data['accionId']          = $_POST['cmbaccion'];

       if(isset($_POST['obligatorio']) and $_POST['obligatorio']== '1' ){
       $data['obligatorio']= '1';
       }else{$data['obligatorio']= '';}
       
        $data['usuario']        = '1';
        $data['activo']         = $_POST['txtActivo'];


        //Armado de las opciones del menu segun el usuario
        $centinela = new Centinela();
        $menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
        $data['menu']               = $this->load->view('vis_menu',$menu_final,true);
        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('mantenimiento/requisitoForm',$data);
        }
        else
        {
            if($data['id'] == -1)
            {
                $dataMsg['result'] = $this->requisitoModel->insert_requisito();
               //$data['nombretipobeca'],$data['usuario'] ,$data['activo'], $this->tipo_becaModel->nombre_tabla
               $this->jelgeneral->mensaje($this,'Registro Almacenado Exitosamente','requisito/requisitoControl','black');
            }
            else
            {
                $dataMsg['result'] = $this->requisitoModel->upd_requisito($data['id']);
                $this->jelgeneral->mensaje($this,'Registro Modificado Exitosamente','requisito/requisitoControl','black');
            }
        }
    }

function del_requisito(){

                $id =$this->uri->segment(3);
                $dataMsg['result'] = $this->requisitoModel->del_requisito($id);
                $this->jelgeneral->mensaje($this,'Registro Modificado Exitosamente','requisito/requisitoControl','black');

    
}




    
}


?>
