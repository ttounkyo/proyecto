<?php
	if($_SESSION['rol'] == "administrador"){
		$file = fopen("log.txt", "r+") or exit("Unable to open file!");
		//Output a line of the file until the end is reached
		while(!feof($file))
		{
		echo fgets($file). "<br />";
		}
		fclose($file);
		
	}elseif($_SESSION['rol'] == "cliente"){
		echo "No tienes permisos para ver este archivo.";
	}
?>