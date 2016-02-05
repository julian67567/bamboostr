<?PHP
//////////////////////////////////////////////////////////////////////////////////////////////////////
require("twitteroauth/twitteroauth.php");
session_start();
// The TwitterOAuth instance
$twitteroauth = new TwitterOAuth('4BMx416r1Vb7NfPivDDQSt1PH', 'L7gfhI4jU9ehyJWhxbKDcxabdry2JCUdWHtrhfO3IiN30yE45U');
// Requesting authentication tokens, the parameter is the URL we will be redirected to
$request_token = $twitteroauth->getRequestToken('http://'.$_SERVER['HTTP_HOST'].'/twitter/twitter_login.php');
// Saving them into the session
$_SESSION['oauth_token'] = $request_token['oauth_token'];
$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
// If everything goes well..
if($twitteroauth->http_code==200){
// Let's generate the URL and redirect
$url = $twitteroauth->getAuthorizeURL($request_token['oauth_token']);
header('Location: '. $url);
} 
else 
{ // It's a bad idea to kill the script, but we've got to know when there's an error.
  die('Something wrong happened.');
}
////////////////////////////////////////////////////////////////////////////////////////////////////////
if(!empty($_GET['oauth_verifier']) && !empty($_SESSION['oauth_token']) && !empty($_SESSION['oauth_token_secret'])){
// We've got everything we need
} else {
// Something's missing, go back to square 1
header('Location: http://'.$_SERVER['HTTP_HOST'].'/twitter/twitter_login.php');
}
?>