<?php

$name = 'antonio';
$url = 'http://localhost/DAW/DEWS/hola/frontoffice/api_php/serviceUserPost.php/' . $name;

$data = array(
	'idpedido' => '300',
	'idmetodopago' => 'ingreso banco',
	'estado' => 'pedido',
	'fecha' => '',
	'username' => 'antonio');
$options = array(
	'http' => array(
		'header' => "Content-type: application/x-www-form-urlencoded\r\n",
		'method' => 'POST',
		'content' => http_build_query($data),
	),
);

$context = stream_context_create($options);
$result = file_get_contents($url, false, $context);

echo $result;
?>