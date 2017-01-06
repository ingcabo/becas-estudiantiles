
<?php $this->mod_usuario->en_session(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!--<META HTTP-EQUIV="Refresh" CONTENT="3;URL=<?php // echo base_url(); ?>Reportes/sorteos.xls">-->

<title><?php // print_r($_POST); ?></title>
<LINK REL=StyleSheet HREF="<?php echo base_url(); ?>system/application/views/estilos/lista.css" TYPE="text/css" MEDIA=screen>

<?php
/*
function descargar($sorteos){

$elArchivo = 'sorteo.xls';

header( "Content-Type: application/octet-stream");
header( "Content-Length: ".filesize($so_mp3));
header( "Content-Disposition: attachment; filename=".$elArchivo."");
readfile($sorteos);
}
descargar($sorteos);
*/
?> 
</head>
<body>
<?php echo $menu; ?>
<br />
<br />
<br />
<p>
<table width="300px" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
<td></td>
<td align="center"><A HREF="http://portatil-01/JEL/Reportes/<?php echo $archivo; ?>" target="_blank"><img alt="Descargar <?php echo $rept; ?>" src="<?php echo base_url(); ?>system/application/views/imagenes/descargar.jpg" border="0"></A></td>
<td>&nbsp;</td>
</tr>
<!--http://portatil-01/JEL//Reportes/sorteos.xls -->
<tr>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
</table>
<?php// print_r($_POST); ?>

</body>
</html>
