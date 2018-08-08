<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sub_subcategorias extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->functions->AccessValidate();
        $this->load->model('subcategoriasModel', 'subcategorias');
        $this->load->model('sub_subcategoriasModel', 'sub_subcategorias');
        $this->load->model('estadosModel', 'estado');
    }


	public function index()
	{
		$data['sub_subcategorias'] = $this->sub_subcategorias->listar();
		$this->load->view('backend/includes/header');
		$this->load->view('backend/includes/nav');
		$this->load->view('backend/sub_subcategorias/inicio', $data);
		$this->load->view('backend/includes/footer');
	}


	public function agregar()
	{
        $data['subcategorias'] = $this->subcategorias->listar();
		$data['estados']  = $this->estado->listar();
		$this->load->view('backend/includes/header');
		$this->load->view('backend/includes/nav');
		$this->load->view('backend/sub_subcategorias/agregar', $data);
		$this->load->view('backend/includes/footer');
	}


	public function guarda_sub_subcategoria()
	{
		$error = 0;
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('subcategoria', 'Subcategoria', 'required');
        $this->form_validation->set_rules('estado', 'Estado', 'required');

        if($this->form_validation->run() === FALSE){
            $error = 1;
        } else {
        	$data = array(
        		'nombre_sub_subcategoria' => $this->functions->sanitizeString($_POST['nombre']),
                'id_subcategoria' => $this->functions->sanitizeString($_POST['subcategoria']),
				'id_estado' => $this->functions->sanitizeString($_POST['estado']));
        	$insert = $this->sub_subcategorias->insertar($data);
        	if ($insert === false){
        		$error = 1;
        	}
        }

        if($error == 1){
            $this->session->set_flashdata('mensaje', $this->functions->showAlertDanger('No se ha podido crear el registro'));
            redirect(base_url().'sub_subcategorias/agregar');
        } else {
            $this->session->set_flashdata('mensaje', $this->functions->showAlertSuccess('Registro creado con éxito'));
            redirect(base_url().'sub_subcategorias');
        }
	}


	public function editar($id_sub_subcategoria)
	{
		$id_sub_subcategoria = $this->functions->sanitizeString($id_sub_subcategoria);

		$data['sub_subcategoria'] = $this->sub_subcategorias->obtener($id_sub_subcategoria);
        $data['subcategorias'] = $this->subcategorias->listar();
		$data['estados']  = $this->estado->listar();

		$this->load->view('backend/includes/header');
		$this->load->view('backend/includes/nav');
		$this->load->view('backend/sub_subcategorias/editar', $data);
		$this->load->view('backend/includes/footer');
	}


	public function editar_sub_subcategoria()
	{

		$error = 0;
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('subcategoria', 'Subategoria', 'required');
        $this->form_validation->set_rules('estado', 'Estado', 'required');

        if($this->form_validation->run() === FALSE){
            $error = 1;
        } else {
        	$data = array(
                'nombre_sub_subcategoria' => $this->functions->sanitizeString($_POST['nombre']),
                'id_subcategoria' => $this->functions->sanitizeString($_POST['subcategoria']),
                'id_estado' => $this->functions->sanitizeString($_POST['estado']));
        	$insert = $this->sub_subcategorias->editar($data, $_POST['id_sub_subcategoria']);
        	if ($insert === false){
        		$error = 1;
        	}
        }

        if($error == 1){
            $this->session->set_flashdata('mensaje', $this->functions->showAlertDanger('No se ha podido editar el registro'));
            redirect(base_url().'sub_subcategorias/agregar');
        } else {
            $this->session->set_flashdata('mensaje', $this->functions->showAlertSuccess('Registro editado con éxito'));
            redirect(base_url().'sub_subcategorias');
        }

	}


    public function eliminar($id_sub_subcategoria)
    {
        $delete = $this->sub_subcategorias->eliminar($id_sub_subcategoria);
        if($delete === true){
            $this->session->set_flashdata('mensaje', $this->functions->showAlertSuccess('Registro eliminado con éxito'));
            redirect(base_url().'sub_subcategorias');
        } else {
            $this->session->set_flashdata('mensaje', $this->functions->showAlertSuccess('No se ha podido eliminar el registro'));
            redirect(base_url().'sub_subcategorias');
        }
    }

}
