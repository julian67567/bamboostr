<?PHP
include ''.dirname(__FILE__).'/../conexioni.php';
$mensaje=$_POST["mensaje"];
$fecha=$_POST["fecha"];
$horario=$_POST["horario"];
$id=$_POST["id"];
if($id && $horario && $fecha && $mensaje){
  $query=$conn->query("UPDATE drafts 
                      SET mensaje='".$mensaje."', fecha='".$fecha."', horario='".$horario."'
					  WHERE id='".$id."'") or die(mysqli_error($conn));
  if($query===true){
    echo "TRUE";
  } else {
    echo "FALSE";
  }
} else if($id) {
  $query=$conn->query("UPDATE drafts SET fecha='1/01/2000' WHERE id='".$id."'") or die(mysqli_error($conn));
  if($query===true){
    $query=$conn->query("SELECT * FROM drafts WHERE id='".$id."'") or die(mysqli_error($conn));
    if($query->num_rows>0){
      $row=$query->fetch_assoc();
      $query=$conn->query("INSERT INTO queue_msg 
                          SET id_token='".$row['id_token']."', name='".$row['name']."', identify='".$row['identify']."', id_post='".$row[id_post]."', 
                              mensaje='".$row['mensaje']."', images='".$row['images']."', link='".$row['link']."', fecha='".$row['fecha']."',
                              horario='".$row['horario']."', image_profile='".$row['image_profile']."', red='".$row['red']."'") or die(mysqli_error($conn));
      $query=$conn->query("DELETE FROM drafts WHERE id='".$id."'") or die(mysqli_error($conn));
      echo "TRUE";
    } else {
      echo "FALSE";
    }
  } else {
    echo "FALSE";
  }
} else {
  echo "FALSE";
}
$conn->close();
?>