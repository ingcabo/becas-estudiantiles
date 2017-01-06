<?php $this->mod_usuario->en_session(); ?>
<html>
<head>
<title>Buscar Contacto</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="text/css">
<!--

a{text-decoration:none}

.f {
	background-image: url(../../imagenes/fondocentral1.jpg);
	background-repeat: no-repeat;
}

.Titulo {color: #003399; font-family: Arial, Helvetica, sans-serif; font-size: 30px;}
-->
</style>
<script language="javascript">
<!-- 		Java Script
	function recargar()
	{
		document.filtro.submit();
	}

	function jumpMenu()
	{
		var selObj = document.frmSup.paginacion;
		document.frmSup.pagina.value=selObj.options[selObj.selectedIndex].value;
		document.frmSup.submit();
	}

	function marcar_buscar()
	{
		document.frmSup.buscar.value=1;
	}

	function evento_enter(evt)
	{
	evt = (evt) ? evt : event
	var charCode = (evt.which) ? evt.which : evt.keyCode
		if(charCode==13)
		{
			marcar_buscar();
			document.frmSup.submit();
		}
	}

	function ampliar()
	{
		resizeTo(screen.width, screen.height)
		moveTo(0, 0);
	}

	window.document.onkeypress=evento_enter;
//-->
</script>
</head>
<body class="f" onLoad="ampliar();">
<?php

//codigo para pagina;

$TAMANO_PAGINA = 40;

if(isset($_POST['pagina'])){
$pagina = $_POST['pagina'];
}

if(isset($_GET["pagina"])){
$pagina = $_GET["pagina"];
}

if(isset($_POST['buscar'])){
	$buscar = $_POST['buscar'];
	if($buscar==1){
	$pagina=NULL;
	}
}

if (!$pagina) {
    $inicio = 0;
    $pagina=1;
}
else {
    $inicio = ($pagina - 1) * $TAMANO_PAGINA;
}

include("../Funciones/FuncionesGenerales.php") ;

$conexion_bd=Conectar($_SESSION["nombre_usuario"],$_SESSION["clave_usuario"]);

	// PAGINACION POR GET
	if (isset($_GET['datos'])){$datos=$_GET['datos'];}
	if (isset($_GET['condiciones'])){$condiciones=$_GET['condiciones'];}
	if (isset($_GET['cadena'])){$cadena=$_GET['cadena'];}

	// PAGINACION POR POST
	if (isset($_POST['datos'])){$datos=$_POST['datos'];}
	if (isset($_POST['condiciones'])){$condiciones=$_POST['condiciones'];}
	if (isset($_POST['txtopcion'])){$cadena=$_POST['txtopcion'];}

//se calcula el numero total de registro para calcular la paginacion
if ($cadena<>""){
	$strsql="SELECT persona_id, nombre_persona, apellido_persona, cedula_persona FROM persona";

	$strsql=filtrado($datos,$condiciones,$cadena,$strsql);

	$result=sql_ejecutar($conexion_bd,$strsql);

	$num_total_registros = pg_num_rows($result);

	$total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);

	$strsql="SELECT persona_id, nombre_persona, apellido_persona, cedula_persona FROM persona";

	$strsql=filtrado($datos,$condiciones,$cadena,$strsql);

	$strsql="$strsql ORDER BY nombre_persona, apellido_persona LIMIT $TAMANO_PAGINA  OFFSET $inicio";

	$result=sql_ejecutar($conexion_bd,$strsql);

	$x=0;
}
else{
	$strsql="SELECT persona_id, nombre_persona, apellido_persona, cedula_persona FROM persona ORDER BY nombre_persona, apellido_persona";

	$result=sql_ejecutar($conexion_bd,$strsql);

	$num_total_registros = pg_num_rows($result);

	$total_paginas = ceil($num_total_registros / $TAMANO_PAGINA);

	$strsql="SELECT persona_id, nombre_persona, apellido_persona, cedula_persona FROM persona ORDER BY nombre_persona, apellido_persona LIMIT $TAMANO_PAGINA  OFFSET $inicio";

	$result=sql_ejecutar($conexion_bd,$strsql);

	$x=0;
}
?>
<form action="buscar_infra.php" method="post" name="frmSup" target="_self" id="frmSup">
<input type="hidden" name="pagina" id="pagina" value="<?php echo $pagina;?>">
<div align="center"></div>
<div align="center" class="Titulo">Supervisores</div>
<p align="center">
<table width="950px" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td bgcolor="#FFFFFF"> <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="250" height="39">
        <param name="movie" value="../Imagenes/infra.swf">
        <param name="quality" value="high">
        <embed src="../Imagenes/infra.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="250" height="39"></embed></object></td>
  </tr>
  <tr>
    <td height="91" bgcolor="#cccccc">
        <p align="center">
          <select name="datos" id="datos">
            <option value="nombre_persona" <?php if($datos=="nombre_persona") echo 'selected';?>>Nombre</option>
            <option value="apellido_persona" <?php if($datos=="telefono_persona") echo 'selected';?>>Teléfono</option>
            <option value="cedula_persona" <?php if($datos=="cedula_persona") echo 'selected';?>>Cédula</option>
            
          </select>
          <select name="condiciones" id="condiciones">
            <option <?php if($condiciones=="Contenga") echo 'selected';?>>Contenga</option>
            <option <?php if($condiciones=="Sea Igual a") echo 'selected';?>>Sea Igual a</option>
          </select>
          <input name="txtopcion" type="text" id="txtopcion" size="80" maxlength="2000" value="<?php echo $cadena;?>" onClick="marcar_buscar();">
          <input name="btnFiltrar" type="submit" id="btnFiltrar" value="Filtrar">
        </p>
      </td>
  </tr>
