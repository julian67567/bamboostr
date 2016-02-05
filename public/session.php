<?PHP
session_start();
include ''.dirname(__FILE__).'/config.php';
include ''.dirname(__FILE__).'/conexioni.php';
$lifetime = 60000;
session_set_cookie_params($lifetime);
ini_set("session.cookie_lifetime",$lifetime);
ini_set("session.gc_maxlifetime",$lifetime);
ini_set('max_execution_time', $lifetime);
if($_SESSION['user']){
  setcookie("id_token", $_SESSION['id_token'], time()+$lifetime);
  setcookie("sessionid", $_SESSION['sessionid'], time()+$lifetime);
  setcookie("identify", $_SESSION['identify'], time()+$lifetime);
  setcookie("user", $_SESSION['user'], time()+$lifetime);
  setcookie("access_token", $_SESSION['access_token'], time()+$lifetime);
  setcookie("red", $_SESSION['red'], time()+$lifetime);
  setcookie("user_image", $_SESSION['user_image'], time()+$lifetime);
  setcookie("foto_bamboostr", $_SESSION['foto_bamboostr'], time()+$lifetime);
  setcookie("user_bamboostr", $_SESSION['user_bamboostr'], time()+$lifetime);
  $status="OK";
} else {
  // debe de tener cookie si no los primeros sign in fallan
  
  if($_COOKIE['user']){
	$_SESSION['id_token'] = $_COOKIE['id_token'];
	$_SESSION['sessionid'] = $_COOKIE['sessionid'];
	$_SESSION['identify'] = $_COOKIE['identify'];
	$_SESSION['user'] = $_COOKIE['user'];
	$_SESSION['access_token'] = $_COOKIE['access_token'];
	$_SESSION['red'] = $_COOKIE['red'];
    $_SESSION['user_image'] = $_COOKIE['user_image'];
    $_SESSION['user_bamboostr'] = $_COOKIE['user_bamboostr'];
    $_SESSION['foto_bamboostr'] = $_COOKIE['foto_bamboostr'];
	$status="OK";
  }
}
$redSocial=$_SESSION['red'];
include ''.dirname(__FILE__).'/scripts/detectLanguageExplorer.php';
//Twitter API 1.1
if(($redSocial=="twitter" || $_GET["agregarRed"]=="twitter") && ($_GET["agregarRed"]!="facebook" && $_GET["agregarRed"]!="instagram") ){
  include ''.dirname(__FILE__).'/login-twitter.php';
} else if( ($redSocial=="facebook" || $_GET["agregarRed"]=="facebook")  && ($_GET["agregarRed"]!="twitter" && $_GET["agregarRed"]!="instagram")){
  include ''.dirname(__FILE__).'/login-facebook.php';
} else if( ($redSocial=="instagram" || $_GET["agregarRed"]=="instagram")  && ($_GET["agregarRed"]!="twitter" && $_GET["agregarRed"]!="facebook")){
  include ''.dirname(__FILE__).'/login-instagram.php';
} else {
  echo "<!--no hay entrada a logins -->";
}
require_once("".dirname(__FILE__)."/scripts/mobileDetect.php");
if(class_exists('Mobile_Detect')){ 
  $detect = new Mobile_Detect();
  $deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
}
?>