
<?php $this->mod_usuario->en_session(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php echo  $xajax_js; ?> 
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>.::Reporte Historico Beneficiario</title></head>
<style type="text/css">
<!--


.celdaError
{
  color:red;
  
  font-family: Geneva, Arial, Helvetica, sans-serif; font-size:12px;
}

.Titulo {color: black; font-family: Arial, Helvetica, sans-serif; font-size: 30px;}

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

function todos_municipio_censo(){
		marcar_todos(document.reporte_censo.municipio_censo);
	    xajax_obtieneParroquia_censo(xajax.getFormValues(reporte_censo));
}
	
function limpiar_municipio_censo(){
		desmarcar_todos(document.reporte_censo.municipio_censo);
	    xajax_obtieneParroquia_censo(xajax.getFormValues(reporte_censo));
}

function todos_accion(){
		marcar_todos(document.reporte_censo.accion);
	    
}
	
function limpiar_accion(){
		desmarcar_todos(document.reporte_censo.accion);
	   
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

function todos_instituto(){
		marcar_todos(document.reporte_censo.instituto);
	     xajax_obtieneCarrera(xajax.getFormValues(reporte_censo));
}
	
function limpiar_instituto(){
		desmarcar_todos(document.reporte_censo.instituto);
	    xajax_obtieneCarrera(xajax.getFormValues(reporte_censo));
}	


function todos_carrera(){
		marcar_todos(document.reporte_censo.carrera);
	     
}
	
function limpiar_carrera(){
		desmarcar_todos(document.reporte_censo.carrera);
	   
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
Reporte Hist&oacute;rico Beneficiarios </p>

 <?php $atributos = array('name' => 'reporte_censo')?>
 <?php echo form_open('con_rep_historicoBenef/const_historicoBenef',$atributos ); ?>

<table width="736px" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
      <tr>
        <td colspan="4" align="left" bgcolor="#FFFFFF" class="celdaError">
        <?php echo validation_errors(); ?>       <?php
          echo anchor('jel/index','<img alt="Volver" src="'.base_url().'system/application/views/imagenes/volver.png" border="0">');
          ?></td>
      </tr>
      


      <tr>
      <td  class="celda"><strong>Municipio Censo </strong></td>
      <td  class="celda"><strong>Parroquia Censo</strong> </td>
      <td  class="celda"><strong>Instituto</strong></td>
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
      <input type="button" value="Todos"   onClick="todos_instituto()">
      <input type="button" value="Ninguno" onClick="limpiar_instituto()"  >      </td>
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
	  <?php foreach ($q_instituto -> result() as $row): 
        
		$data = array(
        'name'     => 'instituto[]',
        'id'       => 'instituto',
        'value'    => $row->instituto_id,
        'checked'  => true,
        'onClick' =>'xajax_obtieneCarrera(xajax.getFormValues(reporte_censo));'
		
          );
	    
	     echo form_checkbox($data).''.'<font size="2" face="Geneva, Arial, Helvetica, sans-serif">'.$row->siglas_instituto.'</font>'."<br>";
	
        endforeach; ?>
  	    </div>	  </td>
      </tr>
      <tr>
      <td  class="celda">
      <strong>
      Municipio Habitaci&oacute;n </strong>      </td>
      <td  class="celda"><strong>Parroquia Habitaci&oacute;n </strong></td>
      <td  class="celda"><strong>Carrera</strong></td>
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
        'value'    => $row->carrera_instituto_id,
        'checked'  => TRUE,
                  );
	      
	     echo form_checkbox($data).' '.'<font size="2" face="Geneva, Arial, Helvetica, sans-serif">'.$row->siglas_instituto."-".$row->descripcion_carrera."</fon><br>";
	     endforeach; ?>
	  </div>	  </td>
      </tr>
</table>
<table  width="749" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
  
  <tr>
  <td colspan="3" class="celda"><strong>Acciones Sobre personas</strong></td>
  <td colspan="2" class="celda"><strong>Datos Espec&iacute;ficos</strong> </td>
  <td class="celda"></td>
  </tr>
<tr>
  <td width="59" bgcolor="#E9E8E2">&nbsp;</td>
  <td width="72" bgcolor="#E9E8E2">&nbsp;</td>
  <td width="149" bgcolor="#E9E8E2"> <input type="button" value="Todos"   onClick="todos_accion()" >
    <input type="button" value="Ninguno" onClick="limpiar_accion()"> </td>
  
   <td bgcolor="#E9E8E2">&nbsp;</td>
   <td bgcolor="#E9E8E2">&nbsp;</td>
   <td bgcolor="#E9E8E2">&nbsp;</td>
  </tr>
   <tr>
  <td colspan="3" rowspan="5" style="height:100px">
 <div id="capa_periodo" style="width:280px; height:120px; z-index:1; background-color:e9e8e2; overflow: auto; left: 120px;   border: 1px none #000000; top: 391px;"><span style="width:250px; height:154px; background-color:e9e8e2; z-index:1; overflow: auto; left: 34px;   border: 1px none #000000; top: 391px;"><font size="2" face="Geneva, Arial, Helvetica, sans-serif">             
  <?php foreach ($q_accion -> result() as $row): 
        
		$data = array(
        'name'     => 'accion[]',
        'id'       => 'accion',
        'value'    => $row->accion_id,
        'checked'  => true,
		
          );
	    
	     echo form_checkbox($data).$row->nombre_accion."<br>";
	
        endforeach; ?>
   </font></span></div>	</td>
  <td width="128" bgcolor="#E9E8E2" class="celda">Número de C&eacute;dula:</td>
  <td width="118" bgcolor="#E9E8E2">
   <div id="3" style="background-color:e9e8e2;  border: 1px none #000000;" >
        <SELECT NAME="scedula" >
                  <OPTION VALUE="0">Seleccione</OPTION>
                  <OPTION VALUE="1">Igual a</OPTION>
                  <OPTION VALUE="2">Que contenga</OPTION>
				  <OPTION VALUE="3">Menor/Igual a</OPTION>
				  <OPTION VALUE="4">Mayor/Igual a</OPTION>
        </SELECT> 
     </div>  </td>
  <td width="223" bgcolor="#E9E8E2">
   <div id="5" style="background-color:e9e8e2;  border: 1px none #000000;" >
  <input type="text" name="cedula" id="cedula" value="" size="20">
  </div>  </td>
  </tr>
  <tr>
  <td width="128" class="celda">Sexo:</td>
  <td width="118">
   <div id="4" style="background-color:e9e8e2;  border: 1px none #000000;" >
        <SELECT NAME="sexo" >
                  <OPTION VALUE="0">Seleccione</OPTION>
                  <OPTION VALUE="M">Masculino</OPTION>
                  <OPTION VALUE="F">Femenino</OPTION>
        </SELECT>
    </div>	 </td>
  <td width="223" bgcolor="#E9E8E2">
   <div id="6" style="background-color:e9e8e2;  border: 1px none #000000;" size=20;> </div>	</td>
  </tr>
  <tr>
  <td width="128" class="celda">Nombre:</td>
  <td width="118">
   <div id="4" style="background-color:e9e8e2;  border: 1px none #000000;" >
     <select name="snombre" >
       <option value="0">Seleccione</option>
       <option value="1">Igual a</option>
       <option value="2">Que contenga</option>
     </select>
   </div>	 </td>
  <td width="223">
   <div id="6" style="background-color:e9e8e2;  border: 1px none #000000;" >
     <input type="text" name="nombre" id="nombre" value="" size="20" />
   </div>	</td>
  </tr>
  
  <tr>
  <td height="27" class="celda">Apellido:</td>
   <td><span style="background-color:e9e8e2;  border: 1px none #000000;">
     <select name="sapellido" >
       <option value="0">Seleccione</option>
       <option value="1">Igual a</option>
       <option value="2">Que contenga</option>
     </select>
   </span></td>
   <td bgcolor="#E9E8E2"><span style="background-color:e9e8e2;  border: 1px none #000000;">
     <input type="text" name="apellido" id="apellido" value="" size="20" />
   </span></td>
  </tr>
  <tr>
  <td height="24" bgcolor="#E9E8E2">&nbsp;</td>
   <td bgcolor="#E9E8E2">&nbsp;</td>
   <td align="right" bgcolor="#E9E8E2"><span style="background-color:e9e8e2;  border: 1px none #000000;">
     <input type="submit" name="Aplicar" value="Generar" />
   </span></td>
  </tr>
    </tr>
</table>







</form>
</body>
</html>
