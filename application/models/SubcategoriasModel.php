<?php

class SubcategoriasModel extends CI_Model {




        public $table = 'subcategorias';

        public function __construct()
        {
                parent::__construct();
        }

        public function listar()
        {
            $this->db->join('categorias', $this->table.'.id_categoria = categorias.id_categoria');
            $this->db->join('estados', $this->table.'.id_estado = estados.id_estado');
            $query = $this->db->get($this->table);
            return $query->result();
        }

        public function obtener($id_subcategoria)
        {
            $this->db->join('categorias', $this->table.'.id_categoria = categorias.id_categoria');
            $this->db->join('estados', $this->table.'.id_estado = estados.id_estado');
            $this->db->where('id_subcategoria', $id_subcategoria);
            $query = $this->db->get($this->table);
            return $query->result();
        }

        public function insertar($data)
        {
            return $this->db->insert($this->table, $data);
        }

        public function editar($data, $id_subcategoria)
        {
            $this->db->where('id_subcategoria', $id_subcategoria);
            return $this->db->update($this->table, $data);
        }

        public function eliminar($id_subcategoria)
        {
            $this->db->where('id_subcategoria', $id_subcategoria);
            return $this->db->delete($this->table);
        }


        public function listarDestacadas()
        {
            $this->db->where('id_estado', 1);
            $this->db->where('subcategoria_destacada', 1);
            $query = $this->db->get($this->table);
            return $query->result();
        }


        public function listarDestacadasColumnaUno()
        {
            $this->db->where('id_estado', 1);
            $this->db->where('subcategoria_destacada', 1);
            $this->db->order_by('nombre_subcategoria', 'ASC');
            $this->db->limit(9, 0);
            $query = $this->db->get($this->table);
            return $query->result();
        }


        public function listarDestacadasColumnaDos()
        {
            $this->db->where('id_estado', 1);
            $this->db->where('subcategoria_destacada', 1);
            $this->db->order_by('nombre_subcategoria', 'ASC');
            $this->db->limit(9, 9);
            $query = $this->db->get($this->table);
            return $query->result();
        }

        public function listarPorCategoria($id_categoria)
        {
            $this->db->where('id_categoria', $id_categoria);
            $query = $this->db->get($this->table);
            return $query->result();
        }



}