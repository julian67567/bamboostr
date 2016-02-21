<?PHP
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
	  $query = $conn->query("SELECT tipo,oauth_token,oauth_token_secret FROM token WHERE screen_name='".$argv[1]."'") or die(mysqli_error($conn));
	  if($query->num_rows>0){
	    $row=$query->fetch_assoc();
		$oauth_token = $row["oauth_token"];
		$oauth_token_secret = $row["oauth_token_secret"];
	    //si hay credenciales en la url
        $twitteroauth = new TwitterOAuth($consumer_key, $consumer_secret, $oauth_token, $oauth_token_secret);
		$screen_name = $argv[1];
		$tipo = $row["tipo"];
		$status = 'OK';
	  }
	  else
	    $status = 'ERROR';
  } else {
    $status = 'ERROR';
  }
  if($status=="OK"){
        $conn->close();

    $keyA = array();

/***************************NOTFOLLOWINGMEBACK*************************************/
    if($argv[2]==1){
	//leemos fichero
	$archivo = fopen("usuarios/".$screen_name."/notfollowme.txt", "rb");
	$contenido = stream_get_contents($archivo);
	fclose($archivo);
	$contenido_array = explode("\n", $contenido);
	
	$archivo = fopen("usuarios/".$screen_name."/notfollowme.txt", "w+");
        $c=0;
	$quitar = 200;
        foreach($contenido_array as $item){
	  if($c<$quitar){
            $keyA["".$item.""] = 1;
	    $status = $twitteroauth->post('friendships/destroy', array('user_id' => $item));
	  } else {
	    fwrite($archivo, "".$item."\n");
	  }
	  $c++;
        }
	fclose($archivo);
	$archivo = fopen("usuarios/".$screen_name."/numnotfollowme.txt", "rb");
	$total = stream_get_contents($archivo);
	fclose($archivo);
	
	$archivo = fopen("usuarios/".$screen_name."/numnotfollowme.txt", "w+");
	if($total-$quitar<0) {
	  fwrite($archivo, "0");
	} else {
	  fwrite($archivo, "".$total-$quitar."");
	}
	fclose($archivo);

	//leemos fichero bots y eliminar eliminados
	$archivo = fopen("usuarios/".$screen_name."/bots.txt", "rb");
	$contenido = stream_get_contents($archivo);
	fclose($archivo);
	$contenido_array = explode("\n", $contenido);

        $archivo = fopen("usuarios/".$screen_name."/bots.txt", "w+");
        foreach($contenido_array as $item){
          if($keyA["".$item.""]!=1){
	    fwrite($archivo, "".$item."\n");
          }
        }
	fclose($archivo);

	//leemos fichero bots y eliminar eliminados
	$archivo = fopen("usuarios/".$screen_name."/inactivas.txt", "rb");
	$contenido = stream_get_contents($archivo);
	fclose($archivo);
	$contenido_array = explode("\n", $contenido);

        $archivo = fopen("usuarios/".$screen_name."/inactivas.txt", "w+");
        foreach($contenido_array as $item){
          if($keyA["".$item.""]!=1){
	    fwrite($archivo, "".$item."\n");
          }
        }
	fclose($archivo);

	//leemos fichero bots y eliminar eliminados
	$archivo = fopen("usuarios/".$screen_name."/image.txt", "rb");
	$contenido = stream_get_contents($archivo);
	fclose($archivo);
	$contenido_array = explode("\n", $contenido);

        $archivo = fopen("usuarios/".$screen_name."/image.txt", "w+");
        foreach($contenido_array as $item){
          if($keyA["".$item.""]!=1){
	    fwrite($archivo, "".$item."\n");
          }
        }
	fclose($archivo);

	//leemos fichero muestreo2 y eliminar eliminados
	$archivo = fopen("usuarios/".$screen_name."/muestreo2.txt", "rb");
	$contenido = stream_get_contents($archivo);
	fclose($archivo);
	$contenido_array = explode("\n", $contenido);

        $archivo = fopen("usuarios/".$screen_name."/muestreo2.txt", "w+");
        foreach($contenido_array as $item){
          $item2 = explode("|",$item);
          if($keyA["".$item2[0].""]!=1){
	    fwrite($archivo, "".$item."\n");
          }
        }
	fclose($archivo);
    }
/***************************BOTS*************************************/
    if($argv[2]==2){
	//leemos fichero
	$archivo = fopen("usuarios/".$screen_name."/bots.txt", "rb");
	$contenido = stream_get_contents($archivo);
	fclose($archivo);
	$contenido_array = explode("\n", $contenido);
	
	$archivo = fopen("usuarios/".$screen_name."/bots.txt", "w+");
        $c=0;
	$quitar = 200;
        foreach($contenido_array as $item){
	  if($c<$quitar){
            $keyA["".$item.""] = 1;
	    $status = $twitteroauth->post('friendships/destroy', array('user_id' => $item));
	  } else {
	    fwrite($archivo, "".$item."\n");
	  }
	  $c++;
        }
	fclose($archivo);

	//leemos fichero muestreo2 y eliminar eliminados
	$archivo = fopen("usuarios/".$screen_name."/muestreo2.txt", "rb");
	$contenido = stream_get_contents($archivo);
	fclose($archivo);
	$contenido_array = explode("\n", $contenido);

        $archivo = fopen("usuarios/".$screen_name."/muestreo2.txt", "w+");
        foreach($contenido_array as $item){
          $item2 = explode("|",$item);
          if($keyA["".$item2[0].""]!=1){
	    fwrite($archivo, "".$item."\n");
          }
        }
	fclose($archivo);

	//leemos fichero following y eliminar eliminados
	$archivo = fopen("usuarios/".$screen_name."/following.txt", "rb");
	$contenido = stream_get_contents($archivo);
	fclose($archivo);
	$contenido_array = explode("|", $contenido);

        $archivo = fopen("usuarios/".$screen_name."/following.txt", "w+");
        foreach($contenido_array as $item){
          if($keyA["".$item.""]!=1){
	    fwrite($archivo, "".$item."|");
          }
        }
	fclose($archivo);
    }
/***************************INACTIVAS*************************************/
    if($argv[2]==3){
	//leemos fichero
	$archivo = fopen("usuarios/".$screen_name."/inactivas.txt", "rb");
	$contenido = stream_get_contents($archivo);
	fclose($archivo);
	$contenido_array = explode("\n", $contenido);
	
	$archivo = fopen("usuarios/".$screen_name."/inactivas.txt", "w+");
        $c=0;
	$quitar = 200;
        foreach($contenido_array as $item){
	  if($c<$quitar){
            $keyA["".$item.""] = 1;
	    $status = $twitteroauth->post('friendships/destroy', array('user_id' => $item));
	  } else {
	    fwrite($archivo, "".$item."\n");
	  }
	  $c++;
        }
	fclose($archivo);

	//leemos fichero muestreo2 y eliminar eliminados
	$archivo = fopen("usuarios/".$screen_name."/muestreo2.txt", "rb");
	$contenido = stream_get_contents($archivo);
	fclose($archivo);
	$contenido_array = explode("\n", $contenido);

        $archivo = fopen("usuarios/".$screen_name."/muestreo2.txt", "w+");
        foreach($contenido_array as $item){
          $item2 = explode("|",$item);
          if($keyA["".$item2[0].""]!=1){
	    fwrite($archivo, "".$item."\n");
          }
        }
	fclose($archivo);

	//leemos fichero following y eliminar eliminados
	$archivo = fopen("usuarios/".$screen_name."/following.txt", "rb");
	$contenido = stream_get_contents($archivo);
	fclose($archivo);
	$contenido_array = explode("|", $contenido);

        $archivo = fopen("usuarios/".$screen_name."/following.txt", "w+");
        foreach($contenido_array as $item){
          if($keyA["".$item.""]!=1){
	    fwrite($archivo, "".$item."|");
          }
        }
	fclose($archivo);
    }
/***************************SIN IMAGEN DE PERFIL*************************************/
    if($argv[2]==4){
	//leemos fichero
	$archivo = fopen("usuarios/".$screen_name."/image.txt", "rb");
	$contenido = stream_get_contents($archivo);
	fclose($archivo);
	$contenido_array = explode("\n", $contenido);
	
	$archivo = fopen("usuarios/".$screen_name."/image.txt", "w+");
        $c=0;
	$quitar = 200;
        foreach($contenido_array as $item){
	  if($c<$quitar){
            $keyA["".$item.""] = 1;
	    $status = $twitteroauth->post('friendships/destroy', array('user_id' => $item));
	  } else {
	    fwrite($archivo, "".$item."\n");
	  }
	  $c++;
        }
	fclose($archivo);

	//leemos fichero muestreo2 y eliminar eliminados
	$archivo = fopen("usuarios/".$screen_name."/muestreo2.txt", "rb");
	$contenido = stream_get_contents($archivo);
	fclose($archivo);
	$contenido_array = explode("\n", $contenido);

        $archivo = fopen("usuarios/".$screen_name."/muestreo2.txt", "w+");
        foreach($contenido_array as $item){
          $item2 = explode("|",$item);
          if($keyA["".$item2[0].""]!=1){
	    fwrite($archivo, "".$item."\n");
          }
        }
	fclose($archivo);

	//leemos fichero following y eliminar eliminados
	$archivo = fopen("usuarios/".$screen_name."/following.txt", "rb");
	$contenido = stream_get_contents($archivo);
	fclose($archivo);
	$contenido_array = explode("|", $contenido);

        $archivo = fopen("usuarios/".$screen_name."/following.txt", "w+");
        foreach($contenido_array as $item){
          if($keyA["".$item.""]!=1){
	    fwrite($archivo, "".$item."|");
          }
        }
	fclose($archivo);
    }
    $obj = new stdclass();
    $obj->status = "success";
    echo json_encode($obj);
  } else {
    $conn->close();
    $obj = new stdclass();
    $obj->error = "false";
    echo json_encode($obj);
  }
?>