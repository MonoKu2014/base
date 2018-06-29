<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        //validate session es para validar que la sesión este iniciada
        validate_session();
        $this->load->model('usuarios_Model', 'usuario');
    }


	public function index()
	{
        $data['usuarios'] = $this->usuario->obtener_usuarios();
        $data['perfiles'] = $this->usuario->obtener_perfiles();
        $data['estados'] = $this->usuario->obtener_estados();
        $this->load->view('layout/header');
		$this->load->view('usuarios/index', $data);
        $this->load->view('layout/footer');
	}


    public function agregar()
    {
        $data['perfiles'] = $this->usuario->obtener_perfiles();
        $data['estados'] = $this->usuario->obtener_estados();
        $this->load->view('layout/header');
        $this->load->view('usuarios/agregar', $data);
        $this->load->view('layout/footer');
    }


    public function guardar()
    {
        $error = 0;
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('perfil', 'Perfil', 'required');
        $this->form_validation->set_rules('estado', 'Estado', 'required');

        if($this->form_validation->run() === FALSE){

            $error = 1;

        } else {

            $data = array(
                'nombre_usuario'    => $this->input->post('nombre'),
                'email_usuario'     => $this->input->post('email'),
                'password_usuario'  => $this->input->post('password'),
                'perfil_fk'         => $this->input->post('perfil'),
                'estado_fk'         => $this->input->post('estado')
            );

            $insert = $this->usuario->insertar($data);
            if($insert === false){
                $error = 1;
            }
        }

        if($error == 1){
            $this->session->set_flashdata('message', alert_danger('No se ha podido crear el registro'));
            redirect(base_url().'usuarios/agregar');
        } else {
            $this->session->set_flashdata('message', alert_success('Registro creado con éxito'));
            redirect(base_url().'usuarios');
        }
    }


    public function editar($id)
    {
        $data['usuario'] = $this->usuario->obtener_usuario($id);
        $data['perfiles'] = $this->usuario->obtener_perfiles();
        $data['estados'] = $this->usuario->obtener_estados();
        $this->load->view('layout/header');
        $this->load->view('usuarios/editar', $data);
        $this->load->view('layout/footer');
    }


    public function guardar_edicion()
    {
        $error = 0;
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('perfil', 'Perfil', 'required');
        $this->form_validation->set_rules('estado', 'Estado', 'required');

        if($this->form_validation->run() === FALSE){

            $error = 1;

        } else {

            $data = array(
                'nombre_usuario'    => $this->input->post('nombre'),
                'email_usuario'     => $this->input->post('email'),
                'password_usuario'  => $this->input->post('password'),
                'perfil_fk'         => $this->input->post('perfil'),
                'estado_fk'         => $this->input->post('estado')
            );

            $insert = $this->usuario->editar($data, $this->input->post('usuario_id'));
            if($insert === false){
                $error = 1;
            }
        }

        if($error == 1){
            $this->session->set_flashdata('message', alert_danger('No se ha podido editar el registro'));
            redirect(base_url().'usuarios/editar/' . $this->input->post('usuario_id'));
        } else {
            $this->session->set_flashdata('message', alert_success('Registro editado con éxito'));
            redirect(base_url().'usuarios');
        }
    }


    public function eliminar($id)
    {
        $delete = $this->usuario->eliminar($id);
        if($delete === false){
            $this->session->set_flashdata('message', alert_danger('No se ha podido eliminar el registro'));
            redirect(base_url().'usuarios');
        } else {
            $this->session->set_flashdata('message', alert_success('Registro eliminado con éxito'));
            redirect(base_url().'usuarios');
        }

    }


    public function activar($id)
    {
        $data = array('estado_fk' => 1);
        $update = $this->usuario->editar($data, $id);
        if($update === false){
            $this->session->set_flashdata('message', alert_danger('No se ha podido activar el registro'));
            redirect(base_url().'usuarios');
        } else {
            $this->session->set_flashdata('message', alert_success('Registro activado con éxito'));
            redirect(base_url().'usuarios');
        }

    }


    public function desactivar($id)
    {
        $data = array('estado_fk' => 2);
        $update = $this->usuario->editar($data, $id);
        if($update === false){
            $this->session->set_flashdata('message', alert_danger('No se ha podido desactivar el registro'));
            redirect(base_url().'usuarios');
        } else {
            $this->session->set_flashdata('message', alert_success('Registro desactivado con éxito'));
            redirect(base_url().'usuarios');
        }

    }


    public function exportar()
    {

        $usuarios = $this->usuario->consulta_exportar()->result();

        $cabeceras = $this->usuario->consulta_exportar()->list_fields();

        $nombre_archivo = 'Usuarios_'.date('d-m-Y').'.xlsx';

        main_export($nombre_archivo, $usuarios, $cabeceras);

    }

}
