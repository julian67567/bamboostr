<?PHP
include '../../conexioni.php';
$id = $_POST["id"];
$query = $conn->query("DELETE FROM crm WHERE id='".$id."'");
?>