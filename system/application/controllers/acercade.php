<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of acercade
 *
 * @author rcamejo
 */
class acercade extends Controller{
    //put your code here

    function Con_acceso()
    {
        parent::Controller();
        $this->load->helper('form');
    }

    function index(){

        $centinela                  = new Centinela(FALSE);
        $menu_final['opciones']     = $this->mod_demenu->inicio($centinela->getId());
        $data['menu']               = $this->load->view('vis_menu',$menu_final,true);

        $data['title'] = 'Sistema de Control y Seguimiento de Beneficiarios JEL';
        $data['titulo'] = 'Sistema de Control y Seguimiento de Beneficiarios JEL';
        $this->load->view('acerca_de',$data);
    }
}
?>
