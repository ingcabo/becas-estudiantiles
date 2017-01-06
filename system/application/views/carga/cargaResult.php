<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php $this->mod_usuario->en_session(); ?>
<html>
<head>
<title><?php echo $titulo; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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

<p align="center" class="Titulo"><?php echo $titulo; ?></p>


  <table width="634" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="4" align="left" class="celdaError">
        
        </td>
      </tr>
      <tr>
        <td colspan="4" align="left">
          <?php
          echo anchor($returnPage,'<img alt="Volver" src="'.base_url().'system/application/views/imagenes/volver.png" border="0">');
          ?>
        </td>
      </tr>
      <tr>
        <td  class="celdaTituloTabla">
        <strong>
        PROCESO FINALIZADO
        </strong>
        </td>
      </tr>
      <tr>
        <td class="<?php if($errorMsg!='') echo 'celdaError'; else echo 'celdaContenido'; ?>">
        <strong>
        <?php 
        if($errorMsg!='')
        {
          echo '<br>ERRORES EN LA EJECUCIÓN DEL PROCESO: <br><br>';
          echo $errorMsg.'<br>';
        }
        echo '<br>PARA OBTENER DETALLES DEL RESULTADO DEL PROCESO REVISE EL ARCHIVO LOG: <br>';
        echo $outputFilename.'<br><br>';
        //echo $errorMsg;
        
        ?>
        </strong>
        </td>
      </tr>
      <tr>
        <td  class="celda">
        <ul>
        <?php //foreach($upload_data as $item => $value):?>
          <li><?php //echo $item; ACORDARME DE ESTO?>: <?php //echo $value;?></li>
        <?php //endforeach; ?>
        </ul>
        </td>
     </tr>

     
  </table>
 
</body>
</html>

