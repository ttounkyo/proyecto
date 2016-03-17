<?php

$name = 'antonio';
$url = 'http://ttounkyo-ttounkyo.rhcloud.com/frontoffice/api_php/serviceUserPost.php/';

$data = array(
	'idmetodopago' => 'ingreso banco',
	'estado' => 'pedido',
	'fecha' => '');
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