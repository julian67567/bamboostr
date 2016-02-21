<?PHP
include ''.dirname(__FILE__).'/../conexioni.php';
$identifyP=$_GET["identifyP"];
$identifyS=$_GET["identifyS"];
$identifyOther=$_GET["identifyOther"]; //no limpio
$redP=$_GET["redP"];
$redS=$_GET["redS"];
$query=$conn->query("SELECT id FROM token
				    WHERE identify='".$identifyP."' AND red='".$redP."'") or die(mysqli_error($conn));
if($query->num_rows>0){
  $row=$query->fetch_assoc();
  $id_token=$row["id"];
} else {
  echo "FALSE";
}
$query=$conn->query("SELECT siguiendo FROM estadisticas_".$redS."
				    WHERE identify='".$identifyS."' AND red='".$redS."' AND id_token='".$id_token."'") or die(mysqli_error($conn));
if($query->num_rows>0){
  $row=$query->fetch_assoc();
  $siguiendo=''.$row["siguiendo"].'';
  echo $siguiendo;
} else {
  echo "FALSE";
}
$conn->close();
?>