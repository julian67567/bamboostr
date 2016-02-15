<?PHP
include ''.dirname(__FILE__).'/../conexioni.php';
$id = $_GET["id"];

$query = $conn->query("DELETE FROM social_share WHERE id='".$id."'") OR DIE(mysqli_error($conn));

?>