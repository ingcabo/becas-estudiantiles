<?php  $this->mod_usuario->en_session(); ?>
<html>
  <head>
    <LINK REL=StyleSheet HREF="<?php echo base_url(); ?>system/application/views/estilos/lista.css" TYPE="text/css" MEDIA=screen>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <script type="text/javascript" src="<?php echo base_url(); ?>system/application/views/javascript/validacion.js"></script>
     <title>Control de Acciones a Beneficiarios</title>
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
    <?php $colSpanFullLine=7; ?>
    <?php $editRecord='accionBeneficiario/accionBeneficiarioForm'; ?>
    <?php $listRecord='accionBeneficiario/accionBeneficiarioControl'; ?>
    <?php $deleteRecord='accionBeneficiario/accionBeneficiarioDelete'; ?>
    
    <br>
    <?php echo form_open($listRecord); ?>
    <input type="hidden" id="bandPost" name="bandPost" value="1">
   

    <p align="center" class="Titulo">Control de Acciones a Beneficiarios</p>
    <table width="736px" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">

      <tr>
        <td colspan="<?php echo $colSpanFullLine?>">
        
        <select name="cmbCampo" id="cmbCampo" style="width:200px">
          <option></option>
          <option value="nombre_persona" <?php if($campo=="nombre_persona") echo 'selected';?> >Nombre de la Persona</option>
          <option value="apellido_persona" <?php if($campo=="apellido_persona") echo 'selected';?> >Apellidos de la Persona</option>
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
        <td colspan="<?php echo $colSpanFullLine?>" align="center" >
          <?php echo($pages);

          //echo '<script>  alert(\''.$pages.'\');  </script>';
          ?>        </td>
      </tr>
      
      <tr>
        <td colspan="<?php echo $colSpanFullLine?>" align="right">
          <?php
          //echo anchor($editRecord.'/-1','<img alt="Agregar" src="'.base_url().'system/application/views/imagenes/agregar.png" border="0">');
          ?>        </td>
      </tr>

      <tr>
        <td class="celdaTitulo" width="25%">
        Nombre        </td>
        <td class="celdaTitulo" width="12%">
        Cédula        </td>
        <td class="celdaTitulo" width="16%">
        Tipo Beca        </td>
        <td class="celdaTitulo" width="18%">
        Beca        </td>
        <td class="celdaTitulo" width="11%">
        Estado        </td>
        <td class="celdaTitulo" width="10%">
        Fecha Ingreso        </td>
        <td class="celdaTitulo" width="8%" align="center">
        Modificar        </td>
      </tr>
      <?php
      if($result->num_rows()!=0)
      {
        foreach($result->result() as $row)
        {
      ?>
          <tr>
            <td class="celdaContenido" width="25%">
            <?php echo($row->apellido_persona.' '.$row->nombre_persona);?>
            </td>
            <td class="celdaContenido" width="12%">
           <?php echo($row->tipo_cedula_persona.'-'.$row->cedula_persona); ?>
           </td>
            <td class="celdaContenido" width="16%">
            <?php echo($row->nombre_tipo_beca); ?>
            </td>
            <td class="celdaContenido" width="18%">
            <?php echo($row->nombre_beca); ?>
            </td>
            <td class="celdaContenido" width="11%">
            <?php echo($row->nombre_estado_persona); ?>
            </td>
            <td class="celdaContenido" width="10%">
            <?php echo($this->jelgeneral->arreglarFechaBD($row->fecha_ingreso)); ?>
            </td>
            <td align="center" class="celdaContenido">
            <?php
            if($permisos['m'])
              echo anchor($editRecord.'/'.$row->beca_persona_id,
                        '<img alt="Modificar" src="'.base_url().'system/application/views/imagenes/modificar.png" border="0">');
            ?>
            </td>
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
          //echo anchor($editRecord.'/-1','<img alt="Agregar" src="'.base_url().'system/application/views/imagenes/agregar.png" border="0">');
          ?>
        </td>
      </tr>
      <tr>
        <td colspan="<?php echo $colSpanFullLine?>" align="center" class="celdaTitulo">
          <?php echo($pages); ?>
        </td>
      </tr>
  </table>
    </form>
</body>
</html>

