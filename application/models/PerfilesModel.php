<?php

class PerfilesModel extends CI_Model {




        public $table = 'perfiles';

        public function __construct()
        {
                parent::__construct();
        }

        public function listar()
        {
            $query = $this->db->get($this->table);
            return $query->result();
        }

        public function editar($id_perfil)
        {
            $this->db->where('id_perfil', $id_perfil);
            $query = $this->db->get($this->table);
            return $query->result();
        }

        public function insertar($data)
        {
            return $this->db->insert($this->table, $data);
        }




}