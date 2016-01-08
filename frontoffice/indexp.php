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
			
			<?php 
				require_once("nav.php");
			 ?>
		</header>
		
		<!-- aside -->
		<?php require_once("sidebar.php"); ?>
		
		<section>
			<?php
				require_once("migapan.php");
			?>
			<?php
				switch ($seccion) {
					case 'pedido':
						require_once('pedido.php');
						break;
					case 'compra':
						require_once('compra.php');
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
		<?php
			require_once("pie.php");
		?>
		<script type="text/javascript" src="js/funciones_index.js"></script>
	</body>
</html>