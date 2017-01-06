<?php
if(!defined('BASEPATH'))
		exit('No direct script access allowed');
/**
 * Description of lib_base
 *
 * @author Ricardo
 */
class Mylib_base {

    function Mylib_base(){
      
    }

    function pg_to_human($fecha){
        return date("d-m-Y",strtotime($fecha));
        //return substr($fecha,8,2)."/".substr($fecha,5,2)."/".substr($fecha,0,4);
    } //fin pg_to_human

    function human_to_pg($fecha){
        return date("Y-m-d",strtotime($fecha));
        //return substr($fecha,8,2)."/".substr($fecha,5,2)."/".substr($fecha,0,4);
    } //fin human_to_pg

    //Formatea el numero a formato postgres
    function numeric_to_pg($numero){
        return preg_replace('/\,/','.',preg_replace('/\./','',$numero));
    } //Fin numeric_to_pg
}
?>
