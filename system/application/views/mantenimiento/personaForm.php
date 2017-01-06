<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php $this->mod_usuario->en_session(); ?>
<html>
<head>
<title>Registro de Personas</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript" src="<?php echo base_url(); ?>system/application/views/javascript/validacion.js"></script>
<LINK REL=StyleSheet HREF="<?php echo base_url(); ?>system/application/views/estilos/lista.css" TYPE="text/css" MEDIA=screen>

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
<?php echo $js; ?>
</head>

<body>
<?php echo $menu; ?>
<p align="center" class="Titulo"><br>Registro de Personas</p>

<?php echo form_open('persona/personaRecord'); ?>


  <input type="hidden" name="txtId" value="<?php echo $id; ?>">
  <input type="hidden" name="txtActivo" value="<?php echo $activo; ?>">

 
 
  <table width="736px" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="2" align="left" class="celdaError">
        <?php echo '<br>'.validation_errors().'<br>';?>
        <?php

          echo anchor('persona/personaControl','<img alt="Volver" src="'.base_url().'system/application/views/imagenes/volver.png" border="0">');
          ?></td>
      </tr>
  </table>

<table width="736px" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
  <tr>
    <td  class="celda" colspan="2" width="20%">
      <strong>
      Cédula
      </strong>
    </td>
    <td  class="celda" width="15%">
      <strong>
      Sexo
      </strong>
    </td>
    <td  class="celda" width="27%">
      <strong>
      Nacionalidad
      </strong>
    </td>
    <td  class="celda" width="38%">
      <strong>
      Correo Electrónico
      </strong>
    </td>
  </tr>
  <tr>
    <td valign="center" width="5%">
      <select name="cmbTipoCedulaPersona" id="cmbTipoCedulaPersona" style="width:45px">
          <option value="-1"></option>
          <option value="V" <?php if($tipoCedulaPersona=='V') echo ' selected'; ?>>V-</option>
          <option value="E" <?php if($tipoCedulaPersona=='E') echo ' selected'; ?>>E-</option>
      </select>
    </td>
    <td width="15%">
      <input name="txtCedulaPersona" type="text" id="txtCedulaPersona" value="<?php echo $cedulaPersona; ?>" size="11">
    </td>
    <td width="15%">
        <select name="cmbSexoPersona" id="cmbSexoPersona" style="width:100px">
          <option value="-1"></option>
          <option value="M" <?php if($sexoPersona=='M') echo ' selected'; ?>>Masculino</option>
          <option value="F" <?php if($sexoPersona=='F') echo ' selected'; ?>>Femenino</option>
        </select>
    </td>
    <td width="27%">
        <select name="cmbNacionalidad" id="cmbNacionalidad" style="width:190px">
          <option value="-1"></option>
          <?php
          if($paises->num_rows()!=0)
          {
            foreach($paises->result() as $row)
            {
          ?>
              <option value="<?php echo($row->pais_id);?>" <?php if($row->pais_id==$nacionalidad) echo ' selected'; ?> >
              <?php echo($row->nacionalidad_pais); ?>
              </option>
          <?php
            }
          }
          ?>
        </select>
    </td>
    <td width="38%">
      <input name="txtEmailPersona" type="text" id="txtEmailPersona" value="<?php echo $emailPersona; ?>" size="41">
    </td>
  </tr>

</table>

<table width="736px" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
      <tr>
      <td  class="celda" width="40%">
      <strong>
      Nombres
      </strong>
      </td>
      <td  class="celda" width="40%">
      <strong>
      Apellidos
      </strong>
      </td>
      <td  class="celda" width="40%">
      <strong>
      Fecha Nac.
      </strong>
      </td>
      </tr>
      <tr>
      <td valign="center">
        <input name="txtNombrePersona" type="text" id="txtNombrePersona" value="<?php echo $nombrePersona; ?>" size="43">
      </td>
      <td>
        <input name="txtApellidoPersona" type="text" id="txtApellidoPersona" value="<?php echo $apellidoPersona; ?>" size="43">
      </td>
      <td>
        <input name="txtFechaNacimientoPersona" type="text" id="txtFechaNacimientoPersona" value="<?php echo $fechaNacimientoPersona; ?>" size="13">
          <img name="dFecCalendario" id="dFecCalendario" src="<?php echo base_url(); ?>system/application/views/imagenes/calendario.png" width="16" height="16" />
    <!-- Inicio de: Iniciar DataPick. -->
   
	<script type="text/javascript">
	var campoId = "txtFechaNacimientoPersona";
	var imagenId = "dFecCalendario";
	iniciarCalendario(campoId, imagenId,"%d-%m-%Y",false);
	</script> 
      </td>
      </tr>
