<?php

class ClientesModel extends CI_Model {




        public $table = 'clientes';

        public function __construct()
        {
                parent::__construct();
        }

        public function listar()
        {
            $this->db->join('estados', $this->table.'.id_estado = estados.id_estado');
            $query = $this->db->get($this->table);
            return $query->result();
        }

        public function obtener($id_cliente)
        {
            $this->db->join('estados', $this->table.'.id_estado = estados.id_estado');
            $this->db->where('id_cliente', $id_cliente);
            $query = $this->db->get($this->table);
            return $query->result();
        }

        public function insertar($data)
        {
            return $this->db->insert($this->table, $data);
        }

        public function editar($data, $id_cliente)
        {
            $this->db->where('id_cliente', $id_cliente);
            return $this->db->update($this->table, $data);
        }

        public function eliminar($id_cliente)
        {
            $this->db->where('id_cliente', $id_cliente);
            return $this->db->delete($this->table);
        }


        public function obtenerLogin($email, $password)
        {
            $this->db->join('estados', $this->table.'.id_estado = estados.id_estado');
            $this->db->where($this->table.'.email_cliente', $email);
            $this->db->where($this->table.'.password_cliente', $password);
            $query = $this->db->get($this->table);
            return $query->result();
        }


        public function misRecomendaciones($id_cliente)
        {
            $this->db->join('empresas', 'recomendaciones.id_empresa = empresas.id_empresa');
            $this->db->where('recomendaciones.id_cliente', $id_cliente);
            $this->db->select('empresas.nombre_empresa, empresas.id_empresa, empresas.id_categoria');
            $query = $this->db->get('recomendaciones');
            return $query->result();
        }

        public function comunaTrabajo($id_cliente)
        {
            $this->db->where('id_cliente', $id_cliente);
            $this->db->select('comuna_trabajo_cliente');
            $query = $this->db->get('clientes');
            $result = $query->row();
            return $result->comuna_trabajo_cliente;
        }

        public function comunaResidencia($id_cliente)
        {
            $this->db->where('id_cliente', $id_cliente);
            $this->db->select('comuna_cliente');
            $query = $this->db->get('clientes');
            $result = $query->row();
            return $result->comuna_cliente;
        }

        public function empresasComunaTrabajo($comuna, $order)
        {
            $this->db->group_by('p.id_producto');
            if($order != '' && $order != 4){
                $this->db->where('pp.id_tipo_promocion', $order);
            }
            $this->db->where('e.comuna_empresa', $comuna);
            $this->db->join('tipo_promocion tp', 'pp.id_tipo_promocion = tp.id_tipo_promocion');
            $this->db->join('productos p', 'p.id_producto = pp.id_producto');
            $this->db->join('empresas e', 'p.id_empresa = e.id_empresa');
            $this->db->join('productos_imagenes pi', 'p.id_producto = pi.id_producto', 'left');
            $this->db->select('p.id_producto, pp.descuento_promocion, tp.tipo_promocion, p.nombre_producto, e.nombre_empresa, pp.id_tipo_promocion, pi.nombre_imagen, e.id_empresa, e.id_categoria, p.id_sub_sub_categoria');
            $productos = $this->db->get('productos_promociones pp')->result();

            $this->db->group_by('p.id_servicio');
            if($order != '' && $order != 4){
                $this->db->where('pp.id_tipo_promocion', $order);
            }
            $this->db->where('e.comuna_empresa', $comuna);
            $this->db->join('tipo_promocion tp', 'pp.id_tipo_promocion = tp.id_tipo_promocion');
            $this->db->join('servicios p', 'p.id_servicio = pp.id_servicio');
            $this->db->join('empresas e', 'p.id_empresa = e.id_empresa');
            $this->db->join('servicios_imagenes pi', 'p.id_servicio = pi.id_servicio', 'left');
            $this->db->select('p.id_servicio, pp.descuento_promocion, tp.tipo_promocion, p.nombre_servicio, e.nombre_empresa, pp.id_tipo_promocion, pi.nombre_imagen, e.id_empresa, e.id_categoria, p.id_sub_sub_categoria');
            $servicios = $this->db->get('servicios_promociones pp')->result();


            $arrayPromociones = array();

            $x = 0;
            foreach ($productos as $p) {
                $arrayPromociones[$x]['id'] = $p->id_producto;
                if($p->id_tipo_promocion == 1){
                    $arrayPromociones[$x]['promocion'] = '-'.$p->descuento_promocion.' '.$p->tipo_promocion;
                } else {
                    $arrayPromociones[$x]['promocion'] = $p->tipo_promocion;
                }
                $arrayPromociones[$x]['nombre'] = $p->nombre_producto;
                $arrayPromociones[$x]['empresa'] = $p->nombre_empresa;
                if($this->functions->ImagenPrincipalProducto($p->id_producto) == ''){
                    $arrayPromociones[$x]['imagen'] = '';
                } else {
                    $arrayPromociones[$x]['imagen'] = PRODUCTOS_EMPRESA_PATH.$this->functions->ImagenPrincipalProducto($p->id_producto);
                }
                $arrayPromociones[$x]['id_empresa'] = $p->id_empresa;
                $arrayPromociones[$x]['id_categoria'] = $p->id_categoria;
                $arrayPromociones[$x]['href'] = base_url().'microempresarios/producto/3/'.$p->id_sub_sub_categoria.'/'.$p->id_empresa.'/'.$p->id_producto;
                $x++;
                if($x == 8){return $arrayPromociones;}
            }

            foreach ($servicios as $s) {
                $arrayPromociones[$x]['id'] = $s->id_servicio;
                if($s->id_tipo_promocion == 1){
                    $arrayPromociones[$x]['promocion'] = '-'.$s->descuento_promocion.' '.$s->tipo_promocion;
                } else {
                    $arrayPromociones[$x]['promocion'] = $s->tipo_promocion;
                }
                $arrayPromociones[$x]['nombre'] = $s->nombre_servicio;
                $arrayPromociones[$x]['empresa'] = $s->nombre_empresa;
                if($this->functions->ImagenPrincipalServicio($s->id_servicio) == ''){
                    $arrayPromociones[$x]['imagen'] = '';
                } else {
                    $arrayPromociones[$x]['imagen'] = SERVICIOS_EMPRESA_PATH.$this->functions->ImagenPrincipalServicio($s->id_servicio);
                }
                $arrayPromociones[$x]['id_empresa'] = $s->id_empresa;
                $arrayPromociones[$x]['id_categoria'] = $s->id_categoria;
                $arrayPromociones[$x]['href'] = base_url().'microempresarios/servicio/3/'.$s->id_sub_sub_categoria.'/'.$s->id_empresa.'/'.$s->id_servicio;
                $x++;
                if($x == 8){return $arrayPromociones;}
            }

                return $arrayPromociones;
        }


