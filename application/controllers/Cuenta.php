<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cuenta extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->functions->AccessValidate();
        $this->load->model('usuariosModel', 'usuario');
    }


	public function index()
	{
		$id_usuario = $this->session->id_usuario;
		
		$data['usuario'] = $this->usuario->obtener($id_usuario);

		$this->load->view('backend/includes/header');
		$this->load->view('backend/includes/nav');
		$this->load->view('backend/cuenta/inicio', $data);
		$this->load->view('backend/includes/footer');
	}

}
