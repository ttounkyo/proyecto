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
	$request = new FacebookRequest($session, 'GET', '/me?fields=first_name,last_name,gender,birthday,email,location');
	$response = $request->execute();
	// get response
	$graphObject = $response->getGraphObject();
	// var_dump($graphObject);
	$fbuname = $graphObject->getProperty('first_name'); // To Get Facebook Username
	$fblastname = $graphObject->getProperty('last_name'); // To Get Facebook full name
	$fbuser = ($fbuname . $fblastname);
	$femail = $graphObject->getProperty('email'); // To Get Facebook email ID

	require_once "../../funciones.php";

	echo "user: " . $fbuser . " Nombre " . $fbuname . " apellidos " . $fblastname . " mail " . $femail;
	$db = conectarBD();
	if ($db->connect_errno > 0) {
		die('Imposible conectar [' . $db->connect_error . ']');
	}

	$count = "SELECT COUNT(*) AS numero FROM usuarios WHERE email = '{$femail}';";
	$result = $db->query($count);
	$row = $result->fetch_array(MYSQL_BOTH)['numero'];

	if ($row == 0) {
		$query = "INSERT INTO usuarios(username,nombre,apellidos,email)
			VALUES ('$fbuser','$fbuname','$fblastname','$femail');";

		if ($resul = $db->query($query)) {
			$_SESSION['usuariofront'] = $fbuser;
			header('http://ttounkyo-ttounkyo.rhcloud.com');
		} /* else {
			echo "Error el usuario ya existe en la base de datos!";
			die($db->connect_error . " en la línea " . $db->connect_errno);
		}*/
	} else {
		$_SESSION['usuariofront'] = $fbuser;
		header("http://ttounkyo-ttounkyo.rhcloud.com");
	}

	desconectarBD($db);

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