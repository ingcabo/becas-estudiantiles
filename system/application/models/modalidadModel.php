<?php
/**
 * @property CI_Loader $load
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property CI_Email $email
 * @property CI_DB_active_record $db
 * @property CI_DB_forge $dbforge
 */

class modalidadModel extends Model
{  
	function modalidadModel()
	{
		parent::Model();

    $this->load->database();
     $this->load->library('JELGeneral');
	}

  function getAllModalidad($campo, $criterio, $valor, $page, $perPage)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->jelgeneral->setWhere($campo, $criterio, $valor);
    }

    $strPerPage = ($perPage == '') ? '' : ' LIMIT '.$perPage;

    $strPage = ($page == '') ? '' : ' OFFSET '.$page;

    $sqlQuery = 'SELECT * FROM vis_modalidad WHERE'.$strWhere.' activo = 1 ORDER BY nombre_modalidad'.$strPerPage.$strPage;

    $result = $this->db->query($sqlQuery);
    return $result;
  }

  function getNumTotalModalidad($campo, $criterio, $valor)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->jelgeneral->setWhere($campo, $criterio, $valor);
    }
    $sqlQuery = 'SELECT COUNT(modalidad_id) as total FROM vis_modalidad WHERE'.$strWhere.' activo = 1';
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result->total;
  }

  function getModalidad($modalidadId)
  {
    $sqlQuery = 'SELECT * FROM vis_modalidad WHERE modalidad_id = '.$modalidadId;
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result;
  }

  function insertModalidad($strNombreModalidad,$strDescripcionModalidad)
  {
    //--------
    $strQuery = 'SELECT ins_modalidad(\''.$strNombreModalidad.'\',\''.$strDescripcionModalidad.'\',1,1);';
    $result = $this->db->query($strQuery);
    $result = $result->row();
    return 0;
  }

  function updateModalidad($strId, $strNombreModalidad,$strDescripcionModalidad, $strActivo)
  {
    $strQuery = 'SELECT upd_modalidad('.$strId.',\''.$strNombreModalidad.'\',\''.$strDescripcionModalidad.'\',1,'.$strActivo.');';
    $result = $this->db->query($strQuery);
    $result = $result->row();
    return 0;
  }

  function deleteModalidad($strId)
  {
    $strQuery = 'SELECT del_modalidad('.$strId.');';
    $result = $this->db->query($strQuery);
    $result = $result->row();
    return 0;
  }
}

?>
