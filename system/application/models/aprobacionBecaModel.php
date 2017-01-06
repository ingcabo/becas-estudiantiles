<?php
class aprobacionBecaModel extends Model
{

  function aprobacionBecaModel()
	{
		parent::Model();
		//$this->load->scaffolding('blog');
    $this->load->database();
    $this->load->library('JELGeneral');
	}

  function getAllaspirante($campo, $criterio, $valor, $page, $perPage)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->jelgeneral->setWhere($campo, $criterio, $valor);
    }

    $strPerPage = ($perPage == '') ? '' : ' LIMIT '.$perPage;

    $strPage = ($page == '') ? '' : ' OFFSET '.$page;

    $sqlQuery = 'SELECT procedencia_persona_id, persona_id, nacionalidad, parroquia_id, nombre_parroquia, municipio_id, nombre_municipio,
    estado_id, nombre_estado, pais_id, nombre_pais, representante_id, tipo_cedula_representante, cedula_representante,
    nombre_representante, apellido_representante, banco_id, nombre_banco, tipo_cedula_persona, cedula_persona,
    nombre_persona, apellido_persona, telefono01_persona, telefono02_persona, telefono03_persona, telefono04_persona,
    direccion01_persona, direccion02_persona, direccion03_persona, email_persona, sexo_persona, fecha_nacimiento_persona,
    ano_grado, promedio_nota, madre_persona_id, tipo_cedula_madre,cedula_madre, nombre_madre, apellido_madre,
    padre_persona_id, tipo_cedula_padre, cedula_padre, nombre_padre, apellido_padre, beca_id, nro_mbro_nucleo_familiar,
    nro_mbro_mayor_edad, fecha_solucion, liceo_id, nombre_liceo, fecha_procedencia, tipo_procedencia_id,
    nombre_tipo_procedencia, contacto_id, nombre_contacto, apellido_contacto, municipio_id_procedencia,
    nombre_municipio_procedencia, parroquia_id_procedencia, nombre_parroquia_procedencia, lugar_procedencia,
    instruccion_procedencia, tipo_cuenta_persona, numero_cuenta_persona, usuario_id, ult_mod, activo
    FROM vis_procedencia_persona WHERE'
    .$strWhere.' activo = 1 AND tipo_procedencia_id NOT IN (SELECT MAX(tipo_procedencia_id_censo) FROM configuracion)
    AND procedencia_persona_id NOT IN (SELECT procedencia_persona_id FROM aprobacion_beca WHERE activo = 1) ORDER BY nombre_tipo_procedencia ASC, fecha_procedencia DESC, nombre_persona ASC, apellido_persona ASC, cedula_persona ASC'.$strPerPage.$strPage;
    $result = $this->db->query($sqlQuery);
    return $result;
  }

  function getNumTotalAspirante($campo, $criterio, $valor)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->jelgeneral->setWhere($campo, $criterio, $valor);
    }
    $sqlQuery = 'SELECT COUNT(persona_id) as total FROM vis_procedencia_persona WHERE'.$strWhere.' activo = 1
                AND tipo_procedencia_id NOT IN (SELECT MAX(tipo_procedencia_id_censo) FROM configuracion)
                AND procedencia_persona_id NOT IN (SELECT procedencia_persona_id FROM aprobacion_beca WHERE activo = 1)';
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result->total;
  }

  function getAspirante($personaId)
  {
    $sqlQuery = 'SELECT procedencia_persona_id, persona_id, nacionalidad, parroquia_id, nombre_parroquia, municipio_id,
    nombre_municipio, estado_id, nombre_estado, pais_id, nombre_pais, representante_id, tipo_cedula_representante,
    cedula_representante, nombre_representante, apellido_representante, banco_id, nombre_banco, tipo_cedula_persona, cedula_persona,
    nombre_persona, apellido_persona, telefono01_persona, telefono02_persona, telefono03_persona, telefono04_persona,
    direccion01_persona, direccion02_persona, direccion03_persona, email_persona, sexo_persona, fecha_nacimiento_persona,
    ano_grado, promedio_nota, madre_persona_id, tipo_cedula_madre,cedula_madre, nombre_madre, apellido_madre,
    padre_persona_id, tipo_cedula_padre, cedula_padre, nombre_padre, apellido_padre, beca_id, nro_mbro_nucleo_familiar,
    nro_mbro_mayor_edad, fecha_solucion, liceo_id, nombre_liceo, procedencia_id, fecha_procedencia, tipo_procedencia_id,
    nombre_tipo_procedencia, contacto_id, nombre_contacto, apellido_contacto, municipio_id_procedencia,
    nombre_municipio_procedencia, parroquia_id_procedencia, nombre_parroquia_procedencia, lugar_procedencia,
    instruccion_procedencia, carrera, tipo_cuenta_persona, numero_cuenta_persona, usuario_id, ult_mod, activo
    FROM vis_procedencia_persona WHERE procedencia_persona_id = '.$personaId;
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result;
  }

  function insertAprobacionBeca($fechaAprobacionBeca, $id, $activo)
  {
    

    $strQuery = 'SELECT ins_aprobacion_beca(\''.$fechaAprobacionBeca.'\','.$id.',1,'.$activo.');';
    //echo($strQuery);
    $result = $this->db->query($strQuery);
    $result = $result->row();
    return $result->ins_aprobacion_beca;
  }

 
}

?>
