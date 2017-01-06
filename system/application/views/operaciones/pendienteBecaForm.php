<?php  $this->mod_usuario->en_session(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Asignación de Beca</title>
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
<p align="center" class="Titulo"><br>Asignación de Beca</p>

<?php echo form_open('pendienteBeca/pendienteBecaRecord'); ?>


  <input type="hidden" name="txtProcedenciaPersonaId" value="<?php echo $procedenciaPersonaId; ?>">
  <input type="hidden" name="txtProcedenciaId" value="<?php echo $procedenciaId; ?>">
  <input type="hidden" name="txtSorteoId" value="<?php echo $sorteoId; ?>">
  <input type="hidden" name="txtActivo" value="<?php echo $activo; ?>">

 
 
  <table width="730" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="655" colspan="2" align="left" class="celdaError">
        <?php echo '<br>'.validation_errors().'<br>';?>
        <?php

          echo anchor('pendienteBeca/pendienteBecaControl','<img alt="Volver" src="'.base_url().'system/application/views/imagenes/volver.png" border="0">');
          ?></td>
      </tr>
  </table>

<table width="730" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
  <tr>
      <td  class="celdaTituloTabla" align="center" colspan="10">
      INFORMACIÓN DEL ASPIRANTE</td>
  </tr>
  <tr>
      <td  class="celda" colspan="3">
      <strong>
      Filtros
      </strong>
      </td>
    </tr>
    <tr>
      <td colspan="3">
      <textarea name="comentarios" rows="3" cols="88" readonly style="color:#FF0000"><?php echo $filtroPersona; ?></textarea>
      
      </td>
    </tr>
  <tr>
    <td  class="celda" colspan="10">
      Procedencia
      &nbsp;&nbsp;(Tipo Procedencia - Fecha - Municipio - Lugar - Contacto)    </td>
  </tr>
  <tr>
    <td  colspan="10" ><input name="txtProcedencia" type="text" id="txtProcedencia" value="<?php echo $procedencia; ?>" size="115" readonly></td>
  </tr>
  <tr>
    <td  class="celda" colspan="10">
      Sorteo
      &nbsp;&nbsp;(Fecha - Municipio - Lugar)    </td>
  </tr>
  <tr>
    <td  colspan="10" ><input name="txtSorteo" type="text" id="txtSorteo" value="<?php echo $sorteo; ?>" size="115" readonly></td>
  </tr>

  <tr>
    <td  class="celda">
      Cédula</td>
    <td  class="celda">
      Apellidos</td>
    <td  class="celda">
      Nombres</td>
  </tr>
  <tr>
    <td width="2%">
    <input name="txtCedulaPersona" type="text" id="txtCedulaPersona" value="<?php echo $cedulaPersona; ?>" size="17" readonly>    </td>
    <td width="5%">
    <input name="txtApellidoPersona" type="text" id="txtApellidoPersona" value="<?php echo $apellidoPersona; ?>" size="43" readonly>    </td>
    <td width="5%">
    <input name="txtNombrePersona" type="text" id="txtNombrePersona" value="<?php echo $nombrePersona; ?>" size="44" readonly>    </td>
  </tr>
</table>

   <table width="730" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
    <tr>
      <td  class="celda">Año de Grado de Bachiller</td>
      <td  class="celda">Promedio de Notas (5to. Año)</td>
      <td  class="celda"># Miembros Núcleo Familiar </td>
      <td  class="celda">Mayores de 18 años </td>
    </tr>
    <tr>
      <td width="21%"><input name="txtAnoGrado" type="text" id="txtAnoGrado" value="<?php echo $anoGrado; ?>" size="24" readonly></td>
      <td width="21%"><input name="txtPromedioNota" type="text" id="txtPromedioNota" value="<?php echo $promedioNota; ?>" size="24" readonly></td>
      <td width="21%"><input name="txtNroMbroNucleoFamiliar" type="text" id="txtNroMbroNucleoFamiliar" value="<?php echo $nroMbroNucleoFamiliar; ?>" size="24" readonly></td>
      <td width="21%"><input name="txtNroMbroMayorEdad" type="text" id="txtNroMbroMayorEdad" value="<?php echo $nroMbroMayorEdad; ?>" size="24" readonly></td>
    </tr>
    
    <tr>
      <td colspan="2" class="celda">
        Beca Solicitada</td>
      <td colspan="2" class="celda">
        Carrera Solicitada
        (Si Aplica)      </td>
    </tr>
    <tr>
      <td valign="center" colspan="2">
        <input name="txtBeca" type="text" id="txtBeca" value="<?php echo $nombreBeca; ?>" size="55" readonly></td>
      <td valign="center" colspan="2"><input name="txtCarrera" type="text" id="txtCarrera" value="<?php echo $carrera; ?>" size="55" readonly></td>
    </tr>
</table>


  <table width="730" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
    <tr>
      <td  class="celdaTituloTabla" align="center" colspan="10">INFORMACIÓN DE LA BECA A ASIGNAR
    </tr>
    <tr>
      <td class="celda" width="24%">
      Fecha de Ingreso</td>
      <td  class="celda" width="28%">
      Periodo</td>
      <td  class="celda" width="48%">
      Beca a Asignar</td>
    </tr>
    <tr>
      <td>
        <input name="txtFechaIngreso" type="text" id="txtFechaIngreso" value="<?php if(isset($fechaIngreso)) echo $fechaIngreso; ?>" size="14">
        <img name="dFecCalendario" id="dFecCalendario" src="<?php echo base_url(); ?>system/application/views/imagenes/calendario.png" width="16" height="16" />
    <!-- Inicio de: Iniciar DataPick. -->
    <script type="text/javascript">
	var campoId = 'txtFechaIngreso';
	var imagenId = 'dFecCalendario';


	iniciarCalendario(campoId, imagenId,'%d-%m-%Y',false);
	</script>      </td>
      <td>
      <select name="cmbPeriodo" id="cmbPeriodo" style="width:205px">
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
                  <?php echo($row->ano_periodo.' - '.$row->parcial_periodo); ?>                  </option>
              <?php
                }
              }
          }
          ?>
        </select>      </td>
      <td>
      <select name="cmbBeca" id="cmbBeca" style="width:350px">
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
                  <?php echo($row->nombre_tipo_beca.' - '.$row->nombre_beca); ?>                  </option>
              <?php
                }
              }
          }
          ?>
        </select></td>
    </tr>
    <tr>
      <td  class="celda" width="24%">
      Institución a Asignar</td>
       <td  class="celda" width="28%">
      Núcleo a Asignar</td>
      <td  class="celda">
      Carrera a Asignar</td>
    </tr>
    <tr>
      <td>
        <select name="cmbInstituto" id="cmbInstituto" style="width:150px" onChange="xajax_buildSelectCarreras(this.value)">
          <option value="-1"></option>
          <?php
          if($institutos->num_rows()!=0)
          {
            foreach($institutos->result() as $row)
            {
          ?>
              <option value="<?php echo($row->instituto_id);?>" <?php if($row->instituto_id==$institutoId) echo ' selected'; ?> >
              <?php echo($row->siglas_instituto); ?>              </option>
          <?php
            }
          }
          ?>
        </select>      </td>

      <td colspan="2">
      <div id="divCmbEspecial">
        <select name="cmbNucleo" id="cmbNucleo" style="width:205px">
          <option value="-1"></option>
        </select>
        <select name="cmbCarrera" id="cmbCarrera" style="width:346px">
          <option value="-1"></option>
        </select>
      </div>      </td>
    </tr>
</table>
   
  
  <table width="730" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td colspan="2" align="right">
        <input name="cmdAceptar" type="submit" value="Aceptar">      </td>
    </tr>
</table>
   <script>setFocus("cmbBeca");</script>
   <blockquote>
     <p>
       </form>
     </p>
   </blockquote>
</body>
</html>
