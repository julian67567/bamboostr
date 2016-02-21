<?PHP
include ''.dirname(__FILE__).'/../../conexioni.php';
$id = $_POST["id"];
$query = $conn->query("DELETE FROM crm WHERE id='".$id."'") or die(mysqli_error($conn));
?>