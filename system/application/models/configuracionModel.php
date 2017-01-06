<?php
/**
 * @property CI_Loader $load
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property CI_Email $email
 * @property CI_DB_active_record $db
 * @property CI_DB_forge $dbforge
 */

class configuracionModel extends Model
{
    
	function configuracionModel()
	{
		parent::Model();

    $this->load->database();
     $this->load->library('JELGeneral');
	}

  function getProcedenciaIdCenso()
  {
    $sqlQuery = 'SELECT MAX(tipo_procedencia_id_censo) as tipo_procedencia_id_censo FROM configuracion';
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    $result = $result->tipo_procedencia_id_censo;
    return $result;
  }

  function getEstadoPersonaIdActivo()
  {
    $sqlQuery = 'SELECT MAX(estado_persona_id_activo) as estado_persona_id_activo FROM configuracion';
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    $result = $result->estado_persona_id_activo;
    return $result;
  }
}

?>
