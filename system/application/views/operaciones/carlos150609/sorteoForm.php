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
<p align="center" class="Titulo">Registro Sorteo </p>

<?php echo form_open('sorteo/sorteoRecord'); ?>


  <input type="hidden" name="txtId" value="<?php echo $id; ?>">
  <input type="hidden" name="txtActivo" value="<?php echo $activo; ?>">
  <table width="736px" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="4" align="left" class="celdaError">
        <?php echo '<br>'.validation_errors().'<br>';?>        </td>
      </tr>
      <tr>
        <td colspan="4" align="left">
          <?php
          
          echo anchor('sorteo/sorteoControl','<img alt="Volver" src="'.base_url().'system/application/views/imagenes/volver.png" border="0">');
          ?>        </td>
      </tr>

    

      <tr>
      <td  class="celda">
      <strong>
      País      </strong>      </td>
      <td  class="celda">
      <strong>
      Estado      </strong>     </td>
      </tr>
      <tr>
      <td>
        <select name="cmbPais" id="cmbPais" style="width:367px" onChange="xajax_buildSelectEstados(this.value)" >
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

  <table width="736px" border="0" align="center" cellpadding="0" cellspacing="0">
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
        <input name="txtFechaProcedencia" type="text" id="txtFechaProcedencia" value="<?php echo $fecha; ?>" size="9">
        <img name="dFecCalendario" id="dFecCalendario" src="<?php echo base_url(); ?>system/application/views/imagenes/calendario.png" width="16" height="16" />
    <!-- Inicio de: Iniciar DataPick. -->
    <script type="text/javascript">
	var campoId = 'txtFechaProcedencia';
	var imagenId = 'dFecCalendario';
		
		
	iniciarCalendario(campoId, imagenId,'%d-%m-%Y',false);
	</script> 
      </td>
      <td>
        <input name="txtLugar" type="text" id="txtLugar" value="<?php echo $lugar; ?>" size="97">
      </td>
      </tr>

      <tr>
      <td  class="celda" colspan="2">
        <strong>
        
        </strong>
      </td>
      </tr>
      <tr>
      <td class="celda" colspan="2">
        
      </td>
      </tr>

      <tr>
      <td colspan="2" align="right">
        <input name="cmdAceptar" type="submit" value="Aceptar">
      </td>
      </tr>
  </table>
  
  <table width="743" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td width="131" class="celda">Numero de Cedula:</td>
<td width="152"><input type="text" name="ced"  size="12" maxlength="12"  value="<?php isset($ced)?$ced:'12'?>" onBlur="xajax_buscarProcedenciaPersona(ced.value)" > </td>
<td width="66">&nbsp;</td>
<td width="343">&nbsp;</td>
<td width="51">&nbsp;</td>
</tr>
<tr>
<td  class="celda"><strong>Nombre</strong></td>
<td  class="celda"> <strong>Apellido</strong></td>
<td  class="celda"><strong> Sexo  </strong></td>
<td  class="celda"> <strong>Dirección </strong></td>
<td  class="celda">&nbsp;</td>
</tr>
</table>
 

  <div id="div_persona" style="size:100; width:auto; "  align="center">Persona</div><!-- este div es llenado con la funcion de buscar a la persona para el sorteo-->
  <p>&nbsp;</p>
  <div id="div_operacion" style="size:100; width:auto; "  align="center">Operacion</div>


</body>
</html>
