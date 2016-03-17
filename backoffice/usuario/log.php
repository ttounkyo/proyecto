
<?php
// if($_SESSION['rol'] == "administrador"){
// 	$file = fopen("log.txt", "r+") or exit("Unable to open file!");
// 	//Output a line of the file until the end is reached
// 	while(!feof($file))
// 	{
// 	echo fgets($file). "<br />";
// 	}
// 	fclose($file);

// }elseif($_SESSION['rol'] == "cliente"){
// 	echo "No tienes permisos para ver este archivo.";
// }
?>

<?php
if (isset($_REQUEST['vaciar'])) {
	unlink("./log.txt");
	$file = fopen("./log.txt", "a");
}

$file = fopen("./log.txt", "r+");
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
