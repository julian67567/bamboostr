<?PHP
ini_set('max_execution_time', 9000);
include ''.dirname(__FILE__).'/../conexioni.php';
$c=0;
$response_array = array();
$id_token = $_GET["id_token"];
$id = $_POST["id"];
if($_POST["id"]){
  $query = $conn->query("SELECT *, STR_TO_DATE(fecha,'%d-%m-%Y') as Fecha, SUBSTRING(fecha,12,2) AS Hora, SUBSTRING(fecha,15,3) AS Min FROM queue_msg WHERE id='".$id."' ORDER BY Fecha, Hora, Min") or die(mysqli_error($conn));
} else {
  $query = $conn->query("SELECT *, STR_TO_DATE(fecha,'%d-%m-%Y') as Fecha, SUBSTRING(fecha,12,2) AS Hora, SUBSTRING(fecha,15,3) AS Min FROM queue_msg WHERE id_token='".$id_token."' ORDER BY Fecha, Hora, Min") or die(mysqli_error($conn));
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
        $partir_images = explode(",",$row["images"]);
        foreach($partir_images as $item){
          if($item!=""){
            $obj->images_img = '<center>'.$obj->images_img.'<img width="150px" style="text-align: center; width: 150px;" src="'.$item.'" /><br /></center>';
          }
        }
	$obj->link = $row["link"];
	$obj->fecha = $row["fecha"];
	$obj->horario = $row["horario"];
	$obj->image_profile = $row["image_profile"];
	$obj->red = $row["red"];
        if($row["red"]=="facebook"){
          $obj->imgRed = "f.png";
        } else if($row["red"]=="twitter"){
          $obj->imgRed = "t.png";
        } else if($row["red"]=="instagram"){
          $obj->imgRed = "i.png";
        }
	$response_array[$c] = new stdclass();
	$response_array[$c] = $obj;
	$c++;
  }
  $response = new stdclass();
  $response->data = $response_array;
  echo json_encode($response);
} else {
  echo "FALSE ".$_GET['id_token']."|";
}
$conn->close();
?>