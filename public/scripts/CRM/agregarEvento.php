<?PHP
ini_set('max_execution_time', 9000);
include ''.dirname(__FILE__).'/../../conexioni.php';
$id_token=$_POST["id_token"];
$titulo=utf8_decode($_POST["titulo"]);
$ubicacion=utf8_decode($_POST["ubicacion"]);
$color=utf8_decode($_POST["color"]);
$fecha=utf8_decode($_POST["fecha"]);
$fecha2=utf8_decode($_POST["fecha2"]);

$query = $conn->query("INSERT INTO crm_evento (id_token,titulo,ubicacion,color,fecha,fecha2) VALUES ('".
$id_token."','".$titulo."','".$ubicacion."','".$color."','".$fecha."','".$fecha2."')") or die(mysqli_error($conn));

$conn->close;
?>