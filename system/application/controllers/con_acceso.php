<?php
/**
 * Programador: Ricardo Camejo
 * Fecha inicio: 10/10/08
 * Fecha final: 11/04/09
 * Controlador de acceso al sistema
 * Gestion completa de usuarios, desde el CRUD, login, logout, validar paginas
 */
class Con_acceso extends Controller
{
    var $iusuario, $iclave, $vismenu, $vpk, $modo_actual, $campos;
    var $menuopciones, $opciones_menu;
    var $detalle_opciones;

    function Con_acceso()
    {
        parent::Controller();
        
        $this->load->library(array('form_validation','parser','mylib_base'));
        $this->load->helper(array('date','email','text','form','url'));
    }

    //Funcion para CRUD de usuarios, utilizo un modo especial para los usuarios, motivado por caracteristicas especiales de la forma
    //donde nos encontramos con repeticion de clave para verificar y busqueda del nombre de usuario para saber si existe o no
    function index($modo,$tabla,$valor_pk = '',$frm_padre=''){

        if(isset($valor_pk)) {$this->vpk = $valor_pk;} else {$this->vpk = '';}

        $centinela  = new Centinela(FALSE);
        $valores_nuevos = array();
		//aplicamos reglas
        
		$this->form_validation->set_rules('txt_email','Correo Electr&oacute;nico','trim|required|valid_email|callback__check_email');
        $this->form_validation->set_rules('txt_fecha','Fecha de expiraci&oacute;n','required');
        
        if($modo === MODO_INCLUIR){
              $this->form_validation->set_rules('txt_usuario','Usuario','trim|required|callback__check_user');
              $this->form_validation->set_rules('txt_password','Contrase&ntilde;a','trim|required|min_length[4]|max_length[15]|alpha_dash|xss_clean');
		      $this->form_validation->set_rules('txt_confirma','Confirmar','trim|required|min_length[4]|max_length[15]|alpha_dash|xss_clean|matches[txt_password]');
        }

        $this->modo_actual = $modo;
        if($modo === MODO_BORRAR){
            $this->mod_usuario->borrar($this->vpk);
            redirect(base_url().'index.php/'.$frm_padre);
            return;
        }
		if($this->form_validation->run() == FALSE){
            //Armado de las opciones del menu segun el usuario
            $menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());

            if($modo === MODO_MODIFICAR or $modo === MODO_GRABAR){
                $this->campos               = $this->mod_usuario->ObtRegistros('usr_usuarios_pk',$this->vpk,'sistema.usuarios');
                $data                       = array('envia' => 'con_acceso/index/'.MODO_GRABAR.'/sistema.usuarios/'.$this->vpk.'/con_listview_Usuarios','noeditar'=>'disabled');
                $this->opciones_menu        = $this->menu_opciones($this->vpk,MODO_MODIFICAR);
                //Carga de menu dinamico
                $data['menu']               = $this->load->view('vis_menu',$menu_final,true);
                //Carga de vista definitiva
                $this->load->view("vis_usuarios",$data);
            }
            if($modo === MODO_INCLUIR){
              $data                 = array('envia' => 'con_acceso/index/'.MODO_INCLUIR.'/sistema.usuarios/'.$this->vpk);
              $this->opciones_menu  = $this->menu_opciones($this->vpk,MODO_INCLUIR);
              $data['menu']         = $this->load->view('vis_menu',$menu_final,true);
              $this->load->view("vis_usuarios",$data);
            }
		}else{
            if($modo === MODO_INCLUIR){
              array_push($valores_nuevos,$this->input->post('txt_usuario'));
              array_push($valores_nuevos,sha1($this->input->post('txt_password')));
              array_push($valores_nuevos,$this->input->post('txt_email'));
              array_push($valores_nuevos,$this->mylib_base->human_to_pg($this->input->post('txt_fecha')));
              $npk  = $this->mod_usuario->nuevo($valores_nuevos);
              $this->menu_opciones($npk['max'],$modo);
            }
            if($modo === MODO_GRABAR){
              array_push($valores_nuevos,$this->input->post('txt_email'));
              array_push($valores_nuevos,$this->mylib_base->human_to_pg($this->input->post('txt_fecha')));
              array_push($valores_nuevos,$this->vpk);
              $this->mod_usuario->modificar($valores_nuevos);
              $this->menu_opciones($this->vpk,$modo);
            }
            if($modo === MODO_BORRAR){
              $this->mod_usuario->borrar($this->vpk);
            }
			redirect(base_url().'index.php/'.$frm_padre);
            return;
		}
    } //Fin index

    //fUNCION DE LOGIN DEL SISTEMA, ESTA DEBE SER EL PRIMER CONTROLADOR A LLAMAR AL INICIAR LA APLICACION
    function entrar()
      {
        $this->form_validation->set_rules('usuario', 'Usuario', 'trim|required|min_length[4]|max_length[15]|alpha_dash|xss_clean');
		$this->form_validation->set_rules('clave', 'Contraseña', 'trim|required|min_length[4]|max_length[15]|alpha_dash|xss_clean');
        //Seleccion de template
        $data = array(
            'title' => 'Sistema Control y Seguimiento de Beneficiarios Jesús Enrique Lossada',
            'titulo'  => 'Bienvenidos al Sistema Control y Seguimiento de Beneficiarios Jesús Enrique Lossada '
            );
    
        if ($this->form_validation->run() == FALSE )
         {
          $this->parser->parse('tem_acceso',$data);
         }
        else
         {
            $nick       = $_POST['usuario'];
			$password   = sha1($_POST['clave']);
			$recordar   = FALSE;
			$centinela  = new Centinela(FALSE);
			if($centinela->login($nick, $password, $recordar)){
                $this->mod_usuario->en_session();
                $menu_final['opciones']   = $this->mod_demenu->inicio($centinela->getId());
                $data['menu'] = $this->load->view('vis_menu',$menu_final,true);
                $data['contenido'] = ''; //por si hay que enviar algo al inicio de la página
		        $this->load->view('index',$data);
            }else{
                $error = array('claveerronea'=>'Nombre de usuario o contraseña inválida, verifique.');
                $final = array_merge($data,$error);
                $this->parser->parse('tem_acceso',$final);
            }
         }
      } //Fin entrar

      //Funcion para hacer logout del sistema
     function salir(){
        $centinela = new Centinela(FALSE);
		$centinela->logout();
		redirect("con_acceso/entrar");
     } //fin salir

     //Cambio de clave para usuario actual
     function cambio_password(){
        $this->form_validation->set_rules('txt_anterior', 'Contrseña actual', 'callback__check_pass');
		$this->form_validation->set_rules('txt_passnuevo', 'Nueva Contrseña', 'trim|required|min_length[4]|max_length[15]|alpha_dash|xss_clean');
        $this->form_validation->set_rules('txt_passconfirma', 'Confirmar Contrseña', 'trim|required|min_length[4]|max_length[15]|alpha_dash|xss_clean|matches[txt_passnuevo]');
        $this->vismenu = $this->load->view('vis_menu','',true);
        $centinela_id = new Centinela();
        $menu_final['opciones']   = $this->mod_demenu->inicio($centinela_id->getId());
        $data['menu'] = $this->load->view('vis_menu',$menu_final,true);
         if ($this->form_validation->run() == FALSE ){
           $this->load->view('vis_cambio_password',$data);
         }else{
            $pk           = $centinela_id->getId();
			$password     = sha1($_POST['txt_passnuevo']);
            $this->mod_usuario->cambio($pk,$password);
            $centinela  = new Centinela(FALSE);
            if($centinela->login($centinela_id->getNick(), $password,FALSE)){
				$this->load->view('index',$data);
            }else
                $this->salir();
         }
     } //Fin cambio_password

    //Callback comprobacion de nombre de usuario, existe
    function _check_pass($txt_anterior)
    {
        //comprobar que exista
        $centinela_cp = new Centinela();
        $this->db->where('usr_clave', sha1($txt_anterior));
        $this->db->where('usr_nombre', $centinela_cp->getNick());
        $q = $this->db->get('sistema.usuarios');

        //devuelve error
        if ($q->num_rows() == 1){
            return TRUE;
        }else{
            $this->form_validation->set_message('_check_pass', 'Contrase&ntilde;a anterior invalidad');
            return FALSE;
        }
    } //fin _check_pass

    //Callback comprobacion de usuario
    function _check_user($nick)
    {
        //comprobar que exista
        $this->db->where('usr_nombre', $nick);
        $q = $this->db->get('sistema.usuarios');

        //devuelve error
        if ($q->num_rows() == 1){
            $this->form_validation->set_message('_check_user', 'El usuario %nick esta elegido, elige otro.');
            return FALSE;
        }else{
            return TRUE;
        }
    } //Fin _check_user

    //Callback comprobacion de usuario
    function _check_email($correo)
    {
        //comprobar que exista
        if($this->modo_actual == MODO_GRABAR or $this->modo_actual == MODO_MODIFICAR){
            $this->db->where('usr_usuarios_pk !=', $this->vpk);
        }
        $this->db->where('usr_correo_electronico', $correo);
        $q = $this->db->get('sistema.usuarios');

        //devuelve error
        if ($q->num_rows() >= 1){
            $this->form_validation->set_message('_check_email', 'Correo electrónico asignado a otro usuario, utilice uno alternativo');
            return FALSE;
        }else{
            return TRUE;
        }
    } //Fin _check_email

    function recuperarclave(){

        $this->form_validation->set_rules('txt_email', 'Email', 'trim|required|valid_email');
        //Seleccion de template

        if ($this->form_validation->run() == FALSE )
         {
          $this->load->view('vis_olvidoclave');
         }
        else
         {
            $email       = $_POST['txt_email'];
            $query = $this->db->query("SELECT usr_usuarios_pk,usr_clave,usr_nombre FROM sistema.usuarios WHERE usr_correo_electronico = '$email'");
            if($query->num_rows() > 0){
              $campos = $query->row();
              $nueva_clave = substr($campos->usr_nombre,1,2).substr($campos->usr_clave,5,5);
              $mensaje_email = "Usted ha solicitado la Regeneración de su Contraseña.

Esta es su nueva Contraseña: ".$nueva_clave."

Se recomienda Personalizar esta contraseña a través de la opción Cambio de Contraseña ubicada del Menú Sistema del REGCO a fin de que pueda recordarla.";
              if(send_email($email, utf8_decode('REGCO: Recuperación de Contraseña'), utf8_decode($mensaje_email))){
                  $this->db->query("update sistema.usuarios set usr_clave ='".sha1($nueva_clave)."' WHERE usr_usuarios_pk = ".$campos->usr_usuarios_pk);
              }

			  redirect("con_acceso/entrar");
            }
         }
    }

    function menu_opciones($usuario_pk,$modo_act){
        //Cargo las opciones del menu disponibles
        if($modo_act === MODO_INCLUIR){
            $consulta = 'SELECT sistema.usuarios_menu.usm_usuarios_menu_pk,sistema.usuarios_menu.usm_titulos, sistema.usuarios_menu.usm_activo FROM sistema.usuarios_menu LEFT JOIN (
                                        SELECT usm_usuarios_menu_pk, usm_nivel, usm_titulos
                                        FROM sistema.usuarios_menu WHERE char_length(usm_nivel) = 2 ORDER BY usm_nivel) as c1
                                        ON c1.usm_nivel = substring(sistema.usuarios_menu.usm_nivel from 1 for 2) and sistema.usuarios_menu.usm_activo = FALSE
                                        ORDER BY sistema.usuarios_menu.usm_nivel';
        }else{
            $consulta = 'select um.usm_titulos,uo.usr_usuarios_fk,uo.uso_ver,uo.uso_incluir,uo.uso_modificar,uo.uso_borrar,uo.uso_campos_solo_lectura,uo.uso_campos_no_visibles,usm_usuarios_fk, 	   um.usm_nivel, um.usm_activo, um.usm_usuarios_menu_pk
                        from sistema.usuarios_menu as um left join sistema.usuarios_opciones as uo
                        on  um.usm_usuarios_menu_pk = uo.usm_usuarios_fk and usr_usuarios_fk = '.$usuario_pk.'
                        order by usm_nivel' ;
        } //Fin if
        $menu = $this->db->query($consulta);
        $this->menuopciones = $menu->result_array();
        $this->vpk = $usuario_pk;
        if(!isset($_POST['bto_procesar']) OR $modo_act == MODO_MODIFICAR){
            return $this->load->view('vis_usuarios_menu','',true);
        }else{
            //en esta seccion se borra toda la permisología y se vuelve a crear.
            $this->db->trans_start();
            $this->db->query("DELETE FROM sistema.usuarios_opciones WHERE usr_usuarios_fk = $usuario_pk");
            foreach($this->menuopciones as $fila){
               $consulta = "INSERT INTO sistema.usuarios_opciones(usr_usuarios_fk, usm_usuarios_fk, uso_ver,
                            uso_incluir, uso_modificar, uso_borrar) VALUES ($usuario_pk,";
               $parametros = '';
               if($fila['usm_activo'] == 't'){
                 $parametros = $fila['usm_usuarios_menu_pk'].",";         //Inserto el pk del menu
                 if( isset($_POST['chk_ver'][$fila['usm_usuarios_menu_pk']]))
                   $parametros .= 'true,';
                 else  $parametros .= 'false,';
                 if(isset($_POST['chk_inc'][$fila['usm_usuarios_menu_pk']]))
                   $parametros .= 'true,';
                 else  $parametros .= 'false,';
                 if(isset($_POST['chk_mod'][$fila['usm_usuarios_menu_pk']]))
                   $parametros .= 'true,';
                 else  $parametros .= 'false,';
                 if(isset($_POST['chk_bor'][$fila['usm_usuarios_menu_pk']]))
                   $parametros .= 'true)';
                 else  $parametros .= 'false)';

               }else{
                 $parametros = $fila['usm_usuarios_menu_pk'].',True,False,False,False)';
               }
               $consulta .=$parametros;
               $this->db->query($consulta);
            }
            $this->db->trans_complete();
        }
    } //Fin menu_opciones

    

} //Fin clase
?>
