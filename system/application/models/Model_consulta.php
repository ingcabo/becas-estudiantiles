<?php
class Model_consulta extends Model {
  
  var $nombre_pais       = '';
  var $nacionalidad_pais = '';
  var $usuario_id        = '';
  var $ult_mod           = '';
  var $activo            = '';
  var $nombre_tabla      = '';


	function Model_consulta()
	{
		parent::Model();
        $this->load->database();
        $this->load->model('Mfrmclass','',TRUE);
	}





function consulta_combo($campo,$order,$tabla){
// $campo = campo por donde ordeno el combo.
// $order = como ordeno.
// $tabla = la tabla o vista a consultar.

    $this -> db -> order_by($campo, $order);
    $this -> db -> where('activo','1');

    $query = $this -> db -> get($tabla);
	//print_r($query);
    return ($query);
}

function consulta_combo_p($campo,$order,$tabla){
// $campo = campo por donde ordeno el combo.
// $order = como ordeno.
// $tabla = la tabla o vista a consultar.

    $this -> db -> order_by($campo, $order);
   

    $query = $this -> db -> get($tabla);
	//print_r($query);
    return ($query);
}

function consulta($campo,$order,$tabla){
// $campo = campo por donde ordeno el combo.
// $order = como ordeno.
// $tabla = la tabla o vista a consultar.

   // $this -> db -> order_by($campo, $order);
    $query =  $this->db->query('select '.$campo.' from '.$tabla);
  //print_r($query);
	return ($query);
}


function consulta_combo_dist($campo,$order,$tabla){
// $campo = campo por donde ordeno el combo.
// $order = como ordeno.
// $tabla = la tabla o vista a consultar.
    $query   = $this->db->query('select distinct('.$campo.'), carrera from '.$tabla.' ORDER BY '.$campo.' asc');
    //$this -> db -> order_by($campo, $order);
	//$query = $this -> db -> get($tabla);
	return ($query);
}



function consulta_un_parametro($campo,$order,$tabla,$parametro,$campo_parametro){
// $campo           = campo por donde ordeno el combo.
// $order           = como ordeno.
// $tabla           = la tabla o vista a consultar.
// $parametro       = valor para el where.
// $campo_parametro = campo a comprar.

     $this -> db -> order_by($campo, $order);
     $this -> db -> where($campo_parametro,$parametro);
	 $query = $this -> db -> get($tabla);
	
     return ($query);
}


function consulta_un_limit_parametro($campo,$order,$tabla,$parametro,$campo_parametro,$limite){
// $campo           = campo por donde ordeno el combo.
// $order           = como ordeno.
// $tabla           = la tabla o vista a consultar.
// $parametro       = valor para el where.
// $campo_parametro = campo a comprar.

     $this -> db -> order_by($campo, $order);
     $this ->db  ->limit($limite);
     $this -> db -> where($campo_parametro,$parametro);
	 $query = $this -> db -> get($tabla);

     return ($query);
}
//$this->db->limit(10);
function consulta_tres_parametro($campo,$order,$tabla,$parametro,$campo_parametro,$parametro2,$campo_parametro2,$parametro3,$campo_parametro3){
// $campo             = campo por donde ordeno el combo.
// $order             = como ordeno.
// $tabla             = la tabla o vista a consultar.
// $parametro         = valor para el where.
// $campo_parametro   = campo a comprar.
// $parametro2        = valor para el where.
// $campo_parametro2  = campo a comprar.
// $parametro3        = valor para el where.
// $campo_parametro3  = campo a comprar.

     $this -> db -> order_by($campo, $order);
     $this -> db -> where($campo_parametro,$parametro);
     $this -> db -> where($campo_parametro2,$parametro2);
     $this -> db -> where($campo_parametro3,$parametro3);
	 $query = $this -> db -> get($tabla);

     
     return ($query);
}
function consulta_dos_parametro($campo,$order,$tabla,$parametro,$campo_parametro,$parametro2,$campo_parametro2){
// $campo             = campo por donde ordeno el combo.
// $order             = como ordeno.
// $tabla             = la tabla o vista a consultar.
// $parametro         = valor para el where.
// $campo_parametro   = campo a comprar.
// $parametro2        = valor para el where.
// $campo_parametro2  = campo a comprar.
// $parametro3        = valor para el where.
// $campo_parametro3  = campo a comprar.

     $this -> db -> order_by($campo, $order);
     $this -> db -> where($campo_parametro,$parametro);
     $this -> db -> where($campo_parametro2,$parametro2);
     
	 $query = $this -> db -> get($tabla);
     //print_r($query);
     return ($query);
}




function ObtTodosRegistros($limite = 0,$comienza=0,$tabla ='',$campo = '',$valorpk= 0){

                            if($limite == 0){

                            $this->db->where($campo,$valorpk);
                            $query = $this->db->query("select * from $tabla");
                            }else{
                            if($comienza == 0){

                            $this->db->where($campo,$valorpk);
                            $query = $this->db->query("select * from $tabla".$limite);
                            }else{

                            $this->db->where($campo,$valorpk);
                            $query = $this->db->query("select * from $tabla limit $limite offset $comienza");
                            }
                            }
                            if($query->num_rows() > 0){
                            return $query;
                            }
                            else{
                            return null;
                            }

                            }



