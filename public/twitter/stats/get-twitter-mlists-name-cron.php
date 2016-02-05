<?PHP
ini_set('max_execution_time', 9000);
include '../conexioni.php';
require("../twitteroauth/twitteroauth.php");
include '../config-sample.php';
$identify=$_GET["identify"];
session_start();
$unique_request = '';
if(!$identify){
  $query=$conn->query("SELECT tok.*, esta.* 
 					  FROM token AS tok INNER JOIN estadisticas_twitter AS esta  
		              ON esta.red='twitter' AND tok.red='twitter' AND tok.identify=esta.identify");
} else {
  $query=$conn->query("SELECT tok.*, esta.* 
 					  FROM token AS tok INNER JOIN estadisticas_twitter AS esta  
		              ON esta.red='twitter' AND tok.red='twitter' AND tok.identify='".$identify."'
					  AND esta.identify='".$identify."'");
}
if($query->num_rows>0){
  $c=0;
  while($row=$query->fetch_assoc()){
	if(!$identify){
      if(strpos($row["mlistasname"],date('d-m-Y'))===false){
	    if(strpos($unique_request,$row["screen_name"])===false){
	      $cuentas[$c][0] = $row["screen_name"];
	      $cuentas[$c][1] = $row["oauth_token"];
	      $cuentas[$c][2] = $row["oauth_token_secret"];
	      $cuentas[$c][3] = $row["id_token"];
	      $cuentas[$c][5] = $row["identify"];
		  $unique_request = ''.$unique_request.''.$row["screen_name"].',';
	      $c++;
		}
	  }
	} else {
	  if(strpos($row["mlistasname"],date('d-m-Y:H'))===false){
	    if(strpos($unique_request,$row["screen_name"])===false){
	      $cuentas[$c][0] = $row["screen_name"];
	      $cuentas[$c][1] = $row["oauth_token"];
	      $cuentas[$c][2] = $row["oauth_token_secret"];
	      $cuentas[$c][3] = $row["id_token"];
	      $cuentas[$c][5] = $row["identify"];
		  $unique_request = ''.$unique_request.''.$row["screen_name"].',';
	      $c++;
		}
	  }
	}
  }
  $c=0;
  foreach($cuentas as $item){
    $twitteroauth = new TwitterOAuth($consumer_key, $consumer_secret, $item[1], $item[2]);
	$user_info = $twitteroauth->get('account/verify_credentials');
	if($twitteroauth->http_code==200){
		$cursor=-1;
		$followers_cont=0;
		$listas = "";
		$cont = 1;
		
		do {
		  $mlists = $twitteroauth->get("https://api.twitter.com/1.1/lists/memberships.json?screen_name=".$item[0]."&cursor=".$cursor."&count=1000");
		  foreach($mlists->lists as $list){
			$listas = ''.$listas.''.str_replace(',', '', str_replace('|', '', $list->name)).'|'.$list->uri.','; 
			$cont++;
		  }
		  $cursor = $mlists->next_cursor;
		} while ($cursor>0);
		
		$listas = ''.$listas.''.date('d-m-Y:H-i').'';
		
		$query2=$conn->query("UPDATE estadisticas_twitter SET mlistasname='".$listas."' 
							 WHERE identify='".$item[5]."' AND red='twitter'");
		echo 'http_code: '.$twitteroauth->http_code.': '.$cont.' '.$item[0].': '.$listas.'<br /><br />';
	} else {
	  echo 'http_code: '.$twitteroauth->http_code.': '.$item[0].'<br />';
	  $query2=$conn->query("UPDATE token SET expire_token=1 
							 WHERE identify='".$item[5]."' AND red='twitter'");
	}
    $c++;
  }
} else {
  echo "FALSE";
}
$conn->close();
?>