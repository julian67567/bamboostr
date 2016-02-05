<?PHP
ini_set('max_execution_time', 9000);
include '../conexioni.php';
$id=$_POST["id"];
$query=$conn->query("DELETE FROM msg_publicados WHERE id='".$id."'");
$conn->close();
if($query===true){
  echo "TRUE";
} else {
  echo "FALSE";
}
?>