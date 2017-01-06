<?php
/**
 * PHP Template.
 */
class Con_frmclass extends Controller
{
    var $campos, $reglas, $attcampo, $nombre_tabla, $valores;
    var $enviar, $vismenu;
    var $vpk;
    var $fkcampos = array();
    var $lv_padre;
    
    function Con_frmclass(){
        parent::Controller();
        $this->load->model('Mfrmclass','',TRUE);
        $this->load->helper(array('form', 'url'));
        $this->load->library('validation');
        $this->load->helper('date');
    }

    /**
     * Funcion para contruir formulario dinamicamente
     * solo hay que indicarle cual es el nombre de la tabla a IAEM (Insertar,
     * actualizar, eliminar y mostrar queremos)
     */
    function index($modo,$tabla,$valor_pk = '',$frm_padre=''){

     //Verifico parametros y encapsulo los mismos
     if(isset($valor_pk)) {$this->vpk = $valor_pk;} else {$this->vpk = '';}
     $this->Mfrmclass->nombre_tabla     = $tabla;
     
     //Variable para redireccionar el boton de cancelar al momento de accionar Cancelar
     if($frm_padre != ''){
        $this->lv_padre = base_url().'index.php/'.$frm_padre;
     }else{
        $this->lv_padre = base_url(); 
     }

     //Caso de borrado de registro sin antes mostrarlo
     if($modo === MODO_BORRAR and BORRADO_SIN_MOSTRAR === 'ACTIVO'){
       $this->Mfrmclass->BorrarRegistro($this->vpk);
       redirect(base_url().'index.php/'.$frm_padre);
       return;
     }

     //Construyo segun estuctura de la tabla los arreglos de $reglas y $campos
     if ($this->db->table_exists($this->Mfrmclass->nombre_tabla))
       {
         $ct = $this->db->field_data($this->Mfrmclass->nombre_tabla);
         foreach ($ct as $campo)
          {
           if (!$this->Mfrmclass->esPk($campo->name))
            {    
             $resultado = $this->Mfrmclass->ObtAttCampo($this->Mfrmclass->nombre_tabla,$campo->name);
             //echo $campo->type;
             switch($campo->type){
                case 'varchar':              
                 $this->reglas["{$campo->name}"]  = 'trim'.$this->Mfrmclass->EsRequerido($resultado).'|max_length['.$resultado['longvar'].']';
                 $this->attcampo["{$campo->name}"]['longitud'] = $resultado['longvar'];
                 break;
                case 'numeric':
                 $this->reglas["{$campo->name}"]  = 'trim'.$this->Mfrmclass->EsRequerido($resultado);
                 $this->attcampo["{$campo->name}"]['longitud'] = 20;
                 break;
                case 'int2':
                case 'int4':
                 $this->reglas["{$campo->name}"]  = 'trim'.$this->Mfrmclass->EsRequerido($resultado);
                 $this->attcampo["{$campo->name}"]['longitud'] = 20;
                 break; 
                case 'bool':
                 //Se elimino esta regla ya que los campos booleanos se evaluan siempre con checkbox	
                 //$this->reglas["{$campo->name}"]  = $this->Mfrmclass->EsRequerido($resultado);
                 break;
                case 'date':
                 $this->reglas["{$campo->name}"]  = '';
                 $this->attcampo["{$campo->name}"]['longitud'] = 20;
                 break;
             }
             //Asigno el tipo de dato al arreglo para mostrar en el view
             $this->attcampo["{$campo->name}"]['tipo']  = $campo->type;
             //Asigno el nombre de los campos
             $this->campos[$campo->name]                = $campo->name;
             //Campos foreing key _fk
             if ($this->Mfrmclass->EsFk($campo->name)){  //Solucion mientras hago la funcion en BD
                 $todos_registros = $this->Mfrmclass->ObtRegPorTabla($this->Mfrmclass->SinPreSufijo($campo->name),'visfk_');
                 if ($todos_registros->num_rows() > 0){
                    $this->fkcampos["{$campo->name}"] = $todos_registros->result_array();
                 }
                 else {
                    $this->fkcampos["{$campo->name}"] = "No Disponible";
                 }
             } //Fin EsFk
            }else{
              $this->Mfrmclass->prefijo_tabla = substr($campo->name,0,4);
              $this->Mfrmclass->campo_clave   = $this->Mfrmclass->prefijo_tabla.$this->Mfrmclass->nombre_tabla.'_pk';
            } //Fin if primary
          } //Fin foreach
       } //Fin validacion tabla
     $this->validation->set_rules($this->reglas); //Aplico las reglas al formulario
     $this->validation->set_fields($this->campos); //Asigno los nombre de los campos para mensajes de error
     $this->validation->set_error_delimiters('<p id=frm_error>'); //Asigno formato para mostrar errores

     //Ejecuto la validacion del formulario
     if ($this->validation->run() == FALSE){
       //echo 'Trabajando en modo entonces: '.$modo."$this->vpk"."  ".$this->Mfrmclass->campo_clave."  ".count($this->valores,COUNT_RECURSIVE);
       if($modo == MODO_MODIFICAR or $modo == MODO_GRABAR){
          if(count($this->valores,COUNT_RECURSIVE) == 0 and $modo == MODO_MODIFICAR){
            $this->valores = $this->Mfrmclass->ObtRegistros($this->Mfrmclass->campo_clave,$this->vpk);}
          $this->enviar = "con_frmclass/index/".MODO_GRABAR."/$tabla/$this->vpk/$frm_padre";
          $variables['modo'] = 'Modificaci&oacute;n';
        }
       if($modo==MODO_INCLUIR){
         $this->enviar = "con_frmclass/index/".MODO_INCLUIR."/$tabla/$this->vpk/$frm_padre";
         $variables['modo'] = 'Inclusi&oacute;n';
       }
       if($modo == MODO_BORRAR){
         if(count($this->valores,COUNT_RECURSIVE) == 0){
            $this->valores = $this->Mfrmclass->ObtRegistros($this->Mfrmclass->campo_clave,$this->vpk);}
         $this->enviar = "con_frmclass/index/".MODO_BORRAR."/$tabla/$this->vpk/$frm_padre";
         $variables['modo'] = 'Eliminar';
       }
        $this->vismenu = $this->load->view('vis_menu','',true);
        $this->load->view('vis_frmclass',$variables);
      }else{//Formulario validado corectamente
          //echo 'Trabajando en modo: '.$modo;
          switch($modo){
             case MODO_GRABAR:
                 $valores = $this->check_post($_POST);
                 array_push($valores,$this->vpk);
                 $this->Mfrmclass->ActualizarRegistro($valores);
                 break;
             case MODO_INCLUIR:
                 $valores = $this->check_post($_POST);
                 $this->Mfrmclass->IncluirRegistro($valores);
                 break;
             case MODO_BORRAR:
                 $this->Mfrmclass->BorrarRegistro($this->vpk);
                 break;
          }
       redirect($frm_padre);
      }
    }

    //Chequeo los valores que vienen en el post, contra los que tienen que estar
    function check_post($val_post){
        $post_valores = array();
             foreach($this->campos  as $variable_post => $valor_post){
                 if(!array_key_exists($variable_post,$val_post)){
                    $post_valores[$variable_post] = null;
                 }else{
                    $post_valores[$variable_post] = $val_post[$variable_post];
                 }
             }
         return $post_valores;
    } //Fin check_post

    function valor_campos()
    {
       return $this->campos;         
    }
}

?>
