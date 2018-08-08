<?php

class UsuariosModel extends CI_Model {




        public $table = 'usuarios';

        public function __construct()
        {
                parent::__construct();
        }

        public function listar()
        {
            $this->db->join('estados', $this->table.'.id_estado = estados.id_estado');
            $this->db->join('perfiles', $this->table.'.id_perfil = perfiles.id_perfil');
            $query = $this->db->get($this->table);
            return $query->result();
        }

        public function obtener($id_usuario)
        {
            $this->db->join('estados', $this->table.'.id_estado = estados.id_estado');
            $this->db->join('perfiles', $this->table.'.id_perfil = perfiles.id_perfil');
            $this->db->where('id_usuario', $id_usuario);
            $query = $this->db->get($this->table);
            return $query->result();
        }

        public function insertar($data)
        {
            return $this->db->insert($this->table, $data);
        }

        public function editar($data, $id_usuario)
        {
            $this->db->where('id_usuario', $id_usuario);
            return $this->db->update($this->table, $data);
        }

        public function eliminar($id_usuario)
        {
            $this->db->where('id_usuario', $id_usuario);
            return $this->db->delete($this->table);
        }




}