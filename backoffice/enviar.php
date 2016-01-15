<h1>Enviamiento de correo</h1>
<?php

	require_once('../funciones.php');

	if(isset($_REQUEST['id'])){
		$id = $_REQUEST['id'];
		$db = conectarBD();
		$verproductos 	= "SELECT titulo FROM productos WHERE idproducto = {$id}";
		$resul_prod 	= $db->query($verproductos) or die ($db->connect_error. " en la línea " . $db->connect_error);
		// $rutaimg 	= mysqli_fetch_array($resul_prod)['ruta'];
		$titulo 		= $resul_prod->fetch_array(MYSQLI_BOTH)['titulo'];

		
		$cliente		= "SELECT * FROM usuarios WHERE rol='cliente';";
		$result_cli 	= $db->query($cliente) or die ($db->connect_error. " en la línea " . $db->connect_error);
		
		while ($registro = $result_cli->fetch_array(MYSQLI_BOTH)){

			$nom 			= $registro['nombre'];
			$correo 		= $registro['email'];
			$para      		= 'nobody@example.com';
			$titulo    		= 'Promoción!!!';
			$mensaje   		= "
							<html>
							<head>
							  <title>Recordatorio de Producto en oferta</title>
							</head>
							<body>
							  <h1>Producto en oferta.</h1>
							  <h2>".$titulo."</h2>
							  <p>Mensaje para ".$nom."</p>
							</body>
							</html>
							";
			$cabeceras 		= 'From: webmaster@example.com' . "\r\n" .
			    'Reply-To: webmaster@example.com' . "\r\n" .
			    'X-Mailer: PHP/' . phpversion();

			mail($para, $titulo, $mensaje, $cabeceras);
		}
			
		desconectarBD($db);

	}
?>