        public function empresasComunaResidencia($comuna, $order)
        {
            $this->db->group_by('p.id_producto');
            if($order != '' && $order != 4){
                $this->db->where('pp.id_tipo_promocion', $order);
            }
            $this->db->where('e.comuna_empresa', $comuna);
            $this->db->join('tipo_promocion tp', 'pp.id_tipo_promocion = tp.id_tipo_promocion');
            $this->db->join('productos p', 'p.id_producto = pp.id_producto');
            $this->db->join('empresas e', 'p.id_empresa = e.id_empresa');
            $this->db->join('productos_imagenes pi', 'p.id_producto = pi.id_producto', 'left');
            $this->db->select('p.id_producto, pp.descuento_promocion, tp.tipo_promocion, p.nombre_producto, e.nombre_empresa, pp.id_tipo_promocion, pi.nombre_imagen, e.id_empresa, e.id_categoria, p.id_sub_sub_categoria');
            $productos = $this->db->get('productos_promociones pp')->result();

            $this->db->group_by('p.id_servicio');
            if($order != '' && $order != 4){
                $this->db->where('pp.id_tipo_promocion', $order);
            }
            $this->db->where('e.comuna_empresa', $comuna);
            $this->db->join('tipo_promocion tp', 'pp.id_tipo_promocion = tp.id_tipo_promocion');
            $this->db->join('servicios p', 'p.id_servicio = pp.id_servicio');
            $this->db->join('empresas e', 'p.id_empresa = e.id_empresa');
            $this->db->join('servicios_imagenes pi', 'p.id_servicio = pi.id_servicio', 'left');
            $this->db->select('p.id_servicio, pp.descuento_promocion, tp.tipo_promocion, p.nombre_servicio, e.nombre_empresa, pp.id_tipo_promocion, pi.nombre_imagen, e.id_empresa, e.id_categoria, p.id_sub_sub_categoria');
            $servicios = $this->db->get('servicios_promociones pp')->result();


            $arrayPromociones = array();

            $x = 0;
            foreach ($productos as $p) {
                $arrayPromociones[$x]['id'] = $p->id_producto;
                if($p->id_tipo_promocion == 1){
                    $arrayPromociones[$x]['promocion'] = '-'.$p->descuento_promocion.' '.$p->tipo_promocion;
                } else {
                    $arrayPromociones[$x]['promocion'] = $p->tipo_promocion;
                }
                $arrayPromociones[$x]['nombre'] = $p->nombre_producto;
                $arrayPromociones[$x]['empresa'] = $p->nombre_empresa;
                if($this->functions->ImagenPrincipalProducto($p->id_producto) == ''){
                    $arrayPromociones[$x]['imagen'] = '';
                } else {
                    $arrayPromociones[$x]['imagen'] = PRODUCTOS_EMPRESA_PATH.$this->functions->ImagenPrincipalProducto($p->id_producto);
                }
                $arrayPromociones[$x]['id_empresa'] = $p->id_empresa;
                $arrayPromociones[$x]['id_categoria'] = $p->id_categoria;
                $arrayPromociones[$x]['href'] = base_url().'microempresarios/producto/3/'.$p->id_sub_sub_categoria.'/'.$p->id_empresa.'/'.$p->id_producto;
                $x++;
                if($x == 8){return $arrayPromociones;}
            }

            foreach ($servicios as $s) {
                $arrayPromociones[$x]['id'] = $s->id_servicio;
                if($s->id_tipo_promocion == 1){
                    $arrayPromociones[$x]['promocion'] = '-'.$s->descuento_promocion.' '.$s->tipo_promocion;
                } else {
                    $arrayPromociones[$x]['promocion'] = $s->tipo_promocion;
                }
                $arrayPromociones[$x]['nombre'] = $s->nombre_servicio;
                $arrayPromociones[$x]['empresa'] = $s->nombre_empresa;
                if($this->functions->ImagenPrincipalServicio($s->id_servicio) == ''){
                    $arrayPromociones[$x]['imagen'] = '';
                } else {
                    $arrayPromociones[$x]['imagen'] = SERVICIOS_EMPRESA_PATH.$this->functions->ImagenPrincipalServicio($s->id_servicio);
                }
                $arrayPromociones[$x]['id_empresa'] = $s->id_empresa;
                $arrayPromociones[$x]['id_categoria'] = $s->id_categoria;
                $arrayPromociones[$x]['href'] = base_url().'microempresarios/servicio/3/'.$s->id_sub_sub_categoria.'/'.$s->id_empresa.'/'.$s->id_servicio;
                $x++;
                if($x == 8){return $arrayPromociones;}
            }

                return $arrayPromociones;
        }


