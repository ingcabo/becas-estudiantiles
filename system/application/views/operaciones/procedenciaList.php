<?php  $this->mod_usuario->en_session(); ?>
<html>
  <head>
    <LINK REL=StyleSheet HREF="<?php echo base_url(); ?>system/application/views/estilos/lista.css" TYPE="text/css" MEDIA=screen>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
 <script type="text/javascript" src="<?php echo base_url(); ?>system/application/views/javascript/validacion.js"></script>
    <title>Control de Procedencias</title>
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
    <?php echo form_open('procedencia/procedenciaControl'); ?>
    <input type="hidden" id="bandPost" name="bandPost" value="1">
   

    <p align="center" class="Titulo">Control de Procedencias</p>
    <table width="736px" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">

      <tr>
        <td colspan="<?php echo $colSpanFullLine; ?>">
        
        <select name="cmbCampo" id="cmbCampo" style="width:200px">
          <option></option>
          <option value="nombre_tipo_procedencia" <?php if($campo=="nombre_tipo_procedencia") echo 'selected';?> >Tipo de Procedencia</option>
          <option value="fecha_procedencia" <?php if($campo=="fecha_procedencia") echo 'selected';?> >Fecha</option>
          <option value="lugar_procedencia" <?php if($campo=="lugar_procedencia") echo 'selected';?> >Lugar</option>
          <option value="nombre_persona" <?php if($campo=="nombre_persona") echo 'selected';?> >Contacto</option>
        </select>
        <select name="cmbCriterio" id="cmbCriterio" style="width:130px">
          <option></option>
          <option <?php if($criterio=="Contenga") echo 'selected';?> >Contenga</option>
          <option <?php if($criterio=="Sea Igual a") echo 'selected';?> >Sea Igual a</option>
        </select>
        <input type="text" name="txtValor" id="txtValor" style="width:310px;" value="<?php echo $valor;?>">
        <input type="submit" value="Filtra">
        <?php
          echo '<img src="'.base_url().'system/application/views/imagenes/buscar.png" border="0">';
          ?>        </td>
      </tr>
      
      <tr>
        <td colspan="<?php echo $colSpanFullLine; ?>" align="center" class="celdaTitulo">
          <?php echo($pages);
          //echo '<script>  alert(\''.$pages.'\');  </script>';
          ?>        </td>
      </tr>
      <tr>
        <td colspan="<?php echo $colSpanFullLine; ?>" align="right">
          <?php
          if($permisos['i'])
            echo anchor('procedencia/procedenciaForm/-1','<img alt="Agregar" src="'.base_url().'system/application/views/imagenes/agregar.png" border="0">');
          ?>        </td>
      </tr>

      <tr>
        <td class="celdaTitulo" width="24%">
        Tipo Procedencia
        </td>
        <td class="celdaTitulo" width="24%">
        Contacto
        </td>
        <td class="celdaTitulo" width="12%">
        Fecha
        </td>
        <td class="celdaTitulo" width="24%">
        Lugar
        </td>
        <td class="celdaTitulo" width="8%" align="center">
        Modificar
        </td>
        <td class="celdaTitulo" width="8%" align="center">
        Eliminar
        </td>
      </tr>
      <?php
      if($result->num_rows()!=0)
      {
        foreach($result->result() as $row)
        {
      ?>
          <tr>
            <td class="celdaContenido">
            <?php echo($row->nombre_tipo_procedencia); ?>
            </td>
            <td class="celdaContenido">
            <?php echo($row->nombre_persona);?>
            </td>
            <td class="celdaContenido">
            <?php echo($this->jelgeneral->arreglarFechaBD($row->fecha_procedencia));?>
            </td>
            <td class="celdaContenido">
            <?php echo($row->lugar_procedencia);?>
            </td>
            <td align="center" class="celdaContenido">
            <?php
            if($permisos['m'])
              echo anchor('procedencia/procedenciaForm/'.$row->procedencia_id,
                        '<img alt="Modificar" src="'.base_url().'system/application/views/imagenes/modificar.png" border="0">');
            ?>
            </td>
            <td align="center" class="celdaContenido">
            <?php
            if($permisos['b'])
              echo anchor('procedencia/procedenciaDelete/'.$row->procedencia_id,
                        '<img alt="Eliminar" src="'.base_url().'system/application/views/imagenes/eliminar.png" border="0">',
                        array('onClick' => 'return confirmDelete();'));
            ?>
            </td>
          </tr>
      <?php
        }
      }
      ?>
      <tr>
        <td colspan="<?php echo $colSpanFullLine; ?>" align="center" class="celdaTitulo">&nbsp;        </td>
      </tr>
      <tr>
        <td colspan="<?php echo $colSpanFullLine; ?>" align="right">
          <?php
          if($permisos['i'])
            echo anchor('procedencia/procedenciaForm/-1','<img alt="Agregar" src="'.base_url().'system/application/views/imagenes/agregar.png" border="0">');
          ?>        </td>
      </tr>
      <tr>
        <td colspan="<?php echo $colSpanFullLine; ?>" align="center" class="celdaTitulo">
          <?php echo($pages); ?>        </td>
      </tr>
  </table>
    </form>
</body>
</html>