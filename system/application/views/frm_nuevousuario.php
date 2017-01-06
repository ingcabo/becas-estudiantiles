<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- INICIO DE COPIA !-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>My Form</title>
<link rel="stylesheet" href="<?php  echo base_url(); ?>system/application/css/mainstyle2.css" type="text/css" />
<link rel="stylesheet" href="<?php  echo base_url(); ?>system/application/SNC.css" type="text/css">

<script type="text/javascript" src="<?php  echo base_url(); ?>system/application/js/general.js"></script>

<script type="text/javascript" src="<?php  echo base_url(); ?>system/application/menu/stmenu.js"></script>

<script type="text/javascript">
<!--
window.onerror=function(m,u,l)
{
	window.status = "Java Script Error: "+m;
	return true;
}

</script>

</head>

<body bgcolor="#FFFFFF" text="#000000" link="#0066FF" vlink="#9933FF" alink="#FF3333">



<div class="bodywrap">
<div class="bodyinfo">
<div class="headerbox">
<div align="center"><?php echo $this->validation->error_string; ?>
  
    <?php echo form_open('cnuevousuario'); ?>
  
</div>
<h5 align="center">&nbsp;</h5>
<div align="center" class="celdaContenido">Username:
  <input type="text" name="username" value="" size="50" />
  
</div>
<h5 align="center">&nbsp;</h5>

  <div align="center" class="celdaContenido">Password:
    <input type="text" name="password" value="" size="50" />
    
  </div>
  <h5 align="center">&nbsp;</h5>
  <div align="center" class="celdaContenido">Password Confirm:
    <input type="text" name="passconf" value="" size="50" />
    
  </div>
  <h5 align="center">&nbsp;</h5>
  <div align="center" class="celdaContenido">Email Address:
    <input type="text" name="email" value="" size="50" />
    
  </div>
  <div>
    <div align="center">
      <input type="submit" value="Submit" />
    </div>
  </div>

  <div align="center">
    </form>
  </div>
  <div class="corner1"> </div>
<div class="corner2"> </div>
<div class="corner3"> </div>
<div class="corner4"> </div>
</div>
</div>

</div>


<div class="bgfooter"> <div class="footerimage"> </div></div>
</body>
</html>
