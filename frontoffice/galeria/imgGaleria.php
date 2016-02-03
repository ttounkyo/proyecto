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
		echo "<div>";
		echo '<a class="example-image-link" href="' . $path . "/" . $files[$i] . '" data-lightbox="example-set">
		<img class="example-image" src="' . $path . "/" . $files[$i] . '" alt="" width="300px" height="300px"/>
		</a>';
		echo "</div>";
	}
}

$path = "galeria/imagen";
showFiles($path);
?>