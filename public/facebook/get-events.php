<?php
include '../conexioni.php';
$identify=$_GET["identify"];
session_start();
require_once ('src/Facebook/config.php');
require_once ('autoload.php');

use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;

$query=$conn->query("SELECT access_token FROM token WHERE identify='".$identify."' AND red='facebook'");
if($query->num_rows>0){
	$row=$query->fetch_assoc();
	$conn->close();
	$acces_token = $row["access_token"];
	FacebookSession::setDefaultApplication($app_id, $app_secret);
	$session = new FacebookSession($acces_token);
	// If you're making app-level requests:
	// Con web sessions falla
	//$session = FacebookSession::newAppSession();
	// To validate the session:
	$error = 0;
	try {
	  $session->validate($app_id, $app_secret);
	  // graph api request for user data
	  //?limit=, ?since=, ?until=, ?filter=app_key, ?offset= 
	  //si hay mas de dos parametros se separa por &
	  //offset puede llegar a ser confuso mirar: https://developers.facebook.com/blog/post/478/
	  //por ello se recomiendo until o since
	  $request = new FacebookRequest($session, 'GET', '/me/events/not_replied');
	  $response = $request->execute();
	  // get response
	  $graphObject = $response->getGraphObject();
	} catch (FacebookRequestException $ex) {
	  // Session not valid, Graph API returned an exception with the reason.
          $obj = new stdclass();
          $obj->errors = $ex->getMessage();
	  echo json_encode($obj);
	  $error = 1;
	} catch (\Exception $ex) {
	  // Graph API returned info, but it may mismatch the current app or have expired.
	  //echo $ex->getMessage();
          $obj = new stdclass();
          $obj->errors = $ex->getMessage();
	  echo json_encode($obj);
	  $error = 1;
	} 
	if($error==0) {
	  echo json_encode($graphObject->getProperty('data')->asArray());
	} else {
	  echo "false";
	}
} else {
  echo "false";
}
?>