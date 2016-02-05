<?PHP
$screen_name=$argv[1];
$archivo = fopen("../twitter/usuarios/".$screen_name."/followingTool.txt", "rb");
$contenido = stream_get_contents($archivo);
fclose($archivo);
$contenido_array=explode("|",$contenido);
$obj = new stdclass();
$obj->cursor = $contenido_array[count($contenido_array)-2];
$obj->hojaNumber = substr($contenido_array[count($contenido_array)-3],5,strlen($contenido_array[count($contenido_array)-3]));
echo json_encode($obj);
?>