<?php $this->mod_usuario->en_session(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Registro de País</title>
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
		marcar_todos(document.reporte_madre.instituto);
	    xajax_obtieneNucleo(xajax.getFormValues(reporte_madre));
}
	
function limpiar_instituto(){
		desmarcar_todos(document.reporte_madre.instituto);
	    xajax_obtieneNucleo(xajax.getFormValues(reporte_madre));
}

function todos_nucleo(){
		marcar_todos(document.reporte_madre.nucleo);
	    
}
	
function limpiar_nucleo(){
		desmarcar_todos(document.reporte_madre.nucleo);
	   
}

function todos_carrera(){
		marcar_todos(document.reporte_madre.carrera);
	    
}
	
function limpiar_carrera(){
		desmarcar_todos(document.reporte_madre.carrera);
	   
}

function todos_periodo(){
		marcar_todos(document.reporte_madre.periodo);
	    
}
	
function limpiar_periodo(){
		desmarcar_todos(document.reporte_madre.periodo);
	   
}

function todos_municipio(){
		marcar_todos(document.reporte_madre.municipio);
		xajax_obtieneParroquia(xajax.getFormValues(reporte_madre));
	    
}
	
function limpiar_municipio(){
		desmarcar_todos(document.reporte_madre.municipio);
		xajax_obtieneParroquia(xajax.getFormValues(reporte_madre));
	   
}

function todos_parroquia(){
		marcar_todos(document.reporte_madre.parroquia);
		
	    
}
	
