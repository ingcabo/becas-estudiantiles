<?php  $this->mod_usuario->en_session(); ?>
<html>
  <head>
    <LINK REL=StyleSheet HREF="<?php echo base_url(); ?>system/application/views/estilos/lista.css" TYPE="text/css" MEDIA=screen>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <script type="text/javascript" src="<?php echo base_url(); ?>system/application/views/javascript/validacion.js"></script>
     <title>Histórico de Acciones a Beneficiarios</title>
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


   <IMG src="<?php echo base_url(); ?>system/application/views/imagenes/header.png" >

   
    <?php $colSpanFullLine=7; ?>
    <?php $editRecord='accionBeneficiario/accionBeneficiarioForm'; ?>
    <?php $listRecord='accionBeneficiario/accionBeneficiarioControl'; ?>
    <?php $deleteRecord='accionBeneficiario/accionBeneficiarioDelete'; ?>
    
    <br>
    <?php echo form_open($listRecord); ?>
    <input type="hidden" id="bandPost" name="bandPost" value="1">
   

    <p align="center" class="Titulo">Histórico de Acciones a Beneficiarios</p>
    <table width="736px" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">

      <tr>
        <td colspan="<?php echo $colSpanFullLine?>">
        
        <select name="cmbCampo" id="cmbCampo" style="width:200px">
          <option></option>
          <option value="nombre_accion" <?php if($campo=="nombre_accion") echo 'selected';?> >Accion</option>
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
          ?>        </td>
      </tr>
      
      <tr>
        <td colspan="<?php echo $colSpanFullLine?>" align="left" class="celdaTituloTabla">
          <?php
          echo('Beneficiario:  '.$tipoCedulaPersona.'-'.$cedulaPersona.',  '.$nombrePersona.' '.$apellidoPersona);
          ?>        </td>
      </tr>
      <tr>
        <td colspan="<?php echo $colSpanFullLine?>" align="left" height="10">        </td>
      </tr>
      <tr>
        <td class="celdaTitulo" width="10%">
        Periodo        </td>
        <td class="celdaTitulo" width="15%">
        Fecha        </td>
        <td class="celdaTitulo" width="20%">
        Acción        </td>
        <td class="celdaTitulo" width="55%">
        Justificación        </td>
        
      <?php
      if($result->num_rows()!=0)
      {
        foreach($result->result() as $row)
        {
      ?>
      <tr>
            <td class="celdaContenido" width="10%">
            <?php echo($row->ano_periodo.'-'.$row->parcial_periodo);?>            </td>
            <td class="celdaContenido" width="15%">
           <?php echo($this->jelgeneral->arreglarFechaBD($row->fecha_accion)); ?>            </td>
            <td class="celdaContenido" width="20%">
            <?php echo($row->nombre_accion); ?>            </td>
            <td class="celdaContenido" width="55%">
            <?php echo($row->razon_accion); ?>            </td>
      </tr>
      <?php
        }
      }
      ?>
      <tr>
        <td colspan="<?php echo $colSpanFullLine?>" align="center" class="celdaTitulo">&nbsp;        </td>
      </tr>
      
      <tr>
        <td colspan="<?php echo $colSpanFullLine?>" align="center" class="celdaTitulo">
          <?php echo($pages); ?>        </td>
      </tr>
  </table>
    </form>
</body>
</html>

