<?php
/**
 * Description of con_demenu
 *
 * @author Ricardo Camejo
 * @version 0.1
 * @copyright Ingenieria, Datos y Tecnologia, C.A 2009
 * @property Con_menu
 *
 */
class Mod_demenu extends Model{
   

    var $esquema,$tbl_usuarios,$menu_opciones;
    var $menu = array();

    function Mod_demenu(){
        parent::Model();
        $this->esquema      = 'sistema';
        $this->tbl_usuarios = 'usuarios';
        $this->tbl_usuarios = 'usuarios_menu';
        $this->load->helper('url');
    }


    function header_menu(){
        $header = '<div class="mmenu">'."\n";
        $header .= '<ul id="qm0" class="qmmc">'."\n";
        return $header;
    }

    function submenu($valor){
        $submenu = '<li><a class="qmparent" href="javascript:void(0)">'.$valor.'</a>'."\n";
        $submenu .= '<ul>'."\n";
        return $submenu;
    }

    function opcion($codigo,$titulo){
        $opcion = '<li><a href="'.base_url().'index.php/'.$codigo.'">'.$titulo.'</a></li>'."\n";
        return $opcion;
    }

    function foot_menu(){
        $foot = '</div><!-- Create Menu Settings: (Menu ID, Is Vertical, Show Timer, Hide Timer, On Click (\'all\' or \'lev2\'), Right to Left, Horizontal Subs, Flush Left, Flush Top) -->
            <script type="text/javascript">qm_create(0,false,0,500,false,false,false,false,false);</script>
            <!-- This script references optionally loads the MyCSSMenu visual interface, to run the menu stand alone remove the script.-->
            <script type="text/javascript">if (window.name=="qm_launch_visual"){document.write(\'<scr\'+\'ipt type="text/javascript" src="http://www.mycssmenu.com/qmv6/qm_visual.js"></scr\'+\'ipt>\')}</script>
            ';
        return $foot;
    }

    function prueba(){
        $p = new centinela();
        echo $p->_nick;
    }

    function inicio($usuario='27'){
        $this->menu['opciones'] = $this->header_menu();
        $this->menu['opciones'] .= $this->_constructor('00',$usuario);
        $this->menu['opciones'] .= $this->_constructor('01',$usuario);
        $this->menu['opciones'] .= $this->_constructor('02',$usuario);
        $this->menu['opciones'] .= $this->_constructor('03',$usuario);
        $this->menu['opciones'] .= $this->_constructor('04',$usuario);
        $this->menu['opciones'] .= $this->foot_menu();
        return $this->menu['opciones'];
        //$this->load->view('vis_menu',$this->menu);
    }

    function _constructor($opcion_menu='00',$usuario='27'){
       //$centinela_menu = new Centinela();
       $consulta='SELECT usm_usuarios_menu_pk,usm_nivel,usm_codigo, usm_titulos
                    FROM sistema.vis_usuarios_menu as um, sistema.usuarios_opciones as uo
                    WHERE substring(usm_nivel from 1 for 2) = \''.$opcion_menu.'\' and
                    uo.usm_usuarios_fk = um.usm_usuarios_menu_pk and
                    uo.uso_ver = true and uo.usr_usuarios_fk = ';

       $menuopciones = $this->db->query($consulta.$usuario);
       $filas = $menuopciones->result_array();
       $resultado = '';
       $fin_menu  = '';$fin_submenu='';
       $nivel_actual = $opcion_menu;
       foreach($filas as $fila){
         if($fila['usm_nivel'] == $opcion_menu){
             $fin_menu = '</ul>'."\n";
             $resultado .= $this->submenu($fila['usm_titulos']);
         }else {
             if($fila['usm_codigo'] == '*'){
               $nivel_actual = strlen($fila['usm_nivel'])-2;
               if($fin_submenu != ''){
                 $resultado .= $fin_submenu;}
               else{
                 $fin_submenu =  '</ul>'."\n";}
               $resultado .= $this->submenu($fila['usm_titulos']);
               }
             else {
               if($nivel_actual == strlen($fila['usm_nivel'])){
                  $resultado  .= $fin_submenu;
                  $nivel_actual             = strlen($fila['usm_nivel'])-2;
                  $fin_submenu              = '';
               }
               $resultado .= $nivel_actual;
               $resultado .= $this->opcion($fila['usm_codigo'],$fila['usm_titulos']);
             }
         } //fin primer if
       } //Fin foreach
       $resultado .= $fin_submenu;
       $resultado .= $fin_menu;
       return $resultado;
    } //Fin _constructor
}
?>
