<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rse extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
        $this->load->model('rseModel', 'rse');
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
        $data['empresas'] = $this->rse->listado_completo($registros_a_mostrar, $inicio, 0, $ordenar);
        $data['total_registros'] = ceil(count($this->rse->listado_completo($registros_a_mostrar, $inicio, 1, 0)) / $registros_a_mostrar);

        $this->load->view('frontend/includes/header_rse');
        $this->load->view('frontend/listado_empresas_rse', $data);
        $this->load->view('frontend/includes/footer');
    }


    public function ofrecer_convenio($id)
    {
        $data['empresa'] = $this->rse->obtenerEmpresaRSE($id);
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
                'id_empresa' => $this->session->id,
                'id_rse' => $this->input->post('id_empresa'),
                'id_usuario' => 0,
                'estado_convenio' => 1,
                'titulo_convenio' => $this->input->post('titulo'),
                'descripcion_convenio' => $this->input->post('descripcion'),
                'descuento_convenio' => $this->input->post('descuento'),
                'fecha_solicitud_convenio' => date('d-m-Y'),
                'fecha_aprobacion_convenio' => '',
                'fecha_rechazo_convenio' => '',
                'motivo_rechazo_convenio' => '',
                'tipo_solicitud' => 0
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
            $this->session->set_flashdata('mensaje', $this->functions->showAlertSuccess('Tu solicitud de convenio ha sido registrada y enviada con éxito'));
            redirect(base_url().'persona');
        }
    }

    public function detalle_convenio($id)
    {
        $data['convenio'] = $this->rse->obtenerConvenio($id);
        $this->load->view('frontend/includes/header');
        $this->load->view('frontend/detalle_convenio', $data);
        $this->load->view('frontend/includes/footer');
    }


}
