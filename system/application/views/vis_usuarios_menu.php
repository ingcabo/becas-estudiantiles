<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin t&iacute;tulo</title>
<script type="javascript">

    function estado(control){
        if(control.checked)
           control.value = 'f';
       else
           control.value = 't';
    }

</script>
</head>

<body>-->
<?php //echo form_open('con_acceso/menu_opciones/'.$this->vpk);?>
<script type="text/javascript">
    function chkAct(i){
        var chkVer = document.getElementById("chk_ver[" + i + "]");
        var chkInc = document.getElementById("chk_inc[" + i + "]");
        var chkMod = document.getElementById("chk_mod[" + i + "]");
        var chkBor = document.getElementById("chk_bor[" + i + "]");

        if(chkVer.checked){
            chkInc.checked = true;
            chkMod.checked = true;
            chkBor.checked = true;
        }
        else{
            chkInc.checked = false;
            chkMod.checked = false;
            chkBor.checked = false;
        }
    }
</script><style type="text/css">
<!--
body {
	background-image: url(<?php echo base_url(); ?>system/application/views/imagenes/bg2.gif);
	background-repeat: no-repeat;
	background-color: #a7d0e4;
}
-->
</style>
<table width="660" cellpadding="0" cellspacing="0" bgcolor="#E9E8E2">
  <!--DWLayoutTable-->
  <tr>
    <td width="146" height="24" align="center" valign="top" class="celda">Men&uacute; Principal </td>
    <td width="220" align="center" valign="top" class="celda">Opciones</td>
    <td width="48" align="center" valign="top" class="celda">Ver</td>
    <td width="69" align="center" valign="top" class="celda">A&ntilde;adir</td>
    <td width="67" align="center" valign="top" class="celda">Modificar</td>
    <td width="73" align="center" valign="top" class="celda">Borrar</td>
  </tr>

    <?php
     foreach($this->menuopciones as $fila){
         //echo'aja';
      echo '<tr>';
      if($fila['usm_activo'] == "f"){
        echo '<td height="22" valign="top" colspan="6" class="celda">'.$fila['usm_titulos'].'</td>';
        //echo '<input type="hidden" name="submenu['.$fila['usm_titulos'].']" value="'.$fila['usm_usuarios_menu_pk'].'" />';
      ?>
      <?php
      }else{
        echo '<td height="22" valign="top">&nbsp;</td>';
		echo '<td valign="top" class="celdaContenido">  '.$fila['usm_titulos'].'</td>';
      ?>
	        <td align="center" valign="top"><input type="checkbox" name="chk_ver[<?php echo $fila['usm_usuarios_menu_pk'];?>]" id="chk_ver[<?php echo $fila['usm_usuarios_menu_pk'];?>]" onclick="chkAct(<?php echo $fila['usm_usuarios_menu_pk'];?>)" value="t" <?php if(isset($fila['uso_ver'])){if($fila['uso_ver'] == 't'){echo 'checked';}}else{echo 'checked';}?> onclick="estado(this);"/></td>
	  <td align="center" valign="top"><input type="checkbox" name="chk_inc[<?php echo $fila['usm_usuarios_menu_pk'];?>]" id="chk_inc[<?php echo $fila['usm_usuarios_menu_pk'];?>]" value="t" <?php if(isset($fila['uso_incluir'])){if($fila['uso_incluir'] == 't'){echo 'checked';}}else{echo 'checked';}?> onclick="estado(this);"/></td>
      <td align="center" valign="top"><input type="checkbox" name="chk_mod[<?php echo $fila['usm_usuarios_menu_pk'];?>]" id="chk_mod[<?php echo $fila['usm_usuarios_menu_pk'];?>]" value="t" <?php if(isset($fila['uso_modificar'])){if($fila['uso_modificar'] == 't'){echo 'checked';}}else{echo 'checked';}?> onclick="estado(this);"/></td>
      <td align="center" valign="top"><input type="checkbox" name="chk_bor[<?php echo $fila['usm_usuarios_menu_pk'];?>]" id="chk_bor[<?php echo $fila['usm_usuarios_menu_pk'];?>]" value="t" <?php if(isset($fila['uso_borrar'])){if($fila['uso_borrar'] == 't'){echo 'checked';}}else{echo 'checked';}?> onclick="estado(this);"/></td>
      <?php
      }
      ?>
      </tr>
      <?php
     }
    ?>
  <tr>
    <td height="4"></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
</table>
<!--</form>
</body>
</html>-->
