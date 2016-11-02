<?php

header("Cache-Control: no-cache, no-store, must-revalidate, post-check=0, pre-check=0");
header("Pragma: no-cache");
header('Access-Control-Allow-Origin: *');

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Events extends MY_Controller {

    protected $language = "";

    public function __construct() {
        parent::__construct();
        $this->load->model('Cam');
    }

    function index() {
        
    }

    public function get_event_by_id($id_vital_experience) {

      $vital_experience =   $this->Cam->sqlInsert(" SELECT  * " .
                " FROM vital_experience  " .
                " WHERE id_vital_experience  = " .$id_vital_experience.
                "");


        echo $vital_experience;
    }

}
