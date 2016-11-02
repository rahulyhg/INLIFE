<?php

header("Cache-Control: no-cache, no-store, must-revalidate, post-check=0, pre-check=0");
header("Pragma: no-cache");
header('Access-Control-Allow-Origin: *');

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_sweph_services extends MY_Controller {

    public $TOLERANCIA_DMO = 0.08333333333333333;
    public $TOLERANCIA_AOT = 0.16666666666666666;
    public $TOLERANCIA_DIFERENCIAS_OBLICUAS = 0.5;
    public $TOLERANCIA_DMO_NEGATIVE = 0.0;
    public $variable_inicial_pos = 0.0;
    public $variable_inicial_neg = 0.0;
    public $variable_final_pos = 0.0;
    public $variable_final_neg = 0.0;
    public $ARRAY_DIFERENCES_ACCEPTED_EVENTS_TOTAL_DAY = array();
    public $HOURS_COMPLETE = 0;
    public $TIME_LAPSED = " 1 second";
    public $HOURS_ACCEPTED_CYCLE = 1;

    public function __construct() {

        parent::__construct();



        $this->TOLERANCIA_DMO_NEGATIVE = $this->TOLERANCIA_DMO * (-1);
        $this->variable_inicial_pos = 0 + $this->TOLERANCIA_AOT;
        $this->variable_inicial_neg = 0 - $this->TOLERANCIA_AOT;
        $this->variable_final_pos = 180 + $this->TOLERANCIA_AOT;
        $this->variable_final_neg = 180 - $this->TOLERANCIA_AOT;
    }

    function index() {
        
    }

    public function calculateCorrectUserHour($user_born_event, $list_events) {

        ini_set('max_execution_time', 9000);

        $init_born_date = $user_born_event["date"];
        $init_born_hour = $user_born_event["hour"];
        $complete_init_born_date = date($init_born_date . " " . $init_born_hour);


        $array_differences_accepted_by_hour = $this->get_DMO_accpeted_differences_by_date($user_born_event, $list_events);
        if ($array_differences_accepted_by_hour != null) {

            $accepted_hour = array(
                'date' => $init_born_date,
                'diff' => $array_differences_accepted_by_hour,
                'hour' => $init_born_hour
            );

            array_push($this->ARRAY_DIFERENCES_ACCEPTED_EVENTS_TOTAL_DAY, $accepted_hour);
        }

        while ($this->HOURS_COMPLETE != $this->HOURS_ACCEPTED_CYCLE) {

            $user_born_event = $this->increment_born_event_time($user_born_event);
            $increment_date = $user_born_event["date"];
            $increment_hour = $user_born_event["hour"];
            $complete_increment_date = date($increment_date . " " . $increment_hour);








            $array_differences_accepted_by_hour_increment = $this->get_DMO_accpeted_differences_by_date($user_born_event, $list_events);


            if ($array_differences_accepted_by_hour_increment != null) {

                $accepted_hour = array(
                    'date' => $increment_date,
                    'diff' => $array_differences_accepted_by_hour_increment,
                    'hour' => $increment_hour
                );

                array_push($this->ARRAY_DIFERENCES_ACCEPTED_EVENTS_TOTAL_DAY, $accepted_hour);
            }


            $this->HOURS_COMPLETE = $this->diff_btwn_hours($complete_init_born_date, $complete_increment_date);
        }


        echo"<br>*****************************************";
        echo"<br>" . json_encode($this->ARRAY_DIFERENCES_ACCEPTED_EVENTS_TOTAL_DAY);
        echo"<br>*****************************************";
    }

    public function diff_btwn_hours($complete_init_born_date, $complete_increment_date) {

        $date1 = new DateTime($complete_init_born_date);
        $date2 = new DateTime($complete_increment_date);

        $diff = $date2->diff($date1);

        $hours = $diff->h;
        $hours = $hours + ($diff->days * 24);

        return $hours;
    }

    public function increment_born_event_time($born_event) {

        $complete_date = date($born_event["date"] . " " . $born_event["hour"]);
        $new_date_increment = strtotime($complete_date) + $this->TIME_LAPSED;

        $born_event["hour"] = date('H:i:s', $new_date_increment);
        $born_event["date"] = date('d.n.Y', $new_date_increment);

        return $born_event;
    }

    public function get_DMO_accpeted_differences_by_date($user_born_event, $list_events) {




        $this->load->library('../controllers/inLife_Services/sweph_get_data_user_rest');

        $evento_nacimiento = $this->sweph_get_data_user_rest->get_sweph_user_data($user_born_event);



        $ARRAY_DIFERENCES_ACCEPTED_EVENTS = array();

        foreach ($list_events as $event) {



            $evento_suceso = $this->sweph_get_data_user_rest->get_sweph_user_data($event);



            $diferencia_dmo_aceptada = $this->compare_event_with_born($evento_nacimiento, $evento_suceso);
            

            array_push($ARRAY_DIFERENCES_ACCEPTED_EVENTS, $diferencia_dmo_aceptada);
        }





        $size_array = sizeof($ARRAY_DIFERENCES_ACCEPTED_EVENTS);
        $positive_values = 0;
        $negative_values = 0;

        foreach ($ARRAY_DIFERENCES_ACCEPTED_EVENTS as $differences_accepted) {
            if ($differences_accepted > 0) {
                $positive_values++;
            } else {
                $negative_values++;
            }
        }

        if ($positive_values == $size_array || $negative_values == $size_array) {
            return $ARRAY_DIFERENCES_ACCEPTED_EVENTS;
        } else {
            return null;
        }
    }

    public function compare_event_with_born($evento_nacimiento, $evento_suceso) {


        $lista_planetas_nacimiento = $evento_nacimiento["planets"];
        $lista_planetas_evento = $evento_suceso["planets"];
        $armc_evento_nacimiento = $evento_nacimiento["ARMC"];
        $long_armc_evento_nacimiento = floatval($armc_evento_nacimiento["long"]);
        $armc_evento_suceso = $evento_suceso["ARMC"];
        $long_armc_evento_suceso = floatval($armc_evento_suceso["long"]);

        $DIFERENCIA_DMO_ACEPTADA = 0;


        foreach ($lista_planetas_nacimiento as $planeta_nacimiento) {

            $dmo_planeta_nacimiento = floatval($planeta_nacimiento["meridian_oblique_distance"]);
            $ascension_oblicua_planeta_nacimiento = floatval($planeta_nacimiento["ascension_oblique"]);

            $TOTAL_DIFERENCIA_DMO = 0;

            foreach ($lista_planetas_evento as $planeta_evento) {



                $dmo_planeta_evento = floatval($planeta_evento["meridian_oblique_distance"]);
                $ascension_oblicua_evento = floatval($planeta_evento["ascension_oblique"]);

                $TOTAL_DIFERENCIA_DMO = $dmo_planeta_nacimiento - $dmo_planeta_evento;




                $IS_TOLERANCE_DMO_ACCEPTED = 0;

                if ($TOTAL_DIFERENCIA_DMO >= $this->TOLERANCIA_DMO_NEGATIVE && $TOTAL_DIFERENCIA_DMO <= $this->TOLERANCIA_DMO) {
                    $IS_TOLERANCE_DMO_ACCEPTED = 1;
                }




                if ($IS_TOLERANCE_DMO_ACCEPTED === 1) {

                    $ARCO_TRANSCURRIDO = $long_armc_evento_suceso - $long_armc_evento_nacimiento;

                    if ($ARCO_TRANSCURRIDO < 0) {
                        $ARCO_TRANSCURRIDO = $ARCO_TRANSCURRIDO + 360;
                    }



                    $ASCENSION_OBLICUA_TRANSCURRIDA = $ascension_oblicua_planeta_nacimiento + $ARCO_TRANSCURRIDO;

                    if ($ASCENSION_OBLICUA_TRANSCURRIDA > 360) {
                        $ASCENSION_OBLICUA_TRANSCURRIDA = $ASCENSION_OBLICUA_TRANSCURRIDA - 360;
                    }



                    $OPUESTO_ASCENSION_OBLICUA_TRANSCURRIDA = 0.0;

                    if ($ASCENSION_OBLICUA_TRANSCURRIDA >= 0 && $ASCENSION_OBLICUA_TRANSCURRIDA < 180) {

                        $OPUESTO_ASCENSION_OBLICUA_TRANSCURRIDA = $ASCENSION_OBLICUA_TRANSCURRIDA + 180;
                    } else if ($ASCENSION_OBLICUA_TRANSCURRIDA >= 180 && $ASCENSION_OBLICUA_TRANSCURRIDA <= 360) {
                        $OPUESTO_ASCENSION_OBLICUA_TRANSCURRIDA = ($ASCENSION_OBLICUA_TRANSCURRIDA + 180) - 360;
                    }


                    if ($ascension_oblicua_evento > 360) {
                        $ascension_oblicua_evento = $ascension_oblicua_evento - 360;
                    }



                    $opuesto_ascension_oblicua_evento = 0.0;


                    if ($ascension_oblicua_evento >= 0 && $ascension_oblicua_evento < 180) {
                        $opuesto_ascension_oblicua_evento = $ascension_oblicua_evento + 180;
                    } else if ($ascension_oblicua_evento >= 180 && $ascension_oblicua_evento <= 360) {
                        $opuesto_ascension_oblicua_evento = ($ascension_oblicua_evento + 180) - 360;
                    }

                    $listado_actiscios = $this->calculate_antiscios($ASCENSION_OBLICUA_TRANSCURRIDA, $ascension_oblicua_evento);

                    $IS_TOLERANCE_AOT_ACCEPTED = $this->is_tolerance_aot_accepted($listado_actiscios, $ascension_oblicua_evento, $opuesto_ascension_oblicua_evento);


                    if ($IS_TOLERANCE_AOT_ACCEPTED == 1) {


                        //**********************************************
                        //       COMPARO PLANETAS SIN IMPORTAR ORDEN  
                        //**********************************************

                        $IS_TOLERANCE_ANTICIO_ACCEPTED = $this->is_tolerance_anticio_accepted($lista_planetas_nacimiento, $lista_planetas_evento);

                        if ($IS_TOLERANCE_ANTICIO_ACCEPTED === 1) {
                            $DIFERENCIA_DMO_ACEPTADA = $TOTAL_DIFERENCIA_DMO;
                        }
                    }
                }
            }
        }


        return $DIFERENCIA_DMO_ACEPTADA;
    }

    public function is_tolerance_anticio_accepted($lista_planetas_nacimiento, $lista_planetas_evento) {
        foreach ($lista_planetas_nacimiento as $planeta_nacimiento) {

            $long_planeta_nacimiento = floatval($planeta_nacimiento["long"]);
            $asntiscio_planeta_nacimiento = floatval($planeta_nacimiento["asntiscio"]);

            foreach ($lista_planetas_evento as $planeta_evento) {
                $long_planeta_evento = floatval($planeta_evento["long"]);
                $asntiscio_planeta_evento = floatval($planet_event_2["asntiscio"]);

                $diferencia_long_nacimiento_long_evento = abs($long_planeta_nacimiento - $long_planeta_evento);
                $diferencia_long_nacimiento_anticio_evento = abs($long_planeta_nacimiento - $asntiscio_planeta_evento);
                $diferencia_anticio_nacimiento_long_evento = abs($asntiscio_planeta_nacimiento - $long_planeta_evento);
                $diferencia_anticio_nacimiento_anticio_evento = abs($asntiscio_planeta_nacimiento - $asntiscio_planeta_evento);

                $diferencia_long_nacimiento_long_evento_f = floatval($diferencia_long_nacimiento_long_evento);
                $diferencia_long_nacimiento_anticio_evento_f = floatval($diferencia_long_nacimiento_anticio_evento);
                $diferencia_anticio_nacimiento_long_evento_f = floatval($diferencia_anticio_nacimiento_long_evento);
                $diferencia_anticio_nacimiento_anticio_evento_f = floatval($diferencia_anticio_nacimiento_anticio_evento);


                if ($diferencia_long_nacimiento_long_evento_f <= 180) {

                    if ($diferencia_long_nacimiento_long_evento_f <= $this->TOLERANCIA_DIFERENCIAS_OBLICUAS && $diferencia_long_nacimiento_long_evento_f >= -$this->TOLERANCIA_DIFERENCIAS_OBLICUAS) {
                        return 1;
                    } else if ($diferencia_long_nacimiento_long_evento_f <= (15 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_long_nacimiento_long_evento_f >= (15 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    } else if ($diferencia_long_nacimiento_long_evento_f <= (30 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_long_nacimiento_long_evento_f >= (30 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    } else if ($diferencia_long_nacimiento_long_evento_f <= (36 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_long_nacimiento_long_evento_f >= (36 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    } else if ($diferencia_long_nacimiento_long_evento_f <= (45 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_long_nacimiento_long_evento_f >= (45 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    } else if ($diferencia_long_nacimiento_long_evento_f <= (60 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_long_nacimiento_long_evento_f >= (60 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    } else if ($diferencia_long_nacimiento_long_evento_f <= (72 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_long_nacimiento_long_evento_f >= (72 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    } else if ($diferencia_long_nacimiento_long_evento_f <= (75 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_long_nacimiento_long_evento_f >= (75 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    } else if ($diferencia_long_nacimiento_long_evento_f <= (90 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_long_nacimiento_long_evento_f >= (90 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    } else if ($diferencia_long_nacimiento_long_evento_f <= (105 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_long_nacimiento_long_evento_f >= (105 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    } else if ($diferencia_long_nacimiento_long_evento_f <= (120 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_long_nacimiento_long_evento_f >= (120 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    } else if ($diferencia_long_nacimiento_long_evento_f <= (135 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_long_nacimiento_long_evento_f >= (135 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    } else if ($diferencia_long_nacimiento_long_evento_f <= (144 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_long_nacimiento_long_evento_f >= (144 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    } else if ($diferencia_long_nacimiento_long_evento_f <= (150 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_long_nacimiento_long_evento_f >= (150 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    } else if ($diferencia_long_nacimiento_long_evento_f <= (165 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_long_nacimiento_long_evento_f >= (165 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    } else if ($diferencia_long_nacimiento_long_evento_f <= (180 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_long_nacimiento_long_evento_f >= (180 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    }
                } else if ($diferencia_long_nacimiento_anticio_evento_f <= 180) {

                    if ($diferencia_long_nacimiento_anticio_evento_f <= $this->TOLERANCIA_DIFERENCIAS_OBLICUAS && $diferencia_long_nacimiento_anticio_evento_f >= -$this->TOLERANCIA_DIFERENCIAS_OBLICUAS) {
                        return 1;
                    } else if ($diferencia_long_nacimiento_anticio_evento_f <= (15 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_long_nacimiento_anticio_evento_f >= (15 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    } else if ($diferencia_long_nacimiento_anticio_evento_f <= (30 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_long_nacimiento_anticio_evento_f >= (30 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    } else if ($diferencia_long_nacimiento_anticio_evento_f <= (36 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_long_nacimiento_anticio_evento_f >= (36 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    } else if ($diferencia_long_nacimiento_anticio_evento_f <= (45 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_long_nacimiento_anticio_evento_f >= (45 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    } else if ($diferencia_long_nacimiento_anticio_evento_f <= (60 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_long_nacimiento_anticio_evento_f >= (60 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    } else if ($diferencia_long_nacimiento_anticio_evento_f <= (72 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_long_nacimiento_anticio_evento_f >= (72 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    } else if ($diferencia_long_nacimiento_anticio_evento_f <= (75 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_long_nacimiento_anticio_evento_f >= (75 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    } else if ($diferencia_long_nacimiento_anticio_evento_f <= (90 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_long_nacimiento_anticio_evento_f >= (90 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    } else if ($diferencia_long_nacimiento_anticio_evento_f <= (105 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_long_nacimiento_anticio_evento_f >= (105 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    } else if ($diferencia_long_nacimiento_anticio_evento_f <= (120 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_long_nacimiento_anticio_evento_f >= (120 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    } else if ($diferencia_long_nacimiento_anticio_evento_f <= (135 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_long_nacimiento_anticio_evento_f >= (135 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    } else if ($diferencia_long_nacimiento_anticio_evento_f <= (144 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_long_nacimiento_anticio_evento_f >= (144 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    } else if ($diferencia_long_nacimiento_anticio_evento_f <= (150 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_long_nacimiento_anticio_evento_f >= (150 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    } else if ($diferencia_long_nacimiento_anticio_evento_f <= (165 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_long_nacimiento_anticio_evento_f >= (165 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    } else if ($diferencia_long_nacimiento_anticio_evento_f <= (180 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_long_nacimiento_anticio_evento_f >= (180 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    }
                } else if ($diferencia_anticio_nacimiento_long_evento_f <= 180) {

                    if ($diferencia_anticio_nacimiento_long_evento_f <= $this->TOLERANCIA_DIFERENCIAS_OBLICUAS && $diferencia_anticio_nacimiento_long_evento_f >= -$this->TOLERANCIA_DIFERENCIAS_OBLICUAS) {
                        return 1;
                    } else if ($diferencia_anticio_nacimiento_long_evento_f <= (15 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_anticio_nacimiento_long_evento_f >= (15 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    } else if ($diferencia_anticio_nacimiento_long_evento_f <= (30 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_anticio_nacimiento_long_evento_f >= (30 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    } else if ($diferencia_anticio_nacimiento_long_evento_f <= (36 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_anticio_nacimiento_long_evento_f >= (36 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    } else if ($diferencia_anticio_nacimiento_long_evento_f <= (45 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_anticio_nacimiento_long_evento_f >= (45 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    } else if ($diferencia_anticio_nacimiento_long_evento_f <= (60 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_anticio_nacimiento_long_evento_f >= (60 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    } else if ($diferencia_anticio_nacimiento_long_evento_f <= (72 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_anticio_nacimiento_long_evento_f >= (72 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    } else if ($diferencia_anticio_nacimiento_long_evento_f <= (75 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_anticio_nacimiento_long_evento_f >= (75 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    } else if ($diferencia_anticio_nacimiento_long_evento_f <= (90 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_anticio_nacimiento_long_evento_f >= (90 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    } else if ($diferencia_anticio_nacimiento_long_evento_f <= (105 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_anticio_nacimiento_long_evento_f >= (105 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    } else if ($diferencia_anticio_nacimiento_long_evento_f <= (120 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_anticio_nacimiento_long_evento_f >= (120 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    } else if ($diferencia_anticio_nacimiento_long_evento_f <= (135 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_anticio_nacimiento_long_evento_f >= (135 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    } else if ($diferencia_anticio_nacimiento_long_evento_f <= (144 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_anticio_nacimiento_long_evento_f >= (144 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    } else if ($diferencia_anticio_nacimiento_long_evento_f <= (150 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_anticio_nacimiento_long_evento_f >= (150 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    } else if ($diferencia_anticio_nacimiento_long_evento_f <= (165 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_anticio_nacimiento_long_evento_f >= (165 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    } else if ($diferencia_anticio_nacimiento_long_evento_f <= (180 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_anticio_nacimiento_long_evento_f >= (180 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    }
                } else if ($diferencia_anticio_nacimiento_anticio_evento_f <= 180) {

                    if ($diferencia_anticio_nacimiento_anticio_evento_f <= $this->TOLERANCIA_DIFERENCIAS_OBLICUAS && $diferencia_anticio_nacimiento_anticio_evento_f >= -$this->TOLERANCIA_DIFERENCIAS_OBLICUAS) {
                        return 1;
                    } else if ($diferencia_anticio_nacimiento_anticio_evento_f <= (15 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_anticio_nacimiento_anticio_evento_f >= (15 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    } else if ($diferencia_anticio_nacimiento_anticio_evento_f <= (30 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_anticio_nacimiento_anticio_evento_f >= (30 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    } else if ($diferencia_anticio_nacimiento_anticio_evento_f <= (36 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_anticio_nacimiento_anticio_evento_f >= (36 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    } else if ($diferencia_anticio_nacimiento_anticio_evento_f <= (45 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_anticio_nacimiento_anticio_evento_f >= (45 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    } else if ($diferencia_anticio_nacimiento_anticio_evento_f <= (60 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_anticio_nacimiento_anticio_evento_f >= (60 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    } else if ($diferencia_anticio_nacimiento_anticio_evento_f <= (72 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_anticio_nacimiento_anticio_evento_f >= (72 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    } else if ($diferencia_anticio_nacimiento_anticio_evento_f <= (75 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_anticio_nacimiento_anticio_evento_f >= (75 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    } else if ($diferencia_anticio_nacimiento_anticio_evento_f <= (90 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_anticio_nacimiento_anticio_evento_f >= (90 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    } else if ($diferencia_anticio_nacimiento_anticio_evento_f <= (105 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_anticio_nacimiento_anticio_evento_f >= (105 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    } else if ($diferencia_anticio_nacimiento_anticio_evento_f <= (120 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_anticio_nacimiento_anticio_evento_f >= (120 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    } else if ($diferencia_anticio_nacimiento_anticio_evento_f <= (135 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_anticio_nacimiento_anticio_evento_f >= (135 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    } else if ($diferencia_anticio_nacimiento_anticio_evento_f <= (144 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_anticio_nacimiento_anticio_evento_f >= (144 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    } else if ($diferencia_anticio_nacimiento_anticio_evento_f <= (150 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_anticio_nacimiento_anticio_evento_f >= (150 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    } else if ($diferencia_anticio_nacimiento_anticio_evento_f <= (165 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_anticio_nacimiento_anticio_evento_f >= (165 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    } else if ($diferencia_anticio_nacimiento_anticio_evento_f <= (180 + $this->TOLERANCIA_DIFERENCIAS_OBLICUAS) && $diferencia_anticio_nacimiento_anticio_evento_f >= (180 - $this->TOLERANCIA_DIFERENCIAS_OBLICUAS)) {
                        return 1;
                    }
                } else {
                    return 0;
                }
            }
        }
    }

    public function is_tolerance_aot_accepted($listado_actiscios, $ascension_oblicua_evento, $opuesto_ascension_oblicua_evento) {


        $dif_btwn_aotb_n_aoe_2 = abs($listado_actiscios["antiscio_ascecion_oblicua_transcurrida_evento"] - $ascension_oblicua_evento);
        $dif_btwn_aotb_n_oaoe_2 = abs($listado_actiscios["antiscio_ascecion_oblicua_transcurrida_evento"] - $opuesto_ascension_oblicua_evento);
        $dif_btwn_aaot_n_aaoe_2 = abs($ascecion_oblicuad_transcurrida_2 - $listado_actiscios["antiscio_ascension_oblicua_evento"]);
        $dif_btwn_aaot_n_oaaoe_2 = abs($ascecion_oblicuad_transcurrida_2 - $listado_actiscios["opuesto_antiscio_ascension_oblicua_evento"]);
        $dif_btwn_aaotb_n_aoe_2 = abs($listado_actiscios["antiscio_ascecion_oblicua_transcurrida_evento"] - $ascension_oblicua_evento);
        $dif_btwn_aaotb_n_oaoe_2 = abs($listado_actiscios["antiscio_ascension_oblicua_evento"] - $opuesto_ascension_oblicua_evento);
        $dif_btwn_aaaot_n_aaoe_2 = abs($listado_actiscios["antiscio_ascecion_oblicua_transcurrida_evento"] - $listado_actiscios["antiscio_ascension_oblicua_evento"]);
        $dif_btwn_aaaot_n_oaaoe_2 = abs($listado_actiscios["antiscio_ascecion_oblicua_transcurrida_evento"] - $listado_actiscios["opuesto_antiscio_ascension_oblicua_transcurrida_evento"]);


        if ($dif_btwn_aotb_n_aoe_2 >= $this->variable_inicial_neg && $dif_btwn_aotb_n_aoe_2 <= $this->variable_inicial_pos || $dif_btwn_aotb_n_aoe_2 >= $this->variable_final_neg && $dif_btwn_aotb_n_aoe_2 <= $this->variable_final_pos) {
            return 1;
        } else if ($dif_btwn_aotb_n_oaoe_2 >= $this->variable_inicial_neg && $dif_btwn_aotb_n_oaoe_2 <= $this->variable_inicial_pos || $dif_btwn_aotb_n_oaoe_2 >= $this->variable_final_neg && $dif_btwn_aotb_n_oaoe_2 <= $this->variable_final_pos) {
            return 1;
        } else if ($dif_btwn_aaot_n_aaoe_2 >= $this->variable_inicial_neg && $dif_btwn_aaot_n_aaoe_2 <= $this->variable_inicial_pos || $dif_btwn_aaot_n_aaoe_2 >= $this->variable_final_neg && $dif_btwn_aaot_n_aaoe_2 <= $this->variable_final_pos) {
            return 1;
        } else if ($dif_btwn_aaot_n_oaaoe_2 >= $this->variable_inicial_neg && $dif_btwn_aaot_n_oaaoe_2 <= $this->variable_inicial_pos || $dif_btwn_aaot_n_oaaoe_2 >= $this->variable_final_neg && $dif_btwn_aaot_n_oaaoe_2 <= $this->variable_final_pos) {
            return 1;
        } else if ($dif_btwn_aaotb_n_aoe_2 >= $this->variable_inicial_neg && $dif_btwn_aaotb_n_aoe_2 <= $this->variable_inicial_pos || $dif_btwn_aaotb_n_aoe_2 >= $this->variable_final_neg && $dif_btwn_aaotb_n_aoe_2 <= $this->variable_final_pos) {
            return 1;
        } else if ($dif_btwn_aaotb_n_oaoe_2 >= $this->variable_inicial_neg && $dif_btwn_aaotb_n_oaoe_2 <= $this->variable_inicial_pos || $dif_btwn_aaotb_n_oaoe_2 >= $this->variable_final_neg && $dif_btwn_aaotb_n_oaoe_2 <= $this->variable_final_pos) {
            return 1;
        } else if ($dif_btwn_aaaot_n_aaoe_2 >= $this->variable_inicial_neg && $dif_btwn_aaaot_n_aaoe_2 <= $this->variable_inicial_pos || $dif_btwn_aaaot_n_aaoe_2 >= $this->variable_final_neg && $dif_btwn_aaaot_n_aaoe_2 <= $this->variable_final_pos) {
            return 1;
        } else if ($dif_btwn_aaaot_n_oaaoe_2 >= $this->variable_inicial_neg && $dif_btwn_aaaot_n_oaaoe_2 <= $this->variable_inicial_pos || $dif_btwn_aaaot_n_oaaoe_2 >= $this->variable_final_neg && $dif_btwn_aaaot_n_oaaoe_2 <= $this->variable_final_pos) {
            return 1;
        } else {
            return 0;
        }
    }

    public
            function calculate_antiscios($AOT, $AO) {

        $antiscio_ascecion_oblicuad_transcurrida_evento = 0.0;
        $antiscio_ascension_oblique_evento = 0.0;
        $opuesto_antiscio_ascension_oblique_evento = 0.0;
        $opuesto_antiscio_ascension_oblicuad_transcurrida_evento = 0.0;

        switch ($AOT) {

            case ($AOT >= 0 && $AOT < 30):
                $antiscio_ascecion_oblicuad_transcurrida_evento = (30 - $AOT) + 150;
                break;

            case ($AOT >= 30 && $AOT < 60):
                $antiscio_ascecion_oblicuad_transcurrida_evento = (60 - $AOT) + 120;
                break;


            case ($AOT >= 60 && $AOT < 90):
                $antiscio_ascecion_oblicuad_transcurrida_evento = (90 - $AOT) + 90;
                break;

            case ($AOT >= 90 && $AOT < 120):
                $antiscio_ascecion_oblicuad_transcurrida_evento = (120 - $AOT) + 60;
                break;


            case ($AOT >= 120 && $AOT < 150):
                $antiscio_ascecion_oblicuad_transcurrida_evento = (150 - $AOT) + 30;
                break;


            case ($AOT >= 150 && $AOT < 180):
                $antiscio_ascecion_oblicuad_transcurrida_evento = (180 - $AOT) - 150;
                break;


            case ($AOT >= 180 && $AOT < 210):
                $antiscio_ascecion_oblicuad_transcurrida_evento = (210 - $AOT) + 330;
                break;


            case ($AOT >= 210 && $AOT < 240):
                $antiscio_ascecion_oblicuad_transcurrida_evento = (240 - $AOT) + 300;
                break;


            case ($AOT >= 240 && $AOT < 270):
                $antiscio_ascecion_oblicuad_transcurrida_evento = (270 - $AOT) + 270;
                break;



            case ($AOT >= 270 && $AOT < 300):
                $antiscio_ascecion_oblicuad_transcurrida_evento = (300 - $AOT) + 240;
                break;


            case ($AOT >= 300 && $AOT < 330):
                $antiscio_ascecion_oblicuad_transcurrida_evento = (330 - $AOT) + 210;
                break;
            case ($AOT >= 330 && $AOT < 360):
                $antiscio_ascecion_oblicuad_transcurrida_evento = (360 - $AOT) + 180;
                break;
        }

        switch ($AO) {
            case ($AO >= 0 && $AO < 30):
                $antiscio_ascension_oblique_evento = (30 - $AO) + 150;
                break;

            case ($AO >= 30 && $AO < 60):
                $antiscio_ascension_oblique_evento = (60 - $AO) + 120;
                break;


            case ($AO >= 60 && $AO < 90):
                $antiscio_ascension_oblique_evento = (90 - $AO) + 90;
                break;



            case ($AO >= 90 && $AO < 120):
                $antiscio_ascension_oblique_evento = (120 - $AO) + 60;
                break;


            case ($AO >= 120 && $AO < 150):
                $antiscio_ascension_oblique_evento = (150 - $AO) + 30;
                break;


            case ($AO >= 150 && $AO < 180):
                $antiscio_ascension_oblique_evento = (180 - $AO) - 150;
                break;


            case ($AO >= 180 && $AO < 210):
                $antiscio_ascension_oblique_evento = (210 - $AO) + 330;
                break;


            case ($AO >= 210 && $AO < 240):
                $antiscio_ascension_oblique_evento = (240 - $AO) + 300;
                break;


            case ($AO >= 240 && $AO < 270):
                $antiscio_ascension_oblique_evento = (270 - $AO) + 270;
                break;

            case ($AO >= 270 && $AO < 300):
                $antiscio_ascension_oblique_evento = (300 - $AO) + 240;
                break;


            case ($AO >= 300 && $AO < 330):
                $antiscio_ascension_oblique_evento = (330 - $AO) + 210;
                break;
            case ($AO >= 330 && $AO < 360):
                $antiscio_ascension_oblique_evento = (360 - $AO) + 180;
                break;
        }

        if ($antiscio_ascecion_oblicuad_transcurrida_evento > 360) {
            $antiscio_ascecion_oblicuad_transcurrida_evento = $antiscio_ascecion_oblicuad_transcurrida_evento - 360;
        }


        if ($antiscio_ascecion_oblicuad_transcurrida_evento >= 0 && $antiscio_ascecion_oblicuad_transcurrida_evento < 180) {

            $opuesto_antiscio_ascension_oblicuad_transcurrida_evento = $antiscio_ascecion_oblicuad_transcurrida_evento + 180;
        } else if ($antiscio_ascecion_oblicuad_transcurrida_evento >= 180 && $antiscio_ascecion_oblicuad_transcurrida_evento <= 360) {

            $opuesto_antiscio_ascension_oblicuad_transcurrida_evento = ($antiscio_ascecion_oblicuad_transcurrida_evento + 180) - 360;
        }

        if ($antiscio_ascension_oblique_evento > 360) {
            $antiscio_ascension_oblique_evento = $antiscio_ascension_oblique_evento - 360;
        }


        if ($antiscio_ascension_oblique_evento >= 0 && $antiscio_ascension_oblique_evento < 180) {
            $opuesto_antiscio_ascension_oblique_evento = $antiscio_ascension_oblique_evento + 180;
        } else if ($antiscio_ascension_oblique_evento >= 180 && $antiscio_ascension_oblique_evento <= 360) {
            $opuesto_antiscio_ascension_oblique_evento = ($antiscio_ascension_oblique_evento + 180) - 360;
        }

        $listado_actiscios = array(
            'antiscio_ascecion_oblicua_transcurrida_evento' => $antiscio_ascecion_oblicuad_transcurrida_evento,
            'antiscio_ascension_oblicua_evento' => $antiscio_ascension_oblique_evento,
            'opuesto_antiscio_ascension_oblicua_evento' => $opuesto_antiscio_ascension_oblique_evento,
            'opuesto_antiscio_ascension_oblicua_transcurrida_evento' => $opuesto_antiscio_ascension_oblicuad_transcurrida_evento
        );

        return $listado_actiscios;
    }

}
