<?php

class LoginModel extends CI_Model {


        public $table = 'usuarios';

        public function __construct()
        {
                parent::__construct();
        }

        public function validarAcceso($email, $password)
        {
            $this->db->where('password_usuario', $password);
            $this->db->where('email_usuario', $email);
            $query = $this->db->get($this->table);
            return $query->result();
        }


}