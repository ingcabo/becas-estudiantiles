<?php
/**
 * Description of con_listview_estatus
 *
 * @author rcamejo
 */
class Con_listview_usuarios extends Controller{

    function Con_listview_usuarios(){
      parent::Controller();
      $col_anc = array('1'=>30,'2'=>40,'3'=>25);
      $params = array('tabla_prefijo' => 'usr_', 'tabla_nombre' => 'usuarios', 'paginacion' => '5', 'esquema' => 'sistema.', 'clase_crud' => 'con_acceso', 'anchos'=>$col_anc);
      $this->load->library('listview',$params);
      $this->load->model('Mfrmclass','',TRUE);
      
    }

    function Tipo_condicion($campo_seleccionado){
         $objResponse = new xajaxResponse();
         $objResponse->Assign("DivSelectOperador","innerHTML", $this->Mfrmclass->Operador($campo_seleccionado));
         $objResponse->Assign("DivCampoFiltro","innerHTML", $this->Mfrmclass->Campo_filtro($campo_seleccionado));
         return $objResponse;
    } //Fin Tipo_condicion

    function index($registro_offset=0){
      $this->listview->inicializar($registro_offset);
    }
}
?>
