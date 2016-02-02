<?php
session_start();
// added in v4.0.0
require_once 'autoload.php';
use Facebook\FacebookSession;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookResponse;
use Facebook\FacebookSDKException;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\Entities\AccessToken;
use Facebook\HttpClients\FacebookCurlHttpClient;
use Facebook\HttpClients\FacebookHttpable;
use Facebook\FacebookSession;

// init app with app id and secret
FacebookSession::setDefaultApplication('1731751890388215', '4e064db0ea2c37c6d9198d866a9b047e');
// login helper with redirect_uri
$helper = new FacebookRedirectLoginHelper('http://ttounkyo-ttounkyo.rhcloud.com/frontoffice/fb/fbconfig.php');
try {
	$session = $helper->getSessionFromRedirect();
} catch (FacebookRequestException $ex) {
	echo $ex->getMessage();
	// When Facebook returns an error
} catch (Exception $ex) {
	echo $ex->getMessage();
	// When validation fails or other local issues
}
// see if we have a session
if (isset($session)) {
	// graph api request for user data
	$request = new FacebookRequest($session, 'GET', '/me');
	$response = $request->execute();
	// get response
	$graphObject = $response->getGraphObject();
	$fbid = $graphObject->getProperty('id'); // To Get Facebook ID
	$fbuname = $graphObject->getProperty('username'); // To Get Facebook Username
	$fbfullname = $graphObject->getProperty('name'); // To Get Facebook full name
	$femail = $graphObject->getProperty('email'); // To Get Facebook email ID
	/* ---- Session Variables -----*/
	echo "<br><br>";
	echo $_SESSION['FBID'] = $fbid;
	echo $_SESSION['USERNAME'] = $fbuname;
	echo $_SESSION['FULLNAME'] = $fbfullname;
	echo $_SESSION['EMAIL'] = $femail;
	echo "<br><br>";
	/* ---- header location after session ----*/
	header("Location: index.php");
} else {
	$permissions = array(
		'email',
		'user_location',
		'user_birthday',
	);
	$loginUrl = $helper->getLoginUrl($permissions);
	header("Location: " . $loginUrl);
}
?>