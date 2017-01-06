<?php
class requisitoModel extends Model {

  var $nombre_tabla      = '';

function requisitoModel()
	{
		parent::Model();
        $this->load->database();
        $this->load->model('Mfrmclass','',TRUE);
	}


function insert_requisito(){


       $nom_tabla = 'requisito';


       $data['accion_id']             = $_POST['cmbaccion'];
       $data['nombre_requisito']      = $_POST['txtrequisito'];

       if(isset($_POST['obligatorio'])){
         $data['obligatorio_requisito'] = $_POST['obligatorio'];
       }else{
         $data['obligatorio_requisito'] = '0';
       }

       $data['usuario_id'] = '1';
       $data['activo'] = $_POST['txtActivo'];





          $consulta = "select * from ins_$nom_tabla (".$this->Model_consulta->CreaParametros($nom_tabla,$data).")";
        // print_r($consulta);
          return $this->db->query($consulta);


}

function upd_requisito($id){

       $nom_tabla = 'requisito';

       $data['requisito_id']          = $id;
       $data['accion_id']             = $_POST['cmbaccion'];
       $data['nombre_requisito']      = $_POST['txtrequisito'];

       if(isset($_POST['obligatorio'])){
         $data['obligatorio_requisito'] = $_POST['obligatorio'];
       }else{
         $data['obligatorio_requisito'] = '0';
       }

       $data['usuario_id'] = '1';
       $data['activo'] = $_POST['txtActivo'];


          $consulta = "select * from upd_$nom_tabla (".$this->Model_consulta->CreaParametros($nom_tabla,$data).")";
        // print_r($consulta);
          return $this->db->query($consulta);
}


function del_requisito($id){
        
          $nom_tabla='requisito';

          $data['reqisito_id'] =$id;

          $consulta = "select * from del_$nom_tabla (".$this->Model_consulta->CreaParametros($nom_tabla,$data).")";
        //print_r($consulta);
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

  function get($Id)
  {
    
    $sqlQuery = 'SELECT * FROM   vis_'.$this->nombre_tabla.' WHERE '.$this->nombre_tabla.'_id = '.$Id;
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result;
  }



 function getcarta($Id)
  {

    $sqlQuery = 'SELECT * FROM   vis_carta_postulacion WHERE carta_postulacion_id = '.$Id;
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result;
  }












}

?>
