<?php

header("Cache-Control: no-cache, no-store, must-revalidate, post-check=0, pre-check=0");
header("Pragma: no-cache");
header('Access-Control-Allow-Origin: *');

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Resources_services extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    function index() {
        
    }

    public function get_recursos_destacados() {
        $this->load->library('../controllers/inLife_DAO/resources_transactional');
        $resources_data = $this->resources_transactional->get_recursos_destacados();
        return $resources_data;
    }
    public function get_recurso_destacado_by_id($id_recurso) {
        $this->load->library('../controllers/inLife_DAO/resources_transactional');
        $resources_data = $this->resources_transactional->get_recurso_destacado_by_id($id_recurso);
        return $resources_data;
    }

}
