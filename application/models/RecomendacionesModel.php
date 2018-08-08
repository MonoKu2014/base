<?php

class RecomendacionesModel extends CI_Model {



        public $table = 'recomendaciones';

        public function __construct()
        {
                parent::__construct();
        }

        public function insertar($data)
        {
            return $this->db->insert($this->table, $data);
        }


        public function listarPorEmpresa($id_empresa)
        {
        	$this->db->where('id_empresa', $id_empresa);
        	$this->db->join('clientes', 'recomendaciones.id_cliente = clientes.id_cliente');
        	$this->db->select('clientes.nombre_cliente, clientes.id_cliente');
        	$query = $this->db->get('recomendaciones');
        	return $query->result();
        }


        public function listarPorPersona($id, $ordenar = 0)
        {
            if($ordenar == 1){
                $this->db->order_by('e.cantidad_recomendaciones', 'desc');
            }

            if($ordenar == 2){
                $this->db->order_by('e.cantidad_productos', 'desc');
            }

            if($ordenar == 3){
                $this->db->order_by('e.cantidad_servicios', 'desc');
            }

            if($ordenar == 4){
                $this->db->order_by('e.cantidad_promociones', 'desc');
            }
            $this->db->where('r.id_cliente', $id);
            $this->db->join('empresas e', 'r.id_empresa = e.id_empresa');
            $query = $this->db->get('recomendaciones r');
            return $query->result();            
        }



        public function listarPorPersonaSoloID($id)
        {

            $this->db->where('r.id_cliente', $id);
            $this->db->select('r.id_empresa');
            $query = $this->db->get('recomendaciones r');
            return $query->result();            
        }



        public function eliminar($id_empresa)
        {
            $this->db->where('id_cliente', $this->session->id);
            $this->db->where('id_empresa', $id_empresa);
            return $this->db->delete($this->table);
        }



        public function clienteSigueEmpresas($id_cliente)
        {

            $this->db->where('s.id_cliente', $id_cliente);
            $this->db->join('empresas e', 's.id_empresa = e.id_empresa');
            return $this->db->get('seguir_empresa s')->result();

        }



        public function clienteSiguePersonas($id_cliente)
        {

            $this->db->where('s.id_seguidor', $id_cliente);
            $this->db->join('clientes e', 's.id_cliente = e.id_cliente');
            return $this->db->get('seguir_persona s')->result();            
        
        }




}