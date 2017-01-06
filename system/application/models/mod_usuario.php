<?php
/**
 * Description of mod_usuario
 *
 * @author rcamejo
 *
 * Tips para implementacion de clase de permisologia:
 * Si se quiere tener restricciones a nivel 3 o sea a nivel de los campos en el formulario se deben hacer las siguientes ajustes:
 * 1.- Antes de cargar el formulario se debe armar la variable $permisos con tantos campos como sean necesarios
 *    Para Solo Lectura: sl
 *    $data['permisos']['sl']['nombre_beca'] = $this->mod_usuario->evalua_permiso('sl','nombre_beca',$this->uri->segment(1));
 *    Para No Visible: nv
 *    $data['permisos']['nv']['nombre_beca'] = $this->mod_usuario->evalua_permiso('nv','nombre_beca',$this->uri->segment(1));
 */
class Mod_usuario extends Model {

    function Mod_usuario(){
        parent::Model();
        $this->load->helper('date');
        $this->load->library('Mylib_base');
    }

    function en_session(){
      $centinela = new Centinela();
	  if(!$centinela->check(0, FALSE))
        redirect("con_acceso/entrar");
    } //Fin index

    function cambio($usuario_actual,$nueva){
      $this->db->query("UPDATE sistema.usuarios SET usr_clave = '$nueva' WHERE usr_usuarios_pk = $usuario_actual");
    } //fin cambio

