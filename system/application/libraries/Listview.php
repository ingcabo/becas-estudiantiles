<?php
 if (!defined('BASEPATH')) exit('No permitir el acceso directo al script');

/**
* @property CI_Loader $load
* @property CI_Form_validation $form_validation
* @property CI_Input $input
* @property CI_Email $email
* @property CI_DB_active_record $db
* @property CI_DB_forge $dbforge
*/


class Listview
{
    var $titulo, $encabezado, $campos_lv, $TotalRegistros, $Tit_Tabla, $col_anc;
    var $t_nombre,$t_prefijo, $registros_paginas, $esquema, $vismenu, $clase_crud;
    var $anchos = array();
    var $filtrado = array();


    function Listview($parametros) {
      $this->t_nombre           = $parametros['tabla_nombre'];
      $this->t_prefijo          = $parametros['tabla_prefijo'];
      $this->registros_paginas  = $parametros['paginacion'];
      $this->esquema            = isset($parametros['esquema']) ? $parametros['esquema'] : '';
      $this->clase_crud         = isset($parametros['clase_crud']) ? $parametros['clase_crud'] : 'con_frmclass';
      $this->anchos             = isset($parametros['anchos'])?$parametros['anchos']:'';
    }

    

    function inicializar($registro_offset=0){

      $CI =& get_instance();
      $CI->load->model('Mfrmclass','',TRUE);
      $CI->load->helper(array('url','form'));
      $CI->load->library(array('Mylib_base','pagination','xajax'));

      //Valido quien llama al listview para limpiar los filtros activos
      if(isset($_SERVER['HTTP_REFERER'])){
        if($CI->centinela->getReferencia() <> $CI->Mfrmclass->uri_segmento($_SERVER['HTTP_REFERER'],4)){
          $CI->centinela->putReferencia($CI->Mfrmclass->uri_segmento($_SERVER['HTTP_REFERER'],4));
          $CI->centinela->putcampo1('');
          $CI->centinela->putcampo2('');
          $CI->centinela->putcampo3('');
        }
      }

      //Si no hay filtro en el post lo elimino
      if(isset($_POST['CampoFiltro'])){
          if(trim($_POST['CampoFiltro']) == ''){
            $CI->centinela->putcampo1('');
            $CI->centinela->putcampo2('');
            $CI->centinela->putcampo3('');
          }elseif($_POST['CampoFiltro'] !=  $CI->centinela->getcampo3()){
            $CI->centinela->putcampo3($_POST['CampoFiltro']);
          }elseif($_POST['dl_campos'] !=  $CI->centinela->getcampo1()){
            $CI->centinela->putcampo1($_POST['dl_campos']);
          }elseif($_POST['SelectOperador'] !=  $CI->centinela->getcampo2()){
            $CI->centinela->putcampo2($_POST['SelectOperador']);
          }
      }

      $pag_config['per_page'] = $this->registros_paginas;
      $CI->Mfrmclass->prefijo_tabla   = $this->t_prefijo;
      $CI->Mfrmclass->nombre_tabla    = $this->t_nombre;
      $CI->titulo                     = utf8_encode('Vista de '.$CI->Mfrmclass->CrearTitulo($CI->Mfrmclass->prefijo_tabla.$CI->Mfrmclass->nombre_tabla));
      $CI->encabezado                 = utf8_encode('Listado de '.$CI->Mfrmclass->CrearTitulo($CI->Mfrmclass->prefijo_tabla.$CI->Mfrmclass->nombre_tabla));
      $CI->clasecrud                  = $this->clase_crud;
      
       //Evaluo los campos a filtrar, si existe o no, para almacenarlo en la session
       if($CI->centinela->getcampo1() <> ''){
          $buscar_campo = $CI->centinela->getcampo1();
       }else {
          $buscar_campo = $CI->input->post('dl_campos',TRUE);
          $CI->centinela->putcampo1($buscar_campo);
       }
       if($CI->centinela->getcampo2() <> ''){
          $buscar_operador = $CI->centinela->getcampo2();
       }else {
          $buscar_operador = $CI->input->post('SelectOperador',TRUE);
          $CI->centinela->putcampo2($buscar_operador);
       }
       if($CI->centinela->getcampo3() <> '' ){
          $buscar_filtro = $CI->centinela->getcampo3();
       }else {
          $buscar_filtro = $CI->input->post('CampoFiltro',TRUE);
          $CI->centinela->putcampo3($buscar_filtro);
       }
     
      //Si extsten todos los campos necesarios para realizar el filtrado se ejecuta de lo contrario se toman todos los registros
      if($buscar_campo <> '0' and $buscar_filtro <> '' and $buscar_operador <> '0'){
          if($registro_offset == 0){
            $resultado_busqueda = $CI->Mfrmclass->ObtRegistrosFiltrados($buscar_campo,$buscar_filtro,$buscar_operador,$pag_config['per_page'],'',$this->esquema);
          }else{
            $resultado_busqueda = $CI->Mfrmclass->ObtRegistrosFiltrados($buscar_campo,$buscar_filtro,$buscar_operador,$pag_config['per_page'],$registro_offset,$this->esquema);
          }
          $CI->campos_lv = ($resultado_busqueda <> NULL) ? $resultado_busqueda->result_array() : NULL;
          $CI->filtrado = array('dl_campos'=>$buscar_campo,'SelectOperador'=>$buscar_operador,'CampoFiltro'=>$buscar_filtro);
          $q_registros = $CI->Mfrmclass->ObtRegistrosFiltrados($buscar_campo,$buscar_filtro,$buscar_operador,'','',$this->esquema);
          if($q_registros <> null)
            $CI->TotalRegistros       = $q_registros->num_rows();
          else
            $CI->TotalRegistros       = 0;
      }else {
          if($registro_offset == 0){
            $resultado_busqueda = $CI->Mfrmclass->ObtTodosRegistros($pag_config['per_page'],'',$this->esquema);
          }else{
            $resultado_busqueda = $CI->Mfrmclass->ObtTodosRegistros($pag_config['per_page'],$registro_offset,$this->esquema);
          }
          $CI->campos_lv = ($resultado_busqueda <> NULL) ? $resultado_busqueda->result_array() : NULL;
          $CI->TotalRegistros       = $CI->Mfrmclass->CantidadRegistros($this->esquema);
      }

      //Parametros para paginacion
      $pag_config['base_url']   = base_url().'index.php/'.$CI->uri->segment(1).'/index/';
      //$pag_config['base_url']   = $CI->uri->segment(1).'/index/';
      $pag_config['total_rows'] = $CI->TotalRegistros;
      $CI->pagination->initialize($pag_config);

      //Incorporo ajax al formulario de busqueda
      $CI->xajax->registerFunction(array('Tipo_condicion',&$CI,'Tipo_condicion'));
      $CI->xajax->processRequest();
      $template['xajax_js'] = $CI->xajax->getJavascript(base_url());
      $template['content']  = 'xajax_Tipo_condicion(this.value);';


      //Compobacion de existen datos que mostrar o no
      if ($CI->campos_lv != null){
        //Asigno los titulos de los campos
        $Tit_Tabla        = array_keys($CI->campos_lv[0]);
        $CI->Tit_Tabla    = $CI->Mfrmclass->sinpk($Tit_Tabla);
        //Asigno anchos de columnas
        $CI->col_anc      = $this->anchos;
        //Identifico el campo PK
        $CI->Mfrmclass->campo_clave = $CI->Mfrmclass->prefijo_tabla.$CI->Mfrmclass->nombre_tabla.'_pk';
        $CI->accion = base_url().'/index.php/'.$CI->uri->segment(1);
        //$CI->vismenu = $CI->load->view('vis_menu','',TRUE);
        $centinela = new centinela();
        $menu_final['opciones']   = $CI->mod_demenu->inicio($centinela->getId());
        $template['menu'] = $CI->load->view('vis_menu',$menu_final,true);
        
        $CI->load->view('vislib_registros',$template);
      }elseif($CI->TotalRegistros == 0 and $CI->Mfrmclass->CantidadRegistros($this->esquema) == 0){ //Caso no hay registros va a incluir el primero
        redirect( base_url().'index.php/'.$CI->clasecrud.'/index/'.MODO_INCLUIR.'/'.$CI->Mfrmclass->nombre_tabla);
      }else{
        $CI->centinela->putcampo1('');
        $CI->centinela->putcampo2('');
        $CI->centinela->putcampo3('');
        redirect(base_url().'/index.php/'.$CI->uri->segment(1));
      }
    }
} //Fin clase listview
?>