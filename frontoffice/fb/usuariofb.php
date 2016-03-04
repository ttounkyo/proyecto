<?php
require_once "../../funciones.php";
$fbid = $_SESSION['FBID'];
$fbuname = $_SESSION['USERNAME'];
$fbfullname = $_SESSION['FULLNAME'];
$femail = $_SESSION['EMAIL'];
echo $fbfullname;
$db = conectarBD();
if ($db->connect_errno > 0) {
	die('Imposible conectar [' . $db->connect_error . ']');
}

$count = "SELECT COUNT(*) FROM usuarios WHERE email = '$femail';";
echo $count;
$cont = "56706V.vDo81k";
if ($count > 1) {
	echo "Ya esta registrado a olvidado su contraseña";
} else {
	$query = "INSERT INTO usuarios(username,nombre,email,password)
			VALUES ('$fbuname','$fbfullname','$femail','$cont');";

	if ($resul = $db->query($query)) {
		echo "Usuario añadido";
	} else {
		echo "Error el usuario ya existe en la base de datos!";
		die($db->connect_error . " en la línea ");
	}
}

desconectarBD($db);
?>