                               function CreaParametros($tabla,$arreglo){
                                    $resultado = '';
                                    foreach($arreglo as $cam => $valor){
                                        $atributos = $this->ObtAttCampo($tabla,$cam);
                                        if($atributos['tipo'] == 'varchar'){
                                          $resultado = $resultado.'\''.$valor.'\',';
                                        }elseif($atributos['tipo'] == 'date'){
                                            if($valor == NULL){ $resultado = $resultado.'null,';}else{
                                                $resultado = $resultado.'\''.$this->mylib_base->human_to_pg($valor).'\',';
                                            }

                                        }elseif($atributos['tipo'] == 'int2' or $atributos['tipo'] == 'int4' or $atributos['tipo'] == 'int2' or $atributos['tipo'] == 'numeric'){
                                          if($valor == '')
                                            $resultado = $resultado.'null,';
                                          else
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
                                  //  print_r($resultado);
                                    return rtrim($resultado,',');
                        } //Fin CreaParametros




                            function ObtAttCampo($tabla,$campo)
                            {
                            $consulta = "select * from pg_att_campo('$tabla','$campo')";
                            return $this->db->query($consulta)->row_array();
                            }




  function setCampo($strCampo)
  {
    return 'upper('.$strCampo.')';
  }

  function setCriterio($strCriterio, $strValor)
  {
    switch ($strCriterio)
    {
      case 'Contenga': $result = 'LIKE \'%\' || \''.strtoupper($strValor).'\' || \'%\''; break;
      case 'Sea Igual a': $result = '= \''.strtoupper($strValor).'\''; break;
    }
    return $result;
  }


  function setwhere($campo, $criterio, $valor)
  {
    return ' '.$this->setCampo($campo).' '.$this->setCriterio($criterio, $valor).' AND ';
  }

  function getAll($campo, $criterio, $valor, $page, $perPage)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->setWhere($campo, $criterio, $valor);
    }

    $strPerPage = ($perPage == '') ? '' : ' LIMIT '.$perPage;

    $strPage = ($page == '') ? '' : ' OFFSET '.$page;

    $sqlQuery = 'SELECT *  FROM '.$this->nombre_tabla.' WHERE'.$strWhere.' activo = 1 ORDER BY nombre_'.$this->nombre_tabla.$strPerPage.$strPage;

    $result = $this->db->query($sqlQuery);
    return $result;
  }
 


  function getNumTotal($campo, $criterio, $valor)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->setWhere($campo, $criterio, $valor);
    }
    $sqlQuery = 'SELECT COUNT( '.$this->nombre_tabla.'_id) as total FROM  '.$this->nombre_tabla.'  WHERE'.$strWhere.' activo = 1';
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result->total;
  }

  function get($Id,$tabla)
  {
    $this->nombre_tabla = $tabla;
    $sqlQuery = 'SELECT * FROM  '.$this->nombre_tabla.' WHERE '.$this->nombre_tabla.'_id = '.$Id;
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result;
  }







}
?>
