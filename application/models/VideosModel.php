<?php

class VideosModel extends CI_Model {



        public $table = 'videos_empresa';

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
            $query = $this->db->get($this->table);
            return $query->result();
        }


        public function obtener($id_video)
        {
            $this->db->where('id_video_empresa', $id_video);
            $query = $this->db->get($this->table);
            return $query->result();
        }

        public function insertar($data)
        {
            return $this->db->insert($this->table, $data);
        }

        public function editar($data, $id_video)
        {
            $this->db->where('id_video_empresa', $id_video);
            return $this->db->update($this->table, $data);
        }

        public function eliminar($id_video)
        {
            $this->db->where('id_video_empresa', $id_video);
            return $this->db->delete($this->table);
        }

        //EN EL DETALLE DE MICROEMPRESARIO MUESTRA LOS ÚLTIMOS DOS VÍDEOS
        public function listarPorEmpresaSoloDos($id_empresa)
        {
            $this->db->where('id_empresa', $id_empresa);
            $this->db->order_by('id_video_empresa', 'desc');
            $this->db->limit(2);
            $query = $this->db->get($this->table);
            return $query->result();
        }




}