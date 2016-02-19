<?PHP
include ''.dirname(__FILE__).'/../funciones.php';
$option = $argv[1];
$id_token = $argv[2];
$red = $argv[4];
if($option=="sendDmsTwitter"){
  $dm_name = $argv[2];
  $text = $argv[3];
  $screen_name = $argv[4];
  //echo "".$text." ".$dm_name."";
  $url='http://'.getDirUrl(1).'/twitter/post-dm.php?screen_name='.$screen_name.'&txt='.cadena_a_getUrlCadena($text).'&dm_name='.$dm_name.'';
}
if($option=="eliminarDm"){
  $id = $argv[2];
  $option2 = $argv[3];
  $id_token = $argv[4];
  $url='http://'.getDirUrl(1).'/scripts/responder/eliminarDMS.php?id='.$id.'&option2='.$option2.'&id_token='.$id_token.'';
}
if($option=="setDMS"){
  $url='http://'.getDirUrl(1).'/scripts/responder/setDMS.php?id_token='.$id_token.'';
}
if($option=="setDMSTwitter"){
  $identify = $argv[3];
  $url='http://'.getDirUrl(1).'/scripts/responder/setDMSTwitter.php?id_token='.$id_token.'&identify='.$identify.'';
}
if($option=="setDMSFacebook"){
  $identify = $argv[3];
  $url='http://'.getDirUrl(1).'/scripts/responder/setDMSFacebook.php?id_token='.$id_token.'&identify='.$identify.'';
}
if($option=="getDMS"){
  $url='http://'.getDirUrl(1).'/scripts/responder/getDMS.php?id_token='.$id_token.'';
}
if($option=="setPinDMS"){
  $id = $argv[3];
  $est = $argv[4];
  $url='http://'.getDirUrl(1).'/scripts/responder/setPinDMS.php?id_token='.$id_token.'&est='.$est.'&id='.$id.'';
}
if($option=="getConversation"){
  $identify_sender = $argv[3];
  $identify_recipient = $argv[5];
  $url='http://'.getDirUrl(1).'/scripts/responder/getConversation.php?id_token='.$id_token.'&identify_sender='.$identify_sender.'&red='.$red.'&identify_recipient='.$identify_recipient.'';
}
if($option=="setReadDMS"){
  $identify = $argv[3];
  $url='http://'.getDirUrl(1).'/scripts/responder/setReadDMS.php?id_token='.$id_token.'&identify='.$identify.'';
}
if($option=="setReadAllDMS"){
  $url='http://'.getDirUrl(1).'/scripts/responder/setReadAllDMS.php?id_token='.$id_token.'';
}
if($option=="setReadAllAi"){
  $url='http://'.getDirUrl(1).'/scripts/responder/setReadAllAi.php?id_token='.$id_token.'';
}
//abrimos la url y que la lea que contiene
$fo= fopen($url,"r") or die ("false");
while (!feof($fo)) {
	$cadena .= fgets($fo);
}
echo $cadena;
?>