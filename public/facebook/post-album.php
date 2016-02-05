<?php
//PHP Version 5.4.34
include '../conexioni.php';
$identify=$_GET["identify"];
$idPost = $_GET["idPost"];
$images=$_GET["images"];
$messages=$_GET["messages"];
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
$query=$conn->query("SELECT access_token FROM token WHERE identify='".$identify."' AND red='facebook'");
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
	  //?limit=, ?since=, ?until=, ?filter=app_key
	  /*
	    Multiple Images On Facebook
		
		
		Edit:
		(regarding grouping of photos on wall)
		
		This grouping is done by facebook automatically if some photos are uploaded into the same album.
		
		Currently you can create an album.
		
		/{user-id}/albums -> Publishing
		
		Then get the album_id /{user-id}/albums, then use the the code.
		
	   /album-id/photos POST
		
		NOTA: fileUpload no se necesita declarar en true ya esta por defecto
		
		// source es un campo en vez de url para forms type file necesita estar en base64 o puedes usar
		//  base64_encode(file_get_contents($image_path_url))
		// No es necesario tener un album api graph te asigna un nuevo album
		
		*/
	  $images_array = explode(",",$images);
	  $messages_array = explode(",",$messages);
	  $c=0;
	  foreach($images_array as $photo){
		   if($photo!=""){
		     $req = array('message' => $messages_array[$c],
			              'url' => $photo);
			 //publicar imagen
			 if($idPost){
				$request = new FacebookRequest($session, 'POST', '/'.$idPost.'/photos', $req);
			  } else {
				$request = new FacebookRequest($session, 'POST', '/me/photos', $req);
			  }
			  $response = $request->execute();
	          // get response
	          $graphObject = $response->getGraphObject();
		   }
		   $c++;
	  }
	
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
	  print_r($graphObject);
	} else { 
	  echo "false";
	}
} else {
  echo "false";
}