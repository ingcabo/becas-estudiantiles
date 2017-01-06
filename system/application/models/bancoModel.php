<?php
/**
 * @property CI_Loader $load
 * @property CI_Form_validation $form_validation
 * @property CI_Input $input
 * @property CI_Email $email
 * @property CI_DB_active_record $db
 * @property CI_DB_forge $dbforge
 */

class bancoModel extends Model
{
    
	function bancoModel()
	{
		parent::Model();

    $this->load->database();
     $this->load->library('JELGeneral');
	}

  function getAllBanco($campo, $criterio, $valor, $page, $perPage)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->jelgeneral->setWhere($campo, $criterio, $valor);
    }

    $strPerPage = ($perPage == '') ? '' : ' LIMIT '.$perPage;

    $strPage = ($page == '') ? '' : ' OFFSET '.$page;

    $sqlQuery = 'SELECT * FROM vis_banco WHERE'.$strWhere.' activo = 1 ORDER BY nombre_banco'.$strPerPage.$strPage;

    $result = $this->db->query($sqlQuery);
    return $result;
  }

  function getNumTotalBanco($campo, $criterio, $valor)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->jelgeneral->setWhere($campo, $criterio, $valor);
    }
    $sqlQuery = 'SELECT COUNT(banco_id) as total FROM vis_banco WHERE'.$strWhere.' activo = 1';
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result->total;
  }

  function getBanco($bancoId)
  {
    $sqlQuery = 'SELECT * FROM vis_banco WHERE banco_id = '.$bancoId;
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result;
  }

  function insertBanco($strNombreBanco)
  {
    //--------
    $strQuery = 'SELECT ins_banco(\''.$strNombreBanco.'\',1,1);';
    $result = $this->db->query($strQuery);
    $result = $result->row();
    return 0;
  }

  function updateBanco($strId, $strNombreBanco, $strActivo)
  {
    $strQuery = 'SELECT upd_banco('.$strId.',\''.$strNombreBanco.'\',1,'.$strActivo.');';
    $result = $this->db->query($strQuery);
    $result = $result->row();
    return 0;
  }

  function deleteBanco($strId)
  {
    $strQuery = 'SELECT del_banco('.$strId.');';
    $result = $this->db->query($strQuery);
    $result = $result->row();
    return 0;
  }
}

?>
