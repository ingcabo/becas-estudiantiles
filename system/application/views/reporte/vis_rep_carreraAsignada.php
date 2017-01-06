<?php $this->mod_usuario->en_session(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>..::Reporte Carrera Asiganada::..</title>
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
		marcar_todos(document.reporte_carrera.instituto);
	    xajax_obtieneNucleo(xajax.getFormValues(reporte_carrera));
}
	
function limpiar_instituto(){
		desmarcar_todos(document.reporte_carrera.instituto);
	    xajax_obtieneNucleo(xajax.getFormValues(reporte_carrera));
}

function todos_nucleo(){
		marcar_todos(document.reporte_carrera.nucleo);
	    
}
	
function limpiar_nucleo(){
		desmarcar_todos(document.reporte_carrera.nucleo);
	   
}

function todos_carrera(){
		marcar_todos(document.reporte_carrera.carrera);
	    
}
	
function limpiar_carrera(){
		desmarcar_todos(document.reporte_carrera.carrera);
	   
}

function todos_periodo(){
		marcar_todos(document.reporte_carrera.periodo);
	    
}
	
function limpiar_periodo(){
		desmarcar_todos(document.reporte_carrera.periodo);
	   
}

function todos_municipio(){
		marcar_todos(document.reporte_carrera.municipio);
		xajax_obtieneParroquia(xajax.getFormValues(reporte_carrera));
	    
}
	
function limpiar_municipio(){
		desmarcar_todos(document.reporte_carrera.municipio);
		xajax_obtieneParroquia(xajax.getFormValues(reporte_carrera));
	   
}

function todos_parroquia(){
		marcar_todos(document.reporte_carrera.parroquia);
		
	    
}
	
function limpiar_parroquia(){
		desmarcar_todos(document.reporte_carrera.parroquia);
		
	   
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
 <p><?php echo $menu; ?></p>
 <p>&nbsp;</p>
 <p>&nbsp; </p>
 <p align="center" class="Titulo"> Reporte de Institutos, Carreras y Materias </p>

 <?php $atributos = array('name' => 'reporte_carrera')?>
 <?php echo form_open('con_rep_inst_carreraAsignada/const_rep_inst_carreraAsignada',$atributos ); ?>
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
      <td width="375" bgcolor="#E9E8E2" class="celda" ><strong>Instituto</strong></td>
      <td width="375" bgcolor="#E9E8E2" class="celda"><strong>Carrera</strong></td>
    </tr>
    <tr bgcolor="#E9E8E2">
      <td height="28" align="right"  class="celda"><input type="button" onClick="todos_instituto()"  value="Todos" >
          <input type="button" onClick="limpiar_instituto()" value="Ninguno">      </td>
      <td align="right"  class="celda"><span class="celda1">
        <input name="button4" type="button"   onClick="todos_carrera()" value="Todos">
        <input name="button3" type="button" onClick="limpiar_carrera()" value="Ninguno"  >
      </span></td>
    </tr>
    <tr>
      <td height="203"><div id="div_instituto"  name="div_instituto" style="width:377px; height:200px; z-index:1; background-color:e9e8e2; overflow: auto; left: 34px;   border: 1px none #000000; top: 391px;"> <font size="2"  face="Geneva, Arial, Helvetica, sans-serif">
        <?php foreach ($q_instituto -> result() as $row): 
        
		$data = array(
        'name'     => 'instituto[]',
        'id'       => 'instituto',
        'value'    => $row->instituto_id,
        'checked'  => true,
        'onClick' =>'xajax_obtieneNucleo(xajax.getFormValues(reporte_carrera));'
		
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
      <td height="202"><div id="div_municipio"  name=="div_municipio" style="width:377px; height:200px; z-index:1; background-color:e9e8e2; overflow: auto; left: 34px;   border: 1px none #000000; top: 391px;"><span style="width:250px; height:154px; background-color:e9e8e2; z-index:1; overflow: auto; left: 34px;   border: 1px none #000000; top: 391px;"><font size="2" face="Geneva, Arial, Helvetica, sans-serif">
        <?php foreach ($q_municipio -> result() as $row): 
        
		$data = array(
        'name'     => 'municipio[]',
        'id'       => 'municipio',
        'value'    => $row->municipio_id,
        'checked'  => true,
		'onClick' =>'xajax_obtieneParroquia(xajax.getFormValues(reporte_carrera));'
          );
	    
	     echo form_checkbox($data).$row->nombre_municipio."<br>";
	
        endforeach; ?>
      </font></span></div></td>
      <td><div id="capa_parroquia"   name="capa_parroquia"  style="width:375px; height:200px; background-color:e9e8e2; z-index:1; overflow: auto; left: 34px;   border: 1px none #000000; top: 391px;"><span style="width:250px; height:154px; z-index:1; background-color:e9e8e2; overflow: auto; left: 34px;   border: 1px none #000000; top: 391px;"><font size="2" face="Geneva, Arial, Helvetica, sans-serif">
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


  <table  width="762" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
  <td height="24" colspan="3"  >&nbsp;</td>
  <td width="377" colspan="2" align="right" ><input type="submit" name="boton" value="Generar"></td>
  </tr>
</table>
  
 
  
</form>
</body>
</html>

