<?PHP
$identify = escapeshellarg($_GET["identify"]);
$red = escapeshellarg($_GET["red"]);
$option = escapeshellarg($_GET["option"]);

//infomundoorg
//$identify = "'979843226'";

//codelogman
//$identify="'1576008097'";

//sabesaveinte
//$identify="'2225411100'";

//boogapp
//$identify="'2187335167'";

//rocio_de_la_luz
//$identify="'904462422'";

//Anahuac del sur
//$identify="'89787003'";

//Jeremy
//$identify="'88341174'";

//JOYSTICK_GAMES_
//$identify="'2799190940'";

//GAMEPLAY_YT
//$identify="'386299312'";

//V147_
//$identify="'2904424445'";

//$option = "'muestreo'";

//muestreo seguidores
if(strpos($option,"muestreo1")!==false){
  $exec_query=exec('php-cli -f get-twitter-muestreo-cron.php '.$identify.' /dev/null 2>&1',$response,$exit);
  print_r($response[0]);
}
//bots y demás (seguidores)
if(strpos($option,"muestreo2")!==false){
  $exec_query=exec('php-cli -f ../../scripts/get-twitter-muestreo.php '.$identify.' '.$red.' /dev/null 2>&1',$response,$exit);
  print_r($response[0]);
}
//hombres y mujeres (seguidores)
if(strpos($option,"muestreo3")!==false){
  $exec_query=exec('php-cli -f ../../scripts/get-twitter-muestreo2.php '.$identify.' '.$red.' /dev/null 2>&1',$response,$exit);
  print_r($response[0]);
}
// muestreo siguiendo
if(strpos($option,"muestreo4")!==false){
  $exec_query=exec('php-cli -f get-twitter-muestreo2-cron.php '.$identify.' '.$red.' /dev/null 2>&1',$response,$exit);
  print_r($response[0]);
}
// Bots y demás (siguiendo)
if(strpos($option,"muestreo5")!==false){
  $exec_query=exec('php-cli -f ../../scripts/get-twitter-muestreo3.php '.$identify.' '.$red.' /dev/null 2>&1',$response,$exit);
  print_r($response[0]);
}
?>