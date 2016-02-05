<?PHP
$id_token = $_GET["id_token"];
$fecha = date("d-m-Y");
include '../conexioni.php';
$query = $conn->query("SELECT mail FROM token WHERE id='".$id_token."' AND recordatorioMail='0'");
$row = $query->fetch_assoc();

if($row["mail"]==""){
  /*ssid_story porque si se sale de sesion va a saber que ya había iniciado*/
  $query = $conn->query("SELECT SUBSTRING(fecha,1,10) as fechaMod FROM ssid_story WHERE id_token='".$id_token."' AND fecha LIKE '%".$fecha."%' AND recordatorioMail='0'");
  if($query->num_rows>0){
    $c=0;
    while($row=$query->fetch_assoc()){
      if($row["fechaMod"]==$fecha){
        $c++;
      }
    }
    if($c<2){
      $query = $conn->query("UPDATE ssid_story SET recordatorioMail='1' WHERE id_token='".$id_token."' AND fecha LIKE '%".$fecha."%' AND recordatorioMail='0'");
      $obj = new stdclass();
      $obj->success = "true";
      $obj->wtf = $query;
      echo json_encode($obj);
    } else {
      $obj = new stdclass();
      $obj->errors = "true3";
      echo json_encode($obj);
    }
  } else {
    $obj = new stdclass();
    $obj->errors = "true2";
    echo json_encode($obj);
  }
  $conn->close();
} else {
  $obj = new stdclass();
  $obj->errors = "true1";
  echo json_encode($obj);
}
?>