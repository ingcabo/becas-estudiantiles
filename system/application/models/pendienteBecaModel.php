<?php
class pendienteBecaModel extends Model
{
 
  
	function pendienteBecaModel()
  {
		parent::Model();
    $this->load->database();
    $this->load->library('JELGeneral');
	}




function setCriterio($strCriterio, $strValor)
  {
    switch ($strCriterio)
    {
      case 'Contenga': $result = 'LIKE \'%\' || \''.strtoupper($strValor).'\' || \'%\''; break;
      case 'Sea Igual a': $result = '= \''.strtoupper($strValor).'\''; break;
    }
    return $result;
  }

function setCampo($strCampo)
  {
    return 'upper('.$strCampo.')';
  }

function setwhere($campo, $criterio, $valor)
  {
    return ' '.$this->setCampo($campo).' '.$this->setCriterio($criterio, $valor).' AND ';
  }

  function getAllPendienteBeca($campo, $criterio, $valor, $page, $perPage)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->jelgeneral->setWhere($campo, $criterio, $valor);
    }

    $strPerPage = ($perPage == '') ? '' : ' LIMIT '.$perPage;
    
    $strPage = ($page == '') ? '' : ' OFFSET '.$page;
    
    $sqlQuery = 'SELECT * FROM vis_pendiente_beca WHERE'.$strWhere.' activo = 1 ORDER BY fecha_procedencia,
    nombre_municipio_procedencia, lugar_procedencia, nombre_persona, apellido_persona, cedula_persona'.$strPerPage.$strPage;
    
    $result = $this->db->query($sqlQuery);
    return $result;
  }

  function getNumTotalPendienteBeca($campo, $criterio, $valor)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->setWhere($campo, $criterio, $valor);
    }
    $sqlQuery = 'SELECT COUNT(procedencia_persona_id) as total FROM vis_pendiente_beca WHERE'.$strWhere.' activo = 1';
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result->total;
  }

  function getPendienteBeca($tipoProcedenciaId,$procedenciaId,$procedenciaPersonaId, $sorteoId)
  {
    $sqlQuery = 'SELECT * FROM vis_pendiente_beca WHERE procedencia_persona_id = '.$procedenciaPersonaId.
                ' AND tipo_procedencia_id = '.$tipoProcedenciaId.' AND procedencia_id = '.$procedenciaId.
                ' AND sorteo_id = '.$sorteoId;

    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result;
  }

    function getAllBecaAsignada($campo, $criterio, $valor, $page, $perPage)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->jelgeneral->setWhere($campo, $criterio, $valor);
    }

    $strPerPage = ($perPage == '') ? '' : ' LIMIT '.$perPage;

    $strPage = ($page == '') ? '' : ' OFFSET '.$page;

    $sqlQuery = 'SELECT * FROM vis_beca_persona WHERE'.$strWhere.' activo = 1 ORDER BY nombre_tipo_beca, nombre_beca'.$strPerPage.$strPage;

    $result = $this->db->query($sqlQuery);
    return $result;
  }


  function insertBecaPersona($becaId, $estadoPersonaId, $procedenciaPersonaId, $fechaIngreso, $nucleoId, $carreraInstitutoId, $strActivo, $periodoId)
  {//OJO usuario ID
    $strQuery = 'SELECT ins_beca_persona('.$becaId.','.$estadoPersonaId.','.$procedenciaPersonaId.',\''.$fechaIngreso.'\',0,0,0,'.
                $nucleoId.','.$carreraInstitutoId.',1,1,'.$periodoId.');';
    $result = $this->db->query($strQuery);
    $result = $result->row();
    return 0;
  }

  
}

?>
