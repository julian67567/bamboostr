<?PHP
ini_set('max_execution_time', 9000);
include ''.dirname(__FILE__).'/../../conexioni.php';
require("".dirname(__FILE__)."/../twitteroauth/twitteroauth.php");
include ''.dirname(__FILE__).'/../config-sample.php';
$identify=$_GET["identify"];
session_start();
$unique_request = '';
if(!$identify){
  $query=$conn->query("SELECT tok.*, esta.* 
 					  FROM token AS tok INNER JOIN estadisticas_twitter AS esta  
		              ON esta.red='twitter' AND tok.red='twitter' AND tok.identify=esta.identify") or die(mysqli_error($conn));
} else {
  $query=$conn->query("SELECT tok.*, esta.* 
 					  FROM token AS tok INNER JOIN estadisticas_twitter AS esta  
		              ON esta.red='twitter' AND tok.red='twitter' AND tok.identify='".$identify."'
					  AND esta.identify='".$identify."'") or die(mysqli_error($conn));
}
if($query->num_rows>0){
  $c=0;
  while($row=$query->fetch_assoc()){
	/**DIFerencia de MINUTOS ENTRE PETICIONES**/
      $difFechaPass = '';
	  //17 inlcluye ,
	  $difFechaPass=substr($row["seguidores"],strlen($row["seguidores"])-17,16);
	  $difFechaPass=explode(":",$difFechaPass);
	  $difFechaPass=explode("-",$difFechaPass[1]);
	  $horaBFP = (intval($difFechaPass[0])*60)+intval($difFechaPass[1]);
	  $horaAFP = (intval(date("H"))*60)+intval(date("i"));
	  $difFechaPass=abs($horaAFP-$horaBFP);
      echo "B: ".$horaBFP." A:".$horaAFP." DIF:".$difFechaPass."<br />";
	/**FIN DIFerencia de MINUTOS ENTRE PETICIONES**/
	if(!$identify){
	  //por día
      if(strpos($row["seguidores"],date('d-m-Y'))===false && $difFechaPass>15){
        if(strpos($unique_request,$row["screen_name"])===false){
		  $cuentas[$c][0] = $row["screen_name"];
	      $cuentas[$c][1] = $row["oauth_token"];
	      $cuentas[$c][2] = $row["oauth_token_secret"];
	      $cuentas[$c][3] = $row["id_token"];
	      $cuentas[$c][4] = $row["seguidores"];
	      $cuentas[$c][5] = $row["identify"];
		  $cuentas[$c][10] = $row["siguiendo"];
		  $cuentas[$c][11] = $row["mlistas"];
		  $cuentas[$c][12] = $row["tweets"];
		  $cuentas[$c][13] = $row["tusfavoritos"];
	      $unique_request = ''.$unique_request.''.$row["screen_name"].',';
	      $c++;
		}
	  }
	} else {
	  //por hora //solo con método post
	  if(strpos($row["seguidores"],date('d-m-Y:H'))===false || $difFechaPass>15){
        if(strpos($unique_request,$row["screen_name"])===false){
		  $cuentas[$c][0] = $row["screen_name"];
	      $cuentas[$c][1] = $row["oauth_token"];
	      $cuentas[$c][2] = $row["oauth_token_secret"];
	      $cuentas[$c][3] = $row["id_token"];
	      $cuentas[$c][4] = $row["seguidores"];
	      $cuentas[$c][5] = $row["identify"];
		  $cuentas[$c][10] = $row["siguiendo"];
		  $cuentas[$c][11] = $row["mlistas"];
		  $cuentas[$c][12] = $row["tweets"];
		  $cuentas[$c][13] = $row["tusfavoritos"];
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
	  if(strpos($cuentas[$c][4],date('d-m-Y'))===false){
		  //si no hay el mismo día
		  $cuentas[$c][4] = ''.$user_info->followers_count.'|'.date('d-m-Y:H-i').',';
		  $cuentas[$c][10] = ''.$user_info->friends_count.'|'.date('d-m-Y:H-i').',';
		  $cuentas[$c][11] = ''.$user_info->listed_count.'|'.date('d-m-Y:H-i').',';
		  $cuentas[$c][12] = ''.$user_info->statuses_count.'|'.date('d-m-Y:H-i').',';
		  $cuentas[$c][13] = ''.$user_info->favourites_count.'|'.date('d-m-Y:H-i').',';
		  $query2=$conn->query("UPDATE estadisticas_twitter 
							   SET seguidores=CONCAT(seguidores,'".$cuentas[$c][4]."'),
								   siguiendo=CONCAT(siguiendo,'".$cuentas[$c][10]."'),
								   mlistas=CONCAT(mlistas,'".$cuentas[$c][11]."'),
								   tweets=CONCAT(tweets,'".$cuentas[$c][12]."'),
								   tusfavoritos=CONCAT(tusfavoritos,'".$cuentas[$c][13]."')
							   WHERE identify='".$item[5]."' AND red='twitter'") or die(mysqli_error($conn));
		  
		  echo 'No hay el Mismo Día, http_code: '.$twitteroauth->http_code.': '.$item[0].' Seguidores: '.$cuentas[$c][4].' Siguiendo: '.$cuentas[$c][10].' mlistas: '.$cuentas[$c][11].' tweets: '.$cuentas[$c][12].' tusfavorios: '.$cuentas[$c][13].'<br />';
		  
	  } else {
		  //si hay el mismo día
		  $seguidores_array=explode(",",$cuentas[$c][4]);
		  $siguiendo_array=explode(",",$cuentas[$c][10]);
		  $mlistas_array=explode(",",$cuentas[$c][11]);
		  $tweets_array=explode(",",$cuentas[$c][12]);
		  $tusfavoritos_array=explode(",",$cuentas[$c][13]);
		  for($i=0; $i<count($seguidores_array)-2; $i++){
		    $seguidores=''.$seguidores.''.$seguidores_array[$i].',';
		    $siguiendo=''.$siguiendo.''.$siguiendo_array[$i].',';
		    $mlistas=''.$mlistas.''.$mlistas_array[$i].',';
		    $tweets=''.$tweets.''.$tweets_array[$i].',';
		    $tusfavoritos=''.$tusfavoritos.''.$tusfavoritos_array[$i].',';
		  }
		  $cuentas[$c][4] = ''.$seguidores.''.$user_info->followers_count.'|'.date('d-m-Y:H-i').',';
		  $cuentas[$c][10] = ''.$siguiendo.''.$user_info->friends_count.'|'.date('d-m-Y:H-i').',';
		  $cuentas[$c][11] = ''.$mlistas.''.$user_info->listed_count.'|'.date('d-m-Y:H-i').',';
		  $cuentas[$c][12] = ''.$tweets.''.$user_info->statuses_count.'|'.date('d-m-Y:H-i').',';
		  $cuentas[$c][13] = ''.$tusfavoritos.''.$user_info->favourites_count.'|'.date('d-m-Y:H-i').',';
		  $query2=$conn->query("UPDATE estadisticas_twitter 
							   SET seguidores='".$cuentas[$c][4]."',
								   siguiendo='".$cuentas[$c][10]."',
								   mlistas='".$cuentas[$c][11]."',
								   tweets='".$cuentas[$c][12]."',
								   tusfavoritos='".$cuentas[$c][13]."'
							   WHERE identify='".$item[5]."' AND red='twitter'") or die(mysqli_error($conn));
		  
		  echo 'Si hay el mismo día, http_code: '.$twitteroauth->http_code.': '.$item[0].' Seguidores: '.$cuentas[$c][4].' Siguiendo: '.$cuentas[$c][10].' mlistas: '.$cuentas[$c][11].' tweets: '.$cuentas[$c][12].' tusfavorios: '.$cuentas[$c][13].'<br />';
		  
	  }
	} else {
		echo 'http_code: '.$twitteroauth->http_code.': '.$item[0].'<br />';
		$query2=$conn->query("UPDATE token SET expire_token=1 
							 WHERE identify='".$item[5]."' AND red='twitter'") or die(mysqli_error($conn));
	}
    $c++;
  }
} else {
  echo "FALSE";
}
$conn->close();
?>