<?php $this->mod_usuario->en_session(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Institutos, Materias y Carreras</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript" src="<?=base_url(); ?>system/application/js/general.js"></script>
<LINK REL=StyleSheet HREF="<?php echo base_url(); ?>system/application/views/estilos/lista.css" TYPE="text/css" MEDIA=screen>
<style type="text/css">
<!--
.celda
{
  background-image: url(<?php echo base_url(); ?>system/application/views/imagenes/fondoCelda.bmp);
  color:black;
  font-family: Geneva, Arial, Helvetica, sans-serif; font-size:12px;
}
.Estilo1 {color: black; font-family: Geneva, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; }
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
<?php echo $js; ?>
<p align="center" class="Titulo">Asignación de Materia por Carrera: <?php echo $carrera; ?> </p>

<?php echo form_open('materiacarrerainstituto/materiacarrerainstitutoRecord/'); ?>
<input type="hidden" name="carrera_instituto_id" id="carrera_instituto_id" value="<?php echo isset($carrera_instituto_id)?$carrera_instituto_id:''; ?>">
<input type="hidden" name="materia_carrera_id" id="materia_carrera_id" value="<?php echo isset($materia_carrera_id)?$materia_carrera_id:''; ?>">
<input type="hidden" name="txtActivo" value="<?php echo isset($activo)?$activo:''; ?>">
<input type="hidden" name="carrera" value="<?php echo isset($carrera)?$carrera:''; ?>">
<table width="564" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
    <!--DWLayoutTable-->
      
      <tr>
      <td width="277" height="19" bgcolor="#FFFFFF" class="celdaError"  ><?php
          echo anchor('materiacarrerainstituto/materia_carrera_list/'.$carrera_instituto_id,'<img alt="Volver" src="'.base_url().'system/application/views/imagenes/volver.png" border="0">');
          ?></td>
      <td width="23" bgcolor="#FFFFFF" class="celdaError" ><!--DWLayoutEmptyCell-->&nbsp;</td>
	  <td width="264" valign="top" bgcolor="#FFFFFF" class="celdaError" ><!--DWLayoutEmptyCell-->&nbsp;</td>
      </tr>
      <tr>
      <td height="15" colspan="2"  valign="middle" class="celda">Materia</td>
	    <td   valign="middle" class="celda">&nbsp;Número Periodo:</td>
      </tr>
      
      <tr>
        <td height="18" colspan="2"  valign="middle"><select name="cmbmateria" id="cmbmateria" style="width:300px">
          <option value="">Seleccione</option>
          <?php
              if($q_materias->num_rows() > 0)
              {
				foreach($q_materias->result() as $row)
                {
              ?>
          <option value="<?php echo($row->materia_id);?>" <?php if($row->materia_id==$materia_id) echo ' selected'; ?> > <?php echo($row->nombre_materia); ?> </option>
          <?php
                }
              }
          ?>
        </select></td>
        <td rowspan="2" valign="top"><input type="text" name="numero_periodo" id="numero_periodo" value="<?php echo $numero_periodo; ?>" maxlength="2" size="55">
        <?php echo form_error('numero_periodo','<div class="celdaError">', '</div>');?></td>
      </tr>
      <tr>
        <td height="18" colspan="2"  valign="top"><?php echo form_error('cmbmateria','<div class="celdaError">', '</div>');?></td>
      </tr>
      
      
      <tr>
        <td  height="22" colspan="2"   valign="middle" class="celda">Unidades Crédito </td>
        <td   valign="middle" class="celda">Código Materia             </tr>
      <tr>
        <td  height="22" colspan="2"   valign="top"><input type="text" name="cantidad_unidad_credito" id="cantidad_unidad_credito" value="<?php echo $cantidad_unidad_credito; ?>" maxlength="2" size="44"></td>
	  <td   valign="middle">
      <input type="text" name="codigo_materia" id="codigo_materia" value="<?php echo $codigo_materia; ?>" maxlength="10" size="55">	  </tr>
	  
      <tr>
        <td  height="18" colspan="2" valign="top"><?php echo form_error('cantidad_unidad_credito','<div class="celdaError">', '</div>');?></td>
      <td valign="top" ><?php echo form_error('codigo_materia','<div class="celdaError">', '</div>');?></td>
      </tr>
      
      
      
	  <tr><td height="24" colspan="3" align="right" valign="top">                          
	    <input name="cmdAceptar" type="submit" value="Aceptar">
	  </tr>
</table>
 
</form>
</body>
</html>
