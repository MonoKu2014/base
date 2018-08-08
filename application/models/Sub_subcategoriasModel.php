<?php

class Sub_subcategoriasModel extends CI_Model {



        public $table = 'sub_subcategorias';

        public function __construct()
        {
                parent::__construct();
        }

        public function listar()
        {
            $this->db->join('subcategorias', $this->table.'.id_subcategoria = subcategorias.id_subcategoria');
            $this->db->join('estados', $this->table.'.id_estado = estados.id_estado');
            $query = $this->db->get($this->table);
            return $query->result();
        }

        public function obtener($id_sub_subcategoria)
        {
            $this->db->join('subcategorias', $this->table.'.id_subcategoria = subcategorias.id_subcategoria');
            $this->db->join('estados', $this->table.'.id_estado = estados.id_estado');
            $this->db->where('id_sub_subcategoria', $id_sub_subcategoria);
            $query = $this->db->get($this->table);
            return $query->result();
        }

        public function insertar($data)
        {
            return $this->db->insert($this->table, $data);
        }

        public function editar($data, $id_sub_subcategoria)
        {
            $this->db->where('id_sub_subcategoria', $id_sub_subcategoria);
            return $this->db->update($this->table, $data);
        }

        public function eliminar($id_sub_subcategoria)
        {
            $this->db->where('id_sub_subcategoria', $id_sub_subcategoria);
            return $this->db->delete($this->table);
        }


        public function listarDestacadas()
        {
            $this->db->order_by('nombre_sub_subcategoria', 'asc');
            $this->db->where('id_estado', 1);
            $this->db->where('sub_subcategoria_destacada', 1);
            $query = $this->db->get($this->table);
            return $query->result();
        }


        public function listarPorEmpresa($id_empresa)
        {
            $this->db->join('sub_subcategorias', 'empresa_sub_subcategorias.id_sub_subcategoria = sub_subcategorias.id_sub_subcategoria');
            $this->db->where('empresa_sub_subcategorias.id_empresa', $id_empresa);
            $query = $this->db->get('empresa_sub_subcategorias');
            return $query->result();
        }


        public function sub_subcategoriasPorSubcategoria($id)
        {
            $this->db->where_in('id_subcategoria', $id);
            $this->db->order_by('nombre_sub_subcategoria', 'asc');
            return $query = $this->db->get('sub_subcategorias')->result();   
        }




}