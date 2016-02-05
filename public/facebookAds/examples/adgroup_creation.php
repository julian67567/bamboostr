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
if(is_null($access_token) || is_null($app_id) || is_null($app_secret)) {
  throw new \Exception(
    'You must set your access token, app id and app secret before executing'
  );
}
if (is_null($account_id)) {
  throw new \Exception(
    'You must set your account id before executing');
}
use FacebookAds\Api;

Api::init($app_id, $app_secret, $access_token);

/**
 * Step 1 Read the AdAccount (optional)
 */
use FacebookAds\Object\AdAccount;
use FacebookAds\Object\Fields\AdAccountFields;

//necesitas permisos arriba de basic access

try{
$account = (new AdAccount($account_id))->read(array(
  AdAccountFields::ID,
  AdAccountFields::NAME,
  AdAccountFields::ACCOUNT_STATUS
));
}catch(Exception $e){
  echo $e->getMessage();
}
$account = (new AdAccount($account_id))->read(array(
  AdAccountFields::ID,
  AdAccountFields::NAME,
  AdAccountFields::ACCOUNT_STATUS
));
echo "hola";
echo "\nUsing this account: ";
echo $account->id."\n";

// Check the account is active
if($account->{AdAccountFields::ACCOUNT_STATUS} !== 1) {
  throw new \Exception(
    'This account is not active');
}

/**
 * Step 2 Create the AdCampaign
 */
use FacebookAds\Object\AdCampaign;
use FacebookAds\Object\Fields\AdCampaignFields;
use FacebookAds\Object\Values\AdObjectives;

$campaign  = new AdCampaign(null, $account->id);
$campaign->setData(array(
  AdCampaignFields::NAME => 'My First Campaign',
  AdCampaignFields::OBJECTIVE => AdObjectives::WEBSITE_CLICKS,
  AdCampaignFields::STATUS => AdCampaign::STATUS_PAUSED,
));

$campaign->validate()->create();
echo "Campaign ID:" . $campaign->id . "\n";

/**
 * Step 3 Search Targeting
 */
use FacebookAds\Object\TargetingSearch;
use FacebookAds\Object\Search\TargetingSearchTypes;
use FacebookAds\Object\TargetingSpecs;
use FacebookAds\Object\Fields\TargetingSpecsFields;

$results = TargetingSearch::search(
  $type = TargetingSearchTypes::INTEREST,
  $class = null,
  $query = 'facebook');

// we'll take the top result for now
$target = (count($results)) ? $results->current() : null;

echo "Using target: ".$target->name."\n";

$targeting = new TargetingSpecs();
$targeting->{TargetingSpecsFields::GEO_LOCATIONS}
  = array('countries' => array('GB'));
$targeting->{TargetingSpecsFields::INTERESTS} = array(
    array(
        'id' => $target->id,
        'name' => $target->name,
    ),
);

/**
 * Step 4 Create the AdSet
 */
use FacebookAds\Object\AdSet;
use FacebookAds\Object\Fields\AdSetFields;
use FacebookAds\Object\Fields\BidInfoFields;
use FacebookAds\Object\Values\BidTypes;

$adset = new AdSet(null, $account->id);
$adset->setData(array(
  AdSetFields::NAME => 'My First AdSet',
  AdSetFields::CAMPAIGN_GROUP_ID => $campaign->id,
  AdSetFields::CAMPAIGN_STATUS => AdSet::STATUS_ACTIVE,
  AdSetFields::DAILY_BUDGET => '150',
  AdSetFields::TARGETING => $targeting,
  AdSetFields::BID_TYPE => BidTypes::BID_TYPE_CPM,
  AdSetFields::BID_INFO =>
    array(BidInfoFields::IMPRESSIONS => 2),
  AdSetFields::START_TIME =>
    (new \DateTime("+1 week"))->format(\DateTime::ISO8601),
  AdSetFields::END_TIME =>
    (new \DateTime("+2 week"))->format(\DateTime::ISO8601),
));

$adset->validate()->create();

echo 'AdSet  ID: '. $adset->id . "\n";

/**
 * Step 5 Create an AdImage
 */
use FacebookAds\Object\AdImage;
use FacebookAds\Object\Fields\AdImageFields;

$image = new AdImage(null, $account->id);
$image->{AdImageFields::FILENAME}
  = SDK_DIR.'/test/misc/image.png';

$image->create();
echo 'Image Hash: '.$image->hash . "\n";

/**
 * Step 6 Create an AdCreative
 */
use FacebookAds\Object\AdCreative;
use FacebookAds\Object\Fields\AdCreativeFields;

$creative = new AdCreative(null, $account->id);
$creative->setData(array(
  AdCreativeFields::NAME => 'Sample Creative',
  AdCreativeFields::TITLE => 'Welcome to the Jungle',
  AdCreativeFields::BODY => 'We\'ve got fun \'n\' games',
  AdCreativeFields::IMAGE_HASH => $image->hash,
  AdCreativeFields::OBJECT_URL => 'http://www.example.com/',
));

$creative->create();
echo 'Creative ID: '.$creative->id . "\n";

/**
 * Step 7 Create an AdGroup
 */
use FacebookAds\Object\AdGroup;
use FacebookAds\Object\Fields\AdGroupFields;

$adgroup = new AdGroup(null, $account->id);
$adgroup->setData(array(
  AdGroupFields::CREATIVE =>
    array('creative_id' => $creative->id),
  AdGroupFields::NAME => 'My First AdGroup',
  AdGroupFields::CAMPAIGN_ID => $adset->id,
));

$adgroup->create();
echo 'AdGroup ID:' . $adgroup->id . "\n";
