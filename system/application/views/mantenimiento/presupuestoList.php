<?php  $this->mod_usuario->en_session(); ?>
<html>
  <head>
    <LINK REL=StyleSheet HREF="<?php echo base_url(); ?>system/application/views/estilos/lista.css" TYPE="text/css" MEDIA=screen>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
 <script type="text/javascript" src="<?php echo base_url(); ?>system/application/views/javascript/validacion.js"></script> 
    <title>Control de Carreras</title>
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
    <?php echo form_open('presupuesto'); ?>
    <input type="hidden" id="bandPost" name="bandPost" value="1">
   

    <p align="center" class="Titulo">Control de Presupuestos </p>
    <table width="736px" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">

      <tr>
        <td colspan="<?php echo $colSpanFullLine; ?>">
        
        <select name="cmbCampo" id="cmbCampo" style="width:200px">
          <option></option>
           <option value="nombre_persona" <?php if($campo=="nombre_persona") echo 'selected';?> >nombre</option>
          <option value="apellido_persona" <?php if($campo=="apellido_persona") echo 'selected';?> >apellido</option>
		   <option value="ano_periodo" <?php if($campo=="ano_periodo") echo 'selected';?> >Año Periodo</option>
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
            echo anchor('presupuesto/presupuestoPersonaControl','<img alt="Agregar" src="'.base_url().'system/application/views/imagenes/agregar.png" border="0">');
          ?>        </td>
      </tr>

      <tr>
        <td class="celdaTitulo" width="42%">Cedula/Nombre</td>
        <td class="celdaTitulo" width="42%">Periodo </td>  
		     
        <td class="celdaTitulo" width="8%" align="center">
        Modificar        </td>
        <td class="celdaTitulo" width="8%" align="center">
        Eliminar        </td>
      </tr>
      <?php
      if($result->num_rows()!=0)
      {
        foreach($result->result() as $row)
        {
      ?>
          <tr>
            <td class="celdaContenido">
            <?php echo $row->cedula_persona.' '.$row->nombre_persona.' '.$row->apellido_persona; ?>            </td>
            <td class="celdaContenido">
            <?php echo $row->ano_periodo.$row->parcial_periodo; ?>            </td>
            <td align="center" class="celdaContenido">
            <?php
            if($permisos['m'])
              echo anchor('presupuesto/presupuestoForm/'.$row->beca_persona_id.'/'.$row->presupuesto_id,
                        '<img alt="Modificar" src="'.base_url().'system/application/views/imagenes/modificar.png" border="0">');
            ?>            </td>
            <td align="center" class="celdaContenido">
            <?php
            if($permisos['b'])
              echo anchor('presupuesto/del_presupuesto/'.$row->presupuesto_id,
                        '<img alt="Eliminar" src="'.base_url().'system/application/views/imagenes/eliminar.png" border="0">',
                        array('onClick' => 'return confirmDelete();'));
            ?>            </td>
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
		    echo anchor('presupuesto/presupuestoPersonaControl','<img alt="Agregar" src="'.base_url().'system/application/views/imagenes/agregar.png" border="0">');
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

