<?php 
session_start();
if (!isset($_GET['sec']))
$seccion = null;
else
$seccion = $_GET['sec'];

if(isset($_SESSION['usuario'])){

// if(!isset($_COOKIE['user'])){
//     setcookie("user",false, time()+10);     
// }
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
		<link rel='stylesheet' type='text/css' href='css/principal.css'>
	</head>
	<body>
		<div id="wrapper">
			<div id="header"><?php require_once("header.php") ?></div>
			<div id="sidebar"><?php require_once("sidebar.php") ?></div>
			<div id="principal">
				<?php 
				if($seccion=='producto'){
					require_once('producto.php');
				}
				elseif($seccion=="eliminarpro"){
					require_once("eliminarpro.php");
				}
				elseif($seccion=="modificarpro"){
					require_once("modificarpro.php");
				}
				else if($seccion=="altausuario"){
					require_once("altausuario.php");
				}
				elseif($seccion=="categoria"){
					require_once("categoria.php");
				}
				elseif($seccion=="eliminarctg"){
					require_once("eliminarctg.php");
				}
				elseif($seccion=="modificarctg"){
					require_once("modificarctg.php");
				}
				elseif($seccion=="pedido"){
					require_once("pedido.php");
				}
				elseif($seccion=="log"){
					require_once("log.php");
				}
				elseif ($seccion=="logout"){
                    session_destroy();
                    header('location:login.php');
                }
				else{
					require_once("inicio.php");
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