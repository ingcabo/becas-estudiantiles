<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<link rel=StyleSheet href="<?php echo base_url(); ?>system/application/views/estilos/lista.css" type="text/css" media=screen>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title; ?></title>

<script type="text/javascript">
window.onerror=function(m,u,l)
{
	window.status = "Java Script Error: "+m;
	return true;
}
</script><style type="text/css">
<!--
body {
	background-image: url();
}

-->
</style></head>
<body text="#000000" link="#0066FF" vlink="#9933FF" alink="#FF3333">
<div style=" min-height:100%; position:relative;">
<table align="center" cellpadding="0" cellspacing="0">
  <!--DWLayoutTable-->
  <tr>
    <td class="tope" width="942" height="185">
    <br>
    <br>
	<br>
	 &nbsp;
&nbsp;    </td>
    </tr>
  <tr align="center">
  <td height="19"><span style="float:right;">MODO<?php echo $this->modo_actual;?>:</span></td>
</tr>
  <tr align="center">
    <td height="312" valign="top">


<?php echo $this->validation->error_string; ?>




<?php echo form_open('cnuevousuario'); ?>
<table width="300" border="0" cellpadding="0" cellspacing="0">
  <!--DWLayoutTable-->
  <tr>
    <td height="26" colspan="2" align="center" valign="top"  scope="col" class="celda">Usuarios del Sistema</td>
          <td width="2"></td>
  </tr>
  <tr>
    <td width="91" height="19" bgcolor="e9e8e2">&nbsp;</td>
    <td width="207" bgcolor="e9e8e2">&nbsp;</td>
    <td></td>
  </tr>
  
  
  
  
  <tr>
    <td height="22" valign="top" bgcolor="#E9E8E2" class="celdacontenido" >&nbsp;Usuario:</td>
            <td valign="top" bgcolor="#E9E8E2"><input type="text" id="usuario" name="usuario" size="19" maxlength="16" value="" <?php echo set_value('usuario')?> /></td>
            <td></td>
  </tr>
  <tr>
    <td height="1" bgcolor="e9e8e2"></td>
        <td bgcolor="e9e8e2"></td>
          <td></td>
  </tr>
  <tr>
    <td height="18" colspan="2" valign="top" bgcolor="e9e8e2"><?php echo form_error('usuario')?></td>
          <td></td>
  </tr>
 <tr>
    <td height="1" bgcolor="e9e8e2"></td>
        <td rowspan="2" valign="top" bgcolor="#E9E8E2"><input type="password" id="clave" name="clave" size="21" maxlength="16" value="" <?php echo set_value('clave')?> /></td>
            <td></td>
  </tr>
  <tr>
    <td rowspan="2" valign="top" bgcolor="#E9E8E2" class="celdacontenido">&nbsp;Contraseña:</td>
          <td height="2"></td>
  </tr>
  
  <tr>
    <td height="1" bgcolor="e9e8e2" ></td>
    <td></td>
  </tr>
   <tr>
    <td height="18" colspan="2" valign="top" bgcolor="e9e8e2" class="celdaError"><?php echo form_error('clave')?>
      <?=isset($claveerronea)?$claveerronea:'';?></td>
          <td></td>
  </tr>
  
  
  
  
  
   <tr>
     <td height="25" colspan="2" align="center" valign="top" bgcolor="e9e8e2" class="celdaError"><input type="submit" name="ini2" value="Iniciar Sesión" align="right" onclick="enviar(3);" /></td>
     <td></td>
   </tr>
   <tr>
     <td height="25" colspan="2" align="center" valign="top" bgcolor="e9e8e2" class="celdaError"><!--DWLayoutEmptyCell-->&nbsp;</td>
     <td></td>
   </tr>
   <tr>
    <td height="25" colspan="2" align="center" valign="top" bgcolor="e9e8e2" class="celdaError"><a href="<?php echo base_url();?>index.php/con_acceso/recuperarclave">¿Has olvidado la contraseña?</a></td>
          <td></td>
  </tr>
</table></td>
</tr>
  <tr align="center">
    <td height="73">&nbsp;</td>
  </tr>
</table>

</div>
</body>
</html>
