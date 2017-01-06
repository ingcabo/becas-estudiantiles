<?php $this->mod_usuario->en_session(); ?>
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
		marcar_todos(document.reporte_beca_nomina.instituto);
	    xajax_obtieneCarrera(xajax.getFormValues(reporte_beca_nomina));
}
	
function limpiar_instituto(){
		desmarcar_todos(document.reporte_beca_nomina.instituto);
	    xajax_obtieneCarrera(xajax.getFormValues(reporte_beca_nomina));
}


function todos_carrera(){
		marcar_todos(document.reporte_beca_nomina.carrera);
	    
}
	
function limpiar_carrera(){
		desmarcar_todos(document.reporte_beca_nomina.carrera);
	   
}




function todos_banco(){
		marcar_todos(document.reporte_beca_nomina.banco);
		
	    
}
	
function limpiar_banco(){
		desmarcar_todos(document.reporte_beca_nomina.banco);
		
	   
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
Reporte de Nómina Beca Becario </p>

 <?php $atributos = array('name' => 'reporte_beca_nomina')?>
 <?php echo form_open('con_rep_nomina_becaBecario/const_nomina_becaBecario',$atributos ); ?>
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
 <table width="762" height="308" border="0"  align="center" bgcolor="#E9E8E2">
   
    
    <tr>
      <td width="377" height="23" class="celda" ><strong>Instituto</strong></td>
      <td width="375" class="celda"><strong>Carrera</strong></td>
    </tr>
    <tr>
      <td height="26" align="right"  class="celda"><input type="button" onClick="todos_instituto()"  value="Todos" >
      <input type="button" onClick="limpiar_instituto()" value="Ninguno">      </td>
      <td  class="celda" align="right"><span class="celda1">
        <input name="button4" type="button"   onClick="todos_carrera()" value="Todos">
        <input name="button3" type="button" onClick="limpiar_carrera()" value="Ninguno"  >
      </span></td>
    </tr>
    <tr>
      <td height="202"><div id="div" style="width:377px; height:200px; z-index:1; background-color:e9e8e2; overflow: auto; left: 34px;   border: 1px none #000000; top: 391px;"> <font size="2"  face="Geneva, Arial, Helvetica, sans-serif">
        <?php foreach ($q_instituto -> result() as $row): 
        
		$data = array(
        'name'     => 'instituto[]',
        'id'       => 'instituto',
        'value'    => $row->instituto_id,
        'checked'  => true,
        'onClick' =>'xajax_obtieneCarrera(xajax.getFormValues(reporte_beca_nomina));'
		
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
      <td height="21" align="right"  class="celda">&nbsp;</td>
      <td  class="celda" ><strong>Banco</strong></td>
   </tr>
</table>


  <table  width="762" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
  <tr>
  <td colspan="3"  class="celda"><strong>Datos Específicos </strong></td>
  <td width="373" colspan="2" align="right"  class="celda">  <input name="button4" type="button"   onClick="todos_banco()" value="Todos">
    <input name="button3" type="button" onClick="limpiar_banco()" value="Ninguno"  ></td>
  </tr>

   <tr>
  <td width="109" class="celda">Nombre:</td>
  <td width="111">
   <div id="1" style="background-color:e9e8e2;  border: 1px none #000000;" >
        <SELECT NAME="snombre"  style="width:107px" >
                  <OPTION VALUE="0">Seleccione</OPTION>
				  <OPTION VALUE="1">Igual a</OPTION>
                  <OPTION VALUE="2">Que contenga</OPTION>
        </SELECT> 
     </div>  </td>
  <td width="165">
   <div id="7" style="background-color:e9e8e2;  border: 1px none #000000;" >
  <input type="text" name="name" id="name" value="" size="20">
  </div>  </td>
  <td colspan="2" rowspan="6" bgcolor="#E9E8E2" class="celdacontenido">
  <div id="capa_periodo" style="z-index:1; height:94px; background-color:e9e8e2; overflow: auto; left: 34px;   border: 1px none #000000; top: 391px;">
  
  <?php foreach ($q_banco -> result() as $row): 
        
		$data = array(
        'name'     => 'banco[]',
        'id'       => 'banco',
        'value'    => $row->banco_id,
        'checked'  => true,
          );
	    
	     echo form_checkbox($data).$row->nombre_banco."<br>";
	
        endforeach; ?>
  </div>  </td>
  </tr>
  <tr>
  <td width="109" class="celda">Apellido:</td>
  <td width="111">
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
    <td class="celda">Fecha Nomina: </td>
	<td bgcolor="#E9E8E2">
	 <div id="10" style="background-color:e9e8e2;  border: 1px none #000000;" >
	   <SELECT NAME="sfecha" style="width:107px">
                  <OPTION VALUE="0">Seleccione</OPTION>
                  <OPTION VALUE="1">Igual a</OPTION>
                  <OPTION VALUE="3">Menor/Igual a</OPTION>
				  <OPTION VALUE="4">Mayor/Igual a</OPTION>
        </SELECT> 
    </div>	</td>
		
	<td>
	 <div id="14" style="background-color:e9e8e2;  border: 1px none #000000;" >
	<input type="text" name="fecha" id="fecha" value="" size="10" maxlength="10"> 
	<img name="dFecCalendario" id="dFecCalendario" src="<?php echo base_url(); ?>system/application/views/imagenes/calendario.png" width="16" height="16" />
    <!-- Inicio de: Iniciar DataPick. -->
    <script type="text/javascript">
	var campoId = 'fecha';
	var imagenId = 'dFecCalendario';
		
		
	iniciarCalendario(campoId, imagenId,'%d-%m-%Y',false);
	</script> 
	</div>	</td>
	</tr>
	<tr>
	  <td class="celda">Cédula:</td>
	  <td bgcolor="#E9E8E2"><span style="background-color:e9e8e2;  border: 1px none #000000;">
	    <select name="scedula" style="width:107px" >
          <option value="0">Seleccione</option>
          <option value="1">Igual a</option>
          <option value="3">Menor/Igual a</option>
          <option value="4">Mayor/Igual a</option>
        </select>
	  </span></td>
	  <td bgcolor="#E9E8E2"></td>
    </tr>
	<tr>
	  <td class="celda">Estatus Presupuesto:</td>
	  <td bgcolor="#E9E8E2"><span style="background-color:e9e8e2;  border: 1px none #000000;">
	    <select name="sstatus"  style="width:160px" >
          <option value="">Seleccione</option>
         <?php foreach ($q_estado_pre -> result() as $row): ?>
		 
		  <option value="<?php echo $row->estado_presupuesto_id; ?>"><?php echo $row->nombre_estado_presupuesto; ?></option>
         
		 <?php endforeach; ?>
        </select>
	  </span></td>
	  <td bgcolor="#E9E8E2"></td>
    </tr>
	<tr>
    <td height="3" colspan="3" bgcolor="#E9E8E2">
	  <div id="11" style="background-color:e9e8e2;  border: 1px none #000000;" ><font size="2" face="Geneva, Arial, Helvetica, sans-serif">Camibiar Estatus Beneficiario: </font><input type="checkbox" name="commit" id="commit" value="1"> </div>	 </td>
	</tr>
	
	
	<tr>
	<td height="24" colspan="5" align="right" bgcolor="#E9E8E2"><input name="button" type="submit"  value="Generar"/>
	  </div>	</td>
	</tr>
</table>
  
</form>
</body>
</html>