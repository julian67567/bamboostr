<?PHP
include ''.dirname(__FILE__).'/conexioni.php';
include ''.dirname(__FILE__).'/funciones.php';
$name = base_de_datos_scape($conn,$_POST["nombre"]);
$contraseña = base_de_datos_scape($conn,encriptar($_POST["password"]));
$mail = base_de_datos_scape($conn,$_POST["mail"]);
$query = $conn->query("SELECT id FROM token WHERE screen_name='".$name."'");
if($query->num_rows==0){
    $query = $conn->query("INSERT INTO token (password,screen_name,screen_name_bamboostr,mail,red,idioma) VALUES ('".$contraseña."','".$name."','".$name."','".$mail."','no','es')") OR die(mysqli_error($conn));
    if($query===true){
        $obj = new stdclass();
        $obj->success = "true";
        echo json_encode($obj);
        session_start();
        session_regenerate_id();
        $query = $conn->query("SELECT * FROM token WHERE screen_name='".$name."'") OR DIE(mysqli_error($conn));
        $row=$query->fetch_assoc();
        $conn->query("UPDATE token SET identify='".$row["id"]."' WHERE id='".$row["id"]."'") OR die(mysqli_error($conn));
        $_SESSION['sessionid'] = session_id();
        $_SESSION['user'] = $row["screen_name"];
        $_SESSION['user_bamboostr'] = $row["screen_name_bamboostr"];
        $_SESSION['identify'] = $row["id"];
        $_SESSION['mail'] = $row["mail"];
        $_SESSION['red'] = "no";
        $_SESSION['id_token'] = $row["id"];
        $_SESSION['foto_bamboostr'] = $row["foto_bamboostr"];
        //notificacion de bienvenida
        $bodyNot = 'Gracias por tu interés, estamos seguros que con bamboostr podrás utilizar tus Redes Sociales de la mejor manera para poder conseguir más clientes potenciales y hacer crecer tu negocio. <br /><br />Aquí encontrarás las herramientas necesarias para  posicionar tu marca en este importante canal, que día con día cobra mayor impacto. <br /><br />Para cualquier aclaración, duda o sugerencia escribanos en nuestras redes sociales o envíe un mensaje a soporte@bamboostr.com';
		$conn->query("INSERT INTO notificaciones (id_token,receptor,titulo,mensaje,fecha,red,tipo) 
		              VALUES ('".$_SESSION['id_token']."','','Bienvenido a Bamboostr','".utf8_decode($bodyNot)."','".date("d-m-Y H:i")."','no','mensaje')") OR DIE(mysqli_error($conn));
		//insertar SSID
        $conn->query("INSERT INTO ssid (id_token,ssid,screen_name,fecha) 
                    VALUES ('".$_SESSION['id_token']."','".$_SESSION['sessionid']."','".$_SESSION['user']."','".date('d-m-Y H:i')."') ") OR DIE(mysqli_error($conn));
        $conn->query("INSERT INTO ssid_story (id_token,ssid,screen_name,fecha) 
                    VALUES ('".$_SESSION['id_token']."','".$_SESSION['sessionid']."','".$_SESSION['user']."','".date('d-m-Y H:i')."') ") OR DIE(mysqli_error($conn));

    } else {
        $obj = new stdclass();  
        $obj->success = "false";
        $obj->text = "ERROR en la base de datos. Contacte a su administrador";
        echo json_encode($obj);
    }
} else {
  $obj = new stdclass();  
  $obj->success = "false";
  $obj->text = "Usuario existente. Use otro";
  echo json_encode($obj); 
}
$conn->close;
?>