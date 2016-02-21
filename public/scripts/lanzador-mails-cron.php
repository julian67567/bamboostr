<?PHP
ini_set('max_execution_time', 9999999);
include ''.dirname(__FILE__).'/../conexioni.php';
$query = $conn->query("SELECT qm.*,tk.screen_name_bamboostr,tk.mail,tk.dev_token FROM queue_mail as qm INNER JOIN token as tk ON qm.id_token=tk.id ORDER BY qm.prioridad") or die(mysqli_error($conn));
if($query->num_rows>0){
  require ''.dirname(__FILE__).'/../PHPMailer/class.phpmailer.php';
  $server  = "bluehost";
  while($row=$query->fetch_assoc()){
        $body ='<div style="width: 700px; text-align: center;" id="contenedor">  <a href="http://bamboostr.com"><img style="width: 400px;" src="http://bamboostr.com/images/mails/bamboostr7.png"></a><br><br>  <img style="width: 700px;" src="http://bamboostr.com/images/mails/image.png">  <div id="contenedor_ciudad" style="background: url(http://bamboostr.com/images/mails/ciudad.png) no-repeat; text-align: center;">    <p style="padding-bottom: 1em; font-size: 1em; color: black; text-align: left; width: 45em; padding-top: 4em; padding-left: 2em;">Hola '.$row["screen_name_bamboostr"].'
<br><br>
'.$row["mensaje"].'
</p>  </div>  <img style="width: 700px;" src="http://bamboostr.com/images/mails/image.png">  <div style="width: 100%; padding-top: .5em; text-align: center; display: table;">      <div style="text-align: center; display: table-row;">        <div style="width: 50%; text-align: center; display: table-cell;">          <a href="http://bamboostr.com"><img style="width: 300px;" src="http://bamboostr.com/images/mails/bamboostr7.png"></a>        </div>        <div style="width: 50%; vertical-align: top; text-align: center; display: table-cell;">          <p>Síguenos en Redes Sociales</p>        </div>      </div>      <div style="text-align: center; display: table-row;">        <div style="width: 50%; text-align: center; display: table-cell;">          <i style="color: blue;">Copyright © 2015 Bamboostr, All rights reserved.</i>        </div>        <div style="width: 50%; text-align: center; display: table-cell;">          <a href="https://facebook.com/bamboostr"><img src="http://bamboostr.com/images/mails/facebook.png"></a>          <a href="https://twitter.com/bamboostr"><img src="http://bamboostr.com/images/mails/twitter.png"></a>          <a href="https://instagram.com/bamboostr"><img src="http://bamboostr.com/images/mails/instagram.png"></a>        </div>      </div>  </div></div>';

    $body=utf8_decode($body);
	$bodyHTML= $body;
	$nombre  = $row["screen_name_bamboostr"];
	$asunto  = $row["titulo"];
	$mensaje = $row["mensaje"];
	$mailDes = $row["mail"];                                // Mail Destino(a mandar)
	$email   = $row["mail"];                             // mail del cliente no se manda a el
	$from    = "soporte@bamboostr.com";                             // mail que verá el receptor
	$date = date("D, d M Y H:i:s -0000");
	$headers = 'From: "Bamboostr" <'.$mailDes.'>
	Return-Path: '.$mailDes.'
	Date: '.$date.'
	X-Mailer: SMF
	Mime-Version: 1.0
	Content-Type: multipart/alternative; boundary="SMF-fd3a2ff78aeec0baba4bc352c33ca57f"
	Content-Transfer-Encoding: 7bit';
	$mail = new PHPMailer;
	$mail->IsSMTP();                                        // Set mailer to use SMTP
	if($server=="bluehost"){                              
	  $mail->Host = 'box894.bluehost.com';                  // Specify main and backup server
	  $mail->Port = 465;                                    // Set the SMTP port
	  $mail->SMTPAuth = true;                               // Enable SMTP authentication
	  $mail->Username = 'soporte@boogapp.com';              // SMTP username
	  $mail->Password = 'boogapp.com';                      // SMTP password
	  $mail->SMTPSecure = 'ssl';                            // Enable encryption, 'ssl' also accepted
	} else if($server=="mailchimp"){
	  $mail->Host = 'smtp.mandrillapp.com'; 
	  $mail->Mailer = "smtp";                               // Server remoto al que nos conectarémos
	  $mail->Port = 587;                                    // Puerto SMTP
	  $mail->SMTPAuth = true;                               // Autenticación SMTP
	  $mail->Username = 'manlioelnum1@hotmail.com';         // Usuario
	  $mail->Password = 'rh2MdhYLZFpIphC5bMl-Ew';           // Password OJO! Es confidencial
	}
	$mail->From = $from;
	$mail->FromName = 'Bamboostr';
    $mail->addAddress($mailDes, $nombre);
	$mail->AddBCC('manlioelnum1@hotmail.com');                          // Agregar Destinatario
	// mail->AddAttachment("Sismo_".date("dmY").".pdf");    // Para que pongas el attachment
	$mail->IsHTML(true);                                                                                                 // Formato HTML
	$mail->Subject = ''.$asunto.'';
	$mail->Body    = $bodyHTML;
	$mail->AltBody = $bodyHTML;
	if($mail->Send()){
	  echo ''.$row["id_token"].'<br />';
          $conn->query("DELETE FROM queue_mail WHERE id='".$row["id"]."'") or die(mysqli_error($conn));
	} else { 
	  echo 'Error: '.$mail->ErrorInfo.' '.$mail->Host.''; 
	}
	//$mail->ClearAllRecipients();                       //Limpiar Destinatarios para nuevo Desti..
        
        /*comentar lo siguiente '.$mailDes.'*/
        echo $body;
        break;
  }
} else {
  echo "no hay mails a enviar";
}
?>