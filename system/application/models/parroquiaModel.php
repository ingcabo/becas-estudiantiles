<?php
class parroquiaModel extends Model
{
  
	function parroquiaModel()
	{
		parent::Model();		
        $this->load->database();
        $this->load->library('JELGeneral');
	}

  function getAllParroquia($campo, $criterio, $valor, $page, $perPage)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->jelgeneral->setWhere($campo, $criterio, $valor);
    }

    $strPerPage = ($perPage == '') ? '' : ' LIMIT '.$perPage;
    $strPage = ($page == '') ? '' : ' OFFSET '.$page;
    $sqlQuery = 'SELECT pais_id, nombre_pais, estado_id, nombre_estado, municipio_id, nombre_municipio,parroquia_id, nombre_parroquia FROM vis_parroquia WHERE'.$strWhere.' activo = 1 ORDER BY nombre_pais, nombre_estado, nombre_municipio, nombre_parroquia'.$strPerPage.$strPage;
    $result = $this->db->query($sqlQuery);
    return $result;
  }

  function getNumTotalParroquia($campo, $criterio, $valor)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->jelgeneral->setWhere($campo, $criterio, $valor);
    }
    $sqlQuery = 'SELECT COUNT(parroquia_id) as total FROM vis_parroquia WHERE'.$strWhere.' activo = 1';
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result->total;
  }

  function getParroquia($parroquiaId)
  {
    $sqlQuery = 'SELECT * FROM vis_parroquia WHERE parroquia_id = '.$parroquiaId;
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result;
  }

  function insertParroquia($strMunicipioId, $strNombreParroquia, $strActivo)
  {  
    $strQuery = 'SELECT ins_parroquia('.$strMunicipioId.',\''.$strNombreParroquia.'\',1,'.$strActivo.');';
    $result = $this->db->query($strQuery);
    $result = $result->row();
    return 0;
  }

  function updateParroquia($strId, $strMunicipioId, $strNombreParroquia, $strActivo)
  {
    $strQuery = 'SELECT upd_parroquia('.$strId.','.$strMunicipioId.',\''.$strNombreParroquia.'\',1,'.$strActivo.');';
    $result = $this->db->query($strQuery);
    $result = $result->row();
    return 0;
  }

  function deleteParroquia($strId)
  {
    $strQuery = 'SELECT del_parroquia('.$strId.');';
    $result = $this->db->query($strQuery);
    $result = $result->row();
    return 0;
  }
}

?>
