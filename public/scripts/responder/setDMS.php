<?PHP
ini_set('max_execution_time', 900000);
include ''.dirname(__FILE__).'/../../conexioni.php';
require("".dirname(__FILE__)."/../../twitter/twitteroauth/twitteroauth.php");
include ''.dirname(__FILE__).'/../../twitter/config-sample.php';
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

//Nueva función SDK v5
$fb = new Facebook\Facebook([
  'app_id' => $app_id,
  'app_secret' => $app_secret,
  'default_graph_version' => 'v2.2',
]);

$id_token = $_GET["id_token"];
//limite de mensajes
$limit = 2;
$query=$conn->query("SELECT * FROM token WHERE id='".$id_token."'") or die(mysqli_error($conn));
if($query->num_rows>0){
    $row = $query->fetch_assoc();
    $social_networks=$row["social_networks"];
    $social_networks_parts=explode(",",$social_networks);
	$c=0;
	$feed_array_escribir=[];
	//print_r($social_networks_parts);
	foreach($social_networks_parts as &$item){
	  unset($GETDM);
	  if($item!=""){
		  if($c==0){
			$query2=$conn->query("SELECT id,red,screen_name,foto,oauth_token,oauth_token_secret,access_token,identify FROM token 
								 WHERE identify='".substr($item,2,strlen($item))."' AND red='".$row["red"]."'") or die(mysqli_error($conn));
			$row2=$query2->fetch_assoc();
			//row2 sacar dms de la principal
			$id_token=$row2["id"];
			if($row2["red"]=="twitter"){
			  $werd = $conn->query("SELECT id_msg FROM mensajes WHERE identify_recipient='".$row2["identify"]."' AND red='twitter' ORDER by id_msg DESC LIMIT 1") or die(mysqli_error($conn));
			  $few = $werd->fetch_assoc();
			  $twitteroauth = new TwitterOAuth($consumer_key, $consumer_secret, $row2["oauth_token"], $row2["oauth_token_secret"]);
			  //obtener mensajes enviados de los usuarios.
			  $GETDM = $twitteroauth->get("https://api.twitter.com/1.1/direct_messages.json?count=".$limit."&since_id=".$few["id_msg"]."");
			  if(!$GETDM->errors && $GETDM[0]->id_str){
			    foreach($GETDM as $dm23){
				  $conn->query("INSERT INTO mensajes (id_token,id_msg,identify_sender,identify_recipient,screen_name,name,image_user,mensaje,fecha,red,pin,propietario_screen_name,propietario2_screen_name) VALUES ('".$id_token."','".$dm23->id_str."','".$dm23->sender->id_str."','".$dm23->recipient->id_str."','".mysqli_real_escape_string($conn,$dm23->sender->screen_name)."','".mysqli_real_escape_string($conn,$dm23->sender->name)."','".$dm23->sender->profile_image_url."','".mysqli_real_escape_string($conn,$dm23->text)."','".strtotime($dm23->created_at)."','twitter','0','".mysqli_real_escape_string($conn,$dm23->sender->screen_name)."','".$row2["screen_name"]."')") or die(mysqli_error($conn));
				}
			  } else if($GETDM->errors) {
				print_r($GETDM);
			  }
			  unset($GETDM);
			  //obtener mensajes enviados por auth user.
			  $GETDM = $twitteroauth->get("https://api.twitter.com/1.1/direct_messages/sent.json?count=".$limit."&since_id=".$few["id_msg"]."");
			  if(!$GETDM->errors && $GETDM[0]->id_str){
			    foreach($GETDM as $dm23){
				  $conn->query("INSERT INTO mensajes (id_token,id_msg,identify_sender,identify_recipient,screen_name,name,image_user,mensaje,fecha,red,pin,propietario,propietario_screen_name,propietario2_screen_name) VALUES ('".$id_token."','".$dm23->id_str."','".$dm23->recipient->id_str."','".$dm23->sender->id_str."','".mysqli_real_escape_string($conn,$dm23->recipient->screen_name)."','".mysqli_real_escape_string($conn,$dm23->recipient->name)."','".$dm23->recipient->profile_image_url."','".mysqli_real_escape_string($conn,$dm23->text)."','".strtotime($dm23->created_at)."','twitter','0','1','".mysqli_real_escape_string($conn,$dm23->sender->screen_name)."','".$row2["screen_name"]."')") or die(mysqli_error($conn));
				}
			  } else if($GETDM->errors) {
				print_r($GETDM);
			  }
			} else if($row2["red"]=="facebook"){
			  //las cuentas de perfil de facebook no se pueden sacar dms
			}
			$c++;
	        
			//fan pages while para sacar las fan pages de todas tus cuentas facebook secundarias
			$query3=$conn->query("SELECT tipo,perms,admin,red,name,identify,identify_account FROM social_share 
									   WHERE id_token='".$id_token."' AND tipo='page'") or die(mysqli_error($conn));
			
			unset($row2);	
							 
			if($query3->num_rows>0){
			  
			  while($row3=$query3->fetch_assoc()){
				//echo "empezo";
				/*los permisos deben de ser full admin para ver el inbox*/
				if($row3["admin"]==1){
					//echo "empezo con perm";
					$werd = $conn->query("SELECT fecha FROM mensajes WHERE identify_recipient='".$row3["identify"]."' AND red='facebook' ORDER by id DESC LIMIT 1") or die(mysqli_error($conn));
					$few = $werd->fetch_assoc();
					$fecha = "";
					if($few["fecha"]){
					  $fecha = explode("+",$few["fecha"]);
					  $fecha = $fecha[0];
					} else {
					  $fecha= "";
					}
					
					$query4=$conn->query("SELECT access_token FROM social_share WHERE identify='".$row3["identify"]."' AND red='facebook' order by id DESC") or die(mysqli_error($conn));
					$row4=$query4->fetch_assoc();
					$fb->setDefaultAccessToken($row4["access_token"]);
					// validating the access token
					try {
						$request = $fb->get(''.$row3["identify"].'/conversations?until='.$fecha.'&limit='.$limit.'');
					} catch(Facebook\Exceptions\FacebookResponseException $e) {
						// When Graph returns an error
						if ($e->getCode() == 190) {
							//unset($_SESSION['facebook_access_token']);
				
							//depricated v4.0
							//$facebook = new FacebookRedirectLoginHelper('http://bamboostr.com/system.php');
							//header('Location: '.$facebook->getLoginUrl($params).'&auth_type=reauthenticate');			
				
							//Nueva función SDK v5
							$helper = $fb->getRedirectLoginHelper();
							header('Location: '.$helper->getLoginUrl("http://bamboostr.com/reponder.php", $permissions).'');
							
						}
						exit;
					} catch(Facebook\Exceptions\FacebookSDKException $e) {
						// When validation fails or other local issues
						echo 'Facebook SDK returned an error: ' . $e->getMessage();
						exit;
					}
					//echo "no c";
					//print_r($request);
					$response = $request->getDecodedBody();
					//print_r($response);
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
                                    $conn->query("INSERT INTO mensajes (id_token,id_msg,identify_sender,identify_recipient,screen_name,name,image_user,mensaje,fecha,red,pin,propietario,propietario_screen_name,propietario2_screen_name) VALUES ('".$id_token."','".$id_message."','".$idSe."','".$idRe."','".mysqli_real_escape_string($conn,$name)."','".mysqli_real_escape_string($conn,$name)."','".$imageSe."','".mysqli_real_escape_string($conn,$mensaje)."','".strtotime($fecha)."','facebook','0','".$propietario."','".mysqli_real_escape_string($conn,$nameSe)."','".$row3["name"]."')") or die(mysqli_error($conn));
                                }
                                } /*fin foreach*/
                            } else {
                                //print_r($erewr);
                            }
                            }/*fin foreach*/
                            echo "<br /><br />Por Persona<br /><br />";
                        }/*fin foreach*/
                        }/*fin if*/
					$c++;
					//echo "termino2";
				} /*if perms*/
				//echo "fin perms";
			  } /*fin while*/
			  //echo "fin while";
			}/*fin if num_rows*/
			echo "<br />Termino Fan Pages<br />";
		  } else {
			  $query2=$conn->query("SELECT tok.id,tok.red,tok.foto,tok.screen_name,tok.oauth_token,tok.oauth_token_secret,tok.access_token,tok.identify 
								   FROM token AS tok INNER JOIN grupos AS gr 
								   ON  tok.identify='".substr($item,2,strlen($item))."'
								   AND tok.social_networks like ('%".$item."%')
								   AND gr.grupo='".$row["identify"]."'
								   AND gr.user='".substr($item,2,strlen($item))."'
								   AND gr.id_token='".$id_token."'");
			  unset($row2);					 
			  $row2=$query2->fetch_assoc();
			  //row2 sacar dms de la principal
				$id_token2=$row2["id"];
				if($row2["red"]=="twitter"){
				  $werd = $conn->query("SELECT id_msg FROM mensajes WHERE identify_recipient='".$row2["identify"]."' AND red='twitter' ORDER by id_msg DESC LIMIT 1") or die(mysqli_error($conn));
				  $few = $werd->fetch_assoc();
				  $twitteroauth = new TwitterOAuth($consumer_key, $consumer_secret, $row2["oauth_token"], $row2["oauth_token_secret"]);
				  //obtener mensajes enviados de los usuarios.
				  $GETDM = $twitteroauth->get("https://api.twitter.com/1.1/direct_messages.json?count=".$limit."&since_id=".$few["id_msg"]."");
				  if(!$GETDM->errors && $GETDM[0]->id_str){
					foreach($GETDM as $dm23){
					  $conn->query("INSERT INTO mensajes (id_token,id_msg,identify_sender,identify_recipient,screen_name,name,image_user,mensaje,fecha,red,pin,propietario_screen_name,propietario2_screen_name) VALUES ('".$id_token."','".$dm23->id_str."','".$dm23->sender->id_str."','".$dm23->recipient->id_str."','".mysqli_real_escape_string($conn,$dm23->sender->screen_name)."','".mysqli_real_escape_string($conn,$dm23->sender->name)."','".$dm23->sender->profile_image_url."','".mysqli_real_escape_string($conn,$dm23->text)."','".strtotime($dm23->created_at)."','twitter','0','".mysqli_real_escape_string($conn,$dm23->sender->screen_name)."','".$row2["screen_name"]."')") or die(mysqli_error($conn));
					}
				  } else if($GETDM->errors) {
					print_r($GETDM);
				  }
				  unset($GETDM);
				  //obtener mensajes enviados por auth user.
				  $GETDM = $twitteroauth->get("https://api.twitter.com/1.1/direct_messages/sent.json?count=".$limit."&since_id=".$few["id_msg"]."");
				  if(!$GETDM->errors && $GETDM[0]->id_str){
					foreach($GETDM as $dm23){
					  $conn->query("INSERT INTO mensajes (id_token,id_msg,identify_sender,identify_recipient,screen_name,name,image_user,mensaje,fecha,red,pin,propietario,propietario_screen_name,propietario2_screen_name) VALUES ('".$id_token."','".$dm23->id_str."','".$dm23->recipient->id_str."','".$dm23->sender->id_str."','".mysqli_real_escape_string($conn,$dm23->recipient->screen_name)."','".mysqli_real_escape_string($conn,$dm23->recipient->name)."','".$dm23->recipient->profile_image_url."','".mysqli_real_escape_string($conn,$dm23->text)."','".strtotime($dm23->created_at)."','twitter','0','1','".mysqli_real_escape_string($conn,$dm23->sender->screen_name)."','".$row2["screen_name"]."')") or die(mysqli_error($conn));
					}
				  } else if($GETDM->errors) {
					print_r($GETDM);
				  }
				} else if($row2["red"]=="facebook"){
				  //las cuentas de perfil de facebook no se pueden sacar dms
				}
			  $c++;	
		  }/*if $c==0*/
	  }/*fin if $item*/
	}/*fin foreach*/
	$conn->close();
	$obj = new stdclass();
    $obj->success = $feed_array_escribir;
    echo json_encode($obj);
} else {
  $conn->close();
  $obj = new stdclass();
  $obj->success = "false";
  echo json_encode($obj);
}
?>