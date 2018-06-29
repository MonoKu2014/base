<?php

class Usuarios_Model extends CI_Model {


    public function __construct()
    {
        parent::__construct();
    }

    public function obtener_usuarios()
    {
        $this->db->where('u.perfil_fk', 1);
        $this->db->join('estados e', 'e.id_estado = u.estado_fk');
        $this->db->join('perfiles p', 'p.id_perfil = u.perfil_fk');
        $query = $this->db->get('usuarios u');
        return $query->result();
    }


    public function obtener_usuario($id)
    {
        $this->db->where('u.id_usuario', $id);
        $this->db->join('estados e', 'e.id_estado = u.estado_fk');
        $this->db->join('perfiles p', 'p.id_perfil = u.perfil_fk');
        $query = $this->db->get('usuarios u');
        return $query->row();
    }

    public function insertar($data)
    {
        return $this->db->insert('usuarios', $data);
    }


    public function obtener_perfiles()
    {
        $this->db->where('id_perfil', 1);
        $query = $this->db->get('perfiles');
        return $query->result();
    }


    public function obtener_estados()
    {
        $query = $this->db->get('estados');
        return $query->result();
    }


    public function eliminar($id)
    {
        $this->db->where('id_usuario', $id);
        return $this->db->delete('usuarios');
    }


    public function editar($data, $id)
    {
        $this->db->where('id_usuario', $id);
        return $this->db->update('usuarios', $data);
    }

}