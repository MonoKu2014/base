<?php

class AccesoModel extends CI_Model {


        public function __construct()
        {
                parent::__construct();
        }

        public function validarAcceso($email, $password)
        {
            $this->db->where('password_usuario', $password);
            $this->db->where('email_usuario', $email);
            $query = $this->db->get('usuarios');
            return $query->result();
        }


}