<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->load->model('promocionesModel', 'promociones');
        $this->load->model('empresasModel', 'empresa');
        $this->load->model('clientesModel', 'cliente');
        $this->load->model('empresacomentariosModel', 'Ecomentario');
        $this->load->model('recomendacionesModel', 'recomendacion');
        $this->load->model('productosModel', 'producto');
        $this->load->model('serviciosModel', 'servicio');
    }

    public function comunasPorRegion()
    {
    	$region = $this->input->post('region');
    	$comunas = $this->functions->comunasPorRegion($region);
    	$select = '<option value="">Seleccione '.$this->functions->texto_general(4).'...</option>';
    	foreach ($comunas as $v) {
    		$select .= '<option value="'.ucfirst($v->nombre_comuna).'">'.ucfirst($v->nombre_comuna).'</option>';
    	}
    	echo $select;
    }

    public function comunasPorRegionRse()
    {
        $region = $this->input->post('region');
        $comuna = $this->input->post('comuna');
        $comunas = $this->functions->comunasPorRegion($region);
        $select = '<option value="">Seleccione...</option>';
        foreach ($comunas as $v) {
            if($v->id_comuna == $comuna){
                $select .= '<option selected value="'.$v->id_comuna.'">'.ucfirst($v->nombre_comuna).'</option>';
            } else {
                $select .= '<option value="'.$v->id_comuna.'">'.ucfirst($v->nombre_comuna).'</option>';
            }
        }
        echo $select;
    }

    public function comunasPorRegionCheckbox()
    {
        $regiones = $this->input->post('regiones');
        $comunas = $this->functions->comunasPorRegionCheckbox($regiones);
        $select = '';
        foreach ($comunas as $v) {
            $select .= '<input class="comunas_check" type="checkbox" name="comunas[]" value="'.ucfirst($v->nombre_comuna).'"> '.ucfirst($v->nombre_comuna).'<br>';
        }
        echo $select;
    }


    public function subcategoriasPorCategoria()
    {
        $categoria = $this->input->post('categoria');
        $subcategorias = $this->functions->subcategoriasPorCategoria($categoria);
        $select = '';
        foreach ($subcategorias as $sc) {
            $select .= '<input class="subcategoria" type="checkbox" name="subcategorias[]" id="subcat-'.$sc->id_subcategoria.'" value="'.$sc->id_subcategoria.'"> '.$sc->nombre_subcategoria.'<br>';
        }
        echo $select;
    }


    public function subcategoriasPorCategoriaComboBox()
    {
        $categoria = $this->input->post('categoria');
        $subcategorias = $this->functions->subcategoriasPorCategoria($categoria);
        $select = '<option value="">Tipo de microempresario</option>';
        foreach ($subcategorias as $sc) {
            $select .= '<option value="'.$sc->id_subcategoria.'">'.$sc->nombre_subcategoria.'</option>';
        }
        echo $select;
    }


    public function subcategoriasPorCategoriaReq()
    {
        $categoria = $this->input->post('categoria');
        $subcategorias = $this->functions->subcategoriasPorCategoria($categoria);
        $select = '';
        foreach ($subcategorias as $sc) {
            $select .= '<input class="subcategoria" type="radio" name="subcategoria" value="'.$sc->id_subcategoria.'"> '.$sc->nombre_subcategoria.'<br>';
        }
        echo $select;
    }


    public function sub_subcategoriasPorSubcategoria()
    {
        $subcategorias = $this->input->post('subcategorias');
        $sub_subcategorias = $this->functions->sub_subcategoriasPorSubcategoria($subcategorias);
        $select = '';
        foreach ($sub_subcategorias as $ssc) {
            $select .= '<input class="sub_subcategoria" type="checkbox" name="sub_subcategorias[]" id="sub_subcat-'.$ssc->id_sub_subcategoria.'" value="'.$ssc->id_sub_subcategoria.'"> '.$ssc->nombre_sub_subcategoria.'<br>';
        }
        echo $select;
    }


    public function sub_subcategoriasPorSubcategoriaReq()
    {
        $subcategorias = $this->input->post('subcategorias');
        $sub_subcategorias = $this->functions->sub_subcategoriasPorSubcategoria($subcategorias);
        $select = '';
        foreach ($sub_subcategorias as $ssc) {
            $select .= '
            <div class="col-md-4" style="font-size:12px;">
            <input style="cursor:pointer;" class="sub_subcategoria" type="checkbox" name="sub_subcategorias[]" id="sub_subcat-'.$ssc->id_sub_subcategoria.'" value="'.$ssc->id_sub_subcategoria.'"> '.$ssc->nombre_sub_subcategoria.'</div>';
        }
        echo $select;
    }


    public function sub_subcategoriasPorSubcategoria_edicion()
    {
        $subcategorias = $this->input->post('subcategorias');
        $id_empresa = $this->input->post('id_empresa');
        $sub_subcategorias = $this->functions->sub_subcategoriasPorSubcategoria($subcategorias);
        $select = '';
        foreach ($sub_subcategorias as $ssc) {
            $tiene = $this->functions->tieneSubsubcategoria($ssc->id_sub_subcategoria, $id_empresa);
            if($tiene == 1){ $checked = 'checked'; } else { $checked = ''; }
            $select .= '<input class="sub_subcategoria" '.$checked.' type="checkbox" name="sub_subcategorias[]"  value="'.$ssc->id_sub_subcategoria.'"> '.$ssc->nombre_sub_subcategoria.'<br>';
        }
        echo $select;
    }


    public function crear_promocion_producto()
    {


        $this->form_validation->set_rules('producto', 'Producto', 'required');
        $this->form_validation->set_rules('tipo', 'tipo', 'required');
        $this->form_validation->set_rules('color', 'Color', 'required');
        $this->form_validation->set_rules('duracion', 'Duracion', 'required');
        if($this->form_validation->run() === TRUE){

            $tipo = $this->input->post('tipo');
            if($tipo == 1){
                $descuento = $this->input->post('descuento');
            } else {
                $descuento = '';
            }

            if($tipo == 1 && $descuento == ''){
                echo json_encode(array('estado' => 1, 'mensaje' => 'Ingrese el porcentaje de descuento'));
            } else {

                $id_producto = $this->input->post('producto');
                $color = $this->input->post('color');
                $duracion = $this->input->post('duracion');
                $id_empresa = $this->input->post('id_empresa');
                $fecha_publicacion = date('Y-m-d');
                $data = array(
                    'id_empresa' => $id_empresa,
                    'id_producto' => $id_producto,
                    'id_tipo_promocion' => $tipo,
                    'descuento_promocion' => $descuento,
                    'color_promocion' => $color,
                    'fecha_promocion' => $fecha_publicacion,
                    'dias_promocion' => $duracion,
                    'id_estado' => 1
                    );
                $insert = $this->promociones->crear_promocion_producto($data);
                if($insert === true){
                    $this->guardar_notificaciones_muchas_personas($id_empresa, $id_producto);
                    echo json_encode(array('estado' => 0, 'mensaje' => 'Tu promoción ha sido creada con éxito'));
                } else {
                    echo json_encode(array('estado' => 1, 'mensaje' => 'Hubo un error al crear la promoción'));
                }
            }
        } else {
            echo json_encode(array('estado' => 1, 'mensaje' => 'Complete los campos obligatorios'));
        }

    }


    public function editar_promocion_producto()
    {

        $this->form_validation->set_rules('producto', 'Producto', 'required');
        $this->form_validation->set_rules('tipo', 'tipo', 'required');
        $this->form_validation->set_rules('color', 'Color', 'required');
        $this->form_validation->set_rules('duracion', 'Duracion', 'required');
        if($this->form_validation->run() === TRUE){

            $tipo = $this->input->post('tipo');
            if($tipo == 1){
                $descuento = $this->input->post('descuento');
            } else {
                $descuento = '';
            }

            if($tipo == 1 && $descuento == ''){
                echo json_encode(array('estado' => 1, 'mensaje' => 'Ingrese el porcentaje de descuento'));
            } else {

                $id_producto = $this->input->post('producto');
                $color = $this->input->post('color');
                $duracion = $this->input->post('duracion');
                $id_empresa = $this->input->post('id_empresa');
                $data = array(
                    'id_tipo_promocion' => $tipo,
                    'descuento_promocion' => $descuento,
                    'color_promocion' => $color,
                    'fecha_promocion' => date('Y-m-d'),
                    'dias_promocion'  => $duracion
                    );
                $update = $this->promociones->editar_promocion_producto($data, $id_producto);
                if($update === true){
                    $this->guardar_notificaciones_muchas_personas($id_empresa, $id_producto);
                    echo json_encode(array('estado' => 0, 'mensaje' => 'Tu promoción ha sido actualizada con éxito'));
                } else {
                    echo json_encode(array('estado' => 1, 'mensaje' => 'Hubo un error al actualizar la promoción'));
                }
            }
        } else {
            echo json_encode(array('estado' => 1, 'mensaje' => 'Hubo un error al actualizar la promoción'));
        }


    }


    public function crear_promocion_servicio()
    {
        $this->form_validation->set_rules('servicio', 'Servicio', 'required');
        $this->form_validation->set_rules('tipo', 'tipo', 'required');
        $this->form_validation->set_rules('color', 'Color', 'required');
        $this->form_validation->set_rules('duracion', 'Duracion', 'required');
        if($this->form_validation->run() === TRUE){

            $tipo = $this->input->post('tipo');
            if($tipo == 1){
                $descuento = $this->input->post('descuento');
            } else {
                $descuento = '';
            }

            if($tipo == 1 && $descuento == ''){
                echo json_encode(array('estado' => 1, 'mensaje' => 'Ingrese el porcentaje de descuento'));
            } else {
                $id_servicio = $this->input->post('servicio');
                $color = $this->input->post('color');
                $fecha_publicacion = date('Y-m-d');
                $duracion = $this->input->post('duracion');
                $id_empresa = $this->input->post('id_empresa');
                $data = array(
                    'id_empresa' => $id_empresa,
                    'id_servicio' => $id_servicio,
                    'id_tipo_promocion' => $tipo,
                    'descuento_promocion' => $descuento,
                    'color_promocion' => $color,
                    'fecha_promocion' => $fecha_publicacion,
                    'dias_promocion'  => $duracion,
                    'id_estado' => 1
                    );
                $insert = $this->promociones->crear_promocion_servicio($data);
                if($insert === true){
                    $this->guardar_notificaciones_muchas_personas_servicio($id_empresa, $id_servicio);
                    echo json_encode(array('estado' => 0, 'mensaje' => 'Tu promoción ha sido creada con éxito'));
                } else {
                    echo json_encode(array('estado' => 1, 'mensaje' => 'Hubo un error al crear la promoción'));
                }
            }
        } else {
            echo json_encode(array('estado' => 1, 'mensaje' => 'Complete los campos obligatorios'));
        }
    }


    public function editar_promocion_servicio()
    {
        $this->form_validation->set_rules('servicio', 'Servicio', 'required');
        $this->form_validation->set_rules('tipo', 'tipo', 'required');
        $this->form_validation->set_rules('color', 'Color', 'required');
        $this->form_validation->set_rules('duracion', 'Duracion', 'required');
        if($this->form_validation->run() === TRUE){

            $tipo = $this->input->post('tipo');
            if($tipo == 1){
                $descuento = $this->input->post('descuento');
            } else {
                $descuento = '';
            }

            if($tipo == 1 && $descuento == ''){
                echo json_encode(array('estado' => 1, 'mensaje' => 'Ingrese el porcentaje de descuento'));
            } else {
                $id_servicio = $this->input->post('servicio');
                $color = $this->input->post('color');
                $duracion = $this->input->post('duracion');
                $id_empresa = $this->input->post('id_empresa');
                $data = array(
                    'id_tipo_promocion' => $tipo,
                    'descuento_promocion' => $descuento,
                    'color_promocion' => $color,
                    'fecha_promocion' => date('Y-m-d'),
                    'dias_promocion'  => $duracion
                    );
                $update = $this->promociones->editar_promocion_servicio($data, $id_servicio);
                if($update === true){
                    $this->guardar_notificaciones_muchas_personas_servicio($id_empresa, $id_servicio);
                    echo json_encode(array('estado' => 0, 'mensaje' => 'Tu promoción ha sido actualizada con éxito'));
                } else {
                    echo json_encode(array('estado' => 1, 'mensaje' => 'Hubo un error al actualizar la promoción'));
                }
            }
        } else {
            echo json_encode(array('estado' => 1, 'mensaje' => 'Complete los campos obligatorios'));
        }

    }


    public function imagen_perfil()
    {

            $file = $_FILES['file'];
            $temporal = $file['tmp_name'];
            $nombre = $file['name'];

            $directorio = 'components/empresas/perfiles/';
            $this->load->library('Watimage', NULL, 'Watimage');

                    $error = 0;
                    copy($temporal, $directorio.$nombre);

                    //TODO: buscar una buena forma de redimensionar imágenes

                    /*$wm = new Watimage($directorio.$nombre);
                    $wm->resize(array('type' => 'resizecrop', 'quality' => 100 ,'size' => array(500, 300)));
                    if (!$wm->generate($directorio.$nombre)){
                       $error = 1;
                    }*/

                $dataImagen = array('imagen_empresa' => $nombre);
                $insert = $this->empresa->insertarImagenPerfil($dataImagen, $this->input->post('id_empresa'));

                if($error == 1){
                    echo json_encode(array('estado' => 1));
                } else {
                    echo json_encode(array('img' => base_url().$directorio.$nombre, 'estado' => 0));
                }

    }




    public function imagen_perfil_persona()
    {

            $file = $_FILES['file'];
            $temporal = $file['tmp_name'];
            $nombre = $file['name'];

            $directorio = 'components/clientes/';
            $this->load->library('Watimage', NULL, 'Watimage');

                    $error = 0;
                    copy($temporal, $directorio.$nombre);

                    /*$wm = new Watimage($directorio.$nombre);
                    $wm->resize(array('type' => 'resizecrop', 'quality' => 100 ,'size' => array(500, 300)));
                    if (!$wm->generate($directorio.$nombre)){
                       $error = 1;
                    }*/

                $dataImagen = array('imagen_cliente' => $nombre);
                $insert = $this->cliente->insertarImagenPerfil($dataImagen, $this->session->id);

                if($error == 1){
                    echo json_encode(array('estado' => 1));
                } else {
                    echo json_encode(array('img' => base_url().$directorio.$nombre, 'estado' => 0));
                }

    }



    public function comentariosPorEmpresa()
    {
        $id_empresa = $this->input->post('id_empresa');
        $comentarios = $this->Ecomentario->listarPorEmpresa($id_empresa);

            $texto = '';
            foreach($comentarios as $c){
                $texto .= '<p>'.$c->texto_comentario.'<br><small><i class="fa fa-user"></i> '.$c->nombre_comentario.', '.$c->region_comentario.' '.$c->comuna_comentario.'</small></p><hr>';
            }

        echo $texto;
    }

    public function guardarComentario()
    {
        $fecha = date('Y-m-d');
        $data = array(
            'texto_comentario' => $this->input->post('comentario'),
            'nombre_comentario' => $this->session->nombre,
            'region_comentario' => $this->session->region,
            'comuna_comentario' => $this->session->comuna,
            'fecha_comentario' => $fecha,
            'id_empresa' => $this->input->post('id_empresa')
            );
        $insert = $this->Ecomentario->insertar($data);
        if($insert === true){
            $this->guardar_notificacion_persona($this->input->post('id_cliente'), 'te dejó un comentario');
            echo 1;
        } else {
            echo 0;
        }
    }


    public function contactar()
    {
        $id_empresa = $this->input->post('id_empresa');
        $nombre = $this->input->post('nombre');
        $email = $this->input->post('email');
        $mensaje = $this->input->post('mensaje');
        $texto = '';

        $para = $this->functions->EmailPersona($this->input->post('id_cliente'));

        $texto = "<b>Contacto Portal Microempresario</b><br />";
        $texto.="<br />Empresa<b> El contacto fue realizado en tu Negocio: ".$this->functions->nombreEmpresa($id_empresa)."</b>";
        $texto.="<br />Fecha <b>".date('d-m-Y')."</b>";
        $texto.="<br />Nombre: ".$nombre;
        $texto.="<br />Email: ".$email;
        $texto.="<br />Mensaje: ".$mensaje;

        $desde = "From: info@portalmicroempresarios.com\r\nContent-type: text/html\r\n";

        if (mail($para , "Contacto Portal Microempresario", $texto, $desde)){
            $this->guardar_notificacion_persona($this->input->post('id_cliente'), 'te envió un correo');
            echo json_encode(array('estado' => 0, 'mensaje' => 'Mensaje enviado!'));
        } else {
            echo json_encode(array('estado' => 1, 'mensaje' => 'Ups, Hubo un error'));
        }

    }



    public function contactar_producto()
    {
        $id_empresa = $this->input->post('id_empresa');
        $producto = $this->input->post('producto');
        $nombre = $this->input->post('nombre');
        $email = $this->input->post('email');
        $mensaje = $this->input->post('mensaje');
        $texto = '';

        $para = $this->functions->EmailPersona($this->input->post('id_cliente'));

        $texto = "<b>Contacto Portal Microempresario Producto</b><br />";
        $texto.="<br />Fecha <b>".date('d-m-Y')."</b>";
        $texto.="<br />Empresa<b> El contacto fue realizado en tu Negocio: ".$this->functions->nombreEmpresa($id_empresa)."</b>";
        $texto.="<br />Producto: ".$producto;
        $texto.="<br />Nombre: ".$nombre;
        $texto.="<br />Email: ".$email;
        $texto.="<br />Mensaje: ".$mensaje;

        $desde = "From: info@portalmicroempresarios.com\r\nContent-type: text/html\r\n";

        if (mail($para , "Contacto Portal Microempresario Producto", $texto, $desde)){
            //enviar notificación a empresa
            $this->guardar_notificacion_persona($this->input->post('id_cliente'), ', Te ha contactado por un producto');
            echo json_encode(array('estado' => 0, 'mensaje' => 'Mensaje enviado!'));
        } else {
            echo json_encode(array('estado' => 1, 'mensaje' => 'Ups, Hubo un error'));
        }

    }


    public function contactar_servicio()
    {
        $id_empresa = $this->input->post('id_empresa');
        $servicio = $this->input->post('servicio');
        $nombre = $this->input->post('nombre');
        $email = $this->input->post('email');
        $mensaje = $this->input->post('mensaje');
        $texto = '';

        $para = $this->functions->EmailPersona($this->input->post('id_cliente'));

        $texto = "<b>Contacto Portal Microempresario Servicio</b><br />";
        $texto.="<br />Fecha <b>".date('d-m-Y')."</b>";
        $texto.="<br />Empresa<b> El contacto fue realizado en tu Negocio: ".$this->functions->nombreEmpresa($id_empresa)."</b>";
        $texto.="<br />Servicio: ".$servicio;
        $texto.="<br />Nombre: ".$nombre;
        $texto.="<br />Email: ".$email;
        $texto.="<br />Mensaje: ".$mensaje;

        $desde = "From: info@portalmicroempresarios.com\r\nContent-type: text/html\r\n";

        if (mail($para , "Contacto Portal Microempresario Servicio", $texto, $desde)){
            //enviar notificación a empresa
            $this->guardar_notificacion_persona($this->input->post('id_cliente'), 'Te ha contactado por un servicio');
            echo json_encode(array('estado' => 0, 'mensaje' => 'Mensaje enviado!'));
        } else {
            echo json_encode(array('estado' => 1, 'mensaje' => 'Ups, Hubo un error'));
        }

    }


    public function recomendar()
    {
        $id_empresa = $this->input->post('id_empresa');
        $fecha = date('Y-m-d');
        $data = array(
            'id_empresa' => $id_empresa,
            'id_cliente' => $this->session->id,
            'fecha_recomendacion' => $fecha
            );
        $insert = $this->recomendacion->insertar($data);
        if($insert === true){
            //enviar notificación a empresa recomendada
            $this->guardar_notificacion_persona($this->input->post('id_cliente'), 'te ha recomendado');
            echo 1;
        } else {
            echo 0;
        }
    }


    public function borrar_recomendar()
    {
        $id_empresa = $this->input->post('id_empresa');
        $delete = $this->recomendacion->eliminar($id_empresa);
        if($delete === true){
            echo 1;
        } else {
            echo 0;
        }
    }


    public function buscar()
    {
        $term = $_GET['term'];
        $busqueda = $this->empresa->buscarEmpresas($term);
        $data = array();
        foreach ($busqueda as $key => $value) {
            $data[$value->id_sub_subcategoria] = $value->nombre_sub_subcategoria;
        }

        echo json_encode($data);

    }


    public function marcar_leidas()
    {
        $http = $_SERVER['HTTP_REFERER'];

        if($this->input->post('ide_noti') !== null){
            foreach ($this->input->post('ide_noti') as $k => $v) {
            $data = array('estado_notificacion' => 1);
                $update = $this->empresa->marcar_leidas_persona($data, $v);
            }
        }

        if($this->input->post('ide_noti_convenio') !== null){
            foreach ($this->input->post('ide_noti_convenio') as $k => $v) {
            $data = array('estado_notificacion' => 1);
                $update = $this->empresa->marcar_leidas_convenio($data, $v);
            }
        }

        echo json_encode(array('redirection' => $http));
    }


    //TIPO 1 ES PRODUCTO Y TIPO 2 ES SERVICIO
    public function activar_registro($id, $tipo, $ref)
    {

        if($tipo == 1){
            $data = array('id_estado' => 1);
            $update = $this->producto->editar($data, $id);
            $mensaje = 'Producto activado correctamente';
        } elseif($tipo == 2) {
            $data = array('id_estado' => 1);
            $update = $this->servicio->editar($data, $id);
            $mensaje = 'Servicio activado correctamente';
        } else {
            $data = array('id_estado' => 1);
            if($ref == 1){
                $update = $this->promociones->editar_promocion_producto($data, $id);
            } else {
                $update = $this->promociones->editar_promocion_servicio($data, $id);
            }
            $mensaje = 'Promoción desactivada correctamente';
        }

        echo json_encode(array('mensaje' => $mensaje));

    }


    public function desactivar_registro($id, $tipo, $ref)
    {

        if($tipo == 1){
            $data = array('id_estado' => 0);
            $update = $this->producto->editar($data, $id);
            $mensaje = 'Producto desactivado correctamente';
        } elseif($tipo == 2) {
            $data = array('id_estado' => 0);
            $update = $this->servicio->editar($data, $id);
            $mensaje = 'Servicio desactivado correctamente';
        } else {
            $data = array('id_estado' => 0);
            if($ref == 1){
                $update = $this->promociones->editar_promocion_producto($data, $id);
            } else {
                $update = $this->promociones->editar_promocion_servicio($data, $id);
            }
            $mensaje = 'Promoción desactivada correctamente';
        }

        echo json_encode(array('mensaje' => $mensaje));
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

    public function guardar_notificacion_persona_dos($id_cliente, $texto)
    {

            $data = array(
                'id_cliente' => $this->session->id,
                'id_href' => $id_cliente,
                'texto_notificacion' => '<b>'.$this->session->nombre.'</b> '.$texto,
                'fecha_notificacion' => date('Y-m-d'),
                'estado_notificacion' => 0
                );
            $this->functions->notificar_persona($data);
    }

    public function guardar_notificaciones_muchas_personas($id_empresa, $id_producto)
    {

            $seguidores = $this->functions->listarSeguidoresPorEmpresa($id_empresa);

            $producto = $this->functions->detalle_producto_notificacion($id_producto);

            foreach ($seguidores as $s) {
                $texto = '';
                $texto .= '<b>"'.$this->functions->nombreEmpresa($id_empresa).'"</b> publicó una nueva promoción: ';
                if($producto[0]->id_tipo_promocion == 1){
                    $texto .= $producto[0]->descuento_promocion.' de descuento en '.$producto[0]->nombre_producto.' por '.$producto[0]->dias_promocion.' días';
                } else {
                    $texto .= $producto[0]->tipo_promocion.' en '.$producto[0]->nombre_producto.' por '.$producto[0]->dias_promocion.' días';
                }

                $data = array(
                    'id_cliente' => $s->id_cliente,
                    'texto_notificacion' => $texto,
                    'fecha_notificacion' => date('Y-m-d'),
                    'estado_notificacion' => 0
                    );
                $this->functions->notificar_persona($data);
                unset($data);

            }

    }


    public function guardar_notificaciones_muchas_personas_servicio($id_empresa, $id_servicio)
    {

            $seguidores = $this->functions->listarSeguidoresPorEmpresa($id_empresa);

            $servicio = $this->functions->detalle_servicio_notificacion($id_servicio);

            foreach ($seguidores as $s) {
                $texto = '';
                $texto .= '<b>"'.$this->functions->nombreEmpresa($id_empresa).'"</b> publicó una nueva promoción: ';
                if($servicio[0]->id_tipo_promocion == 1){
                    $texto .= $servicio[0]->descuento_promocion.' de descuento en '.$servicio[0]->nombre_servicio.' por '.$servicio[0]->dias_promocion.' días';
                } else {
                    $texto .= $servicio[0]->tipo_promocion.' en '.$servicio[0]->nombre_servicio.' por '.$servicio[0]->dias_promocion.' días';
                }

                $data = array(
                    'id_cliente' => $s->id_cliente,
                    'texto_notificacion' => $texto,
                    'fecha_notificacion' => date('Y-m-d'),
                    'estado_notificacion' => 0
                    );
                $this->functions->notificar_persona($data);
                unset($data);

            }

    }


    public function empresaMismoNombre()
    {
        $nombre = $this->input->post('nombre');
        $busqueda = $this->empresa->empresasYaRegistradas($nombre);
        if(count($busqueda) > 0){
            echo 'existen empresas con el mismo nombre o similar';
        } else {
            echo 1;
        }
    }


    public function comenzarSeguirPersona()
    {

        $existe = $this->functions->yaSeguido($this->input->post('id_persona'));

        if($existe == 0){
            $data = array(
                'id_seguidor' => $this->session->id,
                'id_cliente' => $this->input->post('id_persona'),
                'texto_seguir' => 'Seguimiento',
                'fecha_seguir' => date('Y-m-d'),
                'estado_seguir' => 1
            );
            $this->functions->seguir_persona($data);
            $this->guardar_notificacion_persona($this->input->post('id_persona'), 'ahora sigue tus recomendaciones');
            echo 0;
        }

    }


    public function dejarSeguirPersona()
    {
        $this->functions->dejar_seguir_persona($this->session->id, $this->input->post('id_persona'));
        $this->guardar_notificacion_persona($this->input->post('id_persona'), 'dejó de seguir tus recomendaciones');
    }


    public function comenzarSeguirEmpresa()
    {

            $data = array(
                'id_empresa' => $this->input->post('id_empresa'),
                'id_cliente' => $this->session->id,
                'texto_seguir' => 'Seguimiento',
                'fecha_seguir' => date('Y-m-d'),
                'estado_seguir' => 1
            );
            $this->functions->seguir_empresa($data);
            $this->guardar_notificacion_persona($this->input->post('id_persona'), 'empezó a seguirte');

    }


    public function dejarSeguirEmpresa()
    {
        $this->functions->dejar_seguir_empresa($this->session->id, $this->input->post('id_empresa'));
        $this->guardar_notificacion_persona($this->input->post('id_cliente'), 'dejó de seguirte');
    }

    public function yaExisteEmail()
    {
        $email = $this->input->post('email');
        $existe = $this->functions->yaExisteEmail($email);
        if($existe > 0){
            echo 1;
        } else {
            echo 0;
        }
    }

    public function yaExisteEmpresa()
    {
        $empresa = $this->input->post('empresa');
        $region = $this->input->post('region');
        $comuna = $this->input->post('comuna');
        $existe = $this->functions->yaExisteEmpresa($empresa, $region, $comuna);
        if($existe > 0){
            echo 1;
        } else {
            echo 0;
        }
    }


    public function mostrar_notificacion()
    {
        $notificacion = $this->functions->mostrar_notificacion($this->session->id);
        if(count($notificacion) > 0){
            $mensaje = strip_tags($notificacion[0]->texto_notificacion);
            $url_destiny = base_url().'perfil_persona/'.$notificacion[0]->id_href;
            $id_notificacion = $notificacion[0]->id_notificacion;
            echo json_encode(
                    array(
                        'title' => 'Notificación '.$notificacion[0]->fecha_notificacion,
                        'message' => $mensaje,
                        'url_destiny' => $url_destiny,
                        'state' => 0,
                        'id_notificacion' => $id_notificacion
                    ));
        } else {
            echo json_encode(array('state' => 1));
        }
    }


    public function marcar_leidas_push()
    {

        if($this->input->post('id_notificacion') !== null){
            $data = array('estado_notificacion' => 1, 'mostrar_notificacion' => 1);
            $update = $this->empresa->marcar_leidas_persona($data, $this->input->post('id_notificacion'));
        }
    }


    public function busqueda_empresas()
    {
        $html = '';
        $ides = $this->input->post('sub_subcategorias');
        $empresas = $this->empresa->buscar_empresas_requerimientos($ides);
        $id = 0;
        foreach ($empresas as $e) {
            if($id != $e->id_empresa){
                $html .=
                '
                  <tr>
                    <td>'.$e->nombre_empresa.'</td>
                    <td>'.$e->nombre_sub_subcategoria.'</td>
                    <td>'.$e->region_empresa.'</td>
                    <td>'.$e->comuna_empresa.'</td>
                    <td><input class="micro_check" type="checkbox" value="'.$e->id_empresa.'"></td>
                  </tr>
                ';
                $id = $e->id_empresa;
            }
        }

        echo $html;
    }


    public function enviar_requerimiento()
    {
        $categoria = $this->input->post('categoria');
        $subcategoria = $this->input->post('subcategoria');
        $sub_subcategorias = $this->input->post('sub_subcategorias');
        $mensaje = $this->input->post('mensaje');
        $microempresarios = $this->input->post('microempresarios');


        $data = array(
            'fecha_requerimiento' => date('Y-m-d'),
            'hora_requerimiento' => date('H:i:s'),
            'texto_requerimiento' => $mensaje,
            'estado_requerimiento' => 1,
            'id_categoria' => $categoria,
            'id_subcategoria' => $subcategoria,
            'id_cliente' => $this->session->id
        );

        $this->empresa->insertar_requerimiento($data);
        $id_requerimiento = $this->db->insert_id();

        foreach ($sub_subcategorias as $s) {
            $data_sc = array(
                'id_sub_subcategoria' => $s,
                'id_requerimiento' => $id_requerimiento
            );
            $this->empresa->insertar_sc($data_sc);
            unset($data_sc);
        }

        $resultados = $this->empresa->obtener_empresas_requerimientos($microempresarios);
        foreach ($resultados as $r){
            $data = array('id_empresa' => $r->id_empresa, 'id_requerimiento' => $id_requerimiento);
            $this->empresa->insertar_req_empresa($data);
            self::enviar_correo_req($r->nombre_cliente, $r->nombre_empresa, $r->email_cliente, $mensaje);
            self::guardar_notificacion_requerimiento($r->id_cliente, 'Ha ingresado una nueva solicitud de cotizaciones para tí', $id_requerimiento);
        }

    }

    public function enviar_correo_req($nombre, $empresa, $email, $mensaje)
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
            $data['empresa'] = $empresa;
            $data['mensaje'] = $mensaje;
            $data['requeridor'] = $this->session->nombre;
            $data['email'] = $this->session->email;

            $this->email->to($email);
            $this->email->subject('Tienes una solicitud de cotizaciones');

            $body = $this->load->view('frontend/emails/requerimiento', $data, TRUE);
            $this->email->message($body);
            $mail = $this->email->send();
    }


    public function editar_requerimiento()
    {
        $id = $this->input->post('valor');
        $mensaje = $this->input->post('mensaje');

        $data = array(
            'texto_requerimiento' => $mensaje
        );

        $this->empresa->editar_requerimiento($data, $id);
        echo 0;
    }


    public function cerrar_requerimiento()
    {
        $id = $this->input->post('valor');
        $mensaje = $this->input->post('mensaje');

        $data = array(
            'estado_requerimiento' => 0,
            'motivo_cierre' => $mensaje
        );

        $this->empresa->editar_requerimiento($data, $id);
        echo 0;
    }


    public function aceptar_oferta()
    {
        $id = $this->input->post('valor');
        $mensaje = $this->input->post('mensaje');
        $id_requerimiento = $this->input->post('id_requerimiento');
        $id_cliente = $this->input->post('id_cliente');

        $data = array(
            'respuesta_oferta' => 1,
            'texto_respuesta' => $mensaje
        );

        $this->empresa->editar_oferta($data, $id);

        $data_r = array(
            'estado_requerimiento' => 0,
            'motivo_cierre' => 'Cliente aceptó una oferta a través del Portal Microempresarios'
        );

        $this->empresa->editar_requerimiento($data_r, $id_requerimiento);
        self::guardar_notificacion_persona_dos($id_cliente, 'Ha aceptado tu oferta');
        echo 0;
    }



    public function iniciar_sesion()
    {
        $email = $this->input->post('usuario');
        $password = $this->input->post('password');
        $url = $this->input->post('url');

        if($url == ''){
            $url = $_SERVER['HTTP_REFERER'];
        }

        $acceso = $this->cliente->obtenerLogin($email, $password);
        if(count($acceso) == 0){
            echo json_encode(array('estado' => 1));
        } else {
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
            echo json_encode(array('estado' => 0, 'url' => $url));
        }
    }


    public function cargarModal()
    {
        $accion = $this->input->post('accion');

        if($accion == 1){
            $data['recomendaciones'] = $this->recomendacion->listarPorPersona($this->session->id);
            $data = $this->load->view('frontend/modales/recomiendo', $data, TRUE);
            echo $data;
        }

        if($accion == 2){
            $data['clienteSigueEmpresas'] = $this->recomendacion->clienteSigueEmpresas($this->session->id);
            $data['clienteSiguePersonas'] = $this->recomendacion->clienteSiguePersonas($this->session->id);
            $data = $this->load->view('frontend/modales/sigo', $data, TRUE);
            echo $data;
        }

        if($accion == 3){
            $data['seguidores'] = $this->functions->listarSeguidoresPorPersona($this->session->id);
            $data = $this->load->view('frontend/modales/siguen', $data, TRUE);
            echo $data;
        }

    }


    public function guardar_notificacion_requerimiento($id_cliente, $texto, $id_req)
    {
        $data = array(
            'id_cliente' => $id_cliente,
            'id_href' => $this->session->id,
            'texto_notificacion' => '<b>'.$this->session->nombre.'</b> '.$texto,
            'fecha_notificacion' => date('Y-m-d'),
            'estado_notificacion' => 0,
            'tipo_notificacion' => 1,
            'id_requerimiento' => $id_req
            );
        $this->functions->notificar_persona($data);
    }



    public function datos_validacion_facil()
    {
        $rut = $this->input->post('rut');
        $pais = $this->input->post('pais');

        $usuario = $this->functions->buscarEmpresaPorRutUsuario($rut);

        $convenios = $this->functions->validarConvenios($usuario->id_empresa);

        $html = '';

        if(count($convenios) == 0){
            $html .= '<tr><td colspan="3">No hay alianzas registrados para el rut ingresado</td></tr>';
        } else {
            foreach ($convenios as $convenio){
                $html .= '<tr>
                    <td>'.$this->functions->nombreEmpresa($convenio->id_empresa).'</td>
                    <td>'.$convenio->titulo_convenio.'</td>
                    <td>'.$convenio->estado.'</td>
                </tr>';
            }
        }

        echo $html;

    }


}
