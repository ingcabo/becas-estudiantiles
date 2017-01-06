
<?php $this->mod_usuario->en_session(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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

<title>..::Reporte Beca Ayuda::..</title>
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




function todos_banco(){
		marcar_todos(document.reporte_beca_ayuda.banco);
		
	    
}
	
function limpiar_banco(){
		desmarcar_todos(document.reporte_beca_ayuda.banco);
		
	   
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
</head>
 <?php echo $menu; ?>
<body class="fondo"> 
<p>
<p>
<p>
<p>
<p>
<p align="center" class="Titulo"><br>
Reporte de Nómina Beca Ayuda </p>
 <p>
   <?php $atributos = array('name' => 'reporte_beca_ayuda')?>
   <?php echo form_open('con_rep_beca_ayuda/const_rep_beca_ayuda',$atributos ); ?></p>

 <table width="760" border="0" align="center">
   <tr>
     <td><?php
          echo anchor('jel/index','<img alt="Volver" src="'.base_url().'system/application/views/imagenes/volver.png" border="0">');
          ?></td>
   </tr>
 </table>
<table  width="761" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">

  <tr>
  <td colspan="3"  class="celda"><strong>Datos Específicos </strong></td>
  <td width="369" align="right"  class="celda"><strong>Banco&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </strong>
    <input name="button4" type="button"   onClick="todos_banco()" value="Todos">
    <span class="celda1">
    <input name="button3" type="button" onclick="limpiar_banco()" value="Ninguno" />
    </span></td>
  <td width="1"></td>
  </tr>

   <tr>
  <td width="109" class="celda">Nombre:</td>
  <td width="107">
   <div id="1" style="background-color:e9e8e2;  border: 1px none #000000;" >
        <SELECT NAME="snombre"  style="width:107px" >
                  <OPTION VALUE="0">Seleccione</OPTION>
				  <OPTION VALUE="1">Igual a</OPTION>
                  <OPTION VALUE="2">Que contenga</OPTION>
        </SELECT> 
     </div>  </td>
  <td width="175">
   <div id="7" style="background-color:e9e8e2;  border: 1px none #000000;" >
  <input type="text" name="name" id="name" value="" size="20">
  </div>  </td>
  <td colspan="2" rowspan="5" bgcolor="#E9E8E2" class="celdacontenido">
  <div id="capa_periodo" style="z-index:1; height:94px; background-color:e9e8e2; overflow: auto; left: 34px;   border: 1px none #000000; top: 391px;"><font size="2" face="Geneva, Arial, Helvetica, sans-serif">
  
  <?php foreach ($q_banco -> result() as $row): 
        
		$data = array(
        'name'     => 'banco[]',
        'id'       => 'banco',
        'value'    => $row->banco_id,
        'checked'  => true,
          );
	    
	     echo form_checkbox($data).$row->nombre_banco."<br>";
	
        endforeach; ?>
  </font> </div>  </td>
  </tr>
  <tr>
  <td width="109" class="celda">Apellido:</td>
  <td width="107">
   <div id="2" style="background-color:e9e8e2;  border: 1px none #000000;" >
                  <SELECT NAME="sapellido"  style="width:107px">
                  <OPTION VALUE="0">Seleccione</OPTION>
				  <OPTION VALUE="1">Igual a</OPTION>
				  <OPTION VALUE="2">Que contenga</OPTION>
                  </SELECT>
    </div>  </td>
  <td>
   <div id="8" style="background-color:e9e8e2;  border: 1px none #000000;" >
  <input type="text" name="apellido" id="apellido" value="" size="20">
  </div>  </td>	 
  </tr>
  <tr>
    <td class="celda">Estatus:</td>
	<td>
	 <div id="10" style="background-color:e9e8e2;  border: 1px none #000000;" >
	   <select name="sstatus"  style="width:107px" >
       
	     <option value="">Seleccione</option>
       
	   <?php foreach ($q_estado_persona -> result() as $row): ?>  
		 <option value="<?php echo $row->estado_persona_id; ?>"><?php echo $row->nombre_estado_persona; ?></option>
       <?php endforeach; ?>
	     
       </select>
	 </div>	</td>
		
	<td>
    <div id="14" style="background-color:e9e8e2;  border: 1px none #000000;" >	</div>	</td>
  </tr>
	<tr>
	  <td height="22">&nbsp;</td>
	  <td>&nbsp;</td>
	  <td bgcolor="#E9E8E2"></td>
  </tr>
	<tr>
    <td colspan="3" bgcolor="#E9E8E2">
	  <div id="11" style="background-color:e9e8e2;  border: 1px none #000000;" ></div></td>
	</tr>
	<tr>
	<td colspan="12" align="right" bgcolor="#E9E8E2"><span style="background-color:e9e8e2;  border: 1px none #000000;">
	  <input name="button" type="submit"  value="Generar" />
	</span> </td>
	</tr>
</table>
</form> 
<body>
</body>
</html>
