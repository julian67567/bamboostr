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
  else if($argv[1]){
	  //si no hay credenciales en la url
	  $query = $conn->query("SELECT oauth_token,oauth_token_secret FROM token WHERE screen_name='".$argv[1]."'");
	  if($query->num_rows>0){
	    $row=$query->fetch_assoc();
		$oauth_token = $row["oauth_token"];
		$oauth_token_secret = $row["oauth_token_secret"];
	    //si hay credenciales en la url
        $twitteroauth = new TwitterOAuth($consumer_key, $consumer_secret, $oauth_token, $oauth_token_secret);
		$screen_name = $argv[1];
		$status = 'OK';
	  }
	  else
	    $status = 'ERROR';
  }
  else 
    $status = 'ERROR';
  if($status=="OK"){
          $conn->close();
	  $count = $argv[2];
	  $max_id = $argv[3];
	  //GET DM.
	  //DMS Recibidos
	  //$GETDM = $twitteroauth->get("https://api.twitter.com/1.1/direct_messages.json?count=200");
	  //DMS Mandados
	  if(!$max_id){
	    $mentions = $twitteroauth->get("https://api.twitter.com/1.1/statuses/mentions_timeline.json?count=".$count."");
	  } else {
		$mentions = $twitteroauth->get("https://api.twitter.com/1.1/statuses/mentions_timeline.json?count=".$count."&max_id=".$max_id."");
	  }
      echo json_encode($mentions);
  } else {
    $conn->close();
    echo $status;
  }
?>