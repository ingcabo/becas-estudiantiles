<html>
  <head>
    <LINK REL=StyleSheet HREF="<?php echo base_url(); ?>system/application/views/estilos/lista.css" TYPE="text/css" MEDIA=screen>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <script type="text/javascript" src="<?php echo base_url(); ?>system/application/views/javascript/validacion.js"></script>
     <title>Requisito</title>
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
    <?php $colSpanFullLine=5; ?>
    
    <br>
    <?php echo form_open('requisito/requisitoControl'); ?>
    <input type="hidden" id="bandPost" name="bandPost" value="1">
   

    <p align="center" class="Titulo">Control de Requisitos</p>
   
	
	
	 <table width="736px" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
       <tr>
         <td width="703" colspan="<?php echo $colSpanFullLine; ?>"><select name="cmbCampo" id="cmbCampo" style="width:200px">
             <option></option>
             <option value="nombre_requisito" <?php if($campo=="nombre_requisito") echo 'selected';?> >Nombre Requisito</option>
			  <option value="nombre_accion" <?php if($campo=="nombre_accion") echo 'selected';?> >Nombre Acción</option>
			
			  
			  
           </select>
             <select name="cmbCriterio" id="cmbCriterio" style="width:138px">
               <option></option>
               <option <?php if($criterio=="Contenga") echo 'selected';?> >Contenga</option>
               <option <?php if($criterio=="Sea Igual a") echo 'selected';?> >Sea Igual a</option>
             </select>
             <input type="text" name="txtValor" id="txtValor" style="width:310px;" value="<?php echo $valor;?>">
             <input name="submit" type="submit" value="Filtra">
          
         </td>
       </tr>
       <tr>
         <td align="right"><?php
         if($permisos['i'])
           echo anchor('requisito/requisitoForm/-1','<img alt="Agregar" src="'.base_url().'system/application/views/imagenes/agregar.png" border="0">');
          ?></td>
        
       </tr>
</table>
  <table width="736px" border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">

    
   
    <tr>
      <td colspan="<?php echo $colSpanFullLine; ?>" align="center" class="celdaTitulo">
        <?php echo($pages);

       
          ?>      </td>
    </tr>
    

    <tr>
	
      <td class="celdaTitulo" width="38%">
      Nombre del Requisito</td>
	  <td width="26%" class="celdaTitulo">Acción</td>
	  <td width="20%" class="celdaTitulo">Perfil</td>
    
      <td class="celdaTitulo" width="9%" align="center">
        Modificar      </td>
      <td class="celdaTitulo" width="7%" align="center">
        Eliminar      </td>
    </tr>
    <?php
      if($result->num_rows()!=0)
      {
        foreach($result->result() as $row)
        {
      ?>
        <tr>
          <td class="celdaContenido">
            <?php echo($row->nombre_requisito); ?>          </td>
		  <td class="celdaContenido"><?php echo($row->nombre_accion); ?></td>
			<td class="celdaContenido">
            <?php if($row->obligatorio_requisito =='1'){echo 'Obligatorio'; }else{echo 'No Obligatorio';} ?>          </td>
         
          <td align="center" class="celdaContenido">
            <?php
            if($permisos['m'])
              echo anchor('requisito/requisitoForm/'.$row->requisito_id,
                        '<img alt="Modificar" src="'.base_url().'system/application/views/imagenes/modificar.png" border="0">');
            ?>          </td>
          <td align="center" class="celdaContenido">
            <?php
            if($permisos['b'])
              echo anchor('requisito/del_requisito/'.$row->requisito_id,
                        '<img alt="Eliminar" src="'.base_url().'system/application/views/imagenes/eliminar.png" border="0">',
                        array('onClick' => 'return confirmDelete();'));
            ?>          </td>
        </tr>
    <?php
        }
      }
      ?>
    <tr>
      <td colspan="<?php echo $colSpanFullLine; ?>" align="center" class="celdaTitulo">&nbsp;    </td>
    </tr>
    <tr>
      <td colspan="<?php echo $colSpanFullLine; ?>" align="right">
        <?php
            echo anchor('requisito/requisitoForm/-1','<img alt="Agregar" src="'.base_url().'system/application/views/imagenes/agregar.png" border="0">');
          ?>      </td>
    </tr>
    <tr>
      <td colspan="<?php echo $colSpanFullLine; ?>" align="center" class="celdaTitulo">
        <?php echo($pages); ?>      </td>
    </tr>
</table>
    </form>
</body>
</html>
