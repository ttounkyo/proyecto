<?php
session_start();
if (!isset($_GET['sec'])) {
	$seccion = null;
} else {
	$seccion = $_GET['sec'];
}
require_once "../funciones.php";
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>HOME</title>
		<meta name="viewport" content="width=device-width,initial-scale=1">
		<link rel="stylesheet" href="css/principal.css">
		<link rel="shortcut icon" href="./imagenes/favicon.ico" type="image/x-icon" />
		<link rel="apple-touch-icon" sizes="57x57" href="./imagenes/apps/apple-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="./imagenes/apps/apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="./imagenes/apps/apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="./imagenes/apps/apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="./imagenes/apps/apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="./imagenes/apps/apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="./imagenes/apps/apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="./imagenes/apps/apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="./imagenes/apps/apple-icon-180x180.png">
		<link rel="icon" type="image/png" sizes="192x192"  href="./imagenes/apps/android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32" href="./imagenes/apps/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="./imagenes/apps/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="./imagenes/apps/favicon-16x16.png">
		<link rel="manifest" href="/manifest.json">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
		<meta name="theme-color" content="#ffffff">
		<!-- Librerias añadidas por mi
		<script src="js/fastclick.js"></script>
		<script src="js/scroll.js"></script>
		<script src="js/fixed-responsive-nav.js"></script>
		<script src="js/responsive-nav.js"></script>
		-->
	</head>
	<body>
		<!-- Hacer cada archivo contenido de la pagina en otro porque será mucha la complicacion que tendremos
		Podemos poner en otra carpeta y gestionar el FrontOffice -->
		<header>
			<?php require_once "nav.php";?>
		</header>
		<div class="equals">
			<div class="row">
				<!-- aside -->
				<?php require_once "sidebar.php";?>
				<!-- breadcrumb -->
				<section>
					<div class="breadcrumbs">
						hola
					</div>
					<?php
switch ($seccion) {
case 'pedido':
	require_once 'pedido.php';
	break;
case 'listapedido':
	require_once 'listapedido.php';
	break;
case 'cancelar':
	unset($_SESSION['id']);
	unset($_SESSION['can']);
	unset($_SESSION['carrito']);

	//header("location:index.php?sec=patines");
	break;
case 'compra':
	require_once './factura/compra.php';
	break;
case 'registro':
	require_once "registro.php";
	break;
case 'altausuario':
	require_once "../backoffice/usuario/altausuario.php";
	break;
case 'logout':
	unset($_SESSION['usuariofront']);
	header("location:index.php");
	break;
case 'facebook':
	require_once "./fb/fbconfig.php";
	break;
case 'buscador':
	require_once "buscador.php";
	break;
case 'patines':
	require_once "patines.php";
	break;
case 'accesorios':
	require_once "accesorios.php";
	break;
case 'marca':
	require_once "marca.php";
	break;
case 'guardarpdf':
	require_once "./compra_pdf.php";
	break;
case 'imagenes':
	require_once "./galeria/imgGaleria.php";
	break;
case 'videos':
	require_once "./galeria/videos/videos.php";
	break;
default:
	require_once "patines.php";
	break;
}
?>
				</section>
				<!-- aside2 -->
				<?php require_once "sidebar2.php";?>
				<!-- footer -->
			</div>
		</div>
		<?php require_once "pie.php";?>
		<script type="text/javascript" src="js/funciones_index.js"></script>
	</body>
</html>