<?PHP
function pushNotification($dev_token, $body, $title, $id){
    /*
      IONIC PUSH NOTIFICATIONS PHP
      $dev_token token del dispositivo registrado por la app ionic
      $body el cuerpo del mensaje push
      $title el título del mensaje push
      $id identificador único del push notification
    */
    if($dev_token && $body && $title && $id){
        include ''.dirname(__FILE__).'/../config.php';
        $yourApiSecret = $app_secret_key_ionic;
        $androidAppId = $app_id_ionic;
        $data = array(
            "tokens" => array($dev_token),
            "notification" => array("alert" => $body, 
                                    "android" => array("title" => $title,
                                                        "notId" => $id),
                                    "ios" => array("title" => $title,
                                                        "notId" => $id)
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
    } else {
      echo "ERROR PUSH NOTIFICATIONS hay parámetros vacíos";  
    }
}
?>