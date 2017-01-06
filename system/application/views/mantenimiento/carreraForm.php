<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Registro de Carreras</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript" src="<?=base_url(); ?>system/application/js/general.js"></script>
<LINK REL=StyleSheet HREF="<?php echo base_url(); ?>system/application/views/estilos/lista.css" TYPE="text/css" MEDIA=screen>
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
<?php echo $menu; ?>
<p align="center" class="Titulo"><br>Registro de Carreras</p>

<?php echo form_open('carrera/carreraRecord'); ?>


  <input type="hidden" name="carrera_id" value="<?php echo isset($carrera_id)?$carrera_id:''; ?>">
  <input type="hidden" name="txtActivo" value="<?php echo isset($activo)?$activo:''; ?>">
  <table width="736px" border="0" align="center" cellpadding="0" cellspacing="0">
    <!--DWLayoutTable-->
      <tr>
        <td height="18" colspan="3" align="left" class="celdaError">
        <?php //echo '<br>'.validation_errors().'<br>';?>        </td>
      </tr>
      <tr>
        <td height="18" colspan="3" align="left">
          <?php
          echo anchor('carrera','<img alt="Volver" src="'.base_url().'system/application/views/imagenes/volver.png" border="0">');
          ?>        </td>
      </tr>
      <tr>
      <td colspan="4" height="19"   valign="middle" class="celda">Nombre de la Carrera <?php echo form_error('nombre_carrera','<div class="celdaError">', '</div>');?></td>
      </tr>
      <tr>
        <td colspan="4" height="24" valign="top"> <input name="nombre_carrera" type="text" id="nombre_carrera" value="<?php echo set_value('$nombre_carrera',isset($nombre_carrera)?$nombre_carrera:''); ?>" size="125" maxlength="200">      </td>
      </tr>
      <tr>
      <td colspan="4" height="19"   valign="middle" class="celda">Descripción <?php echo form_error('descripcion_carrera','<div class="celdaError">', '</div>');?></td>
      </tr>
      <tr>
        <td colspan="4" height="24" valign="top"> <input name="descripcion_carrera" type="text" id="descripcion_carrera" value="<?php echo set_value('$descripcion_carrera',isset($descripcion_carrera)?$descripcion_carrera:''); ?>" size="125" maxlength="2000">      </td>
      </tr>
      
      <tr>
        <td height="24" colspan="3" align="right" valign="top" bgcolor="#E9E8E2">
          <input name="cmdAceptar" type="submit" value="Aceptar"></td>
      </tr>
      <tr>
        <td height="3"></td>
        <td></td>
        <td></td>
      </tr>
  </table>
  
</form>
</body>
</html>
