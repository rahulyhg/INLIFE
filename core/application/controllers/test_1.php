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

    public function pruebaaa() {

        $string = "Sun 80.0862276 20 ge 5'10.4192 0.0001797 80.0862276 23.0699066 79.2145853";

        $this->generate_planet_format_array($string);
    }

    public function pruebaaaaaa() {
        $this->load->library(array(
            '../controllers/inLife_Services/pa',
            '../controllers/inLife_Services/pe'
        ));


        $this->pa->test();
        $this->pe->test();
    }

    public function pruebsdfa() {


        //  echo(strftime("%B %d %Y, %X %Z","12/01/2012 12:20:12")."<br>");


        $date = new DateTime('22.1.2012 12:20:12');


        echo $date->format('Y-m-d H:i:s');


        echo "<br><br>";

        $date->add(new DateInterval('PT0H10S'));
        echo $date->format('Y-m-d H:i:s');
    }

    public function prueba() {



        $this->load->library('../controllers/inLife_Services/sweph_get_data_user_rest');

        $fabio = array(
            'date' => '11.6.1981',
            'long' => '-76.5225',
            'lat' => '+3.4372222222222',
            'hour' => '03:43:00'
        );


        $event_1 = array(
            'date' => '02.12.2015',
            'long' => '-76.5225',
            'lat' => '+3.4372222222222',
            'hour' => '15:02:07'
        );
        $event_2 = array(
            'date' => '14.01.2016',
            'long' => '-76.5225',
            'lat' => '+3.4372222222222',
            'hour' => '14:02:06'
        );

        $event_3 = array(
            'date' => '14.01.2016',
            'long' => '-76.5225',
            'lat' => '+3.4372222222222',
            'hour' => '22:28:38'
        );


        // $this->compare($fabio, $event_1, $event_2, $event_3);
//
// 
//
//        $event_2 = array(
//            'date' => '14.01.2016',
//            'long' => '-76.5225',
//            'lat' => '+3.4372222222222',
//            'hour' => '14:02:06'
//        );
//
//        $event_3 = array(
//            'date' => '14.01.2016',
//            'long' => '-76.5225',
//            'lat' => '+3.4372222222222',
//            'hour' => '22:28:38'
//        );
//

        $mauricio = array(
            'date' => '16.1.1978',
            'long' => '-76.5222',
            'lat' => '+3.4206',
            'hour' => '00:12:00'
        );

        $sara = array(
            'date' => '4.7.1996',
            'long' => '-76.5225',
            'lat' => '+3.4372222222222',
            'hour' => '20:09:42'
        );
        $julian = array(
            'date' => '27.5.1956',
            'long' => '-76.5225',
            'lat' => '+3.4372222222222',
            'hour' => '09:55:00'
        );
        $jacobo = array(
            'date' => '23.3.2013',
            'long' => '-76.5222',
            'lat' => '+3.4206',
            'hour' => '01:02:04'
        );


        $jesus = array(
            'date' => '13.9.1977',
            'long' => '-74.8105908',
            'lat' => '+4.3113515',
            'hour' => '00:07:00'
        );

        $jesus_1 = array(
            'date' => '13.9.1977',
            'long' => '-74.80388888888889',
            'lat' => '+4.303611111111111',
            'hour' => '00:07:00'
        );
        $santiago_2 = array(
            'date' => '9.1.2015',
            'long' => '-76.5225',
            'lat' => '+3.4372222222222',
            'hour' => '14:24:00'
        );



        $jenifer = array(
            'date' => '14.3.1982',
            'long' => '-76.5225',
            'lat' => '+3.4372222222222',
            'hour' => '07:55:00'
        );

        $evento1 = array(
            'date' => '1.4.2016',
            'long' => '-76.5225',
            'lat' => '+3.4372222222222',
            'hour' => '00:40:18'
        );


//        echo "<br>********************jacobo_format**********************<br>";
//        $jacobo_format = $this->sweph_get_data_user_rest->get_sweph_user_data($jenifer);
//        echo json_encode($jacobo_format);
//        echo "<br>********************mauricio_format**********************<br>";
//        $mauricio_format = $this->sweph_get_data_user_rest->get_sweph_user_data($mauricio);
//        echo json_encode($mauricio_format);
//        echo "<br>******************************************<br>";
//
//        echo "<br>******************************************<br>";
//
//        $this->compare_one($jenifer, $jacobo);
//
//        echo "<br>******************************************<br>";



        $nacimiento = array(
            'date' => '27.5.1956',
            'long' => '-76.5225',
            'lat' => '+3.4372222222222',
            'hour' => '05:00:00'
        );


        $evento1 = array(
            'date' => '4.7.1996',
            'long' => '-76.5225',
            'lat' => '+3.4372222222222',
            'hour' => '20:09:42'
        );
        $evento2 = array(
            'date' => '16.1.1978',
            'long' => '-76.5225',
            'lat' => '+3.4372222222222',
            'hour' => '00:16:35'
        );
        $evento3 = array(
            'date' => '10.8.1996',
            'long' => '-76.5225',
            'lat' => '+3.4372222222222',
            'hour' => '09:58:27'
        );


        $this->compare($nacimiento, $evento1, $evento2, $evento3);
    }

    public function compare_one($born_event, $event_1) {

        // $aceept = 0.0011111111111111111; //4s
        $aceept = 0.002777777777777778; //10s
        // $aceept = 0.008333333333333333; //30s

        $equals_event_1 = 0;



        $is_hour_correct = 0;

        $sweet_event_born = $this->sweph_get_data_user_rest->get_sweph_user_data($born_event);
        $sweet_event_1 = $this->sweph_get_data_user_rest->get_sweph_user_data($event_1);




        $planets_list_event_born = $sweet_event_born["planets"];
        $planets_list_event_1 = $sweet_event_1["planets"];


        foreach ($planets_list_event_born as $planet_born_event) {



            $dmo_planet_born_event = floatval($planet_born_event["meridian_oblique_distance"]);
            $name_planet_born_event = $planet_born_event["name"];




            foreach ($planets_list_event_1 as $planet_event_1) {
                $dmo_planet_event_1 = floatval($planet_event_1["meridian_oblique_distance"]);
                $total_rest = abs($dmo_planet_born_event - $dmo_planet_event_1);
                $name_planet_event_1 = $planet_event_1["name"];

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
            while ($is_hour_correct === 0) {

                $new_born_hour = strtotime($born_event["hour"]) + 10;
                $born_event["hour"] = strftime('%H:%M:%S', $new_born_hour);

//                $date = new DateTime($born_event["date"] . ' ' . $born_event["hour"]);
//                $date->add(new DateInterval('PT0H10S'));
//                $born_event["hour"] = $date->format('H:i:s');
//                $born_event["date"] = $date->format('d.m.Y');


                $equals_event_1 = 0;



                echo"<br>*****************************************";
                echo "<br>CAMBIO DE HORA " . $born_event["date"] . "---" . $born_event["hour"] . "<br>";


                $sweet_event_born = $this->sweph_get_data_user_rest->get_sweph_user_data($born_event);

                echo"<br>*****************************************";
                $planets_list_event_born = $sweet_event_born["planets"];


                foreach ($planets_list_event_born as $planet_born_event) {



                    $dmo_planet_born_event = floatval($planet_born_event["meridian_oblique_distance"]);
                    $name_planet_born_event = $planet_born_event["name"];







                    foreach ($planets_list_event_1 as $planet_event_1) {
                        $dmo_planet_event_1 = floatval($planet_event_1["meridian_oblique_distance"]);
                        $total_rest = abs($dmo_planet_born_event - $dmo_planet_event_1);
                        $name_planet_event_1 = $planet_event_1["name"];


                        $total = floatval($total_rest);

                        if ($total >= 0) {

                            $true = $total <= $aceept ? 0 : 1;


                            if ($true === 0) {

                                $equals_event_1 = 1;

                                echo "<br>_____0_______" . $dmo_planet_born_event;
                                echo "<br>_____0_______" . $name_planet_born_event;

                                echo "<br>_____1_______" . $name_planet_event_1;
                                echo "<br>_____1_______" . $dmo_planet_event_1;
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

    public function modify_born_hour($born_event, $event_1, $event_2, $event_3) {


        $AUMENTED_TIME = 60;
        $DIFFERENCE = 0.06666666666666667;

        $equals_event_1 = 0;
        $equals_event_2 = 0;
        $equals_event_3 = 0;

        $is_hour_correct = 0;

        $sweet_event_born = $this->sweph_get_data_user_rest->get_sweph_user_data($born_event);
        $sweet_event_1 = $this->sweph_get_data_user_rest->get_sweph_user_data($event_1);
        $sweet_event_2 = $this->sweph_get_data_user_rest->get_sweph_user_data($event_2);
        $sweet_event_3 = $this->sweph_get_data_user_rest->get_sweph_user_data($event_3);


        $planets_list_event_born = $sweet_event_born["planets"];
        $planets_list_event_1 = $sweet_event_1["planets"];
        $planets_list_event_2 = $sweet_event_2["planets"];
        $planets_list_event_3 = $sweet_event_3["planets"];

        foreach ($planets_list_event_born as $planet_born_event) {



            $dmo_planet_born_event = floatval($planet_born_event["meridian_oblique_distance"]);
            $name_planet_born_event = $planet_born_event["name"];



            foreach ($planets_list_event_1 as $planet_event_1) {
                $dmo_planet_event_1 = floatval($planet_event_1["meridian_oblique_distance"]);
                $total = abs($dmo_planet_born_event - $dmo_planet_event_1);
                $name_planet_event_1 = $planet_event_1["name"];
                if ($total >= 0 && $total <= $DIFFERENCE) {
                    $equals_event_1 = 1;
                }
            }
            /*
              if ($equals_event_1 == 1) {
              foreach ($planets_list_event_2 as $planet_event_2) {
              $dmo_planet_event_2 = floatval($planet_event_2["meridian_oblique_distance"]);
              $total = abs($dmo_planet_born_event - $dmo_planet_event_2);
              $name_planet_event_2 = $planet_event_1["name"];
              if ($total >= 0 && $total <= $DIFFERENCE) {
              $equals_event_2 = 1;
              }
              }
              }

              if ($equals_event_2 == 1) {
              foreach ($planets_list_event_3 as $planet_event_3) {
              $dmo_planet_event_3 = floatval($planet_event_3["meridian_oblique_distance"]);
              $total = abs($dmo_planet_born_event - $dmo_planet_event_3);
              $name_planet_event_3 = $planet_event_1["name"];
              if ($total >= 0 && $total <= $DIFFERENCE) {
              $equals_event_3 = 1;
              }
              }
              }


             */
        }


//
//        if ($equals_event_1 == 1 && $equals_event_2 == 1 && $equals_event_3 == 1) {
//            $is_hour_correct = 1;
//        }

        if ($equals_event_1 == 1) {
            $is_hour_correct = 1;
        }

        if ($is_hour_correct === 0) {
            while ($is_hour_correct === 0) {

                $new_born_hour = strtotime($born_event["hour"]) + $AUMENTED_TIME;

                $born_event["hour"] = strftime('%H:%M:%S', $new_born_hour);


                echo "<br>CAMBIO DE HORA " . $born_event["hour"] . "<br>";

                $sweet_event_born = $this->sweph_get_data_user_rest->get_sweph_user_data($born_event);
                $planets_list_event_born = $sweet_event_born["planets"];


                foreach ($planets_list_event_born as $planet_born_event) {



                    $dmo_planet_born_event = floatval($planet_born_event["meridian_oblique_distance"]);
                    $name_planet_born_event = $planet_born_event["name"];



                    foreach ($planets_list_event_1 as $planet_event_1) {
                        $dmo_planet_event_1 = floatval($planet_event_1["meridian_oblique_distance"]);
                        $total = abs($dmo_planet_born_event - $dmo_planet_event_1);
                        $name_planet_event_1 = $planet_event_1["name"];
                        if ($total >= 0 && $total <= $DIFFERENCE) {
                            $equals_event_1 = 1;


                            echo "<br>planeta nacimiento ----->" . $planet_born_event["name"];
                            echo "<br>dmo nacimiento ----->" . $dmo_planet_born_event;
                            echo "<br>planeta evento ----->" . $name_planet_event_1;
                            echo "<br>dmo evento ----->" . $dmo_planet_event_1;
                            echo "<br>total ----->" . $total;
                        }
                    }


                    /*

                      if ($equals_event_1 == 1) {
                      foreach ($planets_list_event_2 as $planet_event_2) {
                      $dmo_planet_event_2 = floatval($planet_event_2["meridian_oblique_distance"]);
                      $total = abs($dmo_planet_born_event - $dmo_planet_event_2);
                      $name_planet_event_2 = $planet_event_1["name"];
                      if ($total >= 0 && $total <= $DIFFERENCE) {
                      $equals_event_2 = 1;
                      }
                      }
                      }

                      if ($equals_event_2 == 1) {
                      foreach ($planets_list_event_3 as $planet_event_3) {
                      $dmo_planet_event_3 = floatval($planet_event_3["meridian_oblique_distance"]);
                      $total = abs($dmo_planet_born_event - $dmo_planet_event_3);
                      $name_planet_event_3 = $planet_event_1["name"];
                      if ($total >= 0 && $total <= $DIFFERENCE) {
                      $equals_event_3 = 1;
                      }
                      }
                      }


                     */
                }

                if ($equals_event_1 == 1) {
                    $is_hour_correct = 1;
                }
            }


            echo "<br>FINISH!";
        }
    }

    public function compare($born_event, $event_1, $event_2, $event_3) {

        $aceept = 0.06666666666666667; //10s

        $equals_event_1 = 0;
        $equals_event_2 = 0;
        $equals_event_3 = 0;


        $is_hour_correct = 0;

        $sweet_event_born = $this->sweph_get_data_user_rest->get_sweph_user_data($born_event);
        $sweet_event_1 = $this->sweph_get_data_user_rest->get_sweph_user_data($event_1);
        $sweet_event_2 = $this->sweph_get_data_user_rest->get_sweph_user_data($event_2);
        $sweet_event_3 = $this->sweph_get_data_user_rest->get_sweph_user_data($event_3);



        $planets_list_event_born = $sweet_event_born["planets"];
        $planets_list_event_1 = $sweet_event_1["planets"];
        $planets_list_event_2 = $sweet_event_2["planets"];
        $planets_list_event_3 = $sweet_event_3["planets"];


        foreach ($planets_list_event_born as $planet_born_event) {



            $dmo_planet_born_event = floatval($planet_born_event["meridian_oblique_distance"]);
            $name_planet_born_event = $planet_born_event["name"];




            foreach ($planets_list_event_1 as $planet_event_1) {
                $dmo_planet_event_1 = floatval($planet_event_1["meridian_oblique_distance"]);
                $total_rest = abs($dmo_planet_born_event - $dmo_planet_event_1);
                $name_planet_event_1 = $planet_event_1["name"];


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
            while ($is_hour_correct === 0) {

                // $new_born_hour = strtotime($born_event["hour"]) + 1;
                //  $born_event["hour"] = strftime('%H:%M:%S', $new_born_hour);

                $date = new DateTime($born_event["date"] . ' ' . $born_event["hour"]);
                $date->add(new DateInterval('PT0H10S'));
                $born_event["hour"] = $date->format('H:i:s');
                $born_event["date"] = $date->format('d.m.Y');

                $equals_event_1 = 0;
                $equals_event_2 = 0;
                $equals_event_3 = 0;


                echo"<br>*****************************************";
                echo "<br>CAMBIO DE HORA " . $born_event["date"] . "---" . $born_event["hour"] . "<br>";

                echo"<br>*****************************************";

                $sweet_event_born = $this->sweph_get_data_user_rest->get_sweph_user_data($born_event);
                $planets_list_event_born = $sweet_event_born["planets"];


                foreach ($planets_list_event_born as $planet_born_event) {



                    $dmo_planet_born_event = floatval($planet_born_event["meridian_oblique_distance"]);
                    $name_planet_born_event = $planet_born_event["name"];







                    foreach ($planets_list_event_1 as $planet_event_1) {
                        $dmo_planet_event_1 = floatval($planet_event_1["meridian_oblique_distance"]);
                        $total_rest = abs($dmo_planet_born_event - $dmo_planet_event_1);
                        $name_planet_event_1 = $planet_event_1["name"];


                        $total = floatval($total_rest);

                        if ($total >= 0) {

                            $true = $total <= $aceept ? 0 : 1;


                            if ($true === 0) {

                                $equals_event_1 = 1;

                                echo "<br>_____1_______" . $name_planet_event_1;
                                echo "<br>_____1_______" . $dmo_planet_event_1;
                            }
                        }
                    }



                    foreach ($planets_list_event_2 as $planet_event_2) {
                        $dmo_planet_event_2 = floatval($planet_event_2["meridian_oblique_distance"]);
                        $total_rest = abs($dmo_planet_born_event - $dmo_planet_event_2);
                        $name_planet_event_2 = $planet_event_2["name"];


                        $total = floatval($total_rest);

                        if ($total >= 0) {

                            $true = $total <= $aceept ? 0 : 1;


                            if ($true === 0) {

                                $equals_event_2 = 1;

                                echo "<br>_____2_______" . $name_planet_event_2;
                                echo "<br>_____2_______" . $dmo_planet_event_2;
                            }
                        }
                    }



                    foreach ($planets_list_event_3 as $planet_event_3) {
                        $dmo_planet_event_3 = floatval($planet_event_3["meridian_oblique_distance"]);
                        $total_rest = abs($dmo_planet_born_event - $dmo_planet_event_3);
                        $name_planet_event_3 = $planet_event_3["name"];


                        $total = floatval($total_rest);

                        if ($total >= 0) {

                            $true = $total <= $aceept ? 0 : 1;


                            if ($true === 0) {

                                $equals_event_3 = 1;

                                echo "<br>_____3_______" . $name_planet_event_3;
                                echo "<br>_____3_______" . $dmo_planet_event_3;
                            }
                        }
                    }


                    // echo "<br>nombr  planeta nacimiento------->" . $name_planet_born_event;
                    //  echo "<br>dmo  planeta nacimiento------->" . $dmo_planet_born_event;



                    if ($equals_event_1 === 1 && $equals_event_2 === 1 && $equals_event_3 === 1) {
                        $is_hour_correct = 1;
                    }




                    echo"<br>*****************************************<br><br>";
                }
            }
        }
    }

    public function generate_planet_format_array($ephe_line) {

        $ephe_line_array = explode(" ", $ephe_line);
        $name_planet = $ephe_line_array[0];

        $degreen_sing = $ephe_line_array[2];

        $long_planet = $ephe_line_array[1];
        $zodiac_sign_planet = $ephe_line_array[3];


        $minute_second_of_zodiacal = $ephe_line_array[4];



        $minute_second_of_zodiacal_array = explode("'", $minute_second_of_zodiacal);

        echo "*----->" . $ephe_line_array[4] . "<br>";
        echo "0----->" . $minute_second_of_zodiacal_array[0] . "<br>";
        echo "-1---->" . $minute_second_of_zodiacal_array[1] . "<br>";

        $zodiacal_position_degree = array(
            "degrees" => $ephe_line_array[2],
            "minutes" => $minute_second_of_zodiacal_array[0],
            "seconds" => $minute_second_of_zodiacal_array[1]
        );

        $zodiac_sign_planet_position = $this->grade_converter->dms_to_decimal($zodiacal_position_degree);

        $lat_planet = $ephe_line_array[5];
        $declination_planet = $ephe_line_array[7];
        $right_ascension_planet = $ephe_line_array[8];

        $data_planet = array(
            "name" => $name_planet,
            "long" => $long_planet,
            "lat" => $lat_planet,
            "zodiac_sign" => $zodiac_sign_planet,
            "zodiac_sign_position" => $zodiac_sign_planet_position,
            "declination" => $declination_planet,
            "right_ascension" => $right_ascension_planet
        );

        return $data_planet;
    }

    public function hora() {
        $time = '21:09';
        $timestamp = strtotime($time);
        $timestamp_one_hour_later = $timestamp + 3600;
        echo strftime('%H:%M', $timestamp_one_hour_later);
    }

    public function gmt() {
// $url = 'http://api.timezonedb.com/?zone=America/Bogota&format=json&key=GRXYIXUYI8KJ';
        $url = 'http://api.timezonedb.com/?lat=3.43722&lng=-76.5225&format=json&key=GRXYIXUYI8KJ';



        $opts = array('http' =>
            array(
                'method' => 'POST',
                'header' => 'Content-type: application/x-www-form-urlencoded'
            )
        );

        $context = stream_context_create($opts);

        $result = file_get_contents($url, false, $context);


        //   echo $result;


        $timestamp = strtotime("19.7.1989 21:30:00") + 3600 * 5;
        $time = strtotime("00:00:00") + 3600 * 5;

        echo date('G:i:s', $time);

        echo "<br><br>";



        $number = "5";
        $int_number = intval($number);

        if ($int_number < 0) {
            $timestamp = strtotime("2.7.1989 21:30:00") + 3600 * abs($int_number);
        } else {
            $timestamp = strtotime("2.7.1989 21:30:00") + 3600 * $int_number * -1;
        }

        $day = date('d', $timestamp);
        $month = date('m', $timestamp);
        $year = date('Y', $timestamp);


        $format_day = str_replace("0", "", $day);
        $format_month = str_replace("0", "", $month);
        $new_born_date = $format_day . "." . $format_month . "." . $year;

        echo $new_born_date;
        echo "<br><br>";
        echo date('d.m.Y', $new_born_date);


        echo "<br><br>";


        echo date('G:i:s', $timestamp);
    }

    public function grados() {

        $this->load->library('../controllers/converter/grade_converter');

        $longitud_arco_cali = array(
            "degrees" => 20,
            "minutes" => 5,
            "seconds" => 10.4192
        );

        $dms_to_decimal = $this->grade_converter->dms_to_decimal($longitud_arco_cali);
        $decimal_to_dms = $this->grade_converter->_decimal_to_dms(20.086227555556);

        echo " ====>" . $dms_to_decimal . "<br>";
        echo " ====>" . json_encode($decimal_to_dms) . "<br>";
    }

    public function correction() {



        $data = array(
            "born_country_lat" => 4.5988888888889, //Latitud Colombia
            "born_country_long" => -74.080833333333, //Longitud Colombia
            "born_country_gmt" => "-5",
            "born_country_meridian_long" => "75", //Meridiano oficial del pais????
            "default_hour" => "12:00:00",
            "born_city_lat" => 3.4109271, //Latitud Cali
            "born_city_long" => -76.7232107, //Longitud Cali
        );
    }

}