</table>
<table width="950px" border="1" cellpadding="0" cellspacing="0" bordercolor="#666666">
  <tr bordercolor="#999999">
    <td width="48%" height="24" bgcolor="#cccccc"> <div align="center"><strong><font size="4" face="Eras Light ITC">
	Nombre
	</font></strong></div></td>
    <td width="20%" bgcolor="#cccccc"><div align="center"><strong><font size="4" face="Eras Light ITC">
	Cédula
	</font></strong></div></td>
    <td width="20%" bgcolor="#cccccc"><div align="center"><strong><font size="4" face="Eras Light ITC">
	Teléfono
	</font></strong></div></td>
    <td width="12%" bordercolor="#999999" bgcolor="#cccccc"><p align="center"><a href="buscar_datainfra.php?Tipo_Trans=1" target="_self"><img src="../Imagenes/agregar1.jpg" width="70" height="23" border="0"></a></p></td>
  </tr>
  <?php
  //operaciones para paginaciones
  $num_fila = 0;
  $in=1+(($pagina-1)*5);

  //ciclo para mostrar los datos
  while ($row = pg_fetch_row($result))
  {
  ?>
  <tr bordercolor="#999999">
    <td bgcolor="#ededed"><div align="center"><font size="2" face="Geneva, Arial, Helvetica, sans-serif">
      <?php echo validar_vacio($row[1]);?>
        </font></div></td>
    <td bgcolor="#ededed"><div align="center"><font size="2" face="Geneva, Arial, Helvetica, sans-serif">
      <?php echo validar_vacio($row[2]);?>
        </font></div></td>
    <td bgcolor="#ededed"><div align="center"><font size="2" face="Geneva, Arial, Helvetica, sans-serif">
      <?php echo validar_vacio($row[3]);?>
        </font></div></td>
	<td bgcolor="#cccccc"><div align="center">
	  <input type="button" name="Submit" value="Seleccionar" onClick="
	  window.opener.document.getElementById('txtPersonaId').value = '<?php echo $row[0];?>';
	  window.opener.document.getElementById('txtPersona').value = '<?php echo $row[1];?>';
	  window.opener.focus();
	  window.close();">
	</div></td>
  </tr>
  <?php

  }//fin del ciclo while
  //operaciones de paginacion
  $num_fila++;
  $in++;
  		if($cadena <> ""){$txtopcion = $cadena;}
  ?>
</table>
<table width="950px" border="0" cellpadding="0">
  <tr>
    <td><div align="right"><font size="2" face="Geneva, Arial, Helvetica, sans-serif"><strong>

	<?php
	if($pagina<> 1 and $pagina > 0){
	echo '<a href="buscarContacto.php?pagina='.($pagina-1).'&cadena='.$txtopcion.'&condiciones='.$condiciones.'&datos='.$datos.'" style="display:compact"><< Anterior </a>';
	}
	if ($pagina<>$total_paginas AND $total_paginas > 0){
	echo '<a href="buscarContacto.php?pagina='.($pagina+1).'&cadena='.$txtopcion.'&condiciones='.$condiciones.'&datos='.$datos.'" style="display:compact"> Siguiente >></a>';
	}
	?>
	</strong></font></div></td>
  </tr>
  <tr>
    <td><div align="right"><font size="2" face="Geneva, Arial, Helvetica, sans-serif">
      <?php desconectar($conexion_bd);
//operaciones de paginacion
if ($total_paginas > 1){
echo '<strong>ir a:</strong>';
?>
      <select name="paginacion" id="paginacion" onChange="jumpMenu()">
        <?php
      for ($i=1;$i<=$total_paginas;$i++)
	{
  ?>
        <option value="<?php echo $i;?>" <?php if($i==$pagina) echo 'selected';?>>Página <?php echo $i;?></option>
        <?php
	}
?>
      </select>
<?php
echo '<strong>de '.$total_paginas.'</strong>';
}
?>
    </font></div></td>
  </tr>
</table>
<input type="hidden" name="buscar" id="buscar">
<input type="hidden" name="numero_registros" id="numero_registros" value="<?php echo $num_total_registros;?>">
<?php
if($buscar==1 and $num_total_registros== 0){
echo '<script language="javascript">';
echo 'alert("No se han encontrado registros en su busqueda");';
echo '</script>';
}
?>
</form>
</body>
</html>