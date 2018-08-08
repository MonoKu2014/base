<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->load->model('serviciosModel', 'servicio');
        $this->load->model('productosModel', 'producto');
        $this->load->model('clientesModel', 'cliente');
        $this->load->model('estadosModel', 'estado');
        $this->load->model('empresasModel', 'empresa');
        $this->load->model('categoriasModel', 'categoria');
        $this->load->model('subcategoriasModel', 'subcategoria');
        $this->load->model('sub_subcategoriasModel', 'sub_subcategoria');
        $this->load->model('recomendacionesModel', 'recomendacion');
        $this->load->model('promocionesModel', 'promocion');
        $this->load->model('ticketsModel', 'ticket');
        $this->load->model('muroModel', 'muro');
    }


	public function index()
	{
		$data['categorias_todas'] = $this->categoria->listarDestacadas(1);
		$data['categorias'] = $this->categoria->listarDestacadas();
		$data['subcategorias_mobile'] = $this->subcategoria->listarDestacadas();
		$data['subcategorias_uno'] = $this->subcategoria->listarDestacadasColumnaUno();
		$data['subcategorias_dos'] = $this->subcategoria->listarDestacadasColumnaDos();
		$data['sub_subcategorias'] = $this->sub_subcategoria->listarDestacadas();
		$data['productos'] = $this->producto->listarMasBuscados();
		$data['servicios'] = $this->servicio->listarMasBuscados();
		$data['empresasUno'] = $this->empresa->listarMasRecomendadosUno();
		$data['empresasDos'] = $this->empresa->listarMasRecomendadosDos();
		$data['empresasTres'] = $this->empresa->listarMasRecomendadosTres();
		$data['requerimientos'] = $this->empresa->requerimientos();
		$this->load->view('frontend/includes/header');
		$this->load->view('frontend/inicio', $data);
		$this->load->view('frontend/includes/footer');
	}

	public function persona()
	{

		if(count($this->input->post()) > 0){
			$uno = $this->input->post('ordenar_uno');
			$dos = $this->input->post('ordenar_dos');
		} else {
			$uno = '';
			$dos = '';
		}

		$this->functions->AccessValidateFrontEnd();
		$data['persona'] = $this->cliente->obtener($this->session->id);
		$data['recomendaciones'] = $this->cliente->misRecomendaciones($this->session->id);

		$comuna_vive = $this->cliente->comunaResidencia($this->session->id);
		$data['promociones_vive'] = $this->cliente->empresasComunaResidencia($comuna_vive, $uno);
		$comuna_trabajo = $this->cliente->comunaTrabajo($this->session->id);
		$data['promociones_trabajo'] = $this->cliente->empresasComunaTrabajo($comuna_trabajo, $dos);
		$data['publica_empresa'] = $this->cliente->empresasPublicadasPorCliente($this->session->id);
		$data['uno'] = $uno;
		$data['dos'] = $dos;


		$data['personas_sugeridas'] = $this->functions->personas_sugeridas($this->session->id);
		$data['empresas_sugeridas'] = $this->functions->empresas_sugeridas($this->session->id);

		$data['muro'] = $this->muro->muro($this->session->id);

		$this->load->view('frontend/includes/header');
		$this->load->view('frontend/persona', $data);
		$this->load->view('frontend/includes/footer');
	}


	public function listado_categorias()
	{
		$data['categorias'] = $this->categoria->listar();
		$this->load->view('frontend/includes/header');
		$this->load->view('frontend/listado_categorias', $data);
		$this->load->view('frontend/includes/footer');
	}


	public function contactenos()
	{
		$this->load->view('frontend/includes/header');
		$this->load->view('frontend/contactenos');
		$this->load->view('frontend/includes/footer');
	}


	public function perfil_persona($id)
	{

		if(count($this->input->post()) > 0){
			$ordenar_uno = $this->input->post('ordenar_uno');
			$ordenar_dos = $this->input->post('ordenar_dos');
			$ordenar_tres = $this->input->post('ordenar_tres');
			$ordenar_cuatro = $this->input->post('ordenar_cuatro');
		} else {
			$ordenar_uno = '';
			$ordenar_dos = '';
			$ordenar_tres = '';
			$ordenar_cuatro = '';
		}

		$data['ordenar_uno'] = $ordenar_uno;
		$data['ordenar_dos'] = $ordenar_dos;
		$data['ordenar_tres'] = $ordenar_tres;
		$data['ordenar_cuatro'] = $ordenar_cuatro;


		$data['cliente'] = $this->cliente->obtener($id);
		$data['recomendaciones'] = $this->recomendacion->listarPorPersona($id, $ordenar_uno);
		$data['requerimientos'] = $this->functions->requerimientosPorPersona($id);
		$data['seguidores'] = $this->functions->listarSeguidoresPorPersona($id);
		$data['ayudados'] = $this->empresa->listadoDeAyudaEmpresas($id, $ordenar_cuatro);
		$data['clienteSigueEmpresas'] = $this->recomendacion->clienteSigueEmpresas($id);
		$data['clienteSiguePersonas'] = $this->recomendacion->clienteSiguePersonas($id);

		if(count($data['clienteSigueEmpresas']) == 0){

			$data['promociones'] = [];

		} else {
			foreach ($data['clienteSigueEmpresas'] as $key => $value) {
				$ids_de_empresas[] = $value->id_empresa;
			}

			$data['promociones'] = $this->promocion->listarPorMuchasEmpresas($ids_de_empresas);

		}

		$this->load->view('frontend/includes/header');
		$this->load->view('frontend/perfil_persona', $data);
		$this->load->view('frontend/includes/footer');

	}


	public function contactar()
	{
        $nombre = $this->input->post('nombre');
        $asunto = $this->input->post('asunto');
        $fono = $this->input->post('fono');
        $comentarios = $this->input->post('comentarios');
        $email = $this->input->post('email');
        $texto = '';

        $para = 'contacto@portalmicroempresarios.com';

        $texto = "<b>FORMULARIO CONTACTO</b><br />";
        $texto.="<br />Fecha <b>".date('d-m-Y')."</b>";

        $texto.="<br />Nombre: ".$nombre;
        $texto.="<br />Asunto: ".$asunto;
        $texto.="<br />Fono: ".$fono;
        $texto.="<br />Comentarios: ".$comentarios;

        $desde = "From: ".$email." \r\nContent-type: text/html\r\n";

        if (mail($para , "FORMULARIO CONTACTO", $texto, $desde)){
            $this->session->set_flashdata('mensaje', $this->functions->showAlertDanger('Lo sentimos, hubo un problema al enviar su mensaje.'));
            redirect(base_url().'contactenos');
        } else {
            $this->session->set_flashdata('mensaje', $this->functions->showAlertSuccess('Mensaje enviado con éxito.'));
            redirect(base_url().'contactenos');
        }

	}

	public function editar_persona()
	{
		$this->functions->AccessValidateFrontEnd();
		$data['cliente'] = $this->cliente->obtener($this->session->id);
		$data['regiones'] = $this->functions->listarRegiones();
		$this->load->view('frontend/includes/header');
		$this->load->view('frontend/editar_persona', $data);
		$this->load->view('frontend/includes/footer');
	}


	public function guarda_edicion_persona()
	{
		$this->functions->AccessValidateFrontEnd();

		$error = 0;
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('region-vives', 'Region', 'required');
        $this->form_validation->set_rules('comuna-vives', 'Comuna', 'required');
        $this->form_validation->set_rules('region', 'Region', 'required');
        $this->form_validation->set_rules('comuna', 'Comuna', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if($this->form_validation->run() === FALSE){
            $error = 1;
        } else {
        	$data = array(
        		'nombre_cliente' => $this->input->post('nombre'),
        		'region_cliente' => $this->input->post('region-vives'),
        		'comuna_cliente' => $this->input->post('comuna-vives'),
        		'region_trabajo_cliente' => $this->input->post('region'),
        		'comuna_trabajo_cliente' => $this->input->post('comuna'),
        		'email_cliente' => $this->input->post('email'),
        		'password_cliente' => $this->input->post('password'),
				'id_estado' => 1);
        	$editar = $this->cliente->editar($data, $this->session->id);
        	if ($insert === false){
        		$error = 1;
        	}
        }

        if($error == 1){
            $this->session->set_flashdata('mensaje', $this->functions->showAlertDanger('Lo sentimos, hubo un problema al editar su cuenta.'));
            redirect(base_url().'editar_persona');
        } else {
            $this->session->set_flashdata('mensaje', $this->functions->showAlertSuccess('Su cuenta ha sido editada con éxito'));
            redirect(base_url().'persona');
        }

	}


	public function invitar()
	{
		$this->functions->AccessValidateFrontEnd();
		$this->load->view('frontend/includes/header');
		$this->load->view('frontend/invitar');
		$this->load->view('frontend/includes/footer');
	}


	public function enviar_invitaciones()
	{
		$this->functions->AccessValidateFrontEnd();
		$emails = explode(',', $this->input->post('correos'));
		$email = $this->session->email;

		$x = 1;
		foreach ($emails as $key => $value) {

	        $texto = '';

	        $para = $value;

	        $texto = "<b>INVITACIÓN PORTAL MICROEMPRESARIO</b><br />";
	        $texto.="<br />Fecha <b>".date('d-m-Y')."</b>";

	        $texto.="<br />Nuestro cliente: ".$this->session->nombre." te ha enviado una invitación para ser parte de nuestro portal";

	        $texto.="<br />Visita: www.portalmicroempresario.com y disfruta de nuestros beneficios!";

	        $desde = "From: ".$email." \r\nContent-type: text/html\r\n";

	        mail($para , "INVITACION PORTAL MICROEMPRESARIO", $texto, $desde);
	        $x++;
	        if($x == 10){
	        	break;
	        }

		}

			$this->session->set_flashdata('mensaje', $this->functions->showAlertSuccess('Invitaciones enviadas con éxito.'));
	        redirect(base_url().'invitar');

	}


	public function publicar_microempresario_ayuda()
	{
		$this->load->view('frontend/includes/header');
		$this->load->view('frontend/publicar_microempresario_ayuda');
		$this->load->view('frontend/includes/footer');
	}

	public function ayuda()
	{
		$this->load->view('frontend/includes/header');
		$this->load->view('frontend/ayuda');
		$this->load->view('frontend/includes/footer');
	}


	public function acerca_de()
	{
		$this->load->view('frontend/includes/header');
		$this->load->view('frontend/acerca_de');
		$this->load->view('frontend/includes/footer');
	}


	public function beneficios()
	{
		$this->load->view('frontend/includes/header');
		$this->load->view('frontend/beneficios');
		$this->load->view('frontend/includes/footer');
	}



	public function beneficios_inscritos()
	{
		$this->load->view('frontend/includes/header');
		$this->load->view('frontend/beneficios_inscritos');
		$this->load->view('frontend/includes/footer');
	}


	public function recomendar()
	{
		$this->load->view('frontend/includes/header');
		$this->load->view('frontend/recomendar');
		$this->load->view('frontend/includes/footer');
	}

	public function seguir_promociones()
	{
		$this->load->view('frontend/includes/header');
		$this->load->view('frontend/seguir_promociones');
		$this->load->view('frontend/includes/footer');
	}

	public function seguir_recomendaciones()
	{
		$this->load->view('frontend/includes/header');
		$this->load->view('frontend/seguir_recomendaciones');
		$this->load->view('frontend/includes/footer');
	}


	public function registrarse()
	{
		$this->load->view('frontend/includes/header');
		$this->load->view('frontend/registrarse');
		$this->load->view('frontend/includes/footer');
	}


	public function mis_notificaciones()
	{
		$this->functions->AccessValidateFrontEnd();
		$data['cliente'] = $this->cliente->obtener($this->session->id);
		$data['publica_empresa'] = $this->cliente->empresasPublicadasPorCliente($this->session->id);
		$data['personas_sugeridas'] = $this->functions->personas_sugeridas();
		$data['empresas_sugeridas'] = $this->functions->empresas_sugeridas();
		$data['notificaciones'] = $this->functions->notificaciones_persona($this->session->id, 1);
		$this->load->view('frontend/includes/header');
		$this->load->view('frontend/mis_notificaciones', $data);
		$this->load->view('frontend/includes/footer');
	}

/******************************************************************************************************************************************/

	public function registro_paso_uno()
	{
		$this->load->view('frontend/includes/header');
		$this->load->view('frontend/registro-paso-1');
		$this->load->view('frontend/includes/footer');
	}


	public function registro_paso_dos()
	{
		$this->load->view('frontend/includes/header_int');
		$this->load->view('frontend/registro-paso-2');
		$this->load->view('frontend/includes/footer');
	}


	public function registro_paso_tres()
	{
		$this->load->view('frontend/includes/header_int');
		$this->load->view('frontend/registro-paso-3');
		$this->load->view('frontend/includes/footer');
	}


	public function registro_paso_cuatro()
	{
		$this->functions->AccessValidateFrontEnd();
		$this->load->view('frontend/includes/header');
		$this->load->view('frontend/registro-paso-4');
		$this->load->view('frontend/includes/footer');
	}



	public function publicar_paso_uno()
	{
		$this->functions->AccessValidateFrontEnd();
		$this->load->view('frontend/includes/header');
		$this->load->view('frontend/publicar-paso-1');
		$this->load->view('frontend/includes/footer');
	}


	public function publicar_paso_dos()
	{
		$this->functions->AccessValidateFrontEnd();
		$this->load->view('frontend/includes/header');
		$this->load->view('frontend/publicar-paso-2');
		$this->load->view('frontend/includes/footer');
	}


	public function publicar_paso_tres()
	{
		$this->functions->AccessValidateFrontEnd();
		$this->load->view('frontend/includes/header');
		$this->load->view('frontend/publicar-paso-3');
		$this->load->view('frontend/includes/footer');
	}


	public function publicar_paso_cuatro()
	{
		$this->functions->AccessValidateFrontEnd();
		$this->load->view('frontend/includes/header');
		$this->load->view('frontend/publicar-paso-4');
		$this->load->view('frontend/includes/footer');
	}


	public function agregar_requerimiento()
	{
		$this->functions->AccessValidateFrontEnd();
		$data['cliente'] = $this->cliente->obtener($this->session->id);
		$data['publica_empresa'] = $this->cliente->empresasPublicadasPorCliente($this->session->id);
		$data['personas_sugeridas'] = $this->functions->personas_sugeridas();
		$data['empresas_sugeridas'] = $this->functions->empresas_sugeridas();
		$this->load->view('frontend/includes/header');
		$this->load->view('frontend/agregar_requerimiento', $data);
		$this->load->view('frontend/includes/footer');
	}


	public function mis_requerimientos()
	{
		$this->functions->AccessValidateFrontEnd();
		$data['cliente'] = $this->cliente->obtener($this->session->id);
		$data['publica_empresa'] = $this->cliente->empresasPublicadasPorCliente($this->session->id);
		$data['personas_sugeridas'] = $this->functions->personas_sugeridas();
		$data['empresas_sugeridas'] = $this->functions->empresas_sugeridas();
		$data['requerimientos'] = $this->empresa->mis_requerimientos();
		$this->load->view('frontend/includes/header');
		$this->load->view('frontend/mis_requerimientos', $data);
		$this->load->view('frontend/includes/footer');
	}


	public function mis_ofertas()
	{
		$this->functions->AccessValidateFrontEnd();
		$data['cliente'] = $this->cliente->obtener($this->session->id);
		$data['publica_empresa'] = $this->cliente->empresasPublicadasPorCliente($this->session->id);
		$data['personas_sugeridas'] = $this->functions->personas_sugeridas();
		$data['empresas_sugeridas'] = $this->functions->empresas_sugeridas();
		$data['ofertas'] = $this->empresa->mis_ofertas();
		$this->load->view('frontend/includes/header');
		$this->load->view('frontend/mis_ofertas', $data);
		$this->load->view('frontend/includes/footer');
	}


	public function requerimientos()
	{

		if(count($_POST) > 0){
			$data_post = $this->input->post();
			$data['categoria'] = $this->input->post('categoria');
			$data['subcategoria'] = $this->input->post('subcategoria');
			$data['region'] = $this->input->post('region');
			$data['comuna'] = $this->input->post('comuna');
			$data['fecha'] = $this->input->post('fecha');
			$data['estado'] = $this->input->post('estado');
		} else {
			$data_post = '';
			$data['categoria'] = '';
			$data['subcategoria'] = '';
			$data['region'] = '';
			$data['comuna'] = '';
			$data['fecha'] = '';
			$data['estado'] = 2;
		}

		$data['categorias'] = $this->categoria->listar();
		$data['requerimientos'] = $this->empresa->ver_todos_requerimientos($data_post);
		$this->load->view('frontend/includes/header');
		$this->load->view('frontend/requerimientos', $data);
		$this->load->view('frontend/includes/footer');
	}

	public function detalle_requerimiento($id)
	{
		$data['requerimiento'] = $this->empresa->obtener_requerimiento($id);
		$this->load->view('frontend/includes/header');
		$this->load->view('frontend/detalle_requerimiento', $data);
		$this->load->view('frontend/includes/footer');
	}


	public function enviar_oferta()
	{
		$oferta = $this->input->post('oferta');
		$id_cliente = $this->input->post('id_cliente');
		$email_cliente = $this->input->post('email_cliente');
		$nombre_cliente = $this->input->post('nombre_cliente');
		$id_requerimiento = $this->input->post('id_requerimiento');
		$data = array(
			'fecha_oferta' => date('Y-m-d'),
			'hora_oferta'  => date('H:i:s'),
			'texto_oferta' => $oferta,
			'estado_oferta' => 1,
			'respuesta_oferta' => 0,
			'id_cliente' => $id_cliente,
			'id_ofertador' => $this->session->id,
			'id_requerimiento' => $id_requerimiento
		);

		$this->empresa->insertar_oferta($data);
        $id_oferta = $this->db->insert_id();
		self::enviar_correo_oferta($email_cliente, $nombre_cliente, $oferta);
		self::guardar_notificacion_oferta_link($id_cliente, 'Te ha enviado una oferta a una solicitud de cotizaciones', $id_oferta);
		$this->session->set_flashdata('mensaje', $this->functions->showAlertSuccess('Oferta enviada con éxito.'));
	    redirect(base_url().'persona');
	}


	public function enviar_correo_oferta($email, $nombre, $oferta)
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

            $this->email->from($this->session->email, $this->session->nombre);

            $data['nombre'] = $nombre;
            $data['oferta'] = $oferta;
            $data['ofertador'] = $this->session->nombre;

            $this->email->to($email);
            $this->email->subject('Tienes una oferta en tu solicitud de cotizaciones');

            $body = $this->load->view('frontend/emails/oferta', $data, TRUE);
            $this->email->message($body);
            $mail = $this->email->send();
	}


	public function ofertas_requerimiento($id)
	{
		$this->functions->AccessValidateFrontEnd();
		$data['cliente'] = $this->cliente->obtener($this->session->id);
		$data['publica_empresa'] = $this->cliente->empresasPublicadasPorCliente($this->session->id);
		$data['personas_sugeridas'] = $this->functions->personas_sugeridas();
		$data['empresas_sugeridas'] = $this->functions->empresas_sugeridas();
		$data['ofertas'] = $this->empresa->ofertas_requerimientos($id);
		$data['requerimiento'] = $this->empresa->obtener_requerimiento($id);
		$this->load->view('frontend/includes/header');
		$this->load->view('frontend/ofertas_requerimiento', $data);
		$this->load->view('frontend/includes/footer');
	}



    public function guardar_notificacion_persona($id_cliente, $texto)
    {
        $data = array(
            'id_cliente' => $id_cliente,
            'id_href' => $this->session->id,
            'texto_notificacion' => '<b>'.$this->session->nombre.'</b> '.$texto,
            'fecha_notificacion' => date('Y-m-d'),
            'estado_notificacion' => 0
            );
        $this->functions->notificar_persona($data);
    }



    public function productos_mas_buscados()
    {
		$data['productos'] = $this->producto->listarMasBuscados(1);
		$this->load->view('frontend/includes/header');
		$this->load->view('frontend/productos_mas_buscados', $data);
		$this->load->view('frontend/includes/footer');
    }

	public function servicios_mas_buscados()
	{
		$data['servicios'] = $this->servicio->listarMasBuscados(1);
		$this->load->view('frontend/includes/header');
		$this->load->view('frontend/servicios_mas_buscados', $data);
		$this->load->view('frontend/includes/footer');
	}

	public function mas_recomendados()
	{
		if(count($this->input->post()) > 0){
			$data['ordenar'] = $this->input->post('ordenar');
		} else {
			$data['ordenar'] = '';
		}
		$data['microempresarios'] = $this->empresa->listarMasRecomendados($data);
		$this->load->view('frontend/includes/header');
		$this->load->view('frontend/mas_recomendados', $data);
		$this->load->view('frontend/includes/footer');
	}


    public function solicitudes()
    {
        $this->functions->AccessValidateFrontEnd();
        $data['cliente'] = $this->cliente->obtener($this->session->id);
        $data['publica_empresa'] = $this->cliente->empresasPublicadasPorCliente($this->session->id);
        $data['personas_sugeridas'] = $this->functions->personas_sugeridas();
        $data['empresas_sugeridas'] = $this->functions->empresas_sugeridas();

        $datos = $this->cliente->IDsempresasPublicadasPorCliente($this->session->id);
        $empresas = [];

        foreach ($datos as $key => $value) {
            array_push($empresas, $value->id_empresa);
        }

        $data['ofertas'] = $this->empresa->solicitudes_para_mi($empresas);

        $this->load->view('frontend/includes/header');
        $this->load->view('frontend/solicitudes', $data);
        $this->load->view('frontend/includes/footer');
    }



    public function ofertas_recibidas()
    {
        $this->functions->AccessValidateFrontEnd();
        $data['cliente'] = $this->cliente->obtener($this->session->id);
        $data['publica_empresa'] = $this->cliente->empresasPublicadasPorCliente($this->session->id);
        $data['personas_sugeridas'] = $this->functions->personas_sugeridas();
        $data['empresas_sugeridas'] = $this->functions->empresas_sugeridas();
        $data['ofertas'] = $this->empresa->ofertas_para_mi();

        $this->load->view('frontend/includes/header');
        $this->load->view('frontend/ofertas_recibidas', $data);
        $this->load->view('frontend/includes/footer');
    }

    public function guardar_notificacion_oferta_link($id_cliente, $texto, $id_of)
    {
        $data = array(
            'id_cliente' => $id_cliente,
            'id_href' => $this->session->id,
            'texto_notificacion' => '<b>'.$this->session->nombre.'</b> '.$texto,
            'fecha_notificacion' => date('Y-m-d'),
            'estado_notificacion' => 0,
            'tipo_notificacion' => 2,
            'id_oferta' => $id_of
            );
        $this->functions->notificar_persona($data);
    }



}
