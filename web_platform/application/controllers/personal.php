<?php

header("Cache-Control: no-cache, no-store, must-revalidate, post-check=0, pre-check=0");
header("Pragma: no-cache");

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Personal extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    function index() {
        $this->getLanguageController("personal");
        $this->_render('pages/personal', "FULLPAGE");
    }

}
