<?php

class PagosModel extends CI_Model {



        public $table = 'medios_pago';

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
            $this->db->join('pagos_empresa', $this->table.'.id_medio_pago = pagos_empresa.id_medio_pago');
            $this->db->join('estados', $this->table.'.id_estado = estados.id_estado');
            $this->db->where('pagos_empresa.id_empresa', $id_empresa);
            $query = $this->db->get($this->table);
            return $query->result();
        }


        public function obtener($id_pago)
        {
            $this->db->join('estados', $this->table.'.id_estado = estados.id_estado');
            $this->db->where('id_medio_pago', $id_pago);
            $query = $this->db->get($this->table);
            return $query->result();
        }

        public function insertar($data)
        {
            return $this->db->insert($this->table, $data);
        }

        public function editar($data, $id_pago)
        {
            $this->db->where('id_medio_pago', $id_pago);
            return $this->db->update($this->table, $data);
        }

        public function eliminar($id_pago)
        {
            $this->db->where('id_medio_pago', $id_pago);
            return $this->db->delete($this->table);
        }




}