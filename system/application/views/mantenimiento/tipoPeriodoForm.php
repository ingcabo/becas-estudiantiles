<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Registro de Tipos de Periodos</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
<p align="center" class="Titulo"><br>Registro de Tipos de Periodos</p>

<?php echo form_open('tipoPeriodo/tipoPeriodoRecord'); ?>


  <input type="hidden" name="txtId" value="<?php echo $id; ?>">
  <input type="hidden" name="txtActivo" value="<?php echo $activo; ?>">
  <table width="736px" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
      <tr>
        <td colspan="4" align="left" bgcolor="#FFFFFF" class="celdaError">
        <?php echo '<br>'.validation_errors().'<br>';?>
        <?php
          echo anchor('tipoPeriodo/tipoPeriodoControl','<img alt="Volver" src="'.base_url().'system/application/views/imagenes/volver.png" border="0">');
          ?></td>
      </tr>
      
      <tr>
      <td  class="celda">
      <strong>
      Modalidad      </strong>      </td>
      <td  class="celda">
      <strong>
      Tipo de Periodo      </strong>      </td>
      </tr>
      <tr>
      <td>
        <select name="cmbModalidad" id="cmbModalidad" style="width:363px">
          <option></option>
          <?php
          if($modalidades->num_rows()!=0)
          {
            foreach($modalidades->result() as $row)
            {
          ?>
              <option value="<?php echo($row->modalidad_id);?>" <?php if($row->modalidad_id==$modalidadId) echo ' selected'; ?> >
              <?php echo($row->nombre_modalidad); ?>              </option>
          <?php
            }
          }
          ?>
        </select>      </td>
      <td>
        <input name="txtTipoPeriodo" type="text" id="txtTipoPeriodo" value="<?php echo $nombreTipoPeriodo; ?>" size="56">      </td>
      </tr>
      <tr>
      <td colspan="2" align="right">
        <input name="cmdAceptar" type="submit" value="Aceptar">      </td>
      </tr>
</table>
  
</form>
</body>
</html>
