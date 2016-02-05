<?PHP
include '../conexioni.php';
$id = $_GET["id"];

$query = $conn->query("DELETE FROM social_share WHERE id='".$id."'");

?>