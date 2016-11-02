<?php


header("Cache-Control: no-cache, no-store, must-revalidate, post-check=0, pre-check=0");
header("Pragma: no-cache");
header('Access-Control-Allow-Origin: *');

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Test extends MY_Controller {

    public $SWEPH_DIFERENCIA_2 = 0;
    public $SWEPH_DIFERENCIA_1 = 0;

    public function __construct() {
        parent::__construct();
// $this->load->library('../controllers/inLife_Services_REST/sweph_get_data_user_rest');
//$this->load->library('../controllers/converter/grade_converter');
    }

    function index() {
        
    }

    public function eeeee() {
          $dato = $this->input->post('dato');
            echo "<br>--->" . $dato;
    }
    public function aaaa() {
        
        $hora = "00:00:00";
        $fecha = "19.7.1989";
        $gmtOffset = -5;
        
        
        $hour_in_seconds = 3600;
        $TIME_LAPSED = $gmtOffset * $hour_in_seconds;

        $complete_date = date($fecha . " " . $hora);
        
        echo "<br>--complete_date---->".$complete_date;
        
        $new_date = strtotime($complete_date);
        $new_date_increment = $new_date + $TIME_LAPSED;
        
            echo "<br>--new_date_increment---->".$new_date_increment;

        $day = date('d', $new_date_increment);
        $month = date('m', $new_date_increment);
        $year = date('Y', $new_date_increment);
        $hour = date('H:i:s', $new_date_increment);

        $format_day = str_replace("0", "", $day);
        $format_month = str_replace("0", "", $month);

        $new_born_date = $format_day . "." . $format_month . "." . $year;

        $arrayReturn = array(
            "date" => $new_born_date,
            "hour" => $hour
        );

        echo "<br>".json_encode($arrayReturn);
    }
    public function intvalconversion() {

        $grado = 27.234234;
        $integer = intval($grado);
        $residuo = $integer % 10;
                                
    }

    public function prueba_hora_incremento() {


        $gmt = -5;
        
        if($gmt <0){
            $gmt = $gmt* -1;
        }
        
        
        $hour_in_seconds = 3600;

        $TIME_LAPSED = $gmt * $hour_in_seconds;

        $born_event = array(
            'date' => "19.7.1989",
            'hour' => '00:00:00'
        );


        $born_event2 = array(
            'date' => '15.3.1982',
            'hour' => '24:59:55'
        );



        $complete_date = date($born_event["date"] . " " . $born_event["hour"]);
        $complete_date2 = date($born_event2["date"] . " " . $born_event2["hour"]);

        $date1 = new DateTime($complete_date);
//        $date2 = new DateTime($complete_date2);
//
//        $diff = $date2->diff($date1);
//
//        $hours = $diff->h;
//        $hours = $hours + ($diff->days * 24);
//


        $new_date = strtotime($complete_date);
        $new_date_incrememnt = $new_date + $TIME_LAPSED;
        $day = date('d', $new_date_incrememnt);

                                
        echo "<br>TIME_LAPSED---->" . $TIME_LAPSED;
        echo "<br>day---->" . $day;
        echo "<br>new_date---->" . date('Y.m.d H:i:s', $new_date);
        echo "<br>new_date_incrememnt---->" . date('Y.m.d H:i:s', $new_date_incrememnt);



//
//        echo "<br>---->" . strftime(' %H:%M:%S', $new_date);
//        echo "<br>---->" . date('Y.m.d H:i:s', $new_date);
//        echo "<br>---->" . $hours;
    }

    public function prueba() {


        ini_set('max_execution_time', 9000);

        $this->load->library('../controllers/inLife_Services/sweph_get_data_user_rest');
        // $this->load->library('../controllers/inLife_Services/user_services');
        //  $this->load->library('../controllers/inLife_Services/user_sweph_services');


        $mauricio = array(
            'date' => '16.1.1978',
            'long' => '-76.52277777777778',
            'lat' => '+3.4375000000000004',
            'hour' => '00:07:01'
        );
        $jenifer = array(
            'date' => '14.3.1982',
            'long' => '-76.52277777777778',
            'lat' => '+3.4375000000000004',
            'hour' => '08:00:17'
        );

        $paulina_gomez = array(
            'date' => '3.10.1955',
            'long' => '-76.52277777777778',
            'lat' => '+3.4375000000000004',
            'hour' => '12:24:00'
        );



        $julian = array(
            'date' => '27.5.1956',
            'long' => '-76.52277777777778',
            'lat' => '+3.4375000000000004',
            'hour' => '10:05:20'
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
            'hour' => '01:04:33'
        );


        $listado_eventos = array();
        array_push($listado_eventos, $jenifer);
        array_push($listado_eventos, $jacobo);

        // $this->user_sweph_services->calculateCorrectUserHour($paulina_gomez, $listado_eventos);
        // $sweet_event_born = $this->sweph_get_data_user_rest->get_sweph_user_data($mauricio);
        //  echo json_encode($sweet_event_born);
        $this->compare_two($julian, $sara, $jacobo);
    }

    public function compare_two($born_event, $event_1, $event_2) {


        $TIME_LAPSED = 1;


        $aceept = 0.08333333333333333;
        $rango_tolerancia_aot = 0.16666666666666666;
        $rango_tolerancia = 0.5;


        $variable_inicial_pos = 0 + $rango_tolerancia_aot;
        $variable_inicial_neg = 0 - $rango_tolerancia_aot;
        $variable_final_pos = 180 + $rango_tolerancia_aot;
        $variable_final_neg = 180 - $rango_tolerancia_aot;




        $equals_event_1 = 0;
        $equals_event_2 = 0;

        $is_hour_correct = 0;

        $sweet_event_born = $this->sweph_get_data_user_rest->get_sweph_user_data($born_event);
        $sweet_event_1 = $this->sweph_get_data_user_rest->get_sweph_user_data($event_1);
        $sweet_event_2 = $this->sweph_get_data_user_rest->get_sweph_user_data($event_2);




        $planets_list_event_born = $sweet_event_born["planets"];
        $planets_list_event_1 = $sweet_event_1["planets"];
        $planets_list_event_2 = $sweet_event_2["planets"];

        $armc_e = $sweet_event_1["ARMC"];
        $ARMC_event = floatval($armc_e["long"]);

        $armc_e_2 = $sweet_event_2["ARMC"];
        $ARMC_event_2 = floatval($armc_e_2["long"]);


        foreach ($planets_list_event_born as $planet_born_event) {



            $dmo_planet_born_event = floatval($planet_born_event["meridian_oblique_distance"]);
            $name_planet_born_event = $planet_born_event["name"];
            $right_ascension_born_event = floatval($planet_born_event["right_ascension"]);


            //*****************************
            //*******CORREGIR*************
            //*****************************


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
                    }
                }
            }
        }


        if ($equals_event_1 == 1) {
            $is_hour_correct = 0;
        }

        if (true) {


            $new_date = "";
            $new_hour = "";

            $ARRAY_COMPARE_DIFFERENCES = array();
            $ARRAY_COMPARE_DIFFERENCES_2 = array();

            while ($is_hour_correct === 0) {

                $new_born_hour = strtotime($born_event["hour"]) + $TIME_LAPSED;
                $born_event["hour"] = strftime('%H:%M:%S', $new_born_hour);

                $equals_event_1 = 0;
                $equals_event_2 = 0;



                $new_date = $born_event["date"];
                $new_hour = $born_event["hour"];


                echo"<br>______________________________________________________________________________";
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


                    $total_rest_DIFERENCIA = 0;
                    $total_2_rest_2_DIFERENCIA = 0;

                    $DIFERENCIA_1 = 0;
                    $DIFERENCIA_2 = 0;




                    foreach ($planets_list_event_2 as $planet_event_2) {
                        $dmo_planet_event_2 = floatval($planet_event_2["meridian_oblique_distance"]);

                        $total_2_rest_2 = $dmo_planet_born_event - $dmo_planet_event_2;


                        $total_2_rest_2_DIFERENCIA = $dmo_planet_born_event - $dmo_planet_event_2;
                        $name_planet_event_2 = $planet_event_2["name"];


                        $DMO_PLANETA_EVENTO_2 = floatval($planet_event_2["meridian_oblique_distance"]);
                        $NOMBRE_PLANETA_EVENTO_2 = $planet_event_2["name"];


                        $right_ascension_2 = floatval($planet_event_2["right_ascension"]);
                        $ascension_oblique_2 = floatval($planet_event_2["ascension_oblique"]);

                        $total_2 = floatval($total_2_rest_2);



                        $true = 0;


                        $accept_negative = $aceept * (-1);



                        if ($total_2 >= $accept_negative && $total_2 <= $aceept) {
                            $true = 1;
                        }



                        if ($true === 1) {

                            $arco_trascurrido_2 = $ARMC_event_2 - $ARMC_born;

                            if ($arco_trascurrido_2 < 0) {
                                $arco_trascurrido_2 = $arco_trascurrido_2 + 360;
                            }

                            $ascecion_oblicuad_transcurrida_2 = $ascension_oblique_born_event + $arco_trascurrido_2;

                            if ($ascecion_oblicuad_transcurrida_2 > 360) {
                                $ascecion_oblicuad_transcurrida_2 = $ascecion_oblicuad_transcurrida_2 - 360;
                            }


                            $opuesto_ascecion_oblicuad_transcurrida_2 = 0.0;

                            if ($ascecion_oblicuad_transcurrida_2 >= 0 && $ascecion_oblicuad_transcurrida_2 < 180) {

                                $opuesto_ascecion_oblicuad_transcurrida_2 = $ascecion_oblicuad_transcurrida_2 + 180;
                            } else if ($ascecion_oblicuad_transcurrida_2 >= 180 && $ascecion_oblicuad_transcurrida_2 <= 360) {
                                $opuesto_ascecion_oblicuad_transcurrida_2 = ($ascecion_oblicuad_transcurrida_2 + 180) - 360;
                            }



                            if ($ascension_oblique_2 > 360) {
                                $ascension_oblique_2 = $ascension_oblique_2 - 360;
                            }

                            $opuesto_ascecion_oblicuad_2 = 0.0;


                            if ($ascension_oblique_2 >= 0 && $ascension_oblique_2 < 180) {
                                $opuesto_ascecion_oblicuad_2 = $ascension_oblique_2 + 180;
                            } else if ($ascension_oblique_2 >= 180 && $ascension_oblique_2 <= 360) {
                                $opuesto_ascecion_oblicuad_2 = ($ascension_oblique_2 + 180) - 360;
                            }


                            $antiscio_ascecion_oblicuad_transcurrida_2 = 0.0;
                            $antiscio_ascension_oblique_2 = 0.0;
                            $opuesto_antiscio_ascension_oblique_2 = 0.0;
                            $opuesto_antiscio_ascension_oblicuad_transcurrida_2 = 0.0;


                            switch ($ascecion_oblicuad_transcurrida_2) {

                                case ($ascecion_oblicuad_transcurrida_2 >= 0 && $ascecion_oblicuad_transcurrida_2 < 30):
                                    $antiscio_ascecion_oblicuad_transcurrida_2 = (30 - $ascecion_oblicuad_transcurrida_2) + 150;
                                    break;

                                case ($ascecion_oblicuad_transcurrida_2 >= 30 && $ascecion_oblicuad_transcurrida_2 < 60):
                                    $antiscio_ascecion_oblicuad_transcurrida_2 = (60 - $ascecion_oblicuad_transcurrida_2) + 120;
                                    break;


                                case ($ascecion_oblicuad_transcurrida_2 >= 60 && $ascecion_oblicuad_transcurrida_2 < 90):
                                    $antiscio_ascecion_oblicuad_transcurrida_2 = (90 - $ascecion_oblicuad_transcurrida_2) + 90;
                                    break;

                                case ($ascecion_oblicuad_transcurrida_2 >= 90 && $ascecion_oblicuad_transcurrida_2 < 120):
                                    $antiscio_ascecion_oblicuad_transcurrida_2 = (120 - $ascecion_oblicuad_transcurrida_2) + 60;
                                    break;


                                case ($ascecion_oblicuad_transcurrida_2 >= 120 && $ascecion_oblicuad_transcurrida_2 < 150):
                                    $antiscio_ascecion_oblicuad_transcurrida_2 = (150 - $ascecion_oblicuad_transcurrida_2) + 30;
                                    break;


                                case ($ascecion_oblicuad_transcurrida_2 >= 150 && $ascecion_oblicuad_transcurrida_2 < 180):
                                    $antiscio_ascecion_oblicuad_transcurrida_2 = (180 - $ascecion_oblicuad_transcurrida_2) - 150;
                                    break;


                                case ($ascecion_oblicuad_transcurrida_2 >= 180 && $ascecion_oblicuad_transcurrida_2 < 210):
                                    $antiscio_ascecion_oblicuad_transcurrida_2 = (210 - $ascecion_oblicuad_transcurrida_2) + 330;
                                    break;


                                case ($ascecion_oblicuad_transcurrida_2 >= 210 && $ascecion_oblicuad_transcurrida_2 < 240):
                                    $antiscio_ascecion_oblicuad_transcurrida_2 = (240 - $ascecion_oblicuad_transcurrida_2) + 300;
                                    break;


                                case ($ascecion_oblicuad_transcurrida_2 >= 240 && $ascecion_oblicuad_transcurrida_2 < 270):
                                    $antiscio_ascecion_oblicuad_transcurrida_2 = (270 - $ascecion_oblicuad_transcurrida_2) + 270;
                                    break;



                                case ($ascecion_oblicuad_transcurrida_2 >= 270 && $ascecion_oblicuad_transcurrida_2 < 300):
                                    $antiscio_ascecion_oblicuad_transcurrida_2 = (300 - $ascecion_oblicuad_transcurrida_2) + 240;
                                    break;


                                case ($ascecion_oblicuad_transcurrida_2 >= 300 && $ascecion_oblicuad_transcurrida_2 < 330):
                                    $antiscio_ascecion_oblicuad_transcurrida_2 = (330 - $ascecion_oblicuad_transcurrida_2) + 210;
                                    break;
                                case ($ascecion_oblicuad_transcurrida_2 >= 330 && $ascecion_oblicuad_transcurrida_2 < 360):
                                    $antiscio_ascecion_oblicuad_transcurrida_2 = (360 - $ascecion_oblicuad_transcurrida_2) + 180;
                                    break;
                            }
                            switch ($ascension_oblique_2) {
                                case ($ascension_oblique_2 >= 0 && $ascension_oblique_2 < 30):
                                    $antiscio_ascension_oblique_2 = (30 - $ascension_oblique_2) + 150;
                                    break;

                                case ($ascension_oblique_2 >= 30 && $ascension_oblique_2 < 60):
                                    $antiscio_ascension_oblique_2 = (60 - $ascension_oblique_2) + 120;
                                    break;


                                case ($ascension_oblique_2 >= 60 && $ascension_oblique_2 < 90):
                                    $antiscio_ascension_oblique_2 = (90 - $ascension_oblique_2) + 90;
                                    break;



                                case ($ascension_oblique_2 >= 90 && $ascension_oblique_2 < 120):
                                    $antiscio_ascension_oblique_2 = (120 - $ascension_oblique_2) + 60;
                                    break;


                                case ($ascension_oblique_2 >= 120 && $ascension_oblique_2 < 150):
                                    $antiscio_ascension_oblique_2 = (150 - $ascension_oblique_2) + 30;
                                    break;


                                case ($ascension_oblique_2 >= 150 && $ascension_oblique_2 < 180):
                                    $antiscio_ascension_oblique_2 = (180 - $ascension_oblique_2) - 150;
                                    break;


                                case ($ascension_oblique_2 >= 180 && $ascension_oblique_2 < 210):
                                    $antiscio_ascension_oblique_2 = (210 - $ascension_oblique_2) + 330;
                                    break;


                                case ($ascension_oblique_2 >= 210 && $ascension_oblique_2 < 240):
                                    $antiscio_ascension_oblique_2 = (240 - $ascension_oblique_2) + 300;
                                    break;


                                case ($ascension_oblique_2 >= 240 && $ascension_oblique_2 < 270):
                                    $antiscio_ascension_oblique_2 = (270 - $ascension_oblique_2) + 270;
                                    break;



                                case ($ascension_oblique_2 >= 270 && $ascension_oblique_2 < 300):
                                    $antiscio_ascension_oblique_2 = (300 - $ascension_oblique_2) + 240;
                                    break;


                                case ($ascension_oblique_2 >= 300 && $ascension_oblique_2 < 330):
                                    $antiscio_ascension_oblique_2 = (330 - $ascension_oblique_2) + 210;
                                    break;
                                case ($ascension_oblique_2 >= 330 && $ascension_oblique_2 < 360):
                                    $antiscio_ascension_oblique_2 = (360 - $ascension_oblique_2) + 180;
                                    break;
                            }


                            if ($antiscio_ascecion_oblicuad_transcurrida_2 > 360) {
                                $antiscio_ascecion_oblicuad_transcurrida_2 = $antiscio_ascecion_oblicuad_transcurrida_2 - 360;
                            }



                            if ($antiscio_ascecion_oblicuad_transcurrida_2 >= 0 && $antiscio_ascecion_oblicuad_transcurrida_2 < 180) {

                                $opuesto_antiscio_ascension_oblicuad_transcurrida_2 = $antiscio_ascecion_oblicuad_transcurrida_2 + 180;
                            } else if ($antiscio_ascecion_oblicuad_transcurrida_2 >= 180 && $antiscio_ascecion_oblicuad_transcurrida_2 <= 360) {

                                $opuesto_antiscio_ascension_oblicuad_transcurrida_2 = ($antiscio_ascecion_oblicuad_transcurrida_2 + 180) - 360;
                            }

                            if ($antiscio_ascension_oblique_2 > 360) {
                                $antiscio_ascension_oblique_2 = $antiscio_ascension_oblique_2 - 360;
                            }

                            if ($antiscio_ascension_oblique_2 >= 0 && $antiscio_ascension_oblique_2 < 180) {
                                $opuesto_antiscio_ascension_oblique_2 = $antiscio_ascension_oblique_2 + 180;
                            } else if ($antiscio_ascension_oblique_2 >= 180 && $antiscio_ascension_oblique_2 <= 360) {
                                $opuesto_antiscio_ascension_oblique_2 = ($antiscio_ascension_oblique_2 + 180) - 360;
                            }




                            $dif_btwn_aotb_n_aoe_2 = abs($ascecion_oblicuad_transcurrida_2 - $ascension_oblique_2);
                            $dif_btwn_aotb_n_oaoe_2 = abs($ascecion_oblicuad_transcurrida_2 - $opuesto_ascecion_oblicuad_2);
                            $dif_btwn_aaot_n_aaoe_2 = abs($ascecion_oblicuad_transcurrida_2 - $antiscio_ascension_oblique_2);
                            $dif_btwn_aaot_n_oaaoe_2 = abs($ascecion_oblicuad_transcurrida_2 - $opuesto_antiscio_ascension_oblique_2);

                            $dif_btwn_aaotb_n_aoe_2 = abs($antiscio_ascecion_oblicuad_transcurrida_2 - $ascension_oblique_2);
                            $dif_btwn_aaotb_n_oaoe_2 = abs($antiscio_ascecion_oblicuad_transcurrida_2 - $opuesto_ascecion_oblicuad_2);
                            $dif_btwn_aaaot_n_aaoe_2 = abs($antiscio_ascecion_oblicuad_transcurrida_2 - $antiscio_ascension_oblique_2);
                            $dif_btwn_aaaot_n_oaaoe_2 = abs($antiscio_ascecion_oblicuad_transcurrida_2 - $opuesto_antiscio_ascension_oblique_2);

                            $long_difference_2 = 0.0;
                            $antiscio_difference_2 = 0.0;
                            $anti_born_long_event_difference_2 = 0.0;
                            $long_born_anti_event_difference_2 = 0.0;

                            $diff_acepted_2 = 0;




                            $array_difereces_ao_2 = array();




                            if ($dif_btwn_aotb_n_aoe_2 >= $variable_inicial_neg && $dif_btwn_aotb_n_aoe_2 <= $variable_inicial_pos || $dif_btwn_aotb_n_aoe_2 >= $variable_final_neg && $dif_btwn_aotb_n_aoe_2 <= $variable_final_pos) {
                                $diff_acepted_2 = 1;
                                array_push($array_difereces_ao_2, $dif_btwn_aotb_n_aoe_2);
                            } else if ($dif_btwn_aotb_n_oaoe_2 >= $variable_inicial_neg && $dif_btwn_aotb_n_oaoe_2 <= $variable_inicial_pos || $dif_btwn_aotb_n_oaoe_2 >= $variable_final_neg && $dif_btwn_aotb_n_oaoe_2 <= $variable_final_pos) {
                                $diff_acepted_2 = 1;
                                array_push($array_difereces_ao_2, $dif_btwn_aotb_n_oaoe_2);
                            } else if ($dif_btwn_aaot_n_aaoe_2 >= $variable_inicial_neg && $dif_btwn_aaot_n_aaoe_2 <= $variable_inicial_pos || $dif_btwn_aaot_n_aaoe_2 >= $variable_final_neg && $dif_btwn_aaot_n_aaoe_2 <= $variable_final_pos) {
                                $diff_acepted_2 = 1;
                                array_push($array_difereces_ao_2, $dif_btwn_aaot_n_aaoe_2);
                            } else if ($dif_btwn_aaot_n_oaaoe_2 >= $variable_inicial_neg && $dif_btwn_aaot_n_oaaoe_2 <= $variable_inicial_pos || $dif_btwn_aaot_n_oaaoe_2 >= $variable_final_neg && $dif_btwn_aaot_n_oaaoe_2 <= $variable_final_pos) {
                                $diff_acepted_2 = 1;
                                array_push($array_difereces_ao_2, $dif_btwn_aaot_n_oaaoe_2);
                            } else if ($dif_btwn_aaotb_n_aoe_2 >= $variable_inicial_neg && $dif_btwn_aaotb_n_aoe_2 <= $variable_inicial_pos || $dif_btwn_aaotb_n_aoe_2 >= $variable_final_neg && $dif_btwn_aaotb_n_aoe_2 <= $variable_final_pos) {
                                $diff_acepted_2 = 1;
                                array_push($array_difereces_ao_2, $dif_btwn_aaotb_n_aoe_2);
                            } else if ($dif_btwn_aaotb_n_oaoe_2 >= $variable_inicial_neg && $dif_btwn_aaotb_n_oaoe_2 <= $variable_inicial_pos || $dif_btwn_aaotb_n_oaoe_2 >= $variable_final_neg && $dif_btwn_aaotb_n_oaoe_2 <= $variable_final_pos) {
                                $diff_acepted_2 = 1;
                                array_push($array_difereces_ao_2, $dif_btwn_aaotb_n_oaoe_2);
                            } else if ($dif_btwn_aaaot_n_aaoe_2 >= $variable_inicial_neg && $dif_btwn_aaaot_n_aaoe_2 <= $variable_inicial_pos || $dif_btwn_aaaot_n_aaoe_2 >= $variable_final_neg && $dif_btwn_aaaot_n_aaoe_2 <= $variable_final_pos) {
                                $diff_acepted_2 = 1;
                                array_push($array_difereces_ao_2, $dif_btwn_aaaot_n_aaoe_2);
                            } else if ($dif_btwn_aaaot_n_oaaoe_2 >= $variable_inicial_neg && $dif_btwn_aaaot_n_oaaoe_2 <= $variable_inicial_pos || $dif_btwn_aaaot_n_oaaoe_2 >= $variable_final_neg && $dif_btwn_aaaot_n_oaaoe_2 <= $variable_final_pos) {
                                $diff_acepted_2 = 1;
                                array_push($array_difereces_ao_2, $dif_btwn_aaaot_n_oaaoe_2);
                            }


                            if ($diff_acepted_2 == 1) {

                                //***************************
                                //****COMPARO PLANETAS SIN IMPORTAR ORDEN ****
                                //***************************

                                $is_success_2 = 0;
                                foreach ($planets_list_event_born as $planet_born_event) {

                                    $long_born_event = floatval($planet_born_event["long"]);
                                    $asntiscio_born_event = floatval($planet_born_event["asntiscio"]);

                                    $dmo_planet_born_event = floatval($planet_born_event["meridian_oblique_distance"]);
                                    $name_planet_born_event = $planet_born_event["name"];




                                    foreach ($planets_list_event_2 as $planet_event_2) {


                                        $long_2 = floatval($planet_event_2["long"]);
                                        $asntiscio_2 = floatval($planet_event_2["asntiscio"]);


                                        $planet_name_2 = $planet_event_2["name"];
                                        $meridian_oblique_distance_2_event = floatval($planet_event_2["meridian_oblique_distance"]);



                                        $long_difference_2 = abs($long_born_event - $long_2);
                                        $long_born_anti_event_difference_2 = abs($long_born_event - $asntiscio_2);
                                        $anti_born_long_event_difference_2 = abs($asntiscio_born_event - $long_2);
                                        $antiscio_difference_2 = abs($asntiscio_born_event - $asntiscio_2);


                                        $long_difference_2_int = floatval($long_difference_2);
                                        $antiscio_difference_2_int = floatval($antiscio_difference_2);
                                        $long_born_anti_event_difference_2_int = floatval($long_born_anti_event_difference_2);
                                        $anti_born_long_event_difference_2_int = floatval($anti_born_long_event_difference_2);




                                        if ($long_difference_2_int <= 180) {

                                            if ($long_difference_2_int <= $rango_tolerancia && $long_difference_2_int >= -$rango_tolerancia) {
                                                $is_success_2 = 1;
                                            } else if ($long_difference_2_int <= (15 + $rango_tolerancia) && $long_difference_2_int >= (15 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            } else if ($long_difference_2_int <= (30 + $rango_tolerancia) && $long_difference_2_int >= (30 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            } else if ($long_difference_2_int <= (36 + $rango_tolerancia) && $long_difference_2_int >= (36 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            } else if ($long_difference_2_int <= (45 + $rango_tolerancia) && $long_difference_2_int >= (45 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            } else if ($long_difference_2_int <= (60 + $rango_tolerancia) && $long_difference_2_int >= (60 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            } else if ($long_difference_2_int <= (72 + $rango_tolerancia) && $long_difference_2_int >= (72 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            } else if ($long_difference_2_int <= (75 + $rango_tolerancia) && $long_difference_2_int >= (75 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            } else if ($long_difference_2_int <= (90 + $rango_tolerancia) && $long_difference_2_int >= (90 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            } else if ($long_difference_2_int <= (105 + $rango_tolerancia) && $long_difference_2_int >= (105 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            } else if ($long_difference_2_int <= (120 + $rango_tolerancia) && $long_difference_2_int >= (120 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            } else if ($long_difference_2_int <= (135 + $rango_tolerancia) && $long_difference_2_int >= (135 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            } else if ($long_difference_2_int <= (144 + $rango_tolerancia) && $long_difference_2_int >= (144 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            } else if ($long_difference_2_int <= (150 + $rango_tolerancia) && $long_difference_2_int >= (150 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            } else if ($long_difference_2_int <= (165 + $rango_tolerancia) && $long_difference_2_int >= (165 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            } else if ($long_difference_2_int <= (180 + $rango_tolerancia) && $long_difference_2_int >= (180 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            }
                                        }
                                        if ($antiscio_difference_2_int <= 180) {

                                            if ($antiscio_difference_2_int <= $rango_tolerancia && $antiscio_difference_2_int >= -$rango_tolerancia) {
                                                $is_success_2 = 1;
                                            } else if ($antiscio_difference_2_int <= (15 + $rango_tolerancia) && $antiscio_difference_2_int >= (15 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            } else if ($antiscio_difference_2_int <= (30 + $rango_tolerancia) && $antiscio_difference_2_int >= (30 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            } else if ($antiscio_difference_2_int <= (36 + $rango_tolerancia) && $antiscio_difference_2_int >= (36 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            } else if ($antiscio_difference_2_int <= (45 + $rango_tolerancia) && $antiscio_difference_2_int >= (45 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            } else if ($antiscio_difference_2_int <= (60 + $rango_tolerancia) && $antiscio_difference_2_int >= (60 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            } else if ($antiscio_difference_2_int <= (72 + $rango_tolerancia) && $antiscio_difference_2_int >= (72 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            } else if ($antiscio_difference_2_int <= (75 + $rango_tolerancia) && $antiscio_difference_2_int >= (75 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            } else if ($antiscio_difference_2_int <= (90 + $rango_tolerancia) && $antiscio_difference_2_int >= (90 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            } else if ($antiscio_difference_2_int <= (105 + $rango_tolerancia) && $antiscio_difference_2_int >= (105 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            } else if ($antiscio_difference_2_int <= (120 + $rango_tolerancia) && $antiscio_difference_2_int >= (120 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            } else if ($antiscio_difference_2_int <= (135 + $rango_tolerancia) && $antiscio_difference_2_int >= (135 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            } else if ($antiscio_difference_2_int <= (144 + $rango_tolerancia) && $antiscio_difference_2_int >= (144 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            } else if ($antiscio_difference_2_int <= (150 + $rango_tolerancia) && $antiscio_difference_2_int >= (150 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            } else if ($antiscio_difference_2_int <= (165 + $rango_tolerancia) && $antiscio_difference_2_int >= (165 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            } else if ($antiscio_difference_2_int <= (180 + $rango_tolerancia) && $antiscio_difference_2_int >= (180 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            }
                                        }
                                        if ($long_born_anti_event_difference_2_int <= 180) {

                                            if ($long_born_anti_event_difference_2_int <= $rango_tolerancia && $long_born_anti_event_difference_2_int >= -$rango_tolerancia) {
                                                $is_success_2 = 1;
                                            } else if ($long_born_anti_event_difference_2_int <= (15 + $rango_tolerancia) && $long_born_anti_event_difference_2_int >= (15 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            } else if ($long_born_anti_event_difference_2_int <= (30 + $rango_tolerancia) && $long_born_anti_event_difference_2_int >= (30 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            } else if ($long_born_anti_event_difference_2_int <= (36 + $rango_tolerancia) && $long_born_anti_event_difference_2_int >= (36 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            } else if ($long_born_anti_event_difference_2_int <= (45 + $rango_tolerancia) && $long_born_anti_event_difference_2_int >= (45 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            } else if ($long_born_anti_event_difference_2_int <= (60 + $rango_tolerancia) && $long_born_anti_event_difference_2_int >= (60 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            } else if ($long_born_anti_event_difference_2_int <= (72 + $rango_tolerancia) && $long_born_anti_event_difference_2_int >= (72 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            } else if ($long_born_anti_event_difference_2_int <= (75 + $rango_tolerancia) && $long_born_anti_event_difference_2_int >= (75 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            } else if ($long_born_anti_event_difference_2_int <= (90 + $rango_tolerancia) && $long_born_anti_event_difference_2_int >= (90 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            } else if ($long_born_anti_event_difference_2_int <= (105 + $rango_tolerancia) && $long_born_anti_event_difference_2_int >= (105 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            } else if ($long_born_anti_event_difference_2_int <= (120 + $rango_tolerancia) && $long_born_anti_event_difference_2_int >= (120 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            } else if ($long_born_anti_event_difference_2_int <= (135 + $rango_tolerancia) && $long_born_anti_event_difference_2_int >= (135 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            } else if ($long_born_anti_event_difference_2_int <= (144 + $rango_tolerancia) && $long_born_anti_event_difference_2_int >= (144 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            } else if ($long_born_anti_event_difference_2_int <= (150 + $rango_tolerancia) && $long_born_anti_event_difference_2_int >= (150 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            } else if ($long_born_anti_event_difference_2_int <= (165 + $rango_tolerancia) && $long_born_anti_event_difference_2_int >= (165 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            } else if ($long_born_anti_event_difference_2_int <= (180 + $rango_tolerancia) && $long_born_anti_event_difference_2_int >= (180 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            }
                                        }
                                        if ($anti_born_long_event_difference_2_int <= 180) {

                                            if ($anti_born_long_event_difference_2_int <= $rango_tolerancia && $anti_born_long_event_difference_2_int >= -$rango_tolerancia) {
                                                $is_success_2 = 1;
                                            } else if ($anti_born_long_event_difference_2_int <= (15 + $rango_tolerancia) && $anti_born_long_event_difference_2_int >= (15 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            } else if ($anti_born_long_event_difference_2_int <= (30 + $rango_tolerancia) && $anti_born_long_event_difference_2_int >= (30 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            } else if ($anti_born_long_event_difference_2_int <= (36 + $rango_tolerancia) && $anti_born_long_event_difference_2_int >= (36 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            } else if ($anti_born_long_event_difference_2_int <= (45 + $rango_tolerancia) && $anti_born_long_event_difference_2_int >= (45 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            } else if ($anti_born_long_event_difference_2_int <= (60 + $rango_tolerancia) && $anti_born_long_event_difference_2_int >= (60 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            } else if ($anti_born_long_event_difference_2_int <= (72 + $rango_tolerancia) && $anti_born_long_event_difference_2_int >= (72 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            } else if ($anti_born_long_event_difference_2_int <= (75 + $rango_tolerancia) && $anti_born_long_event_difference_2_int >= (75 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            } else if ($anti_born_long_event_difference_2_int <= (90 + $rango_tolerancia) && $anti_born_long_event_difference_2_int >= (90 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            } else if ($anti_born_long_event_difference_2_int <= (105 + $rango_tolerancia) && $anti_born_long_event_difference_2_int >= (105 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            } else if ($anti_born_long_event_difference_2_int <= (120 + $rango_tolerancia) && $anti_born_long_event_difference_2_int >= (120 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            } else if ($anti_born_long_event_difference_2_int <= (135 + $rango_tolerancia) && $anti_born_long_event_difference_2_int >= (135 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            } else if ($anti_born_long_event_difference_2_int <= (144 + $rango_tolerancia) && $anti_born_long_event_difference_2_int >= (144 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            } else if ($anti_born_long_event_difference_2_int <= (150 + $rango_tolerancia) && $anti_born_long_event_difference_2_int >= (150 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            } else if ($anti_born_long_event_difference_2_int <= (165 + $rango_tolerancia) && $anti_born_long_event_difference_2_int >= (165 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            } else if ($anti_born_long_event_difference_2_int <= (180 + $rango_tolerancia) && $anti_born_long_event_difference_2_int >= (180 - $rango_tolerancia)) {
                                                $is_success_2 = 1;
                                            }
                                        }
                                    }
                                }

                                if ($is_success_2 == 1) {
                                    $this->SWEPH_DIFERENCIA_2 = $DMO_PLANETA_NACIMIENTO - $DMO_PLANETA_EVENTO_2;


                                    echo "<br>**********EVENTO 2***************";
                                    echo "<br>" . $this->SWEPH_DIFERENCIA_2;
                                }
                            }
                        }
                    }



                    foreach ($planets_list_event_1 as $planet_event_1) {
                        $dmo_planet_event_1 = floatval($planet_event_1["meridian_oblique_distance"]);
                        $total_rest = $dmo_planet_born_event - $dmo_planet_event_1;
                        $total_rest_DIFERENCIA = $dmo_planet_born_event - $dmo_planet_event_1;
                        $name_planet_event_1 = $planet_event_1["name"];


                        $DMO_PLANETA_EVENTO = floatval($planet_event_1["meridian_oblique_distance"]);
                        $NOMBRE_PLANETA_EVENTO = $planet_event_1["name"];


                        $right_ascension_1 = floatval($planet_event_1["right_ascension"]);
                        $ascension_oblique_1 = floatval($planet_event_1["ascension_oblique"]);

                        $total = floatval($total_rest);

                        if ($total >= 0) {

                            $accept_negative = $aceept * (-1);

                            if ($total >= $accept_negative && $total <= $aceept) {
                                $true = 1;
                            }


                            if ($true === 1) {

                                $arco_trascurrido = $ARMC_event - $ARMC_born;

                                if ($arco_trascurrido < 0) {
                                    $arco_trascurrido = $arco_trascurrido + 360;
                                }

                                $ascecion_oblicuad_transcurrida = $ascension_oblique_born_event + $arco_trascurrido;

                                if ($ascecion_oblicuad_transcurrida > 360) {
                                    $ascecion_oblicuad_transcurrida = $ascecion_oblicuad_transcurrida - 360;
                                }


                                $opuesto_ascecion_oblicuad_transcurrida = 0.0;
                                if ($ascecion_oblicuad_transcurrida >= 0 && $ascecion_oblicuad_transcurrida < 180) {
                                    $opuesto_ascecion_oblicuad_transcurrida = $ascecion_oblicuad_transcurrida + 180;
                                } else if ($ascecion_oblicuad_transcurrida >= 180 && $ascecion_oblicuad_transcurrida <= 360) {
                                    $opuesto_ascecion_oblicuad_transcurrida = ($ascecion_oblicuad_transcurrida + 180) - 360;
                                }



                                if ($ascension_oblique_1 > 360) {
                                    $ascension_oblique_1 = $ascension_oblique_1 - 360;
                                }

                                $opuesto_ascecion_oblicuad_1 = 0.0;
                                if ($ascension_oblique_1 >= 0 && $ascension_oblique_1 < 180) {
                                    $opuesto_ascecion_oblicuad_1 = $ascension_oblique_1 + 180;
                                } else if ($ascension_oblique_1 >= 180 && $ascension_oblique_1 <= 360) {
                                    $opuesto_ascecion_oblicuad_1 = ($ascension_oblique_1 + 180) - 360;
                                }


                                $antiscio_ascecion_oblicuad_transcurrida = 0.0;
                                $antiscio_ascension_oblique_1 = 0.0;
                                $opuesto_antiscio_ascension_oblique_1 = 0.0;
                                $opuesto_antiscio_ascension_oblicuad_transcurrida = 0.0;

                                switch ($ascecion_oblicuad_transcurrida) {
                                    case ($ascecion_oblicuad_transcurrida >= 0 && $ascecion_oblicuad_transcurrida < 30):
                                        $antiscio_ascecion_oblicuad_transcurrida = (30 - $ascecion_oblicuad_transcurrida) + 150;
                                        break;

                                    case ($ascecion_oblicuad_transcurrida >= 30 && $ascecion_oblicuad_transcurrida < 60):
                                        $antiscio_ascecion_oblicuad_transcurrida = (60 - $ascecion_oblicuad_transcurrida) + 120;
                                        break;


                                    case ($ascecion_oblicuad_transcurrida >= 60 && $ascecion_oblicuad_transcurrida < 90):
                                        $antiscio_ascecion_oblicuad_transcurrida = (90 - $ascecion_oblicuad_transcurrida) + 90;
                                        break;

                                    case ($ascecion_oblicuad_transcurrida >= 90 && $ascecion_oblicuad_transcurrida < 120):
                                        $antiscio_ascecion_oblicuad_transcurrida = (120 - $ascecion_oblicuad_transcurrida) + 60;
                                        break;


                                    case ($ascecion_oblicuad_transcurrida >= 120 && $ascecion_oblicuad_transcurrida < 150):
                                        $antiscio_ascecion_oblicuad_transcurrida = (150 - $ascecion_oblicuad_transcurrida) + 30;
                                        break;


                                    case ($ascecion_oblicuad_transcurrida >= 150 && $ascecion_oblicuad_transcurrida < 180):
                                        $antiscio_ascecion_oblicuad_transcurrida = (180 - $ascecion_oblicuad_transcurrida) - 150;
                                        break;


                                    case ($ascecion_oblicuad_transcurrida >= 180 && $ascecion_oblicuad_transcurrida < 210):
                                        $antiscio_ascecion_oblicuad_transcurrida = (210 - $ascecion_oblicuad_transcurrida) + 330;
                                        break;


                                    case ($ascecion_oblicuad_transcurrida >= 210 && $ascecion_oblicuad_transcurrida < 240):
                                        $antiscio_ascecion_oblicuad_transcurrida = (240 - $ascecion_oblicuad_transcurrida) + 300;
                                        break;


                                    case ($ascecion_oblicuad_transcurrida >= 240 && $ascecion_oblicuad_transcurrida < 270):
                                        $antiscio_ascecion_oblicuad_transcurrida = (270 - $ascecion_oblicuad_transcurrida) + 270;
                                        break;



                                    case ($ascecion_oblicuad_transcurrida >= 270 && $ascecion_oblicuad_transcurrida < 300):
                                        $antiscio_ascecion_oblicuad_transcurrida = (300 - $ascecion_oblicuad_transcurrida) + 240;
                                        break;


                                    case ($ascecion_oblicuad_transcurrida >= 300 && $ascecion_oblicuad_transcurrida < 330):
                                        $antiscio_ascecion_oblicuad_transcurrida = (330 - $ascecion_oblicuad_transcurrida) + 210;
                                        break;
                                    case ($ascecion_oblicuad_transcurrida >= 330 && $ascecion_oblicuad_transcurrida < 360):
                                        $antiscio_ascecion_oblicuad_transcurrida = (360 - $ascecion_oblicuad_transcurrida) + 180;
                                        break;
                                }
                                switch ($ascension_oblique_1) {
                                    case ($ascension_oblique_1 >= 0 && $ascension_oblique_1 < 30):
                                        $antiscio_ascension_oblique_1 = (30 - $ascension_oblique_1) + 150;
                                        break;

                                    case ($ascension_oblique_1 >= 30 && $ascension_oblique_1 < 60):
                                        $antiscio_ascension_oblique_1 = (60 - $ascension_oblique_1) + 120;
                                        break;


                                    case ($ascension_oblique_1 >= 60 && $ascension_oblique_1 < 90):
                                        $antiscio_ascension_oblique_1 = (90 - $ascension_oblique_1) + 90;
                                        break;



                                    case ($ascension_oblique_1 >= 90 && $ascension_oblique_1 < 120):
                                        $antiscio_ascension_oblique_1 = (120 - $ascension_oblique_1) + 60;
                                        break;


                                    case ($ascension_oblique_1 >= 120 && $ascension_oblique_1 < 150):
                                        $antiscio_ascension_oblique_1 = (150 - $ascension_oblique_1) + 30;
                                        break;


                                    case ($ascension_oblique_1 >= 150 && $ascension_oblique_1 < 180):
                                        $antiscio_ascension_oblique_1 = (180 - $ascension_oblique_1) - 150;
                                        break;


                                    case ($ascension_oblique_1 >= 180 && $ascension_oblique_1 < 210):
                                        $antiscio_ascension_oblique_1 = (210 - $ascension_oblique_1) + 330;
                                        break;


                                    case ($ascension_oblique_1 >= 210 && $ascension_oblique_1 < 240):
                                        $antiscio_ascension_oblique_1 = (240 - $ascension_oblique_1) + 300;
                                        break;


                                    case ($ascension_oblique_1 >= 240 && $ascension_oblique_1 < 270):
                                        $antiscio_ascension_oblique_1 = (270 - $ascension_oblique_1) + 270;
                                        break;



                                    case ($ascension_oblique_1 >= 270 && $ascension_oblique_1 < 300):
                                        $antiscio_ascension_oblique_1 = (300 - $ascension_oblique_1) + 240;
                                        break;


                                    case ($ascension_oblique_1 >= 300 && $ascension_oblique_1 < 330):
                                        $antiscio_ascension_oblique_1 = (330 - $ascension_oblique_1) + 210;
                                        break;
                                    case ($ascension_oblique_1 >= 330 && $ascension_oblique_1 < 360):
                                        $antiscio_ascension_oblique_1 = (360 - $ascension_oblique_1) + 180;
                                        break;
                                }


                                if ($antiscio_ascecion_oblicuad_transcurrida > 360) {
                                    $antiscio_ascecion_oblicuad_transcurrida = $antiscio_ascecion_oblicuad_transcurrida - 360;
                                }



                                if ($antiscio_ascecion_oblicuad_transcurrida >= 0 && $antiscio_ascecion_oblicuad_transcurrida < 180) {
                                    $opuesto_antiscio_ascension_oblicuad_transcurrida = $antiscio_ascecion_oblicuad_transcurrida + 180;
                                } else if ($antiscio_ascecion_oblicuad_transcurrida >= 180 && $antiscio_ascecion_oblicuad_transcurrida <= 360) {
                                    $opuesto_antiscio_ascension_oblicuad_transcurrida = ($antiscio_ascecion_oblicuad_transcurrida + 180) - 360;
                                }

                                if ($antiscio_ascension_oblique_1 > 360) {
                                    $antiscio_ascension_oblique_1 = $antiscio_ascension_oblique_1 - 360;
                                }

                                if ($antiscio_ascension_oblique_1 >= 0 && $antiscio_ascension_oblique_1 < 180) {
                                    $opuesto_antiscio_ascension_oblique_1 = $antiscio_ascension_oblique_1 + 180;
                                } else if ($antiscio_ascension_oblique_1 >= 180 && $antiscio_ascension_oblique_1 <= 360) {
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

                                if ($dif_btwn_aotb_n_aoe >= $variable_inicial_neg && $dif_btwn_aotb_n_aoe <= $variable_inicial_pos || $dif_btwn_aotb_n_aoe >= $variable_final_neg && $dif_btwn_aotb_n_aoe <= $variable_final_pos) {
                                    $diff_acepted = 1;
                                    array_push($array_difereces_ao, $dif_btwn_aotb_n_aoe);
                                } else if ($dif_btwn_aotb_n_oaoe >= $variable_inicial_neg && $dif_btwn_aotb_n_oaoe <= $variable_inicial_pos || $dif_btwn_aotb_n_oaoe >= $variable_final_neg && $dif_btwn_aotb_n_oaoe <= $variable_final_pos) {
                                    $diff_acepted = 1;
                                    array_push($array_difereces_ao, $dif_btwn_aotb_n_oaoe);
                                } else if ($dif_btwn_aaot_n_aaoe >= $variable_inicial_neg && $dif_btwn_aaot_n_aaoe <= $variable_inicial_pos || $dif_btwn_aaot_n_aaoe >= $variable_final_neg && $dif_btwn_aaot_n_aaoe <= $variable_final_pos) {
                                    $diff_acepted = 1;
                                    array_push($array_difereces_ao, $dif_btwn_aaot_n_aaoe);
                                } else if ($dif_btwn_aaot_n_oaaoe >= $variable_inicial_neg && $dif_btwn_aaot_n_oaaoe <= $variable_inicial_pos || $dif_btwn_aaot_n_oaaoe >= $variable_final_neg && $dif_btwn_aaot_n_oaaoe <= $variable_final_pos) {
                                    $diff_acepted = 1;
                                    array_push($array_difereces_ao, $dif_btwn_aaot_n_oaaoe);
                                } else if ($dif_btwn_aaotb_n_aoe >= $variable_inicial_neg && $dif_btwn_aaotb_n_aoe <= $variable_inicial_pos || $dif_btwn_aaotb_n_aoe >= $variable_final_neg && $dif_btwn_aaotb_n_aoe <= $variable_final_pos) {
                                    $diff_acepted = 1;
                                    array_push($array_difereces_ao, $dif_btwn_aaotb_n_aoe);
                                } else if ($dif_btwn_aaotb_n_oaoe >= $variable_inicial_neg && $dif_btwn_aaotb_n_oaoe <= $variable_inicial_pos || $dif_btwn_aaotb_n_oaoe >= $variable_final_neg && $dif_btwn_aaotb_n_oaoe <= $variable_final_pos) {
                                    $diff_acepted = 1;
                                    array_push($array_difereces_ao, $dif_btwn_aaotb_n_oaoe);
                                } else if ($dif_btwn_aaaot_n_aaoe >= $variable_inicial_neg && $dif_btwn_aaaot_n_aaoe <= $variable_inicial_pos || $dif_btwn_aaaot_n_aaoe >= $variable_final_neg && $dif_btwn_aaaot_n_aaoe <= $variable_final_pos) {
                                    $diff_acepted = 1;
                                    array_push($array_difereces_ao, $dif_btwn_aaaot_n_aaoe);
                                } else if ($dif_btwn_aaaot_n_oaaoe >= $variable_inicial_neg && $dif_btwn_aaaot_n_oaaoe <= $variable_inicial_pos || $dif_btwn_aaaot_n_oaaoe >= $variable_final_neg && $dif_btwn_aaaot_n_oaaoe <= $variable_final_pos) {
                                    $diff_acepted = 1;
                                    array_push($array_difereces_ao, $dif_btwn_aaaot_n_oaaoe);
                                }




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
                                                } else if ($long_difference_int <= (150 + $rango_tolerancia) && $long_difference_int >= (150 - $rango_tolerancia)) {
                                                    $is_success = 1;
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
                                                } else if ($antiscio_difference_int <= (150 + $rango_tolerancia) && $antiscio_difference_int >= (150 - $rango_tolerancia)) {
                                                    $is_success = 1;
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
                                                } else if ($long_born_anti_event_difference_int <= (150 + $rango_tolerancia) && $long_born_anti_event_difference_int >= (150 - $rango_tolerancia)) {
                                                    $is_success = 1;
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
                                                } else if ($anti_born_long_event_difference_int <= (150 + $rango_tolerancia) && $anti_born_long_event_difference_int >= (150 - $rango_tolerancia)) {
                                                    $is_success = 1;
                                                } else if ($anti_born_long_event_difference_int <= (165 + $rango_tolerancia) && $anti_born_long_event_difference_int >= (165 - $rango_tolerancia)) {
                                                    $is_success = 1;
                                                } else if ($anti_born_long_event_difference_int <= (180 + $rango_tolerancia) && $anti_born_long_event_difference_int >= (180 - $rango_tolerancia)) {
                                                    $is_success = 1;
                                                }
                                            }
                                        }
                                    }

                                    if ($is_success == 1) {
                                        $this->SWEPH_DIFERENCIA_1 = $DMO_PLANETA_NACIMIENTO - $DMO_PLANETA_EVENTO;


                                        echo "<br>**********EVENTO 1***************";
                                        echo "<br>" . $this->SWEPH_DIFERENCIA_1;
                                    }
                                }
                            }
                        }
                    }



//                    if ($this->SWEPH_DIFERENCIA_1 < 0 && $this->SWEPH_DIFERENCIA_2 < 0) {
//                        echo "<br>**************************";
//                        echo "<br> DIFERENCIA_1---->" . $this->SWEPH_DIFERENCIA_1;
//                        echo "<br> DIFERENCIA_2---->" . $this->SWEPH_DIFERENCIA_2;
//                        echo "<br>**************************";
//                    } else if ($this->SWEPH_DIFERENCIA_1 > 0 && $this->SWEPH_DIFERENCIA_2 > 0) {
//                        echo "<br>**************************";
//                        echo "<br> DIFERENCIA_1---->" . $this->SWEPH_DIFERENCIA_1;
//                        echo "<br> DIFERENCIA_2---->" . $this->SWEPH_DIFERENCIA_2;
//                        echo "<br>**************************";
//                    }
                }
            }
        }
    }

}
