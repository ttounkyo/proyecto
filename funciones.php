<?php
/**
 *Función que crea y devuelve un objeto de conexión a la base de datos y chequea el estado de la misma.
 */
function conectarBD() {

	$BD = "ttounkyo";
	$server = getenv("OPENSHIFT_MYSQL_DB_HOST");
	if (!empty($server)) {
		$usuario = "admin9kDV7Ta";
		$pass = "XnDEf3TQ2a68";
	} else {
		$server = "localhost";
		$usuario = "root";
		$pass = "";
	}

	//variable que guarda la conexión de la base de datos
	$conexion = mysqli_connect($server, $usuario, $pass, $BD);
	//devolvemos el objeto de conexión para usarlo en las consultas
	return $conexion;
}

/*Desconectar la conexion a la base de datos*/
function desconectarBD($conexion) {
	//Cierra la conexión y guarda el estado de la operación en una variable
	$close = mysqli_close($conexion);
	//devuelve el estado del cierre de conexión
	return $close;
}
// $db = new mysqli("mysql://$OPENSHIFT_MYSQL_DB_HOST:$OPENSHIFT_MYSQL_DB_PORT/", "admin9kDV7Ta", "XnDEf3TQ2a68", "ttounkyo");

if (!function_exists("hash_equals")) {
	function hash_equals($a, $b) {
		return substr_count($a ^ $b, "\0") * 2 === strlen($a . $b);
	}
}

// Mirar lo que devuelve bien los parametros.
// function breadcrumbs($separator = ' &raquo; ', $home = 'Home') {
// 	$path = array_filter(explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)));
// 	$base = 'https' . '://' . $_SERVER['HTTP_HOST'] . '/';
// 	$breadcrumbs = array('<a href="' . $base . '">' . $home . '</a>');

// 	$last = end(array_keys($path));

// 	foreach ($path as $x => $crumb) {
// 		$title = ucwords(str_replace(array('.php', '_'), array('', ' '), $crumb));

// 		if ($x != $last) {
// 			$breadcrumbs[] = '<a href="' . $base . $crumb . '">' . $title . '</a>';
// 		} else {
// 			$breadcrumbs[] = $title;
// 		}
// 	}
// 	return implode($separator, $breadcrumbs);
// }

function mail_attachment($filename, $path, $mailto, $from_mail, $from_name, $replyto, $subject, $message) {
	$file = $path . $filename;
	$file_size = filesize($file);
	$handle = fopen($file, "r");
	$content = fread($handle, $file_size);
	fclose($handle);
	$content = chunk_split(base64_encode($content));
	$uid = md5(uniqid(time()));
	$name = basename($file);

	$header = "From: " . $from_name . " <" . $from_mail . ">\n";
	$header .= "Reply-To: " . $replyto . "\n";
	$header .= "MIME-Version: 1.0\n";
	$header .= "Content-Type: multipart/mixed; boundary=\"" . $uid . "\"\n\n";
	$emessage = "--" . $uid . "\n";
	$emessage .= "Content-type:text/html; charset=iso-8859-1\n";
	$emessage .= "Content-Transfer-Encoding: 7bit\n\n";
	$emessage .= $message . "\n\n";
	$emessage .= "--" . $uid . "\n";
	$emessage .= "Content-Type: application/octet-stream; name=\"" . $filename . "\"\n"; // use different content types here
	$emessage .= "Content-Transfer-Encoding: base64\n";
	$emessage .= "Content-Disposition: attachment; filename=\"" . $filename . "\"\n\n";
	$emessage .= $content . "\n\n";
	$emessage .= "--" . $uid . "--";

	mail($mailto, $subject, $emessage, $header);
	if (mail($mailto, $subject, "", $header)) {
		echo "mail send ... OK"; // or use booleans here
	} else {
		echo "mail send ... ERROR!";
	}

}
?>