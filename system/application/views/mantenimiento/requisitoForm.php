<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title><?php print_r($_POST); ?>Registro de requisitos</title>
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
<script type="text/javascript">

function valor(a){

alert(a);

}

</script>

</head>



<body>
<?php echo $menu; ?>
<br>
<p align="center" class="Titulo">Registro Requisito </p>

<?php echo form_open('requisito/requisitoRecord'); ?>


  <input type="hidden" name="txtId" value="<?php echo $id; ?>">
  <input type="hidden" name="txtActivo" value="<?php echo $activo; ?>">
 
  <table width="634" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
      <tr>
        <td colspan="4" align="left" class="celdaError">        </td>
      </tr>
      <tr>
        <td colspan="4" align="left" bgcolor="#FFFFFF">
          <?php
          echo anchor('requisito/requisitoControl','<img alt="Volver" src="'.base_url().'system/application/views/imagenes/volver.png" border="0">');
          ?>        </td>
      </tr>
      <tr>
      <td width="343"  class="celda">
      Nombre del Requisito:<span class="fontnormal"><font color="#FF0000"><?php echo form_error('txtrequisito'); ?></font></span></strong></strong>  </td>
      <td width="393"  class="celda">
      Acción: <span class="fontnormal"><font color="#FF0000"> <?php echo form_error('cmbaccion'); ?>  </font></span></td>
      </tr>
      <tr>
      <td>  <input name="txtrequisito" type="text" id="txtrequisito" value="<?php echo $nombrerequisito; ?>" size="56"></td>
      <td>
	   <select name="cmbaccion" id="cmbaccion" style="width:263px"  />
          <option value=" "></option>
          <?php
          if($acciones->num_rows()!= 0)
          {
            foreach($acciones->result() as $row)
            {
          ?>
              <option value="<?php echo($row->accion_id);?>" <?php if($row->accion_id==$accionId) echo ' selected'; ?> >
              <?php echo($row->nombre_accion); ?>			  </option>
			  <?php
            }
          }
          ?>
        </select>	  </td>
      </tr>
	   
	   <tr>
      <td colspan="2"  class="celda">
	  
	  <?php if($obligatorio== '1'){$valor='checked';}else{$valor='';}  ?>
	  <input type="checkbox"   name="obligatorio" value="1" <?php echo $valor; ?>  <?php set_checkbox('obligatorio','1')?> />
	  Obligatorio: <span class="fontnormal"><font color="#FF0000"> </font></span></td>
      </tr>
      <tr>
      <td colspan="2" align="right">
        <input name="cmdAceptar" type="submit" value="Aceptar">      </td>
      </tr>
</table>
   <script>setFocus("txtPais");</script>
</form>
</body>
</html>