<?php
class tipo_becaModel extends Model
{
  var $nombre_pais = '';
  var $nacionalidad_pais = '';
  var $usuario_id = '';
  var $ult_mod = '';
  var $activo = '';


	function tipo_becaModel(){
		parent::Model();
        $this->load->database();
        $this->load->model('Mfrmclass','',TRUE);
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

  function getAlltipo_beca($campo, $criterio, $valor, $page, $perPage)
  {
    $strWhere = '';
    if($campo!='' && $criterio!='' && $valor!='')
    {
      $strWhere = $this->setWhere($campo, $criterio, $valor);
    }

    $strPerPage = ($perPage == '') ? '' : ' LIMIT '.$perPage;

    $strPage = ($page == '') ? '' : ' OFFSET '.$page;

    $sqlQuery = 'SELECT '.$this->Mfrmclass->nombre_tabla.'_id, nombre_'.$this->Mfrmclass->nombre_tabla.'  FROM '.$this->Mfrmclass->nombre_tabla.' WHERE'.$strWhere.' activo = 1 ORDER BY nombre_'.$this->Mfrmclass->nombre_tabla.$strPerPage.$strPage;

    $result = $this->db->query($sqlQuery);
    return $result;
  }

  function getNumTotaltipo_beca($campo, $criterio, $valor)
  {
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

  function gettipo_beca($Id,$tabla)
  {
    $this->Mfrmclass->nombre_tabla = $tabla;
    $sqlQuery = 'SELECT '.$this->Mfrmclass->nombre_tabla.'_id, nombre_'.$this->Mfrmclass->nombre_tabla.', usuario_id, ult_mod, activo FROM  '.$this->Mfrmclass->nombre_tabla.' WHERE '.$this->Mfrmclass->nombre_tabla.'_id = '.$Id;
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

  function insert_tipoBeca($nom_tabla){

        $datos['nombre_tipo_beca'] = $_POST['txttipobeca'];
        $datos['usuario_id']       = '1';
        $datos['activo']           = $_POST['txtActivo'];


         $consulta = "select * from ins_$nom_tabla (".$this->Mfrmclass->CreaParametros($datos).")";
        // print_r($consulta);
          return $this->db->query($consulta);

  }

  function updatetipo_beca($id,$nom_tabla)
  {
        $datos['tipo_beca_id']     = $id;
        $datos['nombre_tipo_beca'] = $_POST['txttipobeca'];
        $datos['usuario_id']       = '1';
        $datos['activo']           = $_POST['txtActivo'];


          $consulta = "select * from upd_$nom_tabla (".$this->Mfrmclass->CreaParametros($datos).")";
        // print_r($consulta);
          return $this->db->query($consulta);

  }

  function deletetipo_beca($strId,$tabla)
  {
    $this->Mfrmclass->nombre_tabla = $tabla;
    $strQuery = 'SELECT del_'.$this->Mfrmclass->nombre_tabla.'('.$strId.');';

      $result = $this->db->query($strQuery);
      $result = $result->row();
    
    return 0; 
       
   

  }
}

?>
