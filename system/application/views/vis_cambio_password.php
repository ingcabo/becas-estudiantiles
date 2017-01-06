<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php $this->mod_usuario->en_session(); ?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>..::.. SCSBJEL ..::.. Cambiar Contrase&ntilde;a</title>
<LINK REL=StyleSheet HREF="<?php echo base_url(); ?>system/application/views/estilos/lista.css" TYPE="text/css" MEDIA=screen>
<script type="text/javascript" src="<?=base_url();?>system/application/views/js_menu/stmenu.js"></script>
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

<?php echo $menu;?>
<?php echo form_open('con_acceso/cambio_password');?>
<br> <table width="408" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
  <!--DWLayoutTable-->
  <tr>
    <td height="28" colspan="7" class="celda"><div align="center">Cambiar Contrase&ntilde;a</div></td>
  </tr>
  <tr>
    <td height="1" colspan="7">&nbsp;</td>
  </tr>
  <tr>
    <td height="22" colspan="3" valign="top" class="celdaContenido"><strong>&nbsp;Contrase&ntilde;a actual : </strong></td>
    <td colspan="3" valign="top"><label>
      <input name="txt_anterior" type="password" id="txt_anterior" value="" <?php echo set_value('txt_anterior');?>/>
    </label></td>
    <td width="68">&nbsp;</td>
  </tr>
  <tr>
    <td height="19" colspan="3"></td>
    <td colspan="4" valign="top"><?php echo form_error('txt_anterior');?></td>
  </tr>
  
  
  <tr>
    <td height="22" colspan="3" valign="top" class="celdaContenido"><strong>&nbsp;Nueva contrase&ntilde;a : </strong></td>
    <td colspan="3" valign="top"><label>
      <input name="txt_passnuevo" type="password" id="txt_passnuevo" value="" <?php echo set_value('txt_passnuevo');?>/>
    </label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td height="18" colspan="3"></td>
    <td colspan="4" valign="top"><?php echo form_error('txt_passnuevo');?></td>
  </tr>
  <tr>
    <td></td>
  </tr>
  <tr>
    <td height="22" colspan="3" valign="top" class="celdaContenido"><p><strong>&nbsp;Confirmar contrase&ntilde;a </strong>: </p></td>
    <td colspan="3" valign="top"><label>
      <input name="txt_passconfirma" type="password" id="txt_passconfirma" value="" <?php echo set_value('txt_passconfirma');?> />
    </label></td>
    <td></td>
  </tr>
  <tr>
    <td height="16" colspan="3"></td>
    <td colspan="4" valign="top"><?php echo form_error('txt_passconfirma');?></td>
  </tr>
  <tr>
    <td height="10" colspan="7"></td>
  </tr>
  
  
  <tr>
    <td height="26" colspan="7"><label>
      <div align="right">
        <input name="bto_aceptar" type="submit" id="bto_aceptar" value="Aceptar" />
        </div>
    </label></td>
  </tr>
</table>
</form>


</body>
</html>
