<?php  $this->mod_usuario->en_session(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Aprobación de Beca</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript" src="<?php echo base_url(); ?>system/application/views/javascript/validacion.js"></script>
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

</head>

<body>
<?php echo $menu; ?>
<p align="center" class="Titulo"><br>Aprobación de Beca</p>
<form action="<?php echo base_url(); ?>/index.php/aprobacionBeca/aprobacionBecaRecord" name="frmAprobacionBeca" id="frmAprobacionBeca" method="post">
  <table width="736px" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="2" align="left" class="celdaError">
        <?php echo '<br>'.validation_errors().'<br>';?>
        <?php

          echo anchor('aprobacionBeca/aprobacionBecaControl','<img alt="Volver" src="'.base_url().'system/application/views/imagenes/volver.png" border="0">');
          ?></td>
      </tr>
  </table>

<table width="480" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
  <tr>
    <td  class="celda" colspan="3" >
      <strong>
      Procedencia      </strong>
      &nbsp;&nbsp;(Tipo Procedencia - Fecha - Lugar - Contacto)    </td>
  </tr>
  <tr>
    <td  colspan="3" >
      <input name="txtProcedencia" type="text" id="txtProcedencia"  value="<?php echo $procedencia; ?>" size="117" readonly>

      </td>
  </tr>
  <tr>
    <td  class="celda" colspan="3" >
      <strong>
      Instrucción
      </strong>
    </td>
  </tr>
   <tr>
      <td colspan="3">
      <input name="txtInstruccion" type="text" id="txtInstruccion"  value="<?php echo $instruccionProcedencia; ?>" size="117" readonly>
      </td>
    </tr>
  <tr>
    <td  class="celda">
      <strong>
      Cédula      </strong>    </td>
    </tr>
  <tr>
    <td valign="center">
      <input name="txtTipoCedulaPersona" type="text" id="txtTipoCedulaPersona"  value="<?php echo $tipoCedulaPersona; ?>" size="1" readonly>
      
      <input name="txtCedulaPersona" type="text" id="txtCedulaPersona" value="<?php echo $cedulaPersona; ?>" size="20" readonly>
      </td>
    </tr>
</table>


  <input type="hidden" name="txtId" value="<?php echo $id; ?>">
  <input type="hidden" name="txtActivo" value="<?php echo $activo; ?>">
  <input type="hidden" name="txtOpcion" value="">
<div id="divAspirante">


<table width="736px" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
    <tr>
      <td  class="celda" colspan="2">
      <strong>
      Filtros
      </strong>
      </td>
    </tr>
    <tr>
      <td colspan="2">
      <textarea name="comentarios" rows="3" cols="89" readonly style="color:#FF0000"><?php echo $filtroPersona; ?></textarea>
      
      </td>
    </tr>
    <tr>
      <td  class="celda">
      <strong>
      Apellidos
      </strong>
      </td>
      <td  class="celda">
      <strong>
      Nombres
      </strong>
      </td>
    </tr>
    <tr>
      <td>
      <input name="txtApellidoPersona" type="text" id="txtApellidoPersona" value="<?php echo $apellidoPersona; ?>" size="54" readonly>
      </td>
      <td>
      <input name="txtNombrePersona" type="text" id="txtNombrePersona" value="<?php echo $nombrePersona; ?>" size="57" readonly>
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

      </strong>
    </td>
    <td  class="celda" width="24%">
      <strong>
      Sexo
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
      <input name="txtEmailPersona" type="text" id="txtEmailPersona" value="<?php echo $emailPersona; ?>" size="47" readonly>
    </td>
    <td width="10%">
      
    </td>
    <td width="24%">
        <input name="txtSexoPersona" type="text" id="txtSexoPersona"  value="<?php echo $sexoPersona; ?>" size="1" readonly>
    </td>
    <td width="22%">
      
      <input name="txtFechaNacimientoPersona" type="text" id="txtFechaNacimientoPersona" value="<?php echo $fechaNacimientoPersona; ?>" size="15" readonly>
           
    
    </td>
  </tr>
 </table>

  <table width="716" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
    <tr>
      <td width="366"  class="celda">
      <strong>
      País de Habitación      </strong>      </td>
      <td width="350"  class="celda">
      <strong>
      Estado de Habitación      </strong>      </td>
    </tr>
    <tr>
      <td>
        <input name="txtPais" type="text" id="txtPais"  value="<?php echo $nombrePais; ?>" size="55" readonly>

      </td>

      <td>
        <input name="txtEstado" type="text" id="txtEstado"  value="<?php echo $nombreEstado; ?>" size="55" readonly>
      </td>
      </tr>
      <tr>
      <td  class="celda">
      <strong>
      Municipio de Habitación      </strong>      </td>
      <td  class="celda">
      <strong>
      Parroquia de Habitación      </strong>      </td>
      </tr>
      <tr>
        <td>
          <input name="txtMunicipio" type="text" id="txtMunicipio"  value="<?php echo $nombreMunicipio; ?>" size="55" readonly>
        </td>
        <td>
          <input name="txtParroquia" type="text" id="txtParroquia"  value="<?php echo $nombreParroquia; ?>" size="55" readonly>
        </td>
      </tr>

      <tr>
      <td  class="celda" colspan="2">
      <strong>
      Dirección de Habitación      </strong>      </td>
      </tr>
      <tr>
      <td colspan="2">
        <input name="txtDireccion01Persona" type="text" id="txtDireccion01Persona" value="<?php echo $direccion01Persona; ?>" size="117" readonly>      </td>
      </tr>
      <tr>
      <td  class="celda" colspan="2">
      <strong>
      Dirección Alternativa      </strong>      </td>
      </tr>
      <tr>
      <td colspan="2">
        <input name="txtDireccion02Persona" type="text" id="txtDireccion02Persona" value="<?php echo $direccion02Persona; ?>" size="117" readonly>      </td>
      </tr>

      <tr>
      <td  class="celda">
      <strong>
      Teléfono Habitación      </strong>      </td>
      <td  class="celda">
      <strong>
      Teléfono Celular      </strong>      </td>
      </tr>
      <tr>
      <td valign="center">
        <input name="txtTelefono01Persona" type="text" id="txtTelefono01Persona" value="<?php echo $telefono01Persona; ?>" size="54" readonly>      </td>
      <td>
        <input name="txtTelefono02Persona" type="text" id="txtTelefono02Persona" value="<?php echo $telefono02Persona; ?>" size="56" readonly>      </td>
      </tr>
      <tr>
      <td  class="celda">
      <strong>
      Teléfono Alternativo      </strong>      </td>
      <td  class="celda">
      <strong>
      Teléfono Alternativo      </strong>      </td>
      </tr>
      <tr>
      <td valign="center">
        <input name="txtTelefono03Persona" type="text" id="txtTelefono03Persona" value="<?php echo $telefono03Persona; ?>" size="54" readonly>      </td>
      <td>
        <input name="txtTelefono04Persona" type="text" id="txtTelefono04Persona" value="<?php echo $telefono04Persona; ?>" size="56" readonly>      </td>
      </tr>
  </table>

  <table width="736px" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
    <tr>
      <td  class="celda" width="25%">
      <strong>
      Año de Grado de Bachiller
      </strong>
      </td>
      <td  class="celda" width="25%">
      <strong>
      Promedio de Notas (5to. Año)
      </strong>
      </td>
      <td  class="celda" width="25%">
      <strong>
      # Miembros Núcleo Familiar
      </strong>
      </td>
      <td  class="celda" width="25%">
      <strong>
      Mayores de 18 años
      </strong>
      </td>
    </tr>
    <tr>
      <td>
        <input name="txtAnoGrado" type="text" id="txtAnoGrado" value="<?php echo $anoGrado; ?>" size="24" readonly>
      </td>
      <td>
        <input name="txtPromedioNota" type="text" id="txtPromedioNota" value="<?php echo $promedioNota; ?>" size="24" readonly>
      </td>
      <td>
      <input name="txtNroMbroNucleoFamiliar" type="text" id="txtNroMbroNucleoFamiliar" value="<?php echo $nroMbroNucleoFamiliar; ?>" size="24" readonly>
      </td>
      <td>
      <input name="txtNroMbroMayorEdad" type="text" id="txtNroMbroMayorEdad" value="<?php echo $nroMbroMayorEdad; ?>" size="25" readonly>
      </td>
    </tr>
  </table>  

</div>

  <table width="736px" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
    <tr>
      <td  class="celda">
      <strong>
      Beca Solicitada
      </strong>
      </td>
      <td  class="celda">
      <strong>
      Carrera Solicitada (Si Aplica)
      </strong>
      </td>
    </tr>
    <tr>
      <td valign="center" >
        <input name="txtBeca" type="text" id="txtBeca"  value="<?php echo $nombreBeca; ?>" size="55" readonly>
         
      </td>
      <td valign="center">
        <input name="txtCarrera" type="text" id="txtCarrera"  value="<?php echo $carrera; ?>" size="55" readonly>
        
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
      <input name="txtTipoCedulaMadre" type="text" id="txtTipoCedulaMadre"  value="<?php echo $tipoCedulaMadre; ?>" size="1" readonly>
      </td>
      <td width="21%">
        <input name="txtCedulaMadre" type="text" id="txtCedulaMadre" value="<?php echo $cedulaMadre; ?>" size="15" readonly>
      </td>
      
      <td width="37%">
      <div id="divNombreMadre">
        <input name="txtNombreMadre" type="text" id="txtNombreMadre" value="<?php echo $nombreMadre; ?>" size="38" readonly>
      </div>
      </td>
      <td width="37%">
      <div id="divApellidoMadre">
        <input name="txtApellidoMadre" type="text" id="txtApellidoMadre" value="<?php echo $apellidoMadre; ?>" size="42" readonly>
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
      <input name="txtTipoCedulaPadre" type="text" id="txtTipoCedulaPadre"  value="<?php echo $tipoCedulaPadre; ?>" size="1" readonly>
      </td>
      <td width="21%">
        <input name="txtCedulaPadre" type="text" id="txtCedulaPadre" value="<?php echo $cedulaPadre; ?>" size="15" readonly>
      </td>
      <td width="37%">
      <div id="divNombrePadre">
        <input name="txtNombrePadre" type="text" id="txtNombrePadre" value="<?php echo $nombrePadre; ?>" size="38" readonly>
      </div>
      </td>
      <td width="37%">
      <div id="divApellidoPadre">
        <input name="txtApellidoPadre" type="text" id="txtApellidoPadre" value="<?php echo $apellidoPadre; ?>" size="42" readonly>
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
      <input name="txtTipoCedulaRepresentante" type="text" id="txtTipoCedulaRepresentante"  value="<?php echo $tipoCedulaRepresentante; ?>" size="1" readonly>
      </td>
      <td width="21%">
        <input name="txtCedulaRepresentante" type="text" id="txtCedulaRepresentante" value="<?php echo $cedulaRepresentante; ?>" size="15" readonly>
      </td>
      <td width="37%">
      <div id="divNombreRepresentante">
        <input name="txtNombreRepresentante" type="text" id="txtNombreRepresentante" value="<?php echo $nombreRepresentante; ?>" size="38" readonly>
        <input name="txtRepresentanteId" type="hidden" id="txtRepresentanteId" value="<?php echo $representanteId; ?>">
      </div>
      </td>
      <td width="37%">
      <div id="divApellidoRepresentante">
        <input name="txtApellidoRepresentante" type="text" id="txtApellidoRepresentante" value="<?php echo $apellidoRepresentante; ?>" size="42" readonly>
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
        <input name="txtBanco" type="text" id="txtBanco" value="<?php echo $nombreBanco; ?>" size="30" readonly>
      </td>
      <td>
        <input name="txtTipoCuentaPersona" type="text" id="txtTipoCuentaPersona" value="<?php echo $nombreBanco; ?>" size="25" readonly>
      </td>
      <td>
        <input name="txtNumeroCuentaPersona" type="text" id="txtNumeroCuentaPersona" value="<?php echo $numeroCuentaPersona; ?>" size="50" readonly>
      </td>
    </tr>
  </table>
  <table width="736px" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td width="19%" class="celda">Fecha de Aprobación      </td>
      <td width="57%" bgcolor="#CCFFFF" ><span class="celda">
        <input name="txtFechaAprobacion" type="text" id="txtFechaAprobacion" value="<?php echo $fechaSolucion; ?>" size="15">
      </span><img name="dFecCalendario" id="dFecCalendario" src="<?php echo base_url(); ?>system/application/views/imagenes/calendario.png" width="16" height="16" />
        <!-- Inicio de: Iniciar DataPick. -->
      <script type="text/javascript">
          var campoId  = 'txtFechaAprobacion';
        	var imagenId = 'dFecCalendario';
          iniciarCalendario(campoId, imagenId,'%d/%m/%Y',false);
        </script>      </td>
      <td width="24%"  align="right" bgcolor="#CCFFFF">
        <input name="cmdAceptar" type="submit" value="Aprobar Beca">      </td>
    </tr>
  </table>

</form>
</body>
</html>
