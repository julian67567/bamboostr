<?PHP
  $identify=$_GET["identify"];
  $red=$_GET["red"];
  $id_token=$_GET["id_token"];
  $option=$_GET["option"];
  include ''.dirname(__FILE__).'/../conexioni.php';
  $c=0;
  $cont=0;
  $response_array = array();
  if($option==3){
    $query = $conn->query("SELECT * FROM notificaciones WHERE id_token='".$id_token."' AND tipo='asistente' ORDER BY id DESC") or die(mysqli_error($conn));
  } else if($option==2){
    $query = $conn->query("SELECT * FROM notificaciones WHERE id_token='".$id_token."' AND tipo='instagram' ORDER BY id DESC") or die(mysqli_error($conn));
  } else if($option==1 || $option==""){
    $query = $conn->query("SELECT * FROM notificaciones WHERE receptor='".$identify."' AND red='".$red."' AND tipo!='instagram' AND tipo!='asistente' ORDER BY id DESC") or die(mysqli_error($conn));
  }
  if($query->num_rows>0) {
    while($row = $query->fetch_assoc()) {
      $obj = new stdclass();
      $obj->read = $row["read"];
      if($row["read"]==0){
        $cont++;
      }
      $obj->id = $row["id"];
      $obj->titulo = utf8_encode($row["titulo"]);
      $obj->mensaje = utf8_encode($row["mensaje"]);
      $obj->imagen = utf8_encode($row["imagen"]);
      $obj->tipo = utf8_encode($row["tipo"]);
      $obj->fecha = $row["fecha"];
      $response_array[$c] = new stdclass();
      $response_array[$c] = $obj;
      $c++;
    }
    $response = new stdclass();
    $response->data = $response_array;
    $response->cont = $cont;
    echo json_encode($response);
  } else {
    $obj = new stdclass();
    $obj->error = TRUE;
    echo json_encode($obj);
  }
  $conn->close();
?>