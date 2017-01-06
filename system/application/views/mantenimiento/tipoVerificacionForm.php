<?php //$this->mod_usuario->en_session(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Registro de Tipos de Verificación</title>
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
<p align="center" class="Titulo"><br>Registro de Tipos de Verificación</p>

<?php echo form_open('tipoVerificacion/tipoVerificacionRecord'); ?>


  <input type="hidden" name="txtId" value="<?php echo $id; ?>">
  <input type="hidden" name="txtActivo" value="<?php echo $activo; ?>">
  <table width="370px" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
      <tr>
        <td  align="left" bgcolor="#FFFFFF" class="celdaError">
        <?php echo '<br>'.validation_errors().'<br>';?>
        <?php
          echo anchor('tipoVerificacion/tipoVerificacionControl','<img alt="Volver" src="'.base_url().'system/application/views/imagenes/volver.png" border="0">');
          ?></td>
      </tr>
      
      <tr>   
      <td  class="celda">
      <strong>
      Nombre del Tipo de Verificación      </strong>      </td>
      </tr>
      <tr>     
      <td>
        <input name="txtTipoVerificacion" type="text" id="txtTipoVerificacion" value="<?php echo $TipoVerificacion; ?>" size="120" maxlength="200">      </td>
      </tr>     
    
      <tr>
      <td  align="right">
        <input name="cmdAceptar" type="submit" value="Aceptar">      </td>
      </tr>
</table>
  <script>setFocus("txtTipoVerificacion");</script>
</form>
</body>
</html>
