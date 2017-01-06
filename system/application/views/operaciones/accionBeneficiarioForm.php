<?php  $this->mod_usuario->en_session(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Acciones a Beneficiario</title>
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
<script language="JavaScript" type="text/JavaScript">
<!--
function verificarFormulario()
{

    if (document.frmAaccionBeneficiario.cmbAccion.value== '-1')
    {
      alert("Debe Especificar una Acción para el Beneficiario");
      return;
    }
    else if(document.frmAaccionBeneficiario.txtFechaAccion.value== '')
    {
      alert("Debe Especificar una Fecha para la Acción");
      return;
    }
    else if(document.frmAaccionBeneficiario.cmbPeriodoAccion.value== '-1')
    {
      alert("Debe Especificar una Periodo para la Acción");
      return;
    }
    
    else if(document.frmAaccionBeneficiario.txtRazonAccion.value== '')
    {
      alert("Debe Especificar una Justificación para la Acción");
      return;
    }
    
    document.frmAaccionBeneficiario.submit();
}


//-->
</script>
<?php echo $js; ?>
</head>

<body>
<?php echo $menu; ?>
<p align="center" class="Titulo"><br>
Registro de Acciones a Beneficiario

<form action="<?php echo base_url(); ?>/index.php/accionBeneficiario/accionBeneficiarioRecord" name="frmAaccionBeneficiario" id="frmAccionBeneficiario" method="post">

  <input type="hidden" name="txtBecaPersonaId" value="<?php echo $becaPersonaId; ?>">
  <input type="hidden" name="txtBecaJelId" value="<?php echo $becaJelId; ?>">
  <input type="hidden" name="txtEstadoId" value="<?php echo $estadoId; ?>">
  <input type="hidden" name="txtPersonaId" value="<?php echo $personaId; ?>">
  <input type="hidden" name="txtInstitutoId" value="<?php echo $institutoId; ?>">
  <input type="hidden" name="txtNucleoId" value="<?php echo $nucleoId; ?>">
  <input type="hidden" name="txtCarreraId" value="<?php echo $carreraId; ?>">
  <input type="hidden" name="txtActivo" value="<?php echo $activo; ?>">
</p>
<table width="736px" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="2" align="left" class="celdaError">
        <?php echo '<br>'.validation_errors().'<br>';?>
        <?php
          echo anchor('accionBeneficiario/accionBeneficiarioControl','<img alt="Volver" src="'.base_url().'system/application/views/imagenes/volver.png" border="0">');
          ?>
        <?php  $atts = array(
              'width'      => '980',
              'height'     => '600',
              'scrollbars' => 'yes',
              'status'     => 'yes',
              'resizable'  => 'yes',
              'screenx'    => '0',
              'screeny'    => '0'
            );

        echo anchor_popup('accionBeneficiario/accionBeneficiarioHistory/'.$becaPersonaId,'<img alt="Ver Histórico de Acciones" src="'.base_url().'system/application/views/imagenes/ver_historico.png" border="0">', $atts ); ?></td>
      </tr>
</table>

<table width="736px" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
  <tr>
    <td  class="celdaTituloTabla" align="center" colspan="5">
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
      <td  class="celda" width="31%">
        <strong>
        Apellidos
        </strong>
      </td>
      <td  class="celda" width="31%">
        <strong>
        Nombres
        </strong>
      </td>
      <td  class="celda" width="7%">
        <strong>
        Sexo
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
        <input name="txtCedulaPersona" type="text" id="txtCedulapersona" value="<?php echo $cedulaPersona; ?>" size="13" readonly>
      </td>
      <td>
        <input name="txtApellidoPersona" type="text" id="txtApellidoPersona" value="<?php echo $apellidoPersona; ?>" size="35" readonly>
      </td>
      <td>
        <input name="txtNombrePersona" type="text" id="txtNombrePersona" value="<?php echo $nombrePersona; ?>" size="35" readonly>
      </td>
      <td>
        <select name="cmbSexoPersona" id="cmbSexoPersona" style="width:55px">
          <option value="-1"></option>
          <option value="M" <?php if($sexoPersona=='M') echo ' selected'; ?>>M</option>
          <option value="F" <?php if($sexoPersona=='F') echo ' selected'; ?>>F</option>
        </select>
      </td>
    </tr>
</table>

  <table width="736px" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
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
</table>

  <table width="736px" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
    <tr>
      <td  class="celda" colspan="3">
      <strong>
      Dirección de Habitación
      </strong>
      </td>
    </tr>
    <tr>
      <td colspan="3">
        <input name="txtDireccion01Persona" type="text" id="txtDireccion01Persona" value="<?php echo $direccion01Persona; ?>" size="117" readonly>
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
      <td  class="celda" >
      <strong>
      Correo Electrónico
      </strong>
      </td>
    </tr>
    <tr>
      <td valign="center">
        <input name="txtTelefono01Persona" type="text" id="txtTelefono01Persona" value="<?php echo $telefono01Persona; ?>" size="34" readonly>
      </td>
      <td>
        <input name="txtTelefono02Persona" type="text" id="txtTelefono02Persona" value="<?php echo $telefono02Persona; ?>" size="34" readonly>
      </td>
      <td>
        &nbsp;<input name="txtEmailPersona" type="text" id="txtEmailPersona" value="<?php echo $emailPersona; ?>" size="36" readonly>
      </td>
    </tr>
</table>

    

  <table width="736px" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
    <tr>
      <td  class="celdaTituloTabla" align="center">
      <strong>
      INFORMACIÓN DE LA BECA ASIGNADA
      </strong>
      </td>
    </tr>
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
      <td  class="celda" width="30%">
      <strong>
      Estado Actual
      </strong>
      </td>
      <td  class="celda" width="37%">
      <strong>
      Beca Asignada      </strong>      </td>
    </tr>
    <tr>
      <td>
        <input name="txtFechaIngreso" type="text" id="txtFechaIngreso" value="<?php if(isset($fechaIngreso)) echo $fechaIngreso; ?>" size="20" readonly>
      </td>
      <td>
      <input name="txtEstadoActual" type="text" id="txtestadoActual" value="<?php if(isset($nombreEstadoPersona)) echo $nombreEstadoPersona; ?>" size="33" readonly>
      </td>
      <td>
      <input name="txtNombreBeca" type="text" id="txtNombreBeca" value="<?php if(isset($nombreBeca)) echo $nombreBeca; ?>" size="48" readonly>
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
      <td  class="celda" width="37%">
      <strong>
      Carrera Asignada      </strong>      </td>
    </tr>
    <tr>
      <td>
        <input name="txtNombreInstituto" type="text" id="txtNombreInstituto" value="<?php if(isset($nombreInstituto)) echo $nombreInstituto; ?>" size="20" readonly>
      </td>

      <td colspan="2">

        <input name="txtNombreNucleoInstituto" type="text" id="txtNombreNucleoInstituto" value="<?php if(isset($nombreNucleoInstituto)) echo $nombreNucleoInstituto; ?>" size="33" readonly>
        &nbsp;
        <input name="txtNombreCarrera" type="text" id="txtNombreCarrera" value="<?php if(isset($nombreCarrera)) echo $nombreCarrera; ?>" size="48" readonly>

      </td>
    </tr>
</table>


  <table width="736px" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
    <tr>
      <td  class="celdaTituloTabla" colspan="4" align="center">
      <strong>
      ACCIONES SOBRE EL BENEFICIARIO
      </strong>
      </td>
    </tr>
    <tr>
      <td  class="celda" colspan="2" >
      <strong>
      Acción -> Estado que Aplica
      </strong>
      </td>
      <td  class="celda">
      <strong>
      Fecha de la Acción
      </strong>
      </td>
      <td  class="celda">
      <strong>
      Periodo de la Acción
      </strong>
      </td>
    </tr>
    <tr>
      <td colspan="2" >
        <select name="cmbAccion" id="cmbAccion" style="width:350px" onChange="xajax_buildSelectCambios(this.value,txtInstitutoId.value,txtNucleoId.value,txtCarreraId.value)">
          <option value="-1"></option>
          <?php
          if($acciones)
          {
              if($acciones->num_rows()!=0)
              {
                foreach($acciones->result() as $row)
                {
              ?>
                  <option value="<?php echo($row->accion_id);?>" <?php if($row->accion_id==$accionId) echo ' selected'; ?> >
                  <?php echo($row->nombre_accion); ?>
                  </option>
              <?php
                }
              }
          }
          ?>
        </select>
      </td>
      <td width="25%">
        <input name="txtFechaAccion" type="text" id="txtFechaAccion" value="<?php echo $fechaAccion; ?>" size="13">
        <img name="dFecCalendario" id="dFecCalendario" src="<?php echo base_url(); ?>system/application/views/imagenes/calendario.png" width="16" height="16" />
        <!-- Inicio de: Iniciar DataPick. -->
        <script type="text/javascript">
        var campoId  = 'txtFechaAccion';
        var imagenId = 'dFecCalendario';
        iniciarCalendario(campoId, imagenId,'%d/%m/%Y',false);
        </script>
      </td>
      <td width="25%">
        <div id="divCmbPeriodoAccion">
        <select name="cmbPeriodoAccion" id="cmbPeriodoAccion" style="width:145px">
          <option value="-1"></option>
          <?php
          if($periodos)
          {
              if($periodos->num_rows()!=0)
              {
                foreach($periodos->result() as $row)
                {
              ?>
                  <option value="<?php echo($row->periodo_id);?>" <?php if($row->periodo_id==$periodoId) echo ' selected'; ?> >
                  <?php echo($row->ano_periodo.$row->parcial_periodo); ?>
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
      <td width="25%" class="celda" colspan="4">
      <div id="divCabeceraInstituto">
      </div>
      </td>
    </tr>
    <tr>
      <td width="25%">
      <div id="divInstituto">
      </div>
      </td>
      <td width="25%">
      <div id="divNucleo">
      </div>
      </td>
      <td width="50%" colspan="2">
      <div id="divCarrera">
      </div>
      </td>

    </tr>

    <tr>
      <td  class="celda" colspan="4">
      <strong>
      Justificación
      </strong>
      </td>
    </tr>
    <tr>
      <td colspan="4">
        <input name="txtRazonAccion" type="text" id="txtRazonAccion" value="<?php echo $razonAccion; ?>" size="117">
      </td>
    </tr>

    <!--tr>
      <td  class="celda" colspan="3">
      <strong>
      Requisitos
      </strong>
      </td>
    </tr>
    <tr>
      <td colspan="3">
        <input name="txtSorteo" type="text" id="txtSorteo" value="<?php echo $sorteo; ?>" size="117" readonly>
      </td>
    </tr-->

</table>


  <table width="736px" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td align="left">

      
      </td>
      <td  align="right">
        <input name="cmdAceptar" type="button" value="Aceptar" onclick="verificarFormulario()">
      </td>
    </tr>
  </table>
   <!--script>setFocus("cmbBeca");</script-->
 </form>
</body>
</html>
