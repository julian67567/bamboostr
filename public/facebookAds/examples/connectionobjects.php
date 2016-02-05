<?php
include '../../facebook/src/Facebook/config.php';
include '../adsConf.php';
include '../../conexioni.php';
$identify_account = $_POST["identify_account"];
$identify = $_POST["identify"];
$tipo = $_POST["tipo"];
$red = $_POST["red"];
$query = $conn->query("SELECT access_token FROM token WHERE identify='".$identify_account."' AND red='".$red."'");
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


use FacebookAds\Api;
use FacebookAds\Object\AdUser;
use FacebookAds\Object\Fields\AdAccountFields;
use FacebookAds\Object\Fields\ConnectionObjectFields;
use FacebookAds\Object\Values\ConnectionObjectTypes;

Api::init($app_id, $app_secret, $access_token);

/*The list of users authorized to access and manage the ad account.*/

$user = new AdUser('me');
$accounts = $user->getAdAccounts([AdAccountFields::ID]);
$account = $accounts[0];

$connection_objects = $account->getConnectionObjects([
  ConnectionObjectFields::ID,
  ConnectionObjectFields::NAME,
  ConnectionObjectFields::OBJECT_STORE_URLS,
  ConnectionObjectFields::TYPE,
  ConnectionObjectFields::URL,
]);

// Group the connection objects based on type
$groups = [];

$c=0;
$adPages = [];
$true=-1;
foreach ($connection_objects as $object) {
  if (!isset($groups[$object->type])) {
    $groups[$object->type] = [];
  }
  $groups[$object->type][] = $object;
      if($identify==$object->id)
        $true = 1;
      $obj = new stdclass();
      $obj->id = $object->id;
      $obj->name = $object->name; 
      $obj->url = $object->url;
      $obj->type = $object->type;
      $adPages[$c] = new stdclass();
      $adPages[$c] = $obj;
      $c++;
}

foreach ($groups as $type => $type_objects) {
  $type_name = get_type_name($type);

  foreach ($type_objects as $object) {
    render_object($object);
  }
}


function get_type_name($type) {
  switch ($type) {
    case ConnectionObjectTypes::PAGE:
      return 'Page';
    case ConnectionObjectTypes::APPLICATION:
      return '';
    case ConnectionObjectTypes::EVENT:
      return 'Event';
    case ConnectionObjectTypes::PLACE:
      return 'Place';
    case ConnectionObjectTypes::DOMAIN:
      return 'Domain';
    default:
      return '';
  }
}


function render_object($object) {
  switch ($object->type) {
    case ConnectionObjectTypes::APPLICATION:
      return;

    default:{
      return;
    }
  }

}

if($true==1){
  $obj = new stdclass();
  $obj->success = "true";
  $obj->pages = $adPages;
} else {
  $obj = new stdclass();
  $obj->errors = "true";
  $obj->pages = $adPages;
}
echo json_encode($obj);

?>
