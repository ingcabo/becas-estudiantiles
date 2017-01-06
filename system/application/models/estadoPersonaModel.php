<?php
/**
 * @property CI_Loader $load
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property CI_Email $email
 * @property CI_DB_active_record $db
 * @property CI_DB_forge $dbforge
 */

class estadoPersonaModel extends Model
{
    
	function estadoPersonaModel()
	{
		parent::Model();

    $this->load->database();
     $this->load->library('JELGeneral');
	}

  function getAllEstadoPersona($campo, $criterio, $valor, $page, $perPage)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->jelgeneral->setWhere($campo, $criterio, $valor);
    }

    $strPerPage = ($perPage == '') ? '' : ' LIMIT '.$perPage;

    $strPage = ($page == '') ? '' : ' OFFSET '.$page;

    $sqlQuery = 'SELECT * FROM vis_estado_persona WHERE'.$strWhere.' activo = 1 ORDER BY nombre_estado_persona'.$strPerPage.$strPage;

    $result = $this->db->query($sqlQuery);
    return $result;
  }

  function getNumTotalEstadoPersona($campo, $criterio, $valor)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->jelgeneral->setWhere($campo, $criterio, $valor);
    }
    $sqlQuery = 'SELECT COUNT(estado_persona_id) as total FROM vis_estado_persona WHERE'.$strWhere.' activo = 1';
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result->total;
  }

  function getEstadoPersona($estadoPersonaId)
  {
    $sqlQuery = 'SELECT * FROM vis_estado_persona WHERE estado_persona_id = '.$estadoPersonaId;
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result;
  }

  function insertEstadoPersona($strNombreEstadoPersona)
  {
    //--------
    $strQuery = 'SELECT ins_estado_persona(\''.$strNombreEstadoPersona.'\',1,1);';
    $result = $this->db->query($strQuery);
    $result = $result->row();
    return 0;
  }

  function updateEstadoPersona($strId, $strNombreEstadoPersona, $strActivo)
  {
    $strQuery = 'SELECT upd_estado_persona('.$strId.',\''.$strNombreEstadoPersona.'\',1,'.$strActivo.');';
    $result = $this->db->query($strQuery);
    $result = $result->row();
    return 0;
  }

  function deleteEstadoPersona($strId)
  {
    $strQuery = 'SELECT del_estado_persona('.$strId.');';
    $result = $this->db->query($strQuery);
    $result = $result->row();
    return 0;
  }
}

?>