function limpiar_parroquia(){
		desmarcar_todos(document.reporte_madre.parroquia);
		
	   
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
Reporte Madres Solteras </p>

 <?php $atributos = array('name' => 'reporte_madre')?>
 <?php echo form_open('con_madresoltera/const_madresoltera',$atributos ); ?>

  
  <table width="736px" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
      <tr>
        <td colspan="4" align="left" bgcolor="#FFFFFF" class="celdaError">
        <?php echo validation_errors(); ?>       <?php
          echo anchor('jel/index','<img alt="Volver" src="'.base_url().'system/application/views/imagenes/volver.png" border="0">');
          ?></td>
      </tr>
      


      <tr>
      <td  class="celda">
      <strong>
      Instituto      </strong>      </td>
      <td  class="celda"><strong>Núcleo</strong></td>
      <td  class="celda"><strong>Carrera</strong></td>
      </tr>
      <tr>
      <tr>
      <td  class="celda" align="right">

      <input type="button" onClick="todos_instituto()"  value="Todos" >
      <input type="button" onClick="limpiar_instituto()" value="Ninguno">      </td>
      <td  class="celda" align="right">
      <input type="button" value="Todos"    onClick="todos_nucleo()"   >
      <input type="button" value="Ninguno"  onClick="limpiar_nucleo()"  >      </td>
      <td  class="celda" align="right">
      <input type="button" value="Todos"   onClick="todos_carrera()">
      <input type="button" value="Ninguno" onClick="limpiar_carrera()"  >      </td>
      </tr>
	  <tr>
      <td style="height:154px" >
      <div id="capa_instituto" style="width:250px; height:154px; z-index:1; background-color:e9e8e2; overflow: auto; left: 34px;   border: 1px none #000000; top: 391px;">
        <font size="2"  face="Geneva, Arial, Helvetica, sans-serif">
        
		
		  
		
		<?php foreach ($q_instituto -> result() as $row): 
        
		$data = array(
        'name'     => 'instituto[]',
        'id'       => 'instituto',
        'value'    => $row->instituto_id,
        'checked'  => true,
        'onClick' =>'xajax_obtieneNucleo(xajax.getFormValues(reporte_madre));'
		
          );
	    
	     echo form_checkbox($data).''.$row->siglas_instituto."<br>";
	
        endforeach; ?>
        </font>		</div>		</td>
      
	  
	 
	  <td style="height:154px" >
	  <div  class="div_texbox"    name="capa_nucleo" id="capa_nucleo"  style="width:250px; height:154px; background-color:e9e8e2; z-index:1; overflow: auto; left: 34px;   border: 1px none #000000; top: 391px;"> <font size="2" face="Geneva, Arial, Helvetica, sans-serif">
        

	    <?php 
		
		foreach ($q_nucleo -> result() as $row){
        
		$data = array(
        'name'     => 'nucleo[]',
        'id'       => 'nucleo',
        'value'    => $row->nucleo_instituto_id,
        'checked'  => TRUE,
                  );

	       echo form_checkbox($data).''.$row->siglas_nucleo_instituto."<br>";

		} 
		
		?>
        
		</font>	    </div>		</td>
        
		<td style="height:154px" >
        <div id="capa_carrera" style="width:250px; height:154px; z-index:1; background-color:e9e8e2; overflow: auto; left: 34px;   border: 1px none #000000; top: 391px;">
        <font size="2" face="Geneva, Arial, Helvetica, sans-serif">
        
	
	    <?php foreach ($q_car_inst -> result() as $row): 
    
	    $data = array(
        'name'     => 'carrera[]',
        'id'       => 'carrera',
        'value'    => $row->carrera_instituto_id,
        'checked'  => TRUE,
                  );
	      
	     echo form_checkbox($data).' '.$row->siglas_instituto."-".$row->descripcion_carrera."<br>";
	     endforeach; ?>
        </font>		</div>		</td>
    </tr>



      <tr>
      <td  class="celda">
      <strong>
      Período      </strong>      </td>
      <td  class="celda">
      <strong>
      Municipio      </strong>      </td>
      <td  class="celda">
      <strong>
      Parroquia      </strong>      </td>
      </tr>
      <tr>
      <tr>
      <td  class="celda" align="right">

      <input type="button" value="Todos"   onClick="todos_periodo()" >
      <input type="button" value="Ninguno" onClick="limpiar_periodo()">      </td>
      <td  class="celda" align="right">
        <input name="button2" type="button" value="Todos" onClick="todos_municipio()">
        <input name="button" type="button" value="Ninguno" onClick="limpiar_municipio()"></td>
      <td  class="celda" align="right">
      <input type="button" value="Todos"   onClick="todos_parroquia()" >
      <input type="button" value="Ninguno" onClick="limpiar_parroquia()" >      </td>
      </tr>
      <td style="height:154px" >
      <div id="capa_periodo" style="width:250px; height:154px; z-index:1; background-color:e9e8e2; overflow: auto; left: 34px;   border: 1px none #000000; top: 391px;">
        <font size="2" face="Geneva, Arial, Helvetica, sans-serif">
       
	   <?php foreach ($q_periodo -> result() as $row): 
        
		$data = array(
        'name'     => 'periodo[]',
        'id'       => 'periodo',
        'value'    => $row->periodo_id,
        'checked'  => true,
          );
	    
	     echo form_checkbox($data).$row->ano_periodo.'-'.$row->nombre_modalidad."<br>";
	
        endforeach; ?>
        </font>      </div>      </td>
      <td style="height:154px" >
      <div id="capa_municipio"  style="width:250px; height:154px; background-color:e9e8e2; z-index:1; overflow: auto; left: 34px;   border: 1px none #000000; top: 391px;">
        <font size="2" face="Geneva, Arial, Helvetica, sans-serif">
   
        <?php foreach ($q_municipio -> result() as $row): 
        
		$data = array(
        'name'     => 'municipio[]',
        'id'       => 'municipio',
        'value'    => $row->municipio_id,
        'checked'  => true,
		'onClick' =>'xajax_obtieneParroquia(xajax.getFormValues(reporte_madre));'
          );
	    
	     echo form_checkbox($data).$row->nombre_municipio."<br>";
	
        endforeach; ?>
        </font>      </div>      </td>
      <td style="height:154px" >
      <div id="capa_parroquia" style="width:250px; height:154px; z-index:1; background-color:e9e8e2; overflow: auto; left: 34px;   border: 1px none #000000; top: 391px;">
        <font size="2" face="Geneva, Arial, Helvetica, sans-serif">
      
	  
	   <?php foreach ($q_parroquia -> result() as $row): 
        
		$data = array(
        'name'     => 'parroquia[]',
        'id'       => 'parroquia',
        'value'    => $row->parroquia_id,
        'checked'  => true,
          );
	    
	     echo form_checkbox($data).$row->nombre_parroquia."<br>";
	
        endforeach; ?>
        </font>      </div>      </td>
      </tr>
</table>
  <table  width="749" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
  <tr>
  <td colspan="6" class="celda"><strong>Datos Específicos </strong></td>
  </tr>

   <tr>
  <td width="96" class="celda">Nombre:</td>
  <td width="126">
   <div id="1" style="background-color:e9e8e2;  border: 1px none #000000;" >
        <SELECT NAME="snombre" >
                  <OPTION VALUE="0">Seleccione</OPTION>
				  <OPTION VALUE="1">Igual a</OPTION>
                  <OPTION VALUE="2">Que contenga</OPTION>
        </SELECT> 
      </div>  </td>
  <td width="127">
   <div id="7" style="background-color:e9e8e2;  border: 1px none #000000;" >
  <input type="text" name="name" id="name" value="" size="20">
  </div>  </td>
  <td width="140" class="celda">&nbsp;&nbsp;Número de Cédula:</td>
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
  <td width="161">
   <div id="5" style="background-color:e9e8e2;  border: 1px none #000000;" >
  <input type="text" name="cedula" id="cedula" value="" size="20">
  </div>  </td>
  </tr>
  <tr>
  <td width="96" class="celda">Apellido:</td>
  <td width="126">
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
  <td width="140" class="celda">&nbsp;&nbsp;Número de Hijos: </td>
  <td width="118">
   <div id="4" style="background-color:e9e8e2;  border: 1px none #000000;" >
     <select name="shijos" >
       <option value="0">Seleccione</option>
       <option value="1">Igual a</option>
       <option value="2">Menor a</option>
       <option value="3">Mayor a</option>
     </select>
   </div>	 </td>
  <td width="161">
   <div id="6" style="background-color:e9e8e2;  border: 1px none #000000;" >
        <input type="text" name="hijos" id="hijos" value="" size="8">
	  </div>	</td>
  </tr>
  <tr>
    <td colspan="6" align="right">
	<div id="10" style="background-color:e9e8e2;  border: 1px none #000000;" >
	 <font size="2" face="Geneva, Arial, Helvetica, sans-serif">
     Generar Detalle<input type="checkbox" name="detalle" value="1" checked="checked" disabled="disabled">
	 </font>
     </div>    </tr>
	
	<tr>
    <td colspan="6" align="right">
	<div id="10" style="background-color:e9e8e2;  border: 1px none #000000;" >
      <input type="submit" name="Aplicar" value="Generar">
    </div>    </tr>
</table>
  
</form>
</body>
</html>
