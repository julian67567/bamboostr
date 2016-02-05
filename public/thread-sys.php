<?PHP
$option = escapeshellarg($_GET["option"]);
$option2 = escapeshellarg($_GET["option2"]);
$option3 = escapeshellarg($_GET["option3"]);
$id_token = escapeshellarg($_GET["id_token"]);
$identify = escapeshellarg($_GET["identify"]);
$red = escapeshellarg($_GET["red"]);
if(strpos($option,"notificaciones")!==false){
  $exec_query=exec('php-cli -f thread-gets.php '.$option.' '.$identify.' '.$red.' '.$option3.' '.$id_token.' /dev/null 2>&1',$response,$exit);
}
if(strpos($option,"programMsgs")!==false){
  $exec_query=exec('php-cli -f thread-gets.php '.$option.' '.$id_token.' /dev/null 2>&1',$response,$exit);
}
if(strpos($option,"draftsMsgs")!==false){
  $exec_query=exec('php-cli -f thread-gets.php '.$option.' '.$id_token.' /dev/null 2>&1',$response,$exit);
}
if(strpos($option,"publicadosMsgs")!==false){
  $exec_query=exec('php-cli -f thread-gets.php '.$option.' '.$id_token.' /dev/null 2>&1',$response,$exit);
}
if(strpos($option,"mail")!==false){
  $exec_query=exec('php-cli -f thread-gets.php '.$option.' '.$id_token.' /dev/null 2>&1',$response,$exit);
}
if(strpos($option,"rastreo")!==false){
  $exec_query=exec('php-cli -f thread-gets.php '.$option.' '.$id_token.' '.$option2.' /dev/null 2>&1',$response,$exit);
}
if(strpos($option,"getCuentas")!==false){
  $exec_query=exec('php-cli -f thread-gets.php '.$option.' '.$id_token.' '.$identify.' /dev/null 2>&1',$response,$exit);
}
print_r($response[0]);
?>