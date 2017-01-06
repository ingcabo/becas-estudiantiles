<?php $this->mod_usuario->en_session(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Registro de Nucleos de Institutos</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript" src="<?php echo base_url(); ?>system/application/js/general.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>system/application/js/masks.js"></script>
<LINK REL=StyleSheet HREF="<?php echo base_url(); ?>system/application/views/estilos/lista.css" TYPE="text/css" MEDIA=screen>
<script language="JavaScript1.2">
	<!--//
	  function init(){
		  document.frmnucleos.reset();

		  otni1Mask = new Mask("(####) ###-##-##");
		  otni1Mask.attach(document.frmnucleos.telefono01_nucleo_instituto);
          otni1Mask.attach(document.frmnucleos.telefono02_nucleo_instituto);
          otni1Mask.attach(document.frmnucleos.telefono03_nucleo_instituto);
          otni1Mask.attach(document.frmnucleos.telefono04_nucleo_instituto);
          otni1Mask.attach(document.frmnucleos.fax01_nucleo_instituto);
          otni1Mask.attach(document.frmnucleos.fax02_nucleo_instituto);
          otni1Mask.attach(document.frmnucleos.telefono_contacto_01);
          otni1Mask.attach(document.frmnucleos.telefono_contacto_02);

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
<p align="center" class="Titulo">Registro de Núcleos de Institutos</p>

<?php
  $atributos = array('id' => 'frmnucleos' ,'name' => 'frmnucleos');
  $formato_telefono = '(%d%d%d) %d%d%d-%d%d-%d%d';

  echo form_open('nucleo/nucleoRecord',$atributos);
?>


  <input type="hidden" name="nucleo_instituto_id" value="<?php echo isset($nucleo_instituto_id)?$nucleo_instituto_id:''; ?>">
  <input type="hidden" name="txtActivo" value="<?php echo isset($activo)?$activo:''; ?>">
  <table width="736px" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
    <!--DWLayoutTable-->
      <tr>
        <td height="18" colspan="3" align="left" bgcolor="#FFFFFF" class="celdaError">
        <?php //echo '<br>'.validation_errors().'<br>';?>        <?php
          echo anchor('nucleo','<img alt="Volver" src="'.base_url().'system/application/views/imagenes/volver.png" border="0">');
          ?></td>
      </tr>
      
      <tr>
      <td width="371" height="19"  class="celda" ><span class="celdaTitulo">Nombre del Instituto</span><?php echo form_error('instituto_id','<div class="celdaError">', '</div>');?></td>
      <td width="343"  class="celda">Parroquia</td>
      <td width="22">&nbsp;</td>
      </tr>
      <tr>
      <td height="22">
      <?php
        $opciones = 'style="width:370px"';
        if(isset($instituto_id)){
          echo form_dropdown('instituto_lista',$instituto_lista,$instituto_id,$opciones);
        }else{
          echo form_dropdown('instituto_lista',$instituto_lista,'',$opciones);
        }
      ?>      </td>
      </td>
      <td>
      <?php
        $opciones = 'style="width:370px"';
        if(isset($parroquia_id)){
          echo form_dropdown('parroquia_lista',$parroquia_lista,$parroquia_id,$opciones);
        }else{
          echo form_dropdown('parroquia_lista',$parroquia_lista,'',$opciones);
        }
      ?>      </td>
      </tr>
      <tr>
      <td height="19" valign="middle" class="celda">Nombre del Núcleo <?php echo form_error('nombre_nucleo_instituto','<div class="celdaError">', '</div>');?></td>
      <td height="19" valign="middle" class="celda">Siglas del Núcleo <?php echo form_error('siglas_nucleo_instituto','<div class="celdaError">', '</div>');?></td>
      <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="24" valign="top">
          <input name="nombre_nucleo_instituto" type="text" id="nombre_nucleo_instituto" value="<?php echo set_value('nombre_nucleo_instituto',isset($nombre_nucleo_instituto)?$nombre_nucleo_instituto:''); ?>" size="56" maxlength="200">      </td>
        </td>
        <td><input name="siglas_nucleo_instituto" type="text" id="siglas_nucleo_instituto" value="<?php echo set_value('siglas_nucleo_instituto',isset($siglas_nucleo_instituto)?$siglas_nucleo_instituto:''); ?>" size="56" maxlength="20">      </td>
      </tr>
      <tr>
      <td colspan="2" height="19"   valign="middle" class="celda">Dirección del Núcleo <?php echo form_error('direccion_nucleo_instituto','<div class="celdaError">', '</div>');?></td>
      </tr>
      <tr>
        <td colspan="3" height="24" valign="top"> <input name="direccion_nucleo_instituto" type="text" id="direccion_nucleo_instituto" value="<?php echo set_value('$direccion_nucleo_instituto',isset($direccion_nucleo_instituto)?$direccion_nucleo_instituto:''); ?>" size="118" maxlength="2000">      </td>
      </tr>
      <tr>
      <td height="19" valign="middle" class="celda">Teléfono Principal<?php echo form_error('telefono01_nucleo_instituto','<div class="celdaError">', '</div>');?></td>
      <td height="19" valign="middle" class="celda">Teléfono Secundario<?php echo form_error('telefono02_nucleo_instituto','<div class="celdaError">', '</div>');?></td>
      <td>&nbsp;</td>
      </tr>
      <tr>
      <td height="24" valign="top"> <input name="telefono01_nucleo_instituto" type="text" id="telefono01_nucleo_instituto" value="<?php echo set_value('$telefono01_nucleo_instituto',isset($telefono01_nucleo_instituto)?$telefono01_nucleo_instituto:''); ?>" size="56" maxlength="15"  >      </td>
        <td height="24" valign="top"> <input name="telefono02_nucleo_instituto" type="text" id="telefono02_nucleo_instituto" value="<?php echo set_value('$telefono02_nucleo_instituto',isset($telefono02_nucleo_instituto)?$telefono02_nucleo_instituto:''); ?>" size="56" maxlength="15">      </td>
      
        </td>
      </tr>
      <tr>
      <td height="19" valign="middle" class="celda">Teléfono Alternativo<?php echo form_error('telefono03_nucleo_instituto','<div class="celdaError">', '</div>');?></td>
      <td height="19" valign="middle" class="celda">Teléfono Alternativo<?php echo form_error('telefono04_nucleo_instituto','<div class="celdaError">', '</div>');?></td>
      
      <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="24" valign="top"> <input name="telefono03_nucleo_instituto" type="text" id="telefono03_nucleo_instituto" value="<?php echo set_value('$telefono03_nucleo_instituto',isset($telefono03_nucleo_instituto)?$telefono03_nucleo_instituto:''); ?>" size="56" maxlength="15">      </td>
        <td height="24" valign="top"> <input name="telefono04_nucleo_instituto" type="text" id="telefono04_nucleo_instituto" value="<?php echo set_value('$telefono04_nucleo_instituto',isset($telefono04_nucleo_instituto)?$telefono04_nucleo_instituto:''); ?>" size="56" maxlength="15">      </td>
        </td>
      </tr>
      <tr>
      <td height="19" valign="middle" class="celda">Número de Fax<?php echo form_error('fax01_nucleo_instituto','<div class="celdaError">', '</div>');?></td>
      <td height="19" valign="middle" class="celda">Número de Fax Alternativo<?php echo form_error('fax02_nucleo_instituto','<div class="celdaError">', '</div>');?></td>
      
      <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="24" valign="top"> <input name="fax01_nucleo_instituto" type="text" id="fax01_nucleo_instituto" value="<?php echo set_value('fax01_nucleo_instituto',isset($fax01_nucleo_instituto)?$fax01_nucleo_instituto:''); ?>" size="56" maxlength="15">      </td>
        <td height="24" valign="top"> <input name="fax02_nucleo_instituto" type="text" id="fax02_nucleo_instituto" value="<?php echo set_value('fax02_nucleo_instituto',isset($fax02_nucleo_instituto)?$fax02_nucleo_instituto:''); ?>" size="56" maxlength="15">      </td>
        </td>
      </tr>
      <tr>
      <td height="19" valign="middle" class="celda">Correo Electrónico<?php echo form_error('email01_nucleo_instituto','<div class="celdaError">', '</div>');?></td>
      <td height="19" valign="middle" class="celda">Correo Electrónico Alternativo<?php echo form_error('email02_nucleo_instituto','<div class="celdaError">', '</div>');?></td>

      <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="24" valign="top"> <input name="email01_nucleo_instituto" type="text" id="email01_nucleo_instituto" value="<?php echo set_value('email01_nucleo_instituto',isset($email01_nucleo_instituto)?$email01_nucleo_instituto:''); ?>" size="56" maxlength="30">      </td>
        <td height="24" valign="top"> <input name="email02_nucleo_instituto" type="text" id="email02_nucleo_instituto" value="<?php echo set_value('email02_nucleo_instituto',isset($email02_nucleo_instituto)?$email02_nucleo_instituto:''); ?>" size="56" maxlength="30">      </td>
        </td>
      </tr>
      <tr>
      <td height="19" valign="middle" class="celda">Persona Contacto<?php echo form_error('contacto_01','<div class="celdaError">', '</div>');?></td>
      <td height="19" valign="middle" class="celda">Teléfono Persona Contacto<?php echo form_error('telefono_contacto_01','<div class="celdaError">', '</div>');?></td>

      <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="24" valign="top"> <input name="contacto_01" type="text" id="contacto_01" value="<?php echo set_value('contacto_01',isset($contacto_01)?$contacto_01:''); ?>" size="56" maxlength="100">      </td>
        <td height="24" valign="top"> <input name="telefono_contacto_01" type="text" id="telefono_contacto_01" value="<?php echo set_value('telefono_contacto_01',isset($telefono_contacto_01)?$telefono_contacto_01:''); ?>" size="56" maxlength="15">      </td>
        </td>
      </tr>
      <tr>
      <td height="19" valign="middle" class="celda">Persona Contacto Alternativo<?php echo form_error('contacto_02','<div class="celdaError">', '</div>');?></td>
      <td height="19" valign="middle" class="celda">Teléfono Persona Contacto Alternativo<?php echo form_error('telefono_contacto_02','<div class="celdaError">', '</div>');?></td>

      <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="24" valign="top"> <input name="contacto_02" type="text" id="contacto_02" value="<?php echo set_value('contacto_02',isset($contacto_02)?$contacto_02:''); ?>" size="56" maxlength="100">      </td>
        <td height="24" valign="top"> <input name="telefono_contacto_02" type="text" id="telefono_contacto_02" value="<?php echo set_value('telefono_contacto_02',isset($telefono_contacto_02)?$telefono_contacto_02:''); ?>" size="56" maxlength="15">      </td>
        </td>
      </tr>
      <tr>
        <td height="24" colspan="2" align="right" valign="top">
          <input name="cmdAceptar" type="submit" value="Aceptar"></td>
      <td></td>
      </tr>
</table>
  
</form>
</body>
</html>
