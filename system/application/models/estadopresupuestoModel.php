<?php
class estadopresupuestomodel extends Model
{

	function estadopresupuestomodel(){
		parent::Model();
		$this->load->library('JELGeneral');
            $this->load->model('Model_consulta','',TRUE);
	}


  function getNumTotalestadopresupuesto($campo, $criterio, $valor)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->jelgeneral->setWhere($campo, $criterio, $valor);
    }
    $sqlQuery = 'SELECT COUNT(estado_presupuesto_id) as total FROM estado_presupuesto WHERE'.$strWhere.' activo = 1';
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result->total;
  }

 function getAllestadopresupuesto($campo, $criterio, $valor, $page, $perPage)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->jelgeneral->setWhere($campo, $criterio, $valor);
    }

    $strPerPage = ($perPage == '') ? '' : ' LIMIT '.$perPage;

    $strPage = ($page == '') ? '' : ' OFFSET '.$page;

    $sqlQuery = 'SELECT * FROM estado_presupuesto WHERE'.$strWhere.' activo = 1 ORDER BY nombre_estado_presupuesto'.$strPerPage.$strPage;

    $result = $this->db->query($sqlQuery);
    return $result;
  }

 function getestadopresupuesto($Id)
  {
    $sqlQuery = 'SELECT * FROM estado_presupuesto WHERE estado_presupuesto_id = '.$Id.' and activo = 1';
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result;
  }


function ins_estado_presupuesto($datos){



      $nom_tabla='estado_presupuesto';

      $data['nombre_estado_presupuesto'] = $datos['nombre_estado_presupuesto'];
      $data['usuario_id'] ='1';
      $data['activo']     ='1';
      

      $strQuery = "SELECT * from ins_$nom_tabla(".$this->Model_consulta->CreaParametros($nom_tabla,$data).")";
      $result = $this->db->query($strQuery);
      $result = $result->row();
      return 0;


}



function upd_estado_presupuesto($datos){


      $data['estado_presupuesto_id']     = $datos['estado_presupuesto_id'];
      $data['nombre_estado_presupuesto'] = $datos['nombre_estado_presupuesto'];
      $data['usuario_id'] ='1';
      $data['activo']     ='1';

      $nom_tabla='estado_presupuesto';
      $strQuery = "SELECT * from upd_$nom_tabla(".$this->Model_consulta->CreaParametros($nom_tabla,$data).")";
      $result = $this->db->query($strQuery);
      $result = $result->row();
      return 0;
}





function delete_estadopresupuesto($id){

     $strQuery = 'SELECT del_estado_presupuesto('.$id.');';
     return $this->db->query($strQuery);





}




}
?>