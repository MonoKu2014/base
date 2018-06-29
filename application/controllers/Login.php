<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {


    public function __construct()
    {
    	//instancio el constructor padre del CI controller
        parent::__construct();
        //cargo un modelo en el constructor de la clase para que este siempre disponible
        //la funcion load model recibe dos paraámetros
        //el nombre del model y el alias con el que va a ser usado en la clase como instancia
        $this->load->model('login_Model', 'login');
    }


	public function index()
	{
		$this->load->view('login');
	}

	public function access()
	{

		//así capturo los datos que van por post
		$email 		= $this->input->post('email');
		$password 	= $this->input->post('password');

		//consulto a través del modelo que tenemos cargado en el constructor
		//si buscas get_login estará la funcion dentro del modelo y recibe esos parámetros
		$user = $this->login->get_login($email, $password);

		if(count($user) > 0){

			//esta es la forma de guardar datos en una sessión en codeigniter
            $newdata = array(
                'id'      	=> $user->id_usuario,
                'nombre'  	=> $user->nombre_usuario,
                'email'   	=> $user->email_usuario,
                'perfil'  	=> $user->perfil_fk,
                'logged_in' => true
            );
            $this->session->set_userdata($newdata);
            redirect(base_url().'panel');

		} else {
			//esta es la forma de enviar alertas desde el controlador a la vista
			//alert_danger esta en la carpeta application/helpers y contiene las funciones globales
			$this->session->set_flashdata('message', alert_danger('Usuario o clave inválida'));
			redirect(base_url());
		}

	}

	public function salir()
	{
        $newdata = array(
            'id'      	=> '',
            'nombre'  	=> '',
            'email'   	=> '',
            'perfil'  	=> '',
            'logged_in' => false
        );
        $this->session->set_userdata($newdata);
        $this->session->sess_destroy();
        redirect(base_url());
	}

}
