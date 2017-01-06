<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */



class accionModel extends Model {

  var $nombre_tabla      = '';

function accionModel()
	{
		parent::Model();
        $this->load->database();
        $this->load->model('Mfrmclass','',TRUE);
	}


function insert_accion(){

$nom_tabla = 'accion';

$data['estado_persona_id'] = $_POST['cmb_estado_persona'];
$data['beca_id']           = $_POST['cmbbeca'];
$data['nombre_accion']     = $_POST['txtaccion'];
$data['usuario_id']        = '1';
$data['activo']            = '1';


          $consulta = "select * from ins_$nom_tabla (".$this->Model_consulta->CreaParametros($nom_tabla,$data).")";
        // print_r($consulta);
          return $this->db->query($consulta);
}


function delete_accion($id,$nom_tabla){

           $consulta = "select * from del_$nom_tabla (".$id.")";
        // print_r($consulta);
          return $this->db->query($consulta);



}

function upd_accion($id,$nom_tabla){

$data['accion_id']         = $id;
$data['estado_persona_id'] = $_POST['cmb_estado_persona'];
$data['beca_id']           = $_POST['cmbbeca'];
$data['nombre_accion']     = $_POST['txtaccion'];
$data['usuario_id']        = '1';
$data['activo']            = '1';


    

         $consulta = "select * from upd_$nom_tabla (".$this->Model_consulta->CreaParametros($nom_tabla,$data).")";
        // print_r($consulta);
          return $this->db->query($consulta);

}

 function getAll($campo, $criterio, $valor, $page, $perPage)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->Model_consulta->setWhere($campo, $criterio, $valor);
    }

    $strPerPage = ($perPage == '') ? '' : ' LIMIT '.$perPage;

    $strPage = ($page == '') ? '' : ' OFFSET '.$page;

    $sqlQuery = 'SELECT *  FROM  vis_'.$this->nombre_tabla.' WHERE'.$strWhere.' activo = 1 ORDER BY nombre_'.$this->nombre_tabla.$strPerPage.$strPage;

    $result = $this->db->query($sqlQuery);
    return $result;
  }

  function getAllAccionEstado($campo, $criterio, $valor, $page, $perPage)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->Model_consulta->setWhere($campo, $criterio, $valor);
    }

    $strPerPage = ($perPage == '') ? '' : ' LIMIT '.$perPage;

    $strPage = ($page == '') ? '' : ' OFFSET '.$page;

    $sqlQuery = 'SELECT accion_id, nombre_accion || \' -> \' || nombre_estado_persona as nombre_accion FROM  vis_accion WHERE'.$strWhere.' activo = 1 ORDER BY nombre_accion'.$strPerPage.$strPage;

    $result = $this->db->query($sqlQuery);
    return $result;
  }


 function getNumTotal($campo, $criterio, $valor)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->Model_consulta->setWhere($campo, $criterio, $valor);
    }
    $sqlQuery = 'SELECT COUNT( '.$this->nombre_tabla.'_id) as total FROM  vis_'.$this->nombre_tabla.'  WHERE'.$strWhere.' activo = 1';
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result->total;
  }

  function get($Id,$tabla)
  {
    $this->nombre_tabla = $tabla;
    $sqlQuery = 'SELECT * FROM   vis_'.$this->nombre_tabla.' WHERE '.$this->nombre_tabla.'_id = '.$Id;
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result;
  }






}

?>
