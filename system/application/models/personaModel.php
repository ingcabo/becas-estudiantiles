<?php
class personaModel extends Model
{

  var $nombre_tabla    = '';
  var $condicion_valor = '';
 
  function personaModel()
	{
		parent::Model();

    //$this->load->scaffolding('blog');
    //$this->load->library('JELGeneral');
    $this->load->database();
    
	}


  function getFiltroPersona($cedPersona)
  {
    $strVerif ='';
    $sqlQuery = "SELECT descripcion_verificacion  ".
                  "FROM verificacion ".
                  "WHERE persona_id = (SELECT persona_id FROM persona WHERE cedula_persona = '".$cedPersona."')".
                  "UNION ".
                  "SELECT 'LA PERSONA ES O HA SIDO BENEFICIARIO DEL JEL' as descripcion_verificacion ".
                  "FROM vis_beca_persona ".
                  "WHERE cedula_persona = '".$cedPersona."' ".
                  "UNION ".
                  "SELECT 'LA PERSONA APARECE COMO GANADOR EN UN SORTEO' as descripcion_verificacion ".
                  "FROM vis_sorteo_persona ".
                  "WHERE cedula_persona = '".$cedPersona."' ";
    $result = $this->db->query($sqlQuery);
     if($result->num_rows()!=0)
     {
       foreach($result->result() as $row)
       {
         $strVerif = $strVerif .' - '.$row->descripcion_verificacion;
       }
     }
    
    return $strVerif;
  }

  function setCampo($strCampo)
  {
    return 'upper('.$strCampo.')';
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


  function setwhere($campo, $criterio, $valor)
  {
    return ' '.$this->setCampo($campo).' '.$this->setCriterio($criterio, $valor).' AND ';
  }

  function getAllPersona($campo, $criterio, $valor, $page, $perPage)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->setWhere($campo, $criterio, $valor);
    }

    $strPerPage = ($perPage == '') ? '' : ' LIMIT '.$perPage;

    $strPage = ($page == '') ? '' : ' OFFSET '.$page;

    $sqlQuery = 'SELECT  '/* persona_id, nacionalidad, pais_id, estado_id, municipio_id, parroquia_id, representante_id,
                nombre_representante, apellido_representante, banco_id, tipo_cedula_persona, cedula_persona,
                nombre_persona, apellido_persona, fecha_nacimiento_persona, telefono01_persona, telefono02_persona,
                telefono03_persona, telefono04_persona, direccion01_persona, direccion02_persona, direccion03_persona,
                email_persona, sexo_persona, tipo_cuenta_persona, numero_cuenta_persona, usuario_id, ult_mod, activo
                */.' * FROM vis_'.$this->personaModel->nombre_tabla.'  WHERE  '
                .$strWhere.' activo = 1  '.$this->personaModel->condicion_valor.'   ORDER BY nombre_persona, apellido_persona, cedula_persona'.$strPerPage.$strPage;

    $result = $this->db->query($sqlQuery);

