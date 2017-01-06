<?php $this->mod_usuario->en_session(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>..::Reporte Beneficiario::..</title>
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
		marcar_todos(document.reporte_beneficiario.instituto);
	    xajax_obtieneNucleo(xajax.getFormValues(reporte_beneficiario));
}
	
function limpiar_instituto(){
		desmarcar_todos(document.reporte_beneficiario.instituto);
	    xajax_obtieneNucleo(xajax.getFormValues(reporte_beneficiario));
}

function todos_nucleo(){
		marcar_todos(document.reporte_beneficiario.nucleo);
	    
}
	
function limpiar_nucleo(){
		desmarcar_todos(document.reporte_beneficiario.nucleo);
	   
}

function todos_carrera(){
		marcar_todos(document.reporte_beneficiario.carrera);
	    
}
	
function limpiar_carrera(){
		desmarcar_todos(document.reporte_beneficiario.carrera);
	   
}

function todos_periodo(){
		marcar_todos(document.reporte_beneficiario.periodo);
	    
}
	
function limpiar_periodo(){
		desmarcar_todos(document.reporte_beneficiario.periodo);
	   
}

function todos_municipio(){
		marcar_todos(document.reporte_beneficiario.municipio);
		xajax_obtieneParroquia(xajax.getFormValues(reporte_beneficiario));
	    
}
	
function limpiar_municipio(){
		desmarcar_todos(document.reporte_beneficiario.municipio);
		xajax_obtieneParroquia(xajax.getFormValues(reporte_beneficiario));
	   
}

function todos_parroquia(){
		marcar_todos(document.reporte_beneficiario.parroquia);
		
	    
}
	
