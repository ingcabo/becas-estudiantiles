<?php
class sorteoModel extends Model
{

	function sorteoModel()
	{
		parent::Model();
    $this->load->database();
    $this->load->library('JELGeneral');
    $this->load->model('Mfrmclass','',TRUE);
    $this->load->model('Model_consulta','',TRUE);
 
	}


 function setCampo($strCampo)
  {
    return 'upper('.$strCampo.')';
  }

function setCriterio($strCriterio, $strValor)
  {
    switch ($strCriterio)
    {
      case 'Contenga': $result = 'LIKE \'%\' || \''.strtoupper($strValor).'\' || \'%\''; break;
      case 'Sea Igual a': $result = '= \''.strtoupper($strValor).'\''; break;
    }
    return $result;
  }


    function setwhere($campo, $criterio, $valor)
  {
    return ' '.$this->setCampo($campo).' '.$this->setCriterio($criterio, $valor).' AND ';
  }


  function getAllsorteo($campo, $criterio, $valor, $page, $perPage)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->setWhere($campo, $criterio, $valor);
    }

    $strPerPage = ($perPage == '') ? '' : ' LIMIT '.$perPage;

    $strPage = ($page == '') ? '' : ' OFFSET '.$page;

    $sqlQuery = 'SELECT *
                 FROM  '.$this->Mfrmclass->nombre_tabla.'  WHERE'.$strWhere.' activo = 1
                 ORDER BY fecha_sorteo DESC '.$strPerPage.$strPage;

    $result = $this->db->query($sqlQuery);
    return $result;
  }

  function getNumTotalsorteo($campo, $criterio, $valor)
  { //getNumTotalsorteo
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->setWhere($campo, $criterio, $valor);
    }
    $sqlQuery = 'SELECT COUNT( '.$this->Mfrmclass->nombre_tabla.'_id) as total FROM  '.$this->Mfrmclass->nombre_tabla.'  WHERE'.$strWhere.' activo = 1';
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result->total;
  }

  function getsorteo($procedenciaId)
  {
    $sqlQuery = 'SELECT * FROM   '.$this->Mfrmclass->nombre_tabla.'  WHERE  '.$this->Mfrmclass->nombre_tabla.'_id = '.$procedenciaId;
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result;
  }

  function insertsorteo()
  {
        $nom_tabla='sorteo';
       
        $datos['fecha_sorteo']     = $this->mylib_base->human_to_pg($_POST['txtFechaProcedencia']);
        $datos['lugar_sorteo']     =$_POST['txtLugar'];
        $datos['usuario_id']       ='1';
        $datos['activo']           ='1';
        $datos['parroquia_id']     =$_POST['cmbParroquia'];


         $consulta = "select * from ins_$nom_tabla(".$this->Mfrmclass->CreaParametros($datos).")";
         // print_r($consulta);
         return $this->db->query($consulta);



   
  
  }


 

  function updatesorteo($id)
  {
        $nom_tabla='sorteo';

        $datos['sorteo_id']        =$id;
        $datos['fecha_sorteo']     =$_POST['txtFechaProcedencia'];
        $datos['lugar_sorteo']     =$_POST['txtLugar'];
        $datos['usuario_id']       ='1';
        $datos['activo']           ='1';
        $datos['parroquia_id']     =$_POST['cmbParroquia'];

   
        $consulta = "select * from upd_$nom_tabla (".$this->Mfrmclass->CreaParametros($datos).")";
         // print_r($consulta);
         return $this->db->query($consulta);

  }

  function sorteo_persona_delete($sorteo,$pp_id)
  {

    $strQuery = 'SELECT del_sorteo_persona('.$sorteo.','.$pp_id.');';
 

   // print_r($strQuery);

     return $this->db->query($strQuery);
  
  }


  function insert_sorteo_per($pp_id,$sorteo_id) {
         $nom_tabla = 'sorteo_persona';

         $datos['procedencia_persona_id'] =$pp_id;
         $datos['sorteo_id']              =$sorteo_id;
         $datos['usuario_id']             ='1';
         $datos['activo']                 ='1';




         $consulta= "select * from ins_$nom_tabla (".$this->Mfrmclass->CreaParametros($datos).")";
         // print_r($consulta_cont_legal);
         return $this->db->query($consulta);

                       

     }

 function insert_postulacion($ubicart,$pp_id,$codcarta,$fechacarta,$refcart){

      $nom_tabla ='carta_postulacion';


      $datos['ubicacion_carta_id']             =$ubicart;
      $datos['procedencia_persona_id']         =$pp_id;
      $datos['codigo_carta_postulacion']       =$codcarta;
      $datos['fecha_carta_postulacion']        =$fechacarta;
      $datos['referencia_carta_postulacion']   =$refcart;
      $datos['usuario_id']                     ='1';
      $datos['activo']                         ='1';


    
         $consulta = "select * from ins_$nom_tabla (".$this->Model_consulta->CreaParametros($nom_tabla,$datos).")";
       //  print_r($consulta);
         return $this->db->query($consulta);
   
         
  }



function insert_carta($data){

         $nom_tabla ='carta_postulacion';
      
      
      $datos['ubicacion_carta_id']             =$data['ubicacion_carta_id'];
      $datos['procedencia_persona_id']         =$data['procedencia_persona_id'];
      $datos['codigo_carta_postulacion']       = $data['codigo_carta_postulacion'];
      $datos['fecha_carta_postulacion']        =$data['fecha_carta_postulacion'];
      $datos['referencia_carta_postulacion']   =$data['referencia_carta_postulacion'];
      $datos['usuario_id']                     ='1';
      $datos['activo']                         ='1';



         $consulta = "select * from ins_$nom_tabla (".$this->Model_consulta->CreaParametros($nom_tabla,$datos).")";
       //  print_r($consulta);
         return $this->db->query($consulta);


  }





 function sorteoDelete($id){

       $strQuery = 'SELECT del_sorteo('.$id.');';


     return $this->db->query($strQuery);



     
 }

     




}

?>
