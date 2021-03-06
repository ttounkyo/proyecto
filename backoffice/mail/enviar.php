<?php

require_once '../PHPMailer-master/class.phpmailer.php';
require_once '../../funciones.php';
require_once '../PHPMailer-master/PHPMailerAutoload.php';

if (isset($_REQUEST['id']) && isset($_POST['textmail'])) {

	$id = $_REQUEST['id'];
	$mensaje = $_POST['textmail'];
	$rango = $_POST['amountRange'];

	$db = conectarBD();
	$verproductos = "SELECT * FROM productos WHERE idproducto ='$id'";
	$resul_prod = $db->query($verproductos) or die($db->connect_error . " en la línea " . $db->connect_errno);

	$datos = $resul_prod->fetch_array(MYSQLI_BOTH);
	$marca = $datos['marca'];
	$precio = $datos['precio'];
	$imagen = $datos['ruta'];
	// echo $marca, $precio, $imagen;

	$cliente = "SELECT * FROM usuarios WHERE rol='cliente';";
	$result_cli = $db->query($cliente) or die($db->connect_error . " en la línea " . $db->connect_errno);

	$correo = new PHPMailer(); //Creamos una instancia en lugar usar mail()
	// $correo->IsSMTP();
	// $correo->SMTPAuth = true;
	// $correo->SMTPSecure = 'tls';
	// $correo->Host = "smtp.gmail.com";
	// $correo->Port = 587;
	// $correo->Username = "ttounkyo@gmail.com";
	// $correo->Password = "ttounkyodaw2016";
	$cabeceras = 'ttounkyo@gmail.com';
	//Usamos el SetFrom para decirle al script quien envia el correo
	$correo->SetFrom($cabeceras, "Cuenta de administrador");
	//Usamos el AddReplyTo para decirle al script a quien tiene que responder el correo
	$correo->AddReplyTo($cabeceras, "Cuenta de administrador");
	$correo->Subject = "Oferta!!";
	while ($registro = $result_cli->fetch_array(MYSQLI_BOTH)) {

		$nom = $registro['nombre'];
		$correocliente = $registro['email'];

		//Usamos el AddAddress para agregar un destinatario
		$correo->AddAddress($correocliente);
		//Ponemos el asunto del mensaje
		/*
			 * Si deseamos enviar un correo con formato HTML utilizaremos MsgHTML:
			 * $correo->MsgHTML("<strong>Mi Mensaje en HTML</strong>");
			 * Si deseamos enviarlo en texto plano, haremos lo siguiente:
			 * $correo->IsHTML(false);
			 * $correo->Body = "Mi mensaje en Texto Plano";
		*/
		$correo->MsgHTML("
			<img src='../../frontoffice/imagenes/logo.png' alt='logo'>
			<h1> " . $nom . "</h1><h2>Marca: <i>" . $marca . "</i></h2><br>" . $mensaje . "<br><h2>Preu:  " . $precio . " €</h2><b><em>Descompte: " . $rango . "%</em></b>
			");

		//Si deseamos agregar un archivo adjunto utilizamos AddAttachment
		$correo->AddAttachment($imagen);

		//Enviamos el correo
		if (!$correo->Send()) {
			echo "Hubo un error: " . $correo->ErrorInfo . "<br>";
		} else {
			echo "Mensaje enviado con exito a " . $nom . "<br>";
		}
		sleep(3);
	}
	header("location: ../principal/index.php");
	desconectarBD($db);

}
?>

<form action="index.php?sec=enviar&id=<?php echo $_REQUEST['id'] ?>" method="POST">
	<label for=""> Nombre Producto
		<!-- <input type="text" disabled value="<?php echo $_REQUEST['n'] ?>"> -->
	</label><br>
	<label for="">Mensaje promocional!</label><br>
	<textarea name="textmail" cols="50" rows="5"></textarea><br>
	<input type="range" name="amountRange" min="5" max="90" value="5" oninput="this.form.amountInput.value=this.value"/>
    <input type="number" name="amountInput" min="5" max="90" value="5" oninput="this.form.amountRange.value=this.value" />%<br>
	<button type="submit">Enviar</button>
</form>