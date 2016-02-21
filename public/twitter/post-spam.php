<?PHP
  echo ''.$argv[1].' '.$argv[2].'';
  ini_set('max_execution_time', 9000);
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
  else if($argv[1]){
	  //si no hay credenciales en la url
	  $query = $conn->query("SELECT identify FROM token WHERE id='".$argv[3]."'") or die(mysqli_error($conn));
	  $row=$query->fetch_assoc();
          $identify = $row["identify"]; 

	  $query = $conn->query("SELECT tipo,oauth_token,oauth_token_secret,identify FROM token WHERE screen_name='".$argv[1]."'") or die(mysqli_error($conn));
	  if($query->num_rows>0){
	    $row=$query->fetch_assoc();
		$oauth_token = $row["oauth_token"];
		$oauth_token_secret = $row["oauth_token_secret"];
	        //si hay credenciales en la url
                $twitteroauth = new TwitterOAuth($consumer_key, $consumer_secret, $oauth_token, $oauth_token_secret);
		$screen_name = $argv[1];
		$tipo = $row["tipo"];
		$query2=$conn->query("SELECT tipo FROM grupos WHERE user='".$row["identify"]."' AND  grupo='".$identify."'") or die(mysqli_error($conn));
		while($row2=$query2->fetch_assoc()){
		  if($tipo=="" && $row2["tipo"]=="basic")
			$tipo="basic";
		  if(($tipo=="" || $tipo=="basic") && $row2["tipo"]=="pro")
			$tipo="pro";
		  if(($tipo=="" || $tipo=="basic" || $tipo=="pro") && $row2["tipo"]=="ent")
			$tipo="ent";
		}
		$status = 'OK';
	  }
	  else
	    $status = 'ERROR';
  } else { 
    $status = 'ERROR';
  }
  if($status=="OK"){
    $conn->close();
    if($argv[2]==1){
      if($tipo!="pro" && $tipo!="ent" && $tipo!="basic"){
        if($screen_name!="bamboostr"){

          // Siguir a bamboostr
          $status = $twitteroauth->post('friendships/create', array('screen_name' => 'bamboostr'));
        }
      }    
    } else if($argv[2]==2){
      //$tipo!="pro" && $tipo!="ent" && $tipo!="basic"
      if($tipo!="pro" && $tipo!="basic"){
        
        // Seguir a bamboostr
        // $status = $twitteroauth->post('friendships/create', array('screen_name' => 'bamboostr'));
        
        // Publicamos el mensaje en twitter
        //$mensaje = "Elimina tus DMS mandados con: @bamboostr";
        //$twitter= $twitteroauth->post('statuses/update', array('status' => $mensaje) );
      }
    } else if($argv[2]==3){
      if($tipo!="pro" && $tipo!="basic"){

        // Seguir a bamboostr
        //$status = $twitteroauth->post('friendships/create', array('screen_name' => 'bamboostr'));

        // Publicamos el mensaje en twitter
        //$mensaje = "Elimina los que no te siguen de vuelta con: @bamboostr";
        //$twitter= $twitteroauth->post('statuses/update', array('status' => $mensaje) );
      }
    }
  }
?>