<?php

class FunctionsModel extends CI_Model {

        public $rse_db;
        public $chat_db;

        public function __construct()
        {
            parent::__construct();
            $this->rse_db = $this->load->database('rse', TRUE);
            //$this->chat_db = $this->load->database('chat', TRUE);
        }


/*===============================================================================================*/
/*===============================================================================================*/

    //FUNCTIONES GLOBALES validar accesos, emails, formatos, sanitizar inputs, fechas, etc...



        public function rango_mes_actual($datestr)
        {

            date_default_timezone_set(date_default_timezone_get());
            $dt = strtotime($datestr);
            $res['start'] = date('Y-m-d', strtotime('first day of this month', $dt));
            $res['end'] = date('Y-m-d', strtotime('last day of this month', $dt));
            return $res;

        }

        public function rango_semana_actual($datestr)
        {

            date_default_timezone_set(date_default_timezone_get());
            $dt = strtotime($datestr);
            $res['start'] = date('N', $dt) == 1 ? date('Y-m-d', $dt) : date('Y-m-d', strtotime('last monday', $dt));
            $res['end'] = date('N', $dt) == 7 ? date('Y-m-d', $dt) : date('Y-m-d', strtotime('next sunday', $dt));
            return $res;

        }


        public function eliminar_ultima_coma($string)
        {
            return substr($string, 0, strlen($string) - 2);
        }


        public function AccessValidate()
        {
            if(!$user = $this->session->id_usuario){
                redirect(base_url().'panel');
            }
        }


        public function AccessValidateFrontEnd()
        {
            if(!$id = $this->session->id){
                $this->session->set_flashdata('mensaje', '<div class="alert alert-info">Inicia tu sesión para acceder al contenido</div>');
                redirect(base_url().'registro/ingreso');
            }
        }


        public function getActiveNav()
        {

            $full_name = $_SERVER[ 'REQUEST_URI' ];
            $name_array = explode( '/', $full_name );
            $count = count($name_array);
            $page_name = $name_array[$count - 1];
            return $page_name;

        }


        public function activeNav($identify)
        {

            if($identify == self::getActiveNav()) {
                $class = 'class="active"';
            } else {
                $class = '';
            }

            return $class;

        }


        public function validateEmail($email)
        {

           $pattern = '#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#';
           if(preg_match($pattern, $email)) {
              return true;
           } else {
             return false;
           }

        }


        public function sanitizeString($value)
        {

            $value = trim($value);

            if (get_magic_quotes_gpc()) { $value = stripslashes($value); }
            $value = strip_tags($value);
            $value = htmlspecialchars($value);
            return $value;

        }




        function replace_special_chars($string)
        {

            $string = trim($string);

            $string = str_replace(
                array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
                array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
                $string
            );

            $string = str_replace(
                array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
                array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
                $string
            );

            $string = str_replace(
                array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
                array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
                $string
            );

            $string = str_replace(
                array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
                array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
                $string
            );

            $string = str_replace(
                array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
                array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
                $string
            );

            $string = str_replace(
                array('ñ', 'Ñ', 'ç', 'Ç'),
                array('n', 'N', 'c', 'C',),
                $string
            );

            return $string;
        }




        public function validateRut($rut)
        {

            if (!preg_match("/^[0-9]+-[0-9kK]{1}/", $rut)) return false;
                $partes = explode('-', $rut);
                return strtolower($partes[1]) == Functions::dv($partes[0]);

        }


        static function dv($dv)
        {

            $m = 0;
            $s = 1;
            for(;$dv;$dv=floor($dv/10))
                $s=($s+$dv%10*(9-$m++%6))%11;
            return $s?$s-1:'k';

        }

        public function createPassword()
        {
            $may  = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
            $cadena = str_shuffle($may);
            $passMay = substr($cadena, 1,1);

            $min = "abcdefghijklmnopqrstuvwxyz";
            $cadena2 = str_shuffle($min);
            $passMin = substr($cadena2, 5,3);

            $passPoint = '.';

            $num = "1234567890";
            $cadena3 = str_shuffle($num);
            $passNum = substr($cadena3, 2,4);

            return $passMay.$passMin.$passPoint.$passNum;
        }

        public function vigencia($fecha, $duracion, $id_promocion = 0, $tipo = 0)
        {

            if($fecha == ''){
                return '';
            }

            $hoy = date('Y-m-d');

            $nuevafecha = strtotime ('+ '.$duracion.' day', strtotime($fecha));
            $nuevafecha = date('Y-m-d' ,$nuevafecha);

            $ts1 = strtotime($nuevafecha);
            $ts2 = strtotime($hoy);

            $seconds_diff = $ts1 - $ts2;

            $dias_calculados = floor($seconds_diff / (60 * 60 * 24));

            if($dias_calculados < 0){
                //cambiar estado
                if($id_promocion != 0){
                    self::vencer_promocion($id_promocion, $tipo);
                }
                return 'Vencida';
            }

            return $dias_calculados;

        }

        public function vencer_promocion($id_promocion)
        {
            $data = array('id_estado' => 0);
            if($tipo == 1){
                $this->db->where('id_promocion', $id_promocion);
                $this->db->update('productos_promociones', $data);
            } else {
                $this->db->where('id_promocion', $id_promocion);
                $this->db->update('servicios_promociones', $data);
            }
        }


        public function moneda($valor)
        {
            return number_format($valor, 0, ',', '.');
        }

