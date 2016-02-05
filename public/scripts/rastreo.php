<?PHP
  include '../conexioni.php';
  $id_token = $_GET["id_token"];
  $option = $_GET["option"];
  $query = $conn->query("SELECT id from rastreo_users WHERE id_token='".$id_token."'");
  if($query->num_rows>0){
    
  } else {
    $query = $conn->query("INSERT INTO rastreo_users (id_token) VALUES ('".$id_token."')");
  }
  if($option=="profile"){
    $query = $conn->query("UPDATE rastreo_users SET profile=profile+1 WHERE id_token='".$id_token."'");
  } if($option=="notificaciones"){
    $query = $conn->query("UPDATE rastreo_users SET notificaciones=notificaciones+1 WHERE id_token='".$id_token."'");
  } if($option=="stats"){
    $query = $conn->query("UPDATE rastreo_users SET stats=stats+1 WHERE id_token='".$id_token."'");
  } if($option=="share"){
    $query = $conn->query("UPDATE rastreo_users SET share=share+1 WHERE id_token='".$id_token."'");
  } if($option=="tools"){
    $query = $conn->query("UPDATE rastreo_users SET tools=tools+1 WHERE id_token='".$id_token."'");
  } if($option=="crm"){
    $query = $conn->query("UPDATE rastreo_users SET crm=crm+1 WHERE id_token='".$id_token."'");
  } if($option=="ads"){
    $query = $conn->query("UPDATE rastreo_users SET ads=ads+1 WHERE id_token='".$id_token."'");
  } if($option=="cuenta"){
    $query = $conn->query("UPDATE rastreo_users SET cuenta=cuenta+1 WHERE id_token='".$id_token."'");
  } if($option=="ayuda"){
    $query = $conn->query("UPDATE rastreo_users SET ayuda=ayuda+1 WHERE id_token='".$id_token."'");
  } if($option=="adminBB"){
    $query = $conn->query("UPDATE rastreo_users SET adminBB=adminBB+1 WHERE id_token='".$id_token."'");
  } if($option=="publicaciones"){
    $query = $conn->query("UPDATE rastreo_users SET publicaciones=publicaciones+1 WHERE id_token='".$id_token."'");
  }
  $conn->close();
?>