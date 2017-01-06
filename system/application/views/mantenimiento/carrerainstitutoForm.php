<?php $this->mod_usuario->en_session(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Institutos, Carreras y Materias</title>
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
<p align="center" class="Titulo">Asignación de Carreras por Instituto </p>

<?php echo form_open('materiacarrerainstituto/carrerainstitutoRecord'); ?>
<input type="hidden" name="carrera_instituto_id" id="carrera_instituto_id" value="<?php echo isset($carrera_instituto_id)?$carrera_instituto_id:''; ?>">
<input type="hidden" name="txtActivo" value="<?php echo isset($activo)?$activo:''; ?>">
  
  <table width="543" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
    <!--DWLayoutTable-->
      <tr>
        <td colspan="3"   align="left" bgcolor="#FFFFFF" class="celdaError"  >
		<?php
          echo anchor('materiacarrerainstituto','<img alt="Volver" src="'.base_url().'system/application/views/imagenes/volver.png" border="0">');
          ?>		</td>
      </tr>
	
      <tr>
        <td width="78"  valign="middle" class="celda">Instituto      </td>
        <td colspan="2" valign="middle" class="celda">Carrera</td>
      </tr>
      <tr>
      <td  valign="middle">
	      <select name="cmbinstituto" id="cmbinstituto" style="width:325px" onChange="xajax_carrera_x(this.value)">
          <option value="">Seleccione</option>
          <?php
         
              if($q_instituto->num_rows() > 0)
              {
            
				
				foreach($q_instituto->result() as $row)
                {
              ?>
                  <option value="<?php echo($row->instituto_id);?>" <?php if($row->instituto_id==$instituto_id) echo ' selected'; ?> >
                  <?php echo($row->nombre_instituto); ?>                  </option>
              <?php
                }
              }
        
          ?>
          </select></td>
	  <td colspan="2" valign="middle">
	    <div  name="div_carrera" id="div_carrera">
	      
	      <select name="cmbcarrera" id="cmbcarrera" style="width:325px">
	        <option value="" >Seleccione</option>
	        <?php
         
              if($q_carrera->num_rows() > 0)
              {
            
				
				foreach($q_carrera->result() as $row)
                {
              ?>
	        <option value="<?php echo($row->carrera_id);?>" <?php if($row->carrera_id==$carrera_id) echo ' selected'; ?> >
            <?php echo($row->nombre_carrera); ?>                  </option>
	        <?php
                }
              }
        
          ?>
          </select>
	    </div></td>
	  </tr>
      <tr>
        <td  height="19"   valign="middle"><span class="celdaError"><?php echo form_error('cmbinstituto','<div class="celdaError">', '</div>');?></span></td>
        <td colspan="2" valign="middle"><span class="celdaError"><?php echo form_error('cmbcarrera','<div class="celdaError">', '</div>');?></span></td>
      </tr>
      <tr>
        <td  height="19"   valign="middle" class="celda">Tipo Periodo</td>
        <td colspan="2" valign="middle" class="celda">Modalidad</td>
      </tr>
      <tr>
      <td  height="19"   valign="middle"> <select name="cmbtipperiodo" id="cmbtipperiodo" style="width:325px">
       
		  
               <option value="">Seleccione</option>
          <?php
         
              if($q_tipo_periodo->num_rows() > 0)
              {
            
				
				foreach($q_tipo_periodo->result() as $row)
                {
              ?>
                  <option value="<?php echo($row->tipo_periodo_id);?>" <?php if($row->tipo_periodo_id==$tipo_periodo_id) echo ' selected'; ?> >
                  <?php echo($row->nombre_tipo_periodo); ?>                  </option>
              <?php
                }
              }
        
          ?>
         
        </select></td>
      <td colspan="2" valign="middle"> 
	    <select name="cmbModalidad" id="cmbmodalidad" style="width:325px">
	      <option value="">Seleccione</option>
	      <?php
         
              if($q_modalidad->num_rows() > 0)
              {
            
				
				foreach($q_modalidad->result() as $row)
                {
              ?>
	      <option value="<?php echo($row->modalidad_id);?>" <?php if($row->modalidad_id==$modalidad_id) echo ' selected'; ?> >
          <?php echo($row->nombre_modalidad); ?>                  </option>
	      <?php
                }
              }
        
          ?>
          </select></td>
	  </tr>
      <tr>
      <td  height="19" valign="top"><?php echo form_error('cmbtipperiodo','<div class="celdaError">', '</div>');?></td>
	  <td colspan="2"><?php echo form_error('cmbModalidad','<div class="celdaError">', '</div>');?></td>
	  </tr>
      
      <tr>
        <td height="24" colspan="3"  align="right" valign="top"><input name="cmdAceptar" type="submit" value="Aceptar"></td>
      </tr>
</table>
 
</form>
</body>
</html>
