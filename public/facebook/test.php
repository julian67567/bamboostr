<?php
//PHP Version 5.4.34
session_start();
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
$params = array(
	'scope' => 'email, user_activities, publish_stream, read_stream, friends_likes, 
			  publish_actions, public_profile, user_friends, offline_access'
);
$facebook = new FacebookRedirectLoginHelper('http://infomundo.org/r/facebook2/test.php?redSocial=facebook');
try {
  $session = $facebook->getSessionFromRedirect();
} catch(FacebookRequestException $ex) {
  // When Facebook returns an error
} catch(\Exception $ex) {
  // When validation fails or other local issues
}
if(isset($session)) {
  //obtiene token
  //$session->getToken();
  //sesion con token
  // If you already have a valid access token:
  /*
  $session = new FacebookSession('access-token');

  // If you're making app-level requests:
  //no sirve en web access
  //$session = FacebookSession::newAppSession();

  // To validate the session:
  try {
    $session->validate();
  } catch (FacebookRequestException $ex) {
  // Session not valid, Graph API returned an exception with the reason.
    echo $ex->getMessage();
  } catch (\Exception $ex) {
  // Graph API returned info, but it may mismatch the current app or have expired.
    echo $ex->getMessage();
  }
  */
  /*
  LOGOUT
  
    Change your logout url:

    $logoutUrl = $facebook->getLogoutUrl(array( 'next' => ($fbconfig['baseurl'].'logout.php') ));

    On your logout.php page, add the following code:

    setcookie('fbs_'.$facebook->getAppId(), '', time()-100, '/', 'domain.com');
    session_destroy();
    header('Location: /');


  */
  // graph api request for user data
  //User /{user-id}
  //A user represents a person on Facebook. The /{user-id} node returns a single user.
  $request = new FacebookRequest($session, 'GET', '/me');
  $response = $request->execute();
  // get response
  $graphObject = $response->getGraphObject();

  // print data
  /*
  Facebook\GraphObject Object
(
    [backingData:protected] => Array
        (
            [id] => 100001184682948
            [email] => jockerclown690@gmail.com
            [first_name] => Manlio E.
            [gender] => male
            [last_name] => Teran
            [link] => http://www.facebook.com/100001184682948
            [locale] => es_LA
            [name] => Manlio E. Teran
            [timezone] => -6
            [updated_time] => 2014-06-28T17:02:43+0000
            [verified] => 1
        )

)
//obtiene informacion del access token como expire date en segundos
/*
// graph api request for user data
  $request = new FacebookRequest($session, 'GET', '/debug_token?input_token='.$acces_token.'&access_token='.$app_id.'|'.$app_secret.'');
  $response = $request->execute();
  // get response
  $graphObject = $response->getGraphObject();
  print_r($graphObject);
//Obtiene imágenes de perfil
	$request = new FacebookRequest($session, 'GET', '/me/picture',
	array (
     'redirect' => false,
     'height' => '200',
     'type' => 'normal',
     'width' => '200',
    ));
    $response = $request->execute();
    // get response
    $graphObject = $response->getGraphObject();
	$_SESSION['user_image'] = $graphObject->getProperty('url');
	

*/
  //$graphObject->getProperty('id');
  //grupos de facebook al que perteneces
  /*
  $request = new FacebookRequest($session, 'GET', '/me/groups');
  */
  echo '<br /><a href="src/Facebook/clearsessions.php">Cerrar Sesión</a><br />';
  
  $req =  array(
       'message' => 'Unete al nuevo concepto de Red Social! Accede y comparte con tus amigos!.',
       'name' => 'Nueva Red Social Infomundo',
       'link' => 'http://infomundo.org',
       'description' => 'Accede y comparte con tus amigos!.',
       'picture' => 'http://infomundo.org/Themes/blue_boxy/images/custom/infomundo.png');
  //Lee privilegios
  $request = new FacebookRequest($session, 'GET', '/me/permissions');
  $response = $request->execute();
  // get response
  $graphObject = $response->getGraphObject();
  // print data
  echo '<pre>' . print_r( $graphObject, 1 ) . '</pre>';
  //publica un mensaje
  $request = new FacebookRequest($session, 'POST', '/feed', $req);
  $response = $request->execute();
  // get response
  $graphObject = $response->getGraphObject();
  // print data
  echo '<pre>' . print_r( $graphObject, 1 ) . '</pre>';
  
} else {
  // show login url
  echo '<a href="' . $facebook->getLoginUrl($params) . '">Login</a>';
}
?>