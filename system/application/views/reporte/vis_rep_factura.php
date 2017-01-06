<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<script type="text/javascript" src="<?php  echo base_url(); ?>system/application/js/general.js"></script>
<!-- Inicio de: JS y CSS para el DataPick. -->
<script type="text/javascript" src="<?php echo base_url(); ?>system/application/js/calendario/jscripts/scripts.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>system/application/js/calendario/jscripts/calendar/calendar.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>system/application/js/calendario/jscripts/calendar/calendar-es.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>system/application/js/calendario/jscripts/calendar/calendar-setup.js"></script>

<link media="screen" href="<?php echo base_url(); ?>system/application/js/calendario/styles/calendar-blue.css" rel="stylesheet" type="text/css" title="win2k-cold-1">
<link media="print" href="<?php echo base_url(); ?>system/application/js/calendario/styles/print.css" rel="stylesheet" type="text/css" title="win2k-cold-1">
<!--    Fin de: JS y CSS para el DataPick. -->

<title>..::Reporte Facturas::..</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css">
<!--
.celda
{
  background-image: url(<?php echo base_url(); ?>system/application/views/imagenes/fondoCelda.bmp);
  color:black;
  font-family: Geneva, Arial, Helvetica, sans-serif; font-size:12px;
}

.celdaError
{
  color:red;
  
  font-family: Geneva, Arial, Helvetica, sans-serif; font-size:12px;
}

.Titulo {color: black; font-family: Arial, Helvetica, sans-serif; font-size: 30px;}

.lable{

font-family: Geneva, Arial, Helvetica, sans-serif; font-size:12px;
}
-->
</style>
<?php echo  $xajax_js; ?> 
<script type="text/javascript">
function marcar_todos(grupo){
	  
		if(grupo==null){
		alert("No hay elementos para seleccionar");
		return 0;
		}
		
 		for (i = 0; i < grupo.length; i++){
			grupo[i].checked = true;
		}
	}
	

function desmarcar_todos(grupo){
	   
		if(grupo==null){
		alert("No hay elementos para seleccionar");
		return 0;
		}
	
 		for (i = 0; i < grupo.length; i++){
			grupo[i].checked = false;
		}
 	}

function todos_instituto(){
		marcar_todos(document.reporte_factura.instituto);
	    xajax_obtieneCarrera(xajax.getFormValues(reporte_factura));
}
	
function limpiar_instituto(){
		desmarcar_todos(document.reporte_factura.instituto);
	    xajax_obtieneCarrera(xajax.getFormValues(reporte_factura));
}


function todos_periodo(){
		marcar_todos(document.reporte_factura.periodo);
	    
}
	
function limpiar_periodo(){
		desmarcar_todos(document.reporte_factura.periodo);
	   
}






</script>
<LINK REL=StyleSheet HREF="<?php echo base_url(); ?>system/application/views/estilos/lista.css" TYPE="text/css" MEDIA=screen>
<style type="text/css">
<!--
.celda
{
  background-image: url(<?php echo base_url(); ?>system/application/views/imagenes/fondoCelda.bmp);
  color:black;
  font-family: Geneva, Arial, Helvetica, sans-serif; font-size:12px;
}
.celda1 {  background-image: url(<?php echo base_url(); ?>system/application/views/imagenes/fondoCelda.bmp);
  color:black;
  font-family: Geneva, Arial, Helvetica, sans-serif; font-size:12px;
}
.celda1 {  background-image: url(<?php echo base_url(); ?>system/application/views/imagenes/fondoCelda.bmp);
  color:black;
  font-family: Geneva, Arial, Helvetica, sans-serif; font-size:12px;
}
body {
	background-image: url(<?php echo base_url(); ?>system/application/views/imagenes/bg2.gif);
	background-repeat: no-repeat;
	background-color: #a7d0e4;
}
-->
</style>
<?php echo $xajax_js; ?> 
</head>

<body class="fondo">
 <?php echo $menu; ?>
