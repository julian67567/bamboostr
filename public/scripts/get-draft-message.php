<?PHP
ini_set('max_execution_time', 9000);
include '../conexioni.php';
$c=0;
$response_array = array();
$id_token = $_GET["id_token"];
$id = $_POST["id"];
if($_POST["id"]){
  $query = $conn->query("SELECT *, STR_TO_DATE(fecha,'%d-%m-%Y') as Fecha, SUBSTRING(fecha,12,2) AS Hora, SUBSTRING(fecha,15,3) AS Min FROM drafts WHERE id='".$id."' ORDER BY Fecha, Hora, Min");
} else {
  $query = $conn->query("SELECT *, STR_TO_DATE(fecha,'%d-%m-%Y') as Fecha, SUBSTRING(fecha,12,2) AS Hora, SUBSTRING(fecha,15,3) AS Min FROM drafts WHERE id_token='".$id_token."' ORDER BY Fecha, Hora, Min");
}
if($query->num_rows>0){
  while($row=$query->fetch_assoc()){
	$obj = new stdclass();
	$obj->id = $row["id"];
        $obj->screen_name = $row["name"];
	$obj->identify = $row["identify"];
	$obj->id_post = $row["id_post"];
	$obj->mensaje = $row["mensaje"];
	$obj->images = $row["images"];
	$obj->link = $row["link"];
	$obj->fecha = $row["fecha"];
	$obj->horario = $row["horario"];
	$obj->image_profile = $row["image_profile"];
	$obj->red = $row["red"];
	$response_array[$c] = new stdclass();
	$response_array[$c] = $obj;
	$c++;
  }
  $response = new stdclass();
  $response->data = $response_array;
  echo json_encode($response);
} else {
  echo "FALSE";
}
$conn->close();
?>