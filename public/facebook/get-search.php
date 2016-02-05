<?php
include '../conexioni.php';
$identify=$_GET["identify"];
$search=$_GET["search"];
$type=$_GET["type"];
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
	  /* types: user, page, event, group, place, placetopic, ad_(asterico) */
          /* type=place&center=37.50,-122.427&distance=1000 -> radio de busquedas se un lugar*/
          /* ad_(asterisco otras opciones de busca en target) */
          /* más info? dev.facebook -> doc -> graph api -> using the graph api -> hasta abajo esta search  */
          
          // get search
	  $request = new FacebookRequest($session, 'GET', '/search?q='.$search.'&type='.$type.'');
	  $response = $request->execute();
	  $search = $response->getGraphObject();

        if($type=="group"){
	  
	  // get groups
	  $request = new FacebookRequest($session, 'GET', '/me/groups');
	  $response = $request->execute();
	  $groups = $response->getGraphObject();
	  
	  
	  $array_b = array();
	  if($groups->getProperty('data')){
	    foreach($groups->getProperty('data')->asArray() as $item){
              $array_b["".$item->id.""]=1;
            }
          }
          
          
          //objeto a regresar
          $c=0;
          $return_array = array();

	  if($search->getProperty('data')){
            foreach($search->getProperty('data')->asArray() as $item){
              $obj = new stdclass();
              if($array_b["".$item->id.""]==1){
                $obj->status=false;
              } else {
                $obj->status=true;
              }

              $obj->id=$item->id;
              $obj->name=$item->name;

              $return_array[$c] = new stdclass();
	      $return_array[$c] = $obj;
	      $c++;
            }
          }

        }
        if($type=="page"){
          //get pages
          $request = new FacebookRequest($session, 'GET', '/me/likes');
	  $response = $request->execute();
	  $pages = $response->getGraphObject();

          $array_b = array();
	  if($pages->getProperty('data')){
	    foreach($pages->getProperty('data')->asArray() as $item){
              $array_b["".$item->id.""]=1;
            }
          }
 
          //objeto a regresar
          $c=0;
          $return_array = array();
	  if($search->getProperty('data')){
            foreach($search->getProperty('data')->asArray() as $item){
              if($c<50){
                // get detailsPage
	        $request = new FacebookRequest($session, 'GET', '/'.$item->id.'');
	        $response = $request->execute();
	        $page = $response->getGraphObject()->asArray();

                $obj = new stdclass();
                if($array_b["".$item->id.""]==1){
                  $obj->status=false;
                } else {
                  $obj->status=true;
                }

                $obj->id=$item->id;
                $obj->name=$item->name;
                $obj->likes=$page["likes"];
                $obj->link=$page["link"];
              if($page["location"]->country && $page["location"]->city){
                $obj->location=''.$page["location"]->country.', '.$page["location"]->city.'';
              } else if($page["location"]->country){
                $obj->location=$page["location"]->country;
              } else {
                $obj->location=$page["location"];
              }
                $obj->description=$page["about"];

                $return_array[$c] = new stdclass();
	        $return_array[$c] = $obj;
	        $c++;
	      }
            }
          }
        }

        if($type=="user"){
 
          //objeto a regresar
          $c=0;
          $return_array = array();

	  if($search->getProperty('data')){
            foreach($search->getProperty('data')->asArray() as $item){
              if($c<50){

                $obj = new stdclass();

                $obj->id=$item->id;
                $obj->name=$item->name;

                $return_array[$c] = new stdclass();
	        $return_array[$c] = $obj;
	        $c++;
	      }
            }
          }
        }

        if($type=="event"){
 
          //objeto a regresar
          $c=0;
          $return_array = array();

	  if($search->getProperty('data')){
            foreach($search->getProperty('data')->asArray() as $item){
              if($c<50){

                $obj = new stdclass();

                $obj->id=$item->id;
                $obj->name=$item->name;
                $obj->start_time=$item->start_time;
                $obj->location=$item->location;

                $return_array[$c] = new stdclass();
	        $return_array[$c] = $obj;
	        $c++;
	      }
            }
          }
        }

        if($type=="place"){
 
          //objeto a regresar
          $c=0;
          $return_array = array();

	  if($search->getProperty('data')){
            foreach($search->getProperty('data')->asArray() as $item){
              //get pages
              if($c<50){

                $request = new FacebookRequest($session, 'GET', '/'.$item->id.'');
	        $response = $request->execute();
	        $place = $response->getGraphObject()->asArray();;

                $obj = new stdclass();

                $obj->id=$item->id;
                $obj->name=$item->name;
                $obj->likes=$place["likes"];
                $obj->link=$place["link"];
              if($place["location"]->country && $place["location"]->city){
                $obj->location=''.$place["location"]->country.', '.$place["location"]->city.'';
              } else if($page["location"]->country){
                $obj->location=$place["location"]->country;
              } else {
                $obj->location=$place["location"];
              }
              if($place["description"] && $place["about"]->city){
                $obj->description=''.$place["description"].', '.$place["about"].'';
              } else if($place["description"]){
                $obj->description=$place["description"];
              } else {
                $obj->description=$place["about"];
              }

                $return_array[$c] = new stdclass();
	        $return_array[$c] = $obj;
	        $c++;
	      }
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
	  $return = new stdclass();
          $return->data = $return_array;
	  echo json_encode($return->data);
	} else { 
	  echo "false2";
	}
} else {
  echo "false1";
}
?>