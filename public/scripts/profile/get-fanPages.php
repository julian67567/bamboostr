<?PHP
include ''.dirname(__FILE__).'/../../conexioni.php';
$id = $_POST["id"];
$identify = $_POST["identify"];

$query=$conn->query("SELECT ss.feed_perfil,ss.id,ss.feed_dms,ss.identify,ss.name
							   FROM social_share as ss WHERE ss.identify_account='".$identify."' AND ss.id_token='".$id."' AND ss.tipo='page'
							   ORDER BY ss.id_token ASC") or die(mysqli_error($conn));
if($query->num_rows>0){
  $c=0;
  $response_array = [];
  while($row=$query->fetch_assoc()){
    $obj = new stdclass();
    $obj->id = $row["id"];
    $obj->feed_perfil = $row["feed_perfil"];
    $obj->feed_dms = $row["feed_dms"];
    $obj->identify = $row["identify"]; 
    $obj->name = $row["name"]; 
    $response_array[$c] = new stdclass();
    $response_array[$c] = $obj;
    $c++;
  }
  $response = new stdclass();
  $response = $response_array;
  echo json_encode($response);
} else {
  $obj = new stdclass();
  $obj->errors = "false";
  echo json_encode($obj);
}
$conn->close();
?>