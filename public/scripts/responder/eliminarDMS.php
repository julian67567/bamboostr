<?PHP
include ''.dirname(__FILE__).'/../../conexioni.php';
$id = $_GET["id"];
$option2 = $_GET["option2"];
$id_token=$_GET["id_token"];
$obj = new stdclass();
if($id){
    $query = $conn->query("SELECT identify_sender, identify_recipient FROM mensajes WHERE id='".$id."'") or die(mysqli_error($conn));
    if($query->num_rows>0){
        $row=$query->fetch_assoc();
        if($option2=="1"){
          $query2 = $conn->query("UPDATE mensajes SET `delete`='1' WHERE id_token='".$id_token."' AND identify_sender='".$row['identify_sender']."' AND identify_recipient='".$row['identify_recipient']."'") or die(mysqli_error($conn));
        } else if($option2=="2") {
          $query2 = $conn->query("UPDATE mensajes SET `deletePerm`='1' WHERE id_token='".$id_token."' AND  identify_sender='".$row['identify_sender']."' AND identify_recipient='".$row['identify_recipient']."'") or die(mysqli_error($conn));    
        } else {
          $query2 = $conn->query("UPDATE mensajes SET `delete`='0' WHERE id_token='".$id_token."' AND  identify_sender='".$row['identify_sender']."' AND identify_recipient='".$row['identify_recipient']."'") or die(mysqli_error($conn));    
        }
        if($query2===true){
          $obj->success = "true";
          $obj->id = $id;
        } else {
          $obj->success = "false";
          $obj->id = $id;
        }
    } else {
      $obj->success = "false";
      $obj->id = $id;
    }
} else {
  $obj->success = "false";
  $obj->id = $id;
}
$conn->close;
echo json_encode($obj);
?>