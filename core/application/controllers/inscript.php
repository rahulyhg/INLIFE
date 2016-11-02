<?php

header("Cache-Control: no-cache, no-store, must-revalidate, post-check=0, pre-check=0");
header("Pragma: no-cache");
header('Access-Control-Allow-Origin: *');

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Inscript extends MY_Controller {

    public function __construct() {
        parent::__construct();
// $this->load->library('../controllers/inLife_Services_REST/sweph_get_data_user_rest');
//$this->load->library('../controllers/converter/grade_converter');
    }

    function index() {
        
    }

    public function reg() {

        $this->load->library('../controllers/inLife_Services/sweph_get_data_user_rest');

        
        
        
        $id_user = 1;
        
        $usuario_data = array(
            'date' => '14.3.1982',
            'long' => '-76.5319854',
            'lat' => '+3.4516467',
            'hour' => '08:08:15'
        );
        


        $sweet_data_format = $this->sweph_get_data_user_rest->get_sweph_user_data($usuario_data);




        $planets_arrary = $sweet_data_format["planets"];
        $houses_arrary = $sweet_data_format["houses"];
        $ascendant = $sweet_data_format["Ascendat"];
        $eliptic_obliquity = $sweet_data_format["eliptic_obliquity"];
        $MC = $sweet_data_format["MC"];
        $ARMC = $sweet_data_format["ARMC"];

        $this->sweph_get_data_user_rest->store_planets($planets_arrary, $id_user);
        $this->sweph_get_data_user_rest->store_houses($houses_arrary, $id_user);
        $this->sweph_get_data_user_rest->store_ascendant($ascendant, $id_user);
        $this->sweph_get_data_user_rest->store_eliptic_obliquity($eliptic_obliquity, $id_user);
        $this->sweph_get_data_user_rest->store_mc($MC, $id_user);
        $this->sweph_get_data_user_rest->store_armc($ARMC, $id_user);


        $this->sweph_get_data_user_rest->get_aspects_by_planets($planets_arrary, $id_user);
    }

}
