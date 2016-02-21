<?PHP
ini_set('max_execution_time', 900000);
include ''.dirname(__FILE__).'/../../conexioni.php';
$id_token = $_GET["id_token"];
$est = $_GET["est"];
$id = $_GET["id"];
if($id){
    $query = $conn->query("SELECT identify_sender, identify_recipient FROM mensajes WHERE id='".$id."'") or die(mysqli_error($conn));
    if($query->num_rows>0){
        $row=$query->fetch_assoc();
        $query=$conn->query("UPDATE mensajes SET pin='".$est."' WHERE id_token='".$id_token."' AND identify_sender='".$row['identify_sender']."' AND identify_recipient='".$row['identify_recipient']."'") or die(mysqli_error($conn));
        if($query==="true"){
            $obj = new stdclass();
            $obj->success = "true";
            echo json_encode($obj);
        } else {
            $obj = new stdclass();
            $obj->success = "false";
            echo json_encode($obj);
        }
    } else {
      $obj = new stdclass();
      $obj->success = "false";
      echo json_encode($obj);
    }
} else {
  $obj = new stdclass();
  $obj->success = "false";
  echo json_encode($obj); 
}
?>