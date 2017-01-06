<?php $this->mod_usuario->en_session(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php echo  $xajax_js; ?> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>.::Reporte Censo</title></head>

<!-- Inicio de: JS y CSS para el DataPick. -->
<script type="text/javascript" src="<?php echo base_url(); ?>system/application/js/calendario/jscripts/scripts.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>system/application/js/calendario/jscripts/calendar/calendar.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>system/application/js/calendario/jscripts/calendar/calendar-es.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>system/application/js/calendario/jscripts/calendar/calendar-setup.js"></script>

<link media="screen" href="<?php echo base_url(); ?>system/application/js/calendario/styles/calendar-blue.css" rel="stylesheet" type="text/css" title="win2k-cold-1">
<link media="print" href="<?php echo base_url(); ?>system/application/js/calendario/styles/print.css" rel="stylesheet" type="text/css" title="win2k-cold-1">
<!--    Fin de: JS y CSS para el DataPick. -->


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

function todos_municipio_censo(){
       
	    
		marcar_todos(document.reporte_censo.municipio_censo);
	    xajax_obtieneParroquia_censo(xajax.getFormValues(reporte_censo));
}
	
function limpiar_municipio_censo(){
		desmarcar_todos(document.reporte_censo.municipio_censo);
	    xajax_obtieneParroquia_censo(xajax.getFormValues(reporte_censo));
}



function todos_parroquia_censo(){
		marcar_todos(document.reporte_censo.parroquia_censo);
	    
}
	
function limpiar_parroquia_censo(){
		desmarcar_todos(document.reporte_censo.parroquia_censo);
	   
}


function todos_municipio_habitad(){
		marcar_todos(document.reporte_censo.municipio_habitad);
	    xajax_obtieneParroquia_habitad(xajax.getFormValues(reporte_censo));
}
	
function limpiar_municipio_habitad(){
		desmarcar_todos(document.reporte_censo.municipio_habitad);
	    xajax_obtieneParroquia_habitad(xajax.getFormValues(reporte_censo));
}



function todos_parroquia_habitad(){
		marcar_todos(document.reporte_censo.parroquia_habitad);
	    
}
	
function limpiar_parroquia_habitad(){
		desmarcar_todos(document.reporte_censo.parroquia_habitad);
	   
}

function todos_procedencia(){
		marcar_todos(document.reporte_censo.procedencia);
	    // xajax_obtieneCarrera(xajax.getFormValues(reporte_censo));
}
	
function limpiar_procedencia(){
		desmarcar_todos(document.reporte_censo.procedencia);
	    //xajax_obtieneCarrera(xajax.getFormValues(reporte_censo));
}	


function todos_carrera(){
		marcar_todos(document.reporte_censo.carrera);
	     
}
	
function limpiar_carrera(){
		desmarcar_todos(document.reporte_censo.carrera);
	   
}	
</script>	
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
	

<LINK REL=StyleSheet HREF="<?php echo base_url(); ?>system/application/views/estilos/lista.css" TYPE="text/css" MEDIA=screen>	
</head>


<body>
<?php echo $menu; ?>
<p align="center" class="Titulo"><br>
Reporte de Censos </p>

 <?php $atributos = array('name' => 'reporte_censo')?>
 <?php echo form_open('con_rep_censo/const_censo',$atributos ); ?>

<table width="736px" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
      <tr>
        <td colspan="4" align="left" bgcolor="#FFFFFF" class="celdaError">
        <?php echo validation_errors(); ?> <?php
          echo anchor('jel/index','<img alt="Volver" src="'.base_url().'system/application/views/imagenes/volver.png" border="0">');
          ?></td>
      </tr>
      


      <tr>
      <td  class="celda"><strong>Municipio Censo </strong></td>
      <td  class="celda"><strong>Parroquia Censo</strong> </td>
      <td  class="celda"><strong>Procedencia</strong></td>
      </tr>
      <tr>
      <tr>
      <td  class="celda" align="right">

      <input type="button" onClick="todos_municipio_censo()"  value="Todos" >
      <input type="button" onClick="limpiar_municipio_censo()" value="Ninguno">      </td>
      <td  class="celda" align="right">
      <input type="button" value="Todos"    onClick="todos_parroquia_censo()"   >
      <input type="button" value="Ninguno"  onClick="limpiar_parroquia_censo()"  >      </td>
      <td  class="celda" align="right">
      <input type="button" value="Todos"   onClick="todos_procedencia()">
      <input type="button" value="Ninguno" onClick="limpiar_procedencia()"  >      </td>
      </tr>
	  <tr>
      <td style="height:154px" >
      <div id="capa_instituto" style="width:250px; height:154px; z-index:1; background-color:e9e8e2; overflow: auto; left: 34px;   border: 1px none #000000; top: 391px;"><font size="2" face="Geneva, Arial, Helvetica, sans-serif">
        <?php foreach ($q_municipio -> result() as $row): 
        
		$data = array(
        'name'     => 'municipio_censo[]',
        'id'       => 'municipio_censo',
        'value'    => $row->municipio_id,
        'checked'  => true,
		'onClick' =>'xajax_obtieneParroquia_censo(xajax.getFormValues(reporte_censo));'
          );
	    
	     echo form_checkbox($data).$row->nombre_municipio."<br>";
	
        endforeach; ?>
      </font> </div>	  </td>
	  <td style="height:154px" >
	  <div  class="div_texbox"    name="capa_parroquia_censo" id="capa_parroquia_censo"  style="width:250px; height:154px; background-color:e9e8e2; z-index:1; overflow: auto; left: 34px;   border: 1px none #000000; top: 391px;"><font size="2" face="Geneva, Arial, Helvetica, sans-serif">
	    <?php foreach ($q_parroquia -> result() as $row): 
        
		$data = array(
        'name'     => 'parroquia_censo[]',
        'id'       => 'parroquia_censo',
        'value'    => $row->parroquia_id,
        'checked'  => true,
          );
	    
	     echo form_checkbox($data).$row->nombre_parroquia."<br>";
	
        endforeach; ?>
	  </font> </div>	  </td>
      <td style="height:154px" >
      <div id="capa_instituto" style="width:250px; height:154px; z-index:1; background-color:e9e8e2; overflow: auto; left: 34px;   border: 1px none #000000; top: 391px;">
	 
	
	  <?php foreach ($q_procedencia -> result() as $row): 
    
	    $data = array(
        'name'     => 'procedencia[]',
        'id'       => 'procedencia',
        'value'    => $row->tipo_procedencia_id,
        'checked'  => TRUE,
                  );
	      
	     echo form_checkbox($data).' '.'<font size="2" face="Geneva, Arial, Helvetica, sans-serif">'.$row->nombre_tipo_procedencia."</fon><br>";
	     endforeach; ?>
  	    </div>	  </td>
      </tr>
      <tr>
      <td  class="celda">
      <strong>
      Municipio Habitaci&oacute;n </strong>      </td>
      <td  class="celda"><strong>Parroquia Habitaci&oacute;n </strong></td>
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
      <div id="capa_municipio_habitad" style="width:250px; height:154px; z-index:1; background-color:e9e8e2; overflow: auto; left: 34px;   border: 1px none #000000; top: 391px;"><span style="width:250px; height:154px; background-color:e9e8e2; z-index:1; overflow: auto; left: 34px;   border: 1px none #000000; top: 391px;"><font size="2" face="Geneva, Arial, Helvetica, sans-serif">
        <?php foreach ($q_municipio -> result() as $row): 
        
		$data = array(
        'name'     => 'municipio_habitad[]',
        'id'       => 'municipio_habitad',
        'value'    => $row->municipio_id,
        'checked'  => true,
		'onClick' =>'xajax_obtieneParroquia_habitad(xajax.getFormValues(reporte_censo));'
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
  <td colspan="6" class="celda"><strong>Datos Espec&iacute;ficos </strong></td>
  </tr>

   <tr>
  <td width="95" class="celda">Nombre:</td>
  <td width="127">
   <div id="1" style="background-color:e9e8e2;  border: 1px none #000000;" >
        <SELECT NAME="snombre" >
                  <OPTION VALUE="0">Seleccione</OPTION>
				  <OPTION VALUE="1">Igual a</OPTION>
                  <OPTION VALUE="2">Que contenga</OPTION>
        </SELECT> 
     </div>  </td>
  <td width="120">
   <div id="7" style="background-color:e9e8e2;  border: 1px none #000000;" >
  <input type="text" name="name" id="name" value="" size="20">
  </div>  </td>
  <td width="131" class="celda">&nbsp;&nbsp;Número de C&eacute;dula:</td>
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
  <td width="95" class="celda">Apellido:</td>
  <td width="127">
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
        <SELECT NAME="sexo" >
                  <OPTION VALUE="0">Seleccione</OPTION>
                  <OPTION VALUE="M">Masculino</OPTION>
                  <OPTION VALUE="F">Femenino</OPTION>
        </SELECT>
	  </div>	 </td>
  <td width="158">
   <div id="6" style="background-color:e9e8e2;  border: 1px none #000000;" ></div>	</td>
  </tr>
  <tr>
  <td width="95" class="celda">Cant. Particip.:</td>
  <td width="127">
   <div id="2" style="background-color:e9e8e2;  border: 1px none #000000;" >
                  <SELECT NAME="scantidad" >
                  <OPTION VALUE="0">Seleccione</OPTION>
				  <OPTION VALUE="1">Igual a</OPTION>
				  <OPTION VALUE="2">Que contenga</OPTION>
                  </SELECT>
    </div>  </td>
  <td>
   <div id="8" style="background-color:e9e8e2;  border: 1px none #000000;" >
  <input type="text" name="cantidad" id="cantidad" value="" size="20">
  </div>  </td>	 
  <td width="131" class="celda">&nbsp;&nbsp;Lugar Censo: </td>
  <td colspan="2">
  
   <div id="6" style="background-color:e9e8e2;  border: 1px none #000000;" >
     <input type="text" name="lugar" id="lugar" value="" size="38" />
   </div></td>
  </tr>
  
  
   <tr>
  <td width="95" class="celda">Fecha Censo:</td>
  <td width="127">
   <div id="2" style="background-color:e9e8e2;  border: 1px none #000000;" >
                  <SELECT NAME="sfecha" >
                  <OPTION VALUE="0">Seleccione</OPTION>
				  <OPTION VALUE="3">Menor/Igual a</OPTION>
				  <OPTION VALUE="4">Mayor/Igual a</OPTION>
                  </SELECT>
    </div>  </td>
  <td>
   <div id="8" style="background-color:e9e8e2;  border: 1px none #000000;" >
  <input type="text" name="fecha" id="fecha" value="" size="8">
  <img name="dFecCalendario" id="dFecCalendario" src="<?php echo base_url(); ?>system/application/views/imagenes/calendario.png" width="16" height="16" />
    <!-- Inicio de: Iniciar DataPick. -->
    <script type="text/javascript">
	var campoId = 'fecha';
	var imagenId = 'dFecCalendario';
		
		
	iniciarCalendario(campoId, imagenId,'%d-%m-%Y',false);
	</script> 
	</div>
  
  
    </td>	 
  <td width="131"> <div id="8" style="background-color:e9e8e2;  border: 1px none #000000;" > <font size="2" face="Geneva, Arial, Helvetica, sans-serif">No Beneficiario 
        <input type="checkbox" name="nobenef" id="nobenef"  value="1"/></font></div> </td>
  <td colspan="2" align="right">
<div id="20" style="background-color:e9e8e2;  border: 1px none #000000;" > <font size="2" face="Geneva, Arial, Helvetica, sans-serif">Generar Detalle <input type="checkbox" name="detalle" id="detalle"  value="1"/>  </font></div>
   </td>
  </tr>
  
  
  <tr>
    <td colspan="6" align="right">
	<div id="10" style="background-color:e9e8e2;  border: 1px none #000000;" >
      <input type="submit" name="Aplicar" value="Generar">
    </div>    </tr>
</table>







</form>
</body>
</html>
