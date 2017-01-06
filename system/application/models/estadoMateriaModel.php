<?php
/**
 * @property CI_Loader $load
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property CI_Email $email
 * @property CI_DB_active_record $db
 * @property CI_DB_forge $dbforge
 */

class estadoMateriaModel extends Model
{  
	function estadoMateriaModel()
	{
		parent::Model();

    $this->load->database();
     $this->load->library('JELGeneral');
	}

  function getAllEstadoMateria($campo, $criterio, $valor, $page, $perPage)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->jelgeneral->setWhere($campo, $criterio, $valor);
    }

    $strPerPage = ($perPage == '') ? '' : ' LIMIT '.$perPage;

    $strPage = ($page == '') ? '' : ' OFFSET '.$page;

    $sqlQuery = 'SELECT * FROM vis_estado_materia WHERE'.$strWhere.' activo = 1 ORDER BY nombre_estado_materia'.$strPerPage.$strPage;

    $result = $this->db->query($sqlQuery);
    return $result;
  }

  function getNumTotalEstadoMateria($campo, $criterio, $valor)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->jelgeneral->setWhere($campo, $criterio, $valor);
    }
    $sqlQuery = 'SELECT COUNT(estado_materia_id) as total FROM vis_estado_materia WHERE'.$strWhere.' activo = 1';
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result->total;
  }

  function getEstadoMateria($estado_materiaId)
  {
    $sqlQuery = 'SELECT * FROM vis_estado_materia WHERE estado_materia_id = '.$estado_materiaId;
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result;
  }

  function insertEstadoMateria($strNombreEstadoMateria,$strDescripcionEstadoMateria)
  {
    //--------
    $strQuery = 'SELECT ins_estado_materia(\''.$strNombreEstadoMateria.'\',\''.$strDescripcionEstadoMateria.'\',1,1);';
    $result = $this->db->query($strQuery);
    $result = $result->row();
    return 0;
  }

  function updateEstadoMateria($strId, $strNombreEstadoMateria,$strDescripcionEstadoMateria, $strActivo)
  {
    $strQuery = 'SELECT upd_estado_materia('.$strId.',\''.$strNombreEstadoMateria.'\',\''.$strDescripcionEstadoMateria.'\',1,'.$strActivo.');';
    $result = $this->db->query($strQuery);
    $result = $result->row();
    return 0;
  }

  function deleteEstadoMateria($strId)
  {
    $strQuery = 'SELECT del_estado_materia('.$strId.');';
    $result = $this->db->query($strQuery);
    $result = $result->row();
    return 0;
  }
}

?>
