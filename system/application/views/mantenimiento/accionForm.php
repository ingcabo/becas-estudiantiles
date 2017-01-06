<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Registro de Acción</title>
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
</head>

<body>
<?php echo $menu; ?>
<br>
<p align="center" class="Titulo">Registro Acción</p>

<?php echo form_open('accion/accionRecord'); ?>


  <input type="hidden" name="txtId" value="<?php echo $id; ?>">
  <input type="hidden" name="txtActivo" value="<?php echo $activo; ?>">
  <table width="630" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
      <tr>
        <td colspan="4" align="left" class="celdaError">        </td>
      </tr>
      <tr>
        <td colspan="4" align="left" bgcolor="#FFFFFF">
          <?php
          echo anchor('accion/accionControl','<img alt="Volver" src="'.base_url().'system/application/views/imagenes/volver.png" border="0">');
          ?>        </td>
      </tr>
      <tr>
      <td width="320"  class="celda"><strong>
      Estado de Persona: <span class="fontnormal"><font color="#FF0000">  <?php echo form_error('cmb_estado_persona'); ?> </font></span>   </strong>  </td>
      <td width="310"  class="celda"><strong>
      Beca: <span class="fontnormal"><font color="#FF0000">  <?php echo form_error('cmbbeca'); ?> </font></span>   </strong> </td>
      </tr>
      <tr>
      <td>
      <select name="cmb_estado_persona" id="cmbestado_persona" style="width:320px">
          <option value=" "></option>
          <?php
          if($estado_personas->num_rows()!= 0)
          {
            foreach($estado_personas->result() as $row)
            {
          ?>
              <option value="<?php echo($row->estado_persona_id);?>" <?php if($row->estado_persona_id==$est_personaId) echo ' selected'; ?> >
              <?php echo($row->nombre_estado_persona); ?>			  </option>
			  <?php
            }
          }
          ?>
        </select>
      </td>
      <td>
	   <select name="cmbbeca" id="cmbbeca" style="width:345px">
          <option value=" "></option>
          <?php
          if($becas->num_rows()!= 0)
          {
            foreach($becas->result() as $row)
            {
          ?>
              <option value="<?php echo($row->beca_id);?>" <?php if($row->beca_id==$becaId) echo ' selected'; ?> >
              <?php echo($row->nombre_beca); ?>			  </option>
			  <?php
            }
          }
          ?>
        </select>
        </td>
      </tr>
	   <tr>
      <td  class="celda" colspan="2"> <strong>
      Nombre de la Acción: <span class="fontnormal"><font color="#FF0000">  <?php echo form_error('txtaccion'); ?> </font></span>   </strong>   </td>
   
      </tr>
	   <tr>
      <td  colspan="2"><input name="txtaccion" type="text" id="txtaccion" value="<?php echo $nombreaccion; ?>" size="105"></td>

      </tr>
      <tr>
      <td colspan="2" align="right">
        <input name="cmdAceptar" type="submit" value="Aceptar">      </td>
      </tr>
</table>
   <script>setFocus("cmb_estado_persona");</script>
</form>
</body>
</html>