        public function horaAM($valor)
        {
            if($valor == '' or $valor == NULL){
                return '';
            } else {
                $am = explode('a', $valor);
                if(strlen($am[0]) < 4){
                    return trim($am[0].':00');
                } else {
                    return trim($am[0]);
                }
            }
        }

        public function horaPM($valor)
        {
            if($valor == '' or $valor == NULL){
                return '';
            } else {
                $pm = explode('a', $valor);
                if(strlen($pm[1]) < 4){
                    return trim($pm[1].':00');
                } else {
                    return trim($pm[1]);
                }
            }
        }

        //si es 0 retorna un string vacío
        public function fono_empresa($fono)
        {
            if($fono == 0){
                return '';
            } else {
                return $fono;
            }
        }


//FIN - GENERALES

/*===============================================================================================*/
/*===============================================================================================*/




/*===============================================================================================*/
/*===============================================================================================*/

    //ALERTAS PARA EL SITIO! son los mensajes que se muestra al usuario que realiza interacciones con el sitio

        public function showAlertSuccess($texto)
        {
            return '<div class="alert alert-success">'.$texto.'</div>';
        }

        public function showAlertdanger($texto)
        {
            return '<div class="alert alert-danger">'.$texto.'</div>';
        }

        public function showAlertWarning($texto)
        {
            return '<div class="alert alert-danger">'.$texto.'</div>';
        }

        public function showAlertInfo($texto)
        {
            return '<div class="alert alert-info">'.$texto.'</div>';
        }

//FIN MENSAJES - ALERTAS

/*===============================================================================================*/
/*===============================================================================================*/



/*===============================================================================================*/
/*===============================================================================================*/


        //FUNCIONES PARA EMPRESAS (MUESTRA DETALLES PARA LA EMPRESA, RECIBE ID_EMPRESA)
        public function cantidadProductos($id)
        {
            $this->db->where('id_estado', 1);
            $this->db->where('id_empresa', $id);
            $query = $this->db->count_all_results('productos');
            //esto se hace para que cada vez se vayan actualizando la cantidad de productos de las empresas, a la cantidad actual
            $data = array('cantidad_productos' => $query);
            $this->db->where('id_empresa', $id);
            $this->db->update('empresas', $data);
            //fin actualización de cantidad
            return $query;

        }

        public function cantidadRecomendaciones($id)
        {
            $this->db->where('id_empresa', $id);
            $this->db->join('clientes', 'recomendaciones.id_cliente = clientes.id_cliente');
            $query = $this->db->count_all_results('recomendaciones');
            //igual que arriba
            $data = array('cantidad_recomendaciones' => $query);
            $this->db->where('id_empresa', $id);
            $this->db->update('empresas', $data);
            return $query;
        }


        public function listarRecomendacionesPorEmpresa($id_empresa)
        {
            $this->db->where('id_empresa', $id_empresa);
            $this->db->join('clientes', 'recomendaciones.id_cliente = clientes.id_cliente');
            $this->db->select('clientes.nombre_cliente, clientes.id_cliente');
            $query = $this->db->get('recomendaciones');
            return $query->result();
        }


        public function listarSeguidoresPorEmpresa($id_empresa)
        {
            $this->db->where('s.id_empresa', $id_empresa);
            $this->db->join('clientes c', 's.id_cliente = c.id_cliente');
            $this->db->select('c.nombre_cliente, c.id_cliente');
            $query = $this->db->get('seguir_empresa s');
            return $query->result();
        }


        public function listarSeguidoresPorPersona($id, $order = 0)
        {
            $this->db->where('s.id_cliente', $id);
            $this->db->join('clientes c', 's.id_seguidor = c.id_cliente');
            $query = $this->db->get('seguir_persona s');
            return $query->result();
        }


        public function requerimientosPorPersona($id)
        {
            $this->db->where('r.id_cliente', $id);
            $this->db->join('subcategorias s', 's.id_subcategoria = r.id_subcategoria');
            $this->db->join('categorias c', 'c.id_categoria = r.id_categoria');
            $query = $this->db->get('requerimientos r');
            return $query->result();
        }


        public function cantidadServicios($id)
        {
            $this->db->where('id_estado', 1);
            $this->db->where('id_empresa', $id);
            $query = $this->db->count_all_results('servicios');
            //actualiza cantidad, igual que arriba
            $data = array('cantidad_servicios' => $query);
            $this->db->where('id_empresa', $id);
            $this->db->update('empresas', $data);
            return $query;
        }

        public function cantidadPromocionesProductos($id)
        {
            $this->db->where('id_estado', 1);
            $this->db->where('id_empresa', $id);
            return $query = $this->db->count_all_results('productos_promociones');
        }



        public function cantidadSeguidores($id)
        {
            $this->db->where('id_empresa', $id);
            $query = $this->db->count_all_results('seguir_empresa');
            return $query;
        }



        public function cantidadPromocionesServicios($id)
        {
            $this->db->where('id_estado', 1);
            $this->db->where('id_empresa', $id);
            return $query = $this->db->count_all_results('servicios_promociones');
        }


        public function cantidadPromociones($id)
        {
            $productos = self::cantidadPromocionesProductos($id);
            $servicios = self::cantidadPromocionesServicios($id);
            $total = $productos + $servicios;
            $data = array('cantidad_promociones' => $total);
            $this->db->where('id_empresa', $id);
            $this->db->update('empresas', $data);
            return $total;
        }

