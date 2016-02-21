<?PHP
include ''.dirname(__FILE__).'/../../conexioni.php';
$id = $_POST["id"];

$query = $conn->query("DELETE FROM social_share WHERE id='".$id."'") or die(mysqli_error($conn));

?>