<?PHP
include '../../conexioni.php';
// ssid<>'' IS NOT NULL AND identify<>'0'
$query = $conn->query("DELETE FROM token WHERE identify='0' OR identify=''");
$query = $conn->query("SELECT tk.id AS id2,tk.identify,tk.screen_name,tk.ssid,tk.social_networks,tk.expire_token,tk.idioma,tk.red,tk.tipo,tk.automatize,tk.last_ssid,tk.first_ssid,ru.profile,ru.notificaciones,ru.stats,ru.share,ru.tools,ru.crm,ru.ads,ru.cuenta,ru.ayuda,ru.adminBB,ru.publicaciones FROM token as tk INNER JOIN rastreo_users as ru ON tk.id=ru.id_token");
if($query->num_rows>0){
  $c=0;
  $response_array = [];
  while($row=$query->fetch_assoc()){
    $obj = new stdclass();
    $obj->id = $row["id2"];
    $obj->identify = $row["identify"];
    $obj->screen_name = $row["screen_name"];
    $obj->ssid = $row["ssid"];
    $obj->social_networks = $row["social_networks"];
    $obj->expire_token = $row["expire_token"];
    $obj->idioma = $row["idioma"];
    $obj->red = $row["red"];
    $obj->tipo = $row["tipo"];
    $obj->automatize = $row["automatize"];
    $obj->last_ssid = $row["last_ssid"];
    $obj->first_ssid = $row["first_ssid"];

    $obj->profile = $row["profile"];
    $obj->notificaciones = $row["notificaciones"];
    $obj->stats = $row["stats"];
    $obj->share = $row["share"];
    $obj->tools = $row["tools"];
    $obj->crm = $row["crm"];
    $obj->ads = $row["ads"];
    $obj->cuenta = $row["cuenta"];
    $obj->ayuda = $row["ayuda"];
    $obj->adminBB = $row["adminBB"];
    $obj->publicaciones = $row["publicaciones"];

    $response_array[$c] = new stdclass();
    $response_array[$c] = $obj;
    $c++;
  }
  $response = new stdclass();
  $response->data = $response_array;
  echo json_encode($response->data);
} else {
  $obj = new stdclass();
  $obj->error = "false";
  echo json_encode($obj);
}
?>