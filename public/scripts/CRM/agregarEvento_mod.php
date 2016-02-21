<?PHP
ini_set('max_execution_time', 9000);
include ''.dirname(__FILE__).'/../../conexioni.php';
$id_token=$_POST["id_token"];
$id=$_POST["id"];
$titulo=utf8_decode($_POST["titulo"]);
$ubicacion=utf8_decode($_POST["ubicacion"]);
$color=utf8_decode($_POST["color"]);
$fecha=utf8_decode($_POST["fecha"]);
$fecha2=utf8_decode($_POST["fecha2"]);

$query = $conn->query("UPDATE crm_evento SET titulo='".$titulo."', ubicacion='".$ubicacion."', color='".$color."', fecha='".$fecha."', fecha2='".$fecha2."' WHERE id='".$id."'") or die(mysqli_error($conn));

print_r($query);

$conn->close;
?>