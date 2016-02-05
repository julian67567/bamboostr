<?PHP
ini_set('max_execution_time', 900000);
include ''.dirname(__FILE__).'/../conexioni.php';
include ''.dirname(__FILE__).'/../scripts/funciones.php';
session_start();
require_once(''.dirname(__FILE__).'/../facebook-4.5/src/Facebook/config.php');
require_once(''.dirname(__FILE__).'/../facebook-4.5/src/Facebook/autoload.php');
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
$permissions = array(
	'scope' => 'user_about_me,user_activities,user_birthday,user_education_history,user_events,user_groups,user_hometown,user_interests,user_likes,user_location,user_photos,user_relationships,user_relationship_details,user_religion_politics,user_status,user_videos,user_website,email,manage_pages,read_stream,read_page_mailboxes,read_insights,ads_management,read_friendlists,publish_actions,public_profile,user_friends,read_mailbox,user_posts,ads_read,ads_management');

//Nueva función SDK v5
$fb = new Facebook\Facebook([
  'app_id' => $app_id,
  'app_secret' => $app_secret,
  'default_graph_version' => 'v2.5',
]);

$id_token = $_GET["id_token"];
$identify = $_GET["identify"];
$id_message = $_GET["id_message"];
$message = $_GET["message"];
//limite de mensajes
$limit = 2;		
$query4=$conn->query("SELECT access_token FROM social_share WHERE identify='".$identify."' AND red='facebook' order by id DESC") or die(mysqli_error($conn));
if($query4->num_rows>0){
    $row4=$query4->fetch_assoc();
    $fb->setDefaultAccessToken($row4["access_token"]);
    // validating the access token
    //echo "".$identify." ".$row4["access_token"]."<br />";
    try {
      $request = $fb->post(''.$id_message.'/messages?message='.rawurlencode(utf8_encode($message)).'');   
    } catch(Facebook\Exceptions\FacebookResponseException $e) {
        // When Graph returns an error
        if ($e->getCode() == 190) {
            //unset($_SESSION['facebook_access_token']);

            //depricated v4.0
            //$facebook = new FacebookRedirectLoginHelper('http://bamboostr.com/system.php');
            //header('Location: '.$facebook->getLoginUrl($params).'&auth_type=reauthenticate');
            //Nueva función SDK v5
            $helper = $fb->getRedirectLoginHelper();
            header('Location: '.$helper->getLoginUrl("http://".getDirUrl(1)."/reponder.php", $permissions).'');
            
        }
        exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
        // When validation fails or other local issues
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }
    //print_r($request);
    //echo "no c";
    //print_r($request);
    $response = $request->getDecodedBody();
    if($response['id']){
      $obj = new stdclass();
      $obj->success="true";
      echo json_encode($obj);      
    } else {
      $obj = new stdclass();
      $obj->success="false";
      $obj->error="no se creo el mensaje";
      echo json_encode($obj); 
    }
    
} else {
  $obj = new stdclass();
  $obj->success="false";
  echo json_encode($obj);  
}