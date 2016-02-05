<?PHP
ini_set('max_execution_time', 900000);
include ''.dirname(__FILE__).'/../../conexioni.php';
include ''.dirname(__FILE__).'/../funciones.php';
session_start();
require_once(''.dirname(__FILE__).'/../../facebook-4.5/src/Facebook/config.php');
require_once(''.dirname(__FILE__).'/../../facebook-4.5/src/Facebook/autoload.php');
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;

$permissions = array(
	'scope' => 'user_about_me,user_activities,user_birthday,user_education_history,user_events,user_groups,user_hometown,user_interests,user_likes,user_location,user_photos,user_relationships,user_relationship_details,user_religion_politics,user_status,user_videos,user_website,email,manage_pages,read_stream,read_page_mailboxes,read_insights,ads_management,read_friendlists,publish_actions,public_profile,user_friends,read_mailbox,user_posts,ads_read,ads_management');

//Nueva funci贸n SDK v5
$fb = new Facebook\Facebook([
  'app_id' => $app_id,
  'app_secret' => $app_secret,
  'default_graph_version' => 'v2.2',
]);

$id_token = $_GET["id_token"];
$identify = $_GET["identify"];
$identify_sender = $_GET["identify_sender"];
//limite de mensajes
$limit = 2;
	        
//fan pages while para sacar las fan pages de todas tus cuentas facebook secundarias
$query3=$conn->query("SELECT tipo,perms,admin,red,name,identify,identify_account FROM social_share 
						   WHERE identify='".$identify."' AND tipo='page'") or die(mysqli_error($conn));
			
						 
if($query3->num_rows>0){
  
  while($row3=$query3->fetch_assoc()){
	//echo "empezo";
	/*los permisos deben de ser full admin para ver el inbox*/
	if($row3["admin"]==1){
		//echo "empezo con perm";
        if(!$identify_sender)
		  $werd = $conn->query("SELECT fecha FROM mensajes WHERE id_token='".$id_token."' && identify_recipient='".$row3["identify"]."' AND red='facebook' ORDER by id DESC LIMIT 1") or die(mysqli_error($conn));
		else {
          $werd = $conn->query("SELECT fecha FROM mensajes WHERE id_token='".$id_token."' && identify_recipient='".$row3["identify"]."' AND identify_sender='".$identify_sender."' AND red='facebook' ORDER by fecha DESC LIMIT 1") or die(mysqli_error($conn));  
        }
        $few = $werd->fetch_assoc();
		$fecha = "";
		if($few["fecha"]){
          $fecha = $few["fecha"];
          echo "<br /><br />Fecha: ".$fecha." ".date("d-m-Y H:i:s O",$few["fecha"])."<br /><br />";
		} else {
		  $fecha= "";
		}
		
		$query4=$conn->query("SELECT access_token FROM social_share WHERE identify='".$row3["identify"]."' AND red='facebook' order by id DESC") or die(mysqli_error($conn));
		$row4=$query4->fetch_assoc();
		$fb->setDefaultAccessToken($row4["access_token"]);
		// validating the access token
        //echo "".$row3["identify"]." ".$row4["access_token"]."";
		try {
            if(!$identify_sender){
              $request = $fb->get(''.$row3["identify"].'/conversations?until='.$fecha.'&limit='.$limit.''); 
            } else {
              $request = $fb->get(''.$row3["identify"].'/conversations?since='.$fecha.'');   
            }
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
			// When Graph returns an error
			if ($e->getCode() == 190) {
				//unset($_SESSION['facebook_access_token']);
	
				//depricated v4.0
				//$facebook = new FacebookRedirectLoginHelper('http://bamboostr.com/system.php');
				//header('Location: '.$facebook->getLoginUrl($params).'&auth_type=reauthenticate');
				//Nueva funci贸n SDK v5
				$helper = $fb->getRedirectLoginHelper();
				header('Location: '.$helper->getLoginUrl("http://".getDirUrl(1)."/reponder.php", $permissions).'');
				
			}
			exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
			// When validation fails or other local issues
			echo 'Facebook SDK returned an error: ' . $e->getMessage();
			exit;
		}
        //print_r($request);
		//echo "no c";
		//print_r($request);
		$response = $request->getDecodedBody();
		print_r($response);
		//echo "<br /><br />".$row3["identify"]."<br /><br />";
		if($response["data"][0]){
		  echo "<br /><br />Por Persona ".$fecha." ".$row3["identify"]."<br /><br />";
		  foreach($response["data"] as $r23rwe){
            $id_message = $r23rwe["id"];
            echo "<br /><br />ID: ".$r23rwe["id"]."";
			foreach($r23rwe as $erewr){ 
			  //<br /><br />Por opciones<br /><br />";
			  if($erewr["data"][0]["id"] && $erewr["data"][0]["created_time"] && $erewr["data"][0]["tags"]){
				foreach($erewr["data"] as $eewre2){
                  $id_msg = $eewre2["id"];
                  echo "<br /><br />ID: ".$eewre2["id"]."";
				  $idSe = "";
				  $propietario = 0;
				  $imageSe = "";
				  $nameSe = "Usuario de Facebook";
				  $idRe = "";
				  $imageRe = "";
				  $nameRe = "Usuario de Facebook";
				  $mensaje = "";
				  $fecha = "";
				  $fecha = $eewre2["created_time"];
				  $name = "Usuario de Facebook";
				  //print_r($eewre2);
				  echo "<br />Fecha: ".$eewre2["created_time"]."<br />";
				  $k=0;
				  foreach($eewre2 as $vnewoew){
					//print_r($vnewoew);
					if($k!=0 && $k!=1 && $k!=2){
					  if($vnewoew["name"] && $vnewoew["id"] && $k!=5){
						if($row3["identify"]==$vnewoew["id"]){
						  echo "Sender Name: ".$vnewoew["name"]." ID: ".$vnewoew["id"]."";
						  $imageSe = $row2["foto"];
						  $idRe = $vnewoew["id"];
						  $nameSe = $vnewoew["name"];
						  $propietario = 1;
						} else {
						  echo "Sender Name: ".$vnewoew["name"]." ID: ".$vnewoew["id"]."";
						  $imageSe = "images/fan-page.png";
						  $idSe = $vnewoew["id"];
						  $nameSe = $vnewoew["name"];
						  $name = $vnewoew["name"];
						}
					  }
					  if($vnewoew["data"][0]["name"] && $vnewoew["data"][0]["id"] && $k!=5){
						if($row3["identify"]==$vnewoew["data"][0]["id"]){
						  echo "Receptor Name: ".$vnewoew["data"][0]["name"]." ID: ".$vnewoew["data"][0]["id"]."";                             
						  $imageRe = $row2["foto"];
						  $idRe = $vnewoew["data"][0]["id"];
						  $nameRe = $vnewoew["data"][0]["name"];
						} else {
							  echo "Receptor Name: ".$vnewoew["data"][0]["name"]." ID: ".$vnewoew["data"][0]["id"]."";
						  $imageRe = "images/fan-page.png";
						  $idSe = $vnewoew["data"][0]["id"];
						  $nameRe = $vnewoew["data"][0]["name"];
						  $name = $vnewoew["data"][0]["name"];
						}
					  }
					  if($k==5){
						echo "Mensaje: ".$vnewoew."";
						$mensaje = $vnewoew;
					  }
					  if($vnewoew["data"][0]["link"] && $k==6){
						echo "Link: ".$vnewoew["data"][0]["link"]."";
						if(strpos(strtolower($vnewoew["data"][0]["link"]),".png")!==false || 
						   strpos(strtolower($vnewoew["data"][0]["link"]),".jpg")!==false ||
						   strpos(strtolower($vnewoew["data"][0]["link"]),".jpeg")!==false){
						  $mensaje = "".$mensaje." <img style='width: 25px;' src='".$vnewoew["data"][0]["link"]."' />";
						} else {
						  $mensaje = "".$mensaje." <a href='".$vnewoew["data"][0]["link"]."' />";
						}
					  }
					  if($vnewoew["data"][0]["picture"] && $k==6){
						$mensaje = "".$mensaje." <img src='".$vnewoew["data"][0]["picture"]."' />";
						echo "Link: ".$vnewoew["data"][0]["picture"]."";
					  }
					  //echo " Cont: ".$k." ";
					  echo "<br />";
					} /*fin $c*/
					$k++;
				  } /*fin foreach*/
				  //echo "<br /><br />Por mensaje<br /><br />";
				  if($mensaje!=""){
                    $edwe=$conn->query("SELECT id_msg FROM mensajes WHERE id_token='".$id_token."' && id_msg='".$id_msg."' AND red='facebook'") or die(mysqli_error($conn));
                    if($edwe->num_rows==0){
                      //busco si tiene pin o delete
                      $weoir = $conn->query("SELECT `delete`,pin FROM mensajes WHERE id_token='".$id_token."' AND identify_recipient='".$idRe."' AND identify_sender='".$idSe."' AND red='facebook'");
                      $weoir2 = $weoir->fetch_assoc();
                      if(!$weoir2["pin"])
                          $weoir2["pin"] = 0;
                      if(!$weoir2["delete"])
                          $weoir2["delete"] = 0;
					  $conn->query("INSERT INTO mensajes (id_token,id_msg,id_message,identify_sender,identify_recipient,screen_name,name,image_user,mensaje,fecha,red,pin,`delete`,propietario,propietario_screen_name,propietario2_screen_name) VALUES ('".$id_token."','".$id_msg."','".$id_message."','".$idSe."','".$idRe."','".mysqli_real_escape_string($conn,$name)."','".mysqli_real_escape_string($conn,$name)."','".$imageSe."','".mysqli_real_escape_string($conn,$mensaje)."','".strtotime($fecha)."','facebook','".$weoir2["pin"]."','".$weoir2["delete"]."','".$propietario."','".mysqli_real_escape_string($conn,$nameSe)."','".$row3["name"]."')") or die(mysqli_error($conn));
                      $obj = new stdclass();
                      $obj->success = "true";
                      echo json_encode($obj); 
                    } else {
                      $obj = new stdclass();
                      $obj->success = "false";
                      $obj->error = "ya existe el mensaje";
                      echo json_encode($obj); 
                    }
				  } else {
                     $obj = new stdclass();
                     $obj->success = "false";
                     $obj->error = "mensaje vacío";
                     echo json_encode($obj); 
                  }
				} /*fin foreach*/
			  } else {
				//print_r($erewr);
			  }
			}/*fin foreach*/
			echo "<br /><br />Por Persona<br /><br />";
		  }/*fin foreach*/
		}/*fin if*/
		//echo "termino2";
	} else {
      $conn->close();
      $obj = new stdclass();
      $obj->success = "false";
      $obj->error = "admin";
      echo json_encode($obj); 
    } /*if perms*/
	//echo "fin perms";
  } /*fin while*/
  //echo "fin while";
$conn->close();
} else {
  $conn->close();
  $obj = new stdclass();
  $obj->success = "false";
  echo json_encode($obj);
}
?>