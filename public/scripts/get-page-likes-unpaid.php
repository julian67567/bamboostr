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
$query=$conn->query("SELECT likes_unpaid FROM estadisticas_facebook
				    WHERE identify_account='".$identifyS."' AND identify='".substr($identifyOther,0,strlen($identifyOther-2))."' 
					AND red='".$redS."' AND id_token='".$id_token."' AND tipo='page'") or die(mysqli_error($conn));
if($query->num_rows>0){
  $row=$query->fetch_assoc();
  $likes_unpaid=''.$row["likes_unpaid"].'';
  echo $likes_unpaid;
} else {
  echo "FALSE";
}
$conn->close();
?>