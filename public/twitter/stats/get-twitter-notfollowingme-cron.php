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
	  $difFechaPass=substr($row["notfollowingme"],strlen($row["notfollowingme"])-17,16);
	  $difFechaPass=explode(":",$difFechaPass);
	  $difFechaPass=explode("-",$difFechaPass[1]);
	  $horaBFP = (intval($difFechaPass[0])*60)+intval($difFechaPass[1]);
	  $horaAFP = (intval(date("H"))*60)+intval(date("i"));
	  $difFechaPass=abs($horaAFP-$horaBFP);
      echo "B: ".$horaBFP." A:".$horaAFP." DIF:".$difFechaPass."<br />";
	/**FIN DIFerencia de MINUTOS ENTRE PETICIONES**/
	if(!$identify){
	  //por día
      if(strpos($row["notfollowingme"],date('d-m-Y'))===false &&
	     strpos($row["siguiendoId"],date('d-m-Y'))!==false &&
	     strpos($row["seguidoresId"],date('d-m-Y'))!==false && ($difFechaPass>15 && $difFechaPass<1425)){
	    if(strpos($unique_request,$row["screen_name"])===false){
	      $cuentas[$c][0] = $row["screen_name"];
	      $cuentas[$c][1] = $row["oauth_token"];
	      $cuentas[$c][2] = $row["oauth_token_secret"];
	      $cuentas[$c][3] = $row["id_token"];
	      $cuentas[$c][4] = $row["notfollowingme"];
	      $cuentas[$c][5] = $row["identify"];
		  $cuentas[$c][6] = $row["seguidoresId"];
		  $cuentas[$c][7] = $row["siguiendoId"];
		  $cuentas[$c][8] = $row["seguidores"];
		  $cuentas[$c][9] = $row["siguiendo"];
		  $cuentas[$c][10] = $row["seguimientomutuo"];
		  $cuentas[$c][11] = $row["fans"];
		  $unique_request = ''.$unique_request.''.$row["screen_name"].',';
	      $c++;
		}
	  }
	} else {
	  //por hora
	  if(strpos($row["notfollowingme"],date('d-m-Y:H'))===false && 
	     strpos($row["siguiendoId"],date('d-m-Y'))!==false &&
	     strpos($row["seguidoresId"],date('d-m-Y'))!==false || ($difFechaPass>15 && $difFechaPass<1425)){
	    if(strpos($unique_request,$row["screen_name"])===false){
	      $cuentas[$c][0] = $row["screen_name"];
	      $cuentas[$c][1] = $row["oauth_token"];
	      $cuentas[$c][2] = $row["oauth_token_secret"];
	      $cuentas[$c][3] = $row["id_token"];
	      $cuentas[$c][4] = $row["notfollowingme"];
	      $cuentas[$c][5] = $row["identify"];
		  $cuentas[$c][6] = $row["seguidoresId"];
		  $cuentas[$c][7] = $row["siguiendoId"];
		  $cuentas[$c][8] = $row["seguidores"];
		  $cuentas[$c][9] = $row["siguiendo"];
		  $cuentas[$c][10] = $row["seguimientomutuo"];
		  $cuentas[$c][11] = $row["fans"];
		  $unique_request = ''.$unique_request.''.$row["screen_name"].',';
	      $c++;
		}
	  }
	}
  }
  $c=0;
  foreach($cuentas as $item){
		//crear carpeta si no existe
		if (!file_exists("../usuarios/".$item[0].""))
		  mkdir("../usuarios/".$item[0]."", 0777);
		  
		//obtener datos
		
		//seguidores
		$archivo = fopen("../usuarios/".$item[0]."/followers.txt", "rb");
		$contenido_seguidores = stream_get_contents($archivo);
		fclose($archivo);
		$seguidores_array=explode("|",$contenido_seguidores);
		$archivo = fopen("../usuarios/".$item[0]."/numfollowers.txt", "rb");
		$followers_cont = stream_get_contents($archivo);
		//siguiendo
		$archivo = fopen("../usuarios/".$item[0]."/following.txt", "rb");
		$contenido_siguiendo = stream_get_contents($archivo);
		fclose($archivo);
		$siguiendo_array=explode("|",$contenido_siguiendo);
		$archivo = fopen("../usuarios/".$item[0]."/numfollowing.txt", "rb");
		$following_cont = stream_get_contents($archivo);
		fclose($archivo);
		 $cont=0;
		 //Abrimos archivo de datos guardando informacion de seguidores y siguiendo
		 $archivo = fopen("../usuarios/".$item[0]."/notfollowme.txt", "w+");
		 fwrite($archivo, "".date("d/m/Y-G:i")."\n");
		 fwrite($archivo, "".$followers_cont.",".$following_cont."\n");
		 foreach($seguidores_array as &$key) 
		   $arrB[$key] = 1;
		 foreach($siguiendo_array as &$item2){
		   //Performance in_array por hash
		   //if(!in_array($item, $seguidores_array)){
		   if(!isset($arrB[$item2])){
			 //guardando informacion en la carpeta del usuario
			 fwrite($archivo, "".$item2."\n");
			 //$status = $oTwitter->post('friendships/destroy', array('user_id' => $isFollowing));
			 $cont++;
		   }
		 }
		 fclose($archivo);
		 $archivo = fopen("../usuarios/".$item[0]."/numnotfollowme.txt", "w+");
		 fwrite($archivo, "".$cont."\n");
		 fclose($archivo);
		if($cont!=0){
	      if(strpos($cuentas[$c][4],date('d-m-Y'))===false && 
	         strpos($cuentas[$c][6],date('d-m-Y'))!==false &&
	         strpos($cuentas[$c][7],date('d-m-Y'))!==false){
			  //si no hay el mismo día
			  $seguidores_array=explode(",",$cuentas[$c][8]);
			  $seguidores_num=explode("|",$seguidores_array[count($seguidores_array)-2]);
			  $seguidores=$seguidores_num[0];
			  
			  $siguiendo_array=explode(",",$cuentas[$c][9]);
			  $siguiendo_num=explode("|",$siguiendo_array[count($siguiendo_array)-2]);
			  $siguiendo=$siguiendo_num[0];
			  
			  $Sm = ($siguiendo-$cont);
			  $cuentas[$c][4] = ''.$cont.'|'.date('d-m-Y:H-i').',';
			  $cuentas[$c][10] = ''.$Sm.'|'.date('d-m-Y:H-i').',';
			  $cuentas[$c][11] = ''.($seguidores-$Sm).'|'.date('d-m-Y:H-i').',';
			  $query2=$conn->query("UPDATE estadisticas_twitter 
								   SET notfollowingme=CONCAT(notfollowingme,'".$cuentas[$c][4]."'),
									   seguimientomutuo=CONCAT(seguimientomutuo,'".$cuentas[$c][10]."'),
									   fans=CONCAT(fans,'".$cuentas[$c][11]."')
								   WHERE identify='".$item[5]."' AND red='twitter'");
			 echo 'No hay el mismo día: '.$item[0].': NOTFM: '.$cont.' SM: '.$Sm.' Fans: '.($seguidores-$Sm).'<br />';
		 } else {
		   //si hay el mismo día
		      $seguidores_array=explode(",",$cuentas[$c][8]);
			  $seguidores_num=explode("|",$seguidores_array[count($seguidores_array)-2]);
			  $seguidores=$seguidores_num[0];
			  
			  $siguiendo_array=explode(",",$cuentas[$c][9]);
			  $siguiendo_num=explode("|",$siguiendo_array[count($siguiendo_array)-2]);
			  $siguiendo=$siguiendo_num[0];
			  
			  $notfollowingme_array=explode(",",$cuentas[$c][4]);
			  $seguimientomutuo_array=explode(",",$cuentas[$c][10]);
			  $fans_array=explode(",",$cuentas[$c][11]);
			  for($i=0; $i<count($notfollowingme_array)-2; $i++){
				 $notfollowingme=''.$notfollowingme.''.$notfollowingme_array[$i].',';
				 $seguimientomutuo=''.$seguimientomutuo.''.$seguimientomutuo_array[$i].',';
		         $fans=''.$fans.''.$fans_array[$i].',';
			  }
			  $Sm = ($siguiendo-$cont);
			  $cuentas[$c][4] = ''.$notfollowingme.''.$cont.'|'.date('d-m-Y:H-i').',';
			  $cuentas[$c][10] = ''.$seguimientomutuo.''.$Sm.'|'.date('d-m-Y:H-i').',';
			  $cuentas[$c][11] = ''.$fans.''.($seguidores-$Sm).'|'.date('d-m-Y:H-i').',';
			  $query2=$conn->query("UPDATE estadisticas_twitter 
								   SET notfollowingme='".$cuentas[$c][4]."',
									   seguimientomutuo='".$cuentas[$c][10]."',
									   fans='".$cuentas[$c][11]."'
								   WHERE identify='".$item[5]."' AND red='twitter'");
			  echo 'Si hay el mismo día: '.$item[0].': NOTFM: '.$cont.' SM: '.$Sm.' Fans: '.($seguidores-$Sm).'<br />';
		 }
	  }//fin if cont
    $c++;
  }
} else {
  echo "FALSE";
}
$conn->close();
?>