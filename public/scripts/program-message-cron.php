<?PHP
include ''.dirname(__FILE__).'/../app/config.php';
include ''.dirname(__FILE__).'/funciones.php';
ini_set('max_execution_time', 9000);
function mifechagmt($fecha_timestamp,$gmt=0){
	$timestamp=$fecha_timestamp; //puedes poner aqui la hora en formato "Unix timestamp" obtenida de una tabla
	$diferenciahorasgmt = (date('Z', time()) / 3600 - $gmt) * 3600; //La diferencia de horas entre el GMT del servidor y el GMT que queremos, en mi caso mi servidor es GTM-4, y si quiero un GTM -5 la diferencia será de -1 hora
	$timestamp_ajuste = $timestamp - $diferenciahorasgmt; //restamos a la hora actual la diferencia horaria en mi caso será -1 hora
	$fecha = date("d-m-Y H:i", $timestamp_ajuste); //mostramos la fecha/hora
	return $fecha;
}
include ''.dirname(__FILE__).'/../conexioni.php';
$fechaAS = strtotime(date("d-m-Y H:i"));
$horarioAS =  substr(date("O"),0,strlen(date("O"))-2);
echo 'Fecha Actual: '.date("d-m-Y H:i").' '.$horarioAS.'<br /><br />';
$query=$conn->query("SELECT * FROM queue_msg ORDER BY fecha");
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
        //notificaciones
        $conn->query("INSERT INTO notificaciones (id_token,receptor,titulo,mensaje,imagen,fecha,red,tipo) VALUES ('".$row["id_token"]."','".$row["identify"]."','Mensaje Programado','".$row["mensaje"]."','".substr($row["images"],0,strlen($row["images"])-1)."','".date("d-m-Y H:i")."','".$row["red"]."','instagram')") OR die("Error: ".mysqli_error($conn));
	  } else {
		  //abrimos la url y que la lea que contiene
		  $cadena="";
		  $imagenes="";
		  $fo= fopen($url2,"r") or die ("false");
		  while (!feof($fo)) {
			$cadena .= fgets($fo);
			$cadena = preg_replace('/\s+/',' ',$cadena);
		  }
		  fclose ($fo); 
		  echo ''.$url2.' | '.$cadena.' | ';
		  $img_array = explode(",",$row["images"]);
		  foreach($img_array as &$item123){
			if($item123!=""){
			  $imagenes=''.$imagenes.'<img src="'.$item123.'"><br /><br />'; 
			}
		  }
	  }
	  $query4 = $conn->query("SELECT dev_token FROM token WHERE id='".$row["id_token"]."'");
	  $row2 = $query4->fetch_assoc();
	  if($row2["dev_token"] && $row["red"]=="instagram"){
		$title12 = 'Mensaje Programado';
		$body12 = 'Instagram a atender';
	  } else if($row2["dev_token"] && $row["red"]!="instagram"){
		$title12 = 'Mensaje Programado';
		$body12 = 'Enviado Correctamente';
		//Mensajes Publicados
        $query2=$conn->query("INSERT INTO msg_publicados SELECT * FROM queue_msg WHERE id='".$row["id"]."'"); 
        //Mandar Mail
        $conn->query("INSERT INTO queue_mail (id_token,titulo,mensaje,prioridad) VALUES ('".$row["id_token"]."','Mensaje Programado Enviado','<br /><br />Muchas Felicidades tu mensaje se a ha enviado con éxito.<br /><br /><center><img src=http://bamboostr.com/images/congrats.png /></center><br /><br />".$row["mensaje"]."<br /><br /><center>".$imagenes."</center>','1')");
		$conn->query("INSERT INTO queue_mail (id_token,titulo,mensaje,prioridad) VALUES ('128','Mensaje Programado Enviado','<br /><br />Muchas Felicidades tu mensaje se a ha enviado con éxito.<br /><br /><center><img src=http://bamboostr.com/images/congrats.png /></center><br /><br />".$row["mensaje"]."<br /><br /><center>".$imagenes."</center>".$url2." | ".$cadena." | ','1')");
		print_r($fo);
		echo "<br />";
	  }
	  if($row2["dev_token"]){
		$yourApiSecret = $app_secret_key_ionic;
		$androidAppId = $app_id_ionic;
		$data = array(
		  "tokens" => array($row2["dev_token"]),
		  "notification" => array("alert" => $body12, 
		                          "android" => array("title" => $title12,
													 "notId" => $row["id"]),
								  "ios" => array("title" => $title12,
													 "notId" => $row["id"])
								  ),
		  
		  //"scheduled" => "1439915098",
		);
                echo json_encode($data);
		$ch = curl_init('https://push.ionic.io/api/v1/push');
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'X-Ionic-Application-Id: '.$androidAppId,
			'Content-Length: ' . strlen(json_encode($data)),
			'Authorization: Basic '.base64_encode($yourApiSecret)
			)
		);
		
		$result = curl_exec($ch);
		var_dump($result);
	  }
	  //Eliminar Llave
	  $query2=$conn->query("DELETE FROM queue_msg WHERE id='".$row["id"]."'");
	  $c++;
	}/*fin hora*/
  } /*fin while*/
} else {
  echo "No hay Mensajes Programados";
}
$conn->close();
?>