<?php




class reportesModel extends Model
{



	function reportesModel()
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
     case    0 : $result = 'LIKE \'%\' || \''.strtoupper($strValor).'\' || \'%\''; break;
     case    1 : $result = '= \''.strtoupper($strValor).'\''; break;
     case    2 : $result = 'LIKE \'%\' || \''.strtoupper($strValor).'\' || \'%\''; break;
     case    3 : $result = '<= \''.strtoupper($strValor).'\''; break;
     case    4 : $result = '>= \''.strtoupper($strValor).'\''; break;
     
    }
    return $result;
  }


    function setwhere($criterio, $valor)
  {
    return $this->setCriterio($criterio, $valor).' ';
  }


  function getAllsorteo($criterio_fecha,$fecha,$criterio_lugar,$lugar,$sql_ms,$sql_ps){

   $strWhere_lugar = ' ';
   $strWhere_fecha = ' ';
   $and            = ' ';
   $andfecha       = ' ';
   
    
    if($fecha!='' )
    {
      $andfecha= ' and ';
      $strWhere_fecha =  'fecha_sorteo '.$this->setWhere($criterio_fecha,$fecha);
    }
     if($lugar!='')
    {
      $strWhere_lugar = ' lugar_sorteo '.$this->setWhere($criterio_lugar,$lugar).' and ';

    }
   
    if($fecha !='' or $lugar !=''){
        
        $and= '  ';
    }

    $strWhere = $strWhere_fecha.$andfecha.$strWhere_lugar.$and;

    $sqlQuery = 'SELECT *
                 FROM  vis_sorteo  WHERE '.$strWhere.$sql_ms.$sql_ps.'  activo = 1
                 ORDER BY sorteo_id ASC ';

    //print_r($sqlQuery);
     $result = $this->db->query($sqlQuery);
    return $result;
  }


function getAllsorteados($criterio_nombre,$nombre,$criterio_pellido,$apellido,$criterio_carta,$carta,$criterio_cedula,$cedula,$criterio_sexo,$sexo,$criterio_apto,$apto,$criterio_numero,$numero,$sql_mh,$sql_ph,$sql_i,$sql_c,$sorteo_id)
{


$strWhere_nombre    = '';
$strWhere_apellido  = '';
$strWhere_carta     = '';
$strWhere_cedula    = '';
$strWhere_sexo      = '';
$strWhere_apto      = '';
$strWhere_numero    = '';
$strWhere_sorteo    = '';


     if($nombre!='')
    {
      $strWhere_nombre = ' upper(nombre_persona) '.$this->setWhere($criterio_nombre,$nombre).' and ';

    }

    if($apellido!='')
    {
      $strWhere_apellido = ' upper(apellido_persona) '.$this->setWhere($criterio_pellido,$apellido).' and ';

    }
    if($carta!='')
    {
      $strWhere_carta = ' upper(codigo_carta_postulacion) '.$this->setWhere($criterio_carta,$carta).' and ';

    }
    if($cedula!='')
    {
      $strWhere_cedula = ' cedula_persona '.$this->setWhere($criterio_cedula,$cedula).' and ';

    }
    if($sexo!='')
    {
      $strWhere_sexo = ' sexo_persona '.$this->setWhere($criterio_sexo,$sexo).' and ';
    }
    
     if($apto!='')
    {
      $strWhere_apto = ' apto '.$this->setWhere($criterio_apto,$apto).' and '; // aun no las he agregado

    }
      if($numero!='')
    {
      $strWhere_numero = ' numero '.$this->setWhere($criterio_numero,$numero).' and '; //numero de participaciones aun no las he agregado

    }

    if($sorteo_id != ''){

        $strWhere_sorteo= ' sorteo_id = '.$sorteo_id.' and ';
    }


    $strWhere= $strWhere_nombre.$strWhere_apellido.$strWhere_carta.$strWhere_cedula.$strWhere_sexo.$strWhere_sorteo.$sql_mh.$sql_ph.$sql_c;
    $sqlQuery = 'SELECT *
                 FROM  vis_sorteo_persona  WHERE '.$strWhere.'  activo = 1
                 ORDER BY sorteo_id ASC ';

   //print_r($sqlQuery);
   $result = $this->db->query($sqlQuery);
   
   

   return $result;
}



