<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subcategorias extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->functions->AccessValidate();
        $this->load->model('subcategoriasModel', 'subcategorias');
        $this->load->model('categoriasModel', 'categorias');
        $this->load->model('estadosModel', 'estado');
    }


	public function index()
	{
		$data['subcategorias'] = $this->subcategorias->listar();
		$this->load->view('backend/includes/header');
		$this->load->view('backend/includes/nav');
		$this->load->view('backend/subcategorias/inicio', $data);
		$this->load->view('backend/includes/footer');
	}


	public function agregar()
	{
        $data['categorias'] = $this->categorias->listar();
		$data['estados']  = $this->estado->listar();
		$this->load->view('backend/includes/header');
		$this->load->view('backend/includes/nav');
		$this->load->view('backend/subcategorias/agregar', $data);
		$this->load->view('backend/includes/footer');
	}


	public function guarda_subcategoria()
	{
		$error = 0;
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('categoria', 'Categoria', 'required');
        $this->form_validation->set_rules('estado', 'Estado', 'required');

        if($this->form_validation->run() === FALSE){
            $error = 1;
        } else {
        	$data = array(
        		'nombre_subcategoria' => $this->functions->sanitizeString($_POST['nombre']),
                'id_categoria' => $this->functions->sanitizeString($_POST['categoria']),
				'id_estado' => $this->functions->sanitizeString($_POST['estado']));
        	$insert = $this->subcategorias->insertar($data);
        	if ($insert === false){
        		$error = 1;
        	}
        }

        if($error == 1){
            $this->session->set_flashdata('mensaje', $this->functions->showAlertDanger('No se ha podido crear el registro'));
            redirect(base_url().'subcategorias/agregar');
        } else {
            $this->session->set_flashdata('mensaje', $this->functions->showAlertSuccess('Registro creado con éxito'));
            redirect(base_url().'subcategorias');
        }
	}


	public function editar($id_subcategoria)
	{
		$id_subcategoria = $this->functions->sanitizeString($id_subcategoria);

		$data['subcategoria'] = $this->subcategorias->obtener($id_subcategoria);
        $data['categorias'] = $this->categorias->listar();
		$data['estados']  = $this->estado->listar();

		$this->load->view('backend/includes/header');
		$this->load->view('backend/includes/nav');
		$this->load->view('backend/subcategorias/editar', $data);
		$this->load->view('backend/includes/footer');
	}


	public function editar_subcategoria()
	{

		$error = 0;
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('categoria', 'Categoria', 'required');
        $this->form_validation->set_rules('estado', 'Estado', 'required');

        if($this->form_validation->run() === FALSE){
            $error = 1;
        } else {
        	$data = array(
                'nombre_subcategoria' => $this->functions->sanitizeString($_POST['nombre']),
                'id_categoria' => $this->functions->sanitizeString($_POST['categoria']),
                'id_estado' => $this->functions->sanitizeString($_POST['estado']));
        	$insert = $this->subcategorias->editar($data, $_POST['id_subcategoria']);
        	if ($insert === false){
        		$error = 1;
        	}
        }

        if($error == 1){
            $this->session->set_flashdata('mensaje', $this->functions->showAlertDanger('No se ha podido editar el registro'));
            redirect(base_url().'subcategorias/agregar');
        } else {
            $this->session->set_flashdata('mensaje', $this->functions->showAlertSuccess('Registro editado con éxito'));
            redirect(base_url().'subcategorias');
        }

	}


    public function eliminar($id_subcategoria)
    {
        $delete = $this->subcategorias->eliminar($id_subcategoria);
        if($delete === true){
            $this->session->set_flashdata('mensaje', $this->functions->showAlertSuccess('Registro eliminado con éxito'));
            redirect(base_url().'subcategorias');
        } else {
            $this->session->set_flashdata('mensaje', $this->functions->showAlertSuccess('No se ha podido eliminar el registro'));
            redirect(base_url().'subcategorias');
        }
    }

}
