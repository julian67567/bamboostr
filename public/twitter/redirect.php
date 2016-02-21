<?php
include ''.dirname(__FILE__).'/../conexioni.php';
include ''.dirname(__FILE__).'/../scripts/funciones.php';
/* Start session and load library. */
if($_GET["liberar"]==1){
  session_start();
  session_unset();
  session_destroy();
}
session_start();
require_once(''.dirname(__FILE__).'/twitteroauth/twitteroauth.php');
require_once(''.dirname(__FILE__).'/config-sample.php');
/* Build TwitterOAuth object with client credentials. */
$connection = new TwitterOAuth($consumer_key, $consumer_secret);
 
/* Get temporary credentials (Redirect). */
if($_SESSION['sessionid'] && $_SESSION['identify']){
  /* Limitar número de cuentas a vincular
  
  $query = $conn->query("SELECT tipo,social_networks FROM token WHERE id='".$_SESSION['id_token']."'") or die(mysqli_error($conn));
  $row = $query->fetch_assoc();
  $num_redes = explode(",",$row['social_networks']);
  $num_redes = (count($num_redes)-1);
  if($row['tipo']=="ent" || ($row['tipo']!="ent" && $row['tipo']!="pro" && $row['tipo']!="basic" && $num_redes<3) || ($row['tipo']=="basic" && $num_redes<5) || ($row['tipo']=="pro" && $num_redes<15)){
    $request_token = $connection->getRequestToken('http://'.getDirUrl(1).'/system.php?agregarRed=twitter');
  } else if($row['tipo']=="pro"){
    header('Location: http://'.getDirUrl(1).'/system.php?agregarRed=errorPro');  
    die();
  } else if($row['tipo']=="basic"){
    header('Location: http://'.getDirUrl(1).'/system.php?agregarRed=errorBasic'); 
    die();
  } else if($row['tipo']!="pro" && $row['tipo']!="basic" && $row['tipo']!="ent"){
    header('Location: http://'.getDirUrl(1).'/system.php?agregarRed=error'); 
    die();
  }
  */
  $request_token = $connection->getRequestToken('http://'.getDirUrl(1).'/system.php?agregarRed=twitter');

} else {
  $_SESSION['red'] = "twitter";
  $request_token = $connection->getRequestToken('http://'.getDirUrl(1).'/system.php');
}
/* Save temporary credentials to session. */
$_SESSION['oauth_token'] = $token = $request_token['oauth_token'];
$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
 
/* If last connection failed don't display authorization link. */
switch ($connection->http_code) {
  case 200:
    /* Build authorize URL and redirect user to Twitter. */
    $url = $connection->getAuthorizeURL($token);
    header('Location: ' . $url); 
    break;
  default:
    /* Show notification if something went wrong. */
    echo 'Could not connect to Twitter. Refresh the page or try again later.';
}
?>