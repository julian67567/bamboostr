<?php

// Configurations
include '../../facebook/src/Facebook/config.php';
$access_token = "CAAGmoxujSOIBAEPMZCXu4FZCpinZBpfGqaw81HNfdvZBSJhtdtVFBV914EpBPmnggrZCPfDBtColJNflyebNaPTb7bS84k0jnMZALX6xafZAs9zr7XE4RUuvyJf9P4hgYnl0sqxKnD6hyoBVJZB7DJVpWUqFlE80ezvuXJ41ZBsJkpd4vh9sTsscG0UP54ycgg09wIzZByUbvCteESIEZBkRygrdDJbwybOTGtBwY7kJ3ZAl61PlwsbdGglV";

// should begin with "act_" (eg: $account_id = 'act_1234567890';)
$account_id = "act_1771351099758319";
//1771351099758319
define('SDK_DIR', __DIR__ . '/..'); // Path to the SDK directory
$loader = include SDK_DIR.'/vendor/autoload.php';
// Configurations - End

if (is_null($access_token) || is_null($app_id) || is_null($app_secret)) {
  throw new \Exception(
    'You must set your access token, app id and app secret before executing'
  );
}

if (is_null($account_id)) {
  throw new \Exception(
    'You must set your account id before executing');
}

define('SDK_DIR', __DIR__ . '/..'); // Path to the SDK directory
$loader = include SDK_DIR.'/vendor/autoload.php';

use FacebookAds\Api;

Api::init($app_id, $app_secret, $access_token);

// use the namespace for Custom Audiences and Fields
use FacebookAds\Object\CustomAudience;
use FacebookAds\Object\Fields\CustomAudienceFields;
use FacebookAds\Object\Values\CustomAudienceTypes;

// Create a custom audience object, setting the parent to be the account id

$audience = new CustomAudience(null, $account_id);
$audience->setData(array(
  CustomAudienceFields::NAME => 'My Custom Audiece',
  CustomAudienceFields::DESCRIPTION => 'Lots of people',
));

echo "hola";

// Create the audience basic access
$audience->create();
echo "Audience ID: " . $audience->id."\n";

// Assuming you have an array of emails:
// NOTE: The SDK will hash (SHA-2) your data before submitting
// it to Facebook servers
$emails = array(
  'paul@example.com',
  'luca@example.com',
  'bruce@example.com',
  'peihua@example.com',
);

$audience->addUsers($emails, CustomAudienceTypes::EMAIL);
$audience->read(array(CustomAudienceFields::APPROXIMATE_COUNT));
echo "Estimated Size:"
  . $audience->{CustomAudienceFields::APPROXIMATE_COUNT}."\n";
