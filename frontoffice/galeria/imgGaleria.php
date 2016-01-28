<?php

function showFiles($path) {

	$dir = opendir($path);
	$files = array();
	while ($current = readdir($dir)) {
		if ($current != "." && $current != "..") {
			if (is_dir($path . "/" . $current)) {
				showFiles($path . '/' . $current);
			} else {
				$files[] = $current;
			}
		}
	}

	echo "<h1>" . str_replace('galeria/imagen/', "", $path) . "</h1>";
	for ($i = 0; $i < count($files); $i++) {
		echo "<div class='imgGaleria'>";
		echo "<img class='imgGaleria' src='" . $path . "/" . $files[$i] . "'></img>";
		echo "</div>";
	}
	?>


<?php
}

$path = "galeria/imagen";
showFiles($path);
?>