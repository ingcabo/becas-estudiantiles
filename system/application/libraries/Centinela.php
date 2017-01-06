<?php
	if(!defined('BASEPATH')) 
		exit('No direct script access allowed');
		
	class Centinela
	{
		var $_id    = 0;
		var $_nick  = "";
		var $_clave = "";
		var $_nivel = "";
        var $_referencia = "";
        var $_campo1 = "";
        var $_campo2 = "";
        var $_campo3 = "";
        var $_politicas = "";
					
		var $_auth = FALSE;
		
		function Centinela($auto = TRUE)
		{
			if($auto)
			{
				$CI =& get_instance();
				
				if($this->login($CI->session->userdata('nick'), $CI->session->userdata('clave')))
				{
					$this->_id          = $CI->session->userdata('id');
					$this->_nick        = $CI->session->userdata('nick');
					$this->_clave       = $CI->session->userdata('clave');
					$this->_nivel       = $CI->session->userdata('nivel');
					$this->_sesion      = $CI->session->userdata('sesion');
					$this->_last        = $CI->session->userdata('last');
                    $this->_campo1      = $CI->session->userdata('campo1');
                    $this->_campo2      = $CI->session->userdata('campo2');
                    $this->_campo3      = $CI->session->userdata('campo3');
                    $this->_referencia  = $CI->session->userdata('referencia');
                    $this->_politicas   = $CI->session->userdata('politicas');
				}
            }
		} //Fin Centinela
		
		//--------------------------------------//
		
        function getId(){return $this->_id;}
		function getNick(){return $this->_nick;}
		function getClave(){return $this->_clave;}
		function getNivel(){return $this->_nivel;}
        function getcampo1(){return $this->_campo1;}
        function getcampo2(){return $this->_campo2;}
        function getcampo3(){return $this->_campo3;}
        function getReferencia(){return $this->_referencia;}
        function getPoliticas(){return $this->_politicas;}
        function putReferencia($valor){
            $CI =& get_instance();
            $CI->session->set_userdata('referencia', $valor);
            $this->_referencia = $valor;}
        function putcampo1($valor){
            $CI =& get_instance();
            $CI->session->set_userdata('campo1', $valor);
            $this->_campo1 = $valor;}
        function putcampo2($valor){
            $CI =& get_instance();
            $CI->session->set_userdata('campo2', $valor);
            $this->_campo2 = $valor;}
        function putcampo3($valor){
            $CI =& get_instance();
            $CI->session->set_userdata('campo3', $valor);
            $this->_campo3 = $valor;}
        function putPoliticas($valor){
            $CI =& get_instance();
            $CI->session->set_userdata($valor);
            $this->_politicas = $valor;}
		
		//--------------------------------------//		
		
		function login($nick = "", $clave = "")
		{
			if(empty($nick)||empty($clave))
				return FALSE;
			
			$CI =& get_instance();		
				
			$sql = "SELECT * FROM sistema.usuarios WHERE usr_nombre=? AND usr_clave=? AND CURRENT_DATE <= usr_fecha_expira";
			$query = $CI->db->query($sql, array($nick, $clave));
			
			//login ok
			if($query->num_rows()==1)
			{	
				$row = $query->row();
				
				$CI->session->set_userdata('id', $row->usr_usuarios_pk);
				$this->_id = $row->usr_usuarios_pk;
				$CI->session->set_userdata('nick', $nick);
				$this->_nick = $nick;
				$CI->session->set_userdata('clave', $clave);
				$this->_clave = $row->usr_clave;
				$CI->session->set_userdata('nivel', $row->usr_nivel);
				$this->_nivel = $row->usr_nivel;
				
				$this->_auth = TRUE;
				
				return TRUE;
			}
			else
			{
				$this->_auth = FALSE;
				$this->logout();
				
				return FALSE;
			}
		}
		
		function logout()
		{
			$CI =& get_instance();
			$CI->session->sess_destroy();
			$this->_auth = FALSE;			
		}
		
		//--------------------------------------//
		
		function check($nivel = 0, $estricto = TRUE)
		{
			if(!$this->_auth)
				return FALSE;
				
			if($estricto)
			{
				if($nivel == $this->_nivel)
					return TRUE;
				else
					return FALSE;
			}
			else
			{
				if($nivel <= $this->_nivel)
					return TRUE;
				else
					return FALSE;				
			}
		}				
	}
?>