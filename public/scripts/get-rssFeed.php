<?PHP
ini_set('max_execution_time', 9000);
header ('Content-type: text/html; charset=utf-8');
mb_internal_encoding("UTF-8");
$categoria = $_POST["categoria"];
if($categoria=="")
  $categoria = $_GET["categoria"];
$lengua = $_POST["lengua"];
if($lengua=="")
  $lengua = $_GET["lengua"];
//$categoria = 1;
//$lengua = "es";
include ''.dirname(__FILE__).'/../conexioni.php';
include ''.dirname(__FILE__).'/funciones.php';

$c=0;
$response_array = [];

$query = $conn->query("SELECT * FROM rss_content WHERE categoria='".$categoria."' AND idioma='".$lengua."'") or die(mysqli_error($conn));
if($query->num_rows>0){
  while($row=$query->fetch_assoc()){
    $obj = new stdclass();
		$obj->id = utf8_encode($row["id"]);
		$obj->link = utf8_encode($row["link"]);
		$obj->dominio = utf8_encode($row["dominio"]); 
		$obj->title = utf8_encode($row["title"]);
		$obj->img = utf8_encode($row["img"]);
		$obj->description = utf8_encode($row["description"]);
		$obj->fecha = utf8_encode($row["fecha"]);
	$response_array[$c] = new stdclass();
	$response_array[$c] = $obj;
	$c++;
  }//fin while

  $response = new stdclass();
  $response->data = $response_array;
  echo json_encode($response->data);

} else {
  $obj = new stdclass();
  $obj->errors = "false";
  echo json_encode($obj);
}
?>