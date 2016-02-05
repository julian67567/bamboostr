<?PHP
include '../../conexioni.php';
$id_token = $_POST["id_token"];
$query = $conn->query("SELECT * FROM crm_evento WHERE id_token='".$id_token."'");
$c=0;
$response_array = array();
if($query->num_rows>0){
  while($row=$query->fetch_assoc()){
      $obj = new stdclass();
      $obj->id = ''.utf8_encode($row["id"]).'';
      $obj->title = ''.utf8_encode($row["titulo"]).'';
      $obj->ubicacion = ''.utf8_encode($row["ubicacion"]).'';
      if($row["fecha"]){
        $fecha = explode(" ",$row["fecha"]);
        $fechaF = explode("-",$fecha[0]);
        $obj->start = ''.$fechaF[2].'-'.$fechaF[1].'-'.$fechaF[0].'T'.$fecha[1].':00';
      }
      if($row["fecha2"]){
        $fecha = explode(" ",$row["fecha2"]);
        $fechaF = explode("-",$fecha[0]);
        $obj->end = ''.$fechaF[2].'-'.$fechaF[1].'-'.$fechaF[0].'T'.$fecha[1].':00';
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