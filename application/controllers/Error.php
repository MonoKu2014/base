<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error extends CI_Controller {


    function __construct()
    {

        parent::__construct();
    
    }


    public function error_400()
    {
		$this->load->view('frontend/includes/header');
		$this->load->view('frontend/404');
		$this->load->view('frontend/includes/footer');
    }


    public function error_500()
    {
 		$this->load->view('frontend/includes/header');
		$this->load->view('frontend/500');
		$this->load->view('frontend/includes/footer');   	
    }


}