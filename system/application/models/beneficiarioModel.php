<?php
class beneficiarioModel extends Model
{
 
  
	function beneficiarioModel()
  {
		parent::Model();
    $this->load->database();
    $this->load->library('JELGeneral');
	}


  function getAllBeneficiario($campo, $criterio, $valor, $page, $perPage)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->jelgeneral->setWhere($campo, $criterio, $valor);
    }

    $strPerPage = ($perPage == '') ? '' : ' LIMIT '.$perPage;
    
    $strPage = ($page == '') ? '' : ' OFFSET '.$page;
    
    $sqlQuery = 'SELECT * FROM vis_beneficiario WHERE'.$strWhere.' activo = 1 ORDER BY apellido_persona, nombre_persona, cedula_persona'.$strPerPage.$strPage;
    
    $result = $this->db->query($sqlQuery);
    return $result;
  }

  function getNumTotalBeneficiario($campo, $criterio, $valor)
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

  function getBeneficiario($becaPersonaId)
  {
    $sqlQuery = 'SELECT * FROM vis_beca_persona WHERE beca_persona_id = '.$becaPersonaId;
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    $data['beneficiario'] = $result;


    
    $sqlQuery = 'SELECT *, nombre_tipo_procedencia || \' - \' || fecha_procedencia || \' - \' || nombre_municipio_procedencia || \' - \' || lugar_procedencia || \' - \' || COALESCE(nombre_contacto, \'NA\') || COALESCE(\' - \' || apellido_contacto, \'\') as nombre_procedencia FROM vis_procedencia_persona
                WHERE procedencia_persona_id =
                (SELECT procedencia_persona_id FROM vis_beneficiario WHERE beca_persona_id = '.$becaPersonaId.')';
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    $data['procedencia'] = $result;

    $sqlQuery = 'SELECT COALESCE(fecha_sorteo || \' - \' || nombre_municipio || \' - \' || lugar_sorteo,\'NA\') as nombre_sorteo
                FROM vis_sorteo_persona
                WHERE procedencia_persona_id =
                (SELECT procedencia_persona_id FROM beca_persona WHERE beca_persona_id = '.$becaPersonaId.')'.
                ' UNION SELECT \'NA\' as nombre_sorteo';
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    $data['sorteo'] = $result;
   
    return $data;
  }

  function updateBeneficiario($personaId, $tipoCedulaPersona, $cedulaPersona, $nombrePersona, $apellidoPersona,
                              $emailPersona,  $sexoPersona, $nacionalidadPersona, $fechaNacimientoPersona,
                              $paisId, $estadoId, $municipioId, $parroquiaId, $direccion01Persona, $direccion02Persona,
                              $telefono01Persona, $telefono02Persona, $telefono03Persona, $telefono04Persona,
                              $tipoCedulaMadre, $cedulaMadre, $nombreMadre, $apellidoMadre, $tipoCedulaPadre, $cedulaPadre,
                              $nombrePadre, $apellidoPadre, $anoGrado, $promedioNota, $nroMbroNucleoFamiliar, $nroMbroMayorEdad,
                              $representanteId, $tipoCedulaRepresentante, $cedulaRepresentante, $nombreRepresentante,
                              $apellidoRepresentante, $bancoId, $tipoCuentaPersona, $numeroCuentaPersona, $nroHijo,
                              $usuarioId, $becaPersonaId, $contactadoBeca, $retiroCartaBeca, $inscritoBeca, $continuidadBeca)
  {

    $representanteId = $representanteId == '-1' ? 'null' : $representanteId;
    $representanteId = $representanteId == '' ? 'null' : $representanteId;
    $tipoCuentaPersona = $tipoCuentaPersona == '-1' ? 'null' : $tipoCuentaPersona;
    $bancoId = $bancoId == '-1' ? 'null' : $bancoId;
    $tipoCedulaMadre = $tipoCedulaMadre == '-1' ? '' : $tipoCedulaMadre;
    $tipoCedulaPadre = $tipoCedulaPadre == '-1' ? '' : $tipoCedulaPadre;
    $tipoCedulaRepresentante = $tipoCedulaRepresentante == '-1' ? '' : $tipoCedulaRepresentante;
    $nroHijo = $nroHijo == '' ? '0' : $nroHijo;



    $strQuery = 'SELECT upd_beneficiario('.$personaId.',\''.$tipoCedulaPersona.'\',\''.$cedulaPersona.'\',\''.$nombrePersona.'\',\''.
                $apellidoPersona.'\',\''.$emailPersona.'\',\''.$sexoPersona.'\','.$nacionalidadPersona.',\''.
                $fechaNacimientoPersona.'\','.$paisId.','.$estadoId.','.$municipioId.','.$parroquiaId.',\''.
                $direccion01Persona.'\',\''.$direccion02Persona.'\',\''.$telefono01Persona.'\',\''.$telefono02Persona.'\',\''.
                $telefono03Persona.'\',\''.$telefono04Persona.'\',\''.$tipoCedulaMadre.'\',\''.$cedulaMadre.'\',\''.
                $nombreMadre.'\',\''.$apellidoMadre.'\',\''.$tipoCedulaPadre.'\',\''.$cedulaPadre.'\',\''.$nombrePadre.'\',\''.
                $apellidoPadre.'\','.$anoGrado.','.$promedioNota.','.$nroMbroNucleoFamiliar.','.$nroMbroMayorEdad.','.
                $representanteId.',\''.$tipoCedulaRepresentante.'\',\''.$cedulaRepresentante.'\',\''.
                $nombreRepresentante.'\',\''.$apellidoRepresentante.'\','.$bancoId.','.$tipoCuentaPersona.',\''.
                $numeroCuentaPersona.'\','.$nroHijo.','.$usuarioId.','.$becaPersonaId.','.
                $contactadoBeca.','.$retiroCartaBeca.','.$inscritoBeca.','.$continuidadBeca.');';


    //echo $strQuery;
    $result = $this->db->query($strQuery);
    $result = $result->row();
    return 0;

  }


  function deleteBeneficiario($strId)
  {
    $strQuery = 'SELECT del_beca_persona('.$strId.');';
    $result = $this->db->query($strQuery);
    $result = $result->row();
    return 0;
  }
  
}

?>
