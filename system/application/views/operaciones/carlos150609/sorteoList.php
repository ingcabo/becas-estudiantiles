<html>
  <head>
    <LINK REL=StyleSheet HREF="<?php echo base_url(); ?>system/application/views/estilos/lista.css" TYPE="text/css" MEDIA=screen>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
 <script type="text/javascript" src="<?php echo base_url(); ?>system/application/views/javascript/validacion.js"></script>
    <title>Control de Procedencias</title>
  </head>
  <body>
   
    <?php echo $menu; ?>
    <?php $colSpanFullLine=6; ?>
    <br>
    <?php echo form_open('sorteo/sorteoControl'); ?>
    <input type="hidden" id="bandPost" name="bandPost" value="1">
   

    <p align="center" class="Titulo">Control de Sorteos </p>
    <table width="736px" border="0" align="center" cellpadding="0" cellspacing="0">

      <tr>
        <td colspan="<?php echo $colSpanFullLine; ?>">
        
        <select name="cmbCampo" id="cmbCampo" style="width:200px">
          <option></option>
          <option value="lugar_sorteo" <?php if($campo=="lugar_sorteo") echo 'selected';?> >lugar sorteo</option>
          <option value="fecha_sorteo" <?php if($campo=="fecha_sorteo") echo 'selected';?> >Fecha</option>
          
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
          ?>
        
        </td>
      </tr>
      <tr>
        <td colspan="<?php echo $colSpanFullLine; ?>" align="center" >&nbsp;
          
        </td>
      </tr>
      <tr>
        <td colspan="<?php echo $colSpanFullLine; ?>" align="center" class="celdaTitulo">
          <?php echo($pages);
          //echo '<script>  alert(\''.$pages.'\');  </script>';
          ?>     
        </td>
      </tr>
      <tr>
        <td colspan="<?php echo $colSpanFullLine; ?>" align="right">
          <?php
          echo anchor('sorteo/sorteoForm/-1','<img alt="Agregar" src="'.base_url().'system/application/views/imagenes/agregar.png" border="0">');
          ?>
        </td>
      </tr>

      <tr>
        <td class="celdaTitulo" width="24%">
        &nbsp;&nbsp;Lugar
        </td>
        <td class="celdaTitulo" width="24%">
        &nbsp;&nbsp;Fecha
        </td>
        <td class="celdaTitulo" width="12%">
        
        </td>
        <td class="celdaTitulo" width="24%">&nbsp;
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
            <?php echo($row->lugar_sorteo); ?>
            </td>
            <td class="celdaContenido">
            <?php echo($row->fecha_sorteo);?>
            </td>
            <td class="celdaContenido">
            <?php // echo($row->fecha_sorteo);?>
            </td>
            <td class="celdaContenido">
            <?php // echo($row->fecha_sorteo);?>
            </td>
            <td align="center" class="celdaContenido">
            <?php
            echo anchor('sorteo/sorteoForm/'.$row->sorteo_id,
                        '<img alt="Modificar" src="'.base_url().'system/application/views/imagenes/modificar.png" border="0">');
            ?>
            </td>
            <td align="center" class="celdaContenido">
            <?php
            echo anchor('sorteo/sorteoDelete/'.$row->sorteo_id,
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
        <td colspan="<?php echo $colSpanFullLine; ?>" align="center" class="celdaTitulo">&nbsp;
          
        </td>
      </tr>
      <tr>
        <td colspan="<?php echo $colSpanFullLine; ?>" align="right">
          <?php
          echo anchor('sorteo/sorteoForm/-1','<img alt="Agregar" src="'.base_url().'system/application/views/imagenes/agregar.png" border="0">');
          ?>
        </td>
      </tr>
      <tr>
        <td colspan="<?php echo $colSpanFullLine; ?>" align="center" class="celdaTitulo">
          <?php echo($pages); ?>
        </td>
      </tr>
    </table>
    </form>
</body>
</html>