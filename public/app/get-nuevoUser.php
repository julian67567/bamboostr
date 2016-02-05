<?PHP
include '../conexioni.php';
$id_token = $_GET["id_token"];
$option = $_GET["option"];
if($option==1){
  $query=$conn->query("SELECT nuevoUser FROM token WHERE id='".$id_token."'");
  $row=$query->fetch_assoc();
  $obj = new stdclass();
  $obj->nuevoUser = $row["nuevoUser"];
  echo json_encode($obj);
} else {
  $query=$conn->query("UPDATE token SET nuevoUser='1' WHERE id='".$id_token."'");
}
?>