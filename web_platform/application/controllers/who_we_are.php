<?php

header("Cache-Control: no-cache, no-store, must-revalidate, post-check=0, pre-check=0");
header("Pragma: no-cache");

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Who_we_are extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    function index() {
        $this->getLanguageController("who_we_are");
        $this->_render('pages/who_we_are', "FULLPAGE");
    }

}
