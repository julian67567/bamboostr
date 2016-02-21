<?PHP
include ''.dirname(__FILE__).'/../conexioni.php';
$option=$_POST["option"];
$screen_name=$_POST["screen_name"];
$last_mention=$_POST["last_mention"];
if($option==4)
  $query = $conn->query("UPDATE token SET last_mention='".$last_mention."' WHERE screen_name='".$screen_name."' AND red='twitter'") or die(mysqli_error($conn));
if($option==3)
  $query = $conn->query("UPDATE token SET last_private='".$last_mention."' WHERE screen_name='".$screen_name."' AND red='twitter'") or die(mysqli_error($conn)); 
echo "true";
$conn->close();
?>