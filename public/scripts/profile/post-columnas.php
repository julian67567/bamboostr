<?PHP
include ''.dirname(__FILE__).'/../../conexioni.php';
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
    $query = $conn->query("UPDATE grupos SET feed_perfil='".$bool."' WHERE id='".$id."'") or die(mysqli_error($conn));
  }
  if($tituloCheck=="inicioCheck"){
    $query = $conn->query("UPDATE grupos SET feed_noticias='".$bool."' WHERE id='".$id."'") or die(mysqli_error($conn));
  }
  if($tituloCheck=="dmsCheck"){
    $query = $conn->query("UPDATE grupos SET feed_dms='".$bool."' WHERE id='".$id."'") or die(mysqli_error($conn));
  }
  if($tituloCheck=="mencionesCheck"){
    $query = $conn->query("UPDATE grupos SET feed_mentions='".$bool."' WHERE id='".$id."'") or die(mysqli_error($conn));
  }
  if($tituloCheck=="eventosCheck"){
    $query = $conn->query("UPDATE grupos SET feed_events='".$bool."' WHERE id='".$id."'") or die(mysqli_error($conn));
  }
  /***Fan Pages Facebook***/
  if($tituloCheck=="fanPageMuroCheck"){
    $query = $conn->query("UPDATE social_share SET feed_perfil='".$bool."' WHERE id='".$id."' AND tipo='page'  AND red='facebook'") or die(mysqli_error($conn));
  }
  if($tituloCheck=="fanPageDmsCheck"){
    $query = $conn->query("UPDATE social_share SET feed_dms='".$bool."' WHERE id='".$id."' AND tipo='page'  AND red='facebook'") or die(mysqli_error($conn));
  }
} else {
  if($tituloCheck=="tweetsCheck"){
    $query = $conn->query("UPDATE token SET feed_perfil='".$bool."' WHERE identify='".$identify."' AND red='".$red."'") or die(mysqli_error($conn));
  }
  if($tituloCheck=="inicioCheck"){
    $query = $conn->query("UPDATE token SET feed_noticias='".$bool."' WHERE identify='".$identify."' AND red='".$red."'") or die(mysqli_error($conn));
  }
  if($tituloCheck=="dmsCheck"){
    $query = $conn->query("UPDATE token SET feed_dms='".$bool."' WHERE identify='".$identify."' AND red='".$red."'") or die(mysqli_error($conn));
  }
  if($tituloCheck=="mencionesCheck"){
    $query = $conn->query("UPDATE token SET feed_mentions='".$bool."' WHERE identify='".$identify."' AND red='".$red."'") or die(mysqli_error($conn));
  }
  if($tituloCheck=="eventosCheck"){
    $query = $conn->query("UPDATE token SET feed_events='".$bool."' WHERE identify='".$identify."' AND red='".$red."'") or die(mysqli_error($conn));
  }
}

$obj = new stdclass();
$obj->success = "true";

echo json_encode($obj);

$conn->close();
?>