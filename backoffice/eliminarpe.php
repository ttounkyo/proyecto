<?php

	if(isset($_GET['id'])){

		$identificador = $_GET['id'];
		require_once("../funciones.php");
 
		$db = conectarBD();
		
		if($db->connect_errno > 0){
		    die('Imposible conectar [' . $db->connect_error . ']');
		}
		// Eliminar segun cantidad **
		$query = "SELECT * FROM pedidos WHERE idpedido='$identificador';";
		$resultado = $db->query($query) or die('Ocurrio un error ejecutando el query [' . $db->error . ']');;
		$db->query("DELETE FROM pedidos WHERE idpedido='$identificador';");
		desconectarBD($db);
		header('location:index.php?sec=compra');
	}

?>