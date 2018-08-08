<?php

class RseModel extends CI_Model {

        public $rse_db;
        public $chat_db;

        public function __construct()
        {
            parent::__construct();
            $this->rse_db = $this->load->database('rse', TRUE);
            $this->chat_db = $this->load->database('chat', TRUE);
        }


        public function listarEmpresaRSE()
        {
            $this->rse_db->join('sectores s', 'e.id_sector = s.id_sector');
            $this->rse_db->join('tipo_empresa t', 'e.id_tipo_empresa = t.id_tipo_empresa');
            $this->rse_db->join('estados es', 'e.id_estado = es.id_estado');
            $query = $this->rse_db->get('empresas e');
            return $query->result();
        }


        public function obtenerEmpresaRSE($id_empresa)
        {
            $this->rse_db->join('sectores s', 'e.id_sector = s.id_sector');
            $this->rse_db->join('tipo_empresa t', 'e.id_tipo_empresa = t.id_tipo_empresa');
            $this->rse_db->join('estados es', 'e.id_estado = es.id_estado');
            $this->rse_db->where('e.id_empresa', $id_empresa);
            $query = $this->rse_db->get('empresas e');
            return $query->row();
        }

        public function usuariosRSE($id_empresa)
        {
            $this->rse_db->where('p.id_pais', $this->functions->id_pais($this->functions->texto_general(7)));
            $this->rse_db->where('u.id_empresa', $id_empresa);
            $this->rse_db->join('pais_usuario p', 'p.id_usuario = u.id_usuario');
            $query = $this->rse_db->get('usuarios u');
            return $query->result();
        }

        public function sucursalesRSE($id_empresa)
        {
            $this->rse_db->where('id_pais', $this->functions->id_pais($this->functions->texto_general(7)));
            $this->rse_db->where('id_empresa', $id_empresa);
            $query = $this->rse_db->get('sucursales');
            return $query->result();
        }


        public function chat($id_rse, $id_microempresa)
        {
            $this->chat_db->order_by('id', 'asc');
            $this->chat_db->where('id_rse', $id_rse);
            $this->chat_db->where('id_microempresario', $id_microempresa);
            $query = $this->chat_db->get('chat');
            return $query->result();
        }

        public function chat_dos($id_rse, $id_microempresa)
        {
            $this->chat_db->order_by('id', 'asc');
            $this->chat_db->where('leido_portal', 0);
            $this->chat_db->where('id_rse', $id_rse);
            $this->chat_db->where('id_microempresario', $id_microempresa);
            $query = $this->chat_db->get('chat');
            return $query->result();
        }


        public function leido($data, $id)
        {
            $this->chat_db->where('id', $id);
            return $this->chat_db->update('chat', $data);
        }

        public function insertar_chat($data)
        {
            return $this->chat_db->insert('chat', $data);
        }


        public function insertarConvenio($data)
        {
            return $this->rse_db->insert('convenios_rse', $data);
        }


        public function obtenerConvenio($id)
        {
            $this->rse_db->where('c.id_convenio', $id);
            $this->rse_db->join('empresas e', 'c.id_rse = e.id_empresa');
            $this->rse_db->join('sectores s', 'e.id_sector = s.id_sector');
            $this->rse_db->join('tipo_empresa t', 'e.id_tipo_empresa = t.id_tipo_empresa');
            $query = $this->rse_db->get('convenios_rse c');
            return $query->row();
        }


        public function listado_completo($final, $inicio, $tipo = 0, $orden, $region, $comuna)
        {
            if($tipo == 0){
                $this->rse_db->limit($final, $inicio);
            }

            if($orden == 1){
                $this->rse_db->order_by('e.cantidad_usuarios', 'desc');
            } elseif ($orden == 2) {
                $this->rse_db->order_by('e.cantidad_alianzas', 'desc');
            } elseif ($orden == 3) {
                $this->rse_db->order_by('e.cantidad_cotizaciones', 'desc');
            }

            if($region !== null ){
                if($region != ''){
                    $this->rse_db->where('u.region_usuario', $region);
                }    
            }
            
            if($comuna !== null){
                if($comuna != ''){
                    $this->rse_db->where('u.comuna_usuario', $comuna);
                }    
            }
            

            $this->rse_db->group_by('e.id_empresa');
            $this->rse_db->where('pe.id_pais', $this->functions->id_pais($this->functions->texto_general(7)));
            $this->rse_db->join('usuarios u', 'u.id_empresa = e.id_empresa');
            $this->rse_db->join('pais_empresa pe', 'pe.id_empresa = e.id_empresa');
            $this->rse_db->join('sectores s', 'e.id_sector = s.id_sector');
            $this->rse_db->join('tipo_empresa t', 'e.id_tipo_empresa = t.id_tipo_empresa');
            $this->rse_db->join('estados es', 'e.id_estado = es.id_estado');
            $query = $this->rse_db->get('empresas e');
            return $query->result();
        }

        public function obtenerRequerimiento($id)
        {
            $this->rse_db->where('r.id_requerimiento', $id);
            $this->rse_db->join('estados e', 'r.id_estado = e.id_estado');
            $this->rse_db->join('usuarios u', 'r.id_usuario = u.id_usuario');
            $this->rse_db->join('sucursales s', 's.id_sucursal = r.id_sucursal');
            $this->rse_db->select('r.id_requerimiento, r.id_empresa, r.titulo_requerimiento, r.id_categoria, r.fecha_requerimiento, r.id_estado, u.nombre_usuario, u.id_usuario, e.estado, r.desde_requerimiento, r.hasta_requerimiento, r.descripcion_requerimiento, s.nombre_sucursal, s.direccion_sucursal, s.fono_sucursal, u.email_usuario');
            $query = $this->rse_db->get('requerimientos r');
            return $query->row();
        }


        public function insertarOferta($data)
        {
            return $this->rse_db->insert('ofertas', $data);
        }


        public function alianzas()
        {

            $id_empresas = [];
            $this->db->where('id_cliente', $this->session->id);
            $empresas = $this->db->get('empresas')->result();

            foreach ($empresas as $key => $value) {
                array_push($id_empresas, $value->id_empresa);
            }

            $this->rse_db->where('id_pais', $this->functions->id_pais($this->functions->texto_general(7)));
            $this->rse_db->where_in('id_empresa', $id_empresas);
            $this->rse_db->where('tipo_solicitud', 0);
            $query = $this->rse_db->get('convenios_rse');
            return $query->result();
        }

        public function ingresar_pregunta($data)
        {
            return $this->rse_db->insert('preguntas_convenio', $data);
        }


        public function editar_convenio($data, $id)
        {
            $this->rse_db->where('id_convenio', $id);
            return $this->rse_db->update('convenios_rse', $data);
        }


        public function alianzas_desde_rse()
        {

            $id_empresas = [];
            $this->db->where('id_cliente', $this->session->id);
            $empresas = $this->db->get('empresas')->result();

            foreach ($empresas as $key => $value) {
                array_push($id_empresas, $value->id_empresa);
            }

            $this->rse_db->where('id_pais', $this->functions->id_pais($this->functions->texto_general(7)));
            $this->rse_db->where_in('id_empresa', $id_empresas);
            $this->rse_db->where('tipo_solicitud', 1);
            $query = $this->rse_db->get('convenios_rse');
            return $query->result();
        }


}