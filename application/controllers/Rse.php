<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rse extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
        $this->load->model('rseModel', 'rse');
        $this->load->model('empresasModel', 'empresa');
        $this->load->model('clientesModel', 'cliente');
	}

	public function perfil_rse($id)
	{
        $data['empresa'] = $this->rse->obtenerEmpresaRSE($id);
		$this->load->view('frontend/includes/header_rse');
		$this->load->view('frontend/perfil_rse', $data);
		$this->load->view('frontend/includes/footer');
	}


    public function chat($id)
    {
        $data['empresa'] = $this->rse->obtenerEmpresaRSE($id);
        $this->load->view('frontend/chat', $data);
    }

    public function get_chat()
    {
        $id_empresa_rse = $this->input->post('id');
        $mensajes = $this->rse->chat($id_empresa_rse, $this->session->id);
        $html = '';
        foreach ($mensajes as $mensaje){
            ($mensaje->tipo == 1) ? $clase = 'message-rse' : $clase = '';
            $html .= '<div class="chat-box-html"><div class="chat-box-message '.$clase.'"><b>'.$mensaje->nombre.':</b><br>'.$mensaje->mensaje.'<span style="float: right;color:#585858;font-size:10px;">'.$this->dia($mensaje->fecha).' '.$this->formatearFecha($mensaje->fecha).'</span></div></div>';
        }

        echo $html;
    }

    function formatearFecha($fecha){
        return date('g:i a', strtotime($fecha));
    }

    function dia($fecha)
    {
        return date('d-m-Y', strtotime($fecha));
    }


    public function get_chat_last_message()
    {
        $id_empresa_rse = $this->input->post('id');
        $mensajes = $this->rse->chat_dos($id_empresa_rse, $this->session->id);
        $html = '';
        foreach ($mensajes as $mensaje){
            ($mensaje->tipo == 1) ? $clase = 'message-rse' : $clase = '';
            $html .= '<div class="chat-box-html"><div class="chat-box-message '.$clase.'"><b>'.$mensaje->nombre.':</b><br>'.$mensaje->mensaje.'<span style="float: right;color:#585858;font-size:10px;">'.$this->dia($mensaje->fecha).' '.$this->formatearFecha($mensaje->fecha).'</span></div></div>';
            $this->actualizar($mensaje->id);
        }

        echo $html;
    }

    public function post_message()
    {
        $id_empresa_rse = $this->input->post('id');
        $id_empresa_portal = $this->session->id;
        $mensaje = $this->input->post('mensaje');
        $data = array(
            'nombre' => $this->session->nombre,
            'mensaje' => $mensaje,
            'id_microempresario' => $id_empresa_portal,
            'id_rse' => $id_empresa_rse,
            'tipo' => 0,
            'leido_portal' => 0,
            'leido_rse' => 0
        );
        $this->rse->insertar_chat($data);
        echo 1;
    }

    function actualizar($id)
    {

        $data = array(
            'leido_portal' => 1
        );
        $this->rse->leido($data, $id);
    }




    public function listado_empresas()
    {

        $region = $this->input->post('region');
        $comuna = $this->input->post('comuna');

        if($comuna == 'Seleccione...'){
            $comuna = '';
        }

        $data['region_seleccionada'] = $region;
        $data['comuna_seleccionada'] = $comuna;

        $registros_a_mostrar = 10;
        if(isset($_GET['p'])){
            $pagina_actual = $_GET['p'];
            $inicio = $registros_a_mostrar * ($pagina_actual - 1);
        } else {
            $pagina_actual = 1;
            $inicio = 0;
        }

        if(isset($_GET['ordenar'])){
            $ordenar = $_GET['ordenar'];
        } else {
            $ordenar = 0;
        }

        $data['pagina_actual'] = $pagina_actual;
        $data['url'] = current_url().'?';
        $data['empresas'] = $this->rse->listado_completo($registros_a_mostrar, $inicio, 0, $ordenar, $region, $comuna);
        $data['total_registros'] = ceil(count($this->rse->listado_completo($registros_a_mostrar, $inicio, 1, 0, $region, $comuna)) / $registros_a_mostrar);

        $this->load->view('frontend/includes/header_rse');
        $this->load->view('frontend/listado_empresas_rse', $data);
        $this->load->view('frontend/includes/footer');
    }


    public function ofrecer_convenio($id)
    {
        $data['empresa'] = $this->rse->obtenerEmpresaRSE($id);
        $data['mis_empresas'] = $this->empresa->mis_empresas($this->session->id);
        $this->load->view('frontend/includes/header_rse');
        $this->load->view('frontend/ofrecer_convenio', $data);
        $this->load->view('frontend/includes/footer');
    }


    public function guardar_convenio()
    {
        $error = 0;
        $this->form_validation->set_rules('titulo', 'titulo', 'required');
        $this->form_validation->set_rules('descuento', 'descuento', 'required');
        $this->form_validation->set_rules('descripcion', 'descripcion', 'required');

        if($this->form_validation->run() === FALSE){
        } else {
            $data = array(
                'id_empresa' => $this->input->post('empresa'),
                'id_rse' => $this->input->post('id_empresa'),
                'id_usuario' => 0,
                'estado_convenio' => 1,
                'titulo_convenio' => $this->input->post('titulo'),
                'descripcion_convenio' => $this->input->post('descripcion'),
                'descuento_convenio' => $this->input->post('descuento'),
                'fecha_solicitud_convenio' => date('d-m-Y'),
                'fecha_aprobacion_convenio' => '',
                'fecha_rechazo_convenio' => '',
                'comentario_convenio' => '',
                'tipo_solicitud' => 0, //esto quiere decir que es desde el portal al RSE
                'id_pais' => $this->functions->id_pais($this->functions->texto_general(7))
            );
            $insert = $this->rse->insertarConvenio($data);
            if ($insert === false){
                $error = 1;
            }
        }

        if($error == 1){
            $this->session->set_flashdata('mensaje', $this->functions->showAlertDanger('No se ha podido crear la solicitud'));
            redirect(base_url().'rse/ofrecer_convenio/' . $this->input->post('id_empresa'));
        } else {
            $this->session->set_flashdata('mensaje', $this->functions->showAlertSuccess('Tu solicitud de alianza ha sido registrada y enviada con éxito'));
            redirect(base_url().'persona');
        }
    }

    public function detalle_convenio($id)
    {
        $data['convenio'] = $this->rse->obtenerConvenio($id);
        $this->load->view('frontend/includes/header_rse');
        $this->load->view('frontend/detalle_convenio', $data);
        $this->load->view('frontend/includes/footer');
    }


    public function validar_convenio()
    {
        $this->load->view('frontend/includes/header_rse');
        $this->load->view('frontend/validar_convenio');
        $this->load->view('frontend/includes/footer');
    }


    public function ofertar($id)
    {
        $requerimiento = $this->rse->obtenerRequerimiento($id);
        $data['requerimiento'] = $requerimiento;
        $data['empresa'] = $this->rse->obtenerEmpresaRSE($requerimiento->id_empresa);
        $data['mis_empresas'] = $this->empresa->mis_empresas($this->session->id);
        $this->load->view('frontend/includes/header_rse');
        $this->load->view('frontend/ofertar_a_rse', $data);
        $this->load->view('frontend/includes/footer');
    }


    public function guardar_oferta()
    {
        $atras = $_SERVER['HTTP_REFERER'];

        $error = 0;
        $this->form_validation->set_rules('oferta', 'oferta', 'required');

        if($this->form_validation->run() === FALSE){
        } else {
            $data = array(
                'texto_oferta' => $this->input->post('oferta'),
                'fecha_oferta' => date('Y-m-d'),
                'id_requerimiento' => $this->input->post('id_requerimiento'),
                'id_empresa' => $this->input->post('empresa'),
                'id_cliente' => $this->session->id,
                'estado_oferta' => 1
            );
            $insert = $this->rse->insertarOferta($data);
            if ($insert === false){
                $error = 1;
            }
        }

        if($error == 1){
            $this->session->set_flashdata('mensaje', $this->functions->showAlertDanger('No se ha podido enviar la oferta'));
            redirect($atras);
        } else {
            $this->enviar_correo_rse($this->input->post('id_empresa'), $this->input->post('id_requerimiento'), $this->input->post('empresa'), $this->input->post('oferta'));
            $this->session->set_flashdata('mensaje', $this->functions->showAlertSuccess('Oferta registrada y enviada con éxito'));
            redirect($atras);
        }

    }


    public function enviar_correo_rse($id_rse, $id_requerimiento, $id_empresa_portal, $oferta)
    {

        $rse = $this->rse->obtenerEmpresaRSE($id_rse);
        $requerimiento = $this->rse->obtenerRequerimiento($id_requerimiento);
        $empresa_portal = $this->empresa->obtener($id_empresa_portal);

        $data = array(
            'id_empresa' => $id_empresa_portal,
            'id_rse' => $id_rse,
            'texto_notificacion' => 'Tienes una nueva oferta a una solicitud de cotizaciones enviada desde el Portal Microempresarios',
            'fecha_notificacion' => date('Y-m-d'),
            'estado_notificacion' => 0,
            'tipo_notificacion' => 1, //uno es por una oferta
            'id_registro_link' => $id_requerimiento
        );

        $this->functions->notificacion_rse($data);


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

            $data['rse'] = $rse;
            $data['empresa_portal'] = $empresa_portal;
            $data['requerimiento'] = $requerimiento;
            $data['ofertador'] = $this->session->nombre;
            $data['texto_oferta'] = $oferta;

            $this->email->to($requerimiento->email_usuario);
            $this->email->subject('Tienes una nueva oferta a una solicitud de cotizaciones');

            $body = $this->load->view('frontend/emails/oferta', $data, TRUE);
            $this->email->message($body);
            $mail = $this->email->send();
    }


    public function listado_alianzas()
    {
        $this->functions->AccessValidateFrontEnd();
        $data['cliente'] = $this->cliente->obtener($this->session->id);
        $data['publica_empresa'] = $this->cliente->empresasPublicadasPorCliente($this->session->id);
        $data['personas_sugeridas'] = $this->functions->personas_sugeridas();
        $data['empresas_sugeridas'] = $this->functions->empresas_sugeridas();
        $data['ofertas'] = $this->empresa->mis_ofertas();
        $data['alianzas'] = $this->rse->alianzas();
        $this->load->view('frontend/includes/header');
        $this->load->view('frontend/solicitudes_alianzas', $data);
        $this->load->view('frontend/includes/footer');
    }


    public function detalle_alianza($id)
    {
        $this->functions->AccessValidateFrontEnd();
        $this->functions->notificacion_rse_leida($id);
        $data['cliente'] = $this->cliente->obtener($this->session->id);
        $data['publica_empresa'] = $this->cliente->empresasPublicadasPorCliente($this->session->id);
        $data['personas_sugeridas'] = $this->functions->personas_sugeridas();
        $data['empresas_sugeridas'] = $this->functions->empresas_sugeridas();
        $data['ofertas'] = $this->empresa->mis_ofertas();
        $data['alianza'] = $this->rse->obtenerConvenio($id);
        $this->load->view('frontend/includes/header');
        $this->load->view('frontend/detalle_alianza', $data);
        $this->load->view('frontend/includes/footer');
    }


    public function responder_pregunta_alianza()
    {
        $atras = $_SERVER['HTTP_REFERER'];


        $data = array(
            'estado_convenio' => 5
        );

        $update = $this->rse->editar_convenio($data, $this->input->post('id_convenio'));

        $error = 0;
        $this->form_validation->set_rules('motivo', 'motivo', 'required');
        $convenio = $this->rse->obtenerConvenio($this->input->post('id_convenio'));

        if($this->form_validation->run() === FALSE){
        } else {
            //si pregunto desde RSE id es 1, desde micromempresario id es 2

            $data_pregunta = array(
                'id_convenio' => $this->input->post('id_convenio'),
                'origen_pregunta' => 2,
                'id_preguntador' => $this->session->id,
                'id_empresa_pregunta' => $convenio->id_empresa,
                'pregunta' => $this->input->post('motivo'), 
                'fecha_pregunta' => date('Y-m-d'),
                'hora_pregunta' => date('H:i:s')
            );

            $insert = $this->rse->ingresar_pregunta($data_pregunta);

            if ($insert === false){
                $error = 1;
            }
        }

        if($error == 1){
            $this->session->set_flashdata('mensaje', $this->functions->showAlertDanger('No se ha podido enviar la respuesta'));
            redirect($atras);
        } else {
            $this->enviar_correo_rse_respuesta($convenio->id_rse, $convenio, $this->input->post('motivo'));
            $this->session->set_flashdata('mensaje', $this->functions->showAlertSuccess('Respuesta registrada y enviada con éxito'));
            redirect($atras);
        }
    }



    public function enviar_correo_rse_respuesta($id_rse, $convenio, $respuesta)
    {

        $rse = $this->rse->obtenerEmpresaRSE($id_rse);
        $empresa_portal = $this->empresa->obtener($convenio->id_empresa);

        $data = array(
            'id_empresa' => $convenio->id_empresa,
            'id_rse' => $id_rse,
            'texto_notificacion' => 'Tienes una respuesta a una de tus preguntas de una solicitud de alianza',
            'fecha_notificacion' => date('Y-m-d'),
            'estado_notificacion' => 0,
            'tipo_notificacion' => 2, //uno es por una respuesta de convenio
            'id_registro_link' => $convenio->id_convenio
        );

        $this->functions->notificacion_rse($data);


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

            $data['rse'] = $rse;
            $data['empresa_portal'] = $empresa_portal;
            $data['convenio'] = $convenio;
            $data['ofertador'] = $this->session->nombre;
            $data['texto'] = $respuesta;

            $this->email->to($requerimiento->email_usuario);
            $this->email->subject('Tienes una nueva respuesta a una de tus preguntas');

            $body = $this->load->view('frontend/emails/respuesta', $data, TRUE);
            $this->email->message($body);
            $mail = $this->email->send();
    }



    public function solicitudes_rse()
    {
        $this->functions->AccessValidateFrontEnd();
        $data['cliente'] = $this->cliente->obtener($this->session->id);
        $data['publica_empresa'] = $this->cliente->empresasPublicadasPorCliente($this->session->id);
        $data['personas_sugeridas'] = $this->functions->personas_sugeridas();
        $data['empresas_sugeridas'] = $this->functions->empresas_sugeridas();
        $data['ofertas'] = $this->empresa->mis_ofertas();
        $data['alianzas'] = $this->rse->alianzas_desde_rse();
        $this->load->view('frontend/includes/header');
        $this->load->view('frontend/solicitudes_rse', $data);
        $this->load->view('frontend/includes/footer');
    }




    public function responder_pregunta_alianza_ajax()
    {

        $data = array(
            'estado_convenio' => 5
        );

        $update = $this->rse->editar_convenio($data, $this->input->post('id_convenio'));

        $error = 0;
        $this->form_validation->set_rules('motivo', 'motivo', 'required');
        $convenio = $this->rse->obtenerConvenio($this->input->post('id_convenio'));

        if($this->form_validation->run() === FALSE){
        } else {
            //si pregunto desde RSE id es 1, desde micromempresario id es 2

            $data_pregunta = array(
                'id_convenio' => $this->input->post('id_convenio'),
                'origen_pregunta' => 2,
                'id_preguntador' => $this->session->id,
                'id_empresa_pregunta' => $convenio->id_empresa,
                'pregunta' => $this->input->post('motivo'), 
                'fecha_pregunta' => date('Y-m-d'),
                'hora_pregunta' => date('H:i:s')
            );

            $insert = $this->rse->ingresar_pregunta($data_pregunta);

            if ($insert === false){
                $error = 1;
            }
        }

        if($error == 1){
            echo 1;
        } else {
            echo 0;
        }
    }



}
