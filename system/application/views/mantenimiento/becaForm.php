<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Registro de Becas</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript" src="<?php echo base_url(); ?>system/application/js/general.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>system/application/js/masks.js"></script>
<LINK REL=StyleSheet HREF="<?php echo base_url(); ?>system/application/views/estilos/lista.css" TYPE="text/css" MEDIA=screen>
<script language="JavaScript1.2">
	<!--//
	  function init(){
		  document.frmbecas.reset();

		  otni1Mask = new Mask("###,##","number");
		  otni1Mask.attach(document.frmbecas.monto_beca);
		  
	  }
	
		
	//-->
	</script>
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
	background-color: #a7d0e4;
}

-->
</style>
</head>

<body onLoad="init();" >
<?php echo $menu; ?>
<br>
<p align="center" class="Titulo">Registro de Becas
  <?php
  $atributos = array('id' => 'frmbecas' ,'name' => 'frmbecas');
  echo form_open('beca/becaRecord',$atributos);
?>
  <input type="hidden" name="beca_id" value="<?php echo isset($beca_id)?$beca_id:''; ?>">
  <input type="hidden" name="txtActivo" value="<?php echo isset($activo)?$activo:''; ?>">
</p>

<table width="736px" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
    <!--DWLayoutTable-->
      <tr>
        <td height="18" colspan="3" align="left" bgcolor="#FFFFFF" class="celdaError">
        <?php //echo '<br>'.validation_errors().'<br>';?>        <?php
          echo anchor('beca','<img alt="Volver" src="'.base_url().'system/application/views/imagenes/volver.png" border="0">');
          ?></td>
    </tr>
      
      <tr>
      <td width="368" height="19"  class="celda" >Nombre de la Beca<span class="fontnormal"><font color="#FF0000"><?php echo form_error('nombre_beca','<div class="celdaError">', '</div>');?></td>
      <td width="360"  class="celda">Tipo de Beca <?php echo form_error('tipo_beca_id','<div class="celdaError">', '</div>');?></td>
      <td width="4">&nbsp;</td>
      </tr>
      <tr>
      <td>
      <input name="nombre_beca" type="text" id="nombre_beca" <?php if($permisos['sl']['nombre_beca']) echo 'disabled';?> value="<?php echo set_value('nombre_beca',isset($nombre_beca)?$nombre_beca:''); ?>" size="56" maxlength="200">      </td>
      <td height="22">
      <?php
        if($permisos['sl']['nombre_beca']){
          echo '<input name="nombre_beca" type="hidden" id="nombre_beca" value="'.set_value('nombre_beca',isset($nombre_beca)?$nombre_beca:'').'" size="56" maxlength="200">';
        }
        $opciones = 'style="width:378px"';
        if(isset($tipo_beca_id)){
          echo form_dropdown('tipo_beca_id',$tipo_beca_lista,$tipo_beca_id,$opciones);
        }else{
          echo form_dropdown('tipo_beca_id',$tipo_beca_lista,'',$opciones);
        }
      ?>      </td>
      </td>
      <td width="4">&nbsp;</td>
      </tr>
      <tr>
        <td height="19" colspan="2" valign="middle" class="celda">Monto de la Beca <?php echo form_error('monto_beca','<div class="celdaError">', '</div>');?></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
      
      <td height="19" colspan="2" valign="middle"><input name="monto_beca" align="right" type="text" id="monto_beca" value="<?php echo set_value($monto_beca,isset($monto_beca)?number_format($monto_beca,2,',','.'):''); ?>" size="119"></td>
      <td>&nbsp;</td>
      </tr>
      <tr>
        <?php
        $combinable = '';
        if(isset($combinable_beca)){
          if($combinable_beca!=0){
            $combinable = 'checked';
          }
        }
        ?>
        <td width="360" height="19" colspan="2" valign="middle" class="celda">
          <input name="combinable_beca"  type="checkbox" id="combinable_beca" value="1" <?php echo $combinable; ?> size="56" >
        Es Combinable <?php echo form_error('combinable_beca','<div class="celdaError">', '</div>');?></td>
        <td>&nbsp;</td>
      </tr>
      
      <tr>
        <td height="24" colspan="2" align="right" valign="top">
          <input name="cmdAceptar" type="submit" value="Aceptar"></td>
      <td></td>
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
