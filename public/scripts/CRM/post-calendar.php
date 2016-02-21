<?PHP
$id = $_POST["id"];
$fecha = $_POST["fecha"];
$fecha2 = $_POST["fecha2"];
include ''.dirname(__FILE__).'/../../conexioni.php';
$query2 = $conn->query("UPDATE crm_evento SET fecha='".$fecha."', fecha2='".$fecha2."' WHERE id='".$id."'") or die(mysqli_error($conn));
$conn->close();
?>