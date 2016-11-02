<?php

header("Cache-Control: no-cache, no-store, must-revalidate, post-check=0, pre-check=0");
header("Pragma: no-cache");
header('Access-Control-Allow-Origin: *');

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Test extends MY_Controller {

    public function __construct() {
        parent::__construct();
// $this->load->library('../controllers/inLife_Services_REST/sweph_get_data_user_rest');
//$this->load->library('../controllers/converter/grade_converter');
    }

    function index() {
        
    }

    public function prueba() {


        ini_set('max_execution_time', 9000);

        $this->load->library('../controllers/inLife_Services/sweph_get_data_user_rest');

        $julian = array(
            'date' => '27.5.1956',
            'long' => '-76.52277777777778',
            'lat' => '+3.4375000000000004',
            'hour' => '10:23:28'
        );
        $sara = array(
            'date' => '4.7.1996',
            'long' => '-76.52277777777778',
            'lat' => '+3.4375000000000004',
            'hour' => '20:09:42'
        );
        $jacobo = array(
            'date' => '23.3.2013',
            'long' => '-76.52277777777778',
            'lat' => '+3.4375000000000004',
            'hour' => '00:59:04'
        );
        $mauricio = array(
            'date' => '16.1.1978',
            'long' => '-76.52277777777778',
            'lat' => '+3.4375000000000004',
            'hour' => '00:27:00'
        );
        $jenifer = array(
            'date' => '14.3.1982',
            'long' => '-76.52277777777778',
            'lat' => '+3.4375000000000004',
            'hour' => '08:00:17'
        );


        $cliente = array(
            'date' => '5.7.1972',
            'long' => '-76.52277777777778',
            'lat' => '+3.4375000000000004',
            'hour' => '07:00:00'
        );
        $evento1 = array(
            'date' => '7.6.1982',
            'long' => '-76.5319854',
            'lat' => '+3.4516467',
            'hour' => '05:00:00'
        );



       // $this->compare_one($cliente, $evento1);
        //$this->compare_one($sara, $julian);
         $sweet_event_born = $this->sweph_get_data_user_rest->get_sweph_user_data($evento1);
          echo json_encode($sweet_event_born);

        $evento1 = array(
            'date' => '4.7.1996',
            'long' => '-76.5225',
            'lat' => '+3.4372222222222',
            'hour' => '20:09:42'
        );
        $evento2 = array(
            'date' => '23.3.2013',
            'long' => '-76.5225',
            'lat' => '+3.4372222222222',
            'hour' => '01:02:04'
        );
        $evento3 = array(
            'date' => '22.9.2015',
            'long' => '-76.5225',
            'lat' => '+3.4372222222222',
            'hour' => '13:52:48'
        );


        // $this->compare($mauricio, $evento1, $evento2, $evento3);


        $s = array(
            'date' => '19.7.1989',
            'long' => '-76.5225',
            'lat' => '+3.4372222222222',
            'hour' => '00:00:00'
        );

        $evento3 = array(
            'date' => '22.9.2015',
            'long' => '-76.5225',
            'lat' => '+3.4372222222222',
            'hour' => '13:52:48'
        );
        //     $this->compare_one($s, $evento3);
    }

    public function compare_one($born_event, $event_1) {

        // $aceept = 0.0011111111111111111; //4s
        $aceept = 0.002777777777777778; //10s
        //  $aceept = 0.0016666666666666668; //6s
        // $aceept = 0.008333333333333333; //30s

        $TIME_LAPSED = 1;
        //  $DIFFERENCIE_AO_ACCEPT = 0.03333333333333333; //2'
        $DIFFERENCIE_AO_ACCEPT = 0.5; //30'

        $equals_event_1 = 0;



        $is_hour_correct = 0;

        $sweet_event_born = $this->sweph_get_data_user_rest->get_sweph_user_data($born_event);
        $sweet_event_1 = $this->sweph_get_data_user_rest->get_sweph_user_data($event_1);




        $planets_list_event_born = $sweet_event_born["planets"];
        $planets_list_event_1 = $sweet_event_1["planets"];

        $armc_e = $sweet_event_1["ARMC"];
        $ARMC_event = floatval($armc_e["long"]);


        foreach ($planets_list_event_born as $planet_born_event) {



            $dmo_planet_born_event = floatval($planet_born_event["meridian_oblique_distance"]);
            $name_planet_born_event = $planet_born_event["name"];
            $right_ascension_born_event = floatval($planet_born_event["right_ascension"]);

            foreach ($planets_list_event_1 as $planet_event_1) {
                $dmo_planet_event_1 = floatval($planet_event_1["meridian_oblique_distance"]);
                $total_rest = abs($dmo_planet_born_event - $dmo_planet_event_1);
                $name_planet_event_1 = $planet_event_1["name"];
                $right_ascension_1 = floatval($planet_event_1["right_ascension"]);

                $total = floatval($total_rest);
                if ($total >= 0) {
                    $true = $total <= $aceept ? 0 : 1;

                    if ($true === 0) {

                        $equals_event_1 = 1;
                        $is_hour_correct = 1;
                    }
                }
            }
        }


        if ($equals_event_1 == 1) {
            $is_hour_correct = 1;
        }


        if ($is_hour_correct === 0) {


            $new_date = "";
            $new_hour = "";

            $ARRAY_COMPARE_DIFFERENCES = array();

            while ($is_hour_correct === 0) {

                $new_born_hour = strtotime($born_event["hour"]) + $TIME_LAPSED;
                $born_event["hour"] = strftime('%H:%M:%S', $new_born_hour);

//                $date = new DateTime($born_event["date"] . ' ' . $born_event["hour"]);
//                $date->add(new DateInterval('PT0H10S'));
//                $born_event["hour"] = $date->format('H:i:s');
//                $born_event["date"] = $date->format('d.m.Y');


                $equals_event_1 = 0;



                $new_date = $born_event["date"];
                $new_hour = $born_event["hour"];


                echo"<br>*****************************************";
                echo "<br>CAMBIO DE HORA " . $new_date . "---" . $new_hour . "<br>";
                echo"<br>*****************************************";

                $sweet_event_born = $this->sweph_get_data_user_rest->get_sweph_user_data($born_event);


                $planets_list_event_born = $sweet_event_born["planets"];


                $armc = $sweet_event_born["ARMC"];
                $ARMC_born = floatval($armc["long"]);


                foreach ($planets_list_event_born as $planet_born_event) {



                    $dmo_planet_born_event = floatval($planet_born_event["meridian_oblique_distance"]);
                    $DMO_PLANETA_NACIMIENTO = floatval($planet_born_event["meridian_oblique_distance"]);
                    $NOMBRE_PLANETA_NACIMIENTO = $planet_born_event["name"];
                    $name_planet_born_event = $planet_born_event["name"];
                    $right_ascension_born_event = floatval($planet_born_event["right_ascension"]);
                    $ascension_oblique_born_event = floatval($planet_born_event["ascension_oblique"]);



                    foreach ($planets_list_event_1 as $planet_event_1) {
                        $dmo_planet_event_1 = floatval($planet_event_1["meridian_oblique_distance"]);
                        $total_rest = abs($dmo_planet_born_event - $dmo_planet_event_1);
                        $name_planet_event_1 = $planet_event_1["name"];


                        $DMO_PLANETA_EVENTO = floatval($planet_event_1["meridian_oblique_distance"]);
                        $NOMBRE_PLANETA_EVENTO = $planet_event_1["name"];


                        $right_ascension_1 = floatval($planet_event_1["right_ascension"]);
                        $ascension_oblique_1 = floatval($planet_event_1["ascension_oblique"]);

                        $total = floatval($total_rest);

                        if ($total >= 0) {

                            $true = $total <= $aceept ? 0 : 1;


                            if ($true === 0) {

                                $arco_trascurrido = $ARMC_event - $ARMC_born;

                                if ($arco_trascurrido < 0) {
                                    $arco_trascurrido = $arco_trascurrido + 360;
                                }

                                $ascecion_oblicuad_transcurrida = $ascension_oblique_born_event + $arco_trascurrido;

                                if ($ascecion_oblicuad_transcurrida > 360) {
                                    $ascecion_oblicuad_transcurrida = $ascecion_oblicuad_transcurrida - 360;
                                }


                                $opuesto_ascecion_oblicuad_transcurrida = 0.0;
                                if ($ascecion_oblicuad_transcurrida > 0 && $ascecion_oblicuad_transcurrida < 180) {
                                    $opuesto_ascecion_oblicuad_transcurrida = $ascecion_oblicuad_transcurrida + 180;
                                } else if ($ascecion_oblicuad_transcurrida > 180 && $ascecion_oblicuad_transcurrida < 360) {
                                    $opuesto_ascecion_oblicuad_transcurrida = ($ascecion_oblicuad_transcurrida + 180) - 360;
                                }



                                if ($ascension_oblique_1 > 360) {
                                    $ascension_oblique_1 = $ascension_oblique_1 - 360;
                                }

                                $opuesto_ascecion_oblicuad_1 = 0.0;
                                if ($ascension_oblique_1 > 0 && $ascension_oblique_1 < 180) {
                                    $opuesto_ascecion_oblicuad_1 = $ascension_oblique_1 + 180;
                                } else if ($ascension_oblique_1 > 180 && $ascension_oblique_1 < 360) {
                                    $opuesto_ascecion_oblicuad_1 = ($ascension_oblique_1 + 180) - 360;
                                }


                                $antiscio_ascecion_oblicuad_transcurrida = 0.0;
                                $antiscio_ascension_oblique_1 = 0.0;
                                $opuesto_antiscio_ascension_oblique_1 = 0.0;
                                $opuesto_antiscio_ascension_oblicuad_transcurrida = 0.0;

                                switch ($ascecion_oblicuad_transcurrida) {
                                    case ($ascecion_oblicuad_transcurrida > 0 && $ascecion_oblicuad_transcurrida < 30):
                                        $antiscio_ascecion_oblicuad_transcurrida = (30 - $ascecion_oblicuad_transcurrida) + 150;
                                        break;

                                    case ($ascecion_oblicuad_transcurrida > 30 && $ascecion_oblicuad_transcurrida < 60):
                                        $antiscio_ascecion_oblicuad_transcurrida = (60 - $ascecion_oblicuad_transcurrida) + 120;
                                        break;


                                    case ($ascecion_oblicuad_transcurrida > 60 && $ascecion_oblicuad_transcurrida < 90):
                                        $antiscio_ascecion_oblicuad_transcurrida = (90 - $ascecion_oblicuad_transcurrida) + 90;
                                        break;

                                    case ($ascecion_oblicuad_transcurrida > 90 && $ascecion_oblicuad_transcurrida < 120):
                                        $antiscio_ascecion_oblicuad_transcurrida = (120 - $ascecion_oblicuad_transcurrida) + 60;
                                        break;


                                    case ($ascecion_oblicuad_transcurrida > 120 && $ascecion_oblicuad_transcurrida < 150):
                                        $antiscio_ascecion_oblicuad_transcurrida = (150 - $ascecion_oblicuad_transcurrida) + 30;
                                        break;


                                    case ($ascecion_oblicuad_transcurrida > 150 && $ascecion_oblicuad_transcurrida < 180):
                                        $antiscio_ascecion_oblicuad_transcurrida = (180 - $ascecion_oblicuad_transcurrida) - 150;
                                        break;


                                    case ($ascecion_oblicuad_transcurrida > 180 && $ascecion_oblicuad_transcurrida < 210):
                                        $antiscio_ascecion_oblicuad_transcurrida = (210 - $ascecion_oblicuad_transcurrida) + 330;
                                        break;


                                    case ($ascecion_oblicuad_transcurrida > 210 && $ascecion_oblicuad_transcurrida < 240):
                                        $antiscio_ascecion_oblicuad_transcurrida = (240 - $ascecion_oblicuad_transcurrida) + 300;
                                        break;


                                    case ($ascecion_oblicuad_transcurrida > 240 && $ascecion_oblicuad_transcurrida < 270):
                                        $antiscio_ascecion_oblicuad_transcurrida = (270 - $ascecion_oblicuad_transcurrida) + 270;
                                        break;



                                    case ($ascecion_oblicuad_transcurrida > 270 && $ascecion_oblicuad_transcurrida < 300):
                                        $antiscio_ascecion_oblicuad_transcurrida = (300 - $ascecion_oblicuad_transcurrida) + 240;
                                        break;


                                    case ($ascecion_oblicuad_transcurrida > 300 && $ascecion_oblicuad_transcurrida < 330):
                                        $antiscio_ascecion_oblicuad_transcurrida = (330 - $ascecion_oblicuad_transcurrida) + 210;
                                        break;
                                    case ($ascecion_oblicuad_transcurrida > 330 && $ascecion_oblicuad_transcurrida < 360):
                                        $antiscio_ascecion_oblicuad_transcurrida = (360 - $ascecion_oblicuad_transcurrida) + 180;
                                        break;
                                }
                                switch ($ascension_oblique_1) {
                                    case ($ascension_oblique_1 > 0 && $ascension_oblique_1 < 30):
                                        $antiscio_ascension_oblique_1 = (30 - $ascension_oblique_1) + 150;
                                        break;

                                    case ($ascension_oblique_1 > 30 && $ascension_oblique_1 < 60):
                                        $antiscio_ascension_oblique_1 = (60 - $ascension_oblique_1) + 120;
                                        break;


                                    case ($ascension_oblique_1 > 60 && $ascension_oblique_1 < 90):
                                        $antiscio_ascension_oblique_1 = (90 - $ascension_oblique_1) + 90;
                                        break;



                                    case ($ascension_oblique_1 > 90 && $ascension_oblique_1 < 120):
                                        $antiscio_ascension_oblique_1 = (120 - $ascension_oblique_1) + 60;
                                        break;


                                    case ($ascension_oblique_1 > 120 && $ascension_oblique_1 < 150):
                                        $antiscio_ascension_oblique_1 = (150 - $ascension_oblique_1) + 30;
                                        break;


                                    case ($ascension_oblique_1 > 150 && $ascension_oblique_1 < 180):
                                        $antiscio_ascension_oblique_1 = (180 - $ascension_oblique_1) - 150;
                                        break;


                                    case ($ascension_oblique_1 > 180 && $ascension_oblique_1 < 210):
                                        $antiscio_ascension_oblique_1 = (210 - $ascension_oblique_1) + 330;
                                        break;


                                    case ($ascension_oblique_1 > 210 && $ascension_oblique_1 < 240):
                                        $antiscio_ascension_oblique_1 = (240 - $ascension_oblique_1) + 300;
                                        break;


                                    case ($ascension_oblique_1 > 240 && $ascension_oblique_1 < 270):
                                        $antiscio_ascension_oblique_1 = (270 - $ascension_oblique_1) + 270;
                                        break;



                                    case ($ascension_oblique_1 > 270 && $ascension_oblique_1 < 300):
                                        $antiscio_ascension_oblique_1 = (300 - $ascension_oblique_1) + 240;
                                        break;


                                    case ($ascension_oblique_1 > 300 && $ascension_oblique_1 < 330):
                                        $antiscio_ascension_oblique_1 = (330 - $ascension_oblique_1) + 210;
                                        break;
                                    case ($ascension_oblique_1 > 330 && $ascension_oblique_1 < 360):
                                        $antiscio_ascension_oblique_1 = (360 - $ascension_oblique_1) + 180;
                                        break;
                                }


                                if ($antiscio_ascecion_oblicuad_transcurrida > 360) {
                                    $antiscio_ascecion_oblicuad_transcurrida = $antiscio_ascecion_oblicuad_transcurrida - 360;
                                }



                                if ($antiscio_ascecion_oblicuad_transcurrida > 0 && $antiscio_ascecion_oblicuad_transcurrida < 180) {
                                    $opuesto_antiscio_ascension_oblicuad_transcurrida = $antiscio_ascecion_oblicuad_transcurrida + 180;
                                } else if ($antiscio_ascecion_oblicuad_transcurrida > 180 && $antiscio_ascecion_oblicuad_transcurrida < 360) {
                                    $opuesto_antiscio_ascension_oblicuad_transcurrida = ($antiscio_ascecion_oblicuad_transcurrida + 180) - 360;
                                }

                                if ($antiscio_ascension_oblique_1 > 360) {
                                    $antiscio_ascension_oblique_1 = $antiscio_ascension_oblique_1 - 360;
                                }

                                if ($antiscio_ascension_oblique_1 > 0 && $antiscio_ascension_oblique_1 < 180) {
                                    $opuesto_antiscio_ascension_oblique_1 = $antiscio_ascension_oblique_1 + 180;
                                } else if ($antiscio_ascension_oblique_1 > 180 && $antiscio_ascension_oblique_1 < 360) {
                                    $opuesto_antiscio_ascension_oblique_1 = ($antiscio_ascension_oblique_1 + 180) - 360;
                                }


                                $dif_btwn_aotb_n_aoe = abs($ascecion_oblicuad_transcurrida - $ascension_oblique_1);
                                $dif_btwn_aotb_n_oaoe = abs($ascecion_oblicuad_transcurrida - $opuesto_ascecion_oblicuad_1);
                                $dif_btwn_aaot_n_aaoe = abs($ascecion_oblicuad_transcurrida - $antiscio_ascension_oblique_1);
                                $dif_btwn_aaot_n_oaaoe = abs($ascecion_oblicuad_transcurrida - $opuesto_antiscio_ascension_oblique_1);

                                $dif_btwn_aaotb_n_aoe = abs($antiscio_ascecion_oblicuad_transcurrida - $ascension_oblique_1);
                                $dif_btwn_aaotb_n_oaoe = abs($antiscio_ascecion_oblicuad_transcurrida - $opuesto_ascecion_oblicuad_1);
                                $dif_btwn_aaaot_n_aaoe = abs($antiscio_ascecion_oblicuad_transcurrida - $antiscio_ascension_oblique_1);
                                $dif_btwn_aaaot_n_oaaoe = abs($antiscio_ascecion_oblicuad_transcurrida - $opuesto_antiscio_ascension_oblique_1);

                                $long_difference = 0.0;
                                $antiscio_difference = 0.0;
                                $anti_born_long_event_difference = 0.0;
                                $long_born_anti_event_difference = 0.0;

                                $diff_acepted = 0;


                                $array_difereces_ao = array();

                                if ($dif_btwn_aotb_n_aoe >= -0.5 && $dif_btwn_aotb_n_aoe <= 0.5 || $dif_btwn_aotb_n_aoe >= 179.5 && $dif_btwn_aotb_n_aoe <= 180.5) {
                                    $diff_acepted = 1;
                                    array_push($array_difereces_ao, $dif_btwn_aotb_n_aoe);
                                } else if ($dif_btwn_aotb_n_oaoe >= -0.5 && $dif_btwn_aotb_n_oaoe <= 0.5 || $dif_btwn_aotb_n_oaoe >= 179.5 && $dif_btwn_aotb_n_oaoe <= 180.5) {
                                    $diff_acepted = 1;
                                    array_push($array_difereces_ao, $dif_btwn_aotb_n_oaoe);
                                } else if ($dif_btwn_aaot_n_aaoe >= -0.5 && $dif_btwn_aaot_n_aaoe <= 0.5 || $dif_btwn_aaot_n_aaoe >= 179.5 && $dif_btwn_aaot_n_aaoe <= 180.5) {
                                    $diff_acepted = 1;
                                    array_push($array_difereces_ao, $dif_btwn_aaot_n_aaoe);
                                } else if ($dif_btwn_aaot_n_oaaoe >= -0.5 && $dif_btwn_aaot_n_oaaoe <= 0.5 || $dif_btwn_aaot_n_oaaoe >= 179.5 && $dif_btwn_aaot_n_oaaoe <= 180.5) {
                                    $diff_acepted = 1;
                                    array_push($array_difereces_ao, $dif_btwn_aaot_n_oaaoe);
                                } else if ($dif_btwn_aaotb_n_aoe >= -0.5 && $dif_btwn_aaotb_n_aoe <= 0.5 || $dif_btwn_aaotb_n_aoe >= 179.5 && $dif_btwn_aaotb_n_aoe <= 180.5) {
                                    $diff_acepted = 1;
                                    array_push($array_difereces_ao, $dif_btwn_aaotb_n_aoe);
                                } else if ($dif_btwn_aaotb_n_oaoe >= -0.5 && $dif_btwn_aaotb_n_oaoe <= 0.5 || $dif_btwn_aaotb_n_oaoe >= 179.5 && $dif_btwn_aaotb_n_oaoe <= 180.5) {
                                    $diff_acepted = 1;
                                    array_push($array_difereces_ao, $dif_btwn_aaotb_n_oaoe);
                                } else if ($dif_btwn_aaaot_n_aaoe >= -0.5 && $dif_btwn_aaaot_n_aaoe <= 0.5 || $dif_btwn_aaaot_n_aaoe >= 179.5 && $dif_btwn_aaaot_n_aaoe <= 180.5) {
                                    $diff_acepted = 1;
                                    array_push($array_difereces_ao, $dif_btwn_aaaot_n_aaoe);
                                } else if ($dif_btwn_aaaot_n_oaaoe >= -0.5 && $dif_btwn_aaaot_n_oaaoe <= 0.5 || $dif_btwn_aaaot_n_oaaoe >= 179.5 && $dif_btwn_aaaot_n_oaaoe <= 180.5) {
                                    $diff_acepted = 1;
                                    array_push($array_difereces_ao, $dif_btwn_aaaot_n_oaaoe);
                                }



                                echo "<br><br>***************************";

                                echo "<br>----->" . json_encode($array_difereces_ao);

                                echo "<br><br>***************************";



                                if ($diff_acepted == 1) {


                                    //***************************
                                    //****COMPARO PLANETAS SIN IMPORTAR ORDEN ****
                                    //***************************
                                    
                                    $is_success = 0;
                                    foreach ($planets_list_event_born as $planet_born_event) {

                                        $long_born_event = floatval($planet_born_event["long"]);
                                        $asntiscio_born_event = floatval($planet_born_event["asntiscio"]);

                                        $dmo_planet_born_event = floatval($planet_born_event["meridian_oblique_distance"]);
                                        $name_planet_born_event = $planet_born_event["name"];




                                        foreach ($planets_list_event_1 as $planet_event_1) {


                                            $long_1 = floatval($planet_event_1["long"]);
                                            $asntiscio_1 = floatval($planet_event_1["asntiscio"]);
                                            $planet_name_1 = $planet_event_1["name"];
                                            $meridian_oblique_distance_1_event = floatval($planet_event_1["meridian_oblique_distance"]);



                                            $long_difference = abs($long_born_event - $long_1);
                                            $long_born_anti_event_difference = abs($long_born_event - $asntiscio_1);
                                            $anti_born_long_event_difference = abs($asntiscio_born_event - $long_1);
                                            $antiscio_difference = abs($asntiscio_born_event - $asntiscio_1);


                                            $long_difference_int = floatval($long_difference);
                                            $antiscio_difference_int = floatval($antiscio_difference);
                                            $long_born_anti_event_difference_int = floatval($long_born_anti_event_difference);
                                            $anti_born_long_event_difference_int = floatval($anti_born_long_event_difference);


                                            $rango_tolerancia = $DIFFERENCIE_AO_ACCEPT;


                                            if ($long_difference_int <= 180) {

                                                if ($long_difference_int <= $rango_tolerancia && $long_difference_int >= -$rango_tolerancia) {
                                                    $is_success = 1;
                                                } else if ($long_difference_int <= (15 + $rango_tolerancia) && $long_difference_int >= (15 - $rango_tolerancia)) {
                                                    $is_success = 1;
                                                } else if ($long_difference_int <= (30 + $rango_tolerancia) && $long_difference_int >= (30 - $rango_tolerancia)) {
                                                    $is_success = 1;
                                                } else if ($long_difference_int <= (36 + $rango_tolerancia) && $long_difference_int >= (36 - $rango_tolerancia)) {
                                                    $is_success = 1;
                                                } else if ($long_difference_int <= (45 + $rango_tolerancia) && $long_difference_int >= (45 - $rango_tolerancia)) {
                                                    $is_success = 1;
                                                } else if ($long_difference_int <= (60 + $rango_tolerancia) && $long_difference_int >= (60 - $rango_tolerancia)) {
                                                    $is_success = 1;
                                                } else if ($long_difference_int <= (72 + $rango_tolerancia) && $long_difference_int >= (72 - $rango_tolerancia)) {
                                                    $is_success = 1;
                                                } else if ($long_difference_int <= (75 + $rango_tolerancia) && $long_difference_int >= (75 - $rango_tolerancia)) {
                                                    $is_success = 1;
                                                } else if ($long_difference_int <= (90 + $rango_tolerancia) && $long_difference_int >= (90 - $rango_tolerancia)) {
                                                    $is_success = 1;
                                                } else if ($long_difference_int <= (105 + $rango_tolerancia) && $long_difference_int >= (105 - $rango_tolerancia)) {
                                                    $is_success = 1;
                                                } else if ($long_difference_int <= (120 + $rango_tolerancia) && $long_difference_int >= (120 - $rango_tolerancia)) {
                                                    $is_success = 1;
                                                } else if ($long_difference_int <= (135 + $rango_tolerancia) && $long_difference_int >= (135 - $rango_tolerancia)) {
                                                    $is_success = 1;
                                                } else if ($long_difference_int <= (144 + $rango_tolerancia) && $long_difference_int >= (144 - $rango_tolerancia)) {
                                                    $is_success = 1;
                                                } else if ($long_difference_int == 150) {
                                                    if ($long_difference_int <= (150 + $rango_tolerancia) && $long_difference_int >= (150 - $rango_tolerancia)) {
                                                        $is_success = 1;
                                                    }
                                                } else if ($long_difference_int <= (165 + $rango_tolerancia) && $long_difference_int >= (165 - $rango_tolerancia)) {
                                                    $is_success = 1;
                                                } else if ($long_difference_int <= (180 + $rango_tolerancia) && $long_difference_int >= (180 - $rango_tolerancia)) {
                                                    $is_success = 1;
                                                }
                                            }
                                            if ($antiscio_difference_int <= 180) {

                                                if ($antiscio_difference_int <= $rango_tolerancia && $antiscio_difference_int >= -$rango_tolerancia) {
                                                    $is_success = 1;
                                                } else if ($antiscio_difference_int <= (15 + $rango_tolerancia) && $antiscio_difference_int >= (15 - $rango_tolerancia)) {
                                                    $is_success = 1;
                                                } else if ($antiscio_difference_int <= (30 + $rango_tolerancia) && $antiscio_difference_int >= (30 - $rango_tolerancia)) {
                                                    $is_success = 1;
                                                } else if ($antiscio_difference_int <= (36 + $rango_tolerancia) && $antiscio_difference_int >= (36 - $rango_tolerancia)) {
                                                    $is_success = 1;
                                                } else if ($antiscio_difference_int <= (45 + $rango_tolerancia) && $antiscio_difference_int >= (45 - $rango_tolerancia)) {
                                                    $is_success = 1;
                                                } else if ($antiscio_difference_int <= (60 + $rango_tolerancia) && $antiscio_difference_int >= (60 - $rango_tolerancia)) {
                                                    $is_success = 1;
                                                } else if ($antiscio_difference_int <= (72 + $rango_tolerancia) && $antiscio_difference_int >= (72 - $rango_tolerancia)) {
                                                    $is_success = 1;
                                                } else if ($antiscio_difference_int <= (75 + $rango_tolerancia) && $antiscio_difference_int >= (75 - $rango_tolerancia)) {
                                                    $is_success = 1;
                                                } else if ($antiscio_difference_int <= (90 + $rango_tolerancia) && $antiscio_difference_int >= (90 - $rango_tolerancia)) {
                                                    $is_success = 1;
                                                } else if ($antiscio_difference_int <= (105 + $rango_tolerancia) && $antiscio_difference_int >= (105 - $rango_tolerancia)) {
                                                    $is_success = 1;
                                                } else if ($antiscio_difference_int <= (120 + $rango_tolerancia) && $antiscio_difference_int >= (120 - $rango_tolerancia)) {
                                                    $is_success = 1;
                                                } else if ($antiscio_difference_int <= (135 + $rango_tolerancia) && $antiscio_difference_int >= (135 - $rango_tolerancia)) {
                                                    $is_success = 1;
                                                } else if ($antiscio_difference_int <= (144 + $rango_tolerancia) && $antiscio_difference_int >= (144 - $rango_tolerancia)) {
                                                    $is_success = 1;
                                                } else if ($antiscio_difference_int == 150) {
                                                    if ($antiscio_difference_int <= (150 + $rango_tolerancia) && $antiscio_difference_int >= (150 - $rango_tolerancia)) {
                                                        $is_success = 1;
                                                    }
                                                } else if ($antiscio_difference_int <= (165 + $rango_tolerancia) && $antiscio_difference_int >= (165 - $rango_tolerancia)) {
                                                    $is_success = 1;
                                                } else if ($antiscio_difference_int <= (180 + $rango_tolerancia) && $antiscio_difference_int >= (180 - $rango_tolerancia)) {
                                                    $is_success = 1;
                                                }
                                            }
                                            if ($long_born_anti_event_difference_int <= 180) {

                                                if ($long_born_anti_event_difference_int <= $rango_tolerancia && $long_born_anti_event_difference_int >= -$rango_tolerancia) {
                                                    $is_success = 1;
                                                } else if ($long_born_anti_event_difference_int <= (15 + $rango_tolerancia) && $long_born_anti_event_difference_int >= (15 - $rango_tolerancia)) {
                                                    $is_success = 1;
                                                } else if ($long_born_anti_event_difference_int <= (30 + $rango_tolerancia) && $long_born_anti_event_difference_int >= (30 - $rango_tolerancia)) {
                                                    $is_success = 1;
                                                } else if ($long_born_anti_event_difference_int <= (36 + $rango_tolerancia) && $long_born_anti_event_difference_int >= (36 - $rango_tolerancia)) {
                                                    $is_success = 1;
                                                } else if ($long_born_anti_event_difference_int <= (45 + $rango_tolerancia) && $long_born_anti_event_difference_int >= (45 - $rango_tolerancia)) {
                                                    $is_success = 1;
                                                } else if ($long_born_anti_event_difference_int <= (60 + $rango_tolerancia) && $long_born_anti_event_difference_int >= (60 - $rango_tolerancia)) {
                                                    $is_success = 1;
                                                } else if ($long_born_anti_event_difference_int <= (72 + $rango_tolerancia) && $long_born_anti_event_difference_int >= (72 - $rango_tolerancia)) {
                                                    $is_success = 1;
                                                } else if ($long_born_anti_event_difference_int <= (75 + $rango_tolerancia) && $long_born_anti_event_difference_int >= (75 - $rango_tolerancia)) {
                                                    $is_success = 1;
                                                } else if ($long_born_anti_event_difference_int <= (90 + $rango_tolerancia) && $long_born_anti_event_difference_int >= (90 - $rango_tolerancia)) {
                                                    $is_success = 1;
                                                } else if ($long_born_anti_event_difference_int <= (105 + $rango_tolerancia) && $long_born_anti_event_difference_int >= (105 - $rango_tolerancia)) {
                                                    $is_success = 1;
                                                } else if ($long_born_anti_event_difference_int <= (120 + $rango_tolerancia) && $long_born_anti_event_difference_int >= (120 - $rango_tolerancia)) {
                                                    $is_success = 1;
                                                } else if ($long_born_anti_event_difference_int <= (135 + $rango_tolerancia) && $long_born_anti_event_difference_int >= (135 - $rango_tolerancia)) {
                                                    $is_success = 1;
                                                } else if ($long_born_anti_event_difference_int <= (144 + $rango_tolerancia) && $long_born_anti_event_difference_int >= (144 - $rango_tolerancia)) {
                                                    $is_success = 1;
                                                } else if ($long_born_anti_event_difference_int == 150) {
                                                    if ($long_born_anti_event_difference_int <= (150 + $rango_tolerancia) && $long_born_anti_event_difference_int >= (150 - $rango_tolerancia)) {
                                                        $is_success = 1;
                                                    }
                                                } else if ($long_born_anti_event_difference_int <= (165 + $rango_tolerancia) && $long_born_anti_event_difference_int >= (165 - $rango_tolerancia)) {
                                                    $is_success = 1;
                                                } else if ($long_born_anti_event_difference_int <= (180 + $rango_tolerancia) && $long_born_anti_event_difference_int >= (180 - $rango_tolerancia)) {
                                                    $is_success = 1;
                                                }
                                            }
                                            if ($anti_born_long_event_difference_int <= 180) {

                                                if ($anti_born_long_event_difference_int <= $rango_tolerancia && $anti_born_long_event_difference_int >= -$rango_tolerancia) {
                                                    $is_success = 1;
                                                } else if ($anti_born_long_event_difference_int <= (15 + $rango_tolerancia) && $anti_born_long_event_difference_int >= (15 - $rango_tolerancia)) {
                                                    $is_success = 1;
                                                } else if ($anti_born_long_event_difference_int <= (30 + $rango_tolerancia) && $anti_born_long_event_difference_int >= (30 - $rango_tolerancia)) {
                                                    $is_success = 1;
                                                } else if ($anti_born_long_event_difference_int <= (36 + $rango_tolerancia) && $anti_born_long_event_difference_int >= (36 - $rango_tolerancia)) {
                                                    $is_success = 1;
                                                } else if ($anti_born_long_event_difference_int <= (45 + $rango_tolerancia) && $anti_born_long_event_difference_int >= (45 - $rango_tolerancia)) {
                                                    $is_success = 1;
                                                } else if ($anti_born_long_event_difference_int <= (60 + $rango_tolerancia) && $anti_born_long_event_difference_int >= (60 - $rango_tolerancia)) {
                                                    $is_success = 1;
                                                } else if ($anti_born_long_event_difference_int <= (72 + $rango_tolerancia) && $anti_born_long_event_difference_int >= (72 - $rango_tolerancia)) {
                                                    $is_success = 1;
                                                } else if ($anti_born_long_event_difference_int <= (75 + $rango_tolerancia) && $anti_born_long_event_difference_int >= (75 - $rango_tolerancia)) {
                                                    $is_success = 1;
                                                } else if ($anti_born_long_event_difference_int <= (90 + $rango_tolerancia) && $anti_born_long_event_difference_int >= (90 - $rango_tolerancia)) {
                                                    $is_success = 1;
                                                } else if ($anti_born_long_event_difference_int <= (105 + $rango_tolerancia) && $anti_born_long_event_difference_int >= (105 - $rango_tolerancia)) {
                                                    $is_success = 1;
                                                } else if ($anti_born_long_event_difference_int <= (120 + $rango_tolerancia) && $anti_born_long_event_difference_int >= (120 - $rango_tolerancia)) {
                                                    $is_success = 1;
                                                } else if ($anti_born_long_event_difference_int <= (135 + $rango_tolerancia) && $anti_born_long_event_difference_int >= (135 - $rango_tolerancia)) {
                                                    $is_success = 1;
                                                } else if ($anti_born_long_event_difference_int <= (144 + $rango_tolerancia) && $anti_born_long_event_difference_int >= (144 - $rango_tolerancia)) {
                                                    $is_success = 1;
                                                } else if ($anti_born_long_event_difference_int == 150) {
                                                    if ($anti_born_long_event_difference_int <= (150 + $rango_tolerancia) && $anti_born_long_event_difference_int >= (150 - $rango_tolerancia)) {
                                                        $is_success = 1;
                                                    }
                                                } else if ($anti_born_long_event_difference_int <= (165 + $rango_tolerancia) && $anti_born_long_event_difference_int >= (165 - $rango_tolerancia)) {
                                                    $is_success = 1;
                                                } else if ($anti_born_long_event_difference_int <= (180 + $rango_tolerancia) && $anti_born_long_event_difference_int >= (180 - $rango_tolerancia)) {
                                                    $is_success = 1;
                                                }
                                            }
                                        }
                                    }

                                    if ($is_success == 1) {
                                        $DIFERENCIA = abs($DMO_PLANETA_NACIMIENTO - $DMO_PLANETA_EVENTO);

                                        $array = array(
                                            "date" => $new_date,
                                            "hora" => $new_hour,
                                            "born_planet" => $NOMBRE_PLANETA_NACIMIENTO,
                                            "born_planet_dmo" => $DMO_PLANETA_NACIMIENTO,
                                            "born_aot" => $ascecion_oblicuad_transcurrida,
                                            "event_planet" => $NOMBRE_PLANETA_EVENTO,
                                            "event_planet_dmo" => $DMO_PLANETA_EVENTO,
                                            "event_ao" => $ascension_oblique_1,
                                            "difference" => $DIFERENCIA
                                        );

                                        array_push($ARRAY_COMPARE_DIFFERENCES, $array);
                                        echo json_encode($ARRAY_COMPARE_DIFFERENCES);
                                    }
                                }
                            }
                        }
                    }

                    if ($equals_event_1 === 1) {
                        $is_hour_correct = 1;
                    }
                }
            }
        }
    }

}
