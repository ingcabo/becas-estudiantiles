<?php
/**
 * @property CI_Loader $load
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property CI_Email $email
 * @property CI_DB_active_record $db
 * @property CI_DB_forge $dbforge
 */

class tipoProcedenciaModel extends Model
{
  var $nombre_topo_procedencia = '';
  var $usuario_id = '';
  var $ult_mod = '';
  var $activo = '';

	function tipoProcedenciaModel()
	{
		parent::Model();
        $this->load->database();
        $this->load->library('JELGeneral');
	}

  function getAllTipoProcedencia($campo, $criterio, $valor, $page, $perPage)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->jelgeneral->setWhere($campo, $criterio, $valor);
    }

    $strPerPage = ($perPage == '') ? '' : ' LIMIT '.$perPage;

    $strPage = ($page == '') ? '' : ' OFFSET '.$page;

    $sqlQuery = 'SELECT * FROM vis_tipo_procedencia WHERE'.$strWhere.' activo = 1 ORDER BY nombre_tipo_procedencia'.$strPerPage.$strPage;

    $result = $this->db->query($sqlQuery);
    return $result;
  }

  function getNumTotalTipoProcedencia($campo, $criterio, $valor)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->jelgeneral->setWhere($campo, $criterio, $valor);
    }
    $sqlQuery = 'SELECT COUNT(tipo_procedencia_id) as total FROM vis_tipo_procedencia WHERE'.$strWhere.' activo = 1';
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result->total;
  }

  function getTipoProcedencia($tipoProcedenciaId)
  {
    $sqlQuery = 'SELECT * FROM vis_tipo_procedencia WHERE tipo_procedencia_id = '.$tipoProcedenciaId;
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result;
  }

  function insertTipoProcedencia($strNombreTipoProcedencia)
  {
    //--------
    $strQuery = 'SELECT ins_tipo_procedencia(\''.$strNombreTipoProcedencia.'\',1,1);';
    $result = $this->db->query($strQuery);
    $result = $result->row();
    return 0;
  }

  function updateTipoProcedencia($strId, $strNombreTipoProcedencia, $strActivo)
  {
    $strQuery = 'SELECT upd_tipo_procedencia('.$strId.',\''.$strNombreTipoProcedencia.'\',1,'.$strActivo.');';
    $result = $this->db->query($strQuery);
    $result = $result->row();
    return 0;
  }

  function deleteTipoProcedencia($strId)
  {
    $strQuery = 'SELECT del_tipo_procedencia('.$strId.');';
    $result = $this->db->query($strQuery);
    $result = $result->row();
    return 0;
  }
}

?>
