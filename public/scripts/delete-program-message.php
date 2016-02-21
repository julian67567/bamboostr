<?PHP
ini_set('max_execution_time', 9000);
include ''.dirname(__FILE__).'/../conexioni.php';
$id=$_POST["id"];
$query=$conn->query("DELETE FROM queue_msg WHERE id='".$id."'") or die(mysqli_error($conn));
$conn->close();
if($query===true){
  echo "TRUE";
} else {
  echo "FALSE";
}
?>