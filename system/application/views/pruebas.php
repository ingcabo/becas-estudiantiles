<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>pruebas</title>
<?php echo  $xajax_js; ?> 

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



-->
</style>

</head>





<body>
<?php echo $menu; ?>
<p>&nbsp;</p>
<p align="center" class="Titulo">Registro Sorteo</p>
<?php echo form_open('sorteo/sorteoRecord'); ?>


  <input type="hidden" name="txtId" value="<?php echo $id; ?>">
  <input type="hidden" name="txtActivo" value="<?php echo $activo; ?>">

<table width="861" height="184" border="2" align="center">
   
     <tr>
    <td width="372">&nbsp;</td>
    <td width="49">&nbsp;</td>
    <td width="256">&nbsp;</td>
    <td width="94">&nbsp;</td>
    <td width="18">&nbsp;</td>
    <td width="30">&nbsp;</td>
  </tr>
   
    <tr>
    <td width="372">Lugar:</td>
    <td width="49">&nbsp;</td>
    <td width="256">Fecha:</td>
    <td width="94">&nbsp;</td>
    <td width="18">&nbsp;</td>
    <td width="30">&nbsp;</td>
  </tr>
  
  
  <tr>
    <td width="372"> <input name="txtlugar" type="text" id="txtlugar" value="<?php echo $lugar; ?>" size="56"></td>
    <td width="49">&nbsp;</td>
    <td width="256"><input name="fecha" type="text" id="fecha" value="<?php echo $fecha; ?>" size="10"></td>
    <td width="94">&nbsp;</td>
    <td width="18">&nbsp;</td>
    <td width="30">&nbsp;</td>
  </tr>
  <tr>
    <td>estado:</td>
    <td>&nbsp;</td>
    <td>Municipio:</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
  <td>  <div class="div_texbox" id="divEstados">
			
			<select name="selEstados" class="textbox" onChange="xajax_obtieneMunicipio(this.value);" >
				<option value="0">Seleccione uno</option>
				<?php if(isset($query_estados)): ?>
				<?php foreach($query_estados -> result() as $row): ?>
				<?php if($row -> estado_id == $est_estados_id): ?>
				<option value="<?php echo $row -> estado_id; ?>" selected="selected"><?php echo $row -> nombre_estado; ?></option>
				<?php else: ?>
				<option value="<?php echo $row -> estado_id; ?>" ><?php echo $row -> nombre_estado; ?></option>
				<?php endif; ?>
				<?php endforeach; ?>
				<?php endif; ?>
			</select>
    </div></td>
	  <td>&nbsp;</td>
    <td>
	 <div class="div_texbox" id="div_Municipio">
			<select name="menu1" class="textbox" onChange='xajax_obtieneParroquia(this.value);'>
				<option value="0">Seleccione uno</option>
				<?php if(isset($query_municipios)): ?>
				<?php foreach($query_municipios -> result() as $row): ?>
				<?php if($row -> municipio_id == $municipio_fk): ?>
				<option value="<?php echo $row -> municipio_id; ?>" selected="selected"><?php echo $row -> nombre_municipio; ?></option>
				<?php else: ?>
				<option value="<?php echo $row -> municipio_id; ?>" ><?php echo $row -> nombre_municipio; ?></option>
				<?php endif; ?>
				<?php endforeach; ?>
				<?php endif; ?>
			</select>
	  </div>
	</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><input type="checkbox" name="algo" onClick="xajax_test()"> </td>
    <td>&nbsp;</td>
    <td><div id="capa" name="capa"><span> este div tiene id= </span> </div></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</form>
</body>
</html>
