<?PHP
include '../twitter/conexioni.php';
$identifyP=$_GET["identifyP"];
$identifyS=$_GET["identifyS"];
$identifyOther=$_GET["identifyOther"]; //no limpio
$redP=$_GET["redP"];
$redS=$_GET["redS"];
$query=$conn->query("SELECT id FROM token
				    WHERE identify='".$identifyP."' AND red='".$redP."'");
if($query->num_rows>0){
  $row=$query->fetch_assoc();
  $id_token=$row["id"];
} else {
  echo "FALSE";
}
$query=$conn->query("SELECT pages FROM estadisticas_facebook
				    WHERE identify_account='".$identifyS."' AND identify='".$identifyOther."' 
					AND red='".$redS."' AND id_token='".$id_token."' AND tipo='facebook'");
if($query->num_rows>0){
  $row=$query->fetch_assoc();
  $pages=''.$row["pages"].'';
  echo $pages;
} else {
  echo "FALSE";
}
$conn->close();
?>