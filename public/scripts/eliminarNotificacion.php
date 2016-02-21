<?PHP
$id = $_POST["id"];
if($id=="")
  $id = $_GET["id"];
include ''.dirname(__FILE__).'/../conexioni.php';
$query = $conn->query("DELETE FROM notificaciones WHERE id='".$id."'") or die(mysqli_error($conn));
if ($query === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}
$conn->close();
?>