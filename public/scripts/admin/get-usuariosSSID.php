<?PHP
include '../../conexioni.php';
$query = $conn->query("SELECT ssid_story.id_token as TokenId,ssid_story.screen_name,ssid_story.fecha,token.identify,token.red FROM ssid_story
                       INNER JOIN token ON ssid_story.id_token=token.id ORDER BY ssid_story.id DESC");
if($query->num_rows>0){
  $array = array();
  $c=0;
  while($row=$query->fetch_assoc()){
    $obj = new stdclass();
    $obj->id = $row["TokenId"];
    $obj->screen_name = $row["screen_name"];
    $obj->fecha = $row["fecha"];
    $obj->identify = $row["identify"];
    $obj->red = $row["red"];
    $array[$c] = new stdclass();
    $array[$c] = $obj;
    $c++;
  }
  $response = new stdclass();
  $response = $array;
  echo json_encode($response);
} else {
  $obj = new stdclass();
  $obj->error = "false";
  echo json_encode($obj);
}
?>