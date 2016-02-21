<?PHP
  ini_set('max_execution_time', 9000);
  header('Content-type: text/html; charset=utf-8');
  include ''.dirname(__FILE__).'/../conexioni.php';
  require("".dirname(__FILE__)."/twitteroauth/twitteroauth.php");
  session_start();
  // We've got everything we need
  // TwitterOAuth instance, with two new parameters we got in twitter_login.php
  include ''.dirname(__FILE__).'/config-sample.php';
  if($_GET["oauth_verifier"] && $_SESSION['oauth_token'] && $_SESSION['oauth_token_secret']){
	//si hay credenciales en la url
    $twitteroauth = new TwitterOAuth($consumer_key, $consumer_secret, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
	//credenciales oauth token correctas
    $credentials = $twitteroauth->getAccessToken($_GET["oauth_verifier"]);
	//datos del usuario
	$user_info = $twitteroauth->get('account/verify_credentials');
	//Almacenar tokens en la base de datos
	$query = $conn->query("SELECT id FROM token WHERE screen_name='".$user_info->screen_name."'") or die(mysqli_error($conn));
	if($query->num_rows>0){
	  $query2=$conn->query("UPDATE token SET oauth_token='".$credentials['oauth_token']."', oauth_token_secret='".$credentials['oauth_token_secret']."' WHERE screen_name='".$user_info->screen_name."'") or die(mysqli_error($conn));
	  $screen_name = $user_info->screen_name;
	  $status = 'OK';
	}
	else{
	  $query2=$conn->query("INSERT INTO token (screen_name,oauth_token,oauth_token_secret) VALUES ('".$user_info->screen_name."','".$credentials['oauth_token']."','".$credentials['oauth_token_secret']."')") or die(mysqli_error($conn));
	  $screen_name = $user_info->screen_name;
	  $status = 'OK';
	}
  }
  else if($_GET["screen_name"]){
	  //si no hay credenciales en la url
	  $query = $conn->query("SELECT oauth_token,oauth_token_secret FROM token WHERE screen_name='".$_GET["screen_name"]."'") or die(mysqli_error($conn));
	  if($query->num_rows>0){
	    $row=$query->fetch_assoc();
		$oauth_token = $row["oauth_token"];
		$oauth_token_secret = $row["oauth_token_secret"];
	    //si hay credenciales en la url
        $twitteroauth = new TwitterOAuth($consumer_key, $consumer_secret, $oauth_token, $oauth_token_secret);
		$screen_name = $_GET["screen_name"];
		$status = 'OK';
	  }
	  else
	    $status = 'ERROR';
  } else { 
    $status = 'ERROR';
  }

  if($status=="OK"){
    $hoja = $_GET["hoja"];
    if($_GET["option"]==2){
      $archivo = fopen("usuarios/".$screen_name."/notfollowme.txt", "rb");
    }
    if($_GET["option"]==3){
      $archivo = fopen("usuarios/".$screen_name."/bots.txt", "rb");
    }
    if($_GET["option"]==4){
      $archivo = fopen("usuarios/".$screen_name."/inactivas.txt", "rb");
    }
    if($_GET["option"]==5){
      $archivo = fopen("usuarios/".$screen_name."/image.txt", "rb");
    }
    if($_GET["option"]==6){
      $archivo = fopen("usuarios/".$screen_name."/blacklist.txt", "rb");
    }
    $notfollowingme = stream_get_contents($archivo);
    fclose($archivo);
    $notfollowingme = explode("\n",$notfollowingme);
    if($hoja==1)
      $cewfe = 1;
    else
      $cewfe = ($hoja-1)*100+1;
    $fin=($hoja*100);
    $cadena = [];
    $total_tope = count($notfollowingme)-1;
    while($cewfe<=$fin && $cewfe<=$total_tope){
      if(($cewfe!=0 && $cewfe!=1 && $_GET["option"]==2) || $_GET["option"]!=2){
        $cadena[] = $notfollowingme[$cewfe];
      }
      $cewfe++;
    }
    $users_profiles = (array)$twitteroauth->get("users/lookup.json?user_id=".implode(',',$cadena)."");
    //print_r($users_profiles);
    foreach($users_profiles as $item2){
	 $query = $conn->query("SELECT id FROM big_data_tw WHERE id='".$item2->id_str."'") or die(mysqli_error($conn));
	 if($query->num_rows>0){
	   $conn->query("UPDATE big_data_tw SET perfil='".$item2->profile_image_url."', screen_name='".$item2->screen_name."', nombre='".$item2->name."', location='".$item2->location."', total_tweets='".$item2->statuses_count."', followers='".$item2->followers_count."', following='".$item2->friends_count."', ultimo_tweet='".$item2->status->created_at."', language='".$item2->lang."', listas='".$item2->listed_count."', created_at='".$item2->created_at."', verified='".$item2->verified."', protected='".$item2->protected."', description='".$item2->description."', order_last_tweet='".date("Y-m-d",strtotime($item2->status->created_at))."', order_last_tweet_hr='".date("H",strtotime($item2->status->created_at))."', order_last_tweet_min='".date("i",strtotime($item2->status->created_at))."'
					WHERE id='".$item2->id_str."'") or die(mysqli_error($conn));
	 } else {
	   $conn->query("INSERT INTO big_data_tw (id,perfil,screen_name,nombre,location,total_tweets,followers,following,ultimo_tweet,language,listas,created_at,verified,protected,description,order_last_tweet,order_last_tweet_hr,order_last_tweet_min) VALUES ('".$item2->id_str."','".$item2->profile_image_url."','".$item2->screen_name."','".$item2->name."','".$item2->location."','".$item2->statuses_count."','".$item2->followers_count."','".$item2->friends_count."','".$item2->status->created_at."','".$item2->lang."','".$item2->listed_count."','".$item2->created_at."','".$item2->verified."','".$item2->protected."','".$item2->description."','".date("Y-m-d",strtotime($item2->status->created_at))."','".date("H",strtotime($item2->status->created_at))."','".date("i",strtotime($item2->status->created_at))."')") or die(mysqli_error($conn));
	 }
    }
    $response_array = [];
    $cwe=0;
    foreach($users_profiles as $item){
      $obj = new stdclass();
      $obj->screen_name = $item->screen_name;
      $obj->location = utf8_encode($item->location);
      $obj->profile_image_url = $item->profile_image_url;
      $obj->friends_count = $item->friends_count;
      $obj->followers_count = $item->followers_count;
      $obj->status->created_at = $item->status->created_at;
      $obj->name = utf8_encode($item->name);
      $obj->following = $item->following;
      $obj->id = $item->id;
      $obj->listed_count = $item->listed_count;
      $obj->statuses_count = $item->statuses_count;
      $obj->verified = $item->verified;
      $obj->protected = $item->protected;
      $obj->description = utf8_encode($item->description);
      $obj->lang = utf8_encode($item->lang);
      $response_array[$cwe] = new stdclass();
      $response_array[$cwe]=$obj;
      $cwe++;
    }
    echo json_encode($response_array);
    $conn->close();
  }
 
?>