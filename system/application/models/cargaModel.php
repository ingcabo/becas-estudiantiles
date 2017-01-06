<?php
class cargaModel extends Model
{
  
	function cargaModel()
  {
		parent::Model();
    $this->load->database();
    $this->load->library('JELGeneral');
	}

  function insertActivoJEL($tipoCedulaPersona, $cedulaPersona, $sexoPersona, $nombrePersona, $apellidoPersona, $institutoId,
                              $carrera,$anoPeriodo, $parcialPeriodo, $usuarioId)
  {
    $strQuery = 'SELECT ins_activo_jel(\''.$tipoCedulaPersona.'\',\''.$cedulaPersona.'\',\''.$sexoPersona.'\',\''.
                $nombrePersona.'\',\''.$apellidoPersona.'\','.$institutoId.',\''.$carrera.'\','.$anoPeriodo.',\''.
                $parcialPeriodo.'\','.$usuarioId.');';
    //echo $strQuery;
    $result = $this->db->query($strQuery);
    $result = $result->row();
    return $result->ins_activo_jel;
  }

  
  function insertActivoNOJEL($tipoCedulaPersona, $cedulaPersona, $sexoPersona, $nombrePersona, $apellidoPersona, $institutoId,
                              $carrera,$anoPeriodo, $parcialPeriodo, $usuarioId)
  {
    $strQuery = 'SELECT ins_activo_no_jel(\''.$tipoCedulaPersona.'\',\''.$cedulaPersona.'\',\''.$sexoPersona.'\',\''.
                $nombrePersona.'\',\''.$apellidoPersona.'\','.$institutoId.',\''.$carrera.'\','.$anoPeriodo.',\''.
                $parcialPeriodo.'\','.$usuarioId.');';
    //echo $strQuery;
    $result = $this->db->query($strQuery);
    $result = $result->row();
    return $result->ins_activo_no_jel;
  }

  function insertInactivoJEL($tipoCedulaPersona, $cedulaPersona, $sexoPersona, $nombrePersona, $apellidoPersona, $institutoId,
                              $carrera,$anoPeriodo, $parcialPeriodo, $usuarioId)
  {
    $strQuery = 'SELECT ins_inactivo_jel(\''.$tipoCedulaPersona.'\',\''.$cedulaPersona.'\',\''.$sexoPersona.'\',\''.
                $nombrePersona.'\',\''.$apellidoPersona.'\','.$institutoId.',\''.$carrera.'\','.$anoPeriodo.',\''.
                $parcialPeriodo.'\','.$usuarioId.');';
    //echo $strQuery;
    $result = $this->db->query($strQuery);
    $result = $result->row();
    return $result->ins_inactivo_jel;
  }

  function insertInactivoNOJEL($tipoCedulaPersona, $cedulaPersona, $sexoPersona, $nombrePersona, $apellidoPersona, $institutoId,
                              $carrera,$anoPeriodo, $parcialPeriodo, $usuarioId)
  {
    $strQuery = 'SELECT ins_inactivo_no_jel(\''.$tipoCedulaPersona.'\',\''.$cedulaPersona.'\',\''.$sexoPersona.'\',\''.
                $nombrePersona.'\',\''.$apellidoPersona.'\','.$institutoId.',\''.$carrera.'\','.$anoPeriodo.',\''.
                $parcialPeriodo.'\','.$usuarioId.');';
    //echo $strQuery;
    $result = $this->db->query($strQuery);
    $result = $result->row();
    return $result->ins_inactivo_no_jel;
  }

   function insertEgresadoJEL($tipoCedulaPersona, $cedulaPersona, $sexoPersona, $nombrePersona, $apellidoPersona, $institutoId,
                              $carrera,$anoPeriodo, $parcialPeriodo, $usuarioId)
  {
    $strQuery = 'SELECT ins_egresado_jel(\''.$tipoCedulaPersona.'\',\''.$cedulaPersona.'\',\''.$sexoPersona.'\',\''.
                $nombrePersona.'\',\''.$apellidoPersona.'\','.$institutoId.',\''.$carrera.'\','.$anoPeriodo.',\''.
                $parcialPeriodo.'\','.$usuarioId.');';
    //echo $strQuery;
    $result = $this->db->query($strQuery);
    $result = $result->row();
    return $result->ins_egresado_jel;
  }

  function insertEgresadoNOJEL($tipoCedulaPersona, $cedulaPersona, $sexoPersona, $nombrePersona, $apellidoPersona, $institutoId,
                              $carrera,$anoPeriodo, $parcialPeriodo, $usuarioId)
  {
    $strQuery = 'SELECT ins_egresado_no_jel(\''.$tipoCedulaPersona.'\',\''.$cedulaPersona.'\',\''.$sexoPersona.'\',\''.
                $nombrePersona.'\',\''.$apellidoPersona.'\','.$institutoId.',\''.$carrera.'\','.$anoPeriodo.',\''.
                $parcialPeriodo.'\','.$usuarioId.');';
    //echo $strQuery;
    $result = $this->db->query($strQuery);
    $result = $result->row();
    return $result->ins_egresado_no_jel;
  }

  function insertInfoAcademica($tipoCedulaPersona, $cedulaPersona, $institutoId, $anoPeriodo, $parcialPeriodo,
                                $codigoMateria, $notaMateria, $siglasEstadoMateria, $turnoMateria, $usuarioId)
  {
    $strQuery = 'SELECT ins_info_academica(\''.$tipoCedulaPersona.'\',\''.$cedulaPersona.'\','.$institutoId.','.
                $anoPeriodo.',\''.$parcialPeriodo.'\',\''.$codigoMateria.'\','.$notaMateria.',\''.
                $siglasEstadoMateria.'\',\''.$turnoMateria.'\','.$usuarioId.');';
    //echo $strQuery;
    $result = $this->db->query($strQuery);
    $result = $result->row();
    return $result->ins_info_academica;
  }
  
}

?>
