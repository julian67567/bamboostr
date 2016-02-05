<?PHP
ini_set('max_execution_time', 9000);
include '../../conexioni.php';
$id_token=$_POST["id_token"];
$id=$_POST["id"];
$nombre=utf8_decode($_POST["nombre"]);
$apellidoPaterno=utf8_decode($_POST["apellidoPaterno"]);
$apellidoMaterno=utf8_decode($_POST["apellidoMaterno"]);
$sexo=utf8_decode($_POST["sexo"]);
$edad=utf8_decode($_POST["edad"]);
$red=utf8_decode($_POST["red"]);
$nombreUsuario=utf8_decode($_POST["nombreUsuario"]);
$empresa=utf8_decode($_POST["empresa"]);
$country=utf8_decode($_POST["country"]);
$estado=utf8_decode($_POST["estado"]);
$direccion=utf8_decode($_POST["direccion"]);
$mail=utf8_decode($_POST["mail"]);
$telefono=utf8_decode($_POST["telefono"]);
$observaciones=utf8_decode($_POST["observaciones"]);

$query = $conn->query("UPDATE crm SET nombre='".$nombre."', apellidoPaterno='".$apellidoPaterno."', apellidoMaterno='".$apellidoMaterno."', sexo='".$sexo."', edad='".$edad."', red_social='".$red."', nombre_de_usuario='".$nombreUsuario."', empresa='".$empresa."', country='".$country."', estado='".$estado."', direccion='".$direccion."', mail='".$mail."', telefono='".$telefono."', observaciones='".$observaciones."' WHERE id='".$id."'");

print_r($query);

$conn->close;
?>