function getbeneficiario($criterio_nombre,$nombre,$criterio_apellido,$apellido,$criterio_promedio,$promedio,$criterio_cedula,$cedula,$criterio_sexo,$sexo,$sql_i,$sql_c,$sql_m,$sql_p)
{


$strWhere_nombre    ='';
$strWhere_apellido  ='';
$strWhere_cedula    ='';
$strWhere_sexo      ='';
$strWhere_promedio  ='';

 if($nombre!='')
    {
      $strWhere_nombre = ' upper(nombre_persona) '.$this->setWhere($criterio_nombre,$nombre).' and ';

    }


if($apellido !='')
   {
       //$criterio_apellido
       $strWhere_apellido = ' upper(apellido_persona)  '.$this->setwhere($criterio_apellido, $apellido).' and ';
   }


if($promedio !='')
   {

        $strWhere_promedio = ' promedio '.$this->setwhere($criterio_promedio, $promedio).' and ';
   }


  if($cedula !='')
     {

          $strWhere_cedula = ' numero_cedula '.$this->setwhere($criterio_cedula, $cedula).' and ';
     }

if($sexo !='')
   {


       $strWhere_sexo =' upper(sexo_persona) '.$this->setwhere($criterio_sexo,$sexo).'  and ';
   }


 $strWhere= $strWhere_nombre.$strWhere_apellido.$strWhere_cedula.$strWhere_promedio.$strWhere_sexo.$sql_i.$sql_c.$sql_m.$sql_p;

 $sqlQuery = 'SELECT *
                 FROM  vis_beca_persona  WHERE '.$strWhere.'  activo = 1 order by nombre_persona asc';
//ORDER BY sorteo_id ASC
   //print_r($sqlQuery);



  $result = $this->db->query($sqlQuery);



   return $result;
//*******************************
}

 function madresoltera($criterio_nombre,$nombre,$criterio_apellido,$apellido,$criterio_cedula,$cedula,$criterio_hijos,$hijos,$sql_i,$sql_n,$sql_c,$sql_p,$sql_m,$sql_pa,$id){

$strWhere_nombre    ='';
$strWhere_apellido  ='';
$strWhere_cedula    ='';
$strWhere_hijos     ='';


if($nombre!='')
    {
      $strWhere_nombre = ' upper(nombre_persona) '.$this->setWhere($criterio_nombre,$nombre).' and ';

    }
if($apellido !='')
    {
      $strWhere_apellido = ' upper(apellido_persona) '.$this->setWhere($criterio_apellido,$apellido).' and ';

    }
if($cedula !='')
    {
      $strWhere_cedula = ' cedula_persona '.$this->setWhere($criterio_cedula,$cedula).' and ';

    }

if($hijos !='')
    {
      $strWhere_hijos = ' numero_hijos '.$this->setWhere($criterio_hijos,$hijos).' and ';

    }



$strWhere= $strWhere_nombre.$strWhere_apellido.$strWhere_cedula.$strWhere_hijos.$sql_i.$sql_n.$sql_c.$sql_p.$sql_m.$sql_pa;


 $sqlQuery = 'SELECT *
                 FROM  vis_beca_persona  WHERE '.$strWhere.'  activo = 1 and beca_id='.$id;
//ORDER BY sorteo_id ASC
//print_r($sqlQuery);



  $result = $this->db->query($sqlQuery);



   return $result;


     
 }



