<?php  $this->mod_usuario->en_session(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Registro de Aspirantes</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript" src="<?php echo base_url(); ?>system/application/views/javascript/validacion.js"></script>
<LINK REL=StyleSheet HREF="<?php echo base_url(); ?>system/application/views/estilos/lista.css" TYPE="text/css" MEDIA=screen>
<script type="text/javascript" src="<?php  echo base_url(); ?>system/application/js/general.js"></script>
<!-- Inicio de: JS y CSS para el DataPick. -->
<script type="text/javascript" src="<?php echo base_url(); ?>system/application/js/calendario/jscripts/scripts.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>system/application/js/calendario/jscripts/calendar/calendar.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>system/application/js/calendario/jscripts/calendar/calendar-es.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>system/application/js/calendario/jscripts/calendar/calendar-setup.js"></script>

<script language="JavaScript" type="text/JavaScript">
<!--
function submitPagina(op)
{

  //if(document.frmAspirante.txtId.value == -1)
  //{

    if(op==2)
    {
      if (document.frmAspirante.cmbProcedencia.value== '-1')
      {
        alert("Debe Especificar una Procedencia");
        return;
      }
      else if(document.frmAspirante.cmbTipoCedulaPersona.value== '-1')
      {
        alert("Debe Especificar un Tipo de Cédula para el Alpirante");
        return;
      }
      else if(document.frmAspirante.txtNombrePersona.value== '')
      {
        alert("Debe Especificar un Nombre para el Aspirante");
        return;
      }
      else if(document.frmAspirante.txtApellidoPersona.value== '')
      {
        alert("Debe Especificar un Apellido para el Aspirante");
        return;
      }
      else if(document.frmAspirante.txtEmailPersona.value== '')
      {
        alert("Debe Especificar un e-mail para el Aspirante");
        return;
      }
      else if(document.frmAspirante.cmbSexoPersona.value== '-1')
      {
        alert("Debe Especificar el Sexo del Aspirante");
        return;
      }
      else if(document.frmAspirante.cmbNacionalidad.value== '-1')
      {
        alert("Debe Especificar la Nacionalidad del Aspirante");
        return;
      }
      else if(document.frmAspirante.txtFechaNacimientoPersona.value== '')
      {
        alert("Debe Especificar la Fecha de Nacimiento del Aspirante");
        return;
      }
      else if(document.frmAspirante.cmbPais.value== '-1')
      {
        alert("Debe Especificar el País donde Reside el Aspirante");
        return;
      }
      else if(document.frmAspirante.cmbEstado.value== '-1')
      {
        alert("Debe Especificar el Estado donde Reside el Aspirante");
        return;
      }
      else if(document.frmAspirante.cmbMunicipio.value== '-1')
      {
        alert("Debe Especificar el Municipio donde Reside el Aspirante");
        return;
      }
      else if(document.frmAspirante.cmbParroquia.value== '-1')
      {
        alert("Debe Especificar la Parroquia donde Reside el Aspirante");
        return;
      }
      else if(document.frmAspirante.txtDireccion01Persona.value== '')
      {
        alert("Debe Especificar la Dirección de Habitación del Aspirante");
        return;
      }
      else if(document.frmAspirante.txtTelefono01Persona.value== '')
      {
        alert("Debe Especificar el Teléfono de Habitación del Aspirante");
        return;
      }
      else if(document.frmAspirante.txtTelefono02Persona.value== '')
      {
        alert("Debe Especificar el Teléfono Celular del Aspirante");
        return;
      }
      else if(document.frmAspirante.txtAnoGrado.value== '')
      {
        alert("Debe Especificar el Año de Graduación de Bachiller del Aspirante");
        return;
      }
      else if(document.frmAspirante.txtPromedioNota.value== '')
      {
        alert("Debe Especificar el Promedio de Notas de Bachillerato del Aspirante");
        return;
      }
      else if(document.frmAspirante.txtNroMbroNucleoFamiliar.value== '')
      {
        alert("Debe Especificar la Cantidad de Personas en el Núcleo Familiar del Aspirante");
        return;
      }
      else if(document.frmAspirante.txtNroMbroMayorEdad.value== '')
      {
        alert("Debe Especificar la Cantidad de Personas Mayores de 18 años en el Núcleo Familiar del Aspirante");
        return;
      }
      else if(document.frmAspirante.cmbBeca.value== '-1')
      {
        alert("Debe Especificar la Beca Solicitada por el Aspirante");
        return;
      }
      
    }
    document.frmAspirante.txtOpcion.value= op;
    document.frmAspirante.submit();
  //}
}

 
//-->
</script>



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
<p align="center" class="Titulo"><br>Registro de Aspirantes</p>
<form action="<?php echo base_url(); ?>/index.php/aspirante/aspiranteSubmit" name="frmAspirante" id="frmAspirante" method="post"> 
  <table width="736px" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="2" align="left" class="celdaError">
        <?php echo '<br>'.validation_errors().'<br>';?>
        <?php

          echo anchor('aspirante/aspiranteControl','<img alt="Volver" src="'.base_url().'system/application/views/imagenes/volver.png" border="0">');
          ?></td>
      </tr>
  </table>

<table width="480" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
  <tr>
    <td  class="celda" colspan="3" width="20%">
      <strong>
      Procedencia      </strong>
      &nbsp;&nbsp;(Tipo Procedencia - Fecha - Lugar - Contacto)    </td>
  </tr>
  <tr>
    <td  colspan="3" >

      <select name="cmbProcedencia" id="cmbProcedencia" style="width:737px">
          <option value="-1"></option>
          <?php
          if($procedencias->num_rows()!=0)
          {
            foreach($procedencias->result() as $row)
            {
          ?>
              <option value="<?php echo($row->procedencia_id);?>" <?php if($row->procedencia_id==$procedenciaId) echo ' selected'; ?> >
              <?php
                $contacto = !$row->nombre_persona  ? '(NINGUNO)' : $row->nombre_persona.' '.$row->apellido_persona;
                echo($row->nombre_tipo_procedencia.' - '.$row->fecha_procedencia.' - '.$row->lugar_procedencia.' - '.$contacto);
              ?>
              </option>
          <?php
            }
          }
          ?>
        </select>    </td>
  </tr>
  <tr>
    <td  class="celda">
      <strong>
      Cédula      </strong>    </td>
    </tr>
  <tr>
    <td valign="center">
      <select name="cmbTipoCedulaPersona" id="cmbTipoCedulaPersona" style="width:45px">
          <option value="-1"></option>
          <option value="V" <?php if($tipoCedulaPersona=='V') echo ' selected'; ?>>V-</option>
          <option value="E" <?php if($tipoCedulaPersona=='E') echo ' selected'; ?>>E-</option>
      </select>    
      <input name="txtCedulaPersona" type="text" id="txtCedulaPersona" value="<?php echo $cedulaPersona; ?>" size="20" onBlur="submitPagina(1)">        </td>
    </tr>
</table>


  <input type="hidden" name="txtId" value="<?php echo $id; ?>">
  <input type="hidden" name="txtActivo" value="<?php echo $activo; ?>">
  <input type="hidden" name="txtOpcion" value="">
  <input type="hidden" name="txtTipoCedulaPersona" value="">
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
      Nombres
      </strong>
      </td>
      <td  class="celda">
      <strong>
      Apellidos
      </strong>
      </td>
    </tr>
    <tr>
      <td>
      <input name="txtNombrePersona" type="text" id="txtNombrePersona" value="<?php echo $nombrePersona; ?>" size="54">
      </td>
      <td>
      <input name="txtApellidoPersona" type="text" id="txtApellidoPersona" value="<?php echo $apellidoPersona; ?>" size="57">
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
        <select name="cmbNacionalidad" id="cmbNacionalidad" style="width:172px">
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
    <td width="22%">
      <input name="txtFechaNacimientoPersona" type="text" id="txtFechaNacimientoPersona" value="<?php echo $fechaNacimientoPersona; ?>" size="15">
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
        <select name="cmbPais" id="cmbPais" style="width:366px" onChange="xajax_buildSelectEstados(this.value)">
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
        <select name="cmbEstado" id="cmbEstado" style="width:371px" onChange="xajax_buildSelectMunicipios(this.value)">
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
      Municipio de Habitación      </strong>      </td>
      <td  class="celda">
      <strong>
      Parroquia de Habitación      </strong>      </td>
      </tr>
      <tr>
      <td>
      <div id="divCmbMunicipio">
        <select name="cmbMunicipio" id="cmbMunicipio" style="width:366px" onChange="xajax_buildSelectParroquias(this.value)">
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
        <select name="cmbParroquia" id="cmbParroquia" style="width:371px">
          <option value="-1"></option>
          <?php
          if($parroquias)
          {
              if($parroquias->num_rows()!=0)
              {
                foreach($parroquias->result() as $row)
                {
              ?>
          <option value="<?php echo($row->parroquia_id);?>" <?php if($row->parroquia_id==$parroquiaId) echo ' selected'; ?> > <?php echo($row->nombre_parroquia); ?> </option>
          <?php
                }
              }
          }
          ?>
        </select>
      </div>      </td>
      </tr>

      <tr>
      <td  class="celda" colspan="2">
      <strong>
      Dirección de Habitación      </strong>      </td>
      </tr>
      <tr>
      <td colspan="2">
        <input name="txtDireccion01Persona" type="text" id="txtDireccion01Persona" value="<?php echo $direccion01Persona; ?>" size="117">      </td>
      </tr>
      <tr>
      <td  class="celda" colspan="2">
      <strong>
      Dirección Alternativa      </strong>      </td>
      </tr>
      <tr>
      <td colspan="2">
        <input name="txtDireccion02Persona" type="text" id="txtDireccion02Persona" value="<?php echo $direccion02Persona; ?>" size="117">      </td>
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
        <input name="txtTelefono01Persona" type="text" id="txtTelefono01Persona" value="<?php echo $telefono01Persona; ?>" size="54">      </td>
      <td>
        <input name="txtTelefono02Persona" type="text" id="txtTelefono02Persona" value="<?php echo $telefono02Persona; ?>" size="56">      </td>
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
        <input name="txtTelefono03Persona" type="text" id="txtTelefono03Persona" value="<?php echo $telefono03Persona; ?>" size="54">      </td>
      <td>
        <input name="txtTelefono04Persona" type="text" id="txtTelefono04Persona" value="<?php echo $telefono04Persona; ?>" size="56">      </td>
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
        <input name="txtAnoGrado" type="text" id="txtAnoGrado" value="<?php echo $anoGrado; ?>" size="24">
      </td>
      <td>
        <input name="txtPromedioNota" type="text" id="txtPromedioNota" value="<?php echo $promedioNota; ?>" size="24">
      </td>
      <td>
      <input name="txtNroMbroNucleoFamiliar" type="text" id="txtNroMbroNucleoFamiliar" value="<?php echo $nroMbroNucleoFamiliar; ?>" size="24">
      </td>
      <td>
      <input name="txtNroMbroMayorEdad" type="text" id="txtNroMbroMayorEdad" value="<?php echo $nroMbroMayorEdad; ?>" size="25">
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
         <select name="cmbBeca" id="cmbBeca" style="width:366px">
          <option value="-1"></option>
          <?php
          if($becas)
          {
              if($becas->num_rows()!=0)
              {
                foreach($becas->result() as $row)
                {
              ?>
                  <option value="<?php echo($row->beca_id);?>" <?php if($row->beca_id==$becaId) echo ' selected'; ?> >
                  <?php echo($row->nombre_tipo_beca.' - '.$row->nombre_beca); ?>
                  </option>
              <?php
                }
              }
          }
          ?>
        </select>
      </td>
      <td valign="center">
        <select name="cmbCarrera" id="cmbCarrera" style="width:370px">
          <option value="-1"></option>
          <?php
          if($carreras->num_rows()!=0)
          {
            foreach($carreras->result() as $row)
            {
          ?>
              <option <?php if($row->nombre_carrera==$carrera) echo ' selected'; ?> >
              <?php echo($row->nombre_carrera); ?>
              </option>
          <?php
            }
          }
          ?>
        </select>
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
      <td width="21%">
        <input name="txtCedulaMadre" type="text" id="txtCedulaMadre" value="<?php echo $cedulaMadre; ?>" size="10">
        <img name="buscarMadre" id="buscarMadre" alt="Introduza la Cédula y Presiones este Botón para verificar si la persona ya existe" src="<?php echo base_url(); ?>system/application/views/imagenes/buscar.png" onClick="xajax_buscarPersonaMadre(txtCedulaMadre.value)"  /> 
      </td>
      
      <td width="37%">
      <div id="divNombreMadre">
        <input name="txtNombreMadre" type="text" id="txtNombreMadre" value="<?php echo $nombreMadre; ?>" size="38">
      </div>
      </td>
      <td width="37%">
      <div id="divApellidoMadre">
        <input name="txtApellidoMadre" type="text" id="txtApellidoMadre" value="<?php echo $apellidoMadre; ?>" size="42">
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
      <td width="21%">
        <input name="txtCedulaPadre" type="text" id="txtCedulaPadre" value="<?php echo $cedulaPadre; ?>" size="10">
        <img name="buscarPadre" id="buscarPadre" alt="Introduza la Cédula y Presiones este Botón para verificar si la persona ya existe" src="<?php echo base_url(); ?>system/application/views/imagenes/buscar.png" onClick="xajax_buscarPersonaPadre(txtCedulaPadre.value)"  />
      </td>
      <td width="37%">
      <div id="divNombrePadre">
        <input name="txtNombrePadre" type="text" id="txtNombrePadre" value="<?php echo $nombrePadre; ?>" size="38">
      </div>
      </td>
      <td width="37%">
      <div id="divApellidoPadre">
        <input name="txtApellidoPadre" type="text" id="txtApellidoPadre" value="<?php echo $apellidoPadre; ?>" size="42">
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
      <td width="21%">
        <input name="txtCedulaRepresentante" type="text" id="txtCedulaRepresentante" value="<?php echo $cedulaRepresentante; ?>" size="10">
        <img name="buscarRepresentante" id="buscarRepresentante" alt="Introduza la Cédula y Presiones este Botón para verificar si la persona ya existe" src="<?php echo base_url(); ?>system/application/views/imagenes/buscar.png" onClick="xajax_buscarPersonaRepresentante(txtCedulaRepresentante.value)"  />   
      </td>
      <td width="37%">
      <div id="divNombreRepresentante">
        <input name="txtNombreRepresentante" type="text" id="txtNombreRepresentante" value="<?php echo $nombreRepresentante; ?>" size="38">
        <input name="txtRepresentanteId" type="hidden" id="txtRepresentanteId" value="<?php echo $representanteId; ?>">
      </div>
      </td>
      <td width="37%">
      <div id="divApellidoRepresentante">
        <input name="txtApellidoRepresentante" type="text" id="txtApellidoRepresentante" value="<?php echo $apellidoRepresentante; ?>" size="42">
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
  <table width="736px" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="2" align="right">
        <input name="cmdAceptar" type="button" value="Aceptar" onClick="submitPagina(2)">
      </td>
    </tr>
  </table>

   
</form>
</body>
</html>
