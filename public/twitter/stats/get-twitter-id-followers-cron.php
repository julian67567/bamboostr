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
	/**DIFerencia de MINUTOS ENTRE PETICIONES**/
      $difFechaPass = '';
	  //17 inlcluye ,
	  $difFechaPass=substr($row["seguidoresId"],strlen($row["seguidoresId"])-17,16);
	  $difFechaPass=explode(":",$difFechaPass);
	  $difFechaPass=explode("-",$difFechaPass[1]);
	  $horaBFP = (intval($difFechaPass[0])*60)+intval($difFechaPass[1]);
	  $horaAFP = (intval(date("H"))*60)+intval(date("i"));
	  $difFechaPass=abs($horaAFP-$horaBFP);
      echo "B: ".$horaBFP." A:".$horaAFP." DIF:".$difFechaPass."<br />";
	/**FIN DIFerencia de MINUTOS ENTRE PETICIONES**/
	if(!$identify){
      if(strpos($row["seguidoresId"],date('d-m-Y'))===false && ($difFechaPass>15 && $difFechaPass<1425)){
	    if(strpos($unique_request,$row["screen_name"])===false){
	      $cuentas[$c][0] = $row["screen_name"];
	      $cuentas[$c][1] = $row["oauth_token"];
	      $cuentas[$c][2] = $row["oauth_token_secret"];
	      $cuentas[$c][3] = $row["id_token"];
	      $cuentas[$c][4] = $row["seguidores"];
	      $cuentas[$c][5] = $row["identify"];
		  $unique_request = ''.$unique_request.''.$row["screen_name"].',';
	      $c++;
		}
	  }
	} else {
	  if(strpos($row["seguidoresId"],date('d-m-Y:H'))===false || ($difFechaPass>15 && $difFechaPass<1425)){
	    if(strpos($unique_request,$row["screen_name"])===false){
	      $cuentas[$c][0] = $row["screen_name"];
	      $cuentas[$c][1] = $row["oauth_token"];
	      $cuentas[$c][2] = $row["oauth_token_secret"];
	      $cuentas[$c][3] = $row["id_token"];
	      $cuentas[$c][4] = $row["seguidores"];
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
		//crear carpeta si no existe
		if (!file_exists("../usuarios/".$item[0].""))
		  mkdir("../usuarios/".$item[0]."", 0777);
		
		//get id seguidores
		$cursor=-1;
		$followers_cont=0;
		$archivo = fopen("../usuarios/".$item[0]."/followers.txt", "w+");
		do {
		  $followers = $twitteroauth->get("https://api.twitter.com/1.1/followers/ids.json?screen_name=".$item[0]."&cursor=".$cursor."&count=5000");
		  $followers_array = (array)$followers;
		  foreach ($followers_array['ids'] as &$item2) {
			$seguidores_array[] = $item2;
			fwrite($archivo, "|".$item2."");
			$followers_cont++;
		  }
		  $cursor = $followers->next_cursor;
		 } while ($cursor>0);
		 fclose($archivo);
		 $archivo = fopen("../usuarios/".$item[0]."/numfollowers.txt", "w+");
		 fwrite($archivo, ''.$followers_cont.'');
		 fclose($archivo);
		 
		 if($followers_cont!=0){
		   $query2=$conn->query("UPDATE estadisticas_twitter SET seguidoresId='".date('d-m-Y:H-i').",' 
								WHERE identify='".$item[5]."' AND red='twitter'");
		 }
		 
		echo 'http_code: '.$twitteroauth->http_code.':'.$item[0].'<br />';
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