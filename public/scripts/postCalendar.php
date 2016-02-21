<?PHP
$id = $_POST["id"];
$fecha = $_POST["fecha"];
include ''.dirname(__FILE__).'/../conexioni.php';
$query2 = $conn->query("UPDATE queue_msg SET fecha='".$fecha."' WHERE id='".$id."'") or die(mysqli_error($conn));
$conn->close();
?>