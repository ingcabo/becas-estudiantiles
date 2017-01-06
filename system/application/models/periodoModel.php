<?php
class periodoModel extends Model
{

	function periodoModel()
	{
		parent::Model();
		$this->load->library('JELGeneral');
        $this->load->database();
	}


  function getAllPeriodo($campo, $criterio, $valor, $page, $perPage)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->jelgeneral->setWhere($campo, $criterio, $valor);
    }

    $strPerPage = ($perPage == '') ? '' : ' LIMIT '.$perPage;

    $strPage = ($page == '') ? '' : ' OFFSET '.$page;

    $sqlQuery = 'SELECT * FROM vis_periodo WHERE'.$strWhere.' activo = 1 ORDER BY ano_periodo DESC, parcial_periodo ASC'.$strPerPage.$strPage;

    $result = $this->db->query($sqlQuery);
    return $result;
  }

  function getNumTotalPeriodo($campo, $criterio, $valor)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->jelgeneral->setWhere($campo, $criterio, $valor);
    }
    $sqlQuery = 'SELECT COUNT(periodo_id) as total FROM vis_periodo WHERE'.$strWhere.' activo = 1';
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result->total;
  }

  function getPeriodo($periodoId)
  {
    $sqlQuery = 'SELECT * FROM vis_periodo WHERE periodo_id = '.$periodoId;
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result;
  }

  function insertPeriodo($strTipoPeriodoId, $strParcialPeriodo, $strAnoPeriodo, $strVisible)
  {
      $strQuery = 'SELECT ins_periodo(\''.$strTipoPeriodoId.'\',\''.$strParcialPeriodo.'\','.$strAnoPeriodo.','.$strVisible.',1,1);';
      $result = $this->db->query($strQuery);
      $result = $result->row();
      return 0;
  }

  function updatePeriodo($strId, $strTipoPeriodoId, $strParcialPeriodo,$strAnoPeriodo, $strVisible)
  {
    $strQuery = 'SELECT upd_periodo('.$strId.','.$strTipoPeriodoId.',\''.$strParcialPeriodo.'\','.$strAnoPeriodo.','.$strVisible.',1,1);';
    $result = $this->db->query($strQuery);
    $result = $result->row();
    return 0;
  }

  function deletePeriodo($strId)
  {
    $strQuery = 'SELECT del_periodo('.$strId.');';
    $result = $this->db->query($strQuery);
    $result = $result->row();
    return 0;
  }
}

?>
