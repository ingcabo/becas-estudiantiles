<?php $this->mod_usuario->en_session(); ?>
<html>
  <head>
    <LINK REL=StyleSheet HREF="<?php echo base_url(); ?>system/application/views/estilos/lista.css" TYPE="text/css" MEDIA=screen>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
 <script type="text/javascript" src="<?php echo base_url(); ?>system/application/views/javascript/validacion.js"></script> 
    <title>Institutos, Carreras y Materias</title>
  <style type="text/css">
<!--
body {
	background-image: url(<?php echo base_url(); ?>system/application/views/imagenes/bg2.gif);
	background-repeat: no-repeat;
	background-color: #a7d0e4;
}
-->
</style></head>
<body>
   
    <?php echo $menu; ?>
    <?php $colSpanFullLine=6; ?>
    <br>
    <?php echo form_open('materiacarrerainstituto/materia_carrera_list/'.$id); ?>
    <input type="hidden" id="bandPost" name="bandPost" value="1">
	<input type="hidden" id="id" name="id" value="<?php echo isset($id)?$id:''; ?>">
	
   

  <p align="center" class="Titulo">Asignación de Materias por Carrera: <?php echo $carrera; ?></p>
    <table width="736px" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
      <tr>
	  <td bgcolor="#FFFFFF" class="celdaError" >
	  <?php
          echo anchor('materiacarrerainstituto','<img alt="Volver" src="'.base_url().'system/application/views/imagenes/volver.png" border="0">');
          ?>
	  </td>
	  <td  bgcolor="#FFFFFF" class="celdaError"></td>
	<td  bgcolor="#FFFFFF" class="celdaError"></td>
	<td  bgcolor="#FFFFFF" class="celdaError"></td>
	<td  bgcolor="#FFFFFF" class="celdaError"></td>
	  </tr>
	  <tr>
        <td width="42%" colspan="<?php echo $colSpanFullLine; ?>"><select name="cmbCampo" id="cmbCampo" style="width:200px">
            <option></option>
            <option value="nombre_materia" <?php if($campo=="nombre_matria") echo 'selected';?> >Materia</option>
            <option value="nombre_modalidad" <?php if($campo=="nombre_modalidad") echo 'selected';?> >Modalidad</option>
            <option value="cantidad_unidad_credito" <?php if($campo=="cantidad_unidad_credito") echo 'selected';?> >Unidad Credito</option>
          </select>
            <select name="cmbCriterio" id="cmbCriterio" style="width:130px">
              <option></option>
              <option <?php if($criterio=="Contenga") echo 'selected';?> >Contenga</option>
              <option <?php if($criterio=="Sea Igual a") echo 'selected';?> >Sea Igual a</option>
            </select>
            <input type="text" name="txtValor" id="txtValor" style="width:310px;" value="<?php echo $valor;?>">
            <input name="submit" type="submit" value="Filtra">
            <?php
          echo '<img src="'.base_url().'system/application/views/imagenes/buscar.png" border="0">';
          ?>        </td>
      </tr>
      <tr>
        <td colspan="<?php echo $colSpanFullLine; ?>" align="center" class="celdaTitulo"><?php echo($pages);

          //echo '<script>  alert(\''.$pages.'\');  </script>';
          ?> </td>
      </tr>
      <tr>
        <td colspan="<?php echo $colSpanFullLine; ?>" align="right"><?php
         
		 if($permisos['i']){
		  echo anchor('materiacarrerainstituto/materiacarrerainstitutoform/'.$id.'/-1','<img alt="Agregar" src="'.base_url().'system/application/views/imagenes/agregar.png" border="0">');
          
		  }?>        </td>
      </tr>
      <tr>
        <td class="celdaTitulo">Nombre de la Materia</td>
        <td class="celdaTitulo" width="23%" align="center">&nbsp;Unidad de Crédito </td>
        <td class="celdaTitulo" width="19%" align="center">&nbsp;&nbsp;Periodo</td>
       
        <td class="celdaTitulo" width="9%" align="center"> Modificar </td>
        <td class="celdaTitulo" width="7%" align="center"> Eliminar </td>
      </tr>
      <?php
      if($result->num_rows()!=0)
      {
        foreach($result->result() as $row)
        {
      ?>
      <tr>
        <td class="celdaContenido"><?php echo($row->nombre_materia); ?> </td>
        <td class="celdaContenido" align="center"><?php echo($row->cantidad_unidad_credito); ?> </td>
        <td class="celdaContenido" align="center"> &nbsp;&nbsp;<?php echo($row->numero_periodo); ?> </td>
        
        <td align="center" class="celdaContenido"><?php
           
		   if($permisos['m'])
		    echo anchor('materiacarrerainstituto/materiacarrerainstitutoForm/'.$id.'/'.$row->materia_carrera_id,
                        '<img alt="Modificar" src="'.base_url().'system/application/views/imagenes/modificar.png" border="0">');
						
            ?></td>
		<td><div align="center"><span class="celdaContenido">
	    <?php
              if($permisos['b'])
			echo anchor('materiacarrerainstituto/delete_materiacarrerainstituto/'.$id.'/'.$row->materia_carrera_id,
                        '<img alt="Eliminar" src="'.base_url().'system/application/views/imagenes/eliminar.png" border="0">',
                        array('onClick' => 'return confirmDelete();'));
            ?>
	    </span></div></td>
      </tr>
      <?php
        }
      }
      ?>
      <tr>
        <td colspan="<?php echo $colSpanFullLine; ?>" align="center" class="celdaTitulo">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="<?php echo $colSpanFullLine; ?>" align="right"><?php
		
		if($permisos['i']){
            echo anchor('materiacarrerainstituto/materiacarrerainstitutoform/'.$id.'/-1','<img alt="Agregar" src="'.base_url().'system/application/views/imagenes/agregar.png" border="0">');
          }
		  ?>        </td>
      </tr>
      <tr>
        <td colspan="<?php echo $colSpanFullLine; ?>" align="center" class="celdaTitulo"><?php echo($pages); ?> </td>
      </tr>
    </table>
    </form>
</body>
</html>

