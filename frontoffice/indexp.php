<?php 
	session_start();
	if (!isset($_GET['sec']))
	$seccion = null;
	else
	$seccion = $_GET['sec'];

	// if($seccion == 'logout'){
	// 	unset($_SESSION['usuariofront']);
	// 	// ob_start();
	// 	// ob_get_clean();
	// 	header("location:indexp.php");
	// }

	
 ?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>HOME</title>
		<link rel="stylesheet" href="css/principal.css">
	</head>
	<body>
	<!-- Hacer cada archivo contenido de la pagina en otro porque será mucha la complicacion que tendremos
		Podemos poner en otra carpeta y gestionar el FrontOffice -->
		<header>
			<a href="indexp.php"><img id="logo" src="imagenes/logo.png" alt="logo"></a>
			<?php 
				require_once("nav.php");
			 ?>
		</header>
		<aside>
			<div class="busc">
				<h1>BUSCADOR</h1>
				<form id="buscador" name="buscador" method="post" action="indexp.php?sec=buscador">
					<input id="buscar" name="buscar" type="search" placeholder="Buscar aquí..." autofocus >
					<input type="submit" name="buscador" class="boton peque aceptar" value="buscar">
				</form>
			</div>
		</aside>
		<section>
			<div class="breadcrumbs">
				<?php
					// This function will take $_SERVER['REQUEST_URI'] and build a breadcrumb based on the user's current path
				function breadcrumbs($separator = ' &raquo; ', $home = 'Home') {
				    // This gets the REQUEST_URI (/path/to/file.php), splits the string (using '/') into an array, and then filters out any empty values
				    $path = array_filter(explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)));

				    // This will build our "base URL" ... Also accounts for HTTPS :)
				    $base = 'http://' . $_SERVER['HTTP_HOST'] . '/' . '?';
				  //  http://localhost/DAW/DEWS/Proyecto/frontoffice/indexp.php?patines

				    // Initialize a temporary array with our breadcrumbs. (starting with our home page, which I'm assuming will be the base URL)
				    $breadcrumbs = Array("<a href=\"$base\">$home</a>");

				    // Find out the index for the last value in our path array
				    $last = end(array_keys($path));

				    // Build the rest of the breadcrumbs
				    foreach ($path AS $x => $crumb) {
				        // Our "title" is the text that will be displayed (strip out .php and turn '_' into a space)
				        $title = ucwords(str_replace(Array('.php', '_'), Array('', ' '), $crumb));

				        // If we are not on the last index, then display an <a> tag
				        if ($x != $last)
				            $breadcrumbs[] = "<a href=\"$base$crumb\">$title</a>";
				        // Otherwise, just display the title (minus)
				        else
				            $breadcrumbs[] = $title;
				    }

				    // Build our temporary array (pieces of bread) into one big string :)
				    return implode($separator, $breadcrumbs);
				}

				?>
				<!-- 
				<p><?= breadcrumbs() ?></p>
				<p><?= breadcrumbs(' > ') ?></p> -->
				<?= breadcrumbs(' > ', ' ttounkyo ') ?>
				
			</div>
		<?php

			
				if($seccion=='producto'){
					require_once('producto.php');
				}
				elseif($seccion=="registro"){
					require_once("registro.php");
				}
				elseif($seccion=="pedido"){
					require_once("pedido.php");
				}
				elseif($seccion == 'logout'){
					unset($_SESSION['usuariofront']);
					unset($_SESSION['usuario']);
					header("location:indexp.php");
				}
				elseif($seccion == 'buscador'){
					require_once("buscador.php");
				}
				elseif ($seccion=="patines"){
					require_once("patines.php");
				}
				elseif ($seccion== 'accesorios'){
					require_once("accesorios.php");
				}
				elseif ($seccion== 'marca'){
					require_once("marca.php");
				}
				else{
					//require_once("patines.php");
				} 
				?>
		</section>
		<footer>
			<div>
				<p>
				¿Necesitas ayuda?<br>
				Localizar o gestionar compras<br>
				Tarifas y políticas de envío<br>
				Devolver o reemplazar productos<br>
				</p>
			</div>
			<div>
				<p>
				Métodos de pago TTOUNKYO<br>
				Métodos de pago<br>
				Conversor de divisas<br>
				Cheques Regalo<br>
				</p>
			</div>
			<div>
				<p>
				Avisos y condiciones<br>
				Condiciones de Uso y Venta<br>
				Aviso de privacidad<br>
				Área legalCookies y Publicidad
				en Internet<br>
				</p>
			</div>
			<span>
				© 1996-2015, ttounkyo.com, Inc. o afiliados. Todos los derechos reservados.
			</span>
		</footer>
		<script type="text/javascript" src="js/funciones_index.js"></script>
	</body>
</html>