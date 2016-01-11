<?php

	if(isset($_GET['id'])){

		$identificador = $_GET['id'];
		require_once("../funciones.php");
 
		$db = conectarBD();
		
		if($db->connect_errno > 0){
		    die('Imposible conectar [' . $db->connect_error . ']');
		}
		// Eliminar segun cantidad **
		$query = "SELECT * FROM productos WHERE idproducto='$identificador';";
		$resultado = $db->query($query) or die('Ocurrio un error ejecutando el query [' . $db->error . ']');;

		if($row = $resultado->fetch_array(MYSQLI_BOTH)){
			$db->query("DELETE FROM productos WHERE idproducto='$identificador';");
			
			$carpeta = ("img_products/".$identificador);
			foreach(glob($carpeta . "/*") as $archivos_carpeta){
			           unlink($archivos_carpeta);       
			}
			rmdir($carpeta);
			desconectarBD($db);					
			header('location:index.php?sec=producto');			
		}
	}

?>