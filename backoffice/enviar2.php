<h1>Enviamiento de correo</h1>
<?php

	require_once ('./PHPMailer-master/class.phpmailer.php');
	require_once('../funciones.php');
	require_once('./PHPMailerAutoload.php');

	if(isset($_REQUEST['id'])){
		$id = $_REQUEST['id'];
		$db = conectarBD();
		$verproductos 	= "SELECT titulo FROM productos WHERE idproducto = '$id";
		$resul_prod 	= mysqli_query($db,$verproductos);
		// $rutaimg 	= mysqli_fetch_array($resul_prod)['ruta'];
		$titulo 		= mysqli_fetch_array($resul_prod)['titulo'];
		
		$cliente		= "SELECT * FROM usuarios WHERE rol='cliente';";
		$result_cli 	= $db->query($cliente) or die ($db->connect_error. " en la línea ");

		$email 			  = new PHPMailer();


		$email->From      = 'aa.antonio.delgado@gmail.com';
		// $email-> poner el usuario y contraseña
		$email->FromName  = 'Administrador';
		$email->Subject   = "Promoción!!";
		
		while ($registro = $result_cli->fetch_array(MYSQLI_BOTH)){

			$nom 			  = $regitro['nombre'];
			$correo 		  = $regitro['email'];
		
			$mensaje 		  = "
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
			$email->Body      = $mensaje;
			
			$email->AddAddress($correo);
			//$email->AddAddress( 'desti2' );

			// $file_to_attach = $_SERVER['DOCUMENT_ROOT'].$ruta;

			// $email->AddAttachment( $file_to_attach , 'logo.png' );

			//$email->AddAttachment( $_SERVER['DOCUMENT_ROOT']."/img/cristalina.jpg" , 'cristalina' );

			if($email->Send()){
				echo "mensaje enviado al usuario ";
			}else{
				echo "no enviado";
			}
		}
			
		desconectarBD($db);



		$mail = new PHPMailer;

		//$mail->SMTPDebug = 3;                               // Enable verbose debug output

		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtp1.example.com;smtp2.example.com';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'user@example.com';                 // SMTP username
		$mail->Password = 'secret';                           // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                    // TCP port to connect to

		$mail->setFrom('from@example.com', 'Mailer');
		$mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
		$mail->addAddress('ellen@example.com');               // Name is optional
		$mail->addReplyTo('info@example.com', 'Information');
		$mail->addCC('cc@example.com');
		$mail->addBCC('bcc@example.com');

		$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
		$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
		$mail->isHTML(true);                                  // Set email format to HTML

		$mail->Subject = 'Here is the subject';
		$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
		$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		if(!$mail->send()) {
		    echo 'Message could not be sent.';
		    echo 'Mailer Error: ' . $mail->ErrorInfo;
		} else {
		    echo 'Message has been sent';
		}

	}
?>