<?PHP
include ''.dirname(__FILE__).'/../scripts/funciones.php';
$identify = $argv[1];
$userId = $argv[2];
$i = $argv[3];
$url='http://'.getDirUrl(1).'/facebook/get-profileDetails.php?identify='.$identify.'&userId='.$userId.'&i='.$i.'';

//abrimos la url y que la lea que contiene
$fo= fopen($url,"r") or die ("false");
while (!feof($fo)) {
	$cadena .= fgets($fo);
}
echo $cadena;
?>