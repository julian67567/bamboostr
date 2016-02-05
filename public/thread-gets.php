<?PHP
include ''.dirname(__FILE__).'/scripts/funciones.php';
$option = $argv[1];
if($option=="notificaciones"){
  $identify = $argv[2];
  $red = $argv[3];
  $url='http://'.getDirUrl(1).'/scripts/get-notificaciones.php?identify='.$identify.'&red='.$red.'&option='.$argv[4].'&id_token='.$argv[5].'';
}
if($option=="programMsgs"){
  $id_token = $argv[2];
  $url='http://'.getDirUrl(1).'/scripts/get-program-message.php?id_token='.$id_token.'';
}
if($option=="draftsMsgs"){
  $id_token = $argv[2];
  $url='http://'.getDirUrl(1).'/scripts/get-draft-message.php?id_token='.$id_token.'';
}
if($option=="publicadosMsgs"){
  $id_token = $argv[2];
  $url='http://'.getDirUrl(1).'/scripts/get-publicados-message.php?id_token='.$id_token.'';
}
if($option=="mail"){
  $id_token = $argv[2];
  $url='http://'.getDirUrl(1).'/scripts/recordatorio-mail.php?id_token='.$id_token.'';
}
if($option=="rastreo"){
  $id_token = $argv[2];
  $option2 = $argv[3];
  $url='http://'.getDirUrl(1).'/scripts/rastreo.php?id_token='.$id_token.'&option='.$option2.'';
}
if($option=="getCuentas"){
  $id_token = $argv[2];
  $identify = $argv[3];
  $url='http://'.getDirUrl(1).'/scripts/get-cuentas.php?id_token='.$id_token.'&identify='.$identify.'';
}
//abrimos la url y que la lea que contiene
$fo= fopen($url,"r") or die ("false");
while (!feof($fo)) {
	$cadena .= fgets($fo);
}
echo $cadena;
?>