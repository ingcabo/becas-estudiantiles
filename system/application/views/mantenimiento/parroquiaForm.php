<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Registro de Parroquias</title>
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
<?php echo $js; ?>
</head>

<body>
<?php echo $menu; ?>
<p align="center" class="Titulo"><br>Registro de Parroquias</p>

<?php echo form_open('parroquia/parroquiaRecord'); ?>

  <input type="hidden" name="txtId" value="<?php echo $id; ?>">
  <input type="hidden" name="txtActivo" value="<?php echo $activo; ?>">
  <table width="736px" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
      <tr>
        <td colspan="2" align="left" bgcolor="#FFFFFF" class="celdaError">
        <?php echo '<br>'.validation_errors().'<br>';?>
        <?php
          echo anchor('parroquia/parroquiaControl','<img alt="Volver" src="'.base_url().'system/application/views/imagenes/volver.png" border="0">');
          ?></td>
      </tr>
      
      <tr>
      <td  class="celda">
      <strong>
      Nombre del País      </strong>      </td>
      <td  class="celda">
      <strong>
      Nombre del Estado      </strong>      </td>
      </tr>
      <tr>
      <td>
        <select name="cmbPais" id="cmbPais" style="width:363px" onChange="xajax_buildSelectEstados(this.value)">
          <option value="-1"></option>
          <?php
          if($paises->num_rows()!=0)
          {
            foreach($paises->result() as $row)
            {
          ?>
              <option value="<?php echo($row->pais_id);?>" <?php if($row->pais_id==$paisId) echo ' selected'; ?> >
              <?php echo($row->nombre_pais); ?>              </option>
          <?php
            }
          }
          ?>
        </select>      </td>
      <td>
        <div id="divEstado">
        <select name="cmbEstado" id="cmbEstado" style="width:401px">
          <option value="-1"></option>
          <?php
          if($estados)
          {
              if($estados->num_rows()!=0)
              {
                foreach($estados->result() as $row)
                {
              ?>
                  <option value="<?php echo($row->estado_id);?>" <?php if($row->estado_id==$estadoId) echo ' selected'; ?> >
                  <?php echo($row->nombre_estado); ?>                  </option>
              <?php
                }
              }
          }
          ?>
        </select>
        </div>      </td>
      </tr>
      <tr>
      <td  class="celda">
      <strong>
      Nombre del Municipio      </strong>      </td>
      <td  class="celda" >
      <strong>
      Nombre de la Parroquia      </strong>      </td>
      </tr>
      <tr>
       <td>
        <div id="divMunicipio">
        <select name="cmbMunicipio" id="cmbMunicipio" style="width:363px">
          <option value="-1"></option>
          <?php
          if($municipios)
          {
              if($municipios->num_rows()!=0)
              {
                foreach($municipios->result() as $row)
                {
              ?>
                  <option value="<?php echo($row->municipio_id);?>" <?php if($row->municipio_id==$municipioId) echo ' selected'; ?> >
                  <?php echo($row->nombre_municipio); ?>                  </option>
              <?php
                }
              }
          }
          ?>
        </select>
        </div>       </td>
      <td>
        <input name="txtParroquia" type="text" id="txtParroquia" value="<?php echo $nombreParroquia; ?>" size="61">      </td>
      </tr>
      <tr>
      <td colspan="2" align="right">
        <input name="cmdAceptar" type="submit" value="Aceptar">      </td>
      </tr>
</table>
  <script>setFocus("cmbPais");</script>
</form>
</body>
</html>