        public function SCNombresPorEmpresa($id)
        {
            $this->db->where('esc.id_empresa', $id);
            $this->db->join('subcategorias sc', 'esc.id_subcategoria = sc.id_subcategoria');
            $query = $this->db->get('empresa_subcategorias esc')->result();
            $texto = '';
            foreach ($query as $k => $v) {
                $texto .= $v->nombre_subcategoria.', ';
            }

            return substr($texto, 0, -2);

        }


        public function EmailEmpresa($id_empresa)
        {
            $this->db->where('id_empresa', $id_empresa);
            $this->db->select('empresas.email_empresa');
            $query = $this->db->get('empresas');
            $result = $query->row();
            return $result->email_empresa;
        }


        public function EmailPersona($id_cliente)
        {
            $this->db->where('id_cliente', $id_cliente);
            $this->db->select('clientes.email_cliente');
            $query = $this->db->get('clientes');
            $result = $query->row();
            return $result->email_cliente;
        }


        public function yaFueRecomendada($id_empresa)
        {
            $this->db->where('id_empresa', $id_empresa);
            $this->db->where('id_cliente', $this->session->id);
            $query = $this->db->get('recomendaciones')->row();
            return count($query);
        }


        public function tieneSubcategoria($id_subcategoria, $id_empresa)
        {
            $this->db->where('id_subcategoria', $id_subcategoria);
            $this->db->where('id_empresa', $id_empresa);
            return $query = $this->db->count_all_results('empresa_subcategorias');
        }


        public function tieneSubsubcategoria($id_sub_subcategoria, $id_empresa)
        {
            $this->db->where('id_sub_subcategoria', $id_sub_subcategoria);
            $this->db->where('id_empresa', $id_empresa);
            return $query = $this->db->count_all_results('empresa_sub_subcategorias');
        }


        public function tienePago($id_pago, $id_empresa)
        {
            $this->db->where('id_medio_pago', $id_pago);
            $this->db->where('id_empresa', $id_empresa);
            return $query = $this->db->count_all_results('pagos_empresa');
        }


        public function notificaciones_empresa($id)
        {
            $this->db->where('estado_notificacion', 0);
            $this->db->where('id_empresa', $id);
            $query = $this->db->get('notificaciones');
            return $query->result();
        }


        public function notificaciones_persona($id, $flag)
        {
            $this->db->order_by('id_notificacion', 'desc');
            if($flag == 0){
                $this->db->where('estado_notificacion', 0);
            }
            $this->db->where('id_cliente', $id);
            $query = $this->db->get('notificaciones_persona');
            return $query->result();
        }


        public function notificaciones_convenio($id, $flag)
        {

            $this->db->order_by('id_notificacion', 'desc');
            if($flag == 0){
                $this->db->where('estado_notificacion', 0);
            }
            $this->db->where('id_cliente', $id);
            $query = $this->db->get('notificaciones_convenio');
            return $query->result();
        }


        public function cantidadEmpresasPorSubcategoria($id, $id_categoria)
        {
            $this->db->where('s.id_categoria', $id_categoria);
            $this->db->where('es.id_subcategoria', $id);
            $this->db->join('subcategorias s', 's.id_subcategoria = es.id_subcategoria');
            return $query = $this->db->count_all_results('empresa_subcategorias es');
        }

        public function cantidadEmpresasPorSubsubcategoria($id)
        {
            $this->db->where('id_sub_subcategoria', $id);
            return $query = $this->db->count_all_results('empresa_sub_subcategorias');
        }


        public function cantidadEmpresasPorRegion($nombre, $id_categoria)
        {
            $this->db->where('region_empresa', $nombre);
            $this->db->where('id_categoria', $id_categoria);
            return $query = $this->db->count_all_results('empresas');
        }


        public function cantidadEmpresasPorComuna($nombre, $id_categoria)
        {
            $this->db->where('comuna_empresa', $nombre);
            $this->db->where('id_categoria', $id_categoria);
            return $query = $this->db->count_all_results('empresas');
        }

        public function cantidadEmpresasDespacho($valor, $id_categoria)
        {
            $this->db->where('despacho_empresa', $valor);
            $this->db->where('id_categoria', $id_categoria);
            return $query = $this->db->count_all_results('empresas');
        }

        public function nombreCategoria($id)
        {
            $this->db->where('id_categoria', $id);
            $query = $this->db->get('categorias')->row();
            return $query->nombre_categoria;
        }


        public function nombreSubcategoria($id)
        {
            $this->db->where('id_subcategoria', $id);
            $query = $this->db->get('subcategorias')->row();
            return $query->nombre_subcategoria;
        }

        public function nombreSubsubcategoria($id)
        {
            $this->db->where('id_sub_subcategoria', $id);
            $query = $this->db->get('sub_subcategorias')->row();
            return $query->nombre_sub_subcategoria;
        }


        public function nombreEmpresa($id)
        {
            $this->db->where('id_empresa', $id);
            $query = $this->db->get('empresas')->row();
            return $query->nombre_empresa;
        }


        //FIN FUNCIONES EMPRESA
/*===============================================================================================*/
/*===============================================================================================*/



/*===============================================================================================*/
/*===============================================================================================*/

    //LISTADO DE GLOBALES (Regiones, Comunas, Perfiles, ETC....)


