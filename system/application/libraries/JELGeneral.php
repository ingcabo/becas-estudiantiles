<?php
if (!defined('BASEPATH')) exit('No permitir el acceso directo al script'); 

class JELGeneral
{

  function leerCelda($data,$hoja,$fil,$col)
  {
    $dato = $data->sheets[$hoja]['cells'][$fil][$col];
    return $dato;
  }

function getSegmentArgument($HTTPString, $argName)
  {
    $arg ='';
		$posArg = strpos($HTTPString, $argName);
		if ($posArg<=0) return $arg;
		$posArg = strpos($HTTPString, '/', $posArg) + 1;
		if (strpos($HTTPString,'/',$posArg) > 0)
		  $posEnd=strpos($HTTPString,'/',$posArg)-1;
		else
		  $posEnd = strlen($HTTPString);
	
		$arg = substr($HTTPString, $posArg, $posEnd - $posArg + 1);
	
	   return $arg;
  }
	
	function getFilterPages($pages,$campo,$criterio,$valor)
	{
    $p2=$pages;
		$p='';
    //if($campo!='' && $criterio !='' && $valor !='')
    if($campo!=false && $criterio !=false && $valor !=false)
		{		 
		  $getString = '/cmbCampo/'.$campo.'/cmbCriterio/'.$criterio.'/txtValor/'.$valor;
	
		  $cont = strpos($pages,'</a>',0);
		  
		  while($cont > 0)
		  {
        $cont2 = $cont;
		   
        while($cont2 > 0)
        {
          if(substr($p2,$cont2,1)=='"')
          {
            $p = $p.substr($p2,0,$cont2).$getString.'"'.substr($p2,$cont2+1,($cont+3)-$cont2);
            $p2 = substr($p2,$cont+4,strlen($p2));
            $cont2=0;
          }//  if(substr($p2,$cont2,1)=='"')
          $cont2--;
        }//	while($cont2 > 0)
        $cont = strpos($p2,'</a>',0);
		  }	//while($cont > 0)	 
		}//if($campo!=false && $criterio !=false && $valor !=false)
    return $p.$p2;
	}

  function arreglarFechaBD($arreglearFecha)
  {

    $fechaBD = $arreglearFecha;
    if(strpos($arreglearFecha,'/')<>0)
    {
      $arreglearFecha = explode("/",$arreglearFecha);
      $fechaBD = $arreglearFecha[2]."/".$arreglearFecha[1]."/".$arreglearFecha[0];
    }
    elseif(strpos($arreglearFecha,'-')<>0)
    {
      $arreglearFecha = explode("-",$arreglearFecha);
      $fechaBD = $arreglearFecha[2]."/".$arreglearFecha[1]."/".$arreglearFecha[0];
    }

    return $fechaBD;
  }



  function mensaje($objeto,$mensaje,$destino,$strColor)
	{
		$datos['nada']='';
		
		$centinela = new Centinela();
        $menu_final['opciones']     = $objeto->mod_demenu->inicio($centinela->getId());
        $dataMsg['menu']            = $objeto->load->view('vis_menu',$menu_final,true);

        $dataMsg['mensaje'] = $mensaje;
 	    $dataMsg['destino'] = $destino;
        $dataMsg['strColor'] = $strColor;
	 	$objeto->load->view('mensaje', $dataMsg);
	}

  function setCampo($strCampo)
  {
    return 'upper('.$strCampo.')';
  }

  function setCriterio($strCriterio, $strValor)
  {
    $strCriterio = strtoupper($strCriterio);
    switch ($strCriterio)
    {
      case 'CONTENGA': $result = 'LIKE \'%\' || \''.strtoupper($strValor).'\' || \'%\''; break;
      case 'SEA IGUAL A': $result = '= \''.strtoupper($strValor).'\''; break;
    }
    return $result;
  }

  function setwhere($campo, $criterio, $valor)
  {
    return ' '.$this->setCampo($campo).' '.$this->setCriterio($criterio, $valor).' AND ';
  }



  function setwhere_cd($campo, $criterio, $valor)
  {
    return ' '.$this->setCampo($campo).' '.$this->setCriterio($criterio, $valor).'  ';
  }


}


	
?>
