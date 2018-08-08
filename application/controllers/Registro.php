<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registro extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->model('clientesModel', 'cliente');
        $this->load->model('empresasModel', 'empresa');
	}

	public function index()
	{
        $data['regiones'] = $this->functions->listarRegiones();
		$this->load->view('frontend/includes/header');
		$this->load->view('frontend/registro', $data);
		$this->load->view('frontend/includes/footer');
	}


	public function ingreso()
	{
		$this->load->view('frontend/includes/header');
		$this->load->view('frontend/ingreso');
		$this->load->view('frontend/includes/footer');
	}


	public function cerrar_sesion()
	{
        $newdata = array(
            'id'      => '',
            'nombre'  => '',
            'email'   => '',
            'region'  => '',
            'comuna'  => '',
            'region_trabajo' => '',
            'comuna_trabajo' => '',
            'logged_in'       => false
        );
        $this->session->set_userdata($newdata);
        $this->session->sess_destroy();
        redirect(base_url());
	}


	public function ingresar_cuenta()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

        $http = $_SERVER['HTTP_REFERER'];

        if($email == '' || $password == ''){
            $this->session->set_flashdata('mensaje', 'Datos incorrectos o Usuario no registrado');
            $this->session->set_flashdata('error', 1);
            redirect($http);
        }

        $acceso = $this->cliente->obtenerLogin($email, $password);
        if(count($acceso) == 0){
            $this->session->set_flashdata('mensaje', 'Datos incorrectos o Usuario no registrado');
            $this->session->set_flashdata('error', 1);
            redirect($http);
        } else {

            if($acceso[0]->id_estado == 0){
                $data = $this->cliente->IDsempresasPublicadasPorCliente($acceso[0]->id_cliente);
                $empresas = [];
                foreach ($data as $key => $value) {
                    array_push($empresas, $value->id_empresa);
                }
                $this->cliente->desactivarCuenta($acceso[0]->id_cliente, $motivo, $empresas);
                $data['texto_uno'] = 'desactivada';
                $texto = 'Te damos la bienvenida nuevamente a tu perfil en Portal Microempresarios';
            } else {
                $texto = 'Has iniciado sesión correctamente';
            }

            $newdata = array(
                'id'      => $acceso[0]->id_cliente,
                'nombre'  => $acceso[0]->nombre_cliente,
                'email'   => $acceso[0]->email_cliente,
                'region'  => $acceso[0]->region_cliente,
                'comuna'  => $acceso[0]->comuna_cliente,
                'region_trabajo' => $acceso[0]->region_trabajo_cliente,
                'comuna_trabajo' => $acceso[0]->comuna_trabajo_cliente,
                'logged_in'       => true
            );
            $this->session->set_userdata($newdata);
            $this->session->set_flashdata('mensaje', '<div class="alert alert-success">'.$texto.'</div>');
            redirect(base_url().'persona');
        }

	}

	public function recuerda_password()
	{
        $this->load->view('frontend/includes/header');
        $this->load->view('frontend/recuerda');
        $this->load->view('frontend/includes/footer');
	}

	public function envia_password()
	{

        $email = $this->input->post('email');
        $cliente = $this->cliente->recuerdaPassword($email);

        if(count($cliente) == 0){
            $this->session->set_flashdata('mensaje', $this->functions->showAlertDanger('Correo no registrado en nuestra base de datos.'));
            redirect(base_url().'registro/recuerda_password');
        } else {

            $config = Array(
                'protocol'  => 'sendmail',
                'smtp_host' => 'smtp.etoliving.com',
                'smtp_port' => 25,
                'smtp_user' => 'contacto@portalmicroempresarios.com',
                'smtp_pass' => 'p0rt4lm1cr03mpr3s4r1os$$',
                'smtp_timeout' => '4',
                'mailtype'  => 'html',
                'charset'   => 'utf-8'
            );

            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");

            $this->email->from('contacto@portalmicroempresarios.com', 'Portal Microempresarios');

            $this->email->to($email);
            $this->email->subject('Recuerdo password');

            $data['password'] = $cliente[0]->password_cliente;

            $body = $this->load->view('frontend/emails/recuerda_password', $data, TRUE);
            $this->email->message($body);
            $mail = $this->email->send();

            $this->session->set_flashdata('mensaje', $this->functions->showAlertSuccess('Revisa tu correo, te hemos enviado tu contraseña.'));
            redirect(base_url().'registro/recuerda_password');

        }

	}




    public function registro_e_inicio()
    {

        $error = 0;

        $data = array(
            'nombre_cliente' => $this->input->post('nombre'),
            'region_cliente' => $this->input->post('regionvives'),
            'comuna_cliente' => $this->input->post('comunavives'),
            'region_trabajo_cliente' => $this->input->post('regiontrabajas'),
            'comuna_trabajo_cliente' => $this->input->post('comunatrabajas'),
            'email_cliente' => $this->input->post('email'),
            'password_cliente' => $this->input->post('password'),
            'id_estado' => 1);
        $insert = $this->cliente->insertar($data);
        $id_insertado = $this->db->insert_id();
        if ($insert === false){
            $error = 1;
        }

        if($error == 1){
            echo json_encode(
                    array(
                        'mensaje' => 'Complete los campos obligatorios',
                        'estado'  => 1
                    )
            );
        } else {
            $this->enviar_email_bienvenida_persona($this->input->post('nombre'), $this->input->post('email'));

            $newdata = array(
                'id'      => $id_insertado,
                'nombre'  => $this->input->post('nombre'),
                'email'   => $this->input->post('email'),
                'region'  => $this->input->post('regionvives'),
                'comuna'  => $this->input->post('comunavives'),
                'region_trabajo' => $this->input->post('regiontrabajas'),
                'comuna_trabajo' => $this->input->post('comunatrabajas'),
                'perfil'  => 0,
                'logged_in'       => true
            );
            $this->session->set_userdata($newdata);

            $apikey  = $this->functions->texto_general(8);
            $list_id = $this->functions->texto_general(9);
            $individulData = array(
                'apikey'        => $apikey,
                'email_address' => $this->session->email,
                'status'        => 'subscribed',
                'merge_fields'  => array(
                    'FNAME' => $this->session->nombre,
                    'LNAME' => '',
                )
            );

            $json_individulData        = json_encode($individulData);
            $finalData['operations'][] =
                array(
                    "method" => "POST",
                    "path"   => "/lists/$list_id/members/",
                    "body"   => $json_individulData
                );

            $api_response = $this->functions->batchSubscribe($finalData, $apikey);

            echo json_encode(
                    array(
                        'mensaje' => 'Su cuenta ha sido creada con éxito, inicie sesión con email y contraseña',
                        'estado'  => 0
                    )
            );

        }
    }

    public function enviar_email_bienvenida_persona($nombre, $email)
    {
            $config = Array(
                'protocol'  => 'sendmail',
                'smtp_host' => 'smtp.etoliving.com',
                'smtp_port' => 25,
                'smtp_user' => 'bienvenido@portalmicroempresarios.com',
                'smtp_pass' => 'iby2814816nacho55811393',
                'smtp_timeout' => '4',
                'mailtype'  => 'html',
                'charset'   => 'utf-8'
            );

            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");

            $this->email->from('bienvenido@portalmicroempresarios.com', 'Portal Microempresarios');

            $this->email->to($email);
            $this->email->subject($nombre.' Ahora puedes...');

            $data = [];

            $body = $this->load->view('frontend/emails/bienvenido_cliente', $data, TRUE);
            $this->email->message($body);
            $mail = $this->email->send();
    }



    public function cerrar_cuenta()
    {
        $this->load->view('frontend/includes/header');
        $this->load->view('frontend/cerrar_cuenta');
        $this->load->view('frontend/includes/footer');
    }


    public function cierre_cuenta()
    {
        $motivo = $this->input->post('motivo');
        $tipo = $this->input->post('tipo');

        $data = $this->cliente->IDsempresasPublicadasPorCliente($this->session->id);
        $empresas = [];

        foreach ($data as $key => $value) {
            array_push($empresas, $value->id_empresa);
        }

        if($tipo == 1){
            //desactivar
            $this->cliente->desactivarCuenta($this->session->id, $motivo, $empresas);
            $data['texto_uno'] = 'desactivada';

        } else {
            //eliminar
            $this->cliente->eliminarCuenta($this->session->id, $empresas);
            $data['texto_uno'] = 'cerrada';

        }

        $data['tipo'] = $tipo;

        $newdata = array(
            'id'      => '',
            'nombre'  => '',
            'email'   => '',
            'region'  => '',
            'comuna'  => '',
            'region_trabajo' => '',
            'comuna_trabajo' => '',
            'logged_in'       => false
        );
        $this->session->set_userdata($newdata);
        $this->session->sess_destroy();

        $this->load->view('frontend/includes/header');
        $this->load->view('frontend/cuenta_cerrada', $data);
        $this->load->view('frontend/includes/footer');


    }


}
