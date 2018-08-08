<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empresas extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->functions->AccessValidate();
        $this->load->model('empresasModel', 'empresa');
        $this->load->model('estadosModel', 'estado');
        $this->load->model('productosModel', 'producto');
        $this->load->model('horariosModel', 'horario');
        $this->load->model('pagosModel', 'pagos');
    }


	public function index()
	{
		$data['empresas'] = $this->empresa->listar();
		$this->load->view('backend/includes/header');
		$this->load->view('backend/includes/nav');
		$this->load->view('backend/empresas/inicio', $data);
		$this->load->view('backend/includes/footer');
	}


	public function ver($id_empresa)
	{
		$data['pagos'] = $this->pagos->listarPorEmpresa($id_empresa);
		$data['horario'] = $this->horario->listarPorEmpresa($id_empresa);
		$data['productos'] = $this->producto->listarPorEmpresa($id_empresa);
		$data['empresa'] = $this->empresa->obtener($id_empresa);
		$this->load->view('backend/includes/header');
		$this->load->view('backend/includes/nav');
		$this->load->view('backend/empresas/ver', $data);
		$this->load->view('backend/includes/footer');
	}

	public function detalle_producto($id_producto)
	{
		$data['producto'] = $this->producto->obtener($id_producto);
		$this->load->view('backend/empresas/detalle_producto', $data);
	}

}