function getbecapromedio($criterio_nombre,$nombre,$criterio_apellido,$apellido,$criterio_cedula,$cedula,$criterio_promedio,$promedio,$sql_i,$sql_c,$sql_m,$sql_p,$sql_pe)
{

$strWhere_nombre   ='';
$strWhere_apellido ='';
$strWhere_cedula   ='';
$strWhere_promedio ='';

if($nombre!='')
    {
      $strWhere_nombre = ' upper(nombre_persona) '.$this->setWhere($criterio_nombre,$nombre).' and ';

    }

if($apellido !='')
    {
      $strWhere_apellido = ' upper(apellido_persona) '.$this->setWhere($criterio_apellido,$apellido).' and ';

    }

if($cedula !='')
    {
      $strWhere_cedula = ' cedula_persona '.$this->setWhere($criterio_cedula,$cedula).' and ';

    }

if($promedio !='')
    {
      $strWhere_promedio = ' promedio_nota '.$this->setWhere($criterio_promedio,$promedio).' and  ';

    }


$strWhere=$strWhere_nombre.$strWhere_apellido.$strWhere_cedula.$strWhere_promedio.$sql_i.$sql_c.$sql_m.$sql_p.$sql_pe;

$sqlQuery = 'SELECT *
                 FROM  vis_beca_promedio  WHERE '.$strWhere.'  usuario_id >= 1 ';
//ORDER BY sorteo_id ASC
   //print_r($sqlQuery);


 // print_r($sqlQuery);
  $result = $this->db->query($sqlQuery);



   return $result;

}


function upd_beca_persona_commit_beca($bpI,$bI,$v){

     $data['beca_persona_id'] =$bpI;
     $data['beca_id']         =$bI;
     $data['commit_beca']     =$v;



      $nom_tabla = 'beca_persona';
      $strQuery = "SELECT * from upd_beca_persona_commit_beca(".$this->Model_consulta->CreaParametros($nom_tabla,$data).")";
      $result = $this->db->query($strQuery);
      $result = $result->row();
      return 0;
}



function gethistoricoBenef($criterio_nombre,$nombre,$criterio_apellido,$apellido,$criterio_cedula,$cedula,$criterio_sexo,$sexo,$sql_mc,$sql_pc,$sql_ma,$sql_pa,$sql_i,$sql_ca,$sql_acc){

$strWhere_nombre   ='';
$strWhere_apellido ='';
$strWhere_sexo     ='';
$strWhere_cedula   ='';

if($nombre!='')
    {
      $strWhere_nombre = ' upper(nombre_persona) '.$this->setWhere($criterio_nombre,$nombre).' and ';

    }

if($apellido !='')
    {
      $strWhere_apellido = ' upper(apellido_persona) '.$this->setWhere($criterio_apellido,$apellido).' and ';

    }

if($cedula !='')
    {
      $strWhere_cedula = ' upper(cedula_persona) '.$this->setWhere($criterio_cedula,$cedula).' and ';

    }

if($sexo !='')
    {
      $strWhere_sexo = ' upper(sexo_persona) '.$this->setWhere($criterio_sexo,$sexo).' and ';

    }

$strWhere = $strWhere_nombre.$strWhere_apellido.$strWhere_cedula.$strWhere_sexo.$sql_mc.$sql_pc.$sql_ma.$sql_pa.$sql_i.$sql_ca;




if ($sql_acc <> ''){

$sqlQuery = 'SELECT *
                 FROM  vis_beneficiario_jel  WHERE '.$strWhere.'  beca_persona_id in (select beca_persona_id from accion_beca where  '.$sql_acc.' ) and  activo = 1 ';

}else{

    $sqlQuery = 'SELECT *
                 FROM  vis_beneficiario_jel  WHERE '.$strWhere.'   activo = 1 ';

}



//print_r($sqlQuery);
  $result = $this->db->query($sqlQuery);



   return $result;





    
}

function getnominabecaBecario($criterio_nombre,$nombre,$criterio_apellido,$apellido,$criterio_cedula,$cedula,$criterio_fecha,$fecha,$criterio_status,$status,$sql_i,$sql_c,$sql_b,$beca_id){

$strWhere_nombre   ='';
$strWhere_apellido ='';
$strWhere_cedula   ='';
$strWhere_fecha    ='';
$strWhere_status   ='';

if($nombre!='')
    {
      $strWhere_nombre = ' upper(nombre_persona) '.$this->setWhere($criterio_nombre,$nombre).' and ';

    }

if($apellido !='')
    {
      $strWhere_apellido = ' upper(apellido_persona) '.$this->setWhere($criterio_apellido,$apellido).' and ';

    }

if($cedula !='')
    {
      $strWhere_cedula = ' upper(cedula_persona) '.$this->setWhere($criterio_cedula,$cedula).' and ';

    }




if($fecha!='')
    {
      $strWhere_fecha = ' upper(fecha_presupuesto) '.$this->setWhere($criterio_fecha,$fecha).' and ';

    }



if($status!='')
    {
      $strWhere_status = ' upper(nombre_estado_presupuesto) '.$this->setWhere($criterio_status,$status).' and ';

    }


$strWhere =$strWhere_nombre.$strWhere_apellido.$strWhere_cedula.$strWhere_fecha.$strWhere_fecha.$strWhere_status.$sql_i.$sql_c.$sql_b;


$sqlQuery = 'SELECT *
                 FROM  vis_nomina_beca_becario  WHERE '.$strWhere.' beca_id = '.$beca_id.' and commit_beca = 0 ';
//ORDER BY sorteo_id ASC
 // print_r($sqlQuery);



  $result = $this->db->query($sqlQuery);



   return $result;



   
}


