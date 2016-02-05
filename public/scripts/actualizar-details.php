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
//fan pages while para sacar las fan pages de todas tus cuentas facebook secundarias
$query2=$conn->query("SELECT id,tipo,perms,admin,red,name,identify,identify_account,activation FROM social_share 
                            WHERE id_token='".$id_token."'");
unset($row2);					 
if($query2->num_rows>0){
    while($row2=$query2->fetch_assoc()){
    if(strpos($row2["perms"],"CREATE_CONTENT") || strpos($row2["perms"],"CREATE_ADS") || strpos($row2["perms"],"BASIC_ADMIN") || $row2["admin"]==1 && ($row2["tipo"]=="grupo" || $row2["tipo"]=="page")){
                        $feed_array_escribir[$c][0]=$row2["id"];
        $feed_array_escribir[$c][1]=$row2["red"];
        $feed_array_escribir[$c][2]=str_replace('|', '', $row2["name"]);
        $feed_array_escribir[$c][2]=str_replace('"', '',$feed_array_escribir[$c][2]);
        if($row2["tipo"]=="grupo"){
                $feed_array_escribir[$c][3]="images/grupos-facebook.png";
            $feed_array_escribir[$c][9]="grupo";
        } else {
            $feed_array_escribir[$c][3]="images/fan-page.png";
            $feed_array_escribir[$c][9]="page";
        }
        $feed_array_escribir[$c][7]=$row2["identify"];
        $feed_array_escribir[$c][8]=$row2["identify_account"];
                        $feed_array_escribir[$c][10]=$row2["activation"];
                        $feed_array_escribir[$c][11]="";
                        $feed_array_escribir[$c][12]=$row2["id"];
        $c++;
    }/*fin if perms*/
    }/*fin while*/
}/*fin num_rows*/
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
            }
        } else {
            $obj = new stdclass();  
            $obj->success = "false";  
            $obj->texto = "Error intentelo nuevamente"; 
        }
    } else {
        $obj = new stdclass();  
        $obj->success = "false"; 
        $obj->texto = "El nombre ya existe"; 
    }
} else {
  $obj = new stdclass();  
  $obj->success = "false"; 
  $obj->texto = "No existe tu usuario"; 
}
echo json_encode($obj);
$conn->close;
?>