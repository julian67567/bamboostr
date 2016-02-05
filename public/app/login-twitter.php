<?PHP
/*
Para poder usar direct Messages en los tokens y permissions levels
Pon false el sign in with twitter en twitteroauth.php
function getAuthorizeURL($token, $sign_in_with_twitter = FALSE) {
	
Para forzar siempre que el usuario capture su username y password
Hay que usar siempre &force_login=true

return $this->authorizeURL() . "?oauth_token={$token}&force_login=true";
*/
include '../scripts/detectLanguageExplorer.php';
include '../conexioni.php';
$oauth_token = $_GET["oauth_token"];
$oauth_token_secret = $_GET["oauth_token_secret"];
$secundaria = $_GET["secundaria"];
session_regenerate_id();
//keys twitter
include '../twitter/config-sample.php';
require("../twitter/twitteroauth/twitteroauth.php");
//$_SESSION['rut']=$row['rut'];
//session_regenerate_id()
if($secundaria=="no"){
	// We've got everything we need
	// TwitterOAuth instance, with two new parameters we got in twitter_login.php
	if($oauth_token && $oauth_token_secret){
		//si hay credenciales en la url
		$twitteroauth = new TwitterOAuth($consumer_key, $consumer_secret, $oauth_token, $oauth_token_secret);
		//datos del usuario
		$user_info = $twitteroauth->get('account/verify_credentials'); 
		$user = $user_info->screen_name;
		$identify = $user_info->id_str;
		$user_image = $user_info->profile_image_url;
		//Almacenar tokens en la base de datos
		$query = $conn->query("SELECT id,ssid FROM token WHERE identify='".$user_info->id_str."' AND red='twitter'");
		if($query->num_rows>0){
		  //si existe usuario
		  //get id from token
		  $row=$query->fetch_assoc();
		  $id_token = $row["id"];

                  //insertar SSID
                  $conn->query("INSERT INTO ssid (id_token,ssid,screen_name,fecha) 
                                VALUES ('".$id_token."','APP".session_id()."','".$user."','".date('d-m-Y H:i')."') ");
                  $conn->query("INSERT INTO ssid_story (id_token,ssid,screen_name,fecha) 
                                VALUES ('".$id_token."','APP".session_id()."','".$user."','".date('d-m-Y H:i')."') ");

		  if($row["ssid"]==""){
		    //estadisticas
		    $query2=$conn->query("INSERT INTO estadisticas_twitter (id_token, identify, red, seguidores, siguiendo, mlistas, tweets, tusfavoritos) VALUES ('".$row["id"]."','".$user_info->id_str."','twitter','".$user_info->followers_count."|".date('d-m-Y:H-i').",','".$user_info->friends_count."|".date('d-m-Y:H-i').",','".$user_info->listed_count."|".date('d-m-Y:H-i').",','".$user_info->statuses_count."|".date('d-m-Y:H-i').",','".$user_info->favourites_count."|".date('d-m-Y:H-i').",')");
		  }// fin if ssid
		  $query2=$conn->query("UPDATE token SET expire_token=0, identify='".$user_info->id_str."', ssid='APP".session_id()."', foto='".$user_info->profile_image_url."', oauth_token='".$oauth_token."', oauth_token_secret='".$oauth_token_secret."', last_ssid='".date("d-m-Y")."' WHERE identify='".$user_info->id_str."' AND red='twitter'");
		} else { 
		  //si no existe usuario
		  $query2=$conn->query("INSERT INTO token (identify,red,ssid,foto,screen_name,oauth_token,oauth_token_secret,social_networks,idioma,first_ssid,last_ssid) VALUES ('".$user_info->id_str."','twitter','APP".session_id()."','".$user_info->profile_image_url."','".$user_info->screen_name."','".$oauth_token."','".$oauth_token_secret."','tw".$user_info->id_str.",','".getUserLanguage()."','".date("d-m-Y")."','".date("d-m-Y")."')");
		  
		  $query2 = $conn->query("SELECT id FROM token WHERE identify='".$user_info->id_str."' AND red='twitter'");
		  //get id from token NOTA: Antes no existe el id
		  $row=$query2->fetch_assoc();
		  $id_token = $row["id"];

                  //insert tutos
                  $conn->query("INSERT INTO tutos (id_token) VALUES ('".$id_token."')");

                  //insert limites twitter
                  $conn->query("INSERT INTO limites_tw (id_token) VALUES ('".$id_token."')");

                  //insert SSID
                  $conn->query("INSERT INTO ssid (id_token,ssid,screen_name,fecha) 
                                VALUES ('".$id_token."','APP".session_id()."','".$user."','".date('d-m-Y H:i')."') ");
                  $conn->query("INSERT INTO ssid_story (id_token,ssid,screen_name,fecha) 
                                VALUES ('".$id_token."','APP".session_id()."','".$user."','".date('d-m-Y H:i')."') ");
                  //insert rastreo
                  $conn->query("INSERT INTO rastreo_users (id_token) VALUES ('".$id_token."') ");

                  //notificacion de bienvenida
                  $bodyNot = 'Gracias por tu interés, estamos seguros que con bamboostr podrás utilizar tus Redes Sociales de la mejor manera para poder conseguir más clientes potenciales y hacer crecer tu negocio. <br /><br />Aquí encontrarás las herramientas necesarias para  posicionar tu marca en este importante canal, que día con día cobra mayor impacto. <br /><br />Para cualquier aclaración, duda o sugerencia escribanos en nuestras redes sociales o envíe un mensaje a soporte@bamboostr.com';
		  $conn->query("INSERT INTO notificaciones (id_token,receptor,titulo,mensaje,fecha,red) 
		              VALUES ('".$id_token."','".$identify."','Bienvenid@ a Bamboostr','".utf8_decode($bodyNot)."','".date("d-m-Y H:i")."','twitter')");

		  //estadisticas
		  $query2=$conn->query("INSERT INTO estadisticas_twitter (id_token, identify, red, seguidores, siguiendo, mlistas, tweets, tusfavoritos) VALUES ('".$row["id"]."','".$user_info->id_str."','twitter','".$user_info->followers_count."|".date('d-m-Y:H-i').",','".$user_info->friends_count."|".date('d-m-Y:H-i').",','".$user_info->listed_count."|".date('d-m-Y:H-i').",','".$user_info->statuses_count."|".date('d-m-Y:H-i').",','".$user_info->favourites_count."|".date('d-m-Y:H-i').",')");
		}
		$obj = new stdclass();
		$obj->id_token = $id_token;
		$obj->user = $user;
		$obj->identify = $identify;
                $obj->image_red = $user_image;
		$obj->cuenta = "primaria";
		echo json_encode($obj);
	} else {
	  $status = 'ERROR';
    }
} else {
  $id_token = $_GET["id_token"];
  $user = $_GET["user"];
  $identify = $_GET["identify"];
  $red = $_GET["red"];
  if($identify){
    //si hay credenciales en la url
    $twitteroauth = new TwitterOAuth($consumer_key, $consumer_secret, $oauth_token, $oauth_token_secret);
    //datos del usuario
    $user_info = $twitteroauth->get('account/verify_credentials');
	if($user_info){
	  //insertar nuevo usuario en un usuario primario
	  //Almacenar tokens en la base de datos
		$query = $conn->query("SELECT id FROM token WHERE identify='".$user_info->id_str."' AND red='twitter'");
		if($query->num_rows>0){
		  $query2=$conn->query("UPDATE token SET expire_token=0, foto='".$user_info->profile_image_url."', oauth_token='".$oauth_token."', oauth_token_secret='".$oauth_token_secret."' WHERE identify='".$user_info->id_str."' AND red='twitter'");
		} else {
		  $query2=$conn->query("INSERT INTO token (identify, social_networks,red, idioma, foto,screen_name,oauth_token,oauth_token_secret) VALUES ('".$user_info->id_str."','tw".$user_info->id_str.",','twitter','".getUserLanguage()."','".$user_info->profile_image_url."','".$user_info->screen_name."','".$oauth_token."','".$oauth_token_secret."')");
 
                  $query = $conn->query("SELECT id FROM token WHERE identify='".$user_info->id_str."' AND red='twitter'");
                  $row=$query->fetch_assoc();

                  //insert tutos
                  $conn->query("INSERT INTO tutos (id_token) VALUES ('".$row['id']."')");

                  //insert limites twitter
                  $conn->query("INSERT INTO limites_tw (id_token) VALUES ('".$row['id']."')");

                  //notificacion de bienvenida
                  $bodyNot = 'Gracias por tu interés, estamos seguros que con bamboostr podrás utilizar tus Redes Sociales de la mejor manera para poder conseguir más clientes potenciales y hacer crecer tu negocio. <br /><br />Aquí encontrarás las herramientas necesarias para  posicionar tu marca en este importante canal, que día con día cobra mayor impacto. <br /><br />Para cualquier aclaración, duda o sugerencia escribanos en nuestras redes sociales o envíe un mensaje a soporte@bamboostr.com';
		  $conn->query("INSERT INTO notificaciones (id_token,receptor,titulo,mensaje,fecha,red) 
		              VALUES ('".$row['id']."','".$user_info->id_str."','Bienvenid@ a Bamboostr','".utf8_decode($bodyNot)."','".date("d-m-Y H:i")."','twitter')");
		}
		//agregar usuario la variable $red en social_networks para agregar cuentas secundarias en las primarias
		$query = $conn->query("SELECT social_networks,id,tipo FROM token WHERE identify='".$identify."' AND red='".$red."'");
		$row=$query->fetch_assoc();
		$social_networks=$row["social_networks"];
		$id_token=$row["id"];
		$tipo=$row["tipo"];
		if(strpos($social_networks, $user_info->id_str)===false){
		  //si no está agrega nuevo usuario
		  $query2=$conn->query("UPDATE token SET social_networks='".$social_networks."tw".$user_info->id_str.",' WHERE identify='".$identify."' AND red='".$red."'");
		  $query2=$conn->query("INSERT INTO grupos (user,grupo,id_token,tipo) VALUES ('".$user_info->id_str."','".$identify."','".$id_token."','".$tipo."')");
		  //estadisticas
		  $query2=$conn->query("INSERT INTO estadisticas_twitter (id_token, identify, red, seguidores, siguiendo, mlistas, tweets, tusfavoritos) VALUES ('".$id_token."','".$user_info->id_str."','twitter','".$user_info->followers_count."|".date('d-m-Y:H-i').",','".$user_info->friends_count."|".date('d-m-Y:H-i').",','".$user_info->listed_count."|".date('d-m-Y:H-i').",','".$user_info->statuses_count."|".date('d-m-Y:H-i').",','".$user_info->favourites_count."|".date('d-m-Y:H-i').",')");
		}

                /*sacar id del nuevo usuario*/
		$query = $conn->query("SELECT id FROM token WHERE identify='".$user_info->id_str."' AND red='twitter'");
	        $row3=$query->fetch_assoc();

		$obj = new stdclass();
		$obj->id_token = $row3["id"];
		$obj->user = $user_info->screen_name;
		$obj->identify = $user_info->id_str;
		$obj->cuenta = "secundaria";
		echo json_encode($obj);
	}
	else{
	  $status = 'ERROR';
	}
  }
}
?>