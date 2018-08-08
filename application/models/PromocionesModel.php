<?php

class PromocionesModel extends CI_Model {

//MODELO SIN TABLA ASOCIADA, PORQUE EXISTEN 2 (SERVICIOS Y PRODUCTOS QUE SE PUEDEN PONER EN PROMOCION)

        public function __construct()
        {
                parent::__construct();
        }

        public function eliminar($id_promocion)
        {
            $this->db->where('id_promocion', $id_promocion);
            return $this->db->delete('productos_promociones');
        }


        public function listarPorEmpresa($id)
        {
            $this->db->join('tipo_promocion tp', 'pp.id_tipo_promocion = tp.id_tipo_promocion');
            $this->db->join('productos p', 'p.id_producto = pp.id_producto');
            $this->db->where('p.id_empresa', $id);
            $this->db->select('pp.dias_promocion, pp.id_estado, pp.id_producto, pp.descuento_promocion, tp.tipo_promocion, p.nombre_producto, pp.fecha_promocion, pp.id_tipo_promocion');
            $productos = $this->db->get('productos_promociones pp')->result();

            $this->db->join('tipo_promocion tp', 'sp.id_tipo_promocion = tp.id_tipo_promocion');
            $this->db->join('servicios s', 's.id_servicio = sp.id_servicio');
            $this->db->where('s.id_empresa', $id);
            $this->db->select('sp.dias_promocion, sp.id_estado, sp.id_servicio, sp.descuento_promocion, tp.tipo_promocion, s.nombre_servicio, sp.fecha_promocion, sp.id_tipo_promocion');
            $servicios = $this->db->get('servicios_promociones sp')->result();

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
                $arrayPromociones[$x]['fecha'] = $p->fecha_promocion;
                $arrayPromociones[$x]['estado'] = $p->id_estado;
                $arrayPromociones[$x]['tipo'] = 1;
                $arrayPromociones[$x]['duracion'] = $p->dias_promocion;
                $x++;
            }

            foreach ($servicios as $s) {
                $arrayPromociones[$x]['id'] = $s->id_servicio;
                if($s->id_tipo_promocion == 1){
                    $arrayPromociones[$x]['promocion'] = '-'.$s->descuento_promocion.' '.$s->tipo_promocion;
                } else {
                    $arrayPromociones[$x]['promocion'] = $s->tipo_promocion;
                }
                $arrayPromociones[$x]['nombre'] = $s->nombre_servicio;
                $arrayPromociones[$x]['fecha'] = $s->fecha_promocion;
                $arrayPromociones[$x]['estado'] = $s->id_estado;
                $arrayPromociones[$x]['tipo'] = 2;
                $arrayPromociones[$x]['duracion'] = $p->dias_promocion;
                $x++;
            }

