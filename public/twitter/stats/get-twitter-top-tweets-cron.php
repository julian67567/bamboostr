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
	  //por día
      if(strpos($row["top_tweets"],date('d-m-Y'))===false){
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
	  //por hora
	  if(strpos($row["top_tweets"],date('d-m-Y:H'))===false){
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
		
		$max_id=-1;
		$top_tweets_cont=0;
		$contador = 0;
		$array_count = array();
		$array_info = array();
		do {
		   if($max_id==-1){
			 $top_tweeets = $twitteroauth->get("https://api.twitter.com/1.1/statuses/retweets_of_me.json?count=100");
		   } else {
		     $top_tweeets = $twitteroauth->get("https://api.twitter.com/1.1/statuses/retweets_of_me.json?max_id=".$max_id."&count=100");
		   }
		   foreach ($top_tweeets as &$item2) {
			 $text=str_replace('|', '', $item2->text);
			 $text=str_replace(',', '', $text);
			 $array_info[$top_tweets_cont]["screen_name"] = $item[0];
			 $array_info[$top_tweets_cont]["id"] = $item2->id_str;
			 $array_info[$top_tweets_cont]["retweet_count"] = $item2->retweet_count;
                         $array_info[$top_tweets_cont]["favorite_count"] = $item2->favorite_count;
			 $array_info[$top_tweets_cont]["text"] = $text;
			 $array_info[$top_tweets_cont]["created_at"] = $item2->created_at;
			 $array_count[$top_tweets_cont] = $item2->retweet_count;
			 $top_tweets_cont++;
			 $max_id = $item2->id;
		   }
		   $contador++;
		   if($contador>=14){
			 $max_id=-1;
		   }
		 } while ($max_id>0 && $max_id!=-1);
		 $contFin=0;
		 $top_tweets_final = '';
		 while($contFin<20) {
		   $array_pos = array_search(max($array_count),$array_count);
		   if($array_count[$array_pos]!=-1 && $agregados["".$array_info[$array_pos]["id"].""]!=1){
		     $top_tweets_final = ''.$top_tweets_final.''.$array_info[$array_pos]["screen_name"].'|'.$array_info[$array_pos]["id"].'|'.$array_info[$array_pos]["retweet_count"].'|'.$array_info[$array_pos]["text"].'|'.$array_info[$array_pos]["created_at"].'|'.$array_info[$array_pos]["favorite_count"].'|'.date('d-m-Y:H-i').',';
			 $agregados["".$array_info[$array_pos]["id"].""] = 1;
		   }
		   $contFin++;
		   $array_count[$array_pos] = -1;
		 }
		 $query2=$conn->query("UPDATE estadisticas_twitter 
							  SET top_tweets='".$top_tweets_final."'
							  WHERE identify='".$item[5]."' AND red='twitter'");
         echo 'http_code: '.$twitteroauth->http_code.': '.$item[0].'<br />';
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