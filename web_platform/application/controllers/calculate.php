<?php

header("Cache-Control: no-cache, no-store, must-revalidate, post-check=0, pre-check=0");
header("Pragma: no-cache");

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Calculate extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    function index() {
       $this->_render('pages/calculate_hour', "FULLPAGE");
    }

    public function calculate_event_one() {
     
    }

}
