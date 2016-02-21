<?PHP
include ''.dirname(__FILE__).'/../conexioni.php';
$option=$_POST["option"];
$identify=$_POST["identify"];
$last_mention=$_POST["last_mention"];
if($option==4)
  $query = $conn->query("UPDATE token SET last_mention='".$last_mention."' WHERE identify='".$identify."' AND red='facebook'") or die(mysqli_error($conn));
if($option==3)
  $query = $conn->query("UPDATE token SET last_private='".$last_mention."' WHERE identify='".$identify."' AND red='facebook'") or die(mysqli_error($conn));
echo "true";
?>