<?php $this->mod_usuario->en_session(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Registro de Carreras</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript" src="<?=base_url(); ?>system/application/js/general.js"></script>
<LINK REL=StyleSheet HREF="<?php echo base_url(); ?>system/application/views/estilos/lista.css" TYPE="text/css" MEDIA=screen>
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
.Estilo1 {color: black; font-family: Geneva, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }

-->
</style>
</head>

<body>
<?php //echo $menu; ?>
<p align="center" class="Titulo"><br>
Registro de Carta Postulacion </p>

<?php echo form_open('sorteo/detallePersonaRecord'); ?>


  <input type="hidden" name="carta_postulacion_id" value="<?php echo isset($carta_postulacion_id)?$carta_postulacion_id:''; ?>">
  
   <table width="745" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
  
  <tr>
    <td width="121" class="celdaContenido">Código  Carta:</td>
    <td width="142"><input name="codigo_carta_postulacion" id="codigo_carta_postulacion" value="<?php echo $codigo_carta_postulacion; ?>" size="12" type="text"></td>
  
  
  <td width="110" class="celdaContenido">&nbsp;&nbsp;Fecha Carta:</td>
  <td width="153"><input name="fecha_carta_postulacion" id="fecha_carta_postulacion" value="<?php echo $fecha_carta_postulacion; ?>" size="10" type="text">
  <img name="dFecCalendarioc" id="dFecCalendarioc" src="http://Portatil-01/JEL/system/application/views/imagenes/calendario.png" height="19" width="18">
   <script type="text/javascript">  
   var campoId = "fecha_carta_postulacion";  
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
   <td class="celdaContenido">Referencia carta: </td><td colspan="5"><input name="referencia_carta_postulacion" id="referencia_carta_postulacion" value="<?php echo $referencia_carta_postulacion; ?>" size="98" type="text">
    
	
	 </td>
   </tr>
   <tr>
   <td>&nbsp;</td>
    <td>&nbsp;</td>
	 <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td>&nbsp;</td>
	  <td><input type="submit" name="enviar" id="enviar" value="Enviar"> </td>
   </tr>
   
</table>
  
</form>
</body>
</html>
