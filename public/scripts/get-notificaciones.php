<?PHP
  $identify=$_GET["identify"];
  $red=$_GET["red"];
  $id_token=$_GET["id_token"];
  $option=$_GET["option"];
  include '../conexioni.php';
  $c=0;
  $cont=0;
  $response_array = array();
  if($option==2){
    $query = $conn->query("SELECT * FROM notificaciones WHERE id_token='".$id_token."' AND tipo='instagram' ORDER BY id DESC");
  } else if($option==1 || $option==""){
    $query = $conn->query("SELECT * FROM notificaciones WHERE receptor='".$identify."' AND red='".$red."' ORDER BY id DESC");
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