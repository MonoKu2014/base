<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Panel extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        //validate session es para validar que la sesión este iniciada
        validate_session();
    }


	public function index()
	{	
        $this->load->view('layout/header');
		$this->load->view('panel/index');
        $this->load->view('layout/footer');
	}


    public function sin_permisos()
    {
        $this->load->view('layout/header');
        $this->load->view('panel/sin_permiso');
        $this->load->view('layout/footer');        
    }


}
