<?PHP
  include '../conexioni.php';
  include 'funciones.php';
  $id_token = base_de_datos_scape($conn,$_GET["id_token"]);
  $query = $conn->query("SELECT * FROM token WHERE id='".$id_token."'") OR DIE(mysqli_error($conn));
  if($query->num_rows>0){
    $row=$query->fetch_assoc();
    $obj = new stdclass();
    $obj->screen_name = $row["screen_name"];
    $obj->screen_name_bamboostr = $row["screen_name_bamboostr"];
    $obj->mail = $row["mail"];
    $obj->categoria = $row["categoria"];
    $obj->foto_bamboostr = $row["foto_bamboostr"];
    if($row["password"])
      $obj->password = "12345";
    else
      $obj->password = "";
    $obj->success = "true";
    echo json_encode($obj);
  } else {
    $obj = new stdclass();
    $obj->success = "false";
    echo json_encode($obj);
  }
  $conn->close;
?>