<?php

class EmpresacomentariosModel extends CI_Model {




        public $table = 'empresa_comentarios';

        public function __construct()
        {
                parent::__construct();
        }


        public function listarPorEmpresa($id_empresa)
        {
            $this->db->where('id_empresa', $id_empresa);
            $this->db->order_by('id_comentario', 'desc');
            $query = $this->db->get($this->table);
            return $query->result();
        }

        public function insertar($data)
        {
            return $this->db->insert($this->table, $data);
        }



}