</table>
<table width="736px" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
      <tr>
      <td  class="celda">
      <strong>
      País de Residencia
      </strong>
      </td>
      <td  class="celda">
      <strong>
      Estado de Residencia
      </strong>
      </td>
      </tr>
      <tr>
      <td>
        <select name="cmbPais" id="cmbPais" style="width:368px" onChange="xajax_buildSelectEstados(this.value)">
          <option value="-1"></option>
          <?php
          if($paises->num_rows()!=0)
          {
            foreach($paises->result() as $row)
            {
          ?>
              <option value="<?php echo($row->pais_id);?>" <?php if($row->pais_id==$paisId) echo ' selected'; ?> >
              <?php echo($row->nombre_pais); ?>
              </option>
          <?php
            }
          }
          ?>
        </select>
      </td>

      <td>
       <div id="divCmbEstado">
        <select name="cmbEstado" id="cmbEstado" style="width:368px">
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
                  <?php echo($row->nombre_estado); ?>
                  </option>
              <?php
                }
              }
          }
          ?>
        </select>
        </div>
      </td>
      </tr>

      <tr>
      <td  class="celda">
      <strong>
      Municipio de Residencia
      </strong>
      </td>
      <td  class="celda">
      <strong>
      Parroquia de Residencia
      </strong>
      </td>
      </tr>
      <tr>
      <td>
      <div id="divCmbMunicipio">
        <select name="cmbMunicipio" id="cmbMunicipio" style="width:368px">
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
                  <?php echo($row->nombre_municipio); ?>
                  </option>
              <?php
                }
              }
          }
          ?>
        </select>
      </div>
      </td>
      <td>
      <div id="divCmbParroquia">
        <select name="cmbParroquia" id="cmbParroquia" style="width:368px">
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
                  <?php echo($row->nombre_parroquia); ?>
                  </option>
              <?php
                }
              }
          }
          ?>
        </select>
      </div>
      </td>
      </tr>

      <tr>
      <td  class="celda" colspan="2">
      <strong>
      Dirección de Residencia
      </strong>
      </td>
      </tr>
      <tr>
      <td colspan="2">
        <input name="txtDireccion01Persona" type="text" id="txtDireccion01Persona" value="<?php echo $direccion01Persona; ?>" size="117">
      </td>
      </tr>
      <tr>
      <td  class="celda" colspan="2">
      <strong>
      Dirección Alternativa
      </strong>
      </td>
      </tr>
      <tr>
      <td colspan="2">
        <input name="txtDireccion02Persona" type="text" id="txtDireccion02Persona" value="<?php echo $direccion02Persona; ?>" size="117">
      </td>
      </tr>

      <tr>
      <td  class="celda">
      <strong>
      Teléfono Residencia
      </strong>
      </td>
      <td  class="celda">
      <strong>
      Teléfono Celular
      </strong>
      </td>
      </tr>
      <tr>
      <td valign="center">
        <input name="txtTelefono01Persona" type="text" id="txtTelefono01Persona" value="<?php echo $telefono01Persona; ?>" size="55">
      </td>
      <td>
        <input name="txtTelefono02Persona" type="text" id="txtTelefono02Persona" value="<?php echo $telefono02Persona; ?>" size="55">
      </td>
      </tr>
      <tr>
      <td  class="celda">
      <strong>
      Teléfono Alternativo
      </strong>
      </td>
      <td  class="celda">
      <strong>
      Teléfono Alternativo
      </strong>
      </td>
      </tr>
      <tr>
      <td valign="center">
        <input name="txtTelefono03Persona" type="text" id="txtTelefono03Persona" value="<?php echo $telefono03Persona; ?>" size="55">
      </td>
      <td>
        <input name="txtTelefono04Persona" type="text" id="txtTelefono04Persona" value="<?php echo $telefono04Persona; ?>" size="55">
      </td>
      </tr>
</table>

  <table width="736px" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
      <tr>
      <td  class="celda" width="30%">
      <strong>
      Representante
      </strong>
      </td>
      <td  class="celda" width="25%">
      <strong>
      Banco
      </strong>
      </td>
      <td  class="celda" width="20%">
      <strong>
      Tipo de Cuenta
      </strong>
      </td>
      <td  class="celda" width="25%">
      <strong>
      Número de Cuenta
      </strong>
      </td>
      </tr>
      <tr>
      <td valign="center">
        <input name="txtRepresentantePersona" type="text" id="txtRepresentantePersona" value="<?php echo $representantePersona; ?>" size="25">
        <input name="txtRepresentanteId" type="hidden" id="txtRepresentanteId" value="<?php echo $representanteId; ?>">
        <?php
          echo anchor('procedencia/buscarContacto','<img alt="Modificar" src="'.base_url().'system/application/views/imagenes/buscar.png" border="0">');
        ?>
      </td>
      <td>
        <select name="cmbBanco" id="cmbBanco" style="width:180px" >
          <option value="-1"></option>
          <?php
          if($bancos->num_rows()!=0)
          {
            foreach($bancos->result() as $row)
            {
          ?>
              <option value="<?php echo($row->banco_id);?>" <?php if($row->banco_id==$bancoId) echo ' selected'; ?> >
              <?php echo($row->nombre_banco); ?>
              </option>
          <?php
            }
          }
          ?>
        </select>
      </td>
      <td>
        <select name="cmbTipoCuentaPersona" id="cmbTipoCuentaPersona" style="width:140px">
          <option value="-1"></option>
          <option value="1" <?php if($tipoCuentaPersona=='1') echo ' selected'; ?>>Ahorro</option>
          <option value="2" <?php if($tipoCuentaPersona=='2') echo ' selected'; ?>>Corriente</option>
          <option value="3" <?php if($tipoCuentaPersona=='3') echo ' selected'; ?>>F.A.L</option>
        </select>
      </td>
      <td>
        <input name="txtNumeroCuentaPersona" type="text" id="txtNumeroCuentaPersona" value="<?php echo $numeroCuentaPersona; ?>" size="25">
      </td>
      </tr>
</table>
  <table width="736px" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
      <td colspan="2" align="right">
        <input name="cmdAceptar" type="submit" value="Aceptar">
      </td>
      </tr>
  </table>

   <script>setFocus("cmbTipoCedulaPersona");</script>
</form>
</body>
</html>
