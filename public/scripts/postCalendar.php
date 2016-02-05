<?PHP
$id = $_POST["id"];
$fecha = $_POST["fecha"];
include '../conexioni.php';
$query2 = $conn->query("UPDATE queue_msg SET fecha='".$fecha."' WHERE id='".$id."'");
$conn->close();
?>