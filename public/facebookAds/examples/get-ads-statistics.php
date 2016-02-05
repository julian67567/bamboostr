<?php
include '../../facebook/src/Facebook/config.php';
include '../adsConf.php';

$access_token = "CAAGmoxujSOIBAEPMZCXu4FZCpinZBpfGqaw81HNfdvZBSJhtdtVFBV914EpBPmnggrZCPfDBtColJNflyebNaPTb7bS84k0jnMZALX6xafZAs9zr7XE4RUuvyJf9P4hgYnl0sqxKnD6hyoBVJZB7DJVpWUqFlE80ezvuXJ41ZBsJkpd4vh9sTsscG0UP54ycgg09wIzZByUbvCteESIEZBkRygrdDJbwybOTGtBwY7kJ3ZAl61PlwsbdGglV";

if(is_null($access_token) || is_null($app_id) || is_null($app_secret)) {
  throw new \Exception(
    'You must set your access token, app id and app secret before executing'
  );
}


use FacebookAds\Api;
use FacebookAds\Object\AdUser;
use FacebookAds\Object\AdAccount;
use FacebookAds\Object\Fields\AdAccountFields;
use FacebookAds\Object\Fields\ConnectionObjectFields;
use FacebookAds\Object\Values\ConnectionObjectTypes;

Api::init($app_id, $app_secret, $access_token);

/*The list of users authorized to access and manage the ad account.*/
      $account = new AdAccount($account_id);

    $fields = array('account_id', 'total_actions', 'spend'); // The fields I ask for?
    $params = array(
        'data_columns' => array (
            'account_id',
            'total_actions',
            'spend'
        ),
        'date_preset' => 'last_7_days',
    );

    try {
    $reports = $account->getReportsStats($fields, $params);
    } catch(Exception $e){
      echo $e->getMessage();
    }


    $response = array();
    foreach($reports as $report) {
        $response[] = $report->getData();
    }

    echo json_encode($response); 

?>
