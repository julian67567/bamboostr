<?PHP
ini_set('max_execution_time', 900000);
include '../../conexioni.php';
$id_token = $_GET["id_token"];
$identify = $_GET["identify"];
$query=$conn->query("UPDATE mensajes SET `read`='1' WHERE id_token='".$id_token."' AND identify_sender='".$identify."'") or die(mysqli_error($conn));
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