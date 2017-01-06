<?php
class mod_materiacarrerainstituto extends Model {

  


	function mod_materiacarrerainstituto()
	{
		parent::Model();
        $this->load->database();
        $this->load->model('Mfrmclass','',TRUE);
	}


 function getAllcarrerainstituto($campo, $criterio, $valor, $page, $perPage)
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
  function getNumTotalcarrerainstituto($campo, $criterio, $valor)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->jelgeneral->setWhere($campo, $criterio, $valor);
    }
    $sqlQuery = 'SELECT COUNT(carrera_id) as total FROM vis_carrera_instituto WHERE'.$strWhere.' activo = 1';
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result->total;
  }


//para las materias de la carrera del instituto
function getNumTotalmateriascarrera($campo, $criterio, $valor,$id)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->jelgeneral->setWhere($campo, $criterio, $valor);
    }
    $sqlQuery = 'SELECT COUNT(materia_carrera_id) as total FROM vis_materia_carrera_instituto WHERE'.$strWhere.' activo = 1 and carrera_instituto_id = '.$id.'';
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result->total;
  }


//para las materias del instituto carrera
function getAllmateriascarrera($campo, $criterio, $valor, $page, $perPage,$id)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->jelgeneral->setWhere($campo, $criterio, $valor);
    }

    $strPerPage = ($perPage == '') ? '' : ' LIMIT '.$perPage;

    $strPage = ($page == '') ? '' : ' OFFSET '.$page;

    $sqlQuery = 'SELECT * FROM vis_materia_carrera_instituto WHERE'.$strWhere.' activo = 1  and carrera_instituto_id = '.$id.'ORDER BY nombre_materia'.$strPerPage.$strPage;

    $result = $this->db->query($sqlQuery);
    return $result;
  }



//
   function getcarrerainstituto($Id)
  {
    $sqlQuery = 'SELECT * FROM vis_carrera_instituto WHERE carrera_instituto_id = '.$Id;
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result;
  }



function getmateriacarrerainstituto($Id)
  {
    $sqlQuery = 'SELECT * FROM vis_materia_carrera_instituto WHERE materia_carrera_id = '.$Id;
    $result = $this->db->query($sqlQuery);
  // print_r($result);
    $result = $result->row();
    return $result;
  }


