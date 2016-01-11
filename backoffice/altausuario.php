<form class='usuario' action='index.php?sec=altausuario' method='POST'>
	<h1>Alta de usuarios</h1>
	<div><label for="nomuser">Nombre de usuario: </label><br>	<input type='text' value='' name='username' /></div>
	<div><label for="nombre">Nombre: </label><br>	<input type='text' value='' name='nombre' /></div>
	<div><label for="apellido">Apellidos: </label><br>	<input type='text' value='' name='apellidos' /></div>
	<div><label for="email">eMAIL: </label><br>	<input type='text' value='' name='email' /></div>
	<div><label for="telefono">Telefono: </label><br>	<input type='text' value='' name='telefono' /></div>
	<div><label for="direccion">Direccion: </label><br>	<input type='text' value='' name='direccion' /></div>
	<!-- 	<div><label for="rol">Rol: </label><input type='text' value='' name='rol' /></div>
 -->	<div><label for="pass">Contraseña: </label><br>	<input type='password' name='passwd' /></div><br>	
	<div ><button class="btn" type='submit' name='enviar'>Enviar</button></div>
</form>

	<?php 
		if(isset($_POST['username']) && isset($_POST['passwd'])){
			$nuser 		= $_REQUEST['username'];
			$nom 		= $_REQUEST['nombre'];
			$ape 		= $_POST['apellidos'];
			$email 		= $_POST['email'];
			$tlf 		= $_POST['telefono'];
			$address 	= $_POST['direccion'];
			// $rol 		= $_POST['rol'];
			$pass 		= $_REQUEST['passwd'];

			

			$db = new mysqli("mysql://$OPENSHIFT_MYSQL_DB_HOST:$OPENSHIFT_MYSQL_DB_PORT/", "admin9kDV7Ta", "XnDEf3TQ2a68", "ttounkyo");
			if($db->connect_errno > 0){
			    die('Imposible conectar [' . $db->connect_error . ']');
			}
				$query = "INSERT INTO usuarios(username,nombre,apellidos,email,telefono,direccion,password)
					VALUES ('$nuser','$nom','$ape','$email','$tlf','$address','$pass');";
				

				if($resul = $db->query($query)){
					echo "Usuario añadido";
				}else{
					echo "Error el usuario ya existe en la base de datos!";
					die ($db->connect_error. " en la línea ");
				}
			$db->close();
		}

		?>