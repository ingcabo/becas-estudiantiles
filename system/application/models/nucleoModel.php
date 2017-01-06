<?php
class Nucleomodel extends Model
{

	function Nucleomodel(){
		parent::Model();
		$this->load->library('JELGeneral');
	}


  function getAllNucleo($campo, $criterio, $valor, $page, $perPage)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->jelgeneral->setWhere($campo, $criterio, $valor);
    }

    $strPerPage = ($perPage == '') ? '' : ' LIMIT '.$perPage;

    $strPage = ($page == '') ? '' : ' OFFSET '.$page;

    $sqlQuery = 'SELECT * FROM vis_nucleo_instituto WHERE'.$strWhere.' activo = 1 ORDER BY nombre_instituto'.$strPerPage.$strPage;

    $result = $this->db->query($sqlQuery);
    return $result;
  }

  function getNumTotalNucleo($campo, $criterio, $valor)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->jelgeneral->setWhere($campo, $criterio, $valor);
    }
    $sqlQuery = 'SELECT COUNT(nucleo_instituto_id) as total FROM vis_nucleo_instituto WHERE'.$strWhere.' activo = 1';
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result->total;
  }

  function getNucleo($Id)
  {
    $sqlQuery = 'SELECT * FROM nucleo_instituto WHERE nucleo_instituto_id = '.$Id;
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result;
  }

  function insertNucleo($datos)
  {
      $strQuery = 'SELECT ins_nucleo_instituto('.$datos['instituto_id'].','.$datos['parroquia_id'].',\''.$datos['nombre_nucleo_instituto'].
                 '\',\''.$datos['siglas_nucleo_instituto'].'\',\''.$datos['direccion_nucleo_instituto'] .'\',\''.$datos['telefono01_nucleo_instituto'].
                 '\',\''.$datos['telefono02_nucleo_instituto'].'\',\''.$datos['telefono03_nucleo_instituto'].'\',\''.$datos['telefono04_nucleo_instituto'].
                 '\',\''.$datos['fax01_nucleo_instituto'].'\',\''.$datos['fax02_nucleo_instituto'].'\',\''.$datos['email01_nucleo_instituto'].
                 '\',\''.$datos['email02_nucleo_instituto'].'\',\''.$datos['contacto_01'].'\',\''.$datos['telefono_contacto_01'].
                 '\',\''.$datos['contacto_02'].'\',\''.$datos['telefono_contacto_02'].'\',1,1);';
      $result = $this->db->query($strQuery);
      $result = $result->row();
      return 0;
  }

  function updateNucleo($datos)
  {

    $strQuery = 'SELECT upd_nucleo_instituto('.$datos['nucleo_instituto_id'].','.$datos['instituto_id'].','.$datos['parroquia_id'].',\''.$datos['nombre_nucleo_instituto'].
                 '\',\''.$datos['siglas_nucleo_instituto'].'\',\''.$datos['direccion_nucleo_instituto'] .'\',\''.$datos['telefono01_nucleo_instituto'].
                 '\',\''.$datos['telefono02_nucleo_instituto'].'\',\''.$datos['telefono03_nucleo_instituto'].'\',\''.$datos['telefono04_nucleo_instituto'].
                 '\',\''.$datos['fax01_nucleo_instituto'].'\',\''.$datos['fax02_nucleo_instituto'].'\',\''.$datos['email01_nucleo_instituto'].
                 '\',\''.$datos['email02_nucleo_instituto'].'\',\''.$datos['contacto_01'].'\',\''.$datos['telefono_contacto_01'].
                 '\',\''.$datos['contacto_02'].'\',\''.$datos['telefono_contacto_02'].'\',1,1);';
    $result = $this->db->query($strQuery);
    $result = $result->row();
    return 0;
  }

  function deleteNucleo($strId)
  {
    $strQuery = 'SELECT del_nucleo_instituto('.$strId.');';
    $result = $this->db->query($strQuery);
    $result = $result->row();
    return 0;
  }
}

?>
