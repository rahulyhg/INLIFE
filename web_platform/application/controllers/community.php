<?php

header("Cache-Control: no-cache, no-store, must-revalidate, post-check=0, pre-check=0");
header("Pragma: no-cache");

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Community extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    function index() {
        $this->getLanguageController("community");
        $this->_render('pages/community', "FULLPAGE");
    }

    public function activate_login() {
        $this->_render_activate_login('pages/community_activate_login', "FULLPAGE");
    }

    public function success_activate_login() {
        $this->_render_activate_account('pages/success_activate_login', "FULLPAGE");
    }

    public function confirm_register_data($id_user, $register_token) {

        $this->getLanguageController("community");


        $this->data["id_user"] = $id_user;
        $this->data["register_token"] = $register_token;
        $this->_render_activate_account('pages/community_activate_count', "FULLPAGE");
    }
    public function confirm_register_data_event($id_user, $register_token) {

        $this->getLanguageController("community");


        $this->data["id_user"] = $id_user;
        $this->data["register_token"] = $register_token;
        $this->_render_activate_account('pages/community_activate_count_event', "FULLPAGE");
    }

}
