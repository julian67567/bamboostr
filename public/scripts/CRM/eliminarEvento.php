<?PHP
include '../../conexioni.php';
$id = $_POST["id"];
$query = $conn->query("DELETE FROM crm_evento WHERE id='".$id."'");
?>