function materias_2($id_i,$id_c,$mt_id){

$query=$this->db->query('select * from materia where materia_id not in (select materia_id from vis_materia_carrera_instituto where instituto_id = '.$id_i.'  and carrera_id = '.$id_c.' )
  or materia_id = '.$mt_id.' ORDER BY nombre_materia asc');
//print_r($query);
return ($query);
}


function materias($id_i,$id_c){

$query=$this->db->query('select * from materia where materia_id not in (select materia_id from vis_materia_carrera_instituto where instituto_id = '.$id_i.'  and carrera_id = '.$id_c.' )
 ORDER BY nombre_materia asc');
//print_r($query);
return ($query);
}

function materias_instituto_carrera($id_i,$id_c){


$query=$this->db->query('select materia_id from vis_materia_carrera_instituto where instituto_id = '.$id_i.'  and carrera_id = '.$id_c.'  order by numero_periodo');
return ($query);
}



function carrera_instituto($id){

  $query=$this->db->query('select * from vis_carrera where carrera_id not in (select carrera_id from vis_carrera_instituto where instituto_id =  '.$id.') and activo =1  order by nombre_carrera ');
  return ($query);
}

/*
function ins_materia_carrera(){



       $nom_tabla='materia_carrera';

       
        $datos['materia_id']                 ='';
        $datos['carrera_instituto_id']       ='';
        $datos['cantidad_unidad_credito']    ='';
        $datos['numero_periodo']             ='';
        $datos['usuario_id']                 ='';
        $datos['activo']                     ='';
        $datos['codigo_materia']             ='';


         $consulta = "select * from ins_$nom_tabla(".$this->Mfrmclass->CreaParametros($datos).")";
         // print_r($consulta);
         return $this->db->query($consulta);


    
}


function upd_materia_carrera($id){



        $nom_tabla='materia_carrera';
        $datos['materia_carrera_id']       =$id;
        $datos['materia_id']               ='';
        $datos['carrera_instituto_id']     ='';
        $datos['cantidad_unidad_credito']  ='';
        $datos['numero_periodo']           ='';
        $datos['usuario_id']               ='';
        $datos['activo']                   ='';
        $datos['codigo_materia']           ='';



        $consulta = "select * from upd_$nom_tabla(".$this->Mfrmclass->CreaParametros($datos).")";
         // print_r($consulta);
         return $this->db->query($consulta);

}
*/

function del_materia_carrera($id){
        $nom_tabla='materia_carrera';
        $datos['materia_carrera_id']=$id;

         $consulta = "select * from del_$nom_tabla(".$this->Mfrmclass->CreaParametros($datos).")";
         // print_r($consulta);
         return $this->db->query($consulta);
}



 function ins_carrera_instituto($datos)
  {



         $data['instituto_id']        =$datos['instituto_id'];
         $data['carrera_id']          =$datos['carrera_id'];
         $data['tipo_periodo_id']     =$datos['tipo_periodo_id'];
         $data['modalidad_id']        =$datos['modalidad_id'];
         $data['usuario_id']          ='1';
         $data['activo']              ='1';

         $nom_tabla='carrera_instituto';

      
      $strQuery = "SELECT * from ins_$nom_tabla(".$this->Model_consulta->CreaParametros($nom_tabla,$data).")";
      $result = $this->db->query($strQuery);
      $result = $result->row();
      return 0;
  }


  function upd_carrera_instituto($datos)
  {


         $data['carrera_instituto_id'] =$datos['carrera_instituto_id'];
         $data['instituto_id']         =$datos['instituto_id'];
         $data['carrera_id']           =$datos['carrera_id'];
         $data['tipo_periodo_id']      =$datos['tipo_periodo_id'];
         $data['modalidad_id']         =$datos['modalidad_id'];
         $data['usuario_id']           ='1';
         $data['activo']               ='1';

         $nom_tabla='carrera_instituto';


      $strQuery = "SELECT * from upd_$nom_tabla(".$this->Model_consulta->CreaParametros($nom_tabla,$data).")";
      $result = $this->db->query($strQuery);
      $result = $result->row();
      return 0;
  }


  function del_tecarrerainstituto($id){

     
     $strQuery = 'SELECT del_carrera_instituto('.$id.');';
     return $this->db->query($strQuery);
      
     
  }



function consulta_carrera_dife($id){

  $query=$this->db->query('SELECT DISTINCT nombre_carrera FROM vis_materia_carrera_instituto where carrera_instituto_id = '.$id.'');
   return ($query);

}



function ins_materiacarrerainstituto($datos){


 
     
         $data['materia_id']               =$datos['materia_id'];
         $data['carrera_instituto_id']     =$datos['carrera_instituto_id'];
         $data['cantidad_unidad_credito']  =$datos['cantidad_unidad_credito'];
         $data['numero_periodo']           =$datos['numero_periodo'];
         $data['usuario_id']               ='1';
         $data['activo']                   ='1';
         $data['codigo_materia']           =$datos['codigo_materia'];
         
         $nom_tabla='materia_carrera';


      $strQuery = "SELECT * from ins_$nom_tabla(".$this->Model_consulta->CreaParametros($nom_tabla,$data).")";
     // print_r($strQuery);
      $result = $this->db->query($strQuery);
      $result = $result->row();
      return 0;
    


}

function upd_materiacarrerainstituto($datos){




 //   activo=$7, codigo_materia=$8
 


    $data['materia_carrera_id']        = $datos['materia_carrera_id'];
    $data['materia_id']                = $datos['materia_id'];
    $data['carrera_instituto_id']      = $datos['carrera_instituto_id'];
    $data['cantidad_unidad_credito']   = $datos['cantidad_unidad_credito'];
    $data['numero_periodo']            = $datos['numero_periodo'];
    $data['usuario_id']                = '1';
    $data['activo']                    = '1';
    $data['codigo_materia']            = $datos['codigo_materia'];
  

      $nom_tabla='materia_carrera';
      $strQuery = "SELECT * from upd_$nom_tabla(".$this->Model_consulta->CreaParametros($nom_tabla,$data).")";
    
     $result = $this->db->query($strQuery);
      $result = $result->row();
      return 0;

}





}
?>
