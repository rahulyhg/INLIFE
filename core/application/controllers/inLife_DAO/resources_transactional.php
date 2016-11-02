<?php

header("Cache-Control: no-cache, no-store, must-revalidate, post-check=0, pre-check=0");
header("Pragma: no-cache");
header('Access-Control-Allow-Origin: *');

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Resources_transactional extends MY_Controller {

    protected $language = "";

    public function __construct() {
        parent::__construct();
        $this->load->model('Cam');
    }

    function index() {
        
    }

    public function get_recursos_destacados() {
        $recursos_destacados = $this->Cam->sql(" SELECT * "
                . " FROM recursos_web rw, tipos_recurso tra"
                . " WHERE rw.destacado =1 "
                . " AND rw.id_tipo_recurso = tra.id_tipo_recurso "
                . " ");

        return $recursos_destacados;
    }

    public function get_recurso_destacado_by_id($id_recurso) {
        $recursos_destacados = $this->Cam->sql(" SELECT * "
                . " FROM recursos_web rw, tipos_recurso tra"
                . " WHERE rw.id_recurso_web =  " . $id_recurso
                . " AND rw.id_tipo_recurso = tra.id_tipo_recurso "
                . " ");

        return $recursos_destacados;
    }

}
