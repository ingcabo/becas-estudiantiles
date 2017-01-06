<?php
class paisModel extends Model
{
  var $nombre_pais = '';
  var $nacionalidad_pais = '';
  var $usuario_id = '';
  var $ult_mod = '';
  var $activo = '';
  
	function paisModel(){
		parent::Model();
        $this->load->database();
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

  function getAllPais($campo, $criterio, $valor, $page, $perPage)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->setWhere($campo, $criterio, $valor);
    }

    $strPerPage = ($perPage == '') ? '' : ' LIMIT '.$perPage;
    
    $strPage = ($page == '') ? '' : ' OFFSET '.$page;
    
    $sqlQuery = 'SELECT pais_id, nombre_pais, nacionalidad_pais FROM pais WHERE'.$strWhere.' activo = 1 ORDER BY nombre_pais'.$strPerPage.$strPage;
    
    $result = $this->db->query($sqlQuery);
    return $result;
  }

  function getNumTotalPais($campo, $criterio, $valor)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->setWhere($campo, $criterio, $valor);
    }
    $sqlQuery = 'SELECT COUNT(pais_id) as total FROM pais WHERE'.$strWhere.' activo = 1';
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result->total;
  }

  function getPais($paisId)
  {
    $sqlQuery = 'SELECT pais_id, nombre_pais, nacionalidad_pais, usuario_id, ult_mod, activo FROM pais WHERE pais_id = '.$paisId;
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result;
  }

  function insertPais($strPais, $strNacionalidad, $strActivo)
  {
    /*$this->nombre_pais = $strPais;
    $this->nacionalidad_pais = $strNacionalidad;
    $this->usuario_id = '1'; //ojo arreglar
    $this->ult_mod = '2009-01-01';
    $this->activo = '1';
    
     * $this->db->insert('pais', $this);
     return 0;
     */

        $data['nombre_pais']      =$strPais;
        $data['nacionalidad_pais']=$strNacionalidad;
        $data['usuario_id']       ='1';
        $data['activo']           ='1';
        $nom_tabla='pais';

        $consulta = "select * from ins_$nom_tabla(".$this->Mfrmclass->CreaParametros($data).")";
         // print_r($consulta);
         return $this->db->query($consulta);

    
   
  }

  function updatePais($strId, $strPais, $strNacionalidad, $strActivo)
  {
    $strQuery = 'SELECT upd_pais('.$strId.',\''.$strPais.'\',\''.$strNacionalidad.'\',1,\'2009-01-01\',1);';
    $result = $this->db->query($strQuery);
    $result = $result->row();
    return 0;
  }

  function deletePais($strId)
  {
    $strQuery = 'SELECT del_pais('.$strId.');';
    $result = $this->db->query($strQuery);
    $result = $result->row();
    return 0;
  }
}

?>
