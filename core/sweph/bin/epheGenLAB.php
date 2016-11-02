<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Expose-Headers: Access-Control-Allow-Origin");

 // $ephemerideExec = "swetest.exe -b19.7.1989 -ut21:10 -p0123456789DAtxo    -fPlZ -house-76.5222,+3.4206,T ";

//$ephemerideExec = "swete32.exe -b19.7.1989 -p0123456789DAt  -fPlZ -house-76.5225,+3.43722,t -ut21:10";
 
 //OK $ephemerideExec = "swetest.exe -b11.6.1981 -ut02:30 -p0123456789xDat   -fPlZBLDa -house-76.5225,+3.4372222222222,T ";
 $ephemerideExec = "swetest.exe -b11.6.1981 -ut02:30 -p0123456789xat -fPlZblda  -house-76.5225,+3.4372222222222,T ";

//$ephemerideExec = "swetest.exe -b19.7.1989 -ut21:10:00";
//$ephemerideExec = "swetest.exe -bj2447727.381944445";

$aOutput = array();
exec($ephemerideExec, $aOutput);
echo json_encode($aOutput);




echo "-------->". tan(0.536207611);