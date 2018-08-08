<?php

class CategoriasModel extends CI_Model {




        public $table = 'categorias';

        public function __construct()
        {
                parent::__construct();
        }

        public function listar()
        {
            $this->db->order_by('nombre_categoria', 'asc');
            $this->db->join('estados', $this->table.'.id_estado = estados.id_estado');
            $query = $this->db->get($this->table);
            return $query->result();
        }

        public function obtener($id_categoria)
        {
            $this->db->join('estados', $this->table.'.id_estado = estados.id_estado');
            $this->db->where('id_categoria', $id_categoria);
            $query = $this->db->get($this->table);
            return $query->result();
        }

        public function insertar($data)
        {
            return $this->db->insert($this->table, $data);
        }

        public function editar($data, $id_categoria)
        {
            $this->db->where('id_categoria', $id_categoria);
            return $this->db->update($this->table, $data);
        }

        public function eliminar($id_categoria)
        {
            $this->db->where('id_categoria', $id_categoria);
            return $this->db->delete($this->table);
        }


        public function listarDestacadas($flag = 0)
        {
            $this->db->where('id_estado', 1);
            if($flag == 0){
                $this->db->where('categoria_destacada', 1);    
            }            
            $query = $this->db->get($this->table);
            return $query->result();
        }




}