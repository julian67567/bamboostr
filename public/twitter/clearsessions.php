<?php
include ''.dirname(__FILE__).'/../conexioni.php';
include ''.dirname(__FILE__).'/../scripts/funciones.php';
/* Load and clear sessions */
session_start();
$conn->query("DELETE FROM ssid WHERE id_token='".$_SESSION['id_token']."' AND ssid='".$_SESSION["sessionid"]."'") OR DIE(mysqli_error($conn));
session_unset();
session_destroy();
UNSET($_SESSION);
UNSET($_COOKIE);
/* Redirect to page with the connect to Twitter option. */
//tu página de aterrisaje debe de limpiar cookies
header('Location: http://'.getDirUrl(1).'/redirect.html');
?>