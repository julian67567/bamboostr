<?PHP
$id_token = $_POST["id_token"];
$mailRecG = $_POST["mailRecG"];
include '../conexioni.php';
$query = $conn->query("UPDATE token SET mail='".$mailRecG."'WHERE id='".$id_token."'");
?>