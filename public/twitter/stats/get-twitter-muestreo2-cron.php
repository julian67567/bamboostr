<?PHP
ini_set('max_execution_time', 15000);
include '../conexioni.php';
require("../twitteroauth/twitteroauth.php");
include '../config-sample.php';
include '../../scripts/funciones.php';
$identify=$argv[1];
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
      if(strpos($row["muestreo2"],date('d-m-Y'))===false){
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
      //muestreo por día para no afectar a los limites de twitter 
      if(strpos($row["muestreo2"],date('d-m-Y'))===false){
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
  }// fin while

  $c=0;
  foreach($cuentas as $item){
    $twitteroauth = new TwitterOAuth($consumer_key, $consumer_secret, $item[1], $item[2]);
	$user_info = $twitteroauth->get('account/verify_credentials');
	if($twitteroauth->http_code==200){
	    $seguidores_rango = $user_info->friends_count;
		$c=1;
		echo ''.$item[0].' S: '.$seguidores_rango.'<br />';
		//seguidores
	    $archivo = fopen("../usuarios/".$item[0]."/following.txt", "rb");
	    $contenido_seguidores = stream_get_contents($archivo);
	    $seguidores_array = explode("|",$contenido_seguidores);
	    fclose($archivo);
		
		//tomas de muestras
		$grupo_100 = array();
		$num_grupo=1;
                $tope = 5000;
		if($seguidores_rango>$tope){
		  while($c<=$tope){
		    //rangos iguales
			//alerta de muestreo
			$muestra = rand(1,$seguidores_rango);
			if($repetidos["".$muestra.""]!=1){
			  $repetidos["".$muestra.""] = 1;
			} else {
			  while($repetidos["".$muestra.""]==1){
			    $muestra = rand(1,$seguidores_rango);
			  }
			  $repetidos["".$muestra.""] = 1;
			}
			if($c%100==0 || $c==1){
			  $grupo_100[$num_grupo] = array();
			  $id_num_grupo = 1;
			  $num_grupo++;
			} 
			$grupo_100[$num_grupo-1][$id_num_grupo] = $seguidores_array[$muestra];
			$id_num_grupo++;
		    $c++;
		  }
		} else {
		  //alerta datos reales
		  while($c<=$seguidores_rango){
		    //rangos iguales
			//alerta de muestreo
			$muestra = rand(1,$seguidores_rango);
			if($repetidos["".$muestra.""]!=1){
			  $repetidos["".$muestra.""] = 1;
			} else {
			  while($repetidos["".$muestra.""]==1){
			    $muestra = rand(1,$seguidores_rango);
			  }
			  $repetidos["".$muestra.""] = 1;
			}
			if($c%100==0 || $c==1){
			  $grupo_100[$num_grupo] = array();
			  $id_num_grupo = 1;
			  $num_grupo++;
			} 
			$grupo_100[$num_grupo-1][$id_num_grupo] = $seguidores_array[$muestra];
			$id_num_grupo++;
		    $c++;
		  }
		}
		$grupo_100[1][100]=$grupo_100[(($tope/100)+1)][1];
		unset($grupo_100[(($tope/100)+1)]);

		//envío de muestras a API twitter
		$group=1;
                $contaweire = 1;
		while($group<=count($grupo_100)){
		  $c=1;
		  $user_id = '';
		  while($c<=count($grupo_100[$group])){
			$user_id = ''.$user_id.''.$grupo_100[$group][$c].',';
			$c++;
		  }
                  $pet=$conn->query("SELECT id,perfil,nombre,location,ultimo_tweet,language,verified,protected,total_tweets,followers,following FROM big_data_tw WHERE id IN (".substr($user_id,0,strlen($user_id)-1).")");
                  //echo 'Encontrados: '.$pet->num_rows.'<br />';
                  if($pet->num_rows>=90){
                    $countObj=0;
                    $arreglo_ob = array(); 
                    while($row=$pet->fetch_assoc()){
                      $obj = new stdclass();
                      $obj->id = $row["id"];
                      $obj->id_str = $row["id"];
                      $obj->profile_image_url = $row["perfil"];
                      $obj->name = $row["nombre"];
                      $obj->location = $row["location"];
                      $obj->status->created_at = $row["ultimo_tweet"];
                      $obj->lang = $row["language"];
                      $obj->verified = $row["verified"];
                      $obj->protected = $row["protected"];
                      $obj->statuses_count = $row["total_tweets"];
                      $obj->followers_count = $row["followers"];
                      $obj->friends_count = $row["following"];
                      $arreglo_ob[$countObj] = new stdclass();
                      $arreglo_ob[$countObj] = $obj;
                      $countObj++; 
                    }  
                    $users = new stdclass();
                    $users = $arreglo_ob;
                  } else {
                    $users = $twitteroauth->post("users/lookup.json?user_id=".substr($user_id,0,strlen($user_id)-1)."");
                    foreach($users as $item2){
                      $pet=$conn->query("SELECT id FROM big_data_tw WHERE id='".$item2->id_str."'");
                      if($pet->num_rows>0){
		        $conn->query("UPDATE big_data_tw SET perfil='".$item2->profile_image_url."', screen_name='".$item2->screen_name."', nombre='".$item2->name."', location='".$item2->location."', total_tweets='".$item2->statuses_count."', followers='".$item2->followers_count."', following='".$item2->friends_count."', ultimo_tweet='".$item2->status->created_at."', language='".$item2->lang."', listas='".$item2->listed_count."', created_at='".$item2->created_at."', verified='".$item2->verified."', protected='".$item2->protected."', description='".$item2->description."', order_last_tweet='".date("Y-m-d",strtotime($item2->status->created_at))."', order_last_tweet_hr='".date("H",strtotime($item2->status->created_at))."', order_last_tweet_min='".date("i",strtotime($item2->status->created_at))."'
							WHERE id='".$item2->id_str."'");
		      } else {
		        $conn->query("INSERT INTO big_data_tw (id,perfil,screen_name,nombre,location,total_tweets,followers,following,ultimo_tweet,language,listas,created_at,verified,protected,description,order_last_tweet,order_last_tweet_hr,order_last_tweet_min) VALUES ('".$item2->id_str."','".$item2->profile_image_url."','".$item2->screen_name."','".$item2->name."','".$item2->location."','".$item2->statuses_count."','".$item2->followers_count."','".$item2->friends_count."','".$item2->status->created_at."','".$item2->lang."','".$item2->listed_count."','".$item2->created_at."','".$item2->verified."','".$item2->protected."','".$item2->description."','".date("Y-m-d",strtotime($item2->status->created_at))."','".date("H",strtotime($item2->status->created_at))."','".date("i",strtotime($item2->status->created_at))."')");
		      }
                    }
                  }
		  //echo 'G: '.$group.' Users '.substr($user_id,0,strlen($user_id)-1).'<br />';

		  foreach($users as $item2){
			$muestreo_array[] = ''.$item2->id_str.'|'.$item2->lang.'|'.obtenerPais(utf8_decode($item2->location)).'|'.$item2->protected.'|'.$item2->verified.'|'.strtoupper(quitar_acentos(utf8_decode($item2->name))).'|'.$item2->profile_image_url.'|'.date("d-m-Y", strtotime($item2->status->created_at)).'|'.$item2->statuses_count.'|'.$item2->followers_count.'|'.$item2->friends_count.'|'.$contaweire.'';
                        $muestreo_array_key["".$item2->id_str.""] = ''.$item2->id_str.'|'.$item2->lang.'|'.obtenerPais(utf8_decode($item2->location)).'|'.$item2->protected.'|'.$item2->verified.'|'.strtoupper(quitar_acentos(utf8_decode($item2->name))).'|'.$item2->profile_image_url.'|'.date("d-m-Y", strtotime($item2->status->created_at)).'|'.$item2->statuses_count.'|'.$item2->followers_count.'|'.$item2->friends_count.'|'.$contaweire.'';
                        $contaweire++;
		  }
		  $group++;
		}// fin while
                $muestreo_array_arch = array();
                $archivo = fopen("../usuarios/".$item[0]."/muestreo2.txt", "rb");
                if($archivo){
                  $muestreo_array_arch = stream_get_contents($archivo);
                } 
                fclose($archivo);
                if(count($muestreo_array_arch)<=0){
                  // no hay datos (no hay muestreo se escribe todo directo)
                  $archivo = fopen("../usuarios/".$item[0]."/muestreo2.txt", "w+");
                  foreach($muestreo_array as $muestra_s){
                    $rcgn1 = explode("\n",$muestra_s);
                    if($muestra_s!="" && $rcgn1[0]!="")
                      fwrite($archivo, ''.$muestra_s.''.PHP_EOL.'');
                  }
                  fclose($archivo);
                } else {
                  // hay datos tenemos que hacer condiciones
                  fclose($archivo);


                  //compara los anteriores ids en la "BD" haber si sigues siguiendo y actualiza los usuario con info anterior por la nueva info. 
                  $keyA = array();
                  foreach($seguidores_array as $sdfgew){
                    $keyA["".$sdfgew.""] = 1;
                  }
                  $archivo3 = fopen("../usuarios/".$item[0]."/muestreo2.txt", "w+");
                  $mMAAmuestreo = explode("\n",$muestreo_array_arch);
                  foreach($mMAAmuestreo as $sdf332){
                    $mMAA = explode("|",$sdf332);
                    if($keyA["".$mMAA[0].""]==1){
                      if($sdf332!=""){
                        if($muestreo_array_key["".$mMAA[0].""]!="")
                          fwrite($archivo3, ''.$muestreo_array_key["".$mMAA[0].""].''.PHP_EOL.'');
                        else if($mMAA[0]!="")
                          fwrite($archivo3, ''.$sdf332.''.PHP_EOL.'');
                      }
                    }
                  }
                  fclose($archivo3);

                  //mete llaves para velocidad y escribe los faltantes en la lista
                  $keyB = array();
                  $mMAAmuestreo = explode("\n",$muestreo_array_arch);
                  foreach($mMAAmuestreo as $fsdf){
                    $mMAA = explode("|",$fsdf);
                    $keyB["".$mMAA[0].""] = 1;
                  }

                  //escribe los faltantes en la lista
                  $archivo2 = fopen("../usuarios/".$item[0]."/muestreo2.txt", "a+");
                  foreach($muestreo_array as $cvasw12){
                    $array327eywqs = explode("|",$cvasw12);
                    if($keyB["".$array327eywqs[0].""]!=1){
                      //guardar nuevo registro
                      if($cvasw12!="" && $array327eywqs[0]!="")
                        fwrite($archivo2, ''.$cvasw12.''.PHP_EOL.'');
                    }
                  }
                  fclose($archivo2);
                }

                //no hay actualizaciones por eso no hay condición
                $query2=$conn->query("UPDATE estadisticas_twitter 
				      SET muestreo2='".date("d-m-Y:H-i")."'
				      WHERE identify='".$item[5]."' AND red='twitter'");

        } 
    $c++;
  }//fin foreach
} else {
  echo "FALSE";
}
$conn->close();
?>