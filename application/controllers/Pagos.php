<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pagos extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->functions->AccessValidate();
        $this->load->model('pagosModel', 'pagos');
        $this->load->model('estadosModel', 'estado');
    }


	public function index()
	{
		$data['pagos'] = $this->pagos->listar();
		$this->load->view('backend/includes/header');
		$this->load->view('backend/includes/nav');
		$this->load->view('backend/pagos/inicio', $data);
		$this->load->view('backend/includes/footer');
	}


	public function agregar()
	{
        $data['pagos'] = $this->pagos->listar();
		$data['estados']  = $this->estado->listar();
		$this->load->view('backend/includes/header');
		$this->load->view('backend/includes/nav');
		$this->load->view('backend/pagos/agregar', $data);
		$this->load->view('backend/includes/footer');
	}


	public function guarda_pago()
	{
		$error = 0;
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('estado', 'Estado', 'required');

        if($this->form_validation->run() === FALSE){
            $error = 1;
        } else {
        	$data = array(
        		'nombre_medio_pago' => $this->functions->sanitizeString($_POST['nombre']),
				'id_estado' => $this->functions->sanitizeString($_POST['estado']));
        	$insert = $this->pagos->insertar($data);
        	if ($insert === false){
        		$error = 1;
        	}
        }

        if($error == 1){
            $this->session->set_flashdata('mensaje', $this->functions->showAlertDanger('No se ha podido crear el registro'));
            redirect(base_url().'pagos/agregar');
        } else {
            $this->session->set_flashdata('mensaje', $this->functions->showAlertSuccess('Registro creado con éxito'));
            redirect(base_url().'pagos');
        }
	}


	public function editar($id_pago)
	{
		$id_pago = $this->functions->sanitizeString($id_pago);

		$data['pago'] = $this->pagos->obtener($id_pago);
		$data['estados']  = $this->estado->listar();

		$this->load->view('backend/includes/header');
		$this->load->view('backend/includes/nav');
		$this->load->view('backend/pagos/editar', $data);
		$this->load->view('backend/includes/footer');
	}


	public function editar_pago()
	{

		$error = 0;
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('estado', 'Estado', 'required');

        if($this->form_validation->run() === FALSE){
            $error = 1;
        } else {
        	$data = array(
                'nombre_medio_pago' => $this->functions->sanitizeString($_POST['nombre']),
                'id_estado' => $this->functions->sanitizeString($_POST['estado']));
        	$insert = $this->pagos->editar($data, $_POST['id_pago']);
        	if ($insert === false){
        		$error = 1;
        	}
        }

        if($error == 1){
            $this->session->set_flashdata('mensaje', $this->functions->showAlertDanger('No se ha podido editar el registro'));
            redirect(base_url().'pagos/editar/'.$_POST['id_pago']);
        } else {
            $this->session->set_flashdata('mensaje', $this->functions->showAlertSuccess('Registro editado con éxito'));
            redirect(base_url().'pagos');
        }

	}


    public function eliminar($id_pago)
    {
        $delete = $this->pagos->eliminar($id_pago);
        if($delete === true){
            $this->session->set_flashdata('mensaje', $this->functions->showAlertSuccess('Registro eliminado con éxito'));
            redirect(base_url().'pagos');
        } else {
            $this->session->set_flashdata('mensaje', $this->functions->showAlertSuccess('No se ha podido eliminar el registro'));
            redirect(base_url().'pagos');
        }
    }

}
