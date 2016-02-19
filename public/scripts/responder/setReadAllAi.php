<?PHP
ini_set('max_execution_time', 900000);
include ''.dirname(__FILE__).'/../../conexioni.php';
$id_token = $_GET["id_token"];
$query=$conn->query("UPDATE notificaciones SET `read`='1' WHERE id_token='".$id_token."' AND tipo='asistente'") or die(mysqli_error($conn));
if($query===true){
  $obj = new stdclass();
  $obj->success = "true";
  echo json_encode($obj);
} else {
  $obj = new stdclass();
  $obj->success = "false";
  echo json_encode($obj);
}
?>