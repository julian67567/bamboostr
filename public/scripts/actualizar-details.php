<?PHP
include ''.dirname(__FILE__).'/../conexioni.php';
include ''.dirname(__FILE__).'/funciones.php';
session_start();
$id_token = base_de_datos_scape($conn,$_GET["id_token"]);
$username = base_de_datos_scape($conn,$_GET["username"]);
$nombre = base_de_datos_scape($conn,$_GET["nombre"]);
$mail = base_de_datos_scape($conn,$_GET["mail"]);
$categoria = base_de_datos_scape($conn,$_GET["categoria"]);
$password = base_de_datos_scape($conn,encriptar($_GET["password"]));
$image = base_de_datos_scape($conn,$_GET["image"]);
$option = base_de_datos_scape($conn,$_GET["option"]);
if($option==3){
  $query = $conn->query("UPDATE token SET foto_bamboostr='".$image."' WHERE id='".$id_token."'") OR DIE(mysqli_error($conn));
  if($query===true){
        $_SESSION["foto_bamboostr"] = $image;
        $obj = new stdclass();  
        $obj->success = "true";
        $obj->text = "Password: no";
  } else {
        $obj = new stdclass();  
        $obj->success = "false";
        $obj->texto = "Error intentelo nuevamente"; 
  }
  echo json_encode($obj);
  die();
}
$query = $conn->query("SELECT screen_name FROM token WHERE id='".$id_token."'") OR DIE(mysqli_error($conn));
if($query->num_rows>0){
    $query2 = $conn->query("SELECT id FROM token WHERE screen_name='".$username."' AND  id='".$id_token."'") OR DIE(mysqli_error($conn));
    $query = $conn->query("SELECT id FROM token WHERE screen_name='".$username."'") OR DIE(mysqli_error($conn));
    if($query->num_rows==0 || $query2->num_rows>0){
        if($option==1){
            //sin password
            $query = $conn->query("UPDATE token SET screen_name='".$username."', screen_name_bamboostr='".$nombre."', mail='".$mail."', categoria='".$categoria."' WHERE id='".$id_token."'") OR DIE(mysqli_error($conn));
            if($query===true){
                $obj = new stdclass();  
                $obj->success = "true";
                $obj->text = "Password: No";
                $_SESSION["user_bamboostr"] = $nombre;
                $obj->screen_name = $username;
                $obj->screen_name_bamboostr = $nombre;
                $obj->mail = $mail;
                $obj->categoria = $categoria;
            } else {
                $obj = new stdclass();  
                $obj->success = "false";
                $obj->texto = "Error intentelo nuevamente"; 
                $obj->error = 5;
            }
        } else if($option==2) {
            //con password  
            $query = $conn->query("UPDATE token SET username='".$username."', screen_name_bamboostr='".$nombre."', mail='".$mail."', categoria='".$categoria."', password='".$password."' WHERE id='".$id_token."'") OR DIE(mysqli_error($conn));
            if($query===true){
                $obj = new stdclass();  
                $obj->success = "true";
                $obj->text = "Password: Yes";
                $_SESSION["user_bamboostr"] = $nombre;
                $obj->screen_name = $username;
                $obj->screen_name_bamboostr = $nombre;
                $obj->mail = $mail;
                $obj->categoria = $categoria;
            } else {
                $obj = new stdclass();  
                $obj->success = "false";
                $obj->texto = "Error intentelo nuevamente"; 
                $obj->error = 4;
            }
        } else {
            $obj = new stdclass();  
            $obj->success = "false";  
            $obj->texto = "Error intentelo nuevamente"; 
            $obj->error = 3;
        }
    } else {
        $obj = new stdclass();  
        $obj->success = "false"; 
        $obj->texto = "El nombre ya existe"; 
        $obj->error = 2;
    }
} else {
  $obj = new stdclass();  
  $obj->success = "false"; 
  $obj->texto = "No existe tu usuario"; 
  $obj->error = 1;
}
echo json_encode($obj);
$conn->close;
?>