<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
* Generador de menus dinamicos
*
*
*/
class Get_menu
{
    function Get_menu()
    {
        $this->obj =& get_instance();
        $this->setVars();
    }
    function setVars()
    {
        $this->result = '';
    }
    /*funcion encargada de devolver el HTML listo para ser puesto en la pagina*/
    function MakeMenu()
    {
         $menuarr = $this->QryMenu(0);/* el parametro inicial es el numero en el parent_id de los padres */
         $data= $this->PintaMenu($menuarr);
       #  $js  ='';
        $js  ='<script type="text/javascript">';
         $js .= 'var listMenu = new FSMenu(\'listMenu\', true, \'visibility\', \'visible\', \'hidden\');';
         $js .= 'listMenu.cssLitClass = \'highlighted\';';
         $js .= 'listMenu.animations[listMenu.animations.length] = animFade;';
         $js .= 'listMenu.animations[listMenu.animations.length] = animClipDown;';
         $js .= 'listMenu.animSpeed = 10;';
         $js .= 'var arrow = null;';
         $js .= 'if (document.createElement && document.documentElement)';
         $js .= '{';
         $js .= 'arrow = document.createElement(\'span\');';
         $js .= 'arrow.appendChild(document.createTextNode(\'»\'));';
         $js .= 'arrow.className = \'subind\';';
         $js .= '}';
         $js .= 'listMenu.activateMenu("listMenuRoot", arrow)';
         $js .= '</script>';
         return $data.$js;
    }

    #Trae los datos de la base de datos y devuelve un array
    function QryMenu( $parent_id = 0 , $prefix = '-')
  
    {

        #Consulta los menus y submenus
      $sql = "SELECT * FROM ci_menu WHERE parent_id = {$parent_id} Order by orderfield, parent_id";
      $query = $this->obj->db->query($sql);
        #Devuelve el resultado  en forma de arreglo y se lo lleva a la variable $resultset
      $resultset = $query->result_array();
       # print_r($resultset);




        foreach($resultset as $index => $valor)
        {
            #Trae los submenus para el menu actual de forma recursiva
           $submenuArray = $this->QryMenu($valor['id']);
            #si la variable devuelve datos, crea un sub-arreglo, en tro caso lleva vacio al arreglo submenu
            if (false === empty($submenuArray))
            {
                $resultset[$index]['submenu'] = $submenuArray;
            }
            else
            {
                $resultset[$index]['submenu'] = array ();
            }
        }

            
         #Devuelve el resultado final
         return $resultset;

    }

    function PintaMenu($arryMenu)
    {
        #Se recorre todo el arreglo en esta funcion se crean los menus superiores y si este tiene hijos llama la funcion makeSubMenu pa;' crear los que despliegan...
        foreach ($arryMenu as $index => $value )
        {
            // Se crean los <li> el vinculo (href) esta en el campo "extra" de la tabla de categorias. y el nombre en el campo...  "nombre".
            $this->result .= "<li class=\"sbcMenu\" id=\"menu0\"> <a href='$value[link]' title='$value[text]' target='$value[target]' class='linkpadre'>$value[text]</a>";
            if ( false === empty($value['submenu']) )
            {
                // Si tiene hijos (sub menu) se llama la funcion makeSubMenu como parametro se envia en sub alrreglo con los hijos.
                $this->PintaSubMenu($value['submenu']);
            }
            else
            {
                $this->result .= '</li>';
            }
            $this->result .= '<li class=\"separador\"> </li>';
        }
        $this->result .= '</ul>';

        // Todo se concatena en la variable $this->result.
      # print_r ($this->result);
  
        return '<ul class="menulist" id="listMenuRoot">'.$this->result.'';
    }


    function PintaSubMenu ($arryMenu)
    {
        $this->result .= '<ul>';
        // Se recorre y se crean tantos <ul> y <li> como se tengan en el arreglo...
        
        foreach ($arryMenu as $index => $value )
        {
            
            $this->result .= "<li  class = 'cssHijo' id=\"submenu\"> <a href='$value[link]' title='$value[text]' target='$value[target]'>$value[text]</a>";
            if ( false === empty($value['submenu']) )
            {
                // Si este tiene hijo se llama asi mismo para colocar hijos en los hijos.
                $this->PintaSubMenu($value['submenu']);
               
            }
            $this->result .= '</li>';
             
        }
        $this->result .= '</ul>';
        

         return $result;
        print_r ($this->result)."hola";
        print_r ("hols");
    }


}

?>
