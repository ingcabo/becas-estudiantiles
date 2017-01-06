<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <LINK REL=StyleSheet HREF="<?php echo base_url(); ?>system/application/views/estilos/lista.css" TYPE="text/css" MEDIA=screen>
        <style type="text/css">
        <!--
        .Titulo {color:<?php $strColor ?>; font-family: Arial, Helvetica, sans-serif; font-size: 30px; }
        -->
        </style>
        <title>Mensaje</title>
    </head>
    <body>
    <?php
	 
	   
	 if (!isset($this->personaModel->nombre_tabla))
	 	 { 
		 $this->personaModel->nombre_tabla= 'no';
	     }else{
	 
	     }
	 
	             if ($this->personaModel->nombre_tabla == 'sorteo_persona'){
	 
	             }else{
	
                  echo $menu;
        
		          }
		
		?>
     <br><br><br><br>
     <table width="736px" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td class="Titulo" align="center">
        <?php
        echo $mensaje;
        ?>
        </td>
      </tr>
      <tr>
        <td class="Titulo" align="center">&nbsp;
        
        </td>
      </tr>
      <tr>
        <td align="center">
        <?php
        echo anchor($destino,'<img alt="Volver" src="'.base_url().'system/application/views/imagenes/volver.png" border="0">');
        ?>
        </td>
      </tr>
    </table>
        
        

    </body>
</html>