<p align="center" class="Titulo">Reportes Facturas </p>

 <?php $atributos = array('name' => 'reporte_factura')?>
 <?php echo form_open('con_rep_factura/const_rep_factura',$atributos ); ?>
 <table width="762" height="333" border="0"  align="center" bgcolor="#E9E8E2">
   <tr>
      <td width="377" height="21"><span class="celdaError"><?php echo validation_errors(); ?></span></td>
     <td width="375"><div id="capa">&nbsp;</div></td>
   </tr>
    <tr>
      <td height="23"><?php
          echo anchor('jel/index','<img alt="Volver" src="'.base_url().'system/application/views/imagenes/volver.png" border="0">');
          ?></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td height="23" class="celda" ><strong>Instituto</strong></td>
      <td class="celda"><strong>Periodo</strong></td>
    </tr>
    <tr>
      <td height="28" align="right"  class="celda"><input type="button" onClick="todos_instituto()"  value="Todos" >
          <input type="button" onClick="limpiar_instituto()" value="Ninguno">      </td>
      <td  class="celda" align="right"><span class="celda1">
        <input name="button4" type="button"   onClick="todos_periodo()" value="Todos">
        <input name="button3" type="button" onClick="limpiar_periodo()" value="Ninguno"  >
      </span></td>
    </tr>
    <tr>
      <td height="203"><div id="div" style="width:377px; height:200px; z-index:1; background-color:e9e8e2; overflow: auto; left: 34px;   border: 1px none #000000; top: 391px;"> <font size="2"  face="Geneva, Arial, Helvetica, sans-serif">
        <?php foreach ($q_instituto -> result() as $row): 
        
		$data = array(
        'name'     => 'instituto[]',
        'id'       => 'instituto',
        'value'    => $row->instituto_id,
        'checked'  => true,
       
		
          );
	    
	     echo form_checkbox($data).''.$row->siglas_instituto."<br>";
	
        endforeach; ?>
      </font></div> </td>
      <td><div  class="div"  id="capa_periodo"   name="capa_periodo"  style="width:375px; height:200px; background-color:e9e8e2; z-index:1; overflow: auto; left: 34px;   border: 1px none #000000; top: 391px;">
	  <font size="2"  face="Geneva, Arial, Helvetica, sans-serif">
	  <?php foreach ($q_periodo -> result() as $row): 
        
		$data = array(
        'name'     => 'periodo[]',
        'id'       => 'periodo',
        'value'    => $row->periodo_id,
        'checked'  => true,
          );
	    
	     echo form_checkbox($data).$row->ano_periodo.'-'.$row->nombre_modalidad."<br>";
	
        endforeach; ?>
	  </font>
	  </div></td>
    </tr>
  
    <tr>
      <td height="21">&nbsp;</td>
      <td>&nbsp;</td>
   </tr>
 
</table>


<table width="766" height="55" align="center" bgcolor="#E9E8E2">
<tr>
<td width="140" class="celda">Fecha  Factura </td>
<td width="107"><SELECT NAME="sfechafact" style="width:107px">
                  <OPTION VALUE="0">Seleccione</OPTION>
                  <OPTION VALUE="1">Igual a</OPTION>
                  <OPTION VALUE="2">Mayor/Igual a</OPTION>
				  <OPTION VALUE="3">Menor/Igual a</OPTION>
    </SELECT></td>
<td width="143"><input type="text" name="fechafact"  size="8" maxlength="10"  />
	<img name="dFecCalendario" id="dFecCalendario" src="<?php echo base_url(); ?>system/application/views/imagenes/calendario.png" width="16" height="16" />
    <!-- Inicio de: Iniciar DataPick. -->
    <script type="text/javascript">
	var campoId = 'fechafact';
	var imagenId = 'dFecCalendario';
		
		
	iniciarCalendario(campoId, imagenId,'%d-%m-%Y',false);
	</script>


</td>
<td width="356">&nbsp;</td>
</tr>
<tr>
<td class="celda">Fecha Recepcion Factura</td>
<td><SELECT NAME="sfecharep" style="width:107px">
                  <OPTION VALUE="0">Seleccione</OPTION>
                  <OPTION VALUE="1">Igual a</OPTION>
                  <OPTION VALUE="2">Mayor/Igual a</OPTION>
				  <OPTION VALUE="3">Menor/Igual a</OPTION>
        </SELECT></td>
<td><input type="text" name="fecharep"  size="8" maxlength="10" />
<img name="dFecCalendario2" id="dFecCalendario2" src="<?php echo base_url(); ?>system/application/views/imagenes/calendario.png" width="16" height="16" />
    <!-- Inicio de: Iniciar DataPick. -->
    <script type="text/javascript">
	var campoId = 'fecharep';
	var imagenId = 'dFecCalendario2';
		
		
	iniciarCalendario(campoId, imagenId,'%d-%m-%Y',false);
	</script>


</td>
<td>&nbsp;</td>
</tr>

<tr>
<td class="celda">Estatus</td>
<td><SELECT NAME="sstatus"  style="width:107px" >
                  <OPTION VALUE="0">Seleccione</OPTION>
				  <OPTION VALUE="1">Activo</OPTION>
                  <OPTION VALUE="2">Congelado</OPTION>
        </SELECT></td>
<td>&nbsp;</td>
<td align="left"><input type="submit" name="Generar" ></td>
</tr>

</table>

  </form>
  <p>&nbsp;</p>
</body>
</html>