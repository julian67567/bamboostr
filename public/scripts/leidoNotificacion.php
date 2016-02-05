<?PHP
$id = $_POST["id"];
include '../conexioni.php';
$query = $conn->query("UPDATE notificaciones SET `read`='1' WHERE id='".$id."'");
if ($query === TRUE) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}
$conn->close();
?>