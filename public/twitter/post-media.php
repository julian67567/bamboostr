<?PHP
  ini_set('max_execution_time', 9000);
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
	}
	else{
	  $query2=$conn->query("INSERT INTO token (screen_name,oauth_token,oauth_token_secret) VALUES ('".$user_info->screen_name."','".$credentials['oauth_token']."','".$credentials['oauth_token_secret']."')");
	  $screen_name = $user_info->screen_name;
	  $status = 'OK';
	}
  }
  else if($_GET["screen_name"]){
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
	  }
	  else
	    $status = 'ERROR';
  } else { 
    $status = 'ERROR';
  }
  if($status=="OK"){
          $conn->close();
	  $identify=$_GET["identify"];
	  $idPost = $_GET["idPost"];
	  $messages=$_GET["messages"];
	  $images=$_GET["images"];
	  $description=$_GET["description"];
	  $link=$_GET["link"];
	  $screen_name=$_GET["screen_name"];
	  if($link || ($description && !$images)){
	    // Publicamos el mensaje en twitter
        $twitter = $twitteroauth->post('statuses/update', array('status' => $description));
	  } else {
		$images_array = explode(",",$images);
		  foreach($images_array as $photo){
			   if($photo!=""){
				   //https://upload.twitter.com/1.1/media/upload.json  -> requiere un subdominio upload.twitter.com/1.1/
                                   //statuses/update_with_media -> depricated
				   $parameters = array('media' => base64_encode(file_get_contents($photo)));
                                   
				   $twitter = $twitteroauth->post('https://upload.twitter.com/1.1/media/upload.json', $parameters, true);	
                                   if($twitter->media_id_string){
                                     $twitter = $twitteroauth->post('statuses/update', array('status' => $description, 'media_ids' =>  $twitter->media_id_string));
                                   } 
			   }
		  }
	  }
	  echo json_encode($twitter);
  } else {
    $conn->close();
    echo $status;
  }
?>