<?php
class liceoModel extends Model
{
  var $nombre_pais = '';
  var $nacionalidad_pais = '';
  var $usuario_id = '';
  var $ult_mod = '';
  var $activo = '';


	function liceoModel(){
		parent::Model();
        $this->load->database();
        $this->load->model('Mfrmclass','',TRUE);
        
	}

  function setCampo($strCampo)
  {
    return ' upper('.$strCampo.')';
  }

  function setCriterio($strCriterio, $strValor)
  {
    switch ($strCriterio)
    {
      case 'Contenga': $result = ' LIKE \'%\' || \''.strtoupper($strValor).'\' || \'%\''; break;
      case 'Sea Igual a': $result = '= \''.strtoupper($strValor).'\''; break;
    }
    return $result;
  }


  function setwhere($campo, $criterio, $valor)
  {
    return ' '.$this->setCampo($campo).' '.$this->setCriterio($criterio, $valor).'  ';
  }

   function setwhere_cd($campo, $criterio, $valor)
  {
    return '  '.$this->setCampo($campo).' '.$this->setCriterio($criterio, $valor).'   ';
  }

  function getAllliceo($campo, $criterio, $valor, $page, $perPage)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->setWhere($campo, $criterio, $valor);
      $strWhere = $strWhere.' and activo = 1';
    } else{

        $strWhere = ' activo = 1 ';
    }

    $strPerPage = ($perPage == '') ? '' : ' LIMIT '.$perPage;

    $strPage = ($page == '') ? '' : ' OFFSET '.$page;

    $sqlQuery = 'SELECT  '.$this->Mfrmclass->nombre_tabla.'_id, nombre_'.$this->Mfrmclass->nombre_tabla.',direccion_'.$this->Mfrmclass->nombre_tabla.', telefono_direccion   FROM '.$this->Mfrmclass->nombre_tabla.' WHERE  '.$strWhere.' ORDER BY nombre_'.$this->Mfrmclass->nombre_tabla.$strPerPage.$strPage;

    $result = $this->db->query($sqlQuery);
    return $result;
  }

  function getNumTotalliceo($campo, $criterio, $valor)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->setWhere_cd($campo, $criterio, $valor);
      $strWhere = $strWhere.' and activo = 1';

    } else{

        $strWhere = ' activo = 1 ';
    }


    $sqlQuery = 'SELECT COUNT( '.$this->Mfrmclass->nombre_tabla.'_id) as total FROM  '.$this->Mfrmclass->nombre_tabla.'  WHERE'.$strWhere.' ';
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result->total;
  }

  function getliceo($Id,$tabla)
  {
    $this->Mfrmclass->nombre_tabla = $tabla;
    $sqlQuery = 'SELECT '.$this->Mfrmclass->nombre_tabla.'_id, nombre_'.$this->Mfrmclass->nombre_tabla.',direccion_liceo, telefono_direccion, usuario_id, ult_mod, activo FROM  '.$this->Mfrmclass->nombre_tabla.' WHERE '.$this->Mfrmclass->nombre_tabla.'_id = '.$Id;
    $result = $this->db->query($sqlQuery);
    $result = $result->row();
    return $result;
  }

/*  function inserttipo_beca($strPais, $strNacionalidad, $strActivo)
  {
    $this->nombre_pais = $strPais;
    $this->nacionalidad_pais = $strNacionalidad;
    $this->usuario_id = '1'; //ojo arreglar
    $this->ult_mod = '2009-01-01';
    $this->activo = '1';
    $this->db->insert('pais', $this);
    return 0;
  }*/

  function insert_liceo($nom_tabla){

        $datos['nombre_liceo']       =$_POST['txtliceo'];
        $datos['usuario_id']         ='1';
        $datos['activo']             =$_POST['txtActivo'];
        $datos['direccion_liceo']    =$_POST['txtdir'];
        $datos['telefono_direccion'] =$_POST['txttelefono'];


         $consulta = "select * from ins_$nom_tabla (".$this->Mfrmclass->CreaParametros($datos).")";
         // print_r($consulta);
         return $this->db->query($consulta);

  }

  function update_liceo($id,$nom_tabla)
  {
        $datos['liceo_id']       = $id;
        $datos['nombre_liceo']   = $_POST['txtliceo'];
        $datos['usuario_id']         = '1';
        $datos['activo']             = $_POST['txtActivo'];
        $datos['direccion_liceo']    =$_POST['txtdir'];
        $datos['telefono_direccion'] =$_POST['txttelefono'];


          $consulta = "select * from upd_$nom_tabla (".$this->Mfrmclass->CreaParametros($datos).")";
         //  print_r($consulta);
         return $this->db->query($consulta);

  }

  function deleteliceo($strId,$tabla)
  {
    $this->Mfrmclass->nombre_tabla = $tabla;
    $strQuery = 'SELECT del_'.$this->Mfrmclass->nombre_tabla.'('.$strId.');';

      $result = $this->db->query($strQuery);
      $result = $result->row();

    return 0;



  }
}

?>