function rep_beca_ayuda($criterio_nombre,$nombre,$criterio_apellido,$apellido,$criterio_status,$status,$sql_b){

$strWhere_nombre   ='';
$strWhere_apellido ='';

$strWhere_status  ='';

if($nombre!='')
    {
      $strWhere_nombre = ' upper(nombre_persona) '.$this->setWhere($criterio_nombre,$nombre).' and ';

    }

if($apellido !='')
    {
      $strWhere_apellido = ' upper(apellido_persona) '.$this->setWhere($criterio_apellido,$apellido).' and ';

    }



if($status !='')
    {
      $strWhere_status = ' upper(estado_persona_id) '.$this->setWhere($criterio_status,$status).' and ';

    }



   $strWhere = $strWhere_nombre.$strWhere_apellido.$strWhere_status.$sql_b;


$sqlQuery = 'SELECT *
                 FROM  vis_nomina_beca_ayuda  WHERE '.$strWhere.'  beca_id >= 1 ';
//ORDER BY sorteo_id ASC
  //print_r($sqlQuery);



  $result = $this->db->query($sqlQuery);



   return $result;



    
}




function getcarreraAsignada($sql_m,$sql_p,$sql_i,$sql_ca){


$strWhere =$sql_m.$sql_p.$sql_i.$sql_ca;


$sqlQuery = 'SELECT *
                 FROM  vis_  WHERE '.$strWhere.'  activo = 1 ';
//ORDER BY sorteo_id ASC
   //print_r($sqlQuery);



  $result = $this->db->query($sqlQuery);



   return $result;



}




function getcon_rep_factura($sql_i,$sql_pe,$criterio_fechafact,$fecha_fact,$criterio_status,$status,$criterio_sfecharep,$fecharep){

 $strWhere_fecha_fact ='';
 $strWhere_fecharep   ='';
 $strWhere_status     ='';

//******************************
if($fecha_fact!='')
    {
      $strWhere_fecha_fact = ' fecha1 '.$this->setWhere($criterio_fechafact,$fecha_fact).' and ';

    }
//******************************************
if($fecharep!='')
    {
      $strWhere_fecharep = ' fecha2 '.$this->setWhere($criterio_sfecharep,$fecharep).' and ';

    }

//******************************************

if($status!='')
    {
      $strWhere_status = ' status '.$this->setWhere($criterio_status,$status).' and ';

    }
//*********************************************


$strWhere = $strWhere_fecha_fact. $strWhere_status.$strWhere_fecharep.$sql_i.$sql_pe;



$sqlQuery = 'SELECT *
                 FROM  vis_  WHERE '.$strWhere.'  activo = 1 ';
//ORDER BY sorteo_id ASC
   //print_r($sqlQuery);



  $result = $this->db->query($sqlQuery);



   return $result;



    
}


function getAllcenso($sql_mc,$sql_pc,$criterio_lugar,$lugar,$criterio_fecha,$fecha,$sql_pro){

 $strWhere_fecha ='';
 $strWhere_lugar ='';


//******************************
if($fecha!='')
    {
      $strWhere_fecha = ' fecha_procedencia '.$this->setWhere($criterio_fecha,$fecha).' and ';

    }
//******************************************

 if($lugar!='')
    {
      $strWhere_lugar = ' lugar_procedencia '.$this->setWhere($criterio_lugar,$lugar).' and ';

    }
//******************************************




   $strWhere = $sql_mc.$sql_pc. $strWhere_fecha.$strWhere_lugar.$sql_pro;

   $sqlQuery = 'SELECT *
                 FROM  vis_censo_general  WHERE '.$strWhere.'  activo = 1 ';
  $result = $this->db->query($sqlQuery);
 
  // print_r($sqlQuery);
   return $result;
   
}

