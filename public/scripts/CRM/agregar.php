<?PHP
ini_set('max_execution_time', 9000);
include ''.dirname(__FILE__).'/../../conexioni.php';
include ''.dirname(__FILE__).'/../funciones.php';
$id_token=$_POST["id_token"];
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

$country = obtenerPais($country);


$query = $conn->query("INSERT INTO crm (id_token,nombre,apellidoPaterno,apellidoMaterno,sexo,edad,red_social,nombre_de_usuario,empresa,country,estado,direccion,mail,telefono,observaciones) VALUES ('".
$id_token."','".$nombre."','".$apellidoPaterno."','".$apellidoMaterno."','".$sexo."','".$edad."','".$red."','".$nombreUsuario."','".$empresa."','".$country."','".$estado."','".$direccion."','".$mail."','".$telefono."','".$observaciones."')") or die(mysqli_error($conn));

$conn->close;
?>