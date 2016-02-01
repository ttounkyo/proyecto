<?php
session_start();
// added in v4.0.0
require_once 'autoload.php';
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookRequestException;
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
	$fbfullname = $graphObject->getProperty('name'); // To Get Facebook full name
	$femail = $graphObject->getProperty('email'); // To Get Facebook email ID
	/* ---- Session Variables -----*/
	$_SESSION['FBID'] = $fbid;
	$_SESSION['FULLNAME'] = $fbfullname;
	$_SESSION['EMAIL'] = $femail;
	/* ---- header location after session ----*/
	header("Location: index.php");
} else {
	$loginUrl = $helper->getLoginUrl();
	header("Location: " . $loginUrl);
}
?>