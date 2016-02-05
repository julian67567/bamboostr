<?php

// Configurations
include '../../facebook/src/Facebook/config.php';
$access_token = "CAAGmoxujSOIBAEPMZCXu4FZCpinZBpfGqaw81HNfdvZBSJhtdtVFBV914EpBPmnggrZCPfDBtColJNflyebNaPTb7bS84k0jnMZALX6xafZAs9zr7XE4RUuvyJf9P4hgYnl0sqxKnD6hyoBVJZB7DJVpWUqFlE80ezvuXJ41ZBsJkpd4vh9sTsscG0UP54ycgg09wIzZByUbvCteESIEZBkRygrdDJbwybOTGtBwY7kJ3ZAl61PlwsbdGglV";

// should begin with "act_" (eg: $account_id = 'act_1234567890';)
$account_id = "1771351099758319";
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

use FacebookAds\Api;
use FacebookAds\Logger\CurlLogger;

Api::init($app_id, $app_secret, $access_token);

// Create the CurlLogger
$logger = new CurlLogger();

// To write to a file pass in a file handler
// $logger = new CurlLogger(fopen('test','w'));

// If you need to escape double quotes, use the following - useful for docs
$logger->setEscapeLevels(1);

// Hide target ids and tokens
$logger->setShowSensitiveData(false);

// Attach the logger to the Api instance
Api::instance()->setLogger($logger);

use FacebookAds\Object\AdAccount;
use FacebookAds\Object\Fields\AdAccountFields;

try {
  $account = (new AdAccount($account_id))->read(array(
    AdAccountFields::ID,
    AdAccountFields::NAME,
    AdAccountFields::ACCOUNT_STATUS
  ));
} catch (exception $e) {
  echo $e;
}
