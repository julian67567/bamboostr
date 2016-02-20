<?php
//PHP Version 5.4.34
include ''.dirname(__FILE__).'/../conexioni.php';
$identify=$_GET["identify"];
$idPost = $_GET["idPost"];
$messages=$_GET["messages"];
$images=$_GET["images"];
$description=$_GET["description"];
$link=$_GET["link"];
$name=$_GET["screen_name"];
$id_token=$_GET["id_token"];
$fecha=$_GET["fecha"];
if($fecha=="")
  $fecha = ''.date("d-m-Y").'';
$horario=$_GET["horario"];
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
if(!$idPost)
  $query=$conn->query("SELECT foto,access_token FROM token WHERE identify='".$identify."' AND red='facebook'") OR die("Error select identify: ".mysqli_error($conn)."");
else
  $query=$conn->query("SELECT access_token FROM social_share WHERE identify='".$idPost."' AND red='facebook' order by id DESC") OR die("Error select idpost: ".mysqli_error($conn)."");
if($query->num_rows>0){
	$row=$query->fetch_assoc();
	$acces_token = $row["access_token"];
    $foto123 = $row["foto"];
    if($foto123==""){
        $foto123 ="images/fan-page.png";
    }
	if(!$acces_token){
		$query=$conn->query("SELECT access_token FROM token WHERE identify='".$identify."' AND red='facebook'") OR die("Error select access_token: ".mysqli_error($conn)."");
		$row=$query->fetch_assoc();
	    $acces_token = $row["access_token"];
	}
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
		You cannot post multiple images to a single feed. (Dosen't make any sense either)
		
		The example link that you've mentioned in simply posting photos, not adding photos to a feed.
		
		So, instead of /feed, simply use the /photos API to get the result.
	  */
	  if($link || ($description && !$images)){
		  $req = array();
		  $images = substr($images,0,strlen($images)-1);
		  if($description){
			//Campo Escribir del POST
			$req["message"] = ''.$description.'';
		  }
		  if($name){
			//Nombre del Enlace o Imágen adjunta al mensaje
			$req["name"] = 'name';
		  }
		  if($link){
			//Enlace Adjunto al Post
			$req["link"] = $link;
		  }
		  if($messages){
			//Descripcion del enlace o Imágen adjunta al mensaje
			$req["description"] = $messages;
		  }
		  if($images){
			//Imágen como Link
			$req["picture"] = $images;
		  }
		   
		  //print_r($req);
		   
		  //publica un mensaje
		  if($idPost){
			$request = new FacebookRequest($session, 'POST', '/'.$idPost.'/feed', $req);
		  } else {
			$request = new FacebookRequest($session, 'POST', '/me/feed', $req);
		  }
		  $response = $request->execute();
		  // get response
	      $graphObject = $response->getGraphObject();
	  } else {
		  $images_array = explode(",",$images);
		  foreach($images_array as $photo){
			   if($photo!=""){
				 $req = array();
				 /*
				 El texto en imágen esta prohibido 
				 it's in violation of Section IV.2 of the Facebook Platform Policies
				 */
				 if($description)
				   $req["message"] = ''.$description.'';
				 
				 $req["url"] = $photo;
				 //print_r($req);
				 //publicar imagen
				 if($idPost){
					$request = new FacebookRequest($session, 'POST', '/'.$idPost.'/photos', $req);
				  } else {
					$request = new FacebookRequest($session, 'POST', '/me/photos', $req);
				  }
				  $response = $request->execute();
				  // get response
	              $graphObject[] = $response->getGraphObject();
			   }
		  }
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
      //insertar a publicados
      $query3434 = $conn->query("INSERT INTO msg_publicados (id_token,name,identify,id_post,mensaje,images,link,image_profile,red,fecha,horario) VALUES ('".$id_token."','".$screen_name."','".$identify."','".$idPost."','".$description."','".$images."','".$link."','".$foto123."','twitter','".$fecha."','".$horario."')") OR die("Error insert into msg_publicados: ".mysqli_error($conn)."");
	  print_r($graphObject);
	} else { 
	  echo '|'.$name.'|false2';
	}
} else {
  echo "false1";
}
$conn->close();
?>