<?PHP
include ''.dirname(__FILE__).'/conexioni.php';
include ''.dirname(__FILE__).'/scripts/funciones.php';
$nombreOmail = base_de_datos_scape($conn,$_POST["nombre"]);
$password = base_de_datos_scape($conn,encriptar($_POST["password"]));
$query = $conn->query("SELECT * FROM token WHERE (screen_name='".$nombreOmail."' OR mail='".$nombreOmail."') AND password='".$password."'") OR DIE(mysqli_error($conn));
if($query->num_rows>0){
  $obj = new stdclass();
  $obj->success = "true";
  echo json_encode($obj);
  session_start();
  session_regenerate_id();
  $row=$query->fetch_assoc();
  $_SESSION['sessionid'] = session_id(); 
  $_SESSION['user'] = $row["screen_name"];
  $_SESSION['user_bamboostr'] = $row["screen_name_bamboostr"];
  $_SESSION['identify'] = $row["id"];
  $_SESSION['mail'] = $row["mail"];
  $_SESSION['red'] = "no";
  $_SESSION['id_token'] = $row["id"];
  $_SESSION['foto_bamboostr'] = $row["foto_bamboostr"];
  //actualizamos fecha
  $conn->query("UPDATE token SET last_ssid='".date("d-m-Y")."' WHERE id='".$_SESSION['id_token']."'") OR die(mysqli_error($conn));
  //insertar SSID
  $conn->query("INSERT INTO ssid (id_token,ssid,screen_name,fecha) 
            VALUES ('".$_SESSION['id_token']."','".$_SESSION['sessionid']."','".$_SESSION['user']."','".date('d-m-Y H:i')."') ") OR DIE(mysqli_error($conn));
  $conn->query("INSERT INTO ssid_story (id_token,ssid,screen_name,fecha) 
            VALUES ('".$_SESSION['id_token']."','".$_SESSION['sessionid']."','".$_SESSION['user']."','".date('d-m-Y H:i')."') ") OR DIE(mysqli_error($conn));

} else {
  $obj = new stdclass();
  $obj->success = "false";
  $obj->text = "Usuario o Contraseña Incorrecta";
  echo json_encode($obj);  
}
$conn->close;
?>