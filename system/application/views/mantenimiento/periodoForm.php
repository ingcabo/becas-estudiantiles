<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Registro de Periodos</title>
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
.Estilo1 {color: black; font-family: Geneva, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }
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
<p align="center" class="Titulo"><br>Registro de Periodos</p>

<?php echo form_open('periodo/periodoRecord'); ?>


  <input type="hidden" name="txtId" value="<?php echo $id; ?>">
  <input type="hidden" name="txtActivo" value="<?isset($activo)?$activo:''; ?>">
  <table width="736px" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
    <!--DWLayoutTable-->
      <tr>
        <td colspan="2" align="left" bgcolor="#FFFFFF" class="celdaError">
        <?php echo '<br>'.validation_errors().'<br>';?>        <?php
          echo anchor('periodo/periodoControl','<img alt="Volver" src="'.base_url().'system/application/views/imagenes/volver.png" border="0">');
          ?></td>
      </tr>
      
      <tr>
      <td width="371" height="19"  class="celda">Tipo de Periodo </td>
      <td width="343"  class="celda">Parcial del Periodo </td>
      </tr>
      <tr>
      <td height="22">
        <select name="cmbTipoPeriodos" id="cmbTipoPeriodos" style="width:363px">
          <option></option>
          <?php
          if($tipoPeriodos->num_rows()!=0)
          {
            foreach($tipoPeriodos->result() as $row)
            {
          ?>
              <option value="<?php echo($row->tipo_periodo_id);?>" <?php if($row->tipo_periodo_id==$tipoPeriodoId) echo ' selected'; ?> >
              <?php echo($row->nombre_tipo_periodo); ?>              </option>
          <?php
            }
          }
          ?>
        </select>      </td>
      <td>
        <input name="txtparcialPeriodo" type="text" id="txtparcialPeriodo" value="<?php if(isset($parcialPeriodo)) echo $parcialPeriodo; else echo ''; ?>" size="56">      </td>
      </tr>
      <tr>
      <td height="19" valign="middle" class="celda">Año del Periodo </td>
      <td height="19" valign="middle" class="celda">        Visible</td>
      </tr>
      <tr>
        <td height="24" valign="top">
          <?php echo form_dropdown('anoPeriodo',$anoPeriodo,isset($anoPeriodoSel)?$anoPeriodoSel:'0'); ?>        </td>
        <td>
          <input type="checkbox" name="chkVisible" value="true" checked="checked" />
        </td>
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
