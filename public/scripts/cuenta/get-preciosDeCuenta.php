<?PHP
include ''.dirname(__FILE__).'/../../conexioni.php';
$opcion=$_POST["facturacion"];
$option=$_POST["plan"];
if($option==1){
  $letra = "basic";
} else if($option==2){
  $letra = "professional";
} else if($option==3){
  $letra = "enterprise";
}
if($opcion==1){
  $letra = "".$letra."A";
} else {
  $letra = "".$letra."M";
}
$query = $conn->query("SELECT * FROM conf WHERE valor='".$letra."'") or die(mysqli_error($conn));
if($query->num_rows>0){
  $row=$query->fetch_assoc();
  $obj = new stdclass();
  $obj->pago = $row["valor2"];
  echo json_encode($obj);
} else {
  $obj = new stdclass();
  $obj->errors = "false";
  echo json_encode($obj);
}
?>