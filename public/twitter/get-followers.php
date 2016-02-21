<?PHP
  ini_set('max_execution_time', 9000);
  include ''.dirname(__FILE__).'/../conexioni.php';
  require("".dirname(__FILE__)."/twitteroauth/twitteroauth.php");
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
  }
  else 
    $status = 'ERROR';

  if($status=="OK" && !$_GET["start"] && !$_GET["seguidores"] && !$_GET["siguiendo"]){
        $conn->close();
	//seguidores
	$cursor=-1;
	$followers_cont=0;
	$archivo = fopen("usuarios/".$screen_name."/followers.txt", "w+");
	do {
	  $followers = $twitteroauth->get("https://api.twitter.com/1.1/followers/ids.json?screen_name=".$screen_name."&cursor=".$cursor."&count=5000");
	  $followers_array = (array)$followers;
	  foreach ($followers_array['ids'] as &$item) {
		$seguidores_array[] = $item;
		fwrite($archivo, "|".$item."");
		$followers_cont++;
	  }
	  $cursor = $followers->next_cursor;
	 } while ($cursor>0);
	 fclose($archivo);
	 $archivo = fopen("usuarios/".$screen_name."/numfollowers.txt", "w+");
	 fwrite($archivo, ''.$followers_cont.'');
	 fclose($archivo);
  } else {
    $conn->close();
  }
?>