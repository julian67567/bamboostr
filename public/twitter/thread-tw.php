<?PHP
$screen_name = escapeshellarg($_GET["screen_name"]);
$seguir = escapeshellarg($_GET["seguir"]);
$cont = escapeshellarg($_GET["cont"]);
$max_id = escapeshellarg($_GET["max_id"]); 
$option = escapeshellarg($_GET["option"]);
if(strpos($option,"getTweets")!==false){
  if($max_id) {
    $exec_query=exec('php-cli -f get-tweets.php '.$screen_name.' '.$cont.' '.$max_id.' /dev/null 2>&1',$response,$exit);
  } else { 
    $exec_query=exec('php-cli -f get-tweets.php '.$screen_name.' '.$cont.' /dev/null 2>&1',$response,$exit);
  }
  print_r($response[0]);
}
if(strpos($option,"getFeeds")!==false){
  if($max_id) {
    $exec_query=exec('php-cli -f get-feeds.php '.$screen_name.' '.$cont.' '.$max_id.' /dev/null 2>&1',$response,$exit);
  } else { 
    $exec_query=exec('php-cli -f get-feeds.php '.$screen_name.' '.$cont.' /dev/null 2>&1',$response,$exit);
  }
  print_r($response[0]);
}
if(strpos($option,"getDMS")!==false){
  if($max_id) {
    $exec_query=exec('php-cli -f get-dms.php '.$screen_name.' '.$cont.' '.$max_id.' /dev/null 2>&1',$response,$exit);
  } else { 
    $exec_query=exec('php-cli -f get-dms.php '.$screen_name.' '.$cont.' /dev/null 2>&1',$response,$exit);
  }
  print_r($response[0]);
}
if(strpos($option,"getMentions")!==false){
  if($max_id) {
    $exec_query=exec('php-cli -f get-mentions.php '.$screen_name.' '.$cont.' '.$max_id.' /dev/null 2>&1',$response,$exit);
  } else { 
    $exec_query=exec('php-cli -f get-mentions.php '.$screen_name.' '.$cont.' /dev/null 2>&1',$response,$exit);
  }
  print_r($response[0]);
}
if(strpos($option,"unFollowingMe")!==false){
  $quitar = escapeshellarg($_GET["quitar"]);
  $exec_query=exec('php-cli -f get-who-is-not-following-me.php '.$screen_name.' '.$quitar.' /dev/null 2>&1',$response,$exit);
  print_r($response[0]);
}
if(strpos($option,"getTwitterSS")!==false){
  $exec_query=exec('php-cli -f ../scripts/get-twitter-SS.php '.$screen_name.' /dev/null 2>&1',$response,$exit);
  print_r($response[0]);
}
if(strpos($option,"getTwitterNotFollowingMe")!==false){
  $option2 = escapeshellarg($_GET["option2"]);
  $exec_query=exec('php-cli -f ../scripts/get-twitter-NotFollowingMe.php '.$screen_name.' '.$option2.' /dev/null 2>&1',$response,$exit);
  print_r($response[0]);
}
if(strpos($option,"postFollow")!==false){
  $seguidores = escapeshellarg($_GET["seguidores"]);
  $siguiendo = escapeshellarg($_GET["siguiendo"]);
  $id_token = escapeshellarg($_GET["id_token"]);
  $exec_query=exec('php-cli -f post-follow.php '.$screen_name.' '.$seguir.' '.$seguidores.' '.$siguiendo.' '.$id_token.' /dev/null 2>&1',$response,$exit);
  print_r($response[0]);
}
if(strpos($option,"postUnfollow")!==false){
  $id_token = escapeshellarg($_GET["id_token"]);
  $exec_query=exec('php-cli -f post-unfollow.php '.$screen_name.' '.$seguir.' "1" "1" '.$id_token.' /dev/null 2>&1',$response,$exit);
  print_r($response[0]);
}
if(strpos($option,"delDms")!==false){
  $exec_query=exec('php-cli -f del-dms.php '.$screen_name.' /dev/null 2>&1',$response,$exit);
  print_r($response[0]);
}
if(strpos($option,"spam")!==false){
  $spam = escapeshellarg($_GET["spam"]);
  $id_token = escapeshellarg($_GET["id_token"]);
  $exec_query=exec('php-cli -f post-spam.php '.$screen_name.' '.$spam.' '.$id_token.' /dev/null 2>&1',$response,$exit);
  print_r($response[0]);
}
if(strpos($option,"details")!==false){
  $options = escapeshellarg($_GET["options"]);
  $id_token = escapeshellarg($_GET["id_token"]);
  $exec_query=exec('php-cli -f get-user-details.php '.$screen_name.' '.$options.' '.$id_token.' /dev/null 2>&1',$response,$exit);
  print_r($response[0]);
}
if(strpos($option,"trends")!==false){
  $country = escapeshellarg($_GET["country"]);
  $exec_query=exec('php-cli -f get-trending.php '.$screen_name.' '.$country.' /dev/null 2>&1',$response,$exit);
  print_r($response[0]);
}
?>