<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel=StyleSheet href="<?php echo base_url(); ?>system/application/views/estilos/lista.css" type="text/css" media=screen>

<?php $this->mod_usuario->en_session(); ?>
<script type="text/javascript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}

function advertenciaSiNo(){
    return confirm('¿Esta seguro de borrar este registro?');
}
//-->
</script>

<style type="text/css">
<!--
body {

	background-image: url(<?php echo base_url(); ?>system/application/views/imagenes/bg2.gif);
	background-repeat: no-repeat;
	background-color: #a7d0e4;
}
}
-->
</style><head>

<!-- Script para adaptar footer según resolución -->
<?=$xajax_js?>
<script type="text/javascript">
<!--
window.onerror=function(m,u,l)
{
	window.status = "Java Script Error: "+m;
	return true;
}
-->
</script>
<title><?php echo $this->titulo;?></title>

 

</head>

<body bgcolor="#FFFFFF" text="#000000" link="#0066FF" vlink="#9933FF" alink="#FF3333">
<div align="center" class="Titulo"><?php echo $menu; //echo $watch;?>
  <br><?php echo $this->encabezado; //echo $watch;?></div>
<div class="busqueda">
  <div align="center"><?php echo form_open($this->accion); ?>
    <table width="800" height="33" bgcolor="#E9E8E2">
      <tr><td width="94"><label></label></td width="90"><td width="392"><label></label></td><td width="240"><label></label></td><td width="54"></td>
      </tr>
      <tr><td width="94">
        
        <?php
               $js = 'onchange="'.$content.'" style=""';
               $opciones = $this->Mfrmclass->Crea_opciones_dropdown($this->Tit_Tabla);
               array_unshift($opciones,'[Seleccione uno]');
               echo form_dropdown('dl_campos',$opciones,($this->centinela->getcampo1() <> '')?$this->centinela->getcampo1():'0',$js);?>
        
        </select></td width="90">
	    <td width="392"><div id="DivSelectOperador" name="DivSelectOperador">
		    <?php
               if($this->centinela->getcampo2() <> ''){
                   echo $this->Mfrmclass->Operador($this->centinela->getcampo1(),$this->centinela->getcampo2());
               }else{?>
		    <select name="Operador" size="1" style="width:165px" >
		      <option value="0" selected="selected">[Seleccione uno]</option></select>
		    <?php }  ?>
	      </div></td><td width="240" ><div id="DivCampoFiltro">
	        <?php
              $tipo_result = $this->Mfrmclass->ObtAttCampo($this->Mfrmclass->nombre_tabla,$this->centinela->getcampo1());
              $tipo_dato = $tipo_result['tipo'];

                if($tipo_dato == 'bool'){
                    if($this->centinela->getcampo3() <> ''){
                      if(trim($this->centinela->getcampo3()) == 'true'){
                        $valor = '<input type="radio" name="CampoFiltro" value="true" checked="checked">Sí</>
                                 <input type="radio" name="CampoFiltro" value="false">No</>';
                      }else{
                        $valor = '<input type="radio" name="CampoFiltro" value="true" >Sí</>
                                 <input type="radio" name="CampoFiltro" value="false" checked="checked">No</>';
                      }
                      echo $valor;
                    }
                }else{
                    $valor = $this->centinela->getcampo3()<>''?$this->centinela->getcampo3():'';
                    echo '<input type="text" name="CampoFiltro" id="CampoFiltro" maxlength="20"  size="40" style="width:300px" 
                         value="'.$valor.'">';
                }
                    
              ?>
	        </div>
            </td>
        <td><input type="submit" name="boton" value="Filtrar" class="inputsubmit" /></td>
      </tr>
    </table>
    <table width="800" bgcolor="#E9E8E2" class="celdaContenido">
      <!--DWLayoutTable-->
      <thead align="center">
        <tr style="text-align:center">
          
        </tr>
        <tr style="text-align:center">
          <th height="20">&nbsp;</th>
        </tr>
        <tr style="text-align:center">
          <th height="22" align="center" valign="top" class="celdaContenido"><div style="width:40px; float:right;">
          
          <a href="<?php echo base_url().'index.php/'.$this->clasecrud.'/index/'.MODO_MODIFICAR.'/'.$this->Mfrmclass->nombre_tabla.'/'.$fila[$this->Mfrmclass->campo_clave].'/'.$this->uri->segment(1);?>">
		  <img src="<?php echo base_url();?>system/application/views/imagenes/modificar.PNG" alt="asdcf" width="16" height="16" border="0" title="Modificar" /></a>&nbsp;
		  <a href="<?php echo base_url().'index.php/'.$this->clasecrud.'/index/'.MODO_BORRAR.'/'.$this->Mfrmclass->nombre_tabla.'/'.$fila[$this->Mfrmclass->campo_clave].'/'.$this->uri->segment(1);?>">
		  <img src="<?php echo base_url();?>system/application/views/imagenes/eliminar.PNG" alt="dc" width="16" height="16" border="0" title="Eliminar"  onclick="return confirm('¿Esta seguro de borrar este registro?');"/></a></div>
		  </th>
        </tr>
      </thead>
      <?php foreach($this->campos_lv as $fila):?>
      <tbody>
      </tbody>
      <?php endforeach;?>
      <tfoot>
        <tr>
          <td height="21"><div align="right" class="celdaContenido"><?php //echo "Registros : $this->TotalRegistros"; ?>&nbsp;</div></td>
        </tr>
        <tr>
          <td height="20" align="right" class="celdaContenido">
		  <?php 
		  //<a href="<?php echo base_url().'index.php/'.$this->clasecrud.'/index/'.MODO_INCLUIR.'/'.$this->Mfrmclass->nombre_tabla.'/0/'.$this->uri->segment(1);
		  //">Nuevo Registro</a> 
		  
		  echo anchor($this->clasecrud.'/index/'.MODO_INCLUIR.$this->Mfrmclass->nombre_tabla.'/0/'.$this->uri->segment(1),'<img alt="Agregar" src="'.base_url().'system/application/views/imagenes/agregar.png" border="0">');
		  ?>		  </td>
        </tr>
        <tr >
          <td height="20" align="center"><?php echo $this->pagination->create_links(); ?> </td>
        </tr>
      </tfoot>
    </table>
    </form>
  </div>
</div>



<div class="listado">
  <div align="center"></div>
</div>

</body>
</html>
