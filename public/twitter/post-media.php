<?PHP
  ini_set('max_execution_time', 9000);
  include ''.dirname(__FILE__).'/../conexioni.php';
  require("".dirname(__FILE__)."/twitteroauth/twitteroauth.php");
  include ''.dirname(__FILE__).'/../scripts/funciones.php';
  session_start();
  // We've got everything we need
  // TwitterOAuth instance, with two new parameters we got in twitter_login.php
  include ''.dirname(__FILE__).'/config-sample.php';
  if($_GET["screen_name"]){
	  //si no hay credenciales en la url
	  $query = $conn->query("SELECT foto,id,oauth_token,oauth_token_secret FROM token WHERE screen_name='".$_GET["screen_name"]."'") OR die("Error: ".mysqli_error($conn));
	  if($query->num_rows>0){
	    $row=$query->fetch_assoc();
		$oauth_token = $row["oauth_token"];
        $oauth_token_secret = $row["oauth_token_secret"];
        $id = $row["id"];
        $foto123 = $row["foto"];
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
      $id_token=$_GET["id_token"];
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
      if(validar_propiedad($twitter,'errors')===false){
        //insertar a publicados
        $query3434 = $conn->query("INSERT INTO msg_publicados (id_token,name,identify,id_post,mensaje,images,link,fecha,horario,image_profile,red) VALUES ('".$id_token."','".$screen_name."','".$identify."','".$idPost."','".$description."','".$images."','".$link."','','','".$foto123."','twitter')") OR die("Error insert into msg_publicados: ".mysqli_error($conn)."");
      }
	  echo json_encode($twitter);
      $conn->close();
  } else {
    $conn->close();
    echo $status;
  }
?>