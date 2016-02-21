<?PHP
  ini_set('max_execution_time', 9000);
  include ''.dirname(__FILE__).'/../conexioni.php';
  include ''.dirname(__FILE__).'/../scripts/funciones.php';
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
  else if($argv[1]){
          //si no hay credenciales en la url
	  $query = $conn->query("SELECT identify FROM token WHERE id='".$argv[3]."'") or die(mysqli_error($conn));
	  $row=$query->fetch_assoc();
          $identify = $row["identify"]; 

	  //si no hay credenciales en la url
	  $query = $conn->query("SELECT oauth_token,oauth_token_secret,id,tipo,identify FROM token WHERE screen_name='".$argv[1]."'") or die(mysqli_error($conn));
	  if($query->num_rows>0){
	    $row=$query->fetch_assoc();
		$oauth_token = $row["oauth_token"];
		$oauth_token_secret = $row["oauth_token_secret"];
	    //si hay credenciales en la url
        $twitteroauth = new TwitterOAuth($consumer_key, $consumer_secret, $oauth_token, $oauth_token_secret);
		$screen_name = $argv[1];
		$id_token = $row["id"];
		$tipo = $row["tipo"];
                $query2=$conn->query("SELECT tipo FROM grupos WHERE user='".$row["identify"]."' AND grupo='".$identify."'") or die(mysqli_error($conn));
		while($row2=$query2->fetch_assoc()){
		  if($tipo=="" && $row2["tipo"]=="basic")
			$tipo="basic";
		  if(($tipo=="" || $tipo=="basic") && $row2["tipo"]=="pro")
			$tipo="pro";
		  if(($tipo=="" || $tipo=="basic" || $tipo=="pro") && $row2["tipo"]=="ent")
			$tipo="ent";
		}
		$status = 'OK';
	  } else {
	    $status = 'ERROR';
          }
  }
  else 
    $status = 'ERROR';
  if($status=="OK"){
          $query2 = $conn->query("SELECT * FROM limites_tw WHERE id_token='".$id_token."'") or die(mysqli_error($conn));
          $conn->close();
          $row = $query2->fetch_assoc();
	  $user_info = $twitteroauth->get("https://api.twitter.com/1.1/account/verify_credentials.json?screen_name=".$screen_name."");
          $obj = new stdclass();
          $obj->followers = $user_info->followers_count;
          $obj->following = $user_info->friends_count;
          $obj->statuses_count = $user_info->statuses_count;
          $obj->favourites_count = $user_info->favourites_count;
          $follow_limit = explode("|",$row["follow"]);
          $unfollow_limit = explode("|",$row["unfollow"]);
          //echo "".date('d-m-Y H:i:s' , strtotime(date('d-m-Y H:i:s')))." ".date('d-m-Y H:i:s' , strtotime($follow_limit[1]))."";
          if(strtotime(date('d-m-Y H:i:s'))<=strtotime($follow_limit[1].'+1 days') || strtotime(date('d-m-Y H:i:s'))<=strtotime($follow_limit[1]))
            $obj->following_limit = $follow_limit[0];
          else 
            $obj->following_limit = 0;
          if(strtotime(date('d-m-Y H:i:s'))<=strtotime($unfollow_limit[1].'+1 days') || strtotime(date('d-m-Y H:i:s'))<=strtotime($unfollow_limit[1]))
            $obj->unfollowing_limit = $unfollow_limit[0];
          else 
            $obj->unfollowing_limit = 0;
          if($tipo=="pro" || $tipo=="ent")
            $obj->top_following_limit = 975;
          else
            $obj->top_following_limit = 500;
          if($tipo=="pro" || $tipo=="ent")
            $obj->top_unfollowing_limit = 500;
          else
            $obj->top_unfollowing_limit = 200;
	  echo json_encode($obj);
  } else {
    $conn->close();
    echo $status;
  }
?>