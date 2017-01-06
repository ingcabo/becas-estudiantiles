<?php
/**
 * PHP Template.
 */
Class Mfrmclass extends Model
{
    var $nombre_tabla    = '';
    var $excepcion_campo = array("ULTIMA_MOD", "USUARIO_FK");
    var $prefijo_tabla   = '';
    var $campo_clave;
    
    //Constructor
    function Mfrmclass()
      {
        parent::Model();
        $this->load->database();
        $this->load->helper('inflector');
        $this->load->library('mylib_base');
      }

#Region Funciones para trabajo con Base de datos

    //Consulta para buscar longitud de un campo de la BD
    function ObtAttCampo($tabla,$campo)
      {
        $consulta = "select * from pg_att_campo('$tabla','$campo')";
        return $this->db->query($consulta)->row_array();
      }
    
    //Evalua si el campo es de uso obligatorio o no en l a BD
    //Se utiliza con el resultado de la function ObtAttCampo[esnulo]
    function EsRequerido($rescon)
      {
        if ($rescon['esnulo'] == 't'){
               return '|required';}
             else {
               return '';}
      }
    
    //Lista todos los registros donde $limite es cantidad registros por paginas y
    //$comienza numero de registro a comenzar
    function ObtTodosRegistros($limite = 0,$comienza=0,$esquema='')
      {
       if($limite == 0){
        $query = $this->db->query("select * from $esquema"."vis_$this->nombre_tabla");
       }else{
        if($comienza == 0){
         $query = $this->db->query("select * from $esquema"."vis_$this->nombre_tabla limit ".$limite);
        }else{
         $query = $this->db->query("select * from $esquema"."vis_$this->nombre_tabla limit $limite offset $comienza");
        }
       }
        if ($query->num_rows() > 0){
            return $query;
          }
        else {
            return null;
          }
      } //fin ObtTodosRegistros
    
    //Se obtiene un campo $field segun filtro $param
    //Solo para uso con vistas
    function ObtRegistrosFiltrados($field,$param,$operador,$limite=0,$comienza=0,$esquema='')
    {
       //tipo texto
       if($operador === '%_%'){
           $condicion =$field." LIKE '%".trim($param)."%'";
       }elseif($operador === '_%'){
           $condicion = $field." LIKE '".trim($param)."%'";
       }elseif($operador === '%_'){
           $condicion = $field." LIKE '%".trim($param)."'";
       }elseif($operador === '='){
           $condicion = $field." = '".trim($param)."'";
       }else{ //Otros tipos
           $condicion =  "$field $operador $param";
       }

       if($limite == 0){
        $query = $this->db->query("select * from $esquema"."vis_$this->nombre_tabla where $condicion");
       }else{
        if($comienza == 0){
         $query = $this->db->query("select * from $esquema"."vis_$this->nombre_tabla where $condicion limit $limite");
        }else{
         $query = $this->db->query("select * from $esquema"."vis_$this->nombre_tabla where $condicion limit $limite offset $comienza");
        }
       }
        if ($query->num_rows() > 0){
            return $query;
          }
        else {
            return null;
          }
    } //Fin ObtRegistrosFiltrados

    //Con esta funcion consulto la tabla directamente, para obtener todos los registros
    function ObtRegistros($field,$param){
        //echo "Campo: $field, Condicion: $param";
        $query = $this->db->where($field,$param);
        $query = $this->db->get($this->nombre_tabla);
        return $query->result_array();
      } //Fin ObtRegistros

    //Carga vistas generales de tablas
    function ObtRegPorTabla($tabla,$prefijo='vis_'){
        $consulta = "select * from $prefijo$tabla";
        return $this->db->query($consulta);
      }
    
    //Cantidad de registros de la tabla
    function CantidadRegistros($esquema=''){
        return $this->db->count_all($esquema.$this->nombre_tabla);
      }

    //Para las siguientes funciones el parametro $valores es una matriz con los parametros del
    //store procedure de la Base de datos que se esta llamando
    function ActualizarRegistro($valores){
        $consulta = "select * from upd_".$this->nombre_tabla."(".$this->CreaParametros($valores).")";
        return $this->db->query($consulta);
    }

    function IncluirRegistro($valores){
        $consulta = "select * from ins_".$this->nombre_tabla."(".$this->CreaParametros($valores).")";
        return $this->db->query($consulta);
    }

    function BorrarRegistro($valores){
        $consulta = "select * from del_".$this->nombre_tabla."($valores)";
        return $this->db->query($consulta);
    }

    #Region Funciones varias
    function CreaParametros($arreglo){
        $resultado = '';
        foreach($arreglo as $cam => $valor){
            $atributos = $this->ObtAttCampo($this->nombre_tabla,$cam);
            if($atributos['tipo'] == 'varchar'){
              $resultado = $resultado.'\''.$valor.'\',';
            }elseif($atributos['tipo'] == 'date'){
                if($valor == '')
                  $resultado .= 'null,';
                else
                  $resultado = $resultado.'\''.$this->mylib_base->human_to_pg($valor).'\',';
            }elseif($atributos['tipo'] == 'int2' or $atributos['tipo'] == 'int4' or $atributos['tipo'] == 'int2' or $atributos['tipo'] == 'numeric'){
              if($valor == '')
                $resultado = $resultado.'null,';
              else
                $valor = str_replace('.','',$valor);
                $valor = str_replace(',','.',$valor);
                $resultado = $resultado.$valor.',';
            }elseif($atributos['tipo'] == 'bool'){
               if($valor == '')
                 $resultado = $resultado.'false,';
               else
                 $resultado = $resultado.$valor.',';
            }else{
              $resultado = $resultado.$valor.',';
            }
        }
        return rtrim($resultado,',');
    } //Fin CreaParametros


                           


    //Existe una variable llamada excepcion_campo que almacena los nombre de campos de uso interno en la
    //tabla, los cuales no deben ser mostrados los formularios como usuario_fk y ultima_mod
    function EsExcepcion($campo){
       foreach($this->excepcion_campo as $c){
            if ($c == strtoupper($campo)){
                return true;}
        } 
        return false;
      } //Fin EsExcepcion

    //Muestra los titulo de los campos sin - ó _ y con la primera letra Mayuscula y el resto en minusculas
    function CrearTitulo($titulo){
        $ttmp = str_replace("_fk","",$titulo);
        $ttmp = substr($ttmp,4);
        if(defined($ttmp)){
          $ttmp =  utf8_encode(constant($ttmp));
        }else{
          $ttmp =  humanize($ttmp);
        }
        return utf8_decode($ttmp);
    } //Fin CrearTitulo

    //Identifico de la lista de campos el pk para sacarlo de la lista
    function SinPk($list_campos){
        return array_filter($list_campos, array('MfrmClass','sinpk_callback'));
    }

    //Callback de SinPk
    function sinpk_callback($campo){
        if (strrpos($campo,"_pk") == False){
            Return true;
        }else {
            Return false;
        }
    }

    //Valido si el campo es primary key a traves de su nombre
    function Espk($campo){
       if($campo != '')
        if(substr($campo,-3)== '_pk'){
          return true;
        }else{
          return false;
        }
    } //fin espk

    function Esfk($campo){
        if(substr($campo,-3)== '_fk'){
          return true;
        }else{
          return false;
        }
    } //Fin Esfk

    //Creo las opciones para crear dropdown menu al estilo de codeigniter
    //Se pasa un arreglo con solo los nombres de los campos, donde el nombre del campo es el mismo valor de la opcion
    function Crea_opciones_dropdown($campos_arreglo){
        $etiquetas_dropdown = array();
        $valores_dropdown = array();
        $opciones = array();
        foreach($campos_arreglo as $campo_nombre => $campo_valor){
          array_push($valores_dropdown,$campo_valor);
          array_push($etiquetas_dropdown,$this->CrearTitulo($campo_valor));
        }
        $opciones = array_combine($valores_dropdown,$etiquetas_dropdown);
        return $opciones;
    } //Fin Crea_opciones_dropdown

    //Quito los prefijos y sufijos de nombre de campo de la tabla
    function SinPreSufijo($nombre){
        $tablafk = substr($nombre,4);
        return str_replace("_fk","",$tablafk);
    } //Fin SinPreSufijo


    function Campo_filtro($campo_seleccionado){
        $valor = $this->centinela->getcampo3()<>''?$this->centinela->getcampo3():'';
        $respuesta = '<input type="text" name="CampoFiltro" id="CampoFiltro" maxlength="20"  size="40" style="width:300px"
                      value="'.$valor.'">';
        $tipo_result = $this->ObtAttCampo($this->nombre_tabla,$campo_seleccionado);
        $tipo_dato = $tipo_result['tipo'];
        if($tipo_dato == 'bool')
        $respuesta = '<input type="radio" name="CampoFiltro" value="true" checked="checked">Sí</>
                     <input type="radio" name="CampoFiltro" value="false">No</> ';
        return $respuesta;
    }

    //Evaluo el tipo de campo de la tabla para devolver los operadores correspondiente
    function Operador($campo_seleccionado,$activo=''){
        //Valido si la tabla existe de no ser asi busco una vista con el nombre de la tabla mas el prefijo vis_
        if ($this->db->table_exists($this->nombre_tabla)){
          $tipo_result = $this->ObtAttCampo($this->nombre_tabla,$campo_seleccionado);
        }else{
          $tipo_result = $this->ObtAttCampo('vis_'.$this->nombre_tabla,$campo_seleccionado);  
        }

        $tipo_dato = $tipo_result['tipo'];

        if($activo == ''){
          $resultado = '<select name="SelectOperador" size="1" style="width:155px" >
                        <option value="0" selected="selected">[Seleccione uno]</option>';
        }else{
          $resultado = '<select name="SelectOperador" size="1" style="width:155px" >
                        <option value="0">[Seleccione uno]</option>';
        }
        switch($tipo_dato){
            case 'varchar':
                if($activo == '=')   $resultado .= '<option value="=" selected="selected">Igual a</option>';        else  $resultado .= '<option value="=">Igual a</option>';
                if($activo == '%_%') $resultado .= '<option value="%_%" selected="selected" >Contenga</option>';    else  $resultado .= '<option value="%_%" >Contenga</option>';
                if($activo == '_%')  $resultado .= '<option value="_%" selected="selected" >Comienza por</option>'; else  $resultado .= '<option value="_%">Comienza por</option>';
                if($activo == '%_')  $resultado .= '<option value="%_" selected="selected" >Termina en</option>';   else  $resultado .= '<option value="%_" >Termina en</option>';
             break;
            case 'numeric':
            case 'int2':
            case 'date':
                if($activo == '=')   $resultado .= '<option value="=" selected="selected">Igual a</option>';        else  $resultado .= '<option value="=">Igual a</option>';
                if($activo == '>=')  $resultado .= '<option value=">=" selected="selected">Mayor o igual que</option>'; else $resultado .= '<option value=">=">Mayor o igual que</option>';
                if($activo == '<=')  $resultado .= '<option value="<=" selected="selected">Menor o igual que</option>'; else $resultado .= '<option value="<=" >Menor o igual que</option>';
                if($activo == '>')   $resultado .= '<option value=">" selected="selected">Mayor que</option>';      else $resultado .= '<option value=">">Mayor que</option>';
                if($activo == '<')   $resultado .= '<option value="<" selected="selected">Menor que</option>';      else $resultado .= '<option value="<">Menor que</option>';
             break;
            case 'bool':
                if($activo == '=')   $resultado .= '<option value="=" selected="selected">Igual a</option>';        else $resultado .= '<option value="=">Igual a</option>';
             break;
            default:
                if($activo == '=')   $resultado .= '<option value="=" selected="selected">Igual a</option>';        else $resultado .= '<option value="=">Igual a</option>';
         }
         $resultado .= '</select>';
         return $resultado;
    } //Fin Operador

    //Funcion para formatear oraciones con las primeras letras en mayusculas, mejo usar humanize del framework
    function formato_oracion($cadenaEntrada = null){
	  if(!is_null($cadenaEntrada)){
		$cadenaSalida = ucwords(strtolower($cadenaEntrada));
		return $cadenaSalida;
	  }else
		return false;
    }

    //Busqueda de un segmento de una uri dada
    function uri_segmento($url,$num_segmento){
        if(!empty($url)){
            $segmentos = split('/{1,2}',$url);
            if(count($segmentos) >= $num_segmento)
              return $segmentos[$num_segmento];
        }
        return false;
    } //Fin uri_segmento
}
?>
