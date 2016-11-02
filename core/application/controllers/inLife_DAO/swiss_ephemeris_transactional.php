<?php

header("Cache-Control: no-cache, no-store, must-revalidate, post-check=0, pre-check=0");
header("Pragma: no-cache");
header('Access-Control-Allow-Origin: *');

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Swiss_ephemeris_transactional extends MY_Controller {

    protected $language = "";

    public function __construct() {
        parent::__construct();
        $this->load->model('Cam');
    }

    function index() {
        
    }

    public function get_user_atral_ephemeride_data($epeh_array) {
        $ephemerideExec = "swetest.exe "
                . " -b" . $epeh_array['date'] . " "
                . " -ut" . $epeh_array['hour'] . " "
                . " -p0123456789mo "
                . " -fPlZblda  "
                . " -house" . $epeh_array['long'] . "," . $epeh_array['lat'] . ",T ";

        chdir(NLF_SWEET_ROOT_DOCUMENT_BIN);
        $aOutput = array();
        exec($ephemerideExec, $aOutput);






        return json_encode($aOutput);
    }

    public function store_id_components($sun_long_hour, $signo_sol, $id_user) {





        $usuarioxepehemeridearray = $this->Cam->sql("" .
                " SELECT * FROM zodiacoxplanetas z  " .
                " WHERE " . $sun_long_hour . " >= z.gradoinicial" .
                " AND " . $sun_long_hour . "  <= z.gradofinal " .
                "  AND z.idzodiaco = " . $signo_sol . " " .
                "");

        $idPosition = $usuarioxepehemeridearray[0]["idzodiacoxplanetas"];

        $this->Cam->sqlInsert("INSERT INTO usuarioxepehmeride " .
                "(idusuario,idzodiacoxplanetas,idproposito,idsalmo,idangel,idnombre) " .
                "VALUES (" .
                "" . $id_user . " , " .
                "" . $idPosition . " , " .
                "" . $idPosition . " , " .
                "" . $idPosition . " , " .
                "" . $idPosition . " , " .
                "" . $idPosition . "  " .
                ")" .
                "");
    }

    public function get_aspects_by_planets($arrayPlanetas, $idUsuario) {

        $aspectArray = array();
        $idPlaneta = 1;
        foreach ($arrayPlanetas as $planeta) {

            $long_converter_array = $this->_decimal_to_dms($planeta["long"]);
            $grado = $long_converter_array["deg"];





            $id_planeta_compare = 1;
            foreach ($arrayPlanetas as $planetaCompare) {

                if ($idPlaneta != $id_planeta_compare) {

                    $long_compare_converter_array = $this->_decimal_to_dms($planetaCompare["long"]);
                    $gradoCompare = $long_compare_converter_array["deg"];


                    $aspecto = abs($grado - $gradoCompare);



                    if (!in_array($aspecto, $aspectArray)) {

                        array_push($aspectArray, $aspecto);

                        $aspectoType = 0;

                        switch ($aspecto) {
                            case $aspecto >= -7 && $aspecto <= 7:
                                //conjunción
                                $aspectoType = 1;

                                break;
                            case $aspecto >= 53 && $aspecto <= 67:
                                //sextil
                                $aspectoType = 2;

                                break;
                            case $aspecto >= 83 && $aspecto <= 97:
                                //cuadratura
                                $aspectoType = 3;

                                break;
                            case $aspecto >= 113 && $aspecto <= 127:
                                //trígono
                                $aspectoType = 4;

                                break;
                            case $aspecto >= 173 && $aspecto <= 187:
                                //oposición
                                $aspectoType = 5;

                                break;
                        }

                        if ($aspectoType != 0) {

                            $this->Cam->sqlInsert("INSERT INTO aspectosxusuarioxephemeride " .
                                    "(idusuario,idaspecto,idplaneta,idplanetacompare,isascendant) " .
                                    "VALUES (" .
                                    "" . $idUsuario . " , " .
                                    "" . $aspectoType . " , " .
                                    "" . $idPlaneta . " , " .
                                    "" . $id_planeta_compare . " , " .
                                    "0 " .
                                    ")" .
                                    "");


                            $this->searchSendForUserByPlanetsAspects($idUsuario, $idPlaneta, $id_planeta_compare, $aspectoType);
                        }
                    }
                }
                $id_planeta_compare++;
            }



            $idPlaneta++;
        }
    }

    public function searchSendForUserByPlanetsAspects($idUsuario, $idPlaneta, $idPlanetaCompare, $aspectoType) {

        $sendero = $this->Cam->sql(" SELECT * FROM senderosxplanetasxaspectos "
                . " WHERE  idplaneta =  " . $idPlaneta
                . " AND idplanetacompare = " . $idPlanetaCompare
                . " AND idaspecto = " . $aspectoType);



        if (sizeof($sendero) > 0) {
            foreach ($sendero as $send) {
                $this->Cam->sqlInsert("INSERT INTO senderosxusuarios " .
                        "(id_persona,id_sendero ) " .
                        "VALUES (" .
                        "" . $idUsuario . " , " .
                        "" . $send['idsendero'] . "   " .
                        ")" .
                        "");
            }
        } else {
            $this->searchSendForUserByPlanetsAspectsInvert($idUsuario, $idPlaneta, $idPlanetaCompare, $aspectoType);
        }
    }

    public function searchSendForUserByPlanetsAspectsInvert($idUsuario, $idPlaneta, $idPlanetaCompare, $aspectoType) {

        $senderoInvert = $this->Cam->sql(" SELECT * FROM senderosxplanetasxaspectos "
                . " WHERE  idplaneta =  " . $idPlanetaCompare
                . " AND idplanetacompare = " . $idPlaneta
                . " AND idaspecto = " . $aspectoType);



        if (sizeof($senderoInvert) > 0) {

            foreach ($senderoInvert as $sendin) {
                $this->Cam->sqlInsert("INSERT INTO senderosxusuarios " .
                        "(id_persona,id_sendero ) " .
                        "VALUES (" .
                        "" . $idUsuario . " , " .
                        "" . $sendin['idsendero'] . "   " .
                        ")" .
                        "");
            }
        }
    }

    public function store_ascendant($ascendant, $id_user) {





        $this->Cam->sqlInsertReturnId("INSERT INTO ascendente_personas " .
                "( idusuario,longitud,zodiac_sign_position, zodiac_sign_planet ) " .
                " VALUES (" .
                "" . $id_user . ", " .
                "'" . $ascendant["long"] . "', " .
                "'" . $ascendant["zodiac_sign_position"] . "', " .
                "'" . $ascendant["zodiac_sign_planet"] . "' " .
                ")" .
                "");
    }

    public function store_eliptic_obliquity($eliptic_obliquity, $id_user) {



        $this->Cam->sqlInsertReturnId("INSERT INTO eliptic_obliquity_personas " .
                "( idusuario,eliptic_obliquity ) " .
                " VALUES (" .
                "" . $id_user . ", " .
                "'" . $eliptic_obliquity["val"] . "' " .
                ")" .
                "");
    }

    public function store_mc($MC, $id_user) {



        $this->Cam->sqlInsertReturnId("INSERT INTO mc_personas " .
                "( idusuario,longitud,zodiac_sign_position, zodiac_sign_planet ) " .
                " VALUES (" .
                "" . $id_user . ", " .
                "'" . $MC["long"] . "', " .
                "'" . $MC["zodiac_sign_position"] . "', " .
                "'" . $MC["zodiac_sign_planet"] . "' " .
                ")" .
                "");
    }

    public function store_armc($ARMC, $id_user) {

        $this->Cam->sqlInsertReturnId("INSERT INTO armc_personas " .
                "( idusuario,longitud,zodiac_sign_position, zodiac_sign_planet ) " .
                " VALUES (" .
                "" . $id_user . ", " .
                "'" . $ARMC["long"] . "', " .
                "'" . $ARMC["zodiac_sign_position"] . "', " .
                "'" . $ARMC["zodiac_sign_planet"] . "' " .
                ")" .
                "");
    }

    public function store_houses($houses_arrary, $id_user) {

        $id_house = 1;

        foreach ($houses_arrary as $house) {

            $this->Cam->sqlInsertReturnId("INSERT INTO casas_personas " .
                    "( idusuario,idcasa,name, "
                    . " topocentric_cut,zodiac_sign_position,zodiac_sign, "
                    . " oblique_ascension ) " .
                    " VALUES (" .
                    "" . $id_user . ", " .
                    "" . $id_house . ", " .
                    "'" . $house["name"] . "', " .
                    "'" . $house["topocentric_cut"] . "', " .
                    "'" . $house["zodiac_sign_position"] . "', " .
                    "'" . $house["zodiac_sign"] . "', " .
                    "'" . $house["oblique_ascension"] . "' " .
                    ")" .
                    "");
            $id_house++;
        }
    }

    public function store_planet($planets_arrary, $id_user) {

        $id_planet = 1;

        foreach ($planets_arrary as $planet) {

            $signo_letter = $planet["zodiac_sign"];
            $signo_id = 0;



            switch ($signo_letter) {
                case "ar":
                    $signo_id = 1;
                    break;
                case "ta":
                    $signo_id = 2;
                    break;
                case "ge":
                    $signo_id = 3;
                    break;
                case "cn":
                    $signo_id = 4;
                    break;
                case "le":
                    $signo_id = 5;
                    break;
                case "vi":
                    $signo_id = 6;
                    break;
                case "li":
                    $signo_id = 7;
                    break;
                case "sc":
                    $signo_id = 8;
                    break;
                case "sa":
                    $signo_id = 9;
                    break;
                case "cp":
                    $signo_id = 10;
                    break;
                case "aq":
                    $signo_id = 11;
                    break;
                case "pi":
                    $signo_id = 12;
                    break;
                case 0:
                    $signo_id = 1;
                    break;
            }

            $this->Cam->sqlInsertReturnId("INSERT INTO planetas_personas " .
                    "( id_persona,id_planeta,id_signo_zodiacal, "
                    . " longitud,latitud,zodiac_sign_position, "
                    . " declination,meridian_distance,ascencional_difference, "
                    . " semi_arc,meridian_oblique_distance,ascension_oblique, "
                    . " asntiscio,right_ascension ) " .
                    " VALUES (" .
                    "" . $id_user . ", " .
                    "" . $id_planet . ", " .
                    "" . $signo_id . ", " .
                    "'" . $planet["long"] . "', " .
                    "'" . $planet["lat"] . "', " .
                    "'" . $planet["zodiac_sign_position"] . "', " .
                    "'" . $planet["declination"] . "', " .
                    "'" . $planet["meridian_distance"] . "', " .
                    "'" . $planet["ascencional_difference"] . "', " .
                    "'" . $planet["semi_arc"] . "', " .
                    "'" . $planet["meridian_oblique_distance"] . "', " .
                    "'" . $planet["ascension_oblique"] . "', " .
                    "'" . $planet["asntiscio"] . "', " .
                    "'" . $planet["right_ascension"] . "' " .
                    ")" .
                    "");


            $id_planet++;
        }
    }

}
