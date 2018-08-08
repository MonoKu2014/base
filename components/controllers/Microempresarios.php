<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Microempresarios extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->load->model('categoriasModel', 'categoria');
        $this->load->model('subcategoriasModel', 'subcategoria');
        $this->load->model('sub_subcategoriasModel', 'sub_subcategoria');
        $this->load->model('empresasModel', 'empresa');
        $this->load->model('pagosModel', 'pagos');
        $this->load->model('empresacomentariosModel', 'Ecomentario');
        $this->load->model('productosModel', 'producto');
        $this->load->model('serviciosModel', 'servicio');
        $this->load->model('promocionesModel', 'promocion');
        $this->load->model('recomendacionesModel', 'recomendacion');
        $this->load->model('videosModel', 'video');
        $this->load->model('clientesModel', 'cliente');

    }


	public function index()
	{
		$this->load->view('frontend/includes/header');
		$this->load->view('frontend/microempresarios');
		$this->load->view('frontend/includes/footer');
	}


	public function listado_microempresarios($tipo, $id)
	{


        if(count($_POST) > 0){
            $ordenar = $this->input->post('ordenar');
        } else {
            $ordenar = 0;
        }

        $registros_a_mostrar = 30;
        if(isset($_GET['p'])){
            $pagina_actual = $_GET['p'];
            $inicio = $registros_a_mostrar * ($pagina_actual - 1);
        } else {
            $pagina_actual = 1;
            $inicio = 0;
        }

        $url = current_url().'?';

        $filtros = [];
        $query = [];

        if(isset($_GET['sc'])){
            $filtro_sc = 'sc='.$_GET['sc'];
            $url = $url.$filtro_sc.'&';
            $filtros[$filtro_sc] = $this->functions->nombreSubcategoria($_GET['sc']);
            $existe_sc_filtro = 1;
            $query[0] = $_GET['sc'];
        } else {
            $filtro_sc = '';
            $filtros[$filtro_sc] = '';
            $existe_sc_filtro = 0;
            $query[0] = 0;
        }

        if(isset($_GET['ssc'])){
            $filtro_ssc = 'ssc='.$_GET['ssc'];
            $url = $url.$filtro_ssc.'&';
            $filtros[$filtro_ssc] = $this->functions->nombreSubsubcategoria($_GET['ssc']);
            $existe_ssc_filtro = 1;
            $query[1] = $_GET['ssc'];
        } else {
            $filtro_ssc = '';
            $filtros[$filtro_ssc] = '';
            $existe_ssc_filtro = 0;
            $query[1] = 0;
        }


        if(isset($_GET['r'])){
            $filtro_r = 'r='.$_GET['r'];
            $url = $url.$filtro_r.'&';
            $filtros[$filtro_r] = $_GET['r'];
            $existe_filtro_r = 1;
            $query[2] = $_GET['r'];
            $data['nombre_region'] = $_GET['r'];
        } else {
            $filtro_r = '';
            $filtros[$filtro_r] = '';
            $existe_filtro_r = 0;
            $query[2] = '';
            $data['nombre_region'] = '';
        }


        if(isset($_GET['c'])){
            $filtro_c = 'c='.$_GET['c'];
            $url = $url.$filtro_c.'&';
            $filtros[$filtro_c] = $_GET['c'];
            $existe_filtro_c = 1;
            $query[3] = $_GET['c'];
        } else {
            $filtro_c = '';
            $filtros[$filtro_c] = '';
            $existe_filtro_c = 0;
            $query[3] = '';
        }


        if(isset($_GET['d'])){
            $filtro_d = 'd='.$_GET['d'];
            $url = $url.$filtro_d.'&';
            $filtros[$filtro_d] = $_GET['d'];
            $existe_filtro_d = 1;
            $query[4] = $_GET['d'];
        } else {
            $filtro_d = '';
            $filtros[$filtro_d] = '';
            $existe_filtro_d = 0;
            $query[4] = '';
        }


        $data['filtros'] = $filtros;
        $data['url'] = $url;
        $data['existe_sc_filtro'] = $existe_sc_filtro;
        $data['existe_ssc_filtro'] = $existe_ssc_filtro;
        $data['existe_filtro_r'] = $existe_filtro_r;
        $data['existe_filtro_c'] = $existe_filtro_c;
        $data['existe_filtro_d'] = $existe_filtro_d;

		//$tipo se refiere a cat, subcat o sub_subcat//1 es cat - 2 es subcat y 3 es sub-subcat
		if($tipo == 1){
			$data['microempresarios'] = $this->empresa->porCategoria($id, $query, $ordenar, $registros_a_mostrar, $inicio);
            $data['total_registros'] = ceil($this->empresa->totalPorCategoria($id, $query) / $registros_a_mostrar);
			$find = $this->categoria->obtener($id);
			$data['busqueda'] = $find[0]->nombre_categoria;
			$data['tipo'] = $tipo;
            $data['madre'] = $id;
            $data['subcategorias'] = $this->subcategoria->listarPorCategoria($id);
		} elseif ($tipo == 2){
            $data['microempresarios'] = $this->empresa->porSubCategoria($id, $query, $ordenar, $registros_a_mostrar, $inicio);
            $data['total_registros'] = ceil($this->empresa->totalPorSubCategoria($id, $query) / $registros_a_mostrar);
            $find = $this->subcategoria->obtener($id);
            $data['busqueda'] = $find[0]->nombre_subcategoria;
            $data['tipo'] = $tipo;
            $data['madre'] = $id;
            $data['subcategorias'] = $this->subcategoria->listarPorCategoria($this->functions->idCategoriaPorSubcategoria($id));
        } else {
            $data['microempresarios'] = $this->empresa->porSubSubCategoria($id, $query, $ordenar, $registros_a_mostrar, $inicio);
            $data['total_registros'] = ceil($this->empresa->totalPorSubSubCategoria($id, $query) / $registros_a_mostrar);
            $find = $this->sub_subcategoria->obtener($id);

            $data['busqueda'] = $find[0]->nombre_sub_subcategoria;
            $data['tipo'] = $tipo;
            $data['madre'] = $id;
            $data['subcategorias'] = $this->subcategoria->listarPorCategoria($this->functions->idCategoriaPorSubSubcategoria($id));
        }

        $ides_subcats = [];
        $id_categoria_madre = '';
        foreach ($data['subcategorias'] as $k => $v) {
            array_push($ides_subcats, $v->id_subcategoria);
            $id_categoria_madre = $v->id_categoria;
        }

        $data['ordenar'] = $ordenar;
        $data['pagina_actual'] = $pagina_actual;

        $data['sub_subcategorias'] = $this->sub_subcategoria->sub_subcategoriasPorSubcategoria($ides_subcats);
        $data['id_categoria'] = $id_categoria_madre;

		$this->load->view('frontend/includes/header');
		$this->load->view('frontend/microempresarios', $data);
		$this->load->view('frontend/includes/footer');

	}


	public function detalle($tipo, $id, $madre = null)
	{
		$data['microempresario'] = $this->empresa->obtener($id);
		$data['tipo'] = $tipo;
        $data['madre'] = $madre;
		$data['pagos'] = $this->pagos->listarPorEmpresa($id);
        $data['productos'] = $this->producto->listarPorEmpresa($id);
        $data['servicios'] = $this->servicio->listarPorEmpresa($id);
        $data['productosMain'] = $this->producto->listarPorEmpresaPrincipales($id);
        $data['promociones'] = $this->promocion->listarPorEmpresaSoloID($id);
        $data['otras_empresas'] = $this->empresa->listarEmpresasPorSector($data['microempresario'][0]->comuna_empresa, $id);
        $data['videos'] = $this->video->listarPorEmpresaSoloDos($id);
		$this->load->view('frontend/includes/header');
		$this->load->view('frontend/detalle', $data);
		$this->load->view('frontend/includes/footer');
	}


	public function microempresario($id_empresa)
	{
		$this->functions->AccessValidateFrontEnd();
		$data['empresa'] = $this->empresa->obtener($id_empresa);
		$data['pagos'] = $this->pagos->listarPorEmpresa($id_empresa);
		$data['productos'] = $this->producto->listarTodosPorEmpresa($id_empresa);
		$data['servicios'] = $this->servicio->listarTodosPorEmpresa($id_empresa);
		$data['promociones'] = $this->promocion->listarPorEmpresa($id_empresa);
        $data['recomendaciones'] = $this->recomendacion->listarPorEmpresa($id_empresa);
		$this->load->view('frontend/includes/header');
		$this->load->view('frontend/microempresario', $data);
		$this->load->view('frontend/includes/footer');
	}


	public function publica()
	{
		$this->load->view('frontend/includes/header');
		$this->load->view('frontend/publica');
		$this->load->view('frontend/includes/footer');
	}


	public function publica_microempresario()
	{
		$data['categorias'] = $this->categoria->listar();
		$data['pagos'] = $this->pagos->listar();
		$data['regiones'] = $this->functions->listarRegiones();
		$this->load->view('frontend/includes/header');
		$this->load->view('frontend/publica_microempresario', $data);
		$this->load->view('frontend/includes/footer');
	}


	public function guarda_microempresario()
	{
		$subcategorias = explode(',', $this->input->post('subcategorias'));
		$sub_subcategorias = explode(',', $this->input->post('sub_subcategorias'));

		$error = 0;

        $this->form_validation->set_rules('empresa', 'Nombre Fantasia', 'required');
        $this->form_validation->set_rules('categoria', 'Categoria', 'required');
        $this->form_validation->set_rules('region', 'Region', 'required');
        $this->form_validation->set_rules('comuna', 'Comuna', 'required');
        $this->form_validation->set_rules('avenida', 'Avenida', 'required');
        $this->form_validation->set_rules('numero', 'Numero', 'required|numeric');
        $this->form_validation->set_rules('celular', 'Celular', 'required|numeric');



        if($this->form_validation->run() === FALSE){
            $error = 1;
        } else {
        	$data = array(
        		'id_categoria' => $this->input->post('categoria'),
        		'nombre_empresa' => $this->input->post('empresa'),
        		'region_empresa' => $this->input->post('region'),
        		'comuna_empresa' => $this->input->post('comuna'),
        		'calle_empresa' => $this->input->post('avenida'),
        		'numero_calle_empresa' => $this->input->post('numero'),
        		'celular_empresa' => $this->input->post('celular'),
        		'fono_empresa' => $this->input->post('fono'),
        		'sitio_empresa' => '',
        		'descripcion_empresa' => $this->input->post('descripcion'),
        		'despacho_empresa' => $this->input->post('despacho'),
        		'id_estado' => 1,
                'id_cliente' => $this->session->id);
        	$insert = $this->empresa->insertar($data);
        	$id_insertado = $this->db->insert_id();

        	foreach ($subcategorias as $s) {
        		$data = array('id_empresa' => $id_insertado, 'id_subcategoria' => $s);
        		$insert = $this->empresa->insertarSubcategoriasEmpresa($data);
        		unset($data);
        	}

        	foreach ($sub_subcategorias as $s) {
        		$data = array('id_empresa' => $id_insertado, 'id_sub_subcategoria' => $s);
        		$insert = $this->empresa->insertarSub_subcategoriasEmpresa($data);
        		unset($data);
        	}

        }

        if($error == 1){
            echo json_encode(
                    array(
                        'mensaje' => 'Complete los campos obligatorios',
                        'estado'  => 1
                    )
            );
        } else {
            echo json_encode(
                    array(
                        'mensaje' => 'negocio creado con éxito',
                        'estado'  => 0
                    )
            );
        }

	}


    public function crear_promocion($id_empresa)
    {
        $this->functions->AccessValidateFrontEnd();
        $data['productos'] = $this->producto->listarPorEmpresa($id_empresa);
        $data['servicios'] = $this->servicio->listarPorEmpresa($id_empresa);
        $data['id_empresa'] = $id_empresa;
        $this->load->view('frontend/includes/header');
        $this->load->view('frontend/crear_promocion', $data);
        $this->load->view('frontend/includes/footer');
    }


    public function agregar_producto($id_empresa)
    {

        $this->functions->AccessValidateFrontEnd();
        $data['help'] = 'Las imágenes con dimensiones mayores a 500x300 px serán cortadas automáticamente al tamaño sugerido';
        $data['sub_subcategorias'] = $this->sub_subcategoria->listarPorEmpresa($id_empresa);
        $data['id_empresa'] = $id_empresa;
        $this->load->view('frontend/includes/header');
        $this->load->view('frontend/agregar_producto', $data);
        $this->load->view('frontend/includes/footer');

    }


    public function guardar_producto($id_empresa)
    {

        $error = 0;
        $directorio = 'components/empresas/productos/';
        $this->load->library('Watimage', NULL, 'Watimage');

        if($_FILES['imagenes']['name'][0] == ''){
            $this->session->set_flashdata('mensaje', $this->functions->showAlertDanger('Debe ingresar mínimo una imagen.'));
            redirect(base_url().'agregar_producto/'.$id_empresa);
        }


            $this->form_validation->set_rules('nombre', 'Producto', 'required');
            $this->form_validation->set_rules('categoria', 'Categoria', 'required');
            $this->form_validation->set_rules('precio', 'Precio', 'required');
            if($this->form_validation->run() === FALSE){
                $error = 1;
            } else {
                $data = array(
                    'nombre_producto' => $this->functions->sanitizeString($this->input->post('nombre')),
                    'id_sub_sub_categoria' => $this->functions->sanitizeString($this->input->post('categoria')),
                    'precio_producto' => $this->functions->sanitizeString($this->input->post('precio')),
                    'descripcion_producto' => $this->functions->sanitizeString($this->input->post('descripcion')),
                    'especificacion_producto' => $this->functions->sanitizeString($this->input->post('especificacion')),
                    'id_empresa' => $id_empresa,
                    'id_estado' => 1);

                    $insert = $this->producto->insertar($data);
                    $id_insertado = $this->db->insert_id();

                    //insertando vista
                    $array = array('id_producto' => $id_insertado, 'cantidad_vistas' => 0);
                    $insert = $this->producto->insertarVistas($array);

                        foreach ($_FILES['imagenes']['error'] as $key => $error) {
                            if ($error == UPLOAD_ERR_OK){
                                $nombre = $this->functions->nuevo_nombre().'.'.pathinfo($_FILES["imagenes"]["name"][$key])['extension'];
                                copy($_FILES["imagenes"]["tmp_name"][$key], $directorio.$nombre);
                            }
                                $wm = new Watimage($directorio.$nombre);
                                $wm->resize(array('type' => 'resizecrop', 'quality' => 100 ,'size' => array(500, 300)));
                                if (!$wm->generate($directorio.$nombre)){

                                }

                            $dataImagen = array('nombre_imagen' => $nombre, 'id_producto' => $id_insertado);
                            $insert = $this->producto->insertarImagen($dataImagen);
                            unset($dataImagen);
                        }

            }

        if($error == 1){
            $this->session->set_flashdata('mensaje', $this->functions->showAlertDanger('Lo sentimos, hubo un problema al ingresar su producto.'));
            redirect(base_url().'agregar_producto/'.$id_empresa);
        } else {
            $this->session->set_flashdata('mensaje', $this->functions->showAlertSuccess('producto ingresado correctamente'));
            redirect(base_url().'microempresario/'.$id_empresa);
        }

    }


    public function agregar_servicio($id_empresa)
    {

        $this->functions->AccessValidateFrontEnd();
        $data['help'] = 'Las imágenes con dimensiones mayores a 500x300 px serán cortadas automáticamente al tamaño sugerido';
        $data['sub_subcategorias'] = $this->sub_subcategoria->listarPorEmpresa($id_empresa);
        $data['id_empresa'] = $id_empresa;
        $this->load->view('frontend/includes/header');
        $this->load->view('frontend/agregar_servicio', $data);
        $this->load->view('frontend/includes/footer');

    }




    public function guardar_servicio($id_empresa)
    {

        $error = 0;
        $directorio = 'components/empresas/servicios/';
        $this->load->library('Watimage', NULL, 'Watimage');

        if($_FILES['imagenes']['name'][0] == ''){
        $this->session->set_flashdata('mensaje', $this->functions->showAlertDanger('Debe ingresar mínimo una imagen.'));
            redirect(base_url().'agregar_servicio/'.$id_empresa);
        }

            $this->form_validation->set_rules('nombre', 'Servicio', 'required');
            $this->form_validation->set_rules('categoria', 'Categoria', 'required');
            $this->form_validation->set_rules('precio', 'Precio', 'required|numeric');
            if($this->form_validation->run() === FALSE){
                $error = 1;
            } else {
                $data = array(
                    'nombre_servicio' => $this->functions->sanitizeString($this->input->post('nombre')),
                    'id_sub_sub_categoria' => $this->functions->sanitizeString($this->input->post('categoria')),
                    'precio_servicio' => $this->functions->sanitizeString($this->input->post('precio')),
                    'descripcion_servicio' => $this->functions->sanitizeString($this->input->post('descripcion')),
                    'especificacion_servicio' => $this->functions->sanitizeString($this->input->post('especificacion')),
                    'id_empresa' => $id_empresa,
                    'id_estado' => 1);

                    $insert = $this->servicio->insertar($data);
                    $id_insertado = $this->db->insert_id();

                    //insertando vista
                    $array = array('id_servicio' => $id_insertado, 'cantidad_vistas' => 0);
                    $insert = $this->servicio->insertarVistas($array);

                        foreach ($_FILES['imagenes']['error'] as $key => $error) {
                            if ($error == UPLOAD_ERR_OK){
                                $nombre = $this->functions->nuevo_nombre().'.'.pathinfo($_FILES["imagenes"]["name"][$key])['extension'];
                                copy($_FILES["imagenes"]["tmp_name"][$key], $directorio.$nombre);
                            }
                                $wm = new Watimage($directorio.$nombre);
                                $wm->resize(array('type' => 'resizecrop', 'quality' => 100 ,'size' => array(500, 300)));
                                if (!$wm->generate($directorio.$nombre)){
                                   $error = 1;
                                }

                            $dataImagen = array('nombre_imagen' => $nombre, 'id_servicio' => $id_insertado);
                            $insert = $this->servicio->insertarImagen($dataImagen);
                            unset($dataImagen);
                        }

            }

        if($error == 1){
            $this->session->set_flashdata('mensaje', $this->functions->showAlertDanger('Lo sentimos, hubo un problema al ingresar su servicio.'));
            redirect(base_url().'agregar_producto/'.$id_empresa);
        } else {
            $this->session->set_flashdata('mensaje', $this->functions->showAlertSuccess('servicio ingresado correctamente'));
            redirect(base_url().'microempresario/'.$id_empresa);
        }

    }



	public function publica_tercero()
	{
        $data['categorias'] = $this->categoria->listar();
        $data['pagos'] = $this->pagos->listar();
        $data['regiones'] = $this->functions->listarRegiones();
        if($this->session->perfil == 0){
            $data['cliente'] = $this->cliente->obtener($this->session->id);
        } else {
            $data['cliente'] = [];
        }

		$this->load->view('frontend/includes/header');
		$this->load->view('frontend/publica_tercero', $data);
		$this->load->view('frontend/includes/footer');
	}




	public function producto($tipo, $madre, $id_empresa, $id)
	{
        $data['producto'] = $this->producto->obtener($id);
        $data['tipo'] = $tipo;
        $data['madre'] = $madre;
        $data['id_empresa'] = $id_empresa;
        $data['empresa'] = $this->empresa->obtener($id_empresa);
        $data['imagenes'] = $this->functions->ImagenesProductos($id);
        $data['promocion'] = $this->functions->PromocionesProductos($id);
        $data['pagos'] = $this->pagos->listarPorEmpresa($id_empresa);
        $data['productos'] = $this->producto->listarPorEmpresaExceptoProducto($id_empresa, $id);
        $data['servicios'] = $this->servicio->listarPorEmpresa($id_empresa);
		$this->load->view('frontend/includes/header');
		$this->load->view('frontend/producto', $data);
		$this->load->view('frontend/includes/footer');
	}


	public function servicio($tipo, $madre, $id_empresa, $id)
	{
        $data['servicio'] = $this->servicio->obtener($id);
        $data['tipo'] = $tipo;
        $data['madre'] = $madre;
        $data['id_empresa'] = $id_empresa;
        $data['empresa'] = $this->empresa->obtener($id_empresa);
        $data['imagenes'] = $this->functions->ImagenesServicios($id);
        $data['promocion'] = $this->functions->PromocionesServicios($id);
        $data['pagos'] = $this->pagos->listarPorEmpresa($id_empresa);
        $data['productos'] = $this->producto->listarPorEmpresa($id_empresa);
        $data['servicios'] = $this->servicio->listarPorEmpresaExceptoServicio($id_empresa, $id);
		$this->load->view('frontend/includes/header');
		$this->load->view('frontend/servicio', $data);
		$this->load->view('frontend/includes/footer');
	}



    public function editar($id_empresa)
    {
        $this->functions->AccessValidateFrontEnd();
        $data['empresa'] = $this->empresa->obtener($id_empresa);
        $data['categorias'] = $this->categoria->listar();
        $data['pagos'] = $this->pagos->listar();
        $data['regiones'] = $this->functions->listarRegiones();
        $this->load->view('frontend/includes/header');
        $this->load->view('frontend/editar_microempresario', $data);
        $this->load->view('frontend/includes/footer');
    }



    public function busqueda($term)
    {
        $term = str_replace('%20', ' ', $term);
        $term = str_replace('%C3%B1', 'ñ', $term);
        $term = str_replace('%C3%A1', 'á', $term);
        $term = str_replace('%C3%A9', 'é', $term);
        $term = str_replace('%C3%AD', 'í', $term);
        $term = str_replace('%C3%B3', 'ó', $term);
        $term = str_replace('%C3%BA', 'ú', $term);

        $busqueda = $this->empresa->buscarEmpresas($term);
        $datos = array();
        foreach($busqueda as $key => $value){
            $datos['madre'] = $value->id_sub_subcategoria;
        }

        redirect(base_url().'microempresarios/3/'.$datos['madre']);

    }



    public function listado_productos($tipo, $madre, $id_empresa)
    {
        $data['tipo'] = $tipo;
        $data['madre'] = $madre;
        $data['id_empresa'] = $id_empresa;
        $data['productos'] = $this->producto->listarTodosPorEmpresa($id_empresa, 1);
        $data['microempresario'] = $this->empresa->obtener($id_empresa);
        $data['otras_empresas'] = $this->empresa->listarEmpresasPorSector($data['microempresario'][0]->comuna_empresa, $id_empresa);
        $this->load->view('frontend/includes/header');
        $this->load->view('frontend/listado_productos', $data);
        $this->load->view('frontend/includes/footer');
    }


    public function listado_servicios($tipo, $madre, $id_empresa)
    {

        $data['tipo'] = $tipo;
        $data['madre'] = $madre;
        $data['id_empresa'] = $id_empresa;
        $data['servicios'] = $this->servicio->listarTodosPorEmpresa($id_empresa, 1);
        $data['microempresario'] = $this->empresa->obtener($id_empresa);
        $data['otras_empresas'] = $this->empresa->listarEmpresasPorSector($data['microempresario'][0]->comuna_empresa, $id_empresa);
        $this->load->view('frontend/includes/header');
        $this->load->view('frontend/listado_servicios', $data);
        $this->load->view('frontend/includes/footer');
    }


    public function editar_producto($id)
    {

        $this->functions->AccessValidateFrontEnd();
        $data['help'] = 'Las imágenes con dimensiones mayores a 500x300 px serán cortadas automáticamente al tamaño sugerido';
        $data['producto'] = $this->producto->obtener($id);
        $data['sub_subcategorias'] = $this->sub_subcategoria->listarPorEmpresa($data['producto'][0]->id_empresa);
        $this->load->view('frontend/includes/header');
        $this->load->view('frontend/editar_producto', $data);
        $this->load->view('frontend/includes/footer');

    }


    public function guardar_edicion_producto()
    {

        $id = $this->input->post('id_producto');
        $error = 0;
        $directorio = 'components/empresas/productos/';
        $this->load->library('Watimage', NULL, 'Watimage');
        //el primero del array de imágenes, si ese viene vacío, no hay nada.
        $imagenes = $_FILES['imagenes']['name'][0];

            $this->form_validation->set_rules('nombre', 'Producto', 'required');
            $this->form_validation->set_rules('categoria', 'Categoria', 'required');
            $this->form_validation->set_rules('precio', 'Precio', 'required|numeric');
            if($this->form_validation->run() === FALSE){
                $error = 1;
            } else {
                $data = array(
                    'nombre_producto' => $this->functions->sanitizeString($this->input->post('nombre')),
                    'id_sub_sub_categoria' => $this->functions->sanitizeString($this->input->post('categoria')),
                    'precio_producto' => $this->functions->sanitizeString($this->input->post('precio')),
                    'descripcion_producto' => $this->functions->sanitizeString($this->input->post('descripcion')),
                    'especificacion_producto' => $this->functions->sanitizeString($this->input->post('especificacion'))
                    );

                    $insert = $this->producto->editar($data, $id);

                    if($_FILES['imagenes']['name'][0] != ''){
                        foreach ($_FILES['imagenes']['error'] as $key => $error) {
                            if ($error == UPLOAD_ERR_OK){
                                $nombre = $this->functions->nuevo_nombre().'.'.pathinfo($_FILES["imagenes"]["name"][$key])['extension'];
                                copy($_FILES["imagenes"]["tmp_name"][$key], $directorio.$nombre);
                            }
                                $wm = new Watimage($directorio.$nombre);
                                $wm->resize(array('type' => 'resizecrop', 'quality' => 100 ,'size' => array(500, 300)));
                                if (!$wm->generate($directorio.$nombre)){
                                   $error = 1;
                                }

                            $dataImagen = array('nombre_imagen' => $nombre, 'id_producto' => $id);
                            $insert = $this->producto->insertarImagen($dataImagen);
                            unset($dataImagen);
                        }
                    }
            }

        if($error == 1){
            $this->session->set_flashdata('mensaje', $this->functions->showAlertDanger('Lo sentimos, hubo un problema al editar su producto.'));
            redirect(base_url().'editar_producto/'.$id);
        } else {
            $this->session->set_flashdata('mensaje', $this->functions->showAlertSuccess('producto editado correctamente'));
            redirect(base_url().'microempresario/' . $this->input->post('id_empresa'));
        }

    }



    public function eliminar_imagen_producto($id)
    {
        $delete = $this->producto->eliminarImagen($id);
        redirect($_SERVER['HTTP_REFERER']);
    }



    public function editar_servicio($id)
    {

        $this->functions->AccessValidateFrontEnd();
        $data['help'] = 'Las imágenes con dimensiones mayores a 500x300 px serán cortadas automáticamente al tamaño sugerido';
        $data['servicio'] = $this->servicio->obtener($id);
        $data['sub_subcategorias'] = $this->sub_subcategoria->listarPorEmpresa($data['producto'][0]->id_empresa);
        $this->load->view('frontend/includes/header');
        $this->load->view('frontend/editar_servicio', $data);
        $this->load->view('frontend/includes/footer');

    }


    public function guardar_edicion_servicio()
    {

        $id = $this->input->post('id_servicio');
        $error = 0;
        $directorio = 'components/empresas/servicios/';
        $this->load->library('Watimage', NULL, 'Watimage');
        $imagenes = $_FILES['imagenes']['name'][0];

            $this->form_validation->set_rules('nombre', 'Servicio', 'required');
            $this->form_validation->set_rules('categoria', 'Categoria', 'required');
            $this->form_validation->set_rules('precio', 'Precio', 'required|numeric');
            if($this->form_validation->run() === FALSE){
                $error = 1;
            } else {
                $data = array(
                    'nombre_servicio' => $this->functions->sanitizeString($this->input->post('nombre')),
                    'id_sub_sub_categoria' => $this->functions->sanitizeString($this->input->post('categoria')),
                    'precio_servicio' => $this->functions->sanitizeString($this->input->post('precio')),
                    'descripcion_servicio' => $this->functions->sanitizeString($this->input->post('descripcion')),
                    'especificacion_servicio' => $this->functions->sanitizeString($this->input->post('especificacion'))
                    );

                    $insert = $this->servicio->editar($data, $id);

                    if($_FILES['imagenes']['name'][0] != ''){
                        foreach ($_FILES['imagenes']['error'] as $key => $error) {
                            if ($error == UPLOAD_ERR_OK){
                                $nombre = $this->functions->nuevo_nombre().'.'.pathinfo($_FILES["imagenes"]["name"][$key])['extension'];
                                copy($_FILES["imagenes"]["tmp_name"][$key], $directorio.$nombre);
                            }
                                $wm = new Watimage($directorio.$nombre);
                                $wm->resize(array('type' => 'resizecrop', 'quality' => 100 ,'size' => array(500, 300)));
                                if (!$wm->generate($directorio.$nombre)){
                                   $error = 1;
                                }

                            $dataImagen = array('nombre_imagen' => $nombre, 'id_servicio' => $id);
                            $insert = $this->servicio->insertarImagen($dataImagen);
                            unset($dataImagen);
                        }
                    }
            }

        if($error == 1){
            $this->session->set_flashdata('mensaje', $this->functions->showAlertDanger('Lo sentimos, hubo un problema al editar su servicio.'));
            redirect(base_url().'editar_servicio/'.$id);
        } else {
            $this->session->set_flashdata('mensaje', $this->functions->showAlertSuccess('servicio editado correctamente'));
            redirect(base_url().'microempresario/' . $this->input->post('id_empresa'));
        }

    }


    public function eliminar_imagen_servicio($id)
    {
        $delete = $this->servicio->eliminarImagen($id);
        redirect($_SERVER['HTTP_REFERER']);
    }





    public function guarda_edicion_microempresario()
    {
        $subcategorias = $this->input->post('subcategorias');
        $sub_subcategorias = $this->input->post('sub_subcategorias');
        $pagos = $this->input->post('pagos');
        $id_empresa = $this->input->post('id_empresa');

        $error = 0;

        $this->form_validation->set_rules('nombre_fantasia', 'Nombre Fantasia', 'required');
        $this->form_validation->set_rules('region', 'Region', 'required');
        $this->form_validation->set_rules('comuna', 'Comuna', 'required');
        $this->form_validation->set_rules('avenida', 'Avenida', 'required');
        $this->form_validation->set_rules('numero', 'Numero', 'required|numeric');
        $this->form_validation->set_rules('celular', 'Celular', 'required|numeric');

        if($this->form_validation->run() === FALSE){
            $error = 1;
        } else {

            $data = array(
                'id_categoria' => $this->input->post('categoria'),
                'nombre_empresa' => $this->input->post('nombre_fantasia'),
                'region_empresa' => $this->input->post('region'),
                'comuna_empresa' => $this->input->post('comuna'),
                'calle_empresa' => $this->input->post('avenida'),
                'numero_calle_empresa' => $this->input->post('numero'),
                'celular_empresa' => $this->input->post('celular'),
                'fono_empresa' => $this->input->post('fono'),
                'sitio_empresa' => $this->input->post('sitio'),
                'descripcion_empresa' => $this->input->post('descripcion'),
                'despacho_empresa' => $this->input->post('despacho'),
                'id_estado' => 1);
            $insert = $this->empresa->editar($data, $id_empresa);

            $this->empresa->eliminarSubcategoriasEmpresa($id_empresa);
            $this->empresa->eliminarSub_subcategoriasEmpresa($id_empresa);
            $this->empresa->eliminarPagos($id_empresa);

            foreach ($subcategorias as $s) {
                $data = array('id_empresa' => $id_empresa, 'id_subcategoria' => $s);
                $insert = $this->empresa->insertarSubcategoriasEmpresa($data);
                unset($data);
            }

            foreach ($sub_subcategorias as $s) {
                $data = array('id_empresa' => $id_empresa, 'id_sub_subcategoria' => $s);
                $insert = $this->empresa->insertarSub_subcategoriasEmpresa($data);
                unset($data);
            }

            foreach ($pagos as $s) {
                $data = array('id_empresa' => $id_empresa, 'id_medio_pago' => $s);
                $insert = $this->empresa->insertarPagos($data);
                unset($data);
            }


        }

        if($error == 1){
            $this->session->set_flashdata('mensaje', $this->functions->showAlertDanger('Lo sentimos, hubo un problema al editar sus datos.'));
            redirect(base_url().'microempresarios/editar/'.$id_empresa);
        } else {
            $this->session->set_flashdata('mensaje', $this->functions->showAlertSuccess('Sus datos han sido editados con éxito'));
            redirect(base_url().'microempresario/'.$id_empresa);
        }

    }

    public function eliminar_producto($id)
    {
        $this->producto->eliminar($id);
        $this->session->set_flashdata('eliminar_mensaje', 'Producto eliminado con éxito');
        redirect($_SERVER['HTTP_REFERER']);
    }


    public function eliminar_servicio($id)
    {
        $this->servicio->eliminar($id);
        $this->session->set_flashdata('eliminar_mensaje', 'Servicio eliminado con éxito');
        redirect($_SERVER['HTTP_REFERER']);
    }


    public function eliminar_promocion($id)
    {
        $this->promocion->eliminar($id);
        $this->session->set_flashdata('eliminar_mensaje', 'Promoción eliminada con éxito');
        redirect($_SERVER['HTTP_REFERER']);
    }


    public function listado_promociones($tipo, $madre, $id_empresa)
    {
        $data['tipo'] = $tipo;
        $data['madre'] = $madre;
        $data['id_empresa'] = $id_empresa;
        $data['promociones'] = $this->promocion->listarPorEmpresaSoloID($id_empresa);
        $data['microempresario'] = $this->empresa->obtener($id_empresa);
        $data['otras_empresas'] = $this->empresa->listarEmpresasPorSector($data['microempresario'][0]->comuna_empresa, $id_empresa);
        $this->load->view('frontend/includes/header');
        $this->load->view('frontend/listado_promociones', $data);
        $this->load->view('frontend/includes/footer');
    }




    public function guardar_publica_tercero()
    {
        $subcategorias = $this->input->post('subcategorias');
        $sub_subcategorias = $this->input->post('sub_subcategorias');
        $pagos = $this->input->post('pagos');

        $error = 0;


        //datos del publicante
        $this->form_validation->set_rules('nombre', '', 'required');
        $this->form_validation->set_rules('apellido', '', 'required');
        $this->form_validation->set_rules('region-vives', '', 'required');
        $this->form_validation->set_rules('comuna-vives', '', 'required');
        $this->form_validation->set_rules('region', '', 'required');
        $this->form_validation->set_rules('comuna', '', 'required');
        $this->form_validation->set_rules('fono', '', 'required|numeric');
        $this->form_validation->set_rules('email', '', 'required|valid_email');
        $this->form_validation->set_rules('email-dos', '', 'required|valid_email');
        $this->form_validation->set_rules('password', '', 'required');
        $this->form_validation->set_rules('password-dos', '', 'required');

        //datos de la empresa
        $this->form_validation->set_rules('nombre-fantasia', '', 'required');
        $this->form_validation->set_rules('categoria', '', 'required');
        $this->form_validation->set_rules('region-empresa', '', 'required');
        $this->form_validation->set_rules('comuna-empresa', '', 'required');
        $this->form_validation->set_rules('calle', '', 'required');
        $this->form_validation->set_rules('numero', '', 'required');

        if($this->form_validation->run() === FALSE){
            $error = 1;


        } else {

            if($this->input->post('debo_guardar') == 1){
                $data_c = array(
                    'nombre_cliente' => $this->input->post('nombre'),
                    'region_cliente' => $this->input->post('region-vives'),
                    'comuna_cliente' => $this->input->post('comuna-vives'),
                    'region_trabajo_cliente' => $this->input->post('region'),
                    'comuna_trabajo_cliente' => $this->input->post('comuna'),
                    'fono_cliente' => $this->input->post('fono'),
                    'email_cliente' => $this->input->post('email'),
                    'password_cliente' => $this->input->post('password'),
                    'id_estado' => 1);
                $insert = $this->cliente->insertar($data_c);
                $id_insertado_user = $this->db->insert_id();
            } else {
                $id_insertado_user = $this->session->id;
            }



            $data = array(
                'id_categoria' => $this->input->post('categoria'),
                'nombre_empresa' => $this->input->post('nombre-fantasia'),
                'region_empresa' => $this->input->post('region-empresa'),
                'comuna_empresa' => $this->input->post('comuna-empresa'),
                'calle_empresa' => $this->input->post('calle'),
                'numero_calle_empresa' => $this->input->post('numero'),
                'complemento' => $this->input->post('complemento'),
                'celular_empresa' => $this->input->post('celular'),
                'fono_empresa' => $this->input->post('fono-empresa'),
                'email_empresa' => $this->input->post('email-contacto'),
                'password_empresa' => 1000,
                'sitio_empresa' => $this->input->post('sitio'),
                'descripcion_empresa' => $this->input->post('descripcion'),
                'despacho_empresa' => $this->input->post('despacho'),
                'id_estado' => 1,
                'id_cliente' => $id_insertado_user);
            $insert = $this->empresa->insertar($data);
            $id_insertado = $this->db->insert_id();

            foreach ($subcategorias as $s) {
                $data = array('id_empresa' => $id_insertado, 'id_subcategoria' => $s);
                $insert = $this->empresa->insertarSubcategoriasEmpresa($data);
                unset($data);
            }

            foreach ($sub_subcategorias as $s) {
                $data = array('id_empresa' => $id_insertado, 'id_sub_subcategoria' => $s);
                $insert = $this->empresa->insertarSub_subcategoriasEmpresa($data);
                unset($data);
            }

            foreach ($pagos as $s) {
                $data = array('id_empresa' => $id_insertado, 'id_medio_pago' => $s);
                $insert = $this->empresa->insertarPagos($data);
                unset($data);
            }

        }

        if($error == 1){
            $this->session->set_flashdata('mensaje', $this->functions->showAlertDanger('Lo sentimos, hubo un problema.'));
            redirect(base_url().'publica_tercero');
        } else {
            $this->session->set_flashdata('mensaje', $this->functions->showAlertSuccess('Gracias por ayudar a este microempresario'));
            redirect(base_url().'publica_tercero');
        }

    }



    public function enviar_email_bienvenida_empresa($empresa, $email)
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

            $data['empresa'] = $empresa;

            $this->email->to($email);
            $this->email->subject('Puedes Aumentar tus Ventas!!!');

            $body = $this->load->view('frontend/emails/bienvenido_cliente', $data, TRUE);
            $this->email->message($body);
            $mail = $this->email->send();
    }

}
