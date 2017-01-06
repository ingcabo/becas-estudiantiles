<?php
class procedenciaModel extends Model
{
  
	function procedenciaModel()
	{
		parent::Model();
    $this->load->database();
    $this->load->library('JELGeneral');
	}

  function getAllProcedencia($campo, $criterio, $valor, $page, $perPage)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->JELGeneral->setWhere($campo, $criterio, $valor);
    }

    $strPerPage = ($perPage == '') ? '' : ' LIMIT '.$perPage;

    $strPage = ($page == '') ? '' : ' OFFSET '.$page;

    $sqlQuery = 'SELECT procedencia_id, contacto_id, nombre_persona, apellido_persona, tipo_procedencia_id,
                 nombre_tipo_procedencia, organismo_id, siglas_organismo, fecha_procedencia, estado_id,
                 nombre_estado, municipio_id, nombre_municipio, parroquia_id, nombre_parroquia,
                 lugar_procedencia, instruccion_procedencia, usuario_id, ult_mod, activo
                 FROM vis_procedencia WHERE'.$strWhere.' activo = 1
                 ORDER BY fecha_procedencia DESC, nombre_tipo_procedencia ASC, lugar_procedencia ASC'.$strPerPage.$strPage;

    $result = $this->db->query($sqlQuery);
    return $result;
  }

  function getNumTotalProcedencia($campo, $criterio, $valor)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->JELGeneral->setWhere($campo, $criterio, $valor);
    }
    $sqlQuery = 'SELECT COUNT(procedencia_id) as total FROM vis_procedencia WHERE'.$strWhere.' activo = 1';
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result->total;
  }

  function getProcedencia($procedenciaId)
  {
    $sqlQuery = 'SELECT procedencia_id, tipo_procedencia_id, nombre_tipo_procedencia, fecha_procedencia,
    pais_id, estado_id, municipio_id, parroquia_id, lugar_procedencia, instruccion_procedencia, contacto_id, nombre_persona,
    apellido_persona, usuario_id, ult_mod, activo FROM vis_procedencia WHERE procedencia_id = '.$procedenciaId;
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result;
  }

  function insertProcedencia( $contactoId, $tipoProcedenciaId, $organismoId, $fechaProcedencia,
                              $lugarProcedencia, $instruccionProcedencia, $usuarioId, $strActivo, $parroquiaId)
  {

    $contactoId = $contactoId = '-1' ? 'null' : $contactoId;
    $strQuery = 'SELECT ins_procedencia('.$contactoId.',\''.$tipoProcedenciaId.'\',\''.$organismoId.'\',\''
                .$fechaProcedencia.'\',\''.$lugarProcedencia.'\',\''.$instruccionProcedencia.'\','.$usuarioId.','
                .$strActivo.','.$parroquiaId.');';
    $result = $this->db->query($strQuery);
    $result = $result->row();
    return 0;
  }

  function updateProcedencia($procedenciaId, $contactoId, $tipoProcedenciaId, $organismoId, $fechaProcedencia,
                              $lugarProcedencia, $instruccionProcedencia, $usuarioId, $strActivo, $parroquiaId)
  {
    
    $contactoId = $contactoId = '-1' ? 'null' : $contactoId;
    $strQuery = 'SELECT upd_procedencia('.$procedenciaId.','.$contactoId.','.$tipoProcedenciaId
                .','.$organismoId.',\''.$fechaProcedencia.'\',\''.$lugarProcedencia.'\',\''
                .$instruccionProcedencia.'\','.$usuarioId.','.$strActivo.','.$parroquiaId.');';
    $result = $this->db->query($strQuery);
    $result = $result->row();
    return 0;
  }

  function deleteProcedencia($strId)
  {
    $strQuery = 'SELECT del_procedencia('.$strId.');';
    $result = $this->db->query($strQuery);
    $result = $result->row();
    return 0;
  }
}

?>
