<?php
/**
 * @property CI_Loader $load
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property CI_Email $email
 * @property CI_DB_active_record $db
 * @property CI_DB_forge $dbforge
 */

class BecaModel extends Model
{
    
	function BecaModel()
	{
	   parent::Model();
       $this->load->database();
       $this->load->library('JELGeneral');
	}

  function getAllBeca($campo, $criterio, $valor, $page, $perPage)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->jelgeneral->setWhere($campo, $criterio, $valor);
    }

    $strPerPage = ($perPage == '') ? '' : ' LIMIT '.$perPage;

    $strPage = ($page == '') ? '' : ' OFFSET '.$page;

    $sqlQuery = 'SELECT * FROM vis_beca WHERE'.$strWhere.' activo = 1 ORDER BY nombre_tipo_beca, nombre_beca'.$strPerPage.$strPage;

    $result = $this->db->query($sqlQuery);
    return $result;
  }

   function getNumTotalBeca($campo, $criterio, $valor)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->jelgeneral->setWhere($campo, $criterio, $valor);
    }
    $sqlQuery = 'SELECT COUNT(beca_id) as total FROM beca WHERE'.$strWhere.' activo = 1';
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result->total;
  }

  function getBeca($Id)
  {
    $sqlQuery = 'SELECT * FROM beca WHERE beca_id = '.$Id;
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result;
  }

  function insertBeca($datos)
  {
      $strQuery = 'SELECT ins_beca('.$datos['tipo_beca_id'].',\''.$datos['nombre_beca'].'\','.$datos['combinable_beca'].
                 ','.$datos['monto_beca'].',1,1);';
      $result = $this->db->query($strQuery);
      $result = $result->row();
      return 0;
  }

  function updateBeca($datos)
  {

    $strQuery = 'SELECT upd_beca('.$datos['beca_id'].','.$datos['tipo_beca_id'].',\''.$datos['nombre_beca'].'\','.$datos['combinable_beca'].
                 ','.$datos['monto_beca'].',1,1);';
    $result = $this->db->query($strQuery);
    $result = $result->row();
    return 0;
  }

  function deleteBeca($strId)
  {
    $strQuery = 'SELECT del_beca('.$strId.');';
    $result = $this->db->query($strQuery);
    $result = $result->row();
    return 0;
  }
  
}

?>
