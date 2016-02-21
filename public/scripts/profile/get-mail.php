<?PHP
include ''.dirname(__FILE__).'/../../conexioni.php';
$identify = $_POST["identify"];
$red= $_POST["red"];

$query = $conn->query("SELECT mail FROM token WHERE identify='".$identify."' AND red='".$red."'") or die(mysqli_error($conn));
$row=$query->fetch_assoc();
$mail=$row["mail"];
if($mail){
  $obj = new stdclass();
  $obj->mail = $mail;
}  else {
  $obj = new stdclass();
  $obj->errors = "false";
}
echo json_encode($obj);
$conn->close();
?>