  //  print_r($result);
    return $result;
  }

  function getNumTotalPersona($campo, $criterio, $valor)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->setWhere($campo, $criterio, $valor);
    }
    $sqlQuery = 'SELECT COUNT(persona_id) as total FROM  vis_'.$this->personaModel->nombre_tabla.'  WHERE '.$strWhere.' activo = 1  '.$this->personaModel->condicion_valor;
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result->total;
  }

  function getPersona($personaId)
  {
    $sqlQuery = 'SELECT '/*persona_id, nacionalidad, pais_id, estado_id, municipio_id, parroquia_id, representante_id,
                nombre_representante, apellido_representante, banco_id, tipo_cedula_persona, cedula_persona,
                nombre_persona, apellido_persona, fecha_nacimiento_persona, telefono01_persona, telefono02_persona,
                telefono03_persona, telefono04_persona, direccion01_persona, direccion02_persona, direccion03_persona,
                email_persona, sexo_persona, tipo_cuenta_persona, numero_cuenta_persona, usuario_id, ult_mod, activo
                */.'*  FROM vis_'.$this->personaModel->nombre_tabla.' WHERE persona_id = '.$personaId;
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result;
  }

  function insertPersona($paisId, $parroquiaId, $representanteId, $bancoId, $tipoCedulaPersona,
                         $cedulaPersona, $nombrePersona, $apellidoPersona, $telefono01Persona,
                         $telefono02Persona, $telefono03Persona, $telefono04Persona, $direccion01Persona,
                         $direccion02Persona, $direccion03Persona, $emailPersona, $sexoPersona,
                         $tipoCuentaPersona, $numeroCuentaPersona, $activo, $fechaNacimientoPersona)
  {
    
    $representanteId = $representanteId == '-1' ? 'null' : $representanteId;
    $tipoCuentaPersona = $tipoCuentaPersona == '-1' ? 'null' : $tipoCuentaPersona;
    $bancoId = $bancoId == '-1' ? 'null' : $bancoId;
    $strQuery = 'SELECT ins_persona('.$paisId.','.$parroquiaId.','.$representanteId.','.$bancoId.',\''.
                $tipoCedulaPersona.'\',\''.$cedulaPersona.'\',\''.$nombrePersona.'\',\''.$apellidoPersona.'\',\''.
                $telefono01Persona.'\',\''.$telefono02Persona.'\',\''.$telefono03Persona.'\',\''.
                $telefono04Persona.'\',\''.$direccion01Persona.'\',\''.$direccion02Persona.'\',\''.
                $direccion03Persona.'\',\''.$emailPersona.'\',\''.$sexoPersona.'\','.$tipoCuentaPersona.',\''.
                $numeroCuentaPersona.'\',1,'.$activo.',\''.$fechaNacimientoPersona.'\');';
    $result = $this->db->query($strQuery);
    $result = $result->row();
    return 0;
  }

  function updatePersona($id, $paisId, $parroquiaId, $representanteId, $bancoId, $tipoCedulaPersona,
                         $cedulaPersona, $nombrePersona, $apellidoPersona, $telefono01Persona,
                         $telefono02Persona, $telefono03Persona, $telefono04Persona, $direccion01Persona,
                         $direccion02Persona, $direccion03Persona, $emailPersona, $sexoPersona,
                         $tipoCuentaPersona, $numeroCuentaPersona, $activo, $fechaNacimientoPersona)
  {

echo $bancoId;

    $representanteId = $representanteId == '-1' ? 'null' : $representanteId;
    $tipoCuentaPersona = $tipoCuentaPersona == '-1' ? 'null' : $tipoCuentaPersona;
    $bancoId = $bancoId == '-1' ? 'null' : $bancoId;
    $strQuery = 'SELECT upd_persona('.$id.','.$paisId.','.$parroquiaId.','.$representanteId.','.$bancoId.',\''.
                $tipoCedulaPersona.'\',\''.$cedulaPersona.'\',\''.$nombrePersona.'\',\''.$apellidoPersona.'\',\''.
                $telefono01Persona.'\',\''.$telefono02Persona.'\',\''.$telefono03Persona.'\',\''.
                $telefono04Persona.'\',\''.$direccion01Persona.'\',\''.$direccion02Persona.'\',\''.
                $direccion03Persona.'\',\''.$emailPersona.'\',\''.$sexoPersona.'\','.$tipoCuentaPersona.',\''.
                $numeroCuentaPersona.'\',1,'.$activo.',\''.$fechaNacimientoPersona.'\');';
    $result = $this->db->query($strQuery);
    $result = $result->row();
    return 0;
  }

  function deletePersona($strId)
  {
    $strQuery = 'SELECT del_persona('.$strId.');';
    $result = $this->db->query($strQuery);
    $result = $result->row();
    return 0;
  }
}

?>
