<?PHP
  ini_set('max_execution_time', 9000);
  include ''.dirname(__FILE__).'/../conexioni.php';
  include ''.dirname(__FILE__).'/../lenguajes/espanol.php';
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
	  $query = $conn->query("SELECT identify FROM token WHERE id='".$argv[5]."'") or die(mysqli_error($conn));
	  $row=$query->fetch_assoc();
          $identify = $row["identify"]; 

	  //si no hay credenciales en la url
	  $query = $conn->query("SELECT oauth_token,oauth_token_secret,tipo,id,identify FROM token WHERE screen_name='".$argv[1]."'") or die(mysqli_error($conn));
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
  } else { 
    $status = 'ERROR';
  }
  if($status=="OK"){
    $cola = json_decode(stripslashes($argv[2]));
    $seguidores_cont = 0;
    $ids = array();
    $message = array();
    $error = 0;
    $condsf = 0;
    foreach($cola as $d){
      //$d[0] screen_name
      //$d[1] ids
      $ids[$condsf] = $d[1];
          $query = $conn->query("SELECT unfollow FROM limites_tw WHERE id_token='".$id_token."'") or die(mysqli_error($conn));
          $row=$query->fetch_assoc();
          $limite_unfollow = $row["unfollow"];
          $limite_unfollow_array = explode("|",$limite_unfollow);
          $limite_unfollow_array2 = explode(" ",$limite_unfollow_array[1]);
          if(strtotime(date('d-m-Y H:i:s'))>=strtotime($limite_unfollow_array[1]) || $limite_unfollow==""){
            if($limite_unfollow==""){
              $conn->query("UPDATE `limites_tw` SET `unfollow`='1|".date('d-m-Y H:i:s', strtotime('-1 minutes'))."' WHERE `id_token`='".$id_token."'") or die(mysqli_error($conn));
              $seguidores_cont++;
            } else {
              if($limite_unfollow_array2[0]==date("d-m-Y")){
                if($limite_unfollow_array[0]<500 && ($tipo=="pro" || $tipo=="ent" || $tipo=="basic")){
                  $conn->query("UPDATE `limites_tw` SET `unfollow`='".($limite_unfollow_array[0]+1)."|".date('d-m-Y H:i:s', strtotime('-1 minutes'))."' WHERE `id_token`='".$id_token."'") or die(mysqli_error($conn));
                  $seguidores_cont++;
                } else if ($limite_unfollow_array[0]<200){
                  $conn->query("UPDATE `limites_tw` SET `unfollow`='".($limite_unfollow_array[0]+1)."|".date('d-m-Y H:i:s', strtotime('-1 minutes'))."' WHERE `id_token`='".$id_token."'") or die(mysqli_error($conn));
                  $seguidores_cont++;
                } else {
                  $obj = new stdclass();
                  if($tipo=="pro" || $tipo=="ent" || $tipo=="basic"){
                    $message[] = $txt["txt520"];
                    $ids[$condsf] = "E".$d[1]."";
                  } else {
                    $message[] = $txt["txt519"];
                    $ids[$condsf] = "E".$d[1]."";
                  }
                }
              } else if(strtotime(date('d-m-Y H:i:s'))>strtotime($limite_unfollow_array[1].'+1 days')) {
                $conn->query("UPDATE `limites_tw` SET `unfollow`='1|".date('d-m-Y H:i:s', strtotime('-1 minutes'))."' WHERE `id_token`='".$id_token."'") or die(mysqli_error($conn));
                $seguidores_cont++;
              } else if(($limite_unfollow_array[0]<400 && ($tipo=="pro" || $tipo=="ent" || $tipo=="basic")) || ($limite_unfollow_array[0]<150 && ($tipo=="pro" || $tipo=="ent" || $tipo=="basic"))){ 
                /*Cuando hicieron falta por dejar de seguir hay que dejar que se dejen de seguir pero dejamos un intervalo y es diferente el día debido a la condicion $limite_unfollow_array2[0]==date("d-m-Y")*/
                $conn->query("UPDATE `limites_tw` SET `unfollow`='".($limite_unfollow_array[0]+1)."|".date('d-m-Y H:i:s', strtotime('-1 minutes'))."' WHERE `id_token`='".$id_token."'") or die(mysqli_error($conn));
                $seguidores_cont++;
              }  else {
                /*si no cumple tiempo*/  
                $message[] = "No puedes Dejar de Seguir debido a que no has esperado el tiempo suficiente";
                $ids[$condsf] = "E".$d[1]."";
              }
	    }
          } else {
            /*si no cumple tiempo*/  
            $message[] = "No puedes Dejar de Seguir debido a que no has esperado el tiempo suficiente";
            $ids[$condsf] = "E".$d[1]."";
          }/*fin if tiempo*/
          if(count($message)==0){
            /*Tiempo de espera entre follows para que no bloqueen las apis*/
            usleep(600000);
	    $archivo = fopen("usuarios/".$screen_name."/numnotfollowme.txt", "rb");
	    $numnotfollowme = stream_get_contents($archivo);
            if($numnotfollowme>0)
              $numnotfollowme = $numnotfollowme-1;
	    fclose($archivo);
	    $archivo = fopen("usuarios/".$screen_name."/numnotfollowme.txt", "w+");
	    fwrite($archivo, "".$numnotfollowme."");
	    fclose($archivo);
	    $status = $twitteroauth->post('https://api.twitter.com/1.1/friendships/destroy.json?screen_name='.$d[0].'');
            if($status->{'id'}){
            } else {
              $ids[$condsf] = "E".$d[1]."";
              if($status->errors[0]->message)
                $message = json_encode($status->errors[0]->message);
              else
                $message = json_encode($status);
            }
          }/*fin mensaje*/
      $condsf++;
    }/*fin foreach*/

    $obj = new stdclass();
    if(count($message)!=0){
      $obj->errors[0]->message = $message;
    }
    if($error==1){
      $obj->errors[0]->m = "Error desde Sistema";
      $obj->errors[0]->message = $txt["txt251"];
    }
    $obj->ids = $ids;
    $obj->cont = $seguidores_cont;
    echo json_encode($obj); 
    $conn->close();
  } else {
    $conn->close();
    echo $status;
  }
?>