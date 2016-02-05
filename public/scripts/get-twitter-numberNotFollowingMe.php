<?PHP
$screen_name = $_POST["screen_name"];//$_POST["screen_name"];
//notfollowingme
$archivo = fopen("../twitter/usuarios/".$screen_name."/numnotfollowme.txt", "rb");
$contenido_notfollowingme = stream_get_contents($archivo);
fclose($archivo);
echo $contenido_notfollowingme;
?>