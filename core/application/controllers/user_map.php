<?php

header("Cache-Control: no-cache, no-store, must-revalidate, post-check=0, pre-check=0");
header("Pragma: no-cache");
header('Access-Control-Allow-Origin: *');

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_map extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    function index() {
        
    }

    public function get_ephe_data_by_user_id($id_usuario) {
        $this->load->library('../controllers/inLife_Services/user_services');
        $user_data_sweph = $this->user_services->get_ephe_data_by_user_id($id_usuario);
        echo json_encode($user_data_sweph);
    }

    public function get_primary_challenge_by_user_id($id_usuario) {
        $this->load->library('../controllers/inLife_Services/user_services');
        $arrayReturn = $this->user_services->get_primary_challenge_by_user_id($id_usuario);
        echo json_encode($arrayReturn);
    }

    public function get_activity_challenge_by_id(  $id_actividad) {
        $this->load->library('../controllers/inLife_Services/user_services');
        $arrayReturn = $this->user_services->get_activity_challenge_by_id( $id_actividad);
        echo json_encode($arrayReturn);
    }

    public function save_profile_image($id_usuario, $id_img_name) {
        $this->load->library('../controllers/inLife_Services/user_services');
        $user_data_sweph = $this->user_services->save_profile_image($id_usuario, $id_img_name);
        echo json_encode($user_data_sweph);
    }

    public function save_answer_day_challenge($id_reto_primordial, $id_usuario, $calification,$respuesta_reto_dia) {
        $this->load->library('../controllers/inLife_Services/user_services');
        $user_data_sweph = $this->user_services->save_answer_day_challenge($id_reto_primordial, $id_usuario, $calification,$respuesta_reto_dia);
        echo json_encode($user_data_sweph);
    }
    
     public function get_challenge($id_reto, $id_usuario) {
        $this->load->library('../controllers/inLife_Services/user_services');
        $user_data_sweph = $this->user_services->get_challenge($id_reto, $id_usuario);
        echo json_encode($user_data_sweph);
    }

}
