<?PHP
include ''.dirname(__FILE__).'/../conexioni.php';
$mensaje=$_POST["mensaje"];
$fecha=$_POST["fecha"];
$horario=$_POST["horario"];
$id=$_POST["id"];
if($id && $horario && $fecha && $mensaje){
  $query=$conn->query("UPDATE queue_msg 
                      SET mensaje='".$mensaje."', fecha='".$fecha."', horario='".$horario."'
					  WHERE id='".$id."'") or die(mysqli_error($conn));
  if($query===true){
    echo "TRUE";
  } else {
    echo "FALSE";
  }
} else if($id) {
  $query=$conn->query("UPDATE queue_msg 
                      SET fecha='1/01/2000'
					  WHERE id='".$id."'") or die(mysqli_error($conn));
  if($query===true){
    echo "TRUE";
  } else {
    echo "FALSE";
  }
} else {
  echo "FALSE";
}
$conn->close();
?>