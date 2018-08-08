<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Preguntas extends CI_Controller {


	public function index()
	{
		$this->load->view('frontend/includes/header');
		$this->load->view('frontend/preguntas_frecuentes');
		$this->load->view('frontend/includes/footer');
	}

}