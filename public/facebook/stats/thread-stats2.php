<?PHP
include ''.dirname(__FILE__).'/../../scripts/funciones.php';
if($argv[4]=="1"){
  $url='http://'.getDirUrl(1).'/facebook/stats/get-page-insights-likes-cron.php?identify='.$argv[1].'&identify_account='.$argv[2].'';
} else if($argv[4]=="2"){
  $url='http://'.getDirUrl(1).'/facebook/stats/get-page-insights-lifetime-cron.php?identify='.$argv[1].'&identify_account='.$argv[2].'';
} else if($argv[4]=="3"){
  $url='http://'.getDirUrl(1).'/facebook/stats/get-page-insights-likes-removes-cron.php?identify='.$argv[1].'&identify_account='.$argv[2].'';
} else if($argv[4]=="4"){
  $url='http://'.getDirUrl(1).'/facebook/stats/get-page-insights-admin-num-posts-cron.php?identify='.$argv[1].'&identify_account='.$argv[2].'';
} else if($argv[4]=="5"){
  $url='http://'.getDirUrl(1).'/facebook/stats/get-page-insights-fans-locale-cron.php?identify='.$argv[1].'&identify_account='.$argv[2].'';
} else if($argv[4]=="6"){
  $url='http://'.getDirUrl(1).'/facebook/stats/get-page-insights-fans-city-cron.php?identify='.$argv[1].'&identify_account='.$argv[2].'';
} else if($argv[4]=="7"){
  $url='http://'.getDirUrl(1).'/facebook/stats/get-page-insights-fans-country-cron.php?identify='.$argv[1].'&identify_account='.$argv[2].'';
} else if($argv[4]=="8"){
  $url='http://'.getDirUrl(1).'/facebook/stats/get-page-insights-fans-gender-age-cron.php?identify='.$argv[1].'&identify_account='.$argv[2].'';
} else if($argv[4]=="9"){
  $url='http://'.getDirUrl(1).'/facebook/stats/get-page-insights-fans-online-cron.php?identify='.$argv[1].'&identify_account='.$argv[2].'';
} else if($argv[4]=="10"){
  $url='http://'.getDirUrl(1).'/facebook/stats/get-page-insights-fans-online-per-cron.php?identify='.$argv[1].'&identify_account='.$argv[2].'';
} 
//abrimos la url y que la lea que contiene
$fo= fopen($url,"r") or die ("false");
while (!feof($fo)) {
	$cadena .= fgets($fo);
}
echo $cadena;
?>