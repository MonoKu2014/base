<?php

class HorariosModel extends CI_Model {




        public $table = 'empresa_horarios';

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
            $this->db->where('id_empresa', $id_empresa); 
            $this->db->join('estados', $this->table.'.id_estado = estados.id_estado');
            $query = $this->db->get($this->table);
            return $query->result();
        }


        public function obtener($id_empresa_horario)
        {
            $this->db->join('estados', $this->table.'.id_estado = estados.id_estado');
            $this->db->where('id_empresa_horario', $id_empresa_horario);
            $query = $this->db->get($this->table);
            return $query->result();
        }

        public function insertar($data)
        {
            return $this->db->insert($this->table, $data);
        }

        public function editar($data, $id_empresa_horario)
        {
            $this->db->where('id_empresa_horario', $id_empresa_horario);
            return $this->db->update($this->table, $data);
        }

        public function eliminar($id_empresa_horario)
        {
            $this->db->where('id_empresa_horario', $id_empresa_horario);
            return $this->db->delete($this->table);
        }




}