<?php
//PHP Version 5.4.34
include ''.dirname(__FILE__).'/../conexioni.php';
$identify_account=$_POST["identify_account"];
$identify = $_POST["identify"];
$id_token=$_POST["id_token"];
//100004745324034
//$_GET["identify"]
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
if($identify=="")
  $query=$conn->query("SELECT access_token FROM token WHERE identify='".$identify_account."' AND red='facebook'") or die(mysqli_error($conn));
else
  $query=$conn->query("SELECT access_token FROM social_share WHERE id_token='".$id_token."' AND identify_account='".$identify_account."' AND identify='".$identify."' AND red='facebook'") or die(mysqli_error($conn));
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
	  $request = new FacebookRequest($session, 'GET', '/me/feed?limit=20');
	  $response = $request->execute();
	  // get response
	  $graphObject = $response->getGraphObject();
	
	} catch (FacebookRequestException $ex) {
	  // Session not valid, Graph API returned an exception with the reason.
	  echo $ex->getMessage();
	  $error = 1;
	} catch (\Exception $ex) {
	  // Graph API returned info, but it may mismatch the current app or have expired.
	  echo $ex->getMessage();
	  $error = 1;
	} 
        $posts = $graphObject->getProperty('data')->asArray();
        $c=0;
        $obj_array = [];
        foreach($posts as $item){
          $obj = new stdclass();
          $obj->id = $item->id;
          $obj->from->name= $item->from->name;
          $obj->link = $item->link;
          $obj->picture = $item->picture;
          $obj->message = $item->message;
          $obj->created_time = $item->created_time;

          $request2 = new FacebookRequest($session, 'GET', '/'.$item->id.'/insights');
	  $response2 = $request2->execute();
	  // get response
	  $graphObject2 = $response2->getGraphObject();
          $stats = $graphObject2->getProperty('data')->asArray();
          if($stats[21]->values[0]->value){
            $obj->clicks = $stats[21]->values[0]->value;
          } else {
            $obj->clicks = 0;
          }
          if($stats[22]->values[0]->value->{'link clicks'}){
            $obj->link_clicks = $stats[22]->values[0]->value->{'link clicks'};
          } else {
            $obj->link_clicks = 0;
          }
          $obj->likes = $stats[31]->values[0]->value->like;
          $obj->engaged_users = $stats[32]->values[0]->value;
          $obj->total_reach = $stats[4]->values[0]->value;

          $obj_array[$c] = new stdclass();
          $obj_array[$c] = $obj;
          $c++;
        }
        $response = new stdclass();
        $response = $obj_array;        

	if($error==0) {
	  echo json_encode($response);
	} else { 
	  echo "false";
	}
} else {
  echo "false";
}
?>