
<?php

if (isset($_GET['vaciar'])) {
	unlink("log.txt");
	$file = fopen("log.txt", "a");
}

$file = fopen("log.txt", "r+");
if (!$file) {
	echo "No se pude abrir";
}
$contenido = "";
while (!feof($file)) {
	$linea = fgets($file);

	$contenido = $contenido . "\r\n" . $linea . "\r\n";
}

?>
 <textarea cols="60" rows="30" ><?php echo $contenido ?></textarea>
<form action="index.php?sec=log" method="POST">
	<a href="index.php?sec=log"><button type="submit" name="vaciar" value="yes">Vacia</button></a>
</form>