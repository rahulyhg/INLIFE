<?php

header("Cache-Control: no-cache, no-store, must-revalidate, post-check=0, pre-check=0");
header("Pragma: no-cache");
header('Access-Control-Allow-Origin: *');

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Register extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    function index() {
        
    }

    public function change_password() {
        $this->load->library('../controllers/inLife_Services/user_services');
        $change_new_pass = $this->input->post('change_new_pass');
        $id_usuario = $this->input->post('id_usuario');


        $data_user_array = $this->user_services->change_password($id_usuario, $change_new_pass);

        echo $data_user_array;
    }

    public function register_user_n_event() {

        $this->load->library('../controllers/inLife_Services/user_services');


        $id_vital_experience = $this->input->post('id_vital_experience');
        $data_user = $this->input->post('data_user');
        $event = $this->input->post('event');
        $data_user_array = $this->user_services->register($data_user, $event);
        $this->user_services->register_n_event($id_vital_experience, $data_user_array["id"]);


        if ($data_user_array != 0) {
            $register_status = $this->user_services->send_register_email($data_user_array["id"], $data_user_array["token"], $data_user["mail"]);
            echo $register_status;
        } else {
            echo 0;
        }
    }

    public function register_user() {

        $this->load->library('../controllers/inLife_Services/user_services');


        $data_user = $this->input->post('data_user');
        $event = $this->input->post('event');
        $data_user_array = $this->user_services->register($data_user, $event);

        if ($data_user_array != 0) {
            $register_status = $this->user_services->send_register_email($data_user_array["id"], $data_user_array["token"], $data_user["mail"]);
            echo $register_status;
        } else {
            echo 0;
        }
    }

    public function activate_acount() {

        $this->load->library('../controllers/inLife_Services/user_services');

        $id = $this->input->post('id');
        $token = $this->input->post('token');
        $event= $this->input->post('event');


        $data_user_array = $this->user_services->activate_acount($id, $token,$event);

        echo $data_user_array;
    }

    public function activate_login_user() {

        $this->load->library('../controllers/inLife_Services/user_services');

        $email = $this->input->post('email');
        $pass = $this->input->post('pass');
        $event = $this->input->post('event');

        $data_user_array = $this->user_services->activate_login_acount($email, $pass, $event);

        echo json_encode($data_user_array);
    }

    public function activate_login_user_event() {

        $this->load->library('../controllers/inLife_Services/user_services');

        $email = $this->input->post('email');
        $pass = $this->input->post('pass');
        $event = $this->input->post('event');

        $data_user_array = $this->user_services->activate_login_acount_event($email, $pass, $event);

        echo $data_user_array;
    }

}
