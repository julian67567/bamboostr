<?PHP
// red de la cuenta principal por la social_networks
include ''.dirname(__FILE__).'/../conexioni.php';
$identifyEliminar = $_GET["identifyEliminar"];
$identify = $_GET["identify"];
$red= $_GET["red"];
$access_token= $_GET["access_token"];
$query = $conn->query("SELECT social_networks,id FROM token WHERE identify='".$identify."' AND red='".$red."'") OR DIE(mysqli_error($conn));
$row=$query->fetch_assoc();
$social_networks=$row["social_networks"];
$id_token=$row["id"];
if($identify==substr($identifyEliminar,2,strlen($identifyEliminar))){
  //si es cuenta primaria
  $query = $conn->query("UPDATE token SET social_networks='".$identifyEliminar.",', ssid='', automatize=0 WHERE identify='".$identify."' AND red='".$red."'") OR DIE(mysqli_error($conn));
  $query = $conn->query("DELETE FROM grupos WHERE id_token='".$id_token."' AND grupo='".$identify."'") OR DIE(mysqli_error($conn));
  $query = $conn->query("DELETE FROM social_share WHERE id_token='".$id_token."'") OR DIE(mysqli_error($conn));
  $query = $conn->query("DELETE FROM estadisticas_twitter WHERE id_token='".$id_token."'") OR DIE(mysqli_error($conn));
  $query = $conn->query("DELETE FROM estadisticas_facebook WHERE id_token='".$id_token."'") OR DIE(mysqli_error($conn));
  $query = $conn->query("DELETE FROM notificaciones WHERE id_token='".$id_token."'") OR DIE(mysqli_error($conn));
  $query = $conn->query("DELETE FROM tutos WHERE id_token='".$id_token."'") OR DIE(mysqli_error($conn));
  session_start();
  session_unset();
  session_destroy();
  echo "true";
} else {
	//si es cuenta secundaria
	$social_networks = preg_replace('#'.$identifyEliminar.',#','',$social_networks);
	if(!strpos($social_networks, $identifyEliminar)){
	  $query = $conn->query("UPDATE token SET social_networks='".$social_networks."' WHERE identify='".$identify."' AND red='".$red."'") OR DIE(mysqli_error($conn));
	$query = $conn->query("DELETE FROM grupos WHERE id_token='".$id_token."' AND grupo='".$identify."' AND user='".substr($identifyEliminar,2,strlen($identifyEliminar))."'") OR DIE(mysqli_error($conn));
	$query = $conn->query("DELETE FROM social_share WHERE identify_account='".substr($identifyEliminar,2,strlen($identifyEliminar))."' AND id_token='".$id_token."'") OR DIE(mysqli_error($conn));
	$query = $conn->query("DELETE FROM estadisticas_twitter WHERE identify='".substr($identifyEliminar,2,strlen($identifyEliminar))."' AND id_token='".$id_token."'") OR DIE(mysqli_error($conn));
	$query = $conn->query("DELETE FROM estadisticas_facebook WHERE identify_account='".substr($identifyEliminar,2,strlen($identifyEliminar))."' AND id_token='".$id_token."'") OR DIE(mysqli_error($conn));
	  echo "true";
	}
	else
      echo "false";
}
$conn->close();
?>