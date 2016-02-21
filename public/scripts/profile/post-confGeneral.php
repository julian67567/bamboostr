<?PHP
include ''.dirname(__FILE__).'/../../conexioni.php';
$identify = $_POST["identify"];
$mail = $_POST["mail"];
$notifications = $_POST["notifications"];
$feed_programados = $_POST["feed_programados"];
$feed_drafts = $_POST["feed_drafts"];
$feed_refresh = $_POST["feed_refresh"];
$red = $_POST["red"];

if($notifications=="true"){
  $notifications = 1;
} else {
  $notifications = 0;
}

if($feed_programados=="true"){
  $feed_programados = 1;
} else {
  $feed_programados = 0;
}

if($feed_drafts=="true"){
  $feed_drafts = 1;
} else {
  $feed_drafts = 0;
}

if($feed_refresh=="true"){
  $feed_refresh = 1;
} else {
  $feed_refresh = 0;
}

$query = $conn->query("UPDATE token SET mail='".$mail."', feed_drafts='".$feed_drafts."', notificaciones='".$notifications."', feed_programados='".$feed_programados."', feed_refresh='".$feed_refresh."' WHERE identify='".$identify."' AND red='".$red."'") or die(mysqli_error($conn));

$obj = new stdclass();
$obj->success = "true";

echo json_encode($obj);

$conn->close();
?>