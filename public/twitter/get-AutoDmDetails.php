<?PHP
include 'conexioni.php';
$screen_name = $_GET["screen_name"];
$query = $conn->query("SELECT automatize,DM FROM token WHERE screen_name='".$screen_name."'");
if($query->num_rows>0){
  $row=$query->fetch_assoc();
  $conn->close();
  $obj = new stdclass();
  $obj->dm = utf8_encode($row["DM"]);
  $obj->active = utf8_encode($row["automatize"]);
  echo json_encode($obj);
} else {
  $conn->close();
  $obj = new stdclass();
  $obj->error = "false";
  echo json_encode($obj);
}
?>