    function nuevo($valores){
      $this->db->trans_start();
       $this->db->query("INSERT INTO sistema.usuarios (usr_nombre, usr_clave, usr_correo_electronico, usr_nivel, usr_fecha_creacion, usr_fecha_expira, usr_rol)
                         VALUES (?,?,?,'1','".mdate('%Y-%m-%d',now())."',?,'1')", $valores);
       $pk = $this->db->query('Select max(usr_usuarios_pk) from sistema.usuarios');
      $this->db->trans_complete();
      return $pk->row_array();
    } //Fin nuevo

    function modificar($valores){
      $this->db->query("UPDATE sistema.usuarios SET usr_correo_electronico=?, usr_fecha_expira=? WHERE usr_usuarios_pk =?" , $valores);
    } //Fin nuevo

    function borrar($pk){
      $this->db->trans_start();
        $this->db->query('DELETE FROM sistema.usuarios_opciones WHERE usr_usuarios_fk ='.$pk);
        $this->db->query('DELETE FROM sistema.usuarios WHERE usr_usuarios_pk ='.$pk);
      $this->db->trans_complete();
      //Opcion para no borrar los usuarios sino vencerlo
      if(!USUARIO_BORRADO == "FALSE")
        $this->db->query('UPDATE sistema.usuarios SET usr_fecha_expira = CURRENT_DATE WHERE usr_usuarios_pk ='.$pk);

    }

    //Con esta funcion consulto la tabla directamente, para obtener todos los registros
    function ObtRegistros($field,$param,$tabla){
        //echo "Campo: $field, Condicion: $param";
        $query = $this->db->where($field,$param);
        $query = $this->db->get($tabla);
        //$q = $this->db->query('Select * from '.$tabla.' where '.$field.'='.$param);
        return $query->row();
      } //Fin ObtRegistros

     //Carga en una variable de session toda la permisologia detallada del $id_usuario
    function carga_detalle_opciones($id_usuario,$controlador){
        $consulta = 'SELECT usm_usuarios_menu_pk,usm_nivel,usm_titulos,uso_incluir, uso_modificar, uso_borrar, uso_campos_solo_lectura, uso_campos_no_visibles
                    FROM sistema.vis_usuarios_menu as um, sistema.usuarios_opciones as uo
                    WHERE uo.usm_usuarios_fk = um.usm_usuarios_menu_pk and
                    uo.uso_ver = true and usm_codigo != \'*\'  and uo.usr_usuarios_fk = ? and usm_nivel = ?';
        $qOpciones = $this->db->query($consulta,array($id_usuario,$controlador));
        $aOpciones = $qOpciones->result_array();
        $ind = 0;$this->detalle_opciones ='';

        $this->detalle_opciones = '<?xml version="1.0" standalone="yes"?>';
        $this->detalle_opciones .= '<menu>';
        $salto_linea = "\n\n";
        //Comentar la siguiente linea si se desea ver el xml con saltos de linea
        $salto_linea = "";
        foreach($aOpciones as $fOpciones){
            $accion = array();
            $menuOpciones[$ind]['opcion'] = $fOpciones['usm_nivel'];
            array_push($accion,$fOpciones['uso_incluir']);
            array_push($accion,$fOpciones['uso_modificar']);
            array_push($accion,$fOpciones['uso_borrar']);
            //Armo formato XML
            $this->detalle_opciones .= '<opcion nombre="'.$fOpciones['usm_nivel'].'">'.$salto_linea;
            $this->detalle_opciones .= '<i>'.$fOpciones['uso_incluir'].'</i>'.$salto_linea;
            $this->detalle_opciones .= '<m>'.$fOpciones['uso_modificar'].'</m>'.$salto_linea;
            $this->detalle_opciones .= '<b>'.$fOpciones['uso_borrar'].'</b>'.$salto_linea;
            if($fOpciones['uso_campos_solo_lectura'] == ''){
              $menuOpciones[$ind]['sl'] = '';
              //Armo formato XML
              $this->detalle_opciones .= '<sl></sl>'.$salto_linea;
            }else{
              $menuOpciones[$ind]['sl'] = split('[,]', $fOpciones['uso_campos_solo_lectura']);
              //Armo formato XML
              $this->detalle_opciones .= '<sl>'.$fOpciones['uso_campos_solo_lectura'].'</sl>'.$salto_linea;
            }
            if($fOpciones['uso_campos_no_visibles'] == ''){
              $menuOpciones[$ind]['nv'] = '';
              //Armo formato XML
              $this->detalle_opciones .= '<nv></nv>'.$salto_linea;
            }else{
              $menuOpciones[$ind]['nv'] = split('[,]', $fOpciones['uso_campos_no_visibles']);
              //Armo formato XML
              $this->detalle_opciones .= '<nv>'.$fOpciones['uso_campos_no_visibles'].'</nv>'.$salto_linea;
            }
            $menuOpciones[$ind++]['accion'] = $accion;
            //Armo formato XML
            $this->detalle_opciones .= '</opcion>'.$salto_linea;
            //echo $this->detalle_opciones ;
        } //Fin foreach
        //Armo formato XML
        $this->detalle_opciones .= '</menu>';
        return $this->detalle_opciones;
        //echo $this->detalle_opciones;
    } //Fin carga_detalle_opciones


    //Obtiene el identificador de nivel del formulario segun el nombre del controlador
    function get_id_formulario($nombre_formulario){
        $consulta = 'select usm_nivel from sistema.usuarios_menu where split_part(usm_codigo, \'/\', 1) = ?';
        $nivel = '';
        $qnivel = $this->db->query($consulta,$nombre_formulario);
        if($qnivel->num_rows() > 0){
          $rnivel = $qnivel->row_array();
          $nivel  = $rnivel['usm_nivel'];
        }
        return $nivel;
    } //Fin get_id_formulario

    //Los parametros indica la $opcion a estudiar y el $permiso en especifico
    //Devuelve true para el caso afirmativo y false para el caso no afirmativo
    //En el caso de evaluar un $control del formulario retorna nv para no visible, sl para solo lectura o sr para sin restricciones
    function evalua_permiso($opcion='',$control='',$controlador=''){
        $nivel_controlador = $this->get_id_formulario($controlador);
        $respuesta = false;
        if($nivel_controlador != ''){
          $cent = new Centinela();
          $pol = $this->carga_detalle_opciones($cent->getId(),$nivel_controlador);
          if($pol != ''){
            $xml = new SimpleXMLElement($pol);
            foreach ($xml->opcion as $valor) {
                if($opcion == 'b' and $valor->b == 't')
                  $respuesta = true;
                if($opcion == 'i' and $valor->i == 't')
                  $respuesta = true;
                if($opcion == 'm' and $valor->m == 't')
                  $respuesta = true;
                if(($valor->sl != '' or $valor->nv != '') and $control != '' ){
                  if($opcion == 'sl' and preg_match("/$control/", $valor->sl))
                    $respuesta = true;
                  if($opcion == 'nv' and preg_match("/$control/", $valor->nv))
                    $respuesta = true;
                }
            }
          }
          return $respuesta;
        }
    } //Fin evalua_permiso


} //fin clase
?>
