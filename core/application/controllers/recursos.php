<?php

header("Cache-Control: no-cache, no-store, must-revalidate, post-check=0, pre-check=0");
header("Pragma: no-cache");
header('Access-Control-Allow-Origin: *');

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Recursos extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    function index() {
        
    }

    public function get_recursos_destacados() {
        $this->load->library('../controllers/inLife_Services/resources_services');
        $recursos_destacados = $this->resources_services->get_recursos_destacados();
        echo json_encode($recursos_destacados, JSON_UNESCAPED_UNICODE);
    }

    public function get_recurso_destacado_by_id($id_recurso) {
        $this->load->library('../controllers/inLife_Services/resources_services');
        $recurso = $this->resources_services->get_recurso_destacado_by_id($id_recurso);
        echo json_encode($recurso, JSON_UNESCAPED_UNICODE);
    }

}
