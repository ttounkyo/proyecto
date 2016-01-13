<h1>Enviamiento de correo</h1>
<?php
	require_once ('./PHPMailer-master/class.phpmailer.php');
	require_once('./funciones.php');
	if(isset($_REQUEST['id'])){
		$id = $_REQUEST['id'];
		$db = conectarBD();
		$verproductos 	= "SELECT * FROM productos WHERE idproducto = '$id";
		$resul_prod 	= mysqli_query($db,$verproductos);
		// $rutaimg 	= mysqli_fetch_array($resul_prod)['ruta'];
		$titulo 		= mysqli_fetch_array($resul_prod)['titulo'];
		
		$cliente		= "SELECT * FROM usuarios WHERE rol='cliente';"
		$resul_cli		= mysqli_query($db,$cliente);
		while ($registro = mysqli_fetch_array($resul_cli)){
			$email = new PHPMailer();
			$email->From      = 'aa.antonio.delgado@gmail.com';
			$email->FromName  = 'Administrador';
			$email->Subject   = $mensaje = "
											<html>
											<head>
											  <title>Recordatorio de Producto en oferta</title>
											</head>
											<body>
											  <h1>Producto en oferta.</h1>
											  <h2>".$titulo."</h2>
											  <p>Mensaje para ".$regitro['nombre']."</p>
											</body>
											</html>
											";
			$email->Body      = "Promoción!!";
			$email->AddAddress( $regitro['email'] );
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
}
?>