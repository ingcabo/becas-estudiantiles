<?php  $this->mod_usuario->en_session(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Registro de Beneficiario</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript" src="<?php echo base_url(); ?>system/application/views/javascript/validacion.js"></script>
<LINK REL=StyleSheet HREF="<?php echo base_url(); ?>system/application/views/estilos/lista.css" TYPE="text/css" MEDIA=screen>
<script type="text/javascript" src="<?php  echo base_url(); ?>system/application/js/general.js"></script>
<!-- Inicio de: JS y CSS para el DataPick. -->
<script type="text/javascript" src="<?php echo base_url(); ?>system/application/js/calendario/jscripts/scripts.js"></script>
<script type="text/javascript"   src="<?php echo base_url(); ?>system/application/js/calendario/jscripts/calendar/calendar.js"></script>
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
<p align="center" class="Titulo"><br>Registro de Beneficiario</p>

<?php echo form_open('beneficiario/beneficiarioRecord'); ?>


  <input type="hidden" name="txtBecaPersonaId" value="<?php echo $becaPersonaId; ?>">
  <input type="hidden" name="txtProcedenciaId" value="<?php echo $procedenciaId; ?>">
  <input type="hidden" name="txtSorteoId" value="<?php echo $sorteoId; ?>">
  <input type="hidden" name="txtPersonaId" value="<?php echo $personaId; ?>">
  <input type="hidden" name="txtActivo" value="<?php echo $activo; ?>">

 
 
  <table width="736px" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="2" align="left" class="celdaError">
        <?php echo '<br>'.validation_errors().'<br>';?>
        <?php
          echo anchor('beneficiario/beneficiarioControl','<img alt="Volver" src="'.base_url().'system/application/views/imagenes/volver.png" border="0">');
          ?></td>
      </tr>
  </table>

<table width="736px" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
  <tr>
      <td  class="celdaTituloTabla" align="center" colspan="4">
      <strong>
      INFORMACIÓN DEL BENEFICIARIO
      </strong>
      </td>
  </tr>


    <tr>
     <td colspan="2" width="20%" class="celda">
      <strong>
      Cédula
      </strong>
      </td>
      <td  class="celda" width="40%">
      <strong>
      Apellidos
      </strong>
      </td>
      <td  class="celda" width="40%">
      <strong>
      Nombres
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
        <input name="txtCedulaPersona" type="text" id="txtCedulapersona" value="<?php echo $cedulaPersona; ?>" size="11">
      </td>
      <td>
      <input name="txtApellidoPersona" type="text" id="txtApellidoPersona" value="<?php echo $apellidoPersona; ?>" size="42">
      </td>
      <td>
      <input name="txtNombrePersona" type="text" id="txtNombrePersona" value="<?php echo $nombrePersona; ?>" size="43">
      </td>
    </tr>
</table>
  <table width="736px" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
  <tr>
    <td  class="celda" width="44%">
      <strong>
      Correo Electrónico
      </strong>
    </td>
    <td  class="celda" width="10%">
      <strong>
      Sexo
      </strong>
    </td>
    <td  class="celda" width="24%">
      <strong>
      Nacionalidad
      </strong>
    </td>
    <td  class="celda" width="22%">
      <strong>
      Fecha Nac.
      </strong>
    </td>
  </tr>
  <tr>
    <td width="44%">
      <input name="txtEmailPersona" type="text" id="txtEmailPersona" value="<?php echo $emailPersona; ?>" size="47">
    </td>
    <td width="10%">
        <select name="cmbSexoPersona" id="cmbSexoPersona" style="width:70px">
          <option value="-1"></option>
          <option value="M" <?php if($sexoPersona=='M') echo ' selected'; ?>>M</option>
          <option value="F" <?php if($sexoPersona=='F') echo ' selected'; ?>>F</option>
        </select>
    </td>
    <td width="24%">
        <select name="cmbNacionalidadPersona" id="cmbNacionalidadPersona" style="width:172px">
          <option value="-1"></option>
          <?php
          if($paises->num_rows()!=0)
          {
            foreach($paises->result() as $row)
            {
          ?>
              <option value="<?php echo($row->pais_id);?>" <?php if($row->pais_id==$nacionalidadPersona) echo ' selected'; ?> >
              <?php echo($row->nacionalidad_pais); ?>
              </option>
          <?php
            }
          }
          ?>
        </select>
    </td>
    <td width="22%">
      <input name="txtFechaNacimientoPersona" type="text" id="txtFechaNacimientoPersona" value="<?php echo $fechaNacimientoPersona; ?>" size="17">
      <img name="dFecCalendario" id="dFecCalendario" src="<?php echo base_url(); ?>system/application/views/imagenes/calendario.png" width="16" height="16" />

      <!-- Inicio de: Iniciar DataPick. -->
      <script type="text/javascript">
      var campoId  = 'txtFechaNacimientoPersona';
      var imagenId = 'dFecCalendario';
      iniciarCalendario(campoId, imagenId,'%d/%m/%Y',false);
      </script>

    </td>
  </tr>
</table>

  <table width="736px" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
    <tr>
      <td  class="celda">
      <strong>
      País de Habitación
      </strong>
      </td>
      <td  class="celda">
      <strong>
      Estado de Habitación
      </strong>
      </td>
    </tr>
    <tr>
      <td>
        <select name="cmbPais" id="cmbPais" style="width:366px" onChange="xajax_buildSelectEstados(this.value)">
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
        <select name="cmbEstado" id="cmbEstado" style="width:370px">
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
      Municipio de Habitación
      </strong>
      </td>
      <td  class="celda">
      <strong>
      Parroquia de Habitación
      </strong>
      </td>
      </tr>
      <tr>
      <td>
      <div id="divCmbMunicipio">
        <select name="cmbMunicipio" id="cmbMunicipio" style="width:366px">
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
        <select name="cmbParroquia" id="cmbParroquia" style="width:370px">
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
      Dirección de Habitación
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
      Teléfono Habitación
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
        <input name="txtTelefono01Persona" type="text" id="txtTelefono01Persona" value="<?php echo $telefono01Persona; ?>" size="54">
      </td>
      <td>
        <input name="txtTelefono02Persona" type="text" id="txtTelefono02Persona" value="<?php echo $telefono02Persona; ?>" size="56">
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
        <input name="txtTelefono03Persona" type="text" id="txtTelefono03Persona" value="<?php echo $telefono03Persona; ?>" size="54">
      </td>
      <td>
        <input name="txtTelefono04Persona" type="text" id="txtTelefono04Persona" value="<?php echo $telefono04Persona; ?>" size="56">
      </td>
      </tr>
</table>

  <table width="736px" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
    <tr>
      <td  class="celda" width="20%">
      <strong>
      Año de Grado Bachiller
      </strong>
      </td>
      <td  class="celda" width="20%">
      <strong>
      Prom. (5to. Año)
      </strong>
      </td>
      <td  class="celda" width="20%">
      <strong>
      # Mbros Núcleo Familiar
      </strong>
      </td>
      <td  class="celda" width="20%">
      <strong>
      Mayores de 18 años
      </strong>
      </td>
      <td  class="celda" width="20%">
      <strong>
      Número de Hijos
      </strong>
      </td>
    </tr>
    <tr>
      <td>
        <input name="txtAnoGrado" type="text" id="txtAnoGrado" value="<?php echo $anoGrado; ?>" size="18">
      </td>
      <td>
        <input name="txtPromedioNota" type="text" id="txtPromedioNota" value="<?php echo $promedioNota; ?>" size="18">
      </td>
      <td>
      <input name="txtNroMbroNucleoFamiliar" type="text" id="txtNroMbroNucleoFamiliar" value="<?php echo $nroMbroNucleoFamiliar; ?>" size="18">
      </td>
      <td>
      <input name="txtNroMbroMayorEdad" type="text" id="txtNroMbroMayorEdad" value="<?php echo $nroMbroMayorEdad; ?>" size="18">
      </td>
      <td>
      <input name="txtNroHijo" type="text" id="txtNroHijo" value="<?php echo $nroHijo; ?>" size="19">
      </td>
    </tr>

</table>


  <table width="736px" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
    <tr>
      <td  class="celda" colspan="2" width="26%">
      <strong>
      Cédula de la Madre
      </strong>
      </td>
      <td  class="celda" width="37%">
      <strong>
      Nombre de la Madre
      </strong>
      </td>
      <td  class="celda" width="37%">
      <strong>
      Apellido de la Madre
      </strong>
      </td>
    </tr>
    <tr>
      <td valign="center" width="5%">
      <select name="cmbTipoCedulaMadre" id="cmbTipoCedulaMadre" style="width:45px">
          <option value="-1"></option>
          <option value="V" <?php if($tipoCedulaMadre=='V') echo ' selected'; ?>>V-</option>
          <option value="E" <?php if($tipoCedulaMadre=='E') echo ' selected'; ?>>E-</option>
      </select>
      </td>
      <td width="23%">
        <input name="txtCedulaMadre" type="text" id="txtCedulaMadre" value="<?php echo $cedulaMadre; ?>" size="10">
        <img name="buscarMadre" id="buscarMadre" alt="Introduza la Cédula y Presiones este Botón para verificar si la persona ya existe" src="<?php echo base_url(); ?>system/application/views/imagenes/buscar.png" onClick="xajax_buscarPersonaMadre(txtCedulaMadre.value)"  />      </td>

      <td width="37%">
      <div id="divNombreMadre">
        <input name="txtNombreMadre" type="text" id="txtNombreMadre" value="<?php echo $nombreMadre; ?>" size="38">
      </div>
      </td>
      <td width="37%">
      <div id="divApellidoMadre">
        <input name="txtApellidoMadre" type="text" id="txtApellidoMadre" value="<?php echo $apellidoMadre; ?>" size="38">
      </div>
      </td>
    </tr>
    <tr>
      <td  class="celda" colspan="2" width="26%">
      <strong>
      Cédula del Padre
      </strong>
      </td>
      <td  class="celda" width="37%">
      <strong>
      Nombre del Padre
      </strong>
      </td>
      <td  class="celda" width="37%">
      <strong>
      Apellido del Padre
      </strong>
      </td>
    </tr>
    <tr>
      <td valign="center" width="5%">
      <select name="cmbTipoCedulaPadre" id="cmbTipoCedulaPadre" style="width:45px">
          <option value="-1"></option>
          <option value="V" <?php if($tipoCedulaPadre=='V') echo ' selected'; ?>>V-</option>
          <option value="E" <?php if($tipoCedulaPadre=='E') echo ' selected'; ?>>E-</option>
      </select>
      </td>
      <td width="23%">
        <input name="txtCedulaPadre" type="text" id="txtCedulaPadre" value="<?php echo $cedulaPadre; ?>" size="10">
        <img name="buscarPadre" id="buscarPadre" alt="Introduza la Cédula y Presiones este Botón para verificar si la persona ya existe" src="<?php echo base_url(); ?>system/application/views/imagenes/buscar.png" onClick="xajax_buscarPersonaPadre(txtCedulaPadre.value)"  />      </td>
      <td width="37%">
      <div id="divNombrePadre">
        <input name="txtNombrePadre" type="text" id="txtNombrePadre" value="<?php echo $nombrePadre; ?>" size="38">
      </div>
      </td>
      <td width="37%">
      <div id="divApellidoPadre">
        <input name="txtApellidoPadre" type="text" id="txtApellidoPadre" value="<?php echo $apellidoPadre; ?>" size="38">
      </div>
      </td>
    </tr>
    <tr>
      <td  class="celda" colspan="2" width="26%">
      <strong>
      Cédula Representante
      </strong>
      </td>
      <td  class="celda" width="37%">
      <strong>
      Nombre Representante
      </strong>
      </td>
      <td  class="celda" width="37%">
      <strong>
      Apellido Representante
      </strong>
      </td>
    </tr>
    <tr>
      <td valign="center" width="5%">
      <select name="cmbTipoCedulaRepresentante" id="cmbTipoCedulaRepresentante" style="width:45px">
          <option value="-1"></option>
          <option value="V" <?php if($tipoCedulaRepresentante=='V') echo ' selected'; ?>>V-</option>
          <option value="E" <?php if($tipoCedulaRepresentante=='E') echo ' selected'; ?>>E-</option>
      </select>
      </td>
      <td width="23%">
        <input name="txtCedulaRepresentante" type="text" id="txtCedulaRepresentante" value="<?php echo $cedulaRepresentante; ?>" size="10">
        <img name="buscarRepresentante" id="buscarRepresentante" alt="Introduza la Cédula y Presiones este Botón para verificar si la persona ya existe" src="<?php echo base_url(); ?>system/application/views/imagenes/buscar.png" onClick="xajax_buscarPersonaRepresentante(txtCedulaRepresentante.value)"  />      </td>
      <td width="37%">
      <div id="divNombreRepresentante">
        <input name="txtNombreRepresentante" type="text" id="txtNombreRepresentante" value="<?php echo $nombreRepresentante; ?>" size="38">
        <input name="txtRepresentanteId" type="hidden" id="txtRepresentanteId" value="<?php echo $representanteId; ?>">
      </div>
      </td>
      <td width="37%">
      <div id="divApellidoRepresentante">
        <input name="txtApellidoRepresentante" type="text" id="txtApellidoRepresentante" value="<?php echo $apellidoRepresentante; ?>" size="38">
      </div>
      </td>
    </tr>
</table>

  <table width="736px" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
    <tr>
      <td  class="celda" width="30%">
      <strong>
      Banco
      </strong>
      </td>
      <td  class="celda" width="25%">
      <strong>
      Tipo de Cuenta
      </strong>
      </td>
      <td  class="celda" width="45%">
      <strong>
      Número de Cuenta
      </strong>
      </td>
    </tr>
    <tr>
      <td>
        <select name="cmbBanco" id="cmbBanco" style="width:210px" >
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
        <select name="cmbTipoCuentaPersona" id="cmbTipoCuentaPersona" style="width:175px">
          <option value="-1"></option>
          <option value="1" <?php if($tipoCuentaPersona=='1') echo ' selected'; ?>>Ahorro</option>
          <option value="2" <?php if($tipoCuentaPersona=='2') echo ' selected'; ?>>Corriente</option>
          <option value="3" <?php if($tipoCuentaPersona=='3') echo ' selected'; ?>>F.A.L</option>
        </select>
      </td>
      <td>
        <input name="txtNumeroCuentaPersona" type="text" id="txtNumeroCuentaPersona" value="<?php echo $numeroCuentaPersona; ?>" size="50">
      </td>
    </tr>
</table>

  <table width="736px" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
    <tr>
      <td  class="celdaTituloTabla" colspan="5" align="center">
      <strong>
      INFORMACIÓN DE LA BECA ASIGNADA
      </strong>
      </td>
    </tr>
    <tr>
      <td class="celda" width="40%">
      <strong>
      Estado del Beneficiario
      </strong>
      </td>
      <td class="celda" width="15%">
      <strong>
      Contactado
      </strong>
      </td>
      <td  class="celda" width="15%">
      <strong>
      Retiró Carta
      </strong>
      </td>
      <td class="celda" width="15%">
      <strong>
      Inscrito
      </strong>
      </td>
      <td class="celda" width="15%">
      <strong>
      Continuidad
      </strong>
      </td>
    </tr>
    <tr>
      <td>
        <input name="txtEstadoPersona" type="text" id="txtEstadoPersona" value="<?php echo $nombreEstadoPersona; ?>" size="42" readonly>
      </td>
      <td>
        <select name="cmbContactado" id="cmbContactado" style="width:105px">
          <option value="-1"></option>
          <option value="1" <?php if($contactadoBeca=='1') echo ' selected'; ?>>SI</option>
          <option value="0" <?php if($contactadoBeca=='0') echo ' selected'; ?>>NO</option>
        </select>
      </td>
      <td>
        <select name="cmbRetiroCarta" id="cmbRetiroCarta" style="width:105px">
          <option value="-1"></option>
          <option value="1" <?php if($retiroCartaBeca=='1') echo ' selected'; ?>>SI</option>
          <option value="0" <?php if($retiroCartaBeca=='0') echo ' selected'; ?>>NO</option>
        </select>
      </td>
      <td>
        <select name="cmbInscrito" id="cmbInscrito" style="width:105px">
          <option value="-1"></option>
          <option value="1" <?php if($inscritoBeca=='1') echo ' selected'; ?>>SI</option>
          <option value="0" <?php if($inscritoBeca=='0') echo ' selected'; ?>>NO</option>
        </select>
      </td>
      <td>
        <select name="cmbContinuidad" id="cmbContinuidad" style="width:110px">
          <option value="-1"></option>
          <option value="1" <?php if($continuidadBeca=='1') echo ' selected'; ?>>SI</option>
          <option value="0" <?php if($continuidadBeca=='0') echo ' selected'; ?>>NO</option>
        </select>
      </td>
    </tr>
</table>

  <table width="736px" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
    <tr>
      <td  class="celda" >
      <strong>
      Procedencia
      </strong>
      &nbsp;&nbsp;(Tipo Procedencia - Fecha - Municipio - Lugar - Contacto)
      </td>
    </tr>
    <tr>
      <td>
        <input name="txtProcedencia" type="text" id="txtProcedencia"  value="<?php echo $procedencia; ?>" size="117" readonly>
      </td>
    </tr>
    <tr>
      <td  class="celda">
      <strong>
      Sorteo
      </strong>
      &nbsp;&nbsp;(Fecha - Municipio - Lugar)
      </td>
    </tr>
    <tr>
      <td>
        <input name="txtSorteo" type="text" id="txtSorteo" value="<?php echo $sorteo; ?>" size="117" readonly>
      </td>
    </tr>
</table>


 <table width="736px" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
    <tr>
      <td class="celda" width="20%">
      <strong>
      Fecha de Ingreso
      </strong>
      </td>
      <td  class="celda" colspan="2" width="80%">
      <strong>
      Beca Asignada
      </strong>
      </td>
    </tr>
    <tr>
      <td>
        <input name="txtFechaIngreso" type="text" id="txtFechaIngreso" value="<?php if(isset($fechaIngreso)) echo $fechaIngreso; ?>" size="20" readonly>
      </td>
      <td colspan="2">
      <input name="txtNombreBeca" type="text" id="txtNombreBeca" value="<?php if(isset($nombreBeca)) echo $nombreBeca; ?>" size="89" readonly>
      </td>
    </tr>
    <tr>
      <td  class="celda" width="20%">
      <strong>
      Institución Asignada
      </strong>
      </td>
       <td  class="celda" width="30%">
      <strong>
      Núcleo Asignado
      </strong>
      </td>
      <td  class="celda" width="40%">
      <strong>
      Carrera Asignada
      </strong>
      </td>
    </tr>
    <tr>
      <td>
        <input name="txtNombreInstituto" type="text" id="txtNombreInstituto" value="<?php if(isset($nombreInstituto)) echo $nombreInstituto; ?>" size="20" readonly>
      </td>

      <td colspan="2">

        <input name="txtNombreNucleo" type="text" id="txtNombreNucleo" value="<?php if(isset($nombreNucleoInstituto)) echo $nombreNucleoInstituto; ?>" size="33" readonly>
        &nbsp;
        <input name="txtNombreCarrera" type="text" id="txtNombreCarrera" value="<?php if(isset($nombreCarrera)) echo $nombreCarrera; ?>" size="48" readonly>

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
   <!--script>setFocus("cmbBeca");</script-->
 </form>
</body>
</html>
