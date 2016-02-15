<?PHP
session_start();
include ''.dirname(__FILE__).'/../scripts/detectLanguageExplorer.php';
include ''.dirname(__FILE__).'/../conexioni.php';

$access_token = $_GET["access_token"];
$secundaria = $_GET["secundaria"];

//PHP Version 5.4.34
include ''.dirname(__FILE__).'/../instagram/config-sample.php';
include ''.dirname(__FILE__).'/../instagram/instagram/src/Instagram.php';
use MetzWeb\Instagram\Instagram;
// initialize class

$instagram = new Instagram(array(
    'apiKey' => $CLIENT_ID,
    'apiSecret' => $CLIENT_SECRET,
    'apiCallback' => 'http://localhost' // must point to success.php
));

$instagram->setAccessToken($access_token);
$result = $instagram->getUser();
//$result = $instagram->getUserMedia();
/*
print_r($result);
print_r($result->data->username);
print_r($result->data->profile_picture);
print_r($result->data->full_name);
print_r($result->data->website);
print_r($result->data->id);
print_r($result->data->counts->followed_by);
print_r($result->data->counts->follows);
die();
*/

session_regenerate_id();

if($secundaria=="si"){
	$id_token = $_GET["id_token"];
	$user = $_GET["user"];
	$identify = $_GET["identify"];
    $red = $_GET["red"];
    if($user!=$result->data->full_name || $identify!=$result->data->id){
		
	  //si no es el mismo usuario
	  //agregamos usuario secundario a primario
	  $link = $result->data->website;
	  //Almacenar tokens en la base de datos
	  //insertar usuario
	  
	  $query = $conn->query("SELECT id FROM token WHERE identify='".$result->data->id."' AND red='instagram'") OR die("Error: ".mysqli_error($conn));
	  
	  if($query->num_rows>0){
		  $query2=$conn->query("UPDATE token SET expire_token=0, foto='".$result->data->profile_picture."', access_token='".$access_token."' WHERE identify='".$result->data->id."' AND red='instagram'") OR die("Error: ".mysqli_error($conn));
	  } else {
		$query2=$conn->query("INSERT INTO token (identify,social_networks,red,idioma,foto,screen_name_bamboostr,access_token,mail) VALUES ('".$result->data->id."','in".$result->data->id.",','instagram','".getUserLanguage()."','".$result->data->profile_picture."','".$result->data->full_name."','".$access_token."','')") OR die("Error: ".mysqli_error($conn));
                $query = $conn->query("SELECT id FROM token WHERE identify='".$result->data->id."' AND red='instagram'") OR die("Error: ".mysqli_error($conn));
                $row=$query->fetch_assoc();
                
                //Insert tutos
                $conn->query("INSERT INTO tutos (id_token) VALUES ('".$row['id']."')") OR die("Error: ".mysqli_error($conn));

                //notificacion de bienvenida en instagram no

          }
	  //agregar usuario
	  $query = $conn->query("SELECT id,social_networks,tipo FROM token WHERE id='".$id_token."' AND red='".$red."'") OR die("Error: ".mysqli_error($conn));
	  $row=$query->fetch_assoc();
	  $social_networks=$row["social_networks"];
	  $id_token=$row["id"];
	  $tipo=$row["tipo"];
	  if(strpos($social_networks, $result->data->id)===false){
		//si no está agrega nuevo usuario es necasaria la variable $red en social_networks para agregar cuentas secundarias en las primarias
	    $query2=$conn->query("UPDATE token SET social_networks='".$social_networks."in".$result->data->id.",' WHERE identify='".$identify."' AND red='".$red."'") OR die("Error: ".mysqli_error($conn));
		$query2=$conn->query("INSERT INTO grupos (user,grupo,id_token,tipo) VALUES ('".$result->data->id."','".$identify."','".$id_token."','".$tipo."')") OR die("Error: ".mysqli_error($conn));
		//estadisticas
		$query2=$conn->query("INSERT INTO estadisticas_facebook (id_token, identify_account, red, tipo) VALUES ('".$row["id"]."','".$result->data->id."','instagram','".$red."')") OR die("Error: ".mysqli_error($conn));
		 
		 /*estadisticas Instagram
		 $pages_names = ''.$pages_names.''.date('d-m-Y:H-i').'';
		 $query2=$conn->query("UPDATE estadisticas_facebook 
							  SET pages='".$contPage."|".date('d-m-Y:H-i').",',
								  pages_name='".$pages_names."'
							  WHERE identify='' 
							  AND identify_account='".$result->data->id."'
							  AND id_token='".$row['id']."'") OR DIE(mysqli_error($conn));
		*/
							  
		/*sacar id del nuevo usuario*/
		$query = $conn->query("SELECT id FROM token WHERE identify='".$result->data->id."' AND red='instagram'") OR die("Error: ".mysqli_error($conn));
	    $row3=$query->fetch_assoc();
		$obj = new stdclass();
		$obj->id_token = $row3["id"];
		$obj->user = $result->data->full_name;
		$obj->identify =$result->data->id;
		$obj->cuenta = "secundaria";
		echo json_encode($obj);
	  } else {
	    /* si si esta el usuario secundario... no agrega al usuario pero actualiza los grupos y pages
		 
		 $query2=$conn->query("UPDATE estadisticas_facebook 
							  SET pages='".$contPage."|".date('d-m-Y:H-i').",',
								  pages_name='".$pages_names."'
							  WHERE identify='' 
							  AND identify_account='".$result->data->id."'
							  AND id_token='".$row['id']."'") OR DIE(mysqli_error($conn));
		*/			  
	  }// fin else si si esta usuario secundario en primario
	} else {
	  //si es el mimso usuario
	  //actualizamos usuario primario NO BUG(porque siempre se cierra sesión al ingresar de nuevo desde una nueva ubicación en ingresar.php)
	  $user = $result->data->full_name;
	  $identify = $result->data->id;
	  $mail = "";
	  $link = $result->data->website;
	  //insertar SSID
	  $conn->query("INSERT INTO ssid (id_token,ssid,screen_name,fecha) 
					VALUES ('".$id_token."','APP".session_id()."','".$user."','".date('d-m-Y H:i')."') ") OR die("Error: ".mysqli_error($conn));
	  $conn->query("INSERT INTO ssid_story (id_token,ssid,screen_name,fecha) 
					VALUES ('".$id_token."','APP".session_id()."','".$user."','".date('d-m-Y H:i')."') ") OR die("Error: ".mysqli_error($conn));
	  
	  $user_image = $result->data->profile_picture;
	  $query = $conn->query("SELECT id FROM token WHERE identify='".$identify."' AND red='instagram'") OR die("Error: ".mysqli_error($conn));
	  if($query->num_rows>0){
	    $row=$query->fetch_assoc();
      	$id_token=$row["id"];
	    $query2=$conn->query("UPDATE token SET link='".$link."', ssid='APP".session_id()."', foto='".$user_image."', access_token='".$access_token."', mail='".$mail."' WHERE identify='".$identify."' AND red='instagram'") OR die("Error: ".mysqli_error($conn));

		 
		 /*estadisticas Instagram
		 $pages_names = ''.$pages_names.''.date('d-m-Y:H-i').'';
		 $query2=$conn->query("UPDATE estadisticas_facebook 
							  SET pages='".$contPage."|".date('d-m-Y:H-i').",',
								  pages_name='".$pages_names."'
							  WHERE identify='' 
							  AND identify_account='".$identify."'
							  AND id_token='".$row['id']."'") OR DIE(mysqli_error($conn));
		  */
	  }
	}
} else {
  echo "entro";
}
echo "entro2";

?>