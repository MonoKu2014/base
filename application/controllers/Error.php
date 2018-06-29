<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        //validate sesion es para validar que la sesión este iniciada
        validate_session();
    }


	public function not_found()
	{	
        $this->load->view('layout/header');
		$this->load->view('errors/not_found');
        $this->load->view('layout/footer');
	}


}
