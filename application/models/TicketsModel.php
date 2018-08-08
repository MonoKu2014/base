<?php

class TicketsModel extends CI_Model {




        public $table = 'tickets';

        public function __construct()
        {
                parent::__construct();
        }

        public function listar()
        {
            $query = $this->db->get($this->table);
            return $query->result();
        }

        public function listar_por_cliente($id_cliente)
        {
            $this->db->where('id_cliente', $id_cliente);
            $query = $this->db->get($this->table);
            return $query->result();
        }

        public function obtener($id_ticket)
        {
            $this->db->where('id_ticket', $id_ticket);
            $query = $this->db->get($this->table);
            return $query->result();
        }

        public function insertar($data)
        {
            return $this->db->insert($this->table, $data);
        }

        public function editar($data, $id_ticket)
        {
            $this->db->where('id_ticket', $id_ticket);
            return $this->db->update($this->table, $data);
        }

        public function eliminar($id_ticket)
        {
            $this->db->where('id_ticket', $id_ticket);
            return $this->db->delete($this->table);
        }


}