        public function listarRegiones()
        {
            $this->db->order_by('orden_region', 'asc');
            return $query = $this->db->get('regiones')->result();
        }

        public function listarCategorias()
        {
            $this->db->order_by('nombre_categoria', 'asc');
            return $query = $this->db->get('categorias')->result();
        }

        public function listarComunas()
        {
            $this->db->order_by('nombre_comuna', 'asc');
            return $query = $this->db->get('comunas')->result();
        }

        public function comunasPorRegion($id)
        {
            $this->db->where('id_region', $id);
            $this->db->order_by('nombre_comuna', 'asc');
            return $query = $this->db->get('comunas')->result();
        }


        public function comunasPorRegionCheckbox($id)
        {
            $this->db->where_in('id_region', $id);
            $this->db->order_by('nombre_comuna', 'asc');
            return $query = $this->db->get('comunas')->result();
        }


        public function subcategoriasPorCategoria($id)
        {
            $this->db->where('id_categoria', $id);
            $this->db->order_by('nombre_subcategoria', 'asc');
            return $query = $this->db->get('subcategorias')->result();
        }


        public function sub_subcategoriasPorSubcategoria($id)
        {
            $this->db->where_in('id_subcategoria', $id);
            $this->db->order_by('nombre_sub_subcategoria', 'asc');
            return $query = $this->db->get('sub_subcategorias')->result();
        }

        //FIN FUNCIONES GLOBALES
/*===============================================================================================*/
/*===============================================================================================*/


/*===============================================================================================*/
/*===============================================================================================*/
    //FUNCIONES PARA PRODUCTOS, SERVICIOS, Y PROMOCIONES

    public function ImagenPrincipalProducto($id_producto)
    {
        $this->db->where('id_producto', $id_producto);
        $this->db->order_by('id_producto_imagen', 'asc');
        $this->db->limit(1);
        $query = $this->db->get('productos_imagenes');
        $result = $query->row();
        if($result){ return $result->nombre_imagen; } else { return ''; }

    }

    public function ImagenPrincipalServicio($id_servicio)
    {
        $this->db->where('id_servicio', $id_servicio);
        $this->db->order_by('id_servicio_imagen', 'asc');
        $this->db->limit(1);
        $query = $this->db->get('servicios_imagenes');
        $result = $query->row();
        if($result){ return $result->nombre_imagen; } else { return ''; }
    }


    public function ImagenesProductos($id_producto)
    {
        $this->db->where('id_producto', $id_producto);
        $this->db->order_by('id_producto_imagen', 'asc');
        return $this->db->get('productos_imagenes')->result();
    }

    public function ImagenesServicios($id_servicio)
    {
        $this->db->where('id_servicio', $id_servicio);
        $this->db->order_by('id_servicio_imagen', 'asc');
        return $this->db->get('servicios_imagenes')->result();

    }


    public function PromocionesProductos($id_producto)
    {
        $this->db->where('id_producto', $id_producto);
        $this->db->join('tipo_promocion tp', 'tp.id_tipo_promocion = pp.id_tipo_promocion');
        return $this->db->get('productos_promociones pp')->result();
    }


    public function PromocionesServicios($id_servicio)
    {
        $this->db->where('id_servicio', $id_servicio);
        $this->db->join('tipo_promocion tp', 'tp.id_tipo_promocion = sp.id_tipo_promocion');
        return $this->db->get('servicios_promociones sp')->result();
    }


    public function sumarVistas($id_producto)
    {
        $cantidad = $this->db->query('select cantidad_vistas from productos_vistas where id_producto = '.$id_producto)->row()->cantidad_vistas;
        $cantidad_vistas = (int)$cantidad + 1;
        $data = array('id_producto' => $id_producto, 'cantidad_vistas' => $cantidad_vistas);$this->db->where('id_producto', $id_producto);
        $this->db->where('id_producto', $id_producto);
        return $this->db->update('productos_vistas', $data);
    }


    public function precioDescuento($id)
    {


        $tipo = $this->PromocionesProductos($id);

        if(count($tipo) > 0){

            if($tipo[0]->id_tipo_promocion == 1){
                $precio = $this->db->query('select p.precio_producto, pp.id_tipo_promocion, pp.descuento_promocion from productos p inner join productos_promociones pp on p.id_producto = pp.id_producto where p.id_producto = '.$id)->result();
                if(count($precio) > 0){
                    $descuento = str_replace('%', '', $precio[0]->descuento_promocion);
                    $uno = $precio[0]->precio_producto * $descuento;
                    $uno = $uno / 100;
                    $precio_final = $precio[0]->precio_producto - $uno;
                    return self::moneda($precio_final);
                }
            } else {
                $precio = $this->db->query('select p.precio_producto, pp.id_tipo_promocion, pp.descuento_promocion from productos p inner join productos_promociones pp on p.id_producto = pp.id_producto where p.id_producto = '.$id)->result();
                if(count($precio) > 0){
                    return self::moneda($precio[0]->precio_producto);
                }
            }

        } else {
            $precio_final = '';
            return $precio_final;
        }

    }


