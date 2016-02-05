<?PHP
ini_set('max_execution_time', 900000);
include '../../conexioni.php';
$id_token = $_GET["id_token"];
$query=$conn->query("SELECT n.* FROM (SELECT m.* FROM (SELECT * FROM mensajes WHERE id_token='".$id_token."' ORDER BY id_msg DESC) m GROUP BY m.identify_sender,m.identify_recipient) n ORDER BY fecha DESC") or die(mysqli_error($conn));
if($query->num_rows>0){
  $c=0;
  $response_array = array();
  while($row=$query->fetch_assoc()){
    $obj = new stdclass();
    $obj->id = $row["id"];
    $obj->id_token = $row["id_token"];
    $obj->id_msg = $row["id_msg"];
    $obj->id_message = $row["id_message"];
    $obj->identify_sender = $row["identify_sender"];
	$obj->identify_recipient = $row["identify_recipient"];
    $obj->screen_name = $row["screen_name"];
    $obj->name = $row["name"];
    $obj->image_user = $row["image_user"];
    $obj->mensaje = $row["mensaje"];
    $obj->fecha = date("d-m-Y",$row["fecha"]);
    $obj->red = $row["red"];
    $obj->read = $row["read"];
	$obj->propietario = $row["propietario"];
    $obj->pin = $row["pin"];
    $obj->delete = $row["delete"];
    $obj->deletePerm = $row["deletePerm"];
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