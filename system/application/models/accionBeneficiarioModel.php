<?php
class accionBeneficiarioModel extends Model
{
  
	function accionBeneficiarioModel()
  {
		parent::Model();
    $this->load->database();
    $this->load->library('JELGeneral');
	}

  function getAccionIdCambioInstituto()
  {
    $sqlQuery = 'SELECT MAX(accion_id_cambio_instituto) as accion_id_cambio_instituto FROM configuracion';
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result->accion_id_cambio_instituto;
  }

  function getAccionIdCambioNucleo()
  {
    $sqlQuery = 'SELECT MAX(accion_id_cambio_nucleo) as accion_id_cambio_nucleo FROM configuracion';
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result->accion_id_cambio_nucleo;
  }

  function getAccionIdCambioCarrera()
  {
    $sqlQuery = 'SELECT MAX(accion_id_cambio_carrera) as accion_id_cambio_carrera FROM configuracion';
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result->accion_id_cambio_carrera;
  }

  function getNumTotalAccionBeneficiario($becaPersonaId, $campo, $criterio, $valor)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->jelgeneral->setWhere($campo, $criterio, $valor);
    }
    $sqlQuery = 'SELECT COUNT(procedencia_persona_id) as total FROM vis_beneficiario WHERE'.$strWhere.' activo = 1';
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result->total;
  }

  function getAllAccionBeneficiario($becaPersonaId, $campo, $criterio, $valor, $page, $perPage)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->jelgeneral->setWhere($campo, $criterio, $valor);
    }

    $strPerPage = ($perPage == '') ? '' : ' LIMIT '.$perPage;

    $strPage = ($page == '') ? '' : ' OFFSET '.$page;

    $sqlQuery = 'SELECT * FROM vis_accion_beca WHERE'.$strWhere.' activo = 1 AND beca_persona_id ='.$becaPersonaId.' ORDER BY ano_periodo, parcial_periodo, fecha_accion'.$strPerPage.$strPage;

    $result = $this->db->query($sqlQuery);
    return $result;
  }

  function insertAccionBeneficiario($accionId, $becaPersonaId, $periodoId, $fechaAccion, $razonAccion, $usuarioId, $activo, $nucleoId, $carreraId)
  {
    $strQuery = 'SELECT ins_accion_beneficiario('.$accionId.','.$becaPersonaId.','.$periodoId.',\''.
                $fechaAccion.'\',\''.$razonAccion.'\','.$usuarioId.','.$activo.','.$nucleoId.','.$carreraId.');';

    $result = $this->db->query($strQuery);
    $result = $result->row();
    return 0;
  } 
  
}

?>
