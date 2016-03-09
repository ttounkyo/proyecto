<h1>Enviamiento de correo</h1>
<?php

require_once './PHPMailer-master/class.phpmailer.php';
require_once '../../funciones.php';
require_once './PHPMailerAutoload.php';

if (isset($_REQUEST['id'])) {
	$id = $_REQUEST['id'];
	$db = conectarBD();
	$verproductos = "SELECT titulo FROM productos WHERE idproducto = '$id";
	$resul_prod = mysqli_query($db, $verproductos);
	$titulo = mysqli_fetch_array($resul_prod)['titulo'];

	$cliente = "SELECT * FROM usuarios WHERE rol='cliente';";
	$result_cli = $db->query($cliente) or die($db->connect_error . " en la línea " . $db->connect_errno);

	$email = new PHPMailer();

	$email->From = 'aa.antonio.delgado@gmail.com';
	// $email-> poner el usuario y contraseña
	$email->FromName = 'Administrador';
	$email->Subject = "Promoción!!";

	while ($registro = $result_cli->fetch_array(MYSQLI_BOTH)) {

		$nom = $regitro['nombre'];
		$correo = $regitro['email'];
		$ruta = $regitro['ruta'];

		$email->MsgHTML("<h1>" . $nomP . "</h1><p>" . $descr . "</p><br>" . $text . "<br><h2>Preu: " . $preu . "</h2>
		<b><em>Descompte: " . $descompte . "</em></b>");
		$email->Body = $mensaje;

		$email->AddAddress($correo);
		//$email->AddAddress( 'desti2' );

		$file_to_attach = $_SERVER['DOCUMENT_ROOT'] . $ruta;

		$email->AddAttachment($file_to_attach, 'logo');

		//$email->AddAttachment( $_SERVER['DOCUMENT_ROOT']."/img/cristalina.jpg" , 'cristalina' );

		if ($email->Send()) {
			echo "mensaje enviado al usuario ";
		} else {
			echo "no enviado";
		}
	}

	desconectarBD($db);
}
?>