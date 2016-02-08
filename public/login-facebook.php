<?PHP
include ''.dirname(__FILE__).'/conexioni.php';
include ''.dirname(__FILE__).'/scripts/funciones.php';
//PHP Version 5.4.34
require_once 'facebook/src/Facebook/config.php';
require_once('facebook/autoload.php');
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
FacebookSession::setDefaultApplication($app_id, $app_secret);

if($_SESSION['identify'] && $_SESSION['sessionid']){
    //$_SESSION['FBRLH_state'] = NULL;
    //$_SESSION['FB_State'] = NULL;
  $facebook = new FacebookRedirectLoginHelper('http://'.getDirUrl(1).'/system.php?agregarRed=facebook');
  //echo "<!--".print_r($facebook)."-->";
} else {
  //echo "<!--prueba3-->";
  $_SESSION['red'] = "facebook";
  $facebook = new FacebookRedirectLoginHelper('http://'.getDirUrl(1).'/system.php');
}

  try {
    echo "<!--prueba54 ".$_SESSION['red']."-->";
    $session = $facebook->getSessionFromRedirect();
    echo "<!--prueba55 ".$_SESSION['red']."-->";
    //echo "<!--1".print_r($session)."-->";
  } catch(FacebookRequestException $ex) {
    // When Facebook returns an error
    echo "<!--2".print_r($ex)."-->";
  } catch(\Exception $ex) {
    // When validation fails or other local issues
    echo "<!--3".print_r($ex)."-->";
  }
if(isset($session)) {
  echo "<!--prueba56324 ".$_SESSION['red']."-->";
} else {
  echo "<!--prueba5adsad6 ".$_SESSION['red']."-->";
}

