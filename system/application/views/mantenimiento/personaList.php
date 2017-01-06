<?php $this->mod_usuario->en_session(); ?>
<html>
  <head>
    <LINK REL=StyleSheet HREF="<?php echo base_url(); ?>system/application/views/estilos/lista.css" TYPE="text/css" MEDIA=screen>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <script type="text/javascript" src="<?php echo base_url(); ?>system/application/views/javascript/validacion.js"></script>
     <title>Control de Personas</title>
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
    <?php $editRecord='persona/personaForm'; ?>
	
    <?php 
	if($this->personaModel->nombre_tabla == 'sorteo_persona'){
	
	$listRecord='sorteo/personaControl'; 
	
	}else{
	
	$listRecord='persona/personaControl'; 
	
	}
	
    ?>
	<?php $deleteRecord='persona/personaDelete'; ?>
    
    <br>
    <?php echo form_open($listRecord); ?>
    <input type="hidden" id="bandPost" name="bandPost"  value="1">
	<input type="hidden" id="sorteo_id" name="sorteo_id" value="<?php if($sorteo_id != '') {echo $sorteo_id;} else {echo '0';}; ?>">
   

    <p align="center" class="Titulo"><?php echo $titulo; ?></p>
    <table width="736px" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">

      <tr>
        <td colspan="<?php echo $colSpanFullLine?>">
        
        <select name="cmbCampo" id="cmbCampo" style="width:200px">
          <option></option>
          <option value="nombre_persona" <?php if($campo=="nombre_persona") echo 'selected';?> >Nombre de la Persona</option>
          <option value="apellido_persona" <?php if($campo=="apellido_persona") echo 'selected';?> >Apellidos de la Persona</option>
          <option value="nacionalidad_pais" <?php if($campo=="nacionalidad_pais") echo 'selected';?> >Nacionalidad</option>
          <option value="tipo_cedula_persona" <?php if($campo=="tipo_cedula_persona") echo 'selected';?> >Tipo Cédula</option>
          <option value="cedula_persona" <?php if($campo=="cedula_persona") echo 'selected';?> >Cédula</option>
        </select>
        <select name="cmbCriterio" id="cmbCriterio" style="width:130px">
          <option></option>
          <option <?php if($criterio=="Contenga") echo 'selected';?> >Contenga</option>
          <option <?php if($criterio=="Sea Igual a") echo 'selected';?> >Sea Igual a</option>
        </select>
        <input type="text" name="txtValor" id="txtValor" style="width:310px;" value="<?php echo $valor;?>">
        <input type="submit" value="Filtra">
        <?php
          echo anchor('jel/#','<img alt="Buscar" src="'.base_url().'system/application/views/imagenes/buscar.png" border="0">', array('onClick' => 'xajax_process_requests(\'paisForm\',\'div_result\',\'?id=-1\');'));
          ?>        </td>
      </tr>
      
      <tr>
        <td colspan="<?php echo $colSpanFullLine?>" align="center" class="celdaTitulo">
          <?php echo($pages);

          //echo '<script>  alert(\''.$pages.'\');  </script>';
          ?>        </td>
      </tr>
      <tr>
        <td colspan="<?php echo $colSpanFullLine?>" align="right">
          <?php
          if($permisos['i'])
            echo anchor($editRecord.'/-1','<img alt="Agregar" src="'.base_url().'system/application/views/imagenes/agregar.png" border="0">');
          ?>        </td>
      </tr>

      <tr>
        <td class="celdaTitulo" >
        Cédula        </td>
        <td class="celdaTitulo" width="23%">
        Nombre        </td>
        <td class="celdaTitulo" width="18%">
        Apellido        </td>
        <td class="celdaTitulo" width="9%" align="center">
        Modificar        </td>
        <td class="celdaTitulo" width="7%" align="center">
        Eliminar        </td>
      </tr>
      <?php
      if($result->num_rows()!=0)
      {
        foreach($result->result() as $row)
        {
      ?>
          <tr>
            <td class="celdaContenido" width="43%">
            <?php echo($row->tipo_cedula_persona); ?>            <?php echo($row->cedula_persona); ?></td>
            <td class="celdaContenido">
            <?php echo($row->nombre_persona);?>            </td>
            <td class="celdaContenido">
            <?php echo($row->apellido_persona);?>            </td>
            <td align="center" class="celdaContenido">
            <?php
           
		   if ($this->personaModel->nombre_tabla == 'sorteo_persona'){
		   
		   
		       $atts = array(
              'width'      => '780',
              'height'     => '600',
              'scrollbars' => 'yes',
              'status'     => 'yes',
              'resizable'  => 'yes',
              'screenx'    => '0',
              'screeny'    => '0'
            );
 
                echo anchor_popup('sorteo/detallePersona/'.$row->persona_id,'<img alt="Ver Detalle" src="'.base_url().'system/application/views/imagenes/zoom+.png" border="0">', $atts );
		   
		   
		   
		   }else{
		   if($permisos['m'])
		    echo anchor($editRecord.'/'.$row->persona_id,
                        '<img alt="Modificar" src="'.base_url().'system/application/views/imagenes/modificar.png" border="0">');
				 }		
						
						
            ?>            </td>
            <td align="center" class="celdaContenido">
            <?php
            
			 if ($this->personaModel->nombre_tabla == 'sorteo_persona'){
			   if($permisos['b'])
			     echo anchor('sorteo/deletepersonasorteo/'.$row->sorteo_id.'/'.$row->procedencia_persona_id,
                        '<img alt="Eliminar" src="'.base_url().'system/application/views/imagenes/eliminar.png" border="0">',
                        array('onClick' => 'return confirmDelete();'));
			 }else{
			   if($permisos['b'])
			     echo anchor($deleteRecord.'/'.$row->persona_id,
                        '<img alt="Eliminar" src="'.base_url().'system/application/views/imagenes/eliminar.png" border="0">',
                        array('onClick' => 'return confirmDelete();'));
                  }
			
			?>            </td>
          </tr>
      <?php
        }
      }
      ?>
      <tr>
        <td colspan="<?php echo $colSpanFullLine?>" align="center" class="celdaTitulo">&nbsp;        </td>
      </tr>
      <tr>
        <td colspan="<?php echo $colSpanFullLine?>" align="right">
          <?php
          if($permisos['i'])
            echo anchor($editRecord.'/-1','<img alt="Agregar" src="'.base_url().'system/application/views/imagenes/agregar.png" border="0">');
          ?>        </td>
      </tr>
      <tr>
        <td colspan="<?php echo $colSpanFullLine?>" align="center" class="celdaTitulo">
          <?php echo($pages); ?>        </td>
      </tr>
  </table>
    </form>
</body>
</html>

