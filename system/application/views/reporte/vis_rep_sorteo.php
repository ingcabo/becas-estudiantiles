<?php $this->mod_usuario->en_session(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<!-- Inicio de: JS y CSS para el DataPick. -->
<script type="text/javascript" src="<?php echo base_url(); ?>system/application/js/calendario/jscripts/scripts.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>system/application/js/calendario/jscripts/calendar/calendar.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>system/application/js/calendario/jscripts/calendar/calendar-es.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>system/application/js/calendario/jscripts/calendar/calendar-setup.js"></script>

<link media="screen" href="<?php echo base_url(); ?>system/application/js/calendario/styles/calendar-blue.css" rel="stylesheet" type="text/css" title="win2k-cold-1">
<link media="print" href="<?php echo base_url(); ?>system/application/js/calendario/styles/print.css" rel="stylesheet" type="text/css" title="win2k-cold-1">
<!--    Fin de: JS y CSS para el DataPick. -->

<?php echo  $xajax_js; ?> 
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php print_r($_POST); ?>.::Reporte sorteo</title></head>
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
body {
	background-image: url(<?php echo base_url(); ?>system/application/views/imagenes/bg2.gif);
	background-repeat: no-repeat;
	background-color: #a7d0e4;
}
-->
</style>
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

function todos_municipio_sorteo(){
		marcar_todos(document.reporte_sorteo.municipio_sorteo);
	    xajax_obtieneParroquia_sorteo(xajax.getFormValues(reporte_sorteo));
}
	
function limpiar_municipio_sorteo(){
		desmarcar_todos(document.reporte_sorteo.municipio_sorteo);
	    xajax_obtieneParroquia_sorteo(xajax.getFormValues(reporte_sorteo));
}



function todos_parroquia_sorteo(){
		marcar_todos(document.reporte_sorteo.parroquia_sorteo);
	    
}
	
function limpiar_parroquia_sorteo(){
		desmarcar_todos(document.reporte_sorteo.parroquia_sorteo);
	   
}


function todos_municipio_habitad(){
		marcar_todos(document.reporte_sorteo.municipio_habitad);
	    xajax_obtieneParroquia_habitad(xajax.getFormValues(reporte_sorteo));
}
	
function limpiar_municipio_habitad(){
		desmarcar_todos(document.reporte_sorteo.municipio_habitad);
	    xajax_obtieneParroquia_habitad(xajax.getFormValues(reporte_sorteo));
}



function todos_parroquia_habitad(){
		marcar_todos(document.reporte_sorteo.parroquia_habitad);
	    
}
	
function limpiar_parroquia_habitad(){
		desmarcar_todos(document.reporte_sorteo.parroquia_habitad);
	   
}

function todos_instituto(){
		marcar_todos(document.reporte_sorteo.instituto);
	     xajax_obtieneCarrera(xajax.getFormValues(reporte_sorteo));
}
	
function limpiar_instituto(){
		desmarcar_todos(document.reporte_sorteo.instituto);
	    xajax_obtieneCarrera(xajax.getFormValues(reporte_sorteo));
}	


function todos_carrera(){
		marcar_todos(document.reporte_sorteo.carrera);
	     
}
	
function limpiar_carrera(){
		desmarcar_todos(document.reporte_sorteo.carrera);
	   
}	
		
	
	
</script>
<LINK REL=StyleSheet HREF="<?php echo base_url(); ?>system/application/views/estilos/lista.css" TYPE="text/css" MEDIA=screen>
</head>


<body>
<?php echo $menu; ?>
<p align="center" class="Titulo"><br>
Reporte de Sorteos </p>

 <?php $atributos = array('name' => 'reporte_sorteo')?>
 <?php echo form_open('con_rep_sorteo/const_sorteos',$atributos ); ?>
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
<table width="736px" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
      
      


      <tr>
      <td  class="celda"><strong>Municipio sorteo </strong></td>
      <td  class="celda"><strong>Parroquia sorteo</strong> </td>
      <td  class="celda">&nbsp;</td>
      </tr>
      <tr>
      <tr>
      <td  class="celda" align="right">

      <input type="button" onClick="todos_municipio_sorteo()"  value="Todos" >
      <input type="button" onClick="limpiar_municipio_sorteo()" value="Ninguno">      </td>
      <td  class="celda" align="right">
      <input type="button" value="Todos"    onClick="todos_parroquia_sorteo()"   >
      <input type="button" value="Ninguno"  onClick="limpiar_parroquia_sorteo()"  >      </td>
      <td  class="celda" align="right">&nbsp;</td>
      </tr>
	  <tr>
      <td style="height:154px" >
      <div id="capa_instituto" style="width:250px; height:154px; z-index:1; background-color:e9e8e2; overflow: auto; left: 34px;   border: 1px none #000000; top: 391px;"><font size="2" face="Geneva, Arial, Helvetica, sans-serif">
        <?php foreach ($q_municipio -> result() as $row): 
        
		$data = array(
        'name'     => 'municipio_sorteo[]',
        'id'       => 'municipio_sorteo',
        'value'    => $row->municipio_id,
        'checked'  => true,
		'onClick' =>'xajax_obtieneParroquia_sorteo(xajax.getFormValues(reporte_sorteo));'
          );
	    
	     echo form_checkbox($data).$row->nombre_municipio."<br>";
	
        endforeach; ?>
      </font> </div>	  </td>
	  <td style="height:154px" >
	  <div  class="div_texbox"    name="capa_parroquia_sorteo" id="capa_parroquia_sorteo"  style="width:250px; height:154px; background-color:e9e8e2; z-index:1; overflow: auto; left: 34px;   border: 1px none #000000; top: 391px;"><font size="2" face="Geneva, Arial, Helvetica, sans-serif">
	    <?php foreach ($q_parroquia -> result() as $row): 
        
		$data = array(
        'name'     => 'parroquia_sorteo[]',
        'id'       => 'parroquia_sorteo',
        'value'    => $row->parroquia_id,
        'checked'  => true,
          );
	    
	     echo form_checkbox($data).$row->nombre_parroquia."<br>";
	
        endforeach; ?>
	  </font> </div>	  </td>
      <td style="height:154px" >
      <div id="capa_instituto" style="width:250px; height:154px; z-index:1; background-color:e9e8e2; overflow: auto; left: 34px;   border: 1px none #000000; top: 391px;">
        <?php foreach ($q_instituto -> result() as $row): 
        
		
	    
		
	    
	
        endforeach; ?>
      </div>	  </td>
      </tr>
      <tr>
      <td  class="celda">
      <strong>
      Municipio Habitacion </strong>      </td>
      <td  class="celda"><strong>Parroquia Habitacion </strong></td>
      <td  class="celda"><strong>Carrera Solicitada </strong></td>
      </tr>
      <tr>
      <tr>
      <td  class="celda" align="right">

      <input type="button" value="Todos"   onClick="todos_municipio_habitad()" >
      <input type="button" value="Ninguno" onClick="limpiar_municipio_habitad()">      </td>
      <td  class="celda" align="right">
        <input name="button2" type="button" value="Todos" onClick="todos_parroquia_habitad()">
        <input name="button" type="button" value="Ninguno" onClick="limpiar_parroquia_habitad()"></td>
      <td  class="celda" align="right">
      <input type="button" value="Todos"   onClick="todos_carrera()" >
      <input type="button" value="Ninguno" onClick="limpiar_carrera()" >      </td>
      </tr>
      <td style="height:154px" >
      <div id="capa_periodo" style="width:250px; height:154px; z-index:1; background-color:e9e8e2; overflow: auto; left: 34px;   border: 1px none #000000; top: 391px;"><span style="width:250px; height:154px; background-color:e9e8e2; z-index:1; overflow: auto; left: 34px;   border: 1px none #000000; top: 391px;"><font size="2" face="Geneva, Arial, Helvetica, sans-serif">
        <?php foreach ($q_municipio -> result() as $row): 
        
		$data = array(
        'name'     => 'municipio_habitad[]',
        'id'       => 'municipio_habitad',
        'value'    => $row->municipio_id,
        'checked'  => true,
		'onClick' =>'xajax_obtieneParroquia_habitad(xajax.getFormValues(reporte_sorteo));'
          );
	    
	     echo form_checkbox($data).$row->nombre_municipio."<br>";
	
        endforeach; ?>
      </font></span></div>      </td>
      <td style="height:154px" >
      <div id="capa_parroquia_habitad"  style="width:250px; height:154px; background-color:e9e8e2; z-index:1; overflow: auto; left: 34px;   border: 1px none #000000; top: 391px;"><span style="width:250px; height:154px; z-index:1; background-color:e9e8e2; overflow: auto; left: 34px;   border: 1px none #000000; top: 391px;"><font size="2" face="Geneva, Arial, Helvetica, sans-serif">
        <?php foreach ($q_parroquia -> result() as $row): 
        
		$data = array(
        'name'     => 'parroquia_habitad[]',
        'id'       => 'parroquia_habitad',
        'value'    => $row->parroquia_id,
        'checked'  => true,
          );
	    
	     echo form_checkbox($data).$row->nombre_parroquia."<br>";
	
        endforeach; ?>
      </font></span></div>      </td>
      <td style="height:154px" >
      <div id="capa_carrera" style="width:250px; height:154px; z-index:1; background-color:e9e8e2; overflow: auto; left: 34px;   border: 1px none #000000; top: 391px;">
        <?php foreach ($q_car_inst -> result() as $row): 
    
	    $data = array(
        'name'     => 'carrera[]',
        'id'       => 'carrera',
        'value'    => $row->carrera,
        'checked'  => TRUE,
                  );
	      
	     echo form_checkbox($data).' '.'<font size="2" face="Geneva, Arial, Helvetica, sans-serif">'.$row->carrera."</fon><br>";
	     endforeach; ?>
      </div>	  </td>
      </tr>
</table>
<table  width="749" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
  <tr>
  <td colspan="6" class="celda"><strong>Datos Especificos </strong></td>
  </tr>

   <tr>
  <td width="96" class="celda">Nombre:</td>
  <td width="120">
   <div id="1" style="background-color:e9e8e2;  border: 1px none #000000;" >
        <SELECT NAME="snombre" >
                  <OPTION VALUE="0">Seleccione</OPTION>
				  <OPTION VALUE="1">Igual a</OPTION>
                  <OPTION VALUE="2">Que contenga</OPTION>
        </SELECT> 
     </div>  </td>
  <td width="126">
   <div id="7" style="background-color:e9e8e2;  border: 1px none #000000;" >
  <input type="text" name="nombre" id="nombre" value="" size="20">
  </div>  </td>
  <td width="131" class="celda">&nbsp;&nbsp;Número de Cedula:</td>
  <td width="118">
   <div id="3" style="background-color:e9e8e2;  border: 1px none #000000;" >
        <SELECT NAME="scedula" >
                  <OPTION VALUE="0">Seleccione</OPTION>
                  <OPTION VALUE="1">Igual a</OPTION>
                  <OPTION VALUE="2">Que contenga</OPTION>
				  <OPTION VALUE="3">Menor/Igual a</OPTION>
				  <OPTION VALUE="4">Mayor/Igual a</OPTION>
        </SELECT> 
	  </div>  </td>
  <td width="158">
   <div id="5" style="background-color:e9e8e2;  border: 1px none #000000;" >
  <input type="text" name="cedula" id="cedula" value="" size="20">
  </div>  </td>
  </tr>
  <tr>
  <td width="96" class="celda">Apellido:</td>
  <td width="120">
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
  <td width="131" class="celda">&nbsp;&nbsp;Sexo:</td>
  <td width="118">
   <div id="4" style="background-color:e9e8e2;  border: 1px none #000000;" >
        <SELECT NAME="ssexo" >
                  <OPTION VALUE="T">Seleccione</OPTION>
                  <OPTION VALUE="M">Masculino</OPTION>
                  <OPTION VALUE="F">Femenino</OPTION>
        </SELECT>
	  </div>	 </td>
  <td width="158" bgcolor="#E9E8E2">
   <div id="6" style="background-color:e9e8e2;  border: 1px none #000000;" size=20;></div>	</td>
  </tr>

  <tr>
 
  <td class="celda">Fecha Sorteo:</td>
  <td>
  <div id="16" style="background-color:e9e8e2;  border: 1px none #000000;" >
  <select name="sfecha" >
    <option value="0">Seleccione</option>
    <option value="1">Igual a</option>
    <option value="3">Menor/Igual a</option>
    <option value="4">Mayor/Igual a</option>
  </select>
  </div>  </td>
 
  <td class="celda">
   
  <input type="text" name="fecha" id="fecha" value="" size="10" />
  <img name="dFecCalendario" id="dFecCalendario" src="<?php echo base_url(); ?>system/application/views/imagenes/calendario.png" width="16" height="16" />
    <!-- Inicio de: Iniciar DataPick. -->
    <script type="text/javascript">
	var campoId = 'fecha';
	var imagenId = 'dFecCalendario';
		
		
	iniciarCalendario(campoId, imagenId,'%d-%m-%Y',false);
	</script> 
	</div>	</td>
  <td class="celda">&nbsp;&nbsp;Apto:</td>
  <td><div id="18" style="background-color:e9e8e2;  border: 1px none #000000;" >
  
  <SELECT NAME="sapto" >
  <OPTION VALUE="T">Seleccione</OPTION>
  <OPTION VALUE="S">Si</OPTION>
  <OPTION VALUE="N">No</OPTION>
        </SELECT>	
		</div>			</td>
  <td bgcolor="#E9E8E2"><div id="19" style="background-color:e9e8e2;  border: 1px none #000000;" size=20></div> </td>
  </tr>
  <tr>
  <td class="celda">Cod. Cartar: </td>
  <td>
    <input type="text" name="carta" id="carta" value="" size="15" />    </td>
  <td class="celda"></td>
  
  <td class="celda">&nbsp;&nbsp;N. Participaciones: </td>
  <td><select name="snumero" >
    <option value="0">Seleccione</option>
    <option value="1">Igual a</option>
    <option value="3">Menor/Igual a</option>
    <option value="4">Mayor/Igual a</option>
  </select></td>
  <td>
  <div id="20" style="background-color:e9e8e2;  border: 1px none #000000;" >
  <input type="text" name="numero" id="numero" value="" size="10">
  </div>   </td>
  </tr>
  <tr>
  <td height="25" class="celda">Lugar Sorteo:  </td>
  <td colspan="2">
  <div id="20" style="background-color:e9e8e2;  border: 1px none #000000;" >
  <input type="text" name="lugar" id="lugar" value="" size="30" /> 
  </div>
   </td>
  <td colspan="3" align="right"><font size="2" face="Geneva, Arial, Helvetica, sans-serif"><div id="20" style="background-color:e9e8e2;  border: 1px none #000000;" >Generar Detalle <input type="checkbox" name="detalle" id="detalle"  value="1"/> </div> </font></td>
  </tr>
  <tr>
    <td colspan="6" align="right">
	<div id="10" style="background-color:e9e8e2;  border: 1px none #000000;" >
      <input  type="submit" name="Aplicar" value="Generar">
    </div>    </tr>
</table>







</form>
</body>
</html>
