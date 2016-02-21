<?PHP
$id = $_POST["id"];
include ''.dirname(__FILE__).'/../conexioni.php';
$query = $conn->query("UPDATE notificaciones SET `read`='1' WHERE id='".$id."'") or die(mysqli_error($conn));
if ($query === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}
$conn->close();
?>