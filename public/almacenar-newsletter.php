<?PHP
include 'config/config.php';
conexion();
$nombre = $_POST["nombre"];
$email = $_POST["email"];
$query=mysql_query("INSERT INTO boletines (nombre,mail) VALUES ('".utf8_decode($nombre)."','".$email."')");
?>