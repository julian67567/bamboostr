<?php
//PHP Version 5.4.34
include ''.dirname(__FILE__).'/../../conexioni.php';
$identify=$_GET["identify"];
$identify_account=$_GET["identify_account"];
session_start();
require_once ''.dirname(__FILE__).'/../src/Facebook/config.php';
require_once(''.dirname(__FILE__).'/../autoload.php');
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
$unique_request = '';
if(!$identify){
  $query=$conn->query("SELECT tok.*, esta.*, tok.identify as identifyP
 					  FROM token AS tok INNER JOIN estadisticas_facebook AS esta  
		              ON esta.red='facebook' AND esta.tipo='facebook' 
					  AND tok.red='facebook' AND tok.identify=esta.identify_account") or die(mysqli_error($conn));
} else {
  $query=$conn->query("SELECT tok.*, esta.*, tok.identify as identifyP
 					  FROM token AS tok INNER JOIN estadisticas_facebook AS esta  
		              ON esta.red='facebook' AND esta.tipo='facebook' AND tok.red='facebook' 
					  AND tok.identify='".$identify."' AND esta.identify='".$identify_account."'
					  AND esta.identify_account='".$identify."'") or die(mysqli_error($conn));
}
if($query->num_rows>0){
  $c=0;
  while($row=$query->fetch_assoc()){
	/**DIFerencia de MINUTOS ENTRE PETICIONES**/
      $difFechaPass = '';
	  //17 inlcluye ,
	  $difFechaPass=substr($row["photos_tagged"],strlen($row["photos_tagged"])-17,16);
	  $difFechaPass=explode(":",$difFechaPass);
	  $difFechaPass=explode("-",$difFechaPass[1]);
	  $horaBFP = (intval($difFechaPass[0])*60)+intval($difFechaPass[1]);
	  $horaAFP = (intval(date("H"))*60)+intval(date("i"));
	  $difFechaPass=abs($horaAFP-$horaBFP);
      echo "B: ".$horaBFP." A:".$horaAFP." DIF:".$difFechaPass."<br />";
	/**FIN DIFerencia de MINUTOS ENTRE PETICIONES**/
	if(!$identify){
	  //por día
      if(strpos($row["photos_tagged"],date('d-m-Y'))===false && $difFechaPass>15){
        if(strpos($unique_request,$row["screen_name"])===false){
		  $cuentas[$c][0] = $row["screen_name"];
	      $cuentas[$c][1] = $row["access_token"];
	      $cuentas[$c][2] = $row["id_token"];
		  $cuentas[$c][3] = $row["photos_tagged"];
		  $cuentas[$c][4] = $row["identifyP"];
	      $unique_request = ''.$unique_request.''.$row["screen_name"].',';
	      $c++;
		}
	  }
	} else {
	  //por hora //solo con método post
	  if(strpos($row["photos_tagged"],date('d-m-Y:H'))===false || $difFechaPass>15){
        if(strpos($unique_request,$row["screen_name"])===false){
		  $cuentas[$c][0] = $row["screen_name"];
	      $cuentas[$c][1] = $row["access_token"];
	      $cuentas[$c][2] = $row["id_token"];
		  $cuentas[$c][3] = $row["photos_tagged"];
		  $cuentas[$c][4] = $row["identifyP"];
	      $unique_request = ''.$unique_request.''.$row["screen_name"].',';
	      $c++;
		}
	  }
	}
  }//fin while row
  $c=0;
  foreach($cuentas as $item){
	$acces_token = $cuentas[$c][1];
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
	  //?limit=, ?since=, ?until=, ?filter=app_key, ?offset=, ?fields=name,id,bio
	  //si hay mas de dos parametros se separa por &
	  //offset puede llegar a ser confuso mirar: https://developers.facebook.com/blog/post/478/
	  //por ello se recomiendo until o since
	  $request = new FacebookRequest($session, 'GET', '/me/photos');
	  $response = $request->execute();
	  // get response
	  $graphObject = $response->getGraphObject();
	
	} catch (FacebookRequestException $ex) {
	  // Session not valid, Graph API returned an exception with the reason.
	  echo ''.$ex->getMessage().' '.$cuentas[$c][0].'<br />';
	  $error = 1;
	} catch (\Exception $ex) {
	  // Graph API returned info, but it may mismatch the current app or have expired.
	  echo ''.$ex->getMessage().' '.$cuentas[$c][0].'<br />';
	  $error = 1;
	} 
	if($error==0) {
      $contPhotos_tagged=0;
	  $photos_tagged_names = "";
	  print_r($graphObject->getProperty('data'));
	  echo '<br /><br />';
	  if($graphObject->getProperty('data')){
	    foreach($graphObject->getProperty('data')->asArray() as $item2){
	      $photos_tagged_names = ''.$photos_tagged_names.''.str_replace(',', '', str_replace('|', '', $item2->name)).'|'.$item2->id.'|'.$item2->created_time.',';
		  $contPhotos_tagged++;
	    }
	  }
	  $photos_tagged_names = ''.$photos_tagged_names.''.date('d-m-Y:H-i').'';
	  $query2=$conn->query("UPDATE estadisticas_facebook 
	                       SET photos_tagged_name='".$photos_tagged_names."' 
						   WHERE identify_account='".$item[4]."' AND red='facebook'
						   AND tipo='facebook'") or die(mysqli_error($conn));
	  
	  echo '<br /><br />'.$cuentas[$c][0].' '.$contPhotos_tagged.' '.$photos_tagged_names.'<br /><br />';
	  
      if(strpos($cuentas[$c][3],date('d-m-Y'))===false){
		  //si no hay el mismo día
		  $cuentas[$c][3] = ''.$contPhotos_tagged.'|'.date('d-m-Y:H-i').',';
		  $query2=$conn->query("UPDATE estadisticas_facebook 
							   SET photos_tagged=CONCAT(photos_tagged,'".$cuentas[$c][3]."')
							   WHERE identify_account='".$item[4]."' AND red='facebook'
							   AND tipo='facebook'") or die(mysqli_error($conn));
		  
		  echo 'No hay el Mismo Día Friends: '.$cuentas[$c][3].' '.$item[4].'<br />';
		  
	  } else {
		  //si hay el mismo día
		  $photos_tagged_array=explode(",",$cuentas[$c][3]);
		  for($i=0; $i<count($photos_tagged_array)-2; $i++){
		    $photos_tagged=''.$photos_tagged.''.$photos_tagged_array[$i].',';
		  }
		  $cuentas[$c][3] = ''.$photos_tagged.''.$contPhotos_tagged.'|'.date('d-m-Y:H-i').',';
		  $query2=$conn->query("UPDATE estadisticas_facebook 
							   SET photos_tagged='".$cuentas[$c][3]."'
							   WHERE identify_account='".$item[4]."' AND red='facebook'
							   AND tipo='facebook'") or die(mysqli_error($conn));
		  
		  echo 'Si hay el mismo día: '.$cuentas[$c][3].' '.$item[4].'<br />';
		  
	  }
	} else { 
	  echo "FALSE";
	}
	$c++;
  }//fin foreach identify
} else {
  echo "FALSE";
}
$conn->close();