                return $arrayPromociones;

        }


        public function crear_promocion_producto($data)
        {
            return $this->db->insert('productos_promociones', $data);
        }

        public function editar_promocion_producto($data, $id_producto)
        {
            $this->db->where('id_producto', $id_producto);
            return $this->db->update('productos_promociones', $data);
        }


        public function crear_promocion_servicio($data)
        {
            return $this->db->insert('servicios_promociones', $data);
        }

        public function editar_promocion_servicio($data, $id_servicio)
        {
            $this->db->where('id_servicio', $id_servicio);
            return $this->db->update('servicios_promociones', $data);
        }


        public function listarPorEmpresaSoloID($id, $tipo = 0)
        {
            $this->db->join('tipo_promocion', 'productos_promociones.id_tipo_promocion = tipo_promocion.id_tipo_promocion');
            $this->db->join('productos', 'productos.id_producto = productos_promociones.id_producto');
            $this->db->where('productos.id_empresa', $id);
            $productos = $this->db->get('productos_promociones')->result();

            $this->db->join('tipo_promocion', 'servicios_promociones.id_tipo_promocion = tipo_promocion.id_tipo_promocion');
            $this->db->join('servicios', 'servicios.id_servicio = servicios_promociones.id_servicio');
            $this->db->where('servicios.id_empresa', $id);
            $servicios = $this->db->get('servicios_promociones')->result();

            $arrayPromociones = array();

            $x = 0;
            foreach ($productos as $p) {
                $arrayPromociones[$x]['id'] = $p->id_producto;
                $arrayPromociones[$x]['nombre'] = $p->nombre_producto;
                $arrayPromociones[$x]['href'] = base_url().'microempresarios/producto/3/'.$p->id_sub_sub_categoria.'/'.$id.'/'.$p->id_producto;
                $arrayPromociones[$x]['color'] = $p->color_promocion;
                if($p->id_tipo_promocion == 1){
                    $arrayPromociones[$x]['promocion'] = '-'.$p->descuento_promocion.' '.$p->tipo_promocion;
                } else {
                    $arrayPromociones[$x]['promocion'] = $p->tipo_promocion;
                }

                if($this->functions->ImagenPrincipalProducto($p->id_producto) == ''){
                    $arrayPromociones[$x]['imagen'] = '';
                } else {
                    $arrayPromociones[$x]['imagen'] = PRODUCTOS_EMPRESA_PATH.$this->functions->ImagenPrincipalProducto($p->id_producto);
                }


                $x++;
                if($tipo == 1){
                    if($x == 6){return $arrayPromociones;}
                }

            }

            foreach ($servicios as $s) {
                $arrayPromociones[$x]['id'] = $s->id_servicio;
                $arrayPromociones[$x]['nombre'] = $p->nombre_servicio;
                $arrayPromociones[$x]['href'] = base_url().'microempresarios/servicio/3/'.$s->id_sub_sub_categoria.'/'.$id.'/'.$s->id_servicio;
                $arrayPromociones[$x]['color'] = $s->color_promocion;
                if($s->id_tipo_promocion == 1){
                    $arrayPromociones[$x]['promocion'] = '-'.$s->descuento_promocion.' '.$s->tipo_promocion;
                } else {
                    $arrayPromociones[$x]['promocion'] = $s->tipo_promocion;
                }


                if($this->functions->ImagenPrincipalServicio($s->id_servicio) == ''){
                    $arrayPromociones[$x]['imagen'] = '';
                } else {
                    $arrayPromociones[$x]['imagen'] = SERVICIOS_EMPRESA_PATH.$this->functions->ImagenPrincipalServicio($s->id_servicio);
                }

                $x++;
                if($tipo == 1){
                    if($x == 6){return $arrayPromociones;}
                }
            }

                return $arrayPromociones;

        }



        public function listarPorMuchasEmpresas($ides, $tipo = 0)
        {

            $this->db->join('tipo_promocion', 'productos_promociones.id_tipo_promocion = tipo_promocion.id_tipo_promocion');
            $this->db->join('productos', 'productos.id_producto = productos_promociones.id_producto');
            $this->db->where_in('productos.id_empresa', $ides);
            $productos = $this->db->get('productos_promociones')->result();

            $this->db->join('tipo_promocion', 'servicios_promociones.id_tipo_promocion = tipo_promocion.id_tipo_promocion');
            $this->db->join('servicios', 'servicios.id_servicio = servicios_promociones.id_servicio');
            $this->db->where_in('servicios.id_empresa', $ides);
            $servicios = $this->db->get('servicios_promociones')->result();

            $arrayPromociones = array();

            $x = 0;
            foreach ($productos as $p) {
                $arrayPromociones[$x]['id'] = $p->id_producto;
                $arrayPromociones[$x]['nombre'] = $p->nombre_producto;
                $arrayPromociones[$x]['href'] = base_url().'microempresarios/producto/3/'.$p->id_sub_sub_categoria.'/'.$p->id_empresa.'/'.$p->id_producto;
                $arrayPromociones[$x]['color'] = $p->color_promocion;
                if($p->id_tipo_promocion == 1){
                    $arrayPromociones[$x]['promocion'] = '-'.$p->descuento_promocion.' '.$p->tipo_promocion;
                } else {
                    $arrayPromociones[$x]['promocion'] = $p->tipo_promocion;
                }

                if($this->functions->ImagenPrincipalProducto($p->id_producto) == ''){
                    $arrayPromociones[$x]['imagen'] = '';
                } else {
                    $arrayPromociones[$x]['imagen'] = PRODUCTOS_EMPRESA_PATH.$this->functions->ImagenPrincipalProducto($p->id_producto);
                }


                $x++;
                if($tipo == 1){
                    if($x == 6){return $arrayPromociones;}
                }

            }

            foreach ($servicios as $s) {
                $arrayPromociones[$x]['id'] = $s->id_servicio;
                $arrayPromociones[$x]['nombre'] = $s->nombre_servicio;
                $arrayPromociones[$x]['href'] = base_url().'microempresarios/servicio/3/'.$s->id_sub_sub_categoria.'/'.$s->id_empresa.'/'.$s->id_servicio;
                $arrayPromociones[$x]['color'] = $s->color_promocion;
                if($s->id_tipo_promocion == 1){
                    $arrayPromociones[$x]['promocion'] = '-'.$s->descuento_promocion.' '.$s->tipo_promocion;
                } else {
                    $arrayPromociones[$x]['promocion'] = $s->tipo_promocion;
                }


                if($this->functions->ImagenPrincipalServicio($s->id_producto) == ''){
                    $arrayPromociones[$x]['imagen'] = '';
                } else {
                    $arrayPromociones[$x]['imagen'] = SERVICIOS_EMPRESA_PATH.$this->functions->ImagenPrincipalServicio($s->id_producto);
                }

                $x++;
                if($tipo == 1){
                    if($x == 6){return $arrayPromociones;}
                }
            }

                return $arrayPromociones;

        }








}