<?PHP
ini_set('max_execution_time', 9000);
include ''.dirname(__FILE__).'/../../conexioni.php';
require("".dirname(__FILE__)."/../twitteroauth/twitteroauth.php");
include ''.dirname(__FILE__).'/../config-sample.php';
$identify=$_GET["identify"];
$unique_request = '';
if(!$identify){
  $query=$conn->query("SELECT tok.*, esta.* 
   					  FROM token AS tok INNER JOIN estadisticas_twitter AS esta  
		              ON esta.red='twitter' AND tok.red='twitter' AND tok.identify=esta.identify") or die(mysqli_error($conn));
} else {
  $query=$conn->query("SELECT tok.*, esta.* 
 					  FROM token AS tok INNER JOIN estadisticas_twitter AS esta  
		              ON esta.red='twitter' AND tok.red='twitter' AND tok.identify='".$identify."'
					  AND esta.identify='".$identify."'") or die(mysqli_error($conn));
}
if($query->num_rows>0){
  $c=0;
  while($row=$query->fetch_assoc()){
	if(!$identify){
      if(strpos($row["notfollowingme"],date('d-m-Y'))!==false && 
	     strpos($row["siguiendoId"],date('d-m-Y'))!==false &&
	     strpos($row["seguidoresId"],date('d-m-Y'))!==false){
	    if(strpos($unique_request,$row["screen_name"])===false){
	      $cuentas[$c][0] = $row["screen_name"];
	      $cuentas[$c][3] = $row["id_token"];
	      $cuentas[$c][4] = $row["notfollowingme"];
	      $cuentas[$c][5] = $row["identify"];
		  $unique_request = ''.$unique_request.''.$row["screen_name"].',';
	      $c++;
		}
	  }
	} else {
      if(strpos($row["notfollowingme"],date('d-m-Y'))!==false && 
	     strpos($row["siguiendoId"],date('d-m-Y'))!==false &&
	     strpos($row["seguidoresId"],date('d-m-Y'))!==false){
	    if(strpos($unique_request,$row["screen_name"])===false){
	      $cuentas[$c][0] = $row["screen_name"];
	      $cuentas[$c][3] = $row["id_token"];
	      $cuentas[$c][4] = $row["notfollowingme"];
	      $cuentas[$c][5] = $row["identify"];
		  $unique_request = ''.$unique_request.''.$row["screen_name"].',';
	      $c++;
		}
	  }
	}
  }
  $c=0;
  foreach($cuentas as $item){
	
	//no necesita verificar tokens deebido a la condicion de arriba de notfollowingme
	
	//crear carpeta si no existe
    if (!file_exists("../usuarios/".$item[0].""))
	  mkdir("../usuarios/".$item[0]."", 0777);
	  
	//obtener datos
	
	//siguiendo
	$archivo = fopen("../usuarios/".$item[0]."/following.txt", "rb");
	$contenido_siguiendo = stream_get_contents($archivo);
	$siguiendo_array = explode("|",$contenido_siguiendo);
	fclose($archivo);
	
	//seguidores
	$archivo = fopen("../usuarios/".$item[0]."/followers.txt", "rb");
	$contenido_seguidores = stream_get_contents($archivo);
	$seguidores_array = explode("|",$contenido_seguidores);
	fclose($archivo);
	
	//notfollowingme
	$archivo = fopen("../usuarios/".$item[0]."/notfollowme.txt", "rb");
	$contenido_notfollowingme = stream_get_contents($archivo);
	$notfollowingme_array = explode("\n",$contenido_notfollowingme);
	fclose($archivo);
	
	 //Abrimos archivo de datos guardando informacion de seguidores y siguiendo
	 $archivo = fopen("../usuarios/".$item[0]."/seguimientomutuo.txt", "w+");

     $seguimientomutuo_cont = 0;
     
	 foreach($notfollowingme_array as &$key) 
	   $notfollowingme[$key] = 1;
	 foreach($siguiendo_array as &$item2){
	   //Performance in_array por hash
	   //if(!in_array($item, $seguidores_array)){
	   if(!isset($notfollowingme[$item2])){
		 //guardando informacion en la carpeta del usuario
		 fwrite($archivo, "".$item2."|");
		 $seguimientomutuo_cont++;
	   }
	 }
	 fclose($archivo);
	 
	//Seguimiento Mutuo
	$archivo = fopen("../usuarios/".$item[0]."/seguimientomutuo.txt", "rb");
	$contenido_seguimientomutuo = stream_get_contents($archivo);
	$seguimientomutuo_array = explode("|",$contenido_seguimientomutuo);
	fclose($archivo);
	
	//Abrimos archivo de datos guardando informacion de seguidores y siguiendo
	 $archivo = fopen("../usuarios/".$item[0]."/fans.txt", "w+");
	
	$fans_cont = 0;
     
	 foreach($seguimientomutuo_array as &$key) 
	   $seguimientomutuo[$key] = 1;
	 foreach($seguidores_array as &$item2){
	   //Performance in_array por hash
	   //if(!in_array($item, $seguidores_array)){
	   if(!isset($seguimientomutuo[$item2])){
		 //guardando informacion en la carpeta del usuario
		 fwrite($archivo, "".$item2."|");
		 $fans_cont++;
	   }
	 }
	 fclose($archivo);
	 
	echo ''.$item[0].': SM: '.$seguimientomutuo_cont.' FANS: '.$fans_cont.'<br />';
    $c++;
  }
} else {
  echo "FALSE";
}
$conn->close();
?>