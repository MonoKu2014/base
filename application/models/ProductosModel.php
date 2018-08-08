<?php

class ProductosModel extends CI_Model {




        public $table = 'productos';

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


        public function listarPorEmpresa($id_empresa)
        {
            $this->db->limit(6);
            $this->db->where($this->table.'.id_empresa', $id_empresa);
            $this->db->join('estados e', $this->table.'.id_estado = e.id_estado', 'left');
            $this->db->join('productos_vistas pv', $this->table.'.id_producto = pv.id_producto', 'left');
            $this->db->join('productos_promociones pp', $this->table.'.id_producto = pp.id_producto', 'left');
            $this->db->join('tipo_promocion tp', 'tp.id_tipo_promocion = pp.id_tipo_promocion', 'left');
            $this->db->distinct();
            $this->db->select('pp.dias_promocion, productos.id_producto, productos.nombre_producto, productos.id_empresa, e.estado, e.id_estado, pv.cantidad_vistas');
            $this->db->select('pp.id_tipo_promocion, pp.descuento_promocion, pp.color_promocion, pp.fecha_promocion, productos.precio_producto, tp.tipo_promocion, pp.id_promocion');
            $query = $this->db->get($this->table);
            return $query->result();
        }


        public function obtener($id_producto)
        {
            $this->db->join('estados', $this->table.'.id_estado = estados.id_estado');
            $this->db->where('id_producto', $id_producto);
            $query = $this->db->get($this->table);
            return $query->result();
        }

        public function insertar($data)
        {
            return $this->db->insert($this->table, $data);
        }

        public function insertarImagen($data)
        {
            return $this->db->insert('productos_imagenes', $data);
        }

        public function insertarVistas($data)
        {
            return $this->db->insert('productos_vistas', $data);
        }

        public function editar($data, $id_producto)
        {
            $this->db->where('id_producto', $id_producto);
            return $this->db->update($this->table, $data);
        }

        public function eliminar($id_producto)
        {
            $this->db->where('id_producto', $id_producto);
            return $this->db->delete($this->table);
        }


        public function listarMasBuscados($no_limit = 0)
        {
            $this->db->join('estados e', $this->table.'.id_estado = e.id_estado');
            $this->db->join('productos_vistas pv', $this->table.'.id_producto = pv.id_producto');
            $this->db->order_by('cantidad_vistas', 'desc');
            $this->db->order_by('nombre_producto', 'desc');
            if($no_limit == 0){ $this->db->limit(6); }
            $query = $this->db->get($this->table);
            return $query->result();
        }


        //EN EL DETALLE DE PRODUCTO NECESITO MOSTRAR MÁS PRODUCTOS Y QUITAR EL QUE SE DETALLA
        public function listarPorEmpresaExceptoProducto($id_empresa, $id_producto)
        {
            $this->db->limit(6);
            $this->db->where($this->table.'.id_producto !=', $id_producto);
            $this->db->where($this->table.'.id_empresa', $id_empresa);
            $this->db->join('estados e', $this->table.'.id_estado = e.id_estado', 'left');
            $this->db->join('productos_vistas pv', $this->table.'.id_producto = pv.id_producto', 'left');
            $this->db->join('productos_promociones pp', $this->table.'.id_producto = pp.id_producto', 'left');
            $this->db->join('tipo_promocion tp', 'tp.id_tipo_promocion = pp.id_tipo_promocion', 'left');
            $this->db->select('productos.id_producto, productos.nombre_producto, productos.id_empresa, e.estado, e.id_estado, pv.cantidad_vistas');
            $this->db->select('pp.id_tipo_promocion, pp.descuento_promocion, pp.color_promocion, pp.fecha_promocion, productos.precio_producto, tp.tipo_promocion');
            $query = $this->db->get($this->table);
            return $query->result();
        }


        //PARA MOSTRAR LAS IMÁGENES PRINCIPALES EN EL CARRUSEL
        public function listarPorEmpresaPrincipales($id_empresa)
        {
            $this->db->where($this->table.'.id_empresa', $id_empresa);
            $this->db->select($this->table.'.id_producto');
            $this->db->limit(8);
            $query = $this->db->get($this->table);
            return $query->result();
        }


        public function listarTodosPorEmpresa($id_empresa, $public = 0)
        {
            if($public == 1){
                $this->db->where($this->table.'.id_estado', 1);
            }
            $this->db->where($this->table.'.id_empresa', $id_empresa);
            $this->db->join('estados e', $this->table.'.id_estado = e.id_estado', 'left');
            $this->db->join('productos_vistas pv', $this->table.'.id_producto = pv.id_producto', 'left');
            $this->db->join('productos_promociones pp', $this->table.'.id_producto = pp.id_producto', 'left');
            $this->db->join('tipo_promocion tp', 'tp.id_tipo_promocion = pp.id_tipo_promocion', 'left');
            $this->db->distinct();
            $this->db->select('productos.id_producto, productos.nombre_producto, productos.id_empresa, e.estado, e.id_estado, pv.cantidad_vistas, productos.id_sub_sub_categoria');
            $this->db->select('pp.id_tipo_promocion, pp.descuento_promocion, pp.color_promocion, pp.fecha_promocion, productos.precio_producto, tp.tipo_promocion');
            $query = $this->db->get($this->table);
            return $query->result();
        }


        public function eliminarImagen($id)
        {
            $this->db->where('id_producto_imagen', $id);
            return $this->db->delete('productos_imagenes');
        }




}