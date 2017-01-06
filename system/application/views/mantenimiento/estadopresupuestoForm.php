<?php $this->mod_usuario->en_session(); ?>
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
<p align="center" class="Titulo"><br>
Registro de Estado del Presupuesto </p>

<?php echo form_open('estadoPresupuesto/estadopresupuestoRecord'); ?>


  <input type="hidden" name="estado_presupuesto_id" value="<?php echo isset($estado_presupuesto_id)?$estado_presupuesto_id:''; ?>">
  <input type="hidden" name="txtActivo" value="<?php echo isset($activo)?$activo:''; ?>">
  <table width="750" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
    <!--DWLayoutTable-->
      <tr>
        <td width="866" height="18" colspan="3" align="left" bgcolor="#FFFFFF" class="celdaError">
        <?php //echo '<br>'.validation_errors().'<br>';?>        <?php
          echo anchor('estadoPresupuesto','<img alt="Volver" src="'.base_url().'system/application/views/imagenes/volver.png" border="0">');
          ?></td>
      </tr>
      <tr>
      <td colspan="4" height="19"   valign="middle" class="celda">Nombre de Estado del Presupuesto <?php echo form_error('nombre_estado_presupuesto','<div class="celdaError">', '</div>');?></td>
      </tr>
      <tr>
        <td colspan="4" height="24" valign="top"> <input name="nombre_estado_presupuesto" type="text" id="nombre_estado_presupuesto" value="<?php echo set_value('$nombre_estado_presupuesto',isset($nombre_estado_presupuesto)?$nombre_estado_presupuesto:''); ?>" size="125" maxlength="200"></td>
      </tr>
      <tr>
        <td height="24" colspan="3" align="right" valign="top" bgcolor="#E9E8E2">
          <input name="cmdAceptar" type="submit" value="Aceptar"></td>
      </tr>
  </table>
  
</form>
</body>
</html>
