<?PHP
session_start();
include ''.dirname(__FILE__).'/../scripts/detectLanguageExplorer.php';
include ''.dirname(__FILE__).'/../conexioni.php';
//PHP Version 5.4.34
require_once(''.dirname(__FILE__).'/../facebook/src/Facebook/config.php');
require_once(''.dirname(__FILE__).'/../facebook/autoload.php');
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
FacebookSession::setDefaultApplication($app_id, $app_secret);

$access_token = $_GET["access_token"];
$secundaria = $_GET["secundaria"];
session_regenerate_id();
$session = new FacebookSession($access_token);
try {
    $session->validate($app_id, $app_secret);
} catch (FacebookRequestException $ex) {
  // Session not valid, Graph API returned an exception with the reason.
  echo $ex->getMessage();
  $error = 1;
} catch (\Exception $ex) {
  // Graph API returned info, but it may mismatch the current app or have expired.
  echo $ex->getMessage();
  $error = 1;
}  

if($error!=1) {
  if($secundaria=="no"){
	//Obtiene perfil
	$request = new FacebookRequest($session, 'GET', '/me');
    $response = $request->execute();
    // get response
    $graphObject = $response->getGraphObject();
    $user = $graphObject->getProperty('name');
	$identify = $graphObject->getProperty('id');
	$mail = $graphObject->getProperty('email');
	$red = "facebook";
	$link = $graphObject->getProperty('link');
	//Obtiene imágenes de perfil
	$request = new FacebookRequest($session, 'GET', '/me/picture',
	array (
     'redirect' => false,
     'height' => '48',
     'type' => 'normal',
     'width' => '48',
    ));
    $response = $request->execute();
    // get response
    $graphObject = $response->getGraphObject();
	$user_image = $graphObject->getProperty('url');
	//Almacenar tokens en la base de datos
	$query = $conn->query("SELECT id,ssid,social_networks FROM token WHERE identify='".$identify."' AND red='facebook'") OR DIE(mysqli_error($conn));
	if($query->num_rows>0){
	  //si existe usuario
	  //get id from token
	  $row2=$query->fetch_assoc();
	  $id_token = $row2["id"];
	  $social_net123 = $row2["social_networks"];

          //insertar SSID
          $conn->query("INSERT INTO ssid (id_token,ssid,screen_name,fecha) 
                        VALUES ('".$id_token."','APP".session_id()."','".$user."','".date('d-m-Y H:i')."') ") OR DIE(mysqli_error($conn));
          $conn->query("INSERT INTO ssid_story (id_token,ssid,screen_name,fecha) 
                        VALUES ('".$id_token."','APP".session_id()."','".$user."','".date('d-m-Y H:i')."') ") OR DIE(mysqli_error($conn));

	  if($row2["ssid"]==""){
		  //estadisticas
		  $query2=$conn->query("INSERT INTO estadisticas_facebook (id_token, identify_account, red, tipo) 
                                        VALUES ('".$row2["id"]."','".$identify."','facebook','facebook') ") OR DIE(mysqli_error($conn));
                  /*
                  // get groups
		  $request = new FacebookRequest($session, 'GET', '/me/groups');
			$response = $request->execute();
			$groups = $response->getGraphObject();
			$contGroup = 0;
			$groups_names = "";
			if($groups->getProperty('data')){
				foreach($groups->getProperty('data')->asArray() as $item){
				  $groups_names = ''.$groups_names.''.str_replace(',', '', str_replace('|', '', $item->name)).'|'.$item->id.',';
				  if($item->administrator==true)
					$adminGroup = 1;
				  else
					$adminGroup = 0;
				  $query2=$conn->query("INSERT INTO social_share (identify_account,id_token,perms,identify,name,admin,tipo,red) VALUES ('".$identify."','".$row2['id']."','".$item->perms."','".$item->id."','".$item->name."','".$adminGroup."','grupo','facebook')") OR DIE(mysqli_error($conn));
				  
				  //estadisticas
		          //$query2=$conn->query("INSERT INTO estadisticas_facebook (id_token, identify_account, identify, red, tipo) 
		          //VALUES ('".$row2["id"]."','".$identify."','".$item->id."','facebook','grupo')") OR DIE(mysqli_error($conn));
				  
				  $contGroup++;
				 } //fin foreach
			 }  //fin if
			 //estadisticas Total Group
			 $groups_names = ''.$groups_names.''.date('d-m-Y:H-i').'';
			 $query2=$conn->query("UPDATE estadisticas_facebook 
								  SET groups='".$contGroup."|".date('d-m-Y:H-i').",',
								      groups_name='".$groups_names."'
								  WHERE identify='' 
								  AND identify_account='".$identify."'
								  AND id_token='".$row2['id']."'") OR DIE(mysqli_error($conn));
                   */
                         // get pages
			 $request = new FacebookRequest($session, 'GET', '/me/accounts');
			 $response = $request->execute();
			 // get pages
			 $pages = $response->getGraphObject();
			 $contPage = 0;
			 $pages_names = "";
			 if($pages->getProperty('data')){
				 foreach($pages->getProperty('data')->asArray() as $item){
				   $pages_names = ''.$pages_names.''.str_replace(',', '', str_replace('|', '', $item->name)).'|'.$item->id.',';
				   $perms="";
				   $c=0;
				   $adminGroup = 0;
				   foreach($item->perms as $item2){
					 $perms = ''.$perms.''.$item2.','; 
					 if($item2=="ADMINISTER" && $c==0)
					   $adminGroup = 1;
					 else if($c==0)
					   $adminGroup = 0;
					 $c++;
				   }
		           
				   /*insertamos*/
				   $query2=$conn->query("INSERT INTO social_share (identify_account,id_token,access_token,perms,identify,name,admin,tipo,red) VALUES ('".$identify."','".$row2['id']."','".$item->access_token."','".$perms."','".$item->id."','".$item->name."','".$adminGroup."','page','facebook')") OR DIE(mysqli_error($conn));
				   //estadisticas
		          $query2=$conn->query("INSERT INTO estadisticas_facebook (id_token, identify_account, identify, red, tipo) VALUES ('".$row2["id"]."','".$identify."','".$item->id."','facebook','page')") OR DIE(mysqli_error($conn));
				  $contPage++;
				 }//fin foreach
			 }//fin if
			 //estadisticas Total Page
			 $pages_names = ''.$pages_names.''.date('d-m-Y:H-i').'';
			 $query2=$conn->query("UPDATE estadisticas_facebook 
								  SET pages='".$contPage."|".date('d-m-Y:H-i').",',
								      pages_name='".$pages_names."'
								  WHERE identify='' 
								  AND identify_account='".$identify."'
								  AND id_token='".$row2['id']."'") OR DIE(mysqli_error($conn));
	  }// fin if ssid
	
	  //si si está, actualiza la info del usuario y le actualiza sus grupos y fan pages y notificación de bienvenida!.
	  $query2=$conn->query("UPDATE token SET expire_token=0, ssid='APP".session_id()."', foto='".$user_image."', access_token='".$access_token."', mail='".$mail."', link='".$link."', last_ssid='".date("d-m-Y")."' WHERE identify='".$identify."' AND red='facebook'") OR DIE(mysqli_error($conn));
	  
	  //actualizar last_ssid de todas las social_networks.
	  $social_net123=explode(",",$social_net123);
	  foreach($social_net123 as $item5){
	    if($item5!=""){
		  if(substr($item5,0,2)=="tw"){
		    $query2=$conn->query("UPDATE token SET last_ssid='".date("d-m-Y")."' WHERE identify='".substr($item5,2,strlen($item5))."' AND red='twitter'") OR DIE(mysqli_error($conn));
		  } else if(substr($item5,0,2)=="fa"){
			$query2=$conn->query("UPDATE token SET last_ssid='".date("d-m-Y")."' WHERE identify='".substr($item5,2,strlen($item5))."' AND red='facebook'") OR DIE(mysqli_error($conn));
		  } else if(substr($item5,0,2)=="in"){
			$query2=$conn->query("UPDATE token SET last_ssid='".date("d-m-Y")."' WHERE identify='".substr($item5,2,strlen($item5))."' AND red='instagram'") OR DIE(mysqli_error($conn));
		  }
		}
	  }/*fin foreach*/
	} else {
        //si no existe el usuario
		//si no esta, inserta al usuario en la bd y le agrega sus grupos y fan pages
		$query2=$conn->query("INSERT INTO token (identify,link,red,ssid,foto,screen_name_bamboostr,access_token,social_networks,idioma,mail,first_ssid,last_ssid) VALUES ('".$identify."','".$link."','facebook','APP".session_id()."','".$user_image."','".$user."','".$access_token."','fa".$identify.",','".getUserLanguage()."','".$mail."','".date("d-m-Y")."','".date("d-m-Y")."')") OR DIE(mysqli_error($conn));
		
		$query2 = $conn->query("SELECT id FROM token WHERE identify='".$identify."' AND red='facebook'") OR DIE(mysqli_error($conn));
		//get id from token NOTA: Antes no existe el id
		$row2=$query2->fetch_assoc();
		$id_token = $row2["id"];

                //Insert tutos
                $conn->query("INSERT INTO tutos (id_token) VALUES ('".$id_token."')") OR DIE(mysqli_error($conn));

                //insert SSID
                $conn->query("INSERT INTO ssid (id_token,ssid,screen_name,fecha) 
                              VALUES ('".$id_token."','APP".session_id()."','".$user."','".date('d-m-Y H:i')."') ") OR DIE(mysqli_error($conn));
                $conn->query("INSERT INTO ssid_story (id_token,ssid,screen_name,fecha) 
                              VALUES ('".$id_token."','APP".session_id()."','".$user."','".date('d-m-Y H:i')."') ") OR DIE(mysqli_error($conn));
                //insert rastreo
                $conn->query("INSERT INTO rastreo_users (id_token) VALUES ('".$id_token."') ") OR DIE(mysqli_error($conn));
		
		//notificacion de bienvenida
                $bodyNot = 'Gracias por tu interés, estamos seguros que con bamboostr podrás utilizar tus Redes Sociales de la mejor manera para poder conseguir más clientes potenciales y hacer crecer tu negocio. <br /><br />Aquí encontrarás las herramientas necesarias para  posicionar tu marca en este importante canal, que día con día cobra mayor impacto. <br /><br />Para cualquier aclaración, duda o sugerencia escribanos en nuestras redes sociales o envíe un mensaje a soporte@bamboostr.com';

                $bodyNot2 = 'Gracias por tu interés, estamos seguros que con bamboostr podrás utilizar tus Redes Sociales de la mejor manera para poder conseguir más clientes potenciales y hacer crecer tu negocio. <br /><br />Aquí encontrarás las herramientas necesarias para  posicionar tu marca en este importante canal, que día con día cobra mayor impacto. <br /><br />Para cualquier aclaración, duda o sugerencia escribanos en nuestras redes sociales o envíe un mensaje a soporte@bamboostr.com';

		$conn->query("INSERT INTO notificaciones (id_token,receptor,titulo,mensaje,fecha,red) 
		              VALUES ('".$id_token."','".$identify."','Bienvenido a Bamboostr','".utf8_decode($bodyNot)."','".date("d-m-Y H:i")."','facebook')") OR DIE(mysqli_error($conn));
                $conn->query("INSERT INTO queue_mail (id_token,titulo,mensaje,prioridad) VALUES ('".$id_token."','Bienvenido a Bamboostr','".utf8_decode($bodyNot2)."','5')") OR DIE(mysqli_error($conn));
		
		//estadisticas
		$query2=$conn->query("INSERT INTO estadisticas_facebook (id_token, identify_account, red, tipo) VALUES ('".$row2["id"]."','".$identify."','facebook','facebook')") OR DIE(mysqli_error($conn));
		/*
		// get groups
		$request = new FacebookRequest($session, 'GET', '/me/groups');
		$response = $request->execute();
		$groups = $response->getGraphObject();
		$contGroup=0;
		$groups_names = '';
		if($groups->getProperty('data')){
			foreach($groups->getProperty('data')->asArray() as $item){
			  $groups_names = ''.$groups_names.''.str_replace(',', '', str_replace('|', '', $item->name)).'|'.$item->id.',';
			  if($item->administrator==true)
				$adminGroup = 1;
			  else
				$adminGroup = 0;
			  $query2=$conn->query("INSERT INTO social_share (identify_account,id_token,perms,identify,name,admin,tipo,red) VALUES ('".$identify."','".$row2['id']."','".$item->perms."','".$item->id."','".$item->name."','".$adminGroup."','grupo','facebook')") OR DIE(mysqli_error($conn));
			  
			  //estadisticas
			  //$query2=$conn->query("INSERT INTO estadisticas_facebook (id_token, identify_account, identify, red, tipo) 
			  //VALUES ('".$row2["id"]."','".$identify."','".$item->id."','facebook','grupo')") OR DIE(mysqli_error($conn));
			  
			  $contGroup++;
			 } //fin foreach
		 } // fin if
		 //estadisticas Total Group
		 $groups_names = ''.$groups_names.''.date('d-m-Y:H-i').'';
		 $query2=$conn->query("UPDATE estadisticas_facebook 
							  SET groups='".$contGroup."|".date('d-m-Y:H-i').",',
							      groups_name='".$groups_names."'
							  WHERE identify='' 
							  AND identify_account='".$identify."'
							  AND id_token='".$row2['id']."'") OR DIE(mysqli_error($conn));
	         */
		 $request = new FacebookRequest($session, 'GET', '/me/accounts');
	     $response = $request->execute();
	     // get pages
	     $pages = $response->getGraphObject();
		 $contPage = 0;
		 $pages_names = "";
		 if($pages->getProperty('data')){
			 foreach($pages->getProperty('data')->asArray() as $item){
			   $pages_names = ''.$pages_names.''.str_replace(',', '', str_replace('|', '', $item->name)).'|'.$item->id.',';
			   $perms="";
			   $c=0;
			   $adminGroup = 0;
			   foreach($item->perms as $item2){
				 $perms = ''.$perms.''.$item2.','; 
				 if($item2=="ADMINISTER" && $c==0)
				   $adminGroup = 1;
				 else if($c==0)
				   $adminGroup = 0;
				 $c++;
			   }
			   $query2=$conn->query("INSERT INTO social_share (identify_account,id_token,access_token,perms,identify,name,admin,tipo,red) VALUES ('".$identify."','".$row2['id']."','".$item->access_token."','".$perms."','".$item->id."','".$item->name."','".$adminGroup."','page','facebook')") OR DIE(mysqli_error($conn));
			   //estadisticas
		       $query2=$conn->query("INSERT INTO estadisticas_facebook (id_token, identify_account, identify, red, tipo) VALUES ('".$row2["id"]."','".$identify."','".$item->id."','facebook','page')") OR DIE(mysqli_error($conn));
			   $contPage++;
			 }// fin foreach
		 }// fin if
		 //estadisticas Total Page
		 $pages_names = ''.$pages_names.''.date('d-m-Y:H-i').'';
		 $query2=$conn->query("UPDATE estadisticas_facebook
								  SET pages='".$contPage."|".date('d-m-Y:H-i').",',
								      pages_name='".$pages_names."'
								  WHERE identify=''
								  AND identify_account='".$identify."'
								  AND id_token='".$row2['id']."'") OR DIE(mysqli_error($conn));
	}// fin else si no existe el usuario
	$obj = new stdclass();
	$obj->id_token = $id_token;
	$obj->user = $user;
	$obj->identify = $identify;
    $obj->image_red = $user_image;
	$obj->cuenta = "primaria";
	echo json_encode($obj);
  } else {
	$id_token = $_GET["id_token"];
	$user = $_GET["user"];
	$identify = $_GET["identify"];
    $red = $_GET["red"];
    //Agregar nuevo Usuario Secundario en usuario primario
	//Obtiene perfil
	$request = new FacebookRequest($session, 'GET', '/me');
    $response = $request->execute();
    // get response
    $graphObject2 = $response->getGraphObject();
    if($user!=$graphObject2->getProperty('name')){
	  //si no es el mismo usuario
	  //agregamos usuario secundario a primario
	  $link = $graphObject2->getProperty('link');
	  //Obtiene imágenes de perfil
	  $request = new FacebookRequest($session, 'GET', '/me/picture',
      array (
       'redirect' => false,
       'height' => '48',
       'type' => 'normal',
       'width' => '48',
      ));
      $response = $request->execute();
      // get response
      $graphObject = $response->getGraphObject();
	  //Almacenar tokens en la base de datos
	  //insertar usuario
	  
	  $query = $conn->query("SELECT id FROM token WHERE identify='".$graphObject2->getProperty('id')."' AND red='facebook'") OR DIE(mysqli_error($conn));
	  if($query->num_rows>0){
		  $query2=$conn->query("UPDATE token SET expire_token=0, foto='".$graphObject->getProperty('url')."', access_token='".$access_token."' WHERE identify='".$graphObject2->getProperty('id')."' AND red='facebook'") OR DIE(mysqli_error($conn));
	  } else {
		$query2=$conn->query("INSERT INTO token (identify,social_networks,red,idioma,foto,screen_name_bamboostr,access_token,mail) VALUES ('".$graphObject2->getProperty('id')."','fa".$graphObject2->getProperty('id').",','facebook','".getUserLanguage()."','".$graphObject->getProperty('url')."','".$graphObject2->getProperty('name')."','".$access_token."','".$graphObject2->getProperty('email')."')") OR DIE(mysqli_error($conn));
                $query = $conn->query("SELECT id FROM token WHERE identify='".$graphObject2->getProperty('id')."' AND red='facebook'") OR DIE(mysqli_error($conn));
                $row=$query->fetch_assoc();
                
                //Insert tutos
                $conn->query("INSERT INTO tutos (id_token) VALUES ('".$row['id']."')") OR DIE(mysqli_error($conn));

                //notificacion de bienvenida
                $bodyNot = 'Gracias por tu interés, estamos seguros que con bamboostr podrás utilizar tus Redes Sociales de la mejor manera para poder conseguir más clientes potenciales y hacer crecer tu negocio. <br /><br />Aquí encontrarás las herramientas necesarias para  posicionar tu marca en este importante canal, que día con día cobra mayor impacto. <br /><br />Para cualquier aclaración, duda o sugerencia escribanos en nuestras redes sociales o envíe un mensaje a soporte@bamboostr.com';
		$conn->query("INSERT INTO notificaciones (id_token,receptor,titulo,mensaje,fecha,red) 
		              VALUES ('".$row['id']."','".$graphObject2->getProperty('id')."','Bienvenida a Bamboostr,'".utf8_decode($bodyNot)."','".date("d-m-Y H:i")."','facebook')") OR DIE(mysqli_error($conn));

          }
	  //agregar usuario
	  $query = $conn->query("SELECT id,social_networks,tipo FROM token WHERE id='".$id_token."' AND red='".$red."'") OR DIE(mysqli_error($conn));
	  $row=$query->fetch_assoc();
	  $social_networks=$row["social_networks"];
	  $id_token=$row["id"];
	  $tipo=$row["tipo"];
	  if(strpos($social_networks, $graphObject2->getProperty('id'))===false){
		//si no está agrega nuevo usuario es necasaria la variable $red en social_networks para agregar cuentas secundarias en las primarias
	    $query2=$conn->query("UPDATE token SET social_networks='".$social_networks."fa".$graphObject2->getProperty('id').",' WHERE identify='".$identify."' AND red='".$red."'") OR DIE(mysqli_error($conn));
		$query2=$conn->query("INSERT INTO grupos (user,grupo,id_token,tipo) VALUES ('".$graphObject2->getProperty('id')."','".$identify."','".$id_token."','".$tipo."')") OR DIE(mysqli_error($conn));
		//estadisticas
		$query2=$conn->query("INSERT INTO estadisticas_facebook (id_token, identify_account, red, tipo) VALUES ('".$row["id"]."','".$graphObject2->getProperty('id')."','facebook','".$red."')") OR DIE(mysqli_error($conn));
		/*
		// get groups
		$request = new FacebookRequest($session, 'GET', '/me/groups');
		$response = $request->execute();
		$groups = $response->getGraphObject();
		$contGroup=0;
		$groups_names = '';
		if($groups->getProperty('data')){
			foreach($groups->getProperty('data')->asArray() as $item){
			  $groups_names = ''.$groups_names.''.str_replace(',', '', str_replace('|', '', $item->name)).'|'.$item->id.',';
			  if($item->administrator==true)
				$adminGroup = 1;
			  else
				$adminGroup = 0;
			  $query2=$conn->query("INSERT INTO social_share (identify_account,id_token,perms,identify,name,admin,tipo,red) VALUES ('".$graphObject2->getProperty('id')."','".$id_token."','".$item->perms."','".$item->id."','".$item->name."','".$adminGroup."','grupo','facebook')") OR DIE(mysqli_error($conn));
			  
			  //estadisticas
			  //$query2=$conn->query("INSERT INTO estadisticas_facebook (id_token, identify_account, identify, red, tipo) 
			  //VALUES ('".$row["id"]."','".$graphObject2->getProperty('id')."','".$item->id."','facebook','grupo')") OR DIE(mysqli_error($conn));
			  
			   $contGroup++;
			 } //fin foreach
		 } //fin if
		 //estadisticas Total Group
		 $groups_names = ''.$groups_names.''.date('d-m-Y:H-i').'';
		 $query2=$conn->query("UPDATE estadisticas_facebook 
							  SET groups='".$contGroup."|".date('d-m-Y:H-i').",',
							      groups_name='".$groups_names."'
							  WHERE identify='' 
							  AND identify_account='".$graphObject2->getProperty('id')."'
							  AND id_token='".$id_token."'") OR DIE(mysqli_error($conn));
		*/
		 $request = new FacebookRequest($session, 'GET', '/me/accounts');
	     $response = $request->execute();
	     // get pages
	     $pages = $response->getGraphObject();
		 $contPage = 0;
		 $pages_names = "";
		 if($pages->getProperty('data')){
			 foreach($pages->getProperty('data')->asArray() as $item){
			   $pages_names = ''.$pages_names.''.str_replace(',', '', str_replace('|', '', $item->name)).'|'.$item->id.',';
			   $perms="";
			   $c=0;
			   $adminGroup = 0;
			   foreach($item->perms as $item2){
				 $perms = ''.$perms.''.$item2.','; 
				 if($item2=="ADMINISTER" && $c==0)
				   $adminGroup = 1;
				 else if($c==0)
				   $adminGroup = 0;
				 $c++;
			   }
			   $query2=$conn->query("INSERT INTO social_share (identify_account,id_token,access_token,perms,identify,name,admin,tipo,red) VALUES ('".$graphObject2->getProperty('id')."','".$id_token."','".$item->access_token."','".$perms."','".$item->id."','".$item->name."','".$adminGroup."','page','facebook')") OR DIE(mysqli_error($conn)); 
			   //estadisticas
		       $query2=$conn->query("INSERT INTO estadisticas_facebook (id_token, identify_account, identify, red, tipo) VALUES ('".$row["id"]."','".$graphObject2->getProperty('id')."','".$item->id."','facebook','page')") OR DIE(mysqli_error($conn));
			   $contPage++;
			 }//fin foreach
		 }//fin if
		 //estadisticas Total Page
		 $pages_names = ''.$pages_names.''.date('d-m-Y:H-i').'';
		 $query2=$conn->query("UPDATE estadisticas_facebook 
							  SET pages='".$contPage."|".date('d-m-Y:H-i').",',
								  pages_name='".$pages_names."'
							  WHERE identify='' 
							  AND identify_account='".$graphObject2->getProperty('id')."'
							  AND id_token='".$row['id']."'") OR DIE(mysqli_error($conn));
		/*sacar id del nuevo usuario*/
		$query = $conn->query("SELECT id FROM token WHERE identify='".$graphObject2->getProperty('id')."' AND red='facebook'") OR DIE(mysqli_error($conn));
	    $row3=$query->fetch_assoc();
		$obj = new stdclass();
		$obj->id_token = $row3["id"];
		$obj->user = $graphObject2->getProperty('name');
		$obj->identify =$graphObject2->getProperty('id');
		$obj->cuenta = "secundaria";
		echo json_encode($obj);
	  } else {
	    // si si esta el usuario secundario... no agrega al usuario pero actualiza los grupos y pages
	    //borrar grupos y pages existentes para actualizarlos y no repetirlos
	    $query2 = $conn->query("DELETE FROM social_share WHERE identify_account='".$graphObject2->getProperty('id')."' AND id_token='".$id_token."'") OR DIE(mysqli_error($conn));
	    $query2 = $conn->query("DELETE FROM estadisticas_facebook WHERE identify_account='".$graphObject2->getProperty('id')."' AND id_token='".$id_token."' AND identify!=''") OR DIE(mysqli_error($conn));
		/*
		// get groups
		$request = new FacebookRequest($session, 'GET', '/me/groups');
		$response = $request->execute();
		$groups = $response->getGraphObject();
		$contGroup=0;
		$groups_names = '';
		if($groups->getProperty('data')){
			foreach($groups->getProperty('data')->asArray() as $item){
			  $groups_names = ''.$groups_names.''.str_replace(',', '', str_replace('|', '', $item->name)).'|'.$item->id.',';
			  if($item->administrator==true)
				$adminGroup = 1;
			  else
				$adminGroup = 0;
			  $query2=$conn->query("INSERT INTO social_share (identify_account,id_token,perms,identify,name,admin,tipo,red) VALUES ('".$graphObject2->getProperty('id')."','".$id_token."','".$item->perms."','".$item->id."','".$item->name."','".$adminGroup."','grupo','facebook')") OR DIE(mysqli_error($conn));
			  
			  //estadisticas
			  //$query2=$conn->query("INSERT INTO estadisticas_facebook (id_token, identify_account, identify, red, tipo) 
			  //VALUES ('".$row["id"]."','".$graphObject2->getProperty('id')."','".$item->id."','facebook','grupo')") OR DIE(mysqli_error($conn));
			  
			  $contGroup++;
			} //fin foreach
		 } // fin if
		 //estadisticas Total Group
		 $groups_names = ''.$groups_names.''.date('d-m-Y:H-i').'';
		 $query2=$conn->query("UPDATE estadisticas_facebook 
							  SET groups='".$contGroup."|".date('d-m-Y:H-i').",',
							      groups_name='".$groups_names."'
							  WHERE identify='' 
							  AND identify_account='".$graphObject2->getProperty('id')."'
							  AND id_token='".$id_token."'") OR DIE(mysqli_error($conn));
		*/
		 $request = new FacebookRequest($session, 'GET', '/me/accounts');
	     $response = $request->execute();
	     // get pages
	     $pages = $response->getGraphObject();
		 $contPage = 0;
		 $pages_names = "";
		 if($pages->getProperty('data')){
			 foreach($pages->getProperty('data')->asArray() as $item){
			   $pages_names = ''.$pages_names.''.str_replace(',', '', str_replace('|', '', $item->name)).'|'.$item->id.',';
			   $perms="";
			   $c=0;
			   $adminGroup = 0;
			   foreach($item->perms as $item2){
				 $perms = ''.$perms.''.$item2.','; 
				 if($item2=="ADMINISTER" && $c==0)
				   $adminGroup = 1;
				 else if($c==0)
				   $adminGroup = 0;
				 $c++;
			   }
			   $query2=$conn->query("INSERT INTO social_share (identify_account,id_token,access_token,perms,identify,name,admin,tipo,red) VALUES ('".$graphObject2->getProperty('id')."','".$id_token."','".$item->access_token."','".$perms."','".$item->id."','".$item->name."','".$adminGroup."','page','facebook')") OR DIE(mysqli_error($conn));
			   //estadisticas
		       $query2=$conn->query("INSERT INTO estadisticas_facebook (id_token, identify_account, identify, red, tipo) VALUES ('".$row["id"]."','".$graphObject2->getProperty('id')."','".$item->id."','facebook','page')") OR DIE(mysqli_error($conn));
			   $contPage++;
			 }//fin foreach
		 }//fin if
		 //estadisticas Total Page
		 $pages_names = ''.$pages_names.''.date('d-m-Y:H-i').'';
		 $query2=$conn->query("UPDATE estadisticas_facebook 
							  SET pages='".$contPage."|".date('d-m-Y:H-i').",',
								  pages_name='".$pages_names."'
							  WHERE identify='' 
							  AND identify_account='".$graphObject2->getProperty('id')."'
							  AND id_token='".$row['id']."'") OR DIE(mysqli_error($conn));
	  }// fin else si si esta usuario secundario en primario
	} else {
	  //si es el mimso usuario
	  //actualizamos usuario primario NO BUG(porque siempre se cierra sesión al ingresar de nuevo desde una nueva ubicación en ingresar.php)
	  $user = $graphObject2->getProperty('name');
	  $identify = $graphObject2->getProperty('id');
	  $mail = $graphObject2->getProperty('email');
	  $link = $graphObject2->getProperty('link');
	  //insertar SSID
	  $conn->query("INSERT INTO ssid (id_token,ssid,screen_name,fecha) 
					VALUES ('".$id_token."','APP".session_id()."','".$user."','".date('d-m-Y H:i')."') ") OR DIE(mysqli_error($conn));
	  $conn->query("INSERT INTO ssid_story (id_token,ssid,screen_name,fecha) 
					VALUES ('".$id_token."','APP".session_id()."','".$user."','".date('d-m-Y H:i')."') ") OR DIE(mysqli_error($conn));
	  //$accessToken = $session->getAccessToken();
	  //$longLivedAccessToken = $accessToken->extend();
	  //Obtiene imágenes de perfil
	  $request = new FacebookRequest($session, 'GET', '/me/picture',
	  array (
       'redirect' => false,
       'height' => '48',
       'type' => 'normal',
       'width' => '48',
      ));
      $response = $request->execute();
      // get response
      $graphObject = $response->getGraphObject();
	  $user_image = $graphObject->getProperty('url');
	  $query = $conn->query("SELECT id FROM token WHERE identify='".$identify."' AND red='facebook'") OR DIE(mysqli_error($conn));
	  if($query->num_rows>0){
	    $row=$query->fetch_assoc();
      	$id_token=$row["id"];
	    $query2=$conn->query("UPDATE token SET link='".$link."', ssid='APP".session_id()."', foto='".$user_image."', access_token='".$access_token."', mail='".$mail."' WHERE identify='".$identify."' AND red='facebook'") OR DIE(mysqli_error($conn));
		//borrar grupos y pages existentes para actualizarlos y no repetirlos
		$query2 = $conn->query("DELETE FROM social_share WHERE identify_account='".$graphObject2->getProperty('id')."' AND id_token='".$row["id"]."'") OR DIE(mysqli_error($conn));
		$query2 = $conn->query("DELETE FROM estadisticas_facebook WHERE identify_account='".$graphObject2->getProperty('id')."' AND id_token='".$row["id"]."' AND identify!=''") OR DIE(mysqli_error($conn));
		/*
		// get groups
		$request = new FacebookRequest($session, 'GET', '/me/groups');
		$response = $request->execute();
		$groups = $response->getGraphObject();
		$contGroup=0;
		$groups_names = '';
		if($groups->getProperty('data')){
			foreach($groups->getProperty('data')->asArray() as $item){
			  $groups_names = ''.$groups_names.''.str_replace(',', '', str_replace('|', '', $item->name)).'|'.$item->id.',';
			  if($item->administrator==true)
				$adminGroup = 1;
			  else
				$adminGroup = 0;
			  $query2=$conn->query("INSERT INTO social_share (identify_account,id_token,perms,identify,name,admin,tipo,red) VALUES ('".$identify."','".$id_token."','".$item->perms."','".$item->id."','".$item->name."','".$adminGroup."','grupo','facebook')") OR DIE(mysqli_error($conn));
			  
			  //estadisticas
			  //$query2=$conn->query("INSERT INTO estadisticas_facebook (id_token, identify_account, identify, red, tipo) 
			  //VALUES ('".$row["id"]."','".$identify."','".$item->id."','facebook','grupo')") OR DIE(mysqli_error($conn));
			  
			  $contGroup++;
			 } //fin foreach
		 }//fin if
		 //estadisticas Total Group
		 $groups_names = ''.$groups_names.''.date('d-m-Y:H-i').'';
		 $query2=$conn->query("UPDATE estadisticas_facebook 
							  SET groups='".$contGroup."|".date('d-m-Y:H-i').",',
							      groups_name='".$groups_names."'
							  WHERE identify='' 
							  AND identify_account='".$identify."'
							  AND id_token='".$id_token."'") OR DIE(mysqli_error($conn));
		*/
		 $request = new FacebookRequest($session, 'GET', '/me/accounts');
	     $response = $request->execute();
	     // get pages
	     $pages = $response->getGraphObject();
		 $contPage = 0;
		 $pages_names = "";
		 if($pages->getProperty('data')){
			 foreach($pages->getProperty('data')->asArray() as $item){
			   $pages_names = ''.$pages_names.''.str_replace(',', '', str_replace('|', '', $item->name)).'|'.$item->id.',';
			   $perms="";
			   $c=0;
			   $adminGroup = 0;
			   foreach($item->perms as $item2){
				 $perms = ''.$perms.''.$item2.','; 
				 if($item2=="ADMINISTER" && $c==0)
				   $adminGroup = 1;
				 else if($c==0)
				   $adminGroup = 0;
				 $c++;
			   }
			   $query2=$conn->query("INSERT INTO social_share (identify_account,id_token,access_token,perms,identify,name,admin,tipo,red) VALUES ('".$identify."','".$row["id"]."','".$item->access_token."','".$perms."','".$item->id."','".$item->name."','".$adminGroup."','page','facebook')") OR DIE(mysqli_error($conn));
			   //estadisticas
		       $query2=$conn->query("INSERT INTO estadisticas_facebook (id_token, identify_account, identify, red, tipo) VALUES ('".$row["id"]."','".$identify."','".$item->id."','facebook','page')") OR DIE(mysqli_error($conn));
			   $contPage++;
			 }//fin foreach
		 }//fin if
		 //estadisticas Total Page
		 $pages_names = ''.$pages_names.''.date('d-m-Y:H-i').'';
		 $query2=$conn->query("UPDATE estadisticas_facebook 
							  SET pages='".$contPage."|".date('d-m-Y:H-i').",',
								  pages_name='".$pages_names."'
							  WHERE identify='' 
							  AND identify_account='".$identify."'
							  AND id_token='".$row['id']."'") OR DIE(mysqli_error($conn));
	  }
	}
  }
}
?>