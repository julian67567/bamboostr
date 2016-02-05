<?PHP
$id = $_POST["id"];
if($id=="")
  $id = $_GET["id"];
include '../conexioni.php';
$query = $conn->query("DELETE FROM notificaciones WHERE id='".$id."'");
if ($query === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}
$conn->close();
?>