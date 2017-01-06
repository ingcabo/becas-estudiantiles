<?php
/**
 * @property CI_Loader $load
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property CI_Email $email
 * @property CI_DB_active_record $db
 * @property CI_DB_forge $dbforge
 */

class tipoPeriodoModel extends Model
{
  	function tipoPeriodoModel()
	{
		parent::Model();		
        $this->load->database();
        $this->load->library('JELGeneral');
	}

    function getAllTipoPeriodo($campo, $criterio, $valor, $page, $perPage)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->jelgeneral->setWhere($campo, $criterio, $valor);
    }

    $strPerPage = ($perPage == '') ? '' : ' LIMIT '.$perPage;

    $strPage = ($page == '') ? '' : ' OFFSET '.$page;

    $sqlQuery = 'SELECT modalidad_id, nombre_modalidad, tipo_periodo_id, nombre_tipo_periodo FROM vis_tipo_periodo WHERE'.$strWhere.' activo = 1 ORDER BY nombre_tipo_periodo'.$strPerPage.$strPage;

    $result = $this->db->query($sqlQuery);
    return $result;
  }

  function getNumTotalTipoPeriodo($campo, $criterio, $valor)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->jelgeneral->setWhere($campo, $criterio, $valor);
    }
    $sqlQuery = 'SELECT COUNT(tipo_periodo_id) as total FROM vis_tipo_periodo WHERE'.$strWhere.' activo = 1';
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result->total;
  }

  function getTipoPeriodo($tipoPeriodoId)
  {
    $sqlQuery = 'SELECT * FROM vis_tipo_periodo WHERE tipo_periodo_id = '.$tipoPeriodoId;
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result;
  }

  function insertTipoPeriodo($strModalidadId, $strNombreTipoPeriodo)
  {
      $strQuery = 'SELECT ins_tipo_periodo(\''.$strModalidadId.'\',\''.$strNombreTipoPeriodo.'\',1,1);';
      $result = $this->db->query($strQuery);
      $result = $result->row();
      return 0;
  }

  function updateTipoPeriodo($strId, $strModalidadId, $strNombreTipoPeriodo, $strActivo)
  {
    $strQuery = 'SELECT upd_tipo_periodo('.$strId.','.$strModalidadId.',\''.$strNombreTipoPeriodo.'\',1,'.$strActivo.');';
    $result = $this->db->query($strQuery);
    $result = $result->row();
    return 0;
  }

  function deleteTipoPeriodo($strId)
  {
    $strQuery = 'SELECT del_tipo_periodo('.$strId.');';
    $result = $this->db->query($strQuery);
    $result = $result->row();
    return 0;
  }
}

?>
