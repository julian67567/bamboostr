<?PHP
$screen_name=$argv[1];
$option=$argv[2];
if($option==2){
  $archivo = fopen("usuarios/".$screen_name."/notfollowme.txt", "rb");
}
if($option==3){
  $archivo = fopen("usuarios/".$screen_name."/bots.txt", "rb");
}
if($option==4){
  $archivo = fopen("usuarios/".$screen_name."/inactivas.txt", "rb");
}
if($option==5){
  $archivo = fopen("usuarios/".$screen_name."/image.txt", "rb");
}
if($option==6){
  $archivo = fopen("usuarios/".$screen_name."/blacklist.txt", "rb");
}

$contenido = stream_get_contents($archivo);
fclose($archivo);
$contenido_array=explode("\n",$contenido);
$obj = new stdclass();
$obj->hojaNumber = count($contenido_array);
echo json_encode($obj);
?>