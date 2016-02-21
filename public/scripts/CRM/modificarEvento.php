<?PHP
ini_set('max_execution_time', 9000);
$id = $_POST["id"];
include ''.dirname(__FILE__).'/../../conexioni.php';
$query = $conn->query("SELECT * FROM crm_evento WHERE id='".$id."' ORDER BY id") or die(mysqli_error($conn));
if($query->num_rows>0){
  $c=0;
  $i=1;
  $response_array = [];
  while($row=$query->fetch_assoc()){
    $obj = new stdclass();
    $obj->id = utf8_encode($row["id"]);
    $obj->titulo = utf8_encode($row["titulo"]);
    $obj->ubicacion = utf8_encode($row["ubicacion"]);
    $obj->color = utf8_encode($row["color"]);
    $obj->fecha = utf8_encode($row["fecha"]);
    $obj->fecha2 = utf8_encode($row["fecha2"]);
    $response_array[$c] = new stdclass();
    $response_array[$c] = $obj;
    $c++;
  }
  $response = new stdclass();
  $response->data = $response_array;
  echo json_encode($response->data);
} else {
  $obj = new stdclass();
  $obj->error = "false";
  echo json_encode($obj);
}
$conn->close;
?>