<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Expose-Headers: Access-Control-Allow-Origin");

$nameEpheUser = $_POST["nombre"];
$mailEpheUser = $_POST["mail"];
$countryCode = $_POST["countryCode"];
$dstOffset = $_POST["dstOffset"];
$gmtOffset = $_POST["gmtOffset"];
$epheRegisterDate = $_POST["epheRegisterDate"];
$epheRegisterTime = $_POST["epheRegisterTime"];
$isSummerTime = $_POST["isSummerTime"];
$lng = $_POST["lng"];
$lat = $_POST["lat"];
$nameDpto = $_POST["nameDpto"];
$namePais = $_POST["namePais"];
$nombreCiudad = $_POST["nombreCiudad"];
$timeZoneId = $_POST["timeZoneId"];



//**************************************
//TRANSFORMACION DE FECHAS A FORMATHO EPHEGEN

$arrayFechaPost = explode("/", $epheRegisterDate);

$intYear = intval($arrayFechaPost[2]);
$intMonth = intval($arrayFechaPost[1]);
$intDay = intval($arrayFechaPost[0]);

$formatBirthDate = $intDay . "." . $intMonth . "." . $intYear;


//**************************************
//**************************************
//AUMENTO HORA VERANO
//**************************************
//**************************************

$arrayTimePost = explode(":", $epheRegisterTime);

$intHour = intval($arrayTimePost[0]);
$intMin = intval($arrayTimePost[1]);


if ($isSummerTime == "true") {
    $intHour = $intHour + 1;
}


//**************************************
//**************************************
//AUMENTO LA HORA DE GMT


$gmtOffsetInt = intval($gmtOffset);

if ($gmtOffsetInt < 0) {
    $gmtOffsetInt = $gmtOffsetInt * (-1);

    $intHour = $intHour + $gmtOffsetInt;
} else {
    $intHour = $intHour - $gmtOffsetInt;
}


$formatTimeDate = $intHour . ":" . $intMin;

//**************************************
$ephemerideExec = "swete32.exe -b19.7.1989 -p0123456789DAt  -fPlZ -house-76.5225,+3.43722,t -ut21:10";
//$ephemerideExec = "swete32.exe -b" . $formatBirthDate . " -p0123456789DAt  -fPlZ -house" . $lng . "," . $lat . ",t -ut" . $formatTimeDate . "";

echo "<br>******************************************<br>";
echo $ephemerideExec;
echo "<br>******************************************<br>";
 

$aOutput = array();
exec($ephemerideExec, $aOutput);
echo json_encode($aOutput);

