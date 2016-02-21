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
	  $difFechaPass=substr($row["siguiendoId"],strlen($row["siguiendoId"])-17,16);
	  $difFechaPass=explode(":",$difFechaPass);
	  $difFechaPass=explode("-",$difFechaPass[1]);
	  $horaBFP = (intval($difFechaPass[0])*60)+intval($difFechaPass[1]);
	  $horaAFP = (intval(date("H"))*60)+intval(date("i"));
	  $difFechaPass=abs($horaAFP-$horaBFP);
      echo "B: ".$horaBFP." A:".$horaAFP." DIF:".$difFechaPass."<br />";
	/**FIN DIFerencia de MINUTOS ENTRE PETICIONES**/
	if(!$identify){
      if(strpos($row["siguiendoId"],date('d-m-Y'))===false && ($difFechaPass>15 && $difFechaPass<1425)){
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
	  if(strpos($row["siguiendoId"],date('d-m-Y:H'))===false || ($difFechaPass>15 && $difFechaPass<1425)){
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
		
		//get id Siguiendo
		 $cursor=-1;
		 $following_cont=0;
		 $archivo = fopen("../usuarios/".$item[0]."/following.txt", "w+");
		 do{
		   $following = $twitteroauth->get("https://api.twitter.com/1.1/friends/ids.json?screen_name=".$item[0]."&cursor=".$cursor."&count=5000");
		   $following_array = (array)$following;
		   foreach ($following_array['ids'] as &$item2) {
			 fwrite($archivo, "|".$item2."");
			 $siguiendo_array[] = $item2;
			 $following_cont++;
		   }
		   $cursor = $following->next_cursor;
		 } while($cursor>0);
		 fclose($archivo);
		 $archivo = fopen("../usuarios/".$item[0]."/numfollowing.txt", "w+");
		 fwrite($archivo, "".$following_cont."");
		 fclose($archivo);
		 
		 if($following_cont!=0){
		   $query2=$conn->query("UPDATE estadisticas_twitter SET siguiendoId='".date('d-m-Y:H-i').",' 
								WHERE identify='".$item[5]."' AND red='twitter'") or die(mysqli_error($conn));
		 }
		 
		echo 'http_code: '.$twitteroauth->http_code.':'.$item[0].'<br />';
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