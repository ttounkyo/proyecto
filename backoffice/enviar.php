<h1>Enviamiento de correo</h1>
<?php

	require_once('../funciones.php');

	if(isset($_REQUEST['id']) && isset($_POST['textmail'])){

		$id = $_REQUEST['id'];
		$mensaje = $_POST['textmail'];

		$db = conectarBD();
		$verproductos 	= "SELECT marca FROM productos WHERE idproducto = {$id}";
		$resul_prod 	= $db->query($verproductos) or die ($db->connect_error. " en la línea " . $db->connect_error);
		// $rutaimg 	= mysqli_fetch_array($resul_prod)['ruta'];
		$titulo 		= $resul_prod->fetch_array(MYSQLI_BOTH)['marca'];


		$cliente		= "SELECT * FROM usuarios WHERE rol='cliente';";
		$result_cli 	= $db->query($cliente) or die ($db->connect_error. " en la línea " . $db->connect_error);
		
		while ($registro = $result_cli->fetch_array(MYSQLI_BOTH)){

			$nom 			= $registro['nombre'];
			$correo 		= $registro['email'];
			$cabeceras 		= 'From: webmaster@example.com';

			if(mail($correo, $titulo, $mensaje, $cabeceras)){//,
				echo "<br>mensaje enviado!! a " . $nom ."<br>";
			}else{
				echo "error al enviar el mensaje.";
			}
			sleep(3);
		}
			
		desconectarBD($db);

	}
?>

<form action="index.php?sec=enviar&id=<?php echo $_REQUEST['id']?>" method="POST">
	<label for=""> Nombre Producto
		<!-- <input type="text" disabled value="<?php echo $_REQUEST['n']?>"> -->
	</label><br>
	<label for="">Mensaje promocional!</label><br>
	<textarea name="textmail" cols="50" rows="5"></textarea><br>
	<button type="submit">Enviar</button>
</form>