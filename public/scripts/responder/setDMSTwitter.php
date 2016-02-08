<?PHP
ini_set('max_execution_time', 900000);
include ''.dirname(__FILE__).'/../../conexioni.php';
require("".dirname(__FILE__)."/../../twitter/twitteroauth/twitteroauth.php");
include ''.dirname(__FILE__).'/../../twitter/config-sample.php';
session_start();

$id_token = $_GET["id_token"];
$identify = $_GET["identify"];
//limite de mensajes
$limit = 10;
$query2=$conn->query("SELECT id,red,screen_name,foto,oauth_token,oauth_token_secret,access_token,identify FROM token WHERE identify='".$identify."' AND red='twitter'") or die(mysqli_error($conn));
if($query2->num_rows>0){
	$row2=$query2->fetch_assoc();
	//row2 sacar dms de la principal
	if($row2["red"]=="twitter"){
	  $werd = $conn->query("SELECT id_msg FROM mensajes WHERE id_token='".$id_token."' AND identify_recipient='".$row2["identify"]."' AND red='twitter' ORDER by id_msg DESC LIMIT 1") or die(mysqli_error($conn));
	  $few = $werd->fetch_assoc();
	  $twitteroauth = new TwitterOAuth($consumer_key, $consumer_secret, $row2["oauth_token"], $row2["oauth_token_secret"]);
	  //obtener mensajes enviados de los usuarios.
	  $GETDM = $twitteroauth->get("https://api.twitter.com/1.1/direct_messages.json?count=".$limit."&since_id=".$few["id_msg"]."");
	  if(!$GETDM->errors && $GETDM[0]->id_str){
		foreach($GETDM as $dm23){
          //busco si tiene pin o delete
          $weoir = $conn->query("SELECT `delete`,pin FROM mensajes WHERE id_token='".$id_token."' AND identify_recipient='".$dm23->recipient->id_str."' AND identify_sender='".$dm23->sender->id_str."' AND red='twitter'");
          $weoir2 = $weoir->fetch_assoc();
          if(!$weoir2["pin"])
            $weoir2["pin"] = 0;
          if(!$weoir2["delete"])
            $weoir2["delete"] = 0;
          //inserto
		  $conn->query("INSERT INTO mensajes (id_token,id_msg,identify_sender,identify_recipient,screen_name,name,image_user,mensaje,fecha,red,pin,`delete`,propietario_screen_name,propietario2_screen_name) VALUES ('".$id_token."','".$dm23->id_str."','".$dm23->sender->id_str."','".$dm23->recipient->id_str."','".mysqli_real_escape_string($conn,$dm23->sender->screen_name)."','".mysqli_real_escape_string($conn,$dm23->sender->name)."','".$dm23->sender->profile_image_url."','".mysqli_real_escape_string($conn,$dm23->text)."','".strtotime($dm23->created_at)."','twitter','".$weoir2["pin"]."','".$weoir2["delete"]."','".mysqli_real_escape_string($conn,$dm23->sender->screen_name)."','".$row2["screen_name"]."')") or die(mysqli_error($conn));
		}
	  } else if($GETDM->errors) {
		print_r($GETDM);
	  }
	  unset($GETDM);
	  //obtener mensajes enviados por auth user.
	  $GETDM = $twitteroauth->get("https://api.twitter.com/1.1/direct_messages/sent.json?count=".$limit."&since_id=".$few["id_msg"]."");
	  if(!$GETDM->errors && $GETDM[0]->id_str){
		foreach($GETDM as $dm23){
          //busco si tiene pin o delete
          $weoir = $conn->query("SELECT `delete`,pin FROM mensajes WHERE id_token='".$id_token."' AND identify_recipient='".$dm23->sender->id_str."' AND identify_sender='".$dm23->recipient->id_str."' AND red='twitter'");
          $weoir2 = $weoir->fetch_assoc();
          if(!$weoir2["pin"])
            $weoir2["pin"] = 0;
          if(!$weoir2["delete"])
            $weoir2["delete"] = 0;
          //inserto
		  $conn->query("INSERT INTO mensajes (id_token,id_msg,identify_sender,identify_recipient,screen_name,name,image_user,mensaje,fecha,red,pin,`delete`,propietario,propietario_screen_name,propietario2_screen_name) VALUES ('".$id_token."','".$dm23->id_str."','".$dm23->recipient->id_str."','".$dm23->sender->id_str."','".mysqli_real_escape_string($conn,$dm23->recipient->screen_name)."','".mysqli_real_escape_string($conn,$dm23->recipient->name)."','".$dm23->recipient->profile_image_url."','".mysqli_real_escape_string($conn,$dm23->text)."','".strtotime($dm23->created_at)."','twitter','".$weoir2["pin"]."','".$weoir2["delete"]."','1','".mysqli_real_escape_string($conn,$dm23->sender->screen_name)."','".$row2["screen_name"]."')") or die(mysqli_error($conn));
		}
	  } else if($GETDM->errors) {
		print_r($GETDM);
	  }
	}/*fin if red twitter*/
	$conn->close();
} else {
  $conn->close();
  $obj = new stdclass();
  $obj->success = "false";
  echo json_encode($obj);
}
?>