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
$query=$conn->query("SELECT seguidores FROM estadisticas_".$redS."
				    WHERE identify='".$identifyS."' AND red='".$redS."' AND id_token='".$id_token."'");
if($query->num_rows>0){
  $row=$query->fetch_assoc();
  $seguidores=''.$row["seguidores"].'';
  echo $seguidores;
} else {
  echo "FALSE";
}
$conn->close();
?>