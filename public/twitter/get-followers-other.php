<?PHP
  ini_set('max_execution_time', 9000);
  header('Content-type: text/html; charset=utf-8');
  include 'conexioni.php';
  require("twitteroauth/twitteroauth.php");
  session_start();
  // We've got everything we need
  // TwitterOAuth instance, with two new parameters we got in twitter_login.php
  include 'config-sample.php';
  if($_GET["oauth_verifier"] && $_SESSION['oauth_token'] && $_SESSION['oauth_token_secret']){
    //si hay credenciales en la url
    $twitteroauth = new TwitterOAuth($consumer_key, $consumer_secret, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
    //credenciales oauth token correctas
    $credentials = $twitteroauth->getAccessToken($_GET["oauth_verifier"]);
    //datos del usuario
    $user_info = $twitteroauth->get('account/verify_credentials');
    //Almacenar tokens en la base de datos
    $query = $conn->query("SELECT id FROM token WHERE screen_name='".$user_info->screen_name."'");
    if($query->num_rows>0){
      $query2=$conn->query("UPDATE token SET oauth_token='".$credentials['oauth_token']."', oauth_token_secret='".$credentials['oauth_token_secret']."' WHERE screen_name='".$user_info->screen_name."'");
      $screen_name = $user_info->screen_name;
      $status = 'OK';
    } else {
      $query2=$conn->query("INSERT INTO token (screen_name,oauth_token,oauth_token_secret) VALUES ('".$user_info->screen_name."','".$credentials['oauth_token']."','".$credentials['oauth_token_secret']."')");
      $screen_name = $user_info->screen_name;
      $status = 'OK';
    }
  } else if($_GET["screen_name"]) {
    //si no hay credenciales en la url
    $query = $conn->query("SELECT oauth_token,oauth_token_secret FROM token WHERE screen_name='".$_GET["screen_name"]."'");
    if($query->num_rows>0){
      $row=$query->fetch_assoc();
      $oauth_token = $row["oauth_token"];
      $oauth_token_secret = $row["oauth_token_secret"];
      //si hay credenciales en la url
      $twitteroauth = new TwitterOAuth($consumer_key, $consumer_secret, $oauth_token, $oauth_token_secret);
      $screen_name = $_GET["screen_name"];
      $status = 'OK';
    } else {
      $status = 'ERROR';
    }
  } else { 
    $status = 'ERROR';
  }
  // Publicamos el mensaje en twitter
  // $mensaje = "Publicando un mensaje en una cuenta de Twitter utilizando OAuth.";
  // $twitter= $connection->post('statuses/update', array('status' => $mensaje) );
  if($status=="OK" && $_GET["other"]){
    //BLACKLIST
    $archivo = fopen("usuarios/".$screen_name."/blacklist.txt", "rb");
    $blacklist = stream_get_contents($archivo);
    fclose($archivo);
    $blacklist_array = explode("\n",$blacklist);
    $blacklist_key = [];    
    foreach($blacklist_array as $item){
      $blacklist_key["".$item.""] = 1; 
    }
    
    //Siguiendo
    if($_GET["hoja"]==1){
    $archivo = fopen("usuarios/".$screen_name."/followingTool.txt", "rb");
    $contenido_seguidores = stream_get_contents($archivo);
    fclose($archivo);
    $contenido_seguidores_array = explode("|",$contenido_seguidores);
    //si hoja es 1
    if(strtoupper($contenido_seguidores_array[count($contenido_seguidores_array)-1])==strtoupper($_GET["other"])){
      $cursor=-2;
    } else {
      $cursor=-1;
    }
  } else {
    $archivo = fopen("usuarios/".$screen_name."/followingTool.txt", "rb");
    $contenido_seguidores = stream_get_contents($archivo);
    fclose($archivo);
    $contenido_seguidores_array = explode("|",$contenido_seguidores);
    //si hoja no es 1
    //no es necesaria la condicion
    if(strtoupper($contenido_seguidores_array[count($contenido_seguidores_array)-1])==strtoupper($_GET["other"])){
      //condicion de 50 en 50
      if($_GET["hoja"]%50==1 && $_GET["hoja"]>((int)((count($contenido_seguidores_array)-2)/100))){
        $cursor=$contenido_seguidores_array[count($contenido_seguidores_array)-2];
      } else if( $_GET["hoja"]*100<=(((count($contenido_seguidores_array)-2+100))) ){
	$cursor=-2;
      } else {
        $obj = new stdclass();
        $obj->fin = "fin";
        echo json_encode($obj);
        die();
      }
      //echo "entro1";
    } 
    //echo "entro2";
  }
  //echo ''.$_GET["hoja"].' '.$cursor.'';
  if($cursor!=-2){
    if($cursor!=-1){
      $archivo = fopen("usuarios/".$screen_name."/followingTool.txt", "rb");
      $archivo_backup = stream_get_contents($archivo);
      fclose($archivo);
    } else {
      $archivo = fopen("usuarios/".$screen_name."/followingTool.txt", "w+");
    }
    $following = $twitteroauth->get("followers/ids.json?screen_name=".$_GET["other"]."&cursor=".$cursor."&count=5000");
  }
  //print_r($following);
  if($following->errors[0]->message!="Rate limit exceeded" && $cursor!=-2){
    //echo "entro";
    $following_array = (array)$following;
    $users_id_array = array();
    $c=1;
    if($cursor!=-1){
      $archivo = fopen("usuarios/".$screen_name."/followingTool.txt", "w+");
      $archivo_backup_array=explode("|",$archivo_backup);
      foreach($archivo_backup_array as $item123){
        if($c==1){
          fwrite($archivo, "".$item123."");
        } else if($c!=(count($archivo_backup_array)-1) && $c!=(count($archivo_backup_array))) {
	  fwrite($archivo, "|".$item123."");
        }
        $c++;
      }
    }
    $c2=1;
    foreach ($following_array['ids'] as $item) {
      if($c2==1 && $item){
        fwrite($archivo, "".$item."");
      } else if($item) {
        fwrite($archivo, "|".$item."");
      }
      if($c2<=100 && $item){
        $user_id_array[] = $item;
      } 
      $c2++;
    }// fin foreach
    $users_profiles_error=$twitteroauth->get("users/lookup.json?user_id=".implode(',',$user_id_array)."");
    //print_r($users_profiles_error);
    $users_profiles = (array)$users_profiles_error;
    foreach($users_profiles as $item2){
      $query = $conn->query("SELECT id FROM big_data_tw WHERE id='".$item2->id_str."'");
      if($query->num_rows>0){
        $conn->query("UPDATE big_data_tw SET perfil='".$item2->profile_image_url."', screen_name='".$item2->screen_name."', nombre='".$item2->name."', location='".$item2->location."', total_tweets='".$item2->statuses_count."', followers='".$item2->followers_count."', following='".$item2->friends_count."', ultimo_tweet='".$item2->status->created_at."', language='".$item2->lang."', listas='".$item2->listed_count."', created_at='".$item2->created_at."', verified='".$item2->verified."', protected='".$item2->protected."', description='".$item2->description."', order_last_tweet='".date("Y-m-d",strtotime($item2->status->created_at))."', order_last_tweet_hr='".date("H",strtotime($item2->status->created_at))."', order_last_tweet_min='".date("i",strtotime($item2->status->created_at))."'
							WHERE id='".$item2->id_str."'");
      } else {
	$conn->query("INSERT INTO big_data_tw (id,perfil,screen_name,nombre,location,total_tweets,followers,following,ultimo_tweet,language,listas,created_at,verified,protected,description,order_last_tweet,order_last_tweet_hr,order_last_tweet_min) VALUES ('".$item2->id_str."','".$item2->profile_image_url."','".$item2->screen_name."','".$item2->name."','".$item2->location."','".$item2->statuses_count."','".$item2->followers_count."','".$item2->friends_count."','".$item2->status->created_at."','".$item2->lang."','".$item2->listed_count."','".$item2->created_at."','".$item2->verified."','".$item2->protected."','".$item2->description."','".date("Y-m-d",strtotime($item2->status->created_at))."','".date("H",strtotime($item2->status->created_at))."','".date("i",strtotime($item2->status->created_at))."')");
      }
    }//fin foreach
    //obtener utf_8 en $users_profiles json_encode
    $response_array = [];
    $cwe=0;
    foreach($users_profiles as $item234){
      $obj = new stdclass();
      $obj->screen_name = $item234->screen_name;
      $obj->location = utf8_encode($item234->location);
      $obj->profile_image_url = $item234->profile_image_url;
      $obj->friends_count = $item234->friends_count;
      $obj->followers_count = $item234->followers_count;
      $obj->status->created_at = $item234->status->created_at;
      $obj->name = utf8_encode($item234->name);
      if(isset($blacklist_key[$item234->id])){
        $obj->following = "BlackList";
      } else {
        $obj->following = $item234->following;
      }
      $obj->id = $item234->id;
      $obj->listed_count = $item234->listed_count;
      $obj->statuses_count = $item234->statuses_count;
      $obj->verified = $item234->verified;
      $obj->protected = $item234->protected;
      $obj->description = utf8_encode($item234->description);
      $obj->lang = utf8_encode($item234->lang);
      $response_array[$cwe] = new stdclass();
      $response_array[$cwe]=$obj;
      $cwe++;
    }
    echo json_encode($response_array);
    $user_id_array = array();
    $cursor = $following->next_cursor;
    fwrite($archivo, "|cont:".(($c+$c2)-1)."");
    fwrite($archivo, "|".$cursor."");
    fwrite($archivo, "|".$_GET["other"]."");
    fclose($archivo);
  } else if($following->errors[0]->message=="Rate limit exceeded") {
    echo "Rate limit exceeded";
  } else if($cursor==-2) {
    //consulta sin get followers id
    $obj = array();
    if($_GET["hoja"]==1){
    $c = 0;
    $limite = 100;
    } else {
      $c = (($_GET["hoja"]-1)*100);
      $limite = $c + 100;
    }
    for($i=$c; $i<$limite; $i++){
      if($contenido_seguidores_array[$i] && strtoupper($_GET["other"])!=strtoupper($contenido_seguidores_array[$i]) && substr($contenido_seguidores_array[$i],0,5)!="cont:"){
        $array[] = $contenido_seguidores_array[$i];
      }
    }
    //print_r($array);
    if($_GET["hoja"]){
      $users_profiles = (array)$twitteroauth->get("users/lookup.json?user_id=".implode(',',$array)."");
      //print_r($users_profiles);
      foreach($users_profiles as $item2){
        $query = $conn->query("SELECT id FROM big_data_tw WHERE id='".$item2->id_str."'");
	if($query->num_rows>0){
	  $conn->query("UPDATE big_data_tw SET perfil='".$item2->profile_image_url."', screen_name='".$item2->screen_name."', nombre='".$item2->name."', location='".$item2->location."', total_tweets='".$item2->statuses_count."', followers='".$item2->followers_count."', following='".$item2->friends_count."', ultimo_tweet='".$item2->status->created_at."', language='".$item2->lang."', listas='".$item2->listed_count."', created_at='".$item2->created_at."', verified='".$item2->verified."', protected='".$item2->protected."', description='".$item2->description."', order_last_tweet='".date("Y-m-d",strtotime($item2->status->created_at))."', order_last_tweet_hr='".date("H",strtotime($item2->status->created_at))."', order_last_tweet_min='".date("i",strtotime($item2->status->created_at))."'
							WHERE id='".$item2->id_str."'");
        } else {
	  $conn->query("INSERT INTO big_data_tw (id,perfil,screen_name,nombre,location,total_tweets,followers,following,ultimo_tweet,language,listas,created_at,verified,protected,description,order_last_tweet,order_last_tweet_hr,order_last_tweet_min) VALUES ('".$item2->id_str."','".$item2->profile_image_url."','".$item2->screen_name."','".$item2->name."','".$item2->location."','".$item2->statuses_count."','".$item2->followers_count."','".$item2->friends_count."','".$item2->status->created_at."','".$item2->lang."','".$item2->listed_count."','".$item2->created_at."','".$item2->verified."','".$item2->protected."','".$item2->description."','".date("Y-m-d",strtotime($item2->status->created_at))."','".date("H",strtotime($item2->status->created_at))."','".date("i",strtotime($item2->status->created_at))."')");
         }
      }//fin foreach
    }//fin if get hoja
    /*Agarro todos los usuario que esta siguiendo la cuenta para conciliarlos con la base de datos*/
    $archivo = fopen("usuarios/".$screen_name."/following.txt", "rb");
    $contenido_seguidores_new = stream_get_contents($archivo);
    $contenido_seguidores_new_array=explode("|",$contenido_seguidores_new);
    fclose($archivo);
    foreach($contenido_seguidores_new_array as $userFgh){
      if($userFgh!=""){
        $siguiendoNoRepetir[$userFgh] = 1;
      }
    }//fin foreach
    $query=$conn->query("SELECT id,screen_name,location,perfil,following,followers,ultimo_tweet,nombre,language,listas,created_at,total_tweets,verified,protected,description
                                 FROM big_data_tw WHERE id IN (".implode(',',$array).")");
    $i=0;
    while($row=$query->fetch_assoc()){
      $obj[$i] = new stdclass();
      $obj[$i]->id = $row["id"];
      if(isset($blacklist_key[$row["id"]])){
        $obj[$i]->following = "BlackList";
      } else if(!isset($siguiendoNoRepetir[$row["id"]])){
        $obj[$i]->following = false;
      } else {
        $obj[$i]->following = true;
      }
      $obj[$i]->screen_name = $row["screen_name"];
      $obj[$i]->location = utf8_encode($row["location"]);
      $obj[$i]->profile_image_url = $row["perfil"];
      $obj[$i]->friends_count = $row["following"];
      $obj[$i]->followers_count = $row["followers"];
      $obj[$i]->status->created_at = $row["ultimo_tweet"];
      $obj[$i]->name = utf8_encode($row["nombre"]);
      $obj[$i]->lang = utf8_encode($row["language"]);
      $obj[$i]->listed_count = $row["listas"];
      $obj[$i]->created_at = $row["created_at"];
      $obj[$i]->statuses_count = $row["total_tweets"];
      if($row["verified"]){
	$obj[$i]->verified = TRUE;
      } else {
        $obj[$i]->verified = FALSE;
      }
      if($row["protected"]){
	$obj[$i]->protected = TRUE;
      } else {
	$obj[$i]->protected = FALSE;
      }
      $obj[$i]->description = utf8_encode($row["description"]);
	$i++;
      }
      echo json_encode($obj);
    }
  }
  $conn->close();

?>