<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Registro de Tipos de Beca</title>
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
<br>
<p align="center" class="Titulo">Registro de Tipo de Beca</p>

<?php echo form_open('tipobeca/tipoBecaRecord'); ?>


  <input type="hidden" name="txtId" value="<?php echo $id; ?>">
  <input type="hidden" name="txtActivo" value="<?php echo $activo; ?>">
  <table width="730" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
      <tr>
        <td colspan="4" align="left" class="celdaError">        </td>
      </tr>
      <tr>
        <td colspan="4" align="left" bgcolor="#FFFFFF">
          <?php
          echo anchor('tipobeca/tipobecaControl','<img alt="Volver" src="'.base_url().'system/application/views/imagenes/volver.png" border="0">');
          ?>        </td>
      </tr>
      <tr>
      <td width="379"  class="celda">
      <strong>
      Nombre del Tipo de Beca: <span class="fontnormal"><font color="#FF0000">  <?php echo validation_errors(); ?> </font></span>   </strong>      </td>
      <td width="351"  class="celda">&nbsp;</td>
      </tr>
      <tr>
      <td colspan="2">
        <input name="txttipobeca" type="text" id="txttipobeca" value="<?php echo $nombretipobeca; ?>" size="122">      </td>
      </tr>
      <tr>
      <td height="24" colspan="2" align="right" bgcolor="#FFFFFF">
        <input name="cmdAceptar" type="submit" value="Aceptar">      </td>
      </tr>
</table>
   <script>setFocus("txtPais");</script>
</form>
</body>
</html>