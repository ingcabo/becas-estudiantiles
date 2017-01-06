<?php  $this->mod_usuario->en_session(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title><?php print_r($_POST); ?>Registro de requisitos</title>
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
<script type="text/javascript">

function valor(a){

alert(a);

}

</script>

</head>



<body>
<?php echo $menu; ?>
<br>
<p align="center" class="Titulo">Registro Presupuesto </p>

<?php echo form_open('presupuesto/presupuestoRecord'); ?>


  <input type="hidden" name="presupuesto_id" value="<?php echo $presupuesto_id; ?>">
   <input type="hidden" name="beca_persona_id" value="<?php echo $beca_persona_id; ?>">
 
 
  <table width="952" height="299" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
      <tr>
        <td colspan="4" align="left" class="celdaError">        </td>
      </tr>
      <tr>
        <td colspan="4" align="left" bgcolor="#FFFFFF">
          <?php
          echo anchor('presupuesto','<img alt="Volver" src="'.base_url().'system/application/views/imagenes/volver.png" border="0">');
          ?>        </td>
      </tr>
	  
	  <tr>
	  <td  class="celda"> Acción: <span class="fontnormal"><font color="#FF0000"> <?php echo form_error('cmbperiodo'); ?>  </font></span></td>
	  <td  class="celda">Estado Presupuesto:<span class="fontnormal"><font color="#FF0000"> <?php echo form_error('cmbestado'); ?>  </font></span> </td>
	  </tr>
	  
      <tr>
      <td width="357"  class="celda">&nbsp;
	    <select name="cmbperiodo" id="cmbperiodo" style="width:263px"  />
          <option value="">Seleccione </option>
          <?php
          if($q_periodo->num_rows()!= 0)
          {
            foreach($q_periodo->result() as $row)
            {
          ?>
              <option value="<?php echo($row->periodo_id);?>" <?php if($row->periodo_id==$periodo_id) echo ' selected'; ?> >
              <?php echo $row->ano_periodo.' '.$row->parcial_periodo; ?>			  </option>
			  <?php
            }
          }
          ?>
        </select>	  </td>
      <td width="348" >
	  
	     <select name="cmbestado" id="cmbestado" style="width:263px"  />
          <option value=" ">Seleccione</option>
          <?php
          if($q_estado->num_rows()!= 0)
          {
            foreach($q_estado->result() as $row)
            {
          ?>
              <option value="<?php echo($row->estado_presupuesto_id);?>" <?php if($row->estado_presupuesto_id==$estado_presupuesto_id) echo ' selected'; ?> >
              <?php echo $row->nombre_estado_presupuesto; ?>			  </option>
	    <?php
            }
          }
          ?></td>
      </tr>
      <tr>
      <td class="celda">Codigo Presupuesto:<font color="#FF0000"><?php echo form_error('codigo_presupuesto'); ?></font></span></td>
     
	  <td  class="celda">Fecha Presupuesto:<span class="fontnormal"><font color="#FF0000"><?php echo form_error('fecha_presupuesto'); ?></font></span >
    <tr>
      <td class="celda"><span class="fontnormal"><font color="#FF0000">
        <input name="codigo_presupuesto" type="text" id="codigo_presupuesto" value="<?php echo $codigo_presupuesto; ?>" size="56">
</font></span></td>
<td><font color="#FF0000">
  <input name="fecha_presupuesto" type="text" id="fecha_presupuesto" value="<?php echo $fecha_presupuesto; ?>" size="8">
</font>
  <img name="dFecCalendario" id="dFecCalendario" src="<?php echo base_url(); ?>system/application/views/imagenes/calendario.png" width="16" height="16" />
    <!-- Inicio de: Iniciar DataPick. -->
    <script type="text/javascript">
	var campoId = 'fecha_presupuesto';
	var imagenId = 'dFecCalendario';
		
		
	iniciarCalendario(campoId, imagenId,'%d-%m-%Y',false);
	</script></td>
    </tr>
      <tr>
      <td  class="celda">Monto Presupuesto: <span class="fontnormal"><font color="#FF0000"><?php echo form_error('monto_presupuesto'); ?></font></span ></td>
      <td></td>
	  </tr>
	  <tr>
      <td><input name="monto_presupuesto" type="text" id="monto_presupuesto" value="<?php echo $monto_presupuesto; ?>" size="56"></td>
      <td>&nbsp;</td>
    <tr>
      <td  class="celda">Observaciones:</td>
      <td></td>
    </tr>
	      <tr>
      <td></tr>
       </td>
      <td></td>
	  </tr>
	      <tr>
      <td></td>
	  </tr>
	  
	    <tr>
		
      <td></td>
	  </tr>
	  <tr>
	  <td><textarea name="observaciones" rows="5" cols="60"><?php echo $observaciones; ?></textarea></td>
	  <td align="right"></td>
	  
	  
	  </tr>
	  <tr>
	  <td></td>
	  <td align="right"><input name="cmdAceptar" type="submit" value="Aceptar"></td>
	  </tr>
</table>
   <script>setFocus("txtPais");</script>
</form>
</body>
</html>