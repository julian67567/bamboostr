<?PHP
$option = escapeshellarg($_GET["option"]);
$id_token = escapeshellarg($_GET["id_token"]);
$red = escapeshellarg($_GET["red"]);
$identify = escapeshellarg($_GET["identify"]);
$id = escapeshellarg($_GET["id"]);
$est = escapeshellarg($_GET["est"]);
$identify_sender = escapeshellarg($_GET["identify_sender"]);
$identify_recipient = escapeshellarg($_GET["identify_recipient"]);
if(strpos($option,"sendDmsTwitter")!==false){
  $screen_name = escapeshellarg($_GET["screen_name"]);
  $dm_name = escapeshellarg($_GET["dm_name"]);
  $text = escapeshellarg($_GET["text"]);
  //echo "".$text." ".$dm_name."";
  $option2 = escapeshellarg($_GET["option2"]);
  $exec_query=exec('php-cli -f thread-gets.php '.$option.' '.$dm_name.' '.$text.' '.$screen_name.' /dev/null 2>&1',$response,$exit);
}
if(strpos($option,"eliminarDm")!==false){
  $option2 = escapeshellarg($_GET["option2"]);
  $exec_query=exec('php-cli -f thread-gets.php '.$option.' '.$id.' '.$option2.' '.$id_token.' /dev/null 2>&1',$response,$exit);
}
if(strpos($option,"setDMSCon")!==false){
  $exec_query=exec('php-cli -f thread-gets.php '.$option.' '.$id_token.' /dev/null 2>&1',$response,$exit);
}
if(strpos($option,"setDMSTwitter")!==false){
  $exec_query=exec('php-cli -f thread-gets.php '.$option.' '.$id_token.' '.$identify.' /dev/null 2>&1',$response,$exit);
}
if(strpos($option,"setDMSFacebook")!==false){
  $exec_query=exec('php-cli -f thread-gets.php '.$option.' '.$id_token.' '.$identify.' /dev/null 2>&1',$response,$exit);
}
if(strpos($option,"getDMS")!==false){
  $exec_query=exec('php-cli -f thread-gets.php '.$option.' '.$id_token.' /dev/null 2>&1',$response,$exit);
}
if(strpos($option,"setPinDMS")!==false){
  $exec_query=exec('php-cli -f thread-gets.php '.$option.' '.$id_token.' '.$id.' '.$est.' /dev/null 2>&1',$response,$exit);
}
if(strpos($option,"getConversation")!==false){
  $exec_query=exec('php-cli -f thread-gets.php '.$option.' '.$id_token.' '.$identify_sender.' '.$red.' '.$identify_recipient.' /dev/null 2>&1',$response,$exit);
}
if(strpos($option,"setReadDMS")!==false){
  $exec_query=exec('php-cli -f thread-gets.php '.$option.' '.$id_token.' '.$identify.' /dev/null 2>&1',$response,$exit);
}
if(strpos($option,"setReadAllDMS")!==false){
  $exec_query=exec('php-cli -f thread-gets.php '.$option.' '.$id_token.' /dev/null 2>&1',$response,$exit);
}
if(strpos($option,"setReadAllAi")!==false){
  $exec_query=exec('php-cli -f thread-gets.php '.$option.' '.$id_token.' /dev/null 2>&1',$response,$exit);
}
print_r($response[0]);
?>