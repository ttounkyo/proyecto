<h1>Enviamiento de correo</h1>
<?php

require_once '../../funciones.php';

if (isset($_REQUEST['id']) && isset($_POST['textmail'])) {

	$uid = $_REQUEST['id'];
	$mensaje = $_POST['textmail'];
	$emessage = "--" . $uid . "\n";
	$emessage .= "Content-type:text/html; charset=iso-8859-1\n";
	$emessage .= "Content-Transfer-Encoding: 7bit\n\n";
	$emessage .= $message . "\n\n";
	$emessage .= "--" . $uid . "\n";
	$emessage .= "Content-Type: application/octet-stream; name=\"" . $filename . "\"\n"; // use different content types here
	$emessage .= "Content-Transfer-Encoding: base64\n";
	$emessage .= "Content-Disposition: attachment; filename=\"" . $filename . "\"\n\n";
	$emessage .= $mensaje . "\n\n";
	$emessage .= "--" . $uid . "--";
	$db = conectarBD();
	$verproductos = "SELECT marca FROM productos WHERE idproducto = {$id}";
	$resul_prod = $db->query($verproductos) or die($db->connect_error . " en la línea " . $db->connect_error);

	$titulo = $resul_prod->fetch_array(MYSQLI_BOTH)['marca'];
	$cliente = "SELECT * FROM usuarios WHERE rol='cliente';";
	$result_cli = $db->query($cliente) or die($db->connect_error . " en la línea " . $db->connect_error);

	while ($registro = $result_cli->fetch_array(MYSQLI_BOTH)) {

		$nom = $registro['nombre'];
		$correo = $registro['email'];
		$cabeceras = 'From: webmaster@example.com';

		if (mail($correo, $titulo, $emessage, $cabeceras)) {
//,
			echo "<br>mensaje enviado!! a " . $nom . "<br>";
		} else {
			echo "error al enviar el mensaje.";
		}
		sleep(3);
	}

	desconectarBD($db);

}
?>

<form action="index.php?sec=enviar&id=<?php echo $_REQUEST['id'] ?>" method="POST">
	<label for=""> Nombre Producto
		<!-- <input type="text" disabled value="<?php echo $_REQUEST['n'] ?>"> -->
	</label><br>
	<label for="">Mensaje promocional!</label><br>
	<textarea name="textmail" cols="50" rows="5"></textarea><br>
	<button type="submit">Enviar</button>
</form>