    public function precioDescuentoServicio($id)
    {


        $tipo = $this->PromocionesServicios($id);

        if(count($tipo) > 0){

            if($tipo[0]->id_tipo_promocion == 1){
                $precio = $this->db->query('select p.precio_servicio, pp.id_tipo_promocion, pp.descuento_promocion from servicios p inner join servicios_promociones pp on p.id_servicio = pp.id_servicio where p.id_servicio = '.$id)->result();
                if(count($precio) > 0){
                    $descuento = str_replace('%', '', $precio[0]->descuento_promocion);
                    $uno = $precio[0]->precio_servicio * $descuento;
                    $uno = $uno / 100;
                    $precio_final = $precio[0]->precio_servicio - $uno;
                    return self::moneda($precio_final);
                }
            } else {
                $precio = $this->db->query('select p.precio_servicio, pp.id_tipo_promocion, pp.descuento_promocion from servicios p inner join servicios_promociones pp on p.id_servicio = pp.id_servicio where p.id_servicio = '.$id)->result();
                if(count($precio) > 0){
                    return self::moneda($precio[0]->precio_servicio);
                }
            }

        } else {
            $precio_final = '';
            return $precio_final;
        }

    }


    public function idCategoriaPorSubSubcategoria($id_sub_subcategoria)
    {
        $query = $this->db->query('select c.id_categoria from sub_subcategorias ss inner join subcategorias s on ss.id_subcategoria = s.id_subcategoria inner join categorias c on s.id_categoria = c.id_categoria where ss.id_sub_subcategoria = '.$id_sub_subcategoria)->result();
        return $query[0]->id_categoria;

    }


    public function idCategoriaPorSubcategoria($id_subcategoria)
    {
        $query = $this->db->query('select c.id_categoria from subcategorias s inner join categorias c on s.id_categoria = c.id_categoria where s.id_subcategoria = '.$id_subcategoria)->result();
        return $query[0]->id_categoria;

    }



    public function notificar_empresa($data)
    {
        return $this->db->insert('notificaciones', $data);
    }


    public function notificar_persona($data)
    {
        return $this->db->insert('notificaciones_persona', $data);
    }


    public function yaSeguidoEmpresa($id_empresa)
    {
        $this->db->where('id_cliente', $this->session->id);
        $this->db->where('id_empresa', $id_empresa);
        $query = $this->db->count_all_results('seguir_empresa');
        return $query;
    }



    //FIN FUNCIONES PRODUCTOS/SERVICIOS Y PROMOCIONES
/*===============================================================================================*/
/*===============================================================================================*/








    /***************************/
    //SEGUIDORES (todas las funciones son por persona (id de persona))
    /***********************************************************************************************/


        public function yaSeguido($id_cliente)
        {
            $this->db->where('id_seguidor', $this->session->id);
            $this->db->where('id_cliente', $id_cliente);
            $query = $this->db->count_all_results('seguir_persona');
            return $query;
        }


        public function cantidadRecomendacionesPorPersona($id)
        {
            $this->db->where('id_cliente', $id);
            $query = $this->db->count_all_results('recomendaciones r');
            return $query;
        }


        public function cantidadRequerimientosPorPersona($id)
        {
            $this->db->where('id_cliente', $id);
            $query = $this->db->count_all_results('requerimientos r');
            return $query;
        }


        public function cantidadSeguidoresPorPersona($id)
        {
            $this->db->where('id_cliente', $id);
            $query = $this->db->count_all_results('seguir_persona');
            return $query;
        }


        public function cantidadAyudados($id)
        {
            $this->db->where('id_cliente', $id);
            $query = $this->db->count_all_results('empresas');
            return $query;
        }

        public function cantidadSeguidosPorPersona($id)
        {
            $this->db->where('id_seguidor', $id);
            $uno = $this->db->count_all_results('seguir_persona');

            $this->db->where('id_cliente', $id);
            $dos = $this->db->count_all_results('seguir_empresa');

            return $uno + $dos;
        }


        public function seguir_persona($data)
        {
            return $this->db->insert('seguir_persona', $data);
        }

        public function dejar_seguir_persona($id_seguidor, $id_cliente)
        {
            $this->db->where('id_seguidor', $id_seguidor);
            $this->db->where('id_cliente', $id_cliente);
            return $this->db->delete('seguir_persona');
        }


        public function seguir_empresa($data)
        {
            return $this->db->insert('seguir_empresa', $data);
        }

        public function dejar_seguir_empresa($id_cliente, $id_empresa)
        {
            $this->db->where('id_empresa', $id_empresa);
            $this->db->where('id_cliente', $id_cliente);
            return $this->db->delete('seguir_empresa');
        }



        /*
            para la tabla generales
            1 = Rut del microempresario
            2 = Rut de la persona
            3 = Región
            4 = Comuna
            5 = carrier del país
            6 = largo del celular del país
            7 = País de origen
            8 = APIKEY Mailchimp
            9 = List ID Mailchimp
            se pueden ir agregando datos generales que de acuerdo al país vayan cambiando

            la función recibe el id del dato y retorna el valor asociado
        */

        public function texto_general($id)
        {
            $this->db->where('id', $id);
            $query = $this->db->get('generales');
            $result = $query->row();
            return $result->texto;
        }


        public function imagen_categoria($id)
        {
            $this->db->where('id_categoria', $id);
            $query = $this->db->get('categorias');
            $result = $query->row();
            return $result->imagen_categoria;
        }


        public function datoCliente($id, $dato)
        {
            $this->db->where('id_cliente', $id);
            $this->db->select($dato);
            $query = $this->db->get('clientes');
            $result = $query->row();
            if($result){
                return $result->$dato;
            }

            return '';

        }

