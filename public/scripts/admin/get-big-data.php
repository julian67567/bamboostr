<?PHP
include '../../conexioni.php';
$query = $conn->query("SELECT MAX(id_big_data) AS id FROM big_data_tw");
if($query->num_rows>0){
  $row=$query->fetch_assoc();
  $obj = new stdclass();
  $obj->id_max = trim($row[id]);
  echo json_encode($obj);
} else {
  $obj = new stdclass();
  $obj->error = "false";
  echo json_encode($obj);
}
?>