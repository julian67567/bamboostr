<?php
include '../../facebook/src/Facebook/config.php';
include '../adsConf.php';
include '../../conexioni.php';
include '../../scripts/funciones.php';
$identify_account = $_POST["identify_account"];
$identify = $_POST["identify"];
$tipo = $_POST["tipo"];
$red = $_POST["red"];
$post = $_POST["post"];
$idioma = $_POST["idioma"];
$dinero = $_POST["dinero"];
$pais = $_POST["pais"];
$genero = $_POST["genero"];
$edad1 = $_POST["edad1"];
$edad2 = $_POST["edad2"];
$intereses = $_POST["intereses"];
$interesesId = $_POST["interesesId"];

$query = $conn->query("SELECT access_token FROM token WHERE identify='".$identify_account."' AND red='facebook'");
if($query->num_rows>0){
  $row=$query->fetch_assoc();
  $access_token = $row["access_token"];
} else {
  $access_token = "";
}
if(is_null($access_token) || is_null($app_id) || is_null($app_secret)) {
  throw new \Exception(
    'You must set your access token, app id and app secret before executing'
  );
}
//$account_id

// targeting_spec={"age_min":25,"geo_locations":{"cities":[{"key":2430536}]}}
// targeting_spec={"geo_locations":{"cities":[{"key":"171194"}]},"locales":[1003],"countries":["US"],}
// locales 21 ->español
// currency=USD -> los bids te apareceran en esta moneda
// act_1771351523091610
// targeting_spec={"geo_locations":{"cities":[{"key":"171194"}],"location_types":["recent", "home"]},"locales":[1003]}
// act_xxx/users  -> usuarios con permisos en ese ID Publish
// act_xxx/
//'interests':[{id: 6003139266461, 'name': 'Movies'}]
/* 
https://graph.facebook.com/v2.4/'.$account_id.'/reachestimate?access_token='.$access_token.'&targeting_spec={'interests':'.json_encode($array_response).',%22genders%22:0,%22age_min%22:13,%22age_max%22:65,%22locales%22:[21],%22geo_locations%22:{%22location_types%22:[%22recent%22,%22home%22],%22countries%22:[%22MX%22],%22locales%22:['.$idioma.']}}
*/

/*
location
The placement of the ad. This field is deprecated and will always be 3.
cpc_min
Estimated bid price for reaching a minimum audience.
cpc_median
Estimated bid price for reaching a median audience.
cpc_max
Estimated bid price for reaching a maximum audience.
cpm_min
Estimated bid price for reaching a minimum audience.
cpm_median
Estimated bid price for reaching a median audience.
cpm_max
Estimated bid price for reaching a maximum audience.
cpa_min
Estimated bid price for reaching a minimum audience. This field is only available if a bid_for parameter is supplied in the call.
cpa_median
Estimated bid price for reaching a median audience. This field is only available if a bid_for parameter is supplied in the call.
cpa_max
Estimated bid price for reaching a maximum audience. This field is only available if a bid_for parameter is supplied in the call.
*/



if($intereses!=""){
  $array_interesesId = explode(",",$interesesId);
  $array_response = [];
  $cogf=0;
  foreach($intereses as &$item){
    $obj = new stdclass();
    $obj->id = $array_interesesId[$cogf];
    $obj->name = cadena_a_getUrlCadena($item);
    $array_response[$cogf] = new stdclass();
    $array_response[$cogf] = $obj;
    $cogf++;  
  }
  $url = 'https://graph.facebook.com/v2.4/'.$account_id.'/reachestimate?access_token='.$access_token.'&targeting_spec={%22interests%22:'.json_encode($array_response).',%22genders%22:'.$genero.',%22age_min%22:'.$edad1.',%22age_max%22:'.$edad2.',%22geo_locations%22:{%22location_types%22:[%22recent%22,%22home%22],%22countries%22:[%22'.$pais.'%22]},%22locales%22:['.$idioma.']}';
} else {
  $url = 'https://graph.facebook.com/v2.4/'.$account_id.'/reachestimate?access_token='.$access_token.'&targeting_spec={%22genders%22:'.$genero.',%22age_min%22:'.$edad1.',%22age_max%22:'.$edad2.',%22geo_locations%22:{%22location_types%22:[%22recent%22,%22home%22],%22countries%22:[%22'.$pais.'%22]},%22locales%22:['.$idioma.']}';
}

//echo $url;
$estimate = json_decode(getAjaxPhp($url));
$users = $estimate->{"users"};
$estimaciones = $estimate->{"bid_estimations"};
$cpc_median = $estimaciones[0]->{"cpc_median"};
$cpm_median = $estimaciones[0]->{"cpm_median"};
$cpa_median = $estimaciones[0]->{"cpa_median"};
$estimado_users = ($dinero*$users)/($cpc_median);
$obj = new stdclass();
$obj->users = $users;
$obj->estimado_users = $estimado_users;
$obj->cpc_median = $cpc_median;
$obj->dinero = $dinero;
$obj->estimaciones = $estimaciones;
echo json_encode($obj);
?>
