<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->functions->AccessValidate();
        $this->load->model('clientesModel', 'cliente');
        $this->load->model('estadosModel', 'estado');
    }


	public function index()
	{
		$data['clientes'] = $this->cliente->listar();
		$this->load->view('backend/includes/header');
		$this->load->view('backend/includes/nav');
		$this->load->view('backend/clientes/inicio', $data);
		$this->load->view('backend/includes/footer');
	}
}
