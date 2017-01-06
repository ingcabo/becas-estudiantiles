<?php
class presupuestomodel extends Model
{

	function presupuestomodel(){
		parent::Model();
		$this->load->library('JELGeneral');
	}


  function getNumTotalpresupuesto($campo, $criterio, $valor)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->jelgeneral->setWhere($campo, $criterio, $valor);
    }
    $sqlQuery = 'SELECT COUNT(presupuesto_id) as total FROM vis_presupuesto WHERE'.$strWhere.' activo = 1';
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result->total;
  }

 function getAllPresupuesto($campo, $criterio, $valor, $page, $perPage)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->jelgeneral->setWhere($campo, $criterio, $valor);
    }

    $strPerPage = ($perPage == '') ? '' : ' LIMIT '.$perPage;

    $strPage = ($page == '') ? '' : ' OFFSET '.$page;

    $sqlQuery = 'SELECT * FROM vis_presupuesto WHERE'.$strWhere.' activo = 1 ORDER BY presupuesto_id'.$strPerPage.$strPage;

    $result = $this->db->query($sqlQuery);
    return $result;
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

    $sqlQuery = 'SELECT * FROM vis_beneficiario WHERE'.$strWhere.' beca_id = (SELECT MAX(beca_id_beca_becario) FROM configuracion) AND activo = 1 ORDER BY persona_id'.$strPerPage.$strPage;

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
    $sqlQuery = 'SELECT COUNT(procedencia_persona_id) as total FROM vis_beneficiario WHERE'.$strWhere.'  beca_id = (SELECT MAX(beca_id_beca_becario) FROM configuracion) AND   activo = 1';
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result->total;
  }



 function getpresupuesto($Id)
  {
    $sqlQuery = 'SELECT * FROM presupuesto WHERE presupuesto_id = '.$Id.' and activo = 1';
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result;
  }

function ins_presupuesto($datos){


     


      $data['periodo_id']            = $datos['periodo_id'];
      $data['beca_persona_id']       = $datos['beca_persona_id'];
      $data['estado_presupuesto_id'] = $datos['estado_presupuesto_id'];
      $data['codigo_presupuesto']    = $datos['codigo_presupuesto'];
      $data['fecha_presupuesto']     = $this->mylib_base->human_to_pg($datos['fecha_presupuesto']);
      $data['monto_presupuesto']     = $datos['monto_presupuesto'];
      $data['usuario_id']            = '1';
      $data['activo']                = '1';
      $data['observaciones']         = $datos['observaciones'];



      $nom_tabla='presupuesto';
      $strQuery = "SELECT * from ins_$nom_tabla(".$this->Model_consulta->CreaParametros($nom_tabla,$data).")";
      $result = $this->db->query($strQuery);
      $result = $result->row();
      return 0;


}


function upd_presupuesto($datos){

    $data['presupuesto_id']             = $datos['presupuesto_id'];
    $data['periodo_id']                 = $datos['periodo_id'];
    $data['beca_persona_id']            = $datos['beca_persona_id'];
    $data['estado_presupuesto_id']      = $datos['estado_presupuesto_id'];
    $data['codigo_presupuesto']         = $datos['codigo_presupuesto'];
    $data['fecha_presupuesto']          = $this->mylib_base->human_to_pg($datos['fecha_presupuesto']);
    $data['monto_presupuesto']          = $datos['monto_presupuesto'];
    $data['usuario_id']                 = '1';
    $data['activo']                     = '1';
    $data['observaciones']              = $datos['observaciones'];



      $nom_tabla='presupuesto';
      $strQuery = "SELECT * from upd_$nom_tabla(".$this->Model_consulta->CreaParametros($nom_tabla,$data).")";
      $result = $this->db->query($strQuery);
      $result = $result->row();
      return 0;
}

function del_presupuesto($id){


    $strQuery = 'SELECT del_presupuesto('.$id.');';
     return $this->db->query($strQuery);
}




}
?>
