<?php

header("Cache-Control: no-cache, no-store, must-revalidate, post-check=0, pre-check=0");
header("Pragma: no-cache");
header('Access-Control-Allow-Origin: *');

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_transactional extends MY_Controller {

    protected $language = "";

    public function __construct() {
        parent::__construct();
        $this->load->model('Cam');
    }

    function index() {
        
    }

    public function save_profile_image($id_usuario, $id_img_name) {

        $this->Cam->sqlUpdate("UPDATE personas SET " .
                " foto =  '" . $id_img_name . "' " .
                " WHERE id_persona=" . $id_usuario);

        return 1;
    }

    public function change_password($id_usuario, $change_new_pass) {
        $this->Cam->sqlUpdate("UPDATE personas SET " .
                " password =  '" . $change_new_pass . "' " .
                " WHERE id_persona=" . $id_usuario);

        return 1;
    }

    public function get_challenge($id_reto, $id_usuario) {

        $is_pay_challenge = $this->Cam->sql(" SELECT *  "
                . " FROM retos_x_persona rp, retos r  "
                . " WHERE rp.id_reto = " . $id_reto
                . " AND rp.id_persona = " . $id_usuario
                . " AND rp.pago = 1"
                . " AND rp.id_reto = r.id_reto");



        if (sizeof($is_pay_challenge) > 0) {
            //total de actividades por reto


            $numero_actividades_x_reto = $this->Cam->sql(" SELECT  count(*) as total_actividades "
                    . " FROM actividad_reto "
                    . " WHERE id_reto = " . $id_reto);



            //total de actividades completadas por reto

            $numero_actividades_x_reto_completadas = $this->Cam->sql(" SELECT  count(*) as total_actividades_completadas "
                    . " FROM actividad_reto ar, respuesta_actividad_reto rar "
                    . " WHERE rar.respuesta_examen !=0 "
                    . " AND rar.id_actividad_reto = ar.id_actividad_reto "
                    . " AND ar.id_reto = " . $id_reto);

            //siguiente actividad
            //----> se genera un random de las actividades por reto

            $id_nex_activity = $this->Cam->sql(" SELECT ar.id_actividad_reto "
                    . " FROM actividad_reto ar "
                    . " WHERE ar.id_reto = " . $id_reto);


            $id_actividad_reto_nuevo_proximo = 0;

            foreach ($id_nex_activity as $activity) {
                $id_actividad_reto_random = $activity["id_actividad_reto"];
                $id_actividad_reto_nuevo = $this->is_questions_answer_by_user($id_actividad_reto_random, $id_usuario);
                if ($id_actividad_reto_nuevo == 0) {
                    $id_actividad_reto_nuevo = $this->is_questions_answer_by_user($id_actividad_reto_random, $id_usuario);
                } else {
                    $id_actividad_reto_nuevo_proximo = $id_actividad_reto_random;
                }
            }

            $arrayReturn = array(
                "status" => "SUCCESS",
                "reto" => $is_pay_challenge,
                "numero_actividades_x_reto" => $numero_actividades_x_reto,
                "numero_actividades_x_reto_completadas" => $numero_actividades_x_reto_completadas,
                "id_actividad_reto_nuevo" => $id_actividad_reto_nuevo_proximo
            );
            return $arrayReturn;
        } else {
            $arrayReturn = array(
                "status" => "ERROR",
                "message" => "El usuario no esta vinculado a este reto."
            );
            return $arrayReturn;
        }
    }

    public function is_questions_answer_by_user($id_actividad_reto, $id_usuario) {
        $answer_to_acvtivity = $this->Cam->sql(" SELECT * "
                . " FROM respuesta_actividad_reto "
                . " WHERE id_actividad_reto = " . $id_actividad_reto
                . " AND respuesta_examen  != 0 "
                . " AND id_persona = " . $id_usuario);
        if (sizeof($answer_to_acvtivity) > 0) {
            return 0;
        } else {
            return intval($id_actividad_reto);
        }
    }

    public function get_prismary_challenge_by_user_id($id_usuario) {



        $listado_retos = $this->Cam->sql(" SELECT  "
                . " id_reto_primordial, nombre,reflexion_desc "
                . " FROM reto_primordial ");


        $respuesta_reto_primordial = $this->Cam->sql(" SELECT * "
                . " FROM respuesta_reto_primordial "
                . " WHERE id_persona = " . $id_usuario
                . " AND id_reto_primordial = ("
                . "    SELECT MAX(id_reto_primordial) "
                . "    FROM respuesta_reto_primordial "
                . " )");

        $id_last_primary_challenge_open = intval($respuesta_reto_primordial[0]["id_reto_primordial"]);

        $answer_last_primary_challenge_open = $respuesta_reto_primordial[0]["respuesta"];
        echo sizeof($listado_retos);
    }

    public function get_primary_challenge_by_user_id($id_usuario) {



        $listado_retos = $this->Cam->sql(" SELECT  "
                . " id_reto_primordial, nombre,reflexion_desc "
                . " FROM reto_primordial ");


        $respuesta_reto_primordial = $this->Cam->sql(" SELECT * "
                . " FROM respuesta_reto_primordial "
                . " WHERE id_persona = " . $id_usuario
                . " AND id_reto_primordial = ("
                . "    SELECT MAX(id_reto_primordial) "
                . "    FROM respuesta_reto_primordial "
                . " )");




        $reto_primordial = null;
        $respuesta_usuario = null;


        $id_nuevo_reto_primordial = 0;

        if (sizeof($respuesta_reto_primordial) == 0) {
            //Enviar reto primordial dia #1 sin respuestas

            $id_nuevo_reto_primordial = 1;

            $reto_primordial = $this->Cam->sql(" SELECT * "
                    . " FROM reto_primordial "
                    . " WHERE id_reto_primordial = " . $id_nuevo_reto_primordial);
        } else {

            $id_last_primary_challenge_open = intval($respuesta_reto_primordial[0]["id_reto_primordial"]);
            $answer_last_primary_challenge_open = $respuesta_reto_primordial[0]["respuesta"];

            if (empty($answer_last_primary_challenge_open)) {
                //no ha contestado el ultimo reto primordial

                $id_nuevo_reto_primordial = $id_last_primary_challenge_open;




                $reto_primordial = $this->Cam->sql(" SELECT * "
                        . " FROM reto_primordial "
                        . " WHERE id_reto_primordial = " . $id_nuevo_reto_primordial);
            } else {
                //ya lo contesto, mostrar el reto siguiente

                $challenge_size = sizeof($listado_retos);


                if ($challenge_size == $id_last_primary_challenge_open) {

                    $id_nuevo_reto_primordial = $id_last_primary_challenge_open;



                    $reto_primordial = $this->Cam->sql(" SELECT * "
                            . " FROM reto_primordial "
                            . " WHERE id_reto_primordial = " . $id_nuevo_reto_primordial);

                    $respuesta_usuario = $this->Cam->sql(" SELECT * "
                            . " FROM respuesta_reto_primordial "
                            . " WHERE id_reto_primordial = " . $id_nuevo_reto_primordial);
                } else {

                    $id_nuevo_reto_primordial = $id_last_primary_challenge_open + 1;

                    $reto_primordial = $this->Cam->sql(" SELECT * "
                            . " FROM reto_primordial "
                            . " WHERE id_reto_primordial = " . $id_nuevo_reto_primordial);
                }
            }
        }

        $arrayReturn = array(
            "status" => "SUCCESS",
            "id_reto_actual" => $id_nuevo_reto_primordial,
            "reto" => $reto_primordial,
            "retos_listado" => $listado_retos,
            "respuesta" => $respuesta_usuario
        );

        return $arrayReturn;
    }

    public function get_activity_challenge_by_id($id_actividad) {



        $listado_actividades_completadas = $this->Cam->sql(" SELECT  ar.id_actividad_reto , ar.nombre"
                . " FROM actividad_reto ar, respuesta_actividad_reto rar "
                . " WHERE rar.respuesta_examen != 0 "
                . " AND rar.id_actividad_reto = ar.id_actividad_reto "
                . " AND ar.id_actividad_reto = " . $id_actividad);


        $actividad_reto = $this->Cam->sql(" SELECT * "
                . " FROM actividad_reto "
                . " WHERE id_actividad_reto = " . $id_actividad);

        $arrayReturn = array(
            "status" => "SUCCESS",
            "actividad_reto" => $actividad_reto,
            "listado_actividades_completadas" => $listado_actividades_completadas
        );

        return $arrayReturn;
    }

    public function get_ephe_data_by_user_id($id_usuario) {


        $usuarioxepehmeride = $this->Cam->sql(" SELECT * "
                . " FROM usuarioxepehmeride "
                . " WHERE idusuario =" . $id_usuario);

        $ascendente_personas = $this->Cam->sql(" SELECT * "
                . " FROM ascendente_personas "
                . " WHERE idusuario =" . $id_usuario);


        $signo = 0;
        switch ($ascendente_personas[0]["zodiac_sign_planet"]) {
            case "ar":
                $signo = 1;
                break;
            case "ta":
                $signo = 2;
                break;
            case "ge":
                $signo = 3;
                break;
            case "cn":
                $signo = 4;
                break;
            case "le":
                $signo = 5;
                break;
            case "vi":
                $signo = 6;
                break;
            case "li":
                $signo = 7;
                break;
            case "sc":
                $signo = 8;
                break;
            case "sa":
                $signo = 9;
                break;
            case "cp":
                $signo = 10;
                break;
            case "aq":
                $signo = 11;
                break;
            case "pi":
                $signo = 12;
                break;
            case 0:
                $signo = 1;
                break;
        }


        $id_user_component = $usuarioxepehmeride[0]["idsalmo"];





        $usuario_componentes = $this->Cam->sql(" SELECT * "
                . " FROM nombres_dios nd, salmos s, angeles a, "
                . " combinacion_letras cl, meditaciones m, propositos p "
                . " WHERE nd.id_salmo = s.id_salmo "
                . " AND nd.id_angel  = a.id_angel "
                . " AND nd.id_combinacion = cl.id_combinacion "
                . " AND nd.id_proposito = p.id_proposito "
                . " AND nd.id_meditacion = m.id_meditacion "
                . " AND nd.id_nombre_dios = " . $id_user_component);

        $planos_sol = $this->Cam->sql(" SELECT * "
                . " FROM planetas_personas pp, plano_signo_planeta psp, planos p "
                . " WHERE pp.id_planeta = 1 "
                . " AND psp.id_plano = p.id_plano  "
                . " AND pp.id_planeta = psp.id_planeta  "
                . " AND pp.id_signo_zodiacal = psp.id_signo_zodiacal  "
                . " AND pp.id_persona =  " . $id_usuario);

        $planos_luna = $this->Cam->sql(" SELECT * "
                . " FROM planetas_personas pp, plano_signo_planeta psp, planos p "
                . " WHERE pp.id_planeta = 2 "
                . " AND psp.id_plano = p.id_plano  "
                . " AND pp.id_planeta = psp.id_planeta  "
                . " AND pp.id_signo_zodiacal = psp.id_signo_zodiacal  "
                . " AND pp.id_persona =  " . $id_usuario);

        $planos_mercurio = $this->Cam->sql(" SELECT * "
                . " FROM planetas_personas pp, plano_signo_planeta psp, planos p "
                . " WHERE pp.id_planeta = 3 "
                . " AND psp.id_plano = p.id_plano  "
                . " AND pp.id_planeta = psp.id_planeta  "
                . " AND pp.id_signo_zodiacal = psp.id_signo_zodiacal  "
                . " AND pp.id_persona =  " . $id_usuario);

        $planos_venus = $this->Cam->sql(" SELECT * "
                . " FROM planetas_personas pp, plano_signo_planeta psp, planos p "
                . " WHERE pp.id_planeta = 4 "
                . " AND psp.id_plano = p.id_plano  "
                . " AND pp.id_planeta = psp.id_planeta  "
                . " AND pp.id_signo_zodiacal = psp.id_signo_zodiacal  "
                . " AND pp.id_persona =  " . $id_usuario);


        $planos_marte = $this->Cam->sql(" SELECT * "
                . " FROM planetas_personas pp, plano_signo_planeta psp, planos p "
                . " WHERE pp.id_planeta = 5 "
                . " AND psp.id_plano = p.id_plano  "
                . " AND pp.id_planeta = psp.id_planeta  "
                . " AND pp.id_signo_zodiacal = psp.id_signo_zodiacal  "
                . " AND pp.id_persona =  " . $id_usuario);

        $planos_saturno = $this->Cam->sql(" SELECT * "
                . " FROM planetas_personas pp, plano_signo_planeta psp, planos p "
                . " WHERE pp.id_planeta = 7 "
                . " AND psp.id_plano = p.id_plano  "
                . " AND pp.id_planeta = psp.id_planeta  "
                . " AND pp.id_signo_zodiacal = psp.id_signo_zodiacal  "
                . " AND pp.id_persona =  " . $id_usuario);

        $planos_jupiter = $this->Cam->sql(" SELECT * "
                . " FROM planetas_personas pp, plano_signo_planeta psp, planos p "
                . " WHERE pp.id_planeta = 6 "
                . " AND psp.id_plano = p.id_plano  "
                . " AND pp.id_planeta = psp.id_planeta  "
                . " AND pp.id_signo_zodiacal = psp.id_signo_zodiacal  "
                . " AND pp.id_persona =  " . $id_usuario);

        $planos_ascendente = $this->Cam->sql(" SELECT * "
                . " FROM   plano_signo_planeta psp , planos p "
                . " WHERE psp.id_ascendente = " . $signo
                . " AND psp.id_plano = p.id_plano  ");




        $color_nombre_dios = $this->Cam->sql(" SELECT * "
                . " FROM   colores_nombre_dios cd, colores c "
                . " WHERE cd.id_nombre_dios = " . $id_user_component
                . " AND cd.id_color = c.id_color ");


        $color_ascendente = $this->Cam->sql(" SELECT * "
                . " FROM signos_zodiacales sz , colores c"
                . " WHERE sz.id_signo_zodiacal = " . $signo
                . " AND sz.id_color_signo = c.id_color ");


        $colores_planetas = $this->Cam->sql(" SELECT * "
                . " FROM colores_planetas"
                . " WHERE  id_color_planeta  = 1 "
                . "OR id_color_planeta = 2");



        $meditacion = $this->Cam->sql(" SELECT * "
                . " FROM  meditaciones "
                . " WHERE id_meditacion = " . $id_user_component);



        $planetas_persona = $this->Cam->sql(" SELECT * "
                . " FROM  planetas_personas "
                . " WHERE id_persona = " . $id_usuario);


        $zodiac_sign_position_grade = intval($planetas_persona[0]["zodiac_sign_position"]);
        $residuo_zodiac_sign_position_grade = $zodiac_sign_position_grade % 10;
        $nivel_desagregado = 1;


        switch ($residuo_zodiac_sign_position_grade) {
            case 1:
                $nivel_desagregado = 1;
                break;
            case 2:
                $nivel_desagregado = 2;
                break;
            case 3:
                $nivel_desagregado = 3;
                break;
            case 4:
                $nivel_desagregado = 4;
                break;
            case 5:
                $nivel_desagregado = 5;
                break;
            case 6:
                $nivel_desagregado = 1;
                break;
            case 7:
                $nivel_desagregado = 2;
                break;
            case 8:
                $nivel_desagregado = 3;
                break;
            case 9:
                $nivel_desagregado = 4;
                break;
            case 10:
                $nivel_desagregado = 5;
                break;
        }


        $id_proposito = $usuario_componentes[0]["id_proposito"];

        $proposito_desagregado = $this->Cam->sql(" SELECT * "
                . " FROM  propositos_desagregados "
                . " WHERE id_proposito = " . $id_proposito
                . " AND nivel = " . $nivel_desagregado);


        $arrayReturn = array(
            "status" => "SUCCESS",
            "proposito_desagregado" => $proposito_desagregado,
            "components" => $usuario_componentes,
            "planos_sol" => $planos_sol,
            "planos_luna" => $planos_luna,
            "planos_mercurio" => $planos_mercurio,
            "planos_venus" => $planos_venus,
            "planos_jupiter" => $planos_jupiter,
            "planos_marte" => $planos_marte,
            "planos_saturno" => $planos_saturno,
            "planos_ascendente" => $planos_ascendente,
            "color_nombre_dios" => $color_nombre_dios,
            "color_ascendente" => $color_ascendente,
            "colores_planetas" => $colores_planetas,
            "mandala" => "mandala_" . $id_user_component . ".png",
            "meditacion" => $meditacion
        );

        return $arrayReturn;
    }

    public function activate_login_acount($email, $pass, $event) {
        $person = $this->Cam->sql(" SELECT * "
                . " FROM personas "
                . " WHERE correo_electronico='" . $email . "'"
                . " AND password = '" . $pass . "'");


        if (sizeof($person) > 0) {

            $registro_eventos = $this->Cam->sql(" SELECT * "
                    . " FROM registro_eventos "
                    . " WHERE id_persona=" . $person[0]["id_persona"] . "");


            if ($registro_eventos[0]["fecha_evento_2"] == "") {
                $this->Cam->sqlUpdate("UPDATE registro_eventos SET " .
                        " fecha_evento_2 =   '" . $event["date"] . "', " .
                        " hora_evento_2 =  '" . $event["hour"] . "', " .
                        " lat_evento_2 =  '" . $event["lat"] . "', " .
                        " long_evento_2 = '" . $event["long"] . "' " .
                        " WHERE id_persona= " . $person[0]["id_persona"]);
            }

            $id_persona = $person[0]["id_persona"];

            $pago_persona_persona = $this->Cam->sql(" SELECT * "
                    . " FROM pagos_personas "
                    . " WHERE id_persona= " . $id_persona);

            $arrayReturn = array(
                "status" => "SUCCESS",
                "pago_persona" => $experience_persona,
                "is_user_activate" => 1,
                "id" => $id_persona,
                "fecha_nacimiento" => $person[0]["fecha_nacimiento"],
                "email" => $person[0]["correo_electronico"],
                "nombre" => $person[0]["nombre"] . " " . $person[0]["apellido"],
                "telefono1" => $person[0]["telefono1"],
                "telefono2" => $person[0]["telefono2"],
                "img_profile" => $person[0]["foto"]
            );

            return $arrayReturn;
        } else {
            return 0;
        }
    }

    public function aaaa() {
        $pago_persona_persona = $this->Cam->sql(" SELECT * "
                . " FROM pagos_personas "
                . " WHERE id_persona= 2 ");


        $is_pago_persona = 0;


        echo json_encode($pago_persona_persona);
    }

    public function get_resources() {
        $recursos = $this->Cam->sql(" SELECT * "
                . " FROM recursos_web ");

        echo json_encode($recursos);
    }

    public function login_acount($email, $pass) {

        $person = $this->Cam->sql(" SELECT * "
                . " FROM personas "
                . " WHERE correo_electronico='" . $email . "'"
                . " AND password = '" . $pass . "'");

        if (sizeof($person) > 0) {

            $id_persona = $person[0]["id_persona"];
            $token_registro = intval($person[0]["token_registro"]);



            $arrayReturn = null;

            if ($token_registro == -1) {


                $pago_persona_persona = $this->Cam->sql(" SELECT * "
                        . " FROM pagos_personas "
                        . " WHERE id_persona= " . $id_persona);




                $arrayReturn = array(
                    "status" => "SUCCESS",
                    "pago_persona" => json_encode($pago_persona_persona),
                    "is_user_activate" => 1,
                    "id" => $id_persona,
                    "fecha_nacimiento" => $person[0]["fecha_nacimiento"],
                    "email" => $person[0]["correo_electronico"],
                    "nombre" => $person[0]["nombre"] . " " . $person[0]["apellido"],
                    "telefono1" => $person[0]["telefono1"],
                    "telefono2" => $person[0]["telefono2"],
                    "img_profile" => $person[0]["foto"]
                );
            } else {
                $arrayReturn = array(
                    "status" => "ERROR",
                    "message" => "Usuario no activado, revisa tu correo electrónico o spam para activar tu cuenta en la comunidad inlife.",
                );
            }



            return $arrayReturn;
        } else {
            $arrayReturn = array(
                "status" => "ERROR",
                "message" => "Hubo un problema ingresar a tu cuenta, revisa tus datos e intentalo de nuvo más tarde.",
            );

            return $arrayReturn;
        }
    }

    public function activate_acount($id, $token, $event) {
        $person = $this->Cam->sql(" SELECT * "
                . " FROM personas "
                . " WHERE id_persona=" . $id . " "
                . " AND token_registro = '" . $token . "'");


        if (sizeof($person) > 0) {

            $this->Cam->sqlUpdate("UPDATE personas SET " .
                    " token_registro = '-1'" .
                    " WHERE id_persona=" . $id);

            $this->Cam->sqlUpdate("UPDATE registro_eventos SET " .
                    " fecha_evento_2 =   '" . $event["date"] . "', " .
                    " hora_evento_2 =  '" . $event["hour"] . "', " .
                    " lat_evento_2 =  '" . $event["lat"] . "', " .
                    " long_evento_2 = '" . $event["long"] . "' " .
                    " WHERE id_persona= " . $id);



            return 1;
        } else {
            return 0;
        }
    }

    public function save_answer_day_challenge($id_reto_primordial, $id_usuario, $calification, $respuesta_reto_dia) {


        $respuesta_reto_primordial = $this->Cam->sql(" SELECT * "
                . " FROM respuesta_actividad_reto "
                . " WHERE id_persona=" . $id_usuario . " "
                . " AND id_actividad_reto = " . $id_reto_primordial);


        $insert = false;

        if (sizeof($respuesta_reto_primordial) > 0) {
            $insert = $this->Cam->sqlUpdate("UPDATE respuesta_actividad_reto SET " .
                    " respuesta =  '$respuesta_reto_dia'," .
                    " respuesta_examen =  $calification" .
                    " WHERE id_persona=" . $id_usuario .
                    " AND id_actividad_reto = " . $id_reto_primordial);
        } else {
            $insert = $this->Cam->sqlInsert("INSERT INTO respuesta_actividad_reto " .
                    "(id_persona, id_actividad_reto, respuesta,respuesta_examen) " .
                    "VALUES (" .
                    "" . $id_usuario . ", " .
                    "" . $id_reto_primordial . ", " .
                    "" . $respuesta_reto_dia . ", " .
                    "'" . $calification . "'" .
                    ")" .
                    "");
        }


        if ($insert) {
            return 1;
        } else {
            return 0;
        }
    }

    public function register_user($data_user) {

        $is_mail_registered = $this->Cam->sql(" SELECT nombre "
                . " FROM personas "
                . " WHERE correo_electronico='" . $data_user["mail"] . "' ");

        if (sizeof($is_mail_registered) == 0) {

            $token_registro = uniqid();

            $id_user = $this->Cam->sqlInsertReturnId("INSERT INTO personas " .
                    "(nombre,apellido,fecha_nacimiento,hora_nacimiento,correo_electronico, "
                    . " password,pais_nacimiento,depto_nacimiento,ciudad_nacimiento,token_registro,lat,lng,telefono1,telefono2 ) " .
                    "VALUES (" .
                    "'" . $data_user["nombre"] . "', " .
                    "'" . $data_user["apellido"] . "', " .
                    "'" . $data_user["fecha_nacimiento"] . "', " .
                    "'" . $data_user["hora_nacimiento"] . "', " .
                    "'" . $data_user["mail"] . "', " .
                    "'" . $data_user["password"] . "', " .
                    "'" . $data_user["namePais"] . "', " .
                    "'" . $data_user["nameDpto"] . "', " .
                    "'" . $data_user["nombreCiudad"] . "'," .
                    "'" . $token_registro . "'," .
                    "'" . $data_user["lat"] . "'," .
                    "'" . $data_user["lng"] . "'," .
                    "'" . $data_user["phone1"] . "'," .
                    "'" . $data_user["phone2"] . "'" .
                    ")" .
                    "");



            $this->Cam->sqlInsert("INSERT INTO pagos_personas " .
                    "(id_persona,mapa_del_ser,reto_primordial ) " .
                    "VALUES (" .
                    "" . $id_user . ", " .
                    "0, " .
                    "0" .
                    ")" .
                    "");


            $data_user_return = array(
                "id" => $id_user,
                "token" => $token_registro
            );

            return $data_user_return;
        } else {
            return 0;
        }
    }

    public function register_simple_user($data_user) {

        $is_mail_registered = $this->Cam->sql(" SELECT nombre "
                . " FROM personas "
                . " WHERE correo_electronico='" . $data_user["mail"] . "' ");

        if (sizeof($is_mail_registered) == 0) {

           // $token_registro = uniqid()."_".uniqid();
            $token_registro = -1;

            $id_user = $this->Cam->sqlInsertReturnId("INSERT INTO personas " .
                    "(nombre,apellido,correo_electronico, "
                    . " password,token_registro) " .
                    "VALUES (" .
                    "'" . $data_user["nombre"] . "', " .
                    "'" . $data_user["apellido"] . "', " .
                    "'" . $data_user["mail"] . "', " .
                    "'" . $data_user["password"] . "', " .
                    "'" . $token_registro . "'" .
                    ")" .
                    "");



            $this->Cam->sqlInsert("INSERT INTO pagos_personas " .
                    "(id_persona,mapa_del_ser,reto_primordial ) " .
                    "VALUES (" .
                    "" . $id_user . ", " .
                    "0, " .
                    "0" .
                    ")" .
                    "");


            $data_user_return = array(
                "id" => $id_user,
                "token" => $token_registro
            );

            return $data_user_return;
        } else {
            return 0;
        }
    }

    public function register_registerform_event($event, $id_user) {

        $this->Cam->sqlInsert("INSERT INTO registro_eventos " .
                "(id_persona,	fecha_evento_1,hora_evento_1,lat_evento_1,long_evento_1 ) " .
                "VALUES (" .
                "" . $id_user . ", " .
                "'" . $event["date"] . "', " .
                "'" . $event["hour"] . "', " .
                "'" . $event["lat"] . "', " .
                "'" . $event["long"] . "'" .
                ")" .
                "");

        return 1;
    }

    public function register_to_inlife_event($idEvent, $id_user) {

        $this->Cam->sqlInsert("INSERT INTO experience_personas " .
                "(id_vital_experience,id_persona,pago) " .
                "VALUES (" .
                "" . $idEvent . ", " .
                "" . $id_user . ", " .
                "0" .
                ")" .
                "");

        return 1;
    }

}
