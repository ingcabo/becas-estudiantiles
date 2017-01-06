<?php
class municipioModel extends Model
{
  var $estado_id = '';
  var $nombre_municipio = '';
  var $usuario_id = '';
  var $ult_mod = '';
  var $activo = '';
  
	function municipioModel()
	{
		parent::Model();
		//$this->load->scaffolding('blog');
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

  function getAllmunicipio($campo, $criterio, $valor, $page, $perPage)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->setWhere($campo, $criterio, $valor);
    }

    $strPerPage = ($perPage == '') ? '' : ' LIMIT '.$perPage;

    $strPage = ($page == '') ? '' : ' OFFSET '.$page;

    $sqlQuery = 'SELECT pais_id, nombre_pais, estado_id, nombre_estado, municipio_id, nombre_municipio FROM vis_municipio WHERE'.$strWhere.' activo = 1 ORDER BY nombre_pais, nombre_estado, nombre_municipio'.$strPerPage.$strPage;

    $result = $this->db->query($sqlQuery);
    return $result;
  }

  function getNumTotalMunicipio($campo, $criterio, $valor)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->setWhere($campo, $criterio, $valor);
    }
    $sqlQuery = 'SELECT COUNT(municipio_id) as total FROM vis_municipio WHERE'.$strWhere.' activo = 1';
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result->total;
  }

  function getMunicipio($municipioId)
  {
    $sqlQuery = 'SELECT pais_id, nombre_pais, estado_id, nombre_estado, municipio_id, nombre_municipio, usuario_id, ult_mod, activo FROM vis_municipio WHERE municipio_id = '.$municipioId;
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result;
  }

  function insertMunicipio($strEstadoId, $strNombreMunicipio, $strActivo)
  {
    /*
    $this->estado_id = $strEstadoId;
    $this->nombre_municipio = $strNombreMunicipio;
    $this->usuario_id = '1'; //ojo arreglar
    $this->ult_mod = '2009-01-01';
    $this->activo = '1'; 
    $this->db->insert('municipio', $this);
    return 0;
    */
    $strQuery = 'SELECT ins_municipio('.$strEstadoId.',\''.$strNombreMunicipio.'\',1,\'2009-01-01\','.$strActivo.');';
    $result = $this->db->query($strQuery);
    $result = $result->row();
    return 0;
  }

  function updateMunicipio($strId, $strEstadoId, $strNombreMunicipio, $strActivo)
  {
    $strQuery = 'SELECT upd_municipio('.$strId.','.$strEstadoId.',\''.$strNombreMunicipio.'\',1,\'2009-01-01\','.$strActivo.');';
    $result = $this->db->query($strQuery);
    $result = $result->row();
    return 0;
  }

  function deleteMunicipio($strId)
  {
    $strQuery = 'SELECT del_municipio('.$strId.');';
    $result = $this->db->query($strQuery);
    $result = $result->row();
    return 0;
  }
}

?>
