<?php

	if(isset($_GET['id'])){

		$identificador = $_GET['id'];
		$db = new mysqli('db608606955.db.1and1.com', 'dbo608606955', '162534Aa', 'db608606955');
		
		if($db->connect_errno > 0){
		    die('Imposible conectar [' . $db->connect_error . ']');
		}
		// Eliminar segun cantidad **
		$query = "SELECT * FROM pedidos WHERE idpedido='$identificador';";
		$resultado = $db->query($query) or die('Ocurrio un error ejecutando el query [' . $db->error . ']');;
		$db->query("DELETE FROM pedidos WHERE idpedido='$identificador';");
		header('location:index.php?sec=compra');
	}

?>