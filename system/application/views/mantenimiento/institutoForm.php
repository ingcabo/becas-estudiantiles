<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Registro de Institutos</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript" src="<?php echo base_url(); ?>system/application/js/general.js"></script>
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
body {
	background-image: url(<?php echo base_url(); ?>system/application/views/imagenes/bg2.gif);
	background-repeat: no-repeat;
	background-color: #a7d0e4;;
}

-->
</style>
</head>

<body>
<?php echo $menu; ?>
<p align="center" class="Titulo"><br>Registro de Institutos</p>

<?php echo form_open('instituto/institutoRecord'); ?>


  <input type="hidden" name="txtId" value="<?php echo isset($institutoId)?$institutoId:''; ?>">
  <input type="hidden" name="txtActivo" value="<?php echo isset($activo)?$activo:''; ?>">
  <table width="689" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
    <!--DWLayoutTable-->
      <tr>
        <td colspan="2" align="left" bgcolor="#FFFFFF" class="celdaError">
        <?php //echo '<br>'.validation_errors().'<br>';?>        <?php
          echo anchor('instituto','<img alt="Volver" src="'.base_url().'system/application/views/imagenes/volver.png" border="0">');
          ?></td>
      </tr>
      
      <tr>
      <td width="353" height="19" valign="middle" class="celda">Nombre del Instituto <?php echo form_error('txtnombre_instituto','<div class="celdaError">', '</div>');?></td>
      <td width="336" height="19" valign="middle" class="celda">Siglas</td>
      </tr>
      <tr>
      <td height="22">
        <input name="txtnombre_instituto" type="text" id="txtnombre_instituto" value="<?php echo set_value('txtnombre_instituto',isset($nombre_instituto)?$nombre_instituto:''); ?>" size="56">      </td>
        <td>
          <input name="txtsiglas_instituto" type="text" id="txtsiglas_instituto" value="<?php echo set_value('txtsiglas_instituto',isset($siglas_instituto)?$siglas_instituto:''); ?>" size="56">      </td>
      </tr>
      <tr>
      <td height="19" valign="middle" class="celda">Número RIF <?php echo form_error('txtrif_instituto','<div class="celdaError">', '</div>');?></td>
      <td height="19" valign="middle" class="celda">Nombre del Rector <?php echo form_error('txtrector_instituto','<div class="celdaError">', '</div>');?></td>
      </tr>
      <tr>
        <td height="24" valign="top">
            <select name="ddl_ini_rif">
                <option value="J" selected>J</option>
                <option value="G">G</option>
                <option value="V">V</option>
                <option value="E">E</option>
            </select>
            <input name="txtrif_instituto" type="text" id="txtrif_instituto" value="<?php echo set_value('txtrif_instituto',isset($rif_instituto)?$rif_instituto:''); ?>" size="49" onKeyPress="return SoloNumero(event);"></td>
        <td><input name="txtrector_instituto" type="text" id="txtrector_instituto" value="<?php echo set_value('txtrector_instituto',isset($rector_instituto)?$rector_instituto:''); ?>" size="56">      </td>
      </tr>
      <tr>
      <td height="19" colspan="2" valign="middle" class="celda">Costo de la Unidad de Crédito <?php echo form_error('txtunidad_credito_instituto','<div class="celdaError">', '</div>');?></td>
      </tr>
      <tr>
        <td height="24" colspan="2" valign="top"><input name="txtunidad_credito_instituto" type="text" id="txtunidad_credito_instituto" value="<?php echo set_value('txtunidad_credito_instituto',isset($unidad_credito_instituto)?$unidad_credito_instituto:''); ?>" size="118" onKeyPress="return SoloNumero(event);"></td>
      </tr>
      <tr>
        <td height="24" colspan="2" align="right" valign="top">
        <input name="cmdAceptar" type="submit" value="Aceptar"></td>
      </tr>
      <tr>
        <td height="3"></td>
        <td></td>
      </tr>
</table>
  
</form>
</body>
</html>
