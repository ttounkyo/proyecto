<?php 
	session_start();
	if (!isset($_GET['sec']))
	$seccion = null;
	else
	$seccion = $_GET['sec'];
	
  


 ?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>HOME</title>
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<link rel="stylesheet" href="css/principal.css">
	
		<!-- Librerias añadidas por mi -->
		<script src="js/fastclick.js"></script>
	    <script src="js/scroll.js"></script>
	    <script src="js/fixed-responsive-nav.js"></script>
		<script src="js/responsive-nav.js"></script>
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
		<aside class="buscador">
			<?php require_once("sidebar.php"); ?>
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
			switch ($seccion) {
				case 'pedido':
					require_once('pedido.php');
					break;
				case 'registro':
					require_once("registro.php");
					break;
				case 'logout':
					unset($_SESSION['usuariofront']);
					unset($_SESSION['usuario']);
					header("location:indexp.php");
					break;
				case 'buscador':
					require_once("buscador.php");
					break;
				case 'patines':
					require_once("patines.php");
					break;
				case 'accesorios':
					require_once("accesorios.php");
					break;
				case 'marca':
					require_once("marca.php");
					break;				
				default:
					# code...
					break;
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