<?php
/**
 * @property CI_Loader $load
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property CI_Email $email
 * @property CI_DB_active_record $db
 * @property CI_DB_forge $dbforge
 */

class tipoVerificacionModel extends Model
{
    
	function tipoVerificacionModel()
	{
		parent::Model();

    $this->load->database();
     $this->load->library('JELGeneral');
	}

  function getAllTipoVerificacion($campo, $criterio, $valor, $page, $perPage)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->jelgeneral->setWhere($campo, $criterio, $valor);
    }

    $strPerPage = ($perPage == '') ? '' : ' LIMIT '.$perPage;

    $strPage = ($page == '') ? '' : ' OFFSET '.$page;

    $sqlQuery = 'SELECT * FROM vis_tipo_verificacion WHERE'.$strWhere.' activo = 1 ORDER BY nombre_tipo_verificacion'.$strPerPage.$strPage;

    $result = $this->db->query($sqlQuery);
    return $result;
  }

  function getNumTotalTipoVerificacion($campo, $criterio, $valor)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->jelgeneral->setWhere($campo, $criterio, $valor);
    }
    $sqlQuery = 'SELECT COUNT(tipo_verificacion_id) as total FROM vis_tipo_verificacion WHERE'.$strWhere.' activo = 1';
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result->total;
  }

  function getTipoVerificacion($tipoVerificacionId)
  {
    $sqlQuery = 'SELECT * FROM vis_tipo_verificacion WHERE tipo_verificacion_id = '.$tipoVerificacionId;
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result;
  }

  function insertTipoVerificacion($strNombreTipoVerificacion)
  {
    //--------
    $strQuery = 'SELECT ins_tipo_verificacion(\''.$strNombreTipoVerificacion.'\',1,1);';
    $result = $this->db->query($strQuery);
    $result = $result->row();
    return 0;
  }

  function updateTipoVerificacion($strId, $strNombreTipoVerificacion, $strActivo)
  {
    $strQuery = 'SELECT upd_tipo_verificacion('.$strId.',\''.$strNombreTipoVerificacion.'\',1,'.$strActivo.');';
    $result = $this->db->query($strQuery);
    $result = $result->row();
    return 0;
  }

  function deleteTipoVerificacion($strId)
  {
    $strQuery = 'SELECT del_tipo_verificacion('.$strId.');';
    $result = $this->db->query($strQuery);
    $result = $result->row();
    return 0;
  }
}

?>
