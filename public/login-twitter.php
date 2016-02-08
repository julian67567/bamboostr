<?PHP
/*
Para poder usar direct Messages en los tokens y permissions levels
Pon false el sign in with twitter en twitteroauth.php
function getAuthorizeURL($token, $sign_in_with_twitter = FALSE) {
	
Para forzar siempre que el usuario capture su username y password
Hay que usar siempre &force_login=true

return $this->authorizeURL() . "?oauth_token={$token}&force_login=true";
*/
include ''.dirname(__FILE__).'/conexioni.php';
include ''.dirname(__FILE__).'/scripts/funciones.php';
//keys twitter
include ''.dirname(__FILE__).'/twitter/config-sample.php';
require("".dirname(__FILE__)."/twitter/twitteroauth/twitteroauth.php");
//$_SESSION['rut']=$row['rut'];
//session_regenerate_id()
if(!$_SESSION['sessionid'] || !$_SESSION['user_bamboostr']){
	session_regenerate_id();
	$_SESSION['sessionid'] = session_id(); 
	// We've got everything we need
	// TwitterOAuth instance, with two new parameters we got in twitter_login.php
	if($_GET["oauth_verifier"] && $_SESSION['oauth_token'] && $_SESSION['oauth_token_secret']){
		//si hay credenciales en la url
		$twitteroauth = new TwitterOAuth($consumer_key, $consumer_secret, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
		//credenciales oauth token correctas
		$credentials = $twitteroauth->getAccessToken($_GET["oauth_verifier"]);
		//datos del usuario
		$user_info = $twitteroauth->get('account/verify_credentials'); 
		$_SESSION['user_bamboostr'] = $user_info->screen_name;
		$_SESSION['identify'] = $user_info->id_str;
		$_SESSION['user_image'] = $user_info->profile_image_url;
		$_SESSION['red'] = "twitter";
		//Almacenar tokens en la base de datos
		$query = $conn->query("SELECT foto_bamboostr,screen_name_bamboostr,id,ssid FROM token WHERE identify='".$user_info->id_str."' AND red='twitter'") OR DIE(mysqli_error($conn));
		if($query->num_rows>0){
		  //si existe usuario
		  //get id from token
		  $row=$query->fetch_assoc();
		  $_SESSION['id_token'] = $row["id"];
          $_SESSION['user_bamboostr'] = $row["screen_name_bamboostr"];
          $_SESSION['foto_bamboostr'] = $row["foto_bamboostr"];

                  //insertar SSID
                  $conn->query("INSERT INTO ssid (id_token,ssid,screen_name,fecha) 
                                VALUES ('".$_SESSION['id_token']."','".$_SESSION['sessionid']."','".$_SESSION['user_bamboostr']."','".date('d-m-Y H:i')."') ") OR DIE(mysqli_error($conn));
                  $conn->query("INSERT INTO ssid_story (id_token,ssid,screen_name,fecha) 
                                VALUES ('".$_SESSION['id_token']."','".$_SESSION['sessionid']."','".$_SESSION['user_bamboostr']."','".date('d-m-Y H:i')."') ") OR DIE(mysqli_error($conn));

		  if($row["ssid"]==""){
		    //estadisticas
		    $query2=$conn->query("INSERT INTO estadisticas_twitter (id_token, identify, red, seguidores, siguiendo, mlistas, tweets, tusfavoritos) VALUES ('".$row["id"]."','".$user_info->id_str."','twitter','".$user_info->followers_count."|".date('d-m-Y:H-i').",','".$user_info->friends_count."|".date('d-m-Y:H-i').",','".$user_info->listed_count."|".date('d-m-Y:H-i').",','".$user_info->statuses_count."|".date('d-m-Y:H-i').",','".$user_info->favourites_count."|".date('d-m-Y:H-i').",')") OR DIE(mysqli_error($conn));
		  }// fin if ssid
		  $query2=$conn->query("UPDATE token SET expire_token=0, identify='".$user_info->id_str."', ssid='".$_SESSION['sessionid']."', foto='".$user_info->profile_image_url."', oauth_token='".$credentials['oauth_token']."', oauth_token_secret='".$credentials['oauth_token_secret']."', last_ssid='".date("d-m-Y")."' WHERE identify='".$user_info->id_str."' AND red='twitter'") OR DIE(mysqli_error($conn));
		header('Location: http://'.getDirUrl(1).'/system.php');
		} else { 
          //si no existe usuario
          $userRand = ''.rand(1000000000,9999999999).''.$_SESSION['user_bamboostr'].'';
          $passRand = rand(1000000000,9999999999);
		  //si no existe usuario
		  $query2=$conn->query("INSERT INTO token (identify,red,ssid,foto,screen_name,password,screen_name_bamboostr,oauth_token,oauth_token_secret,social_networks,idioma,first_ssid,last_ssid) VALUES ('".$user_info->id_str."','twitter','".$_SESSION['sessionid']."','".$user_info->profile_image_url."','".$userRand."','".encriptar($passRand)."','".$user_info->screen_name."','".$credentials['oauth_token']."','".$credentials['oauth_token_secret']."','tw".$user_info->id_str.",','".getUserLanguage()."','".date("d-m-Y")."','".date("d-m-Y")."')") OR DIE(mysqli_error($conn));
		  
		  $query2 = $conn->query("SELECT foto_bamboostr,screen_name_bamboostr,id FROM token WHERE identify='".$user_info->id_str."' AND red='twitter'") OR DIE(mysqli_error($conn));
		  //get id from token NOTA: Antes no existe el id
		  $row=$query2->fetch_assoc();
		  $_SESSION['id_token'] = $row["id"];
          $_SESSION['user_bamboostr'] = $row["screen_name_bamboostr"];
          $_SESSION['foto_bamboostr'] = $row["foto_bamboostr"];
          
                  //mandar mail de contraseña
                $conn->query("INSERT INTO queue_mail (id_token,titulo,mensaje,prioridad) VALUES ('".$_SESSION['id_token']."','Bamboostr: datos de acceso','<br /><br />Muchas Felicidades por registrarte en bamboostr.<br /><br /><center><img src=http://bamboostr.com/images/congrats.png /><br /><br />Te enviamos tus datos de acceso: User: ".$userRand." <br />Pass: ".$passRand."</center><br /><br />','1')") OR DIE(mysqli_error($conn));
          
                  //insert tutos
                  $conn->query("INSERT INTO tutos (id_token) VALUES ('".$_SESSION['id_token']."')") OR DIE(mysqli_error($conn));

                  //insert limites twitter
                  $conn->query("INSERT INTO limites_tw (id_token) VALUES ('".$_SESSION['id_token']."')") OR DIE(mysqli_error($conn));

                  //insert SSID
                  $conn->query("INSERT INTO ssid (id_token,ssid,screen_name,fecha) 
                                VALUES ('".$_SESSION['id_token']."','".$_SESSION['sessionid']."','".$_SESSION['user_bamboostr']."','".date('d-m-Y H:i')."') ") OR DIE(mysqli_error($conn));
                  $conn->query("INSERT INTO ssid_story (id_token,ssid,screen_name,fecha) 
                                VALUES ('".$_SESSION['id_token']."','".$_SESSION['sessionid']."','".$_SESSION['user_bamboostr']."','".date('d-m-Y H:i')."') ") OR DIE(mysqli_error($conn));
                  //insert rastreo
                  $conn->query("INSERT INTO rastreo_users (id_token) VALUES ('".$_SESSION['id_token']."') ") OR DIE(mysqli_error($conn));

                  //notificacion de bienvenida
                  $bodyNot = 'Gracias por tu interés, estamos seguros que con bamboostr podrás utilizar tus Redes Sociales de la mejor manera para poder conseguir más clientes potenciales y hacer crecer tu negocio. <br /><br />Aquí encontrarás las herramientas necesarias para  posicionar tu marca en este importante canal, que día con día cobra mayor impacto. <br /><br />Para cualquier aclaración, duda o sugerencia escribanos en nuestras redes sociales o envíe un mensaje a soporte@bamboostr.com';
		          $conn->query("INSERT INTO notificaciones (id_token,receptor,titulo,mensaje,fecha,red,tipo) 
		              VALUES ('".$_SESSION['id_token']."','".$_SESSION['identify']."','Bienvenid@ a Bamboostr','".utf8_decode($bodyNot)."','".date("d-m-Y H:i")."','twitter','mensaje')") OR DIE(mysqli_error($conn));

		  //estadisticas
		  $query2=$conn->query("INSERT INTO estadisticas_twitter (id_token, identify, red, seguidores, siguiendo, mlistas, tweets, tusfavoritos) VALUES ('".$row["id"]."','".$user_info->id_str."','twitter','".$user_info->followers_count."|".date('d-m-Y:H-i').",','".$user_info->friends_count."|".date('d-m-Y:H-i').",','".$user_info->listed_count."|".date('d-m-Y:H-i').",','".$user_info->statuses_count."|".date('d-m-Y:H-i').",','".$user_info->favourites_count."|".date('d-m-Y:H-i').",')") OR DIE(mysqli_error($conn));
		header('Location: http://'.getDirUrl(1).'/system.php?action=newUser');
		}
		$status = 'OK';
	} else {
	  $status = 'ERROR';
    }
} else {
  if($_SESSION['identify'] && !$_GET["denied"] && $_GET["oauth_verifier"]){
    //si hay credenciales en la url
    $twitteroauth = new TwitterOAuth($consumer_key, $consumer_secret, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
    //credenciales oauth token correctas
    $credentials = $twitteroauth->getAccessToken($_GET["oauth_verifier"]);
    //datos del usuario
    $user_info = $twitteroauth->get('account/verify_credentials');
	if($user_info){
	  //insertar nuevo usuario en un usuario primario
	  //Almacenar tokens en la base de datos
		$query = $conn->query("SELECT id FROM token WHERE identify='".$user_info->id_str."' AND red='twitter'") OR DIE(mysqli_error($conn));
		if($query->num_rows>0){
		  $query2=$conn->query("UPDATE token SET expire_token=0, foto='".$user_info->profile_image_url."', oauth_token='".$credentials['oauth_token']."', oauth_token_secret='".$credentials['oauth_token_secret']."' WHERE identify='".$user_info->id_str."' AND red='twitter'") OR DIE(mysqli_error($conn));
		} else {
		  $query2=$conn->query("INSERT INTO token (identify, social_networks,red, idioma,foto,screen_name_bamboostr,oauth_token,oauth_token_secret) VALUES ('".$user_info->id_str."','tw".$user_info->id_str.",','twitter','".getUserLanguage()."','".$user_info->profile_image_url."','".$user_info->screen_name."','".$credentials['oauth_token']."','".$credentials['oauth_token_secret']."')") OR DIE(mysqli_error($conn));
 
                  $query = $conn->query("SELECT id FROM token WHERE identify='".$user_info->id_str."' AND red='twitter'") OR DIE(mysqli_error($conn));
                  $row=$query->fetch_assoc();

                  //insert tutos
                  $conn->query("INSERT INTO tutos (id_token) VALUES ('".$row['id']."')") OR DIE(mysqli_error($conn));

                  //insert limites twitter
                  $conn->query("INSERT INTO limites_tw (id_token) VALUES ('".$row['id']."')") OR DIE(mysqli_error($conn));

                  //notificacion de bienvenida
                  $bodyNot = 'Gracias por tu interés, estamos seguros que con bamboostr podrás utilizar tus Redes Sociales de la mejor manera para poder conseguir más clientes potenciales y hacer crecer tu negocio. <br /><br />Aquí encontrarás las herramientas necesarias para  posicionar tu marca en este importante canal, que día con día cobra mayor impacto. <br /><br />Para cualquier aclaración, duda o sugerencia escribanos en nuestras redes sociales o envíe un mensaje a soporte@bamboostr.com';
		  $conn->query("INSERT INTO notificaciones (id_token,receptor,titulo,mensaje,fecha,red,tipo) 
		              VALUES ('".$row['id']."','".$user_info->id_str."','Bienvenid@ a Bamboostr','".utf8_decode($bodyNot)."','".date("d-m-Y H:i")."','twitter','mensaje')") OR DIE(mysqli_error($conn));
		}
		//agregar usuario la variable $red en social_networks para agregar cuentas secundarias en las primarias
		$query = $conn->query("SELECT social_networks,id,tipo FROM token WHERE identify='".$_SESSION['identify']."' AND red='".$_SESSION['red']."'") OR DIE(mysqli_error($conn));
		$row=$query->fetch_assoc();
		$social_networks=$row["social_networks"];
		$id_token=$row["id"];
		$tipo=$row["tipo"];
		if(strpos($social_networks, $user_info->id_str)===false){
		  //si no está agrega nuevo usuario
		  $query2=$conn->query("UPDATE token SET social_networks='".$social_networks."tw".$user_info->id_str.",' WHERE identify='".$_SESSION['identify']."' AND red='".$_SESSION['red']."'") OR DIE(mysqli_error($conn));
		  $query2=$conn->query("INSERT INTO grupos (user,grupo,id_token,tipo) VALUES ('".$user_info->id_str."','".$_SESSION['identify']."','".$id_token."','".$tipo."')") OR DIE(mysqli_error($conn));
		  //estadisticas
		  $query2=$conn->query("INSERT INTO estadisticas_twitter (id_token, identify, red, seguidores, siguiendo, mlistas, tweets, tusfavoritos) VALUES ('".$id_token."','".$user_info->id_str."','twitter','".$user_info->followers_count."|".date('d-m-Y:H-i').",','".$user_info->friends_count."|".date('d-m-Y:H-i').",','".$user_info->listed_count."|".date('d-m-Y:H-i').",','".$user_info->statuses_count."|".date('d-m-Y:H-i').",','".$user_info->favourites_count."|".date('d-m-Y:H-i').",')") OR DIE(mysqli_error($conn));
		}
		if($_SESSION['identify'] && $_SESSION['sessionid'])
	          header('Location: http://'.getDirUrl(1).'/system.php');
		$status = 'OK';
	}
	else{
	  $status = 'ERROR';
	}
  }
  else if($_SESSION['identify']){
    $query = $conn->query("SELECT ssid FROM ssid WHERE id_token='".$_SESSION['id_token']."'") OR DIE(mysqli_error($conn));
    if($query->num_rows>0){
      while($row=$query->fetch_assoc()){
        $ssid = $row["ssid"];
        if($ssid==$_SESSION["sessionid"] && $_SESSION["sessionid"]){
          //si no hay credenciales en la url, pero si ssid
	  $query2 = $conn->query("SELECT oauth_token,oauth_token_secret FROM token WHERE identify='".$_SESSION['identify']."' AND red='twitter'") OR DIE(mysqli_error($conn));
	  if($query2->num_rows>0){
	    $row=$query2->fetch_assoc();
	    $oauth_token = $row["oauth_token"];
	    $oauth_token_secret = $row["oauth_token_secret"];
	    $status = 'OK';
            //si hay credenciales en la url
	    $twitteroauth = new TwitterOAuth($consumer_key, $consumer_secret, $oauth_token, $oauth_token_secret);
	    break;
	  } else {
	    $status = 'ERROR';
          }
        } else {
          $status = 'ERROR';
        }
      }
    } else {
      $status = 'ERROR';
    }  
  } else {
    $status = 'ERROR';
  }
}
?>