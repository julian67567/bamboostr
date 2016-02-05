<?PHP
require 'PHPMailer/class.phpmailer.php';
$server  = $_POST["server"];
$nombre  = $_POST['nombre'];
$asunto  = utf8_decode($_POST['asunto']);
$mensaje = $_POST['mensaje'];
$mailDes = $_POST['mailDes'];                           // Mail Destino(a mandar)
$email   = $_POST['email'];                             // mail del cliente no se manda a el
$from    = $_POST['from'];                              // mail que verá el receptor
$body    = $_POST['body'];                              // Cuerpo del Mensaje
$bodyHTML= $_POST["bodyHTML"];
$date = date("D, d M Y H:i:s -0000");
$headers = 'From: "Infomundo" <'.$mailDes.'>
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
$mail->FromName = ''.$nombre.'';
$mail->AddBCC(''.$mailDes.'');                          // Agregar Destinatario
// mail->AddAttachment("Sismo_".date("dmY").".pdf");    // Para que pongas el attachment
$mail->IsHTML(true);                                                                                                 // Formato HTML
$mail->Subject = ''.$asunto.'';
if($body=="contacto"){
  $mail->Body    = ''.$mensaje.'<br /<br />Mail: '.$email.'<br /><br />Mandado desde Boogapp.';
  $mail->AltBody = ''.$mensaje.'<br /><br />Mail: '.$email.'<br /><br />Mandado desde Boogapp.';
} else if($body=="promocionar"){
  $mail->Body    = $bodyHTML;
  $mail->AltBody = $bodyHTML;
}
if($mail->Send()){
  echo 'TRUE';
} else { 
  echo 'Error: '.$mail->ErrorInfo.' '.$mail->Host.''; 
}
//$mail->ClearAllRecipients();                       //Limpiar Destinatarios para nuevo Desti..
?>