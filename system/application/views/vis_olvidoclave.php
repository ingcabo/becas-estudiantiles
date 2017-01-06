<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>..:: SCSJEL ::.. Olvid&oacute; su contrase&ntilde;a</title>
<LINK REL=StyleSheet HREF="<?php echo base_url(); ?>system/application/views/estilos/lista.css" TYPE="text/css" MEDIA=screen>
<style type="text/css">
<!--
body {
		background-image: url(<?php echo base_url(); ?>system/application/views/imagenes/bg2.gif);
	background-repeat: no-repeat;
	background-color: #a7d0e4;
}
-->
</style></head>

<body>

<table heigth="90" width="939" align="center" cellpadding="0" cellspacing="0" >
  <!--DWLayoutTable-->
  <tr class="tope">
    <td height="185" colspan="3" valign="top"><!--DWLayoutEmptyCell-->&nbsp;    </td>
  </tr>
  
  <tr>
    <td width="226" height="19">&nbsp;</td>
    <td width="459" align="center" class="celda"><strong>Ingrese el correo electr&oacute;nico que utiliz&oacute; al registrarse en el Sistema </strong></td>
    <td width="252">&nbsp;</td>
  </tr>
  
  <tr>
    <td height="124">&nbsp;</td>
    <td valign="top" bgcolor="#E9E8E2" class="celdaContenido"><div align="center">
      <div style="float:left; margin-right:30px;">      </div>
           <p align="center" size=""><br>Correo Electr&oacute;nico :
             <input name="txt_email" type="text" id="txt_email" value="" <?php echo set_value('txt_email');?>/> 
      </p>
      <div style="color:#ff0000"><?=form_error('txt_email')?>
      </div>
      <div>
        <label></label>
        <label></label>
        <span style="color:#ff0000">
        <input name="bto_enviar" type="submit" id="bto_enviar" value="Enviar" />
        </span><span style="color:#ff0000">
        <input type="button" name="bto_cancelar" value="Cancelar" onclick="history.go(-1);" />
        </span></p>
  </div>  </tr>
</table>
  
</body>
</html>
