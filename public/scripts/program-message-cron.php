<?PHP
ini_set('max_execution_time', 9000);

include ''.dirname(__FILE__).'/../config.php';
include ''.dirname(__FILE__).'/../conexioni.php';
include ''.dirname(__FILE__).'/funciones.php';

$fechaAS = strtotime(date("d-m-Y H:i"));
$horarioAS =  substr(date("O"),0,strlen(date("O"))-2);
echo 'Fecha Actual: '.date("d-m-Y H:i").' '.$horarioAS.'<br /><br />';
$query=$conn->query("SELECT * FROM queue_msg ORDER BY fecha") OR DIE(mysqli_error($conn));
if($query->num_rows>0){
  $c=1;
  while($row=$query->fetch_assoc()){
	$horarioP = substr($row["horario"],3,strlen($row["horario"])-5);
    if(strtotime(mifechagmt(time(),$horarioP))>=strtotime($row["fecha"])){
	  echo ''.$c.': '.$row["fecha"].' | '.$horarioP.'  | '.mifechagmt(time(),$horarioP).' | '.$row["mensaje"].' | ';
	  //lanzar
	  $url = '';
	  if($row["identify"])
	    $url=''.$url.'identify='.$row["identify"].'&';
	  if($row["id_post"])
	    $url=''.$url.'idPost='.$row["id_post"].'&';
	  if($row["images"])
	    $url=''.$url.'images='.$row["images"].'&';
	  if($row["mensaje"])
	    $url=''.$url.'description='.rawurlencode($row["mensaje"]).'&';
	  if($row["link"])
	    $url=''.$url.'link='.$row["link"].'&';
	  if($row["name"])
	    $url=''.$url.'screen_name='.$row["name"].'';
	  if($row["red"]=="facebook"){
	    $url2='http://'.getDirUrl(1).'/facebook/post-message.php?'.$url.'';
	  }
	  else if($row["red"]=="twitter"){
		$url2='http://'.getDirUrl(1).'/twitter/post-media.php?'.$url.'';
	  }
      if($row["red"]=="instagram"){ 
        //si es instagram notificaciones
        $conn->query("INSERT INTO notificaciones (id_token,receptor,titulo,mensaje,imagen,fecha,red,tipo) VALUES ('".$row["id_token"]."','".$row["identify"]."','Mensaje Programado','".$row["mensaje"]."','".substr($row["images"],0,strlen($row["images"])-1)."','".date("d-m-Y H:i")."','".$row["red"]."','instagram')") OR die("Error: ".mysqli_error($conn));
	  } else {
		  //si no es instagram abrimos la url para enviar el mensaje programado y que la lea que contiene
		  $cadena="";
		  $imagenes="";
		  $fo= fopen($url2,"r") or die ("false");
		  while (!feof($fo)) {
			$cadena .= fgets($fo);
			$cadena = preg_replace('/\s+/',' ',$cadena);
		  }
		  fclose ($fo); 
		  echo ''.$url2.' | '.$cadena.' | ';
	  }
      /*Sacamos imágenes del queue_msg independientemente de la red que sea*/
      $img_array = explode(",",$row["images"]);
      foreach($img_array as &$item123){
        if($item123!=""){
            $imagenes=''.$imagenes.'<img src="'.$item123.'"><br /><br />'; 
        }
      }
	  $query4 = $conn->query("SELECT dev_token FROM token WHERE id='".$row["id_token"]."'") OR DIE(mysqli_error($conn));
	  $row2 = $query4->fetch_assoc();
	  if($row2["dev_token"] && $row["red"]=="instagram"){
        /*instagram no manda mail*/
		$title12 = 'Mensaje Programado';
		$body12 = 'Instagram a atender';
	  } 
      if($row2["dev_token"] && $row["red"]!="instagram"){
        /*si no es instagram pero tiene token dev*/
		$title12 = 'Mensaje Programado';
		$body12 = 'Enviado Correctamente';
      }
      if($row["red"]=="instagram"){
        /*si es instagram mandamos mail*/
        //Mandar Mail al usuario
        $conn->query("INSERT INTO queue_mail (id_token,titulo,mensaje,prioridad) VALUES ('".$row["id_token"]."','Mensaje Programado: Instagram a atender','<br /><br />Muchas Felicidades ya puedes enviar tu mensaje programado de instagram bajando nuestra app de bamboostr.<br /><br /><center><img src=http://bamboostr.com/images/congrats.png /></center><br /><br />".$row["mensaje"]."<br /><br /><center>".$imagenes."</center>','1')") OR DIE(mysqli_error($conn));
        //mandar Mail al admin
		$conn->query("INSERT INTO queue_mail (id_token,titulo,mensaje,prioridad) VALUES ('128','Mensaje Programado: Instagram a atender','<br /><br />Muchas Felicidades ya puedes enviar tu mensaje programado de instagram bajando nuestra app de bamboostr.<br /><br /><center><img src=http://bamboostr.com/images/congrats.png /></center><br /><br />".$row["mensaje"]."<br /><br /><center>".$imagenes."</center>".$url2." | ".$cadena." | ','1')") OR DIE(mysqli_error($conn));
      }
      if($row["red"]!="instagram"){
        /*si no es instagram mandamos mail*/
		//Mensajes Publicados
        $query2=$conn->query("INSERT INTO msg_publicados SELECT * FROM queue_msg WHERE id='".$row["id"]."'") OR DIE(mysqli_error($conn));
        //Mandar Mail al usuario
        $conn->query("INSERT INTO queue_mail (id_token,titulo,mensaje,prioridad) VALUES ('".$row["id_token"]."','Mensaje Programado Enviado','<br /><br />Muchas Felicidades tu mensaje se a ha enviado con éxito.<br /><br /><center><img src=http://bamboostr.com/images/congrats.png /></center><br /><br />".$row["mensaje"]."<br /><br /><center>".$imagenes."</center>','1')") OR DIE(mysqli_error($conn));
        //mandar Mail al admin
		$conn->query("INSERT INTO queue_mail (id_token,titulo,mensaje,prioridad) VALUES ('128','Mensaje Programado Enviado','<br /><br />Muchas Felicidades tu mensaje se a ha enviado con éxito.<br /><br /><center><img src=http://bamboostr.com/images/congrats.png /></center><br /><br />".$row["mensaje"]."<br /><br /><center>".$imagenes."</center>".$url2." | ".$cadena." | ','1')") OR DIE(mysqli_error($conn));
		print_r($fo);
		echo "<br />";
	  }
	  if($row2["dev_token"]){
        /*Mandamos PUSH Notification*/
		include ''.dirname(__FILE__).'/../app/push-notifications.php';
        pushNotification($row2["dev_token"], $body12, $title12, $row["id"]);
	  }
	  //Eliminar Llave
	  $query2=$conn->query("DELETE FROM queue_msg WHERE id='".$row["id"]."'") OR DIE(mysqli_error($conn));
	  $c++;
	}/*fin hora*/
  } /*fin while*/
} else {
  echo "No hay Mensajes Programados";
}
$conn->close();
?>