        public function insertarImagenPerfil($data, $id_cliente)
        {
            $this->db->where('id_cliente', $id_cliente);
            return $this->db->update($this->table, $data);
        }


        public function empresasPublicadasPorCliente($id_cliente)
        {
            $this->db->where('id_cliente', $id_cliente);
            $this->db->select('nombre_empresa, id_empresa, id_categoria');
            return $this->db->get('empresas')->result();
        }


        public function IDsempresasPublicadasPorCliente($id_cliente)
        {
            $this->db->where('id_cliente', $id_cliente);
            $this->db->select('id_empresa');
            return $this->db->get('empresas')->result();
        }


        public function recuerdaPassword($email)
        {
            $this->db->join('estados', $this->table.'.id_estado = estados.id_estado');
            $this->db->where($this->table.'.id_estado', 1);
            $this->db->where($this->table.'.email_cliente', $email);
            $query = $this->db->get($this->table);
            return $query->result();
        }



        public function desactivarCuenta($id_cliente, $motivo, $empresas)
        {
            $this->db->where('id_cliente', $id_cliente);
            $this->db->update('clientes', array('id_estado' => 0, 'motivo_cierre' => $motivo));

            $this->db->where('id_cliente', $id_cliente);
            $this->db->update('empresas', array('id_estado' => 0));

            if(count($empresas) > 0){
                $this->db->where_in('id_empresa', $empresas);
                $this->db->update('productos', array('id_estado' => 0));

                $this->db->where_in('id_empresa', $empresas);
                $this->db->update('servicios', array('id_estado' => 0));
            }

            $this->db->where('id_cliente', $id_cliente);
            $this->db->update('requerimientos', array('estado_requerimiento' => 0));

            $this->db->where('id_cliente', $id_cliente);
            $this->db->update('ofertas', array('estado_oferta' => 0));

        }



        public function eliminarCuenta($id_cliente, $empresas)
        {
            $this->db->where('id_cliente', $id_cliente);
            $this->db->delete('clientes');

            $this->db->where('id_cliente', $id_cliente);
            $this->db->delete('empresas');

            if(count($empresas) > 0){
                $this->db->where_in('id_empresa', $empresas);
                $this->db->delete('productos');

                $this->db->where_in('id_empresa', $empresas);
                $this->db->delete('servicios');
            }

            $this->db->where('id_cliente', $id_cliente);
            $this->db->delete('requerimientos');

            $this->db->where('id_cliente', $id_cliente);
            $this->db->delete('ofertas');

        }


        public function activarCuenta($id_cliente, $motivo, $empresas)
        {
            $this->db->where('id_cliente', $id_cliente);
            $this->db->update('clientes', array('id_estado' => 1, 'motivo_cierre' => $motivo));

            $this->db->where('id_cliente', $id_cliente);
            $this->db->update('empresas', array('id_estado' => 1));

            if(count($empresas) > 0){
                $this->db->where_in('id_empresa', $empresas);
                $this->db->update('productos', array('id_estado' => 1));

                $this->db->where_in('id_empresa', $empresas);
                $this->db->update('servicios', array('id_estado' => 1));
            }

            $this->db->where('id_cliente', $id_cliente);
            $this->db->update('requerimientos', array('estado_requerimiento' => 1));

            $this->db->where('id_cliente', $id_cliente);
            $this->db->update('ofertas', array('estado_oferta' => 1));

        }



}