<?PHP
include '../../conexioni.php';
$id = $_POST["id"];

$query = $conn->query("DELETE FROM social_share WHERE id='".$id."'");

?>