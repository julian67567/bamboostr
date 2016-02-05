<?PHP
  include ''.dirname(__FILE__).'/../conexioni.php';
  $id = $_POST["id"];
  $query = $conn->query("SELECT * FROM token WHERE id='".$id."'") OR DIE(mysqli_error($conn));
  $row = $query->fetch_assoc();
  $obj = new stdclass();
  $obj->nivel = $row["nivel"];
  echo json_encode($obj);
?>