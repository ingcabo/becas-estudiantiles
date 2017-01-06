<?php

class JEL extends Controller
{

	function JEL()
	{
		parent::Controller();
		
    $this->load->helper('url');
    $this->load->helper('form');

	}

	function index()
	{

		$data['contenido'] = ''; //por si hay que enviar algo al inicio de la página
		$data['menu'] = $this->load->view('menu','',true);


		$this->load->view('index',$data);
	}

}
?>