function getAllcensados($sql_ma,$sql_pa,$sql_ca,$criterio_nombre,$nombre,$criterio_apellido,$apellido,$criterio_cedula,$cedula,$criterio_sexo,$sexo,$censo,$no_benef){

$strWhere_nombre   ='';
$strWhere_apellido ='';
$strWhere_cedula   ='';
$strWhere_sexo     ='';


if($nombre!='')
    {
      $strWhere_nombre = ' upper(nombre_persona) '.$this->setWhere($criterio_nombre,$nombre).' and ';

    }

if($apellido !='')
    {
      $strWhere_apellido = ' upper(apellido_persona) '.$this->setWhere($criterio_apellido,$apellido).' and ';

    }

if($cedula !='')
    {
      $strWhere_cedula = ' upper(cedula_persona) '.$this->setWhere($criterio_cedula,$cedula).' and ';

    }
if($sexo !='')
    {
      $strWhere_sexo = ' upper(sexo_persona) '.$this->setWhere($criterio_sexo,$sexo).' and ';

    }

  if($no_benef == 0){
  $strWhere = $sql_ma.$sql_pa.$sql_ca.$strWhere_nombre.$strWhere_apellido.$strWhere_cedula.$strWhere_sexo;
   $sqlQuery = 'SELECT *
                 FROM  vis_procedencia_persona  WHERE '.$strWhere.' numero_censo= '.$censo.' and   activo = 1 ';
  }else{

    $strWhere = $sql_ma.$sql_pa.$sql_ca.$strWhere_nombre.$strWhere_apellido.$strWhere_cedula.$strWhere_sexo;
   $sqlQuery = 'SELECT *
                 FROM  vis_procedencia_persona  WHERE '.$strWhere.' numero_censo= '.$censo.' and persona_id not in (select persona_id from vis_beca_persona)';

  }


// print_r($sqlQuery);
 $result = $this->db->query($sqlQuery);
 return $result;
    
}

function materias($beca_persona,$periodo){


  
   $sqlQuery = 'select * from vis_materia_becado where beca_persona_id = '.$beca_persona.' and periodo_id ='.$periodo;

   //print_r($sqlQuery);
   $result = $this->db->query($sqlQuery);
   return $result;

}

function materias_aprobadas($tabla,$parametro,$campo){



   $sqlQuery = 'select * from '.$tabla.' where '.$campo.' = '.$parametro.' and nota_materia >= 10 ';

   //print_r($sqlQuery);
   $result = $this->db->query($sqlQuery);
   return $result;

}



function getinstituto($qry){

   $sqlQuery = 'SELECT * FROM  vis_instituto  WHERE '.$qry.'  activo=1 ';
   print_r($sqlQuery);
   $result = $this->db->query($sqlQuery);
   return $result;
}



function getnucleo($qm,$qp,$id){

    $strWhere= $qm.$qp;
    $sqlQuery = 'SELECT * FROM  vis_nucleo_instituto_full  WHERE '.$strWhere.' instituto_id= '.$id.' and  activo=1 ';
    //print_r($sqlQuery);
    $result = $this->db->query($sqlQuery);
    return $result;
}


function getcarrera($sql_c,$id){


    $strWhere= $sql_c;
    $sqlQuery = 'SELECT * FROM  vis_carrera_instituto  WHERE '.$strWhere.' instituto_id= '.$id.' and  activo=1 ';
    //print_r($sqlQuery);
    $result = $this->db->query($sqlQuery);
    return $result;
    


}



function materia($id){



    ///$strWhere= $ca_inst;
    $sqlQuery = 'SELECT * FROM  vis_materia_carrera_instituto  WHERE carrera_instituto_id = '.$id.'  and  activo=1 ';
    //print_r($sqlQuery);
    $result = $this->db->query($sqlQuery);
    return $result;



}

}

?>
