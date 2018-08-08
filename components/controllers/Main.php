<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->functions->AccessValidate();
        $this->load->model('categoriasModel', 'categorias');
        $this->load->model('usuariosModel', 'usuario');
    }


	public function index()
	{
		$this->load->view('backend/includes/header');
		$this->load->view('backend/includes/nav');
		$this->load->view('backend/main/inicio');
		$this->load->view('backend/includes/footer');
	}
}
