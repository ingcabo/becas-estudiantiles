<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php  $this->mod_usuario->en_session(); ?>
<html>
<head>
<LINK REL=StyleSheet HREF="<?php echo base_url(); ?>system/application/views/estilos/lista.css" TYPE="text/css" MEDIA=screen>
<title>Sistema JEL</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> <!--iso-8859-1 -->

<style type="text/css">
<!--
body {
	background-image: url(<?php echo base_url(); ?>system/application/views/imagenes/bg2.gif);
	background-repeat: no-repeat;
	background-color: #a7d0e4;
}
}
-->
</style></head>
<body>
  <?php echo $menu; ?>
  <table align="center">
    <tr>
    <td width="950" align="center" height="500" valign="top" class="titulo"><br>Bienvenidos
    <div id="div_result">
      <?php echo $contenido; ?>
    </div>
    </td>
    </tr>
  </table>
  
</body>
</html>