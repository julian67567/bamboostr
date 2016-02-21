<?PHP
include ''.dirname(__FILE__).'/../../conexioni.php';
$identify_sender = $_GET["identify_sender"];
$identify_recipient = $_GET["identify_recipient"];
$id_token = $_GET["id_token"];
$red = $_GET["red"];
if($red=="twitter"){
  $query=$conn->query("SELECT * FROM mensajes WHERE id_token='".$id_token."' AND identify_sender='".$identify_sender."' AND identify_recipient='".$identify_recipient."' AND red='twitter' ORDER BY id_msg ASC") or die(mysqli_error($conn));
} else if($red=="facebook") {
  $query=$conn->query("SELECT * FROM mensajes WHERE id_token='".$id_token."' AND identify_sender='".$identify_sender."' AND identify_recipient='".$identify_recipient."' AND red='facebook' ORDER BY fecha ASC") or die(mysqli_error($conn));
}
if($query->num_rows>0){
  $c=0;
  $response_array = array();
  while($row=$query->fetch_assoc()){
    $obj = new stdclass();
    $obj->screen_name = $row["screen_name"];
	$obj->mensaje = $row["mensaje"];
	$obj->red = $row["red"];
    $obj->id_msg = $row["id_msg"];
    $obj->id_message = $row["id_message"];
    $obj->fecha = date("d-m-Y",$row["fecha"]);
    $obj->identify_sender = $row["identify_sender"];
	$obj->identify_recipient = $row["identify_recipient"];
	$obj->propietario = $row["propietario"];
    if($obj->propietario==0) {
      $obj->image_user = $row["image_user"];
    } else {
      $query2=$conn->query("SELECT foto FROM token WHERE identify='".$row["identify_recipient"]."' AND red='".$row["red"]."'") or die(mysqli_error($conn));
      $row2=$query2->fetch_assoc();
      $obj->image_user = $row2["foto"];
    }
	$obj->propietario_screen_name = $row["propietario_screen_name"];
	$obj->propietario2_screen_name = $row["propietario2_screen_name"];
	$response_array[$c] = new stdclass();
    $response_array[$c] = $obj;
    $c++;
  }
  $response = new stdclass();
  $response->data = $response_array;
  echo json_encode($response);

} else {
  $obj = new stdclass();
  $obj->success = "false";
  echo json_encode($obj);
}
?>