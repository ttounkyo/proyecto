<?php 
session_start();
if (!isset($_GET['sec']))
$seccion = null;
else
$seccion = $_GET['sec'];
//$db = new mysqli('db608606955.db.1and1.com', 'dbo608606955', '162534Aa', 'db608606955');
// Ponemos la session rol para que el cliente no entre al backoffice porque no tiene porque mirar las cosas eso los trabajadores.
if($_SESSION['rol'] === 'administrador'){

 ?>
<!DOCTYPE html>
<!--
* PROYECTO DE PHP, TTOUNKYO.
	* NAME:	 TIENDA ONLINE.
* FECHA: 30/11/2015.
* AUTOR: ILDEFONSO ANTONIO DELGADO MOREIRA.
* eMAIL: aa.antonio.delgado@gmail.com
* DESCRIPCION: PHP y HTML
*
-->
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Inicio</title>
		<link rel='stylesheet' type='text/css' href='../css/principal.css'>
	</head>
	<body>
		<div id="wrapper">
			<div id="header"><?php require_once("header.php") ?></div>
			<div id="sidebar"><?php require_once("sidebar.php") ?></div>
			<div id="principal">
				<?php
				
				switch ($seccion) {
					case "producto":
					require_once('../producto/producto.php');
						break;				
					case "eliminarpro":
						require_once("../producto/eliminarpro.php");
						break;				
					case "modificarpro":
						require_once("../producto/modificarpro.php");
						break;				
					case "altausuario":
						require_once("../usuario/altausuario.php");
						break;				
					case "categoria":
						require_once("../categoria/categoria.php");
						break;				
					case "eliminarctg":
						require_once("../categoria/eliminarctg.php");
						break;				
					case "modificarctg":
						require_once("../categoria/modificarctg.php");
						break;	
					case "enviar":
						require_once('../mail/enviar.php');
						break;			
					case "pedido":
						require_once("../pedido/pedido.php");
						break;
					case "eliminarpe":
						require_once("../pedido/eliminarpe.php");
						break;
					case "modificarpe":
						require_once("../pedido/modificarpe.php");
						break;			
					case "log":
						require_once("../usuario/log.php");
						break;
					case "compra":
						require_once("../pedido/compra.php");
						break;			
					case "logout":
	                    unset($_SESSION['usuario']);
	                    header('location:../usuario/login.php');
	                    break;
	                   
	                default: 
	                	require_once("inicio.php");
	                	break;
				}
				?>
			</div>
		</div>
	</body>
</html>

<?php 
	
}else{
	header("location:login.php");
}

 ?>