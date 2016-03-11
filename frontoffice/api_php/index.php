<?php
require "../torophp/toro.php";
require "../../funciones.php";
ToroHook::add("404", function () {
	echo "Not found";
});

class MainHandler {
	function get() {

		$db = conectarBD();
		$r = $db->query("SELECT * FROM pedidos NATURAL JOIN pedidos_has_productos WHERE username ='antonio' GROUP BY idpedido");
		$pedidos = array();
		while ($row = $r->fetch_assoc()) {
			array_push($pedidos, $row);
		}
		echo json_encode($pedidos);
	}
}
class PaternHandler {
	function get($patern) {
		$db = conectarBD();
		$r = $db->query("SELECT * FROM pedidos NATURAL JOIN pedidos_has_productos WHERE username ='{$patern}' GROUP BY idpedido");
		$pedidos = array();
		while ($row = $r->fetch_assoc()) {
			array_push($pedidos, $row);
		}
		echo json_encode($pedidos);
	}
}
Toro::serve(array(
	"/" => "MainHandler",
	"/:alpha" => "PaternHandler",
));

?>