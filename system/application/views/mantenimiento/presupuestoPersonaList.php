<?php $this->mod_usuario->en_session(); ?>
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
   

  <p align="center" class="Titulo">Presupuestos, Personas </p>
    <table width="736px" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">

<tr>
<td bgcolor="#FFFFFF"><?php
          echo anchor('presupuesto','<img alt="Volver" src="'.base_url().'system/application/views/imagenes/volver.png" border="0">');
          ?> </td>
<td bgcolor="#FFFFFF">&nbsp;</td>
<td bgcolor="#FFFFFF">&nbsp;</td>
<td bgcolor="#FFFFFF">&nbsp;</td>
</tr>


      <tr>
        <td colspan="<?php echo $colSpanFullLine; ?>">
        
        <select name="cmbCampo" id="cmbCampo" style="width:200px">
          <option></option>
           <option value="cedula_persona" <?php if($campo=="cedula_persona") echo 'selected';?> >cedula_persona</option>
          <option value="nombre_persona" <?php if($campo=="nombre_persona") echo 'selected';?> >Nombre Persona</option>
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
        //  if($permisos['i'])
           // echo anchor('presupuesto/presupuestoForm/-1','<img alt="Agregar" src="'.base_url().'system/application/views/imagenes/agregar.png" border="0">');
          ?>        </td>
      </tr>

      <tr>
        <td class="celdaTitulo" width="42%">
        Cedula Persona </td>
        <td class="celdaTitulo" width="42%">
        Nombre Persona </td>       
        <td class="celdaTitulo" width="8%" align="center">
        Agregar      </td>
        <td class="celdaTitulo" width="8%" align="center">
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
            <?php echo($row->cedula_persona); ?>            </td>
            <td class="celdaContenido">
            <?php echo($row->nombre_persona); ?>            </td>
            <td align="center" class="celdaContenido">
            <?php
           // if($permisos['m'])
              echo anchor('presupuesto/presupuestoForm/'.$row->beca_persona_id.'/-1',
                        '<img alt="agregar" src="'.base_url().'system/application/views/imagenes/black_arrow_right.gif" border="0">');
            ?>            </td>
            <td align="center" class="celdaContenido">
            <?php
          //  if($permisos['b'])
            //  echo anchor('presupuesto/presupuestoForm/'.$row->presupuesto_id,
              //          '<img alt="Eliminar" src="'.base_url().'system/application/views/imagenes/eliminar.png" border="0">',
                //        array('onClick' => 'return confirmDelete();'));
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
          //  echo anchor('presupuesto/presupuestoForm/-1','<img alt="Agregar" src="'.base_url().'system/application/views/imagenes/agregar.png" border="0">');
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

