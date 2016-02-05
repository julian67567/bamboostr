<?PHP
include 'conexioni.php';
$screen_name = $_GET["screen_name"];
$activate = utf8_decode($_POST["activate"]);
$DM = utf8_decode($_POST["DM"]);
$query = $conn->query("UPDATE token SET automatize='".$activate."', DM='".$DM."' WHERE screen_name='".$screen_name."'");
?>