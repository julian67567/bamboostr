<?php
//PHP Version 5.4.34
include '../conexioni.php';
$identify=$_GET["identify"];
$count=$_GET["count"];
$until=$_GET["until"];
$userPage=$_GET["userPage"];
session_start();
require_once 'src/Facebook/config.php';
require_once('autoload.php');
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
if($userPage==""){
  $query=$conn->query("SELECT access_token FROM token WHERE identify='".$identify."' AND red='facebook'");
} else {
  $query=$conn->query("SELECT access_token FROM social_share WHERE identify='".$userPage."' AND red='facebook' AND tipo='page' order by id DESC");
}
if($query->num_rows>0){
	$row=$query->fetch_assoc();
	$acces_token = $row["access_token"];
	$conn->close();
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
	  if($until)
	    $request = new FacebookRequest($session, 'GET', '/me/feed?until='.$until.'&limit='.$count.'');
	  else
	    $request = new FacebookRequest($session, 'GET', '/me/feed?limit='.$count.'');
	  $response = $request->execute();
	  // get response
	  $graphObject = $response->getGraphObject();
          //print_r($graphObject);
	
	} catch (FacebookRequestException $ex) {
	  // Session not valid, Graph API returned an exception with the reason.
	  echo $ex->getMessage();
	  $error = 1;
	} catch (\Exception $ex) {
	  // Graph API returned info, but it may mismatch the current app or have expired.
	  echo $ex->getMessage();
	  $error = 1;
	} 
	if($error==0) {
          if($graphObject->getProperty('data'))
	    echo json_encode($graphObject->getProperty('data')->asArray());
          else
            echo "false";
	} else { 
	  echo "false";
	}
} else {
  echo "false";
}
?>