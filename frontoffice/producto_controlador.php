<?php
require_once "./vendor/autoload.php";
require_once "../funciones.php";
$server = new soap_server();
$server->configureWSDL('productosopa', 'urn:ProductModelo', 'http://localhost/DAW/DEWS/hola/frontoffice/producto_controlador.php');
$server->wsdl->schemaTargetNamespaces = 'urn:ProductModelo';
$server->wsdl->addComplexType(
	'Categoria',
	'complexType',
	'struct',
	'all',
	'',
	array(
		'idcategoria' => array('name' => 'idcategoria', 'type' => 'xsd:integer'),
		'nombre' => array('name' => 'nombre', 'type' => 'xsd:string'),
	));

$server->wsdl->addComplexType(
	'Categorias',
	'complexType',
	'array',
	'sequence',
	'',
	array(),
	array(
		array(
			'ref' => 'SOAP-ENC:arrayType',
			'wsdl:arrayType' => 'tns:Categoria[]',
		),
	),
	'tns:Categoria'
);

function getCategoria() {
	$db = conectarBD();
	$query = 'SELECT * FROM categorias';
	$resultado = $db->query($query);

	$categorias = array();

	while ($row = $resultado->fetch_assoc()) {
		array_push($categorias, $row);
	}
	return $categorias;
}

$server->register('getCategoria',
	array(),
	array('return' => 'tns:Categorias'),
	'urn:ProductModelo',
	'urn:ProductModelo#getCategoria',
	'rpc',
	'encoded',
	'Obtener Categorias');

$POST_DATA = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : '';
@$server->service($POST_DATA);

?>