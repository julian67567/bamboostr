<?php
include '../scripts/funciones.php';
session_start();
require_once('config-sample.php');
//$loginUrl = $instagram->getLoginUrl();
$url = "https://api.instagram.com/oauth/authorize/?client_id=".$CLIENT_ID_INSTAGRAM."&redirect_uri=http://".getDirUrl(1)."/system.php?agregarRed=instagram&response_type=code&scope=".$SCOPE_INSTAGRAM."";
//echo $url;
header("Location: ".$url."");
?>