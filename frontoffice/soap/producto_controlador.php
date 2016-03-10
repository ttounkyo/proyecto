<?php
require_once "./vendor/autoload.php";
require_once "../funciones.php";

$server = new soap_server();
$server->configureWSDL('productosopa', 'urn:ProductModelo', 'http://localhost/DAW/DEWS/hola/frontoffice/producto_controlador.php');
$server->wsdl->schemaTargetNamespaces = 'urn:ProductModelo';

// categoria
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

// ProductosByCategoria

$server->wsdl->addComplexType(
	'Producto',
	'complexType',
	'struct',
	'all',
	'',
	array(
		'idproducto' => array('name' => 'idproducto', 'type' => 'xsd:integer'),
		'titulo' => array('name' => 'titulo', 'type' => 'xsd:string'),
		'descripcion' => array('name' => 'descripcion', 'type' => 'xsd:string'),
		'precio' => array('name' => 'precio', 'type' => 'xsd:integer'),
		'marca' => array('name' => 'marca', 'type' => 'xsd:string'),
		'ruta' => array('name' => 'ruta', 'type' => 'xsd:string'),
		'cantidad' => array('name' => 'cantidad', 'type' => 'xsd:integer'),
		'createAt' => array('name' => 'createAt', 'type' => 'xsd:integer'),
		'idcategoria' => array('name' => 'idcategoria', 'type' => 'xsd:integer'),

	));

$server->wsdl->addComplexType(
	'Productos',
	'complexType',
	'array',
	'sequence',
	'',
	array(),
	array(
		array(
			'ref' => 'SOAP-ENC:arrayType',
			'wsdl:arrayType' => 'tns:Producto[]',
		),
	),
	'tns:Producto'
);

function getCategoria() {
	$db = conectarBD();
	$query = "SELECT * FROM categorias";
	$resultado = $db->query($query);

	$categorias = array();

	while ($row = $resultado->fetch_assoc()) {
		array_push($categorias, $row);
	}
	return $categorias;
}

function getProductoCategoria($cat, $group = "") {
	$db = conectarBD();
	$group = !!$group ? "GROUP BY " . $group : "";
	$cat = !!$cat ? "WHERE idcategoria = " . $cat : "";
	$query = "SELECT * FROM productos NATURAL JOIN categorias_productos $cat $group";
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

$server->register('getProductoCategoria',
	array(
		"idcategoria" => "xsd:integer",
		"groupby" => "xsd:string",
	),
	array('return' => 'tns:Productos'),
	'urn:ProductModelo',
	'urn:ProductModelo#getProductoCategoria',
	'rpc',
	'encoded',
	'Obtener Productos por Categorias');

$POST_DATA = isset($GLOBALS['HTTP_RAW_POST_DATA']) ? $GLOBALS['HTTP_RAW_POST_DATA'] : '';
@$server->service($POST_DATA);

?>