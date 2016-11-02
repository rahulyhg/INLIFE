<?php

header("Cache-Control: no-cache, no-store, must-revalidate, post-check=0, pre-check=0");
header("Pragma: no-cache");
header('Access-Control-Allow-Origin: *');

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sweph_get_data_user_rest extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('../controllers/inLife_DAO/swiss_ephemeris_transactional');
    }

    function index() {
        
    }

    public function data_compare_events($data_event_born, $data_event_1, $data_event_2, $data_event_3) {

        $data_event_born_planets = $data_event_born["planets"];
        $data_event_1_planets = $data_event_1["planets"];
        $data_event_2_planets = $data_event_2["planets"];
        $data_event_3_planets = $data_event_3["planets"];



        foreach ($data_event_born_planets as $planet_event_born) {
            foreach ($data_event_1_planets as $planet_event_1) {


                $meridian_oblique_distance_event_born = floatval($planet_event_born["meridian_oblique_distance"]);
                $meridian_oblique_distance_event_1 = floatval($data_event_1_planets["meridian_oblique_distance"]);



                echo "*************************************<br>";
                echo "<br>meridian_oblique_distance_event_born---->" . $meridian_oblique_distance_event_born;
                echo "<br>meridian_oblique_distance_event_1---->" . $meridian_oblique_distance_event_1;
                echo "*************************************<br>";
            }
        }
    }

    public function get_sweph_user_data($array) {


        $data_execute_ephemeris = json_decode($this->swiss_ephemeris_transactional->get_user_atral_ephemeride_data($array));
        $json_ephemeris_return = $this->format_epheris_user_data($data_execute_ephemeris, $array['lat']);
        $json_ephemeris_new_calculate = $this->generate_new_epheris_user_data($json_ephemeris_return, $array['lat']);

        return $json_ephemeris_new_calculate;
    }

    public function generate_new_epheris_user_data($json_ephemeris_return, $geografic_born_lat) {

        $json_meridian_distance_planets_array = $this->calculate_meridian_distance_planets($json_ephemeris_return);
        $json_ascencional_difference_planets_array = $this->calculate_ascencional_difference_planets($json_meridian_distance_planets_array, $geografic_born_lat);
        $json_semi_arc_planets_array = $this->calculate_semi_arc_planets($json_ascencional_difference_planets_array);
        $json_meridian_oblique_distance_array = $this->calculate_meridian_oblique_distance_planets($json_semi_arc_planets_array);
        $json_ascension_oblique_distance_array = $this->calculate_ascension_oblique_planets($json_meridian_oblique_distance_array, $geografic_born_lat);
        $json_ascension_anticios_array = $this->calculate_anticios_planets($json_ascension_oblique_distance_array);
        return $json_ascension_anticios_array;
    }

    public function calculate_fortune_wheel($born_lat, $ascendent_long_strgin, $sun_long_strgin, $moon_long_strgin, $eliptic_obliquity_strgin, $armc_long, $house_1_oblique_ascension, $house_4_oblique_ascension, $house_7_oblique_ascension) {

        $ascendent_long = floatval($ascendent_long_strgin);
        $sun_long = floatval($sun_long_strgin);
        $moon_long = floatval($moon_long_strgin);
        $eliptic_obliquity = floatval($eliptic_obliquity_strgin);


        $wheel_fortune_long = ($ascendent_long + $moon_long) - $sun_long;

        if ($wheel_fortune_long < 0) {
            $wheel_fortune_long = $wheel_fortune_long + 360;
        }



        $wheel_fortune_long_correct = 0;
        if ($wheel_fortune_long > 360) {
            $wheel_fortune_long_correct = $wheel_fortune_long - 360;
        } else {
            $wheel_fortune_long_correct = $wheel_fortune_long;
        }

        $tan_wheel_fortune_long = abs(tan(deg2rad($wheel_fortune_long_correct)));


        $log_tan_wheel_fortune_long = log10($tan_wheel_fortune_long);

        $cos_eliptic_obliquity = cos(deg2rad($eliptic_obliquity));
        $log_cos_eliptic_obliquity = log10($cos_eliptic_obliquity);
        $v1 = $log_tan_wheel_fortune_long + $log_cos_eliptic_obliquity;
        $inv_log_sum = pow(10, $v1);
        $atan_inv_log_sum = atan($inv_log_sum);
        $right_ascension_in_cuadrant = rad2deg($atan_inv_log_sum);

        $right_ascension = $right_ascension_in_cuadrant;


        if ($wheel_fortune_long_correct > 90 && $wheel_fortune_long_correct < 180) {
            $right_ascension = 180 - $right_ascension_in_cuadrant;
        } else if ($wheel_fortune_long_correct > 180 && $wheel_fortune_long_correct < 270) {
            $right_ascension = 180 + $right_ascension_in_cuadrant;
        } else if ($wheel_fortune_long_correct > 270 && $wheel_fortune_long_correct < 360) {
            $right_ascension = 360 - $right_ascension_in_cuadrant;
        }


        $ARMC = floatval($armc_long);
        $house_1_oblique_ascension = floatval($house_1_oblique_ascension);
        $house_4_oblique_ascension = floatval($house_4_oblique_ascension);
        $house_7_oblique_ascension = floatval($house_7_oblique_ascension);
        $planet_right_ascension = $right_ascension;
        $planet_meridian_distance_neg = 0.0;



        if ($house_1_oblique_ascension > $house_7_oblique_ascension) {

            if ($planet_right_ascension > $house_7_oblique_ascension && $planet_right_ascension < $house_1_oblique_ascension) {
                $planet_meridian_distance_neg = $ARMC - $planet_right_ascension;
            } else {
                $planet_meridian_distance_neg = $planet_right_ascension - $house_4_oblique_ascension;
            }
        } else {
            if ($planet_right_ascension > $house_1_oblique_ascension && $planet_right_ascension < $house_7_oblique_ascension) {
                $planet_meridian_distance_neg = $planet_right_ascension - $house_4_oblique_ascension;
            } else {

                $planet_meridian_distance_neg = $ARMC - $planet_right_ascension;
            }
        }

        $planet_meridian_distance = abs($planet_meridian_distance_neg);
        $planet_meridian_distance_modify = $planet_meridian_distance;

        if ($planet_meridian_distance >= 90 && $planet_meridian_distance <= 180) {
            $planet_meridian_distance_modify = $planet_meridian_distance - 180;
        } else if ($planet_meridian_distance >= 180 && $planet_meridian_distance <= 270) {
            $planet_meridian_distance_modify = $planet_meridian_distance - 270;
        } else if ($planet_meridian_distance >= 270 && $planet_meridian_distance <= 360) {
            $planet_meridian_distance_modify = $planet_meridian_distance - 360;
        }
        $planet_meridian_distance_modify_abs = abs($planet_meridian_distance_modify);

        $planet_meridian_distance_abs = abs($planet_meridian_distance_modify_abs);



        $meridian_distance = strval($planet_meridian_distance_abs);



        $abs_wheel_fortune_long = abs(deg2rad($wheel_fortune_long_correct));
        $sin_abs_wheel_fortune_long = sin($abs_wheel_fortune_long);
        $wheel_fortune_long_log_sin = log10(abs($sin_abs_wheel_fortune_long));


        $abs_eliptic_obliquity = abs(deg2rad($eliptic_obliquity));
        $sin_abs_eliptic_obliquity = abs(sin($abs_eliptic_obliquity));
        $wheel_sin_abs_eliptic_obliquity = log10($sin_abs_eliptic_obliquity);



        $suma_total = $wheel_fortune_long_log_sin + $wheel_sin_abs_eliptic_obliquity;



        $inv_log_suma_total = pow(10, $suma_total);

        $declination_wheel = rad2deg(asin($inv_log_suma_total));



        $data_wheel_fortune = array(
            "name" => "wheel_fortune",
            "long" => $wheel_fortune_long_correct,
            "right_ascension" => $right_ascension,
            "lat" => $born_lat,
            "zodiac_sign" => 0.0,
            "zodiac_sign_position" => 0.0,
            "declination" => $declination_wheel,
            "meridian_distance" => $meridian_distance,
            "ascencional_difference" => 0.0,
            "semi_arc" => 0.0,
            "meridian_oblique_distance" => 0.0
        );



        $json_ascencional_difference_planets_array = $this->calculate_ascencional_difference_wheel($data_wheel_fortune, $born_lat);
        $json_semi_arc_planets_array = $this->calculate_semi_arc_planets_wheel($json_ascencional_difference_planets_array);
        $json_meridian_oblique_distance_array = $this->calculate_meridian_oblique_distance_wheel($json_semi_arc_planets_array);



        return $json_meridian_oblique_distance_array;
    }

    public function calculate_ascencional_difference_wheel($json_ephemeris_return, $geografic_born_lat) {



        $lat = floatval($geografic_born_lat);


        $planet_declination = floatval($json_ephemeris_return["declination"]);
        $tan_log_rad_planet_declination = log10(tan(deg2rad(abs($planet_declination))));
        $tan_log_radian_planet_lat = log10(tan(deg2rad($lat)));
        $sum_tan_log_lat_declination_planet = $tan_log_rad_planet_declination + $tan_log_radian_planet_lat;
        $inv_log_sum_declination_n_lat = pow(10, $sum_tan_log_lat_declination_planet);
        $inv_sen_inv_log_sum_declination_n_lat = rad2deg(asin($inv_log_sum_declination_n_lat));




        $json_ephemeris_return["ascencional_difference"] = strval($inv_sen_inv_log_sum_declination_n_lat);




        return $json_ephemeris_return;
    }

    public function calculate_ascencional_difference_planets($json_ephemeris_return, $geografic_born_lat) {


        $geografic_born_lat_replace = str_replace("+", "", $geografic_born_lat);
        $lat = floatval($geografic_born_lat_replace);
        $planets_arrary = $json_ephemeris_return["planets"];


        foreach ($planets_arrary as $key => $planet) {
            $planet_declination = floatval($planet["declination"]);
            $tan_log_rad_planet_declination = log10(tan(deg2rad(abs($planet_declination))));
            $tan_log_radian_planet_lat = log10(tan(deg2rad($lat)));
            $sum_tan_log_lat_declination_planet = $tan_log_rad_planet_declination + $tan_log_radian_planet_lat;
            $inv_log_sum_declination_n_lat = pow(10, $sum_tan_log_lat_declination_planet);
            $inv_sen_inv_log_sum_declination_n_lat = rad2deg(asin($inv_log_sum_declination_n_lat));




            $planets_arrary[$key]["ascencional_difference"] = strval($inv_sen_inv_log_sum_declination_n_lat);
        }

        $json_ephemeris_return["planets"] = $planets_arrary;

        return $json_ephemeris_return;
    }
    
    
    
    
    
    
    
    
    

    public function get_aspects_by_planets($planets_arrary, $id_user) {
        $this->swiss_ephemeris_transactional->get_aspects_by_planets($planets_arrary, $id_user);
    }

    public function store_ascendant($ascendant, $id_user) {
        $this->swiss_ephemeris_transactional->store_ascendant($ascendant, $id_user);
    }

    public function store_armc($ARMC, $id_user) {
        $this->swiss_ephemeris_transactional->store_armc($ARMC, $id_user);
    }
    public function store_eliptic_obliquity($eliptic_obliquity, $id_user) {
        $this->swiss_ephemeris_transactional->store_eliptic_obliquity($eliptic_obliquity, $id_user);
    }
    public function store_mc($MC, $id_user) {
        $this->swiss_ephemeris_transactional->store_mc($MC, $id_user);
    }

    public function store_houses($houses_arrary, $id_user) {
        $this->swiss_ephemeris_transactional->store_houses($houses_arrary, $id_user);
    }

    public function store_planets($planets_arrary, $id_user) {  

        $this->swiss_ephemeris_transactional->store_planet($planets_arrary, $id_user);


        $sun_sign_letter = $planets_arrary[0]["zodiac_sign"];
        $sun_zondiac_position = $planets_arrary[0]["zodiac_sign_position"];



        $signo_sol = 0;
        switch ($sun_sign_letter) {
            case "ar":
                $signo_sol = 1;
                break;
            case "ta":
                $signo_sol = 2;
                break;
            case "ge":
                $signo_sol = 3;
                break;
            case "cn":
                $signo_sol = 4;
                break;
            case "le":
                $signo_sol = 5;
                break;
            case "vi":
                $signo_sol = 6;
                break;
            case "li":
                $signo_sol = 7;
                break;
            case "sc":
                $signo_sol = 8;
                break;
            case "sa":
                $signo_sol = 9;
                break;
            case "cp":
                $signo_sol = 10;
                break;
            case "aq":
                $signo_sol = 11;
                break;
            case "pi":
                $signo_sol = 12;
                break;
            case 0:
                $signo_sol = 1;
                break;
        }

        //$long_converter_array = $this->_decimal_to_dms($sun_zondiac_position);
        //$sun_long_hour = $long_converter_array["deg"];
        
        
        
        $var_float = floatval($sun_zondiac_position);
        
        $var_int = intval($var_float);
        
        $var_int_total = 0;
        
        if($var_float > $var_int){
            $var_int_total = $var_int +1;
        }

        $this->swiss_ephemeris_transactional->store_id_components($var_int_total, $signo_sol, $id_user);
    }





    public function calculate_semi_arc_planets($json_ephemeris_return) {

        $planets_arrary = $json_ephemeris_return["planets"];

        foreach ($planets_arrary as $key => $planet) {
            $planet_ascencional_difference = floatval($planet["ascencional_difference"]);

            $sin_planet_ascencional_difference = sin(deg2rad($planet_ascencional_difference));
            $inv_cos_sin_planet_ascencional_difference = rad2deg(acos($sin_planet_ascencional_difference));

            $planets_arrary[$key]["semi_arc"] = strval($inv_cos_sin_planet_ascencional_difference);
        }

        $json_ephemeris_return["planets"] = $planets_arrary;


        return $json_ephemeris_return;
    }

    public function calculate_semi_arc_planets_wheel($json_ephemeris_return) {


        $planet_ascencional_difference = floatval($json_ephemeris_return["ascencional_difference"]);

        $sin_planet_ascencional_difference = sin(deg2rad($planet_ascencional_difference));
        $inv_cos_sin_planet_ascencional_difference = rad2deg(acos($sin_planet_ascencional_difference));

        $json_ephemeris_return["semi_arc"] = strval($inv_cos_sin_planet_ascencional_difference);

        return $json_ephemeris_return;
    }

    public function calculate_meridian_oblique_distance_planets($json_ephemeris_return) {

        $planets_arrary = $json_ephemeris_return["planets"];

        foreach ($planets_arrary as $key => $planet) {

            $planet_meridian_distance = abs(floatval($planet["meridian_distance"]));




            $log_planet_meridian_distance = log10($planet_meridian_distance);
            $planet_semi_arc = floatval($planet["semi_arc"]);
            $log_planet_semi_arc = log10($planet_semi_arc);
            $log90 = log10(90);
            $total = ($log_planet_meridian_distance - $log_planet_semi_arc) + $log90;




            $meridian_oblique_distance_planet = pow(10, $total);

            $planets_arrary[$key]["meridian_oblique_distance"] = strval($meridian_oblique_distance_planet);
        }

        $json_ephemeris_return["planets"] = $planets_arrary;
        return $json_ephemeris_return;
    }

    public function calculate_ascension_oblique_planets_old($json_ephemeris_return) {

        $planets_arrary = $json_ephemeris_return["planets"];
        $houses_arrary = $json_ephemeris_return["houses"];
        $armc = $json_ephemeris_return["ARMC"];



        $house_1_oblique_ascension = $houses_arrary[0]["oblique_ascension"];
        $house_4_oblique_ascension = $houses_arrary[3]["oblique_ascension"];
        $house_7_oblique_ascension = $houses_arrary[6]["oblique_ascension"];
        $house_10_oblique_ascension = $houses_arrary[9]["oblique_ascension"];

        $ARMC = floatval($armc["long"]);
        $house_1_oblique_ascension = floatval($house_1_oblique_ascension);
        $house_4_oblique_ascension = floatval($house_4_oblique_ascension);
        $house_7_oblique_ascension = floatval($house_7_oblique_ascension);
        $house_10_oblique_ascension = floatval($house_10_oblique_ascension);

        $house4_90 = $house_4_oblique_ascension + 90;

        if ($house4_90 > 360) {
            $house4_90 = $house4_90 - 360;
        }



        foreach ($planets_arrary as $key => $planet) {

            $planet_right_ascension = abs(floatval($planet["right_ascension"]));
            $planet_meridian_oblique_distance = abs(floatval($planet["meridian_oblique_distance"]));
            $ascension_oblique = 0.0;


            echo "<br><br><br>planeta--->" . $planet["name"];

            echo "<br>planet_meridian_oblique_distance->" . $planet_meridian_oblique_distance;
            echo " <br>7--->" . $house_7_oblique_ascension;
            echo " <br>4--->" . $house_4_oblique_ascension;
            echo " <br>1--->" . $house_1_oblique_ascension;
            echo " <br>10--->" . $house_10_oblique_ascension;


            if ($house_1_oblique_ascension > $house_7_oblique_ascension) {

                if ($planet_right_ascension > $house_7_oblique_ascension && $planet_right_ascension < $house_1_oblique_ascension) {
                    //arriba 

                    echo "<br>arriba--1->";
                    if ($planet_right_ascension > $ARMC) {
                        $ascension_oblique = $planet_meridian_oblique_distance + $ARMC;
                    } else {
                        $ascension_oblique = $ARMC - $planet_meridian_oblique_distance;
                    }
                } else {
                    //abajo 
                    echo "<br>abajo-1-->";

                    if ($planet_right_ascension > $house_4_oblique_ascension && $planet_right_ascension <= 360) {
                        $ascension_oblique = $planet_meridian_oblique_distance + $house_4_oblique_ascension;
                    } else if ($planet_right_ascension > 0 && $planet_right_ascension <= $house_7_oblique_ascension) {
                        if (($planet_right_ascension + 360) > $house_4_oblique_ascension) {
                            $ascension_oblique = $planet_meridian_oblique_distance + $house_4_oblique_ascension;
                        }
                    } else {
                        $ascension_oblique = $house_4_oblique_ascension - $planet_meridian_oblique_distance;
                    }
                }
            } else {
                if ($planet_right_ascension > $house_1_oblique_ascension && $planet_right_ascension < $house_7_oblique_ascension) {
                    //arriba 

                    echo "<br>arriba--1->";



                    if ($planet_right_ascension > $house_4_oblique_ascension && $planet_right_ascension <= 360) {
                        $ascension_oblique = $planet_meridian_oblique_distance + $ARMC;
                    } else if ($planet_right_ascension > 0 && $planet_right_ascension <= $house_1_oblique_ascension) {
                        if (($planet_right_ascension + 360) > $house_10_oblique_ascension) {
                            
                        }
                    }







                    if ($planet_right_ascension > $ARMC) {
                        $ascension_oblique = $planet_meridian_oblique_distance + $ARMC;
                    } else {
                        $ascension_oblique = $ARMC - $planet_meridian_oblique_distance;
                    }
                } else {
                    //abajo 
                    echo "<br>abajo-1-->";

                    if ($planet_right_ascension > $house_4_oblique_ascension && $planet_right_ascension <= 360) {
                        $ascension_oblique = $planet_meridian_oblique_distance + $house_4_oblique_ascension;
                    } else if ($planet_right_ascension > 0 && $planet_right_ascension <= $house_7_oblique_ascension) {
                        if (($planet_right_ascension + 360) > $house_4_oblique_ascension) {
                            $ascension_oblique = $planet_meridian_oblique_distance + $house_4_oblique_ascension;
                        }
                    } else {
                        $ascension_oblique = $house_4_oblique_ascension - $planet_meridian_oblique_distance;
                    }
                }
            }

            if ($ascension_oblique > 360) {
                $ascension_oblique = $ascension_oblique - 360;
            }
            echo "  <br>right_ascension--->" . $planet_right_ascension;
            echo "  <br>ascension_oblique--->" . $ascension_oblique;
            $planets_arrary[$key]["ascension_oblique"] = strval($ascension_oblique);
        }

        $json_ephemeris_return["planets"] = $planets_arrary;
        return $json_ephemeris_return;
    }

    public function calculate_ascension_oblique_planets($json_ephemeris_return, $geografic_born_lat) {

        $planets_arrary = $json_ephemeris_return["planets"];

        $geografic_born_lat = abs(floatval($geografic_born_lat));




        foreach ($planets_arrary as $key => $planet) {


            $planet_meridian_oblique_distance = abs(floatval($planet["meridian_oblique_distance"]));
            $declination = abs(floatval($planet["declination"]));
            $planet_right_ascension = abs(floatval($planet["right_ascension"]));

            $log_90 = log10(90);
            $log_dmo = log10($planet_meridian_oblique_distance);



            $lat_tan = tan(deg2rad($geografic_born_lat));
            $lat_tan_log = log10($lat_tan);

            $difetrecn_dmo_90 = $log_dmo - $log_90;

            $sum_dmo_90_lat = $difetrecn_dmo_90 + $lat_tan_log;



            $sum_dmo_90_lat_inv_log = pow(10, $sum_dmo_90_lat);


            $sum_dmo_90_lat_inv_log_inv_tan = rad2deg(atan($sum_dmo_90_lat_inv_log));






            $sum_dmo_90_lat_inv_log_inv_tan_tan = tan(deg2rad($sum_dmo_90_lat_inv_log_inv_tan));
            $sum_dmo_90_lat_inv_log_inv_tan_tan_log = log10($sum_dmo_90_lat_inv_log_inv_tan_tan);


            $declination_tan = tan(deg2rad($declination));
            $declination_tan_log = log10($declination_tan);




            $a = $sum_dmo_90_lat_inv_log_inv_tan_tan_log + $declination_tan_log;

            $b = pow(10, $a);


            $da_ptp = rad2deg(asin($b));

            $ascension_oblique_planet = 0.0;

            if ($planet_right_ascension > 0 && $planet_right_ascension < 90) {
                $ascension_oblique_planet = $planet_right_ascension + $da_ptp;
            } else if ($planet_right_ascension > 180 && $planet_right_ascension < 270) {
                $ascension_oblique_planet = $planet_right_ascension + $da_ptp;
            } else if ($planet_right_ascension > 90 && $planet_right_ascension < 180) {
                $ascension_oblique_planet = $planet_right_ascension - $da_ptp;
            } else if ($planet_right_ascension > 270 && $planet_right_ascension < 360) {
                $ascension_oblique_planet = $planet_right_ascension - $da_ptp;
            }

            $planets_arrary[$key]["ascension_oblique"] = strval($ascension_oblique_planet);
        }

        $json_ephemeris_return["planets"] = $planets_arrary;
        return $json_ephemeris_return;
    }

    public function calculate_anticios_planets($json_ephemeris_return) {

        $planets_arrary = $json_ephemeris_return["planets"];

        foreach ($planets_arrary as $key => $planet) {


            $planet_long = abs(floatval($planet["long"]));

            $planet_antiscio = 0.0;

            switch ($planet_long) {
                case ($planet_long > 0 && $planet_long < 30):
                    $planet_antiscio = (30 - $planet_long) + 150;
                    break;

                case ($planet_long > 30 && $planet_long < 60):
                    $planet_antiscio = (60 - $planet_long) + 120;
                    break;


                case ($planet_long > 60 && $planet_long < 90):
                    $planet_antiscio = (90 - $planet_long) + 90;
                    break;



                case ($planet_long > 90 && $planet_long < 120):
                    $planet_antiscio = (120 - $planet_long) + 60;
                    break;


                case ($planet_long > 120 && $planet_long < 150):
                    $planet_antiscio = (150 - $planet_long) + 30;
                    break;


                case ($planet_long > 150 && $planet_long < 180):
                    $planet_antiscio = (180 - $planet_long) - 150;
                    break;


                case ($planet_long > 180 && $planet_long < 210):
                    $planet_antiscio = (210 - $planet_long) + 330;
                    break;


                case ($planet_long > 210 && $planet_long < 240):
                    $planet_antiscio = (240 - $planet_long) + 300;
                    break;


                case ($planet_long > 240 && $planet_long < 270):
                    $planet_antiscio = (270 - $planet_long) + 270;
                    break;



                case ($planet_long > 270 && $planet_long < 300):
                    $planet_antiscio = (300 - $planet_long) + 240;
                    break;


                case ($planet_long > 300 && $planet_long < 330):
                    $planet_antiscio = (330 - $planet_long) + 210;
                    break;
                case ($planet_long > 330 && $planet_long < 360):
                    $planet_antiscio = (360 - $planet_long) + 180;
                    break;
            }

            $planets_arrary[$key]["asntiscio"] = strval($planet_antiscio);
        }

        $json_ephemeris_return["planets"] = $planets_arrary;
        return $json_ephemeris_return;
    }

    public function calculate_meridian_oblique_distance_wheel($json_ephemeris_return) {





        $planet_meridian_distance = abs(floatval($json_ephemeris_return["meridian_distance"]));
        $log_planet_meridian_distance = log10($planet_meridian_distance);
        $planet_semi_arc = floatval($json_ephemeris_return["semi_arc"]);
        $log_planet_semi_arc = log10($planet_semi_arc);
        $log90 = log10(90);
        $total = ($log_planet_meridian_distance - $log_planet_semi_arc) + $log90;




        $meridian_oblique_distance_planet = pow(10, $total);

        $json_ephemeris_return["meridian_oblique_distance"] = strval($meridian_oblique_distance_planet);

        return $json_ephemeris_return;
    }

    public function calculate_meridian_distance_planets($json_ephemeris_return) {
        $houses_arrary = $json_ephemeris_return["houses"];
        $planets_arrary = $json_ephemeris_return["planets"];

        $ARMC = floatval($json_ephemeris_return["ARMC"]["long"]);
        $house_1_oblique_ascension = floatval($houses_arrary[0]["oblique_ascension"]);
        $house_4_oblique_ascension = floatval($houses_arrary[3]["oblique_ascension"]);
        $house_7_oblique_ascension = floatval($houses_arrary[6]["oblique_ascension"]);

        foreach ($planets_arrary as $key => $planet) {

            $planet_right_ascension = abs(floatval($planet["right_ascension"]));
            $planet_meridian_distance_neg = 0.0;






            if ($house_1_oblique_ascension > $house_7_oblique_ascension) {




                if ($planet_right_ascension > $house_7_oblique_ascension && $planet_right_ascension < $house_1_oblique_ascension) {


                    $planet_meridian_distance_neg = $ARMC - $planet_right_ascension;
                } else {
                    $planet_meridian_distance_neg = $planet_right_ascension - $house_4_oblique_ascension;
                }
            } else {
                if ($planet_right_ascension > $house_1_oblique_ascension && $planet_right_ascension < $house_7_oblique_ascension) {
                    $planet_meridian_distance_neg = $planet_right_ascension - $house_4_oblique_ascension;
                } else {

                    $planet_meridian_distance_neg = $ARMC - $planet_right_ascension;
                }
            }




            $planet_meridian_distance = abs($planet_meridian_distance_neg);




            $planet_meridian_distance_modify = $planet_meridian_distance;

            if ($planet_meridian_distance >= 90 && $planet_meridian_distance <= 180) {


                $planet_meridian_distance_modify = 180 - $planet_meridian_distance;
            } else if ($planet_meridian_distance >= 180 && $planet_meridian_distance <= 270) {

                $planet_meridian_distance_modify = 270 - $planet_meridian_distance;
            } else if ($planet_meridian_distance >= 270 && $planet_meridian_distance <= 360) {

                $planet_meridian_distance_modify = 360 - $planet_meridian_distance;
            }


            $planet_meridian_distance_modify_abs = abs($planet_meridian_distance_modify);






            $planets_arrary[$key]["meridian_distance"] = strval($planet_meridian_distance_modify_abs);
        }
        $json_ephemeris_return["planets"] = $planets_arrary;

        return $json_ephemeris_return;
    }

    public function format_epheris_user_data($data_execute_return, $born_lat) {


        $born_lat_format = str_replace("+", "", $born_lat);

        $ephe_count = 0;
        $ephe_planets_array = array();
        $ephe_houses_array = array();
        $ascendat = "";

        $mc = "";
        $armc = "";

        foreach ($data_execute_return as $line) {





            $ephe_line_format = str_replace("'", " ", $line);
            $ephe_line = preg_replace('/\s\s+/', ' ', $ephe_line_format);

            if ($ephe_count > 6 && $ephe_count < 18) {
                //MESSAGE: position 8 to 17 is the planet ephemeride data 
                $planet_format_array = $this->generate_planet_format_array($ephe_line);
                array_push($ephe_planets_array, $planet_format_array);
            } else if ($ephe_count == 18) {
                //MESSAGE: Ecl. Obl
                $eliptic_obliquity = $this->generate_eliptic_obliquity_array($ephe_line);
            } else if ($ephe_count > 18 && $ephe_count < 31) {
                //MESSAGE: Houses
                $house_format_array = $this->generate_house_format_array($ephe_line);
                array_push($ephe_houses_array, $house_format_array);
            } else if ($ephe_count == 31) {
                //MESSAGE: Ascendant
                $ascendat = $this->generate_generic_format_array($ephe_line);
            } else if ($ephe_count == 32) {
                //MESSAGE: Medium Sky
                $mc = $this->generate_generic_format_array($ephe_line);
            } else if ($ephe_count == 33) {
                //MESSAGE: Rigth Ascension Medium Sky
                $armc = $this->generate_generic_format_array($ephe_line);
            }

            $ephe_count++;
        }


        //TODO:Arreglar la rueda de la fortuna


        $wheel_fortune = $this->calculate_fortune_wheel(
                $born_lat_format, $ascendat["long"], $ephe_planets_array[0]["long"], $ephe_planets_array[1]["long"], $eliptic_obliquity["val"], $armc["long"], $ephe_houses_array[0]["oblique_ascension"], $ephe_houses_array[3]["oblique_ascension"], $ephe_houses_array[6]["oblique_ascension"]
        );



        array_push($ephe_planets_array, $wheel_fortune);





        $format_ephe_array = array(
            "planets" => $ephe_planets_array,
            "houses" => $ephe_houses_array,
            "Ascendat" => $ascendat,
            "eliptic_obliquity" => $eliptic_obliquity,
            "MC" => $mc,
            "ARMC" => $armc
        );




        return $format_ephe_array;
    }

    public function generate_generic_format_array($ephe_line_generic) {

        $ephe_line_array = explode(" ", $ephe_line_generic);
        $long = $ephe_line_array[1];

        $zodiacal_position_degree = array(
            "degrees" => intval($ephe_line_array[2]),
            "minutes" => intval($ephe_line_array[4]),
            "seconds" => floatval($ephe_line_array[5])
        );
        $zodiac_sign_position = $this->_dms_to_decimal($zodiacal_position_degree);
        $zodiac_sign_planet = $ephe_line_array[3];


        $data_generic_body = array(
            "long" => $long,
            "zodiac_sign_position" => $zodiac_sign_position,
            "zodiac_sign_planet" => $zodiac_sign_planet
        );

        return $data_generic_body;
    }

    public function generate_planet_format_array($ephe_line_planet) {



        $ephe_line_array_no_mean_replace = str_replace("mean Node", "node_north", $ephe_line_planet);
        $ephe_line_array = explode(" ", $ephe_line_array_no_mean_replace);

        $name_planet = $ephe_line_array[0];
        $long_planet = $ephe_line_array[1];
        $zodiac_sign_planet = $ephe_line_array[3];

        $zodiacal_position_degree = array(
            "degrees" => floatval($ephe_line_array[2]),
            "minutes" => floatval($ephe_line_array[4]),
            "seconds" => floatval($ephe_line_array[5])
        );

        $zodiac_sign_planet_position = $this->_dms_to_decimal($zodiacal_position_degree);
        $lat_planet = $ephe_line_array[6];
        $declination_planet = $ephe_line_array[8];
        $right_ascension_planet = $ephe_line_array[9];

        $data_planet_format = array(
            "name" => $name_planet,
            "long" => $long_planet,
            "lat" => $lat_planet,
            "zodiac_sign" => $zodiac_sign_planet,
            "zodiac_sign_position" => $zodiac_sign_planet_position,
            "declination" => $declination_planet,
            "meridian_distance" => "0.0",
            "ascencional_difference" => "0.0",
            "semi_arc" => "0.0",
            "meridian_oblique_distance" => "0.0",
            "ascension_oblique" => "0.0",
            "asntiscio" => "0.0",
            "right_ascension" => $right_ascension_planet
        );
        return $data_planet_format;
    }

    public function generate_eliptic_obliquity_array($ephe_line_planet) {
        $ephe_line_array_no_mean_replace = str_replace("Ecl. Obl.", "ecliptic_obliquity", $ephe_line_planet);
        $ephe_line_array = explode(" ", $ephe_line_array_no_mean_replace);
        $ecliptic_obliquity = $ephe_line_array[1];

        $data_generic_body = array(
            "val" => $ecliptic_obliquity
        );

        return $data_generic_body;
    }

    public function generate_house_format_array($ephe_line_house) {

        $ephe_line_array = explode(" ", $ephe_line_house);
        $name_house = $ephe_line_array[0] . "  " . $ephe_line_array[1];
        $topocentric_cut_house = $ephe_line_array[2];

        $zodiacal_position_degree = array(
            "degrees" => floatval($ephe_line_array[3]),
            "minutes" => floatval($ephe_line_array[5]),
            "seconds" => floatval($ephe_line_array[6])
        );

        $zodiac_sign_house_position = $this->_dms_to_decimal($zodiacal_position_degree);
        $zodiac_sign_house = $ephe_line_array[4];
        $oblique_ascension_house = $ephe_line_array[9];

        $data_house = array(
            "name" => $name_house,
            "topocentric_cut" => $topocentric_cut_house,
            "zodiac_sign_position" => $zodiac_sign_house_position,
            "zodiac_sign" => $zodiac_sign_house,
            "oblique_ascension" => $oblique_ascension_house
        );
        return $data_house;
    }

}
