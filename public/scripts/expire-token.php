<?PHP
include '../twitter/conexioni.php';
$identify = $_GET["identify"];
$red = $_GET["red"];
$query=$conn->query("SELECT expire_token FROM token WHERE identify='".$identify."' AND red='".$red."'");
if($query->num_rows>0){
  $row=$query->fetch_assoc();
  if($row["expire_token"]==1){
    echo "FALSE";
  } else {
    echo "TRUE";
  }
} else {
  echo "FALSE";
}
$conn->close();
?>