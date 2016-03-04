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
	$request = new FacebookRequest($session, 'GET', '/me');
	$response = $request->execute();
	// get response
	$graphObject = $response->getGraphObject();
	$fbid = $graphObject->getProperty('id'); // To Get Facebook ID
	$fbuname = $graphObject->getProperty('username'); // To Get Facebook Username
	$fbfullname = $graphObject->getProperty('name'); // To Get Facebook full name
	$femail = $graphObject->getProperty('email'); // To Get Facebook email ID
	/* ---- Session Variables -----*/
	$_SESSION['FBID'] = $fbid;
	$_SESSION['USERNAME'] = $fbuname;
	$_SESSION['FULLNAME'] = $fbfullname;
	$_SESSION['EMAIL'] = $femail;
	/* ---- header location after session ----*/
	require_once "../../funciones.php";

	echo $fbfullname;
	$db = conectarBD();
	if ($db->connect_errno > 0) {
		die('Imposible conectar [' . $db->connect_error . ']');
	}

	$count = "SELECT COUNT(*) FROM usuarios WHERE email = '$femail';";
	$result = $db->query($count);
	$row = $result->fetch_array(MYSQL_BOTH);
	echo "ljnlajks" . $row;
	$cont = "56706V.vDo81k";

	if ($row == 0) {
		$query = "INSERT INTO usuarios(username,nombre,email,password)
			VALUES ('$fbuname','$fbfullname','$femail','$cont');";

		if ($resul = $db->query($query)) {
			echo "Usuario añadido";
		} else {
			echo "Error el usuario ya existe en la base de datos!";
			die($db->connect_error . " en la línea ");
		}
	} else {
		echo "Ya esta registrado a olvidado su contraseña";
		header("http://ttounkyo-ttounkyo.rhcloud.com/");
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