<?php

/**
 * Constructor de trigger en postgres, para hacer
 * auditoria de las tablas
 *
 * @author rcamejo
 */
class Con_gentrigger extends controller{

  var $tabla_nombre, $trigger_encabezado, $trigger_udp_comienzo_cuerpo, $trigger_udp_campo,
      $trigger_udp_fin_cuerpo, $trigger_ins_comienzo_cuerpo, $trigger_ins_campo, $trigger_ins_fin_cuerpo,
      $enlace_tabla_triger,$trigger_del_campo_permitido,$trigger_del_campo_comienzo,$trigger_del_campo_fin;
  var $salto_linea = '<br>';

  function Con_gentrigger(){
    parent::Controller();
    $this->load->model('Mfrmclass','',TRUE);

    $this->trigger_encabezado = '
    CREATE OR REPLACE FUNCTION trg_aud_[% nft %]() RETURNS "trigger" AS'.$this->salto_linea.'
    $BODY$'.$this->salto_linea.'
    BEGIN'.$this->salto_linea;
    $this->trigger_del_campo_comienzo = 'IF (TG_OP = \'DELETE\') THEN'.$this->salto_linea;

    $this->trigger_del_campo ='
       insert into auditoria(adt_tabla,adt_pk_registro,adt_campo_afectado,adt_valor_old,adt_valor_new,adt_cliente_ip,adt_fecha_hora,adt_accion,adt_usuario)'.$this->salto_linea.'
       values( \'[% tabla %]\', OLD.[% pk %], \'[% id %]\', OLD.[% cp %], OLD.[% cp %], inet_client_addr(), current_timestamp, \'DELETE\',CURRENT_USER);'.$this->salto_linea.'
       RAISE EXCEPTION \'NO SE PERMITEN BORRADOS FISICOS\';'.$this->salto_linea;


    $this->trigger_del_campo_fin = '
           RETURN OLD;'.$this->salto_linea.'
           END IF ;'.$this->salto_linea;

    $this->trigger_del_campo_permitido ='
       insert into auditoria(adt_tabla,adt_pk_registro,adt_campo_afectado,adt_valor_old,adt_valor_new,adt_cliente_ip,adt_fecha_hora,adt_accion,adt_usuario)'.$this->salto_linea.'
       values( \'[% tabla %]\', OLD.[% pk %], \'[% id %]\', OLD.[% cp %], OLD.[% cp %], inet_client_addr(), current_timestamp, \'DELETE\',CURRENT_USER);'.$this->salto_linea;


    $this->trigger_udp_comienzo_cuerpo = '
    IF (TG_OP = \'UPDATE\') THEN'.$this->salto_linea;
    $this->trigger_udp_campo = '
     IF (OLD.[% id %] <> NEW.[% id %]) THEN'.$this->salto_linea.'
        insert into auditoria(adt_tabla,adt_pk_registro,adt_campo_afectado,adt_valor_old,adt_valor_new,adt_cliente_ip,adt_fecha_hora,adt_accion,adt_usuario)'.$this->salto_linea.'
        values( \'[% tabla %]\', OLD.[% pk %], \'[% id %]\', OLD.[% cp %], NEW.[% cp %], inet_client_addr(), current_timestamp, \'UPDATE\',CURRENT_USER);'.$this->salto_linea.'
     END IF;'.$this->salto_linea;
    $this->trigger_udp_fin_cuerpo = '
    return new ;'.$this->salto_linea.'
    END IF ;'.$this->salto_linea;

    $this->trigger_ins_comienzo_cuerpo = '
    IF (TG_OP = \'INSERT\') THEN'.$this->salto_linea;
    $this->trigger_ins_campo = '
      IF (NEW.[% id %] IS NOT null) THEN'.$this->salto_linea.'
          insert into auditoria(adt_tabla,adt_pk_registro,adt_campo_afectado,adt_valor_old,adt_valor_new,adt_cliente_ip,adt_fecha_hora,adt_accion,adt_usuario)'.$this->salto_linea.'
          values( \'[% tabla %]\', NEW.[% pk %], \'[% id %]\', null, NEW.[% cp %], inet_client_addr(), current_timestamp, \'INSERT\',CURRENT_USER);'.$this->salto_linea.'
      END IF;'.$this->salto_linea;
    $this->trigger_ins_fin_cuerpo = '
    return new ;'.$this->salto_linea.'
    end IF ;'.$this->salto_linea.'
    END;'.$this->salto_linea.'
    $BODY$'.$this->salto_linea.'
    LANGUAGE \'plpgsql\' VOLATILE;'.$this->salto_linea.'
    ALTER FUNCTION trg_aud_[% nft %]() OWNER TO postgres;'.$this->salto_linea;
    $this->enlace_tabla_triger = 'CREATE TRIGGER trg_[% nft %]'.$this->salto_linea.'
    BEFORE INSERT OR UPDATE OR DELETE'.$this->salto_linea.'
    ON [% nft %]'.$this->salto_linea.'
    FOR EACH ROW'.$this->salto_linea.'
    EXECUTE PROCEDURE trg_aud_[% nft %]();'.$this->salto_linea;
  }

  function actualiza($plantilla, $tabla){
    $resultado = '';$con_tabla = '';
        if ($this->db->table_exists($tabla)){
            $con_tabla = preg_replace('/\[\% tabla \%\]/',$tabla,$plantilla);
            $query = $this->db->query('SELECT * FROM '.$tabla.' limit 1');
            $num_campo = 1;$base='';
            foreach ($query->list_fields() as $campo){
              if($num_campo++ > 1){
                 $carac = $this->Mfrmclass->ObtAttCampo($tabla,$campo);
                 if($carac['tipo']=='int' or $carac['tipo']=='int2' or $carac['tipo']=='int4'){
                   $resultado .= preg_replace('/\[\% id \%\]/',$campo,$base);
                   $resultado = preg_replace('/\[\% cp \%\]/',$campo.'::integer',$resultado);
                 }else{
                   $resultado .= preg_replace('/\[\% id \%\]/',$campo,$base);
                   $resultado = preg_replace('/\[\% cp \%\]/',$campo,$resultado);
                 }
              }else{
                 $base = preg_replace('/\[\% pk \%\]/',$campo,$con_tabla);
                 $resultado .= preg_replace('/\[\% id \%\]/',$campo,$base);
                 $resultado = preg_replace('/\[\% cp \%\]/',$campo,$resultado);
              }
            }
        }
     return $resultado;
  } //Fin actualiza

  function script($tabla){
     $result = '';
     $encabezado = preg_replace('/\[\% nft \%\]/',$tabla,$this->trigger_encabezado);
     //Linea para permitir borrado de registro
     $result = $encabezado.$this->salto_linea.$this->trigger_del_campo_comienzo.$this->salto_linea;
     $result .= $this->actualiza($this->trigger_del_campo_permitido,$tabla).$this->salto_linea;
     $result .= $this->trigger_del_campo_fin.$this->salto_linea;
     //$result = $encabezado.$this->salto_linea.$this->trigger_udp_comienzo_cuerpo.$this->salto_linea;
     $result .= $this->trigger_udp_comienzo_cuerpo.$this->salto_linea;
     $result .= $this->actualiza($this->trigger_udp_campo, $tabla).$this->salto_linea;
     $result .= $this->trigger_udp_fin_cuerpo.$this->salto_linea.$this->trigger_ins_comienzo_cuerpo;
     $result .= $this->actualiza($this->trigger_ins_campo, $tabla);
     $final = preg_replace('/\[\% nft \%\]/',$tabla,$this->trigger_ins_fin_cuerpo);
     $result .= $final;
     $enlace = preg_replace('/\[\% nft \%\]/',$tabla,$this->enlace_tabla_triger);
     return $result.$enlace;
  }

  function index(){

     $tablas = $this->db->list_tables();
     $i=1;
     foreach($tablas as $tabla){
         $consulta = '';
         if(substr($tabla,0,3) != 'vis' and $tabla != 'auditoria'){
           //echo $i++.$tabla.'<br>';
           $consulta = $this->script($tabla);
           echo $consulta.'<h2>Fin</h2><br>';
           //$resultado = $this->db->query($consulta);
         }
     }
   } //Fin index

  
} //Fin Con_gentrigger
?>
