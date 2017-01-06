<?php
class estadoModel extends Model
{

	function estadoModel()
	{
		parent::Model();
		$this->load->library('JELGeneral');
        $this->load->database();
	}


  function getAllEstado($campo, $criterio, $valor, $page, $perPage)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->jelgeneral->setWhere($campo, $criterio, $valor);
    }

    $strPerPage = ($perPage == '') ? '' : ' LIMIT '.$perPage;

    $strPage = ($page == '') ? '' : ' OFFSET '.$page;

    $sqlQuery = 'SELECT pais_id, nombre_pais, estado_id, nombre_estado FROM vis_estado WHERE'.$strWhere.' activo = 1 ORDER BY nombre_estado'.$strPerPage.$strPage;

    $result = $this->db->query($sqlQuery);
    return $result;
  }

  function getNumTotalEstado($campo, $criterio, $valor)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->jelgeneral->setWhere($campo, $criterio, $valor);
    }
    $sqlQuery = 'SELECT COUNT(estado_id) as total FROM vis_estado WHERE'.$strWhere.' activo = 1';
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result->total;
  }

  function getEstado($estadoId)
  {
    $sqlQuery = 'SELECT pais_id, nombre_pais, estado_id, nombre_estado, usuario_id, ult_mod, activo FROM vis_estado WHERE estado_id = '.$estadoId;
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result;
  }

  function insertEstado($strPaisId, $strNombreEstado)
  {
      $strQuery = 'SELECT ins_estado(\''.$strPaisId.'\',\''.$strNombreEstado.'\',1,1);';
      $result = $this->db->query($strQuery);
      $result = $result->row();
      return 0;
  }

  function updateEstado($strId, $strPaisId, $strNombreEstado, $strActivo)
  {
    $strQuery = 'SELECT upd_estado('.$strId.','.$strPaisId.',\''.$strNombreEstado.'\',1,\'2009-01-01\',1);';
    $result = $this->db->query($strQuery);
    $result = $result->row();
    return 0;
  }

  function deleteEstado($strId)
  {
    $strQuery = 'SELECT del_estado('.$strId.');';
    $result = $this->db->query($strQuery);
    $result = $result->row();
    return 0;
  }
}

?>
