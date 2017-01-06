<?php
class Institutomodel extends Model
{

	function Institutomodel(){
		parent::Model();
		$this->load->library('JELGeneral');
	}


  function getAllInstituto($campo, $criterio, $valor, $page, $perPage)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->jelgeneral->setWhere($campo, $criterio, $valor);
    }

    $strPerPage = ($perPage == '') ? '' : ' LIMIT '.$perPage;

    $strPage = ($page == '') ? '' : ' OFFSET '.$page;

    $sqlQuery = 'SELECT * FROM vis_instituto WHERE'.$strWhere.' activo = 1 ORDER BY nombre_instituto'.$strPerPage.$strPage;

    $result = $this->db->query($sqlQuery);
    return $result;
  }

  function getNumTotalInstituto($campo, $criterio, $valor)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->jelgeneral->setWhere($campo, $criterio, $valor);
    }
    $sqlQuery = 'SELECT COUNT(instituto_id) as total FROM vis_instituto WHERE'.$strWhere.' activo = 1';
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result->total;
  }

  function getInstituto($periodoId)
  {
    $sqlQuery = 'SELECT * FROM vis_instituto WHERE instituto_id = '.$periodoId;
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result;
  }

  function insertInstituto($nombre_instituto, $siglas_instituto,$rif_instituto,$rector_instituto,$unidad_credito_instituto)
  {
      $strQuery = 'SELECT ins_instituto(\''.$nombre_instituto.'\',\''.$siglas_instituto.'\',\''.$rif_instituto.'\',\''.$rector_instituto.'\','.$unidad_credito_instituto.',1,1);';
      $result = $this->db->query($strQuery);
      $result = $result->row();
      return 0;
  }

  function updateInstituto($institutoId, $nombre_instituto, $siglas_instituto,$rif_instituto,$rector_instituto,$unidad_credito_instituto)
  {
    $strQuery = 'SELECT upd_instituto('.$institutoId.',\''.$nombre_instituto.'\',\''.$siglas_instituto.'\',\''.$rif_instituto.'\',\''.$rector_instituto.'\','.$unidad_credito_instituto.',1,1);';
    $result = $this->db->query($strQuery);
    $result = $result->row();
    return 0;
  }

  function deleteInstituto($strId)
  {
    $strQuery = 'SELECT del_instituto('.$strId.');';
    $result = $this->db->query($strQuery);
    $result = $result->row();
    return 0;
  }
}

?>
