<?PHP
include '../../twitter/conexioni.php';
$id = $_POST["id"];
$id_token = $_POST["id_token"];
$tituloCheck = $_POST["tituloCheck"];
$bool = $_POST["bool"];
$identify = $_POST["identify"];
$red = $_POST["red"];

if($bool=="true"){
  $bool = 1;
} else {
  $bool = 0;
}

if($id){
  if($tituloCheck=="tweetsCheck"){
    $query = $conn->query("UPDATE grupos SET feed_perfil='".$bool."' WHERE id='".$id."'");
  }
  if($tituloCheck=="inicioCheck"){
    $query = $conn->query("UPDATE grupos SET feed_noticias='".$bool."' WHERE id='".$id."'");
  }
  if($tituloCheck=="dmsCheck"){
    $query = $conn->query("UPDATE grupos SET feed_dms='".$bool."' WHERE id='".$id."'");
  }
  if($tituloCheck=="mencionesCheck"){
    $query = $conn->query("UPDATE grupos SET feed_mentions='".$bool."' WHERE id='".$id."'");
  }
  if($tituloCheck=="eventosCheck"){
    $query = $conn->query("UPDATE grupos SET feed_events='".$bool."' WHERE id='".$id."'");
  }
  /***Fan Pages Facebook***/
  if($tituloCheck=="fanPageMuroCheck"){
    $query = $conn->query("UPDATE social_share SET feed_perfil='".$bool."' WHERE id='".$id."' AND tipo='page'  AND red='facebook'");
  }
  if($tituloCheck=="fanPageDmsCheck"){
    $query = $conn->query("UPDATE social_share SET feed_dms='".$bool."' WHERE id='".$id."' AND tipo='page'  AND red='facebook'");
  }
} else {
  if($tituloCheck=="tweetsCheck"){
    $query = $conn->query("UPDATE token SET feed_perfil='".$bool."' WHERE identify='".$identify."' AND red='".$red."'");
  }
  if($tituloCheck=="inicioCheck"){
    $query = $conn->query("UPDATE token SET feed_noticias='".$bool."' WHERE identify='".$identify."' AND red='".$red."'");
  }
  if($tituloCheck=="dmsCheck"){
    $query = $conn->query("UPDATE token SET feed_dms='".$bool."' WHERE identify='".$identify."' AND red='".$red."'");
  }
  if($tituloCheck=="mencionesCheck"){
    $query = $conn->query("UPDATE token SET feed_mentions='".$bool."' WHERE identify='".$identify."' AND red='".$red."'");
  }
  if($tituloCheck=="eventosCheck"){
    $query = $conn->query("UPDATE token SET feed_events='".$bool."' WHERE identify='".$identify."' AND red='".$red."'");
  }
}

$obj = new stdclass();
$obj->success = "true";

echo json_encode($obj);

$conn->close();
?>