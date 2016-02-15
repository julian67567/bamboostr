<?PHP
/*EXAMPLE FACEBOK SDK V5.0*/
session_start();
include ''.dirname(__FILE__).'/../scripts/detectLanguageExplorer.php';
include ''.dirname(__FILE__).'/../conexioni.php';
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
  'default_graph_version' => 'v2.2',
]);
$access_token = 'CAAGmoxujSOIBAFi3uAvEFOqhqm1qCWDwWLVAd3NgLwCu5UgW8IcmQumLzsvwyoWWNrs3CeRzjAIv9Jez72Kr6LLhDeVOtiTY5lmqfxcNIXCVWnOAmeKWaUS69DwoWicLUIkNv28YoX8Adp3cMZCMPDmq6kes7wYwkB5aO57PZCgUZCXb5SILLauisulrqwZD';

//Nueva función SDK v5
//para no poner en cada petición el token $res = $fb->get('/me',$access_token);
// GET request in v5
//$response = $fb->get('/me', '{access-token}');

// POST request in v5
//$response = $fb->post('/me/feed', $data, '{access-token}');

// DELETE request in v5
//$response = $fb->delete('/123', $data, '{access-token}');

$fb->setDefaultAccessToken($access_token);

// validating the access token
	try {
		$request = $fb->get('/me');
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
		// When Graph returns an error
		if ($e->getCode() == 190) {
			//unset($_SESSION['facebook_access_token']);

			//depricated v4.0
			//$facebook = new FacebookRedirectLoginHelper('http://bamboostr.com/system.php');
			//header('Location: '.$facebook->getLoginUrl($params).'&auth_type=reauthenticate');			

			//Nueva función SDK v5
			$helper = $fb->getRedirectLoginHelper();
			header('Location: '.$helper->getLoginUrl("http://bamboostr.com/system.php", $permissions).'');
			
		}
		exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
		// When validation fails or other local issues
		echo 'Facebook SDK returned an error: ' . $e->getMessage();
		exit;
	}

print_r($request->getGraphObject()->getProperty('name'));
//print_r($request->getDecodedBody());
//$request->getGraphEdge()
?>