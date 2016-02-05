<?PHP
  ini_set('max_execution_time', 9000);
  include 'conexioni.php';
  include '../lenguajes/espanol.php';
  include '../scripts/funciones.php';
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
	  $query = $conn->query("SELECT identify FROM token WHERE id='".$argv[5]."'");
	  $row=$query->fetch_assoc();
          $identify = $row["identify"]; 

	  $query = $conn->query("SELECT oauth_token,oauth_token_secret,tipo,id,identify FROM token WHERE screen_name='".$argv[1]."'");
	  if($query->num_rows>0){
	    $row=$query->fetch_assoc();
		$oauth_token = $row["oauth_token"];
		$oauth_token_secret = $row["oauth_token_secret"];
	    //si hay credenciales en la url
        $twitteroauth = new TwitterOAuth($consumer_key, $consumer_secret, $oauth_token, $oauth_token_secret);
		$screen_name = $argv[1];
                $id_token = $row["id"];
                $tipo = $row["tipo"];
		$query2=$conn->query("SELECT tipo FROM grupos WHERE user='".$row["identify"]."' AND grupo='".$identify."'");
		while($row2=$query2->fetch_assoc()){
		  if($tipo=="" && $row2["tipo"]=="basic")
			$tipo="basic";
		  if(($tipo=="" || $tipo=="basic") && $row2["tipo"]=="pro")
			$tipo="pro";
		  if(($tipo=="" || $tipo=="basic" || $tipo=="pro") && $row2["tipo"]=="ent")
			$tipo="ent";
		}
		$status = 'OK';
                $seguidores = $argv[3];
                $siguiendo = $argv[4];
	  }
	  else
	    $status = 'ERROR';
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
      if( (intval(($seguidores)*(1.1))>$siguiendo) || ($seguidores<=5000 && $siguiendo<5000)){
          $query = $conn->query("SELECT follow FROM limites_tw WHERE id_token='".$id_token."'");
          $row=$query->fetch_assoc();
          $limite_follow = $row["follow"];
          $limite_follow_array = explode("|",$limite_follow);
          $limite_follow_array2 = explode(" ",$limite_follow_array[1]);
          /*hoy vs ayer +1*/
          /*echo "".date('d-m-Y H:i:s',strtotime(date('d-m-Y H:i:s')))."   ".date('d-m-Y H:i:s',strtotime($limite_follow_array[1]))."";*/
          if(strtotime(date('d-m-Y H:i:s'))>=strtotime($limite_follow_array[1]) || $limite_follow==""){
            if($limite_follow==""){
              $conn->query("UPDATE `limites_tw` SET `follow`='1|".date('d-m-Y H:i:s', strtotime('-1 minutes'))."' WHERE `id_token`='".$id_token."'");
              $seguidores_cont++;
            } else {
              if($limite_follow_array2[0]==date("d-m-Y")){
                if($limite_follow_array[0]<975 && ($tipo=="pro" || $tipo=="ent" || $tipo=="basic")){
                  $conn->query("UPDATE `limites_tw` SET `follow`='".($limite_follow_array[0]+1)."|".date('d-m-Y H:i:s', strtotime('-1 minutes'))."' WHERE `id_token`='".$id_token."'");
                  $seguidores_cont++;
                } else if ($limite_follow_array[0]<500){
                  $conn->query("UPDATE `limites_tw` SET `follow`='".($limite_follow_array[0]+1)."|".date('d-m-Y H:i:s', strtotime('-1 minutes'))."' WHERE `id_token`='".$id_token."'");
                  $seguidores_cont++;
                } else {
                  if($tipo=="pro" || $tipo=="ent" || $tipo=="basic"){
                    $message[] = $txt["txt518"];
                    $ids[$condsf] = "E".$d[1]."";
                  } else {
                    $message[] = $txt["txt497"];
                    $ids[$condsf] = "E".$d[1]."";
                  }
                } 
	      } else if(strtotime(date('d-m-Y H:i:s'))>strtotime($limite_follow_array[1].'+1 days')){
                $conn->query("UPDATE `limites_tw` SET `follow`='1|".date('d-m-Y H:i:s', strtotime('-1 minutes'))."' WHERE `id_token`='".$id_token."'");
                $seguidores_cont++;
              } else if(($limite_follow_array[0]<900 && ($tipo=="pro" || $tipo=="ent" || $tipo=="basic")) || ($limite_follow_array[0]<450 && ($tipo=="pro" || $tipo=="ent" || $tipo=="basic"))){ 
                /*Cuando hicieron falta por seguir hay que dejar que se sigan pero dejamos un intervalo y es diferente el día debido a la condicion $limite_follow_array2[0]==date("d-m-Y"*/
                $conn->query("UPDATE `limites_tw` SET `follow`='".($limite_follow_array[0]+1)."|".date('d-m-Y H:i:s', strtotime('-1 minutes'))."' WHERE `id_token`='".$id_token."'");
                $seguidores_cont++;
              } else {
                /*si no cumple tiempo*/  
                $message[] = "No puedes Seguir debido a que no has esperado el tiempo suficiente";
                $ids[$condsf] = "E".$d[1]."";
              }
            }
          } else {
            /*si no cumple tiempo*/  
            $message[] = "No puedes Seguir debido a que no has esperado el tiempo suficiente";
            $ids[$condsf] = "E".$d[1]."";
          }/*fin if tiempo*/

          if(count($message)==0){
          
            /*Tiempo de espera entre follows para que no bloqueen las apis medio segundo por follow*/
            usleep(600000);
            $status = $twitteroauth->post('friendships/create', array('screen_name' => ''.$d[0].''));
            //echo json_encode($status); 
            if($status->{'id'}){
              $seguidores++;
	      $archivo = fopen("usuarios/".$screen_name."/following.txt", "rb");
	      $contenido_seguidores = stream_get_contents($archivo);
	      $contenido_seguidores_array=explode("|",$contenido_seguidores);
	      fclose($archivo);
	      $archivo = fopen("usuarios/".$screen_name."/following.txt", "w+");
	      fwrite($archivo, "|".$status->id."");
	      foreach($contenido_seguidores_array as $item){
	        fwrite($archivo, "".$item."|");
	      }
	      fclose($archivo);

              //Black List
	      $archivo = fopen("usuarios/".$screen_name."/blacklist.txt", "rb");
	      $blacklist = stream_get_contents($archivo);
	      $blacklist_array=explode("\n",$blacklist);
	      fclose($archivo);
              $blacklist_key = array();    
              foreach($blacklist_array as $item){
                $blacklist_key["".$item.""] = 1; 
              }
	      $archivo = fopen("usuarios/".$screen_name."/blacklist.txt", "w+");  
              if(!isset($blacklist_key[$status->id])){
                fwrite($archivo, "".$status->id."\n");
              }
	      foreach($blacklist_array as $item){
	        fwrite($archivo, "".$item."\n");
	      }
	      fclose($archivo);
              /*fin post id*/
            } else {
              $ids[$condsf] = "E".$d[1]."";
              if($status->errors[0]->message)
                $message = json_encode($status->errors[0]->message);
              else
                $message = json_encode($status);
            }
          } else {
            /*Fin if $mensaje*/
          }
      } else {
        $error=1;
      }
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
  } else {
    $conn->close();
    echo $status;
}
?>