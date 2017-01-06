<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php $this->mod_usuario->en_session(); ?>
<html>
<head>
<title>Carga de Informaci&oacute;n Acad&eacute;mica</title>
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
<p align="center" class="Titulo"><br>Carga de Informaci&oacute;n Acad&eacute;mica</p>


<?php echo form_open_multipart('cargaInfoAcademica/cargaInfoAcademicaRecord');?>


  <table width="785" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
      <tr>
        <td colspan="4" align="left" bgcolor="#FFFFFF" class="celdaError">   
        <?php echo $error;?>
        <?php
          echo anchor('JEL/index','<img alt="Volver" src="'.base_url().'system/application/views/imagenes/volver.png" border="0">');
          ?></td>
      </tr>
      

      <tr>
        <td width="780"  class="celda">
        Instututo:</td>
     </tr>
     <tr>
        <td>
	  	  <div align="left">
	  	  <select name="cmbInstituto" id="cmbInstituto" style="width:785px">
          <option value="-1"></option>
          <?php
          if($institutos->num_rows()!=0)
          {
            foreach($institutos->result() as $row)
            {
          ?>
              <option value="<?php echo($row->instituto_id);?>">
              <?php echo($row->nombre_instituto); ?>              </option>
          <?php
            }
          }
          ?>
        </select>
        </div>        </td>
     </tr>

      <tr>
        <td width="780" class="celda">
        <strong>
        Archivo de Información Académica: <span class="fontnormal"><font color="#FF0000">   </font></span>        </strong>        </td>
     </tr>
     <tr>
        <td bgcolor="#FFFFFF">
	  	  <div align="left">
	  	  <input type="file" name="userfile" id="userfile" size="110">
       </div>        </td>
     </tr>
     <tr>
      <td colspan="2" align="right" bgcolor="#FFFFFF">
      <div align="center">
      <font face="Arial, Helvetica, sans-serif">
      <strong> 
          <input name="btnAceptar" type="submit" id="btnAceptar" value=" Aceptar ">
          <input name="btnCancelar" type="button" id="btnCancelar" value="Cancelar">
       </strong>      </font>      </div>      </td>
    </tr>
</table>
  <script>setFocus("userfile");</script>
</form>
</body>
</html>