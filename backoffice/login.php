<?php

	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	session_start();
	if(isset($_POST['nomuser']) && isset($_POST['pass'])){
		$user = $_POST['nomuser'];
		$passwd = $_POST['pass'];

		require_once("../funciones.php");
		$db = conectarBD();

		$loginuser = "SELECT username, rol , password FROM usuarios WHERE username='$user';";
		$result = mysqli_query($db,$loginuser);
		$row 	= mysqli_fetch_array($result);
		//password_verify
			if(password_verify($passwd , $row['password'])){

				$_SESSION['rol'] = $row['rol'];

				$file = fopen("log.txt", "a+");
					if(!$file){
						echo "No es pot obrir el file";
					}
					fputs($file,"El usuario ". $row['username'] . " ha accedido el día. " . date("y/m/d H:s:i" , time()) . " Satisfactoriamente" .PHP_EOL);

				fclose($file);
				if($_SESSION['rol'] === 'administrador'){
					$_SESSION['usuario'] = $row['username'];
				  	header('location:index.php?sec=index');
				}elseif($_SESSION['rol'] === 'cliente'){
					$_SESSION['usuariofront'] = $row['username'];
				 	header('location:../frontoffice/index.php');
				}
				
			
			}else{
				$file = fopen("log.txt", "a+");
				if(!$file){
					echo "No es pot obrir el file";
				}
				fwrite($file,"El usuario ". $row['username'] . " ha accedido el día. " . date("y/m/d H:s:i" , time()) . " Incorrectamente." .PHP_EOL);
				fclose($file);
				header('location:index.php?sec=login');
			}
		desconectarBD($db);
	}
	// Hacerlo con comprobadores de pass 
 ?>

<?php 
	if(isset($_SESSION['usuario']) || empty($_SESSION['usuario'])){
 ?>
 	<!DOCTYPE html>
 	<html lang="en">
 	<head>
 		<meta charset="UTF-8">
 		<title>Document</title>
 	</head>
 	<body>
 		<h1>LOGIN</h1>
		<div class="login" >
			<form action='login.php' method='POST'>
				<div><label for="">Usuario</label><br><input type="text" name="nomuser"></div>
				<div><label for="">Contraseña</label><br><input type="password" name="pass"></div><br>
				<div><button class="btn" type='submit' name='enviar'>Enviar</button></div>
			</form>
		</div>
 	</body>
 	</html>
	
<?php 
	} 
 ?>
