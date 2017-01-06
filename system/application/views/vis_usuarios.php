<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php $this->mod_usuario->en_session(); ?>
<head>
<link rel=StyleSheet href="<?php echo base_url(); ?>system/application/views/estilos/lista.css" type="text/css" media=screen>
<script type="text/javascript" src="<?php echo base_url(); ?>system/application/js/calendario/jscripts/scripts.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>system/application/js/calendario/jscripts/calendar/calendar.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>system/application/js/calendario/jscripts/calendar/calendar-es.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>system/application/js/calendario/jscripts/calendar/calendar-setup.js"></script>

<link media="screen" href="<?php echo base_url(); ?>system/application/js/calendario/styles/calendar-blue.css" rel="stylesheet" type="text/css" title="win2k-cold-1">
<link media="print" href="<?php echo base_url(); ?>system/application/js/calendario/styles/print.css" rel="stylesheet" type="text/css" title="win2k-cold-1">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="javascript">

    function estado(control){
        if(control.checked)
           control.value = 'f';
       else
           control.value = 't';
    }

    

</script>
<title>..:: SCSBJEL ::.. Registro de Usuarios</title>
<!-- Inicio de: JS y CSS para el DataPick. -->


<!--    Fin de: JS y CSS para el DataPick. -->
<style type="text/css">
<!--
body {
	body {
	background-image: url(<?php echo base_url(); ?>system/application/views/imagenes/bg2.gif);
	background-repeat: no-repeat;
	background-color: #a7d0e4;
}
-->
</style></head>

<body bgcolor="#FFFFFF" text="#000000" link="#0066FF" vlink="#9933FF" alink="#FF3333">

<p><?php echo $menu;?></p>
<table width="800" border="0" align="center">
  <tr>
    <td align="right" class="celdaContenido">MODO: <?php echo $this->modo_actual;?></td>
  </tr>
</table><p align="center" class="Titulo">Usuarios del Sistema</p>
<div>

</div>
<div align="center"><br>
</div>
<div align="center"><?php echo form_open($envia);?>
</div>
<div class="headerbox">
<div align="center">
  <table width="790" border="0" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2" class="table_usuarios">
    <tr>
      <td width="160" class="celda">Usuario:</td>
        <td width="200" >
          <input name="txt_usuario" type="text" id="txt_usuario" <?php echo isset($noeditar)?$noeditar:'';?> value="<?php echo set_value('txt_usuario',isset($this->campos->usr_nombre)?$this->campos->usr_nombre:'');?>"  size="21"/>  </td>
        <td width="440"><span style="color:#ff0000;">
          <?php echo form_error('txt_usuario');?>
          </span>    </td>
      </tr>
    
    <tr>
      <td colspan="3">
        <?php if($this->modo_actual === MODO_INCLUIR):?>  </td>
      </tr>
    
    <tr>
      <td  class="celda">Contraseña:</td>
        <td><input name="txt_password" type="password"  size="23" id="txt_password" value="" <?php echo set_value('txt_password');?>/>    </td>
        <td><span style="color:#ff0000" class="celda">
          <?php echo form_error('txt_password');?>
          </span></td>
      </tr>
    <tr>
      <td class="celda">Confirmar Contrase&ntilde;a:</td>
        <td>
          <input name="txt_confirma" type="password" id="txt_confirma" value="" size="23" <?php echo set_value('txt_confirma');?>/>    </td>
        <td><span style="color:#ff0000">
          <?php echo form_error('txt_confirma');?> </span><?php endif;?>    </td>
      </tr>
    <tr>
      <td class="celda">Correo Electr&oacute;nico:</td>
        <td>
          <input name="txt_email" type="text" id="txt_email" size="21" value="<?php echo set_value('txt_email',isset($this->campos->usr_correo_electronico)?$this->campos->usr_correo_electronico:'');?>"/>   </td>
        <td ><span style="color:#ff0000">
          <?php echo form_error('txt_email');?>
          </span></td>
      </tr>
    <tr>
      <td class="celda"><span style="float:left; margin-right:10px;">Fecha Expiraci&oacute;n:</span></td>
        <td><span style="float:left; margin-right:10px;">
          <input name="txt_fecha" type="text" size="21" id="txt_fecha" value="<?php echo set_value('txt_fecha',isset($this->campos->usr_fecha_expira)?$this->mylib_base->pg_to_human($this->campos->usr_fecha_expira):'');?>"/>
          </span>
          <img name="txt_fecha_img" id="txt_fecha_img" src="<?php echo base_url(); ?>system/application/js/calendario/images/calendar.gif" width="16" height="16"><!-- Inicio de: Iniciar DataPick. -->
          <script type="text/javascript">
		var campoId = 'txt_fecha';
		var imagenId = 'txt_fecha_img';
		iniciarCalendario(campoId, imagenId,'%d-%m-%Y',false);
		</script>    </td>
        <td><span style="color:#ff0000">
          <?=form_error('txt_fecha');?>
          </span></td>
      </tr>
    <tr>
      <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><div style="float:right;">
          <input name="bto_procesar" type="submit" id="bto_procesar" value="Guardar" />
          <input name="bto_limpiar"  type="button" id="bto_cancelar" value="Cancelar" onclick="location.href = '<?php echo base_url();?>index.php/con_listview_Usuarios'"/>
          </div></td>
      </tr>
  </table>
</div>
<div class="corner1"> </div>
<div class="corner2"> </div>
<div class="corner3"> </div>
<div class="corner4"> </div>
</div>

<div align="center"style="color:#E9E8E2"><br /> 
    <br />
  
</div>
<div class="tabla_usuarios_2" style="color:#E9E8E2">
  <div align="center"><?php echo $this->opciones_menu;?>
      </form>
  </div>
</div>


</div>
</div>
</div>


</body>
</html>
