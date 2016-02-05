<?PHP
ini_set('max_execution_time', 9000);
$id = $_POST["id"];
include '../../conexioni.php';
$query = $conn->query("SELECT * FROM crm WHERE id='".$id."' ORDER BY id");
if($query->num_rows>0){
  $c=0;
  $i=1;
  $response_array = [];
  while($row=$query->fetch_assoc()){
    $obj = new stdclass();
    $obj->id = utf8_encode($row["id"]);
    $obj->nombre = utf8_encode($row["nombre"]);
    $obj->apellidoPaterno = utf8_encode($row["apellidoPaterno"]);
    $obj->apellidoMaterno = utf8_encode($row["apellidoMaterno"]);
    $obj->sexo = utf8_encode($row["sexo"]);
    $obj->edad = utf8_encode($row["edad"]);
    $obj->red_social = utf8_encode($row["red_social"]);
    $obj->nombre_de_usuario = utf8_encode($row["nombre_de_usuario"]);
    $obj->empresa = utf8_encode($row["empresa"]);
    $obj->country = utf8_encode($row["country"]);
    $obj->estado = utf8_encode($row["estado"]);
    $obj->direccion = utf8_encode($row["direccion"]);
    $obj->mail = utf8_encode($row["mail"]);
    $obj->telefono = utf8_encode($row["telefono"]);
    $obj->observaciones = utf8_encode($row["observaciones"]);
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