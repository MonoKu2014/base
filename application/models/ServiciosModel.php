<?php

class ServiciosModel extends CI_Model {




        public $table = 'servicios';

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
            $this->db->join('servicios_vistas pv', $this->table.'.id_servicio = pv.id_servicio', 'left');
            $this->db->join('servicios_promociones pp', $this->table.'.id_servicio = pp.id_servicio', 'left');
            $this->db->join('tipo_promocion tp', 'tp.id_tipo_promocion = pp.id_tipo_promocion', 'left');
            $this->db->distinct();
            $this->db->select('pp.dias_promocion, servicios.id_servicio, servicios.nombre_servicio, servicios.id_empresa, e.estado, e.id_estado, pv.cantidad_vistas');
            $this->db->select('pp.id_tipo_promocion, pp.descuento_promocion, pp.color_promocion, pp.fecha_promocion, servicios.precio_servicio, tp.tipo_promocion, pp.id_promocion');
            $query = $this->db->get($this->table);
            return $query->result();
        }


        public function obtener($id_servicio)
        {
            $this->db->join('estados', $this->table.'.id_estado = estados.id_estado');
            $this->db->where('id_servicio', $id_servicio);
            $query = $this->db->get($this->table);
            return $query->result();
        }

        public function insertar($data)
        {
            return $this->db->insert($this->table, $data);
        }

        public function insertarImagen($data)
        {
            return $this->db->insert('servicios_imagenes', $data);
        }

        public function insertarVistas($data)
        {
            return $this->db->insert('servicios_vistas', $data);
        }

        public function editar($data, $id_servicio)
        {
            $this->db->where('id_servicio', $id_servicio);
            return $this->db->update($this->table, $data);
        }

        public function eliminar($id_servicio)
        {
            $this->db->where('id_servicio', $id_servicio);
            return $this->db->delete($this->table);
        }


        public function listarMasBuscados($no_limit = 0)
        {
            $this->db->join('estados e', $this->table.'.id_estado = e.id_estado', 'left');
            $this->db->join('servicios_vistas sv', $this->table.'.id_servicio = sv.id_servicio', 'left');
            $this->db->order_by('cantidad_vistas', 'desc');
            $this->db->order_by('nombre_servicio', 'desc');
            if($no_limit == 0){ $this->db->limit(6); }
            $query = $this->db->get($this->table);
            return $query->result();
        }


        //EN EL DETALLE DE SERVICIO NECESITO MOSTRAR MÁS SERVICIOS Y QUITAR EL QUE SE DETALLA
        public function listarPorEmpresaExceptoServicio($id_empresa, $id_servicio)
        {
            $this->db->limit(6);
            $this->db->where($this->table.'.id_servicio !=', $id_servicio);
            $this->db->where($this->table.'.id_empresa', $id_empresa);
            $this->db->join('estados e', $this->table.'.id_estado = e.id_estado', 'left');
            $this->db->join('servicios_vistas pv', $this->table.'.id_servicio = pv.id_servicio', 'left');
            $this->db->join('servicios_promociones pp', $this->table.'.id_servicio = pp.id_servicio', 'left');
            $this->db->join('tipo_promocion tp', 'tp.id_tipo_promocion = pp.id_tipo_promocion', 'left');
            $this->db->select('servicios.id_servicio, servicios.nombre_servicio, servicios.id_empresa, e.estado, e.id_estado, pv.cantidad_vistas');
            $this->db->select('pp.id_tipo_promocion, pp.descuento_promocion, pp.color_promocion, pp.fecha_promocion, servicios.precio_servicio, tp.tipo_promocion');
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
            $this->db->join('servicios_vistas pv', $this->table.'.id_servicio = pv.id_servicio', 'left');
            $this->db->join('servicios_promociones pp', $this->table.'.id_servicio = pp.id_servicio', 'left');
            $this->db->join('tipo_promocion tp', 'tp.id_tipo_promocion = pp.id_tipo_promocion', 'left');
            $this->db->distinct();
            $this->db->select('servicios.id_servicio, servicios.nombre_servicio, servicios.id_empresa, e.estado, e.id_estado, pv.cantidad_vistas, servicios.id_sub_sub_categoria');
            $this->db->select('pp.id_tipo_promocion, pp.descuento_promocion, pp.color_promocion, pp.fecha_promocion, servicios.precio_servicio, tp.tipo_promocion');
            $query = $this->db->get($this->table);
            return $query->result();
        }


}