function limpiar_parroquia(){
		desmarcar_todos(document.reporte_beneficiario.parroquia);
		
	   
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

<body class="fondo">
 <?php echo $menu; ?>
<p align="center" class="Titulo"><br>
Reporte Beca Promedio </p>

 <?php $atributos = array('name' => 'reporte_beneficiario')?>
 <?php echo form_open('con_rep_becaPromedio/const_becaPromedio',$atributos ); ?>
 <table width="760" border="0" align="center">
   <tr>
     <td><span class="celdaError">
       <?php echo validation_errors(); ?>
       <?php
          echo anchor('jel/index','<img alt="Volver" src="'.base_url().'system/application/views/imagenes/volver.png" border="0">');
          ?>
     </span></td>
   </tr>
 </table>
 <table width="760" height="556" border="0"  align="center" bgcolor="#E9E8E2">
   
    
    <tr>
      <td width="375" class="celda" ><strong>Instituto</strong></td>
      <td width="375" class="celda"><strong>Carrera</strong></td>
    </tr>
    <tr>
      <td height="28" align="right"  class="celda"><input type="button" onClick="todos_instituto()"  value="Todos" >
          <input type="button" onClick="limpiar_instituto()" value="Ninguno">      </td>
      <td  class="celda" align="right"><span class="celda1">
        <input name="button4" type="button"   onClick="todos_carrera()" value="Todos">
        <input name="button3" type="button" onClick="limpiar_carrera()" value="Ninguno"  >
      </span></td>
    </tr>
    <tr bgcolor="#E9E8E2">
      <td height="203"><div id="div" style="width:377px; height:200px; z-index:1; background-color:e9e8e2; overflow: auto; left: 34px;   border: 1px none #000000; top: 391px;"> <font size="2"  face="Geneva, Arial, Helvetica, sans-serif">
        <?php foreach ($q_instituto -> result() as $row): 
        
		$data = array(
        'name'     => 'instituto[]',
        'id'       => 'instituto',
        'value'    => $row->instituto_id,
        'checked'  => true,
        'onClick' =>'xajax_obtieneNucleo(xajax.getFormValues(reporte_beneficiario));'
		
          );
	    
	     echo form_checkbox($data).''.$row->siglas_instituto."<br>";
	
        endforeach; ?>
      </font></div> </td>
      <td><div  class="div"  id="capa_carrera"   name="capa_carrera"  style="width:375px; height:200px; background-color:e9e8e2; z-index:1; overflow: auto; left: 34px;   border: 1px none #000000; top: 391px;"><span style="width:250px; height:154px; z-index:1; background-color:e9e8e2; overflow: auto; left: 34px;   border: 1px none #000000; top: 391px;"><font size="2" face="Geneva, Arial, Helvetica, sans-serif">
        <?php foreach ($q_car_inst -> result() as $row): 
    
	    $data = array(
        'name'     => 'carrera[]',
        'id'       => 'carrera',
        'value'    => $row->carrera_instituto_id,
        'checked'  => TRUE,
                  );
	      
	     echo form_checkbox($data).' '.$row->siglas_instituto."-".$row->nombre_carrera."<br>";
	     endforeach; ?>
      </font></span></div></td>
    </tr>
    <tr>
      <td class="celda"> <strong> Municipio </strong> </td>
      <td class="celda">  <strong>Parroquia</strong> </td>
    </tr>
    <tr>
      <td  class="celda" align="right"><input type="button" value="Todos"   onClick="todos_municipio()" >
          <input type="button" value="Ninguno" onClick="limpiar_municipio()">      </td>
      <td  class="celda" align="right"><span class="celda1">
        <input name="button2" type="button"   onClick="todos_parroquia()" value="Todos" >
        <input name="button" type="button" onClick="limpiar_parroquia()" value="Ninguno" >
      </span></td>
   </tr>
    <tr>
      <td height="202"><div id="div3" style="width:377px; height:200px; z-index:1; background-color:e9e8e2; overflow: auto; left: 34px;   border: 1px none #000000; top: 391px;"><span style="width:250px; height:154px; background-color:e9e8e2; z-index:1; overflow: auto; left: 34px;   border: 1px none #000000; top: 391px;"><font size="2" face="Geneva, Arial, Helvetica, sans-serif">
        <?php foreach ($q_municipio -> result() as $row): 
        
		$data = array(
        'name'     => 'municipio[]',
        'id'       => 'municipio',
        'value'    => $row->municipio_id,
        'checked'  => true,
		'onClick' =>'xajax_obtieneParroquia(xajax.getFormValues(reporte_beneficiario));'
          );
	    
	     echo form_checkbox($data).$row->nombre_municipio."<br>";
	
        endforeach; ?>
      </font></span></div></td>
      <td><div id="capa_parroquia"  name="capa_parroquia"  style="width:375px; height:200px; background-color:e9e8e2; z-index:1; overflow: auto; left: 34px;   border: 1px none #000000; top: 391px;"><span style="width:250px; height:154px; z-index:1; background-color:e9e8e2; overflow: auto; left: 34px;   border: 1px none #000000; top: 391px;"><font size="2" face="Geneva, Arial, Helvetica, sans-serif">
        <?php foreach ($q_parroquia -> result() as $row): 
        
		$data = array(
        'name'     => 'parroquia[]',
        'id'       => 'parroquia',
        'value'    => $row->parroquia_id,
        'checked'  => true,
          );
	    
	     echo form_checkbox($data).$row->nombre_parroquia."<br>";
	
        endforeach; ?>
      </font></span></div></td>
    </tr>
</table>


  <table  width="762" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
  <tr>
  <td colspan="3"  class="celda"><strong>Datos Específicos </strong></td>
  <td colspan="2"  class="celda"><strong>Período</strong></td>
  </tr>
<tr>
  <td colspan="3"  class="celda">&nbsp;</td>
  <td colspan="2"  class="celda" align="right">
   <input name="button2" type="button"   onClick="todos_periodo()" value="Todos" >
   <input name="button" type="button" onClick="limpiar_periodo()" value="Ninguno" >  </td>
  </tr>
   <tr>
  <td width="109" class="celda">Nombre:</td>
  <td width="122">
   <div id="1" style="background-color:e9e8e2;  border: 1px none #000000;" >
        <SELECT NAME="snombre" >
                  <OPTION VALUE="0">Seleccione</OPTION>
				  <OPTION VALUE="1">Igual a</OPTION>
                  <OPTION VALUE="2">Que contenga</OPTION>
        </SELECT> 
     </div>  </td>
  <td width="157">
   <div id="7" style="background-color:e9e8e2;  border: 1px none #000000;" >
  <input type="text" name="nombre" id="nombre" value="" size="20">
  </div>  </td>
  <td colspan="2" rowspan="4" bgcolor="#E9E8E2" class="celdacontenido">
  <div id="capa_periodo" style="z-index:1; height:94px; background-color:e9e8e2; overflow: auto; left: 34px;   border: 1px none #000000; top: 391px;">
  
  <?php foreach ($q_periodo -> result() as $row): 
        
		$data = array(
        'name'     => 'periodo[]',
        'id'       => 'periodo',
        'value'    => $row->periodo_id,
        'checked'  => true,
          );
	    
	     echo form_checkbox($data).$row->ano_periodo.'-'.$row->parcial_periodo."<br>";
	
        endforeach; ?>
  </div>  </td>
  </tr>
  <tr>
  <td width="109" class="celda">Apellido:</td>
  <td width="122">
   <div id="2" style="background-color:e9e8e2;  border: 1px none #000000;" >
                  <SELECT NAME="sapellido" >
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
    <td class="celda">Cédula:</td>
	<td>
	 <div id="10" style="background-color:e9e8e2;  border: 1px none #000000;" >
	<SELECT NAME="scedula" >
                  <OPTION VALUE="0">Seleccione</OPTION>
                  <OPTION VALUE="1">Igual a</OPTION>
                  <OPTION VALUE="3">Menor/Igual a</OPTION>
				  <OPTION VALUE="4">Mayor/Igual a</OPTION>
        </SELECT> 
	  </div>	</td>
		
	<td>
	 <div id="14" style="background-color:e9e8e2;  border: 1px none #000000;" >
	<input type="text" name="promedio" id="promedio" value="" size="15" maxlength="15"> 
	</div>	</td>
	</tr>
	<tr>
	  <td height="22" bgcolor="#E9E8E2" class="celda">Promedio:</td>
	  <td bgcolor="#E9E8E2"><span style="background-color:e9e8e2;">
	    <select name="spromedio" >
          <option value="0">Seleccione</option>
          <option value="1">Igual a</option>
          <option value="3">Menor/Igual a</option>
          <option value="4">Mayor/Igual a</option>
        </select>
	  </span></td>
	  <td bgcolor="#E9E8E2"><span style="background-color:e9e8e2;;">
	    <input type="text" name="promedio" id="promedio" value="" size="5" maxlength="5">
	  </span></td>
    </tr>
	
	
	<tr>
	<td bgcolor="#E9E8E2">&nbsp;</td>
	<td bgcolor="#E9E8E2">&nbsp;</td>
	<td bgcolor="#E9E8E2">&nbsp;</td>
	<td width="212" bgcolor="#E9E8E2">&nbsp;</td>
	<td width="169" align="right" bgcolor="#E9E8E2"><font size="2"  face="Geneva, Arial, Helvetica, sans-serif">Generar Detalle</font>
	  <input type="checkbox" name="detalle" id="detalle" value="1" checked="checked"></td>
	</tr>
	<tr>
	<td height="24" bgcolor="#E9E8E2">&nbsp;</td>
	<td bgcolor="#E9E8E2">&nbsp;</td>
	<td bgcolor="#E9E8E2">&nbsp;</td>
	<td width="212" bgcolor="#E9E8E2">&nbsp;</td>
	<td width="169" align="right" bgcolor="#E9E8E2"><input type="submit" name="boton" value="Generar"></td>
	</tr>
</table>
  
</form>
</body>
</html>

