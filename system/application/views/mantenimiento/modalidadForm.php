<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Registro de Modalidades</title>
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
<p align="center" class="Titulo"><br>Registro de Modalidades</p>

<?php echo form_open('modalidad/modalidadRecord'); ?>


  <input type="hidden" name="txtId" value="<?php echo $id; ?>">
  <input type="hidden" name="txtActivo" value="<?php echo $activo; ?>">
  <table width="370px" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
    
    <tr>
      <td colspan="2" bgcolor="#FFFFFF"><span class="celdaError"><?php echo '<br>'.validation_errors().'<br>';?>
        <?php
          echo anchor('modalidad/modalidadControl','<img alt="Volver" src="'.base_url().'system/application/views/imagenes/volver.png" border="0">');
          ?>
      </span></td>
    </tr>
    <tr>
      <td  class="celda">Nombre de la Modalidad</td>
      <td  class="celda">Descripción</td>
    </tr>
    <tr>
      <td><input name="txtNombreModalidad" type="text" id="txtNombreModalidad" value="<?php echo $nombreModalidad; ?>" size="56" maxlength="50"></td>
      <td><input name="txtDescripcionModalidad" type="text" id="txtDescripcionModalidad" value="<?php echo $descripcionModalidad; ?>" size="56" maxlength="2000"></td>
    </tr>
    <tr>
      <td colspan="2" align="right"><input name="cmdAceptar" type="submit" value="Aceptar"></td>
    </tr>
  </table>
  <script>setFocus("txtNombreModalidad");</script>
</form>
</body>
</html>
