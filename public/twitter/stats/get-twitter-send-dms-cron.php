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
      if(strpos($row["send_dms"],date("d-m-Y",strtotime("-1 day")))===false){
        if(strpos($unique_request,$row["screen_name"])===false){
		  $cuentas[$c][0] = $row["screen_name"];
	      $cuentas[$c][1] = $row["oauth_token"];
	      $cuentas[$c][2] = $row["oauth_token_secret"];
	      $cuentas[$c][3] = $row["id_token"];
	      $cuentas[$c][4] = $row["send_dms"];
	      $cuentas[$c][5] = $row["identify"];
	      $unique_request = ''.$unique_request.''.$row["screen_name"].',';
	      $c++;
		}
	  }
	} else {
	  //por hora
	  if(strpos($row["send_dms"],date("d-m-Y:H",strtotime("-1 day")))===false){
        if(strpos($unique_request,$row["screen_name"])===false){
		  $cuentas[$c][0] = $row["screen_name"];
	      $cuentas[$c][1] = $row["oauth_token"];
	      $cuentas[$c][2] = $row["oauth_token_secret"];
	      $cuentas[$c][3] = $row["id_token"];
	      $cuentas[$c][4] = $row["send_dms"];
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
	  
	  $contador_dms_send=0;
	  $dm_info = $twitteroauth->get('direct_messages/sent.json?count=200');
	  foreach ($dm_info as &$item2) {
		$comp_fecha = explode(" ",$item2->created_at);
		if(date("d",strtotime("-1 day",strtotime(date("d-m-Y"))))==$comp_fecha[2]){
		  $contador_dms_send++;
		}
	  }
	  
	  if(strpos($cuentas[$c][4],date("d-m-Y",strtotime("-1 day")))===false){
		  //si no hay el mismo día
		  $cuentas[$c][4] = ''.$contador_dms_send.'|'.date("d-m-Y:H-i",strtotime("-1 day")).',';
		  $query2=$conn->query("UPDATE estadisticas_twitter 
							   SET send_dms=CONCAT(send_dms,'".$cuentas[$c][4]."')
							   WHERE identify='".$item[5]."' AND red='twitter'");
		  echo 'No hay el Mismo Día, http_code: '.$twitteroauth->http_code.': '.$item[0].' <br />';
	  } else {
		  //si hay el mismo día
		  $send_dms_array=explode(",",$cuentas[$c][4]);
		  for($i=0; $i<count($send_dms_array)-2; $i++){
		    $send_dms=''.$send_dms.''.$send_dms_array[$i].',';
		  }
		  $cuentas[$c][4] = ''.$send_dms.''.$contador_dms_send.'|'.date("d-m-Y:H-i",strtotime("-1 day")).',';
		  $query2=$conn->query("UPDATE estadisticas_twitter 
							   SET send_dms='".$cuentas[$c][4]."'
							   WHERE identify='".$item[5]."' AND red='twitter'");
		  echo 'Si hay el mismo día, http_code: '.$twitteroauth->http_code.': '.$item[0].' <br />';
	  }
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