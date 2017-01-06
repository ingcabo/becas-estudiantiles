<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Registro de País</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript" src="<?php echo base_url(); ?>system/application/views/javascript/validacion.js"></script>
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

<body>
<?php echo $menu; ?>
<p align="center" class="Titulo"><br>Registro de Liceo </p>

<?php echo form_open('liceo/liceoRecord'); ?>


  <input type="hidden" name="txtId" value="<?php echo $id; ?>">
  <input type="hidden" name="txtActivo" value="<?php echo $activo; ?>">
  <table width="706" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
      <tr>
        <td colspan="4" align="left" bgcolor="#FFFFFF" class="celdaError">
        <?php // echo validation_errors(); ?>        <?php
          echo anchor('liceo/liceoControl','<img alt="Volver" src="'.base_url().'system/application/views/imagenes/volver.png" border="0">');
          ?></td>
      </tr>
      
      <tr>
      <td width="370"  class="celda">
      <strong>
      Nombre del Liceo      <span class="fontnormal"><font color="#FF0000">  <?php echo form_error('txtliceo'); ?> </font></span> </strong>   </td>
      <td width="336"  class="celda"> <strong>Teléfono: <span class="fontnormal"><font color="#FF0000">  <?php echo form_error('txttelefono'); ?> </font></span>  </strong></td>
      </tr>
      <tr>
      <td>
        <input name="txtliceo" type="text" id="txtliceo" value="<?php echo $nombreliceo; ?>" size="56">      </td>
      <td><input name="txttelefono" type="text" id="txttelefono" value="<?php echo $telefono; ?>" size="56"> </td>
      </tr>
	  <tr>
	  <td class="celda"><strong>Dirección: <span class="fontnormal"><font color="#FF0000"> <?php echo form_error('txtdir'); ?> </font></span>  </strong></td>
	  <td class="celda">&nbsp;</td>
	  </tr>
	  <tr>
	  <td colspan="2">
	    <input type="text" name="txtdir" id="txtdir" value="<?php echo $direccion; ?>" size="118" ></td>
  	  </tr>
      <tr>
      <td colspan="2" align="right">
        <input name="cmdAceptar" type="submit" value="Aceptar">      </td>
      </tr>
</table>
   <script>setFocus("txtliceo");</script>
</form>
</body>
</html>