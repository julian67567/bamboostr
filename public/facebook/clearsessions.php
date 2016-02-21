<?php
include ''.dirname(__FILE__).'/../conexioni.php';
include ''.dirname(__FILE__).'/../scripts/funciones.php';
$access_token=$_GET["access_token"];
$redirect=$_GET["redirect"];
 
/* Redirect to page with the connect to Twitter option. */
if($redirect==1){
  /* Load and clear sessions */
  session_start();
  $conn->query("DELETE FROM ssid WHERE id_token='".$_SESSION['id_token']."' AND ssid='".$_SESSION["sessionid"]."'") or die(mysqli_error($conn));
  session_unset();
  session_destroy();
  header('Location: https://www.facebook.com/logout.php?next=http://'.getDirUrl(1).'/redirect.html&access_token='.$access_token.'');
}
if($redirect==2){
  session_start();
  header('Location: https://www.facebook.com/logout.php?next=http://'.getDirUrl(1).'/facebook/redirect.php?redirect=2&access_token='.$access_token.'');
}
?>