        public function yaExisteEmail($email)
        {
            $this->db->where('email_cliente', $email);
            return $query = $this->db->count_all_results('clientes');
        }

        public function yaExisteEmpresa($empresa, $region, $comuna)
        {
            $this->db->where('nombre_empresa', $empresa);
            $this->db->where('region_empresa', $region);
            $this->db->where('comuna_empresa', $comuna);
            return $query = $this->db->count_all_results('empresas');
        }

        public function empresasPublicadasPorCliente($id_cliente)
        {
            $this->db->where('id_cliente', $id_cliente);
            $this->db->select('nombre_empresa, id_empresa, id_categoria');
            return $this->db->get('empresas')->result();
        }


        public function tipoPromocionServicio($id)
        {
            $this->db->where('id_servicio', $id);
            $this->db->select('id_tipo_promocion');
            $query = $this->db->get('servicios_promociones');
            $result = $query->row();
            if(count($result) > 0){
                return $result->id_tipo_promocion;
            }

            return 0;
        }


        public function tipoPromocion($id)
        {
            $this->db->where('id_producto', $id);
            $this->db->select('id_tipo_promocion');
            $query = $this->db->get('productos_promociones');
            $result = $query->row();
            if(count($result) > 0){
                return $result->id_tipo_promocion;
            }

            return 0;

        }


        public function personas_sugeridas()
        {
            $this->db->limit(15);
            $this->db->distinct();
            $this->db->where('id_cliente !=', $this->session->id);
            $this->db->where('comuna_cliente', $this->session->comuna);
            if($this->session->comuna_trabajo != ''){
                $this->db->or_where('comuna_trabajo_cliente', $this->session->comuna_trabajo);
            }
            return $this->db->get('clientes')->result();

        }


        public function empresas_sugeridas()
        {
            $this->db->limit(15);
            $this->db->distinct();
            $this->db->where('id_cliente !=', $this->session->id);
            $this->db->where('comuna_empresa', $this->session->comuna);
            if($this->session->comuna_trabajo != ''){
                $this->db->or_where('comuna_empresa', $this->session->comuna_trabajo);
            }
            return $this->db->get('empresas')->result();
        }


        public function detalle_producto_notificacion($id_producto)
        {

            $this->db->where('pp.id_producto', $id_producto);
            $this->db->join('tipo_promocion tp', 'tp.id_tipo_promocion = pp.id_tipo_promocion');
            $this->db->join('productos p', 'p.id_producto = pp.id_producto');
            $this->db->select('pp.id_producto, pp.descuento_promocion, pp.dias_promocion, p.nombre_producto, p.id_sub_sub_categoria, p.id_empresa, tp.tipo_promocion, pp.id_tipo_promocion');
            return $this->db->get('productos_promociones pp')->result();

        }



        public function detalle_servicio_notificacion($id_servicio)
        {

            $this->db->where('pp.id_servicio', $id_servicio);
            $this->db->join('tipo_promocion tp', 'tp.id_tipo_promocion = pp.id_tipo_promocion');
            $this->db->join('servicios p', 'p.id_servicio = pp.id_servicio');
            $this->db->select('pp.id_servicio, pp.descuento_promocion, pp.dias_promocion, p.nombre_servicio, p.id_sub_sub_categoria, p.id_empresa, tp.tipo_promocion, pp.id_tipo_promocion');
            return $this->db->get('servicios_promociones pp')->result();

        }

        public function obtener_clientes()
        {
            $this->db->order_by('id_cliente', 'desc');
            return $this->db->get('clientes')->result();
        }


        public function nuevo_nombre()
        {

            $this->load->library('encryption');
            $name = bin2hex($this->encryption->create_key(10));
            $date = date('YmdHis');
            return $date.$name;

        }

        public function personas_sugeridas_email($id_cliente, $comuna)
        {
            $this->db->limit(5);
            $this->db->distinct();
            $this->db->where('id_cliente !=', $id_cliente);
            $this->db->where('comuna_cliente', $comuna);
            return $this->db->get('clientes')->result();

        }


        public function empresas_sugeridas_email($id_cliente, $comuna)
        {
            $this->db->limit(5);
            $this->db->distinct();
            $this->db->where('id_cliente !=', $id_cliente);
            $this->db->where('comuna_empresa', $comuna);
            return $this->db->get('empresas')->result();
        }


        public function mostrar_notificacion($id_cliente)
        {
            $this->db->limit(1);
            $this->db->where('id_cliente', $id_cliente);
            $this->db->where('mostrar_notificacion', 0);
            return $this->db->get('notificaciones_persona')->result();
        }


        public function sc_requerimientos($id)
        {
            $this->db->where('s.id_requerimiento', $id);
            $this->db->join('sub_subcategorias sc', 'sc.id_sub_subcategoria = s.id_sub_subcategoria');
            return $this->db->get('requerimientos_sc s')->result();
        }


        public function contar_ofertas($id_requerimiento)
        {
            $this->db->where('id_requerimiento', $id_requerimiento);
            return $query = $this->db->count_all_results('ofertas');
        }

        public function contar_ofertas_cliente($id_cliente)
        {
            $this->db->where('id_ofertador', $id_cliente);
            return $query = $this->db->count_all_results('ofertas');
        }

        public function contar_ofertas_recibidas($id_cliente)
        {
            $this->db->where('id_cliente', $id_cliente);
            return $query = $this->db->count_all_results('ofertas');
        }

