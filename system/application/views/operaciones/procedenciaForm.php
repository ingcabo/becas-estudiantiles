<?php  $this->mod_usuario->en_session(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Registro de Procedencias</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<LINK REL=StyleSheet HREF="<?php echo base_url(); ?>system/application/views/estilos/lista.css" TYPE="text/css" MEDIA=screen>
<script type="text/javascript" src="<?php  echo base_url(); ?>system/application/js/general.js"></script>
<!-- Inicio de: JS y CSS para el DataPick. -->
<script type="text/javascript" src="<?php echo base_url(); ?>system/application/js/calendario/jscripts/scripts.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>system/application/js/calendario/jscripts/calendar/calendar.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>system/application/js/calendario/jscripts/calendar/calendar-es.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>system/application/js/calendario/jscripts/calendar/calendar-setup.js"></script>

<link media="screen" href="<?php echo base_url(); ?>system/application/js/calendario/styles/calendar-blue.css" rel="stylesheet" type="text/css" title="win2k-cold-1">
<link media="print" href="<?php echo base_url(); ?>system/application/js/calendario/styles/print.css" rel="stylesheet" type="text/css" title="win2k-cold-1">
<!--    Fin de: JS y CSS para el DataPick. -->
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
<script type="text/javascript" charset="UTF-8">


function abrirPagina(op)
	{
		switch (op)
		{
			case 1:
			{//BUSCAR SUPERVISOR
				VentanaContacto = window.open("buscarContacto.php", "miwina", "menubar=no, resizable=yes, scrollbars=yes");
				break;
			}
		}
	}
</script>


<?php echo $js; ?>
</head>

<body>
<?php echo $menu; ?>
<p align="center" class="Titulo"><br>Registro de Procedencias<?php echo form_open('procedencia/procedenciaRecord'); ?>
  <input type="hidden" name="txtId" value="<?php echo $id; ?>">
  <input type="hidden" name="txtActivo" value="<?php echo $activo; ?>">
</p>

<table width="736px" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
      <tr>
        <td colspan="4" align="left" bgcolor="#FFFFFF" class="celdaError">
        <?php echo '<br>'.validation_errors().'<br>';?>
        <?php
          
          echo anchor('procedencia/procedenciaControl','<img alt="Volver" src="'.base_url().'system/application/views/imagenes/volver.png" border="0">');
          ?></td>
      </tr>
      

      <tr>
      <td  class="celda">
      <strong>
      Contacto      </strong>      </td>
      <td  class="celda">
      <strong>
      Tipo de Procedencia      </strong>      </td>
      </tr>
      <tr>
      <td valign="center">
        <select name="cmbContacto" id="cmbContacto" style="width:337px">
          <option value="-1"></option>
          <?php
          if($contactos->num_rows()!=0)
          {
            foreach($contactos->result() as $row)
            {
          ?>
              <option value="<?php echo($row->persona_id);?>" <?php if($row->persona_id==$contactoId) echo ' selected'; ?> >
              <?php echo($row->nombre_persona.' '.$row->apellido_persona); ?>              </option>
          <?php
            }
          }
          ?>
        </select>
        <?php
          echo anchor('procedencia/buscarContacto','<img alt="Modificar" src="'.base_url().'system/application/views/imagenes/buscar.png" border="0">');
        ?>
        <!--img alt="Buscar Contacto" src="http://portatil-01/JEL/system/application/views/imagenes/buscar.png" border="0" onClick="abrirPagina(1)"-->      </td>
      <td>
        <select name="cmbTipoProcedencia" id="cmbTipoProcedencia" style="width:367px">
          <option value="-1"></option>
          <?php
          if($tiposProcedencia->num_rows()!=0)
          {
            foreach($tiposProcedencia->result() as $row)
            {
          ?>
              <option value="<?php echo($row->tipo_procedencia_id);?>" <?php if($row->tipo_procedencia_id==$tipoProcedenciaId) echo ' selected'; ?> >
              <?php echo($row->nombre_tipo_procedencia); ?>              </option>
          <?php
            }
          }
          ?>
        </select>      </td>
      </tr>

      <tr>
      <td  class="celda">
      <strong>
      País      </strong>      </td>
      <td  class="celda">
      <strong>
      Estado      </strong>      </td>
      </tr>
      <tr>
      <td>
        <select name="cmbPais" id="cmbPais" style="width:367px" onChange="xajax_buildSelectEstados(this.value)">
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
       <div id="divCmbEstado">
        <select name="cmbEstado" id="cmbEstado" style="width:367px">
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
      Municipio      </strong>      </td>
      <td  class="celda">
      <strong>
      Parroquia      </strong>      </td>
      </tr>
      <tr>
      <td>
      <div id="divCmbMunicipio">
        <select name="cmbMunicipio" id="cmbMunicipio" style="width:367px">
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
      </div>      </td>
      <td>
      <div id="divCmbParroquia">
        <select name="cmbParroquia" id="cmbParroquia" style="width:367px">
          <option value="-1"></option>
          <?php
          if($parroquias)
          {
              if($parroquias->num_rows()!=0)
              {
                foreach($parroquias->result() as $row)
                {
              ?>
                  <option value="<?php echo($row->parroquia_id);?>" <?php if($row->parroquia_id==$parroquiaId) echo ' selected'; ?> >
                  <?php echo($row->nombre_parroquia); ?>                  </option>
              <?php
                }
              }
          }
          ?>
        </select>
      </div>      </td>
      </tr>
</table>

  <table width="736px" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
      <tr>
      <td  class="celda" style="width:140px">
      <strong>
      Fecha
      </strong>
      </td>
      <td  class="celda" style="width:606px">
      <strong>
      Lugar
      </strong>
      </td>
      </tr>
      <tr>
      <td valign="middle">
        <input name="txtFechaProcedencia" type="text" id="txtFechaProcedencia" value="<?php echo $fechaProcedencia; ?>" size="9">
        <img name="dFecCalendario" id="dFecCalendario" src="<?php echo base_url(); ?>system/application/views/imagenes/calendario.png" width="16" height="16" />
    <!-- Inicio de: Iniciar DataPick. -->
    <script type="text/javascript">
	var campoId = 'txtFechaProcedencia';
	var imagenId = 'dFecCalendario';
		
		
	iniciarCalendario(campoId, imagenId,'%d-%m-%Y',false);
	</script> 
      </td>
      <td>
        <input name="txtLugarProcedencia" type="text" id="txtLugarProcedencia" value="<?php echo $lugarProcedencia; ?>" size="97">
      </td>
      </tr>

      <tr>
      <td  class="celda" colspan="2">
        <strong>
        Instrucción
        </strong>
      </td>
      </tr>
      <tr>
      <td class="celda" colspan="2">
        <input name="txtInstruccionProcedencia" type="text" id="txtInstruccionProcedencia" value="<?php echo $instruccionProcedencia; ?>" style="width:735px">
      </td>
      </tr>

      <tr>
      <td colspan="2" align="right">
        <input name="cmdAceptar" type="submit" value="Aceptar">
      </td>
      </tr>
</table>
  
</form>
</body>
</html>
