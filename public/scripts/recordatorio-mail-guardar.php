<?PHP
$id_token = $_POST["id_token"];
$mailRecG = $_POST["mailRecG"];
include ''.dirname(__FILE__).'/../conexioni.php';
$query = $conn->query("UPDATE token SET mail='".$mailRecG."'WHERE id='".$id_token."'") or die(mysqli_error($conn));
?>