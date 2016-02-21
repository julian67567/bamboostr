<?PHP
require("".dirname(__FILE__)."/twitteroauth/twitteroauth.php");
require_once(''.dirname(__FILE__).'/config-sample.php');
session_start();
// The TwitterOAuth instance
$twitteroauth = new TwitterOAuth($consumer_key, $consumer_secret);
// No redireccionar a la misma URL del Login!
$request_token = $twitteroauth->getRequestToken('http://'.$_SERVER['HTTP_HOST'].'/');
// Saving them into the session
$_SESSION['oauth_token'] = $request_token['oauth_token'];
$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
// If everything goes well..
if($twitteroauth->http_code==200){
// Let's generate the URL and redirect
$url = $twitteroauth->getAuthorizeURL($request_token['oauth_token']);
header('Location: '. $url);
} else {
// It's a bad idea to kill the script, but we've got to know when there's an error.
die('Something wrong happened.');
}
?>