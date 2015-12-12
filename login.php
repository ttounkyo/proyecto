<?php 
	session_start();
	$db = new mysqli('localhost', 'root', '', 'ttounkyo');
	if(isset($_POST['nomuser']) && isset($_POST['pass'])){
		$user = $_POST['nomuser'];
		$passwd = $_POST['pass'];

		$loginuser = "SELECT username, rol , password FROM usuarios WHERE username='$user' AND rol='administrador';";
		$result = mysqli_query($db,$loginuser);
		$row 	= mysqli_fetch_array($result);
		//password_verify

			if(password_verify($passwd , $row['password'])){
			
				$_SESSION['usuario'] = $row['username'];

				$file = fopen("log.txt", "a+");
					if(!$file){
						echo "No es pot obrir el file";
					}
					fputs($file,"El usuario ". $row['username'] . " ha accedido el día. " . date("y/m/d H:s:i" , time()) . " Satisfactoriamente" .PHP_EOL);

				fclose($file);

				header('location:index.php?sec=index');
			
			}else{
				$file = fopen("log.txt", "a+");
				if(!$file){
					echo "No es pot obrir el file";
				}
				fwrite($file,"El usuario ". $row['username'] . " ha accedido el día. " . date("y/m/d H:s:i" , time()) . " incorrectamente." .PHP_EOL);
				fclose($file);
				//header('location:index.php?sec=login');
			}
		$db->close();
	}
	// Hacerlo con comprobadores de pass 
 ?>

<?php 
	if(empty($_SESSION['usuario'])){
 ?>
<h1>LOGIN</h1>
<div class="login" >
	<form action='login.php' method='POST'>
		<div><label for="">Usuario</label><br><input type="text" name="nomuser"></div>
		<div><label for="">Contraseña</label><br><input type="password" name="pass"></div><br>
		<div><button class="btn" type='submit' name='enviar'>Enviar</button></div>
	</form>
</div>
<?php 
	}
 ?>
