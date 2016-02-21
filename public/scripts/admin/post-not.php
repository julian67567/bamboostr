<?PHP
ini_set('max_execution_time', 9999999);
$titulo = utf8_decode($_POST["titulo"]);
$contenido = utf8_decode($_POST["contenido"]);
$prueba = $_POST["prueba"];
$mail = $_POST["mail"];
$sinNot = $_POST["sinNot"];
$inactivos = $_POST["inactivos"];
include ''.dirname(__FILE__).'/../../conexioni.php';
$obj = new stdclass();
if($prueba=="false"){
      // mandar notificaciones a todos dependiendo de los filtros
	$query = $conn->query("SELECT identify,red,id FROM token WHERE ssid<>'' AND ssid IS NOT NULL AND identify<>'0'") or die(mysqli_error($conn));
	if($query->num_rows>0){
	  $c=0;
	  $response_array = [];
	  while($row=$query->fetch_assoc()){
	    $response_array[$c] = [];
	    $response_array[$c]["identify"] = $row["identify"];
	    $response_array[$c]["red"] = $row["red"];
	    $response_array[$c]["id"] = $row["id"];
	    $c++;
	  }
	  foreach($response_array as $item){
            if($sinNot=="true"){
              $query = $conn->query("UPDATE token SET notificaciones=notificaciones+1 WHERE id='".$item["id"]."'") or die(mysqli_error($conn));
	      $query = $conn->query("INSERT INTO notificaciones (id_token,receptor,titulo,mensaje,fecha,red) VALUES ('".$item["id"]."','".$item["identify"]."','".$titulo."','".$contenido."','".date("d-m-Y H:i")."','".$item["red"]."')") or die(mysqli_error($conn));
	    }
	  }

          if($mail=="true"){
            //mandar a cola de mails a todos los usuario que tengan mail.
            $query = $conn->query("SELECT id, last_ssid FROM token WHERE mail<>'' AND mail IS NOT NULL") or die(mysqli_error($conn));
 	    if($query->num_rows>0){
	      while($row=$query->fetch_assoc()){
                if($inactivos=="true"){
                  if(strtotime($row["last_ssid"])<=strtotime('now -30 Days') || $row["last_ssid"]==""){
                    $query2 = $conn->query("INSERT INTO queue_mail (id_token,titulo,mensaje) VALUES ('".$row['id']."','".$titulo."','".$contenido."')") or die(mysqli_error($conn));
                  } 
                } else {
                  $query2 = $conn->query("INSERT INTO queue_mail (id_token,titulo,mensaje) VALUES ('".$row['id']."','".$titulo."','".$contenido."')") or die(mysqli_error($conn));
                }
	      }
            }
          }

	  $obj->mensaje = $query;
          echo json_encode($obj);
	} else {
	  $obj->error = "false";
	  echo json_encode($obj);
	}
} else {
  //es prueba
  $query2 = $conn->query("SELECT identify,red,id,notificaciones FROM token WHERE id='128'") or die(mysqli_error($conn));
  $row=$query2->fetch_assoc();

  if($query2->num_rows>0){
    if($sinNot=="true"){
      $query = $conn->query("UPDATE token SET notificaciones=notificaciones+1 WHERE id='128'") or die(mysqli_error($conn));
      $query = $conn->query("INSERT INTO notificaciones (id_token,receptor,titulo,mensaje,fecha,red) VALUES ('128','100001184682948','".$titulo."','".$contenido."','".date("d-m-Y H:i")."','facebook')") or die(mysqli_error($conn));
      $query = $conn->query("UPDATE token SET notificaciones=notificaciones+1 WHERE id='161'") or die(mysqli_error($conn));
      $query = $conn->query("INSERT INTO notificaciones (id_token,receptor,titulo,mensaje,fecha,red) VALUES ('161','100001184682948','".$titulo."','".$contenido."','".date("d-m-Y H:i")."','facebook')") or die(mysqli_error($conn));
    }
    $obj->mensaje = $query;

    if($mail=="true"){
      //mandar a cola de mails al admin si tiene mail.
      $query2 = $conn->query("INSERT INTO queue_mail (id_token,titulo,mensaje) VALUES ('128','".$titulo."','".$contenido."')") or die(mysqli_error($conn));
      $query2 = $conn->query("INSERT INTO queue_mail (id_token,titulo,mensaje) VALUES ('161','".$titulo."','".$contenido."')") or die(mysqli_error($conn));
    }
  } else {
    $obj->mensaje = "nada";
  }
  echo json_encode($obj);
}
?>