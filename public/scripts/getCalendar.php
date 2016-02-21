<?PHP
include ''.dirname(__FILE__).'/../conexioni.php';
$id_token = $_POST["id_token"];
$query = $conn->query("SELECT * FROM queue_msg WHERE id_token='".$id_token."'") or die(mysqli_error($conn));
$c=0;
$response_array = array();
if($query->num_rows>0){
  while($row=$query->fetch_assoc()){
      $obj = new stdclass();
      $obj->id = ''.utf8_encode($row["id"]).'';
      $obj->id_token = ''.utf8_encode($row["id_token"]).'';
      $obj->name = ''.utf8_encode($row["name"]).'';
      $obj->identify = ''.utf8_encode($row["identify"]).'';
      $obj->title = ''.utf8_encode($row["name"]).': '.utf8_encode($row["mensaje"]).'';
      $obj->id_post = ''.utf8_encode($row["id_post"]).'';
      $obj->mensaje = ''.utf8_encode($row["mensaje"]).'';
      $obj->images = ''.utf8_encode($row["images"]).'';
      $obj->red = ''.utf8_encode($row["red"]).'';
      $obj->image_profile = ''.utf8_encode($row["image_profile"]).'';
      if($row["fecha"]){
        $fecha = explode(" ",$row["fecha"]);
        $fechaF = explode("-",$fecha[0]);
        $obj->start = ''.$fechaF[2].'-'.$fechaF[1].'-'.$fechaF[0].'T'.$fecha[1].':00';
        $obj->fecha = ''.$fechaF[0].'-'.$fechaF[1].'-'.$fechaF[2].' '.$fecha[1].':00';
      }
      if($row["color"]){
        if($row["color"]=="yellow"){
          $obj->textColor = 'Black';
        }
        $obj->color = ''.$row["color"].'';
      } else {
        $obj->color = 'Black';
      }
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
?>