        public function contar_requerimientos_cliente($id_cliente)
        {
            $this->db->where('id_cliente', $id_cliente);
            $queryuno = $this->db->count_all_results('requerimientos');

            $this->rse_db->where('tipo_solicitud', 0);
            $this->rse_db->where('id_empresa', $id_cliente);
            $querydos = $this->rse_db->count_all_results('convenios_rse');

            return $queryuno + $querydos;
        }

        public function existe_oferta($id_requerimiento)
        {
            $this->db->where('id_ofertador', $this->session->id);
            $this->db->where('id_requerimiento', $id_requerimiento);
            return $query = $this->db->count_all_results('ofertas');
        }


        public function batchSubscribe(array $data, $apikey)
        {
            $auth          = base64_encode('user:' . $apikey);
            $json_postData = json_encode($data);
            $ch            = curl_init();
            $dataCenter    = substr($apikey, strpos($apikey, '-') + 1);
            $curlopt_url   = 'https://' . $dataCenter . '.api.mailchimp.com/3.0/batches/';
            curl_setopt($ch, CURLOPT_URL, $curlopt_url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json',
                'Authorization: Basic ' . $auth));
            curl_setopt($ch, CURLOPT_USERAGENT, 'PHP-MCAPI/3.0');
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $json_postData);
            $result = curl_exec($ch);
            return $result;
        }

        public function datoRSE($id, $dato)
        {
            $this->rse_db->where('id_empresa', $id);
            $this->rse_db->select($dato);
            $query = $this->rse_db->get('empresas');
            $result = $query->row();
            return $result->$dato;
        }


        public function mensajes()
        {
            $this->chat_db->order_by('id', 'desc');
            $this->chat_db->group_by('id_rse');
            $this->chat_db->where('id_microempresario', $this->session->id);
            $query = $this->chat_db->get('chat');
            return $query->result();
        }

        public function mensajes_sin_leer()
        {
            $this->chat_db->where('leido_portal', 0);
            $this->chat_db->where('id_microempresario', $this->session->id);
            $query = $this->chat_db->get('chat');
            return $query->result();
        }


        public function solicitudes_convenios($id_empresa)
        {
            $this->rse_db->where('c.id_empresa', $id_empresa);
            $query = $this->rse_db->get('convenios_rse c');
            return $query->result();
        }





        function nombre_imagen_empresa($string)
        {

            $string = trim($string);

            $string = str_replace(
                array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
                array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
                $string
            );

            $string = str_replace(
                array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
                array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
                $string
            );

            $string = str_replace(
                array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
                array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
                $string
            );

            $string = str_replace(
                array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
                array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
                $string
            );

            $string = str_replace(
                array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
                array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
                $string
            );

            $string = str_replace(
                array('ñ', 'Ñ', 'ç', 'Ç'),
                array('n', 'N', 'c', 'C',),
                $string
            );

            $string = str_replace(
                array('"', '´', ' ', '.'),
                array('', '', '', '',),
                $string
            );

            return $string;
        }


        public function listarComunasFiltroLateralRegion($nombre_region)
        {

            if($nombre_region != ''){
                $this->db->where('nombre_region', $nombre_region);
                $region = $query = $this->db->get('regiones')->row();



                $this->db->order_by('nombre_comuna', 'asc');
                $this->db->where('id_region', $region->id_region);
                return $query = $this->db->get('comunas')->result();                
            } else {
                $this->db->order_by('nombre_comuna', 'asc');
                return $query = $this->db->get('comunas')->result();                          
            }

        }



        public function contar_usuarios($id_empresa)
        {
            $this->rse_db->where('id_empresa', $id_empresa);
            $query = $this->rse_db->get('usuarios u');


            //esto se hace para que cada vez se vayan actualizando la datos en el registro de la empresa
            $data = array('cantidad_usuarios' => count($query->result()));
            $this->rse_db->where('id_empresa', $id_empresa);
            $this->rse_db->update('empresas', $data);
            //fin actualización de cantidad

            return $query->result();
        }


        public function contar_convenios($id_empresa)
        {
            $this->rse_db->where('id_rse', $id_empresa);
            $this->rse_db->where('estado_convenio', 2);
            $this->rse_db->join('estados_convenio', 'convenios_rse.estado_convenio = estados_convenio.id_estado');
            $query = $this->rse_db->get('convenios_rse');


            //esto se hace para que cada vez se vayan actualizando la datos en el registro de la empresa
            $data = array('cantidad_alianzas' => count($query->result()));
            $this->rse_db->where('id_empresa', $id_empresa);
            $this->rse_db->update('empresas', $data);
            //fin actualización de cantidad

            return $query->result();

        }


        public function contar_requerimientos($id_empresa)
        {
            $this->rse_db->where('id_empresa', $id_empresa);
            $query = $this->rse_db->get('requerimientos');


            //esto se hace para que cada vez se vayan actualizando la datos en el registro de la empresa
            $data = array('cantidad_cotizaciones' => count($query->result()));
            $this->rse_db->where('id_empresa', $id_empresa);
            $this->rse_db->update('empresas', $data);
            //fin actualización de cantidad

            return $query;

        }


        public function nombre_region($id, $pais)
        {
            $this->db->where('id_region', $id);
            $query = $this->db->get('regiones')->row();

            if(count($query) > 0){
                return $query->nombre_region;
            }

            return '';
        }

        public function nombre_comuna($id, $pais)
        {
            $this->db->where('id_comuna', $id);
            $query = $this->db->get('comunas')->row();

            if(count($query) > 0){
                return $query->nombre_comuna;
            }

            return '';

        }



        public function usuarios_listado_slide($id_empresa)
        {
            $this->rse_db->where('id_empresa', $id_empresa);
            $this->rse_db->group_by('comuna_usuario');
            $query = $this->rse_db->get('usuarios');
            return $query->result();
        }

        public function contar_por_comuna($comuna, $id_empresa)
        {
            $this->rse_db->where('id_empresa', $id_empresa);
            $this->rse_db->where('comuna_usuario', $comuna);
            $query = $this->rse_db->count_all_results('usuarios');
            return $query;
        }


        public function categoriaEmpresa($id)
        {
            $this->db->where('e.id_empresa', $id);
            $this->db->join('categorias c', 'c.id_categoria = e.id_categoria');
            $query = $this->db->get('empresas e')->row();
            return $query->nombre_categoria;
        }


        public function categoriaRequerimiento($id)
        {
            $this->db->where('e.id_requerimiento', $id);
            $this->db->join('categorias c', 'c.id_categoria = e.id_categoria');
            $query = $this->db->get('requerimientos e')->row();
            if(count($query) == 0){
                return '';
            }
            return $query->nombre_categoria;
        }


        public function subcategoriaRequerimiento($id)
        {
            $this->db->where('e.id_requerimiento', $id);
            $this->db->join('subcategorias c', 'c.id_subcategoria = e.id_subcategoria');
            $query = $this->db->get('requerimientos e')->row();
            if(count($query) == 0){
                return '';
            }
            return $query->nombre_subcategoria;
        }


        public function listar_requerimientos($id_empresa)
        {
            $this->rse_db->where('r.id_empresa', $id_empresa);
            $this->rse_db->join('sucursales su', 'r.id_sucursal = su.id_sucursal');
            $this->rse_db->join('usuarios u', 'r.id_usuario = u.id_usuario');
            $this->rse_db->select('r.id_requerimiento, r.id_empresa, r.titulo_requerimiento, r.id_categoria, r.fecha_requerimiento, r.id_estado, u.nombre_usuario, u.id_usuario, su.nombre_sucursal, r.descripcion_requerimiento');
            $query = $this->rse_db->get('requerimientos r');
            return $query->result();
        }


        public function id_pais($nombre_pais)
        {
            $this->rse_db->where('pais', $nombre_pais);
            $query = $this->rse_db->get('paises')->row();
            return $query->id_pais;
        }


        public function buscarEmpresaPorRutUsuario($rut)
        {
            $this->rse_db->where('rut_usuario', $rut);
            return $this->rse_db->get('usuarios')->row();
        }


        public function validarConvenios($id_empresa)
        {
            $this->rse_db->where('convenios_rse.id_rse', $id_empresa);
            $this->rse_db->where('convenios_rse.estado_convenio', 2);
            $this->rse_db->join('estados_convenio', 'convenios_rse.estado_convenio = estados_convenio.id_estado');
            $this->rse_db->join('usuarios', 'convenios_rse.id_usuario = usuarios.id_usuario');
            $this->rse_db->select('convenios_rse.*, usuarios.nombre_usuario, estados_convenio.estado');
            $query = $this->rse_db->get('convenios_rse');
            return $query->result();
        }


        public function contar_ofertas_rse($id_requerimiento)
        {
            $this->rse_db->where('id_requerimiento', $id_requerimiento);
            return $query = $this->rse_db->count_all_results('ofertas');
        }

        public function existe_oferta_rse($id_requerimiento)
        {
            $this->rse_db->where('id_cliente', $this->session->id);
            $this->rse_db->where('id_requerimiento', $id_requerimiento);
            return $query = $this->rse_db->count_all_results('ofertas');
        }

        public function notificacion_rse($data)
        {
            return $this->rse_db->insert('notificaciones', $data);
        }

        public function notificacion_rse_leida($id)
        {
            $data = array('estado_notificacion' => 1, 'mostrar_notificacion' => 1);
            $this->db->where('id_href', $id);
            $this->db->update('notificaciones_convenio', $data);
        }


        public function preguntas_respuestas_alianza($id_alianza)
        {
            $this->rse_db->order_by('id_respuesta', 'asc');
            $this->rse_db->where('id_convenio', $id_alianza);
            $hilo = $this->rse_db->get('preguntas_convenio')->result();

            $texto = '';

            foreach ($hilo as $key => $value) {
                $number = $key + 1;
                if($value->origen_pregunta == 1){
                    $texto .= '<b class="blue">'.$number.'.- Pregunta/Respuesta desde Portal RSE:</b><br>';    
                } else {
                    $texto .= '<b class="orange">'.$number.'.- Pregunta/Respuesta desde Portal Microempresa(rios):</b><br>';    
                }
                
                $texto .= '<p>'.$value->pregunta.'</p>';
            }

            return $texto;
        }

        public function datoConvenioRSE($id, $dato)
        {
            $this->rse_db->where('id_convenio', $id);
            $convenio = $this->rse_db->get('convenios_rse')->row();

            $this->rse_db->where('id_empresa', $convenio->id_rse);
            $this->rse_db->select($dato);
            $query = $this->rse_db->get('empresas');
            $result = $query->row();
            return $result->$dato;
        }


}