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
$idioma = $_POST["idioma"];


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
// search?q=mexico&location_types=['country']&type=adgeolocation.
// search?q=musica&type=adinterest&locale=es -> intereses en español.
// search?q=musica&type=adinterest -> intereses en inglés.
// search?q=es&type=adlocale
// act_1771351523091610
// act_xxx/users  -> usuarios con permisos en ese ID Publish
// act_xxx/

if($_POST["search"]=="pais"){
  $url = 'https://graph.facebook.com/v2.4/search?access_token='.$access_token.'&q='.$_POST["q"].'&location_types=["country"]&type=adgeolocation&locale='.$idioma.'';
}
if($_POST["search"]=="idioma"){
  $url = 'https://graph.facebook.com/v2.4/search?access_token='.$access_token.'&q='.$_POST["q"].'&type=adlocale';
}
if($_POST["search"]=="intereses"){
  $url = 'https://graph.facebook.com/v2.4/search?access_token='.$access_token.'&q='.$_POST["q"].'&type=adinterest&locale='.$idioma.'';
}

echo getAjaxPhp($url);
?>
