<?PHP
include '../conexioni.php';
$option=$_POST["option"];
$identify=$_POST["identify"];
$last_mention=$_POST["last_mention"];
if($option==4)
  $query = $conn->query("UPDATE token SET last_mention='".$last_mention."' WHERE identify='".$identify."' AND red='facebook'");
if($option==3)
  $query = $conn->query("UPDATE token SET last_private='".$last_mention."' WHERE identify='".$identify."' AND red='facebook'");
echo "true";
?>