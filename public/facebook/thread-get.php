<?PHP
include '../scripts/funciones.php';
$option = $argv[1];
if($option=="getMsgs"){
  $identify = $argv[2];
  $count = $argv[3];
  $until = $argv[4];
  $userPage = $argv[5];
  if($until) {
    $url='http://'.getDirUrl(1).'/facebook/get-mensajes.php?identify='.$identify.'&count='.$count.'&until='.$until.'&userPage='.$userPage.'';
  } else { 
    $url='http://'.getDirUrl(1).'/facebook/get-mensajes.php?identify='.$identify.'&count='.$count.'&userPage='.$userPage.'';
  }
}
if($option=="getFeeds"){
  $identify = $argv[2];
  $count = $argv[3];
  $until = $argv[4];
  if($until) {
    $url='http://'.getDirUrl(1).'/facebook/get-feeds.php?identify='.$identify.'&count='.$count.'&until='.$until.'';
  } else { 
    $url='http://'.getDirUrl(1).'/facebook/get-feeds.php?identify='.$identify.'&count='.$count.'';
  }
}
if($option=="postInbox"){
  $identify = $argv[2];
  $id_message = $argv[3];
  $message = $argv[4];
  $url='http://'.getDirUrl(1).'/facebook/post-inbox.php?identify='.$identify.'&id_message='.$id_message.'&message='.cadena_a_getUrlCadena($message).'&identify_sender='.$identify_sender.'';
}
if($option=="getInbox"){
  $identify = $argv[2];
  $count = $argv[3];
  $until = $argv[4];
  $userPage = $argv[5];
  if($until) {
	$url='http://'.getDirUrl(1).'/facebook/get-inbox.php?identify='.$identify.'&count='.$count.'&until='.$until.'&userPage='.$userPage.'';
  } else { 
    $url='http://'.getDirUrl(1).'/facebook/get-inbox.php?identify='.$identify.'&count='.$count.'&userPage='.$userPage.'';
  }
}
if($option=="getMentions"){
  $identify = $argv[2];
  $count = $argv[3];
  $until = $argv[4];
  if($until) {
	$url='http://'.getDirUrl(1).'/facebook/get-mentions.php?identify='.$identify.'&count='.$count.'&until='.$until.'';
  } else { 
    $url='http://'.getDirUrl(1).'/facebook/get-mentions.php?identify='.$identify.'&count='.$count.'';
  }
}
if($option=="getEvents"){
  $identify = $argv[2];
  $count = $argv[3];
  $until = $argv[4];
  if($until) {
	$url='http://'.getDirUrl(1).'/facebook/get-events.php?identify='.$identify.'&count='.$count.'&until='.$until.'';
  } else { 
    $url='http://'.getDirUrl(1).'/facebook/get-events.php?identify='.$identify.'&count='.$count.'';
  }
}
if($option=="getSearch"){
  $identify = $argv[3];
  $search = rawurlencode($argv[2]);
  $type = $argv[4];
  $url='http://'.getDirUrl(1).'/facebook/get-search.php?identify='.$identify.'&search='.$search.'&type='.$type.'';
}
//abrimos la url y que la lea que contiene
$fo= fopen($url,"r") or die ("false");
while (!feof($fo)) {
	$cadena .= fgets($fo);
}
echo $cadena;
?>