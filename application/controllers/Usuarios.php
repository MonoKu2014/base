<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->functions->AccessValidate();
        $this->load->model('perfilesModel', 'perfil');
        $this->load->model('estadosModel', 'estado');
        $this->load->model('usuariosModel', 'usuario');
    }


	public function index()
	{
		$data['usuarios'] = $this->usuario->listar();
		$this->load->view('backend/includes/header');
		$this->load->view('backend/includes/nav');
		$this->load->view('backend/usuarios/inicio', $data);
		$this->load->view('backend/includes/footer');
	}


	public function agregar()
	{
		$data['perfiles'] = $this->perfil->listar();
		$data['estados']  = $this->estado->listar();

		$this->load->view('backend/includes/header');
		$this->load->view('backend/includes/nav');
		$this->load->view('backend/usuarios/agregar', $data);
		$this->load->view('backend/includes/footer');
	}


	public function guarda_usuario()
	{
		$error = 0;
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('perfil', 'Perfil', 'required');
        $this->form_validation->set_rules('estado', 'Estado', 'required');

        if($this->form_validation->run() === FALSE){
            $error = 1;
        } else {
        	$data = array(
        		'nombre_usuario' => $this->functions->sanitizeString($_POST['nombre']),
        		'email_usuario' => $this->functions->sanitizeString($_POST['email']),
				'password_usuario' => $this->functions->createPassword(),
				'id_estado' => $this->functions->sanitizeString($_POST['estado']),
				'id_perfil' => $this->functions->sanitizeString($_POST['perfil']));
        	$insert = $this->usuario->insertar($data);
        	if ($insert === false){
        		$error = 1;
        	}
        }

        if($error == 1){
            $this->session->set_flashdata('mensaje', $this->functions->showAlertDanger('No se ha podido crear el registro'));
            redirect(base_url().'usuarios/agregar');
        } else {
            $this->session->set_flashdata('mensaje', $this->functions->showAlertSuccess('Registro creado con éxito'));
            redirect(base_url().'usuarios');
        }
	}


	public function editar($id_usuario)
	{
		$id_usuario = $this->functions->sanitizeString($id_usuario);

		$data['usuario'] = $this->usuario->obtener($id_usuario);
		$data['perfiles'] = $this->perfil->listar();
		$data['estados']  = $this->estado->listar();

		$this->load->view('backend/includes/header');
		$this->load->view('backend/includes/nav');
		$this->load->view('backend/usuarios/editar', $data);
		$this->load->view('backend/includes/footer');
	}


	public function editar_usuario()
	{

		$error = 0;
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('perfil', 'Perfil', 'required');
        $this->form_validation->set_rules('estado', 'Estado', 'required');

        if($this->form_validation->run() === FALSE){
            $error = 1;
        } else {
        	$data = array(
        		'nombre_usuario' => $this->functions->sanitizeString($_POST['nombre']),
        		'email_usuario' => $this->functions->sanitizeString($_POST['email']),
				'id_estado' => $this->functions->sanitizeString($_POST['estado']),
				'id_perfil' => $this->functions->sanitizeString($_POST['perfil']));
        	$insert = $this->usuario->editar($data, $_POST['id_usuario']);
        	if ($insert === false){
        		$error = 1;
        	}
        }

        if($error == 1){
            $this->session->set_flashdata('mensaje', $this->functions->showAlertDanger('No se ha podido editar el registro'));
            redirect(base_url().'usuarios/agregar');
        } else {
            $this->session->set_flashdata('mensaje', $this->functions->showAlertSuccess('Registro editado con éxito'));
            redirect(base_url().'usuarios');
        }

	}


    public function eliminar($id_usuario)
    {
        $delete = $this->usuario->eliminar($id_usuario);
        if($delete === true){
            $this->session->set_flashdata('mensaje', $this->functions->showAlertSuccess('Registro eliminado con éxito'));
            redirect(base_url().'usuarios');
        } else {
            $this->session->set_flashdata('mensaje', $this->functions->showAlertSuccess('No se ha podido eliminar el registro'));
            redirect(base_url().'usuarios');
        }
    }


}
