<?php $this->mod_usuario->en_session(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
<title>Registro de Sorteos</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<LINK REL=StyleSheet HREF="<?php echo base_url(); ?>system/application/views/estilos/lista.css" TYPE="text/css" MEDIA=screen>
<script type="text/javascript" src="<?php  echo base_url(); ?>system/application/js/general.js"></script>
<!-- Inicio de: JS y CSS para el DataPick. -->
<script type="text/javascript" src="<?php echo base_url(); ?>system/application/js/calendario/jscripts/scripts.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>system/application/js/calendario/jscripts/calendar/calendar.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>system/application/js/calendario/jscripts/calendar/calendar-es.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>system/application/js/calendario/jscripts/calendar/calendar-setup.js"></script>

<link media="screen" href="<?php echo base_url(); ?>system/application/js/calendario/styles/calendar-blue.css" rel="stylesheet" type="text/css" title="win2k-cold-1">
<link media="print" href="<?php echo base_url(); ?>system/application/js/calendario/styles/print.css" rel="stylesheet" type="text/css" title="win2k-cold-1">
<!--    Fin de: JS y CSS para el DataPick. -->
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
<script type="text/javascript">

   
	
	
	
	function actualizare(pp_id,sorteo_id,ubicart,codcarta,fechacarta,refcart){
	


	xajax_actualizar(pp_id,sorteo_id,ubicart,codcarta,fechacarta,refcart);	
	document.getElementById("ref").value      = '';
    document.getElementById("codcarta").value = '';
    document.getElementById("fechac").value   = '';
    document.getElementById("cmbu").value     = '';
	
	
	}
	
	
</script>




<?php echo $js; ?>
</head>

<body>
<?php echo $menu; ?>
<p align="center" class="Titulo"><br>Registro Sorteo </p>
 <?php $atributos = array('name' => 'sorteo')?>
<?php echo form_open('sorteo/sorteoRecord',$atributos); ?>


  <input type="hidden" name="txtId" value="<?php echo $id; ?>">
  <input type="hidden" name="txtActivo" value="<?php echo $activo; ?>">

  <table width="747" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
      <tr>
        <td colspan="4" align="left" bgcolor="#FFFFFF" class="celdaError">
        <?php echo '<br>'.validation_errors().'<br>';?>        <?php
          
          echo anchor('sorteo/sorteoControl','<img alt="Volver" src="'.base_url().'system/application/views/imagenes/volver.png" border="0">');
          ?></td>
      </tr>
      


      <tr>
      <td width="368"  class="celda">
      <strong>
      País      </strong>      </td>
      <td width="379"  class="celda">
      <strong>
      Estado      </strong>     </td>
      </tr>
      <tr>
      <td>
        <select name="cmbPais" id="cmbPais" style="width:367px" onChange="xajax_buildSelectEstados(this.value)" >
          <option value="-1"></option>
          <?php
          if($paises->num_rows()!=0)
          {
            foreach($paises->result() as $row)
            {
          ?>
              <option value="<?php echo($row->pais_id);?>" <?php if($row->pais_id==$paisId) echo ' selected'; ?> >
              <?php echo($row->nombre_pais); ?>              </option>
          <?php
            }
          }
          ?>
        </select>      </td>

      <td>
       <div id="divCmbEstado">
        <select name="cmbEstado" id="cmbEstado" style="width:378px">
          <option value="-1"></option>
          <?php
          if($estados)
          {
              if($estados->num_rows()!=0)
              {
                foreach($estados->result() as $row)
                {
              ?>
                  <option value="<?php echo($row->estado_id);?>" <?php if($row->estado_id==$estadoId) echo ' selected'; ?> >
                  <?php echo($row->nombre_estado); ?>                  </option>
              <?php
                }
              }
          }
          ?>
        </select>
        </div>      </td>
      </tr>

      <tr>
      <td  class="celda">
      <strong>
      Municipio      </strong>      </td>
      <td  class="celda">
      <strong>
      Parroquia      </strong>      </td>
      </tr>
      <tr>
      <td>
      <div id="divCmbMunicipio">
        <select name="cmbMunicipio" id="cmbMunicipio" style="width:367px">
          <option value="-1"></option>
          <?php
          if($municipios)
          {
              if($municipios->num_rows()!=0)
              {
                foreach($municipios->result() as $row)
                {
              ?>
                  <option value="<?php echo($row->municipio_id);?>" <?php if($row->municipio_id==$municipioId) echo ' selected'; ?> >
                  <?php echo($row->nombre_municipio); ?>                  </option>
              <?php
                }
              }
          }
          ?>
        </select>
      </div>      </td>
      <td>
      <div id="divCmbParroquia">
        <select name="cmbParroquia" id="cmbParroquia" style="width:378px">
          <option value="-1"></option>
          <?php
          if($parroquias)
          {
              if($parroquias->num_rows()!=0)
              {
                foreach($parroquias->result() as $row)
                {
              ?>
                  <option value="<?php echo($row->parroquia_id);?>" <?php if($row->parroquia_id==$parroquiaId) echo ' selected'; ?> >
                  <?php echo($row->nombre_parroquia); ?>                  </option>
              <?php
                }
              }
          }
          ?>
        </select>
      </div>      </td>
      </tr>
</table>

  <table width="747" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
      <tr>
      <td width="140"  class="celda" style="width:140px">
      <strong>
      Fecha      </strong>      </td>
      <td width="606"  class="celda" style="width:606px">
      <strong>
      Lugar      </strong>      </td>
      </tr>
      <tr>
      <td valign="middle"><input name="txtFechaProcedencia" type="text" id="txtFechaProcedencia" value="<?php echo $fecha; ?>" size="9">
        <img name="dFecCalendario" id="dFecCalendario" src="<?php echo base_url(); ?>system/application/views/imagenes/calendario.png" width="16" height="16" />
    <!-- Inicio de: Iniciar DataPick. -->
   
	<script type="text/javascript">
	var campoId = "txtFechaProcedencia";
	var imagenId = "dFecCalendario";
	iniciarCalendario(campoId, imagenId,"%d-%m-%Y",false);
	</script>      </td>
      <td>
        <input name="txtLugar" type="text" id="txtLugar" value="<?php echo $lugar; ?>" size="98">      </td>
      </tr>

      <tr>
      <td  class="celda" colspan="2">
      </td><td width="1">    </td>
      </tr>
      <tr>
 
      </tr>

      <tr>
      <td colspan="2" align="right">
        <input name="cmdAceptar" type="submit" value="Aceptar">      </td>
      </tr>
</table>
 <!-- fin de la parte del sorteo -->
 
 
 
 <?php if ($id < 0){   ?>
 
 
  <?php  }else{  ?>
 <!-- inicio de las personas sorteadas -->
  
  <table width="744" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
<tr>
<td colspan="4" class="celdaContenido">Numero de Cédula:
  <input type="text" name="ced"  size="12" maxlength="12"  value="<?php isset($ced)?$ced:'12'?>"  />
  <input type="button"  name="Buscar" value="Buscar"  onClick="xajax_buscarProcedenciaPersona(ced.value,txtId.value)"/></td>
</tr>
<tr>
<td width="125"  class="celda"><strong>Nombre</strong></td>
<td width="155"  class="celda"> <strong>Apellido</strong></td>
<td width="65"  class="celda"><strong> Sexo  </strong></td>
<td width="399" bgcolor="#E9E8E2"  class="celda"> <strong>Dirección </strong></td>
</tr>
</table>
   

  <div id="div_persona" style="size:100; width:auto; "  align="center">&nbsp;</div><!-- este div es llenado con la funcion de buscar a la persona para el sorteo-->
<!---division de los div -->

  <table width="745" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
  
  <tr>
    <td width="121" class="celdaContenido">Código  Carta:</td>
    <td width="142"><input name="codcarta" id="codcarta" value="" size="12" type="text"></td>
  
  
  <td width="110" class="celdaContenido">&nbsp;&nbsp;Fecha Carta:</td>
  <td width="153"><input name="fechac" id="fechac" value="" size="10" type="text">
  <img name="dFecCalendarioc" id="dFecCalendarioc" src="http://Portatil-01/JEL/system/application/views/imagenes/calendario.png" height="19" width="18">
   <script type="text/javascript">  
   var campoId = "fechac";  
   var imagenId = "dFecCalendarioc";  
   iniciarCalendario(campoId, imagenId,"%d-%m-%Y",false);  
   </script>   </td>
  <td width="110" class="celdaContenido">&nbsp;&nbsp;Ubicacion Carta </td>
  <td width="109" align="right">
    <select name="cmbu" id="cmbu"><option value="">[Seleccione]</option>
  
  <?php foreach($q_ubicacion_carta->result() as $row_2){  ?>
  
  <option value="<?php echo $row_2->ubicacion_carta_id; ?>"><?php echo $row_2->nombre_ubicacion_carta; ?></option>
  
  <?php } ?>
  </select></td>
   </tr>
   <tr>
   <td class="celdaContenido">Referencia carta: </td><td colspan="5"><input name="ref" id="ref" value="" size="98" type="text">
    
	
	 </td>
   </tr>
</table>
  
  <table width="743" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
<tr>
<td colspan="4" class="celda"><strong>Personas Sorteadas</strong> <?php

$atts = array(
              'width'      => '780',
              'height'     => '600',
              'scrollbars' => 'yes',
              'status'     => 'yes',
              'resizable'  => 'yes',
              'screenx'    => '0',
              'screeny'    => '0'
            );

 echo anchor_popup('sorteo/personaControl/'.$id, 'Ver la Lista Sorteados', $atts); ?> </td>
</tr>
<tr>
<td width="148"  class="celda"><strong>Cédula</strong></td>
<td width="197"  class="celda"> <strong>Nombre</strong></td>
<td width="177"  class="celda"><strong> Apellido </strong></td>
<td width="221"  class="celda"> <strong>Parroquia </strong></td>
</tr>
</table>

<div id="div_grid">
<table width="744" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
<?php  foreach($sorteo_persona->result() as $row){   ?>

<tr>

<td width="127" class="celdaContenido"><?php echo $row->cedula_persona; ?></td>
<td width="170" class="celdaContenido"><?php echo $row->nombre_persona; ?></td>
<td width="155" class="celdaContenido"><?php echo $row->apellido_persona; ?></td>
<td width="222" class="celdaContenido"><?php echo $row->nombre_parroquia_persona; ?></td>

<td width="30" align="center">
 <?php  $atts = array(
              'width'      => '780',
              'height'     => '600',
              'scrollbars' => 'yes',
              'status'     => 'yes',
              'resizable'  => 'yes',
              'screenx'    => '0',
              'screeny'    => '0'
            );
 
  echo anchor_popup('sorteo/detallePersona/'.$row->persona_id,'<img alt="Ver Detalle" src="'.base_url().'system/application/views/imagenes/zoom+.png" border="0">', $atts ); ?>  </td>
<td width="40" align="center">

<a href="" onClick="xajax_sorteo_persona_Delete(<?php echo $row->sorteo_id; ?>,<?php echo $row->procedencia_persona_id; ?>);return false;"><img name="Eliminar"src="<?php echo base_url(); ?>system/application/views/imagenes/eliminar.png" border="0" ></a></td>
</tr>


<?php  } ?>
</table>
</div>


 <?php } ?> 
  
<div id="div_no">
</div>
  

  <p>&nbsp;</p>
  <p>&nbsp;</p>
  
 
</form>
</body>
</html>
