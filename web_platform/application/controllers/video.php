<?php

header("Cache-Control: no-cache, no-store, must-revalidate, post-check=0, pre-check=0");
header("Pragma: no-cache");

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Video extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }
    function index() {  }

    function show_video($id_video) {
        
      $this->getLanguageController("contact");
        $this->_render_contact('pages/video_container', "FULLPAGE");
    }
 }
