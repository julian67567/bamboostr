<?PHP
//PHP Version 5.4.34
$liberar=$_GET["liberar"];
$redirect=$_GET["redirect"];
if($liberar==1){
  session_start();
  session_unset();
  session_destroy();
}
session_start();
//include '../conexioni.php';
include ''.dirname(__FILE__).'/../scripts/funciones.php';
require_once ''.dirname(__FILE__).'/src/Facebook/config.php';
require_once(''.dirname(__FILE__).'/autoload.php');
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
FacebookSession::setDefaultApplication($app_id, $app_secret);
/*,friends_about_me,user_checkins,friends_birthday,friends_checkins,friends_education_history,friends_events,friends_groups,friends_hometown,friends_interests,friends_likes,friends_location,user_notes,friends_notes,friends_photos,friends_relationships,friends_relationship_details,friends_religion_politics,friends_status,friends_videos,friends_website,friends_activities,publish_stream,offline_access*/

$params = array(
	'scope' => 'user_about_me,user_activities,user_birthday,user_education_history,user_events,user_groups,user_hometown,user_interests,user_likes,user_location,user_photos,user_relationships,user_relationship_details,user_religion_politics,user_status,user_videos,user_website,email,manage_pages,read_stream,read_page_mailboxes,read_insights,ads_management,read_friendlists,publish_actions,public_profile,user_friends,read_mailbox,user_posts,ads_read,ads_management');
echo "prueba";
if($redirect==1 || $redirect==2){
  if($_SESSION['sessionid'] && $_SESSION['identify']){
    echo "<!--".$_SESSION['FBRLH_state']." ".$_SESSION['FB_State']."-->";
    $_SESSION['FBRLH_state'] = NULL;
    $_SESSION['FB_State'] = NULL;
    //unset($_SESSION);
    $facebook = new FacebookRedirectLoginHelper('http://'.getDirUrl(1).'/system.php?agregarRed=facebook');
    //header('Location: '.$facebook->getReRequestUrl(params).'&auth_type=reauthenticate');
    header('Location: '.$facebook->getLoginUrl($params).'&auth_type=reauthenticate');
    /*
    $query = $conn->query("SELECT tipo,social_networks FROM token WHERE id='".$_SESSION['id_token']."'") or die(mysqli_error($conn));
    $row = $query->fetch_assoc();
    $num_redes = explode(",",$row['social_networks']);
    $num_redes = (count($num_redes)-1);
    
    if($row['tipo']=="ent" || ($row['tipo']!="ent" && $row['tipo']!="pro" && $row['tipo']!="basic" && $num_redes<3) || ($row['tipo']=="basic" && $num_redes<5) || ($row['tipo']=="pro" && $num_redes<15)){
      $facebook = new FacebookRedirectLoginHelper('http://'.$_SERVER['HTTP_HOST'].'/system.php?agregarRed=facebook');
    } else if($row['tipo']=="pro"){
      header('Location: http://'.$_SERVER['HTTP_HOST'].'/system.php?agregarRed=errorPro');
      die();
    } else if($row['tipo']=="basic"){
      header('Location: http://'.$_SERVER['HTTP_HOST'].'/system.php?agregarRed=errorBasic');
      die();
    } else if($row['tipo']!="pro" && $row['tipo']!="basic" && $row['tipo']!="ent"){
      header('Location: http://'.$_SERVER['HTTP_HOST'].'/system.php?agregarRed=error');
      die();  
    }*/
  } else {
    $facebook = new FacebookRedirectLoginHelper('http://'.getDirUrl(1).'/system.php');
  }
} else { 
  $_SESSION['red'] = "facebook";
  $facebook = new FacebookRedirectLoginHelper('http://'.getDirUrl(1).'/system.php');
  header('Location: '.$facebook->getLoginUrl($params).'&auth_type=reauthenticate');
}
  /*parameters getloginurl
  &display=popup
  &auth_type=reauthenticate
  */
?>