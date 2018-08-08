<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categorias extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->functions->AccessValidate();
        $this->load->model('categoriasModel', 'categorias');
        $this->load->model('estadosModel', 'estado');
    }


	public function index()
	{
		$data['categorias'] = $this->categorias->listar();
		$this->load->view('backend/includes/header');
		$this->load->view('backend/includes/nav');
		$this->load->view('backend/categorias/inicio', $data);
		$this->load->view('backend/includes/footer');
	}


	public function agregar()
	{
		$data['estados']  = $this->estado->listar();
		$this->load->view('backend/includes/header');
		$this->load->view('backend/includes/nav');
		$this->load->view('backend/categorias/agregar', $data);
		$this->load->view('backend/includes/footer');
	}


	public function guarda_categoria()
	{
		$error = 0;
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('estado', 'Estado', 'required');

        if($this->form_validation->run() === FALSE){
            $error = 1;
        } else {
        	$data = array(
        		'nombre_categoria' => $this->functions->sanitizeString($_POST['nombre']),
				'id_estado' => $this->functions->sanitizeString($_POST['estado']));
        	$insert = $this->categorias->insertar($data);
        	if ($insert === false){
        		$error = 1;
        	}
        }

        if($error == 1){
            $this->session->set_flashdata('mensaje', $this->functions->showAlertDanger('No se ha podido crear el registro'));
            redirect(base_url().'categorias/agregar');
        } else {
            $this->session->set_flashdata('mensaje', $this->functions->showAlertSuccess('Registro creado con éxito'));
            redirect(base_url().'categorias');
        }
	}


	public function editar($id_categoria)
	{
		$id_categoria = $this->functions->sanitizeString($id_categoria);

		$data['categoria'] = $this->categorias->obtener($id_categoria);
		$data['estados']  = $this->estado->listar();

		$this->load->view('backend/includes/header');
		$this->load->view('backend/includes/nav');
		$this->load->view('backend/categorias/editar', $data);
		$this->load->view('backend/includes/footer');
	}


	public function editar_categoria()
	{

		$error = 0;
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('estado', 'Estado', 'required');

        if($this->form_validation->run() === FALSE){
            $error = 1;
        } else {
        	$data = array(
        		'nombre_categoria' => $this->functions->sanitizeString($_POST['nombre']),
				'id_estado' => $this->functions->sanitizeString($_POST['estado']));
        	$insert = $this->categorias->editar($data, $_POST['id_categoria']);
        	if ($insert === false){
        		$error = 1;
        	}
        }

        if($error == 1){
            $this->session->set_flashdata('mensaje', $this->functions->showAlertDanger('No se ha podido editar el registro'));
            redirect(base_url().'categorias/agregar');
        } else {
            $this->session->set_flashdata('mensaje', $this->functions->showAlertSuccess('Registro editado con éxito'));
            redirect(base_url().'categorias');
        }

	}


    public function eliminar($id_categoria)
    {
        $delete = $this->categorias->eliminar($id_categoria);
        if($delete === true){
            $this->session->set_flashdata('mensaje', $this->functions->showAlertSuccess('Registro eliminado con éxito'));
            redirect(base_url().'categorias');
        } else {
            $this->session->set_flashdata('mensaje', $this->functions->showAlertSuccess('No se ha podido eliminar el registro'));
            redirect(base_url().'categorias');
        }
    }

}
