<h1>Enviamiento de correo</h1>
<?php

	require_once('../funciones.php');

	if(isset($_REQUEST['id']) && isset($_REQUEST['textmail'])){
		$id = $_REQUEST['id'];
		$mensaje = $_REQUEST['textmail'];
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
			$para      		= $correo;
			$titulo    		= 'Promoción!!!';s
			$cabeceras 		= 'From: webmaster@example.com' . "\r\n" .
			    'Reply-To: webmaster@example.com' . "\r\n" .
			    'X-Mailer: PHP/' . phpversion();

			mail($para, $titulo, $mensaje, $cabeceras);
		}
			
		desconectarBD($db);

	}
?>

<form action="index.php?sec=enviar&id<? echo $_REQUEST['id'] ?>" method="POST">
	<label for=""> Nombre Producto
		<input type="text" disabled value="<?echo $_REQUEST['n']?>">
	</label>
	<textarea name="textmail" cols="30" rows="10">
	</textarea>
</form>