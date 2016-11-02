<?php

header("Cache-Control: no-cache, no-store, must-revalidate, post-check=0, pre-check=0");
header("Pragma: no-cache");

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Vital_experience extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    function index() {
        $this->getLanguageController("who_we_are");
        $this->_render('pages/who_we_are', "FULLPAGE");
    }

    function show_event($id_event) {
        $this->getLanguageController("who_we_are");
        $this->data["id_event"] = $id_event;
        $this->_render('pages/vital_experience2', "FULLPAGE");
    }

    function register_form($id_event) {
        $this->getLanguageController("who_we_are");
        $this->data["id_event"] = $id_event;
        $this->_render_form_event('pages/vital_experience_form', "FULLPAGE");
    }

}