if(isset($session)) {
  echo "<!--prueba56 ".$_SESSION['red']."-->";
  if((!$_SESSION['sessionid'] || !$_SESSION['user_bamboostr'])){
	session_regenerate_id();
	$_SESSION['sessionid'] = session_id(); 
	$_SESSION['access_token'] = $session->getToken();
	$_SESSION['access_token_sec'] = $session->getToken();
	//$accessToken = $session->getAccessToken();
	//$accessToken = $accessToken->extend();
	//Obtiene perfil
	$request = new FacebookRequest($session, 'GET', '/me');
    $response = $request->execute();
    // get response
    $graphObject = $response->getGraphObject();
    $_SESSION['user_bamboostr'] = $graphObject->getProperty('name');
	$_SESSION['identify'] = $graphObject->getProperty('id');
	$_SESSION['mail'] = $graphObject->getProperty('email');
	$_SESSION['red'] = "facebook";
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
	$_SESSION['user_image'] = $graphObject->getProperty('url');
	//Almacenar tokens en la base de datos
	$query = $conn->query("SELECT foto_bamboostr,screen_name_bamboostr,id,ssid FROM token WHERE identify='".$_SESSION['identify']."' AND red='facebook'") OR DIE(mysqli_error($conn));
	if($query->num_rows>0){
	  //si existe usuario
	  //get id from token
	  $row2=$query->fetch_assoc();
	  $_SESSION['id_token'] = $row2["id"];
      $_SESSION['user_bamboostr'] = $row2["screen_name_bamboostr"];
      $_SESSION['foto_bamboostr'] = $row2["foto_bamboostr"];

          //insertar SSID
          $conn->query("INSERT INTO ssid (id_token,ssid,screen_name,fecha) 
                        VALUES ('".$_SESSION['id_token']."','".$_SESSION['sessionid']."','".$_SESSION['user_bamboostr']."','".date('d-m-Y H:i')."') ") OR DIE(mysqli_error($conn));
          $conn->query("INSERT INTO ssid_story (id_token,ssid,screen_name,fecha) 
                        VALUES ('".$_SESSION['id_token']."','".$_SESSION['sessionid']."','".$_SESSION['user_bamboostr']."','".date('d-m-Y H:i')."') ") OR DIE(mysqli_error($conn));

	  if($row2["ssid"]==""){
		  //estadisticas
		  $query2=$conn->query("INSERT INTO estadisticas_facebook (id_token, identify_account, red, tipo) 
                                        VALUES ('".$row2["id"]."','".$_SESSION['identify']."','facebook','facebook') ") OR DIE(mysqli_error($conn));
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
				  $query2=$conn->query("INSERT INTO social_share (identify_account,id_token,perms,identify,name,admin,tipo,red) VALUES ('".$_SESSION['identify']."','".$row2['id']."','".$item->perms."','".$item->id."','".$item->name."','".$adminGroup."','grupo','facebook')") OR DIE(mysqli_error($conn));
				  
				  //estadisticas
		          //$query2=$conn->query("INSERT INTO estadisticas_facebook (id_token, identify_account, identify, red, tipo) 
		          //VALUES ('".$row2["id"]."','".$_SESSION['identify']."','".$item->id."','facebook','grupo')") OR DIE(mysqli_error($conn));
				  
				  $contGroup++;
				 } //fin foreach
			 }  //fin if
			 //estadisticas Total Group
			 $groups_names = ''.$groups_names.''.date('d-m-Y:H-i').'';
			 $query2=$conn->query("UPDATE estadisticas_facebook 
								  SET groups='".$contGroup."|".date('d-m-Y:H-i').",',
								      groups_name='".$groups_names."'
								  WHERE identify='' 
								  AND identify_account='".$_SESSION['identify']."'
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
				   $query2=$conn->query("INSERT INTO social_share (identify_account,id_token,access_token,perms,identify,name,admin,tipo,red) VALUES ('".$_SESSION['identify']."','".$row2['id']."','".$item->access_token."','".$perms."','".$item->id."','".$item->name."','".$adminGroup."','page','facebook')") OR DIE(mysqli_error($conn));
				   //estadisticas
		          $query2=$conn->query("INSERT INTO estadisticas_facebook (id_token, identify_account, identify, red, tipo) VALUES ('".$row2["id"]."','".$_SESSION['identify']."','".$item->id."','facebook','page')") OR DIE(mysqli_error($conn));
				  $contPage++;
				 }//fin foreach
			 }//fin if
			 //estadisticas Total Page
			 $pages_names = ''.$pages_names.''.date('d-m-Y:H-i').'';
			 $query2=$conn->query("UPDATE estadisticas_facebook 
								  SET pages='".$contPage."|".date('d-m-Y:H-i').",',
								      pages_name='".$pages_names."'
								  WHERE identify='' 
								  AND identify_account='".$_SESSION['identify']."'
								  AND id_token='".$row2['id']."'") OR DIE(mysqli_error($conn));
	  }// fin if ssid
	
	  //si si está, actualiza la info del usuario y le actualiza sus grupos y fan pages y notificación de bienvenida!.
	  $query2=$conn->query("UPDATE token SET expire_token=0, ssid='".$_SESSION['sessionid']."', foto='".$_SESSION['user_image']."', access_token='".$_SESSION['access_token']."', mail='".$_SESSION['mail']."', link='".$link."', last_ssid='".date("d-m-Y")."' WHERE identify='".$_SESSION['identify']."' AND red='facebook'") OR DIE(mysqli_error($conn));

          header('Location: http://'.getDirUrl(1).'/system.php');
	} else {
        //si no existe el usuario
		//si no esta, inserta al usuario en la bd y le agrega sus grupos y fan pages
        $userRand = ''.rand(1000000000,9999999999).''.$_SESSION['user_bamboostr'].'';
        $passRand = rand(1000000000,9999999999);
		$query2=$conn->query("INSERT INTO token (identify,link,red,ssid,foto,screen_name,password,screen_name_bamboostr,access_token,social_networks,idioma,mail,first_ssid,last_ssid) VALUES ('".$_SESSION['identify']."','".$link."','facebook','".$_SESSION['sessionid']."','".$_SESSION['user_image']."','".$userRand."','".encriptar($passRand)."','".$_SESSION['user_bamboostr']."','".$_SESSION['access_token']."','fa".$_SESSION['identify'].",','".getUserLanguage()."','".$_SESSION['mail']."','".date("d-m-Y")."','".date("d-m-Y")."')") OR DIE(mysqli_error($conn));
		
		$query2 = $conn->query("SELECT foto_bamboostr,screen_name_bamboostr,id FROM token WHERE identify='".$_SESSION['identify']."' AND red='facebook'") OR DIE(mysqli_error($conn));
		//get id from token NOTA: Antes no existe el id
		$row2=$query2->fetch_assoc();
		$_SESSION['id_token'] = $row2["id"];
        $_SESSION['user_bamboostr'] = $row2["screen_name_bamboostr"];
        $_SESSION['foto_bamboostr'] = $row2["foto_bamboostr"];
        
                //mandar mail de contraseña
                $conn->query("INSERT INTO queue_mail (id_token,titulo,mensaje,prioridad) VALUES ('".$_SESSION['id_token']."','Bamboostr: datos de acceso','<br /><br />Muchas Felicidades por registrarte en bamboostr.<br /><br /><center><img src=http://bamboostr.com/images/congrats.png /><br /><br />Te enviamos tus datos de acceso: User: ".$userRand." <br />Pass: ".$passRand."</center><br /><br />','1')") OR DIE(mysqli_error($conn));
      
                //Insert tutos
                $conn->query("INSERT INTO tutos (id_token) VALUES ('".$_SESSION['id_token']."')") OR DIE(mysqli_error($conn));

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
		              VALUES ('".$_SESSION['id_token']."','".$_SESSION['identify']."','Bienvenido a Bamboostr','".utf8_decode($bodyNot)."','".date("d-m-Y H:i")."','facebook','mensaje')") OR DIE(mysqli_error($conn));
		
		//estadisticas
		$query2=$conn->query("INSERT INTO estadisticas_facebook (id_token, identify_account, red, tipo) VALUES ('".$row2["id"]."','".$_SESSION['identify']."','facebook','facebook')") OR DIE(mysqli_error($conn));
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
			  $query2=$conn->query("INSERT INTO social_share (identify_account,id_token,perms,identify,name,admin,tipo,red) VALUES ('".$_SESSION['identify']."','".$row2['id']."','".$item->perms."','".$item->id."','".$item->name."','".$adminGroup."','grupo','facebook')") OR DIE(mysqli_error($conn));
			  
			  //estadisticas
			  //$query2=$conn->query("INSERT INTO estadisticas_facebook (id_token, identify_account, identify, red, tipo) 
			  //VALUES ('".$row2["id"]."','".$_SESSION['identify']."','".$item->id."','facebook','grupo')") OR DIE(mysqli_error($conn));
			  
			  $contGroup++;
			 } //fin foreach
		 } // fin if
		 //estadisticas Total Group
		 $groups_names = ''.$groups_names.''.date('d-m-Y:H-i').'';
		 $query2=$conn->query("UPDATE estadisticas_facebook 
							  SET groups='".$contGroup."|".date('d-m-Y:H-i').",',
							      groups_name='".$groups_names."'
							  WHERE identify='' 
							  AND identify_account='".$_SESSION['identify']."'
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
			   $query2=$conn->query("INSERT INTO social_share (identify_account,id_token,access_token,perms,identify,name,admin,tipo,red) VALUES ('".$_SESSION['identify']."','".$row2['id']."','".$item->access_token."','".$perms."','".$item->id."','".$item->name."','".$adminGroup."','page','facebook')") OR DIE(mysqli_error($conn));
			   //estadisticas
		       $query2=$conn->query("INSERT INTO estadisticas_facebook (id_token, identify_account, identify, red, tipo) VALUES ('".$row2["id"]."','".$_SESSION['identify']."','".$item->id."','facebook','page')") OR DIE(mysqli_error($conn));
			   $contPage++;
			 }// fin foreach
		 }// fin if
		 //estadisticas Total Page
		 $pages_names = ''.$pages_names.''.date('d-m-Y:H-i').'';
		 $query2=$conn->query("UPDATE estadisticas_facebook 
								  SET pages='".$contPage."|".date('d-m-Y:H-i').",',
								      pages_name='".$pages_names."'
								  WHERE identify='' 
								  AND identify_account='".$_SESSION['identify']."'
								  AND id_token='".$row2['id']."'") OR DIE(mysqli_error($conn));
          header('Location: http://'.getDirUrl(1).'/system.php?action=newUser');
	}// fin else si no existe el usuario
    $status="OK"; 
    //header('Location: http://'.getDirUrl(1).'/system.php');
  } else {
    echo "<!--prueba55 ".$_SESSION['red']."-->";
    //Agregar nuevo Usuario Secundario en usuario primario
	//Obtiene perfil
	$request = new FacebookRequest($session, 'GET', '/me');
    $response = $request->execute();
    // get response
    $graphObject2 = $response->getGraphObject();
    if($_SESSION['user_bamboostr']!=$graphObject2->getProperty('name')){
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
		  $query2=$conn->query("UPDATE token SET expire_token=0, foto='".$graphObject->getProperty('url')."', access_token='".$session->getToken()."' WHERE identify='".$graphObject2->getProperty('id')."' AND red='facebook'") OR DIE(mysqli_error($conn));
	  } else {
		$query2=$conn->query("INSERT INTO token (identify,social_networks,red,idioma,foto,screen_name_bamboostr,access_token,mail) VALUES ('".$graphObject2->getProperty('id')."','fa".$graphObject2->getProperty('id').",','facebook','".getUserLanguage()."','".$graphObject->getProperty('url')."','".$graphObject2->getProperty('name')."','".$session->getToken()."','".$graphObject2->getProperty('email')."')") OR DIE(mysqli_error($conn));

                $query = $conn->query("SELECT id FROM token WHERE identify='".$graphObject2->getProperty('id')."' AND red='facebook'") OR DIE(mysqli_error($conn));
                $row=$query->fetch_assoc();
                
                //Insert tutos
                $conn->query("INSERT INTO tutos (id_token) VALUES ('".$row['id']."')") OR DIE(mysqli_error($conn));

                //notificacion de bienvenida
                $bodyNot = 'Gracias por tu interés, estamos seguros que con bamboostr podrás utilizar tus Redes Sociales de la mejor manera para poder conseguir más clientes potenciales y hacer crecer tu negocio. <br /><br />Aquí encontrarás las herramientas necesarias para  posicionar tu marca en este importante canal, que día con día cobra mayor impacto. <br /><br />Para cualquier aclaración, duda o sugerencia escribanos en nuestras redes sociales o envíe un mensaje a soporte@bamboostr.com';
		        $conn->query("INSERT INTO notificaciones (id_token,receptor,titulo,mensaje,fecha,red,tipo) 
		              VALUES ('".$row['id']."','".$graphObject2->getProperty('id')."','Bienvenida a Bamboostr,'".utf8_decode($bodyNot)."','".date("d-m-Y H:i")."','facebook','mensaje')") OR DIE(mysqli_error($conn));
          }
	  //agregar usuario la variable $red en social_networks para agregar cuentas secundarias en las primarias son 2 red
	  $query = $conn->query("SELECT id,social_networks,tipo FROM token WHERE id='".$_SESSION['id_token']."' AND red='".$_SESSION['red']."'") OR DIE(mysqli_error($conn));
	  $row=$query->fetch_assoc();
	  $social_networks=$row["social_networks"];
	  $id_token=$row["id"];
	  $tipo=$row["tipo"];
	  if(strpos($social_networks, $graphObject2->getProperty('id'))===false){
		//si no está agrega nuevo usuario
	    $query2=$conn->query("UPDATE token SET social_networks='".$social_networks."fa".$graphObject2->getProperty('id').",' WHERE identify='".$_SESSION['identify']."' AND red='".$_SESSION['red']."'") OR DIE(mysqli_error($conn));
		$query2=$conn->query("INSERT INTO grupos (user,grupo,id_token,tipo) VALUES ('".$graphObject2->getProperty('id')."','".$_SESSION['identify']."','".$id_token."','".$tipo."')") OR DIE(mysqli_error($conn));
		//estadisticas
		$query2=$conn->query("INSERT INTO estadisticas_facebook (id_token, identify_account, red, tipo) VALUES ('".$row["id"]."','".$graphObject2->getProperty('id')."','facebook','facebook')") OR DIE(mysqli_error($conn));
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
			  $query2=$conn->query("INSERT INTO social_share (identify_account,id_token,perms,identify,name,admin,tipo,red) VALUES ('".$graphObject2->getProperty('id')."','".$id_token."','".$item->perms."','".$item->id."','".$item->name."','".$adminGroup."','grupo','facebook') OR DIE(mysqli_error($conn));
			  
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
	  } else {
	    // si si esta el usuario secundario... no agrega al usuario pero actualiza los grupos y pages
	    //borrar grupos y pages existentes para actualizarlos y no repetirlos
	    $query2 = $conn->query("DELETE FROM social_share WHERE identify_account='".$graphObject2->getProperty('id')."' AND id_token='".$_SESSION['id_token']."'") OR DIE(mysqli_error($conn));
	    $query2 = $conn->query("DELETE FROM estadisticas_facebook WHERE identify_account='".$graphObject2->getProperty('id')."' AND id_token='".$_SESSION['id_token']."' AND identify!=''") OR DIE(mysqli_error($conn));
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
			  $query2=$conn->query("INSERT INTO social_share (identify_account,id_token,perms,identify,name,admin,tipo,red) VALUES ('".$graphObject2->getProperty('id')."','".$_SESSION['id_token']."','".$item->perms."','".$item->id."','".$item->name."','".$adminGroup."','grupo','facebook') OR DIE(mysqli_error($conn));
			  
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
			   $query2=$conn->query("INSERT INTO social_share (identify_account,id_token,access_token,perms,identify,name,admin,tipo,red) VALUES ('".$graphObject2->getProperty('id')."','".$_SESSION['id_token']."','".$item->access_token."','".$perms."','".$item->id."','".$item->name."','".$adminGroup."','page','facebook')") OR DIE(mysqli_error($conn));
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
	  if($_SESSION['identify'] && $_SESSION['sessionid'])
	    header('Location: http://'.getDirUrl(1).'/system.php?action=newUser3');
          header('Location: http://'.getDirUrl(1).'/system.php?action=newUser4');
	  $status="OK"; 
	} else {
	  //si es el mimso usuario
	  //actualizamos usuario primario NO BUG(porque siempre se cierra sesión al ingresar de nuevo desde una nueva ubicación en ingresar.php)
	  $_SESSION['user_bamboostr'] = $graphObject2->getProperty('name');
	  $_SESSION['identify'] = $graphObject2->getProperty('id');
	  $_SESSION['mail'] = $graphObject2->getProperty('email');
	  $_SESSION['link'] = $graphObject2->getProperty('link');
	  session_regenerate_id();
	  $_SESSION['sessionid'] = session_id();
	  $_SESSION['access_token'] = $session->getToken();
	  $_SESSION['access_token_sec'] = $session->getToken();
	  //insertar SSID
	  $conn->query("INSERT INTO ssid (id_token,ssid,screen_name,fecha) 
					VALUES ('".$_SESSION['id_token']."','".$_SESSION['sessionid']."','".$_SESSION['user_bamboostr']."','".date('d-m-Y H:i')."') ") OR DIE(mysqli_error($conn));
	  $conn->query("INSERT INTO ssid_story (id_token,ssid,screen_name,fecha) 
					VALUES ('".$_SESSION['id_token']."','".$_SESSION['sessionid']."','".$_SESSION['user_bamboostr']."','".date('d-m-Y H:i')."') ") OR DIE(mysqli_error($conn));
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
	  $_SESSION['user_image'] = $graphObject->getProperty('url');
	  $query = $conn->query("SELECT id FROM token WHERE identify='".$_SESSION['identify']."' AND red='facebook'") OR DIE(mysqli_error($conn));
	  if($query->num_rows>0){
	    $row=$query->fetch_assoc();
      	$id_token=$row["id"];
	    $query2=$conn->query("UPDATE token SET link='".$_SESSION['link']."', ssid='".$_SESSION['sessionid']."', foto='".$_SESSION['user_image']."', access_token='".$_SESSION['access_token']."', mail='".$_SESSION['mail']."' WHERE identify='".$_SESSION['identify']."' AND red='facebook'") OR DIE(mysqli_error($conn));
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
			  $query2=$conn->query("INSERT INTO social_share (identify_account,id_token,perms,identify,name,admin,tipo,red) VALUES ('".$_SESSION['identify']."','".$id_token."','".$item->perms."','".$item->id."','".$item->name."','".$adminGroup."','grupo','facebook')") OR DIE(mysqli_error($conn));
			  
			  //estadisticas
			  //$query2=$conn->query("INSERT INTO estadisticas_facebook (id_token, identify_account, identify, red, tipo) 
			  //VALUES ('".$row["id"]."','".$_SESSION['identify']."','".$item->id."','facebook','grupo')") OR DIE(mysqli_error($conn));
			  
			  $contGroup++;
			 } //fin foreach
		 }//fin if
		 //estadisticas Total Group
		 $groups_names = ''.$groups_names.''.date('d-m-Y:H-i').'';
		 $query2=$conn->query("UPDATE estadisticas_facebook 
							  SET groups='".$contGroup."|".date('d-m-Y:H-i').",',
							      groups_name='".$groups_names."'
							  WHERE identify='' 
							  AND identify_account='".$_SESSION['identify']."'
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
			   $query2=$conn->query("INSERT INTO social_share (identify_account,id_token,access_token,perms,identify,name,admin,tipo,red) VALUES ('".$_SESSION['identify']."','".$row["id"]."','".$item->access_token."','".$perms."','".$item->id."','".$item->name."','".$adminGroup."','page','facebook')") OR DIE(mysqli_error($conn));
			   //estadisticas
		       $query2=$conn->query("INSERT INTO estadisticas_facebook (id_token, identify_account, identify, red, tipo) VALUES ('".$row["id"]."','".$_SESSION['identify']."','".$item->id."','facebook','page')") OR DIE(mysqli_error($conn));
			   $contPage++;
			 }//fin foreach
		 }//fin if
		 //estadisticas Total Page
		 $pages_names = ''.$pages_names.''.date('d-m-Y:H-i').'';
		 $query2=$conn->query("UPDATE estadisticas_facebook 
							  SET pages='".$contPage."|".date('d-m-Y:H-i').",',
								  pages_name='".$pages_names."'
							  WHERE identify='' 
							  AND identify_account='".$_SESSION['identify']."'
							  AND id_token='".$row['id']."'") OR DIE(mysqli_error($conn));
		$status="OK"; 
                header('Location: http://'.getDirUrl(1).'/system.php?action=newUser5');
	  }  else {
		 $status="ERROR"; 
	  }
	}
  }
} else {
  echo "<!--sds-->";
  if($_SESSION['identify'] && $_SESSION['sessionid']){
        $query = $conn->query("SELECT ssid FROM ssid WHERE id_token='".$_SESSION['id_token']."'") OR DIE(mysqli_error($conn));
        if($query->num_rows>0){
	  while($row=$query->fetch_assoc()){
            $ssid = $row["ssid"];
	    if($ssid==$_SESSION["sessionid"] && $_SESSION["sessionid"]){
              //buscar token
	      $query2 = $conn->query("SELECT access_token FROM token WHERE identify='".$_SESSION['identify']."' AND red='facebook'") OR DIE(mysqli_error($conn));
	      if($query2->num_rows>0){
	        $row=$query2->fetch_assoc();
                $status = 'OK';
	        $acess_token = $row["access_token"];
                break;
	      } else {
	        $status="ERROR";
	      }
	    } else {
              $status="ERROR";
            }
          }
        } else {
          $status="ERROR";
        }

  } else {
    $status="ERROR"; 
  }
}
?>