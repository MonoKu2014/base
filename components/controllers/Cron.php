<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->functions->AccessValidate();
		$this->load->model('clientesModel', 'cliente');
        $this->load->model('empresasModel', 'empresa');
    }


    public function index()
    {
		$this->load->view('backend/includes/header');
		$this->load->view('backend/includes/nav');
		$this->load->view('backend/cron/inicio');
		$this->load->view('backend/includes/footer');
    }


    public function email_sugeridos()
    {

        $config = Array(        
            'protocol'  => 'sendmail',
            'smtp_host' => 'smtp.mandrillapp.com',
            'smtp_port' => 587,
            'smtp_user' => 'Portal Microempresarios',
            'smtp_pass' => 'BtP4hEhBhJzLezpf2tRuUQ',
            'smtp_timeout' => '4',
            'mailtype'  => 'html', 
            'charset'   => 'utf-8'
        );

        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from('bienvenido@portalmicroempresarios.com', 'Portal Microempresarios');

        $clientes = $this->functions->obtener_clientes();
        foreach ($clientes as $c) {
            
            $this->email->to($c->email_cliente);
            $this->email->subject('Sugerencias');
            $this->email->from('bienvenido@portalmicroempresarios.com', 'Portal Microempresarios');

            $data['id_actual'] = $c->id_cliente;
            $data['nombre'] = $c->nombre_cliente;
            $data['personas_sugeridas'] = $this->functions->personas_sugeridas_email($c->id_cliente, $c->comuna_cliente);
            $data['empresas_sugeridas'] = $this->functions->empresas_sugeridas_email($c->id_cliente, $c->comuna_cliente);
            $body = $this->load->view('frontend/emails/sugeridos', $data, TRUE);
            $this->email->message($body);
            $mail = $this->email->send();
            
        }

        $this->session->set_flashdata('mensaje', $this->functions->showAlertSuccess('Los correos han sido enviados, ejecuta esta operación cada vez que quieras enviar los correos masivos de sugerencias'));
        redirect(base_url().'cron');


    }



    public function suscriptores()
    {
        ini_set('max_execution_time', 0);
        $clientes = $this->functions->obtener_clientes();

        $apikey  = $this->functions->texto_general(8);
        $list_id = $this->functions->texto_general(9);
        
        foreach ($clientes as $c) {

            $individulData = array(
                'apikey'        => $apikey,
                'email_address' => $c->email_cliente,
                'status'        => 'subscribed',
                'merge_fields'  => array(
                    'FNAME' => $c->nombre_cliente,
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
        }

        $this->session->set_flashdata('mensaje', $this->functions->showAlertSuccess('Tu lista de suscriptores ha sido actualizada'));
        redirect(base_url().'cron');

    }


}
