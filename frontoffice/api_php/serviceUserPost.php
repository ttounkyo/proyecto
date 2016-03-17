<?php

require "../torophp/toro.php";
require "../../funciones.php";
header("Content-Type: application/json");

ToroHook::add("404", function () {
	echo "Not found";
});

class DBHandler {

	function get($id = null, $idped = null) {
		// echo $id;
		// exit;
		if (!empty($id)) {
			try {
				$db = conectarBD();
				$q = '';

				if (!empty($idped)) {
					$q = " AND idpedido = " . $idped;
				}
				$query = "SELECT * FROM pedidos WHERE username = '{$id}'" . $q;

				if (!$resul = $db->query($query)) {
					echo json_encode(array("Error" => $db->error));
					return;
				}

				$pedidos = array();
				while ($row = $resul->fetch_assoc()) {
					array_push($pedidos, $row);
				}
				echo json_encode($pedidos);
				desconectarBD($db);
				return;

			} catch (Exception $e) {
				// $dbh->rollBack();
				echo json_encode(array("Mensaje" => $e->getMessage()));
			}
		}
	}

	function post($id = null) {
		if (!empty($id)) {

			$data = $_POST;
			try {
				$db = conectarBD();
				$query = "INSERT INTO pedidos(idmetodopago,estado, fecha, username)
					VALUES ('{$data["idmetodopago"]}','{$data["estado"]}', '{$data["fecha"]}','{$id}');";

				if ($resul = $db->query($query)) {
					echo json_encode(array("Mensaje" => "ok"));
				} else {
					echo json_encode(array("Mensaje" => $db->connect_error));
				}

				desconectarBD($db);

			} catch (Exception $e) {
				// $dbh->rollBack();
				echo json_encode(array("Mensaje" => $e->getMessage()));
			}
		}
	}

}

Toro::serve(array(
	"/" => "DBHandler",
	"/:alpha" => "DBHandler",
	"/:alpha/:alpha" => "DBHandler",
));
?>