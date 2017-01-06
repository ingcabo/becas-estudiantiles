<?php
class carreramodel extends Model
{

	function carreramodel(){
		parent::Model();
		$this->load->library('JELGeneral');
	}

  function getAllDistinctCarrera()
  {

    $sqlQuery = 'SELECT  DISTINCT nombre_carrera FROM carrera';

    $result = $this->db->query($sqlQuery);
    return $result;
  }

  function getAllCarreraInstituto($campo, $criterio, $valor, $page, $perPage)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->jelgeneral->setWhere($campo, $criterio, $valor);
    }

    $strPerPage = ($perPage == '') ? '' : ' LIMIT '.$perPage;

    $strPage = ($page == '') ? '' : ' OFFSET '.$page;

    $sqlQuery = 'SELECT * FROM vis_carrera_instituto WHERE'.$strWhere.' activo = 1 ORDER BY nombre_carrera'.$strPerPage.$strPage;

    $result = $this->db->query($sqlQuery);
    return $result;
  }


  function getAllcarrera($campo, $criterio, $valor, $page, $perPage)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->jelgeneral->setWhere($campo, $criterio, $valor);
    }

    $strPerPage = ($perPage == '') ? '' : ' LIMIT '.$perPage;

    $strPage = ($page == '') ? '' : ' OFFSET '.$page;

    $sqlQuery = 'SELECT * FROM vis_carrera WHERE'.$strWhere.' activo = 1 ORDER BY nombre_carrera'.$strPerPage.$strPage;

    $result = $this->db->query($sqlQuery);
    return $result;
  }

  function getNumTotalcarrera($campo, $criterio, $valor)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->jelgeneral->setWhere($campo, $criterio, $valor);
    }
    $sqlQuery = 'SELECT COUNT(carrera_id) as total FROM vis_carrera WHERE'.$strWhere.' activo = 1';
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result->total;
  }

  function getcarrera($Id)
  {
    $sqlQuery = 'SELECT * FROM carrera WHERE carrera_id = '.$Id;
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result;
  }

  function insertcarrera($datos)
  {
      $strQuery = 'SELECT ins_carrera(\''.$datos['nombre_carrera'].'\',\''.$datos['descripcion_carrera'].'\',1,1);';
      $result = $this->db->query($strQuery);
      $result = $result->row();
      return 0;
  }

  function updatecarrera($datos)
  {

    $strQuery = 'SELECT upd_carrera('.$datos['carrera_id'].',\''.$datos['nombre_carrera'].'\',\''.$datos['descripcion_carrera'].'\',1,1);';
    $result = $this->db->query($strQuery);
    $result = $result->row();
    return 0;
  }

  function deletecarrera($strId)
  {
    $strQuery = 'SELECT del_carrera('.$strId.');';
    $result = $this->db->query($strQuery);
    $result = $result->row();
    return 0;
  }
}

?>
