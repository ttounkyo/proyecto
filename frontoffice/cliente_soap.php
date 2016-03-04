<?php
require_once "./vendor/autoload.php";

$cliente = new nusoap_client("http://localhost/DAW/DEWS/hola/frontoffice/producto_controlador.php?wsdl", true);
$error = $cliente->getError();

if ($error) {
	echo "<h2>Error </h2><pre>" . $error . "</pre>";
}

$result = $cliente->call("getCategoria",
	array()
);

if ($cliente->fault) {
	echo "<h2>Fault</h2><pre>";
	print_r($result);
	echo "</pre>";
} else {
	$error = $cliente->getError();
	if ($error) {
		echo "<h2>Error </h2><pre>" . $error . "</pre>";
	} else {
		print_r($result);
	}
}

?>
