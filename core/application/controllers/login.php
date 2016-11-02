<?php

header("Cache-Control: no-cache, no-store, must-revalidate, post-check=0, pre-check=0");
header("Pragma: no-cache");
header('Access-Control-Allow-Origin: *');

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    function index() {
        
    }

    
       
    public function aaaa(){
      
                
                
                echo "---->";
         
    }
    
    public function login_user() {

        $this->load->library('../controllers/inLife_Services/user_services');


        $email = $this->input->post('email');
        $pass = $this->input->post('pass');
        $data_user_login = $this->user_services->login_user($email, $pass);

 
        echo json_encode($data_user_login);
 
    }

}
