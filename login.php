<h1>LOGIN</h1>
<div class="login" >
	<form action='index.php?sec=login' method='POST'>
		<div><label for="">Usuario</label><br><input type="text" name="nomuser"></div>
		<div><label for="">Contraseña</label><br><input type="password" name="pass"></div><br>
		<div><button class="btn" type='submit' name='enviar'>Enviar</button></div>
	</form>
</div>

<?php 
	if(isset($_POST['nomuser']) && isset($_POST['pass'])){
		$user = $_POST['nomuser'];
		$passwd = $_POST['pass'];

		$db = new mysqli('localhost', 'root', '', 'ttounkyo');
		if($db->connect_errno ){
		    die('Imposible conectar [' . $db->connect_errno . ']') . $db->connect_error;
		}
		
		$loginuser = "SELECT * FROM usuarios WHERE username='$user' AND password='$passwd';";
		

		if($resultado = $db->query($loginuser)){

			if($row = $resultado->fetch_array(MYSQLI_BOTH)){
			
			$_SESSION['usuario'] = $user;

			$file = fopen("log.txt", "a+");
				if(!$file){
					echo "No es pot obrir el file";
				}
				fputs($file,"El usuario ". $user . " ha accedido el día. " . date("y/m/d H:s:i" , time()) . " Satisfactoriamente" .PHP_EOL);

			fclose($file);

			header('location:index.php?sec=producto');
		
			}else{
				$file = fopen("log.txt", "a+");
				if(!$file){
					echo "No es pot obrir el file";
				}
				fwrite($file,"El usuario ". $user . " ha accedido el día. " . date("y/m/d H:s:i" , time()) . " incorrectamente." .PHP_EOL);
				fclose($file);
				header('location:index.php?sec=login');
			}
		
		}else{
		
			die('Ocurrio un error ejecutando el query [' . $db->error . ']');
		
		}
		
		$db->close();
	}
	// Hacerlo con comprobadores de pass 
 ?>