<?php

class Cnuevousuario extends Controller {

	function index()
	{
		$this->load->helper(array('form', 'url'));

		$this->load->library('validation');

		if ($this->validation->run() == FALSE)
		{
			$this->load->view('nuevousuario');
		}
		else
		{
			$this->load->view('bien');
		}
	}
}
?>