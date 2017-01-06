<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Detalle Persona</title>
<link href="<?php echo base_url(); ?>system/application/views/operaciones/style_form.css" rel="stylesheet" type="text/css" />
</head>

<body>

<h2 align="center"><strong>Datos de Personas</strong></h2>
<?php echo form_open('sorte/personaRecord'); ?>


 

 
 
  <table width="736px" border="0" align="center" cellpadding="0" cellspacing="2">
      <tr>
        <td colspan="2" align="left" class="celdaError">
        <label>&nbsp;</label>
        </td>
      </tr>
      <tr>
        <td colspan="2" align="left">
          <?php

           // echo anchor('sorteo/Control','<img alt="Volver" src="'.base_url().'system/application/views/imagenes/volver.png" border="0">');
          ?>


        </td>
      </tr>
  </table>

<table width="736px" border="0" align="center" cellpadding="0" cellspacing="2">
  <tr>
    <td  class="celda" width="20%">
      <strong>
      Cédula      </strong>    </td>
    <td  class="celda" width="15%">
      <strong>
      Sexo      </strong>    </td>
    <td  class="celda" width="27%">
      <strong>
      Nacionalidad      </strong>    </td>
    <td  class="celda" width="38%">
      <strong>
      Correo Electrónico      </strong>    </td>
  </tr>
  <tr>
    <td valign="center"><label><?php echo $tipo_nacionalidad.'-'.$cedula; ?></label></td>
    <td width="15%"><label><?php echo $sexo; ?></label></td>
    <td width="27%">
        <label><?php echo $nacionalidad; ?></label>    </td>
    <td width="38%">
      <label><?php echo $correo; ?></label>   </td>
  </tr>
</table>

<table width="736px" border="0" align="center" cellpadding="0" cellspacing="2">
      <tr>
      <td  class="celda" width="35%">
      <strong>
      Nombres      </strong>      </td>
      <td  class="celda" width="27%">
      <strong>
      Apellidos      </strong>      </td>
      <td  class="celda" width="38%">
      <strong>
      Fecha Nac.      </strong>      </td>
      </tr>
      <tr>
      <td valign="center">
       <label><?php echo $nombre; ?></label>
      </td>
      <td>
        <label><?php echo $apellido; ?></label>
      </td>
      <td>
       <label><?php echo $f_nacimiento; ?></label>
      </td>
      </tr>
</table>
<table width="736px" border="0" align="center" cellpadding="0" cellspacing="2">
      <tr>
      <td width="258"  class="celda">
      <strong>
      País de Habitación      </strong>      </td>
      <td width="478"  class="celda">
      <strong>
      Estado de Habitación      </strong>      </td>
      </tr>
      <tr>
      <td>
       <label><?php echo $pais; ?></label>
      </td>

      <td>
      <label><?php echo $estado; ?></label>
      </td>
      </tr>

      <tr>
      <td  class="celda">
      <strong>
      Municipio de Habitación
      </strong>
      </td>
      <td  class="celda">
      <strong>
      Parroquia de Habitación
      </strong>
      </td>
      </tr>
      <tr>
      <td>
      <label><?php echo $municipio; ?></label>
      </td>
      <td>
      <label><?php echo $parroquia; ?></label>
      </td>
      </tr>

      <tr>
      <td  class="celda" colspan="2">
      <strong>
      Dirección de Habitación
      </strong>
      </td>
      </tr>
      <tr>
      <td colspan="2">
        <label><?php echo $direccion01; ?></label>
      </td>
      </tr>
      <tr>
      <td  class="celda" colspan="2">
      <strong>
      Dirección Alternativa
      </strong>
      </td>
      </tr>
      <tr>
      <td colspan="2">
       <label><?php echo $direccion02; ?></label>
      </td>
      </tr>

      <tr>
      <td  class="celda">
      <strong>
      Teléfono Habitación
      </strong>
      </td>
      <td  class="celda">
      <strong>
      Teléfono Celular

      </strong>
      </td>
      </tr>
      <tr>
      <td valign="center">
        <label><?php echo $telefono01; ?></label></td>
      <td>
       <label><?php echo $telefono02; ?></label>
      </td>
      </tr>
      <tr>
      <td  class="celda">
      <strong>
      Teléfono Alternativo
      </strong>
      </td>
      <td  class="celda">
      <strong>
      Teléfono Alternativo
      </strong>
      </td>
      </tr>
      <tr>
      <td valign="center">
        <label><?php echo $telefono03; ?></label>
      </td>
      <td>
        <label><?php echo $telefono04; ?></label>
      </td>
      </tr>
</table>

  <table width="736px" border="0" align="center" cellpadding="0" cellspacing="2">
      <tr>
      <td  class="celda" width="30%">
      <strong>
      Representante
      </strong>
      </td>
      <td  class="celda" width="25%">
      <strong>
      Banco
      </strong>
      </td>
      <td  class="celda" width="20%">
      <strong>
      Tipo de Cuenta
      </strong>
      </td>
      <td  class="celda" width="25%">
      <strong>
      Número de Cuenta
      </strong>
      </td>
      </tr>
      <tr>
      <td valign="center">
        <label><?php echo $representante; ?></label>
      </td>
      <td>
   <label><?php echo $banco; ?></label>
      </td>
      <td>
       <label><?php echo $cuenta; ?></label>
      </td>
      <td>
        <label><?php echo $n_cuenta; ?></label>
      </td>
      </tr>
  </table>
  <table width="736px" border="0" align="center" cellpadding="0" cellspacing="2">
      <tr>
      <td colspan="6"  align="center">
      <label><strong> CARTA POSTULACIÓN</strong></label>      </td>
      </tr>
	  <tr>
	  
	  <td width="141" class="celda" ><strong>Codigo Carta</strong></td>
	  <td width="142" class="celda" ><strong>Ubicacion</strong></td>
	  <td width="201" class="celda" ><strong>Fecha Carta Postulacion</strong> </td>
	  <td width="187" class="celda" ><strong>Referencia Carta</strong> </td>
	  <td width="53">Modificar</td>
	  <td>Eliminar</td>
	  </tr>
	    <tr>
	  <div id="postula"  style="size:100; width:auto; "  align="center">
	  <td><?php  if(isset($codigoc)){echo $codigoc;}else{echo '*';}; ?></td>
	  <td><?php echo $ubicacionc; ?></td>
	  <td><?php echo $fecha; ?></td>
	  <td><?php echo $referencia; ?></td>
	  
	  <td><?php
            echo anchor('sorteo/cartaForm/'.$carta_postulacion_id,
                        '<img alt="Modificar" src="'.base_url().'system/application/views/imagenes/modificar.png" border="0">');
            ?>          </td>
	    <td>
		<?php
            echo anchor('sorteo/cartaDelete/'.$carta_postulacion_id,
                        '<img alt="Eliminar" src="'.base_url().'system/application/views/imagenes/Eliminar.png" border="0">');
            ?>
		
		</td>
		
	  
	 
	  </div>
	  
	  </tr>
  </table>

<p>&nbsp;</p>
   <p>&nbsp;</p>
   <p>

     </form>
     
     
     
     
</p>
</body>
</html>
