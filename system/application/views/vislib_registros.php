<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php $this->mod_usuario->en_session(); ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" href="<?php  echo base_url(); ?>system/application/views/estilos/lista.css" type="text/css" />
<script type="text/javascript" src="<?php echo base_url();?>system/application/views/js_menu/stmenu.js"></script>

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

<head>
<link rel="stylesheet" href="<?php  echo base_url(); ?>system/application/css/mainstyle2.css" type="text/css" />
<!-- Script para adaptar footer según resolución -->
<?php echo $xajax_js?>
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

 <style type="text/css">
<!--
body {

	background-image: url(<?php echo base_url(); ?>system/application/views/imagenes/bg2.gif);
	background-repeat: no-repeat;
	background-color: #a7d0e4;
}
}
-->
</style>

</head>

<body bgcolor="#FFFFFF" text="#000000" link="#0066FF" vlink="#9933FF" alink="#FF3333">


<?php echo $menu;?>
<br>
<div class="Titulo" align="center">
<?php echo $this->encabezado; ?>
</div>
<br>
</div>
<div class="busqueda">
<?php echo form_open($this->accion); ?>
      <table width="800" height="33" align="center" bgcolor="#E9E8E2">
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
            </div></td><td width="240"><div id="DivCampoFiltro">
              <?php
              $tipo_result = $this->Mfrmclass->ObtAttCampo($this->Mfrmclass->nombre_tabla,$this->centinela->getcampo1());
              $tipo_dato = $tipo_result['tipo'];

                if($tipo_dato == 'bool'){
                    if($this->centinela->getcampo3() <> ''){
                      if(trim($this->centinela->getcampo3()) == 'true'){
                        $valor = '<input type="radio" name="CampoFiltro" value="true" checked="checked">Sí</>
                                 <input type="radio" name="CampoFiltro" value="false">No</> ';
                      }else{
                        $valor = '<input type="radio" name="CampoFiltro" value="true" >Sí</>
                                 <input type="radio" name="CampoFiltro" value="false" checked="checked">No</> ';
                      }
                      echo $valor;
                    }
                }else{
                    $valor = $this->centinela->getcampo3()<>''?$this->centinela->getcampo3():'';
                    echo '<input type="text" name="CampoFiltro" id="CampoFiltro" maxlength="20"  size="40" style="width:400px"
                         value="'.$valor.'">';
                }
                    
              ?>
              </div>
          </td>
          <td><input type="submit" name="boton" value="Filtra" class="inputsubmit" /></td>
        </tr>
  </table>
  <table width="799" align="center" bgcolor="#E9E8E2" >
    <thead align="center">
    <tr>
      <td align="right">&nbsp;</td>
      <td align="right">&nbsp;</td>
      <td align="right"><a href="<?php echo base_url().'index.php/'.$this->clasecrud.'/index/'.MODO_INCLUIR.'/'.$this->Mfrmclass->nombre_tabla.'/0/'.$this->uri->segment(1);?>"><img src="<?php echo base_url();?>system/application/views/imagenes/agregar.png" width="100" height="23" border="0" title="Nuevo Registro" /></a></td>
      <tr style="text-align:center">
       <td width="687" class="celda">&nbsp;</td>
       <td width="100" class="celda">Modificar</td>
       <?php
      $colnum = 1;
      foreach($this->Tit_Tabla as $titulos):
       if (!$this->Mfrmclass->EsExcepcion($titulos)){
           if($this->col_anc <> '')
            echo "<th class=\"celda\" width=\"".$this->col_anc[$colnum++]."%\" style=\"text-align:left\" colspan=\"\">".$this->Mfrmclass->CrearTitulo($titulos)."</th>";
           else
            echo "<th class=\"celda\" width=\"30%\" style=\"text-align:left\" colspan=\"\">".$this->Mfrmclass->CrearTitulo($titulos)."</th>";
         }
      endforeach;?>
        <td width="100" class="celda">Eliminar</td>
      </tr>
    
    <?php foreach($this->campos_lv as $fila):?>
    <tbody>
      <tr>
        <td align="center">&nbsp;</td>
        <td align="center"><?php   $i_campo = 0;
                foreach($this->Tit_Tabla as $titulos){
                      $ver_tipo = $this->Mfrmclass->obtattcampo($this->Mfrmclass->nombre_tabla,$titulos);
                      if($ver_tipo['tipo'] == 'date'  ){
                         echo "<td class=\"celdaContenido\" align=\"left\">".$this->mylib_base->pg_to_human($fila[$titulos])."</td>";}
                      if($ver_tipo['tipo'] == 'bool'  ){
                        if($fila[$titulos] === 't') {
                          echo "<td align=\"center\">Si</td>";}
                        else{
                          echo "<td align=\"center\">No</td>";}
                      }
                      if($ver_tipo['tipo'] == 'int2' or $ver_tipo['tipo'] == 'int4'  ){
                      echo "<td align=\"right\">".number_format($fila[$titulos],0,',','.')."</td>";}
                      if($ver_tipo['tipo'] == 'numeric'){
                        echo "<td align=\"right\">".number_format($fila[$titulos],2,',','.')."</td>";}
                      if($ver_tipo['tipo'] == 'varchar' or $ver_tipo['tipo'] == '' ){
                         echo "<td class=\"celdaContenido\">".$fila[$titulos]."</td>";}
                  }
                  ?><a href="<?php echo base_url().'index.php/'.$this->clasecrud.'/index/'.MODO_MODIFICAR.'/'.$this->Mfrmclass->nombre_tabla.'/'.$fila[$this->Mfrmclass->campo_clave]."/".$this->uri->segment(1);?>"><img src="<?php echo base_url();?>system/application/views/imagenes/modificar.png" width="20" height="20" border="0" title="Modificar" /></a></td>
        
        <div style="width:40px; float:right">
        <td align="center"><a href="<?php echo base_url().'index.php/'.$this->clasecrud.'/index/'.MODO_BORRAR.'/'.$this->Mfrmclass->nombre_tabla.'/'.$fila[$this->Mfrmclass->campo_clave]."/".$this->uri->segment(1);?>"><img src="<?php echo base_url();?>system/application/views/imagenes/eliminar.png" width="20" height="20" border="0" title="Eliminar"  onclick="return confirm('¿Esta seguro de borrar este registro?');"/></a></td>
        </div>
      </tr>
    </tbody>
    <?php endforeach;?>
    <tfoot>
      <tr> 
      <td colspan="3"><div align="right"><?php //echo "Registros : $this->TotalRegistros"; ?>&nbsp;</div>        </td>
      </tr>
      <tr>
        <td align="right" colspan="3">
        <a href="<?php echo base_url().'index.php/'.$this->clasecrud.'/index/'.MODO_INCLUIR.'/'.$this->Mfrmclass->nombre_tabla.'/0/'.$this->uri->segment(1);?>">
          <img src="<?php echo base_url();?>system/application/views/imagenes/agregar.png" width="100" height="23" border="0" title="Nuevo Registro" />        </a>        </td>
      </tr>
    
      <tr >
        <td height="20" colspan="3" align="center"><?php echo $this->pagination->create_links(); ?> </td>
      </tr>
    </tfoot>
  </table>


</div>


</body>
</html>
