<?php
include '../../facebook/src/Facebook/config.php';
include '../adsConf.php';
include '../../conexioni.php';
include '../../scripts/funciones.php';
$identify_account = $_POST["identify_account"];
$identify = $_POST["identify"];
$tipo = $_POST["tipo"];
$red = $_POST["red"];
$post = $_POST["post"];
$query = $conn->query("SELECT access_token FROM token WHERE identify='".$identify_account."' AND red='facebook'");
if($query->num_rows>0){
  $row=$query->fetch_assoc();
  $access_token = $row["access_token"];
} else {
  $access_token = "";
}
if(is_null($access_token) || is_null($app_id) || is_null($app_secret)) {
  throw new \Exception(
    'You must set your access token, app id and app secret before executing'
  );
}
//$account_id

$url = 'https://graph.facebook.com/v2.4/'.$account_id.'/generatepreviews?access_token='.$access_token.'&ad_format=DESKTOP_FEED_STANDARD&creative={"object_story_id":"'.$post.'"}';
echo getAjaxPhp($url);
?>
