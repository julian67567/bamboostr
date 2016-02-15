<?PHP
include ''.dirname(__FILE__).'/../conexioni.php';
$id_token = $_GET["id_token"];
$token = $_GET["token"];
$query = $conn->query("UPDATE token SET dev_token='".$token."' WHERE id='".$id_token."'") OR DIE(mysqli_error($conn));
if($query===true){
  $obj = new stdclass();
  $obj->success = "true";
  echo json_encode($obj);
} else {
  $obj = new stdclass();
  $obj->success = "false";
  echo json_encode($obj);
}
$conn->close();
?>