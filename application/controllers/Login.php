<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
            parent::__construct();
            $this->load->model('accesoModel', 'acceso');
            $this->load->model('usuariosModel', 'usuario');
    }

    public function index()
    {
        $acceso = $this->acceso->validarAcceso($this->functions->sanitizeString($_POST['email']), $this->functions->sanitizeString($_POST['password']));

        if(count($acceso) == 0){
            $this->session->set_flashdata('mensaje', '<div class="alert alert-danger">Los datos ingresados son incorrectos</div>');
            redirect(base_url().'panel');
        } else {
            $newdata = array(
                'id_usuario'      => $acceso[0]->id_usuario,
                'nombre_usuario'  => $acceso[0]->nombre_usuario,
                'email_usuario'   => $acceso[0]->email_usuario,
                'perfil_usuario'  => $acceso[0]->id_perfil,
                'logged_in'       => true
            );
            $this->session->set_userdata($newdata);
            redirect(base_url().'main');
        }
    }

    public function cerrar_sesion()
    {
        $this->session->sess_destroy();
        redirect(base_url().'panel');
    }

    public function cambiar_password()
    {
        $error = 0;
        $mensaje = '';
        $password_uno = $_POST['password_uno'];
        $password_dos = $_POST['password_dos'];

        if($password_uno != $password_dos){
            $error = 1;
            $mensaje = 'Los passwords ingresados no coinciden';
        }

        if($password_uno == '' || $password_dos == ''){
            $error = 1;
            $mensaje = 'Debes completar ambos campos de password';
        }

        if($error == 1){
            echo json_encode(array('estado' => 1, 'mensaje' => $mensaje));

        } else {
            $data = array('password_usuario' => $password_uno);
            $update = $this->usuario->editar($data, $this->session->id_usuario);
            if($update === true){
                echo json_encode(array('estado' => 0, 'mensaje' => 'Password editado correctamente'));
            } else {
                echo json_encode(array('estado' => 1, 'mensaje' => 'Hubo un error al editar su password'));
            }
        }


    }


}